<?php
$post_meta = get_post_meta( get_the_ID() );
$promo_text = coupon_get_smeta( 'promo_text', $post_meta, '' );
$offer_expire = coupon_get_smeta( 'offer_expire', $post_meta, '' );
$offer_expire = coupon_get_smeta( 'offer_expire', $post_meta, '' );
$offer_shop_logo = coupon_get_smeta( 'offer_shop_logo', $post_meta, '' );
$offer_shop_url = coupon_get_smeta( 'offer_shop_url', $post_meta, '' );
$offer_url = coupon_get_smeta( 'offer_url' , $post_meta, '');
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
		<?php if( has_post_thumbnail() || !empty( $offer_shop_logo ) ): ?>
			<div class="logotype logotype-no-padding">
				<div class="logotype-image">
					<?php if( !empty( $offer_shop_logo ) ): ?>
						<div class="daily-offer-shop">
							<a href="<?php echo !empty( $offer_shop_url ) ? esc_url( $offer_shop_url ) : '' ?>" target="_blank">
								<?php
								$img_data = coupon_get_attachment( $offer_shop_logo, 'full' );
								?>
								<img src="<?php echo esc_url( $img_data['src'] ); ?>">
							</a>
						</div>
					<?php endif; ?>				
					<?php has_post_thumbnail() ? the_post_thumbnail( 'daily_offer' ) : ''; ?>
				</div>
			</div>
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="btn btn-custom btn-shop btn-full blue-bg btn-top btn-default btn-lg"><?php _e( 'Details', 'coupon' ) ?></a>
		<div class="featured-item-content">
			<h4><?php the_title(); ?></h4>
			<p><?php echo $promo_text; ?></p>
			<?php
			$has_ratings = coupon_get_option( 'code_dailly_ratings' );
			if( in_array( 'dailly', $has_ratings ) ){
				echo coupon_get_ratings();
			}
			?>			
			
			<?php if( !empty( $offer_url ) ): ?>
				<a href="<?php echo !empty( $offer_url ) ? esc_url( $offer_url ) : '' ?>" class="green" target="_blank">
					<?php _e( 'Buy Now ', 'coupon' ) ?><span class="fa fa-angle-right"></span>
				</a>
			<?php endif; ?>			
		</div>
		<div class="item-meta daily-meta">
			<ul class="list-inline list-unstyled">
				<li>
					<a href="javascript:;">
						<span class="fa fa-clock-o"></span>
						<div class="countdown countdown-listing" data-time="<?php echo esc_attr( $offer_expire ); ?>" data-days_text="<?php esc_attr_e( 'days', 'coupon' ); ?>" data-day_text="<?php esc_attr_e( 'day', 'coupon' ); ?>" data-style="daily_offer"></div>
					</a>
				</li>
				<li class="pull-right">
					<a href="<?php the_permalink(); ?>">
						<span class="fa fa-plus-square"></span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>