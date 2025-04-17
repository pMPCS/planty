<?php

// Direkten Aufruf verhindern
if(!defined('ABSPATH')) exit();

// Child-Theme-Ressourcen laden
function mn_theme_resources()
{
	// Version bestimmen
	if(isset($_GET['dev'])) $version=time();
	else $version='';

	// CSS laden
	wp_enqueue_style('style.css', get_stylesheet_directory_uri().'/style.css', array(), $version, 'all');

	// JS laden
	wp_register_script('functions.js', get_stylesheet_directory_uri().'/functions.js' , array('jquery'), $version);
	wp_enqueue_script('functions.js');
}
add_action('wp_enqueue_scripts', 'mn_theme_resources');

// WP-Admin-Ressourcen laden
function mn_wp_admin_resources()
{
	// Enqueue wp admin style
	wp_enqueue_style('mn-wp-admin-style', get_stylesheet_directory_uri().'/style-wp-admin.css', array(), '1.0', 'all');
}
// add_action('admin_enqueue_scripts', 'mn_wp_admin_resources');

/*  Breakdance: Google Fonts deaktivieren
add_filter('breakdance_register_font', function($font) 
{
	$isGoogleFont = !!$font['dependencies']['googleFonts'];
	if ($isGoogleFont) return false;
	return $font;
}, PHP_INT_MAX, 1); */


//** Ajout du lien "Admin" **//

function ajouter_lien_admin_menu($items, $args) {
    // Vérifier si l'utilisateur est connecté
    
    if (is_user_logged_in()  && $args->menu == "menu-principal" ) {
        // Ajouter un lien "Admin" qui pointe vers le tableau de bord WordPress
        $items .= '<li class="menu-item"><a href="' . admin_url() . '">Admin</a></li>';
    }
	if (is_user_logged_in()  && $args->menu == "menu-principal-responsive" ) {
        // Ajouter un lien "Admin" qui pointe vers le tableau de bord WordPress
        $items .= '<li class="menu-item"><a href="' . admin_url() . '">Admin</a></li>';
    }
    return $items;
}
// Ajouter la fonction au menu principal
add_filter('wp_nav_menu_items', 'ajouter_lien_admin_menu', 10, 2);
