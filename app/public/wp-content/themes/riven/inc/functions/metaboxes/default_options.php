<?php

function riven_default_meta_data() {
    $riven_layout = riven_layouts();
    $riven_sidebar_position = riven_sidebar_position();
    $riven_sidebars = riven_sidebars();
    $riven_header_layout = riven_header_types();
    $riven_footer_layout = riven_footer_types();
    $riven_slider = riven_rev_sliders_in_array();
    
    return array(
        // header
        'header' => array(
            'name' => 'header',
            'title' => esc_html__('Header Layout', 'riven'),
            'type' => 'select',
            'options' => $riven_header_layout,
            'default' => 'default'
        ),
        // footer
        'footer' => array(
            'name' => 'footer',
            'title' => esc_html__('Footer Layout', 'riven'),
            'type' => 'select',
            'options' => $riven_footer_layout,
            'default' => 'default'
        ),
        // Page title
        'page_title' => array(
            'name' => 'page_title',
            'title' => esc_html__('Page title', 'riven'),
            'desc' => esc_html__('Hide page title', 'riven'),
            'type' => 'checkbox'
        ),
        // Breadcrumbs
        'breadcrumbs' => array(
            'name' => 'breadcrumbs',
            'title' => esc_html__('Breadcrumbs', 'riven'),
            'desc' => esc_html__('Hide Breadcrumbs', 'riven'),
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
        //sidebar position
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
        // layout
        'layout' => array(
            'name' => 'layout',
            'title' => esc_html__('Layout', 'riven'),
            'type' => 'select',
            'options' => $riven_layout,
            'default' => 'default'
        ),
        'show_slider' => array(
            'name' => 'show_slider',
            'title' => esc_html__('Show Revolution Slider', 'riven'),
            'desc' => esc_html__('Show Slider', 'riven'),
            'type' => 'checkbox'
        ), 
        'category_slider' => array(
            'name' => 'category_slider',
            'title' => esc_html__('Select Revolution Slider', 'riven'),
            'desc' => esc_html__('Slider will show if you show revolution slider', 'riven'),
            'type' => 'select',
            'options' => $riven_slider,
            'default' => 'default'
        ),
    );
}

