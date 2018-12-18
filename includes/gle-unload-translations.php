<?php

// includes/gle-unload-translations

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_filter( 'load_textdomain_mofile', 'ddw_gle_maybe_unload_translations', 10, 2 );
/**
 * Optionally unload translations for the plugin plugins. This is controlled via
 *   plugin's settings.
 *
 *   It works by "disabling" the path to the .mo file for the text domain.
 *
 *   Note: We use get_option() here as so early in the load order the Genesis
 *         stuff is not available.
 *
 * @since  2.1.0
 *
 * @uses   get_option()
 *
 * @param  string $mofile Path to .mo file.
 * @param  string $domain Textdomain.
 * @return string|null If our specified domain return null, the path of .mo file
 *                     otherwise.
 */
function ddw_gle_maybe_unload_translations( $mofile, $domain ) {

	$gle_settings = get_option( GLE_SETTINGS_FIELD );

	/** Bail early if unloading not wanted */
	if ( ! isset( $gle_settings[ 'gle_unload_translations' ] ) || ! $gle_settings[ 'gle_unload_translations' ] ) {
		return $mofile;
	}

	/**
	 * If current text domain is in the above array, stop loading the .mo file.
	 */
	if ( 'genesis-layout-extras' === $domain ) {
		$mofile = null;
	}
  
	/** Return the current .mo file */
	return $mofile;
  
}  // end function
