<?php

function load_assets_custom(){
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_script( 'tailscript', 'https://cdn.tailwindcss.com' );
}
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action( 'wp_enqueue_scripts', 'load_assets_custom' );

add_action('get_header', 'remove_admin_login_header');