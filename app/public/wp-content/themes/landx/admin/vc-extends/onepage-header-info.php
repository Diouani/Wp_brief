<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_onepage_header_info_shortcode_vc');
function landx_onepage_header_info_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('Onepage header info', 'landx'),
			'base' => 'landx_onepage_header_info',			
			'category' => __('LandX', 'landx'),
			'description' => __('Display navbar logo & social icons', 'landx'),
			'class' => 'landx-vc',
			'params' => array(				
				array(
			      'type' => 'image_upload',
			      'heading' => __( 'Nav bar Logo', 'landx' ),
			      'param_name' => 'nav_logo',
			      'value' => LANDX_URI.'/images/logo.png',
			    ),			                
				// params group
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'heading' => __( 'Social links', 'landx' ),
	                'param_name' => 'socaial_links',
	                'value' => urlencode( json_encode( array(
		                array(
		                	'title' => 'Facebook',
		                    'icon' => 'fa fa-facebook',
		                    'link' => '#',
		                ),
		                array(
		                	'title' => 'Twitter',
		                    'icon' => 'fa fa-twitter',
		                    'link' => '#',
		                ),
		                array(
		                	'title' => 'Linkedin',
		                    'icon' => 'fa fa-linkedin',
		                    'link' => '#',
		                ),
		                array(
		                	'title' => 'RSS',
		                    'icon' => 'fa fa-rss',
		                    'link' => '#',
		                ),
	                ) ) ),
	                'params' => array(
	                    landx_vc_icon_set('fontawesome', 'icon', '', ''  ), 
	                    array(
		                    'type' => 'textfield',
		                    'value' => '',
		                    'heading' => 'Title',
		                    'param_name' => 'title',
		                    'edit_field_class' => 'vc_col-sm-4',	 
		                    'admin_label' => true,                       
		                ),	
		                array(
		                    'type' => 'textfield',
		                    'heading' => 'Link',
		                    'param_name' => 'link',
		                    'edit_field_class' => 'vc_col-sm-8',
		                    'description' => 'Leave blank avaoid link options'
		                ),
		                array(
			                'type' => 'checkbox',
			                'heading' => __( 'Add link on title?', 'landx' ),
			                'param_name' => 'title_link',
			                'value' => array( __( 'Yes', 'landx' ) => 'yes' ),
			                'std' => '',
			                'edit_field_class' => 'vc_col-sm-4'                   
			            ),
			            array(
				            'type' => 'dropdown',
				            'heading' => __( 'Choose link color', 'landx' ),
				            'param_name' => 'title_color',
				            'value' => landx_vc_color_options(),
				            'std' => 'preset-color',
				            'edit_field_class' => 'vc_col-sm-8',
				            'dependency' => array(
				              'element' => 'title_link',
				              'value' => 'yes',
				            ),             
				        )
			                   
	                )
	            ),
				
			)
		) 
	);

	
	
}
class WPBakeryShortCode_Landx_onepage_header_info extends WPBakeryShortCode {
}

