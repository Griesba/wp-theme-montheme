<?php
namespace Montheme;
/**
 * Core walker class used to create an HTML list of comments.
 *
 * @since 2.7.0
 *
 * @see Walker
 */
class CommentWalker extends \Walker_Comment {

	/**
	 * What the class handles.
	 *
	 * @since 2.7.0
	 * @var string
	 *
	 * @see Walker::$tree_type
	 */
	public $tree_type = 'comment';

	/**
	 * Database fields to use.
	 *
	 * @since 2.7.0
	 * @var array
	 *
	 * @see Walker::$db_fields
	 * @todo Decouple this
	 */
	public $db_fields = array(
		'parent' => 'comment_parent',
		'id'     => 'comment_ID',
	);

	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 2.7.0
	 *
	 * @see Walker::start_lvl()
	 * @global int $comment_depth
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param int    $depth  Optional. Depth of the current comment. Default 0.
	 * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1; // pour les page de 2eme niveau

        $output .= '<div class="ml-4">';// ajoute un marge à droite sur les reponse
	}

	/**
	 * Ends the list of items after the elements are added.
	 *
	 * @since 2.7.0
	 *
	 * @see Walker::end_lvl()
	 * @global int $comment_depth
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param int    $depth  Optional. Depth of the current comment. Default 0.
	 * @param array  $args   Optional. Will only append content if style argument value is 'ol' or 'ul'.
	 *                       Default empty array.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;

        $output .= '</div>';
	}






	/**
	 * Filters the comment text.
	 *
	 * Removes links from the pending comment's text if the commenter did not consent
	 * to the comment cookies.
	 *
	 * @since 5.4.2
	 *
	 * @param string          $comment_text Text of the current comment.
	 * @param WP_Comment|null $comment      The comment object. Null if not found.
	 * @return string Filtered text of the current comment.
	 */
	public function filter_comment_text( $comment_text, $comment ) {
		$commenter          = wp_get_current_commenter();
		$show_pending_links = ! empty( $commenter['comment_author'] );

		if ( $comment && '0' == $comment->comment_approved && ! $show_pending_links ) {
			$comment_text = wp_kses( $comment_text, array() );
		}

		return $comment_text;
	}

	/**
	 * Outputs a single comment.
	 *
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function comment( $comment, $depth, $args ) {
		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}

		$commenter          = wp_get_current_commenter();
		$show_pending_links = isset( $commenter['comment_author'] ) && $commenter['comment_author'];

		if ( $commenter['comment_author_email'] ) {
			$moderation_note = __( 'Your comment is awaiting moderation.' );
		} else {
			$moderation_note = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.' );
		}
		?>
		<<?php echo $tag; ?> <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
			<?php
			if ( 0 != $args['avatar_size'] ) {
				echo get_avatar( $comment, $args['avatar_size'] );
			}
			?>
			<?php
			$comment_author = get_comment_author_link( $comment );

			if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
				$comment_author = get_comment_author( $comment );
			}

			printf(
				/* translators: %s: Comment author link. */
				__( '%s <span class="says">says:</span>' ),
				sprintf( '<cite class="fn">%s</cite>', $comment_author )
			);
			?>
		</div>
		<?php if ( '0' == $comment->comment_approved ) : ?>
		<em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
		<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
			<?php
				/* translators: 1: Comment date, 2: Comment time. */
				printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
			?>
				</a>
				<?php
				edit_comment_link( __( '(Edit)' ), '&nbsp;&nbsp;', '' );
				?>
		</div>

		<?php
		comment_text(
			$comment,
			array_merge(
				$args,
				array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				)
			)
		);
		?>

		<?php
		comment_reply_link(
			array_merge(
				$args,
				array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				)
			)
		);
		?>

		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
		<?php
	}

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		$commenter          = wp_get_current_commenter();
		$show_pending_links = ! empty( $commenter['comment_author'] );

		if ( $commenter['comment_author_email'] ) {
			$moderation_note = __( 'Your comment is awaiting moderation.' );
		} else {
			$moderation_note = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.' );
		}
		?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta col-md-2">
					<div class="comment-author vcard">
						<?php
						if ( 0 != $args['avatar_size'] ) {
							echo get_avatar( $comment, $args['avatar_size'] );
						}
						?>
						<?php
						$comment_author = get_comment_author_link( $comment );

						if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
							$comment_author = get_comment_author( $comment );
						}


						?>
					</div><!-- .comment-author -->



					<?php if ( '0' == $comment->comment_approved ) : ?>
					<em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content col-md-10">
                    <?php
                        						printf(
                                                    /* translators: %s: Comment author link. */
                                                    __( '%s <span class="says">says:</span>' ),
                                                    sprintf( '<b class="fn">%s</b>', $comment_author )
                                                );

                                                
                    ?>

                <div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php
									/* translators: 1: Comment date, 2: Comment time. */
									printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
								?>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
				if ( '1' == $comment->comment_approved || $show_pending_links ) {
					comment_reply_link(
						array_merge(
							$args,
							array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<div class="reply col-md-12">',
								'after'     => '</div>',
							)
						)
					);
				}
				?>
			</article><!-- .comment-body -->
		<?php
	}
}
