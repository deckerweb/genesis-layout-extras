<?php

// includes/gle-functions-conditionals

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * 1st GROUP: My own add-ons/ plugins:
 * @since 2.1.0
 * -----------------------------------------------------------------------------
 */

/**
 * Is Toolbar Extras plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_toolbar_extras_active() {

	return defined( 'TBEX_PLUGIN_VERSION' );

}  // end function


/**
 * Is Genesis Widgetized Not Found & 404 plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_genesis_widgetized_notfound_active() {

	return defined( 'GWNF_PLUGIN_BASEDIR' );

}  // end function


/**
 * Is Genesis Extra Settings Transporter plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_genesis_extra_settings_transporter_active() {

	return defined( 'GEST_PLUGIN_BASEDIR' );

}  // end function


/**
 * Is Genesis What's New Info plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_genesis_whats_new_info_active() {

	return defined( 'GNEWI_PLUGIN_BASEDIR' );

}  // end function


/**
 * Is Genesis Widgetized Archive plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_genesis_widgetized_archive_active() {

	return defined( 'GWAT_PLUGIN_BASEDIR' );

}  // end function


/**
 * Is Genesis Printstyle Plus plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_genesis_printstyle_plus_active() {

	return defined( 'GPSP_PLUGIN_BASEDIR' );

}  // end function


/**
 * Is Genesis Prose Extras plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_genesis_prose_extras_active() {

	return defined( 'GPEX_PLUGIN_BASEDIR' );

}  // end function



/**
 * 2nd GROUP: All other third-party plugins:
 * @since 2.1.0
 * -----------------------------------------------------------------------------
 */

/**
 * Is Genesis get option function available or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if function is available, FALSE otherwise.
 */
function ddw_gle_is_genesis_active() {

	return function_exists( 'genesis_get_option' );

}  // end function


/**
 * Is Genesis Admin CPT Archive Settings class available or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if class is available, FALSE otherwise.
 */
function ddw_gle_is_genesis_cpt_archive_settings_available() {

	return class_exists( 'Genesis_Admin_CPT_Archive_Settings' );

}  // end function


/**
 * Is WooCommerce plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_woocommerce_active() {

	return class_exists( 'WooCommerce' );

}  // end function


/**
 * Is Easy Digital Downloads plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_edd_active() {

	return class_exists( 'Easy_Digital_Downloads' );

}  // end function


/**
 * Is bbPress plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_bbpress_active() {

	return class_exists( 'bbPress' );

}  // end function


/**
 * Is Genesis Portfolio Pro plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_genesis_portfolio_pro_active() {

	return function_exists( 'genesis_portfolio_init' );

}  // end function


/**
 * Is Genesis Author Pro plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_genesis_author_pro_active() {

	return function_exists( 'genesis_author_pro_init' );

}  // end function


/**
 * Is AgentPress Listings plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_agentpress_listings_active() {

	return function_exists( 'agentpress_listings_init' );

}  // end function


/**
 * Is Simple Listings for Genesis plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_simple_listings_genesis_active() {

	return class_exists( 'Simple_Listings_Genesis' );

}  // end function


/**
 * Is Sugar Events Calendar plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_sugar_calendar_active() {

	return defined( 'SC_PLUGIN_FILE' );

}  // end function


/**
 * Is Jigoshop plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_jigoshop_active() {

	return defined( 'JIGOSHOP_BASE_NAME' );

}  // end function


/**
 * Is Genesis Media Project plugin active or not?
 *
 * @since 2.1.0
 *
 * @return bool TRUE if plugin is active, FALSE otherwise.
 */
function ddw_gle_is_genesis_media_project_active() {

	return defined( 'GMP_SETTINGS_FIELD' );

}  // end function
