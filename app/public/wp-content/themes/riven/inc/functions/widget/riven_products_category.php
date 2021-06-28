<?php 
add_action('widgets_init', 'riven_product_load_widgets');
function riven_product_load_widgets()
{
    register_widget('Riven_Product_Widget');
}

class Riven_Product_Widget extends WP_Widget {
	function __construct(){
        parent::__construct (
	      'riven_product_widget', 
	      'Riven Products Category', 
	      array(
	      	'classname' => 'woocommerce widget_products',
	        'description' => 'Riven Product Widget' 
	      )
	    );
    }
    function form($instance){
    	$args = array(
	        'type' => 'post',
	        'child_of' => 0,
	        'parent' => '',
	        'orderby' => 'name',
	        'order' => 'ASC',
	        'hide_empty' => false,
	        'hierarchical' => 1,
	        'exclude' => '',
	        'include' => '',
	        'number' => '',
	        'taxonomy' => 'product_cat',
	        'pad_counts' => false,
	    );
	    $categories = get_categories( $args );
	    $product_categories_dropdown = array(
	    );
	    /*if (class_exists('Vc_Vendor_Woocommerce')) {
	        $vc_vendor_wc = new Vc_Vendor_Woocommerce();
	        $vc_vendor_wc->getCategoryChilds( 0, 0, $categories, 0, $product_categories_dropdown );
	    }*/
    	$defaults = array(
    	 'title' => esc_html__('Product', 'riven'),
    	 'number' => 3, 
    	 'show_category' => 'games', 
		);
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <strong><?php echo esc_html__('Title', 'riven') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset($instance['title'])) echo esc_attr($instance['title']); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">
                <strong><?php echo esc_html__('Number of posts to show', 'riven') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php if (isset($instance['number'])) echo esc_attr($instance['number']); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_category'); ?>">
                <strong><?php echo esc_html__('Name Category', 'riven') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('show_category'); ?>" name="<?php echo $this->get_field_name('show_category'); ?>" value="<?php if (isset($instance['title'])) echo esc_attr($instance['show_category']); ?>" />
            </label>
        </p>
        <?php
    }
    function update($new_instance, $old_instance){
    	$instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = $new_instance['number'];
        $instance['show_category'] = $new_instance['show_category'];

        return $instance;
    }
    function widget($args, $instance){
    	extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        $show_category = $instance['show_category'];

        global $woocommerce, $woocommerce_loop;
        $args = array(
	        'posts_per_page' => $number,
	        'product_cat' => $show_category,
	        'post_type' => 'product',
	    );
		$products = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $args, array('per_page' => $number, 'orderby' => 'date', 'order' => 'desc')));
		if ($products->have_posts()) :

            echo $before_widget;
            ?>	
            <?php if($title) :?>
            <h2 class="widget-title title-block"><?php echo $title;?></h2>      
			<?php endif;?>
                <ul class="products row">
		            <?php while ($products->have_posts()) : $products->the_post(); ?>
		         
                        <?php wc_get_template_part( 'content', 'widget-category' ); ?>
                        
		            <?php endwhile; ?>
                </ul>
    	<?php echo $after_widget;

        endif;
        wp_reset_postdata();	

    }
}
?>