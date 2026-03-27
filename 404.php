<?php get_header(); ?>

<section class="home-section" style="text-align:center;padding:8rem 0;">
    <div class="container">
        <p style="font-family:var(--font-accent);font-size:6rem;color:var(--color-blush);line-height:1;margin-bottom:1rem;">404</p>
        <span class="section-label"><?php esc_html_e( 'Page Not Found', 'parchhatti' ); ?></span>
        <h1 style="font-style:italic;margin-bottom:1.5rem;"><?php esc_html_e( 'Oh Darling, This Page Is Gone', 'parchhatti' ); ?></h1>
        <p style="color:var(--color-muted);max-width:480px;margin:0 auto 2.5rem;">
            <?php esc_html_e( "The page you're looking for has moved, or never existed. Let's find something beautiful for you instead.", 'parchhatti' ); ?>
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary"><?php esc_html_e( 'Back to Homepage', 'parchhatti' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/category/beauty' ) ); ?>" class="btn btn--outline"><?php esc_html_e( 'Browse Beauty', 'parchhatti' ); ?></a>
        </div>

        <div style="margin-top:4rem;">
            <?php get_search_form(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
