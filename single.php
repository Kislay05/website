<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <!-- ── POST HEADER ──────────────────────────────────────────────── -->
    <div class="post-header">
        <div class="container">
            <span class="section-label">
                <?php echo esc_html( parchhatti_get_primary_category() ); ?>
            </span>
            <h1><?php the_title(); ?></h1>
            <div class="post-meta">
                <span>
                    <?php esc_html_e( 'By', 'parchhatti' ); ?>
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                        <?php the_author(); ?>
                    </a>
                </span>
                <span><?php echo esc_html( get_the_date() ); ?></span>
                <span><?php echo esc_html( parchhatti_reading_time() ); ?></span>
                <?php if ( comments_open() ) : ?>
                    <span>
                        <a href="#comments">
                            <?php comments_number( esc_html__( 'No Comments', 'parchhatti' ), esc_html__( '1 Comment', 'parchhatti' ), esc_html__( '% Comments', 'parchhatti' ) ); ?>
                        </a>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ── FEATURED IMAGE ───────────────────────────────────────────── -->
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-featured-image">
        <?php the_post_thumbnail( 'parchhatti-wide' ); ?>
    </div>
    <?php endif; ?>

    <!-- ── POST CONTENT + SIDEBAR ───────────────────────────────────── -->
    <div class="container" style="display:grid;grid-template-columns:1fr 300px;gap:4rem;padding-top:4rem;padding-bottom:4rem;align-items:start;">

        <main id="primary" class="site-main">
            <div class="post-content">
                <?php the_content(); ?>
                <?php
                wp_link_pages( [
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'parchhatti' ),
                    'after'  => '</div>',
                ] );
                ?>
            </div>

            <!-- Tags -->
            <?php if ( has_tag() ) : ?>
            <div style="max-width:740px;margin:0 auto 2rem;padding:0 2rem;">
                <div style="display:flex;flex-wrap:wrap;gap:0.5rem;padding-top:1.5rem;border-top:1px solid var(--color-border);">
                    <span style="font-family:var(--font-accent);font-size:0.6rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--color-muted);align-self:center;">Tags:</span>
                    <?php
                    $tags = get_the_tags();
                    if ( $tags ) :
                        foreach ( $tags as $tag ) :
                    ?>
                        <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                           style="display:inline-block;padding:0.35rem 0.9rem;border:1px solid var(--color-border);font-family:var(--font-accent);font-size:0.6rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--color-muted);transition:var(--transition);"
                           onmouseover="this.style.background='var(--color-charcoal)';this.style.color='var(--color-gold-light)';this.style.borderColor='var(--color-charcoal)';"
                           onmouseout="this.style.background='';this.style.color='var(--color-muted)';this.style.borderColor='var(--color-border)';">
                            <?php echo esc_html( $tag->name ); ?>
                        </a>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Author Bio -->
            <div style="max-width:740px;margin:2rem auto;padding:2rem;background:var(--color-blush-light);display:flex;gap:1.5rem;align-items:flex-start;">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 72, '', '', [ 'style' => 'border-radius:50%;flex-shrink:0;' ] ); ?>
                <div>
                    <p style="font-family:var(--font-accent);font-size:0.6rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--color-gold);margin-bottom:0.4rem;"><?php esc_html_e( 'Written by', 'parchhatti' ); ?></p>
                    <h4 style="font-family:var(--font-display);font-size:1.1rem;margin-bottom:0.5rem;"><?php the_author(); ?></h4>
                    <p style="font-size:0.875rem;color:var(--color-muted);margin:0;"><?php echo esc_html( get_the_author_meta( 'description' ) ?: __( 'Contributing editor at Parchhatti. Passionate about beauty, style and the stories behind them.', 'parchhatti' ) ); ?></p>
                </div>
            </div>

            <!-- Related Posts -->
            <?php
            $related = new WP_Query( [
                'posts_per_page'      => 3,
                'category_name'       => parchhatti_get_primary_category(),
                'post__not_in'        => [ get_the_ID() ],
                'post_status'         => 'publish',
                'meta_key'            => '_thumbnail_id',
                'ignore_sticky_posts' => true,
            ] );
            if ( $related->have_posts() ) :
            ?>
            <section style="max-width:740px;margin:3rem auto 0;padding:0 2rem;">
                <div class="section-header"><h2><?php esc_html_e( 'You May Also Like', 'parchhatti' ); ?></h2></div>
                <div class="grid-3">
                    <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                        <?php parchhatti_article_card( get_the_ID() ); ?>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </section>
            <?php endif; ?>

            <?php comments_template(); ?>
        </main>

        <!-- Sidebar -->
        <aside class="widget-area" style="position:sticky;top:100px;">
            <?php if ( is_active_sidebar( 'sidebar-main' ) ) : ?>
                <?php dynamic_sidebar( 'sidebar-main' ); ?>
            <?php else : ?>
                <!-- Default sidebar content -->
                <div class="widget">
                    <h3 class="widget-title"><?php esc_html_e( 'Popular Posts', 'parchhatti' ); ?></h3>
                    <?php
                    $popular = new WP_Query( [
                        'posts_per_page' => 5,
                        'post_status'    => 'publish',
                        'orderby'        => 'comment_count',
                    ] );
                    if ( $popular->have_posts() ) :
                        while ( $popular->have_posts() ) : $popular->the_post(); ?>
                            <div style="display:flex;gap:0.75rem;margin-bottom:1rem;padding-bottom:1rem;border-bottom:1px solid var(--color-border);">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>" style="flex-shrink:0;">
                                        <?php the_post_thumbnail( 'parchhatti-thumb', [ 'style' => 'width:60px;height:60px;object-fit:cover;' ] ); ?>
                                    </a>
                                <?php endif; ?>
                                <div>
                                    <a href="<?php the_permalink(); ?>" style="font-family:var(--font-display);font-size:0.9rem;line-height:1.3;"><?php the_title(); ?></a>
                                    <p style="font-size:0.7rem;color:var(--color-muted);margin:0.25rem 0 0;font-family:var(--font-accent);letter-spacing:0.1em;"><?php echo esc_html( get_the_date() ); ?></p>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    endif; ?>
                </div>

                <div class="widget">
                    <h3 class="widget-title"><?php esc_html_e( 'Categories', 'parchhatti' ); ?></h3>
                    <?php
                    wp_list_categories( [
                        'title_li'   => '',
                        'show_count' => true,
                        'style'      => 'none',
                        'walker'     => null,
                    ] );
                    ?>
                </div>

                <div class="widget" style="background:var(--color-blush-light);padding:1.5rem;text-align:center;">
                    <span class="section-label"><?php esc_html_e( 'Newsletter', 'parchhatti' ); ?></span>
                    <p style="font-size:0.875rem;color:var(--color-muted);"><?php esc_html_e( 'Get the Parchhatti Edit delivered weekly.', 'parchhatti' ); ?></p>
                    <a href="#newsletter" class="btn btn--primary" style="margin-top:0.75rem;"><?php esc_html_e( 'Subscribe', 'parchhatti' ); ?></a>
                </div>
            <?php endif; ?>
        </aside>

    </div><!-- /.container -->

<?php endwhile; ?>

<?php get_footer(); ?>
