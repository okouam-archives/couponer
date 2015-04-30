<?php
/*
	Template Name: Contact Page
*/
get_header();
the_post();
get_template_part( 'includes/inner_header' );
?>
<!-- =====================================================================================================================================
													C O N T A C T
====================================================================================================================================== -->
<section class="contact">

	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<div class="caption category-caption">
					<h2><?php echo coupon_page_title(); ?></h2>
					<p><?php echo coupon_page_subtitle() ?></p>
					<div class="line-divider">
						<span class="line-mask green-bg"></span>
					</div>
				</div>
			</div>


			<div class="col-md-12">
				<div class="row">

					<div class="col-md-6">
						<div class="register clearfix">

							<!-- title -->
							<div class="caption contact-caption">
								<h2>
									<span class="green"><i class="fa fa-envelope-o"></i>
									</span><?php echo coupon_get_option( 'contact_form_title' ); ?></h2>
							</div>
							<!-- .title -->

							<!-- form -->
							<div class="form register-form">
								<div class="send_result"></div>
								<form action="" method="" class="contact_form">
									<fieldset>
										<div class="form-group">
											<label><?php _e( 'Your name', 'coupon' ); ?></label>
											<input type="text" class="form-control form-control-custom" name="name">
										</div>
										<div class="form-group">
											<label><?php _e( 'Your email', 'coupon' ) ?></label>
											<input type="email" class="form-control form-control-custom" name="email">
										</div>
										<div class="form-group">
											<label><?php _e( 'Subject', 'coupon' ) ?></label>
											<input type="text" class="form-control form-control-custom" name="subject">
										</div>
										<div class="form-group">
											<label><?php _e( 'Message', 'coupon' ) ?></label>
											<textarea class="form-control form-control-custom message-control" name="message"></textarea>
										</div>
										<div class="clearfix">
											<button type="button" class="btn btn-custom btn-default send_contact"><?php _e( 'Send Message', 'coupon' ) ?></button>
										</div>
									</fieldset>
								</form>
							</div>
							<!-- .form -->

						</div>
					</div>

					<div class="col-md-6 main_content">
						<?php the_content(); ?>
					</div>

				</div>
			</div>


		</div>
	</div>

</section>
<?php
get_template_part( 'includes/shop_carousel' );
get_footer();
?>