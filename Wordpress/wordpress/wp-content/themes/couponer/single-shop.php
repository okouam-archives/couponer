<?php
	/**********************************************************************
	***********************************************************************
	COUPON SHOP SINGLE
	**********************************************************************/
get_header(); 
the_post();
get_template_part( 'includes/inner_header' );

$shop_id = get_the_ID();
$shop_meta = get_post_meta( $shop_id );
$shop_link = coupon_get_smeta( 'shop_link', $shop_meta, '' );
?>
	<!-- show show details -->
<?php
$cur_page = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1; //get curent page

$args = array(
	'post_type'		=> 'code',
	'post_status'	=> 'publish',
	'posts_per_page'=> coupon_get_option('shop_listing_per_page'),
	'code_category'	=> get_query_var( 'term' ),
	'meta_key'		=> 'code_expire',
	'orderby'		=> 'meta_value_num',
	'order'			=> 'desc',
	'paged' 		=> $cur_page,
	'meta_query'	=> array(
		'relation'	=> "AND",
		array(
			'key' => 'code_for',
			'value' => 'all_users',
			'compare' => '='
		),
		array(
			'key' => 'code_shop_id',
			'value'	=> $shop_id,
			'compare'	=> '='
		)
	)

);

if( !empty( $_GET['coupon_label'] ) ){
	$args['meta_query'][] = 	array(
		'key' => 'coupon_label',
		'value' => $_GET['label_var'],
		'compare' => '='
	);
}

$main_query = new WP_Query($args);

$page_links_total =  $main_query->max_num_pages;
$page_links = paginate_links( 
	array(
		'base' => add_query_arg( 'page', '%#%' ),
		'prev_next' => true,
		'end_size' => 2,
		'mid_size' => 2,
		'total' => $page_links_total,
		'current' => $cur_page,	
		'prev_next' => false,								
		'type' => 'array'
	)
);

$pagination = coupon_format_pagination( $page_links );
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
								<?php if( has_post_thumbnail() ): ?>
                                <div class="special-item col-md-4">
                                    <a href="<?php echo esc_url( $shop_link ); ?>" target="_blank">
                                        <div class="special-item-inner">
                                            <div class="special-icon shop-logo">
                                                <?php the_post_thumbnail( 'shop_logo' ); ?>
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
                                        <h2><?php the_title(); ?></h2>
                                    </div>
                                    <!-- .title -->

                                    <!-- shop-info-text -->
                                    <div class="shop-text main_content">
                                        <?php the_content(); ?>
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
						
						<?php 
						if( $main_query->have_posts() ){
							while( $main_query->have_posts() ){
								$main_query->the_post(); 
								include( locate_template( 'includes/code_list_complete.php' ) );
								
							}
						}
						?>
                    </div>
                    <!-- .single-shop-container -->
					<?php if( !empty( $pagination ) ): ?>
						<!-- pagination -->
						<div class="row">
							<div class="blog-pagination col-md-12">
							   <ul class="pagination">
								  <?php echo $pagination; ?>
							   </ul>
							</div>
						</div>
						<!-- .pagination -->
					<?php endif; ?>
                </div>


                <!-- sidebar -->
                <div class="col-md-3">
					<!-- recommended-widget -->
					<div class="widget">
						<div class="blog-inner widget-inner">
							<div class="line-divider widget-line-divider"></div>
							<div class="caption widget-caption">
								<h4><?php _e( 'Shop Recommended by', 'coupon' ); ?></h4>
							</div>
							<?php
								/* gte author meta */
								$author_id =  get_the_author_meta('ID');
								$user_meta = get_user_meta( $author_id, 'coupon_user_meta' );
								$user_meta = array_shift( $user_meta );
								$avatar = '';
								$description = '';
								if( !empty( $user_meta['avatar'] ) ){
									$avatar = $user_meta['avatar'];
								}
								
							?>
							<!-- profile -->
							<div class="profile widget-content">
								<?php if( !empty( $avatar ) ): ?>
									<!-- avatar-image -->
									<div class="avatar pull-left">
										<img src="<?php echo esc_url( $avatar ); ?>" class="media-object img-thumbnail img-circle img-responsive img-custom-profile" title="" alt="" />
									</div>
									<!-- .avatar-image -->
								<?php endif; ?>

								<!-- profile-info -->
								<div class="profile-info <?php echo empty( $avatar ) ? 'np-left' : '' ?>">
									<p><?php echo get_the_author_meta( 'display_name' ); ?></p>
									<a href="<?php echo esc_url( get_author_posts_url(  get_the_author_meta( 'ID' ) ) ); ?>"><?php _e( 'View profile' , 'coupon'); ?></a>
								</div>
								<!-- .profile-info -->

								<!-- profile-text -->
								<div class="profile-text">
									<p><?php echo get_the_author_meta( 'description' ); ?></p>
								</div>
								<!-- .profile-text -->
							</div>
							<!-- .profile -->
						</div>

					</div>
					<!-- .recommended-widget -->
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