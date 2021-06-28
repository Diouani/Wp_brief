<?php
/**
* Modified vc element base
*
* @since 1.2
* @return array
*/
function landx_modified_element_base(){
    $array = array( 
        'landx_header_intro',        
        'landx_feature_list',        
        'landx_title',        
        'landx_cta',        
        'landx_contact_us',        
        'landx_feature',        
    ); 

    return apply_filters( 'landx_modified_element_base', $array );
}

/**
* Set typogography options
*
* @since 1.2
* @return array
*/
function landx_add_param_typography_options(){
    $array = array( 'name', 'title', 'subtitle', 'leadtext' );   

    return apply_filters( 'landx_param_add_typography_options', $array );
}


/**
* Additional params typography options
*
* @since 1.2
* @return array
*/
add_filter( 'landx_vc_map_filter', 'landx_vc_elements_param_extention', 11, 2 );
function landx_vc_elements_param_extention( $args, $base ){
    $elementArr = landx_modified_element_base();
    $paramsArr = landx_add_param_typography_options();

   if( in_array($base, $elementArr) ){
        $params = $args['params'];        

        foreach ($paramsArr as $field_id) {           
            if(landx_is_field_id_exists($params, $field_id)):
            $params = landx_vc_param_typography_extention($params, $base, $field_id);       
            endif;
        }
        
        $params = array_filter($params);
       
       $args['params'] = $params;
       
   }

    return $args;
}

/**
* Typography options for params element
* @param array, string, string
*
* @since 1.2
* @return array
*/
function landx_vc_param_typography_extention( $params, $base, $field_id ){  
    $param = landx_get_param_array($params, $field_id);
    $heading = $param['heading'];
    
    if( class_exists('PerchVcMap') ): 

    $params[] =  PerchVcMap::_vc_param_enable_highlight_text( $field_id, $heading ); 
    $params[] =  PerchVcMap::_vc_highlight_text_typography( $field_id, $heading );           
    $params[] =  PerchVcMap::_vc_param_typography( $field_id, $heading );

    endif;

    //$params[] =  PerchVcMap::_vc_param_enable_google_fonts( $field_id, $heading );
    //$params[] =  PerchVcMap::_vc_param_custom_google_fonts( $field_id, $heading );            
          
    
    $params = array_filter($params);
  
    return $params;    
}


/**
* get param array
*
* @since 1.2
* @return array
*/
function landx_get_param_array( $params, $param_name, $key = 'param_name' ){

     $arrKey = array_search($param_name, array_column($params, $key));
     if($params[$arrKey]['param_name'] == $param_name){         
         return $params[$arrKey];
     }else{
        return false;
     }
}
/**
* is param_name exists in params
* @param array, string, string(optional)
*
* @since 1.2
* @return array
*/
function landx_is_field_id_exists($params, $param_name, $key = 'param_name'){
    $arrKey = array_search($param_name, array_column($params, $key));
     if( isset($params[$arrKey]['param_name']) && ($params[$arrKey]['param_name'] == $param_name)){         
         return true;
     }else{
        return false;
     }
}




/**
* vc_map default values
* @param string
* @param array
*
* @since 1.2
* @return mixed html
*/
function landx_get_vc_param_html( $param_name = '', $atts = array() ){

    if( !isset($atts[$param_name]) || ($atts[$param_name] == '') ) return '';

    $output = $atts[$param_name];


    $font_container = $param_name.'_font_container';
    if( isset($atts[$font_container])  && ($atts[$font_container] != '')){       
        $typo_settings =  landx_get_vc_typography_value($atts[$font_container]);
        extract($typo_settings);
        if( '' == $inner_tag ){
            $output = "<{$tag}{$all_classes}{$inline_css}>{$output}</{$tag}>";
        }else{
            $output = "<{$tag}{$all_classes}{$inline_css}><{$inner_tag}>{$output}</{$inner_tag}></{$tag}>";
        }
        
    }
    


    return $output;
}


