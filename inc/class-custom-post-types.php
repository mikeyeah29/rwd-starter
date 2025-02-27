<?php

class RWD_Custom_Post_Types
{
    public function __construct()
    {
        //add_action('init', array($this, 'register_service_post_type'));
    }

    public function register_service_post_type()
    {
        // $labels = array(
        //     'name'               => __('Services', 'rwd-theme'),
        //     'singular_name'      => __('Service', 'rwd-theme'),
        //     'menu_name'          => __('Services', 'rwd-theme'),
        //     'add_new'            => __('Add New', 'rwd-theme'),
        //     'add_new_item'       => __('Add New Service', 'rwd-theme'),
        //     'edit_item'          => __('Edit Service', 'rwd-theme'),
        //     'new_item'           => __('New Service', 'rwd-theme'),
        //     'view_item'          => __('View Service', 'rwd-theme'),
        //     'all_items'          => __('All Services', 'rwd-theme'),
        //     'search_items'       => __('Search Services', 'rwd-theme'),
        //     'not_found'          => __('No services found.', 'rwd-theme'),
        //     'not_found_in_trash' => __('No services found in trash.', 'rwd-theme'),
        // );

        // $args = array(
        //     'labels'             => $labels,
        //     'public'             => true,
        //     'has_archive'        => false,
        //     'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        //     'rewrite'            => array('slug' => 'services'),
        //     'show_in_rest'       => true,
        //     'menu_icon'          => 'dashicons-admin-tools',
        // );

        // register_post_type('service', $args);
    }
}

?>
