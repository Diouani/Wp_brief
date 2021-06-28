<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_halfbg_section_shortcode_vc');
function landx_halfbg_section_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('Section Halfbg', 'landx'),
			'base' => 'landx_halfbg_section',			
			'category' => __('LandX', 'landx'),
			'description' => __('Section with Halfbg', 'landx'),
			'as_parent' => array('only' => 'vc_row' ),
		    'content_element' => true,
		    'show_settings_on_create' => true,
		    'is_container' => true,
		    'class' => 'landx-vc',
		    'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'textfield',
					'value' => '',
					'heading' => 'Section ID',
					'param_name' => 'id',   
					'admin_label' => true,                       
              	),
				array(
					'type' => 'image_upload',
					'heading' => __('Background Image', 'landx'),
					'param_name' => 'image',
					'description' => '',
					'value' => LANDX_URI.'/images/camera1.jpg'
				),    
				array(
					'type' => 'dropdown',
					'heading' => __( 'Alignment', 'landx' ),
					'param_name' => 'align',
					'value' => array(
							__( 'Right', 'landx' ) => 'half-container-right',
							__( 'Left', 'landx' ) => 'half-container-left',       
						),
				),
				array(
		            'type' => 'dropdown',
		            'heading' => __( 'Section class name', 'landx' ),
		            'param_name' => 'padding_class',
		            'value' => array(
		                        'Section top and Bottom padding'  => 'default-padding',
		                        'Section no padding'  => 'section-no-padding',
		                        'Section top padding only'  => 'section-top-padding',
		                        'Section Bottom padding only'  => 'section-bottom-padding',
		                        'Section large Bottom padding only'  => 'section-large-bottom-padding',
		                      ),
		            'description' => '',
		        ),
		        array(
		            'type' => 'dropdown',
		            'heading' => __( 'Section Background', 'landx' ),
		            'param_name' => 'bg_class',
		            'value' => array(
		                        'Default Background color'  => 'default-bg',                    
		                        'Preset Background color'  => 'color-bg',
		                        'Gray Background color'  => 'bgcolor-2',
		                        'Dark background'  => 'dark-bg',
		                      ),
		            'description' => '',        
		        )
				
			)
		) 
	);

	
	
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Landx_halfbg_section extends WPBakeryShortCodesContainer {
	}    
}
