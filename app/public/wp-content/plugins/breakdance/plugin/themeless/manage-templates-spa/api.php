<?php

namespace Breakdance\Themeless\ManageTemplates;

use Breakdance\Themeless\ThemelessController;

use function Breakdance\Admin\get_builder_loader_url;
use function Breakdance\Admin\get_env;
use function Breakdance\Data\get_meta;
use function Breakdance\Data\set_meta;
use function Breakdance\DynamicData\get_dynamic_fields_for_builder;
use function Breakdance\Themeless\convertPhpTemplateTypesCategoriesToJsTemplateTypeCategories;
use function Breakdance\Themeless\getConditionsWithValuesForPostType;
use function Breakdance\Themeless\getFootersAsWPPosts;
use function Breakdance\Themeless\getGlobalBlocksAsWpPosts;
use function Breakdance\Themeless\getHeadersAsWPPosts;
use function Breakdance\Themeless\getPopupTriggers;
use function Breakdance\Themeless\getTemplatesAsWPPosts;
use function Breakdance\Themeless\getPopupsAsWPPosts;
use function Breakdance\Themeless\getTemplateSettingsFromDatabase;

add_action('breakdance_loaded', function () {
    \Breakdance\AJAX\register_handler(
        'breakdance_manage_templates_load_data',
        'Breakdance\Themeless\ManageTemplates\getTemplatesByPostType',
        'edit',
        true,
        ['args' => ['post_type' => FILTER_UNSAFE_RAW]]
    );
});

/**
 * @param string $postType
 * @return array{error?: string, data?: array{templates: TemplateData[], isWooCommerceActive: bool, templatesManagementData: array{conditions: TemplateConditionWithValues[], dynamicFields: DynamicField[], templateTypeCategories: JSTemplateTypeCategory[], popupTriggers: PopupTriggers[]|null }}}
 */
function getTemplatesByPostType($postType)
{
    do_action('breakdance_register_template_types_and_conditions');

    $triggers = null;
    if ($postType === BREAKDANCE_TEMPLATE_POST_TYPE) {
        $templates = getTemplatesAsWPPosts();
        $deletedTemplates = getTemplatesAsWPPosts(true);
        $conditions = getConditionsWithValuesForPostType(BREAKDANCE_TEMPLATE_POST_TYPE);
    } else if ($postType === BREAKDANCE_HEADER_POST_TYPE) {
        $templates = getHeadersAsWPPosts();
        $deletedTemplates = getHeadersAsWPPosts(true);
        $conditions = addEverywhereToAllConditionsAvailableForType(getConditionsWithValuesForPostType(BREAKDANCE_HEADER_POST_TYPE));
    } else if ($postType === BREAKDANCE_FOOTER_POST_TYPE) {
        $templates = getFootersAsWPPosts();
        $deletedTemplates = getFootersAsWPPosts(true);
        $conditions = addEverywhereToAllConditionsAvailableForType(getConditionsWithValuesForPostType(BREAKDANCE_FOOTER_POST_TYPE));
    } else if ($postType === BREAKDANCE_POPUP_POST_TYPE) {
        $templates = getPopupsAsWPPosts();
        $deletedTemplates = getPopupsAsWPPosts(true);
        $conditions = addEverywhereToAllConditionsAvailableForType(getConditionsWithValuesForPostType(BREAKDANCE_POPUP_POST_TYPE));
        $triggers = getPopupTriggers();
    } else {
        return ['error' => "Can't get data for an unsupported post type"];
    }

    return [
        'data' => [
            'templates' => array_merge(
                templateToValidBuilderTemplate($templates, 'publish'),
                templateToValidBuilderTemplate($deletedTemplates, 'trash')
            ),
            'templatesManagementData' => [
                'conditions' => $conditions,
                'dynamicFields' => get_dynamic_fields_for_builder(null),
                'templateTypeCategories' => convertPhpTemplateTypesCategoriesToJsTemplateTypeCategories(ThemelessController::getInstance()->templateTypeCategories),
                'popupTriggers' => $triggers
            ],
            'isWooCommerceActive' => \class_exists('WooCommerce'),
            'environment' => get_env(),
        ]
    ];
}

