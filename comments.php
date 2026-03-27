<?php
if ( post_password_required() ) return;
?>

<div id="comments" class="comments-area" style="max-width:740px;margin:3rem auto;padding:0 2rem;">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title" style="font-style:italic;margin-bottom:2rem;">
            <?php
            comments_number(
                esc_html__( 'No Comments', 'parchhatti' ),
                esc_html__( '1 Comment', 'parchhatti' ),
                esc_html__( '% Comments', 'parchhatti' )
            );
            ?>
        </h2>

        <ol class="comment-list" style="list-style:none;">
            <?php
            wp_list_comments( [
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size' => 48,
            ] );
            ?>
        </ol>

        <?php the_comments_pagination(); ?>

    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments" style="color:var(--color-muted);font-style:italic;">
            <?php esc_html_e( 'Comments are closed.', 'parchhatti' ); ?>
        </p>
    <?php endif; ?>

    <?php
    comment_form( [
        'title_reply'         => esc_html__( 'Leave a Comment', 'parchhatti' ),
        'title_reply_before'  => '<h3 id="reply-title" class="comment-reply-title" style="font-style:italic;margin-bottom:1.5rem;">',
        'title_reply_after'   => '</h3>',
        'class_submit'        => 'btn btn--primary',
        'comment_field'       => '<p class="comment-form-comment"><label for="comment" style="font-family:var(--font-accent);font-size:0.65rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--color-muted);display:block;margin-bottom:0.5rem;">' . esc_html__( 'Comment', 'parchhatti' ) . '</label><textarea id="comment" name="comment" rows="6" style="width:100%;padding:1rem;border:1px solid var(--color-border);font-family:var(--font-body);font-size:0.95rem;outline:none;resize:vertical;" required></textarea></p>',
    ] );
    ?>

</div>
