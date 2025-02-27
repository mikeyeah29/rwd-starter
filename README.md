# Getting Started

1. Install the theme
2. Run npm install
3. Run npm run start

This will compile the sass and compile the js for Gutenberg blocks.

# Post Content

Blog posts are using the Gutenberg editor. The content is a bootstrap container.
Everything expands to full width ( with a maximum of 1920px ). Some content might need to be narrower.

If the width needs adjusting put the content with a single column block and set the CONTENT WIDTH to the maximum width.

## Patterns

1. Example Pattern - this does nothing

## Helper classes

All p tags are defaulted to 1.125rem ( 18px ). To manage font sizes within content use the following classes to add to any text block.

```css

  .txt-small     /* 18px */
  .txt-medium    /* 22px */
  .txt-large     /* 32px */
  .txt-xlarge    /* 36px */
  .txt-xxlarge   /* 80px */

```

# Shortcodes

*Example Shortcode*
[example_shortcode title="Example Title" description="Example Description"]

# scripts

## Block Generator Script

The generate-block.php script automates the creation of Gutenberg block files.

### How to Use

Open a terminal, navigate to your theme’s root directory, and run the following command:
```
php scripts/generate-block.php BlockName
```
Replace BlockName with the name of your block. Use CamelCase for the block name.
This will create the following files...

```
/src
    /blocks
        /block-name
            index.js
/inc
    /blocks
        class-block-name.php
/template-parts
    /blocks
        block-name.php
```

You'll need to then add the js to src/index.js and php class to functions.php

# Colours

Colours are defined in the following places:

1. In SASS /src/sass/base/_variables.scss

This generates classes like...

```css
.has-{color-name}-color {
  color: #FE1F0F;
}

.has-{color-name}-background-color {
  background-color: #FE1F0F;
}
```

2. In the RWD_GutenbergSetup.php file

This adds the colours to the editor.

```php
add_theme_support('editor-color-palette', array(
    array(
        'name'  => __('Peach', 'mytheme'),
        'slug'  => 'peach',
        'color' => '#F9EFEB',
    ),
));
```

This means that the colour palette can be used in sass but also in the editor.