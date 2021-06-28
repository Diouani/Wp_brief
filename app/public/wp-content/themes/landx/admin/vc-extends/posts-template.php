<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'landx_latest_posts_shortcode_vc');
function landx_latest_posts_shortcode_vc() {	
	
	vc_map( 
		array(
			'icon' => 'landx-icon',
			'name' => __('Posts carousel', 'landx'),
			'base' => 'landx_posts',
			'class' => 'landx-vc',
			'category' => __('LandX', 'landx'),
			'description' => __('Display posts carousel', 'landx'),
			'class' => 'landx-vc',
			'params' => array(
				array(
					'type' => 'number',
					'heading' => __('Posts per page', 'landx'),
					'param_name' => 'posts_per_page',
					'value' => 10,
					'min' => '-1',
					'max' => '100',
					'step' => '1',
					'description' => 'Specify number of posts that you want to show. Enter -1 to get all posts',
					'admin_label' => true
				),
				array(
					'type' => 'number',
					'heading' => __('Column', 'landx'),
					'param_name' => 'column',
					'value' => 3,
					'min' => 1,
					'step' => 1,
					'step' => 6,
				),
				array(
					'type' => 'textfield',
					'heading' => __('Button Title', 'landx'),
					'param_name' => 'button_text',
					'value' => 'View More',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Button Link', 'landx'),
					'param_name' => 'button_link',
					'value' => '#',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Post ID\'s', 'landx'),
					'param_name' => 'id',
					'value' => '',
					'description' => 'Enter comma separated ID\'s of the posts that you want to show',
					'group' => 'Posts Settings'
				),				
				array(
					'type' => 'perch_select',
					'multiple' => 'multiple',
					'heading' => __('Select category', 'landx'),
					'param_name' => 'tax_term',
					'value' =>  landx_get_terms(),
					'group' => 'Posts Settings'
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Taxonomy term operator', 'landx'),
					'param_name' => 'tax_operator',
					'description' => 'IN - posts that have any of selected categories terms<br/>NOT IN - posts that is does not have any of selected terms<br/>AND - posts that have all selected terms',
					'value' =>  array(
							'IN' => 'IN',
							'NOT IN' => 'NOT IN',
							'AND' => 'AND',
						),
					'group' => 'Posts Settings'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Authors', 'landx'),
					'param_name' => 'author',
					'description' => 'Enter here comma-separated list of author\'s IDs. Example: 1,7,18',					
					'group' => 'Posts Settings'
				),
				array(
					'type' => 'perch_select',
					'heading' => __('Order', 'landx'),
					'param_name' => 'tax_term',
					'description' => 'Posts order',
					'value' =>  array(
								'desc' => __( 'Descending', 'landx' ),
								'asc' => __( 'Ascending', 'landx' )
							),
					'group' => 'Posts Settings'
				),
				array(
					'type' => 'perch_select',
					'heading' => __('Order by', 'landx'),
					'param_name' => 'orderby',
					'description' => 'Order posts by',
					'selected' => 'date',
					'value' =>  array(
								'none' => __( 'None', 'landx' ),
								'id' => __( 'Post ID', 'landx' ),
								'author' => __( 'Post author', 'landx' ),
								'title' => __( 'Post title', 'landx' ),
								'name' => __( 'Post slug', 'landx' ),
								'date' => __( 'Date', 'landx' ), 
								'modified' => __( 'Last modified date', 'landx' ),
								'parent' => __( 'Post parent', 'landx' ),
								'rand' => __( 'Random', 'landx' ), 
								'comment_count' => __( 'Comments number', 'landx' ),
								'menu_order' => __( 'Menu order', 'landx' ), 'meta_value' => __( 'Meta key values', 'landx' ),
							),
					'group' => 'Posts Settings'
				),
				array(
					'type' => 'perch_select',
					'heading' => __('Ignore sticky', 'landx'),
					'param_name' => 'ignore_sticky_posts',
					'description' => 'Select Yes to ignore posts that is sticked',
					'value' =>  array(
								'no' => __( 'No', 'landx' ),
								'yes' => __( 'Yes', 'landx' )
							),
					'group' => 'Posts Settings'
				),
				
				
			)
		) 
	);
	
}
class WPBakeryShortCode_Landx_posts extends WPBakeryShortCode {
}