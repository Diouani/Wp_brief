<?php
add_action('widgets_init', 'riven_register_sidebars');

function riven_register_sidebars() {
    
    register_sidebar(array(
        'name' => esc_html__('General Sidebar', 'riven'),
        'id' => 'general-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title-category title-block">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar( array(
        'name' => esc_html__('Blog Sidebar', 'riven'),
        'id' => 'blog-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2>',
    ) );
    if ( class_exists( 'bbPress' ) ){
        register_sidebar( array(
            'name' => esc_html__('bbPress Sidebar', 'riven'),
            'id' => 'bb-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h2 class="widget-title title-block">',
            'after_title' => '</h2>',
        ) );
    }
    register_sidebar( array(
        'name' => esc_html__('Event Sidebar', 'riven'),
        'id' => 'event-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2>',
    ) );
    register_sidebar(array(
        'name' => esc_html__('Top Footer', 'riven'),
        'id' => 'top-footer',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2> ',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget 1', 'riven'),
        'id' => 'footer-column-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2> ',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 2', 'riven'),
        'id' => 'footer-column-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 3', 'riven'),
        'id' => 'footer-column-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 4', 'riven'),
        'id' => 'footer-column-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget Bussiness 1', 'riven'),
        'id' => 'footer-bussiness-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2> ',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget Bussiness 2', 'riven'),
        'id' => 'footer-bussiness-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget Bussiness 3', 'riven'),
        'id' => 'footer-bussiness-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget Bussiness 4', 'riven'),
        'id' => 'footer-bussiness-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget Home Product 1', 'riven'),
        'id' => 'footer-home-product-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2> ',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget Home Product 2', 'riven'),
        'id' => 'footer-home-product-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget Home Product 3', 'riven'),
        'id' => 'footer-home-product-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget Home Product 4', 'riven'),
        'id' => 'footer-home-product-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title title-block">',
        'after_title' => '</h2>',
    ));
    if (class_exists('Woocommerce')) {

        register_sidebar(array(
            'name' => esc_html__('Shop Sidebar', 'riven'),
            'id' => 'shop-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h2 class="widget-title title-block">',
            'after_title' => '</h2>',
        ));

        register_sidebar(array(
            'name' => esc_html__('Single Product Sidebar', 'riven'),
            'id' => 'single-product-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h2 class="widget-title title-block">',
            'after_title' => '</h2>',
        ));
    }
}