<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_pricing_table_shortcode_vc');
function landx_pricing_table_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('Pricing table', 'landx'),
			'base' => 'pricing_table',			
			'category' => __('LandX', 'landx'),		
			'class' => 'landx-vc',		
			'params' => array(
				array(
		          'type' => 'dropdown',
		          'heading' => __('Select Pricing table', 'landx'),
		          'param_name' => 'id',
		          'description' => __('You can create menu Pricing table > Add new', 'landx'),
		          'value' => array_flip(landx_get_posts_dropdown(array('post_type' => 'pricing', 'posts_per_page' => -1))),		
		          'admin_label' => true,          
		        ), 
				
			)
		) 
	);

	
	
}

