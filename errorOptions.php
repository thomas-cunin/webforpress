<?php

class errorOptions {

    private const GROUP = 'error_options';

    public static function register () {
        add_action('admin_menu', [self::class, 'addMenu']); //Dès qu'on affiche le menu admin
        add_action('admin_init', [self::class, 'registerSettings']); // Dès qu'on init init le script lié à l'administration
        add_action('admin_enqueue_scripts', [self::class, 'registerScripts']); // Dès qu'on charge les scripts de l'administration
    }

    public static function registerScripts ($suffix) {
        if (1 ==  1) {
            wp_register_style('text-editor', 'https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css', [], false);
            wp_register_script('text-editor', 'https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js', [], false, true);
            wp_enqueue_script('montheme_admin', get_template_directory_uri() . '/text-editor.js', ['text-editor'], false, true);
            wp_enqueue_style('text-editor');
        }
    }

    public static function registerSettings () {
        register_setting(self::GROUP, 'error_text'); // On ajoute une option pour le groupe 'agence_option'
        add_settings_section('error_options_section', 'Paramètres', function () { //Ajoute une section dans le gorupe
            echo "Vous pouvez ici gérer le text de la page 404";
        }, self::GROUP);
        add_settings_field('error_text_textarea', "Texte d'avertissement", function () {
             //Ajoute un field
            ?>
            <textarea id="text-editor" name="error_text" cols="30" rows="10" style="width: 1000px!important"><?= esc_html(get_option('error_text')) ?></textarea>
            <?php
        }, self::GROUP, 'error_options_section');

    }

    public static function addMenu () {
        add_options_page("Gestion de la page d'erreur", "Page 404", "manage_options", self::GROUP, [self::class, 'render']); //Ajoute une page dans le sous-menu option
    }

    public static function render () {
        ?>
        <!-- Rendering -->
        <h1>Gestion de la page erreur</h1>

        <form action="options.php" method="post">
            <?php 
            settings_fields(self::GROUP);
            do_settings_sections(self::GROUP);
            submit_button();
            ?>
        </form>
        <?php 
    }
    
}