<?php
//get search template
function riven_get_search_form() {
    $template = get_search_form(false);
    if(class_exists( 'WooCommerce' )) {
        $template = get_product_search_form(false);
    }
    $output = '';
    ob_start();
    ?>
        <span class="btn-search" onclick="toggleFilter(this);"><i class="fa fa-search"></i></span>
        <div class="top-search content-filter">
            <?php echo $template ?>
        </div>
    <?php
    $output .= ob_get_clean();
    return $output;
}
//mini cart template
if ( class_exists( 'WooCommerce' ) ) {
    function riven_get_minicart_template() {
        $cart_item_count = WC()->cart->cart_contents_count;
        $header_type = riven_get_header_type();
        $output = '';
        $ordertotal = wp_kses_data( WC()->cart->get_total() );
        ob_start();
        ?>
        <?php if($header_type == '6') :?>
            <div class="dib mini-cart header-cart">
                <a class="cart_label" onclick="toggleFilter(this);" href="javascript:void(0);">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>
                <div class="shopping_bag">
                    <span><?php echo esc_html__( 'Shopping Bag', 'riven' );?></span>
                    <p>
                    <span class="count_cart_item"><?php echo $cart_item_count ?></span><?php echo esc_html__( ' item', 'riven' );?> - <?php echo WC()->cart->get_cart_subtotal(); ?>
                    </p>
                </div>
                <div class="cart-block content-filter">
                    <div class="widget_shopping_cart_content">
                    </div>
                </div>
            </div> 
        <?php else :?>
            <div class="dib mini-cart header-cart">
                <a class="cart_label" onclick="toggleFilter(this);" href="javascript:void(0);">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <p class="number-product"><?php echo $cart_item_count ?></p>
                </a>
                <div class="cart-block content-filter">
                    <div class="widget_shopping_cart_content">
                    </div>
                </div>
            </div> 
        <?php endif;?>   
        <?php
        $output .= ob_get_clean();
        return $output;
    }
}
function riven_get_sidebar_left() {
    $result = '';
    global $wp_query, $riven_settings, $riven_sidebar_left;

    if (empty($riven_sidebar_left)) {
        $result = isset($riven_settings['left-sidebar']) ? $riven_settings['left-sidebar'] : 'none';
        if (is_404()) {
            $result = '';
        } else if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_sidebar = get_metadata('category', $cat->term_id, 'left-sidebar', true);
            if (!empty($cat_sidebar) && $cat_sidebar != 'default') {
                $result = $cat_sidebar;
            }else if($cat_sidebar =='none') {
                $result = "none";
            } else {
                $result = $riven_settings['left-post-sidebar'];
            }
        }else if (is_tag()){
            $result = $riven_settings['left-post-sidebar'];
        }
        else if (is_search()){
            $result = $riven_settings['left-post-sidebar'];
        }
        else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_sidebar = get_post_meta(wc_get_page_id('shop'), 'left-sidebar', true);
                $result = !empty($shop_sidebar) && $shop_sidebar != 'default' ? $shop_sidebar : $riven_settings['left-shop-sidebar'];
            } else { 
                if (is_post_type_archive('event')) {
                    if(isset($riven_settings['left-event-sidebar'])){
                        $result = $riven_settings['left-event-sidebar'];  
                    }else{
                        $result = $riven_settings['left-sidebar']; 
                    }  
                }          
                else if (is_post_type_archive('portfolio')) {
                    if(isset($riven_settings['left-portfolio-sidebar'])){
                        $result = $riven_settings['left-portfolio-sidebar'];  
                    }else{
                        $result = $riven_settings['left-sidebar']; 
                    }  
                } else {
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    if ($term) {
                        $tax_sidebar = get_metadata($term->taxonomy, $term->term_id, 'left-sidebar', true);
                        switch ($term->taxonomy) {
                            case 'product_cat':
                                if (!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                }else if($tax_sidebar =='none') {
                                    $result = "none";
                                } else {
                                    $result = $riven_settings['left-shop-sidebar'];
                                }
                                break;
                            case 'product_tag':
                                $result = $riven_settings['left-shop-sidebar'];
                                break;
                            case 'category':
                                if (!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                }else if($tax_sidebar =='none') {
                                    $result = "none";
                                } else {
                                    $result = $riven_settings['left-post-sidebar'];
                                }
                                break;
                            case 'tag':
                                $result = $riven_settings['left-post-sidebar'];
                                break;
                            default:
                                $result = $riven_settings['left-sidebar'];
                        }
                    }
                }
            }
        } else if(function_exists('is_plugin_active') && is_plugin_active( 'bbpress/bbpress.php' ) && is_bbpress()){
            $result = $riven_settings['left-bb-sidebar'];   
        } else {
            if (is_singular()) {
                $single_sidebar = get_post_meta(get_the_id(), 'left-sidebar', true);
                if (!empty($single_sidebar) && $single_sidebar != 'default') {
                    $result = $single_sidebar;
                } else {
                    switch (get_post_type()) {
                        case 'post':
                            $result = $riven_settings['left-post-sidebar'];
                            break;
                        case 'event':
                            $result = $riven_settings['left-event-sidebar'];
                            break;
                        case 'portfolio':
                            $result = $riven_settings['left-portfolio-sidebar'];
                            break;    
                        case 'product':
                            $result = $riven_settings['left-single-product-sidebar'];
                            break;    
                        default:
                            $result = $riven_settings['left-sidebar'];
                    }
                }
            } else {
                if (is_home() && !is_front_page()) {
                    $result = $riven_settings['left-post-sidebar'];
                }
            }
        }
        $riven_sidebar_left = $result;
    }
    return $riven_sidebar_left;
}

