<?php
function riven_get_post_media(){ 
    $gallery = get_post_meta(get_the_ID(), 'images_gallery', true);
    ?> 
    <?php if ( get_post_format() == 'video' ||  get_post_format() == 'audio') : ?>
        <div class="align_center">
            <div class="blog-video">
                <?php $video = get_post_meta(get_the_ID(), 'video_code', true); ?>
                <?php if ($video && $video != ''): ?>
                    <?php if(get_post_format() == 'video'){
                        echo '<div class="iframe_video_container">';
                    }
                    ?>                    
                        <?php if (strpos($video,'iframe') !== false):?>
                            <?php echo esc_html($video); ?>
                        <?php else: ?>
                            <iframe src="<?php echo esc_url(is_ssl() ? str_replace( 'http://', 'https://', $video ) : $video); ?> " <?php if(get_post_format() == 'video'){echo 'height="400"';}?>></iframe>
                        <?php endif;?>
                    <?php if(get_post_format() == 'video'){
                        echo '</div>';
                    }
                    ?> 
                <?php endif; ?>
            </div>
        </div>
    <?php elseif(has_post_format('gallery')): ?>
        <?php if (is_array($gallery) && count($gallery) > 1) : ?>
            <div class="blog-slider">               
                <div id="owl-blog"> 
                    <?php
                    $index = 0;
                    foreach ($gallery as $key => $value) :
                        $image_large = wp_get_attachment_image_src($value, 'full');
                        $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                        echo '<div class="slide"><img src="' . esc_url($image_large[0]) . '" alt="gallery-blog" class="gallery-img" width="900" height="600" /></div>';
                        $index++;
                    endforeach;
                    ?>
                </div>
                <script type="text/javascript">
                    jQuery(function($) {
                        $('#owl-blog').owlCarousel({
                            items: 1,
                            nav: true,
                            dots: true,
                            lazyLoad: true,
                            loop: true,
                            navText :[''],
                        });
                    });
                </script>
            </div>
        <?php else: ?>
            <?php if (has_post_thumbnail()): ?>
                <div class="blog-img">
                    <?php 
                    $attachment_id = get_post_thumbnail_id();
                    $attachment_single = riven_get_attachment($attachment_id, 'riven-blog-single'); 
                    ?>
                    <?php the_post_thumbnail( 'riven-blog-single' );?>
                </div>
            <?php endif;?>
        <?php endif; ?>
    <?php elseif(has_post_format('link')):?>
        <?php 
            $link = get_post_meta(get_the_ID(), 'link_code', true); 
            $link_title = get_post_meta(get_the_ID(), 'link_title', true);
        ?>
        <?php if($link && $link != ''):?>
            <figure>
                <a class="post_link" href="<?php echo esc_url(is_ssl() ? str_replace( 'http://', 'https://', $link ) : $link);?>">
                    <div class="icon_link"></div>
                    <?php if($link_title && $link_title != ''):?>
                        <span><?php echo wp_kses($link_title,array());?></span>
                    <?php endif;?> 
                </a>
            </figure>
        <?php endif;?>
    <?php elseif(has_post_format('quote')):?>
        <?php 
            $quote = get_post_meta(get_the_ID(), 'quote_code', true); 
            $quote_author = get_post_meta(get_the_ID(), 'quote_author', true); 
        ?>
        <?php if($quote && $quote != ''):?>
            <figure>
                <div class="quote_section">
                    <blockquote class="var3">
                        <?php echo wp_kses($quote,array());?>
                    </blockquote>
                    <?php if($quote_author && $quote_author != ''):?>
                        <div class="author_info">- <?php echo  wp_kses($quote_author,array());?></div>
                    <?php endif;?> 
                </div>
            </figure>
        <?php endif;?>    
    <?php else: ?>
        <?php if (has_post_thumbnail()): ?>
            <div class="blog-img">
                <?php 
                $attachment_id = get_post_thumbnail_id();
                $attachment_single = riven_get_attachment($attachment_id, 'riven-blog-single'); 
                ?>
                <?php the_post_thumbnail( 'riven-blog-single' );?>
            </div>
        <?php endif;?>
    <?php endif; 
}
function riven_post_meta_data() {
    return array(
        "description" => array(
            "name" => "description",
            "title" => esc_html__("Short Description", 'riven'),
            "desc" => esc_html__("Content for description", 'riven'),
            "type" => "editor"
        ),
        "video_code" => array(
            "name" => "video_code",
            "title" => esc_html__("Video & Audio Embed Code", 'riven'),
            "desc" => esc_html__('Enter the embed link (Youtube or Vimeo). ', 'riven'),
            "type" => "textarea",
            'display_condition' => 'post-type-video', 
        ),
        "link_code" => array(
            "name" => "link_code",
            "title" => esc_html__("Link", 'riven'),
            "desc" => esc_html__('Enter link. ', 'riven'),
            "type" => "textfield",
            'display_condition' => 'post-type-link', 
        ),
        "link_title" => array(
            "name" => "link_title",
            "title" => esc_html__("Link title", 'riven'),
            "desc" => esc_html__('Enter link title. ', 'riven'),
            "type" => "textfield",
            'display_condition' => 'post-type-link', 
        ),
        "quote_code" => array(
            "name" => "quote_code",
            "title" => esc_html__("Quote", 'riven'),
            "desc" => esc_html__('Enter quote. ', 'riven'),
            "type" => "textarea",
            'display_condition' => 'post-type-quote', 
        ),
        "quote_author" => array(
            "name" => "quote_author",
            "title" => esc_html__("Quote author", 'riven'),
            "desc" => esc_html__('Enter quote author. ', 'riven'),
            "type" => "textfield",
            'display_condition' => 'post-type-quote', 
        ),
    );
}
function riven_view_post_meta_option() {
    $meta_box = riven_post_meta_data();
    riven_show_meta_box($meta_box);
}
function riven_show_post_meta_option() {
    $meta_box = riven_default_meta_data();
    riven_show_meta_box($meta_box);
}
function riven_save_post2_meta_option($post_id) {
    $meta_box = riven_post_meta_data();
    return riven_save_meta_data($post_id, $meta_box);
}
function riven_save_post_meta_option($post_id) {
    $meta_box = riven_default_meta_data();
    return riven_save_meta_data($post_id, $meta_box);
}

