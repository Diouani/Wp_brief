<?php
extract(shortcode_atts(array(
    'header_slider_images'  => '',
), $atts));
$slideArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($header_slider_images) : array();

$slides = array();
if( !empty($slideArr) ){     
    foreach ($slideArr as $key => $value) {
        $slides[]['src'] = $value['image'];
    }

   echo '<div class="landx-background-slider" data-slides='.json_encode($slides).'></div>'; 
}
