<?php get_header(); ?>

<main class="site-main">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <h1><?php bloginfo( 'name' ); ?> - Latest Posts</h1>
            
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p class="meta">Posted on <?php the_date(); ?> by <?php the_author(); ?></p>
                    <div class="excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>

            <?php the_posts_pagination(); ?>

        <?php else : ?>
            <h2>No posts found</h2>
            <p>It looks like there are no posts yet. Check back soon!</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