function riven_add_post_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('show-meta-boxes', esc_html__('Blog Options', 'riven'), 'riven_view_post_meta_option', 'post', 'normal', 'low');
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', 'riven'), 'riven_show_post_meta_option', 'post', 'normal', 'low');
    }
}

add_action('add_meta_boxes', 'riven_add_post_metaboxes');
add_action('save_post', 'riven_save_post_meta_option');
add_action('save_post', 'riven_save_post2_meta_option');

function riven_default_post_tax_meta_data() {
    $riven_sidebar_position = riven_sidebar_position();
    $riven_sidebars = riven_sidebars();
    $riven_header_layout = riven_header_types();
    $riven_footer_layout = riven_footer_types();
    $riven_slider = riven_rev_sliders_in_array();
    return array(
        // header
        'header' => array(
            'name' => 'header',
            'title' => esc_html__('Header Layout', 'riven'),
            'type' => 'select',
            'options' => $riven_header_layout,
            'default' => 'default'
        ),
        // footer
        'footer' => array(
            'name' => 'footer',
            'title' => esc_html__('Footer Layout', 'riven'),
            'type' => 'select',
            'options' => $riven_footer_layout,
            'default' => 'default'
        ),
        // Page title
        'page_title' => array(
            'name' => 'page_title',
            'title' => esc_html__('Page Title', 'riven'),
            'desc' => esc_html__('Hide Page Title', 'riven'),
            'type' => 'checkbox'
        ),
        // Breadcrumbs
        'breadcrumbs' => array(
            'name' => 'breadcrumbs',
            'title' => esc_html__('Breadcrumbs', 'riven'),
            'desc' => esc_html__('Hide Breadcrumbs', 'riven'),
            'type' => 'checkbox'
        ),
        'show_header' => array(
            'name' => 'show_header',
            'title' => esc_html__('Header', 'riven'),
            'desc' => esc_html__('Hide header', 'riven'),
            'type' => 'checkbox'
        ),
        //  Show Footer
        'show_footer' => array(
            'name' => 'show_footer',
            'title' => esc_html__('Footer', 'riven'),
            'desc' => esc_html__('Hide footer', 'riven'),
            'type' => 'checkbox'
        ),
        'left-sidebar' => array(
            'name' => 'left-sidebar',
            'type' => 'select',
            'title' => esc_html__('Left Sidebar', 'riven'),
            'options' => $riven_sidebars,
            'default' => 'default'
        ),
        'right-sidebar' => array(
            'name' => 'right-sidebar',
            'type' => 'select',
            'title' => esc_html__('Right Sidebar', 'riven'),
            'options' => $riven_sidebars,
            'default' => 'default'
        ),
    );
}
//category taxonomy
function riven_add_categorymeta_table() {
    global $wpdb;
    $type = 'category';
    $table_name = $wpdb->prefix . $type . 'meta';
    $variable_name = $type . 'meta';
    $wpdb->$variable_name = $table_name;
    riven_create_metadata_table($table_name, $type);
}
add_action( 'init', 'riven_add_categorymeta_table' );

