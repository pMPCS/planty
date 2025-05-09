<?php

namespace Breakdance\DesignLibrary;

use function Breakdance\Data\get_global_option;
use function Breakdance\Data\get_meta;
use function Breakdance\Data\save_global_settings;
use function Breakdance\Data\set_global_option;
use function Breakdance\Data\set_meta;
use function Breakdance\remotePostToWpAjax;
use function Breakdance\Themeless\getTemplateSettingsFromDatabase;
use function Breakdance\Themeless\ManageTemplates\deleteTemplatesByPostType;
use function Breakdance\Themeless\ManageTemplates\saveTemplate;

/**
 * @param string $url
 * @return DesignSetData|array{error: string}
 */
function externalEndpoint($url)
{
    return getDesignSetRemoteData($url);
}

// ****** Getting external data endpoints ****** //
add_action('breakdance_loaded', function () {
    \Breakdance\AJAX\register_handler(
        'breakdance_get_external_design_set',
        'Breakdance\DesignLibrary\externalEndpoint',
        'full',
        true,
        [
            'args' => [
                'url' => FILTER_VALIDATE_URL
            ],
        ]
    );

    \Breakdance\AJAX\register_handler(
        'breakdance_get_external_global_settings',
        'Breakdance\DesignLibrary\getExternalGlobalSettings',
        'full',
        true,
        [
            'args' => [
                'url' => FILTER_VALIDATE_URL
            ],
        ]
    );

    \Breakdance\AJAX\register_handler(
        'breakdance_get_external_design_presets',
        'Breakdance\DesignLibrary\getExternalDesignPresets',
        'full',
        true,
        [
            'args' => [
                'url' => FILTER_VALIDATE_URL
            ],
        ]
    );

    \Breakdance\AJAX\register_handler(
        'breakdance_import_external_global_settings',
        'Breakdance\DesignLibrary\importExternalGlobalSettings',
        'full',
        true,
        [
            'args' => [
                'url' => FILTER_VALIDATE_URL
            ],
        ]
    );

    \Breakdance\AJAX\register_handler(
        'breakdance_import_external_design_presets',
        'Breakdance\DesignLibrary\importExternalDesignPresets',
        'full',
        true,
        [
            'args' => [
                'url' => FILTER_VALIDATE_URL
            ],
        ]
    );

    \Breakdance\AJAX\register_handler(
        'breakdance_get_design_library_data',
        'Breakdance\DesignLibrary\getDesignLibraryData',
        'full',
    );

    \Breakdance\AJAX\register_handler(
        'breakdance_set_design_set_password',
        'Breakdance\DesignLibrary\setDesignSetPassword',
        'full',
        true,
        [
            'args' => [
                'url' => FILTER_VALIDATE_URL,
                'password' => FILTER_UNSAFE_RAW
            ],
        ]
    );

    \Breakdance\AJAX\register_handler(
        'breakdance_get_invalid_design_sets',
        'Breakdance\DesignLibrary\getInvalidDesignSets',
        'full',
        true,
        [],
        true
    );
});

/**
 * @param string $url
 * @return array
 */
function getExternalGlobalSettings($url)
{
    $request = remotePostToWpAjax($url, 'breakdance_get_global_settings_for_design_library');

    if (is_wp_error($request)) {
        /** @var \WP_Error $request */
        $request = $request;

        return ['error' => $request->get_error_message()];
    }

    $body = wp_remote_retrieve_body($request);

    /** @var mixed */
    $data = json_decode($body, true);

    if (isset($data['error'])) {
        /** @var array{error: string} */
        return $data;
    }

    if (!isset($data['globalSettings'])) return ['error' => 'Wrong data from ' . $url];

    /** @var array{globalSettings: mixed} */
    return $data;
}

/**
 * @param string $url
 * @return ElementPreset[]|array{error: string}
 */
function getExternalDesignPresets($url)
{
    $request = remotePostToWpAjax($url, 'breakdance_get_design_presets_for_design_library');

    if (is_wp_error($request)) {
        /** @var \WP_Error $request */
        $request = $request;

        return ['error' => $request->get_error_message()];
    }

    $body = wp_remote_retrieve_body($request);

    /** @var mixed */
    $data = json_decode($body, true);

    if (isset($data['error'])) {
        /** @var array{error: string} */
        return $data;
    }

    /** @var ElementPreset[] */
    return $data;
}

