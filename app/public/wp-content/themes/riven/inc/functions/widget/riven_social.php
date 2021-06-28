<?php 
add_action('widgets_init', 'riven_social_load_widgets');
function riven_Social_load_widgets()
{
    register_widget('Riven_Social_Widget');
}

class Riven_Social_Widget extends WP_Widget {
	function __construct(){
        parent::__construct (
	      'riven_social_widget', 
	      'Riven Social', 
	      array(
	          'description' => 'Riven Social Widget' 
	      )
	    );
    }
    function form($instance){
    	$defaults = array(
    	 'title' => esc_html__('Social Links', 'riven'),
         'fb_social' => '#', 
         'tw_social' => '#', 
         'gp_social' => '#', 
         'lk_social' => '#',
         'yo_social' => '#', 
         'in_social' => '#',
		);
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <strong><?php echo esc_html__('Title', 'riven') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset($instance['title'])) echo esc_attr($instance['title']); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('fb_social'); ?>">
                <strong><?php echo esc_html__('Facebook', 'riven') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('fb_social'); ?>" name="<?php echo $this->get_field_name('fb_social'); ?>" value="<?php if (isset($instance['fb_social'])) echo esc_attr($instance['fb_social']); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('gp_social'); ?>">
                <strong><?php echo esc_html__('Google Plus', 'riven') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('gp_social'); ?>" name="<?php echo $this->get_field_name('gp_social'); ?>" value="<?php if (isset($instance['gp_social'])) echo esc_attr($instance['gp_social']); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tw_social'); ?>">
                <strong><?php echo esc_html__('Twitter', 'riven') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('tw_social'); ?>" name="<?php echo $this->get_field_name('tw_social'); ?>" value="<?php if (isset($instance['tw_social'])) echo esc_attr($instance['tw_social']); ?>" />
            </label>
        </p>        
        <p>
            <label for="<?php echo $this->get_field_id('lk_social'); ?>">
                <strong><?php echo esc_html__('Linkedin', 'riven') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('lk_social'); ?>" name="<?php echo $this->get_field_name('lk_social'); ?>" value="<?php if (isset($instance['lk_social'])) echo esc_attr($instance['lk_social']); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('yo_social'); ?>">
                <strong><?php echo esc_html__('Youtube', 'riven') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('yo_social'); ?>" name="<?php echo $this->get_field_name('yo_social'); ?>" value="<?php if (isset($instance['yo_social'])) echo esc_attr($instance['yo_social']); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('in_social'); ?>">
                <strong><?php echo esc_html__('Instagram', 'riven') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('in_social'); ?>" name="<?php echo $this->get_field_name('in_social'); ?>" value="<?php if (isset($instance['in_social'])) echo esc_attr($instance['in_social']); ?>" />
            </label>
        </p>
        <?php
    }
    function update($new_instance, $old_instance){
    	$instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['fb_social'] = strip_tags($new_instance['fb_social']);
        $instance['tw_social'] = $new_instance['tw_social'];
        $instance['gp_social'] = $new_instance['gp_social'];
        $instance['lk_social'] = $new_instance['lk_social'];
        $instance['yo_social'] = $new_instance['yo_social'];
        $instance['in_social'] = $new_instance['in_social'];
        return $instance;
    }
    function widget($args, $instance){
    	extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $fb_social = $instance['fb_social'];
        $tw_social = $instance['tw_social'];
        $gp_social = $instance['gp_social'];
        $lk_social = $instance['lk_social'];
        $yo_social = $instance['yo_social'];
        $in_social = $instance['in_social'];
            echo $before_widget;
            ?>	
            <?php if($title) :?>
            <h2 class="widget-title title-block"><?php echo esc_html($title);?></h2>      
			<?php endif;?>
            <ul class="social-networks">
                <?php if(isset($fb_social)&&$fb_social!=''):?>
                    <li class="social-fb first"><a href="<?php echo esc_url($fb_social);?>"><i class="fa fa-facebook"></i></a></li>
                <?php endif;?>
                <?php if(isset($gp_social)&&$gp_social!=''):?>
                    <li class="social-gg"><a href="<?php echo esc_url($gp_social);?>"><i class="fa fa-google-plus"></i></a></li>
                <?php endif;?>
                <?php if(isset($tw_social)&&$tw_social!=''):?>
                    <li class="social-twitter"><a href="<?php echo esc_url($tw_social);?>"><i class="fa fa-twitter"></i></a></li>
                <?php endif;?>
                <?php if(isset($lk_social)&&$lk_social!=''):?>
                    <li class="social-linkedin"><a href="<?php echo esc_url($lk_social);?>"><i class="fa fa-linkedin"></i></a></li>
                <?php endif;?>
                <?php if(isset($yo_social)&&$yo_social!=''):?>
                    <li class="social-youtube"><a href="<?php echo esc_url($yo_social);?>"><i class="fa fa-youtube-play"></i></a></li>
                <?php endif;?>
                <?php if(isset($in_social)&&$in_social!=''):?>
                    <li class="social-instagram"><a href="<?php echo esc_url($in_social);?>"><i class="fa fa-instagram"></i></a></li>
                <?php endif;?>
            </ul>
    	<?php echo $after_widget;

        wp_reset_postdata();	

    }
}
?>