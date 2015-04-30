<?php
/*
	Template Name: Password Recovery
*/
if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	if(!wp_verify_nonce($_POST['recover_field'], 'recover')){
		$confirmation_message = array(
			'icon' 		=> 'fa-times-circle-o',
			'title'		=> __( 'Illegal action', 'coupon' ),
			'message'	=> __( 'Sorry, but this request is invalid.', 'coupon' ),
		);	
	}
	else{
		$email = esc_sql( $_POST['email'] );
		if( !is_email( $email ) ) {
			$error = __( 'Email is invalid', 'coupon' );
		} 
		elseif( email_exists( $email ) ) {
			$user = get_user_by( 'email', $email );
			$new_password = coupon_random_string();
			$update_fields = array(
				'ID' 			=> $user->ID,
				'user_pass'		=> $new_password,
			);
			
			$update_id = wp_update_user( $update_fields );
		
			$subject = coupon_get_option( 'site_name' ).' | '.__( 'Login Credentials', 'coupon' );
			$headers   = array();
			$headers[] = "MIME-Version: 1.0";
			$headers[] = "Content-Type: text/html; charset=ISO-8859-1";	
			$headers[] = "From: NAME <EMAIL>";	
			
			$lost_pass_message = coupon_get_option('lost_password_message');
			
			$message = str_replace( "%USERNAME%", $user->user_login, $lost_pass_message );
			$message = str_replace( "%PASSWORD%", $new_password, $message );
			
			$message_info = mail( $email, $subject, $message, implode( "\r\n",$headers ) );
			
			if( $message_info === true ){
				$confirmation_message = array(
					'icon' 		=> 'envelope',
					'title'		=> __( 'Credentials sent', 'coupon' ),
					'message'	=> __( 'Your username and new password have been sent to your email.', 'coupon' ),
				);
			}
			else{
				$confirmation_message = array(
					'icon' 		=> 'times-circle-o',
					'title'		=> __( 'Email sending failed', 'coupon' ),
					'message'	=> __( 'Could not send credentials to you, try again!', 'coupon' ),
				);
			}
		}
		else{
			$confirmation_message = array(
				'icon' 		=> 'times-circle-o',
				'title'		=> __( 'Wrong email', 'coupon' ),
				'message'	=> __( 'There is no registered user with that email!', 'coupon' ),
			);		
		}
	}
}

get_header();
the_post();
get_template_part( 'includes/inner_header' );

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
								<h2><span class="green"><i class="fa fa-<?php echo $confirmation_message['icon']; ?>"></i></span> <?php echo $confirmation_message['title']; ?></h2>
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
<section class="password-forgot">

	<div class="container">
		<div class="row">
			
			<div class="col-md-12">
			  <div class="register clearfix pass-register pass-padding"> 
			  
				 <!-- title -->
				 <div class="caption pass-caption text-center">
					<h2><span class="green"><i class="fa fa-envelope-o"></i></span> <?php _e( 'Please enter your email below', 'coupon' ); ?></h2>
					<form method="post" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" class="sidebar-newsletter">
						<?php wp_nonce_field('recover','recover_field'); ?>
						<fieldset>
							<div class="form-group">
								<input class="form-control-custom" type="text" name="email" placeholder="<?php _e( 'Type your email...', 'coupon' ) ?>" data-required="true" data-validations="email" data-error="<?php esc_attr_e( 'Email is invalid', 'coupon' ); ?>"/>
							</div>
							<input type="submit" class="btn-custom btn-full btn-pass" value="<?php _e( 'Recover Password', 'coupon' ); ?>" />
						</fieldset>
					</form>
				 </div>
				 <!-- .title --> 
				 
			  </div>
			</div>

		</div>
	</div>
</section>
<?php
} /* end if confirmaion message */
get_template_part( 'includes/shop_carusel' );
get_footer();
?>