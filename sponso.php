<?php

class SponsoMetaBox {

    const META_KEY_SPONSO = 'montheme_sponso';
    const NONCE = '_montheme_sponso_nonce';

    public static function register () {
        add_action('add_meta_boxes', [self::class, 'add'], 10, 2); 
        add_action('save_post', [self::class, 'save']); // Event l'utilisateur enregistre un post
    }

    public static function add ($postType, $post) {
        if ($postType === 'post' && current_user_can('publish_posts', $post)) { // Si l'utilisateur peut publier son post
            add_meta_box(self::META_KEY_SPONSO, 'Sponsoring', [self::class, 'render'], 'post', 'side'); // On ajoute alors une meta box, puis on lance la méthode render
        }
    }

    public static function render ($post) {
        $value = get_post_meta($post->ID, self::META_KEY_SPONSO, true); // On récupère la metadata ajoutée par add_meta_box
        wp_nonce_field(self::NONCE, self::NONCE);
        ?>
<!-- Rendu de la checkbox avec un name récuperé dans la constante META_KEY_SPONSO -->
        <input type="hidden" value="0" name="<?= self::META_KEY_SPONSO ?>">
        <input type="checkbox" value="1" name="<?= self::META_KEY_SPONSO ?>" <?php checked($value, '1') ?>>
        <label for="monthemesponso">Cet article est sponsorisé ?</label>
        <?php
    }

    public static function save ($post) {
        if (
            array_key_exists(self::META_KEY_SPONSO, $_POST) && // La variable globale _POST contient un index META_KEY_SPONSO ?
            current_user_can('publish_posts', $post) && // L'utilisateur peut publier un psot ?
            wp_verify_nonce($_POST[self::NONCE], self::NONCE)
            ) {
                // Gestion des cas de input coché ou non, update ou delete
            if ($_POST[self::META_KEY_SPONSO] === '0') {
                delete_post_meta($post, self::META_KEY_SPONSO);
            } else {
                update_post_meta($post, self::META_KEY_SPONSO, 1);
            }
        }
    }
}