function riven_get_sidebar_right() {
    $result = '';
    global $wp_query, $riven_settings, $riven_sidebar_right;

    if (empty($riven_sidebar_right)) {
        $result = isset($riven_settings['right-sidebar']) ? $riven_settings['right-sidebar'] : 'none';
        if (is_404()) {
            $result = 'none';
        } else if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_sidebar = get_metadata('category', $cat->term_id, 'right-sidebar', true);
            if (!empty($cat_sidebar) && $cat_sidebar != 'default') {
                $result = $cat_sidebar;
            } else {
                $result = $riven_settings['right-post-sidebar'];
            }
        }else if (is_tag()){
            $result = $riven_settings['right-post-sidebar'];
        }
        else if (is_search()){
            $result = $riven_settings['right-post-sidebar'];
        }
        else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_sidebar = get_post_meta(wc_get_page_id('shop'), 'right-sidebar', true);
                $result = !empty($shop_sidebar) && $shop_sidebar != 'default' ? $shop_sidebar : $riven_settings['right-shop-sidebar'];
            } else { 
                if (is_post_type_archive('event')) {
                    if(isset($riven_settings['right-event-sidebar'])){
                        $result = $riven_settings['right-event-sidebar'];  
                    }else{
                        $result = $riven_settings['right-sidebar']; 
                    }  
                }           
                else if (is_post_type_archive('portfolio')) {
                    if(isset($riven_settings['right-portfolio-sidebar'])){
                        $result = $riven_settings['right-portfolio-sidebar'];  
                    }else{
                        $result = $riven_settings['right-sidebar']; 
                    }  
                } else {
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    if ($term) {
                        $tax_sidebar = get_metadata($term->taxonomy, $term->term_id, 'right-sidebar', true);
                        switch ($term->taxonomy) {
                            case 'product_cat':
                                if (!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                }else if($tax_sidebar =='none') {
                                    $result = "none";
                                } else {
                                    $result = $riven_settings['right-shop-sidebar'];
                                }
                                break;
                            case 'product_tag':
                                $result = $riven_settings['right-shop-sidebar'];
                                break;
                            case 'category':
                                if (!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                }else if($tax_sidebar =='none') {
                                    $result = "none";
                                } else {
                                    $result = $riven_settings['right-post-sidebar'];
                                }
                                break;
                            case 'tag':
                                $result = $riven_settings['right-post-sidebar'];
                                break;
                            default:
                                $result = $riven_settings['right-sidebar'];
                        }
                    }
                }
            }
        } else if(function_exists('is_plugin_active') && is_plugin_active( 'bbpress/bbpress.php' ) && is_bbpress()){
            $result = $riven_settings['right-bb-sidebar'];   
        } else {
            if (is_singular()) {
                $single_sidebar = get_post_meta(get_the_id(), 'right-sidebar', true);
                if (!empty($single_sidebar) && $single_sidebar != 'default') {
                    $result = $single_sidebar;
                } else {
                    switch (get_post_type()) {
                        case 'post':
                            $result = $riven_settings['right-post-sidebar'];
                            break;
                        case 'event':
                            $result = $riven_settings['right-event-sidebar'];
                            break;
                        case 'portfolio':
                            $result = $riven_settings['right-portfolio-sidebar'];
                            break;    
                        case 'product':
                            $result = $riven_settings['right-single-product-sidebar'];
                            break;    
                        default:
                            $result = $riven_settings['right-sidebar'];
                    }
                }
            } else {
                if (is_home() && !is_front_page()) {
                    $result = $riven_settings['right-post-sidebar'];
                }
            }
        }
        $riven_sidebar_right = $result;
    }
    return $riven_sidebar_right;
}

