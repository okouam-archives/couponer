<?php
/*
	Template Name: FAQ
*/
get_header();
the_post();
get_template_part( 'includes/inner_header' );
$main_query = new WP_Query(
	array(
		'posts_per_page'	=> -1,
		'post_type'		=> 'faq',
		'post_status' => 'publish'
	)
);

?>
    <!-- =====================================================================================================================================
                                                        F A Q
====================================================================================================================================== -->
<section class="faq">
    
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
	
	<div class="row">
	<?php if( $main_query->have_posts() ): ?>
		<?php $counter = 0; ?>
		<div class="col-md-12">
			<div class="panel-group" id="accordion">
				<?php while( $main_query->have_posts() ): ?>		
					<div class="panel panel-default">
						<?php $main_query->the_post(); ?>
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $counter; ?>">
									<?php the_title(); ?>
								</a>
							</h4>
						</div>
						<div id="collapse_<?php echo $counter; ?>" class="panel-collapse collapse <?php echo $counter == 0 ? 'in' : ''; ?>">
							<div class="panel-body main_content">
								<?php the_content(); ?>
							</div>
						</div>
						<?php $counter++; ?>						
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	<?php endif; ?>
</div>

</section>
<?php
get_template_part( 'includes/shop_carousel' );
wp_reset_query();
get_footer();
?>