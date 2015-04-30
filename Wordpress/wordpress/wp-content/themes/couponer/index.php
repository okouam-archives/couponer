<?php
get_header();
the_post();
get_template_part( 'includes/inner_header' );
global $wp_query;
$args = array_merge( $wp_query->query_vars, array( 'post_type' => 'post' ) );
$main_query = new WP_Query( $args );

$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page
$page_links_total =  $main_query->max_num_pages;
$page_links = paginate_links( 
				array(
					'base' => add_query_arg( 'paged', '%#%' ),
					'prev_next' => true,
					'end_size' => 2,
					'mid_size' => 2,
					'total' => $page_links_total,
					'current' => $cur_page,	
					'prev_next' => false,
					'type' => 'array'
				)
			 );
?>
<!-- blog-home -->
<section class="blog-home">

	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- blog-home-container -->
			<div class="col-md-<?php echo is_active_sidebar('sidebar-right_blog') ? '9' : '12' ?>">
				
				<?php if( $main_query->have_posts() ): ?>
					<!-- row -->
					<div class="row">
						<?php while( $main_query->have_posts() ): ?>
							<?php $main_query->the_post() ?>

							<!-- blog-post-1 -->
							<div class="col-md-12">
								<div <?php post_class( 'blog-post' ); ?>>

									<div class="blog-inner blog-inner-home">
										
										<!-- blog-image -->

										<?php $dealimg = get_post_meta($post->ID, 'imageUrl', true); 

													if($dealimg) {

												?>
										
											<div class="image-placeholder col-md-3">
												<img src="<?php echo $dealimg ?>" alt="<?php the_title(); ?>" class="listing-blog-wull-width">
											</div>

										<?php } ?>
										
										<!-- .blog-image -->

										<!-- blog-post-content -->
										<div class="blog-post-content col-md-9">
											<div class="item-meta blog-meta">
												<ul class="list-inline list-unstyled">
													<li>
														<a href="javascript:;">
															<span class="fa fa-clock-o"></span><?php the_time( 'F j, Y' ) ?></a>
													</li>
												
													<li>
														<a href="javascript:;"><span class="fa fa-bars"></span></a>
														<?php echo coupon_categories_list( get_the_category() ); ?>
													</li>
													
												</ul>
											</div>

											<!-- title -->
											<div class="blog-caption caption">
												<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											</div>
											<!-- .title -->

											<!-- blog-post-text -->
											<div class="text">
												<?php echo get_post_meta($post->ID, 'promo', true); ?>
											</div>
											<!-- .blog-post-text -->

											<!-- blog-single-lead-icon -->
											<div class="blog-single-lead-icon <?php echo has_post_thumbnail() ? '' : 'pad-bottom-plus' ?>">
												<a href="<?php the_permalink(); ?>">
													More Info
													<span class="fa fa-plus-square green"></span>
												</a>

												<?php $deallink = get_post_meta($post->ID, 'purchaseUrl', true); 

													if($deallink) {

												?>

													<a href="<?php echo $deallink; ?>" target="_blank" title="Get <?php the_title(); ?>">
														Get this deal
														<span class="fa fa-tag green"></span>
													</a>
												
												<?php } ?>

											</div>
											<!-- .blog-single-lead-icon -->

										</div>
										<!-- .blog-post-content -->

									</div>

								</div>
							</div>
							<!-- .blog-post-1 -->
						<?php endwhile; ?>
						<?php if( !empty( $page_links ) ): ?>
							<!-- pagination -->
							<div class="blog-pagination col-md-12">
								<ul class="pagination">
									<?php echo coupon_format_pagination( $page_links ); ?>
								</ul>
							</div>
							<!-- .pagination -->
						<?php endif; ?>

					</div>
					<!-- .row -->
				<?php else: ?>
					<p><?php _e( 'No blog posts yet!', 'coupon' ); ?></p>
				<?php endif; ?>
			</div>
			<!-- .blog-home-container -->

			<!-- sidebar -->
			<div class="col-md-3">
				<?php 
				wp_reset_query();
				get_sidebar('right_blog'); 
				?>
			</div>
			<!-- .sidebar -->


		</div>
		<!-- .row -->
	</div>
	<!-- .container -->

</section>
<!-- .blog-home -->
<?php
get_template_part( 'includes/shop_carousel' );
get_footer();
?>