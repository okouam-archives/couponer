<?php
/*
Template Name: Register & Login Page
*/
session_start();
echo '<div></div>';
$can_login = coupon_get_option( 'membership' );

if ( is_user_logged_in() ){
	header( 'Location:' . home_url() );
}
global $error_labels;


if( $can_login == 'yes' ){
	if( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
		$errors = array();
		
		if( isset( $_GET['confirm'] ) && isset( $_GET['user'] ) ){
			$user = get_user_by( 'slug', $_GET['user'] );
			if( !empty( $user ) ){
				$user_meta = get_user_meta( $user->ID, 'coupon_user_meta' );
				$user_meta = array_shift( $user_meta );
				if( !empty( $user_meta['confirmation_hash'] ) ){
					if( $user_meta['confirmation_hash'] == $_GET['confirm'] ){
						$user_meta['confirmation_hash'] = "";
						$user_meta['active_status'] = 'active';
						
						update_user_meta( $user->ID, 'coupon_user_meta', $user_meta );
						
						$confirmation_message = array(
							'icon' 		=> 'lock',
							'title'		=> __( 'Memebership approved!', 'coupon' ),
							'message'	=> __( 'Thanks a lot for registering, now you are a member!', 'coupon' ),
						);
					}
					else{
						$confirmation_message = array(
							'icon' 		=> 'times-circle-o',
							'title'		=> __( 'Confirmation error!', 'coupon' ),
							'message'	=> __( "Confirmation code is not valid.", "coupon" )
						);
					}
				}
				else{
					$confirmation_message = array(
						'icon' 		=> 'times-circle-o',
						'title'		=> __( 'Confirmation error!', 'coupon' ),
						'message'	=> __( "Confirmation code is already used.", "coupon" )
					);			
					$errors['confirm'] = __( "Confirmation code is already used.", "coupon" );
				}
			}
			else{
				$confirmation_message = array(
					'icon' 		=> 'times-circle-o',
					'title'		=> __( 'Confirmation error!', 'coupon' ),
					'message'	=> __( "Username is invalid.", "coupon" )
				);
			}
		}
	}

	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		$errors = array();
		if( $_POST['action'] == 'register' ){
			if( get_option('users_can_register') ){
				if(!wp_verify_nonce($_POST['register_field'], 'register')){

					$errors['nonce'] = $error_labels['nonce'];

				}
				else{
					$captcha = esc_sql( $_POST['captcha'] );
					if( $captcha != $_SESSION['total'] ){
						$errors['captcha'] = $error_labels['captcha'];
					}
					/* Check first name  */
					$first_name = esc_sql($_POST['first_name']);
					if ( empty( $first_name ) ){ 
						$errors['first_name'] = $error_labels['first_name_empty'];
					}	

					/* Check alst name  */
					$last_name = esc_sql($_POST['last_name']);
					if ( empty( $last_name ) ){ 
						$errors['last_name'] = $error_labels['last_name_empty'];
					}
				
					/* Check username is present and not already in use */			
					$username = esc_sql($_POST['username']);
					if ( strpos($username, ' ') !== false ) { 
						$errors['reg_username'] = $error_labels['username_no_spaces'];
					}
					if(empty($username)) { 
						$errors['reg_username'] = $error_labels['username_empty'];
					} elseif( username_exists( $username ) ) {
						$errors['reg_username'] = $error_labels['username_exists'];
					}
			 
					/* Check email address is present and valid */
					$email = esc_sql($_POST['email']);
					if( !is_email( $email ) ) { 
						$errors['email'] = $error_labels['email_not_valid'];
					} elseif( email_exists( $email ) ) {
						$errors['email'] = $error_labels['email_in_use'];
					}
			 
					/* Check password is valid */
					$password = esc_sql($_POST['password']);
					if( 0 === preg_match( "/.{6,}/", $_POST['password'] ) ){
					  $errors['reg_password'] = $error_labels['password_length'];
					}
			 
					/* Check password confirmation_matches */
					$confirm_password = esc_sql($_POST['password_confirmation']);
					if( 0 !== strcmp( $password, $confirm_password ) ){
					  $errors['password_confirmation'] = $error_labels['password_mismatch'];
					}
			 
					/* Check city */
					$city = esc_sql($_POST['city']);
					if($city === ""){
						$errors['city'] = $error_labels['empty_city'];
					}
					
					/* Check gender */
					$gender = isset( $_POST['gender'] ) ? esc_sql( $_POST['gender'] ) : '';
					if($gender === ""){
						$errors['gender'] = $error_labels['empty_gender'];
					}
					
					/* Check age */
					$age = esc_sql($_POST['age']);
					if($age === ""){
						$errors['age'] = $error_labels['empty_age'];
					}
					
					
			 
					if(0 === count($errors)) {
			 
						$password = $_POST['password'];
			 
						$new_user_id = wp_create_user( $username, $password, $email );
						$user_meta = array(
							'city' 				=> $city,
							'gender' 			=> $gender,
							'age' 				=> $age,
							'active_status'		=> 'inactive',
							'subscribe'			=> 'yes',
							'avatar'			=> '',
							'confirmation_hash' => md5( coupon_confirm_hash( 100 ) )
						);
						
						coupon_send_subscription( $email, false );
						
						update_user_meta( $new_user_id, 'coupon_user_meta', $user_meta );
						update_user_meta( $new_user_id, 'first_name', $first_name );
						update_user_meta( $new_user_id, 'last_name', $last_name );
						
						$subject = coupon_get_option( 'site_name' ).' | '.__( 'Confirm Registration', 'coupon' );
						$headers   = array();
						$headers[] = "MIME-Version: 1.0";
						$headers[] = "Content-Type: text/html; charset=ISO-8859-1";
						$headers[] = "From: NAME <EMAIL>";
						
						$confirm_link = add_query_arg( array( 'confirm' => $user_meta["confirmation_hash"], 'user' => $username ), coupon_register_login_url() );
						
						$message = '';
						$message = str_replace( "%LINK%", $confirm_link, coupon_get_option('registration_message') );
						$message = "<html><body>".$message."</body></html>";
						
						$message_info = mail( $email, $subject, $message, implode( "\r\n",$headers ) );
						
						if( $message_info === true ){
							$confirmation_message = array(
								'icon' 		=> 'envelope',
								'title'		=> __( 'Confirmation email sent', 'coupon' ),
								'message'	=> __( 'Please <span class="theme-color">check your email and click registration link</span> in order to confirm your membership!', 'coupon' ),
							);
						}
						else{
							$confirmation_message = array(
								'icon' 		=> 'circle-o',
								'title'		=> __( 'Email sending failed', 'coupon' ),
								'message'	=> __( 'Could not send a confirmation email, try again!', 'coupon' ),
							);
						}
					}
				}
			}
			else{
				echo "Registration is disabled";
			}
		}
		else if( $_POST['action'] == 'login' ){
			if(!wp_verify_nonce($_POST['login_field'], 'login')){

				$errors['nonce'] = $error_labels['nonce'];

			}
			else{
				/*We shall SQL escape all inputs*/
				$username = esc_sql($_POST['username']);
				$password = esc_sql($_POST['password']);
				$remember = isset( $_POST['rememberme'] ) ? 'true' : 'false';	
				
				if( !empty( $username ) ){
					$user = get_user_by( 'slug', $username );
					if( !empty( $user ) ){
						$user_meta = get_user_meta( $user->ID, 'coupon_user_meta' );
						$user_meta = array_shift( $user_meta );
						if( $user_meta['active_status'] == 'active' || empty( $user_meta['active_status'] ) ){
						 
							$login_data = array();
							$login_data['user_login'] = $username;
							$login_data['user_password'] = $password;
							$login_data['remember'] = $remember;
							
							$user_verify = wp_signon( $login_data, false ); 
						 
							if ( is_wp_error($user_verify) ) 
							{
							   $errors['password'] = $error_labels['invalid_password'];
							} else {    
							   echo "<script type='text/javascript'>window.location='". home_url() ."'</script>";
							   exit();
							}
						}
						else{
							$confirmation_message = array(
								'icon' 		=> 'fa-envelope',
								'title'		=> __( 'Confirmation error', 'coupon' ),
								'message'	=> __( 'This account is still not activated. Please check your email, and click on the verification link!', 'coupon' ),
							);
						}
					}
					else{
						$errors['username'] = $error_labels['invalid_username'];
					}
				}
				else{
					$errors['username'] = $error_labels['invalid_username'];
				}
			}
		}	
	}
}
get_header();
the_post();
get_template_part( 'includes/inner_header' );
if( $can_login == 'no' ){
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
								<h2><span class="green"><i class="fa fa-unlock-alt"></i></span> <?php _e( 'Member login is disabled', 'coupon' ) ?></h2>
								<h3><?php _e( 'Member are currently not allowed to login by the administration', 'coupon' ) ?></h3>
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
else if( $can_login == 'yes' ){

?>
<!-- =====================================================================================================================================
													L O G I N
====================================================================================================================================== -->
<section class="login">

	<div class="container">
		<div class="row">

			<div class="container">
				<div class="row">

					<div class="col-md-12">
						<div class="caption category-caption <?php $content = get_the_content(); echo empty( $content ) ? '' : 'bottom-margin' ?>">
							<h2><?php echo coupon_page_title() ?></h2>
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
				<div class="col-md-12">
						<!-- register -->
						<?php if(get_option('users_can_register')): ?>
							<div class="col-md-6">
								<div class="register clearfix">

									<!-- title -->
									<div class="caption contact-caption">
										<h2>
											<span class="green"><i class="fa fa-unlock"></i>
											</span><?php _e( 'Register here', 'coupon' ) ?></h2>
									</div>
									<!-- .title -->

									<!-- form -->
									<div class="form register-form">
										<form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">
										   <fieldset>
											  <div class="form-group">
												 <label id="nemce"><?php _e( 'First name', 'coupon' ); ?></label>
												 <input type="text" value="<?php echo !empty( $first_name ) ? esc_attr( $first_name ) : '' ?>"  name="first_name" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['first_name_empty']; ?>">										 
												 <?php echo !empty( $errors['first_name'] ) ? '<small class="text-danger">'.$errors['first_name'].'</small>' : '' ?>
											  </div>
											  <div class="form-group">
												 <label><?php _e( 'Last name', 'coupon' ); ?></label>
												 <input type="text" value="<?php echo !empty( $last_name ) ? esc_attr( $last_name ) : '' ?>" name="last_name" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['last_name_empty']; ?>">
												 <?php echo !empty( $errors['last_name'] ) ? '<small class="text-danger">'.$errors['last_name'].'</small>' : '' ?>
											  </div>
											  <div class="form-group <?php echo !empty( $errors['email'] ) ? 'has-error' : ''?>">
												 <label><?php _e( 'Your email', 'coupon' ); ?></label>
												 <input type="text" value="<?php echo !empty( $email ) ? esc_attr( $email ) : '' ?>" name="email" class="form-control form-control-custom" data-required="true" data-validations="email" data-error="<?php echo $error_labels['email_not_valid']; ?>">
												 <?php echo !empty( $errors['email'] ) ? '<small class="text-danger">'.$errors['email'].'</small>' : '' ?>
											  </div>
											  <div class="form-group">
												 <label><?php _e( 'How old you are?', 'coupon' ); ?></label>
												 <input type="text" value="<?php echo !empty( $age ) ? esc_attr( $age ) : '' ?>" name="age" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['empty_age']; ?>">
												 <?php echo !empty( $errors['age'] ) ? '<small class="text-danger">'.$errors['age'].'</small>' : '' ?>
											  </div>
											  <label class="clearfix"><?php _e( 'Your Gender', 'coupon' ); ?></label>
											  <?php echo !empty( $errors['gender'] ) ? '<small class="text-danger">'.$errors['gender'].'</small>' : '' ?>
											  <br />
											  <br />
											  <div class="radio-inline">
												 <label>
													<input type="radio" name="gender" id="optionsRadios1" value="male" data-required="true" data-error="<?php echo $error_labels['empty_gender']; ?>" <?php echo !empty( $gender ) ? $gender == 'male' ? 'checked' : '' : ''; ?>>
													<?php _e( 'Male', 'coupon' ); ?> </label>
											  </div>
											  <div class="radio-inline">
												 <label>
													<input type="radio" name="gender" id="optionsRadios2" value="female" <?php echo !empty( $gender ) ? $gender == 'female' ? 'checked' : '' : ''; ?>>
													<?php _e( 'Female', 'coupon' ); ?> </label>
											  </div>
											  <div class="form-group">
												 <label><?php _e( 'Where do you live?', 'coupon' ); ?></label>
												 <input type="text" value="<?php echo !empty( $city ) ? esc_attr( $city ) : '' ?>" name="city" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['empty_city']; ?>">
												 <?php echo !empty( $errors['city'] ) ? '<small class="text-danger">'.$errors['city'].'</small>' : '' ?>
											  </div>
											  <div class="form-group <?php echo !empty( $errors['reg_username'] ) ? 'has-error' : '' ?>">
												 <label><?php _e( 'Choose username', 'coupon' ); ?></label>
												 <input type="text" value="<?php echo !empty( $username ) ? esc_attr( $username ) : '' ?>" name="username" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['username_empty']; ?>">
												 <?php echo !empty( $errors['reg_username'] ) ? '<small class="text-danger">'.$errors['reg_username'].'</small>' : '' ?>
											  </div>
											  <div class="form-group">
												 <label><?php _e( 'Choose password', 'coupon' ); ?></label>
												 <input type="password" name="password" class="form-control form-control-custom" data-required="true" data-validations="length" data-length="6" data-error="<?php echo $error_labels['password_length']; ?>">
												 <?php echo !empty( $errors['reg_password'] ) ? '<small class="text-danger">'.$errors['reg_password'].'</small>' : '' ?>
											  </div>
											  <div class="form-group">
												 <label><?php _e( 'Repeat password', 'coupon' ); ?></label>
												 <input type="password" name="password_confirmation" class="form-control form-control-custom" data-required="true" data-validations="pwd_match" data-compare="password" data-error="<?php echo $error_labels['password_mismach']; ?>">
												 <?php echo !empty( $errors['password_confirmation'] ) ? '<small class="text-danger">'.$errors['password_confirmation'].'</small>' : '' ?>
											  </div>
											  <div class="form-group">
												 <label><?php $captcha = coupon_captcha(); echo $captcha['captcha']; ?></label>
												 <input type="text" name="captcha" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['captcha']; ?>">
												 <?php echo !empty( $errors['captcha'] ) ? '<small class="text-danger">'.$errors['captcha'].'</small>' : '' ?>
											  </div>											  
											  <div class="clearfix">
												<?php wp_nonce_field('register','register_field'); ?>
												<input type="hidden" name="action" value="register">
												<button type="submit" class="btn btn-custom btn-default"><?php _e( 'Register', 'coupon' ); ?></button>
											  </div>
										   </fieldset>
										</form>
									</div>
									<!-- .form -->

								</div>
							</div>
						<?php endif; ?>
						<!-- .register -->
						<!-- register -->
						<div class="col-md-6">
							<div class="register clearfix">

								<!-- title -->
								<div class="caption contact-caption">
									<h2>
										<span class="green"><i class="fa fa-unlock"></i>
										</span><?php _e( 'Login here', 'coupon' ) ?></h2>
								</div>
								<!-- .title -->

								<!-- form -->
								<div class="form register-form">
									<form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">
									   <fieldset>
									   
										  <div class="form-group <?php echo !empty( $errors['username'] ) ? 'has-error' : ''; ?>">
											 <label class="control-label "><?php _e( 'Username', 'coupon' ); ?></label>
											 <input type="text" name="username" class="form-control form-control-custom">
											 <?php echo !empty( $errors['username'] ) ? '<small class="text-danger">'.$errors['username'].'</small>' : ''; ?>
										  </div>
										  
										  <div class="form-group  has-feedback <?php echo !empty( $errors['password'] ) ? 'has-error' : ''; ?>">
											 <label><?php _e( 'Password', 'coupon' ); ?></label>
											 <input type="password" name="password" class="form-control form-control-custom">
											 <?php echo !empty( $errors['password'] ) ? '<small class="text-danger">'.$errors['password'].'</small>' : ''; ?>
										  </div>
										  
										  
										  <div class="form-group clearfix">
										   <div class="checkbox pull-left">
											 <label>
												<input type="checkbox" name="rememberme" value="1">
												<?php _e( 'Remember me', 'coupon' ); ?> </label>
										   </div>
										  
										   <div class="form-group pull-right forgot">
											   <a href="<?php echo esc_url( coupon_get_permalink_by_tpl( 'page-tpl_password_rec' ) ) ?>"><?php _e( 'Forgot password?', 'coupon' ); ?></a>
										   </div>
										  </div>
								 
										  <div class="clearfix">
											<?php wp_nonce_field('login','login_field'); ?>
											<input type="hidden" name="action" value="login">
											<button type="submit" class="btn btn-custom btn-default login"><?php _e( 'Login', 'coupon' ); ?></button>
										  </div>
									   </fieldset>
									</form>
								</div>
								<!-- .form -->

							</div>
						</div>
						<!-- .register -->
					</div>
				</div>
			</div>
		</div>
	</div>


</section>

<?php 
}/* end if confiramtion message */ 
get_template_part( 'includes/shop_carousel' );
get_footer();
?>