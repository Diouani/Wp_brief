<?php
function riven_testimonial_meta_data() {
    return array(
        array(
            "name" => "occupation",
            "title" => esc_html__("Occupation", 'riven'),
            "type" => "textfield"
        ),    
        array(
            "name" => "star_rating",
            "title" => esc_html__("Star Rating", 'riven'),
            "type" => "textfield",
            'desc' => "Enter 1 to 5 star point. Example: 4.7"
        ),    
    );
}
function riven_view_testimonial_meta_option() {
    $meta_box = riven_testimonial_meta_data();
    riven_show_meta_box($meta_box);
}

function riven_save_testimonial_meta_option($post_id) {
    $meta_box = riven_testimonial_meta_data();
    return riven_save_meta_data( $post_id, $meta_box );
}
function riven_add_testimonial_metaboxes() {
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'show-meta-boxes', esc_html__('Testimonial Information', 'riven'), 'riven_view_testimonial_meta_option', 'testimonial', 'normal', 'low' );
    }
}
add_action('add_meta_boxes', 'riven_add_testimonial_metaboxes');
add_action('save_post', 'riven_save_testimonial_meta_option');