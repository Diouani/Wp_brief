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
                    <?php if (have_posts()): ?>                        
                        <?php get_template_part('content', 'blog-list'); ?>
                    <?php else: ?> 
                        <?php get_template_part('content', 'none'); ?>
                    <?php endif; ?>
            </div><!-- #content -->
        </div><!-- #primary -->
  </div>     
<?php get_footer(); ?>
