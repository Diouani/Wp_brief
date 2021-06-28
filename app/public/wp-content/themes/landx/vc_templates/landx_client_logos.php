<?php
extract(shortcode_atts(array(
    'images'  => '',
), $atts));
echo do_shortcode('[perch_clients_logo source="media: '.esc_attr($images).'"]');
?>

