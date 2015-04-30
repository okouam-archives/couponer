jQuery(document).ready(function($){	
	/* set red border for the inputs which have an error after submiting the form */
	$('.form-group').each(function(){
		if( $(this).hasClass('has-error') ){
			$(this).find('input textarea').css('border-color',$('.border-color-error').val());
		}
	});
	function showError( $this, error ){
		if( $this.attr('type') == 'hidden' ){
			$this.parents('.btn-group').prepend('<small class="text-danger">'+error+'</small>');
		}
		else if( $this.attr('type') == 'radio' ){
			$this.parents('.radio-inline').prev().prev().after('<small class="error text-danger">'+error+'</small>');
		}
		else{
			$this.css('border-color',$('.border-color-error').val());
			$this.parents('.form-group').addClass('has-error');
			$this.after('<small class="text-danger">'+error+'</small>');
		}		
	}

	$('input[type="submit"], button[type="submit"]').click(function(e){
		if( $(this).parents('.comment-form').length == 0 ){
			e.preventDefault();
			var valid = true;
			var form = $(this).parents('form');
			form.find('.form-group').removeClass('has-error');
			form.find('.form-group').removeClass('has-success');
			form.find('input,select,textarea').css('border-color',$('.border-color-normal').val());
			form.find('small.text-danger').remove();
			form.find('input,select,textarea').each(function(){
				var $this = $(this);
				if( $this.attr('data-required') == 'true' ){
					var value = $this.val();
					var error = $this.data('error');
					
					if( $this.data('validations') ){
					
						var valids = $this.data('validations').split("|");
						for( var i=0; i< valids.length; i++ ){	
							switch( valids[i] ){
								case 'email' 	: 	if( /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value) === false ){ 
														valid = false;
														showError( $this, error );
													} break;
								case 'number' 	:	if( /^\d+$/.test(value) === false ){
														valid = false; 
														showError( $this, error );
													} break;
								case 'length'	:   if( value.length < $this.data('length') ){
														valid = false;
														showError( $this, error );
													} break;
								case 'pwd_match':	if( value != $('input[name="'+$this.data('compare')+'"]').val() || value == "" ){
														valid = false;
														showError( $this, error );
													} break;
								case 'date'		:	if( /^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/.test(value) == false ){
														valid = false;
														showError( $this, error );
													} break;
							}
						}
					}
					else if( $this.attr('type') == 'radio' && $this.data('error') ){
						var name = $this.attr('name');
						var checked = false;
						$('input[name="'+name+'"]').each(function(){
							if( $(this).prop('checked') ){
								checked = true;
							}
						});
						if( !checked ){
							valid = false;
							showError( $this, error );
						}
					}
					else if( value == "" ){
						valid = false;
						showError( $this, error );				
					}
				}
			});
			
			if( valid ){
				form.submit();
			}
		}
	});
});