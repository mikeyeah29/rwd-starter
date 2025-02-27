<?php

/**
 * Generate a new block.
 *
 * Usage: Run `php scripts/generate-block.php BlockName` in the terminal.
 */

// Get block name from the command line argument
if ($argc !== 2) {
    echo "Usage: php scripts/generate-block.php BlockName\n";
    exit(1);
}

$block_name = $argv[1];
$snake_case_block_name = strtolower(preg_replace('/([a-z])([A-Z])/', '$1-$2', $block_name)); // Convert CamelCase to snake-case
$namespace = 'TGNTheme\\Blocks';

// Define paths relative to the theme root
$theme_root = dirname(__DIR__);
$src_folder = $theme_root . "/src/blocks/$snake_case_block_name";
$php_folder = $theme_root . "/inc/blocks";
$template_folder = $theme_root . "/template-parts/blocks";
$sass_folder = $theme_root . "/assets/sass/blocks";

// Create folder structure
@mkdir($src_folder, 0755, true);
@mkdir($php_folder, 0755, true);
@mkdir($template_folder, 0755, true);
@mkdir($sass_folder, 0755, true);

// Generate JavaScript file
$index_js_content = <<<JS
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

registerBlockType('cherry/{$snake_case_block_name}', {
    title: '{$block_name}',
    icon: 'block-default',
    category: 'widgets',
    attributes: {},
    edit() {
        const blockProps = useBlockProps();

        return (
            <div {...blockProps}>
                <p>{$block_name} Block – Editor Content</p>
            </div>
        );
    },
    save() {
        return <div>{$block_name} Block – Frontend Content</div>;
    },
});
JS;

file_put_contents("$src_folder/index.js", $index_js_content);

// Generate PHP class
$php_class_content = <<<PHP
<?php

namespace {$namespace};

class {$block_name}_Block {

    public function __construct() {
        add_action('init', [\$this, 'register_block']);
    }

    public function register_block() {
        register_block_type('cherry/{$snake_case_block_name}', [
            'render_callback' => [\$this, 'render_block'],
        ]);
    }

    private function get_attributes() {
        return [
            // attributes
        ];
    }

    public function render_block(\$attributes) {
        ob_start();
        get_template_part('template-parts/blocks/{$snake_case_block_name}', null, ['attributes' => \$attributes]);
        return ob_get_clean();
    }
}

// Initialize the block
new {$block_name}_Block();
PHP;

file_put_contents("$php_folder/class-{$snake_case_block_name}.php", $php_class_content);

// Generate Template Part
$template_content = <<<HTML
<?php
/**
 * Template part for {$block_name} block.
 *
 * @var array \$args
 */
?>
<div class="{$snake_case_block_name}-block">
    <p>This is the {$block_name} block.</p>
</div>
HTML;

file_put_contents("$template_folder/{$snake_case_block_name}.php", $template_content);

// Generate SASS file
$sass_content = <<<SCSS
// Styles for {$block_name} block
.{$snake_case_block_name}-block {
    // Add your styles here
}
SCSS;

file_put_contents("$sass_folder/_{$snake_case_block_name}.scss", $sass_content);

// Output success message
echo "Block '{$block_name}' created successfully:\n";
echo "  - JavaScript: src/blocks/{$snake_case_block_name}/index.js\n";
echo "  - PHP Class: inc/blocks/class-{$snake_case_block_name}.php\n";
echo "  - Template Part: template-parts/blocks/{$snake_case_block_name}.php\n";
echo "  - SASS File: assets/sass/blocks/_{$snake_case_block_name}.scss\n";
