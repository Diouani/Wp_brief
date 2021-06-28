        <div class="blog-content">
            <div class="blog-main">
                    <?php 
                    $media_type = get_post_meta(get_the_ID(), 'media_type', true); 
                    $gallery = get_post_meta(get_the_ID(), 'images_gallery', true);
                    ?>
                    <h3 class="title_blog">
                          <?php the_title(); ?>
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
                        <?php edit_post_link( __( 'Edit', 'riven' ), '<span class="edit-link">', '</span>' ); ?>
                        <span class="blog-category"><?php echo get_the_category_list(' '); ?></span>
                    </div>
                    <?php riven_get_post_media();?>       
                    <div class="blog_post_content">
                        <div class="blog_post_desc">
                            <?php 
                            the_content();
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'riven' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                                'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'riven' ) . ' </span>%',
                                'separator'   => '<span class="screen-reader-text">, </span>',
                            ) );
                             ?>
                        </div>
                        <div class="tagcloud">
                        <?php echo get_the_tag_list('',''); ?>
                        </div>
                        <?php riven_author_box(); ?>
                    </div>  
            </div>
            <div class="blog-comments">
                <?php comments_template('', true); ?>
            </div>
        </div>
