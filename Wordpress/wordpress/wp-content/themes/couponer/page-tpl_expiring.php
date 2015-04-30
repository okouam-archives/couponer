<?php
/*
	Template Name: Expiring
*/

get_header();
the_post();
get_template_part( 'includes/inner_header' );

/* grab fetured */
$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page
$expiring_per_page = coupon_get_option( 'expiring_per_page' );
$main_query = new WP_Query(array(
	'post_type' 	=> 'code',
	'meta_key' 		=> 'code_expire',
	'orderby'		=> 'meta_value_num',
	'post_status' 	=> 'publish',
	'order'			=> 'ASC',
	'posts_per_page'=> $expiring_per_page,
	'paged' 		=> $cur_page,
	'meta_query'	=> array(
		'relation'  => 'AND',
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
		'type' => 'array',
	)
);
$pagination = coupon_format_pagination( $page_links );
?>
<section class="shop-single">

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
					<?php 
					$show_logo = true;
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
get_template_part( 'includes/shop_carousel' );
get_footer();
?>