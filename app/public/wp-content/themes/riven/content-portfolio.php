<?php 
$taxonomy_names = get_object_taxonomies('portfolio');
if (is_array($taxonomy_names) && count($taxonomy_names) > 0 && in_array('portfolio_cat', $taxonomy_names)) {
    $terms = get_terms('portfolio_cat', array('hide_empty' => false,));
}
$current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
?>
<div class="portfolio-showcase">
    <?php if (is_array( $terms ) && count( $terms ) > 0 ) : ?>
        <div id="options">
            <div id="filters" class="button-group js-radio-button-group text-center">
                <button class="is-checked" data-filter="*"><?php echo esc_html__('Latest Projects','riven'); ?></button> 
              
                <?php foreach ( $terms as $key => $term ) : ?> 
                    
                    <button data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo $term->name; ?></button>
                   
                <?php endforeach;?>  
            </div>
        </div> 
    <?php endif;?> 
    <div class="portfolio-entry-wrap isotope">
        <?php while (have_posts()) : the_post(); ?>
        <?php 
            $attachment_id = get_post_thumbnail_id();
            $attachment_portfolio = riven_get_attachment($attachment_id, 'portfolio-grid'); 
            $post_term_arr = get_the_terms( get_the_ID(), 'portfolio_cat' );
            $post_term_filters = '';
            $post_term_names = '';
            if (is_array($post_term_arr) || is_object($post_term_arr)){
                foreach ( $post_term_arr as $post_term ) {

                    $post_term_filters .= $post_term->slug . ' ';
                    $post_term_names .= $post_term->name . ', ';
                }
            }
            $post_term_filters = trim( $post_term_filters );
            $post_term_names = substr( $post_term_names, 0, -2 );
            $link_project = get_post_meta(get_the_ID(), 'link_project', true);
            $featuredImage = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
        ?>
        	<div class="col-md-3 col-sm-4 col-xs-6 no-padding item <?php echo esc_attr($post_term_filters);?>">
                <div class="portfolio_box">
                    <div class="portfolio-img">     
                        <img class="img-responsive" width="<?php echo esc_attr($attachment_portfolio['width']) ?>" height="<?php echo esc_attr($attachment_portfolio['height']) ?>" src="<?php echo esc_url($attachment_portfolio['src']) ?>" alt="portfolio-img" />
                    </div>
                    <div class="portfolio_info_box text-center">
                        <div class="portfolio_top_content">
                            <a href="<?php the_permalink(); ?>" class="name-portfolio">
                                <?php the_title();?>
                            </a>    
                            <div class="portfolio-category"><?php echo $post_term_names; ?></div>
                        </div>     
                    </div>
                    <div class="portfolio_bottom_content">   
                            <a href="<?php echo esc_url($featuredImage); ?>" rel="portfolio_gallery" class="portfolio-zoom portfolio-lightbox"><i class="fa fa-search" aria-hidden="true"></i></a>
                            <a class="portfolio-link" href="<?php echo esc_url($link_project);?>">
                                <i class="fa fa-link"></i>
                            </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php if ($wp_query->max_num_pages > 1) : ?>
        <div class="portfolio-loadmore text-center">
            <a data-paged="<?php echo esc_attr($current_page) ?>" data-totalpage="<?php echo esc_attr($wp_query->max_num_pages) ?>" id="portfolio-loadmore" class="btn btn-default"><?php echo esc_html__('Load More', 'riven') ?> </a>
        </div>
    <?php endif; ?>    
</div>    
       