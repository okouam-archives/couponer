<?php

	/**********************************************************************
	***********************************************************************
	COUPON FUNCTIONS
	**********************************************************************/
include( locate_template( 'includes/class-tgm-plugin-activation.php' ) );
include( locate_template( 'includes/code_category_taxonomy.php' ) );
include( locate_template( 'includes/coupon_widgets.php' ) );
include( locate_template( 'includes/shortcodes.php' ) );
require get_template_directory() .'/includes/radium-one-click-demo-install/init.php';
$error_labels = array(
	'first_name_empty' 		=> esc_attr__( "Please enter your first name.", "coupon" ),
	'last_name_empty'	 	=> esc_attr__( "Please enter your last name.", "coupon" ),
	'username_no_spaces' 	=> esc_attr__( "Sorry, no spaces allowed in username.", "coupon" ),
	'username_empty' 		=> esc_attr__( "Please enter a username.", "coupon." ),
	'username_exists' 		=> esc_attr__( "Username already exists, please try another.", "coupon" ),
	'email_not_valid' 		=> esc_attr__( "Please enter a valid email.", "coupon" ),
	'email_in_use'			=> esc_attr__( "This email address is already in use.", "coupon" ),
	'password_length'		=> esc_attr__( "Password must be at least six characters.", "coupon" ),
	'password_mismach'		=> esc_attr__( "Passwords do not match.", "coupon" ),
	'empty_city'			=> esc_attr__( "You must input your city.", "coupon" ),
	'empty_gender'			=> esc_attr__( "You must select your gender.", "coupon" ),
	'empty_age'				=> esc_attr__( "You must input your age.", "coupon" ),
	'nonce'					=> esc_attr__( 'Sorry, but this request is invalid.', 'coupon' ),
	'not_confirmed'			=> esc_attr__( "This account needs email verification.", "coupon" ),
	'invalid_username'		=> esc_attr__( "Username is invalid.", "coupon" ),
	'invalid_password'		=> esc_attr__( "Password is invalid.", "coupon" ),
	'sign_in_error'			=> esc_attr__( "Error singin you in.", "coupon" ),
	/* submit coupon labels */
	'code_conditions'  		=> esc_attr__( "Empty conditions.", "coupon" ),
	'code_discount'  		=> esc_attr__( "Empty discount.", "coupon" ),
	'code_text'  		=> esc_attr__( "Empty ofer text.", "coupon" ),
	'coupon_label'			=> esc_attr__( "Invalid coupon label.", "coupon" ),
	'empty_code'			=> esc_attr__( "Empty coupon code.", "coupon" ),
	'content'				=> esc_attr__( "Empty content.", "coupon" ),
	'expire'				=> esc_attr__( "Invalid expire date.", "coupon" ),
	'coupon_title'			=> esc_attr__( "Input coupon title.", "coupon" ),
	'shop_link'				=> esc_attr__( "Input shop link.", "coupon" ),
	'captcha'				=> esc_attr__( "Captcha is wrong.", "coupon" ),
);

add_action( 'tgmpa_register', 'coupon_requred_plugins' );

