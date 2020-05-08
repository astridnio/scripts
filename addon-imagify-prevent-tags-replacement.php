<?php
/**
 * Plugin Name: addon-imagify-prevent-tags-replacement
 * Plugin URI: https://github.com/astridnio/scripts/blob/master/addon-imagify-prevent-tags-replacement.php
 * Description: Disables the <img> html tag replacement
 * Version: 1.0.0
 * Requires PHP: 5.4
 * Requires: imagify plugin installed.
 * Author: AN
 * Author URI: https://github.com/astridnio/scripts
 * Licence: GPLv2
 */
 
 // Includes the function is_plugin_active
if ( ! function_exists( 'is_plugin_active' ) )
     require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
 // check for plugin using plugin name
 if ( is_plugin_active( 'imagify/imagify.php' ) ) {
     // calls the plugins hooks
	 add_filter( 'imagify_allow_picture_tags_for_webp', 'custom_start_content_proces' );
	 // function to disable the replacement. 
	 function custom_start_content_proces( $allow ) {
		 //false for disable the replacement of <img> tags
		 //true for replace the <img> tags for <picture> tags
		 $allow=false;
		 return $allow; 
		}
 }	