/**
 * @param string $url
 * @return array{success: string}|array{error: string}
 */
function importExternalGlobalSettings($url)
{
    $externalGlobalSettings = getExternalGlobalSettings($url);

    if (isset($externalGlobalSettings['error'])) {
        /** @var array{error: string} */
        return $externalGlobalSettings;
    }

    if (!isset($externalGlobalSettings['globalSettings'])) {
        return ['error' => "Wrong data from $url"];
    }

    save_global_settings(json_encode($externalGlobalSettings['globalSettings']));
    set_global_option('design_library_global_settings_last_imported_from_url', $url);

    return ['success' => 'Global settings imported'];
}

/**
 * @param string $url
 * @return array{success: string}|array{error: string}
 */
function importExternalDesignPresets($url)
{
    $presets = getExternalDesignPresets($url);

    if (isset($presets['error'])) {
        /** @var array{error: string} */
        return $presets;
    }

    if (!$presets) {
        return ['success' => "No presets found."];
    }

    $presetsJson = json_encode($presets);

    \Breakdance\Data\save_presets($presetsJson);
    set_global_option('design_library_design_presets_last_imported_from_url', $url);

    return ['success' => 'Design Presets imported'];
}

/**
 * @return array
 */
function getDesignLibraryData()
{
    return [
        'designProviders' => getDesignProviders(),
        'globalSettingsLastImportedFromUrl' => get_global_option('design_library_global_settings_last_imported_from_url') ?: null,
        'designPresetsLastImportedFromUrl' => get_global_option('design_library_design_presets_last_imported_from_url') ?: null,
        'fullSiteLastImportedFromUrl' => get_global_option('design_library_full_site_last_imported_from_url') ?: null,
    ];
}

/**
 * @param string $url
 * @param string $password
 * @return array{validated: bool, message: string}|array{error: string}
 */
function setDesignSetPassword($url, $password)
{
    if (checkRemotePassword($url, $password)) {
        setPasswordForExternalDesignSet($url, $password);
        return [
            'validated' => true,
            'message' => 'Password has been set.'
        ];
    } else {
        return ['error' => 'Wrong password.'];
    }
}

// ***** Importing a full site endpoints ***** //

add_action('breakdance_loaded', function () {
    \Breakdance\AJAX\register_handler(
        'breakdance_design_lib_get_ids_of_posts_and_pages_to_import',
        'Breakdance\DesignLibrary\getIdsOfPostsToImport',
        'full',
        true,
        [
            'args' => [
                'url' => FILTER_VALIDATE_URL
            ],
        ]
    );

    \Breakdance\AJAX\register_handler(
        'breakdance_design_lib_get_homepage_id_to_import',
        'Breakdance\DesignLibrary\getHomepageIdToImport',
        'full',
        true,
        [
            'args' => [
                'url' => FILTER_VALIDATE_URL
            ],
        ]
    );

    \Breakdance\AJAX\register_handler(
        'breakdance_design_lib_get_ids_of_templates_to_import',
        'Breakdance\DesignLibrary\getIdsOfTemplatesToImport',
        'full',
        true,
        [
            'args' => [
                'url' => FILTER_VALIDATE_URL
            ],
        ]
    );

    \Breakdance\AJAX\register_handler(
        'breakdance_design_lib_import_post_or_page',
        'Breakdance\DesignLibrary\importPostOrPage',
        'full',
        true,
        [
            'args' => [
                'url' => FILTER_VALIDATE_URL,
                'id' => FILTER_VALIDATE_INT
            ],
        ]
    );

    \Breakdance\AJAX\register_handler(
        'breakdance_design_lib_import_template_by_id',
        'Breakdance\DesignLibrary\importTemplateById',
        'full',
        true,
        [
            'args' => [
                'url' => FILTER_VALIDATE_URL,
                'id' => FILTER_VALIDATE_INT
            ],
        ]
    );


    \Breakdance\AJAX\register_handler(
        'breakdance_design_lib_trash_all_templates_by_type',
        'Breakdance\DesignLibrary\trashAllTemplatesByType',
        'full',
        true,
        [
            'args' => [
                'templateType' => FILTER_UNSAFE_RAW
            ],
        ]
    );
});

/**
 * @param string $url
 * @return int[]|array{error: string}
 */
