<?php
require_once(riven_functions . '/layout.php');
require_once(riven_functions . '/menus.php');
require_once(riven_functions . '/sidebars.php');
require_once(riven_functions . '/post_like_count.php');
require_once(riven_functions . '/vc_functions.php');
if (class_exists('Woocommerce')) {
    require_once(riven_functions . '/woocommerce.php');
    require_once(riven_functions . '/widget/riven_override_woocommerce.php');
    require_once(riven_functions . '/widget/riven_products_category.php');
}
//wiget
require_once(riven_functions . '/widget/riven_recent_posts.php');
require_once(riven_functions . '/widget/riven_recent_event.php');
require_once(riven_functions . '/widget/riven_social.php');
if ( !is_admin() ) {
    function riven_searchfilter($query) {
        if ($query->is_search && !is_admin() && $query->get( 'post_type' ) != 'product') {
            $query->set('post_type',array('post'));
        }
        return $query;
    }
    add_filter('pre_get_posts','riven_searchfilter');
}
add_filter('comment_post_redirect', 'riven_redirect_after_comment');
function riven_redirect_after_comment($location)
{
global $wpdb;
    return $_SERVER["HTTP_REFERER"]."#comment-".$wpdb->insert_id;
}
function riven_profile_toplinks(){
    global $riven_settings;
    $register_url = esc_url( get_permalink( get_page_by_title('register') ) );
    $login_url = esc_url( get_permalink( get_page_by_title('login') ) );
    ?>
    <div class="myaccount-custom myaccount-last dib">
        <a class="current-open" href="#" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/login.png" class="image-login" alt="login" />
                </a>
                <div class="dib header-profile">
                <?php 
                $current_user = wp_get_current_user();
                    if ( is_user_logged_in() ) {
                        echo '<ul>';
                            echo '<li><p>'.esc_html__('Hello, ', 'riven').$current_user->display_name.'</p></li>';
                            echo '<li><a href="'.esc_url(get_edit_user_link()).'">'.esc_html__('My account', 'riven').'</a></li>';
                            echo '<li><a href="'.wp_logout_url( home_url() ).'" title="Logout">'.esc_html__('Log out', 'riven').'</a></li>';
                            echo '</ul>';
                        } else {
                            echo '<ul>';
                            echo '<li><a href="'.esc_url($login_url).'" title="Login">'.esc_html__('Log in','riven').'</a></li>';
                            echo '<li><a href="'.esc_url($register_url).'" title="Register">'.esc_html__('Register','riven').'</a></li>';
                            echo '</ul>';
                    }
                ?>
    </div>
</div>
    <?php
}
function riven_myaccount_toplinks() {
    global $riven_settings;
    $login_url = esc_url( get_permalink( get_page_by_title('login') ) );
    ?>
        <div class="myaccount-custom myaccount-login dib">
            <a class="" href="
             <?php 
                    if ( is_user_logged_in() ) {
                            echo esc_url(get_edit_user_link());
                        } else {
                            echo esc_url($login_url);
                    }
                ?>
            " >
                <img src="<?php echo get_template_directory_uri(); ?>/images/user.png" class="image-user" alt="user" />
            </a>
        </div>
    <?php
}
 
function riven_pagination($max_num_pages = null) {
    global $wp_query, $wp_rewrite;

    $max_num_pages = ($max_num_pages) ? $max_num_pages : $wp_query->max_num_pages;

    // Don't print empty markup if there's only one page.
    if ($max_num_pages < 2) {
        return;
    }

    $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $query_args = array();
    $url_parts = explode('?', $pagenum_link);

    if (isset($url_parts[1])) {
        wp_parse_str($url_parts[1], $query_args);
    }

    $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
    $pagenum_link = trailingslashit($pagenum_link) . '%_%';

    $format = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links(array(
        'base' => $pagenum_link,
        'format' => $format,
        'total' => $max_num_pages,
        'current' => $paged,
        'end_size' => 1,
        'mid_size' => 1,
        'add_args' => array_map('urlencode', $query_args),
        'prev_text' => '<i class="fa fa-angle-left"></i>',
        'next_text' => '<i class="fa fa-angle-right"></i>',
        'type' => 'list'
            ));

    if ($links) :
        ?>
        <nav class="pagination ">
            <?php echo $links ?>        
        </nav>
        <?php
    endif;
}

