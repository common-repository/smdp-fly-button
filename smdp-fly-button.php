<?php
/*
Plugin Name: SMDP Fly Button
Plugin URI: https://soft-master.eu/smdp-fly-button-wordpress-plugin/
Description: Plugin for adding a fly button to your site.
Author: Ilias Gomatos
Version: 1.0.0
Author URI: https://soft-master.eu/
Text Domain: smdp-fly-button
Domain Path: /lang/
License: GPLv2
*/



if ( ! defined( 'ABSPATH' ) ) exit;




global $SMDPAP;

// Load plugin class files


require_once( 'includes/class-smdp-fly-button.php' );
require_once( 'includes/class-smdp-fly-button-settings.php' );
require_once plugin_dir_path( __FILE__ ) . 'includes/smdp-sticky-panel.php';
//require_once plugin_dir_path( __FILE__ ) . 'includes/class-smdp-partners.php';


// Load plugin libraries
require_once( 'includes/lib/class-smdp-fly-button-admin-api.php' );
require_once( 'includes/lib/class-smdp-fly-button-post-type.php' );
require_once( 'includes/lib/class-smdp-fly-button-taxonomy.php' );

/**
 * Returns the main instance of smdp_Fly_Button to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object smdp_Fly_Button
 */
function smdp_Fly_Button () {
	$instance = smdp_Fly_Button::instance( __FILE__, '1.0.0' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = smdp_Fly_Button_Settings::instance( $instance );
	}

	return $instance;
}

//SPDP_Referrers_ls::get_instance();
$SMDPAP = smdp_Fly_Button();





