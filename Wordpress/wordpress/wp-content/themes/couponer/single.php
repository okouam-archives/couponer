<?php
get_header();
the_post();
get_template_part( 'includes/inner_header' );

?>
<!-- =====================================================================================================================================
											B L O G - S I N G L E   C O N T E N T
====================================================================================================================================== -->
<!-- blog-single -->
<section class="blog-single">

	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- blog-single-container -->
			<div class="col-md-<?php echo is_active_sidebar('sidebar-right_blog') ? '9' : '12' ?>">

				<!-- row -->
				<div class="row">

					<!-- post -->
					<div class="post col-md-12">

						<!-- blog-inner -->
						<div class="blog-inner">
							
							<?php if( has_post_thumbnail() ): ?>
								<div class="post-image">
									<?php 
										if( is_active_sidebar('sidebar-right_blog') ){
											the_post_thumbnail( 'blog_large', array( 'class' => 'listing-blog-wull-width img-responsive' ) );
										}
										else{
											the_post_thumbnail( 'full', array( 'class' => 'listing-blog-wull-width img-responsive' ) );
										}
									?>
								</div>
							<?php endif; ?>

							<!-- blog-post-content -->
							<div class="blog-post-content blog-single-content">

								<!-- blog-meta -->
								<div class="item-meta blog-meta">
									<ul class="list-inline">
										<li>
											<a href="javascript:;">
												<span class="fa fa-clock-o"></span><?php the_time( 'F j, Y' ) ?></a>
										</li>
										<li>
											<a href="javascript:;">
												<span class="fa fa-user"></span><?php the_author(); ?></a>
										</li>
										<li>
											<a href="javascript:;"><span class="fa fa-bars"></span></a>
											<?php echo coupon_categories_list( get_the_category() ); ?>
										</li>
										<li>
											<a href="javascript:;">
												<span class="fa fa-comment"></span><?php comments_number( '0', '1', '%' ); ?></a>
										</li>
									</ul>
								</div>
								<!-- .blog-meta -->

								<div class="blog-single-lead-icon <?php echo has_post_thumbnail() ? '' : 'pad-bottom-plus' ?>">
											

												<?php $deallink = get_post_meta($post->ID, 'purchaseUrl', true); 

													if($deallink) {

												?>

													<a href="<?php echo $deallink; ?>" target="_blank" title="Get <?php the_title(); ?>" class="btn-custom">
														Get this deal
														<span class="fa fa-tag white"></span>
													</a>
												
												<?php } ?>

											</div>

								<!-- blog-post-text -->
								<div class="text main_content">

									
										<?php $dealpromo = get_post_meta($post->ID, 'promo', true); 

													if($dealpromo) {

														echo $dealpromo;

													} else { 

														the_content(); 

													}

												?>




						

									<?php echo get_post_meta($post->ID, 'promo', true); ?>
								</div>
								<!-- .blog-post-text -->

								
								<?php 
								$tags = coupon_tags_list( get_the_tags(), true ); 
								if( !empty( $tags ) ):
								?>
									<!-- blog-meta -->
									<div class="item-meta blog-meta meta-tags">
										<ul class="list-inline">
											<li>
												<span class="fa fa-tags"></span>
											</li>
											<?php echo $tags; ?>
										</ul>
									</div>
									<!-- .blog-meta -->
								<?php
								endif;
								?>

							</div>
							<!-- .blog-post-content -->

						</div>
						<!-- .blog-inner -->

					</div>
					<!-- .post -->
					<?php 
						$post_pages = coupon_link_pages();
						if( !empty( $post_pages ) ): ?>
						<!-- pagination -->
						<div class="blog-pagination col-md-12 blog-pagination-comments">
							<ul class="pagination">
								<?php echo $post_pages; ?>
							</ul>
						</div>
						<!-- .pagination -->
					<?php endif; ?>					

				
				</div>
				<!-- .row -->
			</div>
			<!-- .blog-single-container -->


			<!-- sidebar -->
			<div class="col-md-3">
				<?php get_sidebar( 'right_blog' ); ?>
			</div>
			<!-- .sidebar -->


		</div>
		<!-- .row -->
	</div>
	<!-- .container -->

</section>
<!-- .blog-single -->
<?php
get_footer();
?>