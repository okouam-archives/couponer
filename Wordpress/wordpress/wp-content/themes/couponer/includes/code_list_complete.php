<?php
$code_id = get_the_ID();
$code_meta = get_post_meta( $code_id );
$code_type = coupon_get_smeta( 'code_type', $code_meta, '2' );
$code_discount = coupon_get_smeta( 'code_discount', $code_meta, '' );					
$code_text = coupon_get_smeta( 'code_text', $code_meta, '' );					
$expire_timestamp = coupon_get_smeta( 'code_expire', $code_meta, time() );
$code_conditions = coupon_get_smeta( 'code_conditions', $code_meta, '' );
$code_api = coupon_get_smeta( 'code_api', $code_meta, '' );
$code_couponcode = coupon_get_smeta( 'code_couponcode', $code_meta, '' );
$shop_id = coupon_get_smeta( 'code_shop_id', $code_meta, '' );
$coupon_label = coupon_get_smeta( 'coupon_label', $code_meta, '' );
$remaining = coupon_remaining_time( $expire_timestamp );

$arrow_fix = '';
if( ( empty( $code_api ) && empty( $code_couponcode ) ) || ( $coupon_label == 'discount' && empty( $code_api ) ) ){
	$arrow_fix = 'arrow_fix';
}

?>

<!-- coupon-box-1 -->
	<div class="coupon-box <?php echo $remaining == 0 ? 'expired' : ''; ?> col-md-12">

		<div class="blog-inner col-md-12">

			<!-- row -->
			<div class="row">

				<!-- coupon-box-discount -->
				<div class="special-item col-md-4">
					<div class="special-item-inner coupon-inner orange <?php echo $arrow_fix; ?>">
						<h2><?php echo $code_discount; ?></h2>
						<h4><?php echo $code_text; ?></h4>
					</div>
					<?php
					if( isset( $show_logo ) ){
						if( has_post_thumbnail( $shop_id ) ){
							?>
							<div class="logotype-image">
								<div class="daily-offer-shop logotype-exp">
									<?php
									$img_data = wp_get_attachment_image_src( get_post_thumbnail_id( $shop_id ), 'full' );
									?>
									<a href="<?php echo get_permalink( $shop_id ); ?>">
										<img src="<?php echo esc_url( $img_data[0] ); ?>">
									</a>
								</div>
							</div>
							<?php
						}
					} 
					?>
				</div>
				<!-- .coupon-box-discount -->

				<div class="blog-single-content coupon-content col-md-8">

					<!-- coupon-box-content -->
					<div class="item-meta blog-meta shop-meta">

						<ul class="list-inline list-unstyled">
							<li>
								<a href="#">
									<span class="fa fa-clock-o"></span><?php echo $remaining == 0 ? __( 'Expired', 'coupon' ) : $remaining; ?></a>
							</li>
							<li>
								<a href="<?php echo esc_url( coupon_get_label_link( $shop_id, $code_id ) ); ?>">
									<span class="fa fa-tag"></span><?php echo coupon_label( $code_id ); ?></a>
							</li>
							<li>
								<a href="#_" class="info pop-over" data-title="<b><?php esc_attr_e( 'Conditions', 'coupon' ); ?></b>" data-content="<p><?php echo esc_attr( $code_conditions ); ?></p>">
									<span class="fa fa-info-circle"></span><?php _e( 'Conditions', 'coupon' ); ?></a>
							</li>
							<li>
								<?php
								$has_ratings = coupon_get_option( 'code_dailly_ratings' );
								if( in_array( 'code', $has_ratings ) ){
									echo coupon_get_ratings();
								}
								?>
							</li>
						</ul>

					</div>

					<!-- coupon-box-promo-title -->
					<div class="shop-promo-title">
						<h4><?php the_content() ?></h4>
					</div>
					<!-- .coupon-box-promo-title -->

					<!-- coupon-box-button-green -->

					<!-- coupon-box-button-replace -->
					<div class="row">
						<?php if( ( $coupon_label == 'coupon' && ( !empty( $code_couponcode) || !empty( $code_api ) ) ) || ( $coupon_label == 'discount' && !empty( $code_api ) ) ):  ?>
							<div class="col-md-6">
								<a data-code="<?php echo $code_couponcode; ?>" href="<?php echo ( !empty( $code_api ) && $remaining > 0 ) ? esc_url( $code_api ) : 'javascript:;'; ?>" target="_blank" class="<?php echo $remaining == 0 ? 'disabled' : ''; ?> btn btn-custom btn-top btn-shop <?php echo ( empty( $code_couponcode )|| $coupon_label == 'discount' ) ? 'blue-bg' : '' ?> btn-default btn-lg <?php echo ( !empty( $code_couponcode ) && $coupon_label == 'coupon' ) ? 'show-code' : '' ?> btn-padding" data-codeid="<?php echo get_the_ID(); ?>">
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
							</div>
						<?php else: ?>
							<div class="col-md-6">
								<p class="dummy-padding"></p>
							</div>
						<?php endif; ?>						
					</div>
					<!-- .coupon-box-button-replace -->
					<?php if( $shop_id != get_the_ID() && !is_singular('code') ){
						?>
						<!-- blog-single-lead-icon -->
						<div class="blog-single-lead-icon pull-right">
							<a href="<?php the_permalink(); ?>">
								<span class="fa fa-plus-square green <?php echo $remaining == 0 ? 'disabled' : ''; ?>"></span>
							</a>
						</div>
						<!-- .blog-single-lead-icon -->						
						<?php
					} ?>
				</div>
				<!-- .coupon-box-content -->

			</div>
			<!-- .row -->
		</div>

	</div>
	<!-- .coupon-box-1 -->