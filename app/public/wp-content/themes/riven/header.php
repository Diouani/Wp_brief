<?php $riven_settings = riven_check_theme_options(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) :?>
            <?php if ($riven_settings['favicon']): ?>
                <link rel="shortcut icon" href="<?php echo esc_url(str_replace(array('http:', 'https:'), '', $riven_settings['favicon']['url'])); ?>" type="image/x-icon" />
            <?php endif; ?>
        <?php endif;?>     
        <?php wp_head(); ?>
    </head>

    <?php
    $riven_sidebar_left = riven_get_sidebar_left();
    $riven_sidebar_right = riven_get_sidebar_right();
    $header_type = riven_get_header_type();
    $riven_layout = riven_get_layout();
    ?>

    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
            <?php if (riven_get_meta_value('show_header', true)) : ?>
                <header id="masthead" class="<?php if ($riven_settings['show-header-blog'] == 0 && (is_home() || is_singular('post'))){echo 'hide_header_blog ';}?>site-header header-v<?php echo esc_attr($header_type) ?>">
                    <?php get_template_part('headers/header_' . $header_type); ?>
                </header><!-- #masthead -->
            <?php endif; ?>
            <?php if (is_home() || is_singular('post')) :?>
                <?php riven_blog_slider();?>
            <?php endif;?>    
            <?php riven_get_page_banner();?>
            <?php get_template_part('breadcrumb'); ?>
            <div id="main" class="wrapper <?php if($riven_layout == 'fullwidth'){echo 'boxed';} ?>">
                <?php if($riven_layout == 'fullwidth') :?>
                    <div class="container">
                        <div class="row">   
                        <?php endif;?>
                        <?php get_sidebar('left'); ?>