//get global layout
function riven_get_layout() {
    global $wp_query, $riven_settings, $riven_layout;
    $result = '';
    if (empty($riven_layout)) {
        $result = isset($riven_settings['layout']) ? $riven_settings['layout'] : 'fullwidth';
        if (is_404()) {
            $result = 'fullwidth';
        } else if (is_category()) {
            $result = $riven_settings['post-layout'];
        } else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_layout = get_post_meta(wc_get_page_id('shop'), 'layout', true);
                $result = !empty($shop_layout) && $shop_layout != 'default' ? $shop_layout : $riven_settings['shop-layout'];
            } else {
                if (is_post_type_archive('event')) {
                    $result = $riven_settings['event-layout'];
                } 
                if (is_post_type_archive('portfolio')) {
                    $result = $riven_settings['portfolio-layout'];
                } else {
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    if ($term) {
                        $tax_layout = get_metadata($term->taxonomy, $term->term_id, 'layout', true);
                        switch ($term->taxonomy) {
                            case 'product_cat':
                                if(!empty($tax_layout) && $tax_layout != 'default') {
                                    $result = $tax_layout;
                                } else {
                                    $result = $riven_settings['shop-layout'];
                                }
                                break;
                            case 'product_tag':
                                $result = $riven_settings['shop-layout'];
                                break;
                            case 'category':
                                $result = $riven_settings['post-layout'];
                                break;
                            case 'event':
                                $result = $riven_settings['event-layout'];
                                break;
                             case 'portfolio':
                                $result = $riven_settings['portfolio-layout'];
                                break;    
                            default:
                                $result = $riven_settings['layout'];
                        }
                    }
                }
            }    
        } else {
            if (is_singular()) {
                $single_layout = get_post_meta(get_the_id(), 'layout', true);
                if (!empty($single_layout) && $single_layout != 'default') {
                    $result = $single_layout;
                } else {
                    switch (get_post_type()) {
                        case 'post':
                            $result = $riven_settings['post-layout'];
                            break;
                        case 'product':
                            $result = $riven_settings['single-product-layout'];
                            break;  
                        case 'event':
                                $result = $riven_settings['event-layout'];
                                break;  
                        case 'portfolio':
                                $result = $riven_settings['portfolio-single-layout'];
                                break;          
                        default:
                            $result = $riven_settings['layout'];
                    }
                }
            } else {
                if (is_home() && !is_front_page()) {
                    $result = $riven_settings['post-layout'];
                }
            }
        }
        $riven_layout = $result;
    }
    return $riven_layout;
}

function riven_get_header_type() {
    $result = '';
    global $riven_settings, $wp_query, $header_type;

    if (empty($header_type)) {
        $result = isset($riven_settings['header-type']) ? $riven_settings['header-type'] : 1;
        if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_layout = get_metadata('category', $cat->term_id, 'header', true);
            if (!empty($cat_layout) && $cat_layout != 'default') {
                $result = $cat_layout;
            } else {
                $result = $riven_settings['header-type'];
            }
        } else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_layout = get_post_meta(wc_get_page_id('shop'), 'header', true);
                if (!empty($shop_layout) && $shop_layout != 'default') {
                    $result = $shop_layout;
                }
            }
        } else {
            if (is_singular()) {
                $single_layout = get_post_meta(get_the_id(), 'header', true);
                if (!empty($single_layout) && $single_layout != 'default') {
                    $result = $single_layout;
                }
            } else {
                if (!is_home() && is_front_page()) {
                    $result = $riven_settings['header-type'];
                } else if (is_home() && !is_front_page()) {
                    $posts_page_id = get_option('page_for_posts');
                    $posts_page_layout = get_post_meta($posts_page_id, 'header', true);
                    if (!empty($posts_page_layout) && $posts_page_layout != 'default') {
                        $result = $posts_page_layout;
                    }
                }
            }
        }
        $header_type = $result;
    }
    return $header_type;
}

