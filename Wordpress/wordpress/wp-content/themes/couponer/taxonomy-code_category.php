<?php 
	/**********************************************************************
	***********************************************************************
	COUPON LISTING BY TAXONOMY CODE CATEGORY
	**********************************************************************/
get_header();
get_template_part( 'includes/inner_header' );

$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page
$taxonomy = get_term_by( 'slug', get_query_var( 'term' ), 'code_category' );
$term_meta = get_option( "taxonomy_".$taxonomy->term_id );
$icon = !empty( $term_meta['category_icon'] ) ? $term_meta['category_icon'] : '';

$main_query = new WP_Query(array(
	'post_type'		=> 'code',
	'post_status'	=> 'publish',
	'posts_per_page'=> coupon_get_option('search_per_page'),
	'code_category'	=> get_query_var( 'term' ),
	'meta_key'		=> 'code_type',
	'orderby'		=> 'meta_value_num',
	'order'			=> 'ASC',
	'paged' 		=> $cur_page,
	'meta_query'	=> array(
		'relation'	=> 'AND',
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
 
$pagination = coupon_format_pagination( $page_links );

/* get number of items and col_md based on the active status of the right sidebar */
$max_count = is_active_sidebar('sidebar-right') ? 3 : 4;
$col_md = is_active_sidebar('sidebar-right') ? 4 : 3;

?>
<section class="category">

	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- single-shop-container -->
			<div class="col-md-<?php echo is_active_sidebar('sidebar-right') ? '9' : '12' ?>">

				<!-- row -->
				<div class="row">

					<!-- shop-info -->
					<div class="shop-info col-md-12">

						<!-- row -->
						<div class="row">

							<!-- shop-info-image -->
							<div class="special-item col-md-4">
								<a href="#">
									<div class="special-item-inner">
										<div class="special-icon">
											<span class="fa fa-<?php echo esc_attr( $icon ); ?>"></span>
											<h3><?php echo $taxonomy->name; ?></h3>
										</div>
									</div>
								</a>
							</div>
							<!-- .shop-info-image -->

							<!-- shop-info-content -->
							<div class="col-md-8">
								<!-- title -->
								<div class="caption top-caption">
									<h2><?php echo $taxonomy->name; ?></h2>
								</div>
								<!-- .title -->

								<!-- shop-info-text -->
								<div class="text">
									<p><?php echo $taxonomy->description; ?></p>
								</div>
								<!-- .shop-info-text -->

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

					<!-- computers-items -->
					<div class="featured-container col-md-12">
						<?php if( $main_query->have_posts() ): ?>
							<!-- first-row -->
							<div class="row">						
							<?php $counter = 0; ?>
							<?php while( $main_query->have_posts() ): ?>
								<?php
								$main_query->the_post();
								include(locate_template( 'includes/code_list_loop.php' ));
								?>
							<?php endwhile; ?>
							</div>
							<!-- .first-row -->
						<?php endif; ?>

					</div>
					<!-- .computers-items -->
					
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
				<!-- .row -->
			</div>
			<!-- .container -->

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
<?php 
wp_reset_query();
get_template_part( 'includes/shop_carousel' );
get_footer(); 
?>