<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/tgmpa/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'landx_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function landx_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name' => __( 'Rev-slider', 'landx' ), // The plugin name.
            'slug' => 'revslider', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/tgmpa/plugins/revslider-6.3.5.zip', // The plugin source.
            'required' => true,
            'version' => '6.3.5',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '' 
        ), 
       array(
            'name' => __( 'Visual Composer', 'landx' ), // The plugin name.
            'slug' => 'js_composer', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/tgmpa/plugins/js_composer-6.5.0.zip', // The plugin source.
            'required' => true,
            'version' => '6.5.0',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '' 
        ), 
       array(
            'name' => __( 'Landx extends', 'landx' ), // The plugin name.
            'slug' => 'perch_modules', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/tgmpa/plugins/perch_modules-1.0.4.zip', // The plugin source.
            'required' => true,
            'version' => '1.0.4',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '' 
        ),
        array(
            'name'               => 'Iconize WordPress', // The plugin name.
            'slug'               => 'iconize', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/tgmpa/plugins/iconize.zip',  
            'required'           => true, 
			'version'            => '1.1.5', 
            'force_activation'   => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '' 
        ),
        array(
            'name'               => 'Convert Plus', // The plugin name.
            'slug'               => 'convertplug', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/tgmpa/plugins/convertplug-3.5.17.zip',  
            'required'           => false, 
            'version'            => '3.5.17', 
            'force_activation'   => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '' 
        ),
       array(
            'name'      => __('One Click Demo Import', 'landx'),
            'slug'      => 'one-click-demo-import',
            'required'  => true,
        ),       
        array(
            'name'               => 'Landx shortcodes', // The plugin name.
            'slug'               => 'perch-shortcodes', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/tgmpa/plugins/perch-shortcodes-1.5.zip', 
            'required'           => true, 
            'version'            => '1.5', 
            'force_activation'   => false,
            'force_deactivation' => false, 
        ),
        array(
            'name'               => 'Contact Form 7', // The plugin name.
            'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			
        ),		
		array(
			'name'      => 'Newsletter',
			'slug'      => 'newsletter',
			'required'  => true,
		),
        array(
            'name'      => 'Mailchimp for WP',
            'slug'      => 'mailchimp-for-wp',
            'required'  => true,
        ),
        array(
			'name'      => __('Envato Market', 'landx'), // The plugin name.
			'slug'      => 'envato-market', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/tgmpa/plugins/envato-market.zip', 
			'required'  => true,			
		),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config  = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', 
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '' // Message to output right before the plugins table.
    );
    tgmpa( $plugins, $config );

}