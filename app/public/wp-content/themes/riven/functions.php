<?php
$theme = wp_get_theme();
define('riven_version', $theme->get('Version'));
define('riven_lib', get_template_directory() . '/inc');
define('riven_admin', riven_lib . '/admin');
define('riven_plugins', riven_lib . '/plugins');
define('riven_functions', riven_lib . '/functions');
define('riven_metaboxes', riven_functions . '/metaboxes');
define('riven_css', get_template_directory_uri() . '/css');
define('riven_js', get_template_directory_uri() . '/js');

require_once(riven_admin . '/functions.php');
require_once(riven_metaboxes . '/functions.php');
require_once(riven_functions . '/functions.php');
require_once(riven_plugins . '/functions.php');
// Set up the content width value based on the theme's design and stylesheet.
if (!isset($content_width)) {
    $content_width = 1140;
}
if (!function_exists('riven_setup')) {

    function riven_setup() {

        load_theme_textdomain('riven', get_template_directory() . '/languages');
        add_editor_style(array('styles.css'));
        add_theme_support( 'post-formats', array('image', 'video', 'audio', 'quote', 'link', 'gallery',
        ) );
        add_theme_support('automatic-feed-links');
        register_nav_menus( array(
            'menu_primary' => esc_html__('Menu Primary', 'riven'),
            'menu_startup' => esc_html__('One Page Startup', 'riven'),
            'menu_applanding' => esc_html__('One Page Applanding', 'riven'),
            'menu_gamelanding' => esc_html__('One page Gamelanding', 'riven'),
            'menu_single_product' => esc_html__('One page Home Single Product', 'riven'),
        ));

        // This theme uses a custom image size for featured images, displayed on "standard" posts.
        add_theme_support( 'title-tag' ); 
        add_theme_support( 'post-thumbnails' );
        add_image_size('riven-event', 456, 215, true);
        add_image_size('riven-post_medium', 262, 160, true);
        add_image_size('riven-blog-list', 600, 600, true);
        add_image_size('riven-blog-list-2', 360, 214, true);
        add_image_size('riven-blog-single', 900, 600, true);
        add_image_size('riven-blog-sticky', 555, 450, true);
        add_image_size('riven-blog-sticky-small', 164, 116, true);
        add_image_size('riven-portfolio-grid', 600, 600, true);
        add_image_size('riven-single-portfolio', 556, 556, true);
    }

}
add_action('after_setup_theme', 'riven_setup');

/**
 * Inclued css, js
 */
