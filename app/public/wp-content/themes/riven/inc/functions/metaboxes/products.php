<?php
function riven_product_meta_data(){
    return array(
        // Ios Link
        "version" => array(
            "name" => "version",
            "title" => esc_html__("Version Product", 'riven'),
            "desc" => esc_html__("Enter Version For Product.", 'riven'),
            "type" => "textfield"
        ),
        // Custom Tab Title
        "custom_tab_title" => array(
            "name" => "custom_tab_title",
            "title" => esc_html__("Custom Tab Title", 'riven'),
            "desc" => esc_html__("Input the custom tab title.", 'riven'),
            "type" => "textfield"
        ),
        // Content Tab Content
        "custom_tab_content" => array(
            "name" => "custom_tab_content",
            "title" => esc_html__("Custom Tab Content", 'riven'),
            "desc" => esc_html__("Input the custom tab content.", 'riven'),
            "type" => "editor"
        ),
        // Custom Tab Title
        "custom_tab_title_2" => array(
            "name" => "custom_tab_title_2",
            "title" => esc_html__("Custom Tab Title 2", 'riven'),
            "desc" => esc_html__("Input the custom tab title.", 'riven'),
            "type" => "textfield"
        ),
        // Content Tab Content
        "custom_tab_content_2" => array(
            "name" => "custom_tab_content_2",
            "title" => esc_html__("Custom Tab Content 2", 'riven'),
            "desc" => esc_html__("Input the custom tab content.", 'riven'),
            "type" => "editor"
        ),
        // Ios Link
        "ios_link" => array(
            "name" => "ios_link",
            "title" => esc_html__("Link to IOS", 'riven'),
            "desc" => esc_html__("If You Enter Link, Icon IOS Will Show.", 'riven'),
            "type" => "textfield"
        ),
        // Ios Link
        "android_link" => array(
            "name" => "android_link",
            "title" => esc_html__("Link to Android", 'riven'),
            "desc" => esc_html__("If You Enter Link, Icon Android Will Show.", 'riven'),
            "type" => "textfield"
        ),
        // Ios Link
        "pc_link" => array(
            "name" => "pc_link",
            "title" => esc_html__("Link to PC", 'riven'),
            "desc" => esc_html__("If You Enter Link, Icon PC Will Show.", 'riven'),
            "type" => "textfield"
        ),
    );
}

function riven_show_product_meta_option() {
    $meta_box = riven_product_meta_data();
    riven_show_meta_box($meta_box);
}

function riven_save_product_meta_option($post_id) {
    $meta_box = riven_product_meta_data();
    return riven_save_meta_data($post_id, $meta_box);
}

function riven_add_product_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('view-meta-boxes', esc_html__('Product Options', 'riven'), 'riven_show_product_meta_option', 'product', 'normal', 'low');
    }
}

add_action('add_meta_boxes', 'riven_add_product_metaboxes');
add_action('save_post', 'riven_save_product_meta_option');
function riven_add_categorymeta_product_table() {
// Create Product Cat Meta
global $wpdb;
$type = 'product_cat';
$table_name = $wpdb->prefix . $type . 'meta';
$variable_name = $type . 'meta';
$wpdb->$variable_name = $table_name;

// Create Product Cat Meta Table
riven_create_metadata_table($table_name, $type);
}
add_action( 'init', 'riven_add_categorymeta_product_table' );
//Taxonomy
function riven_default_product_tax_meta_data() {
    $riven_sidebar_position = riven_sidebar_position();
    $riven_sidebars = riven_sidebars();   
    return array(
        // Breadcrumbs
        'breadcrumbs' => array(
            'name' => 'breadcrumbs',
            'title' => esc_html__('Breadcrumbs', 'riven'),
            'desc' => esc_html__('Hide breadcrumbs', 'riven'),
            'type' => 'checkbox'
        ),
        'page_title' => array(
            'name' => 'page_title',
            'title' => esc_html__('Page Title', 'riven'),
            'desc' => esc_html__('Hide Page Title', 'riven'),
            'type' => 'checkbox'
        ),
        'show_header' => array(
            'name' => 'show_header',
            'title' => esc_html__('Header', 'riven'),
            'desc' => esc_html__('Hide header', 'riven'),
            'type' => 'checkbox'
        ),
        //  Show Footer
        'show_footer' => array(
            'name' => 'show_footer',
            'title' => esc_html__('Footer', 'riven'),
            'desc' => esc_html__('Hide footer', 'riven'),
            'type' => 'checkbox'
        ),
        'left-sidebar' => array(
            'name' => 'left-sidebar',
            'type' => 'select',
            'title' => esc_html__('Left Sidebar', 'riven'),
            'options' => $riven_sidebars,
            'default' => 'default'
        ),
        'right-sidebar' => array(
            'name' => 'right-sidebar',
            'type' => 'select',
            'title' => esc_html__('Right Sidebar', 'riven'),
            'options' => $riven_sidebars,
            'default' => 'default'
        ),
        //sideba

    );
}

add_action( 'product_cat_add_form_fields', 'riven_add_product_cat', 10, 2);
function riven_add_product_cat() {
    $product_cat_meta_boxes = riven_default_product_tax_meta_data();

    riven_show_tax_add_meta_boxes($product_cat_meta_boxes);
}

add_action( 'product_cat_edit_form_fields', 'riven_edit_product_cat', 10, 2);
function riven_edit_product_cat($tag, $taxonomy) {
    $product_cat_meta_boxes = riven_default_product_tax_meta_data();

    riven_show_tax_edit_meta_boxes($tag, $taxonomy, $product_cat_meta_boxes);
}

add_action( 'created_term', 'riven_save_product_cat', 10,3 );
add_action( 'edit_term', 'riven_save_product_cat', 10,3 );

function riven_save_product_cat($term_id, $tt_id, $taxonomy) {
    if (!$term_id) return;
    
    $product_cat_meta_boxes = riven_default_product_tax_meta_data();
    return riven_save_taxdata( $term_id, $tt_id, $taxonomy, $product_cat_meta_boxes );
}