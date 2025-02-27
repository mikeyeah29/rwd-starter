<?php
/**
 * The template for displaying all single posts.
 *
 * @package YourTheme
 */

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div class="container">

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Post Content -->
            <div class="post-content">
                <?php the_content(); ?>
            </div>

        </article>

    </div>

<?php endwhile; else : ?>
    <p>No content found.</p>
<?php endif; ?>

<?php get_footer(); ?>
