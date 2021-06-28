<?php

if (!class_exists('ReduxFramework') && file_exists(riven_admin . '/ReduxCore/framework.php')) {
    require_once( riven_admin . '/ReduxCore/framework.php' );
}

require_once( riven_admin . '/settings/settings.php' );
require_once( riven_admin . '/settings/save_settings.php' );

function riven_check_theme_options() {
    // check default options
    global $riven_settings;
    if(!get_option('riven_settings')) {
        ob_start();
        include(riven_plugins . '/importer/data_import/options_data/option_demo_1.php');
        $options = ob_get_clean();
        $riven_default_settings = json_decode($options, true);
        if (is_array($riven_default_settings) || is_object($riven_default_settings))
            {
                foreach ($riven_default_settings as $key => $value) {
                    if (is_array($value)) {
                        foreach ($value as $key1 => $value1) {
                            if (!isset($riven_settings[$key][$key1]) || !$riven_settings[$key][$key1]) {
                                $riven_settings[$key][$key1] = $riven_default_settings[$key][$key1];
                            }
                        }
                    } else {
                        if (!isset($riven_settings[$key])) {
                            $riven_settings[$key] = $riven_default_settings[$key];
                        }
                    }
                }
            }    
    }

    return $riven_settings;
}

if(!class_exists('ReduxFramework')) {
    riven_check_theme_options();
}

function riven_theme_types() {
    return array(
        '1' => esc_html__("Demo 1", 'riven'),
        '2' => esc_html__("Demo 2", 'riven'),
        '3' => esc_html__("Demo 3", 'riven'),
        '4' => esc_html__("Demo 4", 'riven'),
        '5' => esc_html__("Demo 5", 'riven'),
        '6' => esc_html__("Demo 6", 'riven'),
    );
}
//riven block
function riven_block(){
    $block_options = array();
    $args = array(
        'numberposts'       => -1,
        'post_type'         => 'block',
        'post_status'       => 'publish',
    );
    $posts = get_posts($args);
    foreach( $posts as $_post ){
        $block_options[$_post->ID] = $_post->post_title;
    }
    return $block_options;
}
//slider
function riven_list_rev_sliders(){
    if (class_exists('RevSlider')) {
        $theslider     = new RevSlider();
        $arrSliders = $theslider->getArrSliders();
        $arrA     = array();
        $arrT     = array();
        foreach($arrSliders as $slider){
            $arrA[]     = $slider->getAlias();
            $arrT[]     = $slider->getTitle();
        }
        if($arrA && $arrT){
            $result = array_combine($arrA, $arrT);
        }
        else
        {
            $result = false;
        }
        return $result;
    }
}
//product columns
function riven_product_columns() {
    return array(
        "2" => esc_html__("2", 'riven'),
        "3" => esc_html__("3", 'riven'),
        "4" => esc_html__("4", 'riven'),
    );
}
//get theme layout options
function riven_layouts() {
    return array(
        'default' => esc_html__('Default Layout', 'riven'),
        'wide' => esc_html__('Wide', 'riven'),
        'fullwidth' => esc_html__('Full width', 'riven')
    );
}
//get theme sidebar position options
function riven_sidebar_position() {
    return array(
        'default' => esc_html__('Default Position', 'riven'),
        'left-sidebar' => esc_html__('Left', 'riven'),
        'right-sidebar' => esc_html__('Right', 'riven'),
        'none' => esc_html__('None', 'riven')
    );
}

function riven_header_types() {
    return array(
        'default' => esc_html__('Default Header', 'riven'),
        '1' => esc_html__('Header Type 1', 'riven'),
        '2' => esc_html__('Header Type 2', 'riven'),
        '3' => esc_html__('Header Type 3', 'riven'),
        '4' => esc_html__('Header Type 4', 'riven'),
        '5' => esc_html__('Header Type 5', 'riven'),
        '6' => esc_html__('Header Type 6', 'riven'),
    );
}
function riven_footer_types() {
    return array(
        'default' => esc_html__('Default Footer', 'riven'),
        '1' => esc_html__('Footer Type 1', 'riven'),
        '2' => esc_html__('Footer Type 2', 'riven'),
        '3' => esc_html__('Footer Type 3', 'riven'),
        '4' => esc_html__('Footer Type 4', 'riven'),
        '5' => esc_html__('Footer Type 5', 'riven'),
        '6' => esc_html__('Footer Type 6', 'riven'),
    );
}
function riven_register_pages() {
    $block_options = array();
    $archive_pages_args = array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'register.php'
    );

    $archive_pages = get_pages( $archive_pages_args );
    $i =1;
      foreach( $archive_pages as $archive_page ){
        $block_options[$i] = $archive_page->post_title;
        $i++;
    }
    return $block_options;
}
function riven_login_pages() {
    $login_options = array();
    $pages_args = array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'login.php'
    );

    $pages = get_pages( $pages_args );
    $i =1;
      foreach( $pages as $page ){
        $login_options[$i] = $page->post_title;
        $i++;
    }
    return $login_options;
}
