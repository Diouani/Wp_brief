<?php
$args = landx_feature_list_shortcode_vc(true);
$atts['title_highlight_text'] = 'text_color:preset-color';
$args['content'] = $content;
$atts = shortcode_atts( $args, $atts);
extract($atts);
$titleClass = apply_filters('perch_vc_class_filter', '', 'title', $atts);
$subtitleClass = apply_filters('perch_vc_class_filter', '', 'subtitle', $atts);
?>
<div class="feature-list-1">
	<div class="icon-container pull-left"><span class="<?php echo esc_attr($icon); ?>"></span></div>
	<?php if( $title != '' ): ?>
		<!-- Title -->
		<h6 class="<?php echo esc_attr($titleClass) ?>" data-animation="fadeInUp" data-animation-delay="300"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'title', $atts) ?>>
			<?php echo apply_filters('perch_modules_text_filter', $title, 'title', $atts) ?>
		</h6>
	<?php endif; ?>
	<?php if( $subtitle != '' ): ?>
		<p class="<?php echo esc_attr($subtitleClass) ?>" data-animation="fadeInUp" data-animation-delay="300"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'subtitle', $atts) ?>>
			<?php echo apply_filters('perch_modules_text_filter', $subtitle, 'subtitle', $atts) ?>
		</p>
	<?php endif; ?>	
	<?php if( $content != '' ): ?>
		<p><?php echo do_shortcode($content); ?></p>
	<?php endif; ?>
</div>