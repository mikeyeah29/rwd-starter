<?php

namespace TGNTheme;

class Settings_Page {

    private $page_slug;
    private $page_title;
    private $menu_title;
    private $capability;
    private $fields;
    private $option_name;

    public function __construct($page_slug, $page_title, $menu_title, $capability = 'manage_options', $fields = []) {
        $this->page_slug   = $page_slug;
        $this->page_title  = $page_title;
        $this->menu_title  = $menu_title;
        $this->capability  = $capability;
        $this->fields      = $fields;
        $this->option_name = $page_slug . '_options';

        add_action('admin_menu', [$this, 'register_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function register_settings_page() {
        add_options_page(
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->page_slug,
            [$this, 'render_settings_page']
        );
    }

    public function register_settings() {
        register_setting($this->option_name, $this->option_name);

        add_settings_section(
            $this->page_slug . '_section',
            '',
            '__return_false',
            $this->page_slug
        );

        foreach ($this->fields as $key => $field) {
            add_settings_field(
                $key,
                $field['label'] ?? $key,
                [$this, 'render_field'],
                $this->page_slug,
                $this->page_slug . '_section',
                ['key' => $key, 'field' => $field]
            );
        }
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html($this->page_title); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields($this->option_name);
                do_settings_sections($this->page_slug);
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function render_field($args) {
        $key    = $args['key'];
        $field  = $args['field'];
        $type   = $field['type'] ?? 'text';
        $value  = get_option($this->option_name);
        $val    = $value[$key] ?? '';

        switch ($type) {
            case 'checkbox':
                echo '<input type="checkbox" id="' . esc_attr($key) . '" name="' . esc_attr($this->option_name) . '[' . esc_attr($key) . ']" value="1" ' . checked($val, '1', false) . ' />';
                break;

            case 'image':
                $image_id = intval($val);
                $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';
                echo '<div class="smb-image-wrapper">';
                if ($image_url) {
                    echo '<img src="' . esc_url($image_url) . '" style="max-width:100%; height:auto; display:block; margin-bottom:8px;" />';
                }
                echo '<input type="hidden" id="' . esc_attr($key) . '" name="' . esc_attr($this->option_name) . '[' . esc_attr($key) . ']" value="' . esc_attr($image_id) . '" />';
                echo '<button class="button smb-upload-image" data-target="' . esc_attr($key) . '">Choose Image</button>';
                echo '</div>';
                break;
            case 'textarea':
                echo '<textarea id="' . esc_attr($key) . '" name="' . esc_attr($this->option_name) . '[' . esc_attr($key) . ']" style="width: 100%; min-height: 200px;">' . esc_textarea($val) . '</textarea>';
                break;
            default:
                echo '<input type="text" id="' . esc_attr($key) . '" name="' . esc_attr($this->option_name) . '[' . esc_attr($key) . ']" value="' . esc_attr($val) . '" style="width: 100%;" />';
        }
    }
}
