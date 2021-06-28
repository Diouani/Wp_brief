<?php
function riven_page_meta_data() {
    $riven_skin = array('radical-red', 'cadet-blue', 'persimmon', 'chateau-green', 'rich-electric-blue', 'color-single-product'); 
    
    return array(
       'special_skin' => array(
            'name' => 'special_skin',
            'title' => esc_html__('Special Skin', 'riven'),
            'desc' => esc_html__('Select Skin for this page', 'riven'),
            'type' => 'checkbox'
        ), 
        'skin' => array(
            'name' => 'skin',
            'title' => esc_html__('Skin', 'riven'),
            'desc' => esc_html__('Select Skin', 'riven'),
            'type' => 'skin',
            'default'=> 'awesome',
            'options'=> $riven_skin
        ),
    );
}
function riven_view_page_meta_option() {
    $meta_box = riven_page_meta_data();
    riven_show_meta_box($meta_box);
}
function riven_save_page2_meta_option($post_id) {
    $meta_box = riven_page_meta_data();
    return riven_save_meta_data($post_id, $meta_box);
}
function riven_show_page_meta_option() {
    $meta_box = riven_default_meta_data();
    $meta_box['header_fixed'] = array(
        'name' => 'header_fixed',
        'title' => esc_html__('Header Fixed', 'riven'),
        'type' => 'checkbox'
    );
    $meta_box['menu_onepage'] = array(
        'name' => 'menu_onepage',
        'title' => esc_html__('Show Menu Onepage', 'riven'),
        'type' => 'checkbox'
    );
    riven_show_meta_box($meta_box);
}

function riven_save_page_meta_option($post_id) {
    $meta_box = riven_default_meta_data();
    $meta_box['header_fixed'] = array(
        'name' => 'header_fixed',
        'title' => esc_html__('Header Fixed', 'riven'),
        'type' => 'checkbox'
    );
    $meta_box['menu_onepage'] = array(
        'name' => 'menu_onepage',
        'title' => esc_html__('Show Menu Onepage', 'riven'),
        'type' => 'checkbox'
    );
    return riven_save_meta_data($post_id, $meta_box);
}

function riven_add_page_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('show-meta-boxes', esc_html__('Skin Color', 'riven'), 'riven_view_page_meta_option', 'page', 'normal', 'low');
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', 'riven'), 'riven_show_page_meta_option', 'page', 'side', 'low');
    }
}
function riven_meta_page_assets(){
	wp_enqueue_script( 'riven-page-metabox', get_template_directory_uri() . '/inc/functions/metaboxes/js/metaboxs.js', array( 'jquery' ), '1.0'); 
	wp_enqueue_style("riven-page-metabox-style",get_template_directory_uri().'/inc/functions/metaboxes/css/metaboxs.css', array(), '1.0');
}
add_action('add_meta_boxes', 'riven_add_page_metaboxes');
add_action('save_post', 'riven_save_page_meta_option');
add_action('save_post', 'riven_save_page2_meta_option');
add_action('admin_enqueue_scripts', 'riven_meta_page_assets' );