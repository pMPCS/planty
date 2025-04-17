<?php

if (!function_exists('breakdance_zero_theme_setup')) {
    function breakdance_zero_theme_setup()
    {
        add_theme_support('title-tag');
        add_theme_support( 'post-thumbnails' );

    }
}

add_action('after_setup_theme', 'breakdance_zero_theme_setup');


add_action( 'admin_notices', 'warn_if_breakdance_is_disabled' );

function warn_if_breakdance_is_disabled() {
    if (defined('__BREAKDANCE_DIR__')){
        return;
    }

    ?>
    <div class="notice notice-error is-dismissible">
        <p>You're using Breakdance's Zero Theme but Breakdance is not enabled. This isn't supported.</p>
    </div>
    <?php
}
//** Ajout du lien "Admin" **//

function ajouter_lien_admin_menu($items, $args) {
    // Vérifier si l'utilisateur est connecté
    if (is_user_logged_in()) {
        // Ajouter un lien "Admin" qui pointe vers le tableau de bord WordPress
        $items .= '<li class="menu-item"><a href="' . admin_url() . '">Admin</a></li>';
    }
    return $items;
}
// Ajouter la fonction au menu principal
add_filter('wp_nav_menu_items', 'ajouter_lien_admin_menu', 10, 2);