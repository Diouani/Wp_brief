<div class="blog_item"><div class="blog-item-inner">
  <?php if ( ! post_password_required() && ! is_attachment() ) :
    global $wp_query;
    $thumb_width = 400;
    landx_post_thumb( 400, 250 );
  endif; ?>
  <div class="blog_info">
              <h3 class="blog_title"><a href="<?php echo get_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 10 ); ?></a></h3>
    <?php landx_entry_header_meta(); ?>
              <a class="blog_icons last" href="<?php echo get_permalink(); ?>"><i class="fa fa-calendar"></i><?php echo get_the_date('d M Y'); ?></a>
    <p><?php 
    $content = get_the_excerpt();
    $trimmed_content = wp_trim_words( $content, 20 );
    echo force_balance_tags($trimmed_content);
    ?></p>
    <?php 
    $readmore_text = ot_get_option('readmore_text');
    echo ( $readmore_text != '' )? '<a class="btn small" href="'.get_permalink().'">'.esc_attr($readmore_text).'</a>' : '';  ?>
  </div>
</div></div>