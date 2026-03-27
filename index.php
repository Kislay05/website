<?php get_header(); ?>

<?php if ( is_home() && ! is_paged() ) : ?>

    <!-- ══════════════════════════════════════════════════════════
         HERO SECTION — Latest or featured post
    ══════════════════════════════════════════════════════════ -->
    <?php
    $hero_cat  = get_theme_mod( 'parchhatti_hero_category', '' );
    $hero_args = [
        'posts_per_page' => 1,
        'post_status'    => 'publish',
        'meta_key'       => '_thumbnail_id',
    ];
    if ( $hero_cat ) {
        $hero_args['category_name'] = $hero_cat;
    }
    $hero_query = new WP_Query( $hero_args );

    if ( $hero_query->have_posts() ) :
        $hero_query->the_post();
    ?>
    <section class="hero">
        <div class="container">
            <div class="hero__grid">
                <div class="hero__content fade-in-up">
                    <span class="hero__eyebrow">
                        <?php echo esc_html( parchhatti_get_primary_category() ); ?>
                        &nbsp;·&nbsp;
                        <?php echo esc_html( parchhatti_reading_time() ); ?>
                    </span>
                    <h1 class="hero__title"><?php the_title(); ?></h1>
                    <p class="hero__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn--primary">
                        <?php esc_html_e( 'Read Story', 'parchhatti' ); ?>
                        &nbsp;→
                    </a>
                </div>
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="hero__image">
                    <?php the_post_thumbnail( 'parchhatti-hero' ); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    wp_reset_postdata();
    endif; // hero
    ?>

    <!-- ══════════════════════════════════════════════════════════
         BEAUTY & FASHION SECTION
    ══════════════════════════════════════════════════════════ -->
    <section class="home-section">
        <div class="container">
            <div class="section-header">
                <h2><?php esc_html_e( 'Beauty & Fashion', 'parchhatti' ); ?></h2>
                <a href="<?php echo esc_url( home_url( '/category/beauty' ) ); ?>" class="btn btn--ghost">
                    <?php esc_html_e( 'See All', 'parchhatti' ); ?>
                </a>
            </div>

            <?php
            $beauty_query = new WP_Query( [
                'posts_per_page' => 5,
                'category_name'  => 'beauty,fashion',
                'post_status'    => 'publish',
                'meta_key'       => '_thumbnail_id',
            ] );
            ?>

            <?php if ( $beauty_query->have_posts() ) : ?>
            <div class="beauty-grid">
                <?php $idx = 0; while ( $beauty_query->have_posts() ) : $beauty_query->the_post(); ?>
                    <?php parchhatti_article_card( get_the_ID(), $idx === 0 ? 'featured' : '' ); ?>
                <?php $idx++; endwhile; wp_reset_postdata(); ?>
            </div>
            <?php else : ?>
                <p class="no-results"><?php esc_html_e( 'No beauty & fashion posts yet. Start writing!', 'parchhatti' ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════
         CELEBRITY NEWS SECTION
    ══════════════════════════════════════════════════════════ -->
    <section class="home-section home-section--tinted">
        <div class="container">
            <div class="section-header">
                <h2><?php esc_html_e( 'Celebrity News', 'parchhatti' ); ?></h2>
                <a href="<?php echo esc_url( home_url( '/category/celebrity' ) ); ?>" class="btn btn--ghost">
                    <?php esc_html_e( 'See All', 'parchhatti' ); ?>
                </a>
            </div>

            <?php
            $celeb_query = new WP_Query( [
                'posts_per_page' => 4,
                'category_name'  => 'celebrity,celeb',
                'post_status'    => 'publish',
                'meta_key'       => '_thumbnail_id',
            ] );
            ?>

            <?php if ( $celeb_query->have_posts() ) : ?>
            <div class="celeb-strip">
                <?php while ( $celeb_query->have_posts() ) : $celeb_query->the_post(); ?>
                    <?php parchhatti_article_card( get_the_ID() ); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php else : ?>
                <p class="no-results"><?php esc_html_e( 'No celebrity posts yet. Start writing!', 'parchhatti' ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════
         LIFESTYLE & TRAVEL SECTION
    ══════════════════════════════════════════════════════════ -->
    <section class="home-section">
        <div class="container">
            <div class="section-header">
                <h2><?php esc_html_e( 'Lifestyle & Travel', 'parchhatti' ); ?></h2>
                <a href="<?php echo esc_url( home_url( '/category/lifestyle' ) ); ?>" class="btn btn--ghost">
                    <?php esc_html_e( 'See All', 'parchhatti' ); ?>
                </a>
            </div>

            <?php
            $life_query = new WP_Query( [
                'posts_per_page' => 4,
                'category_name'  => 'lifestyle,travel',
                'post_status'    => 'publish',
                'meta_key'       => '_thumbnail_id',
            ] );
            ?>

            <?php if ( $life_query->have_posts() ) : ?>
            <div class="lifestyle-layout">
                <div class="lifestyle-main">
                    <?php $life_query->the_post(); ?>
                    <?php parchhatti_article_card( get_the_ID(), 'featured' ); ?>
                </div>
                <aside class="lifestyle-sidebar">
                    <?php while ( $life_query->have_posts() ) : $life_query->the_post(); ?>
                        <?php parchhatti_article_card( get_the_ID(), 'horizontal' ); ?>
                    <?php endwhile; ?>
                </aside>
            </div>
            <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="no-results"><?php esc_html_e( 'No lifestyle posts yet. Start writing!', 'parchhatti' ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════
         HOMEPAGE WIDGET AREA
    ══════════════════════════════════════════════════════════ -->
    <?php if ( is_active_sidebar( 'homepage-after-hero' ) ) : ?>
    <section class="home-section home-section--tinted">
        <div class="container">
            <?php dynamic_sidebar( 'homepage-after-hero' ); ?>
        </div>
    </section>
    <?php endif; ?>

<?php else : ?>

    <!-- ══════════════════════════════════════════════════════════
         BLOG / ARCHIVE LISTING
    ══════════════════════════════════════════════════════════ -->
    <div class="page-banner">
        <div class="container">
            <span class="section-label"><?php esc_html_e( 'Our Journal', 'parchhatti' ); ?></span>
            <h1><?php single_cat_title( '', true ) ?: bloginfo( 'name' ); ?></h1>
        </div>
    </div>

    <section class="home-section">
        <div class="container">
            <div class="grid-3">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php parchhatti_article_card( get_the_ID() ); ?>
                <?php endwhile; ?>
            </div>

            <?php parchhatti_pagination(); ?>
        </div>
    </section>

<?php endif; ?>

<?php get_footer(); ?>
