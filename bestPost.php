<?php


class BestPostMetaBox{

    const META_KEY_BEST_POST = 'best_post';
    const NONCE_BF = '_best_post_NONCE_BF';
    public static function register(){
        add_action('add_meta_boxes', [self::class, 'add'], 10, 2); 
        add_action('save_post', [self::class, 'save']); // Event l'utilisateur enregistre un post
    }
    public static function add($postType, $post){
        if ($postType === 'post' && current_user_can('publish_posts', $post)) { // Si l'utilisateur peut publier son post
            add_meta_box(self::META_KEY_BEST_POST, 'Article à la une', [self::class, 'render'], 'post', 'side'); // On ajoute alors une meta box, puis on lance la méthode render
        }
    }
    public static function render ($post) {
        $value = get_post_meta($post->ID, self::META_KEY_BEST_POST, true); // On récupère la metadata ajoutée par add_meta_box
        wp_NONCE_field(self::NONCE_BF, self::NONCE_BF);
        ?>
<!-- Rendu de la checkbox avec un name récuperé dans la constante META_KEY_BEST_POST -->
        <input type="hidden" value="0" name="<?= self::META_KEY_BEST_POST ?>">
        <input type="checkbox" value="1" name="<?= self::META_KEY_BEST_POST ?>" <?php checked($value, '1') ?>>
        <label for="monthemesponso">Cet article est à mettre à la une ?</label>
        <?php
    }

    public static function save ($post) {
        if (
            array_key_exists(self::META_KEY_BEST_POST, $_POST) && // La variable globale _POST contient un index META_KEY_BEST_POST ?
            current_user_can('publish_posts', $post) && // L'utilisateur peut publier un psot ?
            wp_verify_NONCE($_POST[self::NONCE_BF], self::NONCE_BF)
            ) {
                // Gestion des cas de input coché ou non, update ou delete
            if ($_POST[self::META_KEY_BEST_POST] === '0') {
                delete_post_meta($post, self::META_KEY_BEST_POST);
            } else {
                update_post_meta($post, self::META_KEY_BEST_POST, 1);
            }
        }
    }
}