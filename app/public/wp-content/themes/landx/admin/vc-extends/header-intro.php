<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_header_intro_shortcode_vc');
function landx_header_intro_shortcode_vc( $return = false ) {	
	 
		 $args = array(
			'icon' => 'landx-icon',
			'name' => __('Header Intro', 'landx'),
			'base' => 'landx_header_intro',			
			'category' => __('LandX', 'landx'),
			'description' => __('title & description', 'landx'),
			'class' => 'landx-vc',
			'params' => array(
                array(
			      'type' => 'dropdown',
			      'heading' => __( 'Alignment', 'landx' ),
                  'param_name' => 'align',
			      'std' => 'text-left',
			      'value' => array(
			        __( 'Inherit', 'landx' ) => '',
                    __( 'Left', 'landx' ) => 'text-left',
                    __( 'Center', 'landx' ) => 'text-center',  
                    __( 'Right', 'landx' ) => 'text-right',       
			      ),
			      
			    ),
                array(
                    'type' => 'textfield',
                    'value' => 'Get the Best {Solution} for Your {Business}',
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
                    'value' => 'Accelerator photo sharing business school drop out ramen hustle crush it revenue traction
platforms. Coworking viral landing page user base.'
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

class WPBakeryShortCode_Landx_header_intro extends WPBakeryShortCode {
}


