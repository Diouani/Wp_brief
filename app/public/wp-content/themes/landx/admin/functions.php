<?php
require THEMEDIR . 'admin/google-web-fonts.php';
require THEMEDIR . 'admin/icon-picker/icon-picker.php';
require THEMEDIR . 'admin/scripts.php';
require THEMEDIR . 'admin/mce-button.php';
require THEMEDIR . 'admin/meta-boxes.php';
require THEMEDIR . 'admin/onepage-meta-boxes.php';
require THEMEDIR . 'admin/squzee-meta-boxes.php';
include THEMEDIR.'admin/vc-extends.php';
include THEMEDIR.'admin/class.wpcf7-config.php';
include THEMEDIR.'admin/demo-data.php';


function landx_login_logo() { 
	$logo = (function_exists('ot_get_option'))? ot_get_option('admin_logo') : THEMEURI.'images/logo-dark.png';
	
    echo '<style type="text/css">
        body.login div#login h1 a {
            background-image: url('.esc_url($logo).');
            background-position: bottom center; 
        }
    </style>';
 }
add_action( 'login_enqueue_scripts', 'landx_login_logo' );

function landx_options_filter($var){
    $var = (is_array($var) && ($var['type'] == 'background') || ($var['type'] == 'measurement') || ($var['type'] == 'typography')|| ($var['type'] == 'colorpicker'));

     return $var;
}


function landx_dynamic_css(){
    $settings = landx_theme_options();
    $options = array_filter($settings, "landx_options_filter");
    foreach ($options as $option) :
        if(isset($option['action'])){
            if( $option['type'] == 'background' ):
                $background = ot_get_option( $option['id'] );
                $background = (empty($background)) ? $option['std'] : $background;
                if( !empty($background) ):
                    foreach ($option['action'] as $value) {
                        if($value['selector'] != ''){
                            echo $value['selector']. '{ ';
                            foreach( $background as $key => $value ){
                                if($key == 'background-image') echo ($value != '')? $key. ': url('.esc_url($value).'); ' : '';
                                else echo ($value != '')? $key. ': '.$value.'; ' : '';
                            }
                            echo '}';
                        }
                         ?>

<?php
                    }
                endif;
            elseif( $option['type'] == 'typography' ):
                $typography = ot_get_option( $option['id'], array() );        
                $typography = empty($typography) ? $option['std'] : $typography;
                if(!empty($typography)) :
                    foreach ($option['action'] as $value) {  
                        if($value['selector'] != ''){
                            echo $value['selector']. '{ ';
                            foreach ($typography as $key => $value) {

                                if( $key == 'font-color' ) echo 'color: '.$value.'; ';
                                elseif( $key == 'font-family' ){
                                    if($value != ''){
                                        $ot_set_google_fonts  = get_theme_mod( 'ot_google_fonts', array() );
                                        $family = $ot_set_google_fonts[$value]['family'];
                                        echo 'font-family: "'.$family.'"; ';
                                    }
                                    
                                } 
                                else echo ( $value != '' )? $key. ': '.$value.'; ' : '';
                            }
                            echo ' }';
                        }
                    }
                    ?>

<?php           
                endif;
            elseif( $option[ 'type' ] == 'colorpicker' ):   
                $colorpicker = ot_get_option( $option['id'] );  

                $colorpicker = ($colorpicker == '') ? $option['std'] : $colorpicker;

                $rgb = hex2rgb($colorpicker);

                if( $colorpicker != '' ):
                    foreach ($option['action'] as $value) {
                        $colorpicker = isset($value['opacity'])? 'rgba('.$rgb.', '.$value['opacity'].')' : $colorpicker;
                        echo ($value['selector'] != '')?$value['selector']. '{ '.$value['property'].': '.$colorpicker .'; } ' : '';
                    }           
                    ?>

<?php           
                 endif;
            elseif( $option[ 'type' ] == 'measurement' ):  
                $measurement =  ot_get_option( $option['id'], array() ); 
                $measurement = empty($measurement) ? $option['std'] : $measurement; 
                if( !empty( $measurement ) ) :
                    foreach ($option['action'] as $value) {  
                        if($value['selector'] != ''){
                            echo $value['selector']. '{ ';
                            echo $value['property'].': '.intval($measurement[0]).$measurement[1] .';';
                            echo ' }';
                        }
                    }
                    ?>

<?php           
                endif;
            endif;
        }//if(isset($option['action'])):
    endforeach;
}

