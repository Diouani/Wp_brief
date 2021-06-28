<?php get_header(); 
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
?>  <div class="<?php echo esc_attr($class);?>"> 
        <div id="primary" class="site-content">
            <div id="content" role="main">
                    <?php if (have_posts()): ?>                        
                        <?php get_template_part('content', 'search'); ?>
                    <?php else: ?> 
                    <article id="post-0" class="post no-results not-found">
                        <div class="container">
                            <header class="entry-header">
                                <h1 class="entry-title"><?php esc_html_e('Nothing Found', 'riven'); ?></h1>
                            </header>

                            <div class="entry-content">
                                <p><?php esc_html_e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'riven'); ?></p>
                                <?php get_search_form(); ?>
                            </div><!-- .entry-content -->
                        </div>
                    </article><!-- #post-0 -->
                <?php endif; ?>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
<?php get_footer(); ?>