/**
 * We want access to all conditions for "everywhere".
 * @param TemplateConditionWithValues[] $conditions
 * @return TemplateConditionWithValues[]
 */
function addEverywhereToAllConditionsAvailableForType($conditions)
{
    return array_map(
        function ($condition) {
            $condition['availableForType'] = array_merge($condition['availableForType'], ['everywhere']);

            return $condition;
        },
        $conditions
    );
}

/**
 * @param \WP_Post[] $templates
 * @param 'publish'|'trash' $status
 * @return TemplateData[]
 */
function templateToValidBuilderTemplate($templates, $status)
{
    return array_map(function ($template) use ($status) {
        return [
            'id' => $template->ID,
            'title' => $template->post_title,
            'postType' => $template->post_type,
            'settings' => getTemplateSettingsFromDatabase($template->ID, true),
            'editInBreakdanceLink' => get_builder_loader_url($template->ID),
            'status' => $status,
        ];
    }, $templates);
}

// -----

add_action('breakdance_loaded', function () {
    \Breakdance\AJAX\register_handler(
        'breakdance_manage_templates_save',
        '\Breakdance\Themeless\ManageTemplates\saveTemplate',
        'edit',
        true,
        [
            'args' => [
                'title' => FILTER_UNSAFE_RAW,
                'id' => FILTER_VALIDATE_INT,
                'settings' => FILTER_UNSAFE_RAW,
                'postType' => FILTER_UNSAFE_RAW,
            ]
        ]
    );

    \Breakdance\AJAX\register_handler(
        'breakdance_manage_templates_duplicate',
        '\Breakdance\Themeless\ManageTemplates\duplicateTemplate',
        'edit',
        true,
        [
            'args' => [
                'originalId' => FILTER_VALIDATE_INT,
                'title' => FILTER_UNSAFE_RAW,
                'settings' => FILTER_UNSAFE_RAW,
                'postType' => FILTER_UNSAFE_RAW,
            ]
        ]
    );
});

/**
 * @param int $originalId
 * @param string $title
 * @param string $settings
 * @param string $postType
 * @return array{data?: TemplateData, error?: string}
 */
function duplicateTemplate($originalId, $title, $settings, $postType)
{
    $response = saveTemplate($title, -1, $settings, $postType);

    if (!isset($response['data'])) return $response;

    /** @var array $data */
    $data = get_meta($originalId, '_breakdance_data');

    set_meta($response['data']['id'], '_breakdance_data', $data);

    return $response;
}


/**
 * @param string $title
 * @param int $id
 * @param string $settings
 * @param string $postType
 * @return array{data?: TemplateData, error?: string}
 */
function saveTemplate($title, $id, $settings, $postType)
{
    $title = sanitize_text_field($title);

    /* ID needs to be -1 to create a post, because if it's something
    falsy like 0, it will return the current post in the loop. */
    $post = get_post($id);

    if ($post) {
        $result = wp_update_post(
            [
                'ID' => $id,
                'post_title' => $title,
            ],
            true
        );

        // TODO - security. Apparently arrays are supposed to be escaped, but not objects? What the fuck?
    } else {
        $result = wp_insert_post(
            [
                'post_title' => $title,
                'post_type' => $postType,
            ],
            true
        );
    }

    if (is_wp_error($result)) {
        return ['error' => "Couldn't update template with ID \"{$id}\""];
    }

    /**  @var int */
    $result = $result;

    \Breakdance\Data\set_meta($result, '_breakdance_template_settings', $settings);

    $template = get_post($result);

    if (!$template) {
        return ['error' => "Couldn't get template with ID \"{$id}\""];
    }

    /** @var \WP_Post */
    $template = $template;

    return [
        'data' => [
            'id' => $template->ID,
            'title' => $template->post_title,
            'postType' => $template->post_type,
            'settings' => getTemplateSettingsFromDatabase($template->ID, true),
            'editInBreakdanceLink' => get_builder_loader_url($template->ID),
            'status' => 'publish'
        ]
    ];
}

