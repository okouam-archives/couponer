<?php
/*
	Template Name: Page Top 20
*/

get_header();
the_post();
get_template_part( 'includes/inner_header' );
$show_in_listings = (array)coupon_get_option( 'show_in_listings' );
$featured_per_page = coupon_get_option( 'featured_per_page' );
$popular_per_page = coupon_get_option( 'popular_per_page' );
$newest_per_page = coupon_get_option( 'newest_per_page' );
$tab = !empty( $_GET['tab'] ) ? $_GET['tab'] : '';

/* grab top 20 */
if( in_array( 'top20', $show_in_listings ) ){
	$args = array(
		'post_type' 	=> 'code',
		'meta_key' 		=> 'code_clicks',
		'orderby'		=> 'meta_value_num',
		'post_status'	=> 'publish',
		'order'			=> 'DESC',
		'posts_per_page'=> 20,
		'fields'        => 'ids',
		'meta_query'	=> array(
			'relation' => 'AND',
			array(
				'key' => 'code_for',
				'value' => 'all_users',
				'compare' => '='
			),
			array(
				'key' => 'code_expire',
				'value' => time(),
				'compare' => '>='
			)
		)
	);
	
	$popular_sort = coupon_get_option( 'popular_sort' );
	if( $popular_sort == 'ratings' ){
		$args['meta_key'] = 'coupon_average_rate';
	}
	$top20 = get_posts( $args );

	$top20fake = get_posts( array(
		'post_type' 	=> 'code',
		'meta_key' 		=> 'code_force_top20',
		'orderby'		=> 'meta_value_num',
		'post_status'	=> 'publish',
		'order'			=> 'ASC',
		'posts_per_page'=> 20,
		'fields'        => 'ids',
		'meta_query'	=> array(
			'relation' => 'AND',
			array(
				'key' => 'code_for',
				'value' => 'all_users',
				'compare' => '='
			),
			array(
				'key' => 'code_expire',
				'value' => time(),
				'compare' => '>='
			)
		)
	) );
	if( !empty( $top20fake ) ){
		foreach( $top20fake as $code_id ){
			if( in_array( $code_id, $top20 ) ){
				unset( $top20[ array_search( $code_id, $top20 ) ] );
			}
			
			$code_position = get_post_meta( $code_id, 'code_force_top20' );
			
			array_splice( $top20, $code_position[0]-1, 0, $code_id );
		}
	}
}

if( in_array( 'featured', $show_in_listings ) ){
	/* grab fetured */
	if( $tab == 'featured' ){
		$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page
	}
	else{
		$cur_page = 1;
	}
	$featured = new WP_Query(array(
		'post_type' 	=> 'code',
		'meta_key' 		=> 'code_type',
		'orderby'		=> 'meta_value_num',
		'post_status' 	=> 'publish',
		'order'			=> 'DESC',
		'posts_per_page'=> $featured_per_page,
		'paged' 		=> $cur_page,
		'meta_query'	=> array(
			'relation' => "AND",
			array(
				'key' => 'code_for',
				'value' => 'all_users',
				'compare' => '='
			),
			array(
				'key' => 'code_expire',
				'value' => time(),
				'compare' => '>'
			),
			array(
				'key' => 'code_type',
				'value' => '1',
				'compare' => '='
			),			
			
		)
	));

	$page_links_total =  $featured->max_num_pages;
	$page_links = paginate_links( 
		array(
			'base' => add_query_arg( 'paged', '%#%' ),
			'prev_next' => true,
			'end_size' => 2,
			'mid_size' => 2,
			'total' => $page_links_total,
			'current' => $cur_page,	
			'prev_next' => false,								
			'type' => 'array',
			'add_args' => array( 'tab' => 'featured' )
		)
	);

	$featured_pagination = coupon_format_pagination( $page_links );
}

if( in_array( 'popular', $show_in_listings ) ){
	/* grab popular */
	if( $tab == 'popular' ){
		$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page
	}
	else{
		$cur_page = 1;
	}
	$popular = new WP_Query(array(
		'post_type' 	=> 'code',
		'meta_key' 		=> 'code_clicks',
		'orderby'		=> 'meta_value_num',
		'post_status' 	=> 'publish',
		'order'			=> 'DESC',
		'posts_per_page'=> $popular_per_page,
		'paged' 		=> $cur_page,
		'meta_query'	=> array(
			'relation' => "AND",
			array(
				'key' => 'code_for',
				'value' => 'all_users',
				'compare' => '='
			),	
			array(
				'key' => 'code_expire',
				'value' => time(),
				'compare' => '>'
			),
		)
	));

	$page_links_total =  $popular->max_num_pages;
	$page_links = paginate_links( 
		array(
			'base' => add_query_arg( 'paged', '%#%' ),
			'prev_next' => true,
			'end_size' => 2,
			'mid_size' => 2,
			'total' => $page_links_total,
			'current' => $cur_page,	
			'prev_next' => false,								
			'type' => 'array',
			'add_args' => array( 'tab' => 'popular' )
		)
	);

	$popular_pagination = coupon_format_pagination( $page_links );
}

