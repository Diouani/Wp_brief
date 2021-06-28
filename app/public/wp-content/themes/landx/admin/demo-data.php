<?php
function landx_import_demo_data() {
  return array(
    array(
      'import_file_name'           => 'Full demo',
      'categories'                 => array(),
      'import_file_url'            => LANDX_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDX_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDX_URI.'/admin/demo-data/customizer.dat',      
      'import_preview_image_url'   => LANDX_URI.'/screenshot.jpg',
      'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'landx' ),
      'preview_url'                => '//themeperch.net/landx/new',
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'landx_import_demo_data' );

function landx_after_import_setup() {
  // Assign menus to their locations.
  $primary = get_term_by( 'name', 'Main menu', 'nav_menu' );

  set_theme_mod( 'nav_menu_locations', array(
      'header-menu' => $primary->term_id,
    )
  );

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title( 'Layout Style 1' );
  $blog_page_id  = get_page_by_title( 'Blog' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );


}
add_action( 'pt-ocdi/after_import', 'landx_after_import_setup' );