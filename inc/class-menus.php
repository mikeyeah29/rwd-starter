<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class RWD_Menus {

    /**
     * Constructor to hook into WordPress.
     */
    public function __construct() {
        add_action('after_setup_theme', [$this, 'register_menus']);
    }

    /**
     * Register navigation menus.
     */
    public function register_menus() {
        register_nav_menus(array(
            'primary'   => __('Primary Menu', 'rwd-theme'),
            'footer'    => __('Footer Menu', 'rwd-theme')
        ));
    }
}
