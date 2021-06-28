<?php $riven_settings = riven_check_theme_options(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        
        <?php if ($riven_settings['favicon']): ?>
            <link rel="shortcut icon" href="<?php echo esc_url(str_replace( array( 'http:', 'https:' ), '', $riven_settings['favicon']['url'])); ?>" type="image/x-icon" />
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>
<body class="home">
<div id="primary" class="site-content">
    <div id="content" role="main">
        <div class="page-404 bg-gradient text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 page-404-container">
                        <div class="content-404">
                            <div class="logo-404">
								<a href="<?php echo esc_url(home_url('/')); ?>">
									<?php echo '<img class="" width="120" height="95" src="' . esc_url(str_replace(array('http:', 'https:'), '', $riven_settings['logo']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />'; ?>
								</a>
							</div>
							<div class="content-desc">
                                <h1><?php echo esc_html__('404', 'riven'); ?></h1>
                                <h4><?php echo esc_html__('page not found.', 'riven'); ?></h4>
                                <p><br>   
                                    <?php echo esc_html__('Oooop, The page you were looking for could not be found.', 'riven'); ?><br>
                                    <?php echo esc_html__('Try searching for the best match or back to homepage', 'riven'); ?>
                                </p>
                            </div>
                            <div class="button-404">
                                <a class="btn btn-default" href="<?php echo esc_url(home_url('/')); ?>"><span><span><?php echo esc_html__('Back to home', 'riven'); ?></span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- #content -->
</div><!-- #primary -->
</body>
<?php wp_footer(); ?>
</html
