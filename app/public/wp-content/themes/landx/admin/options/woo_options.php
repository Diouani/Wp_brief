<?php
function landx_woo_options( $options = array() ){
	$options = array(  
        array(
            'id'          => 'product_archive_custom_button_text',
            'label'       => __( 'Change add to cart button text', 'landx' ),
            'desc'        => __( 'Applied on product archive page.', 'landx' ),
            'std'         => 'off',
            'type'        => 'on-off',
            'section'     => 'woo_options',
            'condition'   => '',
            'operator'    => 'and'
          
        ),
        array(
        'id'          => 'archive_add_to_cart_text',
        'label'       => __( 'Add to cart text', 'landx' ),
        'desc'        => 'Applied on product archive page.',
        'std'         => 'Add to cart',
        'type'        => 'text',
        'section'     => 'woo_options',
        'condition'   => 'product_archive_custom_button_text:is(on)',
        'operator'    => 'and'
        ),
        array(
        'id'          => 'variable_add_to_cart_text',
        'label'       => __( 'Add to cart text for variation product', 'landx' ),
        'desc'        => 'Applied on product archive page.',
        'std'         => 'Select options',
        'type'        => 'text',
        'section'     => 'woo_options',
        'condition'   => 'product_archive_custom_button_text:is(on)',
        'operator'    => 'and'
        ),
        array(
        'id'          => 'external_add_to_cart_text',
        'label'       => __( 'Add to cart text for External product', 'landx' ),
        'desc'        => 'Applied on product archive page.',
        'std'         => 'Buy product',
        'type'        => 'text',
        'section'     => 'woo_options',
        'condition'   => 'product_archive_custom_button_text:is(on)',
        'operator'    => 'and'
        ),
        array(
        'id'          => 'grouped_add_to_cart_text',
        'label'       => __( 'Add to cart text for External product', 'landx' ),
        'desc'        => 'Applied on product archive page.',
        'std'         => 'View products',
        'type'        => 'text',
        'section'     => 'woo_options',
        'condition'   => 'product_archive_custom_button_text:is(on)',
        'operator'    => 'and'
        ),
          array(
            'id'          => 'listview_button_text',
            'label'       => __( 'List view button text', 'landx' ),
            'desc'        => 'Applied on product archive page.',
            'std'         => 'See Details',
            'type'        => 'text',
            'section'     => 'woo_options',
            'condition'   => 'product_archive_custom_button_text:is(on)',
            'operator'    => 'and'
          ),  
        array(
            'id'          => 'product_custom_button_text',
            'label'       => __( 'Custom add to cart button text', 'landx' ),
            'desc'        => __( 'Applied on single product page.', 'landx' ),
            'std'         => 'off',
            'type'        => 'on-off',
            'section'     => 'woo_options',
            'condition'   => '',
            'operator'    => 'and'
          
        ),
         
        array(
        'id'          => 'add_to_cart_text',
        'label'       => __( 'Add to cart text', 'landx' ),
        'desc'        => 'Applied on single product page.',
        'std'         => 'Add to cart',
        'type'        => 'text',
        'section'     => 'woo_options',
        'condition'   => 'product_custom_button_text:is(on)',
        'operator'    => 'and'
      ),
        array(
            'id'          => 'added_to_cart_text',
            'label'       => __( 'Already in cart text', 'landx' ),
            'desc'        => 'Applied on single product page.',
            'std'         => 'Already in cart',
            'type'        => 'text',
            'section'     => 'woo_options',
            'condition'   => 'product_custom_button_text:is(on)',
            'operator'    => 'and'
          ),
        array(
            'id'          => 'related_product_display',
            'label'       => __( 'Related product show in single product', 'landx' ),
            'desc'        => '',
            'std'         => 'off',
            'type'        => 'on-off',
            'section'     => 'woo_options',
            'condition'   => '',
            'operator'    => 'and'
          
        ),           
        array(
            'id'          => 'related_product',
            'label'       => __( 'Related product display maximum', 'landx' ),
            'desc'        => '',
            'std'         => '6',
            'type'        => 'numeric-slider',
            'section'     => 'woo_options',
            'min_max_step'=> '1,12,1',
            'class'       => '',
            'condition'   => 'related_product_display:is(on)',
            'operator'    => 'and'
          
        ),
        array(
            'id'          => 'related_product_column',
            'label'       => __( 'Related product column', 'landx' ),
            'desc'        => '',
            'std'         => '3',
            'type'        => 'numeric-slider',
            'section'     => 'woo_options',
            'min_max_step'=> '2,4,1',
            'class'       => '',
            'condition'   => 'related_product_display:is(on)',
            'operator'    => 'and'
          
        ),        
        array(
            'id'          => 'shop_info',
            'label'       => __( 'Related product show in single product', 'landx' ),
            'desc'        => sprintf(__( '<h3>Product Images</h3>These settings affect the display and dimensions of images in your catalog &ndash; the display on the front-end will still be affected by CSS styles. After changing these settings you may need to <a href="%s">regenerate your thumbnails</a>.', 'landx' ), admin_url('tools.php?page=regenerate-thumbnails')),
            'std'         => '3',
            'type'        => 'textblock',
            'section'     => 'woo_options',           
        ),
        
        array(
            'id'          => 'catalog_image_width',
            'label'       => __( 'Catalog Images Width', 'landx' ),
            'desc'        => __( 'The size used in product listing.', 'landx' ),
            'std'         => '390',
            'type'        => 'numeric-slider',
            'section'     => 'woo_options',
            'min_max_step'=> '350,1200,1',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          
        ),
        array(
            'id'          => 'catalog_image_height',
            'label'       => __( 'Catalog Images height', 'landx' ),
            'desc'        => __( 'The size used in product listing.', 'landx' ),
            'std'         => '414',
            'type'        => 'numeric-slider',
            'section'     => 'woo_options',
           'min_max_step'=> '350,1000,1',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          
        ),
        array(
            'id'          => 'single_image_width',
            'label'       => __( 'Single Product Image Width', 'landx' ),
            'desc'        => __( 'This size used in single product page.', 'landx' ),
            'std'         => '570',
            'type'        => 'numeric-slider',
            'section'     => 'woo_options',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '400,1200,5',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          
        ),
        array(
            'id'          => 'single_image_height',
            'label'       => __( 'Single Product Image height', 'landx' ),
            'desc'        => __( 'This size used in single product page.', 'landx' ),
            'std'         => '665',
            'type'        => 'numeric-slider',
            'section'     => 'woo_options',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '400,1000,5',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          
        ),
	  array(
        'id'          => 'shop_layout',
        'label'       => __( 'Shop layout', 'landx' ),
        'desc'        => '',
        'std'         => 'ls',
        'type'        => 'radio-image',
        'section'     => 'woo_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'full',
            'label'       => __( 'Full width', 'landx' ),
            'src'         => OT_URL . '/assets/images/layout/full-width.png'
          ),
          array(
            'value'       => 'ls',
            'label'       => __( 'Left sidebar', 'landx' ),
            'src'         => OT_URL . '/assets/images/layout/left-sidebar.png'
          ),
          array(
            'value'       => 'rs',
            'label'       => __( 'Right sidebar', 'landx' ),
            'src'         => OT_URL . '/assets/images/layout/right-sidebar.png'
          )
        )
      ),
    array(
        'id'          => 'shop_layout_sidebar',
        'label'       => __( 'Select shop Sidebar', 'landx' ),
        'desc'        => '',
        'std'         => 'sidebar-2',
        'type'        => 'sidebar-select',
        'section'     => 'woo_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'shop_layout:not(full)',
        'operator'    => 'and'
      ),
    array(
        'id'          => 'product_layout',
        'label'       => __( 'Product layout', 'landx' ),
        'desc'        => '',
        'std'         => 'rs',
        'type'        => 'radio-image',
        'section'     => 'woo_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'full',
            'label'       => __( 'Full width', 'landx' ),
            'src'         => OT_URL . '/assets/images/layout/full-width.png'
          ),
          array(
            'value'       => 'ls',
            'label'       => __( 'Left sidebar', 'landx' ),
            'src'         => OT_URL . '/assets/images/layout/left-sidebar.png'
          ),
          array(
            'value'       => 'rs',
            'label'       => __( 'Right sidebar', 'landx' ),
            'src'         => OT_URL . '/assets/images/layout/right-sidebar.png'
          )
        )
      ),
    array(
        'id'          => 'product_layout_sidebar',
        'label'       => __( 'Product Sidebar', 'landx' ),
        'desc'        => '',
        'std'         => 'sidebar-2',
        'type'        => 'sidebar-select',
        'section'     => 'woo_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'product_layout:not(full)',
        'operator'    => 'and'
      ),
    
      
    );

    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
  
        return apply_filters( 'landx_woo_options', $options );
    }else{
        return array(
            array(
            'id'          => 'woo_info',
            'label'       => 'Woocommerce',
            'desc'       => __( 'Woocommerce plugin is Required. Installed & activated woocommerce plugin to get Woo options', 'landx' ),          
            'std'         => '3',
            'type'        => 'textblock',
            'section'     => 'woo_options',           
        ));
    }

	
}  
?>