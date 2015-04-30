<?php
/*
	Template Name: Code Search
*/
get_header();
the_post();
get_template_part( 'includes/inner_header' );
$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page
$search_per_page = coupon_get_option( 'search_per_page' );

if( !isset( $_GET['start_range'] ) ){
	$_GET['start_range'] = 0;
}
if( !isset( $_GET['end_range'] ) ){
	$_GET['end_range'] = 999999999;
}
if( !isset( $_GET['code_category'] ) ){
	$_GET['code_category'] = '';
}
if( !isset( $_GET['code_shop_id'] ) ){
	$_GET['code_shop_id'] = '';
}
if( !isset( $_GET['coupon_label'] ) ){
	$_GET['coupon_label'] = '';
}

$args = array(
	'post_type'		=> 'code',
	'post_status'	=> 'publish',
	'posts_per_page'=> $search_per_page,
	'meta_key'		=> 'code_expire',
	'orderby'		=> 'meta_value_num',
	'order'			=> 'DESC',
	'paged' 		=> $cur_page,
	'meta_query'	=> array(
		'relation'	=> "AND",
		array(
			'key' => 'code_for',
			'value' => 'all_users',
			'compare' => '='
		),		
		array(
			'key' => 'code_expire',
			'value' => time() + 86400 * $_GET['start_range'],
			'compare' => '>='
		),
		array(
			'key' => 'code_expire',
			'value'	=> time() + 86400 * $_GET['end_range'],
			'compare'	=> '<='
		)
	)
);

if( !empty( $_GET['code_category'] ) ){
	$args['code_category'] = $_GET['code_category'];
}

if( !empty( $_GET['code_shop_id'] ) ){
	$args['meta_query'][] = array(
		'key' => 'code_shop_id',
		'value' => $_GET['code_shop_id'],
		'compare' => '='
	);
}

if( !empty( $_GET['coupon_label'] ) ){
	$args['meta_query'][] = array(
		'key' => 'coupon_label',
		'value' => $_GET['coupon_label'],
		'compare' => '='
	);
}

$main_query = new WP_Query($args);

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
		'add_args' => array(
			'start_range' => $_GET['start_range'],
			'end_range' => $_GET['end_range'],
			'code_category' => $_GET['code_category'],
			'code_shop_id' => $_GET['code_shop_id'],
			'coupon_label' => $_GET['coupon_label'],
		)
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