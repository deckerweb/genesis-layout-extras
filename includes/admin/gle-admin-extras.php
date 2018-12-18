<?php

// includes/gle-admin-extras

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Add "Settings" link to plugin page
 *
 * @since  1.0.0
 *
 * @param  array $gle_links (Default) Array of plugin action links.
 * @return array Array of link markup/ strings of plugin action links.
 */
function ddw_gle_settings_page_link( $gle_links ) {

	/** Plugin setting page link */
	$gle_settings_link = sprintf(
		'<a  href="%s" title="%s"><span class="dashicons-before dashicons-welcome-widgets-menus"></span> %s</a>',
		esc_url( admin_url( 'admin.php?page=gle-layout-extras' ) ),
		esc_html__( 'Go to the settings page', 'genesis-layout-extras' ),
		esc_attr__( 'Layout Settings', 'genesis-layout-extras' )
	);
	
	/** Set the order of the links */
	array_unshift( $gle_links, $gle_settings_link );

	/** Display plugin settings links */
	return apply_filters(
		'gle_filter_settings_page_link',
		$gle_links,
		$gle_settings_link 		// additional param
	);

}  // end function


add_filter( 'plugin_row_meta', 'ddw_gle_plugin_links', 10, 2 );
/**
 * Add various support links to plugin page
 *
 * @since  1.1.0
 * @since  2.1.0 Refactoring.
 *
 * @param  array  $gle_links (Default) Array of plugin meta links
 * @param  string $gle_file  Path of base plugin file.
 * @return array $gle_links Array of plugin link strings to build HTML markup.
 */
function ddw_gle_plugin_links( $gle_links, $gle_file ) {

	/** Capability Check */
	if ( ! current_user_can( 'install_plugins' ) ) {
		return $gle_links;
	}

	/** Add additional plugin links */
	if ( $gle_file === GLE_PLUGIN_BASEDIR . 'genesis-layout-extras.php' ) {

		?>
			<style type="text/css">
				tr[data-plugin="<?php echo $gle_file; ?>"] .plugin-version-author-uri a.dashicons-before:before {
					font-size: 17px;
					margin-right: 2px;
					opacity: .85;
					vertical-align: sub;
				}
			</style>
		<?php

		/* translators: Plugins page listing */
		$gle_links[] = ddw_gle_get_info_link( 'url_wporg_faq', esc_html_x( 'FAQ', 'Plugins page listing', 'genesis-layout-extras' ), 'dashicons-before dashicons-editor-help' );

		/* translators: Plugins page listing */
		$gle_links[] = ddw_gle_get_info_link( 'url_wporg_forum', esc_html_x( 'Support', 'Plugins page listing', 'genesis-layout-extras' ), 'dashicons-before dashicons-sos' );

		/* translators: Plugins page listing */
		$gle_links[] = ddw_gle_get_info_link( 'url_fb_group', esc_html_x( 'Facebook Group', 'Plugins page listing', 'genesis-layout-extras' ), 'dashicons-before dashicons-facebook' );

		/* translators: Plugins page listing */
		$gle_links[] = ddw_gle_get_info_link( 'url_translate', esc_html_x( 'Translations', 'Plugins page listing', 'genesis-layout-extras' ), 'dashicons-before dashicons-translation' );

		/* translators: Plugins page listing */
		$gle_links[] = ddw_gle_get_info_link( 'url_donate', esc_html_x( 'Donate', 'Plugins page listing', 'genesis-layout-extras' ), 'button dashicons-before dashicons-thumbs-up' );

		/* translators: Plugins page listing */
		$gle_links[] = ddw_gle_get_info_link( 'url_newsletter', esc_html_x( 'Join our Newsletter', 'Plugins page listing', 'genesis-layout-extras' ), 'button-primary dashicons-before dashicons-awards' );

	}  // end if

	/** Output the links */
	return apply_filters(
		'gle_filter_plugin_links',
		$gle_links
	);

}  // end function


add_filter( 'admin_footer_text', 'ddw_gle_admin_footer_text' );
/**
 * Modifies the "Thank you" text displayed in the WP Admin footer.
 *   Fired by 'admin_footer_text' filter.
 *
 * @since  2.1.0
 *
 * @uses   genesis_is_menu_page()
 *
 * @param  string $footer_text The content that will be printed.
 * @return string The content that will be printed.
 */
