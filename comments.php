<?php if ( post_password_required() ) return; ?>

<div id="comments" class="comments-area">
	
	<!-- no comments -->
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments">
			<?php _e( 'Comments are closed.', 'quickly' ); ?>
		</p>
	<?php endif; ?>
	<!-- comment form -->
	<?php 
		// fields for author, email and website
		$fields = array(
			'author' => 
				'<div class="form-group">' . 
					'<label class="sr-only" for="author">' . __( 'Name', 'quickly' ) . '</label> ' .
					'<input id="author" name="author" type="text" class="form-control" placeholder="Name'.( $req ? '*' : "" ).'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . '>' .
				'</div>' ,
			'email' =>
				'<div class="form-group">' . 
					'<label class="sr-only" for="Email">' . __( 'Email', 'quickly' ) . '</label> ' .
					'<input id="email" name="email" type="email" class="form-control" placeholder="Email'.( $req ? '*' : "" ).'" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . '>' .
				'</div>',
			'url' => ""
		);
		
		comment_form( array(
			'fields' => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field' => '<div class="form-group"><textarea id="comment" name="comment" cols="65" rows="8" aria-required="true" class="form-control" placeholder="' . __( 'Write your message', 'quickly' ) . '"></textarea></div>',
		) ); 
	?>

	<!-- list comments -->
	<?php if ( have_comments() ) : ?>
		<ul class="comment-list">
			<?php wp_list_comments( 'type=comment&callback=quickly_list_comments&max_depth=2' ); ?>
		</ul>
		
		<!-- comment pagination -->
		<?php paginate_comments_links(); ?>
	<?php endif; ?>
	
</div>