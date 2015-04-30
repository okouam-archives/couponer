<?php header('Content-type: text/css'); 
	
	/* OVERALL */
	$bg_image = coupon_get_option( 'site_slider' );
	$bg_color = coupon_get_option( 'site_slider_bg_color' );
	$site_color = coupon_get_option( 'site_color' );
	$btn_color_hvr = coupon_get_option( 'btn_color_hvr' );
	
	if( empty( $site_color ) ){
		$site_color = '#24b6ac';
	}
	
	if( empty( $btn_color_hvr ) ){
		$btn_color_hvr = '#24caac';
	}
	
	$nav_hold_bg = coupon_get_option( 'nav_hold_bg' );
	if( empty( $nav_hold_bg ) ){
		$nav_hold_bg = '#fff';
	}

	$nav_hold_border = coupon_get_option( 'nav_hold_border' );
	if( empty( $nav_hold_border ) ){
		$nav_hold_border = '#fff';
	}

	$nav_fist_lvl_color = coupon_get_option( 'nav_fist_lvl_color' );
	if( empty( $nav_fist_lvl_color ) ){
		$nav_fist_lvl_color = '#626262';
	}

	$nav_sub_bg = coupon_get_option( 'nav_sub_bg' );
	if( empty( $nav_sub_bg ) ){
		$nav_sub_bg = '#fff';
	}

	$nav_sub_font = coupon_get_option( 'nav_sub_font' );
	if( empty( $nav_sub_font ) ){
		$nav_sub_font = '#000';
	}

	$nav_sub_bg_hvr = coupon_get_option( 'nav_sub_bg_hvr' );
	if( empty( $nav_sub_bg_hvr ) ){
		$nav_sub_bg_hvr = '#24b6ac';
	}

	$nav_sub_font_hvr = coupon_get_option( 'nav_sub_font_hvr' );
	if( empty( $nav_sub_font_hvr ) ){
		$nav_sub_font_hvr = '#ffffff';
	}

	$body_bg = coupon_get_option( 'body_bg' );
	if( empty( $body_bg ) ){
		$body_bg = '#fff';
	}

	$page_title_divider = coupon_get_option( 'page_title_divider' );
	if( empty( $page_title_divider ) ){
		$page_title_divider = '#e5e5e5';
	}

	$borders_color = coupon_get_option( 'borders_color' );
	if( empty( $borders_color ) ){
		$borders_color = '#e5e5e5';
	}

	$slogan_color = coupon_get_option( 'slogan_color' );
	if( empty( $slogan_color ) ){
		$slogan_color = '#fff';
	}

	$titles_color = coupon_get_option( 'titles_color' );
	if( empty( $titles_color ) ){
		$titles_color = '#000';
	}

	$text_color = coupon_get_option( 'text_color' );
	if( empty( $text_color ) ){
		$text_color = '#000';
	}

	$discount_arrow_color = coupon_get_option( 'discount_arrow_color' );
	if( empty( $discount_arrow_color ) ){
		$discount_arrow_color = '#e5e5e5';
	}

	$shop_filter = coupon_get_option( 'shop_filter' );
	if( empty( $shop_filter ) ){
		$shop_filter = '#fff';
	}

	$top_20_tabs_font_color = coupon_get_option( 'top_20_tabs_font_color' );
	if( empty( $top_20_tabs_font_color ) ){
		$top_20_tabs_font_color = '#000';
	}

	$active_top_20_tabs_font_color = coupon_get_option( 'active_top_20_tabs_font_color' );
	if( empty( $active_top_20_tabs_font_color ) ){
		$active_top_20_tabs_font_color = '#fff';
	}

	$pag_font_color = coupon_get_option( 'pag_font_color' );
	if( empty( $pag_font_color ) ){
		$pag_font_color = '#000';
	}

	$active_pag_font_color = coupon_get_option( 'active_pag_font_color' );
	if( empty( $active_pag_font_color ) ){
		$active_pag_font_color = '#fff';
	}

	$feat_lab_bg = coupon_get_option( 'feat_lab_bg' );
	if( empty( $feat_lab_bg ) ){
		$feat_lab_bg = '#ff8b02';
	}

	$feat_lab_font = coupon_get_option( 'feat_lab_font' );
	if( empty( $feat_lab_font ) ){
		$feat_lab_font = '#fff';
	}

	$coupoon_blog_text = coupon_get_option( 'coupoon_blog_text' );
	if( empty( $coupoon_blog_text ) ){
		$coupoon_blog_text = '#6d6d6d';
	}

	$item_meta_color = coupon_get_option( 'item_meta_color' );
	if( empty( $item_meta_color ) ){
		$item_meta_color = '#8f8f8f';
	}

	$item_meta_icon_color = coupon_get_option( 'item_meta_icon_color' );
	if( empty( $item_meta_icon_color ) ){
		$item_meta_icon_color = '#dadada';
	}

	$countdown_info_font = coupon_get_option( 'countdown_info_font' );
	if( empty( $countdown_info_font ) ){
		$countdown_info_font = '#292929';
	}

	$special_bg = coupon_get_option( 'special_bg' );
	if( empty( $special_bg ) ){
		$special_bg = '#f9fbfb';
	}

	$special_item_bg = coupon_get_option( 'special_item_bg' );
	if( empty( $special_item_bg ) ){
		$special_item_bg = '#fff';
	}

	$special_item_font = coupon_get_option( 'special_item_font' );
	if( empty( $special_item_font ) ){
		$special_item_font = '#000';
	}

	$home_tab_bg = coupon_get_option( 'home_tab_bg' );
	if( empty( $home_tab_bg ) ){
		$home_tab_bg = '#fff';
	}

	$home_tab_font = coupon_get_option( 'home_tab_font' );
	if( empty( $home_tab_font ) ){
		$home_tab_font = '#000';
	}

	$home_tab_font_hvr = coupon_get_option( 'home_tab_font_hvr' );
	if( empty( $home_tab_font_hvr ) ){
		$home_tab_font_hvr = '#fff';
	}

	$footer_bg = coupon_get_option( 'footer_bg' );
	if( empty( $footer_bg ) ){
		$footer_bg = '#292929';
	}

	$footer_widg_cap = coupon_get_option( 'footer_widg_cap' );
	if( empty( $footer_widg_cap ) ){
		$footer_widg_cap = '#fff';
	}

	$footer_widg_text = coupon_get_option( 'footer_widg_text' );
	if( empty( $footer_widg_text ) ){
		$footer_widg_text = '#9d9c9c';
	}

	$footer_widg_link_hvr = coupon_get_option( 'footer_widg_link_hvr' );
	if( empty( $footer_widg_link_hvr ) ){
		$footer_widg_link_hvr = '#fff';
	}

	$footer_news_txt_bg = coupon_get_option( 'footer_news_txt_bg' );
	if( empty( $footer_news_txt_bg ) ){
		$footer_news_txt_bg = '#313131';
	}

	$footer_news_txt_bord = coupon_get_option( 'footer_news_txt_bord' );
	if( empty( $footer_news_txt_bord ) ){
		$footer_news_txt_bord = '#484848';
	}

	$footer_social_font = coupon_get_option( 'footer_social_font' );
	if( empty( $footer_social_font ) ){
		$footer_social_font = '#fff';
	}

	$footer_cat_count_bg = coupon_get_option( 'footer_cat_count_bg' );
	if( empty( $footer_cat_count_bg ) ){
		$footer_cat_count_bg = '#ffffff';
	}
	
	$footer_cat_count_font = coupon_get_option( 'footer_cat_count_font' );
	if( empty( $footer_cat_count_font ) ){
		$footer_cat_count_font = '#313030';
	}
	
	$copyright_bg = coupon_get_option( 'copyright_bg' );
	if( empty( $copyright_bg ) ){
		$copyright_bg = '#fff';
	}

	$copyright_font = coupon_get_option( 'copyright_font' );
	if( empty( $copyright_font ) ){
		$copyright_font = '#878686';
	}

	$modal_bg = coupon_get_option( 'modal_bg' );
	if( empty( $modal_bg ) ){
		$modal_bg = '#fff';
	}

	$modal_font = coupon_get_option( 'modal_font' );
	if( empty( $modal_font ) ){
		$modal_font = '#000';
	}

	$modal_close_font = coupon_get_option( 'modal_close_font' );
	if( empty( $modal_close_font ) ){
		$modal_close_font = '#e5e5e5';
	}

	$sidebar_widg_font = coupon_get_option( 'sidebar_widg_font' );
	if( empty( $sidebar_widg_font ) ){
		$sidebar_widg_font = '#000';
	}

	$sidebar_widg_lnk_hvr = coupon_get_option( 'sidebar_widg_lnk_hvr' );
	if( empty( $sidebar_widg_lnk_hvr ) ){
		$sidebar_widg_lnk_hvr = '#8f8f8f';
	}

	$sidebar_news_txt_bg = coupon_get_option( 'sidebar_news_txt_bg' );
	if( empty( $sidebar_news_txt_bg ) ){
		$sidebar_news_txt_bg = '#ffffff';
	}

	$sidebar_news_txt_bord = coupon_get_option( 'sidebar_news_txt_bord' );
	if( empty( $sidebar_news_txt_bord ) ){
		$sidebar_news_txt_bord = '#ffffff';
	}

	$sidebar_cat_count_bg = coupon_get_option( 'sidebar_cat_count_bg' );
	if( empty( $sidebar_cat_count_bg ) ){
		$sidebar_cat_count_bg = '#313030';
	}

	$sidebar_cat_count_font = coupon_get_option( 'sidebar_cat_count_font' );
	if( empty( $sidebar_cat_count_font ) ){
		$sidebar_cat_count_font = '#fff';
	}
	
	/* SIDEBAR DROPDOWN */
	$sidebar_dropdown_bg = coupon_get_option( 'sidebar_dropdown_bg' );
	if( empty( $sidebar_dropdown_bg ) ){
		$sidebar_dropdown_bg = '#fff';
	}
	
	$sidebar_dropdown_bg_hvr = coupon_get_option( 'sidebar_dropdown_bg_hvr' );
	if( empty( $sidebar_dropdown_bg_hvr ) ){
		$sidebar_dropdown_bg_hvr = '#24b6ac';
	}

	$sidebar_dropdown_font = coupon_get_option( 'sidebar_dropdown_font' );
	if( empty( $sidebar_dropdown_font ) ){
		$sidebar_dropdown_font = '#333';
	}

	$sidebar_dropdown_font_hvr = coupon_get_option( 'sidebar_dropdown_font_hvr' );
	if( empty( $sidebar_dropdown_font_hvr ) ){
		$sidebar_dropdown_font_hvr = '#fff';
	}
	$sidebar_dropdown_cont_bg = coupon_get_option( 'sidebar_dropdown_cont_bg' );
	if( empty( $sidebar_dropdown_cont_bg ) ){
		$sidebar_dropdown_cont_bg = '#fff';
	}

	$sidebar_dropdown_cont_font = coupon_get_option( 'sidebar_dropdown_cont_font' );
	if( empty( $sidebar_dropdown_cont_font ) ){
		$sidebar_dropdown_cont_font = '#000';
	}

	$sidebar_dropdown_cont_bg_hvr = coupon_get_option( 'sidebar_dropdown_cont_bg_hvr' );
	if( empty( $sidebar_dropdown_cont_bg_hvr ) ){
		$sidebar_dropdown_cont_bg_hvr = '#292929';
	}

	$sidebar_dropdown_cont_font_hvr = coupon_get_option( 'sidebar_dropdown_cont_font_hvr' );
	if( empty( $sidebar_dropdown_cont_font_hvr ) ){
		$sidebar_dropdown_cont_font_hvr = '#fff';
	}		

	/* FOOTER DROPDOWN */
	$footer_dropdown_bg = coupon_get_option( 'footer_dropdown_bg' );
	if( empty( $footer_dropdown_bg ) ){
		$footer_dropdown_bg = '#fff';
	}
	
	$footer_dropdown_bg_hvr = coupon_get_option( 'footer_dropdown_bg_hvr' );
	if( empty( $footer_dropdown_bg_hvr ) ){
		$footer_dropdown_bg_hvr = '#24b6ac';
	}

	$footer_dropdown_font = coupon_get_option( 'footer_dropdown_font' );
	if( empty( $footer_dropdown_font ) ){
		$footer_dropdown_font = '#333';
	}

	$footer_dropdown_font_hvr = coupon_get_option( 'footer_dropdown_font_hvr' );
	if( empty( $footer_dropdown_font_hvr ) ){
		$footer_dropdown_font_hvr = '#fff';
	}
	$footer_dropdown_cont_bg = coupon_get_option( 'footer_dropdown_cont_bg' );
	if( empty( $footer_dropdown_cont_bg ) ){
		$footer_dropdown_cont_bg = '#fff';
	}

	$footer_dropdown_cont_font = coupon_get_option( 'footer_dropdown_cont_font' );
	if( empty( $footer_dropdown_cont_font ) ){
		$footer_dropdown_cont_font = '#000';
	}

	$footer_dropdown_cont_bg_hvr = coupon_get_option( 'footer_dropdown_cont_bg_hvr' );
	if( empty( $footer_dropdown_cont_bg_hvr ) ){
		$footer_dropdown_cont_bg_hvr = '#292929';
	}

	$footer_dropdown_cont_font_hvr = coupon_get_option( 'footer_dropdown_cont_font_hvr' );
	if( empty( $footer_dropdown_cont_font_hvr ) ){
		$footer_dropdown_cont_font_hvr = '#fff';
	}	
	/* INNER HEADER DROPDOWN */
	$dropdown_bg = coupon_get_option( 'dropdown_bg' );
	if( empty( $dropdown_bg ) ){
		$dropdown_bg = '#fff';
	}

	$dropdown_font = coupon_get_option( 'dropdown_font' );
	if( empty( $dropdown_font ) ){
		$dropdown_font = '#333';
	}

	$pack_bg = coupon_get_option( 'pack_bg' );
	if( empty( $pack_bg ) ){
		$pack_bg = '#2ca9e0';
	}

	$show_pack_font = coupon_get_option( 'show_pack_font' );
	if( empty( $show_pack_font ) ){
		$show_pack_font = '#fff';
	}

	$side_arows = coupon_get_option( 'side_arows' );
	if( empty( $side_arows ) ){
		$side_arows = '#fff';
	}

	$active_top_20_tabs_border = coupon_get_option( 'active_top_20_tabs_border' );
	if( empty( $active_top_20_tabs_border ) ){
		$active_top_20_tabs_border = '#e5e5e5;';
	}

	$log_reg_err = coupon_get_option( 'log_reg_err' );
	if( empty( $log_reg_err ) ){
		$log_reg_err = '#ff4f53';
	}

	$dropdown_cont_bg = coupon_get_option( 'dropdown_cont_bg' );
	if( empty( $dropdown_cont_bg ) ){
		$dropdown_cont_bg = '#fff';
	}

	$dropdown_cont_font = coupon_get_option( 'dropdown_cont_font' );
	if( empty( $dropdown_cont_font ) ){
		$dropdown_cont_font = '#000';
	}

	$dropdown_cont_bg_hvr = coupon_get_option( 'dropdown_cont_bg_hvr' );
	if( empty( $dropdown_cont_bg_hvr ) ){
		$dropdown_cont_bg_hvr = '#292929';
	}

	$dropdown_cont_font_hvr = coupon_get_option( 'dropdown_cont_font_hvr' );
	if( empty( $dropdown_cont_font_hvr ) ){
		$dropdown_cont_font_hvr = '#fff';
	}

	$ajax_drop_con_bg = coupon_get_option( 'ajax_drop_con_bg' );
	if( empty( $ajax_drop_con_bg ) ){
		$ajax_drop_con_bg = '#292929';
	}

	$ajax_drop_con_font = coupon_get_option( 'ajax_drop_con_font' );
	if( empty( $ajax_drop_con_font ) ){
		$ajax_drop_con_font = '#fff';
	}

	$ajax_drop_con_font_hvr = coupon_get_option( 'ajax_drop_con_font_hvr' );
	if( empty( $ajax_drop_con_font_hvr ) ){
		$ajax_drop_con_font_hvr = '#000';
	}

	$ajax_drop_con_bg_hvr = coupon_get_option( 'ajax_drop_con_bg_hvr' );
	if( empty( $ajax_drop_con_bg_hvr ) ){
		$ajax_drop_con_bg_hvr = '#fff';
	}

	$ajax_drop_placeholder_hvr = coupon_get_option( 'ajax_drop_placeholder_hvr' );
	if( empty( $ajax_drop_placeholder_hvr ) ){
		$ajax_drop_placeholder_hvr = '#dadada';
	}
	
	/*------INPUT TEXT------------*/
	
	$input_text = coupon_get_option( 'input_text' );
	if( empty( $input_text ) ){
		$input_text = '#dadada';
	}	
	
	/*---------ORANGE PROMO BOX-------------*/
	
	$orange_promo = coupon_get_option( 'orange_promo' );
	if( empty( $orange_promo ) ){
		$orange_promo = '#ff8b02';
	}
	
	/*logo padding and width*/
	$padding = coupon_get_option( 'top_bar_logo_padding' );
	if( empty( $padding ) ){
		$padding = '22px 0px 0px 0px';
	}
	
	$width = coupon_get_option( 'top_bar_logo_width' );
	if( empty( $width ) ){
		$width = '140px';
	}

