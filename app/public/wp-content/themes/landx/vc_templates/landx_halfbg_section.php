<?php
extract(shortcode_atts(array(
	'id' => '',
    'align'  => 'half-container-right',
    'image' => LANDX_URI.'/images/camera1.jpg',
    'padding_class' => 'default-padding',
    'bg_class' => 'default-bg',
), $atts));
$sectionClass = array();
$sectionClass[] = $padding_class;
$sectionClass[] = $bg_class;
$sectionClass[] = (($bg_class == 'color-bg') || ($bg_class == 'dark-bg'))? 'has-dark-bg' : '';

$contaiclass = ( $align == 'half-container-right' )? 'col-md-5 text-md-left' : 'col-md-5 col-md-offset-7 text-md-left';
?>

<div id="<?php echo esc_attr($id) ?>" class="<?php echo implode(' ', $sectionClass); ?>">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr($contaiclass) ?>">
    			<?php echo wpb_js_remove_wpautop( $content ); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo esc_attr($align); ?> dark-bg" style="background-image: url(<?php echo esc_url($image) ?>);"></div>
	<div class="bg"></div>
</div>