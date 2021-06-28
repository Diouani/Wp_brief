<?php
/**
 * Enqueue scripts and styles for the front end.
 *
 */
function landx_scripts() {
	// Add Lato font, used in the main stylesheet.
	$font_url = landx_get_font_url();
	if ( ! empty( $font_url ) )
	wp_enqueue_style( 'landx-fonts', esc_url_raw( $font_url ), false, THEMEVERSION );
	wp_enqueue_style( 'bootstrap', LANDX_URI .'/css/bootstrap.min.css', false, THEMEVERSION );
	wp_enqueue_style( 'selectize-bootstrap3', THEMEURI. 'css/selectize.bootstrap3.css', false, '0.12.1' );
	wp_enqueue_style( 'linearicons', LANDX_URI .'/fonts/linearicons/style.css', false, '1.0' );
	wp_enqueue_style( 'genericons', LANDX_URI .'/fonts/genericons/genericons.css', false, '3.2' );
	wp_enqueue_style( 'ionicons', LANDX_URI .'/fonts/ionicons-2.0.1/css/ionicons.min.css', false, '3.2' );
	wp_enqueue_style( 'font-awesome', LANDX_URI .'/fonts/font-awesome/css/font-awesome.min.css', false, '3.2' );
	wp_enqueue_style( 'elegant-icon-style', LANDX_URI .'/assets/elegant-icons/style.css', false, null );
	wp_enqueue_style( 'landx-blue', LANDX_URI .'/css/colors/blue.css', false, null );
	wp_enqueue_style( 'vc_font_awesome_5');
	

	

	wp_enqueue_style( 'landx-blog', LANDX_URI .'/css/blog.css', false, THEMEVERSION );
	wp_enqueue_style( 'landx-owl-theme', LANDX_URI .'/css/owl.theme.css', false, null );
	wp_enqueue_style( 'landx-carousel-owl', LANDX_URI .'/css/owl.carousel.css', false, null );
	wp_enqueue_style( 'landx-nivo-lightbox', LANDX_URI .'/css/nivo-lightbox.css', false, null );
	wp_enqueue_style( 'landx-default', LANDX_URI .'/css/nivo_themes/default/default.css', false, null );
	wp_enqueue_style( 'landx-animate', LANDX_URI .'/css/animate.css', false, null );
	
	if( function_exists('is_woocommerce') ){
		wp_dequeue_style( 'woocommerce-general' );
    	wp_register_style( 'landx-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', false, THEMEVERSION );
    	wp_enqueue_style( 'landx-woocommerce' );
	}
	wp_register_style( 'jquery-ui-datepicker-style' , get_template_directory_uri() . '/css/jquery-datepicker.css');
	

	// Load our main stylesheet.
	wp_enqueue_style( 'landx-style', LANDX_URI. '/style.css', false, THEMEVERSION );
	wp_enqueue_style( 'landx-responsive', LANDX_URI .'/css/responsive.css', array( 'landx-style' ), THEMEVERSION );
	wp_enqueue_style( 'landx-css',  LANDX_URI .'/css/styles.css', array( 'landx-style' ), THEMEVERSION );


	//scripts
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	wp_enqueue_script( 'jquery' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_register_script( 'landx-ajaxchimp', LANDX_URI .'/js/jquery.ajaxchimp.js', array( 'jquery' ), '', false );
	wp_register_script( 'landx-ajaxchimplangs', LANDX_URI .'/js/jquery.ajaxchimp.langs.js', array( 'jquery', 'landx-ajaxchimp' ), '', false );
	wp_localize_script( 'landx-ajaxchimp', 'landx', 
		array(
			'mailchimp_post_url' => esc_url(ot_get_option('mailchimp_post_url')), 
			'themeuri' => THEMEURI, 'ajax_url' => admin_url( 'admin-ajax.php' )) 
		);
	wp_enqueue_script('landx-ajaxchimplangs');


	// Adds JavaScript.
	wp_register_style( 'landx-vegas', LANDX_URI .'/css/vegas.css', array(), null );
    wp_register_script( 'landx-vegas', LANDX_URI .'/js/vegas.min.js', array( 'jquery' ), '1.0', true );
     wp_enqueue_script('landx-vegas');
    wp_enqueue_style('landx-vegas');
	wp_enqueue_script( 'landx-bootstrap', LANDX_URI .'/js/bootstrap.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'selectize', LANDX_URI .'/js/selectize.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'vidbg', LANDX_URI .'/js/vidbg.min.js', array( 'jquery' ), '', true );
	
	
	wp_enqueue_script( 'landx-scrollTo', LANDX_URI .'/js/jquery.scrollTo.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'landx-parallax', LANDX_URI .'//js/parallax.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'landx-localScroll', LANDX_URI .'/js/jquery.localscroll-1.2.7-min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'landx-carousel', LANDX_URI .'/js/owl.carousel.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'landx-nivo-lightbox', LANDX_URI .'/js/nivo-lightbox.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'landx-simple-expand', LANDX_URI .'/js/simple-expand.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'landx-jquery.nav', LANDX_URI .'/js/jquery.nav.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'landx-fitvids', LANDX_URI .'/js/jquery.fitvids.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'landx-equalheights', LANDX_URI .'/js/jquery.equalheights.min.js', array( 'jquery' ), '', true );


	
	wp_enqueue_script( 'landx-visible', LANDX_URI .'/js/jquery.visible.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'landx-custom', LANDX_URI .'/js/custom.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker' ), THEMEVERSION, true );
	
}
add_action( 'wp_enqueue_scripts', 'landx_scripts' );

function landx_dynamic_style_load_to_header(){	
	if( function_exists('ot_get_option') ){
		load_template( THEMEDIR . '/inc/style.php' );
		echo ot_get_option('google_analytic_code');
		echo '<style>'.ot_get_option('custom_css').'</style>';
		
	}	

	
}
add_action( 'wp_head', 'landx_dynamic_style_load_to_header' );

function landx_dynamic_style_load_to_footer(){	
	if( function_exists('ot_get_option') ){
		echo ot_get_option( 'footer_scripts' );
	}	

	//wp_enqueue_script( 'landx-retina', LANDX_URI .'/js/retina-1.1.0.min.js', array( 'jquery' ), '3.1.5', true );
	
}
add_action( 'wp_footer', 'landx_dynamic_style_load_to_footer' );

function print_landx_inline_script() {
	$background_type = get_post_meta(get_the_ID(), 'onepage_header_style', true);
	if( $background_type == 'image_slider' ){
                  
    	$attachments = get_post_meta(get_the_ID(), 'onepage_image_slider', true);
    	$arr = explode(',', $attachments);
    	if( !empty($arr) ):
    		wp_enqueue_style( 'landx-vegas', LANDX_URI .'/css/vegas.css', array(), null );
    		wp_enqueue_script( 'landx-vegas', LANDX_URI .'//js/vegas.min.js', array( 'jquery' ), '1.0', true );
  			?>
			<script type="text/javascript">
				jQuery( function() {
					jQuery('header, body').vegas({
     
						slides:[
							<?php 
								foreach( $arr as $id ){
									$image_attributes = wp_get_attachment_image_src( $id, 'full' ); 
									echo ($image_attributes[0] != '')? "{ src:'".$image_attributes[0]."', fade:1500 }," : "";
								}
							 ?>							
						],
						loading:false
					})
				});
			</script>
			<style>.landx-onepage header{background-image:none; position: relative; z-index: 9999;}</style>
			<?php 
		endif;
  	}
}
add_action( 'wp_footer', 'print_landx_inline_script' );

/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 */
function landx_inline_color_scheme_css() {  
    wp_add_inline_style( 'landx-style', landx_dynamic_color_options_css() );  
}
add_action( 'wp_enqueue_scripts', 'landx_inline_color_scheme_css' );