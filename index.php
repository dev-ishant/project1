<?php get_header(); ?>

<main id="main-content">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php if ( is_singular() ) : ?>
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    <?php else : ?>
                        <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                    <?php endif; ?>
                </header>

                <div class="entry-content">
                    <?php
                    if ( is_singular() ) {
                        the_content();
                    } else {
                        the_excerpt();
                    }
                    ?>
                </div>
            </article>
            <?php
        endwhile;
    else :
        echo '<p>No content found</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
