
<?php 
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
$riven_settings = riven_check_theme_options();
?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="number-comments title-border">
			<?php echo "".number_format_i18n( get_comments_number())."<span>"." Comments"."</span>";?>
		</h3>
		<div class="scrollbar-inner scrollbar-comment">
			<ul class="commentlist">
				<?php
					wp_list_comments( 'reply_text=Reply&style=ul&short_ping=true&avatar_size=56&callback=riven_comment_body_template');
				?>
			</ul>
		</div>

		<?php riven_comment_nav(); ?>
	
	<?php endif; ?>

	<?php
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'riven' ); ?></p>
	<?php endif; ?>

	<div class="comment-form row">
		<?php 

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$comment_login='';
		if ( is_user_logged_in() ) {$comment_login="comment-field-login";}

		$comment_args = array( 
			'fields' => apply_filters( 'comment_form_default_fields', array(
			    'author' => '<div class="comment-left-field col-md-6 col-sm-12 col-xs-12"><p class="comment-form-author form-row form-row-first">' .
			                // ( $req ? '<span class="required">*</span>' : '' ) .
			         	'<input id="author" class="required" name="author" type="text" placeholder="' .esc_attr__('Your name', 'riven' ) . '" value="' .
			                esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
			     	'</p>',
			    'email'  => '<p class="comment-form-email form-row">' .
			                // ( $req ? '<span class="required">*</span>' : '' ) .
			          	'<input id="email" class="required email" name="email" type="text" placeholder="' .esc_attr__('Email Address', 'riven' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
					'</p>',
				'subject' => '<p class="comment-form-subject form-row form-row-last">' .
			                // ( $req ? '<span class="required">*</span>' : '' ) .
			         	'<input id="subject" class="subject" name="subject" type="text" placeholder="' .esc_attr__('Subject', 'riven' ) . '" size="30"' . $aria_req . ' />' .
			     	'</p></div>',		

			    'url'    => '' ) ),

			'title_reply'  => esc_html__( 'Leave your comment ','riven' ),
			'cancel_reply_link' => esc_html__('Cancel reply','riven'),
		    'comment_field' => '<div class="comment-right-field col-md-6 col-sm-12 col-xs-12'.$comment_login.' "><p class="comment-form-comment form-row form-row-wide">' .
		       		'<textarea id="comment" placeholder="' .esc_attr__('Message', 'riven' ) . '" class="required" name="comment" cols="45" rows="4" aria-required="true"></textarea>' .
		   		'</p></div>',
		   	'logged_in_as' => '',
		    'comment_notes_after' => '',
		    'comment_notes_before' => '',
		    'class_submit'         => 'btn btn-primary button submit',
		    'label_submit'		=> 'submit',
		);
		comment_form($comment_args);
	?> 
	</div>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#commentform').validate();
            $('.scrollbar-comment').scrollbar();
        })
    </script>

</div>
