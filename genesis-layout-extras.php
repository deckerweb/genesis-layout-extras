<?php # -*- coding: utf-8 -*-
/**
 * Main plugin file.
 * @package      Genesis Layout Extras
 * @author       David Decker
 * @copyright    Copyright (c) 2011-2019, David Decker - DECKERWEB
 * @license      GPL-2.0-or-later
 * @link         https://deckerweb.de/twitter
 *
 * @origin       Based on the work of @WPChildThemes for original plugin called
 *               "Genesis Layout Manager" (C) 2010 (GPLv2 or later).
 *
 * @wordpress-plugin
 * Plugin Name:  Genesis Layout Extras
 * Plugin URI:   https://github.com/deckerweb/genesis-layout-extras/
 * Description:  For Genesis Framework: Allows modifying of default layouts for homepage, various archive, attachment, search, 404 and even bbPress 2.x pages via plugin settings page. Plus: up to 9 alternate layout options as well as additional post type support!
 * Version:      2.0.0
 * Author:       David Decker - DECKERWEB
 * Author URI:   https://deckerweb.de/
 * License:      GPL-2.0-or-later
 * License URI:  http://www.opensource.org/licenses/gpl-license.php
 * Text Domain:  genesis-layout-extras
 * Domain Path:  /languages/
 * Requires WP:  4.7
 * Requires PHP: 5.6
 *
 * Copyright (c) 2011-2019 David Decker - DECKERWEB
 *
 *     This file is part of Genesis Layout Extras,
 *     a plugin for WordPress.
 *
 *     Genesis Layout Extras is free software:
 *     You can redistribute it and/or modify it under the terms of the
 *     GNU General Public License as published by the Free Software
 *     Foundation, either version 2 of the License, or (at your option)
 *     any later version.
 *
 *     Genesis Layout Extras is distributed in the hope that
 *     it will be useful, but WITHOUT ANY WARRANTY; without even the
 *     implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
 *     PURPOSE. See the GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with WordPress. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Setting constants
 *
 * @since 1.0.0
 */
/** Plugin version */
define( 'GLE_PLUGIN_VERSION', '2.0.0' );
define( 'GLE_RELEASE_DATE', strtotime( '18 December 2018' ) );

/** Plugin directory */
define( 'GLE_PLUGIN_DIR', trailingslashit( dirname( __FILE__ ) ) );

/** Plugin base directory */
define( 'GLE_PLUGIN_BASEDIR', trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) );

/** Plugin settings field */
define( 'GLE_SETTINGS_FIELD', 'gle-settings' );

/** Required Version of Genesis Framework */
define( 'GLE_REQUIRED_GENESIS', '1.8.2' );

/** Required Version of WordPress */
define( 'GLE_LATEST_WORDPRESS', '3.4.2' );

/** Dev scripts & styles on Debug, minified on production */
define(
	'GLE_SCRIPT_SUFFIX',
	( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) || ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ) ? '' : '.min'
);

// ( ( defined( 'WP_DEBUG' ) && ! WP_DEBUG ) || ( defined( 'SCRIPT_DEBUG' ) && ! SCRIPT_DEBUG ) ) ? '.min' : ''


add_action( 'plugins_loaded', 'ddw_gle_translations_init', 100 );
/**
 * @since 2.0.0
 *
 * @uses  get_locale()
 * @uses  load_textdomain()	To load translations first from WP_LANG_DIR sub folder.
 * @uses  load_plugin_textdomain() To additionally load default translations from plugin folder (default).
 */
function ddw_gle_translations_init() {

	/** Load the translations only when needed - within the Admin */
	if ( is_admin() ) {
		
		/** Set unique textdomain string */
		$gle_textdomain = 'genesis-layout-extras';

		/** The 'plugin_locale' filter is also used by default in load_plugin_textdomain() */
		$plugin_locale = esc_attr(
			apply_filters(
				'plugin_locale',
				get_locale(),
				$gle_textdomain
			)
		);

		/**
		 * WordPress languages directory
		 *   Will default to: wp-content/languages/genesis-layout-extras/genesis-layout-extras-{locale}.mo
		 */
		$gle_wp_lang_dir = trailingslashit( WP_LANG_DIR ) . trailingslashit( $gle_textdomain ) . $gle_textdomain . '-' . $plugin_locale . '.mo';

		/** Translations: First, look in WordPress' "languages" folder = custom & update-safe! */
		load_textdomain(
			$gle_textdomain,
			$gle_wp_lang_dir
		);

		/** Translations: Secondly, look in 'wp-content/languages/plugins/' for the proper .mo file (= default) */
		load_plugin_textdomain(
			$gle_textdomain,
			FALSE,
			GLE_PLUGIN_BASEDIR . 'languages'
		);

	}  // end if

}  // end function


register_activation_hook( __FILE__, 'ddw_genesis_layout_extras_activation_check' );
/**
 * Checks for activated Genesis Framework before allowing plugin to activate.
 *
 * Note: register_activation_hook() isn't run after auto or manual upgrade, only on activation!
 *
 * @since  1.3.0
 *
 * @uses   ddw_gle_translations_init()
 * @uses   get_template_directory()
 * @uses   deactivate_plugins()
 * @uses   wp_die()
 *
 * @return string Optional plugin activation messages for the user.
 */
