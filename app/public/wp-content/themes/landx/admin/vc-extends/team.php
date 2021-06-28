<?php
add_action( 'vc_before_init', 'landx_team_shortcode_vc');
function landx_team_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => 'Team',
			'description' => '',
			'base' => 'landx_team',			
			'category' => 'LandX',	
			'class' => 'landx-vc',	
			'params' => array(
				array(
					'type' => 'checkbox',
					'heading' => __( 'Border box?', 'landx' ),
					'param_name' => 'border_box',
					'description' => __( 'If checked team will be set border.', 'landx' ),
					'value' => array( __( 'Yes', 'landx' ) => 'border-box' ),
        		),
        		array(
					'type' => 'dropdown',
					'heading' => __('Style', 'landx'),
					'param_name' => 'style',
					'value' =>  array(
								'Single column' => 'col-md-12',
								'Double column' => 'col-md-6',			
							),
					'admin_label' => true,
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Alignment', 'landx'),
					'param_name' => 'align',
					'value' =>  array(
								'Default' => '',
								'Center' => 'text-center',			
							),
					'admin_label' => true,
					'dependency' => array(
			              'element' => 'style',
			              'value' => array('col-md-12'),
			            ),   
				),
				array(
	                'type' => 'image_upload',
	                'heading' => __('Team image', 'landx'),
	                'param_name' => 'image',
	                'value' => LANDX_URI.'/images/team-1.png',
	            ), 				
                array(
					'type' => 'textfield',
					'value' => 'Michael Smith',
					'heading' => 'Title',
					'param_name' => 'title',   
					'admin_label' => true,                       
              	),
              	array(
					'type' => 'textfield',
					'value' => 'Designer',
					'heading' => 'Sub Title',
					'param_name' => 'subtitle',   
					'admin_label' => true,              
              	),
              	array(
					'type' => 'dropdown',
					'heading' => __('Subtitle tag', 'landx'),
					'param_name' => 'subtitle_tag',
					'value' =>  array(								
								'H4' => 'h4',	
								'H5' => 'h5',		
								'H6' => 'h6',	
								'P' => 'p',	
							),
				),
              	array(
					'type' => 'textarea',
					'value' => '',
					'heading' => 'Description',
					'param_name' => 'desc',   
              	),
              	array(
			      'type' => 'param_group',
			      'heading' => __( 'Social links', 'landx' ),
			      'param_name' => 'social_links',
			      'save_always' => true,
			      'value' => urlencode( json_encode( array(
			                    array(
			                      'icon' => 'fa fa-facebook',
			                      'title' => 'Twitter',
			                      'link' => '#',
			                    ),
			                    array(
			                      'icon' => 'fa fa-twitter',
			                      'title' => 'Facebook',
			                      'link' => '#',
			                    ),
			                    array(
			                      'icon' => 'fa fa-linkedin',
			                      'title' => 'Linkedin',
			                      'link' => '#',
			                    ),
			                  ) ) ),
			      'params' => array(
			      		landx_vc_icon_set('fontawesome', 'icon', ''  ),
				      	array(
		                  'type' => 'textfield',
		                  'value' => '',
		                  'heading' => 'Title',
		                  'param_name' => 'title',   
		                  'admin_label' => true,                   
		              	),
		              	array(
		                  'type' => 'textfield',
		                  'value' => '',
		                  'heading' => 'Link',
		                  'param_name' => 'link',                
		              	),
			      )
			    ),
			)
		) 
	);

	
	
}
class WPBakeryShortCode_Landx_team extends WPBakeryShortCode {
}

