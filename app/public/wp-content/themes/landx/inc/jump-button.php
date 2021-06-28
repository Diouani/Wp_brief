<?php
    global $post;
    $jump_button = get_post_meta( get_the_ID(), 'jump_button', true );
    $button_animation = get_post_meta( get_the_ID(), 'button_animation', true );
    if( $jump_button == 'on' ):
        $buttons = get_post_meta( get_the_ID(), 'buttons', true );
        if( !empty($buttons) ){
            echo '<div class="cta-section button-container'.$button_animation.'" id="cta-5">';
            foreach ($buttons as $key => $value) {
                $link = ( $value['link_type'] == 'inner' )? '#'.get_the_slug($value['page_id']) : get_permalink($value['page_id']);
                $link = ( $value['link_type'] == 'customlink' )? $value['custom_url'] : $link ;
                $display_button_icon = isset($value['display_button_icon'])? $value['display_button_icon'] : 'off';
                $icon = ($display_button_icon == 'on')? landx_ot_get_icon($value['button_icon']).'&nbsp;&nbsp;' : '';

                echo '<a class="btn '.$value['button_type'].' link-type-'.$value['link_type'].'" href="'.esc_url($link).'">'.$icon.esc_attr($value['title']).'</a>';
            }
            echo '</div>';
        }
    endif;
?>