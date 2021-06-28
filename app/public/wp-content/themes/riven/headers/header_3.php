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
                        if ($riven_settings['logo'] && $riven_settings['logo']['url']):
                            echo '<img class="" width="105" height="83" src="' . esc_url(str_replace(array('http:', 'https:'), '', $riven_settings['logo']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
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
                        <?php if ( class_exists( 'WooCommerce' ) ) :?>
                            <?php 
                                $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
                                $search_template = riven_get_search_form();
                                $minicart_template = riven_get_minicart_template();
                                $logout_url = wp_logout_url(get_permalink($myaccount_page_id));
                                if (get_option('woocommerce_force_ssl_checkout') == 'yes') {
                                    $logout_url = str_replace('http:', 'https:', $logout_url);
                                }
                             ?>  
                            <div class="right_header">
                                 <ul>
                                    <?php if($riven_settings['header-search']) :?>
                                    <li class="customlinks">
                                        <div class="search-block-top"><?php echo $search_template; ?></div>
                                    </li>
                                    <?php endif;?>
                                    <?php if($riven_settings['header-myaccount']) :?>
                                    <li class="customlinks">
                                        <a href="#" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown"  onclick="toggleFilter(this)">
                                            <i class="fa fa-user"></i>
                                        </a>
                                        <div class="dib header-profile dropdown-menu content-filter">
                                            <ul>
                                                <li><a href="<?php echo esc_url(get_permalink($myaccount_page_id)); ?>"><?php echo esc_html__('My Account', 'riven') ?></a></li>
                                                <?php if (!is_user_logged_in()): ?>
                                                    <li><a href="<?php echo esc_url(get_permalink($myaccount_page_id)); ?>"><?php echo esc_html__('Login / Register', 'riven') ?></a></li>
                                                <?php else: ?>
                                                    <li><a href="<?php echo esc_url($logout_url) ?>"><?php echo esc_html__('Logout', 'riven') ?></a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </li>
                                    <?php endif;?>  
                                    <?php if($riven_settings['header-cart']) :?>
                                    <li class="customlinks">
                                        <div id="mini-cart" class="mini-cart">
                                            <?php echo $minicart_template; ?>
                                        </div>
                                    </li> 
                                    <?php endif;?>                              
                                 </ul> 
                             </div>
                        <?php endif;?>     
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

