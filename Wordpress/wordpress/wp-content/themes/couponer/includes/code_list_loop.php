<?php
$code_meta = get_post_meta( get_the_ID() );
$code_type = coupon_get_smeta( 'code_type', $code_meta, '2' );
$code_discount = coupon_get_smeta( 'code_discount', $code_meta, '' );					
$code_text = coupon_get_smeta( 'code_text', $code_meta, '' );					
$expire_timestamp = coupon_get_smeta( 'code_expire', $code_meta, time() );
$code_conditions = coupon_get_smeta( 'code_conditions', $code_meta, '' );
$code_api = coupon_get_smeta( 'code_api', $code_meta, '' );
$shop_id = coupon_get_smeta( 'code_shop_id', $code_meta, '' );
$code_couponcode = coupon_get_smeta( 'code_couponcode', $code_meta, '' );
$coupon_label = coupon_get_smeta( 'coupon_label', $code_meta, '' );
$remaining = coupon_remaining_time( $expire_timestamp );								
if( $counter == $max_count ){
	$counter = 0;
	?>
	</div>
	<div class="row">
	<?php
}
$counter++;
?>
<!-- item-1 -->
<div class="featured-item-container col-md-<?php echo $col_md; ?>">
	<div class="featured-item">
		<?php  echo coupon_code_type( $code_type ) ?>
		<?php if( has_post_thumbnail( $shop_id ) ): ?>
			<div class="logotype">
				<div class="logotype-image">
					<?php echo get_the_post_thumbnail( $shop_id, 'shop_logo' ); ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if( ( $coupon_label == 'coupon' && ( !empty( $code_couponcode) || !empty( $code_api ) ) ) || ( $coupon_label == 'discount' && !empty( $code_api ) ) ):  ?>
			<a data-code="<?php echo $code_couponcode; ?>" href="<?php echo !empty( $code_api ) ? esc_url( $code_api ) : ''; ?>" target="_blank" class="btn btn-custom btn-full <?php echo ( empty( $code_couponcode )|| $coupon_label == 'discount' ) ? 'blue-bg' : '' ?> btn-shop btn-top btn-default btn-lg <?php echo ( !empty( $code_couponcode ) && $coupon_label == 'coupon' ) ? 'show-code' : '' ?>" data-codeid="<?php echo get_the_ID(); ?>">
				<?php
					if( !empty( $code_couponcode ) && $coupon_label == 'coupon' ){
						echo coupon_get_option( 'show_code_text' );
					}
					else if( empty( $code_couponcode ) && $coupon_label == 'coupon' ){
						echo coupon_get_option( 'pack_open_text' );
					}
					else{
						echo coupon_get_option( 'check_discount_text' );
					}
				?>
			</a>
		<?php endif; ?>
		<div class="featured-item-content">
			<a href="<?php the_permalink() ?>"><h4><?php the_title(); ?></h4></a>
			<p><?php the_content(); ?></p>
			<?php
			$has_ratings = coupon_get_option( 'code_dailly_ratings' );
			if( in_array( 'code', $has_ratings ) ){
				echo coupon_get_ratings();
			}
			?>			
		</div>
		<div class="item-meta">
			<ul class="list-inline list-unstyled">
				<li>
					<a href="javascript:;">
						<span class="fa fa-clock-o"></span><?php echo coupon_remaining_time( $expire_timestamp ); ?>
					</a>
				</li>
				<li>
					<a href="<?php echo esc_url( coupon_get_label_link( $shop_id, get_the_ID() ) ); ?>">
						<span class="fa fa-tag"></span><?php echo coupon_label( get_the_ID() ); ?>
					</a>
				</li>
				<li class="pull-right">
					<a href="<?php echo esc_url( get_permalink( $shop_id ) ); ?>">
						<span class="fa fa-plus-square"></span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- .item-1 -->