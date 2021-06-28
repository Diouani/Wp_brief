<?php
$args = landx_title_area_shortcode_vc(true);
$atts['title_highlight_text'] = 'text_color:preset-color';
$args['content'] = $content;
$atts = shortcode_atts( $args, $atts);
extract($atts);
$titleClass = apply_filters('perch_vc_class_filter', '', 'title', $atts);
$subtitleClass = apply_filters('perch_vc_class_filter', 'sub-heading', 'subtitleClass', $atts);
?>
<div class="onepage-title  <?php echo esc_attr($align); ?>">
	<h2 class="<?php echo esc_attr($titleClass) ?>" data-animation="fadeInUp" data-animation-delay="300"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'title', $atts) ?>>
		<?php echo apply_filters('perch_modules_text_filter', $title, 'title', $atts) ?>
	</h2>	
	<div class="colored-line"></div>
	<?php if( $subtitle != '' ): ?>
	<p class="<?php echo esc_attr($subtitleClass) ?>" data-animation="fadeInUp" data-animation-delay="300"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'subtitle', $atts) ?>>
		<?php echo apply_filters('perch_modules_text_filter', $subtitle, 'subtitle', $atts) ?>
	</p>
	<?php endif; ?>
	<?php if( $content != '' ): ?>
		<div class="sub-heading"><?php echo do_shortcode($content); ?></div>
	<?php endif; ?>
</div>