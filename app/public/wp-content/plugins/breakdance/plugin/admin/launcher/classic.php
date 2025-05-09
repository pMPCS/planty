<?php

namespace Breakdance\Admin;

function classic_editor_scripts()
{
    if (!is_breakdance_available()) {
        return;
    }

    if (\Breakdance\is_gutenberg_page()) {
        return;
    }

    $url = BREAKDANCE_PLUGIN_URL . 'plugin/admin/launcher/js/classic.js';
    /** @psalm-suppress UndefinedConstant */
    $version = (string) __BREAKDANCE_VERSION;

    wp_enqueue_script('breakdance-launcher-classic', $url, ['breakdance-launcher-shared'], $version);
}
add_action('admin_enqueue_scripts', 'Breakdance\Admin\classic_editor_scripts');

function add_launcher_to_classic_editor()
{
    if (!is_breakdance_available()) {
        return;
    }

    $config = get_launcher_config();
    $strings = $config['strings'];

    /** @var \WP_Post|null $post */
    $post = get_post();
    if ($post !== null) {
        $postHasClassicEditorContent = trim(get_the_content()) !== '';
        $postHasBreakdanceContent = !empty(get_post_meta($post->ID, '_breakdance_data'));

        if (!$postHasBreakdanceContent && $postHasClassicEditorContent) {
            return;
        }
    }

?>
    <div class="breakdance-launcher breakdance-launcher--classic">

        <svg class="breakdance-logo" xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 49 68">
            <path d="M27.8994 66.001C31.7098 66.001 34.7988 62.912 34.7988 59.1016C34.7988 55.2911 31.7098 52.2021 27.8994 52.2021C24.089 52.2021 21 55.2911 21 59.1016C21 62.912 24.089 66.001 27.8994 66.001Z"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.834 48.34C3.55184 48.3392 2.32245 47.8294 1.41602 46.9226C0.509581 46.0158 0.000264827 44.7862 0 43.504C0.0010599 42.2222 0.510864 40.9932 1.41743 40.087C2.324 39.1808 3.55319 38.6715 4.835 38.671H14.535C15.8113 38.662 17.0324 38.1488 17.9319 37.2433C18.8314 36.3378 19.3365 35.1134 19.337 33.837V4.833C19.3378 3.55145 19.8472 2.32262 20.7534 1.41643C21.6596 0.51024 22.8885 0.000794758 24.17 0C25.4517 0.000529828 26.6808 0.509858 27.5872 1.41608C28.4936 2.3223 29.0032 3.55128 29.004 4.833V18.503C29.0048 19.7845 30.4204 21.9196 30.4204 21.9196C31.3266 22.8258 32.5555 23.3352 33.837 23.336C35.1189 23.3355 36.3481 22.826 37.2546 21.9196C38.161 21.0131 38.6705 19.7839 38.671 18.502V4.833C38.6718 3.55128 39.1814 2.3223 40.0878 1.41608C40.9942 0.509858 42.2233 0.000529828 43.505 0C44.7868 0.000529565 46.016 0.509825 46.9226 1.41602C47.8291 2.32221 48.3389 3.55119 48.34 4.833V62.842C48.3392 64.124 47.8295 65.3532 46.9229 66.2596C46.0163 67.166 44.787 67.6755 43.505 67.676C42.2231 67.6755 40.9939 67.166 40.0874 66.2596C39.181 65.3531 38.6715 64.1239 38.671 62.842V58.008C38.671 52.671 34.339 48.339 29.004 48.339L4.834 48.34Z"></path>
        </svg>

        <p class="breakdance-launcher__description"><?php echo $strings['description']; ?></p>

        <div class="breakdance-launcher__buttons">
            <button class="breakdance-launcher-button" type="button" data-breakdance-action="edit"><?php echo $strings['openButton']; ?></button>

            <?php
            if ($config['canUseDefaultEditor']) {
                echo '<button class="breakdance-launcher-link" type="button" data-breakdance-action="disable">' . $strings['disableButton'] . '</button>';
            }
            ?>
        </div>

        <span class="breakdance-launcher__unsaved-changes"><?php echo $strings['unsavedMessage']; ?></span>
    </div>

    <style>
        /* hide tinymce */
        .is-breakdance-available #postdivrich {
            display: none;
        }

        .is-breakdance-available #post-body-content .breakdance-launcher-small-button {
            display: none;
        }
    </style>
<?php
}
add_action('edit_form_after_editor', '\Breakdance\Admin\add_launcher_to_classic_editor');

function add_edit_button_to_classic_editor()
{
    if (!is_breakdance_available()) {
        return;
    }

    $config = get_launcher_config();
    $strings = $config['strings'];

    if ($config['hasFullAccess']) {
        echo <<<HTML
        <button class="breakdance-launcher-small-button" data-breakdance-action="edit">{$strings['openButton']}</button>
        HTML;
    }
}
add_action('edit_form_after_title', '\Breakdance\Admin\add_edit_button_to_classic_editor');
