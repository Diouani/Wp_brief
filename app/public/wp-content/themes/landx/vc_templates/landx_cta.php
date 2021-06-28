<?php
$args = landx_call_to_action_shortcode_vc(true);
$atts['title_highlight_text'] = 'text_color:preset-color';
$args['content'] = $content;
$atts = shortcode_atts( $args, $atts);
extract($atts);
$buttonsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($buttons) : array();
$titleClass = apply_filters('perch_vc_class_filter', '', 'title', $atts);
$subtitleClass = apply_filters('perch_vc_class_filter', '', 'subtitle', $atts);
?>			
<div class="call-to-action <?php echo esc_attr($align); ?>">

	<h4 class="<?php echo esc_attr($titleClass) ?>" data-animation="fadeInUp" data-animation-delay="300"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'title', $atts) ?>>
        <?php echo apply_filters('perch_modules_text_filter', $title, 'title', $atts) ?>
    </h4>
	<h2 class="<?php echo esc_attr($subtitleClass) ?>" data-animation="fadeInUp" data-animation-delay="300"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'subtitle', $atts) ?>>
        <?php echo apply_filters('perch_modules_text_filter', $subtitle, 'subtitle', $atts) ?>
    </h2>
    <?php if( $content != '' ): ?>
        <div class="sub-heading"><?php echo do_shortcode($content) ?></div>
    <?php endif;  ?>


    <?php if( !empty($buttonsArr) ): ?>
        <div class="button-container">
        	<?php
            foreach ($buttonsArr as $key => $value) {
                extract($value);
                echo '<a href="'.esc_url($button_link).'" class="btn '.esc_attr($button_style).'">'.esc_attr($button_title).'</a>';
            }
            ?>
        </div>	
    <?php endif; ?>
</div>