function coupon_requred_plugins(){
	$plugins = array(
		array(
				'name'                 => 'NHP Options',
				'slug'                 => 'nhpoptions',
				'source'               => get_stylesheet_directory() . '/lib/plugins/nhpoptions.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),		
		array(
				'name'                 => 'Smeta',
				'slug'                 => 'smeta',
				'source'               => get_stylesheet_directory() . '/lib/plugins/smeta.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),
		array(
				'name'                 => 'Simple Share Buttons',
				'slug'                 => 'simple-share-buttons-adder',
				'source'               => get_stylesheet_directory() . '/lib/plugins/simple-share-buttons-adder.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
			'domain'           => 'coupon',
			'default_path'     => '',
			'parent_menu_slug' => 'themes.php',
			'parent_url_slug'  => 'themes.php',
			'menu'             => 'install-required-plugins',
			'has_notices'      => true,
			'is_automatic'     => false,
			'message'          => '',
			'strings'          => array(
				'page_title'                      => __( 'Install Required Plugins', 'coupon' ),
				'menu_title'                      => __( 'Install Plugins', 'coupon' ),
				'installing'                      => __( 'Installing Plugin: %s', 'coupon' ),
				'oops'                            => __( 'Something went wrong with the plugin API.', 'coupon' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'coupon' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'coupon' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'coupon' ),
				'nag_type'                        => 'updated'
			)
	);

	tgmpa( $plugins, $config );
}

if (!isset($content_width)){
	$content_width = 1920;
}

function coupon_options(){
	global $coupon_opts;
	$args = array();
	$sections = array();
	$tabs = array();
	$args['dev_mode'] = false;
	$args['opt_name'] = 'coupon';
	$args['menu_title'] = __('Coupon Options', 'coupon');
	$args['page_title'] = __('Coupon Settings', 'coupon');
	$args['page_slug'] = 'coupon_theme_options';
	
	
	/**********************************************************************
	***********************************************************************
	OVERALL
	**********************************************************************/
	$sections[] = array(
		'title' => __('Overall', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_119_adjust.png',
		'desc' => __('This is basic section where you can set up main settings for your website.', 'coupon'),
		'fields' => array(		
			//Favicon
			array(
				'id' => 'site_slider',
				'type' => 'upload',
				'title' => __('Site Main Image', 'coupon') ,
				'desc' => __('Upload image for the home page background image.', 'coupon')
			),
			//Site Slider Bg Image
			array(
				'id' => 'site_slider_bg_color',
				'type' => 'color',
				'title' => __('Site Main Slider Color', 'coupon') ,
				'desc' => __('Select main slider background color if no image is used.', 'coupon'),
				'std' => '#24caac'
			),
			//Favicon
			array(
				'id' => 'site_favicon',
				'type' => 'upload',
				'title' => __('Site Favicon', 'coupon') ,
				'desc' => __('Please upload favicon here in PNG or JPG format. <small>(18px 18px maximum size recommended)</small>)', 'coupon')
			),
			//Navigation Style
			array(
				'id' => 'navigation_style',
				'type' => 'select',
				'title' => __('Navigation Style', 'coupon') ,
				'desc' => __('<br />Select navigation style', 'coupon'),
				'options' => array(
					'style_1' => 'Style 1',
					'style_2' => 'Style 2'
				),
				'std' => 'style_1'
			),
			//Membership
			array(
				'id' => 'membership',
				'type' => 'select',
				'title' => __('Enable Membership Login', 'coupon') ,
				'desc' => __('<br />Enable or disable membership login (This option will also affect registration)', 'coupon'),
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No'
				),
				'std' => 'yes'
			),
			//Search And Categories
			array(
				'id' => 'ajax_categories',
				'type' => 'select',
				'title' => __('Enable Ajax Search And Categories', 'coupon') ,
				'desc' => __('<br />Enable or disable ajax search and category list in the header', 'coupon'),
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No'
				),
				'std' => 'yes'
			),
			// Lost Password Message
			array(
				'id' => 'lost_password_message',
				'type' => 'textarea',
				'title' => __('Lost Password Message', 'coupon') ,
				'desc' => __('<br />Input %USERNAME% where you wish for the username to show and input %PASSWORD% where you want for the password to show.', 'coupon')
			) ,
			//Blog Layout
			array(
				'id' => 'direction',
				'type' => 'select',
				'options' => array(
					'ltr' => __('Left To Right', 'gorising'),
					'rtl' => __('Right To Left', 'gorising'),
				),
				'title' => __( 'Site Text Direction', 'gorising'),
				'desc' => __('Select site text direction', 'gorising'),
				'std' => 'ltr'
			),	
			//Ratings
			array(
				'id' => 'code_dailly_ratings',
				'type' => 'multi_select',
				'title' => __('Show Ratings On', 'coupon'),
				'desc' => __('<br />Select where you would like to display ratings.', 'coupon'),
				'options' => array(
					'code' => __( 'Codes', 'coupon' ),
					'dailly' => __( 'Dailly Offers', 'coupon' )
				),
				'std' => array( 'code', 'dailly' )
			),
			// Registration Message
			array(
				'id' => 'registration_message',
				'type' => 'textarea',
				'title' => __('Registration Message', 'coupon') ,
				'desc' => __('<br />Input %LINK% where you wish for the confirmation link to show.', 'coupon')
			) ,			
			//Top Bar Logo
			array(
				'id' => 'top_bar_logo',
				'type' => 'upload',
				'title' => __('Site Top Bar Logo', 'coupon') ,
				'desc' => __('Upload top bar logo', 'coupon')
			),
			//Top Bar Logo Padding
			array(
				'id' => 'top_bar_logo_padding',
				'type' => 'text',
				'title' => __('Top Bar Logo Padding', 'coupon') ,
				'desc' => __('<br />Tweak up logo padding in the form TOP(px) RIGHT(px) BOTTOM(px) LEFT(px) (navigation style 1 only)', 'coupon'),
				'std' => '22px 0px 0px 0px'
			),
			//Top Bar Logo Width
			array(
				'id' => 'top_bar_logo_width',
				'type' => 'text',
				'title' => __('Top Bar Logo Width', 'coupon') ,
				'desc' => __('<br />Tweak up logo width in pixels (navigation style 1 only).', 'coupon'),
				'std' => '140px'
			),			
			//Copyright
			array(
				'id' => 'copyright_text',
				'type' => 'text',
				'title' => __('Copyright', 'coupon') ,
				'desc' => __('<br />Type copyright text here', 'coupon')
			),
		)
	);
	/**********************************************************************
	***********************************************************************
	SEO
	**********************************************************************/
	
	$sections[] = array(
		'title' => __('SEO', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_079_signal.png',
		'desc' => __('This is important part for search engines.', 'coupon'),
		'fields' => array(
			// Keywords
			array(
				'id' => 'seo-keywords',
				'type' => 'text',
				'title' => __('Keywords', 'coupon') ,
				'desc' => __('<br />Type here website keywords separated by comma. <small>(eg. lorem, ipsum, adiscipit)</small>.', 'coupon')
			) ,
			
			// Description
			array(
				'id' => 'seo-description',
				'type' => 'textarea',
				'title' => __('Description', 'coupon') ,
				'desc' => __('<br />Type here website description.', 'coupon')
			) ,
		)
	);
	
	/**********************************************************************
	***********************************************************************
	LISTINGS
	**********************************************************************/
	
	$sections[] = array(
		'title' => __('Listing', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_114_list.png',
		'desc' => __('Listing page template options.', 'coupon'),
		'fields' => array(
			//Category listing order by
			array(
				'id' => 'category_order_by',
				'type' => 'select',
				'title' => __('Order Categories By', 'coupon') ,
				'desc' => __('<br />Select by which field to order the categories on the category listing page.', 'coupon'),
				'options' => array(
					'name' => __( 'Category Name', 'coupon' ),
					'id' => __( 'Category ID', 'coupon' ),
					'count' => __( 'Code Count ', 'coupon' ),
					'slug' => __( 'Category Slug', 'coupon' ),
					'none' => __( 'None', 'coupon' ),
				),
				'std' => 'name'
			) ,	
			//Category listing order
			array(
				'id' => 'category_order',
				'type' => 'select',
				'title' => __('Order Categories', 'coupon') ,
				'desc' => __('<br />Select how to order the categories on the category listing page.', 'coupon'),
				'options' => array(
					'ASC' => __( 'Ascending', 'coupon' ),
					'DESC' => __( 'Descending', 'coupon' ),
				),
				'std' => 'ASC'
			) ,		
			// Show Code Button
			array(
				'id' => 'show_code_text',
				'type' => 'text',
				'title' => __('Text On Show Code Button', 'coupon') ,
				'desc' => __('<br />Input text which will be displayed on the show code button.', 'coupon'),
				'std' => 'SHOW CODE'
			) ,	
			// Pack And Open Button
			array(
				'id' => 'pack_open_text',
				'type' => 'text',
				'title' => __('Text On Pack And Open Button', 'coupon') ,
				'desc' => __('<br />Input text which will be displayed on the pack code and open button.', 'coupon'),
				'std' => 'PACK CODE AND OPEN'
			) ,
			// Check Discount Button
			array(
				'id' => 'check_discount_text',
				'type' => 'text',
				'title' => __('Text On Check Discount Button', 'coupon') ,
				'desc' => __('<br />Input text which will be displayed on the check discount button.', 'coupon'),
				'std' => 'CHECK DISCOUNT'
			),
			
			// Show In Listings
			array(
				'id' => 'show_in_listings',
				'type' => 'multi_select',
				'title' => __('Select Tabs', 'coupon') ,
				'options' => array(
					'top20' => __( 'Top 20', 'coupon' ),
					'featured' => __( 'Featured', 'coupon' ),
					'popular' => __( 'Popular', 'coupon' ),
					'newest' => __( 'Newest', 'coupon' )
				),
				'desc' => __('<br />Select tabs you want to show on listing page.', 'coupon'),
			) ,
			// Search Per Page
			array(
				'id' => 'popular_sort',
				'type' => 'select',
				'title' => __('Sort Popular By', 'coupon') ,
				'desc' => __('<br />Select how the popular codes will be calculated.', 'coupon'),
				'options' => array(
					'clicks' => __( 'Clicks', 'coupon' ),
					'ratings' => __( 'Ratings', 'coupon' )
				),
				'std' => 'clicks'
			) ,
			// Search Per Page
			array(
				'id' => 'search_per_page',
				'type' => 'text',
				'title' => __('Search Results Per Page', 'coupon') ,
				'desc' => __('<br />Input number of search result codes to show per page.', 'coupon'),
				'std' => '10'
			) ,
			// Expiting Per Page
			array(
				'id' => 'expiring_per_page',
				'type' => 'text',
				'title' => __('Expiring Per Page', 'coupon') ,
				'desc' => __('<br />Input number of expiring codes to show per page.', 'coupon'),
				'std' => '10'
			) ,		
			// Featured Per Page
			array(
				'id' => 'featured_per_page',
				'type' => 'text',
				'title' => __('Featured Per Page', 'coupon') ,
				'desc' => __('<br />Input number of featured codes to show per page.', 'coupon'),
				'std' => '10'
			) ,
			// Newest Per Page
			array(
				'id' => 'newest_per_page',
				'type' => 'text',
				'title' => __('Newest Per Page', 'coupon') ,
				'desc' => __('<br />Input number of newest codes to show per page.', 'coupon'),
				'std' => '10'
			) ,
			// Popular Per Page
			array(
				'id' => 'popular_per_page',
				'type' => 'text',
				'title' => __('Popular Per Page', 'coupon') ,
				'desc' => __('<br />Input number of popular codes to show per page.', 'coupon'),
				'std' => '10'
			) ,
			// Shop Listing Per Page
			array(
				'id' => 'shop_listing_per_page',
				'type' => 'text',
				'title' => __('Shop Listing Per Page', 'coupon') ,
				'desc' => __('<br />Input number of codes to show in the shop listing.', 'coupon'),
				'std' => '10'
			) ,
			// Daily Offers Per Page
			array(
				'id' => 'daily_offers_per_page',
				'type' => 'text',
				'title' => __('Daily Offers Per Page', 'coupon') ,
				'desc' => __('<br />Input number of daily offers to show per page.', 'coupon'),
				'std' => '10'
			) ,
		)
	);
	/**********************************************************************
	***********************************************************************
	NEW CODE
	**********************************************************************/
	
	$sections[] = array(
		'title' => __('New Code', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_065_tag.png',
		'desc' => __('New code information settings.', 'coupon'),
		'fields' => array(
			// New Code Email
			array(
				'id' => 'new_code_email',
				'type' => 'text',
				'title' => __('New code email', 'coupon') ,
				'desc' => __('<br />Input email where the information about new codes should arrive.', 'coupon')
			) ,	
			// New Code Email
			array(
				'id' => 'required_aditional_fields',
				'type' => 'multi_select',
				'title' => __('Required Fields', 'coupon') ,
				'desc' => __('<br />Select Additional required Fields.', 'coupon'),
				'options' => array(
					'content' => __( 'Coupon Or Discount Description', 'coupon' ),
					'code_conditions' => __( 'Code Condition', 'coupon' ),
					'code_discount' => __( 'Code Discount', 'coupon' ),
					'code_text' => __( 'Code Text', 'coupon' )
				),
			) ,				
		)
	);	
	/**********************************************************************
	***********************************************************************
	SUBSCRIPTION
	**********************************************************************/
	
	$sections[] = array(
		'title' => __('Subscription', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_073_signal.png',
		'desc' => __('Set up subscription API key and list ID.', 'coupon'),
		'fields' => array(
			// Mail Chimp API
			array(
				'id' => 'mail_chimp_api',
				'type' => 'text',
				'title' => __('API Key', 'coupon') ,
				'desc' => __('<br />Type your mail chimp api key.', 'coupon')
			) ,	
			// Mail Chimp List ID
			array(
				'id' => 'mail_chimp_list_id',
				'type' => 'text',
				'title' => __('List ID', 'coupon') ,
				'desc' => __('<br />Type here ID of the list on which users will subscribe.', 'coupon')
			) ,
		)
	);

	
	/**********************************************************************
	***********************************************************************
	HOME PAGE SETTINGS
	**********************************************************************/
	
	$sections[] = array(
		'title' => __('Home Page', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_020_home.png',
		'desc' => __('Home page settings.', 'coupon'),
		'fields' => array(
			// Tabs Home Page
			array(
				'id' => 'home_groups',
				'type' => 'multi_select',
				'title' => __('Select Tabs', 'coupon') ,
				'options' => array(
					'feature' => __( 'Featured', 'coupon' ),					
					'popular' => __( 'Popular', 'coupon' ),
					'daily' => __( 'Daily Offer', 'coupon' ),
					'latest' => __( 'Latest', 'coupon' )
				),
				'desc' => __('<br />Select tabs you want to show on home page.', 'coupon'),
			) ,
			//Site Slogan
			array(
				'id' => 'site_slogan',
				'type' => 'textarea',
				'title' => __('Site Slogan', 'coupon') ,
				'desc' => __('<br />Type in site Slogan which will appear on the home page.', 'coupon'),
			),
			//SIte SubSlogan
			array(
				'id' => 'site_sub_slogan',
				'type' => 'textarea',
				'title' => __('Site Subtitle', 'coupon') ,
				'desc' => __('<br />Type in site subtitle use %COUPONS% and %USERS% to place the number of coupons and registered users.', 'coupon'),
			),		
			//Codes in tabs
			array(
				'id' => 'codes_num',
				'type' => 'number',
				'title' => __('Codes In Groups', 'coupon') ,
				'desc' => __('<br />Input how many codes should each group have.', 'coupon'),
				'label' => '',
				'min' => '1',
				'max' => '99999999999',
				'std' => '20'
			),
			//featured category
			array(
				'id' => 'home_promo_cat',
				'type' => 'select',
				'title' => __('Promo Category', 'coupon') ,
				'desc' => __('<br />Select promo category.', 'coupon'),
				'options' => coupon_get_code_category_parents()
			),
			//Subcategory from featured category
			array(
				'id' => 'home_promo_cat_num',
				'type' => 'number',
				'title' => __('Promo Category Boxes', 'coupon') ,
				'desc' => __('Input how many subcategories from the category to show.', 'coupon'),
				'std' => '3',
				'label' => '',
				'min' => '1',
				'max' => '99999999999'
			),
			//Home page blogs
			array(
				'id' => 'home_latest_blogs',
				'type' => 'text',
				'title' => __('Latest Blogs', 'coupon') ,
				'desc' => __('Input how many latest blogs to show on home page.', 'coupon'),
				'std' => '3',
				'label' => '',
				'min' => '0',
				'max' => '99999999999'
			)
		)
	);
	
	/**********************************************************************
	***********************************************************************
	CONTACT PAGE SETTINGS
	**********************************************************************/
	
	$sections[] = array(
		'title' => __('Contact Page', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_151_edit.png',
		'desc' => __('Contact page settings.', 'coupon'),
		'fields' => array(
			//Contact Form Title
			array(
				'id' => 'contact_form_title',
				'type' => 'text',
				'title' => __('Contact Form Title', 'coupon') ,
				'desc' => __('<br />Type in contact form title.', 'coupon'),
			),
			//COntact Form Email
			array(
				'id' => 'contact_email',
				'type' => 'text',
				'title' => __('Contact Email', 'coupon') ,
				'desc' => __('<br />Type in email address on which the messages should arrive.', 'coupon'),
			),	
		)
	);	

	/**********************************************************************
	***********************************************************************
	COMMON COLORS
	**********************************************************************/
	$sections[] = array(
		'title' => __('Common Colors', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_051_eye_open.png',
		'desc' => __('Set up colors which are common for more than two section.', 'coupon'),
		'fields' => array(
			//Main Color
			array(
				'id' => 'site_color',
				'type' => 'color',
				'title' => __('Site Main Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/common/site_main_color.png',
				'text_desc' => __('Select main color for the site.', 'coupon'),
				'std' => '#24b6ac'
			),
			//Buttons Hover Color
			array(
				'id' => 'btn_color_hvr',
				'type' => 'color',
				'title' => __('Main Buttons Hover Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/common/main_buttons_hover_background_color.png',
				'text_desc' => __('Select background color for the buttons with main color on hover.', 'coupon'),
				'std' => '#24caac'			
			),
			//Borders Color
			array(
				'id' => 'borders_color',
				'type' => 'color',
				'title' => __('Borders Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/common/borders_color.png',
				'text_desc' => __('Select color of the border for all items with the boredr ( featured box, widgets, tabs in the TOP 20, ... ).', 'coupon'),
				'std' => '#e5e5e5'
			),
			
			/*---------------------------------------INPUT TEXT----------------------------*/
			//Text and placeholders in the input and textarea
			array(
				'id' => 'input_text',
				'type' => 'color',
				'title' => __('Form Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/common/form_font_color.png',
				'text_desc' => __('Select font color for the text in the input fields.', 'coupon'),
				'std' => '#d1d0d0'
			),
			
		)
	);
	
	/**********************************************************************
	***********************************************************************
	NAVIGATION COLORS
	**********************************************************************/
	$sections[] = array(
		'title' => __('Navigation Colors', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_051_eye_open.png',
		'desc' => __('Set up colors for the navigation section.', 'coupon'),
		'fields' => array(
			//Navigation Holder Background
			array(
				'id' => 'nav_hold_bg',
				'type' => 'color',
				'title' => __('Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/navigation/background_color.png',
				'text_desc' => __('Select background color for the navgation section.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Navigation Holder Border
			array(
				'id' => 'nav_hold_border',
				'type' => 'color',
				'title' => __('Border Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/navigation/border_color.png',
				'text_desc' => __('Select border color for the navgation section.', 'coupon'),
				'std' => '#e7e7e7'
			),
			
			//Navigation First Level Color
			array(
				'id' => 'nav_fist_lvl_color',
				'type' => 'color',
				'title' => __('First Level Links Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/navigation/first_level_links_color.png',
				'text_desc' => __('Select font color for the first level links in the navigation.', 'coupon'),
				'std' => '#626262'
			),
			
			//Navigation Sublevel Background Color
			array(
				'id' => 'nav_sub_bg',
				'type' => 'color',
				'title' => __('Sublevel Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/navigation/sublevel_background_color.png',
				'text_desc' => __('Select background color for the sublevels.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Navigation Sublevel Font Color
			array(
				'id' => 'nav_sub_font',
				'type' => 'color',
				'title' => __('Sublevel Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/navigation/sublevel_font_color.png',
				'text_desc' => __('Select font color for the sublevels.', 'coupon'),
				'std' => '#626262'
			),
			
			//Navigation Sublevel Background Color Hover
			array(
				'id' => 'nav_sub_bg_hvr',
				'type' => 'color',
				'title' => __('Sublevel Background Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/navigation/sublevel_background_color_on_hover.png',
				'text_desc' => __('Select background color for the sublevels on hover.', 'coupon'),
				'std' => '#24b6ac'
			),
			
			//Navigation Sublevel Font Color
			array(
				'id' => 'nav_sub_font_hvr',
				'type' => 'color',
				'title' => __('Sublevel Font Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/navigation/sublevel_font_color_on_hover.png',
				'text_desc' => __('Select font color for the sublevels on hover.', 'coupon'),
				'std' => '#ffffff'
			),
			
		)
	);
	/**********************************************************************
	***********************************************************************
	INNER HEADER COLORS
	**********************************************************************/
	$sections[] = array(
		'title' => __('Inner Header Colors', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_051_eye_open.png',
		'desc' => __('Set up colors for the inner header section.', 'coupon'),
		'fields' => array(
			//Featured Border
			array(
				'id' => 'slogan_color',
				'type' => 'color',
				'title' => __('Slogan Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/inerheader/slogan_font_color.png',
				'text_desc' => __('Select font color for the site slogan.', 'coupon'),
				'std' => '#ffffff'
			),

			//Ajax Search Dropdown Content
			array(
				'id' => 'ajax_drop_con_bg',
				'type' => 'color',
				'title' => __('Ajax Search Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/innerheader/ajax_search_background_color.png',
				'text_desc' => __('Select background color for the ajax search content.', 'coupon'),
				'std' => '#292929'
			),
			
			//Ajax Search Dropdown Content Font
			array(
				'id' => 'ajax_drop_con_font',
				'type' => 'color',
				'title' => __('Ajax Search Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/innerheader/ajax_search_font_color.png',
				'text_desc' => __('Select font color for the ajax search content.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Ajax Search Dropdown Content HOver
			array(
				'id' => 'ajax_drop_con_bg_hvr',
				'type' => 'color',
				'title' => __('Ajax Search Background Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/innerheader/ajax_search_background_color_on_hover.png',
				'text_desc' => __('Select background color for the ajax search on item hover.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Ajax Search Dropdown Content Font
			array(
				'id' => 'ajax_drop_con_font_hvr',
				'type' => 'color',
				'title' => __('Ajax Search Font Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/innerheader/ajax_search_font_color_on_hover.png',
				'text_desc' => __('Select font color for the ajax search on item hover.', 'coupon'),
				'std' => '#000000'
			),
			
			//Ajax Search Dropdown PlaceH Ooder
			array(
				'id' => 'ajax_drop_placeholder_hvr',
				'type' => 'color',
				'title' => __('Ajax Search Placeholder Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/innerheader/ajax_search_placeholder_font_color.png',
				'text_desc' => __('Select font color for the ajax search placeholder.', 'coupon'),
				'std' => '#dadada'
			),
			//Dropdown background color
			array(
				'id' => 'dropdown_bg',
				'type' => 'color',
				'title' => __('Dropdown Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/innerheader/dropdown_background_color.png',
				'text_desc' => __('Select background color for the dropdown.', 'coupon'),
				'std' => '#fefdfe'
			),

			//Dropdown font color
			array(
				'id' => 'dropdown_font',
				'type' => 'color',
				'title' => __('Dropdown Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/innerheader/dropdown_font_color.png',
				'text_desc' => __('Select font color for the dropdown.', 'coupon'),
				'std' => '#000000'
			),
			
			//Dropdown container background
			array(
				'id' => 'dropdown_cont_bg',
				'type' => 'color',
				'title' => __('Dropdown Content Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/innerheader/dropdown_content_background_color.png',
				'text_desc' => __('Select background color for the dropdown content.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Dropdown container font color
			array(
				'id' => 'dropdown_cont_font',
				'type' => 'color',
				'title' => __('Dropdown Content Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/innerheader/dropdown_content_font_color.png',
				'text_desc' => __('Select font color for the dropdown content.', 'coupon'),
				'std' => '#000000'
			),
			
			//Dropdown container hover background
			array(
				'id' => 'dropdown_cont_bg_hvr',
				'type' => 'color',
				'title' => __('Dropdown Content Background Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/innerheader/dropdown_content_background_color_on_hover.png',
				'text_desc' => __('Select background color for the dropdown content on hover.', 'coupon'),
				'std' => '#000000'
			),
			
			//Dropdown container hover font
			array(
				'id' => 'dropdown_cont_font_hvr',
				'type' => 'color',
				'title' => __('Dropdown Content Font Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/innerheader/dropdown_content_font_color_on_hover.png',
				'text_desc' => __('Select font color for the dropdown content on hover.', 'coupon'),
				'std' => '#ffffff'
			),
			
		)
	);
	/**********************************************************************
	***********************************************************************
	BODY COLORS
	**********************************************************************/
	$sections[] = array(
		'title' => __('Body Colors', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_051_eye_open.png',
		'desc' => __('Set up colors for the body section.', 'coupon'),
		'fields' => array(
			//Body Font Color
			array(
				'id' => 'body_bg',
				'type' => 'color',
				'title' => __('Body Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/body_background_color.png',
				'text_desc' => __('Select body background color.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Page title divider
			array(
				'id' => 'page_title_divider',
				'type' => 'color',
				'title' => __('Page Title Divider Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/page_title_divider_color.png',
				'text_desc' => __('Select color of the divider page title', 'coupon'),
				'std' => '#e5e5e5'
			),
			
			//Titles Color
			array(
				'id' => 'titles_color',
				'type' => 'color',
				'title' => __('Titles And Labels Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/titles_and_labels_font_color.png',
				'text_desc' => __('Select font color for the titles and labels.', 'coupon'),
				'std' => '#333333'
			),	
			
			//Text Color
			array(
				'id' => 'text_color',
				'type' => 'color',
				'title' => __('Content Text Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/content_text_font_color.png',
				'text_desc' => __('Select font color for the content text.', 'coupon'),
				'std' => '#6d6d6d'
			),
			
			//Discount Arrow Color
			array(
				'id' => 'discount_arrow_color',
				'type' => 'color',
				'title' => __('Discount Arrow Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/discount_arrow_color.png',
				'text_desc' => __('Select color for the dsicount arrow.', 'coupon'),
				'std' => '#e5e5e5'
			),
			
			//Shop Listing Filter
			array(
				'id' => 'shop_filter',
				'type' => 'color',
				'title' => __('Shop Filter Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/shop_filter_font_color.png',
				'text_desc' => __('Select font color for the shop filter.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//TOP 20 Font Color
			array(
				'id' => 'top_20_tabs_font_color',
				'type' => 'color',
				'title' => __('Top 20 Tabs Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/top_20_tabs_font_color.png',
				'text_desc' => __('Select font color for the tabs in the TOP 20 listing.', 'coupon'),
				'std' => '#000000'
			),
			
			//TOP 20 Font Color Active Tab
			array(
				'id' => 'active_top_20_tabs_font_color',
				'type' => 'color',
				'title' => __('Top 20 Active Tab Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/top_20_active_tab_font_color.png',
				'text_desc' => __('Select font color for the active tabs in the TOP 20 listing.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Pagination Font Color
			array(
				'id' => 'pag_font_color',
				'type' => 'color',
				'title' => __('Pagination Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/pagination_font_color.png',
				'text_desc' => __('Select font color for the pagination.', 'coupon'),
				'std' => '#000000'
			),
			
			//Active Pagination Font Color
			array(
				'id' => 'active_pag_font_color',
				'type' => 'color',
				'title' => __('Active Pagination Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/active_pagination_font_color.png',
				'text_desc' => __('Select font color for the active pagination.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Featured Label Background Color
			array(
				'id' => 'feat_lab_bg',
				'type' => 'color',
				'title' => __('Featured Label Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/featured_label_background_color.png',
				'text_desc' => __('Select background color for the featured label.', 'coupon'),
				'std' => '#ff8b02'
			),
			//Featured Label Font Color
			array(
				'id' => 'feat_lab_font',
				'type' => 'color',
				'title' => __('Featured Label Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/featured_label_font_color.png',
				'text_desc' => __('Select font color for the featured label.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Item Meta Color
			array(
				'id' => 'item_meta_color',
				'type' => 'color',
				'title' => __('Coupon / Blog Information Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/coupon_blog_information_font_color.png',
				'text_desc' => __('Select font color for the coupon and blog information.', 'coupon'),
				'std' => '#8f8f8f'
			),	
			
			//Item Meta Icon Color
			array(
				'id' => 'item_meta_icon_color',
				'type' => 'color',
				'title' => __('Coupon / Blog Information Icon Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/coupon_blog_information_icon_color.png',
				'text_desc' => __('Select font color for the coupon and blog icons in the information.', 'coupon'),
				'std' => '#dadada'
			),
			
			//Countdown Box Information Font Color
			array(
				'id' => 'countdown_info_font',
				'type' => 'color',
				'title' => __('Countdown Information Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/countdown_information_font_color.png',
				'text_desc' => __('Select font color for the countdown information box text.', 'coupon'),
				'std' => '#292929'
			),
			
			//Pack And Open Background
			array(
				'id' => 'pack_bg',
				'type' => 'color',
				'title' => __('Pack And Open Button Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/pack_and_open_button_background_color.png',
				'text_desc' => __('Select background color for the pack and open button.', 'coupon'),
				'std' => '#2ca9e0'
			),
			
			//Pack And Open Font
			array(
				'id' => 'show_pack_font',
				'type' => 'color',
				'title' => __('Show Code / Pack And Open Button Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/show_code_pack_and_open_button_font_color.png',
				'text_desc' => __('Select font color for the pack and open button.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Pack And Open Side Arrows
			array(
				'id' => 'side_arows',
				'type' => 'color',
				'title' => __('Show Code / Pack And Open Button Arrows Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/show_code_pack_and_open_button_arrows_color.png',
				'text_desc' => __('Select color for the side arrows of Show Code / Pack And Open button.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Login Regsiter Error Message
			array(
				'id' => 'log_reg_err',
				'type' => 'color',
				'title' => __('Form Error Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/form_error_font_color.png',
				'text_desc' => __('Select font color for the form error messages.', 'coupon'),
				'std' => '#ff4f53'
			),
			
			//Orange promo
			array(
				'id' => 'orange_promo',
				'type' => 'color',
				'title' => __('Promo Discount Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/body/promo_discount_font_color.png',
				'text_desc' => __('Select font color for the promo discount text.', 'coupon'),
				'std' => '#ff8b02'
			),
			
		)
	);
	
	/**********************************************************************
	***********************************************************************
	FOOTER COLORS
	**********************************************************************/
	$sections[] = array(
		'title' => __('Footer Colors', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_051_eye_open.png',
		'desc' => __('Set up colors for the footer section.', 'coupon'),
		'fields' => array(
			//Footer bg color
			array(
				'id' => 'footer_bg',
				'type' => 'color',
				'title' => __('Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/background_color.png',
				'text_desc' => __('Select background color for the footer section.', 'coupon'),
				'std' => '#292929'
			),
			
			//Footer widget caption color
			array(
				'id' => 'footer_widg_cap',
				'type' => 'color',
				'title' => __('Widget Title Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/widget_title_font_color.png',
				'text_desc' => __('Select font color for the footer widget titles.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Footer widget text color
			array(
				'id' => 'footer_widg_text',
				'type' => 'color',
				'title' => __('Widget Text Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/widget_text_font_color.png',
				'text_desc' => __('Select font color for the footer widget text.', 'coupon'),
				'std' => '#9d9c9c'
			),
			
			//Footer widget link hover color
			array(
				'id' => 'footer_widg_link_hvr',
				'type' => 'color',
				'title' => __('Widget Link Font Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/widget_link_font_color_on_hover.png',
				'text_desc' => __('Select font color for the footer widget links on hover.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Footer newsletter text input box background
			array(
				'id' => 'footer_news_txt_bg',
				'type' => 'color',
				'title' => __('Newsletter Text Input Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/newsletter_text_input_background_color.png',
				'text_desc' => __('Select background color for the widget newsletter in the footer.', 'coupon'),
				'std' => '#313131'
			),
			
			//Footer newsletter text input box border
			array(
				'id' => 'footer_news_txt_bord',
				'type' => 'color',
				'title' => __('Newsletter Input Border Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/newsletter_input_border_color.png',
				'text_desc' => __('Select border color for the widget newsletter input field in the footer.', 'coupon'),
				'std' => '#484848'
			),
			
			//Footer social icon font
			array(
				'id' => 'footer_social_font',
				'type' => 'color',
				'title' => __('Social Icons Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/footer_social_icons_font.png',
				'text_desc' => __('Select color for the widget social icons in the footer.', 'coupon'),
				'std' => '#484848'
			),
			
			//Category counter background
			array(
				'id' => 'footer_cat_count_bg',
				'type' => 'color',
				'title' => __('Badge Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/badge_background_color.png',
				'text_desc' => __('Select background color for the badge in the widget list (badge next to the categories or shops).', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Category counter font
			array(
				'id' => 'footer_cat_count_font',
				'type' => 'color',
				'title' => __('Badge Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/badge_font_color.png',
				'text_desc' => __('Select font color for the badge in the widget list (badge next to the categories or shops).', 'coupon'),
				'std' => '#313030'
			),
			
			//Dropdown background color
			array(
				'id' => 'footer_dropdown_bg',
				'type' => 'color',
				'title' => __('Dropdown Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/dropdown_background_color.png',
				'text_desc' => __('Select background color for the dropdown.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Dropdown background color on hover
			array(
				'id' => 'footer_dropdown_bg_hvr',
				'type' => 'color',
				'title' => __('Dropdown Background Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/dropdown_background_color_on_hover.png',
				'text_desc' => __('Select background color for the dropdown on hover.', 'coupon'),
				'std' => '#24b6ac'
			),

			//Dropdown font color
			array(
				'id' => 'footer_dropdown_font',
				'type' => 'color',
				'title' => __('Dropdown Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/dropdown_font_color.png',
				'text_desc' => __('Select font color for the dropdown.', 'coupon'),
				'std' => '#000000'
			),
			
			//Dropdown font color hover
			array(
				'id' => 'footer_dropdown_font_hvr',
				'type' => 'color',
				'title' => __('Dropdown Font Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/dropdown_font_color_on_hover.png',
				'text_desc' => __('Select font color for the dropdown on hover.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Dropdown container background
			array(
				'id' => 'footer_dropdown_cont_bg',
				'type' => 'color',
				'title' => __('Dropdown Content Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/dropdown_content_background_color.png',
				'text_desc' => __('Select background color for the dropdown content.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Dropdown container font color
			array(
				'id' => 'footer_dropdown_cont_font',
				'type' => 'color',
				'title' => __('Dropdown Content Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/dropdown_content_font_color.png',
				'text_desc' => __('Select font color for the dropdown content.', 'coupon'),
				'std' => '#000000'
			),
			
			//Dropdown container hover background
			array(
				'id' => 'footer_dropdown_cont_bg_hvr',
				'type' => 'color',
				'title' => __('Dropdown Content Background Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/dropdown_content_background_color_on_hover.png',
				'text_desc' => __('Select background color for the dropdown content on hover.', 'coupon'),
				'std' => '#000000'
			),
			
			//Dropdown container hover font
			array(
				'id' => 'footer_dropdown_cont_font_hvr',
				'type' => 'color',
				'title' => __('Dropdown Content Font Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/footer/dropdown_content_font_color_on_hover.png',
				'text_desc' => __('Select font color for the dropdown content on hover.', 'coupon'),
				'std' => '#ffffff'
			),
			
		)
	);
	
	/**********************************************************************
	***********************************************************************
	COPYRIGHT COLORS
	**********************************************************************/
	$sections[] = array(
		'title' => __('Copyright Colors', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_051_eye_open.png',
		'desc' => __('Set up colors for the copyright section.', 'coupon'),
		'fields' => array(
			//Copyright Background
			array(
				'id' => 'copyright_bg',
				'type' => 'color',
				'title' => __('Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/copyrights/background_color.png',
				'text_desc' => __('Select background color for the copyright section.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Copyright Font
			array(
				'id' => 'copyright_font',
				'type' => 'color',
				'title' => __('Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/copyrights/font_color.png',
				'text_desc' => __('Select font color for the copyright section.', 'coupon'),
				'std' => '#878686'
			),
			
		)
	);
	
	/**********************************************************************
	***********************************************************************
	RIGHT SIDEBAR COLORS
	**********************************************************************/
	$sections[] = array(
		'title' => __('Right Sidebar Colors', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_051_eye_open.png',
		'desc' => __('Set up colors for the right sidebar section.', 'coupon'),
		'fields' => array(
			//Sidebar Widgets Font
			array(
				'id' => 'sidebar_widg_font',
				'type' => 'color',
				'title' => __('Widget Text Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/widget_text_font_color.png',
				'text_desc' => __('Select font color for the text in the right sidebar widgets.', 'coupon'),
				'std' => '#000000'
			),
			
			//Sidebar widget link hover color
			array(
				'id' => 'sidebar_widg_lnk_hvr',
				'type' => 'color',
				'title' => __('Widget Link Font Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/widget_link_font_color_on_hover.png',
				'text_desc' => __('Select font color for the sidebar widget links on hover.', 'coupon'),
				'std' => '#8f8f8f'
			),	
			
			//Sidebar newsletter text input box background
			array(
				'id' => 'sidebar_news_txt_bg',
				'type' => 'color',
				'title' => __('Newsletter Text Input Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/newsletter_text_input_background_color.png',
				'text_desc' => __('Select background color for the widget newsletter in the right sidebar.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Sidebar newsletter text input box border
			array(
				'id' => 'sidebar_news_txt_bord',
				'type' => 'color',
				'title' => __('Newsletter Input Border Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/newsletter_input_border_color.png',
				'text_desc' => __('Select border color for the widget newsletter input field in the right sidebar.', 'coupon'),
				'std' => '#e7e7e7'
			),
			
			//Sidebar social icon font
			array(
				'id' => 'sidebar_social_font',
				'type' => 'color',
				'title' => __('Social Icons Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/social_icons_color.png',
				'text_desc' => __('Select color for the widget social icons in the right sidebar.', 'coupon'),
				'std' => '#000000'
			),			
			
			//Category counter background
			array(
				'id' => 'sidebar_cat_count_bg',
				'type' => 'color',
				'title' => __('Badge Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/badge_background_color.png',
				'text_desc' => __('Select background color for the badge in the widget list (badge next to the categories or shops).', 'coupon'),
				'std' => '#313030'
			),
			
			//Category counter font
			array(
				'id' => 'sidebar_cat_count_font',
				'type' => 'color',
				'title' => __('Badge Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/badge_font_color.png',
				'text_desc' => __('Select font color for the badge in the widget list (badge next to the categories or shops).', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Dropdown background color
			array(
				'id' => 'sidebar_dropdown_bg',
				'type' => 'color',
				'title' => __('Dropdown Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/dropdown_background_color.png',
				'text_desc' => __('Select background color for the dropdown.', 'coupon'),
				'std' => '#fefdfe'
			),
			
			//Dropdown background color on hover
			array(
				'id' => 'sidebar_dropdown_bg_hvr',
				'type' => 'color',
				'title' => __('Dropdown Background Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/dropdown_background_color_on_hover.png',
				'text_desc' => __('Select background color for the dropdown on hover.', 'coupon'),
				'std' => '#24b6ac'
			),

			//Dropdown font color
			array(
				'id' => 'sidebar_dropdown_font',
				'type' => 'color',
				'title' => __('Dropdown Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/dropdown_font_color.png',
				'text_desc' => __('Select font color for the dropdown.', 'coupon'),
				'std' => '#000000'
			),
			
			//Dropdown font color hover
			array(
				'id' => 'sidebar_dropdown_font_hvr',
				'type' => 'color',
				'title' => __('Dropdown Font Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/dropdown_font_color_on_hover.png',
				'text_desc' => __('Select font color for the dropdown on hover.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Dropdown container background
			array(
				'id' => 'sidebar_dropdown_cont_bg',
				'type' => 'color',
				'title' => __('Dropdown Content Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/dropdown_content_background_color.png',
				'text_desc' => __('Select background color for the dropdown content.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Dropdown container font color
			array(
				'id' => 'sidebar_dropdown_cont_font',
				'type' => 'color',
				'title' => __('Dropdown Content Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/dropdown_content_font_color.png',
				'text_desc' => __('Select font color for the dropdown content.', 'coupon'),
				'std' => '#000000'
			),
			
			//Dropdown container hover background
			array(
				'id' => 'sidebar_dropdown_cont_bg_hvr',
				'type' => 'color',
				'title' => __('Dropdown Content Background Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/dropdown_content_background_color_on_hover.png',
				'text_desc' => __('Select background color for the dropdown content on hover.', 'coupon'),
				'std' => '#000000'
			),
			
			//Dropdown container hover font
			array(
				'id' => 'sidebar_dropdown_cont_font_hvr',
				'type' => 'color',
				'title' => __('Dropdown Content Font Color On Hover', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/sidebarwidget/dropdown_content_font_color_on_hover.png',
				'text_desc' => __('Select font color for the dropdown content on hover.', 'coupon'),
				'std' => '#ffffff'
			),
		)
	);
	
	/**********************************************************************
	***********************************************************************
	MODAL COLORS
	**********************************************************************/
	$sections[] = array(
		'title' => __('Modal Colors', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_051_eye_open.png',
		'desc' => __('Set up colors for the modal section.', 'coupon'),
		'fields' => array(
			//Modal Background
			array(
				'id' => 'modal_bg',
				'type' => 'color',
				'title' => __('Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/modal/background_color.png',
				'text_desc' => __('Select background color for the modal window.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Modal Font
			array(
				'id' => 'modal_font',
				'type' => 'color',
				'title' => __('Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/modal/font_color.png',
				'text_desc' => __('Select font color for the modal window.', 'coupon'),
				'std' => '#ba1414'
			),
			
			//Modal Close Font
			array(
				'id' => 'modal_close_font',
				'type' => 'color',
				'title' => __('Modal Close Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/modal/modal_close_font_color.png',
				'text_desc' => __('Select font color for the modal window close link.', 'coupon'),
				'std' => '#e5e5e5'
			),	
		)
	);
	
	/**********************************************************************
	***********************************************************************
	HOME PAGE COLORS
	**********************************************************************/
	$sections[] = array(
		'title' => __('Home Page Colors', 'coupon') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_051_eye_open.png',
		'desc' => __('Set up colors for the home page section.', 'coupon'),
		'fields' => array(
			//Home page special background color
			array(
				'id' => 'special_bg',
				'type' => 'color',
				'title' => __('Special Category Section Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/homepage/special_category_section_background_color.png',
				'text_desc' => __('Select background color for the special category section.', 'coupon'),
				'std' => '#f9fbfb'
			),
			
			//Home page special item background color
			array(
				'id' => 'special_item_bg',
				'type' => 'color',
				'title' => __('Special Item Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/homepage/special_item_background_color.png',
				'text_desc' => __('Select background color for the special item.', 'coupon'),
				'std' => '#ffffff'
			),
			
			//Home page special item font color
			array(
				'id' => 'special_item_font',
				'type' => 'color',
				'title' => __('Special Item Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/homepage/special_item_font_color.png',
				'text_desc' => __('Select font color for the special item.', 'coupon'),
				'std' => '#000000'
			),
			
			//Home page tabs background
			array(
				'id' => 'home_tab_bg',
				'type' => 'color',
				'title' => __('Tabs Background Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/homepage/tabs_background_color.png',
				'text_desc' => __('Select background color for the tabs.', 'coupon'),
				'std' => '#ffffff'
			),	
			
			//Home page tabs font
			array(
				'id' => 'home_tab_font',
				'type' => 'color',
				'title' => __('Tabs Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/homepage/tabs_font_color.png',
				'text_desc' => __('Select font color for the tabs.', 'coupon'),
				'std' => '#000000'
			),
			
			//Home page tabs font hover
			array(
				'id' => 'home_tab_font_hvr',
				'type' => 'color',
				'title' => __('Active Tab Font Color', 'coupon') ,
				'desc' => '',
				'image_desc' => NHP_OPTIONS_URL.'img/couponer_image_desc/homepage/active_tab_font_color.png',
				'text_desc' => __('Select font color for the active tab.', 'coupon'),
				'std' => '#ffffff'
			),
			
		)
	);
	
	$coupon_opts = new NHP_Options($sections, $args, $tabs);
	}
if (class_exists('NHP_Options')){
	add_action('init', 'coupon_options', 10);
}
/* do shortcodes in the excerpt */
add_filter('the_excerpt', 'do_shortcode');

/* create captcha */
function coupon_captcha(){
	$num1 = rand( 1, 10 );
	$num2 = rand( 1, 10 );
	$total = $num1 + $num2;
	$_SESSION['total'] = $total;  

	$response = array(
		'num1' => $num1,
		'num2' => $num2,
		'captcha' => $num1.'+'.$num2.'='
	);	
	
	if( isset( $_POST['new_captcha'] ) ){
		echo json_encode( $response );
		die();
	}
	else{
		return $response;
	}
}
add_action('wp_ajax_captcha', 'lex_captcha');
add_action('wp_ajax_nopriv_captcha', 'lex_captcha');


/* include custom made widgets */
function coupon_widgets_init(){
	
	register_sidebar(array(
		'name' => __('Blog Sidebar', 'coupon') ,
		'id' => 'sidebar-right_blog',
		'before_widget' => '<div class="widget right_widget"><div class="blog-inner widget-inner"><div class="line-divider widget-line-divider"></div>',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="caption widget-caption"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears on the right side of the blog.', 'coupon')
	));
	
	register_sidebar(array(
		'name' => __('Page Sidebar', 'coupon') ,
		'id' => 'sidebar-right',
		'before_widget' => '<div class="widget right_widget"><div class="blog-inner widget-inner"><div class="line-divider widget-line-divider"></div>',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="caption widget-caption"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears on the right side of the page.', 'coupon')
	));
	
	register_sidebar(array(
		'name' => __('Bottom Sidebar 1', 'coupon') ,
		'id' => 'sidebar-bottom-1',
		'before_widget' => '<div class="widget footer_widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="caption footer-caption"><h3>',
		'after_title' => '</h3></div>',
		'description' => __('Appears at the bottom of the page.', 'coupon')
	));
	
	register_sidebar(array(
		'name' => __('Bottom Sidebar 2', 'coupon') ,
		'id' => 'sidebar-bottom-2',
		'before_widget' => '<div class="widget footer_widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="caption footer-caption"><h3>',
		'after_title' => '</h3></div>',
		'description' => __('Appears at the bottom of the page.', 'coupon')
	));
	
	register_sidebar(array(
		'name' => __('Bottom Sidebar 3', 'coupon') ,
		'id' => 'sidebar-bottom-3',
		'before_widget' => '<div class="widget footer_widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="caption footer-caption"><h3>',
		'after_title' => '</h3></div>',
		'description' => __('Appears at the bottom of the page.', 'coupon')
	));
	
	register_sidebar(array(
		'name' => __('Bottom Sidebar 4', 'coupon') ,
		'id' => 'sidebar-bottom-4',
		'before_widget' => '<div class="widget footer_widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="caption footer-caption"><h3>',
		'after_title' => '</h3></div>',
		'description' => __('Appears at the bottom of the page.', 'coupon')
	));
}

add_action('widgets_init', 'coupon_widgets_init');

if( !function_exists( 'coupon_post_types_and_taxonomies' ) ){
	function coupon_post_types_and_taxonomies(){
		register_post_type( 'shop', array(
			'labels' => array(
				'name' => __( 'Shops', 'coupon' ),
				'singular_name' => __( 'Shop', 'coupon' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-cart',
			'has_archive' => false,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'custom-fields'
			)
		));	
		
		register_post_type( 'code', array(
			'labels' => array(
				'name' => __( 'Codes', 'coupon' ),
				'singular_name' => __( 'Code', 'coupon' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-tag',
			'has_archive' => false,
			'supports' => array(
				'title',
				'editor',
				'custom-fields'
			)
		));	
		

		register_taxonomy( 'code_category', array( 'code' ), array(
			'label' => __( 'Code Categories', 'coupon' ),
			'hierarchical' => true,
			'labels' => array(
				'name' 							=> __( 'Code Categories', 'coupon' ),
				'singular_name' 				=> __( 'Code Category', 'coupon' ),
				'menu_name' 					=> __( 'Code Category', 'coupon' ),
				'all_items'						=> __( 'All Code Categories', 'coupon' ),
				'edit_item'						=> __( 'Edit Code Category', 'coupon' ),
				'view_item'						=> __( 'View Code Category', 'coupon' ),
				'update_item'					=> __( 'Update Code Category', 'coupon' ),
				'add_new_item'					=> __( 'Add New Code Category', 'coupon' ),
				'new_item_name'					=> __( 'New Code Category Name', 'coupon' ),
				'parent_item'					=> __( 'Parent Code Category', 'coupon' ),
				'parent_item_colon'				=> __( 'Parent Code Category:', 'coupon' ),
				'search_items'					=> __( 'Search Code Categories', 'coupon' ),
				'popular_items'					=> __( 'Popular Code Categories', 'coupon' ),
				'separate_items_with_commas'	=> __( 'Separate code categories with commas', 'coupon' ),
				'add_or_remove_items'			=> __( 'Add or remove code categories', 'coupon' ),
				'choose_from_most_used'			=> __( 'Choose from the most used code categories', 'coupon' ),
				'not_found'						=> __( 'No code categories found', 'coupon' ),
			)
		
		) );
		
		register_post_type( 'faq', array(
			'labels' => array(
				'name' => __( 'FAQ', 'coupon' ),
				'singular_name' => __( 'FAQ', 'coupon' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-sos',
			'has_archive' => false,
			'supports' => array(
				'title',
				'editor'
			)
		));	
		
		register_post_type( 'daily_offer', array(
			'labels' => array(
				'name' => __( 'Daily Offers', 'coupon' ),
				'singular_name' => __( 'Daily Offer', 'coupon' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-megaphone',
			'has_archive' => false,
			'supports' => array(
				'title',
				'editor',
				'thumbnail'
			)
		));	
	}
}
add_action('init', 'coupon_post_types_and_taxonomies', 0);

function coupon_set_direction() {
	global $wp_locale, $wp_styles;

	$_user_id = get_current_user_id();
	$direction = coupon_get_option( 'direction' );
	if( empty( $direction ) ){
		$direction = 'ltr';
	}

	if ( $direction ) {
		update_user_meta( $_user_id, 'rtladminbar', $direction );
	} else {
		$direction = get_user_meta( $_user_id, 'rtladminbar', true );
		if ( false === $direction )
			$direction = isset( $wp_locale->text_direction ) ? $wp_locale->text_direction : 'ltr' ;
	}

	$wp_locale->text_direction = $direction;
	if ( ! is_a( $wp_styles, 'WP_Styles' ) ) {
		$wp_styles = new WP_Styles();
	}
	$wp_styles->text_direction = $direction;
}
add_action( 'init', 'coupon_set_direction' );


/* add scripts and styles for the admin section */
function coupon_admin_resources(){
	wp_enqueue_style( 'coupon-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
}
add_action('init', 'coupon_admin_resources');


/* =======================================================================LOGIN AND REGISTER FUNCTION */

/* get url by page template */
function coupon_get_permalink_by_tpl( $template_name ){
	$page = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => $template_name . '.php'
	));
	if(!empty($page)){
		return get_permalink($page[0]->ID);
	}
	else{
	return "javascript:;";
	}
}

/* get login URL */
function coupon_register_login_url() {
   return coupon_get_permalink_by_tpl( 'page-tpl_register_login' );
}

/*common for gmap and for culture gallery*/
function coupon_confirm_hash( $length = 100 ) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $random_string;
}

/* add user activation user status to the columns */
function coupon_active_column($columns) {
    $columns['active'] = __( 'Activation Status', 'coupon' );
    return $columns;
}
add_filter('manage_users_columns', 'coupon_active_column');
 
/* add user activation user status data to the columns */
function coupon_active_column_content( $value, $column_name, $user_id ){
	$usermeta = get_user_meta( $user_id, 'coupon_user_meta' );
    $usermeta = array_shift( $usermeta );
	if ( 'active' == $column_name ){
		if( empty( $usermeta ) ||  $usermeta['active_status'] == "active" ){
			return __( 'Activated', 'coupon' );
		}
		else{
			return __( 'Need Confirmation', 'coupon' );
		}
	}
    return $value;
}
add_action('manage_users_custom_column',  'coupon_active_column_content', 10, 3);


add_action( 'show_user_profile', 'couponer_edit_user_status' );
add_action( 'edit_user_profile', 'couponer_edit_user_status' );

function couponer_edit_user_status( $user ){
	$usermeta = get_user_meta( $user->ID, 'coupon_user_meta' );
    $usermeta = array_shift( $usermeta );	
    ?>
        <h3><?php _e( 'User Status', 'coupon' ) ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="user_status"><?php _e( 'User Status', 'coupon' ); ?></label></th>
                <td>
                	<select name="active_status">
                		<option <?php echo !empty( $usermeta ) && $usermeta['active_status'] != 'active' ? 'selected="selected"' : '' ?> value="inactive"><?php _e( 'Inactive', 'coupon' ) ?></option>
                		<option <?php echo empty( $usermeta ) || $usermeta['active_status'] == 'active' ? 'selected="selected"' : '' ?> value="active"><?php _e( 'Active', 'coupon' ) ?></option>
                	</select>
                </td>
            </tr>
        </table>
    <?php
}


add_action( 'personal_options_update', 'couponer_save_user_meta' );
add_action( 'edit_user_profile_update', 'couponer_save_user_meta' );

function couponer_save_user_meta( $user_id ){
	$usermeta = get_user_meta( $user_id, 'coupon_user_meta' );
	$usermeta = array_shift( $usermeta );
    if( !empty( $usermeta ) ){
    	$usermeta['active_status'] = $_POST['active_status'];
    }
    update_user_meta( $user_id,'coupon_user_meta', $usermeta );
}

/* remove admin bar for all except for admins */
function coupon_remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}
add_action('after_setup_theme', 'coupon_remove_admin_bar');
/* =======================================================================END LOGIN AND REGISTER FUNCTION */


/* get number of custom posts by post type */
function coupon_custom_post_count( $type ){
	$num_posts = wp_count_posts( $type );

	return intval( $num_posts->publish );
}

/* add number of cars to the "At a glance" box on Dashboard. Aslo add number of pennding cars if there is any */
function coupon_add_custom_post_count(){

	$post_types = array( 'shop', 'code', 'faq', 'daily_offer' );
    foreach( $post_types as $type ) {
        if( ! post_type_exists( $type ) ){
			continue;
		}
        $num_posts = wp_count_posts( $type );
		$published = intval( $num_posts->publish );
		$post_type = get_post_type_object( $type );
		$text = _n( '%s ' . $post_type->labels->singular_name, '%s ' . $post_type->labels->name, $published, 'your_textdomain' );
		$text = sprintf( $text, number_format_i18n( $published ) );
		if ( current_user_can( $post_type->cap->edit_posts ) ) {
			$items[] = '<a class="'.$type.'-count" href="edit.php?post_type='.$type.'">'.$text."</a>\n";
		} else {
			$items[] = '<span class="'.$type.'-count">'.$text."</span>\n";
		}
		
        if ( $num_posts->pending > 0 ){
			$text = _n( '%s ' . $post_type->labels->singular_name . __( 'Pending', 'coupon' ), '%s ' . $post_type->labels->name . __( 'Pending', 'coupon' ), $published, 'your_textdomain' );
			$pending = intval( $num_posts->publish );
			$text = sprintf( $text, number_format_i18n( $pending  ) );
			if ( current_user_can( $post_type->cap->edit_posts ) ) {
				$items[] = '<a class="'.$type.'-count" href="edit.php?post_type='.$type.'">'.$text."</a>\n";
			} else {
				$items[] = '<span class="'.$type.'-count">'.$text."</span>\n";
			}
		}
    }
    return $items;
}
add_action('dashboard_glance_items', 'coupon_add_custom_post_count');

/* create icons for the custom post types in the At A Glance box */
function coupon_custom_post_icons(){
	echo "	<style type='text/css'>
				#dashboard_right_now a.shop-count:before,
				#dashboard_right_now span.shop-count:before {
				  content: '\\f174';
				}	
				#dashboard_right_now a.code-count:before,
				#dashboard_right_now span.code-count:before {
				  content: '\\f323';
				}
				#dashboard_right_now a.faq-count:before,
				#dashboard_right_now span.faq-count:before {
				  content: '\\f468';
				}
				#dashboard_right_now a.daily_offer-count:before,
				#dashboard_right_now span.daily_offer-count:before {
				  content: '\\f488';
				}				
             </style>";
}
add_action( 'admin_head', 'coupon_custom_post_icons' );

/* total_defaults */
function coupon_defaults( $id ){	
	$defaults = array(
		'site_slider' => '',
		'direction' => 'ltr',
		'site_slider_bg_color' => '#24caac',
		'site_favicon' => '',
		'navigation_style' => 'style_1',
		'membership' => 'yes',
		'ajax_categories' => 'no',
		'lost_password_message' => '',
		'code_dailly_ratings' => array(),
		'registration_message' => '',
		'top_bar_logo' => '',
		'top_bar_logo_padding' => '22px 0px 0px 0px',
		'top_bar_logo_width' => '140px',
		'copyright_text' => '',
		'seo-keywords' => '',
		'seo-description' => '',
		'category_order_by' => 'name',
		'category_order' => 'ASC',
		'show_code_text' => 'SHOW CODE',
		'pack_open_text' => 'PACK CODE AND OPEN',
		'check_discount_text' => 'CHECK DISCOUNT',
		'show_in_listings' => '',
		'popular_sort' => 'clicks',
		'search_per_page' => '10',
		'expiring_per_page' => '10',
		'featured_per_page' => '10',
		'newest_per_page' => '10',
		'popular_per_page' => '10',
		'shop_listing_per_page' => '10',
		'daily_offers_per_page' => '10',
		'new_code_email' => '',
		'mail_chimp_api' => '',
		'mail_chimp_list_id' => '',
		'home_groups' => '',
		'site_slogan' => '',
		'site_sub_slogan' => '',
		'codes_num' => '20',
		'home_promo_cat' => '',
		'home_promo_cat_num' => '3',
		'home_latest_blogs' => '3',
		'contact_form_title' => '',
		'contact_email' => '',
		'site_color' => '#24b6ac',
		'btn_color_hvr' => '#24caac',
		'borders_color' => '#e5e5e5',
		'input_text' => '#d1d0d0',
		'nav_hold_bg' => '#ffffff',
		'nav_hold_border' => '#e7e7e7',
		'nav_fist_lvl_color' => '#626262',
		'nav_sub_bg' => '#ffffff',
		'nav_sub_font' => '#626262',
		'nav_sub_bg_hvr' => '#24b6ac',
		'nav_sub_font_hvr' => '#ffffff',
		'slogan_color' => '#ffffff',
		'ajax_drop_con_bg' => '#292929',
		'ajax_drop_con_font' => '#ffffff',
		'ajax_drop_con_bg_hvr' => '#ffffff',
		'ajax_drop_con_font_hvr' => '#000000',
		'ajax_drop_placeholder_hvr' => '#dadada',
		'dropdown_bg' => '#fefdfe',
		'dropdown_font' => '#000000',
		'dropdown_cont_bg' => '#ffffff',
		'dropdown_cont_font' => '#000000',
		'dropdown_cont_bg_hvr' => '#000000',
		'dropdown_cont_font_hvr' => '#ffffff',
		'body_bg' => '#ffffff',
		'page_title_divider' => '#e5e5e5',
		'titles_color' => '#333333',
		'text_color' => '#6d6d6d',
		'discount_arrow_color' => '#e5e5e5',
		'shop_filter' => '#ffffff',
		'top_20_tabs_font_color' => '#000000',
		'active_top_20_tabs_font_color' => '#ffffff',
		'pag_font_color' => '#000000',
		'active_pag_font_color' => '#ffffff',
		'feat_lab_bg' => '#ff8b02',
		'feat_lab_font' => '#ffffff',
		'item_meta_color' => '#8f8f8f',
		'item_meta_icon_color' => '#dadada',
		'countdown_info_font' => '#292929',
		'pack_bg' => '#2ca9e0',
		'show_pack_font' => '#ffffff',
		'side_arows' => '#ffffff',
		'log_reg_err' => '#ff4f53',
		'orange_promo' => '#ff8b02',
		'footer_bg' => '#292929',
		'footer_widg_cap' => '#ffffff',
		'footer_widg_text' => '#9d9c9c',
		'footer_widg_link_hvr' => '#ffffff',
		'footer_news_txt_bg' => '#313131',
		'footer_news_txt_bord' => '#484848',
		'footer_social_font' => '#484848',
		'footer_cat_count_bg' => '#ffffff',
		'footer_cat_count_font' => '#313030',
		'footer_dropdown_bg' => '#ffffff',
		'footer_dropdown_bg_hvr' => '#24b6ac',
		'footer_dropdown_font' => '#000000',
		'footer_dropdown_font_hvr' => '#ffffff',
		'footer_dropdown_cont_bg' => '#ffffff',
		'footer_dropdown_cont_font' => '#000000',
		'footer_dropdown_cont_bg_hvr' => '#000000',
		'footer_dropdown_cont_font_hvr' => '#ffffff',		
		'copyright_bg' => '#ffffff',
		'copyright_font' => '#878686',
		'sidebar_widg_font' => '#000000',
		'sidebar_widg_lnk_hvr' => '#8f8f8f',
		'sidebar_news_txt_bg' => '#ffffff',
		'sidebar_news_txt_bord' => '#e7e7e7',
		'sidebar_social_font' => '#000000',
		'sidebar_cat_count_bg' => '#313030',
		'sidebar_cat_count_font' => '#ffffff',
		'sidebar_dropdown_bg' => '#fefdfe',
		'sidebar_dropdown_bg_hvr' => '#24b6ac',
		'sidebar_dropdown_font' => '#000000',
		'sidebar_dropdown_font_hvr' => '#ffffff',
		'sidebar_dropdown_cont_bg' => '#ffffff',
		'sidebar_dropdown_cont_font' => '#000000',
		'sidebar_dropdown_cont_bg_hvr' => '#000000',
		'sidebar_dropdown_cont_font_hvr' => '#ffffff',
		'modal_bg' => '#ffffff',
		'modal_font' => '#ba1414',
		'modal_close_font' => '#e5e5e5',
		'special_bg' => '#f9fbfb',
		'special_item_bg' => '#ffffff',
		'special_item_font' => '#000000',
		'home_tab_bg' => '#ffffff',
		'home_tab_font' => '#000000',
		'home_tab_font_hvr' => '#ffffff',	
	);
	
	if( isset( $defaults[$id] ) ){
		return $defaults[$id];
	}
	else{
		
		return '';
	}
}

/* get option from theme options */
function coupon_get_option($id){
	global $coupon_opts;
	if( isset( $coupon_opts ) ){
		$value = $coupon_opts->get($id);
		if( isset( $value ) ){
			return $value;
		}
		else{
			return coupon_defaults( $id );
		}
	}
	else{
		return coupon_defaults( $id );
	}	
}

	/* setup neccessary theme support, add image sizes */
function coupon_setup(){
	load_theme_textdomain('coupon', get_template_directory() . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('html5', array(
		'comment-form',
		'comment-list'
	));
	register_nav_menu('top-navigation', __('Top Navigation', 'coupon'));
	
	add_theme_support('post-thumbnails',array( 'post', 'pages', 'shop', 'daily_offer' ));
	
	set_post_thumbnail_size(380, 250, true);
	if (function_exists('add_image_size')){
		add_image_size( 'shop_logo', 0, 75, false );
		add_image_size( 'daily_offer', 265, 130, true );
		add_image_size( 'blog_latest', 350, 215, true );
		add_image_size( 'blog_large', 848, 530, true);	
	}

	add_theme_support('custom-header');
	add_theme_support('custom-background');
	add_theme_support('post-formats',array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ));
	add_editor_style();
}
add_action('after_setup_theme', 'coupon_setup');

/* get ratings of the couponer */
function coupon_get_rate_average( $post_id ){
	global $wpdb;
	$average = 0;
	
	$result = $wpdb->get_results( "SELECT COUNT(*) AS count, SUM(meta_value) AS sum FROM {$wpdb->postmeta} WHERE post_id='".$post_id."' AND meta_key='coupon_rating'" );
	$result = array_shift( $result );

	return $result;
}

function coupon_calculate_ratings( $post_id ){
	$rate = '<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';

	$result = coupon_get_rate_average( $post_id );
	
	if( $result->count > 0 ) {
		$average = get_post_meta( $post_id, 'coupon_average_rate', true );
		if( $average <= 0.25 ){
			$rate = '<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 0.75 ){
			$rate = '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 1.25 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 1.75 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 2.25 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 2.75 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 3.25 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 3.75 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 4.25 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average < 4.75 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
		}
		else{
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
		}
	}

	$votes = $result->count.' '.( ( $result->count == 1 ) ? __( 'rate', 'coupon' ) : __( 'rates', 'coupon' ) );

	return $rate.' <span> ('.$votes.')</span>';
}

/* get ratings of the coupon */
function coupon_get_ratings( $post_id = '' ){
	if( empty( $post_id ) ){
		$post_id = get_the_ID();
	}

	$rate = coupon_calculate_ratings( $post_id );

	return '<div class="item-ratings" data-post_id="'.$post_id.'">
				'.$rate.'
			</div>';
}

function coupon_write_ratings(){
	global $wpdb;
	$rate = $_POST['rate'];
	$post_id = $_POST['post_id'];

	$result = coupon_get_rate_average( $post_id );
	$avg = get_post_meta( $post_id, 'coupon_average_rate', true );
	$sum = $result->count * $avg;

	$check_vote = $wpdb->get_results( "SELECT * FROM {$wpdb->postmeta} WHERE post_id='".$post_id."' AND meta_key='coupon_rating' AND meta_value LIKE '".$_SERVER['REMOTE_ADDR']."%'" );
	$check_vote = array_shift( $check_vote );
	if( !empty( $check_vote ) ){
		$temp = explode( '|', $check_vote->meta_value );
		$old_value = $temp[1];
		$sum -= $old_value;
		$result->count -= 1;

		$check_vote = $wpdb->get_results( "DELETE FROM {$wpdb->postmeta} WHERE post_id='".$post_id."' AND meta_key='coupon_rating' AND meta_value LIKE '".$_SERVER['REMOTE_ADDR']."%'" );
	}
	add_post_meta( $post_id, 'coupon_rating', $_SERVER['REMOTE_ADDR'].'|'.$rate );
		
	$average = 0;
	$average = number_format( ( $sum + $rate ) / ( $result->count + 1 ), 2 );
	update_post_meta( $post_id, 'coupon_average_rate', $average );
	
	$rate = coupon_calculate_ratings( $post_id );

	echo $rate;
	die();
}
add_action('wp_ajax_write_rate', 'coupon_write_ratings');
add_action('wp_ajax_nopriv_write_rate', 'coupon_write_ratings');

/* get post attachements by attachement mime type */
function coupon_get_post_attachement( $post_id, $att_type ){
	$attachments = get_posts( array(
		'post_type' => 'attachment',
		'post_mime_type' => $att_type,
		'numberposts' => -1,
		'post_parent' => $post_id
	));
	
	return $attachments;
}

/* setup neccessary styles and scripts */
function coupon_scripts_styles(){


	wp_enqueue_style( 'coupon-navigation-font', "http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" );
	wp_enqueue_style( 'coupon-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'coupon-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'coupon-slider', get_template_directory_uri() . '/css/slider.css' );
	wp_enqueue_style( 'coupon-flexslider', get_template_directory_uri() . '/css/flexslider.css' );
	wp_enqueue_style( 'coupon-owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css' );

	/* load style.css */
	wp_enqueue_style('coupon-style', get_stylesheet_uri() , array());
	wp_enqueue_style('dynamic-layout', admin_url('admin-ajax.php').'?action=dynamic_css', array());	
	
	if (is_singular() && comments_open() && get_option('thread_comments')){
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	
	wp_enqueue_script( 'coupon-jquery-library', get_template_directory_uri() . '/js/jquery.library.js', false, false, true );
	wp_enqueue_script( 'coupon-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', false, false, true );
	wp_enqueue_script( 'coupon-bootstrap-multilevel-js', get_template_directory_uri() . '/js/bootstrap-dropdown-multilevel.js', false, false, true );
	wp_enqueue_script( 'coupon-bootstrap-slider', get_template_directory_uri() . '/js/bootstrap-slider.js', false, false, true );
	wp_enqueue_script( 'coupon-flexslider',  get_template_directory_uri() . '/js/jquery.flexslider-min.js', false, false, true );
	wp_enqueue_script( 'coupon-form-validation',  get_template_directory_uri() . '/js/form_validation.js', false, false, true );
	wp_enqueue_script( 'coupon-carousel',  get_template_directory_uri() . '/js/owl.carousel.min.js', false, false, true );
	wp_enqueue_script( 'coupon-countdown',  get_template_directory_uri() . '/js/countdown.js', false, false, true );
	wp_enqueue_script( 'coupon-zeroclipboard',  get_template_directory_uri() . '/js/ZeroClipboard.min.js', false, false, true );
	wp_enqueue_script( 'coupon-custom', get_template_directory_uri() . '/js/custom.js', false, false, true );
	wp_localize_script( 'coupon-custom', 'coupon_data', array(
		'url' => get_template_directory_uri()
	) );

}
add_action('wp_enqueue_scripts', 'coupon_scripts_styles');

/* add main css dynamically so it can support changing collors */
function coupon_dynaminc_css() {
  require(get_template_directory().'/css/main-color.css.php');
  exit;
}
add_action('wp_ajax_dynamic_css', 'coupon_dynaminc_css');
add_action('wp_ajax_nopriv_dynamic_css', 'coupon_dynaminc_css');

/* format date and time that will be shown on comments, blogs, cars .... */
function coupon_format_post_date($date, $format){
	return date($format, strtotime($date));
}

/* return textual represetnation of the code type */
if( !function_exists( 'coupon_code_type' ) ){
	function coupon_code_type( $code_type ){
		switch( $code_type ){
			case '1' : return '<div class="featured-mask"><p>'.__( 'FEATURED', 'coupon' ).'</p></div>'; break;
			default	 : return ''; break;
		}
	}
}

/* add admin-ajax */
function coupon_custom_head(){
	echo '<script type="text/javascript">var ajaxurl = \'' . admin_url('admin-ajax.php') . '\';</script>';
}
add_action('wp_head', 'coupon_custom_head');

function coupon_smeta_images( $meta_key, $post_id, $default, $post_id ){
	if(class_exists('SM_Frontend')){
		global $sm;
		return $result = $sm->sm_get_meta($meta_key, $post_id);
	}
	else{		
		return $default;
	}
}

/* check if smeta plugin is installed */
function coupon_get_smeta( $meta_key, $post_data = '', $default ){
	if( !empty( $post_data[$meta_key] ) ){
		return $post_data[$meta_key][0];
	}
	else{
		return $default;
	}
}	

/* return list of the all custom post type shops */
function coupon_get_shops_list(){
	$shop_array = array();
	$shops = get_posts( array(  'post_type' => 'shop', 'post_status' => 'publish', 'posts_per_page' => -1 ) );
	
	foreach( $shops as $shop ){
		$shop_array[$shop->ID] = $shop->post_title;
	}
	
	return $shop_array;
}

/* add custom meta fields using smeta to post types. */
function coupon_custom_meta_boxes(){
	/* add custom meta for the daily offer post type */
	$daily_meta = array(
		array(
			'id' => 'offer_expire',
			'name' => __( 'Expire date', 'coupon' ),
			'type' => 'datetime_unix'
		),
		array(
			'id' => 'offer_shop_logo',
			'name' => __('Add Offer Shop Logo','carell'),
			'type' => 'image',
		) ,
		array(
			'id' => 'offer_shop_url',
			'name' => __('Add Offer Shop URL','carell'),
			'type' => 'text',
		) ,
		array(
			'id' => 'offer_images',
			'name' => __('Add Offer Images','carell'),
			'type' => 'image',
			'repeatable' => 1
		) ,
		array(
			'id' => 'offer_url',
			'name' => __( 'Buy URL', 'coupon' ),
			'type'	=> 'text'
		),
		array(
			'id' => 'promo_text',
			'name' => __( 'Promo Text', 'coupon' ),
			'type' => 'textarea'
		),
	);
	$meta_boxes[] = array(
		'title' => __( 'Add daily offer data', 'coupon' ),
		'pages' => 'daily_offer',
		'fields' => $daily_meta,
	);
	
	/* add custom meta fields to the code custom post type */
	$code_meta = array(
		array(
			'id' => 'pending_shop_url',
			'name' => __( 'Link to the shop if the code is frontend submited', 'coupon' ),
			'type' => 'text'
		),	
		array(
			'id' => 'coupon_label',
			'name' => __( 'Select code type', 'coupon' ),
			'type' => 'select',
			'options' => array(
				'coupon' => __( 'Coupon', 'coupon' ),
				'discount' => __( 'Discount', 'coupon' )
			)
		),
		array(
			'id' => 'code_shop_id',
			'name' => __( 'Select shop from which the code is', 'coupon' ),
			'type' => 'select',
			'options' => coupon_get_shops_list()
		),	
		array(
			'id' => 'code_api',
			'name' => __( 'Link to the shop\'s API for direct access with the code', 'coupon' ),
			'type' => 'text'
		),
		array(
			'id' => 'code_couponcode',
			'name' => __( 'Coupon code', 'coupon' ),
			'type'	=> 'text'
		),
		array(
			'id' => 'code_conditions',
			'name' => __( 'Conditions', 'coupon' ),
			'type' => 'textarea'
		),
		array(
			'id' => 'code_discount',
			'name' => __( 'Code Discount', 'coupon' ),
			'type' => 'text'
		),
		array(
			'id' => 'code_text',
			'name' => __( 'Code Text', 'coupon' ),
			'type' => 'text'
		),
		array(
			'id' => 'code_expire',
			'name' => __( 'Expire date', 'coupon' ),
			'type' => 'datetime_unix'
		),
		array(
			'id' => 'code_for',
			'name' => __( 'Code for', 'coupon' ),
			'type' => 'select',
			'options' => array(
				'all_users' => __( 'All Users', 'coupon' ),
				'members_only' => __( 'Members Only', 'coupon' ),
				//'guests_only' => __( 'Guests Only', 'coupon' )
			)
		),
		array(
			'id' => 'code_type',
			'name' => __( 'Code Type', 'coupon' ),
			'type' => 'select',
			'options' => array(
				'2' => __( 'Normal', 'coupon' ),
				'1' => __( 'Featured', 'coupon' ),
			)
		),
		array(
			'id' => 'code_force_top20',
			'name' => __( 'Where to be in TOP 20 (leave empty to not force to TOP 20)', 'coupon' ),
			'type' => 'text',
		),
	);
	$meta_boxes[] = array(
		'title' => __( 'Add coupon data', 'coupon' ),
		'pages' => 'code',
		'fields' => $code_meta,
	);
	
	/* add custom meta fields to the posts */
	$shops_meta = array(
		array(
			'id' => 'shop_link',
			'name' => __( 'Shop Link', 'coupon' ),
			'type' => 'text'
		)
	);
	$meta_boxes[] = array(
		'title' => __( 'Add shop data', 'coupon' ),
		'pages' => 'shop',
		'fields' => $shops_meta,
	);	
	
	$page_meta = array(
		array(
			'id' => 'html_title',
			'name' => __( 'Input page html title', 'coupon' ),
			'type' => 'text',
		),
		array(
			'id' => 'subtitle',
			'name' => __( 'Input page subtitle', 'coupon' ),
			'type' => 'text',
		),				
	);
	$meta_boxes[] = array(
		'title' => __( 'Add page data', 'coupon' ),
		'pages' => array( 'page', 'daily_offer' ),
		'fields' => $page_meta,
	);
	
	return $meta_boxes;
}

add_filter('sm_meta_boxes', 'coupon_custom_meta_boxes');

/* check for html title before the regular one */
function coupon_page_title(){
	$post_id = get_the_ID();
	$html_title = '';
	if( !empty( $post_id ) ){
		$post_meta = get_post_meta( $post_id );
		$html_title = coupon_get_smeta( 'html_title', $post_meta, '' );
	}
	if( !empty( $html_title ) ){
		return $html_title;
	}
	else{
		return get_the_title();
	}
	
}

/* get subtitle of a page */
function coupon_page_subtitle(){
	$post_id = get_the_ID();
	$subtitle = '';
	if( !empty( $post_id ) ){
		$post_meta = get_post_meta( $post_id );
		$subtitle = coupon_get_smeta( 'subtitle', $post_meta, '' );
	}
	
	
	return $subtitle;
}

/* get data of the attached image */
function coupon_get_attachment( $attachment_id, $size ){
	$attachment = get_post( $attachment_id );
	if( !empty( $attachment ) ){
	$att_data_thumb = wp_get_attachment_image_src( $attachment_id, $size );
		return array(
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => $attachment->guid,
			'src' => $att_data_thumb[0],
			'title' => $attachment->post_title
		);
	}
	else{
		return array(
			'alt' => '',
			'caption' => '',
			'description' => '',
			'href' => '',
			'src' => '',
			'title' => '',
		);
	}
}
function coupon_get_daily_list(){
	$query = new WP_Query( array(
		'posts_per_page' => coupon_get_option( 'codes_num' ),
		'post_type' => 'daily_offer',
		'post_status' => 'publish',
		'order' => 'DESC',
		'meta_query' => array(
			array(
				'key' => 'offer_expire',
				'value' => time(),
				'compare' => '>'
			)
		)
	));
	if( $query->have_posts() ){
		$counter = 0;
		$max_count = 4;
		$col_md = 3;
		while( $query->have_posts() ){
			$query->the_post();
			include( locate_template( 'includes/content-daily_offer.php' ) );
		}
	}
	wp_reset_query();
}

/* get coupons by ratings or date added or number of clicks */
function coupon_get_list( $order_by ){
	$data = array();
	if( !empty( $order_by ) ){
		$args = array(
			'posts_per_page' => coupon_get_option( 'codes_num' ),
			'post_type' => 'code',
			'post_status' => 'publish',
			'order' => 'DESC',
			'meta_query'	=> array(
				'relation'	=> 'AND',
				array(
					'key' => 'code_for',
					'value' => 'all_users',
					'compare' => '='
				),
				array(
					'key' => 'code_expire',
					'value' => time(),
					'compare' => '>'
				),		
			)
		);
		switch( $order_by ){
			case 'clicks' : $args['meta_key'] ='code_clicks'; $args['orderby'] = 'meta_value_num'; break;
			case 'ratings' : $args['meta_key'] ='coupon_average_rate'; $args['orderby'] = 'meta_value_num'; break;
			case 'date'	  : $args['orderby'] ='date'; break;
			case 'feature': $args['meta_key'] = 'code_type'; $args['orderby'] = 'meta_value_num'; $args['meta_query'][] = array( 'key' => 'code_type', 'value' => '1', 'compare' => '=' ); break;
		}

		$query = new WP_Query( $args );
		$data =  $query->get_posts();
		wp_reset_query();
	}
	
	return $data;
}

if( !function_exists( 'coupon_home_list' ) ){
	function coupon_home_list( $codes ){
		if( !empty( $codes ) ){	
			$has_ratings = coupon_get_option( 'code_dailly_ratings' );
			$counter = 0;
			foreach( $codes as $code ){
			$content = $code->post_content;
			$length = strlen( $content );
			$content = strip_tags( $content );
			$content = substr( $content, 0 , 58 );
			$content .= $length > 58 ? '...' : '';
			
			$code_meta = get_post_meta( $code->ID );
			$code_type = coupon_get_smeta( 'code_type', $code_meta, '2' );
			$code_text = coupon_get_smeta( 'code_text', $code_meta, '' );
			$expire_timestamp = coupon_get_smeta( 'code_expire', $code_meta, time() );
			$shop_id = coupon_get_smeta( 'code_shop_id', $code_meta, '' );
			$code_api = coupon_get_smeta( 'code_api', $code_meta, '' );
			$code_couponcode = coupon_get_smeta( 'code_couponcode', $code_meta, '' );
			$coupon_label = coupon_get_smeta( 'coupon_label', $code_meta, '' );			
			if( $counter == 4 ){
			$counter = 0;
			?>
			</div>
			</div>
			<div class="featured-container col-md-12">
			<div class="row">
			<?php
			}
			$counter++;
			?>
				<!-- item-1 -->
				<div class="featured-item-container col-md-3">
					<div class="featured-item">
						<?php  echo coupon_code_type( $code_type ) ?>
						<?php if( has_post_thumbnail( $shop_id ) ): ?>
							<div class="logotype">
								<div class="logotype-image">
									<?php echo get_the_post_thumbnail( $shop_id, 'shop_logo' ); ?>
								</div>						
							</div>
							<?php endif; ?>
							<div class="featured-item-content">
								<a href="<?php echo get_permalink( $code->ID ) ?>"><h4><?php echo $code->post_title; ?></h4></a>
								<p><?php echo apply_filters( 'the_content', $content ); ?></p>
							<?php
							if( in_array( 'code', $has_ratings ) ){
								echo coupon_get_ratings( $code->ID );
							}
							?>
						</div>
						<div class="item-meta">
							<ul class="list-inline list-unstyled">
								<li>
									<a href="javascript:;">
										<span class="fa fa-clock-o"></span><?php echo coupon_remaining_time( $expire_timestamp ); ?>
									</a>
								</li>
								<?php 
								$label = coupon_label( $code->ID ); 
								if( !empty( $label ) ){
								?>
									<li>
										<a href="<?php echo esc_url( coupon_get_label_link( $shop_id, $code->ID ) ); ?>">
											<span class="fa fa-tag"></span><?php echo $label; ?>
										</a>
									</li>
								<?php
								}
								?>
								<li class="pull-right">
									<a href="<?php echo esc_url( get_permalink( $shop_id ) ); ?>">
										<span class="fa fa-plus-square"></span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- .item-1 -->
			<?php
			}
		}
	}
}
/* return permalink by label term */
function coupon_get_label_link( $shop_id, $code_id ){
	$post_meta = get_post_meta( $code_id );
	$label = coupon_get_smeta( 'coupon_label', $post_meta, '' );
	
	$url = add_query_arg( array( 'label_var' => $label ), get_permalink( $shop_id ) );
	
	
	return $url;
}

/* return label for the code */
function coupon_label( $post_id ){
	$post_meta = get_post_meta( $post_id );
	$label = coupon_get_smeta( 'coupon_label', $post_meta, '' );
	if( $label == 'coupon' ){
		return __( 'Coupon', 'coupon' );
	}
	else if( $label == 'discount' ){
		return __( 'Discount', 'coupon' );
	}
	return $label;
}

/* transform color form hex to rgb */
function coupon_hex2rgb( $hex ) {
	$hex = str_replace("#", "", $hex);

	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));
	return $r.", ".$g.", ".$b; 
}

/* format remaining time */
function coupon_remaining_time( $expire_timestamp ){
	$diff = $expire_timestamp - time();

	if( $diff > 0 ){
	
		$secondsInAMinute = 60;
		$secondsInAnHour  = 60 * $secondsInAMinute;
		$secondsInADay    = 24 * $secondsInAnHour;

		/* extract days */
		$days = floor( $diff / $secondsInADay );

		/* extract hours */
		$hourSeconds = $diff % $secondsInADay;
		$hours = floor( $hourSeconds / $secondsInAnHour );

		/* extract minutes */
		$minuteSeconds = $hourSeconds % $secondsInAnHour;
		$minutes = floor( $minuteSeconds / $secondsInAMinute );

		/* extract the remaining seconds */
		$remainingSeconds = $minuteSeconds % $secondsInAMinute;
		$seconds = ceil( $remainingSeconds );	
	
		if( $days > 0 ){
			if( $days == 1 ){
				$remaining = '1 '.__( 'day', 'coupon' );
			}
			else{
				$remaining = $days.' '.__( 'days', 'coupon' );
			}
		}
		else if( $hours > 0 ){
			if( $hours == 1 ){
				$remaining = '1 '.__( 'hour', 'coupon' );
			}
			else{
				$remaining = $hours.' '.__( 'hours', 'coupon' );
			}
		}
		else if( $minutes > 0 ){
			if( $minutes == 1 ){
				$remaining = '1 '.__( 'minute', 'coupon' );
			}
			else{
				$remaining = $minutes.' '.__( 'minutes', 'coupon' );
			}
		}
		else if( $seconds > 0 ){
			if( $seconds == 1 ){
				$remaining = '1 '.__( 'second', 'coupon' );
			}
			else{
				$remaining = $seconds.' '.__( 'seconds', 'coupon' );
			}
		}
	}
	else{
		$remaining = __( 'Expired', 'coupon' );
	}
	
	return $remaining;
}

/* check if expired */
function coupon_is_expired( $expire_timestamp ){
	if( time() > $expire_timestamp ){
		return true;
	}
	else{
		return false;
	}
}

/* coupon register click */
function coupon_register_click( $code_id ){
	if( !empty( $code_id ) ){
		$clicks = get_post_meta( $code_id, 'code_clicks' );
		delete_post_meta( $code_id, 'code_clicks' );
		if( !empty( $clicks ) ){
			$clicks = $clicks[0] + 1;
		}
		else{
			$clicks = 1;
		}
		update_post_meta( $code_id, 'code_clicks', $clicks );
	}
}

/* on post save add 0 clicks */
function coupon_save_post_meta( $post_id, $post ){
	if( $post->post_type == 'code' ){
		$post_type = get_post_type_object( $post->post_type );
		
		/* Check if the current user has permission to edit the post. */
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ){
			return $post_id;
		}
		
		/* Check autosave */
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		
		$meta_value = get_post_meta( $post_id, 'code_clicks', true );
		if( empty( $meta_value ) ){
			add_post_meta( $post_id, 'code_clicks', '0', true );
		}
	}
}
add_action( 'save_post', 'coupon_save_post_meta', 10, 2 );

/* custom walker class to create main top and bottom navigation */
class coupon_walker extends Walker_Nav_Menu {
  
	/**
	* @see Walker::start_lvl()
	* @since 3.0.0
	*
	* @param string $output Passed by reference. Used to append additional content.
	* @param int $depth Depth of page. Used for padding.
	*/
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\"dd-custom dropdown-menu\">\n";
	}

	/**
	* @see Walker::start_el()
	* @since 3.0.0
	*
	* @param string $output Passed by reference. Used to append additional content.
	* @param object $item Menu item data object.
	* @param int $depth Depth of menu item. Used for padding.
	* @param int $current_page Menu item ID.
	* @param object $args
	*/
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		* Dividers, Headers or Disabled
		* =============================
		* Determine whether the item is a Divider, Header, Disabled or regular
		* menu item. To prevent errors we use the strcasecmp() function to so a
		* comparison that is not case sensitive. The strcasecmp() function returns
		* a 0 if the strings are equal.
		*/
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} 
		else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} 
		else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} 
		else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} 
		else {
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			
			if ( $args->has_children ){
				$class_names .= ' dropdown';
			}

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title'] = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel'] = ! empty( $item->xfn )	? $item->xfn	: '';

			// If item has_children add atts to a.
			$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			$atts['class'] = '';
			if ( $args->has_children ) {
				$atts['data-toggle']	= 'dropdown';
				$atts['class']	= 'dropdown-toggle';
				$atts['aria-haspopup']	= 'true';
			} 
			
			if( strpos( $class_names, 'current' ) !== false && !is_author() && get_post_type() != 'shop' && get_post_type() != 'code' && get_post_type() != 'daily_offer' ){
				$atts['class'] .= ' active';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			* Glyphicons
			* ===========
			* Since the the menu item is NOT a Divider or Header we check the see
			* if there is a value in the attr_title property. If the attr_title
			* property is NOT null we apply it as the class name for the glyphicon.
			*/
			if ( ! empty( $item->attr_title ) ){
				$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			}
			else{
				$item_output .= '<a'. $attributes .'>';
			}

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			if( $args->has_children && 0 === $depth ){
				$item_output .= ' <i class="fa fa-angle-down"></i>';
			}
			else if( $args->has_children && 0 < $depth ){
				$item_output .= ' <i class="fa fa-angle-right"></i>';
			}
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	* Traverse elements to create list from elements.
	*
	* Display one element if the element doesn't have any children otherwise,
	* display the element and its children. Will only traverse up to the max
	* depth and no ignore elements under that depth.
	*
	* This method shouldn't be called directly, use the walk() method instead.
	*
	* @see Walker::start_el()
	* @since 2.5.0
	*
	* @param object $element Data object
	* @param array $children_elements List of elements to continue traversing.
	* @param int $max_depth Max depth to traverse.
	* @param int $depth Depth of current element.
	* @param array $args
	* @param string $output Passed by reference. Used to append additional content.
	* @return null Null on failure with no changes to parameters.
	*/
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element )
			return;

		$id_field = $this->db_fields['id'];

		// Display this element.
		if ( is_object( $args[0] ) ){
		   $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	* Menu Fallback
	* =============
	* If this function is assigned to the wp_nav_menu's fallback_cb variable
	* and a manu has not been assigned to the theme location in the WordPress
	* menu manager the function with display nothing to a non-logged in user,
	* and will add a link to the WordPress menu manager if logged in as an admin.
	*
	* @param array $args passed from the wp_nav_menu function.
	*
	*/
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id ){
					$fb_output .= ' id="' . $container_id . '"';
				}

				if ( $container_class ){
					$fb_output .= ' class="' . $container_class . '"';
				}

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id ){
				$fb_output .= ' id="' . $menu_id . '"';
			}

			if ( $menu_class ){
				$fb_output .= ' class="' . $menu_class . '"';
			}

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container ){
				$fb_output .= '</' . $container . '>';
			}

			echo $fb_output;
		}
	}
}


/* set sizes for cloud widget */
function coupon_custom_tag_cloud_widget($args) {
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 10; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'coupon_custom_tag_cloud_widget' );

/* format wp_link_pages so it has the right css applied to it */
function coupon_link_pages(){
	$post_pages = wp_link_pages( 
		array(
			'before' 		   => '',
			'after' 		   => '',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'next_or_number'   => 'number',
			'nextpagelink'     => __( '&raquo;', 'coupon' ),
			'previouspagelink' => __( '&laquo;', 'coupon' ),			
			'separator'        => ' ',
			'echo'			   => 0
		) 
	);
	/* format pages that are not current ones */
	$post_pages = str_replace( '<a', '<li><a', $post_pages );
	$post_pages = str_replace( '</span></a>', '</a></li>', $post_pages );
	$post_pages = str_replace( '><span>', '>', $post_pages );
	
	/* format current page */
	$post_pages = str_replace( '<span>', '<li class="active"><a href="javascript:;">', $post_pages );
	$post_pages = str_replace( '</span>', '</a></li>', $post_pages );
	
	return $post_pages;
	
}

/* create tags list */
function coupon_tags_list( $tags, $with_links = false ){
	$tag_list = array();
	$tags_list = '';
	if( !empty( $tags ) ){
		foreach( $tags as $tag ){
			if( $with_links ){
				$tag_list[] = '<li><a href="'.esc_url( get_tag_link( $tag->term_id ) ).'">'.$tag->name.'</a></li>';
			}
			else{
				$tag_list[] = $tag->name;
			}
		}
		$tags_list = join( ', ', $tag_list );
	}
	return $tags_list;
}

function coupon_list_categories(){
	$parents = get_terms( 'code_category', array( 'hide_empty' => 0, 'parent' => 0 ) );

	if( !empty( $parents ) ){
		foreach( $parents as $parent ){
			$children = get_terms( 'code_category', array( 'hide_empty' => 0, 'parent' => $parent->term_id ) );
			if( !empty( $children ) ){
				foreach( $children as $child ){
					$term_meta = get_option( "taxonomy_".$child->term_id );
					$icon = !empty( $term_meta['category_icon'] ) ? $term_meta['category_icon'] : '';
					echo '<li><a href="'.esc_url( get_term_link( $child->slug, 'code_category' ) ).'"><i class="fa fa-'.esc_attr( $icon ).'"></i> '.$child->name.'</a></li>';
				}
			}
		}
	}
}

/* limit excerpt */
function coupon_the_excerpt(){
	$excerpt = get_the_excerpt();
	if( strlen( $excerpt ) > 167 ){
		$excerpt = substr( $excerpt, 0 , 167 );
		$excerpt = substr( $excerpt, 0, strripos ( $excerpt, " " ) );
		$excerpt = $excerpt . '...' ;
	}
	
	return '<p>'.$excerpt.'</p>';
}

/* create array of the code categry parents for HNP overall options */
function coupon_get_code_category_parents(){
	$parents = get_terms( 'code_category', array( 'hide_empty' => 0, 'parent' => 0 ) );
	$categories = array( '' => __('None', 'coupon'));
	if( !empty( $parents ) ){
		foreach( $parents as $parent ){
			$categories[$parent->term_id] = $parent->name;
		}
	}
	
	return $categories;
}

/* create categories list */
function coupon_categories_list( $categories ){
	$category_list = '';
	if( !empty( $categories ) ){
		foreach( $categories as $category ){
			$category_list .= '<a href="'.esc_url( get_category_link( $category->term_id ) ).'">'.$category->name.'</a> ';
		}
	}
	
	return $category_list;
}

/* format pagination so it has correct style applied to it */
function coupon_format_pagination( $page_links ){
	$list = '';
	if( !empty( $page_links ) ){
		foreach( $page_links as $page_link ){
			if( strpos( $page_link, 'page-numbers current' ) !== false ){
				$page_link = str_replace( "<span class='page-numbers current'>", '<a href="javascript:;">', $page_link );
				$page_link = str_replace( '</span>', '</a>', $page_link );
				$list .= '<li class="active">'.$page_link.'</li>';
			}
			else{
				$list .= '<li>'.$page_link.'</li>';
			}
			
		}
	}
	
	return $list;
}

/*generate random password*/
function coupon_random_string( $length = 10 ) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$random = '';
	for ($i = 0; $i < $length; $i++) {
		$random .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $random;
}


/* coupon ajax search function */
function coupon_ajax_search(){
	global $wpdb;
	$search_term = esc_sql( $_POST['search'] );
	$response = array(
		"list" => array()
	);
	
	$query = "SELECT * FROM {$wpdb->prefix}posts WHERE post_status='publish' AND post_type='shop' AND post_title LIKE '%{$search_term}%' ORDER BY post_title ASC";
	
	$results = $wpdb->get_results( $query );
	
	if( !empty( $results ) ){
		foreach( $results as $result ){
			$title = str_replace( " ", "&nbsp;", $result->post_title );
			$response["list"][] = array(
				"name" 	=> urlencode( $title ),
				"url"	=> urlencode( get_permalink( $result->ID ) )
			);
		}
	}
	
	echo json_encode( $response );
	die();
}
add_action('wp_ajax_ajax_search', 'coupon_ajax_search');
add_action('wp_ajax_nopriv_ajax_search', 'coupon_ajax_search');

function coupon_get_code(){
	$codeid = $_POST['codeid'];
	$response = array();
	
	$code = get_post( $codeid );
	if( !empty( $code ) ){
		coupon_register_click( $codeid );
		$code_meta = get_post_custom( $codeid );
		$code_couponcode = coupon_get_smeta( 'code_couponcode', $code_meta, '' );
		$shop_id = coupon_get_smeta( 'code_shop_id', $code_meta, '' );
		$thumb_id = get_post_thumbnail_id( $shop_id );
		$image = wp_get_attachment_image_src( $thumb_id, 'top20' );
		$response['image'] = !empty( $image ) ? $image[0] : '';
		$response['title'] = $code->post_title;
		$response['text'] = $code->post_content;
		$response['code'] = $code_couponcode;
	}
	else{
		$response['error'] = __( 'Coupon does not exists', 'coupon' );
	}
	
	echo json_encode( $response );
	die();
}
add_action('wp_ajax_ajax_code', 'coupon_get_code');
add_action('wp_ajax_nopriv_ajax_code', 'coupon_get_code');

/* add the ... at the end of the excerpt */
function coupon_new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'coupon_new_excerpt_more');

/* create options for the select box in the category icon select */
function coupon_icons_list( $value ){
	$icons_list = coupon_awesome_icons_list();
	
	$select_data = '';
	
	foreach( $icons_list as $key => $label){
		$select_data .= '<option value="'.esc_attr( $key ).'" '.( $value == $key ? 'selected="selected"' : '' ).'>'.$label.'</option>';
	}
	
	return $select_data;
}

/* =======================================================SUBSCRIPTION FUNCTIONS */
function coupon_send_subscription( $email = '', $die = true ){
	$email = !empty( $email ) ? $email : $_POST["email"];
	$response = array();	
	if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		require_once( locate_template( 'includes/mailchimp.php' ) );
		$chimp_api = coupon_get_option("mail_chimp_api");
		$chimp_list_id = coupon_get_option("mail_chimp_list_id");
		if( !empty( $chimp_api ) && !empty( $chimp_list_id ) ){
			$mc = new MailChimp( $chimp_api );
			$result = $mc->call('lists/subscribe', array(
				'id'                => $chimp_list_id,
				'email'             => array( 'email' => $email )
			));
			
			if( $result === false) {
				$response['error'] = __( 'There was an error contacting the API, please try again.', 'coupon' );
			}
			else if( isset($result['status']) && $result['status'] == 'error' ){
				$response['error'] = json_encode($result);
			}
			else{
				$response['success'] = __( 'You have successuffly subscribed to the newsletter.', 'coupon' );
			}
			
		}
		else{
			$response['error'] = __( 'API data are not yet set.', 'coupon' );
		}
	}
	else{
		$response['error'] = __( 'Email is empty or invalid.', 'coupon' );
	}
	if( $die ){
		echo json_encode( $response );
		die();
	}
	else{
		return $response;
	}
}
add_action('wp_ajax_subscribe', 'coupon_send_subscription');
add_action('wp_ajax_nopriv_subscribe', 'coupon_send_subscription');

function coupon_remove_subscription( $email ){
	$response = array();
	if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		require_once( locate_template( 'includes/mailchimp.php' ) );
		$chimp_api = coupon_get_option("mail_chimp_api");
		$chimp_list_id = coupon_get_option("mail_chimp_list_id");
		if( !empty( $chimp_api ) && !empty( $chimp_list_id ) ){
			$mc = new MailChimp( $chimp_api );
			$result = $mc->call('lists/unsubscribe', array(
				'id'                => $chimp_list_id,
				'email'             => array( 'email' => $email ),
				'delete_member'		=> true
			));
			
			if( $result === false) {
				$response['error'] = __( 'There was an error contacting the API, please try again.', 'coupon' );
			}
			else if( isset($result['status']) && $result['status'] == 'error' ){
				$response['error'] = json_encode($result);
			}
			else{
				$response['success'] = __( 'You have successuffly unsubscribed to the newsletter.', 'coupon' );
			}
			
		}
		else{
			$response['error'] = __( 'API data are not yet set.', 'coupon' );
		}
	}
	
	return $response;
}

function coupon_send_contact(){
	$errors = array();
	$name = esc_sql( $_POST['name'] );
	$subject = esc_sql( $_POST['subject'] );
	$email = esc_sql( $_POST['email'] );
	$message = esc_sql( $_POST['message'] );
	if( !empty( $name ) && !empty( $subject ) && !empty( $email ) && !empty( $message ) ){
		if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
			$email_to = coupon_get_option( 'contact_email' );
			if( !empty( $email_to ) ){
				$message = "
					".__( 'Name: ', 'coupon' )." {$name} \n
					".__( 'Subject: ', 'coupon' )." {$subject} \n
					".__( 'Email: ', 'coupon' )." {$email} \n
					".__( 'Message: ', 'coupon' )."\n {$message} \n
				";
				$info = @wp_mail( $email_to, $subject, $message );
				if( $info ){
					echo json_encode(array(
						'success' => __( 'Your message was successfully submitted.', 'coupon' ),
					));
					die();
				}
				else{
					echo json_encode(array(
						'error' => __( 'Unexpected error while attempting to send e-mail.', 'coupon' ),
					));
					die();
				}
			}
			else{
				echo json_encode(array(
					'error' => __( 'Message is not send since the recepient email is not yet set.', 'coupon' ),
				));
				die();
			}
		}
		else{
			echo json_encode(array(
				'error' => __( 'Email is not valid.', 'coupon' ),
			));
			die();
		}
	}
	else{
		echo json_encode(array(
			'error' => __( 'All fields are required.', 'coupon' ),
		));
		die();
	}
}
add_action('wp_ajax_contact', 'coupon_send_contact');
add_action('wp_ajax_nopriv_contact', 'coupon_send_contact');

function coupon_get_home_subtitle(){
	$count_codes = wp_count_posts( 'code' ); 
	$count_users = count_users(); 
	$subslogan = coupon_get_option( 'site_sub_slogan' );
	$subslogan = str_replace( array( '%USERS%', '%COUPONS%' ), array( $count_users['total_users'], $count_codes->publish ), $subslogan );
	
	return $subslogan;
}

/* gte list of the popular shops */
function coupon_popular_shops( $limit ){
	global $wpdb;
	$popular_shops = array();
	$query = "SELECT post_title, ID FROM {$wpdb->prefix}posts WHERE ID IN( 
				SELECT meta_value FROM {$wpdb->prefix}postmeta WHERE post_id IN( 
					SELECT post_id FROM(
						SELECT post_id, SUM( meta_value ) as clicks_sum FROM {$wpdb->prefix}postmeta WHERE meta_key = 'code_clicks' GROUP BY post_id ORDER BY clicks_sum
					) as code_id_list
				) AND meta_key = 'code_shop_id'
			 ) LIMIT {$limit}";
	$results = $wpdb->get_results( $query );
	if( !empty( $results ) ){
		$popular_shops = $results;
	}
	return $popular_shops;
}

function coupon_get_avatar_url( $get_avatar ){
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
	if( !empty( $matches[1] ) ){
		return $matches[1];
	}
	else{
		return '';
	}
}

function coupon_embed_html( $html ) {
    return '<div class="video-container">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'coupon_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'coupon_embed_html' ); // Jetpack

function coupon_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$add_below = ''; 
	?>
	<!-- comment-1 -->
	<div class="media">
		<div class="comment-inner">
			<?php 
			$avatar = coupon_get_avatar_url( get_avatar( $comment, 60 ) );
			if( !empty( $avatar ) ): ?>
				<a class="pull-left" href="javascript:;">
					<img src="<?php echo esc_url( $avatar ); ?>" class="media-object comment-avatar" title="" alt="">
				</a>
			<?php endif; ?>
			<div class="media-body comment-body">
				<h4 class="media-heading"><?php comment_author(); ?></h4>
				<a href="javascritp:;"><?php comment_time( 'F j, Y '.__('@','coupon').' H:i' ); ?></a>
				<?php 
				if ($comment->comment_approved != '0'){
				?>
					<p><?php echo get_comment_text(); ?></p>
				<?php 
				}
				else{ ?>
					<p><?php _e('Your comment is awaiting moderation.', 'coupon'); ?></p>
				<?php
				}
				?>
				<?php 
				comment_reply_link( 
					array_merge( 
						$args, 
						array( 
							'reply_text' => '<span class="fa fa-reply pull-right"></span>', 
							'add_below' => $add_below, 
							'depth' => $depth, 
							'max_depth' => $args['max_depth'] 
						) 
					) 
				); ?>				
			</div>
		</div>
	</div>
	<!-- .comment-1 -->	
	<?php  
}


add_filter( 'manage_edit-code_columns', 'coupon_custom_code_columns' );
function coupon_custom_code_columns($columns) {
	$columns = 
		array_slice($columns, 0, count($columns) - 1, true) + 
		array(
			"code_shop_id" => __( 'Shop', 'coupon' ),
			"code_couponcode" => __( 'Coupon Code', 'coupon' ),
			"code_expire" => __( 'Expire Date', 'coupon' ),
			"coupon_average_rate" => __( 'Coupon Ratings', 'coupon' ),
			"code_clicks" => __( 'Clicks', 'coupon' )
		) + 
		array_slice($columns, count($columns) - 1, count($columns) - 1, true) ;	
	return $columns;
}

/* input the number of views in the post type listing in the admin panel */
add_action( 'manage_code_posts_custom_column', 'coupon_custom_column_populate', 10, 2 );
function coupon_custom_column_populate( $column, $post_id ) {
	switch ( $column ) {
		case 'code_shop_id' :
			$code_shop_id = get_post_meta( $post_id, 'code_shop_id', true );
			if( !empty( $code_shop_id ) ){
				echo get_the_title( $code_shop_id );
			}
			else{
				echo '';
			}
			break;
		case 'code_couponcode' :
			echo get_post_meta( $post_id, 'code_couponcode', true );
			break;
		case 'code_expire' :
			$code_expire = get_post_meta( $post_id, 'code_expire', true );
			if( !empty( $code_expire ) ){
				echo date( 'F j, Y', $code_expire );
			}
			break;
		case 'offer_expire' :
			$offer_expire = get_post_meta( $post_id, 'offer_expire', true );
			if( !empty( $code_expire ) ){
				echo date( 'F j, Y', $offer_expire );
			}
			break;			
		case 'coupon_average_rate' : 
			echo coupon_get_ratings( $post_id );
			break;
		case 'code_clicks' : 
			echo get_post_meta( $post_id, 'code_clicks', true );
			break;
	}
}

/* allow sorting by post type views in the admin panel*/
add_filter( 'manage_edit-code_sortable_columns', 'coupon_sorting_columns' );
function coupon_sorting_columns($columns) {
	$custom = array(
		'code_shop_id'	=> 'code_shop_id',
		'code_couponcode'	=> 'code_couponcode',
		'code_expire'	=> 'code_expire',
		'offer_expire'	=> 'offer_expire',
		'coupon_average_rate'	=> 'coupon_average_rate',
		'code_clicks'	=> 'code_clicks',
	);
	return wp_parse_args($custom, $columns);
}


/*sort carellcars custom posts by custom meta fields in admin panel */
add_action( 'pre_get_posts', 'coupon_sort_columns' );
function coupon_sort_columns( $query ){
	if( ! is_admin() ){
		return;	
	}

	$orderby = $query->get( 'orderby');
	if( $orderby == 'offer_expire' || $orderby == 'code_shop_id' || $orderby == 'coupon_average_rate' || $orderby == 'code_clicks' || $orderby == 'code_expire' ){
		$query->set( 'meta_key', $orderby );
		$query->set( 'orderby', 'meta_value_num' );
	}
}

add_filter( 'manage_edit-daily_offer_columns', 'coupon_dof_custom_code_columns' );
function coupon_dof_custom_code_columns($columns) {
	$columns = 
		array_slice($columns, 0, count($columns) - 1, true) + 
		array(
			"offer_expire" => __( 'Expire Date', 'coupon' ),
			"coupon_average_rate" => __( 'Coupon Ratings', 'coupon' ),
		) + 
		array_slice($columns, count($columns) - 1, count($columns) - 1, true) ;	
	return $columns;
}

/* input the number of views in the post type listing in the admin panel */
add_action( 'manage_daily_offer_posts_custom_column', 'coupon_custom_column_populate', 10, 2 );

/* allow sorting by post type views in the admin panel*/
add_filter( 'manage_edit-daily_offer_sortable_columns', 'coupon_sorting_columns' );

/* manage ratings */
function coupon_ratings_box() {

	$screens = array( 'code', 'daily_offer' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'coupon_ratings',
			__( 'Manage Ratings', 'coupon' ),
			'coupon_ratings_box_populate',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'coupon_ratings_box' );

function coupon_ratings_box_populate( $post ){
	$coupon_ratings = get_post_meta( $post->ID, 'coupon_rating' );

	echo '<textarea name="ratings" style="min-height: 300px; width: 100%">'.join("\n", $coupon_ratings).'</textarea>';
}

function coupon_save_ratings( $post_id ) {

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && ( 'code' == $_POST['post_type'] || 'daily_offer' == $_POST['post_type'] ) ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['ratings'] ) ) {
		return;
	}

	if( !empty( $_POST['ratings'] ) ){

		$ratings = explode( "\n", $_POST['ratings'] );
		delete_post_meta( $post_id, 'coupon_rating' );
		delete_post_meta( $post_id, 'coupon_average_rate' );
		$sum = 0;
		foreach( $ratings as $rate ){			
			if( !strpos( $rate, "|" ) ){
				$rate = '0|'.$rate;
			}
			add_post_meta( $post_id, 'coupon_rating', $rate );
			$temp = explode( "|", $rate );
			$sum += $temp[1];
		}
		add_post_meta( $post_id, 'coupon_average_rate', $sum / sizeof( $ratings ) );
	}
}
add_action( 'save_post', 'coupon_save_ratings' );

/* complete list of icons */
function coupon_awesome_icons_list(){
	$icon_list = array(
		'' => 'No Icon',
		'adjust' => 'adjust',
		'adn' => 'adn',
		'align-center' => 'align-center',
		'align-justify' => 'align-justify',
		'align-left' => 'align-left',
		'align-right' => 'align-right',
		'ambulance' => 'ambulance',
		'anchor' => 'anchor',
		'android' => 'android',
		'angellist' => 'angellist',
		'angle-double-down' => 'angle-double-down',
		'angle-double-left' => 'angle-double-left',
		'angle-double-right' => 'angle-double-right',
		'angle-double-up' => 'angle-double-up',
		'angle-down' => 'angle-down',
		'angle-left' => 'angle-left',
		'angle-right' => 'angle-right',
		'angle-up' => 'angle-up',
		'apple' => 'apple',
		'archive' => 'archive',
		'area-chart' => 'area-chart',
		'arrow-circle-down' => 'arrow-circle-down',
		'arrow-circle-left' => 'arrow-circle-left',
		'arrow-circle-o-down' => 'arrow-circle-o-down',
		'arrow-circle-o-left' => 'arrow-circle-o-left',
		'arrow-circle-o-right' => 'arrow-circle-o-right',
		'arrow-circle-o-up' => 'arrow-circle-o-up',
		'arrow-circle-right' => 'arrow-circle-right',
		'arrow-circle-up' => 'arrow-circle-up',
		'arrow-down' => 'arrow-down',
		'arrow-left' => 'arrow-left',
		'arrow-right' => 'arrow-right',
		'arrow-up' => 'arrow-up',
		'arrows' => 'arrows',
		'arrows-alt' => 'arrows-alt',
		'arrows-h' => 'arrows-h',
		'arrows-v' => 'arrows-v',
		'asterisk' => 'asterisk',
		'at' => 'at',
		'automobile' => 'automobile',
		'backward' => 'backward',
		'ban' => 'ban',
		'bank' => 'bank',
		'bar-chart' => 'bar-chart',
		'bar-chart-o' => 'bar-chart-o',
		'barcode' => 'barcode',
		'bars' => 'bars',
		'bed' => 'bed',
		'beer' => 'beer',
		'behance' => 'behance',
		'behance-square' => 'behance-square',
		'bell' => 'bell',
		'bell-o' => 'bell-o',
		'bell-slash' => 'bell-slash',
		'bell-slash-o' => 'bell-slash-o',
		'bicycle' => 'bicycle',
		'binoculars' => 'binoculars',
		'birthday-cake' => 'birthday-cake',
		'bitbucket' => 'bitbucket',
		'bitbucket-square' => 'bitbucket-square',
		'bitcoin' => 'bitcoin',
		'bold' => 'bold',
		'bolt' => 'bolt',
		'bomb' => 'bomb',
		'book' => 'book',
		'bookmark' => 'bookmark',
		'bookmark-o' => 'bookmark-o',
		'briefcase' => 'briefcase',
		'btc' => 'btc',
		'bug' => 'bug',
		'building' => 'building',
		'building-o' => 'building-o',
		'bullhorn' => 'bullhorn',
		'bullseye' => 'bullseye',
		'bus' => 'bus',
		'buysellads' => 'buysellads',
		'cab' => 'cab',
		'calculator' => 'calculator',
		'calendar' => 'calendar',
		'calendar-o' => 'calendar-o',
		'camera' => 'camera',
		'camera-retro' => 'camera-retro',
		'car' => 'car',
		'caret-down' => 'caret-down',
		'caret-left' => 'caret-left',
		'caret-right' => 'caret-right',
		'caret-square-o-down' => 'caret-square-o-down',
		'caret-square-o-left' => 'caret-square-o-left',
		'caret-square-o-right' => 'caret-square-o-right',
		'caret-square-o-up' => 'caret-square-o-up',
		'caret-up' => 'caret-up',
		'cart-arrow-down' => 'cart-arrow-down',
		'cart-plus' => 'cart-plus',
		'cc' => 'cc',
		'cc-amex' => 'cc-amex',
		'cc-discover' => 'cc-discover',
		'cc-mastercard' => 'cc-mastercard',
		'cc-paypal' => 'cc-paypal',
		'cc-stripe' => 'cc-stripe',
		'cc-visa' => 'cc-visa',
		'certificate' => 'certificate',
		'chain' => 'chain',
		'chain-broken' => 'chain-broken',
		'check' => 'check',
		'check-circle' => 'check-circle',
		'check-circle-o' => 'check-circle-o',
		'check-square' => 'check-square',
		'check-square-o' => 'check-square-o',
		'chevron-circle-down' => 'chevron-circle-down',
		'chevron-circle-left' => 'chevron-circle-left',
		'chevron-circle-right' => 'chevron-circle-right',
		'chevron-circle-up' => 'chevron-circle-up',
		'chevron-down' => 'chevron-down',
		'chevron-left' => 'chevron-left',
		'chevron-right' => 'chevron-right',
		'chevron-up' => 'chevron-up',
		'child' => 'child',
		'circle' => 'circle',
		'circle-o' => 'circle-o',
		'circle-o-notch' => 'circle-o-notch',
		'circle-thin' => 'circle-thin',
		'clipboard' => 'clipboard',
		'clock-o' => 'clock-o',
		'close' => 'close',
		'cloud' => 'cloud',
		'cloud-download' => 'cloud-download',
		'cloud-upload' => 'cloud-upload',
		'cny' => 'cny',
		'code' => 'code',
		'code-fork' => 'code-fork',
		'codepen' => 'codepen',
		'coffee' => 'coffee',
		'cog' => 'cog',
		'cogs' => 'cogs',
		'columns' => 'columns',
		'comment' => 'comment',
		'comment-o' => 'comment-o',
		'comments' => 'comments',
		'comments-o' => 'comments-o',
		'compass' => 'compass',
		'compress' => 'compress',
		'connectdevelop' => 'connectdevelop',
		'copy' => 'copy',
		'copyright' => 'copyright',
		'credit-card' => 'credit-card',
		'crop' => 'crop',
		'crosshairs' => 'crosshairs',
		'css3' => 'css3',
		'cube' => 'cube',
		'cubes' => 'cubes',
		'cut' => 'cut',
		'cutlery' => 'cutlery',
		'dashboard' => 'dashboard',
		'dashcube' => 'dashcube',
		'database' => 'database',
		'dedent' => 'dedent',
		'delicious' => 'delicious',
		'desktop' => 'desktop',
		'deviantart' => 'deviantart',
		'diamond' => 'diamond',
		'digg' => 'digg',
		'dollar' => 'dollar',
		'dot-circle-o' => 'dot-circle-o',
		'download' => 'download',
		'dribbble' => 'dribbble',
		'dropbox' => 'dropbox',
		'drupal' => 'drupal',
		'edit' => 'edit',
		'eject' => 'eject',
		'ellipsis-h' => 'ellipsis-h',
		'ellipsis-v' => 'ellipsis-v',
		'empire' => 'empire',
		'envelope' => 'envelope',
		'envelope-o' => 'envelope-o',
		'envelope-square' => 'envelope-square',
		'eraser' => 'eraser',
		'eur' => 'eur',
		'euro' => 'euro',
		'exchange' => 'exchange',
		'exclamation' => 'exclamation',
		'exclamation-circle' => 'exclamation-circle',
		'exclamation-triangle' => 'exclamation-triangle',
		'expand' => 'expand',
		'external-link' => 'external-link',
		'external-link-square' => 'external-link-square',
		'eye' => 'eye',
		'eye-slash' => 'eye-slash',
		'eyedropper' => 'eyedropper',
		'facebook' => 'facebook',
		'facebook-f' => 'facebook-f',
		'facebook-official' => 'facebook-official',
		'facebook-square' => 'facebook-square',
		'fast-backward' => 'fast-backward',
		'fast-forward' => 'fast-forward',
		'fax' => 'fax',
		'female' => 'female',
		'fighter-jet' => 'fighter-jet',
		'file' => 'file',
		'file-archive-o' => 'file-archive-o',
		'file-audio-o' => 'file-audio-o',
		'file-code-o' => 'file-code-o',
		'file-excel-o' => 'file-excel-o',
		'file-image-o' => 'file-image-o',
		'file-movie-o' => 'file-movie-o',
		'file-o' => 'file-o',
		'file-pdf-o' => 'file-pdf-o',
		'file-photo-o' => 'file-photo-o',
		'file-picture-o' => 'file-picture-o',
		'file-powerpoint-o' => 'file-powerpoint-o',
		'file-sound-o' => 'file-sound-o',
		'file-text' => 'file-text',
		'file-text-o' => 'file-text-o',
		'file-video-o' => 'file-video-o',
		'file-word-o' => 'file-word-o',
		'file-zip-o' => 'file-zip-o',
		'files-o' => 'files-o',
		'film' => 'film',
		'filter' => 'filter',
		'fire' => 'fire',
		'fire-extinguisher' => 'fire-extinguisher',
		'flag' => 'flag',
		'flag-checkered' => 'flag-checkered',
		'flag-o' => 'flag-o',
		'flash' => 'flash',
		'flask' => 'flask',
		'flickr' => 'flickr',
		'floppy-o' => 'floppy-o',
		'folder' => 'folder',
		'folder-o' => 'folder-o',
		'folder-open' => 'folder-open',
		'folder-open-o' => 'folder-open-o',
		'font' => 'font',
		'forumbee' => 'forumbee',
		'forward' => 'forward',
		'foursquare' => 'foursquare',
		'frown-o' => 'frown-o',
		'futbol-o' => 'futbol-o',
		'gamepad' => 'gamepad',
		'gavel' => 'gavel',
		'gbp' => 'gbp',
		'ge' => 'ge',
		'gear' => 'gear',
		'gears' => 'gears',
		'genderless' => 'genderless',
		'gift' => 'gift',
		'git' => 'git',
		'git-square' => 'git-square',
		'github' => 'github',
		'github-alt' => 'github-alt',
		'github-square' => 'github-square',
		'gittip' => 'gittip',
		'glass' => 'glass',
		'globe' => 'globe',
		'google' => 'google',
		'google-plus' => 'google-plus',
		'google-plus-square' => 'google-plus-square',
		'google-wallet' => 'google-wallet',
		'graduation-cap' => 'graduation-cap',
		'gratipay' => 'gratipay',
		'group' => 'group',
		'h-square' => 'h-square',
		'hacker-news' => 'hacker-news',
		'hand-o-down' => 'hand-o-down',
		'hand-o-left' => 'hand-o-left',
		'hand-o-right' => 'hand-o-right',
		'hand-o-up' => 'hand-o-up',
		'hdd-o' => 'hdd-o',
		'header' => 'header',
		'headphones' => 'headphones',
		'heart' => 'heart',
		'heart-o' => 'heart-o',
		'heartbeat' => 'heartbeat',
		'history' => 'history',
		'home' => 'home',
		'hospital-o' => 'hospital-o',
		'hotel' => 'hotel',
		'html5' => 'html5',
		'ils' => 'ils',
		'image' => 'image',
		'inbox' => 'inbox',
		'indent' => 'indent',
		'info' => 'info',
		'info-circle' => 'info-circle',
		'inr' => 'inr',
		'instagram' => 'instagram',
		'institution' => 'institution',
		'ioxhost' => 'ioxhost',
		'italic' => 'italic',
		'joomla' => 'joomla',
		'jpy' => 'jpy',
		'jsfiddle' => 'jsfiddle',
		'key' => 'key',
		'keyboard-o' => 'keyboard-o',
		'krw' => 'krw',
		'language' => 'language',
		'laptop' => 'laptop',
		'lastfm' => 'lastfm',
		'lastfm-square' => 'lastfm-square',
		'leaf' => 'leaf',
		'leanpub' => 'leanpub',
		'legal' => 'legal',
		'lemon-o' => 'lemon-o',
		'level-down' => 'level-down',
		'level-up' => 'level-up',
		'life-bouy' => 'life-bouy',
		'life-buoy' => 'life-buoy',
		'life-ring' => 'life-ring',
		'life-saver' => 'life-saver',
		'lightbulb-o' => 'lightbulb-o',
		'line-chart' => 'line-chart',
		'link' => 'link',
		'linkedin' => 'linkedin',
		'linkedin-square' => 'linkedin-square',
		'linux' => 'linux',
		'list' => 'list',
		'list-alt' => 'list-alt',
		'list-ol' => 'list-ol',
		'list-ul' => 'list-ul',
		'location-arrow' => 'location-arrow',
		'lock' => 'lock',
		'long-arrow-down' => 'long-arrow-down',
		'long-arrow-left' => 'long-arrow-left',
		'long-arrow-right' => 'long-arrow-right',
		'long-arrow-up' => 'long-arrow-up',
		'magic' => 'magic',
		'magnet' => 'magnet',
		'mail-forward' => 'mail-forward',
		'mail-reply' => 'mail-reply',
		'mail-reply-all' => 'mail-reply-all',
		'male' => 'male',
		'map-marker' => 'map-marker',
		'mars' => 'mars',
		'mars-double' => 'mars-double',
		'mars-stroke' => 'mars-stroke',
		'mars-stroke-h' => 'mars-stroke-h',
		'mars-stroke-v' => 'mars-stroke-v',
		'maxcdn' => 'maxcdn',
		'meanpath' => 'meanpath',
		'medium' => 'medium',
		'medkit' => 'medkit',
		'meh-o' => 'meh-o',
		'mercury' => 'mercury',
		'microphone' => 'microphone',
		'microphone-slash' => 'microphone-slash',
		'minus' => 'minus',
		'minus-circle' => 'minus-circle',
		'minus-square' => 'minus-square',
		'minus-square-o' => 'minus-square-o',
		'mobile' => 'mobile',
		'mobile-phone' => 'mobile-phone',
		'money' => 'money',
		'moon-o' => 'moon-o',
		'mortar-board' => 'mortar-board',
		'motorcycle' => 'motorcycle',
		'music' => 'music',
		'navicon' => 'navicon',
		'neuter' => 'neuter',
		'newspaper-o' => 'newspaper-o',
		'openid' => 'openid',
		'outdent' => 'outdent',
		'pagelines' => 'pagelines',
		'paint-brush' => 'paint-brush',
		'paper-plane' => 'paper-plane',
		'paper-plane-o' => 'paper-plane-o',
		'paperclip' => 'paperclip',
		'paragraph' => 'paragraph',
		'paste' => 'paste',
		'pause' => 'pause',
		'paw' => 'paw',
		'paypal' => 'paypal',
		'pencil' => 'pencil',
		'pencil-square' => 'pencil-square',
		'pencil-square-o' => 'pencil-square-o',
		'phone' => 'phone',
		'phone-square' => 'phone-square',
		'photo' => 'photo',
		'picture-o' => 'picture-o',
		'pie-chart' => 'pie-chart',
		'pied-piper' => 'pied-piper',
		'pied-piper-alt' => 'pied-piper-alt',
		'pinterest' => 'pinterest',
		'pinterest-p' => 'pinterest-p',
		'pinterest-square' => 'pinterest-square',
		'plane' => 'plane',
		'play' => 'play',
		'play-circle' => 'play-circle',
		'play-circle-o' => 'play-circle-o',
		'plug' => 'plug',
		'plus' => 'plus',
		'plus-circle' => 'plus-circle',
		'plus-square' => 'plus-square',
		'plus-square-o' => 'plus-square-o',
		'power-off' => 'power-off',
		'print' => 'print',
		'puzzle-piece' => 'puzzle-piece',
		'qq' => 'qq',
		'qrcode' => 'qrcode',
		'question' => 'question',
		'question-circle' => 'question-circle',
		'quote-left' => 'quote-left',
		'quote-right' => 'quote-right',
		'ra' => 'ra',
		'random' => 'random',
		'rebel' => 'rebel',
		'recycle' => 'recycle',
		'reddit' => 'reddit',
		'reddit-square' => 'reddit-square',
		'refresh' => 'refresh',
		'remove' => 'remove',
		'renren' => 'renren',
		'reorder' => 'reorder',
		'repeat' => 'repeat',
		'reply' => 'reply',
		'reply-all' => 'reply-all',
		'retweet' => 'retweet',
		'rmb' => 'rmb',
		'road' => 'road',
		'rocket' => 'rocket',
		'rotate-left' => 'rotate-left',
		'rotate-right' => 'rotate-right',
		'rouble' => 'rouble',
		'rss' => 'rss',
		'rss-square' => 'rss-square',
		'rub' => 'rub',
		'ruble' => 'ruble',
		'rupee' => 'rupee',
		'save' => 'save',
		'scissors' => 'scissors',
		'search' => 'search',
		'search-minus' => 'search-minus',
		'search-plus' => 'search-plus',
		'sellsy' => 'sellsy',
		'send' => 'send',
		'send-o' => 'send-o',
		'server' => 'server',
		'share' => 'share',
		'share-alt' => 'share-alt',
		'share-alt-square' => 'share-alt-square',
		'share-square' => 'share-square',
		'share-square-o' => 'share-square-o',
		'shekel' => 'shekel',
		'sheqel' => 'sheqel',
		'shield' => 'shield',
		'ship' => 'ship',
		'shirtsinbulk' => 'shirtsinbulk',
		'shopping-cart' => 'shopping-cart',
		'sign-in' => 'sign-in',
		'sign-out' => 'sign-out',
		'signal' => 'signal',
		'simplybuilt' => 'simplybuilt',
		'sitemap' => 'sitemap',
		'skyatlas' => 'skyatlas',
		'skype' => 'skype',
		'slack' => 'slack',
		'sliders' => 'sliders',
		'slideshare' => 'slideshare',
		'smile-o' => 'smile-o',
		'soccer-ball-o' => 'soccer-ball-o',
		'sort' => 'sort',
		'sort-alpha-asc' => 'sort-alpha-asc',
		'sort-alpha-desc' => 'sort-alpha-desc',
		'sort-amount-asc' => 'sort-amount-asc',
		'sort-amount-desc' => 'sort-amount-desc',
		'sort-asc' => 'sort-asc',
		'sort-desc' => 'sort-desc',
		'sort-down' => 'sort-down',
		'sort-numeric-asc' => 'sort-numeric-asc',
		'sort-numeric-desc' => 'sort-numeric-desc',
		'sort-up' => 'sort-up',
		'soundcloud' => 'soundcloud',
		'space-shuttle' => 'space-shuttle',
		'spinner' => 'spinner',
		'spoon' => 'spoon',
		'spotify' => 'spotify',
		'square' => 'square',
		'square-o' => 'square-o',
		'stack-exchange' => 'stack-exchange',
		'stack-overflow' => 'stack-overflow',
		'star' => 'star',
		'star-half' => 'star-half',
		'star-half-empty' => 'star-half-empty',
		'star-half-full' => 'star-half-full',
		'star-half-o' => 'star-half-o',
		'star-o' => 'star-o',
		'steam' => 'steam',
		'steam-square' => 'steam-square',
		'step-backward' => 'step-backward',
		'step-forward' => 'step-forward',
		'stethoscope' => 'stethoscope',
		'stop' => 'stop',
		'street-view' => 'street-view',
		'strikethrough' => 'strikethrough',
		'stumbleupon' => 'stumbleupon',
		'stumbleupon-circle' => 'stumbleupon-circle',
		'subscript' => 'subscript',
		'subway' => 'subway',
		'suitcase' => 'suitcase',
		'sun-o' => 'sun-o',
		'superscript' => 'superscript',
		'support' => 'support',
		'table' => 'table',
		'tablet' => 'tablet',
		'tachometer' => 'tachometer',
		'tag' => 'tag',
		'tags' => 'tags',
		'tasks' => 'tasks',
		'taxi' => 'taxi',
		'tencent-weibo' => 'tencent-weibo',
		'terminal' => 'terminal',
		'text-height' => 'text-height',
		'text-width' => 'text-width',
		'th' => 'th',
		'th-large' => 'th-large',
		'th-list' => 'th-list',
		'thumb-tack' => 'thumb-tack',
		'thumbs-down' => 'thumbs-down',
		'thumbs-o-down' => 'thumbs-o-down',
		'thumbs-o-up' => 'thumbs-o-up',
		'thumbs-up' => 'thumbs-up',
		'ticket' => 'ticket',
		'times' => 'times',
		'times-circle' => 'times-circle',
		'times-circle-o' => 'times-circle-o',
		'tint' => 'tint',
		'toggle-down' => 'toggle-down',
		'toggle-left' => 'toggle-left',
		'toggle-off' => 'toggle-off',
		'toggle-on' => 'toggle-on',
		'toggle-right' => 'toggle-right',
		'toggle-up' => 'toggle-up',
		'train' => 'train',
		'transgender' => 'transgender',
		'transgender-alt' => 'transgender-alt',
		'trash' => 'trash',
		'trash-o' => 'trash-o',
		'tree' => 'tree',
		'trello' => 'trello',
		'trophy' => 'trophy',
		'truck' => 'truck',
		'try' => 'try',
		'tty' => 'tty',
		'tumblr' => 'tumblr',
		'tumblr-square' => 'tumblr-square',
		'turkish-lira' => 'turkish-lira',
		'twitch' => 'twitch',
		'twitter' => 'twitter',
		'twitter-square' => 'twitter-square',
		'umbrella' => 'umbrella',
		'underline' => 'underline',
		'undo' => 'undo',
		'university' => 'university',
		'unlink' => 'unlink',
		'unlock' => 'unlock',
		'unlock-alt' => 'unlock-alt',
		'unsorted' => 'unsorted',
		'upload' => 'upload',
		'usd' => 'usd',
		'user' => 'user',
		'user-md' => 'user-md',
		'user-plus' => 'user-plus',
		'user-secret' => 'user-secret',
		'user-times' => 'user-times',
		'users' => 'users',
		'venus' => 'venus',
		'venus-double' => 'venus-double',
		'venus-mars' => 'venus-mars',
		'viacoin' => 'viacoin',
		'video-camera' => 'video-camera',
		'vimeo-square' => 'vimeo-square',
		'vine' => 'vine',
		'vk' => 'vk',
		'volume-down' => 'volume-down',
		'volume-off' => 'volume-off',
		'volume-up' => 'volume-up',
		'warning' => 'warning',
		'wechat' => 'wechat',
		'weibo' => 'weibo',
		'weixin' => 'weixin',
		'whatsapp' => 'whatsapp',
		'wheelchair' => 'wheelchair',
		'wifi' => 'wifi',
		'windows' => 'windows',
		'won' => 'won',
		'wordpress' => 'wordpress',
		'wrench' => 'wrench',
		'xing' => 'xing',
		'xing-square' => 'xing-square',
		'yahoo' => 'yahoo',
		'yelp' => 'yelp',
		'yen' => 'yen',
		'youtube' => 'youtube',
		'youtube-play' => 'youtube-play',
		'youtube-square' => 'youtube-square',
	);
	
	return $icon_list;
}
?>