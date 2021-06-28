<?php
$riven_settings = riven_check_theme_options();
?>
<div class="header-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-9 col-xs-12">
                <div class="dib link-contact">
                    <?php if (!empty($riven_settings['header-address'])): ?>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i><span><?php echo $riven_settings['header-address'] ?></span></p>
                    <?php endif; ?>
                    <?php if (!empty($riven_settings['header-phone-number'])): ?>
                        <p><a href="tel:+<?php echo $riven_settings['header-phone-number'] ?>"><i class="fa fa-phone"></i><span><?php echo $riven_settings['header-phone-number'] ?></span></a></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6 col-sm-3 hidden-xs">
                <div class="header-social">
                    <ul>
                        <?php if (!empty($riven_settings['social-facebook'])): ?>
                            <li><a href="<?php echo esc_url($riven_settings['social-facebook']) ?>" title="facebook"><i class="fa fa-facebook"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($riven_settings['social-twitter'])): ?>
                            <li><a href="<?php echo esc_url($riven_settings['social-twitter']) ?>" title="twitter"><i class="fa fa-twitter"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($riven_settings['social-linkedin'])): ?>
                            <li><a href="<?php echo esc_url($riven_settings['social-linkedin']) ?>" title="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($riven_settings['social-pinterest'])): ?>
                            <li><a href="<?php echo esc_url($riven_settings['social-pinterest']) ?>" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($riven_settings['social-instagram'])): ?>
                            <li><a href="<?php echo esc_url($riven_settings['social-instagram']) ?>" title="instagram"><i class="fa fa-instagram"></i></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>    
    </div>        
</div>
<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-12 col-xs-12">
                <?php if ( is_front_page()) : ?><h1 class="header-logo"><?php else : ?><div class="header-logo"><?php endif; ?>
                    <a rel="home" href="<?php echo esc_url(home_url('/')); ?>">
                        <?php
                        if ($riven_settings['logo_5'] && $riven_settings['logo_5']['url']):
                            echo '<img class="" width="156" height="48" src="' . esc_url(str_replace(array('http:', 'https:'), '', $riven_settings['logo_5']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
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
                    </nav><!-- #site-navigation -->
            </div>
        </div>
    </div>    
</div>

