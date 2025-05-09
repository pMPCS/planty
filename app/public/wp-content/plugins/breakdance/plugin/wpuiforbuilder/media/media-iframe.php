<?php

namespace Breakdance\WPUIForBuilder\Media;

if (isset($_GET['breakdance_wpuiforbuilder_media']) && $_GET['breakdance_wpuiforbuilder_media']) {
    add_action('admin_enqueue_scripts', '\Breakdance\WPUIForBuilder\Media\enqueueMediaScriptsAndStyles');
}

function enqueueMediaScriptsAndStyles()
{
    /** @psalm-suppress UndefinedConstant */
    $version = (string) __BREAKDANCE_VERSION;

    wp_enqueue_media();

    wp_enqueue_script('breakdance-media-control', BREAKDANCE_PLUGIN_URL . "plugin/wpuiforbuilder/media/media.js", [], $version);
    wp_enqueue_style('breakdance-media-control', BREAKDANCE_PLUGIN_URL . "plugin/wpuiforbuilder/media/media.css", [], $version);
}
