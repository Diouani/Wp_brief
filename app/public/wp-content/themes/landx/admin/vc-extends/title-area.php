<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_title_area_shortcode_vc');
function landx_title_area_shortcode_vc( $return = false ) {	

	$args = array(
			'icon' => 'landx-icon',
			'name' => __('Title area', 'landx'),
			'base' => 'landx_title',			
			'category' => __('LandX', 'landx'),
			'description' => __('title & description', 'landx'),
			'class' => 'landx-vc',
			'params' => array(
                array(
			      'type' => 'dropdown',
			      'heading' => __( 'Alignment', 'landx' ),
			      'param_name' => 'align',
			      'value' => array(
			       __( 'Inherit', 'landx' ) => '',
			      	__( 'Left', 'landx' ) => 'text-left',
			      	__( 'Center', 'landx' ) => 'text-center',  
			      	__( 'Right', 'landx' ) => 'text-right',   
			      ),
			      
			    ),
                array(
                    'type' => 'textfield',
                    'value' => 'LandX Features',
                    'heading' => 'Title',
                    'param_name' => 'title',	
                    'description' => __('Use {} to highlight text', 'landx'),
                    'admin_label' => true, 
                                       
                ),
                array(
                    'type' => 'textarea',
                    'value' => '',
                    'heading' => 'Subtitle',
                    'param_name' => 'subtitle',	
                    'description' => __('Use {} to highlight text', 'landx'),
                    'admin_label' => true, 
                                       
                ),
                array(
                    'type' => 'textarea',
                    'heading' => 'Content',
                    'param_name' => 'content',
                    'admin_label' => true,
                    'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.'
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

class WPBakeryShortCode_Landx_title extends WPBakeryShortCode {
}


