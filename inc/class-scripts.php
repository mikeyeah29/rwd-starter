<?php

class RWD_Scripts {

    /**
     * Initialize the hooks for enqueuing styles and scripts.
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
        add_action( 'enqueue_block_editor_assets', [$this, 'enqueue_block_editor_assets']);
    }

    /**
     * Enqueue styles for Slick.js and other assets.
     */
    public function enqueue_styles() {

        // Bootstrap
        wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' );

        // Enqueue Slick.js CSS
        wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
        wp_enqueue_style( 'slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css' );

        wp_enqueue_style( 'aio-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css' );
        wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css', [], time() );

        // Enqueue the compiled frontend styles
        wp_enqueue_style(
            'rwd-block-style',
            get_stylesheet_directory_uri() . '/assets/css/main.css',
            [],
            time()
        );
    }

    /**
     * Enqueue scripts for Slick.js and other assets.
     */
    public function enqueue_scripts() {
        // Enqueue Slick.js Script
        wp_enqueue_script( 'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true );
    
        wp_enqueue_script( 'rellax-js', 'https://cdnjs.cloudflare.com/ajax/libs/rellax/1.12.1/rellax.min.js', array('jquery'), '1.8.1', true );
        wp_enqueue_script( 'aio-js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array('jquery'), '1.8.1', true );

        wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
        wp_enqueue_script( 'menu-js', get_stylesheet_directory_uri() . '/assets/js/menu.js', array('jquery'), null, true);

        if (is_front_page()) {
            wp_enqueue_script( 'home-page-js', get_stylesheet_directory_uri() . '/assets/js/home-page.js', array('jquery'), '1.0', true );
        }
    }

    /**
     * Enqueue block editor assets for Gutenberg.
     */
    public function enqueue_block_editor_assets() {
        // Enqueue Bootstrap CSS for the editor
        wp_enqueue_style(
            'rwd-bootstrap-editor',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
            [],
            null
        );
        // Enqueue the compiled editor styles for Gutenberg blocks
        wp_enqueue_style(
            'rwd-block-editor-style',
            get_stylesheet_directory_uri() . '/assets/css/editor-style.css',
            [],
            filemtime(get_stylesheet_directory() . '/assets/css/editor-style.css')
        );

        // Enqueue the block JavaScript
        wp_enqueue_script(
            'rwd-blocks-js',
            get_stylesheet_directory_uri() . '/build/index.js',
            ['wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'], // Dependencies
            time(),
            true
        );
    }
}

?>
