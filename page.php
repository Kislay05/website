<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <div class="page-banner">
        <div class="container">
            <span class="section-label"><?php bloginfo( 'name' ); ?></span>
            <h1><?php the_title(); ?></h1>
        </div>
    </div>

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-featured-image" style="max-height:450px;overflow:hidden;">
        <?php the_post_thumbnail( 'parchhatti-wide' ); ?>
    </div>
    <?php endif; ?>

    <section class="home-section">
        <div class="container--narrow">
            <div class="post-content">
                <?php the_content(); ?>
                <?php
                wp_link_pages( [
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'parchhatti' ),
                    'after'  => '</div>',
                ] );
                ?>
            </div>
            <?php if ( comments_open() || get_comments_number() ) : ?>
                <?php comments_template(); ?>
            <?php endif; ?>
        </div>
    </section>

<?php endwhile; ?>

<?php get_footer(); ?>
