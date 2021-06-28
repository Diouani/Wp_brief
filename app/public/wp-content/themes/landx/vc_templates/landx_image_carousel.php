<?php
extract(shortcode_atts(array(
    'images'  => '',
    'width'  => 400,
    'height'  => 272,
    'items'  => 3,    
), $atts));
echo do_shortcode('[perch_carousel source="media: '.esc_attr($images).'" thumb_width="'.intval($width).'" thumb_height="'.intval($height).'" items="'.intval($items).'"]');
?>

