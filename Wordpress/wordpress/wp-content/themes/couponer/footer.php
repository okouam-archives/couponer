<!-- =====================================================================================================================================
													F O O T E R
====================================================================================================================================== -->
<?php get_sidebar(); ?>
<!-- =====================================================================================================================================
													C O P Y R I G H T S
====================================================================================================================================== -->
<!-- copyrights -->
<section class="copyright">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- copy -->
			<div class="col-md-4">
				<div class="navbar-header">
					<small><?php echo coupon_get_option( 'copyright_text' ); ?></small>
				</div>
			</div>
			<!-- .copy -->

			<!-- bottom-nav -->
			<div class="footer-nav col-md-8">
				<nav class="navbar navbar-default collapsed bottom-nav" role="navigation">
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">					
						<ul class="nav navbar-nav">
							<?php
							if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'top-navigation' ] ) ) {
								wp_nav_menu( array(
									'theme_location'  	=> 'top-navigation',
									'menu_class'        => 'nav navbar-nav',
									'echo'          	=> true,
									'container'			=> false,
									'items_wrap'        => '%3$s',
									'depth'         	=> 1,
									'walker' 			=> new coupon_walker
								) );
							}
							?>
						</ul>
					</div>
				</nav>
				<!-- .navbar-collapse -->
			</div>
			<!-- .bottom-nav -->

		</div>
		<!-- .row -->
	</div>
	<!-- .container -->

</section>
<!-- .copyrights -->
<!-- =====================================================================================================================================
													M O D A L
====================================================================================================================================== -->
<!-- modal -->
<div class="modal fade in" id="showCode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog">
		<div class="modal-content showCode-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<div class="row">
					<div class="col-md-6">
						<?php 
							$logo_url = coupon_get_option( 'top_bar_logo' ); 
							if( !empty( $logo_url ) ):	
						?>
							<img src="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( coupon_get_option('site-name') ); ?>" alt="<?php echo esc_attr( coupon_get_option('site-name') ); ?>"/>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class="col-md-4">
						<img src="" class="modal_image" />
					</div>
					<div class="modal-caption col-md-8">
						<h3 class="modal_title"></h3>
						<p class="modal_text"></p>
					</div>
				</div>
				<hr>
				<div class="coupon-modal">
					<div class="row">
						<div class="modal-code col-md-12">
							<!-- coupon-box-button-replace -->
							<p data-toggle="modal" class="modal_code btn-custom btn-top btn-shop btn-default code-replace btn-lg "></p>
							<p class="is_copied" data-text="<?php _e( 'Code is copied', 'coupon' ); ?>"></p>
							<!-- .coupon-box-button-replace -->
						</div>
					</div>
				</div>

			</div>

			<hr>

		</div>
	</div>
</div>
<!-- .modal -->
<?php wp_footer() ?>
</body>
</html>