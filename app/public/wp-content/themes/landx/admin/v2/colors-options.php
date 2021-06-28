<?php

/*default color classes */
function landx_default_color_classes(){
  $preset_color = ot_get_option('preset_color', '#008ed6');
  $preset_color2 = ot_get_option('woocommerce_color', '#008ed6');
  $array = array(
    'tra' => array('label' => 'Transparent color', 'value' => 'transparent' ),
    'light' => array('label' => 'Light color', 'value' => '#fff' ),
    'white' => array('label' => 'White color', 'value' => '#fff' ),   
    'black' => array('label' => 'Black color', 'value' => '#333' ),   
    'preset' => array('label' => 'Preset color', 'value' => $preset_color), 
    'preset2' => array('label' => 'Preset color 2', 'value' => $preset_color2), 
    'dark' => array('label' => 'Dark color', 'value' => '#222', 'color' => '#000' ),
    'lightdark' => array('label' => 'Dark color - Light', 'value' => '#252d35'),
    'deepdark' => array('label' => 'Dark color - Deep', 'value' => '#1a1a1a'),
    'lightgrey' => array('label' => 'Grey color - Light', 'value' => '#f2f2f2', 'color' => '#ccc'),
    'grey' => array('label' => 'Grey color', 'value' => '#ede9e6', 'color' => '#666'),
    'deepgrey' => array('label' => 'Grey color - Deep', 'value' => '#ddd'),
    'rose' => array('label' => 'Rose color', 'value' => '#ff3366'),    
    'red' => array('label' => 'Red color', 'value' => '#e35029'),
    'tomato' => array('label' => 'Tomato color', 'value' => '#eb2f5b'),
    'coral' => array('label' => 'Red color - Coral', 'value' => '#ea5c5a'),
    'yellow' => array('label' => 'Yellow color', 'value' => '#fed841', 'color' => '#fcb80b'),    
    'green' => array('label' => 'Green color', 'value' => '#42a045', 'color' => '#56a959'),
    'lightgreen' => array('label' => 'Green color - Light', 'value' => '#59BD56', 'color' => '#22bc3f'),
    'deepgreen' => array('label' => 'Green color - Deep', 'value' => '#009587'),
    'blue' => array('label' => 'Blue color', 'value' => '#2154cf', 'color' => '#3176ed'),
    'lightblue' => array('label' => 'Blue color - Light', 'value' => '#1e88e5'),
    'skyblue' => array('label' => 'Blue color - Skyblue', 'value' => '#01b7de'),
    'deepblue' => array('label' => 'Blue color - Deep', 'value' => '#004861'),
    'tinyblue' => array('label' => 'Blue color - Tiny', 'value' => '#e6f9fa'),
    'purple' => array('label' => 'Purple color', 'value' => '#6e45e2'),
    'deeppurple' => array('label' => 'Purple color - Deep', 'value' => '#510fa7', 'color' => '#004861'),
    'lightpurple' => array('label' => 'Purple color - Light', 'value' => '#715fef'),
  );
  return apply_filters( 'landx_default_color_classes', $array);
}
function landx_default_color(){
  return 'preset';
}
function landx_default_dark_color_classes(){
    $array = array( 'bg-deepdark', 'bg-dark', 'bg-lightdark', 'bg-rose', 'bg-red', 'bg-green', 'bg-deepgreen', 'bg-blue','bg-skyblue', 'bg-deepblue', 'bg-lightblue', 'bg-purple', 'bg-deeppurple', 'bg-tomato', 'bg-coral' );

    return apply_filters( 'landx_default_dark_color_classes', $array);
}

function landx_bg_color_options(){
    $arr = array();
    $colors = landx_default_color_classes();
    foreach ($colors as $key => $value) {
        $color_name = $value['label'];
        $color_class = 'bg-'.$key;
        $arr[] = array( 'label' => $color_name, 'value' =>  $color_class ); 
    }
    return $arr;
}

function landx_vc_color_options($coloronly = false){
    $arr = landx_bg_color_options();
    $colorArr = array('Default' => 'default');
    $newarr = array('Default' => '');
    foreach ($arr as $key => $value) {
        $newkey = $value['label'];
        $newvalue = $value['value'];
        $newvalue = str_replace( 'bg-', '', $newvalue );
        $colorArr[$newkey] = $newvalue;
        $newvalue = $newvalue. '-color';
        $newarr[$newkey] = $newvalue;
    }
    if($coloronly){
        return $colorArr;
    }else{
        return $newarr;
    }    
}


