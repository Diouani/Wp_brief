<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_contact_us_shortcode_vc');
function landx_contact_us_shortcode_vc( $return = false ) {	
	
	 
	$args = array(
			'icon' => 'landx-icon',
			'name' => __('Contact us', 'landx'),
			'base' => 'landx_contact_us',			
			'category' => __('LandX', 'landx'),
			'class' => 'landx-vc',
			'description' => __('Title with contact form', 'landx'),	
			'params' => array(  
				array(
			      'type' => 'dropdown',
			      'heading' => __( 'Alignment', 'landx' ),
			      'param_name' => 'align',
			      'std'  => 'text-center',
			      'value' => array(
			      	__( 'Inherit', 'landx' ) => '',
			      	__( 'Left', 'landx' ) => 'text-left',
			      	__( 'Center', 'landx' ) => 'text-center',  
			      	__( 'Right', 'landx' ) => 'text-right',			             
			      ),
			      
			    ),              
                array(
                    'type' => 'textfield',
                    'value' => 'Need any help? Contact us now!',
                    'heading' => 'Title',
                    'param_name' => 'title',	
                    'description' => __('Leave blank to avoid', 'landx'),
                    'admin_label' => true, 
                                       
                ),
                array(
                    'type' => 'textfield',
                    'heading' => 'Toogle link text',
                    'param_name' => 'linktext',
                    'admin_label' => true,
                    'value' => 'Contact us now'
                ), 
                array(
		          'type' => 'textfield',
		          'heading' => __('Contact form 7 Shortcode', 'landx'),
		          'param_name' => 'shortcode',
		          'value' => '',         
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

class WPBakeryShortCode_Landx_contact_us extends WPBakeryShortCode {
}


