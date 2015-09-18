<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php printf ( __( 'This post is password protected. Enter the password to view comments.' , 'bordeaux' ));?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() && comments_open()) : ?>

		<ol>
		
			<?php wp_list_comments('type=comment&callback=bordeaux_comment'); ?>
		</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
		<div class="no-comments">
		<p><b><?php printf ( __( 'No comments yet.' , 'bordeaux' ));?></b></p>
		<p><?php printf ( __( 'Be first to leave your comment!' , 'bordeaux' ));?></p>
		</div>
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="no-comments"><?php printf ( __( 'Comments are closed' , 'bordeaux' ));?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>


<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf ( __( 'Only <a href="%1$s"> registered </a> users can comment.', 'bordeaux' ), wp_login_url( get_permalink() ));?> </p>
<?php else : ?>

	<!-- BEGIN .add-comment -->
	<div class="add-comment">
	<a href="#" name="respond"></a>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		
			<table>
			<?php if ( is_user_logged_in() ) : ?>
				<p><?php printf ( __( 'Logged in as <a href="%1$s/wp-admin/profile.php"> %2$s </a>. <a href="%3$s" title="Log out of this account">Log out &raquo;</a>', 'bordeaux' ), get_option('siteurl'), $user_identity, wp_logout_url(get_permalink()));?></p>

			<?php else : ?>
			
				<tr>
					<td class="label"><?php printf ( __( 'Name' , 'bordeaux' ));?>:</td>
					<td><p class="input-text-1"><span><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" class="input-text" <?php if ($req) echo "aria-required='true'"; ?> /></span></p></td>
				</tr>
				<tr><td class="spacer-1" colspan="2"></td></tr>
				<tr>
					<td class="label"><?php printf ( __( 'E-mail' , 'bordeaux' ));?>:</td>
					<td><p class="input-text-1"><span><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" class="input-text" <?php if ($req) echo "aria-required='true'"; ?> /></span></p></td>
				</tr>
				<tr><td class="spacer-1" colspan="2"></td></tr>
				<tr>
					<td class="label"><?php printf ( __( 'Homepage' , 'bordeaux' ));?>:</td>
					<td><p class="input-text-1"><span><input type="text" name="url" id="url" value="<?php echo $comment_author_url ?>" class="input-text" <?php if ($req) echo "aria-required='true'"; ?> /></span></p></td>
				</tr>
				<tr><td class="spacer-1" colspan="2"></td></tr>
			<?php endif; // If registration required and not logged in ?>
				
				<tr>
					<td class="label"><?php printf ( __( 'Comment' , 'bordeaux' ));?>:</td>
					<td>
						<div class="text-area-1">
							<div class="top">
								<textarea name="comment" id="comment"></textarea>
							</div>
							<div class="bottom"></div>
						</div>
					</td>
				</tr>
				<tr><td class="spacer-2" colspan="2"></td></tr>
				<tr>
					<td></td>
					<td><p class="show-all"><a href="#" onclick="document.getElementById('commentform').submit(); return false;" class="btn-1 btn-align-left"><span><?php printf ( __( 'Add your comment' , 'bordeaux' ));?></span></a></p></td>
				</tr>
			</table>
			<?php comment_id_fields(); ?>
			<?php do_action('comment_form', $post->ID); ?>
			
		</form>
	<!-- END .add-comment -->
	</div>

<?php endif; // if you delete this the sky will fall on your head ?>

<?php endif; ?>