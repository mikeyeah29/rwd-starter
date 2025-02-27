<?php

class RWD_GutenbergSetup {

    /**
     * Blocks to wrap in a container.
     *
     * @var array
     */
    private $blocks_to_wrap = [
        'core/columns'
        // 'core/image'
    ];

    /**
     * Constructor to hook into WordPress.
     */
    public function __construct() {
        add_action('after_setup_theme', [$this, 'register_colors']);
        add_filter('render_block', [$this, 'wrap_block_with_container'], 10, 2);
    }

    /**
     * Register custom colors for Gutenberg.
     */
    public function register_colors() {
        add_theme_support('editor-color-palette', array(
            array(
                'name'  => __('Peach', 'mytheme'),
                'slug'  => 'peach',
                'color' => '#F9EFEB',
            ),
            array(
                'name'  => __('Peach Dark', 'mytheme'),
                'slug'  => 'peach-dark',
                'color' => '#F3E1D8',
            ),
            array(
                'name'  => __('Dark', 'mytheme'),
                'slug'  => 'dark',
                'color' => '#2B2A35',
            ),
            array(
                'name'  => __('Red', 'mytheme'),
                'slug'  => 'red',
                'color' => '#FE1F0F',
            ),
            array(
                'name'  => __('White', 'mytheme'),
                'slug'  => 'white',
                'color' => '#FFF',
            ),
            array(
                'name'  => __('Black', 'mytheme'),
                'slug'  => 'black',
                'color' => '#000',
            ),
        ));

        // Optional: Disable default WordPress colors
        add_theme_support('disable-custom-colors');
    }

    public function wrap_block_with_container($block_content, $block) {

        if (!isset($block['blockName']) || !$block['blockName']) {
            return $block_content;
        }

        // Check if the block is in the list
        if (in_array($block['blockName'], $this->blocks_to_wrap, true)) {
            return '<div class="container-fluid">' . $block_content . '</div>';
        }

        return $block_content;
    }
}