?>

.orange h2, .orange h4{
	color: <?php echo $orange_promo; ?>;
}

/* =========================================================================================== 
NAVIGATION BACKGROUND COLORS ------------------------------------------------------------------
============================================================================================== */
.navbar-default {
    background: <?php echo $nav_hold_bg ?>;
    border-color: <?php echo $nav_hold_border ?>;
}

.navbar-collapse ul.navbar-nav li a {
    color: <?php echo $nav_fist_lvl_color ?>;
}
.navbar-collapse ul.dd-custom li a {
    background: <?php echo $nav_sub_bg ?>;
    color: <?php echo $nav_sub_font ?>;
}


/* =========================================================================================== 
----------------------------------------------------------------------------------------------
==============================  MAIN STARTS FROM HERE  =======================================
==============================  MAIN STARTS FROM HERE  =======================================
----------------------------------------------------------------------------------------------
============================================================================================== */
body {
	background: <?php echo $body_bg ?>;
}

/* =========================================================================================== 
BORDERS COLORS -------------------------------------------------------------------------------
============================================================================================== */

.btn-coupon, button.btn-coupon:hover, button.btn-coupon:active, button.btn-coupon:focus, .navbar-collapse ul.dd-custom, ul.dd-custom, .blog-pagination .pagination li a, .blog-pagination .pagination li span, .form-control, .category-divider, hr, .widget-line-divider, .top-20-tabs ul.nav-tabs li, .featured-item, .featured-item-content, .featured-item .logotype, .blog-inner, .blog-content, .special, .special-item-inner, .blog-inner, .clients, .coupon-content, .register, .ssba, .meta-tags, .widget-caption, .media, .widget-caption, .time-caption, .countdown .days, .widget .widget-inner ul:not(.dd-custom) li, .slider-track, .profile-tabs ul.vertical-tabs li, .profile-tab-pane, .modal-header {
    border-color: <?php echo $borders_color ?>;
}

