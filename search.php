<?php get_header(); ?>

<div class="page-banner">
    <div class="container">
        <span class="section-label"><?php esc_html_e( 'Search Results', 'parchhatti' ); ?></span>
        <h1>
            <?php
            printf(
                /* translators: %s: search query */
                esc_html__( 'Results for: %s', 'parchhatti' ),
                '<em>' . esc_html( get_search_query() ) . '</em>'
            );
            ?>
        </h1>
    </div>
</div>

<section class="home-section">
    <div class="container">

        <div style="max-width:500px;margin:0 auto 3rem;">
            <?php get_search_form(); ?>
        </div>

        <?php if ( have_posts() ) : ?>
            <div class="grid-3">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php parchhatti_article_card( get_the_ID() ); ?>
                <?php endwhile; ?>
            </div>
            <?php parchhatti_pagination(); ?>
        <?php else : ?>
            <div style="text-align:center;padding:4rem 0;">
                <p style="color:var(--color-muted);margin-bottom:2rem;">
                    <?php esc_html_e( 'No posts found matching your search. Try different keywords.', 'parchhatti' ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
                    <?php esc_html_e( '← Back to Homepage', 'parchhatti' ); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
