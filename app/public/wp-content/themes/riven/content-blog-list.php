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
        <?php 
        $media_type = get_post_meta(get_the_ID(), 'media_type', true); 
        $gallery = get_post_meta(get_the_ID(), 'images_gallery', true);
        ?>
        <li class="<?php echo esc_attr($blog_entry_col);?> grid-item item">
                    <div class="blog-main">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="blog-img hover-link">
                            <?php 
                            $attachment_id = get_post_thumbnail_id();
                            $attachment_grid = riven_get_attachment($attachment_id, 'riven-blog-list'); 
                            ?>
                            <a class="bg-gradient" href="<?php esc_url(the_permalink()); ?>"><img class="img-responsive" width="<?php echo esc_attr($attachment_grid['width']) ?>" height="<?php echo esc_attr($attachment_grid['height']) ?>" src="<?php echo esc_url($attachment_grid['src']) ?>" alt="<?php echo esc_attr($attachment_grid['alt']) ?>" /></a>
                        </div>
                    <?php else :?> 
                           
                    <?php endif;?>
                        <div class="blog_post_content">
                            <h3 class="title_blog">
                                <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
                                <?php  if ( is_sticky() && is_home() && ! is_paged() ):?>
                                <span class="sticky_post"><?php echo esc_html__('Featured', 'riven')?></span>
                                <?php endif;?>
                            </h3>
                            <div class="blog_info blog-info-style">
                                <span class="blog-date">
                                    <i class="fa fa-calendar"></i>
                                    <?php if( date('Yz') == get_the_time('Yz') ){
                                        echo get_the_time();
                                    }
                                    else{
                                       echo get_the_date(); 
                                    }
                                    ?>
                                </span> 
                                <span class="blog-author">
                                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                                        <?php echo get_the_author();?>
                                    </a>
                                </span> 
                                <?php edit_post_link( esc_html__( 'Edit', 'riven' ), '<span class="edit-link">', '</span>' ); ?>
                                <span class="blog-category"><?php echo get_the_category_list(', '); ?></span>
                            </div>
                            <div class="blog_post_desc">
                                <?php 
                                $desc_short = get_post_meta(get_the_ID(), 'description', true); 
                                if($desc_short){
                                   echo get_post_meta(get_the_ID(), 'description', true).' ...'; 
                               }else{
                                    echo '<div class="entry-content">';
                                    the_content();
                                    wp_link_pages( array(
                                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'riven' ) . '</span>',
                                        'after'       => '</div>',
                                        'link_before' => '<span>',
                                        'link_after'  => '</span>',
                                        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'riven' ) . ' </span>%',
                                        'separator'   => '<span class="screen-reader-text">, </span>',
                                    ) );
                                    echo '</div>';
                                }
                                 
                                ?> 
                            </div>
                        </div>  
                    </div>
                    <div class="button-readmore">
                        <a href="<?php esc_url(the_permalink());?>"><?php echo esc_html__('Read more','riven');?></a>
                    </div> 
                </li>
        <?php endwhile; ?>
    </ul>
</div>
<div class="text-center"><?php riven_pagination(); ?> </div>