function ddw_gle_admin_footer_text( $footer_text ) {

	/** Check for Genesis function, otherwise bail early */
	if ( ! function_exists( 'genesis_is_menu_page' ) ) {
		return;
	}

	/** If we're on a Genesis admin screen */
	if ( genesis_is_menu_page( 'gle-layout-extras' ) ) {

		$rating = sprintf(
			/* translators: %s - 5 stars icons */
			'<a href="https://wordpress.org/support/plugin/genesis-layout-extras/reviews/?filter=5#new-post" target="_blank" rel="noopener noreferrer">' . __( '%s rating', 'genesis-layout-extras' ) . '</a>',
			'&#9733;&#9733;&#9733;&#9733;&#9733;'
		);

		$footer_text = sprintf(
			/* translators: 1 - name of the plugin, "Genesis Layout Extras" / 2 - Link to plugin review */
			__( 'Enjoyed %1$s? Please leave us a %2$s. We really appreciate your support!', 'genesis-layout-extras' ),
			'<strong>' . __( 'Genesis Layout Extras', 'genesis-layout-extras' ) . '</strong>',
			$rating
		);

	}  // end if

	return $footer_text;

}  // end function


/**
 * Inline CSS fix for Plugins page update messages.
 *
 * @since 2.1.0
 *
 * @see   ddw_gle_plugin_update_message()
 * @see   ddw_gle_multisite_subsite_plugin_update_message()
 */
function ddw_gle_plugin_update_message_style_tweak() {

	?>
		<style type="text/css">
			.gle-update-message p:before,
			.update-message.notice p:empty {
				display: none !important;
			}
		</style>
	<?php

}  // end function


add_action( 'in_plugin_update_message-' . GLE_PLUGIN_BASEDIR . 'genesis-layout-extras.php', 'ddw_gle_plugin_update_message', 10, 2 );
/**
 * On Plugins page add visible upgrade/update notice in the overview table.
 *   Note: This action fires for regular single site installs, and for Multisite
 *         installs where the plugin is activated Network-wide.
 *
 * @since  2.1.0
 *
 * @param  object $data
 * @param  object $response
 * @return string Echoed string and markup for the plugin's upgrade/update
 *                notice.
 */
function ddw_gle_plugin_update_message( $data, $response ) {

	if ( isset( $data[ 'upgrade_notice' ] ) ) {

		ddw_gle_plugin_update_message_style_tweak();

		printf(
			'<div class="update-message gle-update-message">%s</div>',
			wpautop( $data[ 'upgrade_notice' ] )
		);

	}  // end if

}  // end function


add_action( 'after_plugin_row_wp-' . GLE_PLUGIN_BASEDIR . 'genesis-layout-extras.php', 'ddw_gle_multisite_subsite_plugin_update_message', 10, 2 );
/**
 * On Plugins page add visible upgrade/update notice in the overview table.
 *   Note: This action fires for Multisite installs where the plugin is
 *         activated on a per site basis.
 *
 * @since  2.1.0
 *
 * @param  string $file
 * @param  object $plugin
 * @return string Echoed string and markup for the plugin's upgrade/update
 *                notice.
 */
function ddw_gle_multisite_subsite_plugin_update_message( $file, $plugin ) {

	if ( is_multisite() && version_compare( $plugin[ 'Version' ], $plugin[ 'new_version' ], '<' ) ) {

		$wp_list_table = _get_list_table( 'WP_Plugins_List_Table' );

		ddw_gle_plugin_update_message_style_tweak();

		printf(
			'<tr class="plugin-update-tr"><td colspan="%s" class="plugin-update update-message notice inline notice-warning notice-alt"><div class="update-message gle-update-message"><h4 style="margin: 0; font-size: 14px;">%s</h4>%s</div></td></tr>',
			$wp_list_table->get_column_count(),
			$plugin[ 'Name' ],
			wpautop( $plugin[ 'upgrade_notice' ] )
		);

	}  // end if

}  // end function


/**
 * Optionally tweaking Plugin API results to make more useful recommendations to
 *   the user.
 *
 * @since 2.1.0
 */

