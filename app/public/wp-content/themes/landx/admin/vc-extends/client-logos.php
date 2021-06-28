<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_client_logos_shortcode_vc');
function landx_client_logos_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('Client logos', 'landx'),
			'base' => 'landx_client_logos',			
			'category' => __('LandX', 'landx'),
			'class' => 'landx-vc',
			'params' => array(				
				array(
			      'type' => 'attach_images',
			      'heading' => __( 'Client logos', 'landx' ),
			      'param_name' => 'images',
			      'value' => '',
			      'admin_label' => true, 
			    ),
				
			)
		) 
	);

	
	
}
class WPBakeryShortCode_Landx_client_logos extends WPBakeryShortCode {
}

