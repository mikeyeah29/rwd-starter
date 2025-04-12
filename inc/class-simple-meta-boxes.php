<?php

namespace TGNTheme;

class Simple_Meta_Boxes {

    private $post_type;
    private $meta_box_id;
    private $meta_box_title;
    private $fields;

    private static $script_enqueued = false;

    /**
     * Constructor.
     *
     * @param string $post_type      The post type this meta box applies to.
     * @param string $meta_box_title Title displayed in the editor.
     * @param array  $fields         Array of meta fields: ['key' => 'Label']
     */
    public function __construct($post_type, $meta_box_title, $fields = []) {
        $this->post_type      = $post_type;
        $this->meta_box_title = $meta_box_title;
        $this->meta_box_id    = $this->generate_id($meta_box_title);
        $this->fields         = $fields;

        add_action('add_meta_boxes', [$this, 'add_meta_box']);
        add_action('save_post', [$this, 'save_meta_box']);

        if (!self::$script_enqueued) {
            add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
            self::$script_enqueued = true;
        }
    }

    public function enqueue_scripts() {
        wp_enqueue_media();

        wp_add_inline_script('jquery-core', "
            jQuery(document).ready(function($) {
                $('.smb-upload-image').on('click', function(e) {
                    e.preventDefault();

                    const button = $(this);
                    const wrapper = button.closest('.smb-image-wrapper');
                    const input = wrapper.find('input[type=hidden]');
                    const previewImg = wrapper.find('img');

                    const customUploader = wp.media({
                        title: 'Select Image',
                        button: { text: 'Use this image' },
                        multiple: false
                    });

                    customUploader.on('select', function() {
                        const attachment = customUploader.state().get('selection').first().toJSON();
                        input.val(attachment.id);

                        if (previewImg.length) {
                            previewImg.attr('src', attachment.sizes.thumbnail.url);
                        } else {
                            $('<img>').attr('src', attachment.sizes.thumbnail.url).css({
                                maxWidth: '100%',
                                height: 'auto',
                                display: 'block',
                                marginBottom: '8px'
                            }).insertBefore(input);
                        }

                        customUploader.close();
                    });

                    customUploader.open();
                });
            });
        ");
    }

    /**
     * Generate a slug-style ID from the title.
     */
    private function generate_id($title) {
        return sanitize_title($title) . '_meta_box';
    }

    public function add_meta_box() {

        add_meta_box(
            $this->meta_box_id,
            $this->meta_box_title,
            [$this, 'render_meta_box'],
            $this->post_type,
            'side',
            'default'
        );
    }

    public function render_meta_box($post) {
        wp_nonce_field($this->meta_box_id . '_nonce', $this->meta_box_id . '_nonce_field');

        foreach ($this->fields as $key => $field) {

            $label = $field['label'] ?? $key;
            $type = $field['type'] ?? 'text';
            $value = get_post_meta($post->ID, $key, true);

            if(!is_array($field)) {
                $label = $field;
                $type = 'text';
                $value = get_post_meta($post->ID, $key, true);
            }
            
            echo '<p>';
            echo '<label for="' . esc_attr($key) . '"><strong>' . esc_html($label) . ':</strong></label><br />';

            switch ($type) {
                case 'checkbox':
                    echo '<input type="checkbox" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="1" ' . checked($value, '1', false) . ' />';
                    break;

                case 'image':
                    $image_id = intval($value);
                    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';
                    echo '<div class="smb-image-wrapper">';
                    if ($image_url) {
                        echo '<img src="' . esc_url($image_url) . '" style="max-width:100%; height:auto; display:block; margin-bottom:8px;" />';
                    }
                    echo '<input type="hidden" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($image_id) . '" />';
                    echo '<button class="button smb-upload-image" data-target="' . esc_attr($key) . '">Choose Image</button>';
                    echo '</div>';
                    break;

                default:
                    echo '<input type="text" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '" style="width:100%;" />';
            }

            echo '</p>';
        }
    }

    public function save_meta_box($post_id) {
        if (!isset($_POST[$this->meta_box_id . '_nonce_field']) ||
            !wp_verify_nonce($_POST[$this->meta_box_id . '_nonce_field'], $this->meta_box_id . '_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (wp_is_post_revision($post_id)) return;
        if (!current_user_can('edit_post', $post_id)) return;

        foreach ($this->fields as $key => $field) {
            $type = $field['type'] ?? 'text';

            if ($type === 'checkbox') {
                $value = isset($_POST[$key]) ? '1' : '0';
                update_post_meta($post_id, $key, $value);
            } else {
                if (isset($_POST[$key])) {
                    $value = sanitize_text_field($_POST[$key]);
                    update_post_meta($post_id, $key, $value);
                }
            }
        }
    }
}

