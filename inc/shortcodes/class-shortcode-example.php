<?php

class RWD_Shortcode_Example {

    public function __construct() {
        add_shortcode('rwd_example', [$this, 'render_example']);
    }

    /**
     * Render the testimonial slider shortcode.
     *
     * @param array $atts Shortcode attributes.
     * @return string Slider HTML output.
     */
    public function render_slider($atts) {
        // Parse shortcode attributes
        $atts = shortcode_atts(array(
            'posts_per_page' => 5, // Default number of testimonials to display
            'invert' => false
        ), $atts);

        // Query testimonials
        $query = new WP_Query(array(
            'post_type'      => 'testimonial',
            'posts_per_page' => $atts['posts_per_page'],
        ));

        // Generate unique ID for multiple instances
        $slider_id = 'testimonial-slider-' . wp_generate_uuid4();

        // Prepare arguments for the template part
        $args = [
            'query'     => $query,
            'slider_id' => $slider_id,
            'invert' => $atts['invert']
        ];

        // Capture the output of the template part
        ob_start();
        get_template_part('template-parts/testimonial-slider', null, $args);
        wp_reset_postdata(); // Reset query after template part
        return ob_get_clean();
    }
}