if( in_array( 'newest', $show_in_listings ) ){
	/* grab newest */
	if( $tab == 'newest' ){
		$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page
	}
	else{
		$cur_page = 1;
	}
	$newest = new WP_Query(array(
		'post_type' 	=> 'code',
		'orderby'		=> 'date',
		'post_status' 	=> 'publish',
		'order'			=> 'DESC',
		'posts_per_page'=> $newest_per_page,
		'paged' 		=> $cur_page,
		'meta_query'	=> array(
			'relation' => "AND",
			array(
				'key' => 'code_for',
				'value' => 'all_users',
				'compare' => '='
			),	
			array(
				'key' => 'code_expire',
				'value' => time(),
				'compare' => '>'
			),
			
		)
	));

	$page_links_total =  $popular->max_num_pages;
	$page_links = paginate_links( 
		array(
			'base' => add_query_arg( 'paged', '%#%' ),
			'prev_next' => true,
			'end_size' => 2,
			'mid_size' => 2,
			'total' => $page_links_total,
			'current' => $cur_page,	
			'prev_next' => false,							
			'type' => 'array',
			'add_args' => array( 'tab' => 'newest' )
		)
	);

	$newest_pagination = coupon_format_pagination( $page_links );
}

/* calculate width of the boxes based on the active status of the right sidebar */
$max_count = is_active_sidebar('sidebar-right') ? 3 : 4;
$col_md = is_active_sidebar('sidebar-right') ? 4 : 3;

?>

<!-- =====================================================================================================================================
													T O P 2 0  C O N T E N T
