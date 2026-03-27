<?php
/**
 * Parchhatti Theme Functions
 *
 * @package Parchhatti
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ── Theme Constants ───────────────────────────────────────────────────────────
define( 'PARCHHATTI_VERSION', '1.0.0' );
define( 'PARCHHATTI_DIR', get_template_directory() );
define( 'PARCHHATTI_URI', get_template_directory_uri() );

// ── Theme Setup ───────────────────────────────────────────────────────────────
function parchhatti_setup() {
    load_theme_textdomain( 'parchhatti', PARCHHATTI_DIR . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ] );
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'post-formats', [ 'video', 'gallery', 'audio', 'quote', 'link' ] );

    // Image sizes
    add_image_size( 'parchhatti-hero',      1280, 720,  true );
    add_image_size( 'parchhatti-card',       640, 480,  true );
    add_image_size( 'parchhatti-card-sq',    480, 480,  true );
    add_image_size( 'parchhatti-portrait',   480, 640,  true );
    add_image_size( 'parchhatti-thumb',      200, 150,  true );
    add_image_size( 'parchhatti-wide',      1280, 500,  true );

    // Menus
    register_nav_menus( [
        'primary'  => __( 'Primary Navigation', 'parchhatti' ),
        'topbar'   => __( 'Top Bar Menu', 'parchhatti' ),
        'footer'   => __( 'Footer Menu', 'parchhatti' ),
        'social'   => __( 'Social Links Menu', 'parchhatti' ),
    ] );

    // Custom colours for Gutenberg
    add_theme_support( 'editor-color-palette', [
        [ 'name' => __( 'Blush',    'parchhatti' ), 'slug' => 'blush',    'color' => '#F2C4CE' ],
        [ 'name' => __( 'Gold',     'parchhatti' ), 'slug' => 'gold',     'color' => '#C9A84C' ],
        [ 'name' => __( 'Ivory',    'parchhatti' ), 'slug' => 'ivory',    'color' => '#FDF7F0' ],
        [ 'name' => __( 'Charcoal', 'parchhatti' ), 'slug' => 'charcoal', 'color' => '#2A2020' ],
        [ 'name' => __( 'White',    'parchhatti' ), 'slug' => 'white',    'color' => '#FFFFFF' ],
    ] );
}
add_action( 'after_setup_theme', 'parchhatti_setup' );

// ── Content Width ─────────────────────────────────────────────────────────────
function parchhatti_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'parchhatti_content_width', 1280 );
}
add_action( 'after_setup_theme', 'parchhatti_content_width', 0 );

// ── Enqueue Scripts & Styles ──────────────────────────────────────────────────
function parchhatti_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'parchhatti-fonts',
        'https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&family=Jost:wght@300;400;500&family=Marcellus&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'parchhatti-style',
        get_stylesheet_uri(),
        [ 'parchhatti-fonts' ],
        PARCHHATTI_VERSION
    );

    // Main JS
    wp_enqueue_script(
        'parchhatti-main',
        PARCHHATTI_URI . '/assets/js/main.js',
        [],
        PARCHHATTI_VERSION,
        true
    );

    // Comment reply
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'parchhatti_scripts' );

// ── Widget Areas ──────────────────────────────────────────────────────────────
function parchhatti_widgets_init() {
    $sidebars = [
        [
            'name'        => __( 'Main Sidebar', 'parchhatti' ),
            'id'          => 'sidebar-main',
            'description' => __( 'Shown on blog and single post pages.', 'parchhatti' ),
        ],
        [
            'name'        => __( 'Footer Column 1', 'parchhatti' ),
            'id'          => 'footer-1',
            'description' => __( 'First footer widget column.', 'parchhatti' ),
        ],
        [
            'name'        => __( 'Footer Column 2', 'parchhatti' ),
            'id'          => 'footer-2',
            'description' => __( 'Second footer widget column.', 'parchhatti' ),
        ],
        [
            'name'        => __( 'Footer Column 3', 'parchhatti' ),
            'id'          => 'footer-3',
            'description' => __( 'Third footer widget column.', 'parchhatti' ),
        ],
        [
            'name'        => __( 'Homepage - After Hero', 'parchhatti' ),
            'id'          => 'homepage-after-hero',
            'description' => __( 'Displayed below the hero section on the homepage.', 'parchhatti' ),
        ],
    ];

    $defaults = [
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ];

    foreach ( $sidebars as $sidebar ) {
        register_sidebar( array_merge( $defaults, $sidebar ) );
    }
}
add_action( 'widgets_init', 'parchhatti_widgets_init' );

// ── Helper: Get Post Category Label ──────────────────────────────────────────
function parchhatti_get_primary_category( $post_id = null ) {
    $categories = get_the_category( $post_id );
    if ( empty( $categories ) ) return '';
    return esc_html( $categories[0]->name );
}

// ── Helper: Reading Time ──────────────────────────────────────────────────────
function parchhatti_reading_time( $post_id = null ) {
    $content   = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( wp_strip_all_tags( $content ) );
    $minutes   = max( 1, (int) round( $word_count / 200 ) );
    return sprintf( _n( '%d min read', '%d min read', $minutes, 'parchhatti' ), $minutes );
}

// ── Helper: Pagination ────────────────────────────────────────────────────────
function parchhatti_pagination() {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if ( $pages <= 1 ) return;

    $current = max( 1, get_query_var( 'paged' ) );

    echo '<div class="pagination">';
    echo paginate_links( [
        'base'      => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
        'format'    => '?paged=%#%',
        'current'   => $current,
        'total'     => $pages,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
    ] );
    echo '</div>';
}

// ── Helper: Article Card ─────────────────────────────────────────────────────
function parchhatti_article_card( $post_id, $variant = '' ) {
    $classes = 'article-card';
    if ( $variant ) $classes .= ' article-card--' . $variant;

    $category = parchhatti_get_primary_category( $post_id );
    $reading  = parchhatti_reading_time( $post_id );

    echo '<article id="post-' . $post_id . '" class="' . esc_attr( $classes ) . '">';

    if ( has_post_thumbnail( $post_id ) ) {
        echo '<div class="article-card__image">';
        if ( is_sticky( $post_id ) ) {
            echo '<span class="article-card__badge">' . esc_html__( 'Featured', 'parchhatti' ) . '</span>';
        }
        echo '<a href="' . esc_url( get_permalink( $post_id ) ) . '">';
        echo get_the_post_thumbnail( $post_id, 'parchhatti-card' );
        echo '</a>';
        echo '</div>';
    }

    echo '<div class="article-card__body">';
    if ( $category ) {
        echo '<a class="article-card__category" href="' . esc_url( get_category_link( get_the_category( $post_id )[0]->term_id ) ) . '">' . esc_html( $category ) . '</a>';
    }
    echo '<h3 class="article-card__title"><a href="' . esc_url( get_permalink( $post_id ) ) . '">' . esc_html( get_the_title( $post_id ) ) . '</a></h3>';

    if ( $variant !== 'mini' ) {
        echo '<p class="article-card__excerpt">' . esc_html( wp_trim_words( get_the_excerpt( $post_id ), 20 ) ) . '</p>';
    }

    echo '<div class="article-card__meta">';
    echo '<span>' . esc_html( get_the_date( '', $post_id ) ) . '</span>';
    echo '<span>' . esc_html( $reading ) . '</span>';
    echo '</div>';
    echo '</div>';
    echo '</article>';
}

// ── Custom Excerpt Length ──────────────────────────────────────────────────────
function parchhatti_excerpt_length( $length ) { return 25; }
add_filter( 'excerpt_length', 'parchhatti_excerpt_length' );

function parchhatti_excerpt_more( $more ) { return '&hellip;'; }
add_filter( 'excerpt_more', 'parchhatti_excerpt_more' );

// ── Add Category to Body Class ────────────────────────────────────────────────
function parchhatti_body_classes( $classes ) {
    if ( is_singular() ) {
        $categories = get_the_category();
        if ( $categories ) {
            foreach ( $categories as $cat ) {
                $classes[] = 'cat-' . $cat->slug;
            }
        }
    }
    return $classes;
}
add_filter( 'body_class', 'parchhatti_body_classes' );

// ── Custom Login Logo ─────────────────────────────────────────────────────────
function parchhatti_login_style() {
    echo '<style>
        body.login { background: #FDF7F0; }
        .login h1 a {
            background-image: none;
            font-family: "Cinzel", serif;
            font-size: 2rem;
            letter-spacing: 0.3em;
            color: #2A2020;
            text-decoration: none;
            width: auto;
            height: auto;
            text-indent: 0;
            display: block;
            text-align: center;
        }
        .login h1 a::before { content: "PARCHHATTI"; }
        .login #loginform {
            border: 1px solid #EDD5DC;
            box-shadow: 0 4px 24px rgba(201,168,76,0.1);
        }
        .login .button-primary {
            background: #2A2020;
            border-color: #2A2020;
            font-family: "Cinzel", serif;
            letter-spacing: 0.15em;
        }
    </style>';
}
add_action( 'login_head', 'parchhatti_login_style' );

// ── Customizer Settings ───────────────────────────────────────────────────────
function parchhatti_customize_register( $wp_customize ) {
    // ── Magazine Info ──────────────────────────────────────────────────
    $wp_customize->add_section( 'parchhatti_magazine', [
        'title'    => __( 'Magazine Settings', 'parchhatti' ),
        'priority' => 30,
    ] );

    // Tagline under logo
    $wp_customize->add_setting( 'parchhatti_logo_tagline', [
        'default'           => 'Beauty · Fashion · Lifestyle',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'parchhatti_logo_tagline', [
        'label'   => __( 'Logo Tagline', 'parchhatti' ),
        'section' => 'parchhatti_magazine',
        'type'    => 'text',
    ] );

    // Ticker text
    $wp_customize->add_setting( 'parchhatti_ticker', [
        'default'           => 'New Arrivals · Spring Beauty Trends · Celebrity Style Guide · Must-Have Bags of the Season · Self-Care Sunday Rituals',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'parchhatti_ticker', [
        'label'   => __( 'News Ticker Text', 'parchhatti' ),
        'section' => 'parchhatti_magazine',
        'type'    => 'textarea',
    ] );

    // Footer copy
    $wp_customize->add_setting( 'parchhatti_footer_about', [
        'default'           => 'Parchhatti is your destination for the latest in beauty, fashion, celebrity news and lifestyle. Curated with love and a touch of gold.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'parchhatti_footer_about', [
        'label'   => __( 'Footer About Text', 'parchhatti' ),
        'section' => 'parchhatti_magazine',
        'type'    => 'textarea',
    ] );

    // Hero category slug
    $wp_customize->add_setting( 'parchhatti_hero_category', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'parchhatti_hero_category', [
        'label'       => __( 'Hero Post Category Slug', 'parchhatti' ),
        'description' => __( 'Pull the hero post from a specific category (leave blank for latest).', 'parchhatti' ),
        'section'     => 'parchhatti_magazine',
        'type'        => 'text',
    ] );

    // Social links
    foreach ( [ 'instagram', 'facebook', 'twitter', 'pinterest', 'youtube' ] as $social ) {
        $wp_customize->add_setting( 'parchhatti_social_' . $social, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ] );
        $wp_customize->add_control( 'parchhatti_social_' . $social, [
            'label'   => ucfirst( $social ) . ' URL',
            'section' => 'parchhatti_magazine',
            'type'    => 'url',
        ] );
    }
}
add_action( 'customize_register', 'parchhatti_customize_register' );