button.code_type:active:focus{
	border: 1px solid <?php echo $borders_color ?>;
}
/* =========================================================================================== 
TITLES COLORS --------------------------------------------------------------------------------
============================================================================================== */

/*SCREEN HEADER*/

.slogan h1, .slogan p {
    color: <?php echo $slogan_color ?>;
}
/*MAIN PART OF THE PAGES*/

.btn-coupon, .profile-info p, .comment-caption h3, small.info, .special-caption h2, .blog-title h2, .category-caption h2, .contact-caption h2, .top-caption h2, .blog-caption h3, .modal-caption h3, .featured-item-content h4, .blog-content h4, .single-letter h3, .widget-caption h4, .main_content h1, .main_content h2, .main_content h3, .main_content h4, .main_content h5, .comment-body h4, .media-body h2 strong, .profile-tab-pane h2 strong, .profile-tab-pane p, .profile-tabs ul.vertical-tabs li a, .profile-tabs ul.vertical-tabs li a:hover, fieldset label, .single-letter-list ul li a {
    color: <?php echo $titles_color ?>;
}

/*DISCOUNT ARROW BEFORE*/

.coupon-inner:before {
    color: <?php echo $discount_arrow_color ?>;
}
/*SHOP LISTING FILTERS*/

.shop-filter ul li a, .shop-filter ul li a:hover {
    color: <?php echo $shop_filter ?>;
}

