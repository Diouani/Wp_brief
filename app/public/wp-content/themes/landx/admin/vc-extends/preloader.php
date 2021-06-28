<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_preloader_shortcode_vc');
function landx_preloader_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('Preloader', 'landx'),
			'base' => 'landx_preloader',			
			'category' => __('LandX', 'landx'),
			'class' => 'landx-vc',
			'params' => array(				
				array(
			      'type' => 'image_upload',
			      'heading' => __( 'Image', 'landx' ),
			      'param_name' => 'image',
			      'value' => LANDX_URI.'/images/loading.gif',
			    ),
				
			)
		) 
	);

	
	
}
class WPBakeryShortCode_Landx_preloader extends WPBakeryShortCode {
}