function riven_get_footer_type() {
    $result = '';
    global $riven_settings, $wp_query, $footer_type;;
    if (empty($footer_type)) {    
        $result = isset($riven_settings['footer-type']) ? $riven_settings['footer-type'] : 1;
        if (is_category()) {
                $cat = $wp_query->get_queried_object();
                $cat_layout = get_metadata('category', $cat->term_id, 'footer', true);
                if (!empty($cat_layout) && $cat_layout != 'default') {
                    $result = $cat_layout;
                } else {
                    $result = $riven_settings['footer-type'];
                }
        } else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_layout = get_post_meta(wc_get_page_id('shop'), 'footer', true);
                if (!empty($shop_layout) && $shop_layout != 'default') {
                    $result = $shop_layout;
                }
            }
        } else {
            if (is_singular()) {
                $single_layout = get_post_meta(get_the_id(), 'footer', true);
                if (!empty($single_layout) && $single_layout != 'default') {
                    $result = $single_layout;
                }
            } else {
                if (!is_home() && is_front_page()) {
                    $result = $riven_settings['footer-type'];
                } else if (is_home() && !is_front_page()) {
                    $posts_page_id = get_option('page_for_posts');
                    $posts_page_layout = get_post_meta($posts_page_id, 'footer', true);
                    if (!empty($posts_page_layout) && $posts_page_layout != 'default') {
                        $result = $posts_page_layout;
                    }
                }
            }
        }
    $footer_type = $result;
    }
    return $footer_type;
}

