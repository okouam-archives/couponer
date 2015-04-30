<?php
get_header();
the_post();
get_template_part( 'includes/inner_header' );
$post_meta = get_post_meta( get_the_ID() );
$offer_expire = coupon_get_smeta( 'offer_expire' , $post_meta, '');
$offer_images = coupon_smeta_images( 'offer_images' , $post_meta, array(), get_the_ID());
$offer_url = coupon_get_smeta( 'offer_url' , $post_meta, '');
$promo_text = coupon_get_smeta( 'promo_text' , $post_meta, '');

$page_content = get_the_content();
?>
<!-- =====================================================================================================================================
											B L O G - S I N G L E   C O N T E N T
====================================================================================================================================== -->
<section class="daily_offers">

        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="caption category-caption">
                        <h2><?php echo coupon_page_title() ?></span>
                        </h2>
                        <p><?php echo coupon_page_subtitle() ?></p>
                        <div class="line-divider">
                            <span class="line-mask green-bg"></span>
                        </div>
                    </div>
                </div>


                <!-- coupon-single-container -->
                <div class="col-md-9">

                    <!-- row -->
                    <div class="row">

						<?php if( !empty( $offer_images ) && strpos( $page_content, '[rev_slider' ) === false ): ?>
							<div class="post col-md-12">

								<!-- coupon-inner -->
								<div class="blog-inner">

									<div class="flexslider">
										<ul class="slides">
											<?php foreach( $offer_images as $image_id ): ?>
												<?php $image = coupon_get_attachment( $image_id, 'blog_large' ); ?>
												<li>  <img src="<?php echo esc_url( $image['src'] ); ?>" title="<?php echo esc_attr( $image['caption'] ) ?>" alt="<?php echo esc_attr( $image['caption'] ) ?>" /></li>
											<?php endforeach; ?>
										</ul>
									</div>

								</div>
								<!-- coupon-inner -->

							</div>
						<?php  endif; ?>
                        <!-- .coupon-single-container -->
                        
                        <!-- coupon-info-container -->
                        <div class="col-md-12 main_content">
                            <?php echo apply_filters( 'the_content', $page_content ); ?>
                        </div>
                        <!-- .coupon-info-container -->

                    </div>
                </div>
                <!-- .coupon-single-container -->


                <!-- sidebar -->
                <div class="col-md-3">

                    <!-- search-widget -->
                    <div class="widget">
                        <div class="blog-inner timer-inner">
                            <div class="line-divider widget-line-divider"></div>
                            <div class="caption widget-caption">
                                <h4><?php the_title(); ?></h4>
                            </div>

                            <!-- widget-content -->
                            <div class="widget-content">

                                <!-- coupon-timer -->
                                <div class="time">

                                    <div class="time-caption caption">
										<p><?php echo $promo_text;  ?></p>
										<?php
										$has_ratings = coupon_get_option( 'code_dailly_ratings' );
										if( in_array( 'dailly', $has_ratings ) ){
											echo coupon_get_ratings();
										}
										?>
									</div>

                                    <!-- countdown -->
									<?php if( !empty( $offer_expire ) ): ?>
                                    <div class="time-content">

                                        <span class="coupon-meta-caption"><?php _e( 'Time Left To Buy', 'coupon' );  ?></span>
                                        <!-- COUNTDOWN -->
                                        <div class="countdown" data-time="<?php echo esc_attr( $offer_expire ); ?>" data-button_url="<?php echo esc_url( $offer_url ); ?>" data-button_text="<?php esc_attr_e( 'Buy Now', 'coupon' ) ?>" data-days_text="<?php esc_attr_e( 'days', 'coupon' ); ?>" data-day_text="<?php esc_attr_e( 'day', 'coupon' ); ?>">

                                        </div>

                                    </div>
									<?php endif; ?>
                                    <!-- .countdown -->
                                </div>
                                <!-- .coupon-timer -->

                            </div>
                            <!-- .widget-content -->

                        </div>
                    </div>
                    <!-- search-widget -->

                </div>
                <!-- .sidebar -->

            </div>
            <!-- .row -->
        </div>
        <!-- .container -->

    </section>
<?php
get_footer();
?>