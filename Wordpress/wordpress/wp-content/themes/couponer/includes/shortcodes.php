<?php
/* GRID ELEMENTS */
/* section */
function couponer_section( $atts, $content ){
	extract( shortcode_atts( array(
		'class' => '',
	), $atts ) );
	
	return '<section class="'.esc_attr( $class ).'"><div class="container">'.do_shortcode( $content ).'</div></section>';
	
}
add_shortcode( 'couponer_section', 'couponer_section' );

/* row */
function couponer_row( $atts, $content ){

	return '<div class="row">'.do_shortcode( $content ).'</div>';
	
}
add_shortcode( 'couponer_row', 'couponer_row' );

/* columns */
function couponer_col( $atts, $content ){
	extract( shortcode_atts( array(
		'md' => '',
	), $atts ) );
	
	return '<div class="col-md-'.esc_attr( $md ).'">'.apply_filters( 'the_content', $content ).'</div>';
	
}
add_shortcode( 'couponer_col', 'couponer_col' );

/* button */
function couponer_button( $atts, $content ){
	extract( shortcode_atts( array(
		'text' => '',
		'link' => '',
		'target' => '_self',
		'bg_color' => '',
		'font_color' => '',
		'bg_color_hvr' => '',
		'font_color_hvr' => '',
	), $atts ) );
	
	$random = coupon_confirm_hash(10);
	$style = '
		<style>
			a.'.$random.'{
				background: '.$bg_color.';
				color: '.$font_color.'
			}
			a.'.$random.':hover, .'.$random.':active, .'.$random.':focus{
				background: '.$bg_color_hvr.';
				color: '.$font_color_hvr.'
			}
		</style>
	';
	$html = $style.'<a href="'.$link.'" class="btn btn-custom '.$random.'" target="'.$target.'">'.$text.'</a>';
	
	return $html;
	
}
add_shortcode( 'couponer_button', 'couponer_button' );

	
/* ADD BUTTON TO THE TEXT EDITOR */
function couponer_tinymce_buttons(){
	add_filter( "mce_external_plugins", "couponer_add_buttons" );
    add_filter( 'mce_buttons', 'couponer_register_buttons' );	
}
add_action( 'init', 'couponer_tinymce_buttons' );

function couponer_add_buttons( $plugin_array ) {
    $plugin_array['couponer'] = get_template_directory_uri() . '/js/shortcodes.js';
    return $plugin_array;
}
function couponer_register_buttons( $buttons ) {
    array_push( $buttons, 'couponergrid', 'couponerelements' ); 
    return $buttons;
}


?>