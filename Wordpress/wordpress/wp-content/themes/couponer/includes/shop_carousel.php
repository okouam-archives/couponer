<?php
$shops = get_posts(array(
	'post_type' => 'shop',
	'post_status' => 'publish',
	'posts_per_page' => -1
));
if( !empty( $shops ) ):
?>
<!-- =====================================================================================================================================
													C L I E N T S
====================================================================================================================================== -->
<!-- clients -->
<section class="clients">

	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div id="owl-clients" class="owl-carousel">
				<?php
				foreach( $shops as $shop ){
					if( has_post_thumbnail( $shop->ID ) ){
						?>
						<!-- client-1 -->
						<div class="client col-md-3">
							<div class="logotype-client">
								<div class="logotype-client-image">
									<a href="<?php echo esc_url( get_permalink( $shop->ID ) ); ?>">
										<?php echo get_the_post_thumbnail( $shop->ID, 'shop_logo' ); ?>
									</a>
								</div>
							</div>
						</div>
						<!-- .client-1 -->					
						<?php
					}
				}
				?>

			</div>

		</div>
		<!-- .row -->
	</div>
	<!-- .container -->

</section>
<!-- .clients -->
<?php endif; ?>