/*PAGINTION*/

.blog-pagination ul li a, .blog-pagination ul li span {
    color: <?php echo $pag_font_color ?>;
}
.blog-pagination ul li span:hover{
	color: <?php echo $pag_font_color ?>;
}
.blog-pagination ul li.active a, .blog-pagination ul li.active a:hover {
    color: <?php echo $active_pag_font_color ?>;
}

/* =========================================================================================== 
FEATURED BOX COLORS --------------------------------------------------------------------------
============================================================================================== */

/*FEATURED STICKY*/

.featured-mask {
    background-color: <?php echo $feat_lab_bg ?>;
}
.featured-mask p {
    color: <?php echo $feat_lab_font ?>;
}
/*FEATURED CONTENT*/

.featured-item-content p, p.logged-in-as, p.form-allowed-tags, .profile-intro .profile-media .media-body p,
.category-caption p, .main_content,
.comment-body p, .post .blog-inner .blog-post-content .text p, .blog-content p,
.shop-promo-title h4 p,
.widget .profile .profile-text p,
.comment-notes,
.text p{
    color: <?php echo $text_color ?>;
}
.item-meta ul li a, .item-meta ul li a:hover {
    color: <?php echo $item_meta_color ?>;
}
.item-meta ul li a.info span:before, .item-meta ul li a span, .blog-meta ul li:last-child a span, .item-meta ul li a span:hover, .blog-post-content .blog-meta ul li a span:before {
    color: <?php echo $item_meta_icon_color ?>;
}
.daily-meta ul li a, .daily-meta ul li a:hover, .countdown-listing .kkcountdown-box, .countdown-listing .kkcountdown-box span, .countdown-listing .kkcountdown-box span:hover {
    color: <?php echo $countdown_info_font ?>;
}
/* =========================================================================================== 
SPECIAL CATEGORIES & BLOG LATEST HEADERS COLORS ----------------------------------------------
============================================================================================== */

