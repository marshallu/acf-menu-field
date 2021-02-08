<?php
/**
 * The actual field.
 *
 * @package acf-menu-field
 */

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// check if class already exists.
if ( ! class_exists( 'mu_acf_field_menu_field' ) ) :


	/**
	 * The field
	 */
	class Mu_Acf_Field_Menu_Field extends acf_field {

		/**
		 *  Setup the class.
		 *
		 *  This function will setup the field type data
		 *
		 *  @param array $settings All the settings.
		 */
		public function __construct( $settings ) {
			/*
			*  name (string) Single word, no spaces. Underscores allowed
			*/
			$this->name = 'menu_field';

			/*
			*  label (string) Multiple words, can include spaces, visible when selecting a field type
			*/
			$this->label = __( 'Menu Field', 'acf-menu-field' );

			/*
			*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
			*/
			$this->category = 'relational';

			/*
			*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
			*/

			$this->defaults = array(
				'font_size' => 0,
			);

			/*
			*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
			*  var message = acf._e('menu_field', 'error');
			*/
			$this->l10n = array(
				'menu' => __( 'Error! Please enter a higher value', 'acf-menu-field' ),
			);

			/*
			*  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
			*/
			$this->settings = $settings;

			// do not delete!
			parent::__construct();
		}

		/**
		 * Render field settings
		 *
		 * Create extra settings for your field. These are visible when editing a field
		 *
		 * @param array $field The settings for the field.
		 */
		public function render_field_settings( $field ) {
			/*
			*  acf_render_field_setting
			*
			*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
			*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
			*
			*  More than one setting can be added by copy/paste the above code.
			*  Please note that you must also have a matching $defaults value for the field name (font_size)
			*/
			acf_render_field_setting(
				$field,
				array(
					'label'        => __( 'Menu', 'acf-menu-field' ),
					'instructions' => __( 'Select a menu', 'acf-menu-field' ),
					'type'         => 'select',
					'name'         => 'menu',
				)
			);
		}


		/**
		 *  Render the field, render_field()
		 *
		 *  Create the HTML interface for your field
		 *
		 *  @param array $field the $field being edited.
		 */
		public function render_field( $field ) {

			$selected = '';

			echo '<select name="' . esc_attr( $field['name'] ) . '">';
			echo '<option>Select a navigation menu</option>';

			foreach ( get_terms( 'nav_menu' ) as $menu ) {

				if ( intval( $field['value'] ) === intval( $menu->term_taxonomy_id ) ) {
					$selected = ' selected ';
				}

				echo '<option value="' . esc_attr( $menu->term_taxonomy_id ) . '" ' . esc_attr( $selected ) . '>' . esc_attr( $menu->name ) . '</option>';

				$selected = '';
			}

			echo '</select>';
		}

		/**
		 *  The load_value()
		 *
		 *  This filter is applied to the $value after it is loaded from the db
		 *
		 *  @param mixed $value (mixed) the value found in the database.
		 *  @param mixed $post_id (mixed) the $post_id from which the value was loaded.
		 *  @param array $field (array) the field array holding all the field options.
		 *  @return $value
		 */
		public function load_value( $value, $post_id, $field ) {
			return $value;
		}

		/**
		 *  The update_value()
		 *
		 *  This filter is applied to the $value after it is loaded from the db
		 *
		 *  @param mixed $value (mixed) the value found in the database.
		 *  @param mixed $post_id (mixed) the $post_id from which the value was loaded.
		 *  @param array $field (array) the field array holding all the field options.
		 *  @return $value
		 */
		public function update_value( $value, $post_id, $field ) {
			return $value;
		}

		/**
		 *  The validate_value()
		 *
		 *  This filter is applied to the $value after it is loaded from the db
		 *
		 *  @param boolean $valid (boolean) validation status based on the value and the field's required setting.
		 *  @param mixed   $value (mixed) the $_POST value.
		 *  @param array   $field (array) the field array holding all the field options.
		 *  @param string  $input (string) the corresponding input name for $_POST value.
		 *  @return $value
		 */
		public function validate_value( $valid, $value, $field, $input ) {
			return $valid;
		}
	}

	// initialize.
	new mu_acf_field_menu_field( $this->settings );


	// class_exists check.
endif;
