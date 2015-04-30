<?php
/*
	Template Name: Submit Coupon
*/
session_start();
echo '<div></div>';
get_header();
the_post();
get_template_part( 'includes/inner_header' );

$required_aditional_fields = (array)coupon_get_option( 'required_aditional_fields' );
global $error_labels;
$registered = false;
if ( is_user_logged_in() ){
	$registered = true;
}
if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$errors = array();
	if(!wp_verify_nonce($_POST['submit_field'], 'submit')){
		$errors['nonce'] = $error_labels['nonce'];
	}
	else{
		
		$email_info = coupon_get_option( 'new_code_email' );
		$title = esc_sql( $_POST['title'] );
		$shop_link = esc_sql( $_POST['shop_link'] );
		$coupon_label = esc_sql( $_POST['coupon_label'] );
		$coupon_code = esc_sql( $_POST['coupon_code'] );
		$content = esc_sql( $_POST['content'] );
		$code_expire = esc_sql( $_POST['code_expire'] );
		$captcha = esc_sql( $_POST['captcha'] );
		
		$code_conditions = esc_sql( $_POST['code_conditions'] );
		$code_discount = esc_sql( $_POST['code_discount'] );
		$code_text = esc_sql( $_POST['code_text'] );
		$code_for = esc_sql( $_POST['code_for'] );
		
		if( in_array( 'code_conditions', $required_aditional_fields ) && empty( $code_conditions ) ){
			$errors['code_conditions'] = $error_labels['empty_conditions'];
		}
		if( in_array( 'code_discount', $required_aditional_fields ) && empty( $code_discount ) ){
			$errors['code_discount'] = $error_labels['empty_discount'];
		}
		if( in_array( 'code_text', $required_aditional_fields ) && empty( $code_text ) ){
			$errors['code_text'] = $error_labels['empty_text'];
		}
		
		if( empty( $title ) ){
			$errors['title'] = $error_labels['coupon_title'];
		}
		
		if( empty( $shop_link ) ){
			$errors['shop_link'] = $error_labels['shop_link'];
		}
		
		if( empty( $coupon_label ) ){
			$errors['coupon_label'] = $error_labels['coupon_label'];
		}
		else{
			if( $coupon_label == 'coupon' ){
				if( empty( $coupon_code ) ){
					$errors['empty_code'] = $error_labels['empty_code'];
				}
			}
		}
		
		if( in_array( 'content', $required_aditional_fields ) && empty( $content ) ){
			$errors['content'] = $error_labels['content'];
		}
		
		if( empty( $code_expire ) ){
			$errors['code_expire'] = $error_labels['expire'];
		}
		
		if( $captcha != $_SESSION['total'] ){
			$errors['captcha'] = $error_labels['captcha'];
		}
		
		if( count( $errors ) == 0 ) {
			
			$code_id = wp_insert_post(array(
				'post_title'    => $title,
				'post_content'  => $content,
				'post_status'   => 'pending',
				'post_type'		=> 'code'
			), false);
			
			if( $code_id ){
				update_post_meta( $code_id, 'pending_shop_url', $shop_link);
				update_post_meta( $code_id, 'coupon_label', $coupon_label);
				update_post_meta( $code_id, 'code_expire', strtotime( $code_expire ));
				update_post_meta( $code_id, 'code_conditions', $code_conditions );
				update_post_meta( $code_id, 'code_discount', $code_discount );
				update_post_meta( $code_id, 'code_text', $code_text );
				update_post_meta( $code_id, 'code_for', $code_for );
			
				if( $coupon_label == 'coupon' ){
					update_post_meta( $code_id, 'code_couponcode', $coupon_code);
				}
			}
			
			if( !empty( $email_info ) ){
				$message = "New code has been submited. Here are the details:\n\nCoupon name: {$title}\n\nShop URL: {$shop_link}\n\nCode type: {$coupon_label}\n\nContent: {$content}\n\nCode expire: {$code_expire}";
				$info = wp_mail( $email_info, __( 'New Code Submited', 'coupon' ), $message );
			}
			
			$confirmation_message = array(
				'icon' 		=> 'envelope',
				'title'		=> __( 'Code has been submited', 'coupon' ),
				'message'	=> __( 'After <span class="green">review</span> it will be accepted or declined!', 'coupon' ),
			);
		}		
	}
}
$captcha_new = coupon_captcha();

