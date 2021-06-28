<?php
function riven_portfolio_meta_data() {
    return array(
        array(
            "name" => "link_project",
            "title" => esc_html__("Link To Project", 'riven'),
            "type" => "textfield"
        ),  
        array(
            "name" => "client_project",
            "title" => esc_html__("Client Project", 'riven'),
            "type" => "textarea"
        ),  
        array(
            "name" => "tool_project",
            "title" => esc_html__("Tools Project", 'riven'),
            "type" => "textarea"
        ),   
    );
}
function riven_view_portfolio_meta_option() {
    $meta_box = riven_portfolio_meta_data();
    riven_show_meta_box($meta_box);
}

function riven_save_portfolio_meta_option($post_id) {
    $meta_box = riven_portfolio_meta_data();
    return riven_save_meta_data( $post_id, $meta_box );
}
function riven_add_portfolio_metaboxes() {
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'show-meta-boxes', esc_html__('Portfolio Option', 'riven'), 'riven_view_portfolio_meta_option', 'portfolio', 'normal', 'low' );
    }
}
add_action('add_meta_boxes', 'riven_add_portfolio_metaboxes');
add_action('save_post', 'riven_save_portfolio_meta_option');