<?php
$post_id = get_option( 'woocommerce_shop_page_id' );
$title = get_the_title( $post_id );
$custom_title = get_post_meta( $post_id, 'custom_title', true );
if( $custom_title == 'on' ){
	$alt_title = get_post_meta( $post_id, 'title', true );
	$title = ( $alt_title != '' )? $alt_title : $title;

	$subtitle = get_post_meta( get_the_ID(), 'subtitle', true );
	$subtitle = ( $subtitle != '' )? '<div class="blog-description">'.esc_attr($subtitle).'</div>' : '';
}
if($custom_title != 'off'):
?>
<div class="color-overlay">
	<div class="blog-intro">
		<div class="container">
			<h1 class="blog-title intro white-text"><?php echo force_balance_tags($title); ?></h1>		
			<?php echo $subtitle; ?>		
			<?php  
				$show_breadcrumbs = (function_exists('ot_get_option'))? ot_get_option('show_breadcrumbs', 'off') : 'off';
  				if( $show_breadcrumbs != 'off' )landx_breadcrumbs(); 
  			?>
		</div>
	</div>
</div>
<?php endif; ?>

