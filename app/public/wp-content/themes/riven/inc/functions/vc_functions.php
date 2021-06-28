<?php 
function riven_shortcode_js_remove_wpautop( $content, $autop = false ) {

    if ( $autop ) {
        $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }

    return do_shortcode( shortcode_unautop( $content ) );
}
function riven_iconpicker_type_pestrokefont( $icons ) {
    $pestrokefont_icons = array(
        array( 'pe-7s-paint-bucket' => 'Bucket'),
        array( 'pe-7s-way' => 'Way' ),
        array( 'pe-7s-cup' => 'Cup' ),
        array( 'pe-7s-arc' => 'Archor' ),
        array( 'pe-7s-plane' => 'Plane' ),
        array( 'pe-7s-help2' => 'Help' ),
        array( 'pe-7s-clock' => 'Clock' ),
        array( 'pe-7s-refresh' => 'Refresh' ),
        array( 'pe-7s-album' => 'Album' ),
        array( 'pe-7s-diamond' => 'Diamond' ),
        array( 'pe-7s-door-lock' => 'Door lock' ),
        array( 'pe-7s-photo' => 'Photo' ),
        array( 'pe-7s-settings' => 'Settings' ),
        array( 'pe-7s-volume' => 'Volumn' ),
        array( 'pe-7s-users' => 'Users' ),
        array( 'pe-7s-tools' => 'Tools' ),
        array( 'pe-7s-star' => 'Star' ),
        array( 'pe-7s-like2' => 'Like' ),
        array( 'pe-7s-map-2' => 'Map 2' ),
        array( 'pe-7s-call' => 'Call' ),
        array( 'pe-7s-mail' => 'Mail' ),
    );

    return array_merge( $icons, $pestrokefont_icons );
}

add_filter( 'vc_iconpicker-type-pestrokefont', 'riven_iconpicker_type_pestrokefont' );

function riven_vc_icon() {
    $attributes = array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Position icon", 'riven'),
            "param_name" => "position",
            'std' => 'list',
            'value' => array(
                esc_html__('Icon Center', 'riven') => 'center',
                esc_html__('Icon Left', 'riven') => 'left',
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Icon library', 'riven'),
            'value' => array(
                esc_html__('Font Awesome', 'riven') => 'fontawesome',
                esc_html__('Stroke Icons 7', 'riven') => 'pestrokefont',
                esc_html__('Open Iconic', 'riven') => 'openiconic',
                esc_html__('Typicons', 'riven') => 'typicons',
                esc_html__('Entypo', 'riven') => 'entypo',
                esc_html__('Linecons', 'riven') => 'linecons',
            ),
            'admin_label' => true,
            'param_name' => 'type',
            'weight' => 10,
            'description' => esc_html__('Select icon library.', 'riven'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'riven'),
            'param_name' => 'icon_pestrokefont',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'pestrokefont',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'pestrokefont',
            ),
            'weight' => 9,
            'description' => esc_html__('Select icon from library.', 'riven'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'riven'),
            'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-adjust', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000,
            // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'fontawesome',
            ),
            'description' => esc_html__('Select icon from library.', 'riven'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'riven'),
            'param_name' => 'icon_openiconic',
            'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'openiconic',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'openiconic',
            ),
            'description' => esc_html__('Select icon from library.', 'riven'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'riven'),
            'param_name' => 'icon_typicons',
            'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'typicons',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'typicons',
            ),
            'description' => esc_html__('Select icon from library.', 'riven'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'riven'),
            'param_name' => 'icon_entypo',
            'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'entypo',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'entypo',
            ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'riven'),
            'param_name' => 'icon_linecons',
            'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'linecons',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'linecons',
            ),
            'description' => esc_html__('Select icon from library.', 'riven'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon alignment', 'riven' ),
            'param_name' => 'align',
            'value' => array(
                esc_html__( 'Left', 'riven' ) => 'left',
                esc_html__( 'Right', 'riven' ) => 'right',
                esc_html__( 'Center', 'riven' ) => 'center',
                esc_html__( 'Inline', 'riven' ) => 'inline',
            ),
            'description' => esc_html__( 'Select Box icon alignment.', 'riven' ),
             "group"     => "Icon Style",
        ),
        array(
            'type' => 'number',
            'heading' => esc_html__( 'Size', 'riven' ),
            'param_name' => 'size',
            "value" => "14",
            'description' => esc_html__( 'Icon size (px)', 'riven' ),
             "group"     => "Icon Style",
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => esc_html__("Border Style", "riven"),
            "param_name" => "icon_border_style",
            "value" => array(
                esc_html__("None","riven") => "none",
                esc_html__("Solid","riven")   => "solid",
                esc_html__("Dashed","riven") => "dashed",
                esc_html__("Dotted","riven") => "dotted",
                esc_html__("Double","riven") => "double",
                esc_html__("Inset","riven") => "inset",
                esc_html__("Outset","riven") => "outset",
            ),
            "description" => esc_html__("Select the border style for icon.","riven"),
            "dependency" => Array("element" => "background_style", "value" => array("rounded-outline","boxed-outline", "rounded-less-outline")),
            "group"     => "Icon Style",
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Enable hover state for icon', 'riven' ),
            'param_name' => 'icon_hover',
            'value' => true,
             "group"     => "Icon Style",
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Content", "riven" ),
            "param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
            "description" => esc_html__( "Enter your content.", "riven" ),
            'group' => esc_html__( 'Content', 'riven' )
        )
    );

    vc_add_params('vc_icon', $attributes);

}

