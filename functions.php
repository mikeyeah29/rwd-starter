<?php

if ( ! defined( 'THEME_NAMESPACE' ) ) {
	define( 'THEME_NAMESPACE', 'rwd-starter' );
}

// use RWDTheme\Blocks\Example_Block;

/* Theme Setup
=============================================*/
require_once get_stylesheet_directory() . '/inc/class-gutenberg-setup.php';
require_once get_stylesheet_directory() . '/inc/class-scripts.php';
require_once get_stylesheet_directory() . '/inc/class-menus.php';
require_once get_stylesheet_directory() . '/inc/class-custom-post-types.php';
require_once get_stylesheet_directory() . '/inc/class-blocks.php';

add_action('after_setup_theme', function() {

    new RWD_GutenbergSetup();
    new RWD_Scripts();
    new RWD_Menus();
    new RWD_Custom_Post_Types();
    new RWD_Blocks();

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

});

/* Shortcodes
=============================================*/
// require_once get_stylesheet_directory() . '/inc/shortcodes/class-shortcode-example.php';

add_action('init', function() {
   // new RWD_Shortcode_Example();
});

/* Blocks
=============================================*/

foreach (glob(get_template_directory() . '/inc/blocks/*.php') as $file) {
    require_once $file;
}

add_action('wp_footer', function() {
    if (is_user_logged_in() && current_user_can('manage_options')) { // Restrict to logged-in admins
        global $template;
        echo '<div style="position: fixed; bottom: 0; left: 0; background: rgba(0,0,0,0.7); color: #fff; padding: 5px 10px; font-size: 12px; z-index: 9999;">';
        echo 'Template: ' . basename($template);
        echo '</div>';
    }
});

?>
