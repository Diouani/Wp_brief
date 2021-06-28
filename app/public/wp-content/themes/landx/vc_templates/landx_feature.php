<?php
$args = landx_feature_shortcode_vc(true);
$atts['title_highlight_text'] = 'text_color:preset-color';
$args['content'] = $content;
$atts = shortcode_atts( $args, $atts);
extract($atts);
$icon = 'icon_'.$type;
wp_enqueue_style( 'vc_'.$type );
$class = array('feature');
$class[] = $align;
$class[] = $border_box;
$class = array_filter($class);
$icon_value = (!isset($atts[$icon]))? 'vc_li vc_li-heart' : $atts[$icon];
$buttonsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($buttons) : array();
$titleClass = apply_filters('perch_vc_class_filter', '', 'title', $atts);
$subtitleClass = apply_filters('perch_vc_class_filter', 'p', 'subtitle', $atts);
?>

<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
	<div class="icon"><span class="<?php echo esc_attr($icon_value) ?>"></span></div>
	<?php if( $title != '' ): ?>
		<h4 class="<?php echo esc_attr($titleClass) ?>" data-animation="fadeInUp" data-animation-delay="300"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'title', $atts) ?>>
			<?php echo apply_filters('perch_modules_text_filter', $title, 'title', $atts) ?>
		</h4>
	<?php endif; ?>
	<?php if( $subtitle != '' ): ?>
		<p class="<?php echo esc_attr($subtitleClass) ?>" data-animation="fadeInUp" data-animation-delay="300"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'subtitle', $atts) ?>>
			<?php echo apply_filters('perch_modules_text_filter', $subtitle, 'subtitle', $atts) ?>
		</p>
	<?php endif; ?>
	<?php if( $content != '' ): ?>
		<?php echo do_shortcode($content); ?>
	<?php endif; ?>
	<?php echo ($button == 'yes')? '<p class="mt-20">'.landx_get_button_groups($buttonsArr).'</p>' : ''; ?>
</div>