add_action('vc_before_init', 'riven_vc_icon');

function riven_vc_progress_bar() {
    $attributes = array(
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Values', 'riven' ),
            'param_name' => 'values',
            'description' => esc_html__( 'Enter values for graph - value, title and color.', 'riven' ),
            'value' => urlencode( json_encode( array(
                array(
                    'label' => esc_html__( 'Development', 'riven' ),
                    'value' => '90',
                ),
                array(
                    'label' => esc_html__( 'Design', 'riven' ),
                    'value' => '80',
                ),
                array(
                    'label' => esc_html__( 'Marketing', 'riven' ),
                    'value' => '70',
                ),
            ) ) ),

            'params' => array(
                
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__('Icon', 'riven'),
                    'param_name' => 'icon_fontawesome',
                    'value' => 'fa fa-adjust', // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false,
                        // default true, display an "EMPTY" icon?
                        'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value' => 'fontawesome',
                    ),
                    'description' => esc_html__('Select icon from library.', 'riven'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Label', 'riven' ),
                    'param_name' => 'label',
                    'description' => esc_html__( 'Enter text used as title of bar.', 'riven' ),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Value', 'riven' ),
                    'param_name' => 'value',
                    'description' => esc_html__( 'Enter value of bar.', 'riven' ),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Color', 'riven' ),
                    'param_name' => 'color',
                    'value' => array(
                            esc_html__( 'Default', 'riven' ) => '',
                        ) + array(
                            esc_html__( 'Classic Grey', 'riven' ) => 'bar_grey',
                            esc_html__( 'Classic Blue', 'riven' ) => 'bar_blue',
                            esc_html__( 'Classic Turquoise', 'riven' ) => 'bar_turquoise',
                            esc_html__( 'Classic Green', 'riven' ) => 'bar_green',
                            esc_html__( 'Classic Orange', 'riven' ) => 'bar_orange',
                            esc_html__( 'Classic Red', 'riven' ) => 'bar_red',
                            esc_html__( 'Classic Black', 'riven' ) => 'bar_black',
                        ) + getVcShared( 'colors-dashed' ) + array(
                            esc_html__( 'Custom Color', 'riven' ) => 'custom',
                        ),
                    'description' => esc_html__( 'Select single bar background color.', 'riven' ),
                    'admin_label' => true,
                    'param_holder_class' => 'vc_colored-dropdown',
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__( 'Custom color', 'riven' ),
                    'param_name' => 'customcolor',
                    'description' => esc_html__( 'Select custom single bar background color.', 'riven' ),
                    'dependency' => array(
                        'element' => 'color',
                        'value' => array( 'custom' ),
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__( 'Custom text color', 'riven' ),
                    'param_name' => 'customtxtcolor',
                    'description' => esc_html__( 'Select custom single bar text color.', 'riven' ),
                    'dependency' => array(
                        'element' => 'color',
                        'value' => array( 'custom' ),
                    ),
                ),
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Show icon", 'riven'),
            "param_name" => "show",
            'std' => 'list',
            'value' => array(
                esc_html__('Hidden Icon', 'riven') => 'hidden',
                esc_html__('Display Icon', 'riven') => 'display',
            ),
        ),
    );

    vc_add_params('vc_progress_bar', $attributes);

}

add_action('vc_before_init', 'riven_vc_progress_bar');

function riven_vc_column() {
    $attributes = array(
        array(
            "type" => "dropdown",
                "heading" => esc_html__("Show Background Top", "riven"),
                "param_name" => "border_top",
                'std' => 'none',
                'value' => array(
                    esc_html__('No', 'riven') => 'none',
                    esc_html__('Yes', 'riven') => 'bg_top',
                ),
        ),
        array(
            "type" => "dropdown",
                "heading" => esc_html__("Show Background Gradient", "riven"),
                "param_name" => "bg_gradient",
                'std' => 'none',
                'value' => array(
                    esc_html__('No', 'riven') => 'none',
                    esc_html__('Yes', 'riven') => 'bg-grad',
                ),
        ),
    );
    vc_add_params('vc_column', $attributes);
}

add_action('vc_before_init', 'riven_vc_column');