/*SPECIAL BACKGROUND*/

.special {
    background-color: <?php echo $special_bg ?>;
}
/*SPECIAL ELEMENTS*/

.special-item-inner {
    background-color: <?php echo $special_item_bg ?>;
}
.special-item-inner .special-icon span, .special-item-inner .special-icon h3 {
    color: <?php echo $special_item_font ?>;
}


/* =========================================================================================== 
TABS COLORS ----------------------------------------------------------------------------------
============================================================================================== */

.filter-tabs ul.nav-tabs li {
    background-color: rgba(<?php echo coupon_hex2rgb( $home_tab_bg ) ?>, .8);
}
.filter-tabs ul.nav-tabs li a, .filter-tabs ul.nav-tabs li a:hover {
    color: <?php echo $home_tab_font ?>;
}
/*HOVER*/

.filter-tabs ul.nav-tabs li.active a, .filter-tabs ul.nav-tabs li.active a:hover {
    color: <?php echo $home_tab_font_hvr ?>;
}

/* =========================================================================================== 
TOP 20 TABS COLORS ---------------------------------------------------------------------------
============================================================================================== */

/*TABS*/
.top-20-tabs ul.nav-tabs li{
	background: transparent;
}
.top-20-tabs ul.nav-tabs li a, .top-20-tabs ul.nav-tabs li a:hover, .top-20-tabs ul.nav-tabs li a:active {
    color: <?php echo $top_20_tabs_font_color ?>;
}

.top-20-tabs ul.nav-tabs li.active a, .top-20-tabs ul.nav-tabs li.active a:hover, .btn.btn-custom{
    color: <?php echo $active_top_20_tabs_font_color ?>;
}



/* =========================================================================================== 
----------------------------------------------------------------------------------------------
==============================  FOOTER STARTS FROM HERE  =====================================
==============================  FOOTER STARTS FROM HERE  =====================================
----------------------------------------------------------------------------------------------
============================================================================================== */


/* =========================================================================================== 
FOOTER COLORS --------------------------------------------------------------------------------
============================================================================================== */

/*FOOTER BACKGROUND*/

.footer {
    background-color: <?php echo $footer_bg ?>;
}
/*FOOTER ELEMENTS*/

.footer-caption h3 {
    color: <?php echo $footer_widg_cap ?>;
}

.footer_widget,
.footer_widget p,
.footer_widget .widget-content .time .time-content span div:not(.days),
.footer .footer_widget ul.list-group li a,
.footer_widget .widget-content .time .time-content span.coupon-meta-caption,
.footer_widget .widget-content h5,
.footer_widget .widget-content .time .time-caption p,
.footer_widget .widget-content .timeline p,
.newsletter p,
.footer .widget ul.faq li a, .about ul li a {
    color: <?php echo $footer_widg_text ?>;
}

.footer_widget .form-control-news {
    background-color: <?php echo $footer_news_txt_bg ?>;
    border: 1px solid <?php echo $footer_news_txt_bord ?>;
}

.right_widget .widget-inner .newsletter fieldset .input-group input{
    background-color: <?php echo $sidebar_news_txt_bg ?>;
    border: 1px solid <?php echo $sidebar_news_txt_bord ?>;
}

.footer .social ul.soc-icons li a i, .footer .widget ul li a {
    color: <?php echo $footer_social_font ?>;
}
/*HOVER*/

.footer .widget ul.faq li a:hover, .about ul li a:hover {
    color: <?php echo $footer_widg_link_hvr ?>;
}

/* =========================================================================================== 
COPYRIGHT & BOTTOM NAV COLORS ----------------------------------------------------------------
============================================================================================== */

.copyright, .footer .navbar {
    background: <?php echo $copyright_bg ?>;
}

