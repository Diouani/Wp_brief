<?php
add_action( 'widgets_init', 'riven_category_override_woocommerce_widgets', 15 );
function riven_category_override_woocommerce_widgets() {
    if ( class_exists( 'WC_Widget_Product_Categories' ) ) {
        unregister_widget( 'WC_Widget_Product_Categories' );
        include get_template_directory() . '/woocommerce/classes/class-wc-widget-product-categories.php';
        register_widget( 'Riven_Category_WC_Widget_Product_Categories' );
    }
}   
add_action( 'widgets_init', 'riven_top_rate_override_woocommerce_widgets', 15 );
function riven_top_rate_override_woocommerce_widgets() {
    if ( class_exists( 'WC_Widget_Top_Rated_Products' ) ) {
        unregister_widget( 'WC_Widget_Top_Rated_Products' );
        include get_template_directory() . '/woocommerce/classes/class-wc-widget-top-rated-products.php';
        register_widget( 'Riven_Top_Rate_WC_Widget_Top_Rated_Products' );
    }
}  
add_action( 'widgets_init', 'riven_product_override_woocommerce_widgets', 15 );
function riven_product_override_woocommerce_widgets() {
    if ( class_exists( 'WC_Widget_Products' ) ) {
        unregister_widget( 'WC_Widget_Products' );
        include get_template_directory() . '/woocommerce/classes/class-wc-widget-products.php';
        register_widget( 'Riven_Product_WC_Widget_Products' );
    }
}   