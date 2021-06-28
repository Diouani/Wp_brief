<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'landx_about_us_shortcode_vc' );
function landx_about_us_shortcode_vc( $return = false ) {
    $args = array(
         'icon' => 'landx-icon',
        'name' => __( 'About us', 'landx' ),
        'base' => 'landx_about_us',
        'class' => 'landx-vc',
        'category' => __( 'LandX', 'landx' ),
        'description' => __( 'Display image, title, description & counter ', 'landx' ),
        'params' => array(
            array(
                'type' => 'checkbox',
                'heading' => __( 'Image in right position?', 'landx' ),
                'param_name' => 'position',
                'description' => __( 'Default image in left', 'landx' ),
                'value' => array( __( 'Yes', 'landx' ) => 'yes' ),
                'group' => __( 'Image options', 'landx' ),                 
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( 'Image', 'landx' ),
                'param_name' => 'image',
                'description' => '',
                'value' => LANDX_URI . '/images/image-01.png',
                'group' => __( 'Image options', 'landx' ), 
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'enable video popup?', 'landx' ),
                'param_name' => 'video_popup',
                'description' => __( 'Checked to video popup link on image', 'landx' ),
                'value' => array( __( 'Yes', 'landx' ) => 'yes' ),
                'admin_label' => true,  
                'group' => __( 'Image options', 'landx' ),            
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Youtube url', 'landx' ),
                'param_name' => 'url',
                'value' => 'https://www.youtube.com/embed/SZEflIVnhH8',
                'dependency' => array(
                     'element' => 'video_popup',
                    'value' => 'yes' 
                ) ,
                'group' => __( 'Image options', 'landx' ), 
            ), 
            array(
                'type' => 'textfield',
                'heading' => __( 'Sub Title', 'landx' ),
                'param_name' => 'subtitle',
                'value' => 'Welcome to LandX',
                'admin_label' => true,
                'group' => __( 'Content', 'landx' ), 
            ),
            array(
                 'type' => 'textfield',
                'heading' => __( 'Heading Title', 'landx' ),
                'param_name' => 'title',
                'value' => 'We bring the best things for you',
                'admin_label' => true,
                'group' => __( 'Content', 'landx' ), 
            ),
            array(
                 'type' => 'textarea',
                'heading' => __( 'Lead text', 'landx' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'An magnis nulla dolor sapien augue erat iaculis pretium purus tempor magna ipsum vitae purus primis ipsum and congue magna odio augue ligula rutrum nullam',
                'admin_label' => true,
                'group' => __( 'Content', 'landx' ), 
            ),
            array(
                 'type' => 'textfield',
                'heading' => __( 'Title #2', 'landx' ),
                'param_name' => 'title2',
                'value' => '',
                'description' => 'optional',
                'admin_label' => true,
                'group' => __( 'Content', 'landx' ), 
            ),            
            landx_vc_strategy_list_group(),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Enable content group as list', 'landx' ),
                'param_name' => 'list_display',
                'description' => __( 'Checked to display animated list', 'landx' ),
                'value' => array( __( 'Yes', 'landx' ) => 'yes' ),
                'std' => 'yes',
                'admin_label' => true,    
                'group' => __( 'Content', 'landx' ),         
            ),
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Display', 'landx' ),
                'param_name' => 'display',
                'value' => landx_vc_element_display_option(),
                'std' => 'video',
                'admin_label' => true,
                'group' => __( 'Content bottom', 'landx' ), 
            ),
            array(
                 'type' => 'textfield',
                'heading' => __( 'Tech Title', 'landx' ),
                'param_name' => 'tech_title',
                'value' => 'Technologies we use:',
                'admin_label' => true,
                'dependency' => array(
                    'element' => 'display',
                    'value' => 'techs'
                ) , 
                'group' => __( 'Content bottom', 'landx' ),               
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'style',
                'value' => landx_vc_color_options(true),
                'std' => 'rose',
                'heading' => __( 'Counter color', 'landx' ),
                'dependency' => array(
                    'element' => 'display',
                    'value' => 'counter'
                ) , 
                'group' => __( 'Content bottom', 'landx' ),                
            ),
            array(
                 'type' => 'textfield',
                'heading' => __( 'Video link Title', 'landx' ),
                'param_name' => 'video_link_title',
                'value' => 'Watch Our Video {duration: 2:40 min}',
                'dependency' => array(
                    'element' => 'display',
                    'value' => 'video'
                ) , 
                'group' => __( 'Content bottom', 'landx' ),               
            ),
            array(
                 'type' => 'textfield',
                'heading' => __( 'Video link', 'landx' ),
                'param_name' => 'video_link',
                'value' => 'https://www.youtube.com/embed/SZEflIVnhH8',
                'admin_label' => true,
                'dependency' => array(
                    'element' => 'display',
                    'value' => 'video'
                ) , 
                'group' => __( 'Content bottom', 'landx' ),               
            ),
            // params group
            landx_vc_techs_group(),
            landx_vc_counter_group(),            
        ) 
    );
    $args = apply_filters( 'landx_vc_map_filter', $args, $args['base'] );
    if( $return ) {
        return landx_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_LandX_about_us extends WPBakeryShortCode {
}