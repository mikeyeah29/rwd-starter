<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
// Ensure the `wp_body_open` hook is available for themes with WordPress 5.2 or later.
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
?>

<header class="d-flex align-items-center">

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-content-center">

            <a href="/" class="site-logo">
                <?php bloginfo('name'); ?>
            </a>

            <nav class="main-nav d-flex justify-content-end align-items-end align-items-md-center" aria-label="Primary Menu">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'primary-menu',
                        'container'      => false,
                    ) );
                ?>
            </nav>

            <!-- Mobile Menu -->
            <div class="d-md-none">

                <div class="burger">
                    <span></span>
                    <span></span>
                </div>

            </div>

        </div>

    </div>

</header>

