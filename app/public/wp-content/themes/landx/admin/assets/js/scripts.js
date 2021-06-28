jQuery(document).ready(function($) {
	 	
	  "use strict";
	  	var myOptions = {
		    // you can declare a default color here,
		    // or in the data-default-color attribute on the input
		    defaultColor: '#81d742',
		    // a callback to fire whenever the color changes to a valid color
		    change: function(event, ui){},
		    // a callback to fire when the input is emptied or an invalid color
		    clear: function() {},
		    // hide the color picker controls on load
		    hide: true,
		    // show a group of common colors beneath the square
		    // or, supply an array of colors to customize further
		    palettes: true
		};

 	$('.color').on( 'hover', function(){
 		$('.color').wpColorPicker( myOptions );
 	} )	
	
	
	var formfield;
	jQuery('.perch-upload-button').on('click', function(){
		formfield = $(this).closest('.perch-shortcode-field').find('.perch-upload-field').attr('id');
		tb_show('Upload an image', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});

	window.original_send_to_editor = window.send_to_editor;
	 window.send_to_editor = function(html) {
		if (formfield) {
			var fileurl = $('img',html).attr('src');
			$('#'+formfield).val(fileurl);			
			tb_remove();			
		}else {
			window.original_send_to_editor(html);
		} 
	};

	$('.landx-upload-button').on('click', function(e) {
		var $button = $(this),
		$val = $(this).parents('.landx-upload-container').find('input:text'),
		file;
		e.preventDefault();
		e.stopPropagation();
		// If the frame already exists, reopen it
		if (typeof(file) !== 'undefined') file.close();
		// Create WP media frame.
		file = wp.media.frames.perch_media_frame_2 = wp.media({
			// Title of media manager frame
			title: 'Upload image',
			button: {
				//Button text
				text: 'Insert URL'
			},
			// Do not allow multiple files, if you want multiple, set true
			multiple: false
		});
		//callback for selected image
		file.on('select', function() {
			var attachment = file.state().get('selection').first().toJSON();
			$val.val(attachment.url).trigger('change');
			$button.closest('div').find('img').attr('src', attachment.url );
		});
		// Open modal
		file.open();
	});

	$('#landx_onepage_meta_box').hide();
	$('#landx_squzee_meta_box').hide();

	if($('#page_template').length > 0){
		$('#page_template').on('change', function(){

			if( $(this).val() == 'page-templates/one-page.php'  ){
				$('#landx_onepage_meta_box').show();
			}else{
				$('#landx_onepage_meta_box').hide();
			}
			
			if( $(this).val() == 'page-templates/squeeze-page.php'  ){
				$('#landx_squzee_meta_box').show();
			}else{
				$('#landx_squzee_meta_box').hide();
			}

			if( $(this).val() == 'page-templates/vc-onepage.php'  ){
				$('#landx_onepage_meta_box').hide();
				$('#landx_squzee_meta_box').hide();
				$('#landx_meta_box').hide();
				$('#postimagediv').hide();
			}	

			return false;
		})

		$('#page_template').trigger('change');
	}		    
	
});