add_action('wp_enqueue_scripts', 'riven_scripts_styles', 1000);
add_action('wp_enqueue_scripts', 'riven_scripts_js', 1000);
add_action('admin_enqueue_scripts', 'riven_admin_scripts_css', 1000);
add_action('admin_enqueue_scripts', 'riven_admin_scripts_js', 1000);
function riven_admin_scripts_css() {
    wp_enqueue_style('riven_admin_css', riven_css . '/admin.css', false);
};
function riven_admin_scripts_js() {
    wp_register_script('riven_admin_js', riven_js . '/un-minify/admin.js', array('common', 'jquery', 'media-upload', 'thickbox'), riven_version, true);
    wp_enqueue_script('riven_admin_js');
}
function riven_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';
     /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Lato font: on or off', 'riven' ) ) {
        $fonts[] = 'Lato:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic,900,900italic';
    }

    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $fonts ) ),
            'subset' => urlencode( $subsets ),
        ), 'https://fonts.googleapis.com/css' );
    }

    return $fonts_url;
}
function riven_scripts_styles() {
    wp_enqueue_style( 'riven-fonts', riven_fonts_url(), array(), null );
    //load font icon
    wp_enqueue_style('riven-font', get_template_directory_uri() . '/css/pe-icon/pe-icon-7-stroke.css?ver=' . riven_version);
    //Load plugins css
    wp_enqueue_style('riven-plugins', get_template_directory_uri() . '/css/plugins.css?ver=' . riven_version);
    //Load theme css
    wp_enqueue_style('riven-theme', get_template_directory_uri() . '/css/theme.css?ver=' . riven_version);
    //Load reponsive css
    wp_enqueue_style('riven-reponsive', get_template_directory_uri() . '/css/responsive.css?ver=' . riven_version);
    // Load skin stylesheet
    if(is_page()){
        global $post;
        if(get_post_meta($post->ID, 'special_skin', true) == 'special_skin' && get_post_meta($post->ID,'skin',true)){
            $riven_skin = get_post_meta($post->ID,'skin',true);
            wp_enqueue_style('riven-skin-color', get_template_directory_uri() . '/css/color/'. $riven_skin .'.css?ver=' . riven_version); 
        }else{
            wp_enqueue_style('riven-skin-color', get_template_directory_uri() . '/css/config/skin.css?ver=' . riven_version);
        }
    }else{
        wp_enqueue_style('riven-skin-color', get_template_directory_uri() . '/css/config/skin.css?ver=' . riven_version);
    }
    // Load skin theme css
    wp_enqueue_style('riven-skin-theme', get_template_directory_uri() . '/css/config/skin-theme.css?ver=' . riven_version);
    // Loads our main stylesheet.
    wp_enqueue_style('riven-style', get_stylesheet_uri());
}
//Disable all woocommerce styles
add_filter('woocommerce_enqueue_styles', '__return_false');
function riven_scripts_js() {
    global $riven_settings;
    if (!is_admin() && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) )) {
        wp_reset_postdata();
        // comment reply
        if ( is_singular() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
        // load visual composer default js
        if (!wp_script_is('wpb_composer_front_js')) {
            wp_enqueue_script('wpb_composer_front_js');
        }
        // load ultimate addons default js
        $bsf_options = get_option('bsf_options');
        $ultimate_global_scripts = (isset($bsf_options['ultimate_global_scripts'])) ? $bsf_options['ultimate_global_scripts'] : false;
        if ($ultimate_global_scripts !== 'enable') {
            $isAjax = false;
            $ultimate_ajax_theme = get_option('ultimate_ajax_theme');
            if ($ultimate_ajax_theme == 'enable')
                $isAjax = true;
            $ultimate_js = get_option('ultimate_js', 'disable');
            $bsf_dev_mode = (isset($bsf_options['dev_mode'])) ? $bsf_options['dev_mode'] : false;
            if (($ultimate_js == 'enable' || $isAjax == true) && ($bsf_dev_mode != 'enable') ) {
                if (!wp_script_is('ultimate-script')) {
                    wp_enqueue_script('ultimate-script');
                }
            }
        }
        //custom vc parallax
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), riven_version);
        wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), riven_version, true);
        wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), riven_version, true);
        wp_enqueue_script('scrollreveal', get_template_directory_uri() . '/js/un-minify/scrollReveal.js', array(), riven_version, true);
        wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), riven_version, true);
        wp_enqueue_script('cascade-slider', get_template_directory_uri() . '/js/un-minify/cascade-slider.js', array(), riven_version, true);
        wp_enqueue_script('nouislider', get_template_directory_uri() . '/js/nouislider.min.js', array(), riven_version);
        wp_enqueue_script('validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), riven_version, true);
        wp_enqueue_script('fancybox', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array('jquery'), riven_version, true);
        wp_enqueue_script('scrollbar', get_template_directory_uri() . '/js/jquery.scrollbar.min.js', array('jquery'), riven_version, true);
        wp_enqueue_script('riven-script', get_template_directory_uri() . '/js/un-minify/functions.js', array('jquery'), riven_version, true);
        wp_localize_script('riven-script', 'riven_params', array(
            'ajax_url' => esc_js(admin_url( 'admin-ajax.php' )),
            'ajax_loader_url' => esc_js(str_replace(array('http:', 'https'), array('', ''), riven_css . '/images/ajax-loader.gif')),
            'header_sticky' => esc_js($riven_settings['header-sticky']),
            'ajax_cart_added_msg' => esc_html__('A product has been added to cart.', 'riven'),
        ));
    }    
}
/* redirect users to front page after login */
function riven_redirect_to_front_page() {
    global $redirect_to;
    if (!isset($_GET['redirect_to'])) {
        $redirect_to = get_option('siteurl');
    }
}
add_action('login_form', 'riven_redirect_to_front_page');
/*Defer parsing of JavaScript
if (!(is_admin() )) {
    function riven_defer_parsing_of_js ( $url ) {
        if ( FALSE === strpos( $url, '.js' ) ) return $url;
        if ( strpos( $url, 'jquery.min.js' ) ) return $url;
        if ( strpos( $url, 'jquery.js' ) ) return $url;
        // return "$url' defer ";
        return "$url' defer onload='";
    }
    add_filter( 'clean_url', 'riven_defer_parsing_of_js', 11, 1 );
}
*/