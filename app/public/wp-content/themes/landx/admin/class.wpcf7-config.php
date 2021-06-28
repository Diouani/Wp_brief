<?php
if( class_exists('WPCF7_ContactFormTemplate') ):
class Landx_ContactFormTemplate extends WPCF7_ContactFormTemplate { 
	function __construct(){
      add_action( 'wpcf7_init', array( __CLASS__, 'add_form_tag_admin_edit_link' ) );
		  add_filter( 'wpcf7_default_template', array( __CLASS__, 'custom_form' ), 10, 2 );
	}
 
 
  public static function custom_form($template, $prop) { 
    if ( $prop == 'form' ) {
      $template = '<div class="expanded-contact-form"><div class="field-wrapper col-md-6">[text* your-name class:form-control class:input-box placeholder "Your Name"] </div>
      <div class="field-wrapper col-md-6">[email* your-email class:form-control class:input-box placeholder "Email"] </div><div class="field-wrapper col-md-12">[text your-subject class:form-control class:input-box placeholder "Subject"] </div><div class="field-wrapper col-md-12">[textarea your-message class:form-control class:textarea-box placeholder "Your Message"] </div>
      [submit class:btn class:standard-button "Send Message"] </div>[editlink]'; 
          }
 
      return $template; 
  } 


  public static function add_form_tag_admin_edit_link() {
      wpcf7_add_form_tag( 'editlink', 'landx_admin_edit_link_form_tag_handler', array( 'name-attr' => false ) );
  }

  
} 

new Landx_ContactFormTemplate();
endif;

function landx_admin_edit_link_form_tag_handler( $tag ) {
     if( current_user_can( 'administrator' ) ){
          $wpcf7 = WPCF7_ContactForm::get_current(); 
          $id = $wpcf7->id();
          $form_edit_link = admin_url( 'admin.php?page=wpcf7&post='.intval($id).'&action=edit' );
          $mail_edit_link = admin_url( 'admin.php?page=wpcf7&post='.intval($id).'&action=edit&active-tab=1' );

          $html = '<div class="cf7-edit-link small">';  
          $html .= sprintf(' <a target="_blank" href="%s">%s</a>', esc_url($form_edit_link), esc_attr__('Edit contact form', 'landx'));        
          $html .= sprintf(', <a target="_blank" href="%s">%s</a>', esc_url($mail_edit_link), esc_attr__('Check Mail settings', 'landx'));
          $html .= '</div>';      

          return $html;
      }
}