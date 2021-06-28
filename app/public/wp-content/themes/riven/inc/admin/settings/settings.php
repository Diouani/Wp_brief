<?php

/**
 * Riven Settings Options
 */
if (!class_exists('Framework_riven_Settings')) {

    class Framework_riven_Settings {

        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }

        public function initSettings() {
            $this->ReduxFramework = new ReduxFramework($this->riven_get_setting_sections(), $this->riven_get_setting_arguments());
        }

        public function riven_get_setting_sections() {
            $page_layout = riven_layouts();
            $sidebar_positions = riven_sidebar_position();
            unset($page_layout['default']);
            unset($sidebar_positions['default']);

            $sections = array(
                array(
                    'icon' => 'el-icon-dashboard',
                    'icon_class' => 'icon',
                    'title' => esc_html__('General', 'riven'),
                    'fields' => array(
                        array(
                            'id' => '1',
                            'type' => 'info',
                            'desc' => esc_html__('Layout default', 'riven')
                        ),
                        array(
                            'id' => 'layout',
                            'type' => 'button_set',
                            'title' => esc_html__('Layout', 'riven'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                        array(
                            'id' => 'left-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'riven'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'right-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'riven'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => '1',
                            'type' => 'info',
                            'desc' => esc_html__('Logo, Icon', 'riven')
                        ),
                        array(
                            'id' => 'logo',
                            'type' => 'media',
                            'url' => true,
                            'readonly' => false,
                            'title' => esc_html__('Logo', 'riven'),
                            'desc' => esc_html__('Logo for riven', 'riven'),
                            'required' => array('header-type', 'equals', array(
                                '1',
                                '2',
                                '3',
                            )),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/logo.png',
                            )
                        ),
                        array(
                            'id' => 'logo_4',
                            'type' => 'media',
                            'url' => true,
                            'readonly' => false,
                            'title' => esc_html__('Logo', 'riven'),
                            'required' => array('header-type', 'equals', array(
                                '4'
                            )),
                            'desc' => esc_html__('Logo for Header 4 (80px X 66px)', 'riven'),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/logo_4.png',
                            )
                        ),
                        array(
                            'id' => 'logo_5',
                            'type' => 'media',
                            'url' => true,
                            'readonly' => false,
                            'title' => esc_html__('Logo For Header 5', 'riven'),
                            'required' => array('header-type', 'equals', array(
                                '5'
                            )),
                            'desc' => esc_html__('Logo for Header 5 (156px X 48px)', 'riven'),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/logo_5.png',
                            )
                        ),
                        array(
                            'id' => 'logo_6',
                            'type' => 'media',
                            'url' => true,
                            'readonly' => false,
                            'title' => esc_html__('Logo For Header 6', 'riven'),
                            'required' => array('header-type', 'equals', array(
                                '6'
                            )),
                            'desc' => esc_html__('Logo for Header 6 (90px X 60px)', 'riven'),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/logo_6.png',
                            )
                        ),
                        array(
                            'id' => 'favicon',
                            'type' => 'media',
                            'url' => true,
                            'readonly' => false,
                            'title' => esc_html__('Favicon', 'riven'),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/favicon.ico'
                            )
                        ),
                        array(
                            'id' => 'js-code',
                            'type' => 'ace_editor',
                            'title' => esc_html__('JS Code', 'riven'),
                            'subtitle' => esc_html__('Paste your JS code here.', 'riven'),
                            'mode' => 'javascript',
                            'theme' => 'chrome',
                            'default' => ""
                        )
                    )
                ),    
                array(
                    'icon' => 'el-icon-css',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Skin', 'riven'),
                    'fields' => array(
                        array(
                            'id' => 'compile-css',
                            'type' => 'switch',
                            'title' => esc_html__('Compile CSS', 'riven'),
                            'default' => false
                        ),
                    )
                ),
                array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('General', 'riven'),
                    'fields' => array(
                        array(
                            'id'=>'general-bg',
                            'type' => 'background',
                            'title' => esc_html__('General Background', 'riven'),
                            'default' => array(
                                'background-color' => '#f2f2f2',
                                'background-image' => '',
                                'background-size' => 'inherit',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'inherit'
                            )
                        ),
                        array(
                            'id'=>'general-font',
                            'type' => 'typography',
                            'title' => esc_html__('General Font', 'riven'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'default'=> array(
                                'color'=>"#787878",
                                'google'=>true,
                                'font-weight'=>'400',
                                'font-family'=>'Lato',
                                'font-size'=>'14px',
                                'line-height' => '23px'
                            ),
                        ),
                        array(
                            'id'=>'primary-color',
                            'type' => 'color',
                            'title' => esc_html__('Primary color', 'riven'),
                            'default' => '#ff2759',
                            'validate' => 'color',
                            'transparent' => false
                        ),
                        array(
                            'id'=>'highlight-color',
                            'type' => 'color',
                            'title' => esc_html__('Highlight color', 'riven'),
                            'default' => '#700877',
                            'validate' => 'color',
                            'transparent' => false
                        ),
                    )
                ),
                array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Footer', 'riven'),
                    'fields' => array(
                        array(
                            'id'=>'footer-bg-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer background color', 'riven'),
                            'required' => array('footer-type', 'equals', array(
                                    '3',
                                )),
                            'default' => '#0c000e',
                            'validate' => 'color',
                        ),
                        array(
                            'id' => 'footer-bg',
                            'type' => 'background', 
                            'title' => esc_html__('Footer Background', 'riven'),
                            'required' => array('footer-type', 'equals', array(
                                    '1',
                                )),
                            'background-color' => false,
                            'default' => array(
                                'background-color' => '#fff',
                                'background-image' => get_template_directory_uri() . '/images/bg-footer-v1.jpg',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'inherit'
                            )
                        ),
                    )
                ),
                array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Breadcrumb', 'riven'),
                    'fields' => array(
                        array(
                            'id' => 'breadcrumbs-bg',
                            'type' => 'background',
                            'title' => esc_html__('Background', 'riven'),
                            'required' => array('header-type', 'equals', array(
                                '1',
                                '2',
                                '3',
                                '4',
                                '5',
                            )),
                            'background-color' => false,
                            'default' => array(
                                'background-color' => '#fff',
                                'background-image' => get_template_directory_uri() . '/images/background/bg-breadcrumb.jpg',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'inherit'
                            )
                        ),
                        array(
                            'id' => 'breadcrumbs-bg-5',
                            'type' => 'background',
                            'title' => esc_html__('Background', 'riven'),
                            'required' => array('header-type', 'equals', array(
                                '5'
                            )),
                            'background-color' => false,
                            'default' => array(
                                'background-color' => '#fff',
                                'background-image' => get_template_directory_uri() . '/images/background/breadcrumb_5.jpg',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'inherit'
                            )
                        ),
                    )
                ),
                array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Typography', 'riven'),
                    'fields' => array(
                        array(
                            'id'=>'h1-font',
                            'type' => 'typography',
                            'title' => esc_html__('H1 Font', 'riven'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => false,
                            'line-height' => false,
                            'default'=> array(
                                'color'=>"#000000",
                                'google'=>true,
                                'font-family'=>'Lato',
                                'font-size'=>'48px',
                            ),
                        ),
                        array(
                            'id'=>'h2-font',
                            'type' => 'typography',
                            'title' => esc_html__('H2 Font', 'riven'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => false,
                            'line-height' => false,
                            'default'=> array(
                                'color'=>"#000000",
                                'google'=>true,
                                'font-family'=>'Lato',
                                'font-size'=>'36px',
                            ),
                        ),
                        array(
                            'id'=>'h3-font',
                            'type' => 'typography',
                            'title' => esc_html__('H3 Font', 'riven'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => false,
                            'line-height' => false,
                            'default'=> array(
                                'color'=>"#000000",
                                'google'=>true,
                                'font-family'=>'Lato',
                                'font-size'=>'20px',
                            ),
                        ),
                        array(
                            'id'=>'h4-font',
                            'type' => 'typography',
                            'title' => esc_html__('H4 Font', 'riven'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => false,
                            'line-height' => false,
                            'default'=> array(
                                'color'=>"#000000",
                                'google'=>true,
                                'font-family'=>'Lato',
                                'font-size'=>'18px',
                            ),
                        ),
                        array(
                            'id'=>'h5-font',
                            'type' => 'typography',
                            'title' => esc_html__('H5 Font', 'riven'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => false,
                            'line-height' => false,
                            'default'=> array(
                                'color'=>"#000000",
                                'google'=>true,
                                'font-family'=>'Lato',
                                'font-size'=>'16px',
                            ),
                        ),
                        array(
                            'id'=>'h6-font',
                            'type' => 'typography',
                            'title' => esc_html__('H6 Font', 'riven'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => false,
                            'line-height' => false,
                            'default'=> array(
                                'color'=>"#000000",
                                'google'=>true,
                                'font-family'=>'Lato',
                                'font-size'=>'10px',
                            ),
                        ),
                    )
                ),
                array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Custom', 'riven'),
                    'fields' => array(
                        array(
                            'id'=>'custom-css-code',
                            'type' => 'ace_editor',
                            'title' => esc_html__('CSS', 'riven'),
                            'subtitle' => esc_html__('Enter CSS code here.', 'riven'),
                            'mode' => 'css',
                            'theme' => 'monokai',
                            'default' => ""
                        ),
                    )
                ),
                array(
                    'icon' => 'el-icon-website',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Header', 'riven'),
                    'fields' => array(
                        array(
                            'id' => 'header-type',
                            'type' => 'image_select',
                            'title' => esc_html__('Header Type', 'riven'),
                            'options' => $this->riven_header_types(),
                            'default' => '3'
                        ),
                        array(
                            'id' => 'header-link',
                            'type' => 'text',
                            'title' => esc_html__('Link Go Kickstarter', 'riven'),
                            'required' => array(
                                        array('header-type', 'equals', array(
                                        '4'
                                    )),
                                ),
                            'default' => esc_html__('#', 'riven'),
                        ),
                        array(
                            'id' => 'header-address',
                            'type' => 'text',
                            'title' => esc_html__('Header Adress', 'riven'),
                            'required' => array(
                                        array('header-type', 'equals', array(
                                        '5'
                                    )),
                                ),
                            'default' => esc_html__('Brooklyn, NY 10036, United States', 'riven'),
                        ),
                        array(
                            'id' => 'header-phone-number',
                            'type' => 'text',
                            'title' => esc_html__('Header Phone Number', 'riven'),
                            'required' => array(
                                        array('header-type', 'equals', array(
                                        '5'
                                    )),
                                ),
                            'default' => esc_html__('(+84)1234-5678', 'riven'),
                        ),
                        array(
                            'id' => 'header-contact-6',
                            'type' => 'text',
                            'title' => esc_html__('Header Contact', 'riven'),
                            'required' => array(
                                        array('header-type', 'equals', array(
                                        '6'
                                    )),
                                ),
                            'default' => esc_html__('0800 123 456', 'riven'),
                        ),
                        array(
                            'id' => 'header-search',
                            'type' => 'switch',
                            'title' => esc_html__('Show Search', 'riven'),
                            'required' => array('header-type', 'equals', array('3')),
                            'default' => true
                        ),
                        array(
                            'id' => 'header-myaccount',
                            'type' => 'switch',
                            'title' => esc_html__('Show my account links', 'riven'),
                            'required' => array('header-type', 'equals', array('3')),
                            'default' => true
                        ),
                        array(
                            'id' => 'header-cart',
                            'type' => 'switch',
                            'title' => esc_html__('Show Mini Cart', 'riven'),
                            'required' => array('header-type', 'equals', array('3')),
                            'default' => true
                        ),
                        array(
                            'id' => 'header-sticky',
                            'type' => 'switch',
                            'title' => esc_html__('Enable sticky', 'riven'),
                            'default' => true
                        ),
                        array(
                        'id' => 'logo-header-sticky',
                        'type' => 'media',
                        'url' => true,
                        'readonly' => false,
                        'title' => esc_html__('Logo for sticky menu', 'riven'),
                        'required' => array('header-sticky', 'equals', 1),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/sticky-logo.png',
                            )
                        ),    
                    )
                ),
                array(
                    'icon' => 'el-icon-website',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Footer', 'riven'),
                    'fields' => array(
                        array(
                            'id' => 'footer-type',
                            'type' => 'image_select',
                            'title' => esc_html__('Footer Type', 'riven'),
                            'options' => $this->riven_footer_types(),
                            'default' => '3'
                        ),
                        array(
                            'id' => "footer-copyright",
                            'type' => 'textarea',
                            'title' => esc_html__('Copyright', 'riven'),
                            'default' => wp_kses( __('&copy; Riven 2016. All Rights Reserved. Designed by <a target="_blank" href="http://arrowhitech.com">AHT Studio</a>', 'riven'), 
                                array(
                                'a' => array(
                                    'href' => array(),
                                    'title' => array(),
                                    'target' => array()
                                ),
                                ))
                        ),
                        array(
                            'id' => 'show-top-footer',
                            'type' => 'switch',
                            'title' => esc_html__('Show Top Footer', 'riven'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'riven'),
                            'off' => esc_html__('No', 'riven'),
                        ),
                    )
                ),
                array(
                    'icon' => 'el-icon-brush',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Blog & Single Blog', 'riven'),
                    'fields' => array(
                        array(
                            'id' => '1',
                            'type' => 'info',
                            'desc' => esc_html__('Blog layout default', 'riven')
                        ),
                        array(
                            'id' => 'show-header-blog',
                            'type' => 'switch',
                            'title' => esc_html__('Show Header On Blog Page', 'riven'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'riven'),
                            'off' => esc_html__('No', 'riven'),
                        ),
                        array(
                            'id' => 'show-slider-blog',
                            'type' => 'switch',
                            'title' => esc_html__('Show Slider Blog', 'riven'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'riven'),
                            'off' => esc_html__('No', 'riven'),
                        ),
                        array(
                            'id' => 'select-slider-blog',
                            'type' => 'select',
                            'required' => array('show-slider-blog', 'equals', true),
                            'title' => esc_html__('Select Slider', 'riven'),
                            'options' => riven_list_rev_sliders()
                        ),
                        array(
                            'id' => 'post-layout',
                            'type' => 'button_set',
                            'title' => esc_html__('Layout', 'riven'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                        array(
                            'id' => 'left-post-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'riven'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'right-post-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'riven'),
                            'data' => 'sidebars',
                            'default' => 'blog-sidebar'
                        ),
                        array(
                            'id' => 'blog-archive-column',
                            'type' => 'button_set',
                            'title' => esc_html__('Columns', 'riven'),
                            'options' => array(
                                '1' => esc_html__('1 columns', 'riven'),
                                '2' => esc_html__('2 columns', 'riven'),
                                '3' => esc_html__('3 columns', 'riven'),
                                '4' => esc_html__('4 columns', 'riven'),
                            ),
                            'default' => '2',
                        ),
                        array(
                            'id' => 'post-banner',
                            'type' => 'select',
                            'title' => esc_html__('Banner Bottom', 'riven'),
                            'options' => riven_block()
                        ),
                        array(
                        'id'=>'blog-title',
                        'type' => 'text',
                        'title' => esc_html__('Page Title', 'riven'),
                        'default' => 'Blog'
                        ),
                    )
                ),
                array(
                    'icon' => 'el-icon-brush',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Event & Single Event', 'riven'),
                    'fields' => array(
                        array(
                            'id' => '1',
                            'type' => 'info',
                            'desc' => esc_html__('Event layout default', 'riven')
                        ),
                        array(
                            'id' => 'event-layout',
                            'type' => 'button_set',
                            'title' => esc_html__('Layout', 'riven'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                        array(
                            'id' => 'left-event-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'riven'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'right-event-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'riven'),
                            'data' => 'sidebars',
                            'default' => 'event-sidebar'
                        ),
                        array(
                        'id'=>'event-title',
                        'type' => 'text',
                        'title' => esc_html__('Page Title', 'riven'),
                        'default' => 'Event'
                        ),
                    )
                ),
                array(
                    'icon' => 'el-icon-brush',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Portfolio', 'riven'),
                    'fields' => array(
                        array(
                            'id' => 'portfolio-layout',
                            'type' => 'button_set',
                            'title' => esc_html__('Layout', 'riven'),
                            'options' => $page_layout,
                            'default' => 'wide'
                        ),
                        array(
                            'id' => 'left-portfolio-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'riven'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'right-portfolio-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'riven'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'portfolio-banner',
                            'type' => 'select',
                            'title' => esc_html__('Banner Bottom', 'riven'),
                            'options' => riven_block()
                        ),
                        array(
                        'id'=>'portfolio-title',
                        'type' => 'text',
                        'title' => esc_html__('Page Title', 'riven'),
                        'default' => 'Project'
                        ),
                        array(
                            'id' => 'portfolio-single-layout',
                            'type' => 'button_set',
                            'title' => esc_html__('Single Layout', 'riven'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                    )
                ),
                array(
                    'icon' => 'el-icon-shopping-cart',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Shop', 'riven'),
                    'fields' => array(
                        array(
                            'id' => '1',
                            'type' => 'info',
                            'desc' => esc_html__('Product listing', 'riven')
                        ),
                        array(
                            'id' => 'shop-layout',
                            'type' => 'button_set',
                            'title' => esc_html__('Layout', 'riven'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                        array(
                            'id' => 'left-shop-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'riven'),
                            'data' => 'sidebars',
                            'default' => 'shop-sidebar'
                        ),
                        array(
                            'id' => 'right-shop-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'riven'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'category-item',
                            'type' => 'text',
                            'title' => esc_html__('Products per Page', 'riven'),
                            'desc' => esc_html__('Comma separated list of product counts.', 'riven'),
                            'default' => '8,16,24'
                        ),
                        array(
                            'id' => 'product-cols',
                            'type' => 'button_set',
                            'title' => esc_html__('Product Columns', 'riven'),
                            'options' => riven_product_columns(),
                            'default' => '4',
                        ),
                        array(
                            'id' => 'product-wishlist',
                            'type' => 'switch',
                            'title' => esc_html__('Show Wishlist', 'riven'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'riven'),
                            'off' => esc_html__('No', 'riven'),
                        ),
                        array(
                            'id' => 'product-compare',
                            'type' => 'switch',
                            'title' => esc_html__('Show Compare', 'riven'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'riven'),
                            'off' => esc_html__('No', 'riven')
                        ),
                        array(
                            'id' => '1',
                            'type' => 'info',
                            'desc' => esc_html__('Single Product', 'riven')
                        ),
                        array(
                            'id' => 'single-product-layout',
                            'type' => 'button_set',
                            'title' => esc_html__('Layout', 'riven'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                        array(
                            'id' => 'left-single-product-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'riven'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'right-single-product-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'riven'),
                            'data' => 'sidebars',
                            'default' => 'single-product-sidebar'
                        ),
                    )
                ),
                array(
                    'icon' => 'el el-network',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Social', 'riven'),
                    'fields' => array(
                        array(
                            'id' => '1',
                            'type' => 'info',
                            'desc' => esc_html__('If the Url empty, the social icon will not display.', 'riven')
                        ),
                        array(
                            'id' => 'social-facebook',
                            'type' => 'text',
                            'title' => esc_html__('Facebook', 'riven'),
                            'placeholder' => esc_html__('http://', 'riven'),
                            'default' => '#'
                        ),
                        array(
                            'id' => 'social-google',
                            'type' => 'text',
                            'title' => esc_html__('Google', 'riven'),
                            'placeholder' => esc_html__('http://', 'riven'),
                            'default' => '#'
                        ),
                        array(
                            'id' => 'social-twitter',
                            'type' => 'text',
                            'title' => esc_html__('Twitter', 'riven'),
                            'placeholder' => esc_html__('http://', 'riven'),
                            'default' => '#'
                        ),
                        array(
                            'id' => 'social-linkedin',
                            'type' => 'text',
                            'title' => esc_html__('LinkedIn', 'riven'),
                            'placeholder' => esc_html__('http://', 'riven'),
                            'default' => '#'
                        ),
                        array(
                            'id' => 'social-pinterest',
                            'type' => 'text',
                            'title' => esc_html__('Pinterest', 'riven'),
                            'placeholder' => esc_html__('http://', 'riven'),
                            'default' => '#'
                        ),
                        array(
                            'id' => 'social-instagram',
                            'type' => 'text',
                            'title' => esc_html__('Instagram', 'riven'),
                            'placeholder' => esc_html__('http://', 'riven'),
                            'default' => '#'
                        ),
                        array(
                            'id' => 'social-youtube',
                            'type' => 'text',
                            'title' => esc_html__('Youtube', 'riven'),
                            'placeholder' => esc_html__('http://', 'riven'),
                            'default' => '#'
                        ),
                    )
                ),
            );
            return $sections;
        }

        public function riven_get_setting_arguments() {
            $theme = wp_get_theme();
            $args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'riven_settings',
                'display_name' => esc_html__('Riven', 'riven'),
                'display_version' => $theme->get('Version'),
                'menu_type' => 'menu',
                'allow_sub_menu' => true,
                'menu_title' => esc_html__('Riven', 'riven'),
                'page_title' => esc_html__('Riven', 'riven'),
                'google_api_key' => '',
                'google_update_weekly' => false,
                'async_typography' => true,
                'admin_bar' => true,
                'admin_bar_icon' => 'dashicons-admin-generic',
                'admin_bar_priority' => 50,
                'global_variable' => '',
                'dev_mode' => false,
                'update_notice' => true,
                'customizer' => true,
                'page_priority' => null,
                'page_parent' => 'themes.php',
                'page_permissions' => 'manage_options',
                'menu_icon' => '',
                'last_tab' => '',
                'page_icon' => 'icon-themes',
                'page_slug' => '',
                'save_defaults' => true,
                'default_show' => false,
                'default_mark' => '',
                'show_import_export' => true,
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                'output_tag' => true,
                'database' => '',
                'use_cdn' => true,
                // HINTS
                'hints' => array(
                    'icon' => 'el el-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'red',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => '',
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'mouseover',
                        ),
                        'hide' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'click mouseleave',
                        ),
                    ),
                )
            );
            return $args;
        }

        protected function riven_header_types() {
            return array(
                '1' => array('alt' => esc_html__('Header Type 1', 'riven'), 'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-1.jpg'),
                '2' => array('alt' => esc_html__('Header Type 2', 'riven'), 'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-2.jpg'),
                '3' => array('alt' => esc_html__('Header Type 3', 'riven'), 'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-3.jpg'),
                '4' => array('alt' => esc_html__('Header Type 4', 'riven'), 'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-4.jpg'),
                '5' => array('alt' => esc_html__('Header Type 5', 'riven'), 'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-5.jpg'),
                '6' => array('alt' => esc_html__('Header Type 6', 'riven'), 'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-6.jpg'),
            );
        }
        protected function riven_footer_types() {
            return array(
                '1' => array('alt' => esc_html__('Footer Type 1', 'riven'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-1.jpg'),
                '2' => array('alt' => esc_html__('Footer Type 2', 'riven'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-2.jpg'),
                '3' => array('alt' => esc_html__('Footer Type 3', 'riven'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-3.jpg'),
                '4' => array('alt' => esc_html__('Footer Type 4', 'riven'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-4.jpg'),
                '5' => array('alt' => esc_html__('Footer Type 5', 'riven'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-5.jpg'),
                '6' => array('alt' => esc_html__('Footer Type 6', 'riven'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-6.jpg'),
            );
        }
    }

    function riven_get_framework_settings() {
        global $rivenReduxSettings;
        $rivenReduxSettings = new Framework_riven_Settings();
        return $rivenReduxSettings;
    }
    riven_get_framework_settings();
}