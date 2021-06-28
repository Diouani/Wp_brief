<?php
function landx_get_page_sections_info(){
    global $wpdb;
    $output = '';
    if(!isset($_GET['post'])) return $output;
    if(null === $_GET['post']) return $output;
    $section = get_post_meta($_GET['post'], 'pages', true);
    if(empty($section)) return $output;

    $output .= '<ul class="option-tree-setting-wrap landx-section-content-edit">';
    foreach ($section as $key => $value) {
        if($value['page_id'] != '')
            $output .= '<li class="list-list-item"><div class="option-tree-setting"><a target="_blank" href="'.get_edit_post_link( $value['page_id'] ).'"><span class="icon ot-icon-pencil"></span> Edit page</a><span class="slug">#'.landx_get_slug($value['page_id']).'</span></div></li>';
        else
            $output .= '<li class="list-list-item"><div class="option-tree-setting"><span style="color:#a00">Section page is not selected !!!</span></div></li>';
    }
    $output .= '</ul>';

    return $output;
}
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'landx_onepage_meta_boxes' );

function landx_onepage_meta_boxes() {

  if( function_exists( 'ot_get_option' ) ): 

  $my_meta_box = array(
    'id'        => 'landx_onepage_meta_box',
    'title'     => 'Landx One-page Template Settings',
    'desc'      => 'This option only applicable when you select one page Template',
    'pages'     => array( 'page' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'onepage_general_settings',
        'label'       => 'General settings',      
        'type'        => 'tab',
        'operator'    => 'and'
      ),  
      array(
        'id'          => 'onepage_preloader',
        'label'       => __( 'Preloader', THEMENAME ),
        'desc'        => '',
        'std'         => THEMEURI . 'admin/assets/images/loading.gif',
        'type'        => 'upload',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
        )
        
      ), 
      array(
        'id'          => 'nav_display_type',
        'label'       => __( 'Navigation display in header', THEMENAME ),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        
      ),
      array(
        'id'          => 'home_link',
        'label'       => __( 'Home link', THEMENAME ),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        
      ), 
      array(
        'id'          => 'home_text',
        'label'       => __( 'Home Text', THEMENAME ),
        'desc'        => '',
        'std'         => 'Home',
        'type'        => 'text',
        'class'       => '',
        'condition'   => 'home_link:is(on)',
        'operator'    => 'and',
        
      ),       
      array(
        'id'          => 'header_logo_display',
        'label'       => __( 'Header logo display', THEMENAME ),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        
      ), 
      array(
        'id'          => 'header_logo',
        'label'       => __( 'Header logo', THEMENAME ),
        'desc'        => '',
        'std'         => THEMEURI. '/images/logo.png',
        'type'        => 'upload',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'header_logo_display:is(on)',
        'operator'    => 'and',
        
      ),
      array(
        'id'          => 'social_button_display',
        'label'       => __( 'Social link display', THEMENAME ),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        
      ), 
      array(
            'id'          => 'nav_control',
            'label'       => 'Navigation Control From',
            'desc'        => '',
            'std'         => 'section',
            'type'        => 'select',
            'class'       => '',
            'rows'        => '',
            'choices'     => array(
                    array(
                        'value'       => 'section',
                        'label'       => 'Section settings(recomended)',
                        'src'         => ''
                      ),
                      array(
                        'value'       => 'wp_nav',
                        'label'       => 'Wordpress default nav menu(New)',
                        'src'         => ''
                      ),                      
                ),
            'operator'    => 'and',
            'condition'   => ''
          ),
      array(
            'id'          => 'nav_control_section',
            'label'       => '',
            'desc'        => 'Nav menu item come from section settings. Sub-menu is not support in section settings.',
            'type'        => 'Textblock',
            'operator'    => 'and',
            'condition'   => 'nav_control:is(section)'
          ),
      array(
            'id'          => 'one_page_wp_nav',
            'label'       => 'Select onepage nav menu',
            'desc'        => '',
            'std'         => '',
            'type'        => 'taxonomy-select',
            'taxonomy'   => 'nav_menu',
            'class'       => '',
            'rows'        => '',            
            'operator'    => 'and',
            'condition'   => 'nav_control:is(wp_nav)'
          ),
      array(
        'id'          => 'onepage_header_settings',
        'label'       => 'Header settings',      
        'type'        => 'tab',
        'operator'    => 'and'
      ), 
     array(
            'id'          => 'onepage_header_style',
            'label'       => 'Header style',
            'desc'        => '',
            'std'         => 'dark',
            'type'        => 'select',
            'class'       => '',
            'rows'        => '',
            'choices'     => array(
                    array(
                        'value'       => 'image',
                        'label'       => 'Image',
                        'src'         => ''
                      ),
                      array(
                        'value'       => 'image_slider',
                        'label'       => 'Images Slider',
                        'src'         => ''
                      ),
                      array(
                        'value'       => 'video',
                        'label'       => 'HTML5 video',
                        'src'         => ''
                      ),
                      array(
                        'value'       => 'shortcode',
                        'label'       => 'Custom shortcode',
                        'src'         => ''
                      )
                ),
            'operator'    => 'and',
            'condition'   => ''
          ),
          array(
            'id'          => 'onepage_header_image',
            'label'       => 'Header Background image',
            'desc'        => 'Header image settings in <strong>Landx Page settings > One page settings - Background image</strong>',
            'std'         => '',
            'type'        => 'Textblock',
            'class'       => '',
            'choices'     => array(),
            'operator'    => 'and',
            'condition'   => 'onepage_header_style:is(image)'
          ), 
          array(
            'id'          => 'onepage_image_slider',
            'label'       => 'Slider Images',
            'desc'        => '',
            'std'         => '',
            'type'        => 'gallery',
            'class'       => '',
            'choices'     => array(),
            'operator'    => 'and',
            'condition'   => 'onepage_header_style:is(image_slider)'
          ), 
          array(
            'id'          => 'mp4_video_url',
            'label'       => '.mp4 Video url',
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'class'       => '',
            'choices'     => array(),
            'operator'    => 'and',
            'condition'   => 'onepage_header_style:is(video)'
          ), 
          array(
            'id'          => 'webm_video_url',
            'label'       => '.webm video url',
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'class'       => '',
            'choices'     => array(),
            'operator'    => 'and',
            'condition'   => 'onepage_header_style:is(video)'
          ),  
          array(
            'id'          => 'mov_video_url',
            'label'       => '.mov video url',
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'class'       => '',
            'choices'     => array(),
            'operator'    => 'and',
            'condition'   => 'onepage_header_style:is(video)'
          ),      
          array(
            'id'          => 'onepage_header_slider',
            'label'       => 'Slider shortcode',
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'class'       => '',
            'rows'        => 3,
            'choices'     => array(),
            'operator'    => 'and',
            'condition'   => 'onepage_header_style:is(shortcode)'
          ),
      array(
        'id'          => 'content_settings',
        'label'       => 'Section settings',      
        'type'        => 'tab',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pages',
        'label'       => __( 'Pages', THEMENAME ),
        'desc'        => landx_get_page_sections_info(),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
            array(
            'id'          => 'page_id',
            'label'       => 'Select a page',
            'desc'        => '',
            'std'         => '',
            'type'        => 'page-select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'     => '',
          ),
            array(
            'id'          => 'display_in_menu',
            'label'       => 'Display in menu',
            'desc'        => 'Work only when nav control by Sections',
            'std'         => 'on',
            'type'        => 'on-off',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'     => '',
          ),
        array(
            'id'          => 'link_type',
            'label'       => 'Menu link type',
            'desc'        => '',
            'std'         => 'internal',
            'type'        => 'select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => 'display_in_menu:is(on)',
            'operator'    => 'and',
            'choices'     => array(
                array(
                    'value'       => 'internal',
                    'label'       => 'Internal',
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'external',
                    'label'       => 'External',
                    'src'         => ''
                  ),
				  array(
                    'value'       => 'custom_link',
                    'label'       => 'Custom Link',
                    'src'         => ''
                  )
              ),
          ),
		  array(
				'id'          => 'custom_link_url',
				'label'       => 'Custom link url',
				'desc'        => '',
				'std'         => '#',
				'type'        => 'text',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => 'link_type:is(custom_link)',
				'operator'    => 'and',
				'choices'     => '',
			),

          array(
            'id'          => 'section_padding',
            'label'       => 'Section padding',
            'desc'        => 'section spacing top and bottom',
            'std'         => 'internal',
            'type'        => 'select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'operator'    => 'and',
            'choices'     => array(
                array(
                    'value'       => 'default-padding',
                    'label'       => 'Default padding (top & bottom)',
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'top-padding-only',
                    'label'       => 'Top padding only',
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'bottom-padding-only',
                    'label'       => 'Bottom Padding only',
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'no-padding',
                    'label'       => 'No padding',
                    'src'         => ''
                  )
              ),
          ),
            

        )
      ),
    )
  );


  if ( !is_page_template( 'page-templates/vc-onepage.php' ) ) {
      ot_register_meta_box( $my_meta_box );
    }
  endif;  //if( function_exists( 'ot_get_option' ) ):

}
?>