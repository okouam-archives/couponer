<?php
/*
	Template Name: Page Home
*/
get_header();
$home_group = (array)coupon_get_option( 'home_groups' );
?>
<!-- =====================================================================================================================================
													S C R E E N
====================================================================================================================================== -->
<!-- screen -->
<section class="screen">

	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- screen-content -->
			<div class="screen-content home-screen clearfix">

				<!-- slogan -->
				<div class="slogan col-md-12">
					<h1><?php echo get_bloginfo( 'description', 'display' ); ?></h1>
					<p class="center-block">
						<?php echo coupon_get_home_subtitle(); ?>
					</p>
				</div>
				<!-- .slogan -->
				<?php 
				$filters = coupon_get_option( 'ajax_categories' );
				if( $filters == 'yes' ){
				?>
					<!-- filters -->
					<div class="filters col-md-8 col-md-offset-2 col-sm-12">

						<!-- shop-search -->
						<form class="form-horizontal search-coupon" role="search">
							<div class="form-group has-feedback">
								<span class="fa fa-search form-control-feedback icon-left"></span>
								<input type="text" name="search_<?php echo coupon_confirm_hash() ?>" id="search_<?php echo coupon_confirm_hash() ?>" class="form-control ajax_search" id="inputSuccess3" placeholder="<?php esc_attr_e( 'Type shop name', 'coupon' ); ?>">
								<span class="fa fa-angle-down form-control-feedback"></span>
							</div>
							<div class="ajax_search_results">
								<ul class="list-unstyled">
								<ul>
							</div>
						</form>
						<!-- .shop-search -->

						<!-- categories-dropdown-buton -->
						<div class="btn-group btn-categories form-control">
							<button type="button" class="btn btn-categories btn-default btn-default btn-lg dropdown-toggle form-control" data-toggle="dropdown">
								<span class="fa fa-bars btn-left-icon"></span><?php _e( 'Categories', 'coupon' ) ?>
								<span class="fa fa-angle-down pull-right categories-angle-icon"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<?php coupon_list_categories(); ?>
							</ul>
						</div>
						<!-- .categories-dropdown-buton -->

					</div>
					<!-- .filters -->
				<?php
				}
				?>

			</div>
			<!-- .screen-content -->

			<!-- filter-tabs -->
			<div class="col-md-12">
				<div class="filter-tabs">
					<ul class="nav nav-tabs list-unstyled list-inline">
						<?php if( in_array( 'feature', $home_group ) ):?>
							<li class="active"><a href="#feature" data-toggle="tab"><?php _e( 'Featured', 'coupon' ) ?> <i class="fa fa-angle-down pull-right"></i></a></li>
						<?php endif; ?>
						<?php if( in_array( 'popular', $home_group ) ):?>
							<li><a href="#popular" data-toggle="tab"><?php _e( 'Popular', 'coupon' ) ?> <i class="fa fa-angle-down pull-right"></i></a></li>
						<?php endif; ?>
						<?php if( in_array( 'daily', $home_group ) ):?>
							<li><a href="#daily" data-toggle="tab"><?php _e( 'Daily Offers', 'coupon' ) ?> <i class="fa fa-angle-down pull-right"></i></a></li>
						<?php endif; ?>
						<?php if( in_array( 'latest', $home_group ) ):?>
							<li><a href="#latest" data-toggle="tab"><?php _e( 'Latest', 'coupon' ) ?> <i class="fa fa-angle-down pull-right"></i></a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
			<!-- .filter-tabs -->

		</div>
		<!-- .row -->
	</div>
	<!-- .container -->

</section>
<!-- .screen -->
<!-- =====================================================================================================================================
													F E A T U R E D
