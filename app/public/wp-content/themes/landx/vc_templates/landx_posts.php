<?php
extract(shortcode_atts(array(
    'button_text'  => 'View More',
    'button_link' => '#',
    'posts_per_page' => 10,
    'id' => '',
    'post_type'           => 'post',
    'taxonomy'            => 'category',
    'tax_term'            => false,
    'tax_operator'        => 'IN',
    'order'               => 'DESC',
    'orderby'             => 'date',
    'ignore_sticky_posts' => 'yes',
    'column'              => 3,
), $atts));

$args = array(
        'posts_per_page' => $posts_per_page,        
        'post_type'           => 'post',
        'taxonomy'            => 'category',
        'tax_term'            => explode(',', $tax_term),
        'tax_operator'        => $tax_operator,
        'post_parent' => false,
        'order'               => $order,
        'orderby'             => $orderby,
        'ignore_sticky_posts' => ($ignore_sticky_posts == 'yes')? true : false,
    );
if( $id != '' ){
    $args['post__in']    = explode(',', $id);
}


// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) :
    echo '<div class="posts-carousel-wrap text-center"><div class="posts-carousel owl-carousel">';
    while ( $the_query->have_posts() ) :
        $the_query->the_post();       
         get_template_part('content/post', 'grid') ;

    endwhile; 
    wp_reset_postdata(); 
    echo '</div></div>';
    ?>

    <?php if( $button_text != '' ): ?>
    <div class="h30"></div>
    <div class="text-center blog-button-group">
        <a class="btn standard-button" href="<?php echo esc_url($button_link); ?>"><?php echo esc_attr($button_text) ?></a>
    </div>
    <?php endif; ?>
<?php endif; ?>    