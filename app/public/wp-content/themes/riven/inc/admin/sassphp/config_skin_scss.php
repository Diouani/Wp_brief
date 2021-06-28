<?php 
$riven_settings = riven_check_theme_options();
$config = $riven_settings;
?>

//SKIN

//General
$general_bg_color: <?php echo $config['general-bg']['background-color'] ?>;
$general_bg_image: url('<?php echo $config['general-bg']['background-image'] ?>');
$general_bg_repeat: <?php echo $config['general-bg']['background-repeat'] ?>;
$general_bg_osition: <?php echo $config['general-bg']['background-position'] ?>;
$general_bg_size: <?php echo $config['general-bg']['background-size'] ?>;
$general_bg_attachment: <?php echo $config['general-bg']['background-attachment'] ?>;
$general_font_family: <?php echo $config['general-font']['font-family'] ?>;
$general_font_weight: <?php echo $config['general-font']['font-weight'] ?>;
$general_font_size: <?php echo $config['general-font']['font-size'] ?>;
$general_font_color: <?php echo $config['general-font']['color'] ?>;
$general_line_height: <?php echo $config['general-font']['line-height'] ?>;
$primary_color: <?php echo $config['primary-color'] ?>;
$highlight_color: <?php echo $config['highlight-color'] ?>;
//Footer
$footer_bg_color: <?php echo $config['footer-bg-color'] ? $config['footer-bg-color'] : '#333333' ?>;
$footer_bg_image: url('<?php echo $config['footer-bg']['background-image'] ?>');
$footer_bg_repeat: <?php echo $config['footer-bg']['background-repeat'] ?>;
$footer_bg_position: <?php echo $config['footer-bg']['background-position'] ?>;
$footer_bg_size: <?php echo $config['footer-bg']['background-size'] ?>;
$footer_bg_attachment: <?php echo $config['footer-bg']['background-attachment'] ?>;
//Breadcrumb
$breadcrumb_bg_image: url('<?php echo esc_url(str_replace(array('http:', 'https:'), '', $config['breadcrumbs-bg']['background-image'])) ?>');
$breadcrumb_bg_repeat: <?php echo $config['breadcrumbs-bg']['background-repeat'] ?>;
$breadcrumb_bg_position: <?php echo $config['breadcrumbs-bg']['background-position'] ? $config['breadcrumbs-bg']['background-position'] : 'center center' ?>;
$breadcrumb_bg_size: <?php echo $config['breadcrumbs-bg']['background-size'] ?>;
$breadcrumb_bg_attachment: <?php echo $config['breadcrumbs-bg']['background-attachment'] ?>;
//breadcumb header 5
$breadcrumb_bg_image_5: url('<?php echo esc_url(str_replace(array('http:', 'https:'), '', $config['breadcrumbs-bg-5']['background-image'])) ?>');
$breadcrumb_bg_repeat_5: <?php echo $config['breadcrumbs-bg-5']['background-repeat'] ?>;
$breadcrumb_bg_position_5: <?php echo $config['breadcrumbs-bg-5']['background-position'] ? $config['breadcrumbs-bg-5']['background-position'] : 'center center' ?>;
$breadcrumb_bg_size_5: <?php echo $config['breadcrumbs-bg-5']['background-size'] ?>;
$breadcrumb_bg_attachment_5: <?php echo $config['breadcrumbs-bg-5']['background-attachment'] ?>;

//Typography
$h1_font_family: <?php
		if(isset( $config['h1-font']['font-family'] ) && $config['h1-font']['font-family']!=''){
			echo $config['h1-font']['font-family'] ;
		}else{
			echo 'Lato';
		}?>;
$h1_font_size: <?php
		if(isset( $config['h1-font']['font-size'] ) && $config['h1-font']['font-size']!=''){
			echo $config['h1-font']['font-size'] ;
		}else{
			echo '24px';
		}?>;
$h1_font_color: <?php
		if(isset( $config['h1-font']['color'] ) && $config['h1-font']['color']!=''){
			echo $config['h1-font']['color'] ;
		}else{
			echo '#353535';
		}?>;
$h2_font_family: <?php
		if(isset( $config['h2-font']['font-family'] ) && $config['h2-font']['font-family']!=''){
			echo $config['h2-font']['font-family'] ;
		}else{
			echo 'Lato';
		}?>;
$h2_font_size: <?php
		if(isset( $config['h2-font']['font-size'] ) && $config['h2-font']['font-size']!=''){
			echo $config['h2-font']['font-size'] ;
		}else{
			echo '22px';
		}?>;
$h2_font_color: <?php
		if(isset( $config['h2-font']['color'] ) && $config['h2-font']['color']!=''){
			echo $config['h2-font']['color'] ;
		}else{
			echo '#353535';
		}?>;
$h3_font_family: <?php
		if(isset( $config['h3-font']['font-family'] ) && $config['h3-font']['font-family']!=''){
			echo $config['h3-font']['font-family'];
		}else{
			echo 'Lato';
		}?>;
$h3_font_size: <?php
		if(isset( $config['h3-font']['font-size'] ) && $config['h3-font']['font-size']!=''){
			echo $config['h3-font']['font-size'] ;
		}else{
			echo '20px';
		}?>;
$h3_font_color: <?php
		if(isset( $config['h3-font']['color'] ) && $config['h3-font']['color']!=''){
			echo $config['h3-font']['color'] ;
		}else{
			echo '#353535';
		}?>;
$h4_font_family: <?php
		if(isset( $config['h4-font']['font-family'] ) && $config['h4-font']['font-family']!=''){
			echo $config['h4-font']['font-family'] ;
		}else{
			echo 'Lato';
		}?>;
$h4_font_size: <?php
		if(isset( $config['h4-font']['font-size'] ) && $config['h4-font']['font-size']!=''){
			echo $config['h4-font']['font-size'] ;
		}else{
			echo '18px';
		}?>;
$h4_font_color: <?php
		if(isset( $config['h4-font']['color'] ) && $config['h4-font']['color']!=''){
			echo $config['h4-font']['color'] ;
		}else{
			echo '#353535';
		}?>;
$h5_font_family: <?php
		if(isset( $config['h5-font']['font-family'] ) && $config['h5-font']['font-family']!=''){
			echo $config['h5-font']['font-family'] ;
		}else{
			echo 'Lato';
		}?>;
$h5_font_size: <?php
		if(isset( $config['h5-font']['font-size'] ) && $config['h5-font']['font-size']!=''){
			echo $config['h5-font']['font-size'] ;
		}else{
			echo '16px';
		}?>;
$h5_font_color: <?php
		if(isset( $config['h5-font']['color'] ) && $config['h5-font']['color']!=''){
			echo $config['h5-font']['color'] ;
		}else{
			echo '#353535';
		}?>;
$h6_font_family: <?php
		if(isset( $config['h6-font']['font-family'] ) && $config['h6-font']['font-family']!=''){
			echo $config['h6-font']['font-family'];
		}else{
			echo 'Lato';
		}?>;
$h6_font_size: <?php
		if(isset( $config['h6-font']['font-size'] ) && $config['h6-font']['font-size']!=''){
			echo $config['h6-font']['font-size'] ;
		}else{
			echo '14px';
		}?>;
$h6_font_color: <?php
		if(isset( $config['h6-font']['color'] ) && $config['h6-font']['color']!=''){
			echo $config['h6-font']['color'] ;
		}else{
			echo '#353535';
		}?>;