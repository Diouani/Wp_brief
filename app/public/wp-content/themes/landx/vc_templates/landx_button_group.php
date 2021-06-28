<?php
extract(shortcode_atts(array(
    'align'  => 'text-center',
    'buttons' => '',
), $atts));
$buttonsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($buttons) : array();
?>			


<?php if( !empty($buttonsArr) ): ?>
    <div class="button-container button-group <?php echo esc_attr($align); ?>">
    	<?php
        foreach ($buttonsArr as $key => $value) {
            extract($value);
            echo '<a href="'.esc_url($button_link).'" class="btn '.esc_attr($button_style).'">'.esc_attr($button_title).'</a>';
        }
        ?>
    </div>	
<?php endif; ?>