add_filter( 'ddwlib_plir/filter/plugins', 'ddw_gle_register_plugin_recommendations' );
/**
 * Register specific plugins for the class "DDWlib Plugin Installer
 *   Recommendations".
 *   Note: The top-level array keys are plugin slugs from the WordPress.org
 *         Plugin Directory.
 *
 * @since  2.1.0
 *
 * @param  array $plugins Array holding all plugin recommendations, coming from
 *                        the class and the filter.
 * @return array Filtered and merged array of all plugin recommendations.
 */
function ddw_gle_register_plugin_recommendations( array $plugins ) {
  
  	/** Remove our own slug when we are already active :) */
  	if ( isset( $plugins[ 'genesis-layout-extras' ] ) ) {
  		$plugins[ 'genesis-layout-extras' ] = null;
  	}

  	/** Register our additional plugin recommendations */
	$gle_plugins = array(
		'genesis-widgetized-notfound' => array(
			'featured'    => 'yes',
			'recommended' => 'yes',
			'popular'     => 'yes',
		),
		'genesis-widgetized-footer' => array(
			'featured'    => 'yes',
			'recommended' => 'yes',
			'popular'     => 'yes',
		),
		'genesis-widgetized-archive' => array(
			'featured'    => 'yes',
			'recommended' => 'yes',
			'popular'     => 'no',
		),
		'genesis-whats-new-info' => array(
			'featured'    => 'yes',
			'recommended' => 'yes',
			'popular'     => 'yes',
		),
		'genesis-extra-settings-transporter' => array(
			'featured'    => 'yes',
			'recommended' => 'yes',
			'popular'     => 'no',
		),
		'genesis-portfolio-pro' => array(
			'featured'    => 'yes',
			'recommended' => 'yes',
			'popular'     => 'yes',
		),
		'blox-lite' => array(
			'featured'    => 'yes',
			'recommended' => 'yes',
			'popular'     => 'no',
		),
		'genesis-title-toggle' => array(
			'featured'    => 'yes',
			'recommended' => 'yes',
			'popular'     => 'yes',
		),
		'genesis-footer-builder' => array(
			'featured'    => 'yes',
			'recommended' => 'yes',
			'popular'     => 'no',
		),
		'display-featured-image-genesis' => array(
			'featured'    => 'yes',
			'recommended' => 'yes',
			'popular'     => 'no',
		),
		'genesis-enews-extended' => array(
			'featured'    => 'no',
			'recommended' => 'no',
			'popular'     => 'yes',
		),
		'genesis-simple-edits' => array(
			'featured'    => 'no',
			'recommended' => 'no',
			'popular'     => 'yes',
		),
		'genesis-simple-sidebars' => array(
			'featured'    => 'no',
			'recommended' => 'yes',
			'popular'     => 'yes',
		),
		'genesis-simple-hooks' => array(
			'featured'    => 'no',
			'recommended' => 'no',
			'popular'     => 'yes',
		),
	);

  	/** Merge with the existing recommendations and return */
	return array_merge( $plugins, $gle_plugins );

}  // end function

/** Optionally add string translations for the library */
if ( ! function_exists( 'ddwlib_plir_strings_plugin_installer' ) ) :

	add_filter( 'ddwlib_plir/filter/strings/plugin_installer', 'ddwlib_plir_strings_plugin_installer' );
	/**
	 * Optionally, make strings translateable for included library "DDWlib Plugin
	 *   Installer Recommendations".
	 *   Strings:
	 *    - "Newest" --> tab in plugin installer toolbar
	 *    - "Version:" --> label in plugin installer plugin card
	 *
	 * @since  2.1.0
	 *
	 * @param  array $strings Holds all filterable strings of the library.
	 * @return array Array of tweaked translateable strings.
	 */
	function ddwlib_plir_strings_plugin_installer( $strings ) {

		$strings[ 'newest' ] = _x(
			'Newest',
			'Plugin installer: Tab name in installer toolbar',
			'genesis-layout-extras'
		);

		$strings[ 'version' ] = _x(
			'Version:',
			'Plugin card: plugin version',
			'genesis-layout-extras'
		);

		return $strings;

	}  // end function

endif;  // function check
	
/** Include class DDWlib Plugin Installer Recommendations */
require_once( GLE_PLUGIN_DIR . 'includes/admin/classes/ddwlib-plugin-installer-recommendations.php' );
