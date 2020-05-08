<?php
/**
 * Plugin Name: help_images_AN
 * Plugin URI: https://github.com/astridnio/scripts/blob/master/helpplugin
 * Description: Disables the <img> html tag replacement
 * Version: 1.0.0
 * Requires PHP: 5.4
 * Author: AN
 * Author URI: https://github.com/astridnio/scripts
 * Licence: GPLv2
 */
defined( 'ABSPATH' ) || die( 'Cheatin’ uh?' );
public function init() {
    // check for plugin using plugin name
    if ( is_plugin_active( 'plugin-directory/imagify.php' ) ) {
    //plugin is activated
        add_action( 'template_redirect', [ $this, 'start_content_process' ], -1000 );
    }
}    
    /**
	 * Start buffering the page content.
	 *
	 * @since  1.9
	 * @access public
	 * @author Grégory Viguier
	 */

    public function start_content_process() {
		if ( ! get_imagify_option( 'display_webp' ) ) {
			return;
		}

		if ( self::OPTION_VALUE !== get_imagify_option( 'display_webp_method' ) ) {
			return;
		}

		/**
		 * Prevent the replacement of <img> tags into <picture> tags.
		 *
		 * @since  1.9
		 * @author Grégory Viguier
		 *
		 * @param bool $allow True to allow the use of <picture> tags (default). False to prevent their use.
		 */
		$allow = apply_filters( 'imagify_allow_picture_tags_for_webp', false );

		if ( ! $allow ) {
			return;
		}

		ob_start( [ $this, 'maybe_process_buffer' ] );
	}
} 
