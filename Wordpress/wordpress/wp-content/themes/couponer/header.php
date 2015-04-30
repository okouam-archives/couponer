<?php
/* listen for the membership disable */
$can_login = coupon_get_option( 'membership' );
if( $can_login == 'no' ){
	
	if( is_user_logged_in() && !current_user_can( 'manage_options' ) ){
		wp_logout();
		wp_redirect( home_url() );
	}
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="keywords" content="<?php echo esc_attr( coupon_get_option( 'seo-keywords' ) ) ?>" />
	<meta name="description" content="<?php echo esc_attr( coupon_get_option( 'seo-description' ) ) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'coupon' ), max( $paged, $page ) );

	?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( coupon_get_option( 'site_favicon' ) ); ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php if( is_singular( 'code' ) ): ?>   
		<!-- for Facebook -->
		<?php
		$shop_id = get_post_meta( get_the_ID(), 'code_shop_id', true ); 
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $shop_id ), 'post-thumbnail' );
		?>
		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:image" content="<?php echo !empty( $image ) ? esc_url( $image[0] ) : '' ?>" />
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:description" content="<?php echo esc_attr( get_post_meta( get_the_ID(), 'code_text', true ) ); ?>" />

		<!-- for Twitter -->          
		<meta name="twitter:title" content="<?php the_title(); ?>" />
		<meta name="twitter:description" content="<?php echo esc_attr( get_post_meta( get_the_ID(), 'code_text', true ) ); ?>" />
		<meta name="twitter:image" content="<?php echo !empty( $image ) ? esc_url( $image[0] ) : '' ?>" />	
		<!-- for Facebook -->     
	<?php elseif( is_single() ): ?>
		<?php
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-thumbnail' );
		?>     
		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:image" content="<?php echo !empty( $image ) ? esc_url( $image[0] ) : '' ?>" />
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:description" content="<?php the_excerpt(); ?>" />

		<!-- for Twitter -->          
		<meta name="twitter:title" content="<?php the_title(); ?>" />
		<meta name="twitter:description" content="<?php the_excerpt(); ?>" />
		<meta name="twitter:image" content="<?php echo !empty( $image ) ? esc_url( $image[0] ) : '' ?>" />
	<?php endif; ?>
	<?php wp_head(); ?>	
</head>

<body <?php body_class(); ?>>
<input type="hidden" class="border-color-error" value="<?php $normal = coupon_get_option( 'log_reg_err' ); echo !empty( $normal ) ? $normal : '#ff4f53'; ?>">
<input type="hidden" class="border-color-normal" value="<?php $border = coupon_get_option( 'borders_color' ); echo !empty( $border ) ? $border : '#e5e5e5'; ?>">

<!-- =====================================================================================================================================
                                                        N A V I G A T I O N
====================================================================================================================================== -->
<?php
$navigation_style = coupon_get_option( 'navigation_style' );
if( $navigation_style == 'style_2' ){
?>
<div class="container">
	<div class="row">
		<div class="logo-space clearfix">
			<div class="navbar-header navbar-header-2">
				<?php
				$logo_url = coupon_get_option( 'top_bar_logo' );
				if( !empty( $logo_url ) ){
				?>
					<a class="navbar-brand navbar-brand-2" href="<?php echo esc_url( home_url() ); ?>">
						<img src="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( coupon_get_option('site-name') ); ?>" alt="<?php echo esc_attr( coupon_get_option('site-name') ); ?>" />
					</a>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
	<!-- main-navigation -->
    <div id="navigation" class="clearfix fixedsticky">
        <nav class="navbar navbar-default collapsed" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
						<?php if( $navigation_style == 'style_1' || empty( $navigation_style )  ){ ?>
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
									<span class="sr-only"><?php _e( 'Toggle navigation', 'coupon' ) ?></span>
									<span class="fa fa-bars"></span>
								</button>
								<?php
								$logo_url = coupon_get_option( 'top_bar_logo' );
								if( !empty( $logo_url ) ){
								?>
									<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
										<img src="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( coupon_get_option('site-name') ); ?>" alt="<?php echo esc_attr( coupon_get_option('site-name') ); ?>" />
									</a>
								<?php
								}
								?>
							</div>
						<?php  
						}
						else{
						?>
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
									<span class="sr-only"><?php _e( 'Toggle navigation', 'coupon' ) ?></span>
									<span class="fa fa-bars"></span>
								</button>
							</div>
						<?php
						}
						?>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse <?php echo $navigation_style == 'style_1' ? 'navbar-right' : 'no-li-padding' ?> navbar-ex1-collapse">
							<ul class="nav navbar-nav">
								<?php
								if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'top-navigation' ] ) ) {
									wp_nav_menu( array(
										'theme_location'  	=> 'top-navigation',
										'menu_class'        => 'nav navbar-nav',
										'echo'          	=> true,
										'container'			=> false,
										'items_wrap'        => '%3$s',
										'depth'         	=> 10,
										'walker' 			=> new coupon_walker
									) );
								}
								if( is_user_logged_in() || $can_login == 'yes' ){
								?>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<span class="fa fa-<?php echo !is_user_logged_in() ? 'unlock-alt' : 'lock'; ?> green"></span>
										</a>
										<ul class="dropdown-menu dd-custom">
											<?php if( !is_user_logged_in() && $can_login == 'yes' ): ?>
												<li><a href="<?php echo esc_url( coupon_register_login_url() ); ?>" class="login-button"><i class="fa fa-lock"></i> <?php _e( 'Login ', 'coupon' ); ?></a></li>
												<li><a href="<?php echo esc_url( coupon_get_permalink_by_tpl( 'page-tpl_submit_code' ) ); ?>"><i class="fa fa-tags"></i> <?php _e( 'Submit Coupon', 'coupon' ) ?></a></li>
												<li><a href="<?php echo esc_url( coupon_register_login_url() ); ?>" class="register-button"><i class="fa fa-sign-in"></i> <?php _e( 'Register ', 'coupon' ); ?></a></li>
											<?php 
												else: 
												global $current_user;
											?>											
												<li><a href="<?php echo esc_url( get_author_posts_url( $current_user->ID ) ); ?>" class="register-button"><i class="fa fa-user"></i> <?php _e( 'Hi ', 'coupon' ); ?><?php echo !empty( $current_user->first_name ) ? $current_user->first_name : $current_user->user_login; ?></a></li>
												<li><a href="<?php echo esc_url( coupon_get_permalink_by_tpl( 'page-tpl_submit_code' ) ); ?>"><i class="fa fa-tags"></i> <?php _e( 'Submit Coupon', 'coupon' ) ?></a></li>
												<li><a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="login-button"><i class="fa fa-unlock-alt"></i> <?php _e( 'Logout ', 'coupon' ); ?></a></li>
											<?php endif; ?>										
										</ul>
									</li>
								<?php
								}
								?>
							</ul>
                        </div>
                        <!-- .navbar-collapse -->
                    </div>
                </div>
            </div>
            <!-- .container -->
        </nav>
    </div>
    <!-- .main-navigation -->