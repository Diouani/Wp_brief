<?php 
    $riven_settings = riven_check_theme_options();
    $riven_sidebar_left = riven_get_sidebar_left();
    $riven_sidebar_right = riven_get_sidebar_right();
    switch ( $riven_settings['blog-archive-column'] ) {
    case '4':
        $blog_entry_col = 'col-md-3 col-sm-4 col-xs-12';
        break;  
    case '3':
        $blog_entry_col = 'col-md-4 col-sm-6 col-xs-12';
        break;
    case '2':
        $blog_entry_col = 'col-md-6 col-sm-6 col-xs-12';
        break;
    default:
        $blog_entry_col = 'col-md-12 col-sm-12 col-xs-12';
        break;
    }
    $current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
?>
<div class="blog-content <?php if($riven_sidebar_left || $riven_sidebar_right){echo "row";}?>">
    <ul id="content-post" class="blog_post blog-entries-wrap grid_blog">
        <?php while (have_posts()) : the_post(); ?>
        <li class="<?php echo esc_attr($blog_entry_col);?> grid-item item">     
            <div class="blog_post_content">
                <h3 class="title_blog">
                    <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
                    <?php  if ( is_sticky() && is_home() && ! is_paged() ):?>
                    <span class="sticky_post"><?php echo esc_html__('Featured', 'riven')?></span>
                    <?php endif;?>
                </h3>
            </div>  
        </li>
        <?php endwhile; ?>
    </ul>
</div>
<div class="text-center"><?php riven_pagination(); ?> </div>