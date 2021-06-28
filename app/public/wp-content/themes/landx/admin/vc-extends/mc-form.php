<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_mc_form_shortcode_vc');
function landx_mc_form_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('Mailchimp form', 'landx'),
			'base' => 'landx_mc_form',			
			'category' => __('LandX', 'landx'),
			'description' => __('Mailchimp form', 'landx'),
			'class' => 'landx-vc',
			'params' => array(
                array(
			      'type' => 'dropdown',
			      'heading' => __( 'Form Style', 'landx' ),
			      'param_name' => 'style',
			      'value' => array(
			        __( 'Vertical', 'landx' ) => 'vertical',
			        __( 'Horizontal', 'landx' ) => 'horizontal',       
			      ),
			      
			    ),
			    array(
			      'type' => 'dropdown',
			      'heading' => __( 'Language', 'landx' ),
			      'param_name' => 'language',
			      'value' => array(
			        'en' => 'en',
			        'it' => 'it',
			        'de' => 'de',
			        'pl' => 'pl',
			        'es' => 'es',			              
			        'fr' => 'fr',			              
			      ),
			      
			    ),
			    array(
                    'type' => 'textfield',
                    'value' => '//themeperch.us9.list-manage.com/subscribe/post?u=d33802e92fdc29def2e7af643&id=0085e5e2b5',
                    'heading' => 'Mailchimp post url',
                    'param_name' => 'post_url',	
                    'admin_label' => true, 
                     'description' => 'Required'                  
                ), 
                array(
                    'type' => 'textfield',
                    'value' => 'Try Premium Account',
                    'heading' => 'Title',
                    'param_name' => 'title',	
                    'admin_label' => true, 
                     'description' => 'Leave blank to avoid title area'                  
                ), 
                array(
			      'type' => 'param_group',
			      'heading' => __( 'Form fields', 'bookpress' ),
			      'param_name' => 'fields',
			      'value' => urlencode( json_encode( array(
			                    array(
			                      'type' => 'input',
			                       'name' => 'FULLNAME',
			                       'placeholder' => 'Your name',
			                    ),
			                    array(
			                      'type' => 'email',
			                       'name' => 'EMAIL',
			                       'placeholder' => 'Your Email',
			                    ),
			                    array(
			                      'type' => 'input',
			                       'name' => 'MMERGE3',
			                       'placeholder' => 'Phone number',
			                    ), 
			                  ) ) ),
			      'params' => array(
			            array(
					      'type' => 'dropdown',
					      'heading' => __( 'Field type', 'landx' ),
					      'param_name' => 'type',
					      'value' => array(
					       		'Input' => 'input',  
					       		'Email' => 'email',  
					       		'Select options' => 'select',  
					       		'Radio' => 'radio',  
					       		'Checkbox' => 'checkbox',  
					       		 'Datefield' => 'date',
					      ),
					      'admin_label' => true,					      
					    ),
			            array(
			                  'type' => 'textfield',
			                  'value' => 'dd/mm',
			                  'heading' => 'Field Name',
			                  'param_name' => 'name', 
			                  'description' => 'Required'   
			              ),
			            array(
			                  'type' => 'textfield',
			                  'value' => '',
			                  'heading' => 'Placeholder',
			                  'param_name' => 'placeholder', 
			                  'admin_label' => true, 
			              ),
			            array(
			                  'type' => 'textfield',
			                  'value' => '',
			                  'heading' => 'format',
			                  'param_name' => 'format', 
			                  'admin_label' => true, 
			                  'dependency' => array(
						        'element' => 'type',
						        'value' => array('date'),
						      ), 
			              ),
			            array(
			                  'type' => 'textarea',
			                  'value' => '',
			                  'heading' => 'Option field',
			                  'param_name' => 'options',
			                  'description' => 'Multiple value are comma (|) separated. Example: male,Male|female,Female',
			                  'dependency' => array(
						        'element' => 'type',
						        'value' => array('select', 'radio', 'checkbox'),
						      ), 
			              ),
			              
			                 
			          ),

			    ),       
				array(
                    'type' => 'textfield',
                    'value' => 'Get started',
                    'heading' => 'Button text',
                    'param_name' => 'button_text',	
                ), 
				
			)
		) 
	);

	
	
}

class WPBakeryShortCode_Landx_mc_form extends WPBakeryShortCode {
}


