<?php

/* Custom Meta For Taxonomies */


/* Adding New */
/* icon meta */
function coupon_category_icon_add() {
	echo '
	<div class="form-field">
		<label for="term_meta[category_icon]">'.__( 'Icon:', 'pippin' ).'</label>
		<select name="term_meta[category_icon]" id="term_meta[category_icon]"> 
			'.coupon_icons_list( '' ).'
		</select>
		<p class="description">'.__( 'Select icon for the code category','pippin' ).'</p>
	</div>';
}
add_action( 'code_category_add_form_fields', 'coupon_category_icon_add', 10, 2 );

/* Editing */
function coupon_category_icon_edit( $term ) {
	$t_id = $term->term_id;
	$term_meta = get_option( "taxonomy_$t_id" );
	
	$value = !empty( $term_meta['category_icon'] ) ? $term_meta['category_icon'] : '';
	?>
	<table class="form-table">
		<tbody>
			<tr class="form-field form-required">
				<th scope="row"><label for="term_meta[category_icon]"><?php _e( 'Icon', 'coupon' ); ?></label></th>
				<td>
					<select name="term_meta[category_icon]" id="term_meta[category_icon]"> 
						<?php echo coupon_icons_list( $value ); ?>
					</select>
				<p class="description"><?php _e( 'Select icon for the code category', 'coupon' ); ?></p></td>
			</tr>
		</tbody>
	</table>
	<?php
}
add_action( 'code_category_edit_form_fields', 'coupon_category_icon_edit', 10, 2 );

/* Save It */
function coupon_category_icon_save( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_code_category', 'coupon_category_icon_save', 10, 2 );  
add_action( 'create_code_category', 'coupon_category_icon_save', 10, 2 );

/* Delete meta */
function coupon_category_icon_delete( $term_id ) {
	delete_option( "taxonomy_$term_id" );
}  
add_action( 'delete_code_category', 'coupon_category_icon_delete', 10, 2 );

/* Add icon column */
function coupon_category_column( $columns ) {
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'name' => __('Name', 'coupon'),
		'description' => __('Description', 'coupon'),
        'slug' => __( 'Slug', 'coupon' ),
        'posts' => __( 'Codes', 'coupon' ),
		'icon' => __( 'Icon', 'coupon' )
        );
    return $new_columns;
}
add_filter("manage_edit-code_category_columns", 'coupon_category_column'); 

function coupon_populate_category_column( $out, $column_name, $label_id ){
    switch ( $column_name ) {
        case 'icon': 
			$term_meta = get_option( "taxonomy_$label_id" );
			$value = !empty( $term_meta['category_icon'] ) ? $term_meta['category_icon'] : '';

            $out .= '<div style="width: 20px; height: 20px;"><span class="fa fa-'.$value.'"></span></div>';
            break;
 
        default:
            break;
    }
    return $out; 
}

add_filter("manage_code_category_custom_column", 'coupon_populate_category_column', 10, 3);
?>