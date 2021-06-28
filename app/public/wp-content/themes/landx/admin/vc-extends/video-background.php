<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_video_background_shortcode_vc');
function landx_video_background_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('HTML5 video background', 'landx'),
			'base' => 'landx_video_background',			
			'category' => __('LandX', 'landx'),
			'description' => __('Header & section video background', 'landx'),
			'class' => 'landx-vc',
			'params' => array(
				array(
	                'type' => 'image_upload',
	                'heading' => __('Poster Image', 'bookpress'),
	                'param_name' => 'poster',
	                'description' => '',
	                'value' => LANDX_URI.'/images/bg-image-2.jpg',
	              ),  
                array(
			      'type' => 'param_group',
			      'heading' => __( 'Videos type', 'bookpress' ),
			      'param_name' => 'video_types',
			      'value' => urlencode( json_encode( array(
			                    array(
			                      'type' => 'mp4',
			                       'url' => 'http://themeperch.net/landx/wp-content/uploads/2015/06/headerbg.mp4',
			                    ),
			                    array(
			                      'type' => 'webm',
			                      'url' => 'http://themeperch.net/landx/wp-content/uploads/2015/06/headerbg.webm',
			                    ), 
			                    array(
			                      'type' => 'mov',
			                      'url' => 'http://themeperch.net/landx/wp-content/uploads/2015/06/headerbg.mov',
			                    ), 
			                  ) ) ),
			      'params' => array(
			            array(
			                  'type' => 'textfield',
			                  'value' => '',
			                  'heading' => 'Type',
			                  'param_name' => 'type',   
			                  'admin_label' => true,                       
			              ),
			            array(
			                  'type' => 'textfield',
			                  'value' => '',
			                  'heading' => 'Video url',
			                  'param_name' => 'url',   
			              ),
			              
			                 
			          ),

			    )
			)
		) 
	);

	
	
}

class WPBakeryShortCode_Landx_video_background extends WPBakeryShortCode {
}


