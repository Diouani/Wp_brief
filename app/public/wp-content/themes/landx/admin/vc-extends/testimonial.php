<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_testimonial_shortcode_vc');
function landx_testimonial_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('Testimonial', 'landx'),
			'base' => 'landx_testimonial',			
			'category' => __('LandX', 'landx'),
            'class' => 'landx-vc',
			'params' => array(				
				array(
			      'type' => 'image_upload',
			      'heading' => __( 'Image', 'landx' ),
			      'param_name' => 'image',
			      'value' => LANDX_URI.'/images/testimonial1.jpg',
			    ),	            
				array(
                    'type' => 'textfield',
                    'value' => 'Jhone doe',
                    'heading' => 'Name',
                    'param_name' => 'name',	
                    'admin_label' => true, 
                ),
                array(
                    'type' => 'textfield',
                    'value' => 'http://www.themeperch.net',
                    'heading' => 'Website',
                    'param_name' => 'website',	
                    'admin_label' => true, 
                ),
                array(
                    'type' => 'textfield',
                    'value' => 'Marketing maneger',
                    'heading' => 'Title',
                    'param_name' => 'title',	
                    'admin_label' => true, 
                ),
                array(
                    'type' => 'textarea',
                    'heading' => 'Content',
                    'param_name' => 'content',
                    'admin_label' => true,
                    'value' => 'Lorem lean startup ipsum product market fit customer development acquihire technical cofounder. User engagement A/B testing shrink a market venture capital pitch deck. Social bookmarking group buying crowded market pivot onboarding.'
                ),
				
			)
		) 
	);

	
	
}
class WPBakeryShortCode_Landx_testimonial extends WPBakeryShortCode {
}

