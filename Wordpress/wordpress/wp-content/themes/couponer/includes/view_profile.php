<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
	die ( 'Please do not load this page directly. Thanks!' );
}
$user = get_user_by( 'id', $author_id );
if( !empty( $user ) ):
$user_meta = get_user_meta( $author_id, 'coupon_user_meta' );
$user_meta = array_shift( $user_meta );
$default_meta = array(
	'city' 				=> '',
	'gender' 			=> '',
	'age' 				=> '',
	'subscribe'			=> '',
	'avatar'			=> '',
);
$user_meta = array_merge( $default_meta, (array)$user_meta );
extract( $user_meta );
?>
<section class="profile">
	<div class="container">
		<div class="row">

			<div class="profile-intro">

				<div class="media profile-media">
					<?php if( !empty( $avatar ) ): ?>
						<a class="pull-left" href="javascript:;">
							<img src="<?php echo esc_url( $avatar ) ?>" title="" alt="">
						</a>
					<?php endif; ?>

					<div class="media-body">
						<h2>
							<strong>
								<?php echo $user->user_login; ?></strong>
						</h2>
						<p><?php echo get_the_author_meta( 'description', $author_id ); ?></p>
					</div>

				</div>
				<hr />
			</div>
		</div>
	</div>
</section>
<?php endif; ?>