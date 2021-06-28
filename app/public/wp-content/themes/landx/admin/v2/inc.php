<?php
if( !function_exists('landx_compress') ):
function landx_compress($buffer) {
    //Remove CSS comments
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    //Remove tabs, spaces, newlines, etc.
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}
endif;
load_template( LANDX_DIR . '/admin/v2/colors-options.php' );
load_template( LANDX_DIR . '/admin/v2/vc-typography-field.php' );
load_template( LANDX_DIR . '/admin/v2/vc-extends.php' );