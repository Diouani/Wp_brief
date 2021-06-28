<?php
extract(shortcode_atts(array(
    'name'  => 'Jhone doe',
    'website'  => 'http://www.themeperch.net',
    'title'  => 'Marketing maneger',
    'image'  => LANDX_URI.'/images/testimonial1.jpg',
), $atts));
echo do_shortcode('[perch_testimonial name="'.esc_attr($name).'" title="'.esc_attr($title).'" website="'.esc_attr($website).'" image="'.esc_url($image).'"]'.$content.'[/perch_testimonial]');
?>