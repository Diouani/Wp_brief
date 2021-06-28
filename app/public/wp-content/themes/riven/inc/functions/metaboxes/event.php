<?php
function riven_event_meta_data() {
    return array(
        array(
            "name" => "location",
            "title" => esc_html__("Location", 'riven'),
            "type" => "textfield"
        ),
        array(
            "name" => "country",
            "title" => esc_html__("Country", 'riven'),
            "type" => "textfield"
        ), 
        array(
            "name" => "time_event",
            "title" => esc_html__("Time Event", 'riven'),
            "type" => "textfield"
        ),
        array(
            "name" => "day_event",
            "title" => esc_html__("Date Event", 'riven'),
            "type" => "textfield"
        ), 
        array(
            "name" => "map_event",
            "title" => esc_html__("Map iframe Code", 'riven'),
            "desc" => esc_html__('Enter iframe code', 'riven'),
            "type" => "textarea"
        ),     
    );
}
function riven_view_event_meta_option() {
    $meta_box = riven_event_meta_data();
    riven_show_meta_box($meta_box);
}

function riven_save_event_meta_option($post_id) {
    $meta_box = riven_event_meta_data();
    return riven_save_meta_data( $post_id, $meta_box );
}
function riven_add_event_metaboxes() {
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'show-meta-boxes', esc_html__('Event Option', 'riven'), 'riven_view_event_meta_option', 'event', 'normal', 'low' );
    }
}
add_action('add_meta_boxes', 'riven_add_event_metaboxes');
add_action('save_post', 'riven_save_event_meta_option');