<?php
extract(shortcode_atts(array(
	'poster' => LANDX_URI.'/images/bg-image-2.jpg',
    'video_types'  => '',
), $atts));
$video_typesArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($video_types) : array();
?>			
<div class="video-bg-wrap video-play"			
	<?php
	if( !empty($video_typesArr) ){  
		echo ' data-poster="'.esc_url($poster).'"';   
	    foreach ($video_typesArr as $key => $value) {
	        echo ' data-'.esc_attr($value['type']).'="'.esc_url($value['url']).'"';
	    }
	    
	   
	}
?>
></div>
