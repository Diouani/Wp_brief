<?php
extract(shortcode_atts(array(
	'border_box' => '',
	'style' => 'col-md-12',
    'align' => '',
    'image' => LANDX_URI.'/images/team-1.png',
    'title' => 'Michael Smith',
    'subtitle' => 'Designer',
    'subtitle_tag' => 'h4',
    'desc' => '',
    'social_links' => '',
), $atts));
$social_linksArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($social_links) : array();
?>
<div class="team-box<?php echo ($align != '')? ' '.esc_attr($align): ''; echo ' '.$border_box; ?>">
	<div class="row">
		<div class="<?php echo esc_attr($style) ?>">
			<div class="team-contact">
				<?php if( !empty($social_linksArr) ): ?>
				<ul class="social-list">
					<?php 
					foreach ($social_linksArr as $key => $value) {
						echo ($value['icon'] != '')? '<li><a href="'.esc_url($value['link']).'" target="_blank" title="'.esc_attr($value['title']).'"><i class="'.esc_attr($value['icon']).' icon-size-m"></i></a></li>' : '';
					} 
					?>
				</ul>
				<?php endif; ?>
				<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr( $title ); ?>">
			</div>
			<h3 class="mt-20 mb-0"><?php echo esc_attr( $title ); ?></h3>
			<?php if( $subtitle != '' ): ?>
				<<?php echo esc_attr( $subtitle_tag ); ?> class="colored-text">
					<?php echo esc_attr($subtitle) ?>
				</<?php echo esc_attr( $subtitle_tag ); ?>>
			<?php endif; ?>
			<?php if( ($desc != '') && ($style == 'col-md-12') ): ?>
				<p><?php echo force_balance_tags($desc) ?></p>
			<?php endif; ?>
		</div>
		<?php if($style == 'col-md-6'): ?>
			<div class="<?php echo esc_attr($style) ?>">
				<p class="mb-25"><?php echo force_balance_tags($desc) ?></p>
			</div>
		<?php endif ?>
	</div>
</div>