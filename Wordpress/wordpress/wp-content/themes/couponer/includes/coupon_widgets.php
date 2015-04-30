<?php
	/**********************************************************************
	***********************************************************************
	COUPON WIDGETS
	**********************************************************************/

	/******************************************************** 
Coupon Text Widget
********************************************************/
class Coupon_Text extends WP_Widget {
	public function __construct() {
		parent::__construct('coupon_archives', __('Coupon Text','coupon'), array('description' =>__('Coupon Text Widget','coupon') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$text = empty( $instance['text'] ) ? '' : $instance['text'];

		echo $before_widget.
				$before_title.$title.$after_title.
				'<div class="widget-list">
					'.$text.'
				</div>'.
			 $after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		
		$title = esc_attr( $instance['title'] );
		$text = esc_attr( $instance['text'] );

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';
		
		echo '<p><label for="'.esc_attr($this->get_field_id('text')).'">'.__( 'Text:', 'coupon' ).'</label>';
		echo '<textarea class="widefat" id="'.esc_attr($this->get_field_id('text')).'"  name="'.esc_attr($this->get_field_name('text')).'">'.$text.'</textarea></p>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = $new_instance['text'];
		return $instance;	
	}	
}
/******************************************************** 
Coupon List Widget
********************************************************/
class Coupon_List extends WP_Widget {
	public function __construct() {
		parent::__construct('coupon_list', __('Coupon List','coupon'), array('description' =>__('Coupon List Widget','coupon') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$text = empty( $instance['text'] ) ? '' : $instance['text'];

		$list = explode( "\n", $text );
		echo $before_widget.
				$before_title.$title.$after_title.
				'<div class="widget-list"><ul>';
					if( !empty( $list ) ){
						foreach( $list as $item ){
							echo '<li>'.$item.'</li>';
						}
					}
		echo	'</ul></div>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		
		$title = esc_attr( $instance['title'] );
		$text = esc_attr( $instance['text'] );

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';		
		
		echo '<p><label for="'.esc_attr($this->get_field_id('text')).'">'.__( 'List (one in a line):', 'coupon' ).'</label>';
		echo '<textarea class="widefat" id="'.esc_attr($this->get_field_id('text')).'"  name="'.esc_attr($this->get_field_name('text')).'">'.$text.'</textarea></p>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = $new_instance['text'];
		return $instance;	
	}	
}

/******************************************************** 
Coupon FAQ
********************************************************/
class Coupon_FAQ extends WP_Widget {
	public function __construct() {
		parent::__construct('coupon_faq', __('Coupon FAQ','coupon'), array('description' =>__('Coupon FAQ Widget','coupon') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$count = empty( $instance['count'] ) ? '' : $instance['count'];
		$query = new WP_Query(
			array(
				'posts_per_page'	=> $count,
				'post_type'		=> 'faq',
				'post_status' => 'publish'
			)
		);
		
		echo $before_widget.
				$before_title.$title.$after_title.
				'<ul class="list-unstyled faq">';
				if( $query->have_posts() ){
					while( $query->have_posts() ){
						$query->the_post();
						echo '<li><a href="'.esc_url( coupon_get_permalink_by_tpl( 'page-tpl_faq' ) ).'">'.get_the_title().'</a></li>';
					}
				}
		echo '</ul>'.$after_widget;

		wp_reset_query();		
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '') );
		
		$title = esc_attr( $instance['title'] );
		$count = esc_attr( $instance['count'] );		
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';		
		
		echo '<p><label for="'.esc_attr($this->get_field_id('count')).'">'.__( 'Number of FAQ:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('count')).'"  name="'.esc_attr($this->get_field_name('count')).'" value="'.esc_attr( $count ).'"></p>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] =  strip_tags( $new_instance['title'] );
		$instance['count'] =  strip_tags( $new_instance['count'] );
		return $instance;	
	}	
}

/******************************************************** 
Coupon Social Widget
********************************************************/
class Coupon_Social extends WP_Widget {
	public function __construct() {
		parent::__construct('coupon_social', __('Coupon Social','coupon'), array('description' =>__('Coupon Social Widget','coupon') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$twitter = empty( $instance['twitter'] ) ? '' : '<li><a href="'.esc_url( $instance['twitter'] ).'" class="active"><i class="fa fa-twitter-square"></i></a></li>';
		$facebook = empty( $instance['facebook'] ) ? '' : '<li><a href="'.esc_url( $instance['facebook'] ).'" class="active"><i class="fa fa-facebook-square"></i></a></li>';
		$google = empty( $instance['google'] ) ? '' : '<li><a href="'.esc_url( $instance['google'] ).'" class="active"><i class="fa fa-google-plus-square"></i></a></li>';
		
		echo $before_widget.
				$before_title.$title.$after_title.
				'<div class="social">
					<ul class="list-inline soc-icons">
						'.$twitter.'
						'.$facebook.'
						'.$google.'
					</ul>
				</div>'.
			 $after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'twitter' => '', 'facebook' => '', 'google' => '' ) );
		
		$title = $instance['title'];
		$twitter = $instance['twitter'];
		$facebook =  $instance['facebook'];
		$google =  $instance['google'];
	
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';
		
		echo '<p><label for="'.esc_attr($this->get_field_id('twitter')).'">'.__( 'Twitter page link:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('twitter')).'"  name="'.esc_attr($this->get_field_name('twitter')).'" value="'.esc_url( $twitter ).'"></p>';
				
		echo '<p><label for="'.esc_attr($this->get_field_id('facebook')).'">'.__( 'Facebook page link:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('facebook')).'"  name="'.esc_attr($this->get_field_name('facebook')).'" value="'.esc_url( $facebook ).'"></p>';
				
		echo '<p><label for="'.esc_attr($this->get_field_id('google')).'">'.__( 'Google+ page link:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('google')).'"  name="'.esc_attr($this->get_field_name('google')).'" value="'.esc_url( $google ).'"></p>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['google'] = strip_tags( $new_instance['google'] );
		return $instance;	
	}	
}

/******************************************************** 
Coupon Categories Widget
********************************************************/
class Coupon_Categories extends WP_Widget {
	public function __construct() {
		parent::__construct('coupon_categories', __('Coupon Categories','coupon'), array('description' =>__('Coupon Categories Widget','coupon') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$categories = empty( $instance['categories'] ) ? array() : explode( ",", $instance['categories'] );
		
		echo $before_widget.
				$before_title.$title.$after_title.
				'<ul class="list-group">';
					if( !empty( $categories ) ){
						foreach( $categories as $category ){
							if( !empty( $category ) ){
								$term = get_term_by( 'id', $category, 'code_category' );
								$args = array(
									'post_type' => 'code',
									'post_status' => 'publish',
									'code_category' => $term->slug,
									'numberposts' => -1
								);
								$num = count( get_posts( $args ) );
								$term_link = get_term_link( $term->slug, 'code_category' );
								
								echo '<li class="list-group-item">
										<span class="badge">'.$num.'</span>
										<a href="'.esc_url( $term_link ).'"> '.$term->name.' </a>
									  </li>';
							}
						}
					}
		echo	'</ul>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'categories' => '' ) );
		
		$title = esc_attr( $instance['title'] );
		$categories = explode( ",", $instance['categories'] );
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';
		
		echo '<p><label for="'.esc_attr($this->get_field_id('categories')).'">'.__( 'Select categories:', 'coupon' ).'</label>';
		echo '<select class="widefat" name="'.esc_attr($this->get_field_name('categories')).'[]" multiple>';		
			$parents = get_terms( 'code_category', array( 'hide_empty' => 0, 'parent' => 0 ) );

			if( !empty( $parents ) ){
				foreach( $parents as $parent ){
					echo '<optgroup label="'.$parent->name.'">'	;	
					$children = get_terms( 'code_category', array( 'hide_empty' => 0, 'parent' => $parent->term_id ) );
					if( !empty( $children ) ){
						foreach( $children as $child ){
							echo '<option value="'.esc_attr( $child->term_id ).'" '.( in_array( $child->term_id, $categories ) ? 'selected="selected"' : '' ).'>'.$child->name."</option>";
						}
					}
					echo '</optgroup>';
				}
			}
		echo '</select>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = join( ",", $new_instance['categories'] );
		return $instance;	
	}	
}

/******************************************************** 
Coupon Newsletter Widget
********************************************************/
class Coupon_Newsletter extends WP_Widget {
	public function __construct() {
		parent::__construct('coupon_newsletter', __('Coupon Newsletter','coupon'), array('description' =>__('Coupon Newsletter Widget','coupon') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? __( 'Newsletter', 'coupon' ) : $instance['title'];
		$subtitle = empty( $instance['subtitle'] ) ? __( 'Latest discounts and coupons', 'coupon' ) : $instance['subtitle'];
		$placeholder = empty( $instance['placeholder'] ) ? esc_attr__( 'Email Address', 'coupon' ) : esc_attr( $instance['placeholder'] );
		$btn_text = empty( $instance['btn_text'] ) ? __( 'Subscribe', 'coupon' ) : $instance['btn_text'];
		
		if( !empty( $subtitle ) ){
			$subtitle = '<p>'.$subtitle.'</p>';
		}
		
		echo $before_widget.
				$before_title.$title.$after_title.
				'<div class="newsletter">
					'.$subtitle.'
					<div class="subscription_result"></div>
					<fieldset>
						<div class="input-group">
							<input type="text" class="form-control-news email" placeholder="'.$placeholder.'" name="email_news">
							<br>
							<button type="submit" class="btn btn-custom btn-default subscribe">'.$btn_text.'</button>
						</div>
					</fieldset>
				</div>'.$after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'subtitle' => '', 'placeholder' => '', 'btn_text' => '' ) );

		$title = $instance['title'];
		$subtitle = $instance['subtitle'];
		$placeholder = $instance['placeholder'];
		$btn_text = $instance['btn_text'];
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';
		
		echo '<p><label for="'.esc_attr($this->get_field_id('subtitle')).'">'.__( 'Subtitle:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('subtitle')).'"  name="'.esc_attr($this->get_field_name('subtitle')).'" value="'.esc_attr( $subtitle ).'"></p>';
		
		echo '<p><label for="'.esc_attr($this->get_field_id('placeholder')).'">'.__( 'Placeholder:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('placeholder')).'"  name="'.esc_attr($this->get_field_name('placeholder')).'" value="'.esc_attr( $placeholder ).'"></p>';
		
		echo '<p><label for="'.esc_attr($this->get_field_id('btn_text')).'">'.__( 'Button Text:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('btn_text')).'"  name="'.esc_attr($this->get_field_name('btn_text')).'" value="'.esc_attr( $btn_text ).'"></p>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['placeholder'] = strip_tags( $new_instance['placeholder'] );
		$instance['btn_text'] = strip_tags( $new_instance['btn_text'] );
		return $instance;	
	}	
}

/******************************************************** 
Coupon Popular Shops Widget
********************************************************/
class Coupon_Popular_Shops extends WP_Widget {
	public function __construct() {
		parent::__construct('coupon_popular_shops', __('Coupon Popular Shops','coupon'), array('description' =>__('Coupon Popular Shops Widget','coupon') ));
	}
	public function widget( $args, $instance ) {
		global $wpdb;
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$count = empty( $instance['count'] ) ? 5 : $instance['count'];
		
		$popular_shops = coupon_popular_shops( $count );
		
		echo $before_widget.
				$before_title.$title.$after_title.
				'<ul class="list-group">';
					if( !empty( $popular_shops ) ){
						foreach( $popular_shops as $popular_shop ){
							$result = $wpdb->get_results("SELECT COUNT(*) AS code_num FROM {$wpdb->prefix}postmeta AS postmeta WHERE postmeta.meta_key = 'code_shop_id' AND postmeta.meta_value='{$popular_shop->ID}'");
							$result = array_shift( $result );
							echo '
								<li class="list-group-item">
									<span class="badge">'.$result->code_num.'</span>
									<a href="'.esc_url( get_permalink( $popular_shop->ID ) ).'"> '.$popular_shop->post_title.' </a>
								</li>';
						}
					}
		echo	'</ul>'.
			 $after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '' ) );

		$title =  $instance['title'];
		$count = $instance['count'];
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';
		
		echo '<p><label for="'.esc_attr($this->get_field_id('count')).'">'.__( 'Number of shops:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('count')).'"  name="'.esc_attr($this->get_field_name('count')).'" value="'.esc_attr( $count ).'"></p>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		return $instance;	
	}	
}

/******************************************************** 
Coupon Search Widget
********************************************************/
class Coupon_Search extends WP_Widget {
	public function __construct() {
		parent::__construct('coupon_search', __('Coupon Search','coupon'), array('description' =>__('Coupon Search Widget','coupon') ));
	}
	public function widget( $args, $instance ) {
		global $wpdb;
		extract($args);
		$title = empty( $instance['title'] ) ? __( 'Search Coupons', 'coupon' ) : $instance['title'];
		
		$code_category = '';
		if( !empty( $_GET['code_category'] ) ){
			$code_category = $_GET['code_category'];
		}
		
		$code_shop_id = '';
		if( !empty( $_GET['code_shop_id'] ) ){
			$code_shop_id = $_GET['code_shop_id'];
		}		
		
		$shops_list = '';
		$shops = get_posts(array(
			'post_type' => 'shop',
			'post_status' => 'publish',
			'posts_per_page' => -1
		));
		
		if( !empty( $shops ) ){
			foreach( $shops as $shop ){
				$shops_list .= '<li><a href="#" data-value="'.$shop->ID .'" '.( $shop->ID == $code_shop_id ? 'data-selected="selected"' : '' ).'>'.$shop->post_title.'</a></li>';
			}
		}
		
		$category_list = '';
		$parents = get_terms( 'code_category', array( 'hide_empty' => 1, 'parent' => 0 ) );
		if( !empty( $parents ) ){
			foreach( $parents as $parent ){
				$children = get_terms( 'code_category', array( 'hide_empty' => 1, 'parent' => $parent->term_id ) );
				if( !empty( $children ) ){
					foreach( $children as $child ){
						$term_meta = get_option( "taxonomy_".$child->term_id );	
						$icon = !empty( $term_meta['category_icon'] ) ? $term_meta['category_icon'] : '';
						$category_list .= '<li><a href="#" data-value="'.esc_attr( $child->slug ).'" '.( $child->slug == $code_category ? 'data-selected="selected"' : '' ).'><i class="fa fa-'.esc_attr( $icon ).'"></i> '.$child->name.'</a></li>';
					}
				}
			}
		}
		
		$result = $wpdb->get_results( "SELECT MAX( postmeta.meta_value ) AS max_range FROM {$wpdb->prefix}posts as posts LEFT JOIN {$wpdb->prefix}postmeta as postmeta ON posts.ID = postmeta.post_id WHERE posts.post_status = 'publish' AND postmeta.meta_key='code_expire'" );
		$result = array_shift( $result );
		
		$secondsInAMinute = 60;
		$secondsInAnHour  = 60 * $secondsInAMinute;
		$secondsInADay    = 24 * $secondsInAnHour;

		/* extract days */
		$days = ceil( ($result->max_range - time() ) / $secondsInADay );
		if( $days < 0 ){
			$days = 1;
		}
		
		$start_range = 0;
		if( !empty( $_GET['start_range'] ) ){
			$start_range = $_GET['start_range'];
		}
		
		$end_range = $days;
		if( !empty( $_GET['end_range'] ) ){
			$end_range = $_GET['end_range'];
		}	
		
		$coupon_label = '';
		if( !empty( $_GET['coupon_label'] ) ){
			$coupon_label = $_GET['coupon_label'];
		}
		
		echo $before_widget.
				$before_title.$title.$after_title.
				'<!-- widget-content -->
					<div class="widget-content">

						<!-- time-slider -->
						<div class="timeline">
							<p>'.__( 'Days Range:' , 'coupon').' <span class="green">'.$start_range.'</span> - <span class="green">'.$end_range.'</span></p>
						</div>

						<div class="slider slider-horizontal">
							<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="'.esc_attr( $days ).'" data-slider-step="1" data-slider-value="['.esc_attr( $start_range ).','.esc_attr( $end_range ).']" id="time-slider">
						</div>
						<!-- .time-slider -->

						<!-- dropdown-categories -->
						<div class="dropdown dd-widget">
							<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
								'.__( 'Categories' , 'coupon').'
								<span class="fa fa-angle-down pull-right"></span>
							</button>
							<ul class="dropdown-menu dd-custom dd-widget" role="menu" data-name="code_category">
								'.$category_list.'
							</ul>
						</div>
						<!-- .dropdown-categories -->

						<!-- dropdown-shops -->
						<div class="dropdown dd-widget">
							<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
								'.__( 'Shops', 'coupon' ).'
								<span class="fa fa-angle-down pull-right"></span>
							</button>
							<ul class="dropdown-menu dd-custom dd-widget" role="menu" data-name="code_shop_id">
								'.$shops_list.'
							</ul>
						</div>
						<!-- .dropdown-shops -->

						<!-- dropdown-type -->
						<div class="dropdown dd-widget">
							<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
								'.__( 'Type', 'coupon' ).'
								<span class="fa fa-angle-down pull-right"></span>
							</button>
							<ul class="dropdown-menu dd-custom dd-widget" role="menu" data-name="coupon_label">
								<li><a href="#" data-value="coupon" '.( $coupon_label == 'coupon' ? 'data-selected="selected"' : '' ).'>'.__( 'Coupon', 'coupon' ).'</a>
								</li>
								<li><a href="#" data-value="discount" '.( $coupon_label == 'discount' ? 'data-selected="selected"' : '' ).'>'.__( 'Discount', 'coupon' ).'</a>
								</li>
							</ul>
						</div>
						<!-- .dropdown-type -->

						<!-- search-button -->
						<form method="get" action="'.coupon_get_permalink_by_tpl( 'page-tpl_code_search' ).'" class="search_widget">
							<input type="hidden" value="'.esc_attr( $start_range ).'" name="start_range">
							<input type="hidden" value="'.esc_attr( $end_range ).'" name="end_range">
							<input type="hidden" value="'.esc_attr( $code_category ).'" name="code_category">
							<input type="hidden" value="'.esc_attr( $code_shop_id ).'" name="code_shop_id">
							<input type="hidden" value="'.esc_attr( $coupon_label ).'" name="coupon_label">						
							<button type="submit" class="btn btn-custom btn-full btn-default btn-lg">'.__( 'Search Coupons', 'coupon' ).'</button>
						</form>
						<!-- .search-button -->

					</div>
					<!-- .widget-content -->'.
			 $after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );

		$title = $instance['title'];
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;	
	}	
}

class Coupon_Daily_Offer extends WP_Widget {
	public function __construct() {
		parent::__construct('coupon_daily_offer', __('Coupon Daily Offer','coupon'), array('description' =>__('Coupon Daily Offer Widget','coupon') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? __( 'Daily Offer', 'coupon' ) : $instance['title'];
		$offer_id = $instance['offer_id'];
		if( !empty( $offer_id ) ){
			$daily = get_post( $offer_id );
			$post_meta = get_post_meta( $offer_id );
			$promo_text = coupon_get_smeta( 'promo_text', $post_meta, '' );
			$offer_expire = coupon_get_smeta( 'offer_expire', $post_meta, '' );
			$offer_expire = coupon_get_smeta( 'offer_expire', $post_meta, '' );
			$offer_url = coupon_get_smeta( 'offer_url' , $post_meta, '');
			$offer_shop_logo = coupon_get_smeta( 'offer_shop_logo', $post_meta, '' );
			$offer_shop_url = coupon_get_smeta( 'offer_shop_url', $post_meta, '' );
			
			echo $before_widget.$before_title.$title.$after_title;
			echo '
				<!-- widget-content -->
				<div class="widget-content">

					<!-- coupon-timer -->
					<div class="time">

						<div class="time-caption caption">
							<a href="'.esc_url( get_permalink( $daily->ID ) ).'" class="green pack">'.$daily->post_title.'</a>
							<p>'.$promo_text.'</p>
						</div>

						'.( !empty( $offer_expire ) ?
							'<!-- countdown -->
							<div class="time-content">

								<span class="coupon-meta-caption">'.__( 'Time Left To Buy', 'coupon' ).'</span>
								<!-- COUNTDOWN -->
								<div class="countdown" data-time="'.esc_attr( $offer_expire ).'" data-button_url="'.esc_url( $offer_url ).'" data-button_text="'.esc_attr__( 'Buy Now', 'coupon' ).'" data-days_text="'.esc_attr__( 'days', 'coupon' ).'" data-day_text="'.esc_attr__( 'day', 'coupon' ).'">

								</div>

							</div>
							<!-- .countdown -->'
							:
							''
						).'
					</div>
					<!-- .coupon-timer -->

				</div>
				<!-- .widget-content -->			
			';
			echo $after_widget;
			
			wp_reset_query();
		}
				

	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'offer_id' => '' ) );

		$title = $instance['title'];
		$offer_id = $instance['offer_id'];
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';
		
		echo '<p><label for="'.esc_attr($this->get_field_id('offer_id')).'">'.__( 'Select Offer:', 'coupon' ).'</label>';
		echo '<select class="widefat" name="'.esc_attr($this->get_field_name('offer_id')).'" id="'.esc_attr($this->get_field_id('offer_id')).'">';
			$daily_offers = get_posts(array(
				'post_type' => 'daily_offer',
				'meta_key' => 'offer_expire',
				'orderby' => 'meta_value_num',			
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'meta_query'   => array(
					array(
						'key' => 'offer_expire',
						'value' => time(),
						'compare' => '>'
					)
				)
			));
			if( !empty( $daily_offers ) ){
				foreach( $daily_offers as $daily_offer ){
					echo '<option value="'.$daily_offer->ID.'" '.( $daily_offer->ID == $offer_id ? 'selected="selected"' : '' ).'>'.$daily_offer->post_title.'</option>';
				}
			}
		echo '</select>';
		
		wp_reset_query();
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['offer_id'] = $new_instance['offer_id'];
		return $instance;	
	}	
}


/******************************************************** 
Coupon Categories Widget
********************************************************/
class Coupon_Daily_Offers extends WP_Widget {
	public function __construct() {
		parent::__construct('coupon_daily_offers', __('Coupon Daily Offers','coupon'), array('description' =>__('Coupon Daily Offers Widget','coupon') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$daily_offers = empty( $instance['daily_offers'] ) ? array() : explode( ",", $instance['daily_offers'] );
		
		echo $before_widget.
				$before_title.$title.$after_title.
				'<ul class="list-group">';
					if( !empty( $daily_offers ) ){
						foreach( $daily_offers as $daily_offer_id ){						
							echo '<li class="list-group-item">
									<a href="'.esc_url( get_permalink( $daily_offer_id ) ).'"> '.get_the_title( $daily_offer_id ).' </a>
								  </li>';
						}
					}
		echo	'</ul>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'daily_offers' => '' ) );
		
		$title = $instance['title'];
		$daily_offers = explode( ",", $instance['daily_offers'] );
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'coupon' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';
		
		echo '<p><label for="'.esc_attr($this->get_field_id('daily_offers')).'">'.__( 'Select daily offers:', 'coupon' ).'</label>';
		echo '<select class="widefat" name="'.esc_attr($this->get_field_name('daily_offers')).'[]" multiple>';
			
			$daily_offers = get_posts(array(
				'post_type' => 'daily_offer',
				'meta_key' => 'offer_expire',
				'orderby' => 'meta_value_num',			
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'meta_query'   => array(
					array(
						'key' => 'offer_expire',
						'value' => time(),
						'compare' => '>'
					)
				)
			));

			if( !empty( $daily_offers ) ){
				foreach( $daily_offers as $daily_offer ){
					echo '<option value="'.$daily_offer->ID.'" '.( $daily_offer->ID == $offer_id ? 'selected="selected"' : '' ).'>'.$daily_offer->post_title.'</option>';
				}
			}
		echo '</select>';
		
		wp_reset_query();
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['daily_offers'] = join( ",", $new_instance['daily_offers'] );
		return $instance;	
	}	
}

/******************************************************** 
Add Coupon Widgets 
********************************************************/
function coupon_widgets_load(){
	register_widget( 'Coupon_Text' );
	register_widget( 'Coupon_FAQ' );
	register_widget( 'Coupon_List' );
	register_widget( 'Coupon_Social' );
	register_widget( 'Coupon_Categories' );
	register_widget( 'Coupon_Newsletter' );
	register_widget( 'Coupon_Popular_Shops' );
	register_widget( 'Coupon_Search' );
	register_widget( 'Coupon_Daily_Offer' );
	register_widget( 'Coupon_Daily_Offers' );
}
add_action( 'widgets_init', 'coupon_widgets_load');
?>