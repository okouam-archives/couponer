<?php 
if ( is_active_sidebar( 'sidebar-bottom-1' ) || is_active_sidebar( 'sidebar-bottom-2' ) || is_active_sidebar( 'sidebar-bottom-3' ) || is_active_sidebar( 'sidebar-bottom-4' ) ){
	?>
	<!-- footer -->
	<section class="footer">

		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-3">
					<?php dynamic_sidebar( 'sidebar-bottom-1' ); ?>
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar( 'sidebar-bottom-2' ); ?>
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar( 'sidebar-bottom-3' ); ?>
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar( 'sidebar-bottom-4' ); ?>
				</div>
			</div>
		</div>
	</section>
	<!-- .footer -->
<?php
}
?>