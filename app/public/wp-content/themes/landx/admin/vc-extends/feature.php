<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_feature_shortcode_vc');
function landx_feature_shortcode_vc( $return = false ) {	
	 
		 $args = array(
			'icon' => 'landx-icon',
			'name' => __('Feature box', 'landx'),
			'base' => 'landx_feature',			
			'category' => __('LandX', 'landx'),
			'class' => 'landx-vc',
			'description' => __('Icon, title & description', 'landx'),	
			'params' => array(
				array(
                  'type' => 'checkbox',
                  'heading' => __( 'Border box?', 'landx' ),
                  'param_name' => 'border_box',
                  'description' => __( 'If checked service will be set border.', 'landx' ),
                  'value' => array( __( 'Yes', 'landx' ) => 'border-box' ),
                ),
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
				landx_vc_icontype_dropdown('type'),
            	landx_vc_icon_set('linecons', 'icon_linecons', '', 'type'  ),         
            	landx_vc_icon_set('entypo', 'icon_entypo', '', 'type'  ), 
            	landx_vc_icon_set('typicons', 'icon_typicons', '', 'type'  ),       
            	landx_vc_icon_set('openiconic', 'icon_openiconic', '', 'type'  ),       
            	landx_vc_icon_set('fontawesome', 'icon_fontawesome', '', 'type'  ), 
            	landx_vc_icon_set('material', 'icon_material', '', 'type'  ),
                array(
                    'type' => 'textfield',
                    'value' => 'Responsive Design',
                    'heading' => 'Title',
                    'param_name' => 'title',	
                    'description' => __('Leave blank to avoid', 'landx'),
                    'admin_label' => true, 
                     'save_always' => true,                  
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
                    'type' => 'textarea_html',
                    'heading' => 'Content',
                    'param_name' => 'content',
                    'admin_label' => true,
                    'value' => '<p style="text-align:center">Lorem lean startup ipsum product market fit customer development acquihire tech cofounder. User engagement A/B testing.</p>'
                ),  
                array(
		          'type' => 'checkbox',
		          'heading' => __( 'Button in bottom?', 'landx' ),
		          'param_name' => 'button',
		          'description' => __( 'If checked button will be show in bottom.', 'landx' ),
		          'value' => array( __( 'Yes', 'landx' ) => 'yes' ),
		          'admin_label' => true,  
		        ),
                array(
			      'type' => 'param_group',
			      'heading' => __( 'Buttons', 'landx' ),
			      'param_name' => 'buttons',
			      'save_always' => true,			      
			      'value' => urlencode( json_encode( array(
			                    array(
			                      'button_text' => 'View more',
			                      'button_url' => '#',
			                      'button_target' => '_self',
			                      'button_style' => 'btn-primary',
			                      'button_size' => '',
			                      'icon' => 'fa fa-long-arrow-right',
			                      'icon_position' => 'icon-position-right',
			                      'icon_size' => '',
			                    ),
			                  ) ) ),
			      'params' => landx_button_groups_param(),
			      'dependency' => array(
		              'element' => 'button',
		              'value' => array('yes'),
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

class WPBakeryShortCode_Landx_feature extends WPBakeryShortCode {
}


