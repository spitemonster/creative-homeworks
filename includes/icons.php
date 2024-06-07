<?php

/**
 * ACF Icon Picker
 *
 * @package    Package_Name
 * @subpackage Package_Name/Subpackage_Name
 * @author     Author_Name
 * @copyright  Copyright (c) Date, Author_Name
 * @license    GPL-2.0
 * @version    1.0.0
 * @since      1.0.0
 */

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

/**
 * ACF Icon Picker
 *
 * @author Jason Witt
 * @since  1.0.0
 */
class ACFIconPicker {

	/**
	 * Settings
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @var array
	 */
	protected $settings;


	/**
	 * File Path
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @var string
	 */
	protected $filepath = '/includes/acf-icons/';

	/**
	 * Icons Path
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @var string
	 */
	protected $icons_path = 'assets/images/';

	/**
	 * Initialize the class
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
		$this->settings = array(
			'version' => '1.9.1',
			'url'     => get_stylesheet_directory_uri() . $this->filepath,
			'path'    => get_template_directory() . $this->filepath,
		);

		add_action( 'acf/include_field_types', array( $this, 'include_field_types' ) );
		add_filter(
			'acf_icon_path_suffix',
			function() {
				return $this->icons_path;
			}
		);
	}

	/**
	 * Load the fields
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function include_field_types( $version = false ) {
		include_once 'acf-icons/fields/acf-icon-picker-v5.php';
	}
}

new ACFIconPicker();
