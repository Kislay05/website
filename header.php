<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site-wrapper">

    <!-- ── TOP BAR ──────────────────────────────────────────────────── -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar__inner">
                <span><?php echo esc_html( date_i18n( 'l, F j, Y' ) ); ?></span>

                <?php if ( has_nav_menu( 'topbar' ) ) : ?>
                    <?php wp_nav_menu( [
                        'theme_location' => 'topbar',
                        'container'      => false,
                        'menu_class'     => 'top-bar-menu',
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ] ); ?>
                <?php else : ?>
                    <nav>
                        <ul style="display:flex;gap:1.5rem;list-style:none;">
                            <li><a href="<?php echo esc_url( home_url( '/subscribe' ) ); ?>"><?php esc_html_e( 'Subscribe', 'parchhatti' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/advertise' ) ); ?>"><?php esc_html_e( 'Advertise', 'parchhatti' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'parchhatti' ); ?></a></li>
                        </ul>
                    </nav>
                <?php endif; ?>

                <div style="display:flex;gap:1rem;align-items:center;">
                    <?php foreach ( [ 'instagram', 'facebook', 'pinterest' ] as $soc ) :
                        $url = get_theme_mod( 'parchhatti_social_' . $soc, '' );
                        if ( $url ) : ?>
                            <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener">
                                <?php echo esc_html( ucfirst( $soc ) ); ?>
                            </a>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div><!-- /.top-bar -->

    <!-- ── SITE HEADER ──────────────────────────────────────────────── -->
    <header id="masthead" class="site-header">
        <div class="container">
            <div class="site-header__inner">

                <!-- Left Nav -->
                <nav class="site-nav" id="site-navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'parchhatti' ); ?>">
                    <?php wp_nav_menu( [
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => '',
                        'depth'          => 2,
                        'fallback_cb'    => 'parchhatti_fallback_menu',
                    ] ); ?>
                </nav>

                <!-- Logo -->
                <div class="site-logo">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <span class="logo-text"><?php bloginfo( 'name' ); ?></span>
                            <span class="logo-tagline"><?php echo esc_html( get_theme_mod( 'parchhatti_logo_tagline', 'Beauty · Fashion · Lifestyle' ) ); ?></span>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Right Icons -->
                <div class="header-icons">
                    <a href="<?php echo esc_url( home_url( '/?s=' ) ); ?>" class="header-icon" aria-label="<?php esc_attr_e( 'Search', 'parchhatti' ); ?>">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    </a>
                    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header-icon" aria-label="<?php esc_attr_e( 'Cart', 'parchhatti' ); ?>">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        </a>
                    <?php endif; ?>
                    <button class="menu-toggle" id="menu-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'parchhatti' ); ?>">
                        <span></span><span></span><span></span>
                    </button>
                </div>

            </div>
        </div>
    </header><!-- /#masthead -->

    <!-- ── NEWS TICKER ──────────────────────────────────────────────── -->
    <?php $ticker_text = get_theme_mod( 'parchhatti_ticker', 'New Arrivals · Spring Beauty Trends · Celebrity Style Guide · Must-Have Bags of the Season · Self-Care Sunday Rituals' ); ?>
    <?php if ( $ticker_text ) : ?>
    <div class="news-ticker" aria-hidden="true">
        <div class="container">
            <div class="ticker-inner">
                <span class="ticker-label"><?php esc_html_e( 'Trending', 'parchhatti' ); ?></span>
                <div class="ticker-track" id="ticker-track">
                    <?php for ( $i = 0; $i < 3; $i++ ) : ?>
                        <?php foreach ( explode( '·', $ticker_text ) as $item ) : ?>
                            <span><?php echo esc_html( trim( $item ) ); ?></span>
                        <?php endforeach; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ── PAGE CONTENT ──────────────────────────────────────────────── -->
    <div id="content" class="site-content">
<?php

// Fallback menu if none assigned
function parchhatti_fallback_menu() {
    echo '<ul>';
    echo '<li><a href="' . esc_url( home_url( '/category/beauty' ) ) . '">' . esc_html__( 'Beauty', 'parchhatti' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/category/fashion' ) ) . '">' . esc_html__( 'Fashion', 'parchhatti' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/category/celebrity' ) ) . '">' . esc_html__( 'Celebrity', 'parchhatti' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/category/lifestyle' ) ) . '">' . esc_html__( 'Lifestyle', 'parchhatti' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/category/travel' ) ) . '">' . esc_html__( 'Travel', 'parchhatti' ) . '</a></li>';
    echo '</ul>';
}
