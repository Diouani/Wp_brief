<?php
function riven_member_meta_data() {
    return array(
        array(
            "name" => "occupation",
            "title" => esc_html__("Occupation", 'riven'),
            "type" => "textfield"
        ),
        array(
            "name" => "facebook",
            "title" => esc_html__("Facebook Link", 'riven'),
            "type" => "textfield"
        ),
        array(
            "name" => "google",
            "title" => esc_html__("Instagram Link", 'riven'),
            "type" => "textfield"
        ), 
        array(
            "name" => "twitter",
            "title" => esc_html__("Twitter Link", 'riven'),
            "type" => "textfield"
        ), 
        array(
            "name" => "linkedin",
            "title" => esc_html__("Linkedin Link", 'riven'),
            "type" => "textfield"
        ), 
        array(
            "name" => "youtube",
            "title" => esc_html__("Youtube Link", 'riven'),
            "type" => "textfield"
        ),       
    );
}
function riven_view_member_meta_option() {
    $meta_box = riven_member_meta_data();
    riven_show_meta_box($meta_box);
}

function riven_save_member_meta_option($post_id) {
    $meta_box = riven_member_meta_data();
    return riven_save_meta_data( $post_id, $meta_box );
}
function riven_add_member_metaboxes() {
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'show-meta-boxes', esc_html__('Member Information', 'riven'), 'riven_view_member_meta_option', 'member', 'normal', 'low' );
    }
}
add_action('add_meta_boxes', 'riven_add_member_metaboxes');
add_action('save_post', 'riven_save_member_meta_option');