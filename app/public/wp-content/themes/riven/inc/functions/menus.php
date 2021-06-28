<?php
//Saves new custom options for navigation
add_action('wp_update_nav_menu_item', 'riven_custom_nav_update', 10, 3);

function riven_custom_nav_update($menu_id, $menu_item_db_id, $args) {
    if(isset($_POST['menu-item-use_megamenu'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_menu_item_use_megamenu', $_POST['menu-item-use_megamenu'][$menu_item_db_id]);
    }
    if(isset($_POST['menu-item-panel_column'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_menu_item_panel_column', $_POST['menu-item-panel_column'][$menu_item_db_id]);
    }
    if(isset($_POST['menu-item-mega_item_column'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_menu_item_mega_item_column', $_POST['menu-item-mega_item_column'][$menu_item_db_id]);
    }
}

//Adds value of custom option to $item object that will be passed to Riven_Walker_Nav_Menu_Edit
add_filter('wp_setup_nav_menu_item', 'riven_custom_nav_item');

function riven_custom_nav_item($menu_item) {
    $menu_item->use_megamenu = get_post_meta($menu_item->ID, '_menu_item_use_megamenu', true);
    $menu_item->panel_column = get_post_meta($menu_item->ID, '_menu_item_panel_column', true);
    $menu_item->mega_item_column = get_post_meta($menu_item->ID, '_menu_item_mega_item_column', true);
    return $menu_item;
}

add_filter('wp_edit_nav_menu_walker', 'riven_custom_nav_edit_walker', 10, 2);

function riven_custom_nav_edit_walker($walker, $menu_id) {
    return 'Riven_Walker_Nav_Menu_Edit';
}
//Add menu item options
if (!class_exists('Riven_Walker_Nav_Menu_Edit')) {
    
    class Riven_Walker_Nav_Menu_Edit extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = array() ) {}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {}
        
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( esc_html__( '%s (Invalid)', 'riven' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( esc_html__('%s (Pending)', 'riven'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		?>
		<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
			<div class="menu-item-bar">
				<div class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo esc_attr($submenu_text); ?>><?php echo esc_html__( 'sub item','riven' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up','riven'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','riven'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item','riven'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php echo esc_html__( 'Edit Menu Item','riven' ); ?></a>
					</span>
				</div>
			</div>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
				<?php if ( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php echo esc_html__( 'URL','riven' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-wide">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php echo esc_html__( 'Navigation Label','riven' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="field-title-attribute description description-wide">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php echo esc_html__( 'Title Attribute','riven' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php echo esc_html__( 'Open link in a new window/tab','riven' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php echo esc_html__( 'CSS Classes (optional)','riven' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php echo esc_html__( 'Link Relationship (XFN)','riven' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php echo esc_html__( 'Description','riven' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php echo esc_html__('The description will be displayed in the menu if the current theme supports it.','riven'); ?></span>
					</label>
				</p>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php echo esc_html__( 'Move', 'riven' ); ?></span>
						<a href="#" class="menus-move menus-move-up" data-dir="up"><?php echo esc_html__( 'Up one', 'riven' ); ?></a>
						<a href="#" class="menus-move menus-move-down" data-dir="down"><?php echo esc_html__( 'Down one', 'riven' ); ?></a>
						<a href="#" class="menus-move menus-move-left" data-dir="left"></a>
						<a href="#" class="menus-move menus-move-right" data-dir="right"></a>
						<a href="#" class="menus-move menus-move-top" data-dir="top"><?php echo esc_html__( 'To the top', 'riven' ); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( esc_html__('Original: %s', 'riven'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php echo esc_html__( 'Remove', 'riven' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo $item_id; ?>"><?php echo esc_html__('Cancel', 'riven'); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
    }

}

//Primary menu
if (!class_exists('Riven_Primary_Walker_Nav_Menu')) {

    class Riven_Primary_Walker_Nav_Menu extends Walker_Nav_Menu {

        public function start_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"children dropdown-menu\">\n";
        }
        
        protected function riven_get_megamenu_item_column_class($total = 4, $col = 1) {
            $col = $col > $total ? $total : $col;
            if($total == 5) {
                return '5-'.$col;
            }
            return 12/$total*$col;
        }

        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
            $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;
            if($item->use_megamenu && $depth == 0) {
                $classes[] = 'megamenu';
            }
            $parent_use_megamenu = false;
            if($depth == 1) {
                if($item->menu_item_parent) {
                    $parent_use_megamenu = get_post_meta($item->menu_item_parent, '_menu_item_use_megamenu', true);
                    $parent_panel_column = get_post_meta($item->menu_item_parent, '_menu_item_panel_column', true);
                    if($parent_use_megamenu) {
                        $total_col = $parent_panel_column ? $parent_panel_column : 4;
                        $num_col = $item->mega_item_column && $item->mega_item_column > 0 ? $item->mega_item_column : 1;
                    }
                }
            }
            if($args->has_children){
                $classes[] = 'page_item_has_children';
            }
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names . '>';

            $atts = array();
            $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
            $atts['href'] = !empty($item->url) ? $item->url : '';
            
            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            /** This filter is documented in wp-includes/post-template.php */
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            if($args->has_children && ($depth == 0 || ($depth == 1 && !$parent_use_megamenu))) {
                $item_output .= '<span class="dropdown-toggle caret" data-toggle="dropdown" role="menubar" aria-expanded="true"><i class="fa fa-chevron-down"></i></span>';
            }
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
        
        public function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
            $id_field = $this->db_fields['id'];
            if ( is_object( $args[0] ) ) {
                $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
            }
            return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }

    }

}