add_filter( 'perch/vc_param_enable_highlight_text', 'landx_param_enable_highlight_text', 10, 1 );
function landx_param_enable_highlight_text( $args ){
    $args['edit_field_class'] = 'vc_col-sm-6';
    $args['std'] = 'text_color:preset-color';
    return $args;
}
add_filter( 'perch_vc_typography_fields_column', 'landx_vc_typography_fields_column', 10, 2 );
function landx_vc_typography_fields_column( $column, $field_id ){
    if( $field_id == 'title' ){
        $column = 3;
    }else{
        $column = 4;
    }
    return intval($column);
}

add_filter( 'perch_vc_typography_std', 'landx_vc_typography_std', 10, 2 );
function landx_vc_typography_std( $std, $field_id ){
    if( $field_id == 'title' ){
        $std = '';
    }else{
        $std = 'tag:p';
    }
    return $std;
}

add_filter( 'perch_vc_typography_fields', 'landx_perch_vc_typography_fields', 10, 2 );
function landx_perch_vc_typography_fields( $fields, $field_id ){
    if( $field_id == 'title' ){
    $fields = array(              
                'text_color',              
                'text_underline',
                'extra_class',
                // inline css
                'font_family',
                'font_size',
                'font_style',
                'font_size',
                'text_transform',
                'text_decoration',            
                'font_variant',
                'font_weight',
                'letter_spacing',           
                'line_height',
            );
    }

    if( ($field_id == 'subtitle') || ($field_id == 'sub_title')  || ($field_id == 'lead_text') ){
    $fields = array(              
                'text_color', 
                'size',             
                'text_underline',
                'extra_class',
                // inline css
                'font_family',
                'font_size',
                'font_style',
                'font_size',
                'text_transform',
                'text_decoration',            
                'font_variant',
                'font_weight',
                'letter_spacing',           
                'line_height',
            );
    }
    return $fields;
}

add_filter( 'perch/vc_param_enable_highlight_text', 'landx_vc_param_enable_highlight_text' );
function landx_vc_param_enable_highlight_text( $args ){
    $args['std'] = 'yes';
    return $args;
}
add_filter('perch_modules/get_allowed_color_class', 'landx__get_allowed_color_class');
function landx__get_allowed_color_class($allowed_color){
    if( function_exists('landx_vc_color_options') ){
            $allowed_color = array_merge($allowed_color, landx_vc_color_options(false));
        }

    return $allowed_color;    
}

add_filter('perch_modules/get_allowed_underline_class', 'landx__get_allowed_underline_class');
function landx__get_allowed_underline_class($allowed_color){
     if( function_exists('landx_vc_underline_color_options') ){
            $allowed_color = array_merge($allowed_color, landx_vc_underline_color_options());
        }

    return $allowed_color;    
}

add_filter('perch_modules/get_allowed_bg_class', 'landx__get_allowed_bg_class');
function landx__get_allowed_bg_class($allowed_color){
     if( function_exists('landx_vc_background_options') ){
            $allowed_color = array_merge($allowed_color, landx_vc_background_options(true));
        }

    return $allowed_color;    
}

