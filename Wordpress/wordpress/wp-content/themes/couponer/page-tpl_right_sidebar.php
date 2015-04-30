<?php
/*
	Template Name: Page With Right Sidebar
*/
get_header();
the_post();
get_template_part( 'includes/inner_header' );
?>
<section class="shop-single">

	<!-- container -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="caption category-caption">
					<h2><?php echo coupon_page_title(); ?></h2>
					<p><?php echo coupon_page_subtitle(); ?></p>
					<div class="line-divider">
						<span class="line-mask green-bg"></span>
					</div>
				</div>
			</div>
		</div>
	
		<!-- row -->
		<div class="row">

			<!-- single-shop-container -->
			<div class="col-md-9 main_content page_content">				<!-- row -->
				<?php the_content(); ?>
			</div>


			<!-- sidebar -->
			<div class="col-md-3">
				<?php get_sidebar( 'right_blog' ); ?>
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