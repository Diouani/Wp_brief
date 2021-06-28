<?php
//remove action
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
//add action
add_action( 'woocommerce_add_compare_wishlist', 'riven_compare_custom', 40 );
add_action( 'woocommerce_add_compare_wishlist', 'riven_wishlist_custom', 50 );
add_action( 'woocommerce_single_product_summary', 'riven_tag_single_product', 7 );
add_action( 'woocommerce_single_product_summary', 'riven_product_social', 60 );
add_action( 'woocommerce_after_shop_loop_item', 'riven_product_social', 40 );
add_action( 'woocommerce_single_product_summary_after', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary_after', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'after_setup_theme', 'riven_woocommerce_support' );
//add filter
add_filter('woocommerce_add_to_cart_fragments', 'riven_woocommerce_header_add_to_cart_fragment');
add_filter("woocommerce_checkout_fields", "riven_order_fields");
add_filter("woocommerce_checkout_fields", "riven_order_shipping_fields");
add_filter('loop_shop_per_page', 'riven_product_shop_per_page', 20);
// add_filter( 'woocommerce_billing_fields' , 'riven_override_billing_fields' );
// add_filter( 'woocommerce_shipping_fields' , 'riven_override_shipping_fields' );
add_filter('woocommerce_checkout_fields', 'riven_custom_override_checkout_fields');
add_filter( 'gettext', 'riven_sort_change', 20, 3 ); 
add_filter('woocommerce_product_get_rating_html', 'riven_get_rating_html', 10, 2);
add_filter( 'woocommerce_default_address_fields' , 'riven_override_default_address_fields' );

function riven_override_default_address_fields( $address_fields ) {
     $address_fields['postcode']['placeholder'] = esc_html__('Postcode / Zip *','riven');
     $address_fields['state']['placeholder'] = esc_html__('State / County *','riven');  
     return $address_fields;
}
function riven_wishlist_custom(){
    global $riven_settings;
?>
<?php if (class_exists('YITH_WCWL')) :?>
<div class="add-to wishlist-btn">
        <?php    
            echo do_shortcode('[yith_wcwl_add_to_wishlist]');
        ?>
</div>
<?php endif;?>
<?php
}
function riven_compare_custom(){
     global $product, $riven_settings;
    $compare = (get_option('yith_woocompare_compare_button_in_products_list') == 'yes');
    ?>
    <?php
    if ($compare && $riven_settings['product-compare']){
            printf('<div class="add-to"><a title="'.esc_html__("compare","riven").'" onclick="" data-toggle="tooltip" href="%s" class="%s" data-product_id="%d"><i class="fa fa-random"></i></a></div>', riven_add_compare_action($product->get_id()), 'add_to_compare compare button', $product->get_id(), esc_html__('Compare', 'riven'));
        }
    ?>
    <?php
}   
function riven_add_compare_action($product_id) {
    $action = 'yith-woocompare-add-product';
    $url_args = array('action' => $action, 'id' => $product_id);
    return wp_nonce_url(add_query_arg($url_args), $action);
}
//show rating when not review
function riven_get_rating_html($rating_html, $rating) {
  if ( $rating > 0 ) {
    $title = sprintf( esc_html__( 'Rated %s out of 5', 'riven' ), $rating );
  } else {
    $title = 'Not yet rated';
    $rating = 0;
  }

  $rating_html  = '<div class="star-rating" title="' . $title . '">';
  $rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . esc_html__( 'out of 5', 'riven' ) . '</span>';
  $rating_html .= '</div>';

  return $rating_html;
}
function riven_tag_single_product(){
    global $post, $product;
    $tag_condition = get_the_terms( $post->ID, 'product_tag' );
    ?>
    <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="category_product">' . _n( '', '', count( $product->get_tag_ids() ), 'riven' ) . ' ', '</div>' ); ?>    
    <?php
} 
function riven_product_social(){
global $riven_settings;
$apple = get_post_meta(get_the_ID(), 'ios_link', true); 
$android = get_post_meta(get_the_ID(), 'android_link', true);   
$windows = get_post_meta(get_the_ID(), 'pc_link', true);     
if($apple != '' || $android != '' || $windows != '') :
?>
<div class="product_social">
    <?php if(is_product()) :?>
        <label><?php echo esc_html__('Available','riven')?></label>
    <?php endif;?>
    <ul>
        <?php if($apple != '') :?>
        <li><a href="<?php echo $apple;?>"><i class="fa fa-apple" aria-hidden="true"></i></a></li>
        <?php endif;?>
        <?php if($android != '') :?>
        <li><a href="<?php echo $android;?>"><i class="fa fa-android" aria-hidden="true"></i></a></li>
        <?php endif;?>
        <?php if($windows != '') :?>
        <li><a href="<?php echo $windows;?>"><i class="fa fa-windows" aria-hidden="true"></i></a></li>
        <?php endif;?>
    </ul>
</div>
<?php
endif;
}
//update cart items on minicart
function riven_woocommerce_header_add_to_cart_fragment($fragments) {
    $_cartQty = WC()->cart->cart_contents_count;
    $fragments['.mini-cart .number-product'] = '<p class="number-product">' . $_cartQty . '</p>';
    $fragments['.mini-cart .shopping_bag .count_cart_item'] = '<span class="count_cart_item">' . $_cartQty . '</span>';
    return $fragments;
}
//woocommerce supports
function riven_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
function riven_order_fields($fields) {
    $order = array(
        "billing_country",
        "billing_state",
        "billing_first_name", 
        "billing_last_name", 
        "billing_company", 
        "billing_address_1", 
        "billing_address_2",
        "billing_city",   
        "billing_postcode",       
        "billing_email", 
        "billing_phone"
    );
    foreach($order as $field)
    {   
        if(isset($fields["billing"][$field])){
            $ordered_fields[$field] = $fields["billing"][$field];
        }
    }

    $fields["billing"] = $ordered_fields;
    return $fields;

}
function riven_order_shipping_fields($fields) {
    $order = array(
        "shipping_country",
        "shipping_state",
        "shipping_first_name", 
        "shipping_last_name", 
        "shipping_company", 
        "shipping_address_1",
        "shipping_address_2",
        "shipping_city",        
        "shipping_postcode",
        "shipping_phone",       
        "shipping_email", 
        
    );
    foreach($order as $field)
    {
        if(isset($fields["shipping"][$field])){
            $ordered_fields[$field] = $fields["shipping"][$field];
        }
    }

    $fields["shipping"] = $ordered_fields;
    return $fields;

}
function riven_product_shop_per_page() {
    global $riven_settings;
    parse_str($_SERVER['QUERY_STRING'], $params);

    // replace it with theme option
    if ($riven_settings['category-item']) {
        $per_page = explode(',', $riven_settings['category-item']);
    } else {
        $per_page = explode(',', '12,24,36');
    }

    $item_count = !empty($params['count']) ? $params['count'] : $per_page[0];

    return $item_count;
}
function riven_override_billing_fields( $fields ) {
  $fields['billing_first_name'] = array(
        'label' => 'First Name',
        'placeholder' => _x('First Name *', 'placeholder', 'riven'),
        'required' => true,
    );
    $fields['billing_last_name'] = array(
        'label' => 'Last Name',
        'placeholder' => _x('Last Name *', 'placeholder', 'riven'),
        'required' => true,
    );
  $fields['billing_company'] = array(
        'label' => 'Company name',
        'placeholder' => _x('Company Name', 'placeholder', 'riven'),
        'required' => false,
    );
  $fields['billing_email'] = array(
        'label' => 'Email',
        'placeholder' => _x('E-mail *', 'placeholder', 'riven'),
        'required' => true,
    );
  $fields['billing_phone'] = array(
        'label' => 'Phone',
        'placeholder' => _x('Phone *', 'placeholder', 'riven'),
        'required' => true,
    );
  $fields['billing_address_1'] = array(
        'label' => 'Address',
        'placeholder' => _x('Address', 'placeholder', 'riven'),
        'required' => false,
    );
  $fields['billing_address_2'] = array(
        'label' => 'Apartment, suite, unit etc. (optional)',
        'placeholder' => _x('Apartment, suite, unit etc. (optional)', 'placeholder', 'riven'),
        'required' => false,
    );
  $fields['billing_postcode'] = array(
        'label' => 'Postcode / Zip',
        'placeholder' => _x('Postcode / Zip *', 'placeholder', 'riven'),
        'required' => true,
    );
  $fields['billing_city'] = array(
        'label' => 'Town / City',
        'placeholder' => _x('Town / City *', 'placeholder', 'riven'),
        'required' => true,
    );
  $fields['billing_phone'] = array(
        'label' => 'Phone',
        'placeholder' => _x('Phone *', 'placeholder', 'riven'),
        'required' => true,
    );
  return $fields;
}

function riven_override_shipping_fields( $fields ) {
  $fields['shipping_first_name'] = array(
        'label' => 'First Name',
        'placeholder' => _x('First Name *', 'placeholder', 'riven'),
        'required' => true,
    );
    $fields['shipping_last_name'] = array(
        'label' => 'Last Name',
        'placeholder' => _x('Last Name *', 'placeholder', 'riven'),
        'required' => true,
    );
  $fields['shipping_company'] = array(
        'label' => 'Company name',
        'placeholder' => _x('Company Name', 'placeholder', 'riven'),
        'required' => false,
    );
  $fields['shipping_email'] = array(
        'label' => 'Email',
        'placeholder' => _x('E-mail *', 'placeholder', 'riven'),
        'required' => true,
    );
  $fields['shipping_phone'] = array(
        'label' => 'Phone',
        'placeholder' => _x('Phone *', 'placeholder', 'riven'),
        'required' => true,
    );
  $fields['shipping_address_1'] = array(
        'label' => 'Address',
        'placeholder' => _x('Address *', 'placeholder', 'riven'),
        'required' => true,
    );
  $fields['shipping_address_2'] = array(
        'label' => 'Apartment, suite, unit etc. (optional)',
        'placeholder' => _x('Apartment, suite, unit etc. (optional)', 'placeholder', 'riven'),
        'required' => false,
    );
  $fields['shipping_postcode'] = array(
        'label' => 'Postcode / Zip',
        'placeholder' => _x('Postcode / Zip *', 'placeholder', 'riven'),
        'required' => true,
    );
  $fields['shipping_city'] = array(
        'label' => 'Town / City',
        'placeholder' => _x('Town / City *', 'placeholder', 'riven'),
        'required' => true,
    );
  $fields['shipping_phone'] = array(
        'label' => 'Phone',
        'placeholder' => _x('Phone *', 'placeholder', 'riven'),
        'required' => true,
    );
  return $fields;
}
function riven_custom_override_checkout_fields($fields) {

    $fields['billing']['billing_first_name'] = array(
        'label' => 'First Name',
        'placeholder' => _x('First Name *', 'placeholder', 'riven'),
        'required' => true,
    );
    $fields['billing']['billing_last_name'] = array(
        'label' => 'Last Name',
        'placeholder' => _x('Last Name *', 'placeholder', 'riven'),
        'required' => true,
    );
    $fields['billing']['billing_company'] = array(
        'label' => '',
        'placeholder' => _x('Company Name', 'placeholder', 'riven'),
        'required' => false,
        'class'     => array('form-row-wide'),
    );
    $fields['billing']['billing_address_1'] = array(
        'label' => '',
        'placeholder' => _x('Address', 'placeholder', 'riven'),
        'required' => false,
        'class'     => array('form-row-wide'),
    );
    $fields['billing']['billing_address_2'] = array(
        'label' => '',
        'placeholder' => _x('Enter Your Apartment', 'placeholder', 'riven'),
        'required' => false,
    );
    $fields['billing']['billing_city'] = array(
        'label' => 'City',
        'placeholder' => _x('City *', 'placeholder', 'riven'),
        'required' => true,
    );
    $fields['billing']['billing_email'] = array(
        'label' => 'Email Address',
        'placeholder' => _x('E-mail *', 'placeholder', 'riven'),
        'required' => true,
    );
    $fields['billing']['billing_phone'] = array(
        'label' => 'Phone',
        'placeholder' => _x('Phone *', 'placeholder', 'riven'),
        'required' => true,
    );
    $fields['shipping']['shipping_phone'] = array(
        'label' => 'Phone',
        'placeholder'   => _x('Phone Number *', 'placeholder', 'riven'),
        'required'  => true,
     );
    $fields['shipping']['shipping_first_name'] = array(
        'label' => 'First Name',
        'placeholder' => _x('First Name *', 'placeholder', 'riven'),
        'required' => true,
    );
    $fields['shipping']['shipping_last_name'] = array(
        'label' => 'Last Name',
        'placeholder' => _x('Last Name *', 'placeholder', 'riven'),
        'required' => true,
    );
    $fields['shipping']['shipping_company'] = array(
        'label' => 'Company Name',
        'placeholder' => _x('Company Name', 'placeholder', 'riven'),
        'required' => false,
        'class'     => array('form-row-wide'),
    );
    $fields['shipping']['shipping_city'] = array(
        'label' => 'City',
        'placeholder' => _x('City *', 'placeholder', 'riven'),
        'required' => true,
    );
    $fields['shipping']['shipping_email'] = array(
        'label' => 'Email Address',
        'placeholder' => _x('E-mail *', 'placeholder', 'riven'),
        'required' => true,
    );
    $fields['shipping']['shipping_address_1'] = array(
        'label' => 'Adress',
        'placeholder' => _x('Address *', 'placeholder', 'riven'),
        'required' => true,
        'class'     => array('form-row-wide'),
    );
    $fields['order']['order_comments'] = array(
        'label' => 'Order notes',
        'placeholder' => _x('Order Notes', 'placeholder', 'riven'),
        'required' => false,
        'type' => 'textarea',
        'class'     => array('form-row-wide'),
    );
    

    return $fields;
}
//change text sort by
function riven_sort_change( $translated_text, $text, $domain ) {

    if ( is_woocommerce() ) {

        switch ( $translated_text ) {
            case 'Sort by popularity' :

                $translated_text = esc_html__( 'Popularity', 'riven' );
                break;
            case 'Sort by average rating' :

                $translated_text = esc_html__( 'Average rating', 'riven' );
                break;    
            case 'Sort by newness' :

                $translated_text = esc_html__( 'Newest', 'riven' );
                break;
            case 'Sort by price: low to high' :

                $translated_text = esc_html__( 'Low to high', 'riven' );
                break;    
            case 'Sort by price: high to low' :

                $translated_text = esc_html__( 'High to low', 'riven' );
                break;    
        }

    }

    return $translated_text;
} 