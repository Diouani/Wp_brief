<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_background_slider_shortcode_vc');
function landx_background_slider_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('Background slider', 'landx'),
			'base' => 'landx_background_slider',			
			'category' => __('LandX', 'landx'),
			'class' => 'landx-vc',
			'description' => __('Header & section background slider', 'landx'),
	
			'params' => array(
                array(
			      'type' => 'param_group',
			      'heading' => __( 'SLider images', 'bookpress' ),
			      'param_name' => 'header_slider_images',
			      'value' => urlencode( json_encode( array(
			                    array(
			                      'title' => 'Image 2',
			                       'image' => LANDX_URI.'/images/slide1.jpg',
			                    ),
			                    array(
			                      'title' => 'Image 1',
			                      'image' => LANDX_URI.'/images/bg-image-2.jpg',
			                    ), 
			                  ) ) ),
			      'params' => array(
			            array(
			                  'type' => 'textfield',
			                  'value' => '',
			                  'heading' => 'Title',
			                  'param_name' => 'title',   
			                  'admin_label' => true,                       
			              ),
			              array(
			                'type' => 'image_upload',
			                'heading' => __('Slide Image', 'bookpress'),
			                'param_name' => 'image',
			                'description' => '',
			              ),  
			                 
			          ),

			    )
			)
		) 
	);

	
	
}

class WPBakeryShortCode_Landx_background_slider extends WPBakeryShortCode {
}