//breadcrumbs...
function riven_breadcrumbs() {
    global $post, $wp_query, $author, $riven_settings;

    $prepend = '';
    $before = '<li>';
    $after = '</li>';
    $home = esc_html__('Home', 'riven');

    $shop_page_id = false;
    $shop_page = false;
    $front_page_shop = false;
    if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
        $permalinks   = get_option( 'woocommerce_permalinks' );
        $shop_page_id = wc_get_page_id( 'shop' );
        $shop_page    = get_post( $shop_page_id );
        $front_page_shop = get_option( 'page_on_front' ) == wc_get_page_id( 'shop' );
    }

    // If permalinks contain the shop page in the URI prepend the breadcrumb with shop
    if ( $shop_page_id && $shop_page && strstr( $permalinks['product_base'], '/' . $shop_page->post_name ) && get_option( 'page_on_front' ) != $shop_page_id ) {
        $prepend = $before . '<a href="' . esc_url(get_permalink( $shop_page )) . '">' . $shop_page->post_title . '</a> ' . $after;
    }

    if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && $front_page_shop ) ) || is_paged() ) {
        echo '<ul class="breadcrumb">';

        if ( ! empty( $home ) ) {
            echo $before . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) . '">' . $home . '</a>' . $after;
        }

        if ( is_home() ) {

            echo $before . single_post_title('', false) . $after;

        }
        else if(is_search()){
            echo $before . esc_html__( 'Search results for &ldquo;', 'riven' ) . get_search_query() . '&rdquo;' . $after;
        }
        else if ( is_category()) {

            if ( get_option( 'show_on_front' ) == 'page' ) {
                echo $before . '<a href="' . esc_url(get_permalink( get_option('page_for_posts' ) )) . '">' . get_the_title( get_option('page_for_posts', true) ) . '</a>' . $after;
            }

            $cat_obj = $wp_query->get_queried_object();
            $this_category = get_category( $cat_obj->term_id );

            echo $before . single_cat_title( '', false ) . $after;

        } elseif ( is_tax('product_cat') || is_tax('portfolio_cat')) {

            echo $prepend;

            if ( is_tax('portfolio_cat') ) {
                $post_type = get_post_type_object( 'portfolio' );
                echo $before . '<a href="' . get_post_type_archive_link( 'portfolio' ) . '">' . $post_type->labels->singular_name . '</a>' . $after;
            }
            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

            foreach ( $ancestors as $ancestor ) {
                $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

                echo $before . '<a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '">' . esc_html( $ancestor->name ) . '</a>' . $after;
            }

            echo $before . esc_html( $current_term->name ) . $after;

        } elseif ( is_day() ) {

            echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . $after;
            echo $before . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $after;
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {

            echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after;
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {

            echo $before . get_the_time('Y') . $after;

        } elseif ( is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id ) {

            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }

            if ( is_search() ) {

                echo $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . esc_html__( 'Search results for &ldquo;', 'riven' ) . get_search_query() . '&rdquo;' . $after;

            } elseif ( is_paged() ) {

                echo $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $after;

            } else {

                echo $before . $_name . $after;

            }

        } elseif ( is_single() && ! is_attachment() ) {

            if ( 'product' == get_post_type() ) {

                echo $prepend;

                if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                    $main_term = $terms[0];
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );

                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );

                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo $before . '<a href="' . get_term_link( $ancestor ) . '">' . $ancestor->name . '</a>' . $after;
                        }
                    }

                    echo $before . '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a>' . $after;

                }

                echo $before . get_the_title() . $after;

            } elseif ( 'post' != get_post_type() ) {
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                echo $before . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . $post_type->labels->singular_name . '</a>' . $after;
                echo $before . get_the_title() . $after;

            } else {

                if ( 'post' == get_post_type() && get_option( 'show_on_front' ) == 'page' ) {
                    echo $before . '<a href="' . esc_url(get_permalink( get_option('page_for_posts' ) )) . '">' . get_the_title( get_option('page_for_posts', true) ) . '</a>' . $after;
                }

                $cat = current( get_the_category() );
                if ( ( $parents = get_category_parents( $cat, TRUE, $after . $before ) ) && ! is_wp_error( $parents ) ) {
                    echo $before . substr( $parents, 0, strlen($parents) - strlen($after . $before) ) . $after;
                }
                echo $before . get_the_title() . $after;

            }

        } elseif ( is_404() ) {

            echo $before . esc_html__( 'Error 404', 'riven' ) . $after;

        } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

            $post_type = get_post_type_object( get_post_type() );

            if ( $post_type ) {
                echo $before . $post_type->labels->singular_name . $after;
            }

        } elseif ( is_attachment() ) {

            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID );
            $cat = $cat[0];
            if ( ( $parents = get_category_parents( $cat, TRUE, $after . $before ) ) && ! is_wp_error( $parents ) ) {
                echo $before . substr( $parents, 0, strlen($parents) - strlen($after . $before) ) . $after;
            }
            echo $before . '<a href="' . esc_url(get_permalink( $parent )) . '">' . $parent->post_title . '</a>'. $after;
            echo $before . get_the_title() . $after;

        } elseif ( is_page() && !$post->post_parent ) {

            echo $before . get_the_title() . $after;

        } elseif ( is_page() && $post->post_parent ) {

            $parent_id  = $post->post_parent;
            $breadcrumbs = array();

            while ( $parent_id ) {
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title( $page->ID ) . '</a>';
                $parent_id  = $page->post_parent;
            }

            $breadcrumbs = array_reverse( $breadcrumbs );

            foreach ( $breadcrumbs as $crumb ) {
                echo $before . $crumb . $after;
            }

            echo $before . get_the_title() . $after;

        } elseif ( is_search() ) {

            echo $before . esc_html__( 'Search results for &ldquo;', 'riven' ) . get_search_query() . '&rdquo;' . $after;

        } elseif ( is_tag() ) {

            echo $before . esc_html__( 'Posts tagged &ldquo;', 'riven' ) . single_tag_title('', false) . '&rdquo;' . $after;

        } elseif ( is_author() ) {

            $userdata = get_userdata($author);
            echo $before . esc_html__( 'Author:', 'riven' ) . ' ' . $userdata->display_name . $after;

        }

        if ( get_query_var( 'paged' ) ) {
            echo $before . '&nbsp;(' . esc_html__( 'Page', 'riven' ) . ' ' . get_query_var( 'paged' ) . ')' . $after;
        }

        echo '</ul>';
    } else {
        if ( is_home() && !is_front_page() ) {
            echo '<ul class="breadcrumb">';

            if ( ! empty( $home ) ) {
                echo $before . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) . '">' . $home . '</a>' . $after;

                echo $before . esc_html($riven_settings['blog-title']) . $after;
            }

            echo '</ul>';
        }
    }
}

