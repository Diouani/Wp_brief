<?php
$riven_settings = riven_check_theme_options();
$search_template = riven_get_search_form();
?>
<div class="header-contact">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="dib link-contact">
                    <?php if (!empty($riven_settings['header-contact-6'])): ?>
                        <p><a href="callto:<?php echo esc_url($riven_settings['header-contact-6']) ?>"><span class="pe-7s-headphones" style="font-size: 20px;"></span><span><?php echo esc_html__('Need help? Call us ', 'riven');?><span><?php echo $riven_settings['header-contact-6'] ?></span></span></a></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 hidden-xs">
                <div class="header-social">
                <?php 
                    $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
                    $logout_url = wp_logout_url(get_permalink($myaccount_page_id));
                    if (get_option('woocommerce_force_ssl_checkout') == 'yes') {
                        $logout_url = str_replace('http:', 'https:', $logout_url);
                    }
                 ?> 
                    <ul>
                        <li><a href="<?php echo esc_url(get_permalink($myaccount_page_id)); ?>"><?php echo esc_html__('My Account', 'riven') ?></a></li>
                        <?php if (!is_user_logged_in()): ?>
                            <li><a href="<?php echo esc_url(get_permalink($myaccount_page_id)); ?>"><?php echo esc_html__('Login / Register', 'riven') ?></a></li>
                        <?php else: ?>
                            <li><a href="<?php echo esc_url($logout_url) ?>"><?php echo esc_html__('Logout', 'riven') ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>    
    </div>        
</div>
<div class="header-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-sm-12 col-xs-12">
                <?php if ( is_front_page()) : ?><h1 class="header-logo"><?php else : ?><div class="header-logo"><?php endif; ?>
                    <a rel="home" href="<?php echo esc_url(home_url('/')); ?>">
                        <?php
                        if ($riven_settings['logo_6'] && $riven_settings['logo_6']['url']):
                            echo '<img class="" width="90" height="60" src="' . esc_url(str_replace(array('http:', 'https:'), '', $riven_settings['logo_6']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                        else:
                            bloginfo('name');
                        endif;
                        ?>
                    </a>
                <?php if ( is_front_page()) : ?></h1><?php else : ?></div><?php endif; ?>  
            </div>
            <div class="col-md-8 col-sm-12 col-xs-12 text-center">
                    <nav id="site-navigation" class="main-navigation">
                        <button class="menu-toggle"><i class="fa fa-bars"></i><span><?php echo esc_html__('Menu', 'riven') ?></span></button>
                        <?php
                        $menu_onepage = get_post_meta(get_the_ID(), 'menu_onepage', true);
                        if(!empty($menu_onepage)) :
                         ?>
                            <?php
                            if(has_nav_menu('menu_single_product')) {
                                wp_nav_menu(array(
                                    'theme_location' => 'menu_single_product',
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
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'walker' => new riven_Primary_Walker_Nav_Menu()
                                        )
                                );
                            }
                            ?>
                        <?php endif;?>
                    </nav><!-- #site-navigation -->
                    <div class="search-block-top"><?php echo $search_template; ?></div>
            </div>
            <?php if ( class_exists( 'WooCommerce' ) ) :?>
            <div class="col-md-2 col-sm-12 col-xs-12">
                <?php 
                    $minicart_template = riven_get_minicart_template();
                ?>
                <div class="right_header">
                    <ul>
                        <li class="customlinks">
                            <div id="mini-cart" class="mini-cart">
                                <?php echo $minicart_template; ?>
                            </div>
                        </li> 
                    </ul>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>    
</div>

