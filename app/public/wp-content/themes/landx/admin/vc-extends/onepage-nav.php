<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_onepage_nav_shortcode_vc');
function landx_onepage_nav_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('Onepage Nav menu', 'landx'),
			'base' => 'landx_onepage_nav',			
			'category' => __('LandX', 'landx'),
			'description' => __('Display navbar logo & menu', 'landx'),
			'class' => 'landx-vc',
			'params' => array(	
				array(
			      'type' => 'checkbox',
			      'heading' => __( 'Navbar visible?', 'landx' ),
			      'param_name' => 'navbar_visible',
			      'value' => array( __( 'Yes', 'landx' ) => 'yes' ),
			    ),			
			    array(
			      'type' => 'checkbox',
			      'heading' => __( 'Sticky navbar disable?', 'landx' ),
			      'param_name' => 'sticky_disable',
			      'value' => array( __( 'Yes', 'landx' ) => 'yes' ),
			      'dependency' => array(
			        'element' => 'navbar_visible',
			        'value' => array('yes'),
			      ),
			    ),
				array(
			      'type' => 'image_upload',
			      'heading' => __( 'Nav bar Logo', 'landx' ),
			      'param_name' => 'nav_logo',
			      'value' => LANDX_URI.'/images/logo-dark.png',
			    ),	            
				array(
		          'type' => 'dropdown',
		          'heading' => __('Select nav menu', 'landx'),
		          'param_name' => 'nav_menu',
		          'description' => __('You can create menu Appearance > Menu', 'landx'),
		          'value' => array_flip(landx_get_terms('nav_menu', 'slug')),		          
		        ), 
				
			)
		) 
	);

	
	
}
class WPBakeryShortCode_Landx_onepage_nav extends WPBakeryShortCode {
}