function riven_get_excerpt($limit = 45) {
    global $riven_settings;

    if (!$limit) {
        $limit = 45;
    }

    if (has_excerpt()) {
        $content = strip_tags( strip_shortcodes(get_the_excerpt()) );
    } else {
        $content = strip_tags( strip_shortcodes(get_the_content()) );
    }

    $content = explode(' ', $content, $limit);

    if (count($content) >= $limit) {
        array_pop($content);
            $content = implode(" ",$content).'.....';
    } else {
        $content = implode(" ",$content);
    }

    return $content;
}
function riven_get_attachment( $attachment_id, $size = 'full' ) {
    if (!$attachment_id)
        return false;
    $attachment = get_post( $attachment_id );
    $image = wp_get_attachment_image_src($attachment_id, $size);

    if (!$attachment)
        return false;

    return array(
        'alt' => esc_attr(get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true )),
        'caption' => esc_attr($attachment->post_excerpt),
        'description' => force_balance_tags($attachment->post_content),
        'href' => get_permalink( $attachment->ID ),
        'src' => esc_url($image[0]),
        'title' => esc_attr($attachment->post_title),
        'width' => esc_attr($image[1]),
        'height' => esc_attr($image[2])
    );
}
function riven_convert_to_time_ago( $orig_time ) {
    return human_time_diff( $orig_time, current_time( 'timestamp' ) ).' '.esc_html__( 'ago', 'riven' );
}
function riven_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'riven_move_comment_field_to_bottom' );
function riven_comment_body_template($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    $orig_time = strtotime( $comment->comment_date ); 
    ?>
    <<?php echo esc_html($tag); ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
        <div class="comment-author vcard">
            <?php $author_id = $comment ->user_id; ?>
            <a href="<?php echo esc_url(get_edit_user_link( $author_id )); ?>" class="tag"><?php echo get_avatar( $author_id, 32 );?></a>
        </div>
            <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php echo esc_html__('Your comment is awaiting moderation.', 'riven'); ?></em>
            <br />
    <?php endif; ?> 
    <div class="box-comment"> 
        <div class = "name_author">
            <?php comment_author(); ?>
        </div>    
        <div class="comment-meta commentmetadata">
            <?php comment_date(); ?>  <?php comment_time(); ?>
        </div>

            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
        <?php if($depth<$args['max_depth']): ?>
        <div class="reply">
            <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            <?php edit_comment_link('<i class="fa fa-pencil"></i>', '  ', ''); ?>
        </div>
        <?php endif; ?>
    </div>    
        <?php if ('div' != $args['style']) : ?>
        </div>
    <?php endif; ?>
    <?php
}
function riven_comment_nav() {
    if (get_comment_pages_count() > 1 && get_option('page_comments')) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <div class="comment-nav-links">
        <?php
        if ($prev_link = get_previous_comments_link(esc_html__('Older', 'riven'))) :
            printf('<div class="comment-nav-previous">%s</div>', $prev_link);
        endif;

        if ($next_link = get_next_comments_link(esc_html__('Newer', 'riven'))) :
            printf('<div class="comment-nav-next">%s</div>', $next_link);
        endif;
        ?>
            </div>
        </nav>
        <?php
    endif;
}
add_filter('comment_reply_link', 'riven_reply_link_class');
function riven_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='button", $class);
    return $class;
}

//back to top
add_action( 'wp_footer', 'riven_back_to_top' );
function riven_back_to_top() {
echo '<a class="scroll-to-top smooth03"><i class="fa fa-chevron-up"></i>
</a>';
}

function riven_latest_tweets_date( $created_at ){
    $date = DateTime::createFromFormat('D M d H:i:s O Y', $created_at );
    return $date->format('g:i A - j M Y');
}
add_filter('latest_tweets_render_date', 'riven_latest_tweets_date', 10 , 1 );


function riven_get_category_page_banner() {
    global $wp_query, $header_type;
    $cat = $wp_query->get_queried_object();
    $show_slider = get_metadata('category', $cat->term_id, 'show_slider', true);
    $slider_category = get_metadata('category', $cat->term_id, 'category_slider', true); 
    $output = '';
    ob_start();
    ?>
    <?php if($show_slider) :?>
        <div class="slider_category">
          <?php echo do_shortcode( '[rev_slider alias=' . $slider_category . ']' ); ?>
        </div>
    <?php endif;?>
    <?php
    $output .= ob_get_clean();
    echo $output;
}
function riven_get_page_banner() {
    global $wp_query, $header_type;
    $cat = $wp_query->get_queried_object();
    $show_slider = get_post_meta(get_the_ID(), 'show_slider', true);
    $slider_category = get_post_meta(get_the_ID(), 'category_slider', true);
    $output = '';
    ob_start();
    ?>
    <?php if($show_slider) :?>
        <div class="main-slider">
          <?php echo do_shortcode( '[rev_slider alias=' . $slider_category . ']' ); ?>
        </div>
    <?php endif;?>
    <?php
    $output .= ob_get_clean();
    echo $output;
}
function riven_blog_slider() {
    global $wp_query, $header_type, $riven_settings;
    $cat = $wp_query->get_queried_object();
    $show_slider = isset($riven_settings['show-slider-blog'])?$riven_settings['show-slider-blog']:'';
    $slider_slug = isset($riven_settings['select-slider-blog'])?$riven_settings['select-slider-blog']:'';
    $output = '';
    ob_start();
    ?>
    <?php if($show_slider) :?>
        <div class="main-slider">
          <?php echo do_shortcode( '[rev_slider alias=' . $slider_slug . ']' ); ?>
        </div>
    <?php endif;?>
    <?php
    $output .= ob_get_clean();
    echo $output;
}

function riven_get_page_path() {
    global $wp_rewrite;

    $pagenum = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagelink = html_entity_decode(get_pagenum_link());
    $page_path = '';
    if ( !$wp_rewrite->using_permalinks() || is_admin() || strpos($pagelink, '?') ) {
        if (strpos($pagelink, '?') !== false)
            $page_path = apply_filters( 'get_pagenum_link', $pagelink . '&paged=');
        else
            $page_path = apply_filters( 'get_pagenum_link', $pagelink . '?paged=');
    } else {
        $page_path = apply_filters( 'get_pagenum_link', $pagelink . user_trailingslashit( $wp_rewrite->pagination_base . "/" ));
    }
    return $page_path;
}

?>