====================================================================================================================================== -->
<!-- featured -->
<section class="featured">

	<!-- container -->
	<div class="container">

		<!-- row -->
		<div class="row">


			<!-- tab-content -->
			<div class="tab-content">
				<?php if( in_array( 'feature', $home_group ) ):?>
					<!-- featured-elements -->
					<div class="tab-pane fade in active" id="feature">
						<!-- feature-container-first -->
						<div class="featured-container col-md-12">

							<!-- first-row -->
							<div class="row">
								<?php
								$featured_codes = coupon_get_list( 'feature' ); 
								coupon_home_list( $featured_codes );
								?>
							</div>
							<!-- .first-row -->
						</div>
						<!-- .feature-container-first -->
					</div>
					<!-- .featured-elements -->
				<?php endif; ?>

				<?php if( in_array( 'popular', $home_group ) ):?>
					<!-- popular-elements -->
					<div class="tab-pane fade in clearfix" id="popular">

						<!-- feature-container-first -->
						<div class="featured-container col-md-12">

							<!-- first-row -->
							<div class="row">
								<?php
								$popular_sort = coupon_get_option('popular_sort');
								if( $popular_sort == 'ratings' ){
									$popular_codes = coupon_get_list( 'ratings' );
								}
								else{
									$popular_codes = coupon_get_list( 'clicks' );
								}
								coupon_home_list( $popular_codes );
								?>
							</div>
							<!-- .first-row -->

						</div>
						<!-- .feature-container-first -->

					</div>
					<!-- .popular-elements -->
				<?php endif; ?>

				<?php if( in_array( 'daily', $home_group ) ):?>
					<!-- latest-elements -->
					<div class="tab-pane fade in" id="daily">

						<!-- feature-container-first -->
						<div class="featured-container col-md-12">

							<!-- first-row -->
							<div class="row">
								<?php
								coupon_get_daily_list();
								?>
							</div>
							<!-- .first-row -->

						</div>
						<!-- .feature-container-first -->

					</div>
					<!-- .latest-elements -->
				<?php endif; ?>
				
				<?php if( in_array( 'latest', $home_group ) ):?>
					<!-- newest-elements -->
					<div class="tab-pane fade in" id="latest">

						<!-- feature-container-first -->
						<div class="featured-container col-md-12">

							<!-- first-row -->
							<div class="row">
								<?php
								$newest_codes = coupon_get_list( 'date' ); 
								coupon_home_list( $newest_codes );
								?>
							</div>
							<!-- .first-row -->

						</div>
						<!-- .feature-container-first -->

					</div>
					<!-- .newest-elements -->
				<?php endif; ?>


			</div>
			<!-- .tab-content -->

		</div>
		<!-- .row -->
	</div>
	<!-- .container -->
</section>
<!-- .featured -->
<!-- =====================================================================================================================================
													S P E C I A L
====================================================================================================================================== -->
<!-- special -->
<?php
$promo_category = coupon_get_option( 'home_promo_cat' );
if( !empty( $promo_category ) ){
	$category = get_term( $promo_category, 'code_category' );
	if( !empty( $category ) ):
		$cats_num = coupon_get_option( 'home_promo_cat_num' );
		$children = get_terms( 'code_category', array( 'hide_empty' => 0, 'parent' => $promo_category, 'number' => $cats_num ) );
		?>
		<section class="special <?php echo !empty( $children ) ? 'no-bottom-padding' : ''; ?>">

			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- title-column -->
					<div class="special-box col-md-3">
						<div class="caption special-caption">
							<h2><?php echo $category->name; ?></h2>
						</div>
						<div class="line-divider">
							<span class="line-mask green-bg"></span>
						</div>
						<p><?php echo $category->description; ?></p>
						<a href="<?php echo esc_url( coupon_get_permalink_by_tpl( 'page-tpl_categories' ) ); ?>" class="btn btn-custom btn-default btn-lg">
							<?php _e( 'See All', 'coupon' ); ?>
						</a>
					</div>
					<!-- .title-column -->
					
					<div class="col-md-9">
						<?php
						if( !empty( $children ) ):
						$counter = 0;
						?>
						<div class="row category-row">
							<?php 
							foreach( $children as $child ): 
								$term_meta = get_option( "taxonomy_".$child->term_id );
								$icon = !empty( $term_meta['category_icon'] ) ? $term_meta['category_icon'] : '';
								if( $counter == 3 ){
									$counter = 0;
									?>
									</div>
									<div class="row category-row">
									<?php
								}
								$counter++;
							?>
								<!-- element-column -->
								<div class="special-item col-md-4">
									<a href="<?php echo esc_url( get_term_link( $child->slug, 'code_category' ) ) ?>">
										<div class="special-item-inner">
											<div class="special-icon">
												<span class="fa fa-<?php echo $icon; ?>"></span>
												<h3><?php echo $child->name; ?></h3>
											</div>
										</div>
									</a>
								</div>
								<!-- .element-column -->
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<!-- .row -->
			</div>
			<!-- .container -->
		</section>
	<?php
	endif;
}
?>
<!-- .special -->

