   <?php get_header(); ?>
   <?php 
    $class = '';
    if ($riven_sidebar_left && $riven_sidebar_right && is_active_sidebar($riven_sidebar_left) && is_active_sidebar($riven_sidebar_right)){
        $class .= 'col-md-6 col-sm-12 col-xs-12 main-sidebar'; 
    }elseif($riven_sidebar_left && (!$riven_sidebar_right|| $riven_sidebar_right=="none") && is_active_sidebar($riven_sidebar_left)){
        $class .= 'f-right col-lg-9 col-md-9 col-sm-12 col-xs-12 main-sidebar'; 
    }elseif((!$riven_sidebar_left || $riven_sidebar_left=="none") && $riven_sidebar_right && is_active_sidebar($riven_sidebar_right)){
        $class .= 'col-lg-9 col-md-9 col-sm-12 col-xs-12 main-sidebar'; 
    }else {
        $class .= 'content-primary'; 
    }   
	?>
   <div class="<?php echo esc_attr($class);?>">
        <div id="primary" class="site-content">
            <div id="content" role="main">
                    <?php while (have_posts()) : the_post(); ?>
                    	 <?php $media_type = get_post_meta(get_the_ID(), 'media_type', true); ?>
		 				<?php 
			            $featuredImage = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
			            $iframe = get_post_meta(get_the_ID(), 'map_event', true);
			             ?>
			            <div class="event-lightbox">
		                <div class="lightbox-content popup-content">
									<?php if(has_post_thumbnail()) :?>
										<img class="event-img" src="<?php echo esc_url($featuredImage); ?>" alt="event" width="1000" height="350">
									<?php endif;?>
									<div class="event-text popup-top">
										<div class="calendar-time">
											<?php echo get_post_time("M d"); ?>
										</div>
										<h3><?php the_title();?></h3>
										<div class="desc"><?php the_content();?></div>
									</div>
									<?php 
									$country = get_post_meta(get_the_ID(),'country', true);
									$location = get_post_meta(get_the_ID(),'location', true);
									$time_event = get_post_meta(get_the_ID(),'time_event', true);
									$day_event = get_post_meta(get_the_ID(),'day_event', true);
									?>
									<div class="time-location">
										<div class="time">
											<div class="time-desc">
												<h5><?php echo esc_html__('Time', 'riven');?></h5>
												<p class="hours"><?php echo esc_html($time_event);?></p>
												<p class="letter"><?php echo esc_html($day_event);?></p>
											</div>
										</div>
										<div class="time">
											<div class="time-desc">
												<h5><?php echo esc_html__('Location', 'riven');?></h5>
												<p class="hours"><?php echo esc_html($location);?></p>
												<p class="letter"><?php echo esc_html($country);?></p>
											</div>
										</div>
									</div>
									<div class="map_event">
										<?php
											echo wp_kses($iframe,array(
							                  	'iframe' => array(
							                    'height' => array(),
							                    'frameborder' => array(),
							                    'style' => array(),
							                    'src' => array(),
							                    'allowfullscreen' => array(),
							                    )
							                ));
										?>
									</div>
									<div class="blog-comments">
										<?php comments_template('', true); ?>
									</div>
								</div>
							</div>
		 
		   				 <?php endwhile;?> 
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>    
   			
    <?php get_footer(); ?>
 