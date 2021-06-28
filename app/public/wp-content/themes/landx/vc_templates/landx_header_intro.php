<?php
$args = landx_header_intro_shortcode_vc(true);
$atts['title_highlight_text'] = 'text_color:preset-color';
$args['content'] = $content;
$atts = shortcode_atts( $args, $atts);
extract($atts);
$titleClass = apply_filters('perch_vc_class_filter', 'intro', 'title', $atts);
$subtitleClass = apply_filters('perch_vc_class_filter', 'p', 'subtitle', $atts);
?>
<div class="intro-section <?php echo esc_attr($align); ?>">
	<!-- Title -->
	<h2 class="<?php echo esc_attr($titleClass) ?>" data-animation="fadeInUp" data-animation-delay="300"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'title', $atts) ?>>
		<?php echo apply_filters('perch_modules_text_filter', $title, 'title', $atts) ?>
	</h2>
	<?php if( $subtitle != '' ): ?>
		<p class="<?php echo esc_attr($subtitleClass) ?>" data-animation="fadeInUp" data-animation-delay="300"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'subtitle', $atts) ?>>
			<?php echo apply_filters('perch_modules_text_filter', $subtitle, 'subtitle', $atts) ?>
		</p>
	<?php endif; ?>
	<?php if( $content != '' ): ?>
		<p class="sub-heading"><?php echo do_shortcode($content); ?></p>
	<?php endif; ?>
</div>