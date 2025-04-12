<?php

namespace RWDStarter\PageTemplates;

class Post_Template {

    public function __construct() {
        add_action('init', [$this, 'register_template']);
    }

    public function register_template() {
        // Get the existing arguments for the 'page' post type
        $post_type_args = get_post_type_object('post');

        // Ensure the post type exists before modifying
        if (!$post_type_args) {
            return;
        }
        
        $theme_namespace = 'rwd-starter';

        // Define the default block template for pages
        $post_type_args->template = [
            [$theme_namespace . '/page-hero', [
                'preTitle' => 'PRE TITLE',
                'heading' => 'Lorum | ipsum ||| amet | consectetur',
                'backgroundImage' => 'https://placehold.co/800' // Will be set manually or use a Featured Image
            ]],
            [$theme_namespace . '/bootstrap-container', [
                'xs' => 'col-11',
                'sm' => 'col-sm-11',
                'md' => 'col-md-8',
                'lg' => 'col-lg-6',
                'xl' => 'col-xl-6'
            ], [
                ['core/paragraph', ['content' => 'Welcome to our website! We are committed to providing the best services.']],
                ['core/paragraph', ['content' => 'Our team of experts is here to help you find what you need.']],
                ['core/paragraph', ['content' => 'Feel free to explore and learn more about what we offer.']]
            ]],
            [$theme_namespace . '/bootstrap-container', [
                'xs' => 'col-12',
                'sm' => 'col-sm-12',
                'md' => 'col-md-10',
                'lg' => 'col-lg-8',
                'xl' => 'col-xl-8'
            ], [
                ['core/heading', ['level' => 2, 'content' => 'Heading</br>Ipsum', 'className' => 'hdln-1 txt-accent text-uppercase']]
            ]],
            [$theme_namespace . '/bootstrap-container', [
                'xs' => 'col-11',
                'sm' => 'col-sm-11',
                'md' => 'col-md-8',
                'lg' => 'col-lg-6',
                'xl' => 'col-xl-6'
            ], [
                ['core/paragraph', ['content' => 'Welcome to our website! We are committed to providing the best services.']],
                ['core/paragraph', ['content' => 'Our team of experts is here to help you find what you need.']],
                ['core/paragraph', ['content' => 'Feel free to explore and learn more about what we offer.']]
            ]],
        ];

        $post_type_args->template_lock = false; // Allow users to modify the template

        // Update the 'page' post type registration
        register_post_type('post', (array) $post_type_args);
    }
}   