<?php
/*
	Template Name: All Shops
*/
get_header();
the_post();
get_template_part( 'includes/inner_header' );
$shops = get_posts( array( 
	'posts_per_page' => -1, 
	'post_type' => 'shop', 
	'post_status' => 'publish', 
	'order' => 'ASC', 
	'orderby' => 'title' ) 
);

$letter_keyed_shops = array();

$shop_letter_links = '';
$shop_titles = '';
if( !empty( $shops ) ){
	foreach( $shops as $shop ){
        $first_letter = mb_strtoupper( mb_substr( $shop->post_title, 0, 1, 'UTF-8' ) );
		if( is_numeric( $first_letter ) ){
			$first_letter = '0-9';
		}
		else{
			$first_letter = mb_strtoupper( $first_letter, 'UTF-8' );
		}
        if ( !array_key_exists( $first_letter, $letter_keyed_shops ) ) {
            $letter_keyed_shops[ $first_letter ] = array();
        }

        $letter_keyed_shops[ $first_letter ][] = $shop;	
	}
	
	foreach( $letter_keyed_shops as $letter => $shops ){
		$shop_letter_links .= '<li><a href="#'.$letter.'">'.$letter.'</a></li>';
		$blocks = array( '', '', '', '' );
		$block_counter = -1;
		$shop_titles .='<!-- ----------------------------------- -->
						<!-- letter -->
						<div class="row">
							<div class="col-md-12">
					  
								<div class="single-letter">
									<a href="#" name="'.$letter.'"></a>
									<h3>'.$letter.'</h3>
								</div>
					  
							</div>
						</div>
						<!-- .letter -->
						<!-- lists -->
						<div class="row">';
		foreach( $shops as $shop ){
			if( $block_counter == 3 ){
				$block_counter = 0;
			}
			else{
				$block_counter++;
			}
			$blocks[$block_counter] .= '<li><a href="'.get_permalink( $shop->ID ).'">'.$shop->post_title.'</a></li>';
		}
		
		$shop_titles .='
				<!-- 1 -->
				<div class="col-md-3">
					<div class="single-letter-list">
						<ul>
							'.$blocks[0].'
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="single-letter-list">
						<ul>
							'.$blocks[1].'
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="single-letter-list">
						<ul>
							'.$blocks[2].'
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="single-letter-list">
						<ul>
							'.$blocks[3].'
						</ul>
					</div>
				</div>
				<!-- .1 -->
		 
			</div>
			<!-- .lists -->
		  
			<!-- to top -->
			<div class="row">
				<div class="col-md-12">
				
					<div class="to-top">
						<a href="#" class="pull-right"><i class="fa fa-chevron-up"></i></a>
					</div>
				
				</div>
			</div>
			<!-- .to top -->
			<!-- ----------------------------------- --> 			
		';		
	}
}
?>
<!-- =====================================================================================================================================
													A L L  S H O P S
====================================================================================================================================== -->
<section class="all_shops">

	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<div class="caption category-caption <?php $content = get_the_content(); echo empty( $content ) ? '' : 'bottom-margin' ?>">
					<h2><?php echo coupon_page_title(); ?></h2>
					<p><?php echo coupon_page_subtitle() ?></p>
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
	</div>

	<div class="shop-filter">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="list-unstyled list-inline">
						<?php echo $shop_letter_links; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="body-wrapper">
		<div class="container">
			<?php echo $shop_titles; ?>
		</div>
	</div>
</section>
<?php
wp_reset_query();
get_template_part( 'includes/shop_carousel' );
get_footer();
?>