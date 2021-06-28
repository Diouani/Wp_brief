<?php
/**
 * Template Name: One page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in landx consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage themecap
 * @since landx 1.0
 */

get_header('onepage'); ?>
<div id="sections-container">
<?php
global $wpdb, $post;
$pages = get_post_meta( get_the_ID(), 'pages', true );
if( !empty($pages) ):
	$i = 0;
	foreach ($pages as $key => $value):
		$alt = ( ($i % 2) == 1 )? 'bgcolor-2' : '';
		if( ($value['page_id'] != '') && ( $value['link_type'] == 'internal' ) ):
			
			$pageid = get_the_ID();
			$the_query = new WP_Query( array('p' =>$value['page_id'], 'post_type' => 'page' ) );
			while ( $the_query->have_posts() ) : $the_query->the_post(); 
			?>
			<?php
			$bg_style = get_post_meta( get_the_ID(), 'bg_style', true );
			$bg_style_class = ( ($bg_style == 'dark') || ($bg_style == 'color') )? 'cta-section '.$bg_style : 'default-cta';

			$class = array(
				'onepage-'.$pageid,
				'section'.$value['page_id'],
				$alt,
				$bg_style_class
				);
			$class[] = isset($value['section_padding'])? $value['section_padding'] : 'default-padding';


			$class = array_filter($class);



			$section_data = ( ($bg_style == 'dark') || ($bg_style == 'color') )? ' data-parallax="scroll" data-image-src="'.esc_url(get_post_meta( get_the_ID(), 'background', true )).'"' : get_template_directory_uri().'/images/bg-image-2.jpg';
			?>
			<section id="<?php echo get_the_slug($value['page_id']); ?>" class="<?php echo implode(' ', $class); ?>"<?php echo  $section_data; ?>>
				<?php echo ( ($bg_style == 'dark') || ($bg_style == 'color') )? '<div class="color-overlay">' : '';  ?>
					<div class="container">		
 					<?php get_template_part( 'content', 'onepage' ); ?>	
 					</div><!--.container-->
				<?php echo ( ($bg_style == 'dark') || ($bg_style == 'color') )? '</div>' : '';  ?>
			</section><!--#section<?php echo $value['page_id']; ?>-->
 			<?php endwhile; // end of the loop. ?>	
			<?php wp_reset_postdata(); ?>
			<?php
			$i++;
		endif; //if( $value['page_id'] != ''):
	endforeach;	
endif; //if( !empty($pages) )	
?>
</div>
<?php get_footer(); ?>