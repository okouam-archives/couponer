<?php
global $error_labels;

if ( is_user_logged_in() ){
	wp_get_current_user();
	$user_ID = $current_user->ID; 
	$user_meta = get_user_meta( $user_ID );
}
else{
	$user_ID = 0;
}	
$can_edit = false;

$author_id = get_the_author_meta( 'ID' );
$author_name = get_query_var('author_name');
if( empty( $author_id ) && $author_name ){
	$author = get_user_by( 'login', $author_name );
	$author_id = $author->ID;
}

$errors = array();
if( $_SERVER['REQUEST_METHOD'] == 'POST' && $user_ID != 0) {
	if(!wp_verify_nonce($_POST['update_profile_field'], 'update_profile')){
		$errors['nonce'] = $error_labels['nonce'];
	}
	else{
		if( isset( $_FILES['avatar'] ) ){
			$uploadedfile = $_FILES['avatar'];
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
			if( !empty( $movefile['url'] ) ){
				$avatar = $movefile['url'];
			}
			else{
				$avatar = '';
			}
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
 
		/* Check email address is present and valid */
		$email = esc_sql($_POST['email']);
		if( !is_email( $email ) ) { 
			$errors['email'] = $error_labels['email_not_valid'];
		}
 
		/* Check password is valid */
		if( !empty( $_POST['password'] ) ){
			$password = esc_sql($_POST['password']);
			if( 0 === preg_match( "/.{6,}/", $_POST['password'] ) ){
				$errors['reg_password'] = $error_labels['password_length'];
			}	
 
			/* Check password confirmation_matches */
			$confirm_password = esc_sql($_POST['password_confirmation']);
			if( 0 !== strcmp( $password, $confirm_password ) ){
				$errors['password_confirmation'] = $error_labels['password_mismach'];
			}
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
	}
		
	if( 0 === count($errors) ){
		$update_fields = array(
			'ID' 			=> $user_ID,
			'user_email'	=> $email,
		);
		if( !empty( $password ) ){
			$update_fields['user_pass'] = $password;
		}

		$update_id = wp_update_user( $update_fields );
		if( !is_wp_error( $update_id ) ){	
			$user_meta = get_user_meta( $user_ID, 'coupon_user_meta' );
			$user_meta = array_shift( $user_meta );
			$subscribe = '';
			if( !empty( $_POST['subscribe'] ) ){
				$subscribe = $_POST['subscribe'];
				if( $user_meta['subscribe'] !== $subscribe ){
					if( $subscribe == 'yes' ){
						coupon_send_subscription( $email, false );
					}
					else{
						coupon_remove_subscription( $email, false );
					}
				}
			}
		
			$user_meta['city'] = $city;
			$user_meta['gender'] = $gender;
			$user_meta['age'] = $age;
			$user_meta['active_status'] = 'active';
			$user_meta['subscribe']	= $subscribe;
			$user_meta['confirmation_hash'] = '';
			if( !empty( $avatar ) ){
				$user_meta['avatar'] = $avatar;
			}
						
			update_user_meta( $user_ID, 'coupon_user_meta', $user_meta );
			update_user_meta( $user_ID, 'first_name', $first_name );
			update_user_meta( $user_ID, 'last_name', $last_name );
			if( !empty( $_POST['description'] ) ){
				$description = esc_sql( $_POST['description'] );
				update_user_meta( $user_ID, 'description', $description );
			}			
		}
		else{
			echo __( 'Error updating the profile.', 'coupon' );
		}
	}
	else{
		var_dump( $errors );
	}
}

if( isset( $_GET['delete_avatar'] ) ){
	$user_meta = get_user_meta( $user_ID, 'coupon_user_meta' );
	$user_meta = array_shift( $user_meta );
	if( !empty( $user_meta['avatar'] ) ){
		$temp = explode( 'uploads', $user_meta['avatar'] );
		$filename = $temp[1];
		$upload_dir = wp_upload_dir();
		unlink( $upload_dir['basedir'].$filename );
		$user_meta['avatar'] = '';
		
		update_user_meta( $user_ID, 'coupon_user_meta', $user_meta );
	}
	
	wp_redirect( get_author_posts_url( $user_ID ) );
}

get_header();
get_template_part( 'includes/inner_header' );

if( current_user_can('edit_users') || $user_ID == $author_id ){
	$can_edit = true;
}

if( $can_edit ){
	include( locate_template('includes/my_profile.php') );
}
else{
	include( locate_template('includes/view_profile.php') );
}

get_footer(); 
?>