/**
* developer pre print
*
* @since 1.2
* @return output
*/
if( !function_exists('landx_print') ):
function landx_print($array = array()){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
endif;

/*about-us related functions*/

function landx_vc_strategy_list_group($group = true){
    $output = array(
            'type' => 'param_group',
            'save_always' => true,
            'heading' => __( 'Content group', 'landx' ),
            'param_name' => 'strategy_list',
            'value' => urlencode( json_encode( array(
                array(
                     'title' => 'Vitae auctor integer congue magna at pretium purus pretium ligula rutrum luctus risus velna auctor congue tempus undo magna ',
                ),
                array(
                     'title' => 'An enim nullam tempor sapien gravida donec enim ipsum porta blandit justo integer odio velna vitae auctor integer luctus',
                ),
            ) ) ),
            'params' => array(
                 array(
                    'type' => 'textarea',
                    'heading' => __( 'Description', 'landx' ),
                    'param_name' => 'title',
                    'description' => '',
                    'value' => '',
                    'admin_label' => true 
                ),
            ),
        );

    if($group) $output['group'] = __( 'Content', 'landx' );

    return $output;
}

function landx_vc_get_strategy_list( $type = 'list', $paramsArr = array() , $duration = 400  ){
    if( empty($paramsArr) ) return false;
   
    if( $type == 'list' ){
        echo '<ul class="content-list">';
            foreach ($paramsArr as $key => $value): 
                extract($value);                                    
                echo '<li class="wow fadeInUp" data-wow-delay="'.intval($duration).'ms">';
                    echo wpautop($title);                 
                echo '</li>';
                $duration = $duration + 100;
            endforeach;
        echo '</ul>';
    }else{
        foreach ($paramsArr as $key => $value): 
            extract($value);                                    
            echo '<div class="wow fadeInUp" data-wow-delay="'.intval($duration).'ms">';
                echo wpautop($title);                 
            echo '</div>';
            $duration = $duration + 100;
        endforeach;
    }
}
function landx_vc_element_display_option(){
    return array(
                    'None' => 'none',
                    'Video link' => 'video',                    
                    'Counter' => 'counter',
                    'Techs' => 'techs',
                );
}

function landx_vc_techs_group(){
    return array(
        'type' => 'param_group',
        'save_always' => true,
        'heading' => __( 'Techs', 'landx' ),
        'param_name' => 'techs_group',
        'value' => urlencode( json_encode( array(
            array(
                 'title' => 'HTML5',
                'icon' => 'fa fa-html5',
                'image' => ''
            ),
            array(
                 'title' => 'CSS3',
                'icon' => 'fa fa-css3',
                'image' => ''
            ),
            array(
                 'title' => 'jsfiddle',
                'icon' => 'fa fa-jsfiddle',
                'image' => ''
            ),
            array(
                 'title' => 'git',
                'icon' => 'fa fa-git',
                'image' => ''
            ),
            array(
                 'title' => 'WordPress',
                'icon' => 'fa fa-wordpress',
                'image' => ''
            ),
            array(
                 'title' => 'mixcloud',
                'icon' => 'fa fa-mixcloud',
                'image' => ''
            ),
        ) ) ),
        'params' => array(
             array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'landx' ),
                'param_name' => 'title',
                'description' => '',
                'value' => '',
                'admin_label' => true 
            ),
             landx_vc_icon_set( 'fontawesome', 'icon' ),
             array(
                'type' => 'image_upload',
                'heading' => __( 'Icon Image', 'landx' ),
                'param_name' => 'image',
                'description' => 'You can use image instead of Icon',
                'value' => '' 
            ),
        ),
        'dependency' => array(
            'element' => 'display',
            'value' => 'techs'
        ),
        'group' => __( 'Content bottom', 'landx' ),  
    );
}

function landx_vc_counter_group(){
    return array(
        'type' => 'param_group',
        'save_always' => true,
        'heading' => __( 'Counter up', 'landx' ),
        'param_name' => 'counter_group',
        'value' => urlencode( json_encode( array(
            array(
                 'title' => 'Happy Clients',
                'count' => '438',
                'prefix' => '3,',
            ),
            array(
                 'title' => 'Tickets Closed',
                'count' => '263',
                'prefix' => '1,',
            ),
        ) ) ),
        'params' => array(
            array(
                 'type' => 'textfield',
                'heading' => __( 'Counter Prefix', 'landx' ),
                'param_name' => 'prefix',
                'description' => '',
                'value' => '3,',
                'admin_label' => true 
            ),
            array(
                 'type' => 'textfield',
                'heading' => __( 'Count', 'landx' ),
                'param_name' => 'count',
                'description' => 'Number only',
                'value' => '' ,
                'admin_label' => true 
            ),
             array(
                 'type' => 'textfield',
                'heading' => __( 'Title', 'landx' ),
                'param_name' => 'title',
                'description' => '',
                'value' => '',
                'admin_label' => true 
            ),
            
        ),
        'dependency' => array(
            'element' => 'display',
            'value' => 'counter'
        ),
        'group' => __( 'Content bottom', 'landx' ),  
    );
}