<?php

// includes/gle-functions-global

/**
 * Prevent direct access to this file.
 *
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Setting internal plugin helper values.
 *
 * @since  2.1.0
 *
 * @return array Array of info values.
 */
function ddw_gle_info_values() {

	/** Get current user */
	$user = wp_get_current_user();

	/** Build Newsletter URL */
	$url_nl = sprintf(
		'https://deckerweb.us2.list-manage.com/subscribe?u=e09bef034abf80704e5ff9809&amp;id=380976af88&amp;MERGE0=%1$s&amp;MERGE1=%2$s',
		esc_attr( $user->user_email ),
		esc_attr( $user->user_firstname )
	);

	$gle_info = array(

		'url_translate'     => 'https://translate.wordpress.org/projects/wp-plugins/genesis-layout-extras',
		'url_wporg_faq'     => 'https://wordpress.org/plugins/genesis-layout-extras/#faq',
		'url_wporg_forum'   => 'https://wordpress.org/support/plugin/genesis-layout-extras',
		'url_wporg_profile' => 'https://profiles.wordpress.org/daveshine/',

		'url_snippets'      => 'https://gist.github.com/deckerweb/6151740',
		'url_fb_group'      => 'https://www.facebook.com/groups/deckerweb.wordpress.plugins/',

		'license'           => 'GPL-2.0-or-later',
		'url_license'       => 'https://opensource.org/licenses/GPL-2.0',
		'url_donate'        => 'https://www.paypal.me/deckerweb',
		//'url_newsletter_ee'    => 'https://eepurl.com/gbAUUn',
		'url_newsletter'    => $url_nl,
		'url_plugin'        => 'https://github.com/deckerweb/genesis-layout-extras',
		'url_plugin_faq'    => 'https://wordpress.org/plugins/genesis-layout-extras/#faq',

		'first_code'        => '2011',
		'author'            => __( 'David Decker - DECKERWEB', 'genesis-layout-extras' ),
		'author_uri'        => 'https://deckerweb.de/',

		'url_twitter'       => 'https://twitter.com/deckerweb',
		'url_github_follow' => 'https://github.com/deckerweb',

		'space_helper'      => '<div style="height: 10px;"></div>',
		'space_helper_5'    => '<div style="height: 5px;"></div>',
		'space_helper_10'   => '<div style="height: 10px;"></div>',
		'space_helper_15'   => '<div style="height: 15px;"></div>',

	);  // end array

	return $gle_info;

}  // end function


/**
 * Get URL of specific GLE info value.
 *
 * @since  2.1.0
 *
 * @uses   ddw_gle_info_values()
 *
 * @param  string $url_key String of value key from array of ddw_gle_info_values()
 * @param  bool   $raw     If raw escaping or regular escaping of URL gets used
 * @return string URL for info value.
 */
function ddw_gle_get_info_url( $url_key = '', $raw = FALSE ) {

	$gle_info = (array) ddw_gle_info_values();

	$output = esc_url( $gle_info[ sanitize_key( $url_key ) ] );

	if ( TRUE === $raw ) {
		$output = esc_url_raw( $gle_info[ esc_attr( $url_key ) ] );
	}

	return $output;

}  // end function


/**
 * Get link with complete markup for a specific BTC info value.
 *
 * @since  2.1.0
 *
 * @uses   ddw_gle_get_info_url()
 *
 * @param  string $url_key String of value key
 * @param  string $text    String of text and link attribute
 * @param  string $class   String of CSS class
 * @return string HTML markup for linked URL.
 */
function ddw_gle_get_info_link( $url_key = '', $text = '', $class = '' ) {

	$link = sprintf(
		'<a class="%1$s" href="%2$s" target="_blank" rel="nofollow noopener noreferrer" title="%3$s">%3$s</a>',
		strtolower( esc_attr( $class ) ),	//sanitize_html_class( $class ),
		ddw_gle_get_info_url( $url_key ),
		esc_html( $text )
	);

	return $link;

}  // end function


/**
 * Get timespan of coding years for this plugin.
 *
 * @since  2.1.0
 *
 * @uses   ddw_gle_info_values()
 *
 * @param  int $first_year Integer number of first year
 * @return string Timespan of years.
 */
function ddw_gle_coding_years( $first_year = '' ) {

	$gle_info = (array) ddw_gle_info_values();

	$first_year = ( empty( $first_year ) ) ? absint( $gle_info[ 'first_code' ] ) : absint( $first_year );

	/** Set year of first released code */
	$code_first_year = ( date( 'Y' ) == $first_year || 0 === $first_year ) ? '' : $first_year . '&#x02013;';

	return $code_first_year . date( 'Y' );

}  // end function


/**
 * Build Customizer live preview URL for certain section, based on Widget area.
 *
 * @since  2.1.0
 *
 * @param  string $area Which widget area to use.
 * @return string Customizer live preview link URL based upon context.
 */
function ddw_gle_get_customizer_preview_link( $area = '' ) {

	/** Sanitize given area string */
	$area = sanitize_key( $area );

	/** Check Widget area the 2 possible values */
	switch ( $area ) {

		case 'notfound':
			$url = get_site_url() . '/?s=' . md5( rand() );
			break;
		case '404':
			$url = get_site_url() . '/404-testing-' . md5( rand() );
			break;

	}  // end switch

	/** Build the Customizer URL and return it */
	return add_query_arg(
		array(
			'autofocus[section]' => 'sidebar-widgets-gle-' . $area . '-widget',
			'url'                => $url,
		),
		admin_url( 'customize.php' )
	);

}  // end function