.navbar-header small,
.bottom-nav .navbar-collapse ul li a {
    color: <?php echo $copyright_font ?>;
}

/* =========================================================================================== 
MODAL COLORS ---------------------------------------------------------------------------------
============================================================================================== */

.showCode-content {
    background: <?php echo $modal_bg ?>;
}
p.modal_text {
    color: <?php echo $modal_font ?>;
}
button.close, button.close:hover {
    color: <?php echo $modal_close_font ?>;
}
/* =========================================================================================== 
WIDGET COLORS --------------------------------------------------------------------------------
============================================================================================== */

.widget h5,
.time-caption p,
.time-content span.coupon-meta-caption,
.countdown,
.widget .widget-inner ul li a,
.timeline p,
.widget .widget-inner .time-caption a {
    color: <?php echo $sidebar_widg_font ?>;
}

.widget .widget-inner ul li a:hover, .widget .widget-inner a:hover{
	color: <?php echo $sidebar_widg_lnk_hvr ?>;
}

a.btn.btn-custom:hover{
    color: <?php echo $active_top_20_tabs_font_color ?>;
}

.right_widget .badge {
	background-color: <?php echo $sidebar_cat_count_bg ?>;
    color: <?php echo $sidebar_cat_count_font ?>;
}

.footer_widget .badge {
	background-color: <?php echo $footer_cat_count_bg ?>;
    color: <?php echo $footer_cat_count_font ?>;
}

.screen{
	background: url(<?php echo $bg_image; ?>) no-repeat fixed center;
	background-color: <?php echo $bg_color; ?>;
}

@media only screen and (max-width: 1030px) {
	.screen{
		background: url(<?php echo $bg_image; ?>) no-repeat center;
		background-color: <?php echo $bg_color; ?>;
	}
}
.filter-tabs ul.nav-tabs li.active:before{
	color: <?php echo $site_color; ?>;
}
p.code-replace:before{
	color: <?php echo $site_color; ?>;
}

p.code-replace:after{
	color: <?php echo $site_color; ?>;
}

.special-item a:hover .special-item-inner,
.blog-pagination ul li.active a,
.blog-pagination ul li a:hover,
.blog-pagination ul li.active a:hover
{
	border: 1px solid <?php echo $site_color; ?>;
}

p.code-replace, p.code-replace:hover, p.code-replace:focus{
	border: 3px solid <?php echo $site_color; ?>;
}

.sticky{
	border-bottom:5px solid <?php echo $site_color; ?>;
}

.shop-filter,
.to-top a{
	background: <?php echo $site_color; ?>;
}

.register .register-form input[type="text"]:focus, .register .register-form input[type="password"]:focus, .register .register-form input[type="email"]:focus, .register .register-form textarea:focus, .form-control-custom:focus, .form-control-custom:focus{
	border-color: <?php echo $site_color; ?>;
}


.green,
.navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a,
.navbar-collapse ul.navbar-nav li a:hover,
.navbar-collapse ul.navbar-nav li a.active,
.item-meta ul li:last-child a span,
.special-item a:hover .special-item-inner,
.widget .profile .profile-info a,
.comment-body a,
.comment-body a:hover,
.featured-item-container .featured-item .featured-item-content a:hover,
.send_result p.success,
.forgot a, .forgot a:hover,
.single-letter-list ul li a:hover,
.profile-tabs ul.vertical-tabs li.active a,
.pass a,
.profile-item-content p a, .profile-item-content p a:hover,
.widget .widget-inner ul li.recentcomments a,
.widget .widget-caption h4 a.rsswidget, .footer .widget .footer-caption h3 a.rsswidget,
.widget .widget-caption h4 a.rsswidget, .footer .widget .footer-caption h3 a.rsswidget,
.widget .widget-inner ul li a.rsswidget, .footer .widget .widget ul li a.rsswidget,
#wp-calendar tbody td a,
#wp-calendar tbody td a:hover,
#wp-calendar tfoot #next a,
#wp-calendar tfoot #prev a ,
.footer #wp-calendar tbody td a,
.footer #wp-calendar tbody td a:hover,
.footer #wp-calendar tfoot #next a,
.footer #wp-calendar tfoot #prev a,
.tagcloud a,
.tagcloud a:hover,
.footer .widget ul li a.rsswidget,
.footer .widget ul li a.rsswidget:hover,
.footer #wp-calendar tfoot tr td a,
.footer #wp-calendar tbody tr td a,
p.code-replace, p.code-replace:hover, p.code-replace:focus,
p.logged-in-as a, p.logged-in-as a:hover,
.avatar-delete a,
a{
	color: <?php echo $site_color; ?>;
}

/*HOVER*/

.navbar-collapse ul.dd-custom li a:hover {
    background-color: rgba(<?php echo coupon_hex2rgb( $nav_sub_bg_hvr ); ?>, .9);
    color: <?php echo $nav_sub_font_hvr ?>;
}

.green-bg,
.btn-custom,
.filter-tabs ul.nav-tabs li.active, .filter-tabs ul.nav-tabs li.active a:focus,
.filter-tabs ul.nav-tabs li.active:focus a,
.blog-pagination ul li.active a,
.blog-pagination ul li a:hover,
.blog-pagination ul li.active a:hover,
.widget .widget-inner .widget-content .dropdown button:focus, .widget .widget-inner .widget-content .dropdown button:hover,
.panel-default>.panel-heading,
button.btn-coupon:hover, button.btn-coupon:focus, button.btn-coupon:active,
.btn-coupon.btn-coupon-clicked,
.popover h3.popover-title,
.slider-handle
{
	background-color: <?php echo $site_color; ?>;
}


