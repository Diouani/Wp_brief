<?php
extract(shortcode_atts(array(
	'navbar_visible' => 'no',
	'sticky_disable' => 'no', 
    'nav_logo'  => LANDX_URI.'/images/logo-dark.png',
    'nav_menu' => '',
), $atts));

$navbar_class = ($navbar_visible == 'yes')? ' header-on' : '';
$navbar_class .= (($sticky_disable == 'yes') && ($navbar_visible == 'yes'))? '' : ' navbar-fixed-top';
?>

<!-- STICKY NAVIGATION -->
<div class="navbar navbar-inverse bs-docs-nav sticky-navigation<?php echo esc_attr($navbar_class); ?>">
	<div class="container">
		<div class="navbar-header">					
			<!-- LOGO ON STICKY NAV BAR -->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#landx-navigation">
			<span class="sr-only"><?php _e('Toggle navigation', 'landx'); ?></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($nav_logo) ?>" alt="<?php bloginfo( 'name' ); ?>"></a>					
		</div>
		
		<!-- NAVIGATION LINKS -->
		<div class="navbar-collapse collapse" id="landx-navigation">			
			<?php
				$wooli = $home_li = '';
				if ( class_exists( 'WooCommerce' ) ) {
					if(ot_get_option('cart_menu_onepage', 'off') == 'on'){
						$wooli = '<li><a class="cart-contents" href="'.WC()->cart->get_cart_url().'" title="'.__( 'View your shopping cart' ).'">'.sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ).' - '. WC()->cart->get_cart_total().'</a></li>';
					}else{
						$wooli = '';
					}

				}

				$args = array(
					'menu'            => $nav_menu,
					'container'       => '',			
					'menu_class'      => 'nav navbar-nav navbar-right main-navigation',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'landx_one_page_menu',						
					'items_wrap'      => '<ul id="%1$s" class="%2$s">'.$home_li.'%3$s'.$wooli.'</ul>'
				);

				wp_nav_menu( $args );
				
			?>
		</div>				
	</div><!-- /END CONTAINER -->			
</div><!-- /END STICKY NAVIGATION -->