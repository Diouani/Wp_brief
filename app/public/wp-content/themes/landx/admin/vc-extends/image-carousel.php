<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_image_carousel_shortcode_vc');
function landx_image_carousel_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('Image carousel', 'landx'),
			'base' => 'landx_image_carousel',			
			'category' => __('LandX', 'landx'),
			'class' => 'landx-vc',
			'params' => array(				
				array(
			      'type' => 'attach_images',
			      'heading' => __( 'Attach images', 'landx' ),
			      'param_name' => 'images',
			      'value' => '',
			      'admin_label' => true, 
			    ),
			    array(
			      'type' => 'number',
			      'heading' => __( 'Thumbnail width', 'landx' ),
			      'param_name' => 'width',
			      'value' => 400,
			      'admin_label' => true, 
			    ),
			    array(
			      'type' => 'number',
			      'heading' => __( 'Thumbnail height', 'landx' ),
			      'param_name' => 'height',
			      'value' => 272,
			      'admin_label' => true, 
			    ),
			    array(
			      'type' => 'number',
			      'heading' => __( 'Items display', 'landx' ),
			      'param_name' => 'items',
			      'value' => 3,
			      'admin_label' => true, 
			    ),	
				
			)
		) 
	);

	
	
}
class WPBakeryShortCode_Landx_image_carousel extends WPBakeryShortCode {
}

