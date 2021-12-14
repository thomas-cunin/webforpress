<?php

function load_assets_custom()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('tailscript', 'https://cdn.tailwindcss.com');
}
function remove_admin_login_header()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}
function wpdocs_theme_setup()
{
    add_theme_support('post-thumbnails');
    add_image_size('post-thumb', 300, 300, true); // 300 pixels wide (and unlimited height)
    add_image_size('homepage-thumb', 220, 180, true); // (cropped)
}
function init_custom()
{
    register_taxonomy(
        'sponsor',
        'post',
        [

            'labels' =>
            [
                'name'              =>'Sponso',
                'singular_name'     => 'Sponso',
                'plural_name'       => 'Sponsos',
                'search_items'      => 'Rechercher',
                'all_items'         => 'Tous les sponsors',
                'edit_item'         => 'Editer',
                'update_item'       => 'Mettre à jour',
                'add_new_item'      => 'Ajouter un nouveau',
                'new_item_name'     => 'Ajouter un nouveau',
                'menu_name'         => 'Sponso',    
            ],
            'hierarchical'=>true,
            'show_in_rest'=>true,
            'show_admin_column'=>true,

        ]
    );

    register_post_type( 'test', [
        'label'=>'Test', //name
        'public'=>true,
        'menu_position'=>3, // 5 - 1
        'menu_icon'=>'dashicons-forms',
        // 'show_in_rest'=>true,
        'has_archive'=>true,
        'supports'=>[
            'title',
            'editor',
            'thumbnail',
        ]
    ] );
}
function themename_widgets_init() {
    register_sidebar([
        'name'          => 'Home page',
        'id'            => 'sidebar-1',
    ] );

}

add_action('init', 'init_custom'); // First

add_action('after_setup_theme', 'wpdocs_theme_setup');

add_action('widgets_init', 'themename_widgets_init');

add_action('wp_enqueue_scripts', 'load_assets_custom');

add_action('get_header', 'remove_admin_login_header');
require_once('sponso.php');
require_once('agence.php');
require_once('bestPost.php');
require_once('errorOptions.php');
SponsoMetaBox::register();
AgenceMenuPage::register();
BestPostMetaBox::register();
errorOptions::register();