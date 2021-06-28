<?php
$args = landx_contact_us_shortcode_vc(true);
$args['content'] = $content;
$atts = shortcode_atts( $args, $atts);
extract($atts);
$titleClass = apply_filters('perch_vc_class_filter', 'heading', 'title', $atts);
?>

<div class="contact-us-now <?php echo esc_attr($align); ?>">
	<?php if( $title != '' ): ?>
		<!-- Title -->
		<h3 class="<?php echo esc_attr($titleClass) ?>" data-animation="fadeInUp" data-animation-delay="300"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'title', $atts) ?>>
			<?php echo apply_filters('perch_modules_text_filter', $title, 'title', $atts) ?>
		</h3>
	<?php endif; ?>
	<p>
		<a class="contact-link expand-form collapsed"><span class="icon_mail_alt"></span><?php echo esc_attr($linktext) ?></a><br>
	</p>
	<div class="expanded-contact-form">
		<?php echo do_shortcode($shortcode); ?>
	</div>
</div>