.navbar-collapse ul.dd-custom li a:hover{
	background-color: rgba(<?php echo coupon_hex2rgb( $site_color ); ?>, .9);
}

.register .register-form input[type="text"]:focus, .register .register-form input[type="password"]:focus, .register .register-form input[type="email"]:focus, .register .register-form textarea:focus, .form-control-custom:focus, .form-control-custom:focus  {
	-webkit-box-shadow: 0 0 8px rgba(<?php echo coupon_hex2rgb( $site_color ); ?>, .6);
	box-shadow: 0 0 8px rgba(<?php echo coupon_hex2rgb( $site_color ); ?>, .6);	
}

a.btn-top, a.btn-top:focus, a.btn-top:active, a.btn-top:hover{
 	background: -webkit-linear-gradient(-225deg, rgba(255,255,255,0.2) 0, rgba(255,255,255,0.2) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 50%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0.2) 75%, rgba(0,0,0,0) 75%, rgba(0,0,0,0) 100%), rgba(<?php echo coupon_hex2rgb( $site_color ); ?>,1);
 	background: -moz-linear-gradient(315deg, rgba(255,255,255,0.2) 0, rgba(255,255,255,0.2) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 50%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0.2) 75%, rgba(0,0,0,0) 75%, rgba(0,0,0,0) 100%), rgba(<?php echo coupon_hex2rgb( $site_color ); ?>,1);
 	background: linear-gradient(315deg, rgba(255,255,255,0.2) 0, rgba(255,255,255,0.2) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 50%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0.2) 75%, rgba(0,0,0,0) 75%, rgba(0,0,0,0) 100%), rgba(<?php echo coupon_hex2rgb( $site_color ); ?>,1);
 	background-position: auto auto;
 	-webkit-background-size: 25px 25px;
 	background-size: 25px 25px;	
}
a.blue-bg, a.blue-bg:hover, a.blue-bg:focus, a.blue-bg:active {
	background: #2ca9e0;
}

.pass a:hover, .avatar-delete a:hover{
	color: <?php echo $btn_color_hvr ?>;
}

.blog-icon-mask:hover,
.btn-custom:hover, .btn-custom:focus, .btn-custom:active{
	background-color: <?php echo $btn_color_hvr ?>;
}
.bottom-nav, .widget ul li, .special-item .coupon-inner {
	background: transparent;
}

/* SIDEBAR DROPDOWNS */
button.dropdown-toggle.btn, button.dropdown-toggle.btn:hover, button.dropdown-toggle.btn:active, button.dropdown-toggle.btn:focus, .open .dropdown-toggle.btn-categories{
    color: <?php echo $dropdown_font ?>;
    background-color: <?php echo $dropdown_bg ?>;
    border-color: <?php echo $dropdown_bg ?>;
}

.widget button.dropdown-toggle.btn, .widget button.dropdown-toggle.btn:hover, .widget button.dropdown-toggle.btn:active, .widget button.dropdown-toggle.btn:focus{
    color: <?php echo $sidebar_dropdown_font ?>;
    background-color: <?php echo $sidebar_dropdown_bg ?>;
	border: 1px solid <?php echo $borders_color ?>;
}

.widget .widget-inner .widget-content .dropdown button:hover, 
.widget .widget-inner .widget-content .dropdown button:active, 
.widget .widget-inner .widget-content .dropdown button:focus{
	color: <?php echo $sidebar_dropdown_bg_hvr; ?>;
}

.widget .widget-inner .widget-content .dropdown button:hover, 
.widget .widget-inner .widget-content .dropdown button:active, 
.widget .widget-inner .widget-content .dropdown button:focus,
.widget .widget-inner .widget-content .dropdown button:hover span, 
.widget .widget-inner .widget-content .dropdown button:active span, 
.widget .widget-inner .widget-content .dropdown button:focus span{
	color: <?php echo $sidebar_dropdown_font_hvr ?>;
}

/* FOOTER DROPDOWNS */
.widget.footer_widget button.dropdown-toggle.btn{
    color: <?php echo $footer_dropdown_font ?>;
    background-color: <?php echo $footer_dropdown_bg ?>;
	border: 1px solid <?php echo $borders_color ?>;
}

.widget.footer_widget button.dropdown-toggle.btn:hover, 
.widget.footer_widget button.dropdown-toggle.btn:active, 
.widget.footer_widget button.dropdown-toggle.btn:focus{
	background-color: <?php echo $footer_dropdown_bg_hvr; ?>;
	color: <?php echo $footer_dropdown_font_hvr ?>;
}

/* PACK AND OPEN BUTTON */

a.blue-bg, a.blue-bg:hover, a.blue-bg:focus, a.blue-bg:active {
	background-color: <?php echo $pack_bg ?>;
	color: <?php echo $show_pack_font ?>;  
}

a.btn-top, a.btn-top:hover, a.btn-top:focus, a.btn-top:active {
	color: <?php echo $show_pack_font ?>;  
}