if( !empty( $confirmation_message ) ){
?>
<section class="password-forgot">

	<div class="container">
		<div class="row">
			
			<div class="col-md-12">
				<div class="row"> 
					<!-- register -->
					<div class="col-md-12">
						<div class="register clearfix pass-register"> 

							<!-- title -->
							<div class="caption pass-caption text-center">
								<h2><span class="green"><i class="fa fa-<?php echo $confirmation_message['icon']; ?>"></i></span> <?php echo esc_attr( $confirmation_message['title'] ); ?></h2>
								<h3><?php echo $confirmation_message['message']; ?></h3>
							</div>
							<!-- .title --> 
						   
						</div>
					</div>
					<!-- .register -->
				</div>
			</div>

		</div>
	</div>
</section>
<?php
}
else{
?>
<!-- =====================================================================================================================================
													C O N T A C T
====================================================================================================================================== -->
<section class="contact">

	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<div class="caption category-caption">
					<h2><?php echo coupon_page_title(); ?></span>
					</h2>
					<p><?php echo coupon_page_subtitle(); ?></p>
					<div class="line-divider">
						<span class="line-mask green-bg"></span>
					</div>
				</div>
			</div>


			<div class="col-md-12">
				<div class="row">

					<div class="col-md-6">
						<div class="register clearfix">

							<?php if( is_user_logged_in() ): ?>
							<!-- title -->
							<div class="caption contact-caption">
								<h2>
									<span class="green"><i class="fa fa-share"></i>
									</span><?php _e( 'Submit', 'coupon' ) ?></h2>
							</div>
							<!-- .title -->

							<!-- form -->
							<div class="form register-form">								
									<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
										<fieldset>
											<div class="form-group">
												<label><?php _e( 'Coupon Or Discount Name', 'coupon' ) ?></label>
												<input type="text" value="<?php echo !empty( $title ) ? esc_attr( $title ) : '' ?>" class="form-control form-control-custom" name="title" data-required="true" data-error="<?php echo $error_labels['coupon_title']; ?>">
											</div>									
											<div class="form-group">
												<label><?php _e( 'Store Website', 'coupon' ) ?></label>
												<input type="text" value="<?php echo !empty( $shop_link ) ? esc_url( $shop_link ) : '' ?>" class="form-control form-control-custom" name="shop_link" data-required="true" data-error="<?php echo $error_labels['shop_link']; ?>">
											</div>
											<div class="form-group clearfix">
												<label><?php _e( 'Offer Type', 'coupon' ) ?></label>
												<div class="btn-group btn-coupon-group form-group">
													<button type="button" class="btn btn-default btn-coupon code_type" data-value="coupon"><?php _e( 'Coupon', 'coupon' ) ?></button>
													<button type="button" class="btn btn-default btn-coupon code_type" data-value="discount"><?php _e( 'Discount', 'coupon' ) ?></button>
													<input type="hidden" value="<?php echo !empty( $coupon_label ) ? $coupon_label : '' ?>"  name="coupon_label" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['coupon_label']; ?>">
												</div>
											</div>
											<div class="form-group coupon_code_field">
												<label><?php _e( 'Coupon Code', 'coupon' ) ?></label>
												<input type="text" value="<?php echo !empty( $coupon_code ) ? esc_attr( $coupon_code ) : '' ?>" class="form-control form-control-custom" name="coupon_code" data-required="false" data-error="<?php echo $error_labels['empty_code']; ?>">
											</div>	
											 <div class="form-group">
												<label><?php _e( 'Coupon Or Discount Description', 'coupon' ) ?></label>
												<textarea class="form-control form-control-custom message-control" name="content" data-required="<?php echo in_array( 'content', $required_aditional_fields ) ? 'true' : 'false' ?>" data-error="<?php echo $error_labels['content']; ?>"><?php echo !empty( $content ) ? $content : '' ?></textarea>
											</div>
											 <div class="form-group">
												<label><?php _e( 'Coupon Or Discount Conditions', 'coupon' ) ?></label>
												<textarea class="form-control form-control-custom message-control" name="code_conditions" data-required="<?php echo in_array( 'code_conditions', $required_aditional_fields ) ? 'true' : 'false' ?>" data-error="<?php echo $error_labels['code_conditions']; ?>"><?php echo !empty( $content ) ? $content : '' ?></textarea>
											</div>
											<div class="form-group">
												<label><?php _e( 'Offer Text', 'coupon' ) ?></label>
												<input type="text" value="<?php echo !empty( $code_text ) ? esc_attr( $code_text ) : '' ?>" class="form-control form-control-custom" name="code_text" data-required="<?php echo in_array( 'code_text', $required_aditional_fields ) ? 'true' : 'false' ?>" data-error="<?php echo $error_labels['code_text']; ?>">
											</div>
											<div class="form-group">
												<label><?php _e( 'Offer Discount', 'coupon' ) ?></label>
												<input type="text" value="<?php echo !empty( $code_discount ) ? esc_attr( $code_discount ) : '' ?>" class="form-control form-control-custom" name="code_discount" data-required="<?php echo in_array( 'code_discount', $required_aditional_fields ) ? 'true' : 'false' ?>" data-error="<?php echo $error_labels['code_discount']; ?>">
											</div>
											<div class="form-group clearfix">
												<label><?php _e( 'Code For', 'coupon' ) ?></label>
												<div class="btn-group btn-coupon-group form-group">
													<button type="button" class="btn btn-default btn-coupon code_for btn-coupon-clicked" data-value="all_users"><?php _e( 'All Users', 'coupon' ) ?></button>
													<button type="button" class="btn btn-default btn-coupon code_for" data-value="members_only"><?php _e( 'Members Only', 'coupon' ) ?></button>
													<input type="hidden" value="all_users"  name="code_for" class="form-control form-control-custom">
												</div>
											</div>
											<div class="form-group">
												<label><?php _e( 'Expiration Date', 'coupon' ) ?></label>
												<input type="text" value="<?php echo !empty( $code_expire ) ? $code_expire : '' ?>"  name="code_expire" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['expire']; ?>" data-validations="date">
												<small class="info"><?php _e( 'Date must be in the form dd/mm/yyyy', 'coupon' ); ?></small>
											</div>
											<div class="form-group">
												<label><?php _e( 'Input Captcha', 'coupon' ) ?></label>
												<input type="text"  name="captcha" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['captcha']; ?>" placeholder="<?php echo $captcha_new['captcha']; ?>">
												<?php echo !empty( $errors['captcha'] ) ? '<small class="text-danger">'.$errors['captcha'].'</small>' : '' ?>
											</div>
											<div class="clearfix">
												<?php wp_nonce_field('submit','submit_field'); ?>
												<button type="submit" class="btn btn-custom btn-default"><?php _e( 'Submit Coupon', 'coupon' ); ?></button>
											</div>
										</fieldset>
									</form>
							</div>
							<!-- .form -->
							<?php else: ?>
								<!-- title -->
								<div class="caption contact-caption">
									<h2>
										<span class="green"><i class="fa fa-unlock"></i>
										</span><?php _e( 'Register To Submit Code', 'coupon' ) ?></h2>
								</div>
								<!-- .title -->
							<!-- form -->
							<div class="form register-form">								
								<a href="<?php echo esc_url( coupon_get_permalink_by_tpl( 'page-tpl_register_login' ) ) ?>" class="btn btn-custom btn-default"><?php _e( 'Register Here', 'coupon' ); ?></a>
							</div>								
							<?php endif; ?>
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
} /* end confirmation message */
get_template_part( 'includes/shop_carousel' );
get_footer();
?>