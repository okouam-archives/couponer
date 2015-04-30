/* Begin Of jQuery or JS Custom Scripts - This line of codemust stay intact */
jQuery(document).ready(function ($) { 
	"use strict";

/*************************************/
/************ CUSTOM JS **************/
/*************************************/

/* TABLE OF CONTENTS *****************

Here you can find name and line of each 
section of JS code for this theme:

	1. (line )
	2. (line )
	
*/

/* =========================================================================================== 
TIME-SLIDER ----------------------------------------------------------------------------------
============================================================================================== */
	$('#time-slider').slider().on('slideStop',function(e){
		var $this = $(this);
		var values = JSON.parse( JSON.stringify( $this.data('slider').getValue() ) );
		$('input[name="start_range"]').val( values[0] );
		$('input[name="end_range"]').val( values[1] );
	});
	
	$('a[data-selected="selected"]').each( function(){
		var $this = $(this);
		var value = $this.html();
		var main = $this.parents( '.dropdown' ).find('button');
		
		main.html( value + '<span class="fa fa-angle-down pull-right"></span>' );
		
	} );

/* =========================================================================================== 
CLIENTS SLIDER -------------------------------------------------------------------------------
============================================================================================== */
	$("#owl-clients").owlCarousel();

/* =========================================================================================== 
BLOG SLIDER ----------------------------------------------------------------------------------
============================================================================================== */
// Can also be used with $(document).ready()
	$('.flexslider').flexslider({
		animation: "slide",
		controlNav: false
	});

	if( $('.search_widget').length > 0 ){
		
	}
	
	$(".dropdown .dropdown-menu li a").click(function(e){
		var $this = $(this);
		if( $this.parents('ul').data('name') ){
			e.preventDefault();		
			var main = $this.parents( '.dropdown' ).find('button');
			
			main.html( $this.html() + '<span class="fa fa-angle-down pull-right"></span>' );
			
			var el = $this.parents('ul').data('name');
			$('input[name="'+el+'"]').val( $this.data('value') );
		}
	});
	
	
	/* CONTACT */
	$('.send_contact').click(function(e){
		e.preventDefault();
		$.ajax({
			url: ajaxurl,
			dataType: "JSON",
			data:{
				name: $('input[name="name"]').val(),
				email: $('input[name="email"]').val(),
				subject: $('input[name="subject"]').val(),
				message: $('textarea[name="message"]').val(),
				action: 'contact'
			},
			method: "POST",
			success: function( response ){
				if( !response.error ){
					$('.send_result').html( '<p class="success">'+response.success+'</p>' );
				}
				else{
					$('.send_result').html( '<p class="error">'+response.error+'</p>' );
				}
			},
		})
	});
	
	// $('.datepicker').datepicker({
        // dateFormat : 'dd-mm-yy'
    // });
	
	/*=============================SHOW CODE IN MODAL=========================================*/
	$( '.show-code, .pack' ).click(function(e){
		var $this = $(this);
		var parent = $this.parents('.featured-item');
		if( parent.length == 0 ){
			parent = $this.parents('.coupon-box');
		}
		if( $this.attr('href') == "" || $this.attr('href') == "#" ){
			e.preventDefault();
		}
		var codeid = $this.data('codeid');		
		var code_el = parent.find('.show-code');
		if( !code_el.hasClass('open') ){
			$.ajax({
				url: ajaxurl,
				data:{
					action: 'ajax_code',
					codeid: codeid
				},
				dataType: "JSON",
				method: "POST",
				success: function(response){
					if( !response.error ){
						$('.modal_image').attr( 'src', response.image );
						$('.modal_title').html( response.title );
						$('.modal_text').html( response.text );
						$('.modal_code').html( response.code );
					}
					$('#showCode').modal('show');
					code_el.addClass( 'open' );
					code_el.text( response.code );
					code_el.removeClass('btn').addClass('code-replace').replaceWith( '<p class="'+code_el.attr('class')+'">'+code_el.html()+'</p>' );
				},
				error: function(){
				
				},
				complete: function(){
				
				}
			});
		}
	});
	
	/*=============================AJAX SEARCH===================================*/
	$('.ajax_search').keyup(function(){
		var $this = $(this);
		var value = $this.val();
		if( value.length >= 1 ){			
			$.ajax({
				url: ajaxurl,
				data:{
					search: value,
					action: 'ajax_search'
				},
				method: "POST",
				dataType: "JSON",
				success: function(  response ){
					if( !response.error ){
						if( $this.val() !== "" ){
							$('.ajax_search_results ul').html('');
							for( var i=0; i<response.list.length; i++ ){
								var shop = response.list[i];
								$('.ajax_search_results ul').append(
									'<li><a href="'+decodeURIComponent( shop.url )+'">'+decodeURIComponent( shop.name )+'</li>'
								);
							}
						}
					}
				},
				error: function(){
					
				},
				complete: function(){
					
				}
			});
		}
		else{
			$('.ajax_search_results ul').html('');
		}
	});

	/* daily offer countdown */
	if( $('.countdown').length > 0 ){
		$('.countdown').each(function(){
			var $this = $(this);
			$this.kkcountdown({
				buttonUrl	: $this.data('button_url'),
				buttonText	: $this.data('button_text'),
				dayText		: $this.data('day_text'),
				daysText 	: $this.data('days_text'),
				displayZeroDays : true,
				displayTexts : $this.data('show_texts'),
				boxStyle: $this.data('style') || 'normal',
				rusNumbers  :   false
			});			
		});	

	}
	
	/*=============================SUBSCRIPTION===================================*/
	$(document).on( 'click', '.subscribe', function(e){
		e.preventDefault();
		var $this = $(this);
		var parent = $this.parents('.newsletter');
		var result_div = parent.find('.subscription_result');
		result_div.html( '' );
		
		$.ajax({
			url: ajaxurl,
			method: "POST",
			data: {
				email: parent.find('.email').val(),
				action: 'subscribe'
			},
			dataType: "JSON",
			success: function( response ){
				if( !response.error ){
					result_div.html( '<p class="success">'+response.success+'</p>' );
				}
				else{
					result_div.html( '<p class="error">'+response.error+'</p>' );
				}
			},
			error: function(){
				
			},
			complete: function(){
				
			}
		});
	});
	
	
	/* CONDITIONS */
	/* on conditions hover */
	$('.pop-over').popover({
		trigger: 'hover',
		html: true,
		placement: 'top'
	});	

	/* submit coupon code type select buttons */	
	$('.code_type').click(function(){
		$('.code_type').removeClass( 'btn-coupon-clicked' );
		$(this).addClass( 'btn-coupon-clicked' );
		$('input[name="coupon_label"]').val( $(this).data('value') );
		if( $(this).data('value') == 'coupon' ){
			$('.coupon_code_field').slideDown();
			$('.coupon_code_field input').attr('data-required', 'true');
		}
		else{
			$('.coupon_code_field').slideUp();
			$('.coupon_code_field input').attr('data-required', 'false');
		}
	});
	
	/* set code for */	
	$('button.code_for').click(function(){
		$('button.code_for').removeClass( 'btn-coupon-clicked' );
		$(this).addClass( 'btn-coupon-clicked' );
		$('input[name="code_for"]').val( $(this).data('value') );
	});	
	
	/* fix comment form button */
	$('.form-submit input[type="submit"]').attr( 'class', 'btn btn-custom btn-default btn-block' ).wrap('<div class="col-md-12"></div>');
	
	
	/* slide down navigation */
	var navigation = $('#navigation').clone();
	if( $('#wpadminbar').css('position') == 'fixed' ){
		var topOffset = $('#wpadminbar').outerHeight(true);
	}
	else{
		var topOffset = 0;			
	}	
	navigation.css({display: 'none', position: 'fixed', left: '0px', top: topOffset+'px', width: '100%'});
	navigation.find('.navbar-brand img').css('padding', '0px');
	if( $(window).width() > 768 ){
		navigation.find('.nav.navbar-nav > li').css('padding', '0px 3px');
	}
	navigation.attr( 'id', 'abs' );
	$('body').append(navigation);
	
	$(window).scroll(function(){
		if( $(document).scrollTop() >= $('#navigation').outerHeight() ){
			navigation.slideDown();
		}
		else{
			navigation.fadeOut();
		}
	});
	
	$(window).resize(function(){		
		if( $('#wpadminbar').css('position') == 'fixed' ){
			var topOffset = $('#wpadminbar').outerHeight(true);
		}
		else{
			var topOffset = 0;			
		}
		
		$('#abs').css({top: topOffset+'px'});
		
		if( $(window).width > 768 ){
			navigation.find('.nav.navbar-nav > li').css('padding', '0px 3px');
		}
		else{
			navigation.find('.nav.navbar-nav > li').css('padding', '0px');
		}
	});
	
	

	/****** open drop down on hover ********/
    if ($(window).width() >= 767) {
        $('ul.nav li.dropdown, ul.nav li.dropdown-submenu').hover(function () {
            $(this).find(' > .dropdown-menu').stop(true, true).delay(0).fadeIn();
        }, function () {
            $(this).find(' > .dropdown-menu').stop(true, true).delay(0).fadeOut();

        });
    }
	$(document).on('click', '.dropdown-toggle', function(){
		var $this = $(this);
		if( typeof $this.attr('href') !== typeof undefined && $this.attr('href') !== false && $this.attr('href').indexOf('http') !== -1 && $(window).width() >= 767 ){
			window.location = $this.attr('href');
		}
	});	
	
	/* HANDLE RATINGS */
	$('.item-ratings').each(function(){
		$(this).find('i').each(function(e){
			$(this).attr( 'backup-class', $(this).attr( 'class' ) );
		});
	});

	
	$(document).on( 'mouseover', '.item-ratings i', function(e){
		var $parent = $(this).parents('.item-ratings');
		if( $parent.find('.fa-spin').length == 0 ){
			var count = $parent.children().index( this );
			for( var i=0; i<=count; i++ ){
				$parent.find('i:eq('+i+')').attr( 'class', 'fa fa-star opacity-fa' );
			}
		}
	});

	$(document).on( 'mouseout', '.item-ratings i', function(e){
		var $parent = $(this).parents('.item-ratings');
		$parent.find('i').each(function(e){
			$(this).attr( 'class', $(this).attr('backup-class') );
		});
	});

	$(document).on( 'click', '.item-ratings i', function(e){
		var $parent = $(this).parents('.item-ratings');
		var count = $parent.children().index( this );
		$parent.html('<i class="fa fa-spinner fa-spin"></i>');
		$.ajax({
			url: ajaxurl,
			method: "POST",
			data:{
				action: 'write_rate',
				rate: count + 1,
				post_id: $parent.data('post_id')
			},
			success: function( response ){
				$parent.html( response );
				$parent.find('i').each(function(e){
					$(this).attr( 'backup-class', $(this).attr( 'class' ) );
				});				
			},
			error: function(){

			},
			complete: function(){

			}
		});
	});

	/* OVERLAP FIX */
	$('.all_shops .list-inline a').click(function(e){
		e.preventDefault();
		var $this = $(this);
		var el = $('a[name="'+(  $this.attr('href').split("#")[1] )+'"]');
		var position;
		if( $('#abs').length > 0 ){
			position = Math.round( el.offset().top ) - $('.fixedsticky').outerHeight( true );
		}
		else{
			position = Math.round( el.offset().top );
		}
        $("html, body").stop().animate(
            {
                scrollTop: position
            }, 
            {
                duration: 1200,
            }
        );		
	});
	
	
	/* AUTO CODE COPY */
	ZeroClipboard.config( { swfPath: coupon_data.url+"/js/ZeroClipboard.swf" } );
	$('.is_copied').text('');
	$('.show-code').each(function(){
		var $this = $(this);
		var client = new ZeroClipboard( $this );

		client.on( 'ready', function(event) {
			client.on( 'copy', function(event) {
				event.clipboardData.setData('text/plain', $this.data('code'));
			});
	
			client.on( 'aftercopy', function(event) {
				$('.is_copied').text( $('.is_copied').data('text') );
			});
		});
	
		client.on( 'error', function(event) {
			ZeroClipboard.destroy();
		});
	});
/* End Of jQuery or JS Custom Scripts - This line of code must stay intact */
});