// category meta
add_action( 'category_add_form_fields', 'riven_add_category', 10, 2);
function riven_add_category() {
    $category_meta_boxes = riven_default_post_tax_meta_data();
    riven_show_tax_add_meta_boxes($category_meta_boxes);
}

add_action( 'category_edit_form_fields', 'riven_edit_category', 10, 2);
function riven_edit_category($tag, $taxonomy) {
    $category_meta_boxes = riven_default_post_tax_meta_data();
    riven_show_tax_edit_meta_boxes($tag, $taxonomy, $category_meta_boxes);
}

add_action( 'created_term', 'riven_save_category', 10,3 );
add_action( 'edit_term', 'riven_save_category', 10,3 );
function riven_save_category($term_id, $tt_id, $taxonomy) {
    if (!$term_id) return;
    
    $category_meta_boxes = riven_default_post_tax_meta_data();
    return riven_save_taxdata( $term_id, $tt_id, $taxonomy, $category_meta_boxes );
}

// Featured Post
//ADD THE META BOX
add_action( 'add_meta_boxes', 'riven_add_featured_slide' );
function riven_add_featured_slide(){
    //POST TYPES TO HAVE THE CUSTOM META BOX 
    $ctptypes = array( 'post', 'portfolio' );
    foreach ( $ctptypes as $ctptype ) {
        add_meta_box( 'featured-slide', 'Featured Post', 'riven_featured_slide_func', $ctptype, 'side', 'high' );
    }
}
//DEFINE THE META BOX
function riven_featured_slide_func( $post ){
    $values = get_post_custom( $post->ID );
    $check = isset( $values['special_box_check'] ) ? esc_attr( $values['special_box_check'][0] ) : '';
    wp_nonce_field( 'my_featured_slide_nonce', 'featured_slide_nonce' );
    ?>
    <p>
        <input type="checkbox" name="special_box_check" id="special_box_check" <?php checked( $check, 'on' ); ?> />
        <label for="special_box_check"><?php echo esc_html__( 'Feature', 'riven' ); ?></label>
    </p>
    <?php 
}
//SAVE THE META BOX DATA WITH THE POST
add_action( 'save_post', 'riven_featured_slide_save' );
function riven_featured_slide_save( $post_id ){
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !isset( $_POST['featured_slide_nonce'] ) || !wp_verify_nonce( $_POST['featured_slide_nonce'], 'my_featured_slide_nonce' ) ) return;
    if( !current_user_can( 'edit_post' ) ) return;
    $allowed = array( 
        'a' => array( 
            'href' => array() 
        )
    );
    // IF CHECKED SAVE THE CUSTOM META
    if ( isset( $_POST['special_box_check'] ) && $_POST['special_box_check'] ) {
        add_post_meta( $post_id, 'special_box_check', 'on', true );
    }
    // IF UNCHECKED DELETE THE CUSTOM META
    else {
        delete_post_meta( $post_id, 'special_box_check' );
    }
}

// function to display number of posts.
function riven_get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '0';
    }
    return $count;
}
 
// function to count views.
function riven_set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}