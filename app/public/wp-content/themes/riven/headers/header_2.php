<?php
$riven_settings = riven_check_theme_options();
?>
<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-6 col-xs-4">
                <?php if ( is_front_page()) : ?><h1 class="header-logo"><?php else : ?><div class="header-logo"><?php endif; ?>
                    <a rel="home" href="<?php echo esc_url(home_url('/')); ?>">
                        <?php
                        if ($riven_settings['logo'] && $riven_settings['logo']['url']):
                            echo '<img class="" width="90" height="72" src="' . esc_url(str_replace(array('http:', 'https:'), '', $riven_settings['logo']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                        else:
                            bloginfo('name');
                        endif;
                        ?>
                    </a>
                <?php if ( is_front_page()) : ?></h1><?php else : ?></div><?php endif; ?>  
                <?php if ($riven_settings['header-sticky']) :?>
                <div class="header-sticky-logo">
                    <a rel="home" href="<?php echo esc_url(home_url('/')); ?>">
                        <?php
                        if ($riven_settings['logo-header-sticky'] && $riven_settings['logo-header-sticky']['url']):
                            echo '<img class="" width="120" height="95" src="' . esc_url(str_replace(array('http:', 'https:'), '', $riven_settings['logo-header-sticky']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                        else:
                            bloginfo('name');
                        endif;
                        ?>
                    </a>
                </div>
                <?php  endif;?>
            </div>
            <div class="col-md-10 col-sm-6 col-xs-8">
                    <nav id="site-navigation" class="main-navigation">
                        <button class="menu-toggle"><i class="fa fa-bars"></i><span><?php echo esc_html__('Menu', 'riven') ?></span></button>
                        <?php
                        $menu_onepage = get_post_meta(get_the_ID(), 'menu_onepage', true);
                        if(!empty($menu_onepage)) :
                         ?>
                            <?php
                            if(has_nav_menu('menu_gamelanding')) {
                                wp_nav_menu(array(
                                    'theme_location' => 'menu_gamelanding',
                                    'menu_class' => 'mega-menu',
									'container_class' => 'menu-container',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'walker' => new riven_Primary_Walker_Nav_Menu()
                                        )
                                );
                            }
                            ?>
                        <?php else :?>
                            <?php
                            if(has_nav_menu('menu_primary')) {
                                wp_nav_menu(array(
                                    'theme_location' => 'menu_primary',
                                    'menu_class' => 'mega-menu',
									'container_class' => 'menu-container',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'walker' => new riven_Primary_Walker_Nav_Menu()
                                        )
                                );
                            }
                            ?>
                        <?php endif;?>
                    </nav><!-- #site-navigation -->
            </div>
        </div>
    </div>    
</div>

