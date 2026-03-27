    </div><!-- /#content -->

    <!-- ── NEWSLETTER ───────────────────────────────────────────────── -->
    <?php if ( ! is_page() ) : ?>
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-inner">
                <span class="section-label"><?php esc_html_e( 'Stay Connected', 'parchhatti' ); ?></span>
                <h2><?php esc_html_e( 'The Parchhatti Edit', 'parchhatti' ); ?></h2>
                <p><?php esc_html_e( 'Curated beauty finds, style inspiration and celebrity news delivered straight to your inbox — every week.', 'parchhatti' ); ?></p>

                <?php if ( function_exists( 'mc4wp_form' ) ) : ?>
                    <?php mc4wp_form(); ?>
                <?php else : ?>
                    <form class="newsletter-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post">
                        <input type="email" name="email" placeholder="<?php esc_attr_e( 'Your email address', 'parchhatti' ); ?>" required>
                        <button type="submit"><?php esc_html_e( 'Subscribe', 'parchhatti' ); ?></button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── QUOTE STRIP ──────────────────────────────────────────────── -->
    <div class="quote-strip">
        <div class="container">
            <blockquote><?php esc_html_e( 'Style is a way to say who you are without having to speak.', 'parchhatti' ); ?></blockquote>
            <cite><?php esc_html_e( 'The Parchhatti Philosophy', 'parchhatti' ); ?></cite>
        </div>
    </div>

    <!-- ── FOOTER ───────────────────────────────────────────────────── -->
    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-grid">

                <!-- Brand Column -->
                <div class="footer-brand">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <div class="site-logo">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <span class="logo-text"><?php bloginfo( 'name' ); ?></span>
                                <span class="logo-tagline"><?php echo esc_html( get_theme_mod( 'parchhatti_logo_tagline', 'Beauty · Fashion · Lifestyle' ) ); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <p><?php echo esc_html( get_theme_mod( 'parchhatti_footer_about', 'Parchhatti is your destination for the latest in beauty, fashion, celebrity news and lifestyle. Curated with love and a touch of gold.' ) ); ?></p>

                    <div class="footer-social">
                        <?php
                        $socials = [
                            'instagram' => 'IG',
                            'facebook'  => 'FB',
                            'twitter'   => 'TW',
                            'pinterest' => 'PT',
                            'youtube'   => 'YT',
                        ];
                        foreach ( $socials as $key => $label ) :
                            $url = get_theme_mod( 'parchhatti_social_' . $key, '' );
                            if ( $url ) : ?>
                                <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( ucfirst( $key ) ); ?>">
                                    <?php echo esc_html( $label ); ?>
                                </a>
                            <?php endif;
                        endforeach; ?>
                    </div>
                </div>

                <!-- Footer Widget Areas -->
                <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
                    <div class="footer-col">
                        <?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
                            <?php dynamic_sidebar( 'footer-' . $i ); ?>
                        <?php else : ?>
                            <?php
                            $defaults = [
                                1 => [
                                    'title' => __( 'Sections', 'parchhatti' ),
                                    'links' => [
                                        __( 'Beauty', 'parchhatti' )    => home_url( '/category/beauty' ),
                                        __( 'Fashion', 'parchhatti' )   => home_url( '/category/fashion' ),
                                        __( 'Celebrity', 'parchhatti' ) => home_url( '/category/celebrity' ),
                                        __( 'Lifestyle', 'parchhatti' ) => home_url( '/category/lifestyle' ),
                                        __( 'Travel', 'parchhatti' )    => home_url( '/category/travel' ),
                                    ],
                                ],
                                2 => [
                                    'title' => __( 'Company', 'parchhatti' ),
                                    'links' => [
                                        __( 'About Us', 'parchhatti' )      => home_url( '/about' ),
                                        __( 'Advertise', 'parchhatti' )     => home_url( '/advertise' ),
                                        __( 'Write For Us', 'parchhatti' )  => home_url( '/write-for-us' ),
                                        __( 'Contact', 'parchhatti' )       => home_url( '/contact' ),
                                        __( 'Careers', 'parchhatti' )       => home_url( '/careers' ),
                                    ],
                                ],
                                3 => [
                                    'title' => __( 'Legal', 'parchhatti' ),
                                    'links' => [
                                        __( 'Privacy Policy', 'parchhatti' )    => home_url( '/privacy-policy' ),
                                        __( 'Terms of Service', 'parchhatti' )  => home_url( '/terms' ),
                                        __( 'Cookie Policy', 'parchhatti' )     => home_url( '/cookies' ),
                                        __( 'Sitemap', 'parchhatti' )           => home_url( '/sitemap.xml' ),
                                    ],
                                ],
                            ];
                            $col = $defaults[ $i ];
                            ?>
                            <h4 class="widget-title"><?php echo esc_html( $col['title'] ); ?></h4>
                            <ul>
                                <?php foreach ( $col['links'] as $label => $url ) : ?>
                                    <li><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>

            </div><!-- /.footer-grid -->

            <div class="footer-bottom">
                <span>
                    &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>.
                    <?php esc_html_e( 'All rights reserved.', 'parchhatti' ); ?>
                </span>
                <span><?php esc_html_e( 'Made with ♥ for fashion lovers', 'parchhatti' ); ?></span>
            </div>

        </div>
    </footer><!-- /#colophon -->

</div><!-- /#page -->

<?php wp_footer(); ?>
</body>
</html>
