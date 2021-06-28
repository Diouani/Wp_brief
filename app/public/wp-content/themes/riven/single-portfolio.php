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
            	<div class="single-portfolio-content">
			    <?php while (have_posts()) : the_post(); ?>
			    		<div class="col-md-6 col-sm-6 col-xs-12">
				    	<?php $portfolio_gallery = get_post_meta(get_the_ID(), 'images_gallery', true);?>
				    	<?php if (has_post_thumbnail() || ( is_array($portfolio_gallery) && count($portfolio_gallery) > 1 )) : ?>
					    	<?php if (is_array($portfolio_gallery) && count($portfolio_gallery) > 1) : ?>
						    	<div class="portfolio-gallery">
						    		<div id="portfolio-gallery" class="owl-carousel">
						    		<?php foreach ($portfolio_gallery as $key => $value) :?>
						    			<?php $image = wp_get_attachment_image_src($value, 'riven-single-portfolio');?>
						    			<div class="image-portfolio-gallery">
						    				<img src="<?php echo $image[0];?>" />
						    			</div>
						    		<?php endforeach;?>
						    		</div>
								</div>
								<script type="text/javascript">
						            jQuery(function ($) {
						                var owl = $("#portfolio-gallery");
						                owl.owlCarousel({
						                    <?php if (is_rtl()) :?>
						                    rtl:true,
						                    <?php endif;?>
						                    dots:true,
						                    loop:true,
						                    margin:10,
						                    nav:false,
						                    navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
						                    items: 1,
						                }); //end: owl
						            });
	        					</script>
							<?php else : ?>
		                        <div class="portfolio-thumbnail">
		                            <?php if (has_post_thumbnail()): ?>
		                                <?php the_post_thumbnail('riven-single-portfolio'); ?>
		                            <?php endif; ?>
		                        </div>
		                    <?php endif; ?>
	                	<?php endif; ?>
	                	</div>
	                	<div class="col-md-6 col-sm-6 col-xs-12">
	                		<h2 class="portfolio-title"><?php esc_html(the_title());?></h2>
	                		<div class="portfolio-desc">
	                			<?php the_content();?>
	                		</div>
	                		<?php
	                		$portfolio_client = get_post_meta(get_the_ID(), 'client_project', true);
	                		$portfolio_tools = get_post_meta(get_the_ID(), 'tool_project', true);
	                		$link_project = get_post_meta(get_the_ID(), 'link_project', true);
	                		?>	
	                		<?php if($portfolio_client) :?> 
	                		<div class="portfolio-client">
	                			<div class="title_client"><?php esc_html_e('Client','riven');?></div>
	                			<div class="content_client">
	                				<?php 
										echo wp_kses($portfolio_client,array(
											'a' => array(),
											'br' => array(),
						                ));
									?> 
	                			</div>
	                		</div>
	                		<?php endif;?>
	                		<?php if($portfolio_tools) :?>
	                		<div class="portfolio-tools">
	                			<div class="title_tools"><?php esc_html_e('Tools','riven');?></div>
	                			<div class="content_tools">
	                				<?php 
										echo wp_kses($portfolio_tools,array(
											'a' => array(),
											'br' => array(),
						                ));
									?>
	                			</div>
	                		</div>	
	                		<?php endif;?>
                			<a class="button_preview btn btn-default" target= "_blank" href="<?php echo esc_url($link_project);?>">
                            	<?php esc_html_e('Live Preview', 'riven');?>
                        	</a>
	                	</div>		 
				<?php endwhile;?> 
				</div>
			</div><!-- #content -->
        </div><!-- #primary -->
    </div>  
   
<?php get_footer(); ?>	
 