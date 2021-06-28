<?php
add_filter( 'ot_option_types_array', 'landx_ot_option_types_array', 10, 1 );
function landx_ot_option_types_array($args){
	$args['iconpicker'] = 'Icon picker';
	return $args;
}

/**
 * Text option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_iconpicker' ) ) {
  
  function ot_type_iconpicker( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-text ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build text input */
        echo '<input class="widefat option-tree-ui-iconpicker ' . esc_attr( $field_class ) . '" type="hidden" id="' . esc_attr( $field_id ) . '" name="' . esc_attr( $field_name ) . '" value="' . esc_attr( $field_value ) . '"/>';
        if( $field_value != '' ) { $v= explode('|',$field_value); $icon = $v[0].' '.$v[1]; }
        else $icon = '';
        echo '<div id="preview_' . esc_attr( $field_id ) . '" data-target="#' . esc_attr( $field_id ) . '" class="button icon-picker '.$icon.'"></div>';
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

function landx_ot_iconpicker($field_id = ''){

  if( $field_id == '' ) return;

  $field_value = ot_get_option($field_id);
  $iconclass = '';
  if( $field_value != '' ) { $v= explode('|',$field_value); $iconclass = $v[0].' '.$v[1]; }
  return ( $iconclass != '' )? "<i class='{$iconclass}'></i>" : "";
}

function landx_ot_get_icon($field_value = ''){

  if( $field_value == '' ) return;

  $iconclass = '';
  if( $field_value != '' ) { $v= explode('|',$field_value); $iconclass = $v[0].' '.$v[1]; }
  return ( $iconclass != '' )? "<i class='{$iconclass}'></i>" : "";
}
