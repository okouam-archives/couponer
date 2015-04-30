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
			<div class="screen-content clearfix">

				<!-- slogan -->
				<div class="slogan col-md-12">
					<h1>
						<?php 
							if ( is_category() ){
								single_cat_title();
							}
							else if( is_404() ){
								echo __('404 Nothing Found', 'coupon'); 
							}
							else if( is_tax() ){
								$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
								echo __('Code Category: ', 'coupon'). $term->name; 
							}
							else if( is_tag() ){
								echo __('Search by tag: ', 'coupon'). get_query_var('tag'); 
							}
							else if( is_author() ){
								echo __('Profile', 'coupon'); 
							}						
							else if( is_archive() ){
								echo __('Archive for:', 'coupon'). single_month_title(' ',false); 
							}
							else if( is_search() ){ 
								echo __('Search results for: ', 'coupon').' '. get_search_query();
							}
							else if( is_front_page() || is_home()){
								echo get_bloginfo( 'description', 'display' );
							}
							else{
								echo get_the_title();
							}?>						
					</h1>
					<p class="center-block">
						<?php 
							echo coupon_get_home_subtitle();
						?>
					</p>
				</div>
				<!-- .slogan -->
				<?php 
				$filters = coupon_get_option( 'ajax_categories' );
				if( $filters == 'yes' ){
				?>
					<!-- filters -->
					<div class="filters col-md-12">

						<!-- shop-search -->
						<div class="col-md-6">
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
						</div>
						<!-- .shop-search -->

						<!-- categories-dropdown-buton -->
						<div class="col-md-6">
							<div class="btn-group btn-categories form-control">
								<button type="button" class="btn btn-categories btn-default btn-default btn-lg dropdown-toggle form-control" data-toggle="dropdown">
									<span class="fa fa-bars btn-left-icon"></span><?php _e( 'Categories', 'coupon' ) ?>
									<span class="fa fa-angle-down pull-right categories-angle-icon"></span>
								</button>
								<ul class="dropdown-menu dd-custom dd-widget" role="menu">
									<?php coupon_list_categories(); ?>
								</ul>
							</div>
						</div>
						<!-- .categories-dropdown-buton -->

					</div>
					<!-- .filters -->
				<?php
				}
				?>

			</div>
			<!-- .screen-content -->

		</div>
		<!-- .row -->
	</div>
	<!-- .container -->

</section>
<!-- .screen -->