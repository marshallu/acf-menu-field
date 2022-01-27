<?php
/**
 * Plugin Name: Advanced Custom Fields: Menu Field
 * Plugin URI: http://www.marshall.edu
 * Description: A custom field type for ACF to select menus.
 * Version: 1.0.0
 * Author: Christopher McComas
 * Author URI: http://www.cmccomas.com
 *
 * @package acf-menu-field
 */

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// check if class already exists.
if ( ! class_exists( 'mu_acf_plugin_menu_field' ) ) :

	/**
	 * MU ACF Plugin Menu Field class
	 */
	class Mu_Acf_Plugin_Menu_Field {

		/**
		 * The construct function
		 */
		public function __construct() {

			$this->settings = array(
				'version' => '1.0.0',
				'url'     => plugin_dir_url( __FILE__ ),
				'path'    => plugin_dir_path( __FILE__ ),
			);

			add_action( 'acf/include_field_types', array( $this, 'include_field' ) ); // v5.
			add_action( 'acf/register_fields', array( $this, 'include_field' ) ); // v4.
		}


		/**
		 *  Include the field
		 *
		 *  This function will include the field type class
		 *
		 *  @since 1.0.0
		 *
		 * @param int $version major ACF version. Defaults to false.
		 * @return void
		 */
		public function include_field( $version = false ) {

			// support empty $version.
			if ( ! $version ) {
				$version = 5;
			}

			// load textdomain.
			load_plugin_textdomain( 'acf-menu-field', false, plugin_basename( dirname( __FILE__ ) ) . '/lang' );

			// include.
			include_once 'fields/class-mu-acf-field-menu-field-v' . $version . '.php';
		}
	}


	// Initialize the Plugin.
	new mu_acf_plugin_menu_field();


	// class_exists check.
endif;