// ----

add_action('breakdance_loaded', function () {
    \Breakdance\AJAX\register_handler(
        'breakdance_manage_templates_delete',
        '\Breakdance\Themeless\ManageTemplates\deleteTemplate',
        'edit',
        true,
        ['args' => ['id' => FILTER_VALIDATE_INT, 'trashOrDelete' => FILTER_UNSAFE_RAW]]
    );
});

/**
 * @param int $id
 * @param string $trashOrDelete
 * @return array{data?: string, error?: string}
 */
function deleteTemplate($id, $trashOrDelete)
{
    $result = $trashOrDelete === 'delete' ? wp_delete_post($id) :  wp_trash_post($id);

    if (!$result) {
        return ['error' => "Couldn't {$trashOrDelete} template with ID \"{$id}\""];
    }

    return ['data' => 'success'];
}

// ----

add_action('breakdance_loaded', function () {
    \Breakdance\AJAX\register_handler(
        'breakdance_manage_templates_restore',
        '\Breakdance\Themeless\ManageTemplates\restoreTemplate',
        'edit',
        true,
        ['args' => ['id' => FILTER_VALIDATE_INT]]
    );
});

/**
 * @param int $id
 * @return array{data?: string, error?: string}
 */
function restoreTemplate($id)
{
    $result = wp_untrash_post($id);

    if (!$result) {
        return ['error' => "Couldn't restore template with ID \"{$id}\""];
    }

    return ['data' => 'success'];
}

// ----

add_action('breakdance_loaded', function () {
    \Breakdance\AJAX\register_handler(
        'breakdance_manage_global_blocks',
        '\Breakdance\Themeless\ManageTemplates\getGlobalBlocksToManage',
        'edit',
        true
    );
});

/**
 * @return array{data: GlobalBlock[]}
 */
function getGlobalBlocksToManage()
{
    $globalBlocks = getGlobalBlocksAsWpPosts();
    $deletedGlobalBlocks = getGlobalBlocksAsWpPosts(true);

    return ['data' => array_merge(
        getGlobalBlockFromWpPosts($globalBlocks, 'publish'),
        getGlobalBlockFromWpPosts($deletedGlobalBlocks, 'trash')
    )];
}

/**
 * @param \WP_Post[] $posts
 * @param 'publish'|'trash' $status
 * @return GlobalBlock[]
 */
function getGlobalBlockFromWpPosts($posts, $status)
{
    return array_map(function ($post) use ($status) {
        $tree = \Breakdance\Data\get_tree($post->ID);

        return [
            'label' => $post->post_title,
            'id' => intval($post->ID),
            'tree' => $tree,
            'editInBreakdanceLink' => get_builder_loader_url($post->ID),
            'status' => $status
        ];
    }, $posts);
}

// ----

add_action('breakdance_loaded', function () {
    \Breakdance\AJAX\register_handler(
        'breakdance_manage_templates_empty_trash',
        '\Breakdance\Themeless\ManageTemplates\emptyTrashByTemplatePostType',
        'edit',
        true,
        ['args' => ['postType' => FILTER_UNSAFE_RAW]]
    );
});

/**
 * @param string $postType
 * @return array{data?: string, error?: string}
 */
function emptyTrashByTemplatePostType($postType)
{
    /** @var int[] $deletedGlobalBlocksIds */
    $deletedGlobalBlocksIds = get_posts([
        'post_type' => $postType,
        'posts_per_page' => -1,
        'post_status' => 'trash',
        'fields' => 'ids'
    ]);

    $failedToDeleteSomething = false;

    foreach ($deletedGlobalBlocksIds as $deletedGlobalBlocksId) {
        $deleted = wp_delete_post($deletedGlobalBlocksId);

        if (!$deleted) {
            $failedToDeleteSomething = true;
        }
    }

    if ($failedToDeleteSomething) {
        return ['error' => 'Failed to empty trash'];
    }

    return ['data' => 'success'];
}