function getIdsOfPostsToImport($url)
{
    $request = remotePostToWpAjax($url, 'breakdance_design_lib_get_ids_of_posts_and_pages_to_export');

    if (is_wp_error($request)) {
        /** @var \WP_Error $request */
        $request = $request;

        return ['error' => $request->get_error_message()];
    }


    $idsOfPostsToImport = wp_remote_retrieve_body($request);

    /** @var int[] */
    $data = json_decode($idsOfPostsToImport, true);

    return $data;
}

/**
 * @param string $url
 * @return array{id: int}|array{error: string}
 */
function getHomepageIdToImport($url)
{
    $request = remotePostToWpAjax($url, 'breakdance_design_lib_get_homepage_id');

    if (is_wp_error($request)) {
        /** @var \WP_Error $request */
        $request = $request;

        return ['error' => $request->get_error_message()];
    }

    /** @var array{id: int}|mixed $body */
    $body = json_decode(wp_remote_retrieve_body($request), true);

    return ['id' => $body && isset($body['id']) ? intval($body['id'] ?? '0') : 0];
}

/**
 * @param string $url
 * @return array
 */
function getIdsOfTemplatesToImport($url)
{
    $request = remotePostToWpAjax($url, 'breakdance_design_lib_get_ids_of_templates_to_export');

    if (is_wp_error($request)) {
        /** @var \WP_Error $request */
        $request = $request;

        return ['error' => $request->get_error_message()];
    }

    $idsOfPostsToImport = wp_remote_retrieve_body($request);

    /** @var array */
    return json_decode($idsOfPostsToImport, true);
}

/**
 * @param string $url
 * @param int $id
 * @return array
 */
function importPostOrPage($url, $id)
{
    $request = remotePostToWpAjax($url, 'breakdance_design_lib_get_post_data', ['id' => $id]);

    if (is_wp_error($request)) {
        /** @var \WP_Error $request */
        $request = $request;

        return ['error' => $request->get_error_message()];
    }

    $postData = wp_remote_retrieve_body($request);
    /** @var array{postData: array{ post_title: string, post_name: string, post_content: string, post_excerpt: string, post_status: string, post_type: string}, breakdanceData: array{ tree_json_string: string }} $postDataJson
     */
    $postDataJson = json_decode($postData, true);

    if (!isset($postDataJson['postData']) || !isset($postDataJson['breakdanceData'])) {
        return ['error' => "Wrong data from " . $url];
    }

    $IdOfExistingPostOrPageWithSameTitle = getIdOfPostByTitle($postDataJson['postData']['post_type'], $postDataJson['postData']['post_title']);

    // don't save post/page if it already exists
    if ($IdOfExistingPostOrPageWithSameTitle) {
        /** @var array{ tree_json_string: string } $existingBreakdanceData */
        $existingBreakdanceData = get_meta($IdOfExistingPostOrPageWithSameTitle, '_breakdance_data');

        if ($existingBreakdanceData === $postDataJson['breakdanceData']) {
            return ['success' => $postDataJson['postData']['post_type'] . ' already exists'];
        }
    }

    $importedPostId = wp_insert_post($postDataJson['postData']);

    if (!$importedPostId) return ['error' => "Failed at importing post"];

    if (is_wp_error($importedPostId)) {
        /** @var \WP_Error $request */
        $request = $request;

        return ['error' => $request->get_error_message()];
    }

    set_meta((int)$importedPostId, '_breakdance_data', $postDataJson['breakdanceData']);

    return ['success' => $postDataJson['postData']['post_type'] . " '$id' imported successfully", 'postId' => $importedPostId];
}

/**
 * @param string $url
 * @param int $id
 * @return array
 */
