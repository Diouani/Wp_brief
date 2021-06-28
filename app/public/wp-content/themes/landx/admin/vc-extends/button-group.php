<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_button_group_shortcode_vc');
function landx_button_group_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('Button group', 'landx'),
			'base' => 'landx_button_group',			
			'category' => __('LandX', 'landx'),
			'class' => 'landx-vc',
			'description' => __('Button group', 'landx'),
	
			'params' => array(
				array(
			      'type' => 'dropdown',
			      'heading' => __( 'Alignment', 'landx' ),
			      'param_name' => 'align',
			      'value' => array(
			      	__( 'center', 'landx' ) => 'text-center',  
			        __( 'Default', 'landx' ) => 'text-align-default',			             
			      ),
			      
			    ),
                array(
			      'type' => 'param_group',
			      'heading' => __( 'Button Type', 'landx' ),
			      'param_name' => 'buttons',
			      'value' => urlencode( json_encode( array(
			                    array(
			                      'button_title' => 'Get started',
			                      'button_link' => '#home',
			                      'button_style' => 'standard-button'
			                    ),
			                    array(
			                      'button_title' => 'Learn more',
			                      'button_link' => '#features',
			                      'button_style' => 'secondary-button-white'
			                    ),
			                  ) ) ),
			      'params' => array(
			            array(
			                  'type' => 'textfield',
			                  'value' => '',
			                  'heading' => 'Button Title',
			                  'param_name' => 'button_title',   
			                  'admin_label' => true,                       
			              ),
			            array(
			                  'type' => 'textfield',
			                  'value' => '#',
			                  'heading' => 'Button Link',
			                  'param_name' => 'button_link',   
			                  'admin_label' => true,                       
			              ),
			              array(
						      'type' => 'dropdown',
						      'heading' => __( 'Button Style', 'landx' ),
						      'param_name' => 'button_style',
						      'value' => array(
						      	__( 'Primary button', 'landx' ) => 'standard-button',  
						        __( 'Secondary button', 'landx' ) => 'secondary-button',			             
						        __( 'Secondary Alt', 'landx' ) => 'secondary-button-white',			             
						      ),
						      
						    ),    
			                 
			          ),
			    ),            
				
				
			)
		) 
	);

	
	
}

class WPBakeryShortCode_Landx_button_group extends WPBakeryShortCode {
}


