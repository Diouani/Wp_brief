<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_call_to_action_shortcode_vc');
function landx_call_to_action_shortcode_vc( $return = false ) {	

		$args = array(
			'icon' => 'landx-icon',
			'name' => __('Call to action', 'landx'),
			'base' => 'landx_cta',
			'class' => 'landx-vc',			
			'category' => __('LandX', 'landx'),
			'description' => __('title, subtitle & button group', 'landx'),
	
			'params' => array(
				array(
			      'type' => 'dropdown',
			      'heading' => __( 'Alignment', 'landx' ),
			      'param_name' => 'align',
			      'std' => 'text-center',
			      'value' => array(
			        __( 'Inherit', 'landx' ) => '',
			      	__( 'Left', 'landx' ) => 'text-left',
			      	__( 'Center', 'landx' ) => 'text-center',  
			      	__( 'Right', 'landx' ) => 'text-right',			       			             
			      ),
			      
			    ),
                array(
                    'type' => 'textfield',
                    'value' => 'We Are Ready to Help You',
                    'heading' => 'Title',
                    'param_name' => 'title',	
                    'admin_label' => true, 
                    'description' => __('Leave blank to avoid this area', 'landx'),
                                       
                ),
                array(
                    'type' => 'textfield',
                    'value' => 'Get the Best Solution for Your Business',
                    'heading' => 'Sub-Title',
                    'param_name' => 'subtitle',	
                    'admin_label' => true, 
                    'description' => __('Leave blank to avoid this area', 'landx'),
                                       
                ),
                array(
                    'type' => 'textarea',
                    'heading' => 'Content',
                    'param_name' => 'content',
                    'admin_label' => true,
                    'value' => '',
                    'description' => __('Leave blank to avoid this area', 'landx'),
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
		);
		$args = apply_filters( 'landx_vc_map_filter', $args, $args['base'] );
	    if( $return ) {
	        return landx_vc_get_params_value($args);
	    }else{
	        vc_map( $args );
	    }

	
	
}

class WPBakeryShortCode_Landx_cta extends WPBakeryShortCode {
}