function importTemplateById($url, $id)
{
    $request = remotePostToWpAjax($url, 'breakdance_design_lib_get_template_data', ['id' => $id]);

    if (is_wp_error($request)) {
        /** @var \WP_Error $request */
        $request = $request;

        return ['error' => $request->get_error_message()];
    }

    $templateData = wp_remote_retrieve_body($request);
    /** @var array{isFallback: bool}|array{title: string, settings: string, postType: string, breakdanceData: string} $templateDataJson */
    $templateDataJson = json_decode($templateData, true);

    // ignore fallback templates
    if (isset($templateDataJson['isFallback'])) {
        return ['success' => 'Fallback templates are ignored'];
    }

    if (!isset($templateDataJson['title']) || !array_key_exists('settings', $templateDataJson)) {
        return ['error' => "Wrong data from " . $url];
    }

    /** @var array{title: string, settings: string, postType: string, breakdanceData: array{ tree_json_string: string }} $templateDataJson */
    $templateDataJson = $templateDataJson;

    // Note: we trash all templates/headers/etc before importing. No need to check if the importing template already exists
    $savedTemplate = saveTemplate(
        $templateDataJson['title'],
        // -1 to create new template
        -1,
        json_encode($templateDataJson['settings']),
        $templateDataJson['postType']
    );

    if ($savedTemplate['error'] ?? !isset($savedTemplate['data']['id'])) return ['error' => "Failed at importing template " . $id];

    $templateDataJson['breakdanceData'] = updateDesignLibraryUrls($templateDataJson['breakdanceData'], $url);

    set_meta($savedTemplate['data']['id'] ?? 0, '_breakdance_data', $templateDataJson['breakdanceData']);

    return ['success' => "Imported template '$id' successfully"];
}

/**
 * @param array{ tree_json_string: string } $data
 * @param string $url
 * @return array{ tree_json_string: string }
 */
function updateDesignLibraryUrls($data, $url) {
    $tree = $data['tree_json_string'];
    $old_url = rtrim($url,"/");
    $new_url = get_site_url();

    // Match all URLs that don't include /wp-content/ to avoid replacing image URLs
    $regex = '/"((' . preg_quote($old_url, '/') . ')((?!\/wp-content\/)[^"]+))"/';
    $replaced_tree = preg_replace($regex, '"' . $new_url . '${3}"', $tree);

    $data['tree_json_string'] = $replaced_tree;

    return $data;
}

/**
 * Equivalent to deprecated "get_page_by_title"
 * https://make.wordpress.org/core/2023/03/06/get_page_by_title-deprecated/
 *
 * @param string $postType
 * @param string $title
 * @return false|int
 */
function getIdOfPostByTitle($postType, $title)
{
    $existingPostWithSameTitle = new \WP_Query([
        'post_type' => $postType,
        'title' => $title,
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'no_found_rows'          => true,
        'update_post_term_cache' => false,
        'update_post_meta_cache' => false,
    ]);

    /**
     * These checks aren't redundant, Psalm is dumb
     * @psalm-suppress RedundantConditionGivenDocblockType
     * @psalm-suppress RedundantCondition
     */
    if (!empty($existingPostWithSameTitle) && $existingPostWithSameTitle->post) {
        return $existingPostWithSameTitle->post->ID;
    }

    return false;
}

/**
 * @param string $templateType
 * @return array
 */
function trashAllTemplatesByType($templateType)
{
    $success = false;

    if ($templateType === 'headers') {
        $success = trashAllTemplatesByPostType(BREAKDANCE_HEADER_POST_TYPE);
    } else if ($templateType === 'footers') {
        $success = trashAllTemplatesByPostType(BREAKDANCE_FOOTER_POST_TYPE);
    } else if ($templateType === 'templates') {
        $success = trashAllTemplatesByPostType(BREAKDANCE_TEMPLATE_POST_TYPE);
    } else if ($templateType === 'global_blocks') {
        $success = trashAllTemplatesByPostType(BREAKDANCE_BLOCK_POST_TYPE);
    } else if ($templateType === 'popups') {
        $success = trashAllTemplatesByPostType(BREAKDANCE_POPUP_POST_TYPE);
    }


    if (!$success) {
        return ['error' => 'Failed to delete ' . $templateType];
    }

    return ['success' => "Deleted $templateType successfully."];
}

/**
 * @param string $postType
 * @return array
 */
function trashAllTemplatesByPostType($postType)
{
    /** @var int[] $templatesIdToTrash */
    $templatesIdToTrash = get_posts([
        'post_type' => $postType,
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'fields' => 'ids'
    ]);

    $templatesIdToTrash = removeFallbacksFromTemplateIdsList($templatesIdToTrash);

    $failedToDeleteSomething = false;

    foreach ($templatesIdToTrash as $templateIdToTrash) {
        $trashed = wp_trash_post($templateIdToTrash);

        if (!$trashed) {
            $failedToDeleteSomething = true;
        }
    }

    if ($failedToDeleteSomething) {
        return ['error' => "Failed to delete all $postType."];
    }

    return ['success' => "Deleted all $postType successfully."];
}