====================================================================================================================================== -->
<!-- top20 -->
<section class="top20">

	<!-- container -->
	<div class="container">

		<!-- row -->
		<div class="row">

			<!-- featured-boxes -->
			<div class="col-md-<?php echo is_active_sidebar('sidebar-right') ? '9' : '12' ?>">
				<div class="row">
					<div class="col-md-12 main_content">
						<?php the_content(); ?>
					</div>
				</div>
				<!-- row -->
				<div class="row">

					<!-- featured-boxes-header -->
					<div class="head clearfix">

						<div class="col-md-12">

							<div class="caption top-caption col-md-5">
								<h2><?php echo coupon_page_title() ?></h2>
							</div>

							<!-- filter-tabs -->
							<div class="filter-tabs clearfix top-20-tabs col-lg-7 col-md-7">
								<ul class="nav nav-tabs list-unstyled list-inline">
									<?php if( in_array( 'top20', $show_in_listings ) ): ?>
										<li <?php echo empty( $tab ) ? 'class="active"' : ''; ?>><a href="#top" data-toggle="tab"><?php _e( 'Top 20', 'coupon' ); ?> </a></li>
									<?php endif; ?>
									
									<?php if( in_array( 'featured', $show_in_listings ) ): ?>
										<li <?php echo $tab == 'featured' ? 'class="active"' : ''; ?>><a href="#featured" data-toggle="tab"><?php _e( 'Featured', 'coupon' ) ?> </a></li>
									<?php endif; ?>
									
									<?php if( in_array( 'popular', $show_in_listings ) ): ?>
										<li <?php echo $tab == 'popular' ? 'class="active"' : ''; ?>><a href="#popular" data-toggle="tab"><?php _e( 'Popular', 'coupon' ) ?> </a></li>
									<?php endif; ?>
									
									<?php if( in_array( 'newest', $show_in_listings ) ): ?>
										<li <?php echo $tab == 'newest' ? 'class="active"' : ''; ?>><a href="#newest" data-toggle="tab"><?php _e( 'Newest', 'coupon' ) ?> </a></li>
									<?php endif; ?>
								</ul>
							</div>
							<!-- .filter-tabs -->

						</div>

					</div>
					<!-- .featured-boxes-header -->

					<!-- tab-content -->
					<div class="tab-content">
						<?php if( in_array( 'top20', $show_in_listings ) ): ?>
							<div class="tab-pane fade <?php echo empty( $tab ) ? 'in active' : ''; ?>" id="top">
								<div class="featured-container col-md-12">
									<?php if( !empty( $top20 ) ): ?>
										<div class="row">
											<?php 
											$counter = 0;
											foreach( $top20 as $code_id ){
												$code = get_post( $code_id );
												$code_meta = get_post_meta( $code->ID );
												$code_type = coupon_get_smeta( 'code_type', $code_meta, '2' );
												$code_text = coupon_get_smeta( 'code_text', $code_meta, '' );					
												$code_conditions = coupon_get_smeta( 'code_conditions', $code_meta, '' );
												$expire_timestamp = coupon_get_smeta( 'code_expire', $code_meta, time() );
												$code_api = coupon_get_smeta( 'code_api', $code_meta, '' );
												$shop_id = coupon_get_smeta( 'code_shop_id', $code_meta, '' );												
												$coupon_label = coupon_get_smeta( 'coupon_label', $code_meta, '' );												
												$code_couponcode = coupon_get_smeta( 'code_couponcode', $code_meta, '' );												
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
															<a data-code="<?php echo $code_couponcode; ?>" href="<?php echo !empty( $code_api ) ? esc_url( $code_api ) : ''; ?>" target="_blank" class="btn btn-custom btn-full <?php echo ( empty( $code_couponcode )|| $coupon_label == 'discount' ) ? 'blue-bg' : '' ?> btn-shop btn-top btn-default btn-lg <?php echo ( !empty( $code_couponcode ) && $coupon_label == 'coupon' ) ? 'show-code' : '' ?>" data-codeid="<?php echo $code->ID; ?>">
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
															<a href="<?php echo get_permalink( $code->ID ) ?>"><h4><?php echo $code->post_title; ?></h4></a>
															<p><?php echo $code->post_content ?></p>
															<?php
															$has_ratings = coupon_get_option( 'code_dailly_ratings' );
															if( in_array( 'code', $has_ratings ) ){
																echo coupon_get_ratings( $code->ID );
															}
															?>
														</div>
														<div class="item-meta">
															<ul class="list-inline list-unstyled">
																<li>
																	<a href="javascript:;">
																		<span class="fa fa-clock-o"></span><?php echo coupon_remaining_time( $expire_timestamp ); ?></a>
																</li>
																<li>
																	<a href="<?php echo esc_url( coupon_get_label_link( $shop_id, $code->ID ) ); ?>">
																		<span class="fa fa-tag"></span><?php echo coupon_label( $code->ID ); ?>
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
												<?php
											}
											?>
										</div>
									<?php endif; ?>
								</div>						
							</div>
						<?php endif; ?>
						
						<?php if( in_array( 'featured', $show_in_listings ) ): ?>
							<div class="tab-pane fade <?php echo $tab == 'featured' ? 'in active' : ''; ?>" id="featured">
								<div class="featured-container col-md-12">
									<?php if( $featured->have_posts() ): $counter = 0;?>
										<div class="row">
											<?php 
											while( $featured->have_posts() ){
												$featured->the_post();
												include( locate_template( 'includes/code_list_loop.php' ) );
											}
											?>
										</div>
										<!-- pagination -->
										<?php if( !empty( $featured_pagination ) ): ?>
											<!-- pagination -->
											<div class="row">
												<div class="blog-pagination col-md-12">
												   <ul class="pagination">
													  <?php echo $featured_pagination; ?>
												   </ul>
												</div>
											</div>
											<!-- .pagination -->
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
						
						<?php if( in_array( 'popular', $show_in_listings ) ): ?>
							<div class="tab-pane fade <?php echo $tab == 'popular' ? 'in active' : ''; ?>" id="popular">
								<div class="featured-container col-md-12">
									<?php if( $popular->have_posts() ): $counter = 0;?>
										<div class="row">
											<?php 
											while( $popular->have_posts() ){
												$popular->the_post();
												include( locate_template( 'includes/code_list_loop.php' ) );
											}
											?>
										</div>
										<?php if( !empty( $popular_pagination ) ): ?>
											<!-- pagination -->
											<div class="row">
												<div class="blog-pagination col-md-12">
												   <ul class="pagination">
													  <?php echo $popular_pagination; ?>
												   </ul>
												</div>
											</div>
											<!-- .pagination -->
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
						
						<?php if( in_array( 'newest', $show_in_listings ) ): ?>
							<div class="tab-pane fade <?php echo $tab == 'newest' ? 'in active' : ''; ?>" id="newest">
								<div class="featured-container col-md-12">
									<?php if( $newest->have_posts() ): $counter = 0;?>
										<div class="row">
											<?php 
											while( $newest->have_posts() ){
												$newest->the_post();
												include( locate_template( 'includes/code_list_loop.php' ) );
											}
											?>
										</div>
										<?php if( !empty( $newest_pagination ) ): ?>
											<!-- pagination -->
											<div class="row">
												<div class="blog-pagination col-md-12">
												   <ul class="pagination">
													  <?php echo $newest_pagination; ?>
												   </ul>
												</div>
											</div>
											<!-- .pagination -->
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<!-- .tab-content -->

				</div>
				<!-- .row -->
				
			</div>
			<!-- .featured-boxes -->


			<!-- sidebar -->
			<div class="col-md-3">
				<?php get_sidebar( 'right' ); ?>
			</div>
			<!-- .sidebar -->

		</div>
		<!-- .row -->
	</div>
	<!-- .container -->

</section>
<!-- .top20 -->
<?php
get_template_part( 'includes/shop_carousel' );
get_footer();
?>