function ddw_genesis_layout_extras_activation_check() {

	/** Load translations to display for the activation message. */
	ddw_gle_translations_init();

	/** Check for activated Genesis Framework (= template/parent theme) */
	if ( 'genesis' === basename( get_template_directory() ) && ! class_exists( 'Genesis_Admin_Boxes' ) ) {

		/** User action message */
		$gle_user_action_message = '<p>' . sprintf(
			/* translators: */
			__( 'You\'re in luck because you\'re already running the Genesis Framework :). However, you\'re using an %1$solder%2$s version of Genesis and should upgrade to the latest version available but at least to version %3$s.', 'genesis-layout-extras' ),
			'<em>',
			'</em>',
			'<code>' . GLE_REQUIRED_GENESIS . '</code>'
		) . '</p>' .
			'<p>' . sprintf(
				__( 'Get the latest version of %1$sGenesis Framework here%2$s or go to your %3$sMy StudioPress Portal%4$s to download the latest version package. Also, make sure, you\'re running the latest WordPress version, that is %5$s or higher.', 'genesis-layout-extras' ),
				'<a href="https://deckerweb.de/go/genesis/" target="_blank" rel="nofollow noopener noreferrer">',
				'</a>',
				'<a href="https://deckerweb.de/go/mystudiopress/" target="_blank" rel="nofollow noopener noreferrer"><em>',
				'</em></a>',
				'<code>' . GLE_LATEST_WORDPRESS . '</code>'
		) . '</p>' .
			'<p>' . sprintf(
				/* translators: %s - name of the plugin, "Genesis Layout Extras" */
				__( 'Just go back and enjoy using %s, while on the next occasion you should make any necessary updates. Thank you!', 'genesis-layout-extras' ),
				'<em>' . __( 'Genesis Layout Extras', 'genesis-layout-extras' ) . '</em>'
		) . '</p>';

		wp_die(
			$gle_user_action_message,
			__( 'Genesis Layout Extras', 'genesis-layout-extras' ),
			array( 'back_link' => TRUE )
		);

	} elseif ( 'genesis' !== basename( get_template_directory() ) ) {

		/** If no Genesis, deactivate ourself */
		deactivate_plugins( plugin_basename( __FILE__ ) );  // Deactivate ourself

		/** Deactivation message */
		$gle_deactivation_message = sprintf(
			/* translators: %1$s - opening link markup / %2$s - closing link markup */
			__( 'Sorry, you can&rsquo;t activate unless you have installed the %1$sGenesis Framework%2$s', 'genesis-layout-extras' ),
			'<a href="https://deckerweb.de/go/genesis/" target="_blank" rel="noopener noreferrer">',
			'</a>'
		);

		wp_die(
			$gle_deactivation_message,
			__( 'Genesis Layout Extras', 'genesis-layout-extras' ),
			array( 'back_link' => TRUE )
		);

	}  // end if

}  // end function


add_action( 'init', 'ddw_genesis_layout_extras_init', 1 );
/**
 * Setup the plugin for its tasks. Load the files.
 * 
 * @since 1.0.0
 * @since 2.1.0 Tweaked and improved.
 *
 * @uses  ddw_gle_is_genesis_active()
 */
function ddw_genesis_layout_extras_init() {

	/** Define constants and set defaults for enabling specific stuff */
	if ( ! defined( 'GLE_NO_EXPORT_IMPORT_INFO' ) ) {
		define( 'GLE_NO_EXPORT_IMPORT_INFO', FALSE );
	}

	if ( ! defined( 'GLE_NO_HNCS_LAYOUT_OPTION' ) ) {
		define( 'GLE_NO_HNCS_LAYOUT_OPTION', FALSE );
	}

	/** Conditionals functions */
	require_once( GLE_PLUGIN_DIR . 'includes/gle-functions-conditionals.php' );

	/** Global functions */
	require_once( GLE_PLUGIN_DIR . 'includes/gle-functions-global.php' );

	/** Layout extras */
	require_once( GLE_PLUGIN_DIR . 'includes/gle-layout-extras.php' );

	/** Load admin and frontend functions only when needed */
	if ( is_admin() && ddw_gle_is_genesis_active() ) {
		
		/** Include plugin code parts */
		require_once( GLE_PLUGIN_DIR . 'includes/admin/gle-admin-functions.php' );
				//require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-functions-dropdown.php' );
		require_once( GLE_PLUGIN_DIR . 'includes/admin/gle-admin-extras.php' );
		require_once( GLE_PLUGIN_DIR . 'includes/admin/views/gle-admin-help.php' );

	} elseif ( ddw_gle_is_genesis_active() ) {

		/** This executes our settings visually */
		require_once( GLE_PLUGIN_DIR . 'includes/gle-frontend.php' );

	}  // end if

	/** Add "Settings Page" link to plugin page - only within 'wp-admin' */
	if ( ( is_admin() || is_network_admin() )
		&& current_user_can( 'manage_options' )
	) {

		add_filter(
			'plugin_action_links_' . plugin_basename( __FILE__ ),
			'ddw_gle_settings_page_link'
		);

		add_filter(
			'network_admin_plugin_action_links_' . plugin_basename( __FILE__ ),
			'ddw_gle_settings_page_link'
		);

	}  // end if

}  // end function


add_action( 'genesis_init', 'ddw_gle_admin_init', 11 );
/**
 * Load plugin's admin settings page - only within 'wp-admin'.
 * 
 * @since 2.0.0
 */
function ddw_gle_admin_init() {

	/** Load the settings & help stuff */
	if ( is_admin() && ddw_gle_is_genesis_active() ) {
		require_once( GLE_PLUGIN_DIR . 'includes/admin/gle-admin-options.php' );
	}

}  // end function


/**
 * Include functions for optionally unloading translations.
 *   Note: This is loaded from here to keep a higher priority, beyond the setup
 *         functions above.
 *
 * @since 2.1.0
 */
require_once( GLE_PLUGIN_DIR . 'includes/gle-unload-translations.php' );