function riven_page_title() {

    global $riven_settings, $post, $wp_query, $author;

    $home = esc_html__('Home', 'riven');

    $shop_page_id = false;
    $front_page_shop = false;
    if (defined('WOOCOMMERCE_VERSION')) {
        $shop_page_id = wc_get_page_id('shop');
        $front_page_shop = get_option('page_on_front') == wc_get_page_id('shop');
    }

    if ((!is_home() && !is_front_page() && !( is_post_type_archive() && $front_page_shop ) ) || is_paged()) {

        if (is_home()) {
            
        } else if (is_category()) {

            echo single_cat_title('', false);
        }
        elseif (is_search()) {

            echo esc_html__('Search results for &ldquo;', 'riven') . get_search_query() . '&rdquo;';
        } elseif ( is_tax('product_cat')) {

            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            echo esc_html( $current_term->name );

        } elseif (is_tax('product_tag')) {

            $queried_object = $wp_query->get_queried_object();
            echo esc_html__('Products tagged &ldquo;', 'riven') . $queried_object->name . '&rdquo;';
        } elseif (is_day()) {

            printf(esc_html__('Daily Archives: %s', 'riven'), get_the_date());
        } elseif (is_month()) {

            printf(esc_html__('Monthly Archives: %s', 'riven'), get_the_date(_x('F Y', 'monthly archives date format', 'riven')));
        } elseif (is_year()) {

            printf(esc_html__('Yearly Archives: %s', 'riven'), get_the_date(_x('Y', 'yearly archives date format', 'riven')));
        } elseif (is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id) {

            $_name = wc_get_page_id('shop') ? get_the_title(wc_get_page_id('shop')) : '';

            if (!$_name) {
                $product_post_type = get_post_type_object('product');
                $_name = $product_post_type->labels->singular_name;
            }

            if (is_search()) {
                
            } elseif (is_paged()) {
                
            } else {

                echo $_name;
            }
        } else if(is_post_type_archive('portfolio')){
            if(isset($riven_settings['portfolio-title']) && $riven_settings['portfolio-title'] !=""){
                echo force_balance_tags($riven_settings['portfolio-title']);
            }else{
                echo esc_html__( 'Featured Project', 'riven' );
            }
        }
        else if(is_post_type_archive('event')){
                if(isset($riven_settings['event-title']) && $riven_settings['event-title'] !=""){
                    echo force_balance_tags($riven_settings['event-title']);
                }else{
                    echo esc_html__( 'Event', 'riven' );
                }
            }
         else if (is_post_type_archive()) {
            sprintf(esc_html__('Archives: %s', 'riven'), post_type_archive_title('', false));
        } elseif (is_single() && !is_attachment()) {

            if ('casestudy' == get_post_type()) {

                echo esc_html(get_the_title());
            } else {

                echo esc_html(get_the_title());
            }
        } elseif (is_404()) {

            echo esc_html__('Error 404', 'riven');
        } elseif (!is_single() && !is_page() && get_post_type() != 'post') {

            $post_type = get_post_type_object(get_post_type());

            if ($post_type) {
                echo $post_type->labels->singular_name;
            }
        } elseif (is_attachment()) {

            echo esc_html(get_the_title());
        } elseif (is_page() && !$post->post_parent) {

            echo esc_html(get_the_title());
        } elseif (is_page() && $post->post_parent) {

            echo esc_html(get_the_title());
        } elseif (is_search()) {

            echo esc_html__('Search results for &ldquo;', 'riven') . get_search_query() . '&rdquo;';
        } elseif (is_tag()) {

            echo esc_html__('Tag &ldquo;', 'riven') . single_tag_title('', false) . '&rdquo;';
        } elseif (is_author()) {

            $userdata = get_userdata($author);
            echo esc_html__('Author:', 'riven') . ' ' . $userdata->display_name;
        }

        if (get_query_var('paged')) {
            echo ' (' . esc_html__('Page', 'riven') . ' ' . get_query_var('paged') . ')';
        }
    } else {
        if (is_home() && !is_front_page()) {
            if (!empty($home)) {
                echo force_balance_tags($riven_settings['blog-title']);
            }
        }
    }
}
