<?php
	/**********************************************************************
	***********************************************************************
	COUPON CODE SINGLE
	**********************************************************************/
get_header(); 
the_post();
get_template_part( 'includes/inner_header' );

$code_id = get_the_ID();
$code_meta = get_post_meta( $code_id );
$shop_id = coupon_get_smeta( 'code_shop_id', $code_meta, '' );
$shop_meta = get_post_meta( $shop_id );
$shop_link = coupon_get_smeta( 'shop_link', $shop_meta, '' );
?>
	<!-- show show details -->
<?php
  ?>
<section class="shop-single">

        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- single-shop-container -->
                <div class="col-md-9">

                    <!-- row -->
                    <div class="row">

                        <!-- shop-info -->
                        <div class="shop-info col-md-12">

                            <!-- row -->
                            <div class="row">

                                <!-- shop-info-image -->
								<?php if( has_post_thumbnail( $shop_id ) ): ?>
                                <div class="special-item col-md-4">
                                    <a href="<?php echo esc_url( $shop_link ); ?>" target="_blank">
                                        <div class="special-item-inner">
                                            <div class="special-icon shop-logo">
                                                <?php echo get_the_post_thumbnail( $shop_id, 'shop_logo' ); ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
								<?php endif; ?>
                                <!-- .shop-info-image -->

                                <!-- shop-info-content -->
                                <div class="col-md-8">
                                    <!-- title -->
                                    <div class="caption top-caption">
                                        <h2><?php echo get_the_title( $shop_id ); ?></h2>
                                    </div>
                                    <!-- .title -->

                                    <!-- shop-info-text -->
                                    <div class="shop-text main_content">
                                        <?php echo apply_filters( 'the_content', get_post_field( 'post_content', $shop_id ) ); ?>
                                    </div>
                                    <!-- .shop-info-text -->

                                    <!-- social-plugin -->
                                    <div class="social-plugin">

                                    </div>
                                    <!-- .social-plugin -->

                                </div>
                                <!-- .shop-info-content -->

                            </div>
                            <!-- .row -->

                        </div>
                        <!-- .shop-info -->

                        <!-- line-divider -->
                        <div class="col-md-12">
                            <div class="line-divider category-divider"></div>
                        </div>
                        <!-- .line-divider -->
						
						<?php include( locate_template( 'includes/code_list_complete.php' ) ); ?>
                    </div>
                </div>


                <!-- sidebar -->
                <div class="col-md-3">
                    <?php get_sidebar( 'right' ); ?>

                </div>
                <!-- .sidebar -->

            </div>

        </div>
        <!-- .row -->
        </div>
        <!-- .container -->

    </section>
<?php
wp_reset_query();
get_template_part( 'includes/shop_carousel' );
get_footer();
?>