<!-- =====================================================================================================================================
													B L O G  L A T E S T
====================================================================================================================================== -->
<!-- blog -->
<?php 
$latest_blogs_num = coupon_get_option( 'home_latest_blogs' );
if( $latest_blogs_num > 0 ):
?>
	<section class="blog">

		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- title -->
				<div class="title blog-title col-md-12">
					<h2><?php _e( 'Blog Latest', 'coupon' ) ?></h2>
					<div class="line-divider">
						<span class="line-mask green-bg"></span>
					</div>
				</div>
				<!-- .title -->
			</div>
							
				<?php
				
				$blogs = new WP_Query(array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => $latest_blogs_num
				));
				if( $blogs->have_posts() ):
					?>
					<div class="row">
					<?php
					$counter = 0;
					while( $blogs->have_posts() ):
						$blogs->the_post();
						switch( get_post_format() ){
							case 'aside' : $icon = 'edit'; break;
							case 'gallery' : $icon = 'file-picture-o'; break;
							case 'link' : $icon = 'external-link'; break;
							case 'image' : $icon = 'image'; break;
							case 'quote' : $icon = 'quote-right'; break;
							case 'status' : $icon = 'user'; break;
							case 'video' : $icon = 'video-camera'; break;
							case 'audio' : $icon = 'music'; break;
							case 'chat' : $icon = 'wechat'; break;
							default: $icon = 'plus-square-o';
						}
						if( $counter == 3 ){
							?>
							</div>
							<div class="row">
							<?php
						}
						?>
						<!-- blog-post-1 -->
						<div class="blog-post col-md-4">
							<!-- blog-inner -->
							<div class="blog-inner blog-inner-home">
								<!-- blog-top-icon -->
								<a href="<?php the_permalink() ?>">
									<div class="blog-icon-mask green-bg">
										<i class="fa fa-<?php echo $icon; ?>"></i>
									</div>
								</a>
								<!-- .blog-top-icon -->

								<!-- blog-image -->
								<?php if( has_post_thumbnail() ): ?>
									<div class="blog-image">
										<?php the_post_thumbnail( 'blog_latest', array( 'class' => 'img-responsive' ) ); ?>
									</div>
								<?php endif; ?>
								<!-- .blog-image -->

								<!-- blog-content -->
								<div class="blog-content">
									<h4><?php the_title() ?></h4>
									<?php the_excerpt() ?>
								</div>
								<!-- .blog-content -->

								<!-- blog-meta -->
								<div class="item-meta">
									<ul class="list-inline list-unstyled">
										<li>
											<a href="javascript:;">
												<span class="fa fa-clock-o"></span><?php the_time( 'F j, Y' ); ?></a>
										</li>
										<li class="pull-right">
											<a href="<?php the_permalink(); ?>">
												<span class="fa fa-plus-square"></span>
											</a>
										</li>
									</ul>
								</div>
								<!-- .blog-meta -->
							</div>
							<!-- .blog-inner -->
						</div>
						<!-- .blog-post-1 -->
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
			</div>
			<!-- .row -->
		</div>
		<!-- .container -->

	</section>
	<!-- .blog -->
<?php endif; ?>
<?php get_template_part( 'includes/shop_carousel' ); ?>
<?php
wp_reset_query();
get_footer();
?>
