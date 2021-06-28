<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_feature_list_shortcode_vc');
function landx_feature_list_shortcode_vc( $return = false ) {	
	 
	 $args = array(
			'icon' => 'landx-icon',
			'name' => __('Feature list', 'landx'),
			'base' => 'landx_feature_list',			
			'category' => __('LandX', 'landx'),
			'description' => __('Icon, title & description', 'landx'),
			'class' => 'landx-vc',
			'params' => array(
                landx_vc_icon_set('fontawesome', 'icon', 'fa fa-check', ''  ), 
                array(
                    'type' => 'textfield',
                    'value' => 'Easy to Customize',
                    'heading' => 'Title',
                    'param_name' => 'title',	
                    'description' => __('Leave blank to avoid', 'landx'),
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
                    'value' => 'Lorem lean startup ipsum product market fit customer development acquihire tech cofounder. User engagement A/B testing.'
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

class WPBakeryShortCode_Landx_feature_list extends WPBakeryShortCode {
}


