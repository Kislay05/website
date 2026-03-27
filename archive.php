<?php get_header(); ?>

<div class="page-banner">
    <div class="container">
        <?php if ( is_category() ) : ?>
            <span class="section-label"><?php esc_html_e( 'Category', 'parchhatti' ); ?></span>
            <h1><?php single_cat_title(); ?></h1>
            <?php if ( category_description() ) : ?>
                <p style="max-width:600px;margin:1rem auto 0;color:var(--color-muted);"><?php echo wp_kses_post( category_description() ); ?></p>
            <?php endif; ?>

        <?php elseif ( is_tag() ) : ?>
            <span class="section-label"><?php esc_html_e( 'Tag', 'parchhatti' ); ?></span>
            <h1><?php single_tag_title(); ?></h1>

        <?php elseif ( is_author() ) : ?>
            <span class="section-label"><?php esc_html_e( 'Author', 'parchhatti' ); ?></span>
            <h1><?php the_author(); ?></h1>

        <?php elseif ( is_date() ) : ?>
            <span class="section-label"><?php esc_html_e( 'Archive', 'parchhatti' ); ?></span>
            <h1><?php echo esc_html( get_the_date( 'F Y' ) ); ?></h1>

        <?php else : ?>
            <h1><?php esc_html_e( 'Archives', 'parchhatti' ); ?></h1>
        <?php endif; ?>
    </div>
</div>

<section class="home-section">
    <div class="container">

        <?php if ( have_posts() ) : ?>
            <div class="grid-3">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php parchhatti_article_card( get_the_ID() ); ?>
                <?php endwhile; ?>
            </div>
            <?php parchhatti_pagination(); ?>
        <?php else : ?>
            <p style="text-align:center;padding:4rem 0;color:var(--color-muted);">
                <?php esc_html_e( 'No posts found. Try browsing a different category.', 'parchhatti' ); ?>
            </p>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
