<?php
/*
	Template Name: Daily Offers
*/

get_header();
the_post();
get_template_part( 'includes/inner_header' );

$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page

$args =array( 
	'post_type' 	=> 'daily_offer',
	'meta_key' 		=> 'offer_expire',
	'orderby'		=> 'meta_value_num',
	'post_status'	=> 'publish',
	'order'			=> 'DESC',
	'posts_per_page'=> coupon_get_option('daily_offers_per_page'),
	'paged' 		=> $cur_page,
	's'				=> get_query_var('s'),
	'meta_query'   => array(
		array(
			'key' => 'offer_expire',
			'value' => time(),
			'compare' => '>'
		)
	)
);	
$main_query = new WP_Query( $args );


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

?>
<section class="category">

        <!-- container -->
        <div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="caption category-caption <?php $content = get_the_content(); echo empty( $content ) ? '' : 'bottom-margin' ?>">
						<h2><?php echo coupon_page_title(); ?></h2>
						<p><?php echo coupon_page_subtitle(); ?></p>
						<div class="line-divider">
							<span class="line-mask green-bg"></span>
						</div>
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-md-12 main_content">
					<?php the_content(); ?>
				</div>
			</div>
            <!-- row -->
            <div class="row">

                <!-- single-shop-container -->
                <div class="col-md-<?php echo is_active_sidebar('sidebar-right') ? '9' : '12' ?>">

                    <!-- row -->
                    <div class="row">

                        <!-- shop-info -->
                        <div class="shop-info">

                        <!-- computers-items -->
                        <div class="featured-container col-md-12">
							<?php if( $main_query->have_posts() ): ?>
								<?php 
								$counter = 0; 
								$max_count = is_active_sidebar('sidebar-right') ? 3 : 4;
								$col_md = is_active_sidebar('sidebar-right') ? 4 : 3;
								?>
								<!-- first-row -->
								<div class="row">
									<?php while( $main_query->have_posts() ): ?>
										<?php
										$main_query->the_post();
										include( locate_template( 'includes/content-daily_offer.php' ) );
										?>
										<!-- .item-1 -->
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
						</div>
						<!-- .first-row -->

					</div>
					<!-- .computers-items -->
					
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
				
				<!-- sidebar -->
				<div class="col-md-3">
					<?php get_sidebar( 'right' ); ?>
				</div>
				<!-- .sidebar -->				
				
			</div>
			<!-- .container -->


		</div>
		<!-- .row -->
	</div>
	<!-- .container -->

</section>
<?php
get_template_part( 'includes/shop_carousel' );
wp_reset_query();
get_footer();
?>