function landx_vc_background_options(){
    $output = array();

    $arr = landx_bg_color_options();
   $output['Transparent'] = 'bg-tra';
    foreach ($arr as $value) {
        $key = $value['label'];
        $output[$key] =  $value['value'];
    }
    return $output;
}

function landx_vc_underline_color_options(){
    $arr = array(
        __('None', 'landx') => 'none',
        __('Image', 'landx') => 'underline-image',
         __('Font weight bold', 'landx') => 'font-weight-bold',
         __('Italic text', 'landx') => 'font-italic',
         __('Indicates uppercased text', 'landx') => 'text-uppercase',
    );

    $colors = landx_default_color_classes();
    foreach ($colors as $key => $value) {
        $color_name = $value['label'];
        $color_class = 'underline-'.$key;
        $arr[$color_name] = $color_class;
    }

    return $arr;
}

function landx_dynamic_color_options_css(){
    $css = '';
    $darkcolorArr = landx_default_dark_color_classes(array('prefix' => 'btn-'));   
    $darkcolortraArr = landx_default_dark_color_classes(array('prefix' => 'btn-tra-'));

    $colors_arr = landx_default_color_classes();
    foreach ($colors_arr as $key => $value) {

        //check dark color
        $btncolorcss = '';
        $button_style = 'btn-'.$key;
        if(in_array( $button_style, $darkcolorArr)){
            $btncolorcss = 'color: #fff;';
        }
       

        $color = $value['value'];
        $css .= "
        .fbox-3.{$key}-hover:hover {
            border-bottom: 1px solid {$color};
        }
        .fbox-3.{$key}-hover:hover .b-icon span,
        .bg-{$key} { background-color: {$color}; } 
        .underline-{$key} { 
          background-image: linear-gradient(120deg, {$color} 0%, {$color} 90%); 
          background-repeat: no-repeat;
          background-size: 100% 0.22em;
          background-position: 0 105%; 
        }";
        $color =  isset($value['color'])? $value['color']: $value['value'];
        $css .= "
        .{$key}-icon [class^='ti-'], .{$key}-icon [class*=' ti-'],
        .{$key}-nav .slick-prev::before, 
        .{$key}-nav .slick-next::before,
        .navbar.{$key}-hover .navbar-nav .nav-link:focus, 
                  .navbar.{$key}-hover .navbar-nav .nav-link:hover, 
                  .modal-video .{$key}-color,
                  .play-icon-{$key},
                  .{$key}-color,
                  .{$key}-color h2, 
                  .{$key}-color h3, 
                  .{$key}-color h4, 
                  .{$key}-color h5, 
                  .{$key}-color h6, 
                  .{$key}-color p, 
                  .{$key}-color a, 
                  .{$key}-color li,
                  .{$key}-color i, 
                  .white-color .{$key}-color,
                  span.section-id.{$key}-color,
                  .{$key}-color p{ color: {$color}; }";
        $css .= "
        .btn-{$key},
        .navbar .nav-button .btn-tra-{$key}:hover,
        .navbar .nav-button .btn-tra-{$key}:focus,
        .btn-tra-{$key}:hover,
        .btn-tra-{$key}:focus,
        .btn-{$key}:hover,
        .btn-{$key}:focus{
          background-color: {$color}; 
          border-color: {$color};
          {$btncolorcss}
        }";          
        $css .= "        
        .btn-tra-{$key}{
          background-color: transparent; 
          border-color: {$color};
        }";          
        $css .= ".{$key}-icon, .{$key}-icon [class^='flaticon-']::before {color: {$color};}"; 
        $css .= ".navbar.scroll.{$key}-scroll{background-color: {$color} !important;}";        
        $css .= ".box-rounded.box-rounded-{$key}{border-color: {$color};}";   

        $css .= "
        .video-1 .video-btn.play-icon-{$key},
        .{$key}-nav.perch-vc-carousel .owl-nav [class*='owl-']:hover,
        .{$key}-nav.perch-vc-carousel .owl-dots .owl-dot.active span,
        .perch-vc-carousel.{$key}-nav .slick-dots li.slick-active button::before,
        .vc-bg-{$key} .landx-vc .wpb_element_wrapper{ background-color: {$color} }
        ";     
    }



    return landx_compress($css);
}