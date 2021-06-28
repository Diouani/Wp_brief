<?php
add_action('vc_after_init', 'landx_vc_section');
function landx_vc_section() {
  $newParamData = array(
        array(
            'group' => 'LandX Settings',
            'type' => 'el_id',
            'heading' => __( 'Section ID', 'landx' ),
            'param_name' => 'el_id',
            'description' => sprintf( __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'landx' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
          ),
        array(
            'group' => 'LandX Settings',
            'type' => 'dropdown',
            'heading' => __( 'Section stretch', 'landx' ),
            'param_name' => 'full_width',
            'value' => array(
              __( 'Default', 'landx' ) => 'container',
              __( 'Stretch section', 'landx' ) => 'container-wide',       
            ),
            'description' => __( 'Select stretching options for section and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'landx' ),
          ),
        array(
            'group' => 'LandX Settings',
            'type' => 'dropdown',
            'heading' => __( 'Section type', 'landx' ),
            'param_name' => 'section_type',
            'value' => array(
              __( 'Section', 'landx' ) => 'section',
              __( 'Header', 'landx' ) => 'header',       
              __( 'footer', 'landx' ) => 'footer',       
            ),
            'description' => __( 'Select Container section, Header and footer', 'landx' ),
          ),
        array(
          'type' => 'checkbox',
          'group' => 'LandX Settings',
          'heading' => __( 'Full height section?', 'js_composer' ),
          'param_name' => 'full_height',
          'description' => __( 'If checked section will be set to full height.', 'js_composer' ),
          'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
        ),
        array(
          'type' => 'checkbox',
          'group' => 'LandX Settings',
          'heading' => __( 'Use video background?', 'js_composer' ),
          'param_name' => 'video_bg',
          'description' => __( 'If checked, video will be used as section background.', 'js_composer' ),
          'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
        ),
        array(
          'group' => 'LandX Settings',
          'type' => 'textfield',
          'heading' => __( 'YouTube link', 'js_composer' ),
          'param_name' => 'video_bg_url',
          'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
          // default video url
          'description' => __( 'Add YouTube link.', 'js_composer' ),
          'dependency' => array(
            'element' => 'video_bg',
            'not_empty' => true,
          ),
        ),
        array(
          'type' => 'dropdown',
          'group' => 'LandX Settings',
          'heading' => __( 'Parallax', 'js_composer' ),
          'param_name' => 'video_bg_parallax',
          'value' => array(
            __( 'None', 'js_composer' ) => '',
            __( 'Simple', 'js_composer' ) => 'content-moving',
            __( 'With fade', 'js_composer' ) => 'content-moving-fade',
          ),
          'description' => __( 'Add parallax type background for section.', 'js_composer' ),
          'dependency' => array(
            'element' => 'video_bg',
            'not_empty' => true,
          ),
        ), 
        array(
          'type' => 'dropdown',
          'group' => 'LandX Settings',
          'heading' => __( 'Parallax', 'js_composer' ),
          'param_name' => 'parallax',
          'value' => array(
            __( 'None', 'js_composer' ) => '',
            __( 'Simple', 'js_composer' ) => 'content-moving',
            __( 'With fade', 'js_composer' ) => 'content-moving-fade',
          ),
          'description' => __( 'Add parallax type background for section (Note: If no image is specified, parallax will use background image from Design Options).', 'js_composer' ),
          'dependency' => array(
            'element' => 'video_bg',
            'is_empty' => true,
          ),
        ),       
        array(
          'group' => 'LandX Settings',
          'type' => 'image_upload',
          'heading' => __( 'Image', 'js_composer' ),
          'param_name' => 'parallax_image',
          'value' => LANDX_URI.'/images/slide2.jpg',
          'description' => __( 'Select image from media library.', 'js_composer' ),
          'dependency' => array(
            'element' => 'parallax',
            'not_empty' => true,
          ),
        ),
        array(
          'group' => 'LandX Settings',
          'type' => 'checkbox',
          'heading' => __( 'Overlay enable?', 'landx' ),
          'param_name' => 'overlay',
          'value' => array( __( 'Yes', 'landx' ) => 'yes' ),
        ),
        array(
          'group' => 'LandX Settings',
          'type' => 'dropdown',
          'heading' => __( 'Overlay type', 'landx' ),
          'param_name' => 'overlay_type',
          'value' => array(
            __( 'Dark', 'landx' ) => 'darkshadow',
            __( 'Color', 'landx' ) => 'colorshadow',       
            __( 'Light', 'landx' ) => 'lightshadow',       
          ),
          'dependency' => array(
            'element' => 'overlay',
            'value' => 'yes',
          ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Section class name', 'landx' ),
            'param_name' => 'padding_class',
            'group' => 'LandX Settings',
            'value' => array(
                        'Section top and Bottom padding'  => 'default-padding',
                        'Section no padding'  => 'section-no-padding',
                        'Section top padding only'  => 'section-top-padding',
                        'Section Bottom padding only'  => 'section-bottom-padding',
                        'Section large Bottom padding only'  => 'section-large-bottom-padding',
                      ),
            'description' => '',  
            'dependency' => array(
              'element' => 'section_type',
              'value' => array('section', 'header'),
            ),      
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Section Background', 'landx' ),
            'param_name' => 'bg_class',
            'group' => 'LandX Settings',
            'value' => array(
                        'Default Background color'  => 'default-bg',                    
                        'Preset Background color'  => 'color-bg',
                        'Gray Background color'  => 'bgcolor-2',
                        'Dark background'  => 'dark-bg',
                      ),
            'description' => '',        
        )
    ); 

    foreach ($newParamData as $key => $value) {
      vc_update_shortcode_param( 'vc_section', $value );
    }
    
}

