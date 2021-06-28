<?php
$riven_settings = riven_check_theme_options();
?>
<div class="header-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-sm-12 col-xs-12">
                <?php if ( is_front_page()) : ?><h1 class="header-logo"><?php else : ?><div class="header-logo"><?php endif; ?>
                    <a rel="home" href="<?php echo esc_url(home_url('/')); ?>">
                        <?php
                        if ($riven_settings['logo_4'] && $riven_settings['logo_4']['url']):
                            echo '<img class="" width="80" height="66" src="' . esc_url(str_replace(array('http:', 'https:'), '', $riven_settings['logo_4']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                        else:
                            bloginfo('name');
                        endif;
                        ?>
                    </a>
                <?php if ( is_front_page()) : ?></h1><?php else : ?></div><?php endif; ?>  
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
                    <nav id="site-navigation" class="main-navigation">
                        <button class="menu-toggle"><i class="fa fa-bars"></i><span><?php echo esc_html__('Menu', 'riven') ?></span></button>
                        <?php if($riven_settings['header-link']) :?>
                            <div class="right_header hidden-xs">
                                <a href="<?php echo esc_url($riven_settings['header-link']);?>"><?php echo  esc_html__('Go KickStarter', 'riven');?></a>
                            </div>
                        <?php endif;?>
                        <?php
                        $menu_onepage = get_post_meta(get_the_ID(), 'menu_onepage', true);
                        if(!empty($menu_onepage)) :
                         ?>
                            <?php
                            if(has_nav_menu('menu_startup')) {
                                wp_nav_menu(array(
                                    'theme_location' => 'menu_startup',
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

