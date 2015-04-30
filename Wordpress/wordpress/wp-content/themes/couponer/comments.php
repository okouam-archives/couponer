<?php
	/**********************************************************************
	***********************************************************************
	COUPONER COMMENTS
	**********************************************************************/
	
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ( 'Please do not load this page directly. Thanks!' );
	if ( post_password_required() ) {
		return;
	}
?>
<?php if ( comments_open() ) : ?>
	<!-- comments -->
	<div class="comments col-md-12">

		<!-- blog-inner -->
		<div class="blog-inner">

			<!-- comments-title -->
			<div class="caption widget-caption comment-caption">
				<h3><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></h3>
			</div>
			<!-- .comments-title -->
			<?php if ( have_comments() ) : ?>
				<?php wp_list_comments( 'type=comment&callback=coupon_comments' ); ?>
			<?php endif; ?>
		</div>
		<!-- .blog-inner -->

	</div>
	<!-- .comments -->
	<?php
		$comment_links = paginate_comments_links( 
			array(
				'echo' => false,
				'type' => 'array'
			) 
		);
		if( !empty( $comment_links ) ):
	?>		
		<div class="blog-pagination col-md-12 blog-pagination-comments">
			<ul class="pagination">
				<?php echo  coupon_format_pagination( $comment_links ); ?>
			</ul>
		</div>
	<?php endif; ?>	
	<!-- comment-form -->
	<div class="comment-form col-md-12">
		<div class="blog-inner">
			<div class="caption widget-caption comment-caption">
				<h3><?php _e( 'Leave Comment', 'coupon' ); ?></h3>
			</div>
			<div class="comment-form-content clearfix">
				<div class="row">
				<?php 	$comments_args = array(
							'label_submit'	=>	__( 'Post comment', 'coupon' ),
							'title_reply'	=>	'',
							'fields'		=>	apply_filters( 'comment_form_default_fields', array(
													'author' => '<div class="form-group col-md-6">
																	<input type="text" class="form-control form-control-custom" id="name" placeholder="'.esc_attr__( 'Name', 'coupon' ).'" name ="author">
																</div>',
													'email'	 => '<div class="form-group col-md-6">
																	<input type="text" class="form-control form-control-custom" id="name" placeholder="'.esc_attr__( 'Email', 'coupon' ).'" name ="email">
																</div>'
													)
												),
							'comment_field'	=>	'<div class="form-group col-md-12">
													<textarea class="form-control form-control-custom" rows="8" id="comment" placeholder="'.esc_attr__( 'Comment', 'coupon' ).'" name="comment"></textarea>
												</div>',
							'cancel_reply_link' => __( 'or cancel reply', 'coupon' ),
							'comment_notes_after' => '<div class="col-md-12"><p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'coupon' ), ' <code>' . allowed_tags() . '</code>' ) . '</p></div>',
							'must_log_in' => '<div class="col-md-12"><p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'coupon' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p></div>',
							'logged_in_as' => '<div class="col-md-12"><p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'coupon' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p></div>',
							'comment_notes_before' => '<div class="col-md-12"><p class="comment-notes">' . __( 'Your email address will not be published.', 'coupon' ) .'</p></div>'
						);
						comment_form( $comments_args );
				?>
				</div>
			</div>
		</div>
	</div>
	<!-- .comment-form -->
<?php endif; ?>