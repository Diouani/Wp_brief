<?php
extract(shortcode_atts(array(
    'nav_logo'  => LANDX_URI.'/images/logo.png',
    'socaial_links' => '',
), $atts));
$social_linksArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($socaial_links) : array();
?>

<!-- ONLY LOGO ON HEADER -->
<div class="navigation-header">
<div class="navbar non-sticky">	
		<?php if($nav_logo != ''): ?>
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($nav_logo) ?>" alt="<?php bloginfo( 'name' ); ?>"></a>	
		</div>
		<?php endif; ?>

		<?php if( !empty($social_linksArr) ): ?>
		<ul class="nav navbar-nav navbar-right social-navigation hidden-xs">
			<?php 
        	foreach ($social_linksArr as $key => $value) {
        		$class = preg_replace('/\s+/', '', esc_attr($value['icon']));
        		$class = substr($class, 5);
        		$icon = ( isset($value['icon']) && ($value['icon'] != ''))? '<i class="'.esc_attr($value['icon']).'"></i>':'';


        		if( isset($value['title_link']) &&  ($value['title_link'] == 'yes') ){
        			if( ($value['link']) == '' ){
        				echo '<li><span class="header-info-title '.esc_attr($value['title_color']).'">'.$icon.esc_attr($value['title']).'</span></li>';
        			}else{
        				echo '<li><a class="header-info-link" href="'.esc_url($value['link']).'" target="_blank" title="'.esc_attr($value['title']).'"><span class="header-info-title '.esc_attr($value['title_color']).'">'.$icon.esc_attr($value['title']).'</span></a></li>';
        			}
        			
        		}else{
        			echo '<li><a class="'.$class.' img-circle" href="'.esc_url($value['link']).'" target="_blank" title="'.esc_attr($value['title']).'">'.$icon.'</a></li>';
        		}
        		
        	}
        	?>					
		</ul>
		<?php endif; ?>			
</div><!-- /END ONLY LOGO ON HEADER -->
</div>