/* BUTTON ARROWS */
a.btn-top:before, a.btn-top:after {
	color: <?php echo $side_arows ?>;  
}

/* TOP20 ACTIVE TAB BORDER COLOR */

.top-20-tabs ul.nav-tabs li.active {
	border-color: <?php echo $active_top_20_tabs_border ?>;  
}



/*LOGIN | REGISTER ERROR TEXT */

small.text-danger {
	color: <?php echo $log_reg_err ?>;
}

/* DROPDOWNS */
ul.dropdown-menu {
	background-color: rgba(<?php echo coupon_hex2rgb( $dropdown_cont_bg ) ?>, .9);
}


ul.dropdown-menu li a, .widget ul.dropdown-menu li a { 
	color: <?php echo $dropdown_cont_font ?>;
}

ul.dropdown-menu li a:hover, .widget .widget-inner .widget-content .dd-widget li a:hover {
	background-color: rgba(<?php echo coupon_hex2rgb( $dropdown_cont_bg_hvr ) ?>, .9);
        color: <?php echo $dropdown_cont_font_hvr ?>;
}
/*  SIDEBAR DROPDOWN CONTENT */
.widget ul.dropdown-menu {
	background-color: rgba(<?php echo coupon_hex2rgb( $sidebar_dropdown_cont_bg ) ?>, .9);
}


.widget ul.dropdown-menu li a, .widget ul.dropdown-menu li a { 
	color: <?php echo $sidebar_dropdown_cont_font ?>;
}

.widget ul.dropdown-menu li a:hover, .widget .widget-inner .widget-content .dd-widget li a:hover {
	background-color: rgba(<?php echo coupon_hex2rgb( $sidebar_dropdown_cont_bg_hvr ) ?>, .9);
        color: <?php echo $sidebar_dropdown_cont_font_hvr ?>;
}

/* FOOTER DROPDOWN CONTENT */
.widget.footer_widget ul.dropdown-menu {
	background-color: rgba(<?php echo coupon_hex2rgb( $footer_dropdown_cont_bg ) ?>, .9);
}


.widget.footer_widget ul.dropdown-menu li a, .widget ul.dropdown-menu li a { 
	color: <?php echo $footer_dropdown_cont_font ?>;
}

.widget.footer_widget ul.dropdown-menu li a:hover, .widget .widget-inner .widget-content .dd-widget li a:hover {
	background-color: rgba(<?php echo coupon_hex2rgb( $footer_dropdown_cont_bg_hvr ) ?>, .9);
        color: <?php echo $footer_dropdown_cont_font_hvr ?>;
}


/* THE REST OF THE PLACEHOLDERS */
.form-group .form-control {
    color: <?php echo $input_text ?>;
}

.form-group .form-control::-webkit-input-placeholder { /* WebKit browsers */
    color: <?php echo $input_text ?>;
}
.form-group .form-control:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    color: <?php echo $input_text ?>;
    opacity:  1;
}
.form-group .form-control::-moz-placeholder { /* Mozilla Firefox 19+ */
    color: <?php echo $input_text ?>;
    opacity:  1;
}
.form-group .form-control-custom:-ms-input-placeholder { /* Internet Explorer 10+ */
    color: <?php echo $input_text ?>;
}

/* AJAX SEARCH */
.form-horizontal .form-group .form-control, .ajax_search_results ul {
	background-color: rgba(<?php echo coupon_hex2rgb( $ajax_drop_con_bg ) ?>, .9);
}

.form-horizontal .form-group input[type="text"], .ajax_search_results ul li a {
	color: <?php echo $ajax_drop_con_font ?>;
}

.ajax_search_results ul li a:hover {
        color: <?php echo $ajax_drop_con_font_hvr ?>;
        background-color: rgba(<?php echo coupon_hex2rgb( $ajax_drop_con_bg_hvr ) ?>, .9);  
}

.filters .form-horizontal .has-feedback .form-control-feedback{
	color: <?php echo $ajax_drop_con_font ?>;
}

.form-horizontal .form-group .form-control::-webkit-input-placeholder { /* WebKit browsers */
    color: <?php echo $ajax_drop_placeholder_hvr ?>;
}
.form-horizontal .form-group .form-control:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    color: <?php echo $ajax_drop_placeholder_hvr ?>;
    opacity: 1;
}
.form-horizontal .form-group .form-control::-moz-placeholder { /* Mozilla Firefox 19+ */
    color: <?php echo $ajax_drop_placeholder_hvr ?>;
    opacity: 1;
}
.form-horizontal .form-group .form-control:-ms-input-placeholder { /* Internet Explorer 10+ */
    color: <?php echo $ajax_drop_placeholder_hvr ?>;
}
<?php
$navigation_style = coupon_get_option( 'navigation_style' );
if( $navigation_style == 'style_1' ){
?>
	.navbar-brand{
		width: <?php echo $width; ?>;
	}
	
	@media only screen and (min-width: 780px) {
		.navbar-brand img{
			padding: <?php echo $padding; ?>;
		}
	}	
<?php
}
?>
.expired, .expired h2, .expired h3, .expired h4, .expired h4 p, .expired p, .expired a, .expired ul li a span, .expired .disabled {
	color: #e5e5e5;
	border-color: #e5e5e5;
}

.expired .disabled {
	background-color: #e5e5e5 !important;
	color: #fff;
}

.expired .shop-meta {
	color: #dadada;
}
