<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
	die ( 'Please do not load this page directly. Thanks!' );
}
$user = get_user_by( 'id', $user_ID );
if( !empty( $user ) ):
$user_meta = get_user_meta( $user_ID, 'coupon_user_meta' );
$user_meta = array_shift( $user_meta );
$default_meta = array(
	'city' 				=> '',
	'gender' 			=> '',
	'age' 				=> '',
	'subscribe'			=> '',
	'avatar'			=> '',
);
$user_meta = array_merge( $default_meta, (array)$user_meta );
extract( $user_meta );
?>
<section class="profile">

	<div class="container">
		<div class="row">

			<div class="profile-intro">

				<div class="media profile-media">
					<?php if( !empty( $avatar ) ): ?>
						<a class="pull-left" href="javascript:;">
							<img src="<?php echo esc_url( $avatar ) ?>" title="" alt="" class="img-circle">
						</a>
					<?php endif; ?>

					<div class="media-body">
						<h2>
							<strong>
								<span class="green"><?php _e( 'Hi', 'coupon' ) ?> </span><?php echo $user->user_firstname; ?> <?php echo $user->user_lastname; ?></strong>
						</h2>
						<p><?php _e( 'Manage your profile, look at the member only codes.', 'coupon' ); ?></p>
					</div>

				</div>

				<hr />

				<div class="col-md-12">
					<div class="row">

						<div class="col-md-3">
							<div class="profile-tabs">
								<ul class="nav nav-tabs vertical-tabs">
									<li class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-user"></i> <?php _e( 'My Profile', 'coupon' ); ?></a>
									</li>
									<li class=""><a href="#members-only" data-toggle="tab"><i class="fa fa-gift"></i> <?php _e( 'Members only codes', 'coupon' ); ?></a>
									</li>
								</ul>
							</div>

						</div>

						<div class="col-md-9">

							<div class="profile-tabs-content">
								<div class="tab-content">

									<!-- profile -->
									<div class="tab-pane profile-tab-pane active" id="profile">

										<h2>
											<strong>
												<span class="green"><?php _e( 'Member', 'coupon' ) ?></span> <?php _e( 'Details', 'coupon' ); ?></strong>
										</h2>
										<p><?php _e( 'Update your profile settings.', 'coupon' ); ?></p>
										<hr>

										<!-- form -->
										<div class="register admin-register">
											<div class="form register-form">
												<form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post" enctype='multipart/form-data'>
													<fieldset>
														<div class="form-group"> 
															<label><?php _e( 'Change profile picture', 'coupon' ); ?></label>
															<div class="media media-profile"> 
																<?php if( !empty( $avatar ) ): ?>
																	<a class="pull-left" href="javascript:;">
																		<img class="media-object img-thumbnail img-circle img-responsive img-custom-profile" src="<?php echo esc_url( $avatar ); ?>" alt="" title="" >
																	</a>
																	<div class="avatar-delete">
																		<a href="<?php echo esc_url( add_query_arg( array('delete_avatar' => '1'), $_SERVER['REQUEST_URI'] ) ); ?>"><?php _e( 'Delete avatar', 'blogismo' ); ?></a>
																	</div>
																<?php endif; ?>
																<div class="media-body pull-left">
																	<input type="file" class="form-control form-control-custom" name="avatar">
																</div>

															</div>
														</div>
														
														<div class="form-group">
															<label id="nemce"><?php _e( 'First name', 'coupon' ); ?></label>
															<input type="text" value="<?php echo esc_attr( $user->user_firstname ); ?>"  name="first_name" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['first_name_empty']; ?>">										 
															<?php echo !empty( $errors['first_name'] ) ? '<small class="text-danger">'.$errors['first_name'].'</small>' : '' ?>
														</div>
														
														<div class="form-group">
															<label><?php _e( 'Last name', 'coupon' ); ?></label>
															<input type="text" value="<?php echo esc_attr( $user->user_lastname ); ?>" name="last_name" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['last_name_empty']; ?>">
															<?php echo !empty( $errors['last_name'] ) ? '<small class="text-danger">'.$errors['last_name'].'</small>' : '' ?>
														</div>
														
														<div class="form-group <?php echo !empty( $errors['email'] ) ? 'has-error' : ''?>">
															<label><?php _e( 'Your email', 'coupon' ); ?></label>
															<input type="text" value="<?php echo $user->user_email; ?>" name="email" class="form-control form-control-custom" data-required="true" data-validations="email" data-error="<?php echo $error_labels['email_not_valid']; ?>">
															<?php echo !empty( $errors['email'] ) ? '<small class="text-danger">'.$errors['email'].'</small>' : '' ?>
														</div>
														
														<div class="form-group">
															<label><?php _e( 'How old you are?', 'coupon' ); ?></label>
															<input type="text" value="<?php echo esc_attr( $age ); ?>" name="age" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['empty_age']; ?>">
															<?php echo !empty( $errors['age'] ) ? '<small class="text-danger">'.$errors['age'].'</small>' : '' ?>
														</div>
														
														<label class="clearfix"><?php _e( 'Your Gender', 'coupon' ); ?></label>
														<?php echo !empty( $errors['gender'] ) ? '<small class="text-danger">'.$errors['gender'].'</small>' : '' ?>
														
														<br />
														<br />
														
														<div class="radio-inline">
															<label>
																<input type="radio" name="gender" id="optionsRadios1" value="male" data-required="true" data-error="<?php echo $error_labels['empty_gender']; ?>" <?php echo $gender == 'male' ? 'checked' : ''; ?>>
																<?php _e( 'Male', 'coupon' ); ?> </label>
														</div>
														
														<div class="radio-inline">
															<label>
																<input type="radio" name="gender" id="optionsRadios2" value="female" <?php echo $gender == 'female' ? 'checked' : ''; ?>>
																<?php _e( 'Female', 'coupon' ); ?> </label>
														</div>
														
														<div class="form-group">
															<label><?php _e( 'Where do you live?', 'coupon' ); ?></label>
															<input type="text" value="<?php echo esc_attr( $city ); ?>" name="city" class="form-control form-control-custom" data-required="true" data-error="<?php echo $error_labels['empty_city']; ?>">
															<?php echo !empty( $errors['city'] ) ? '<small class="text-danger">'.$errors['city'].'</small>' : '' ?>
														</div>
														
														<div class="form-group">
															<label><?php _e( 'Choose password', 'coupon' ); ?></label>
															<input type="password" name="password" class="form-control form-control-custom">
															<a href="<?php echo esc_url( coupon_get_permalink_by_tpl( 'page-tpl_password_rec' ) ); ?>"><?php _e( 'Click Here to retreive your password', 'coupon' ); ?></a>
															<?php echo !empty( $errors['reg_password'] ) ? '<small class="text-danger">'.$errors['reg_password'].'</small>' : '' ?>
														</div>
														
														<div class="form-group">
															<label><?php _e( 'Repeat password', 'coupon' ); ?></label>
															<input type="password" name="password_confirmation" class="form-control form-control-custom">
															<?php echo !empty( $errors['password_confirmation'] ) ? '<small class="text-danger">'.$errors['password_confirmation'].'</small>' : '' ?>
														</div>
													  
														<label class="clearfix"><?php _e( 'Receive Newsletter', 'coupon' ); ?></label>
														
														<br />
														<br />
														
														<div class="radio-inline">
															<label>
																<input type="radio" name="subscribe" id="optionsRadios1" value="yes" <?php echo $user_meta['subscribe'] == 'yes' ? 'checked' : ''; ?>><?php _e( 'Yes', 'coupon' ); ?> 
															</label>
														</div>
														
														<div class="radio-inline">
															<label>
																<input type="radio" name="subscribe" id="optionsRadios2" value="no" <?php echo $user_meta['subscribe'] == 'no' ? 'checked' : ''; ?>><?php _e( 'No', 'coupon' ); ?> 
															</label>
														</div>
														
														<div class="form-group">
															<label><?php _e( 'About You', 'coupon' ); ?></label>
															<textarea name="description" class="form-control form-control-custom"><?php echo get_the_author_meta( 'description', $user_ID ); ?></textarea>
														</div>														
														
														<div class="clearfix">
															<?php wp_nonce_field('update_profile','update_profile_field'); ?>
															<button type="submit" class="btn btn-custom btn-default test"><?php _e( 'UPDATE YOUR SETTINGS', 'coupon' ); ?></button>
														</div>

													</fieldset>
												</form>
											</div>
										</div>
										<!-- .form -->
									</div>
									<!-- .profile -->


									<!-- members-only -->
									<div class="tab-pane profile-tab-pane" id="members-only">
										<h2>
											<strong>
												<span class="green"><?php _e( 'Member', 'coupon' ) ?></span> <?php _e( 'Coupons', 'coupon' ); ?></strong>
										</h2>
										<p><?php _e( 'This is the list of all codes for the members only.', 'coupon' ); ?></p>
										<hr>
										<!-- row with categories -->
										<div class="clearfix">
											<div class="row">

												<!-- feature-container-first -->
												<div class="featured-container col-md-12">
													<?php
													/* GET MEMBERS ONLY CODES */
													$codes = query_posts(array(
														'post_type' 	=> 'code',
														'post_status'	=> 'publish',
														'posts_per_page'=> -1,
														'orderby'		=> 'date',
														'order'			=> 'DESC',
														'meta_query'	=> array(
															'relation'  => 'AND',
															array(
																'key' => 'code_for',
																'value' => 'members_only',
																'compare' => '='
															),
															array(
																'key' => 'code_expire',
																'value' => time(),
																'compare' => '>'
															)
														)
													));
													
													if( !empty( $codes ) ){
														$counter = 0;
														foreach( $codes as $code ){
															$code_meta = get_post_custom( $code->ID );
															$shop_id = coupon_get_smeta( 'code_shop_id', $code_meta, $code->ID );
															$code_type = coupon_get_smeta( 'code_type', $code_meta, '3' );
															$code_expire = coupon_get_smeta( 'code_expire', $code_meta, time() );												
															$code_api = coupon_get_smeta( 'code_api', $code_meta, '' );												
															$coupon_label = coupon_get_smeta( 'coupon_label', $code_meta, '' );		
															$code_couponcode = coupon_get_smeta( 'code_couponcode', $code_meta, '' );	
															
															if( $counter == 3 ){
																$counter = 0;
																echo '</div></div><div class="row"><div class="featured-container col-md-12">';
															}
															$counter++;
															?>
															<!-- item-1 -->
															<div class="featured-item-container col-md-4">
																<div class="featured-item">
																	<?php if( has_post_thumbnail( $shop_id ) ): ?>
																		<div class="logotype">
																			<?php echo get_the_post_thumbnail( $shop_id, 'shop_logo' ); ?>
																		</div>
																	<?php endif; ?>
																	<?php if( ( $coupon_label == 'coupon' && ( !empty( $code_couponcode) || !empty( $code_api ) ) ) || ( $coupon_label == 'discount' && !empty( $code_api ) ) ):  ?>
																		<a data-code="<?php echo $code_couponcode; ?>" href="<?php echo !empty( $code_api ) ? esc_url( $code_api ) : ''; ?>" target="_blank" class="btn btn-custom btn-full <?php echo ( empty( $code_couponcode )|| $coupon_label == 'discount' ) ? 'blue-bg' : '' ?> btn-shop btn-top btn-default btn-lg <?php echo ( !empty( $code_couponcode ) && $coupon_label == 'coupon' ) ? 'show-code' : '' ?>" data-codeid="<?php echo $code->ID; ?>">
																			<?php
																				if( !empty( $code_couponcode ) && $coupon_label == 'coupon' ){
																					echo coupon_get_option( 'show_code_text' );
																				}
																				else if( empty( $code_couponcode ) && $coupon_label == 'coupon' ){
																					echo coupon_get_option( 'pack_open_text' );
																				}
																				else{
																					echo coupon_get_option( 'check_discount_text' );
																				}
																			?>
																		</a>
																	<?php endif; ?>
																	<div class="member-rate">
																		<?php
																		$has_ratings = coupon_get_option( 'code_dailly_ratings' );
																		if( in_array( 'code', $has_ratings ) ){
																			echo coupon_get_ratings( $code->ID );
																		}
																		?>
																	</div>
																	<div class="featured-item-content profile-item-content">
																		<p><?php _e( 'All', 'coupon' ) ?> <a href="<?php echo esc_url( get_permalink( $shop_id ) ); ?>"> <?php echo get_the_title( $shop_id ); ?> </a> <?php _e( 'codes', 'coupon' ) ?>
																			<br />
																			<small><?php _e( 'Expires', 'coupon' ); ?> <?php echo date( 'd. M Y.', $code_expire ); ?></small>
																		</p>
																	</div>
																</div>
															</div>
															<!-- .item-1 -->
															<?php
														}
													}
													
													?>
													<!-- first-row -->

													</div>
													<!-- .first-row -->

												</div>
											</div>

										</div>


									</div>


								</div>
							</div>
							<!-- .row with categories -->
						</div>
						<!-- .members only -->

					</div>

				</div>
			</div>


		</div>
	</div>

</section>

<?php else: ?>
	<?php get_template_part( 'includes/view_profile' ); ?>
<?php endif; ?>