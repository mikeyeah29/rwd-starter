<?php

// namespace RWDTheme\Blocks;

// // Exit if accessed directly.
// if (!defined('ABSPATH')) {
//     exit;
// }

// class Example_Block {

//     public function __construct() {
//         add_action('init', [$this, 'register_block']);
//     }

//     public function register_block() {
//         register_block_type('rwd/example-block', [
//             'attributes' => $this->get_attributes(),
//             'render_callback' => [$this, 'render_block'],
//         ]);
//     }

//     private function get_attributes() {
//         return [
//             'numberOfPosts' => [
//                 'type' => 'number',
//                 'default' => 5,
//             ],
//             'heading' => [
//                 'type' => 'string',
//                 'default' => 'Articles of Interest',
//             ],
//             'category' => [
//                 'type' => 'string',
//                 'default' => '',
//             ],
//             'inset' => [
//                 'type' => 'boolean',
//                 'default' => true
//             ]
//         ];
//     }

//     public function render_block($attributes) {
//         $query_args = [
//             'post_type' => 'post',
//             'posts_per_page' => $attributes['numberOfPosts'],
//         ];

//         if (!empty($attributes['category'])) {
//             $query_args['category_name'] = $attributes['category'];
//         }

//         $query = new \WP_Query($query_args);

//         ob_start();
//         get_template_part(
//             'template-parts/blocks/article-list',
//             null,
//             [
//                 'attributes' => $attributes,
//                 'query' => $query,
//             ]
//         );

//         wp_reset_postdata();
//         return ob_get_clean();
//     }
// }