function landx_get_slug($id = null) {
   $post_data = get_post($id, ARRAY_A);
   $slug = $post_data['post_name'];
   return $slug;
}

function landx_animation_select(){
    return array(
        array(
            'value'       => '',
            'label'       => __( 'Select a animation', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation bounce',
            'label'       => __( 'bounce', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation flash',
            'label'       => __( 'flash', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation rubberBand',
            'label'       => __( 'rubberBand', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation shake',
            'label'       => __( 'shake', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation swing',
            'label'       => __( 'swing', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation tada',
            'label'       => __( 'tada', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation wobble',
            'label'       => __( 'wobble', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation bounceIn',
            'label'       => __( 'bounceIn', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation bounceInDown',
            'label'       => __( 'bounceInDown', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation bounceInLeft',
            'label'       => __( 'bounceInLeft', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation bounceInRight',
            'label'       => __( 'bounceInRight', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation bounceInRight',
            'label'       => __( 'bounceInRight', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation bounceInUp',
            'label'       => __( 'bounceInUp', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation fadeIn',
            'label'       => __( 'fadeIn', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation fadeInDown',
            'label'       => __( 'fadeInDown', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation fadeInDownBig',
            'label'       => __( 'fadeInDownBig', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation fadeInLeft',
            'label'       => __( 'fadeInLeft', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation fadeInLeftBig',
            'label'       => __( 'fadeInLeftBig', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation fadeInRight',
            'label'       => __( 'fadeInRight', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation fadeInRightBig',
            'label'       => __( 'fadeInRightBig', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation fadeInUp',
            'label'       => __( 'fadeInUp', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation fadeInUpBig',
            'label'       => __( 'fadeInUpBig', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation flip',
            'label'       => __( 'flip', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation flipInX',
            'label'       => __( 'flipInX', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation flipInY',
            'label'       => __( 'flipInY', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation rotateIn',
            'label'       => __( 'rotateIn', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation rotateInDownLeft',
            'label'       => __( 'rotateInDownLeft', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation rotateInDownRight',
            'label'       => __( 'rotateInDownRight', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation rotateInUpLeft',
            'label'       => __( 'rotateInUpLeft', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation rotateInUpRight',
            'label'       => __( 'rotateInUpRight', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation zoomIn',
            'label'       => __( 'zoomIn', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation zoomInDown',
            'label'       => __( 'zoomInDown', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation zoomInLeft',
            'label'       => __( 'zoomInLeft', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation zoomInRight',
            'label'       => __( 'zoomInRight', THEMENAME ),
            'src'         => ''
        ),
        array(
            'value'       => ' animation zoomInUp',
            'label'       => __( 'zoomInUp', THEMENAME ),
            'src'         => ''
        ),
    );
}

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   $rgb_color = implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
   return $rgb_color;
}
// Add Toolbar Menus
function landx_themeperch_toolbar() {
    global $wp_admin_bar;

    $args = array(
        'id'     => 'themeperch',
        'parent' => '',
        'title'  => __( THEMENAME.' '.THEMEVERSION, 'landx' ),
        'href'   => 'http://themeforest.net/item/landx-multipurpose-wordpress-landing-page/9545842?ref=themeperch',
    );
    $wp_admin_bar->add_menu( $args );

    $args = array(
        'id'     => 'forum',
        'parent' => 'themeperch',
        'title'  => __( 'Forum support', 'landx' ),
        'href'   => 'http://www.themeperch.net/forums',
        'target' => '_blank'
    );
    $wp_admin_bar->add_menu( $args );

    $args = array(
        'id'     => 'portfolio',
        'parent' => 'themeperch',
        'title'  => __( 'Envato Portfolio', 'landx' ),
        'href'   => 'http://themeforest.net/user/themeperch/portfolio?ref=themeperch',
        'target' => '_blank'
    );
    $wp_admin_bar->add_menu( $args );

}

// Hook into the 'wp_before_admin_bar_render' action
add_action( 'wp_before_admin_bar_render', 'landx_themeperch_toolbar', 999 );

/* filter theme option header */
function landx_header_version_text($output){
  return THEMENAME.' <small>vs</small> '.THEMEVERSION;
}
add_filter('ot_header_version_text', 'landx_header_version_text');

function landx_post_thumbnail( $size = 'thumbnail' ) {
    global $post;
    $postid = $post->ID;
    echo landx_get_post_thumbnail( $postid, $size );
}

function landx_get_post_thumbnail( $postid, $size = 'thumbnail' ) {
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'full' );
    $sizearr         = landx_get_image_size( $size );
    return '<img src="' . landx_image_resize( $large_image_url[ 0 ], $sizearr[ 'width' ], $sizearr[ 'height' ] ) . '" alt="' . get_the_title( $postid ) . '">';
}

/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function landx_get_image_sizes() {
    global $_wp_additional_image_sizes;
    
    $sizes = array();
    
    foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array(
             'thumbnail',
            'medium',
            'medium_large',
            'large' 
        ) ) ) {
            $sizes[ $_size ][ 'width' ]  = get_option( "{$_size}_size_w" );
            $sizes[ $_size ][ 'height' ] = get_option( "{$_size}_size_h" );
            $sizes[ $_size ][ 'crop' ]   = (bool) get_option( "{$_size}_crop" );
        } //in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) )
        elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array(
                 'width' => $_wp_additional_image_sizes[ $_size ][ 'width' ],
                'height' => $_wp_additional_image_sizes[ $_size ][ 'height' ],
                'crop' => $_wp_additional_image_sizes[ $_size ][ 'crop' ] 
            );
        } //isset( $_wp_additional_image_sizes[ $_size ] )
    } //get_intermediate_image_sizes() as $_size
    
    return $sizes;
}
/**
 * Filter callback to add image sizes to Media Uploader
 */
function landx_display_image_size_names_muploader( $sizes ) {
    
    $new_sizes = array();
    
    $added_sizes = get_intermediate_image_sizes();
    
    // $added_sizes is an indexed array, therefore need to convert it
    // to associative array, using $value for $key and $value
    foreach( $added_sizes as $key => $value) {
        $new_sizes[$value] = $value;
    }
    
    // This preserves the labels in $sizes, and merges the two arrays
    $new_sizes = array_merge( $new_sizes, $sizes );
    
    return $new_sizes;
}
add_filter('image_size_names_choose', 'landx_display_image_size_names_muploader', 11, 1);
/**
 * Get size information for a specific image size.
 *
 * @uses   landx_get_image_sizes()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|array $size Size data about an image size or false if the size doesn't exist.
 */
function landx_get_image_size( $size ) {
    $sizes = landx_get_image_sizes();
    
    if ( isset( $sizes[ $size ] ) ) {
        return $sizes[ $size ];
    } //isset( $sizes[ $size ] )
    
    return false;
}

/**
 * Get the width of a specific image size.
 *
 * @uses   landx_get_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Width of an image size or false if the size doesn't exist.
 */
function landx_get_image_width( $size ) {
    if ( !$size = landx_get_image_size( $size ) ) {
        return false;
    } //!$size = landx_get_image_size( $size )
    
    if ( isset( $size[ 'width' ] ) ) {
        return $size[ 'width' ];
    } //isset( $size[ 'width' ] )
    
    return false;
}

/**
 * Get the height of a specific image size.
 *
 * @uses   get_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Height of an image size or false if the size doesn't exist.
 */
function landx_get_image_height( $size ) {
    if ( !$size = landx_get_image_size( $size ) ) {
        return false;
    } //!$size = landx_get_image_size( $size )
    
    if ( isset( $size[ 'height' ] ) ) {
        return $size[ 'height' ];
    } //isset( $size[ 'height' ] )
    
    return false;
}

function landx_button_groups_param(){
  return array(             
        landx_vc_icon_set('fontawesome', 'icon_landx', 'fa fa-long-arrow-right'  ), 
          array(
          'type' => 'dropdown',
          'heading' => __('Icon position', 'landx'),
          'param_name' => 'icon_position',
          'std' => 'icon_position-right',
          'value' =>  array(                
                'Left' => 'icon-position-left',
                'Right' => 'icon-position-right',
              ),
        ),
              array(
                  'type' => 'dropdown',
                  'heading' => __('Icon size', 'landx'),
                  'param_name' => 'icon-size',
                  'std' => 'icon-size-m',
                  'value' =>  array(
                        'Default' => '',
                        'Extra Small' => 'icon-size-xs',
                        'Small' => 'icon-size-sm',    
                        'Medium' => 'icon-size-m',    
                        'Large' => 'icon-size-l',    
                        'Extra large' => 'icon-size-xl',    
                      ),
                ),
            array(
                  'type' => 'textfield',
                  'value' => 'Purchase now',
                  'heading' => 'Button text',
                  'param_name' => 'button_text',   
                  'admin_label' => true,                    
              ),
              array(
                  'type' => 'textfield',
                  'value' => '#',
                  'heading' => 'Button URL',
                  'param_name' => 'button_url',   
                  'admin_label' => true,                    
              ),  
              array(
                'type' => 'dropdown',
                'heading' => __('Button target', 'landx'),
                'param_name' => 'button_target',
                'value' =>  array(
                      'Open link in a self tab' => '_self',
                      'Open link in a new tab' => '_blank',
                    ),
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Button style', 'landx'),
                'param_name' => 'button_style',
                'std' => 'btn-primary',
                'value' =>  array(
                      'Default' => 'btn-default',
                      'Primary' => 'btn-primary',
                      'Link' => 'btn-link',
                    ),
              ),
              array(
                'type' => 'dropdown',
                'std' => 'btn-normal',
                'value' =>  array(
                    'Extra Large' => 'btn-xl',
                    'Large' => 'btn-lg',
                    'Small' => 'btn-sm',
                    'Extra Small' => 'btn-xs',
                    'Normal' => 'btn-normal',
                  ),               
                'heading' => 'Button size',
                'param_name' => 'button_size',
            ),

                 
          );
}

function landx_get_button_groups($buttons = array()){
  if ( empty( $buttons ) )
    return;
  
  $output = '';
  foreach ($buttons as $key => $value) :

    extract( shortcode_atts( array(     
      'button_text' => 'Button text',
      'button_url' => '#',
      'button_target' => '_self',
      'button_style' => 'btn-default',
      'button_size' => '',
      'icon_landx' => '',
      'icon_position' => 'icon-position-left',
      'icon_size' => '',
    ), $value ) );
    
    $iconClass = array();
    $iconClass[] = $icon_landx;
    $iconClass[] = $icon_position;
    $iconClass[] = $icon_size;
    $iconClass = array_filter($iconClass);

    $buttonClass = array('btn', 'smooth');
    $buttonClass[] = $button_style;
    $buttonClass[] = $button_size;
    $buttonClass = array_filter($buttonClass);

    $buttonAttr = array();
    $buttonAttr['target'] =  $button_target;
    $buttonAttr['href'] =  esc_url($button_url);
    $buttonAttr['title'] =  esc_attr($button_text);
    $buttonAttr['class'] =  implode(' ', $buttonClass);

    $attr = '';
    foreach ($buttonAttr as $key => $value) {
      $attr .= ' '.$key.'="'.$value.'"';
    }

    $icon = '';
    if( $icon_landx != '' ){
      $icon = '<i class="'.implode(' ', $iconClass).'"></i>';
    }

    $output .= '<a'.$attr.'>';
    $output .= ($icon_position == 'icon-position-left')? $icon : '';
    $output .= '<span class="spr-option-textedit-link">'.landx_parse_text( $button_text, array('tag' => 'strong') ).'</span>';
    $output .= ($icon_position == 'icon-position-right')? $icon : '';
    $output .= '</a>';

  endforeach;

  
  
  return $output;

}


