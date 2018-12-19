<?php

// includes/gle-admin-functions

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_action( 'admin_enqueue_scripts', 'ddw_gle_load_admin_styles' );
/**
 * Load additional admin styles for plugin's admin page.
 *
 * @since 2.0.0
 *
 * @uses  genesis_is_menu_page()
 * @uses  wp_register_style()
 * @uses  wp_enqueue_style()
 */
function ddw_gle_load_admin_styles( $hook_suffix ) {

	/** Register the stylesheet */
	wp_register_style(
		'gle-admin-styles',
		plugins_url(
			'assets/css/gle-admin-styles' . GLE_SCRIPT_SUFFIX . '.css',
			dirname( dirname( __FILE__ ) )
		),
		FALSE,
		GLE_PLUGIN_VERSION,
		'all'
	);
	
	/** Check for Genesis function, otherwise bail early */
	if ( ! function_exists( 'genesis_is_menu_page' ) ) {
		return;
	}

	/** If we're on a Genesis admin screen */
	if ( genesis_is_menu_page( 'gle-layout-extras' ) ) {

		/** Enqueue the stylesheet */
		wp_enqueue_style( 'gle-admin-styles' );

	}  // end if

}  // end function


/**
 * Helper function for echoing the some inline styles for the layout dropdown
 *   in this plugin settings.
 *
 * @since  2.0.0
 *
 * @param  string 	$gle_bg
 * @param  string 	$output_type
 *
 * @return string CSS background markup.
 */
function ddw_gle_styles_layout_dropdown( $gle_bg = '', $output_type = 'echo' ) {

	/** Create output markup */
	$output = sprintf(
		'class="gle-dropdown" style="background-color: %s;"',
		( ! empty( $gle_bg ) ) ? sanitize_hex_color( $gle_bg ) : '#fff'
	);

	/** Control function output type */
	if ( 'echo' === sanitize_key( $output_type ) ) {
		echo $output;
	} else {
		return $output;
	}

}  // end function


/**
 * Helper function for creating the '<option>' markup for the layout select
 *   drop-down.
 *
 * @since  2.0.0
 *
 * @uses   genesis_get_option()
 * @uses   GLE_SETTINGS_FIELD
 * @uses   ddw_gle_styles_layout_dropdown()
 *
 * @param  string $layout_type       Genesis Layout type.
 * @param  string $layout_title      Title (label) of the layout.
 * @param  string $gle_styles_bg     Background color in the drop-down selectio field.
 * @param  string $gle_layout_option Option from Genesis Layout Extras plugin.
 *
 * @return string Option markup for select field.
 */
function ddw_gle_layout_select_option( $layout_type, $layout_title, $gle_styles_bg, $gle_layout_option ) {

	/**
	 * Output the markup for display of the <option> items for select drop-down.
	 *   Begin form code
	 */
	?>
		<option <?php ddw_gle_styles_layout_dropdown( sanitize_hex_color( $gle_styles_bg ) ); ?> value="<?php echo esc_attr( $layout_type ); ?>"<?php selected( genesis_get_option( $gle_layout_option, GLE_SETTINGS_FIELD ), esc_attr( $layout_type ) ); ?>>
			<?php echo esc_attr( $layout_title ); ?>
		</option>
	<?php
	/** ^End form code */

}  // end function


/**
 * Helper function for the admin settings page:
 *   Setting up the drop-down menus - reuseable in a flexible way.
 *
 * @since 1.0.0
 *
 * @uses  ddw_gle_layout_select_option()
 * @uses  genesis_get_layout()
 * @uses  GLE_SETTINGS_FIELD
 * @uses  genesis_get_option()
 * @uses  ddw_gle_is_alternate_layout_registered()
 *
 * @param string $gle_layout_title
 * @param string $gle_layout_option
 */
function ddw_genesis_layout_extras_option( $gle_layout_title, $gle_layout_option ) {

	//$has_alternate_layouts = ddw_gle_is_alternate_layout_registered() ? TRUE : FALSE;

	/** Begin form code */
	?>

		<p>
			<?php echo $gle_layout_title; ?>
			<select name="<?php echo GLE_SETTINGS_FIELD; ?>[<?php echo $gle_layout_option; ?>]">

				<?php
					/** Basis option: 'Genesis Default' layout as defined in Genesis Theme Settings */
					ddw_gle_layout_select_option(
						'',
						__( 'Genesis Default', 'genesis-layout-extras' ),
						'#fff',
						$gle_layout_option
					);

					/** "Internal hook" - for my own plugins etc. */
					do_action( 'gle_layouts_drop_down_core', $gle_layout_option );


					if ( has_action( 'gle_layouts_drop_down_core' ) && ddw_gle_is_alternate_layout_registered() ) {
						echo '<option value="void" disabled="disabled" class="gle-dropdown-void">&rarr; <em>' . __( 'Alternate layouts via plugin', 'genesis-layout-extras' ) . ':</em> </option>';
					}

					/** "Internal hook" - for my own plugins etc. */
					do_action( 'gle_layouts_drop_down_internal', $gle_layout_option );

					if ( has_action( 'gle_layouts_drop_down' ) && ddw_gle_is_alternate_layout_registered() ) {
						echo '<option value="void" disabled="disabled" class="gle-dropdown-void">&rarr; <em>' . __( 'Custom layouts:', 'genesis-layout-extras' ) . '</em> </option>';
					}

					/** For adding custom layouts to the drop-down */
					do_action( 'gle_layouts_drop_down', $gle_layout_option );
				?>

			</select>
		</p>

	<?php
	/** ^End form code */

}  // end function


add_action( 'gle_layouts_drop_down_core', 'ddw_gle_layouts_drop_down_genesis_core', 10, 1 );
/**
 * Adding the Genesis core layout options to the select drop-down menu.
 *
 * @since 2.0.0
 *
 * @uses  genesis_get_layout()
 * @uses  ddw_gle_layout_select_option()
 *
 * @param string 	$gle_layout_option
 */
function ddw_gle_layouts_drop_down_genesis_core( $gle_layout_option ) {

	/** Genesis core layout options - only if registered */
	if ( genesis_get_layout( 'content-sidebar' ) ) {

		ddw_gle_layout_select_option(
			'content-sidebar',
			__( 'Content-Sidebar', 'genesis-layout-extras' ),
			'#eee',
			$gle_layout_option
		);

	}

	if ( genesis_get_layout( 'sidebar-content' ) ) {

		ddw_gle_layout_select_option(
			'sidebar-content',
			__( 'Sidebar-Content', 'genesis-layout-extras' ),
			'#eee',
			$gle_layout_option
		);
		
	}

	if ( genesis_get_layout( 'content-sidebar-sidebar' ) ) {

		ddw_gle_layout_select_option(
			'content-sidebar-sidebar',
			__( 'Content-Sidebar-Sidebar', 'genesis-layout-extras' ),
			'#fafafa',
			$gle_layout_option
		);
		
	}

	if ( genesis_get_layout( 'sidebar-sidebar-content' ) ) {

		ddw_gle_layout_select_option(
			'sidebar-sidebar-content',
			__( 'Sidebar-Sidebar-Content', 'genesis-layout-extras' ),
			'#fafafa',
			$gle_layout_option
		);
		
	}

	if ( genesis_get_layout( 'sidebar-content-sidebar' ) ) {

		ddw_gle_layout_select_option(
			'sidebar-content-sidebar',
			__( 'Sidebar-Content-Sidebar', 'genesis-layout-extras' ),
			'#fafafa',
			$gle_layout_option
		);
		
	}

	if ( genesis_get_layout( 'full-width-content' ) ) {

		ddw_gle_layout_select_option(
			'full-width-content',
			__( 'Full Width Content', 'genesis-layout-extras' ),
			'#ddd',
			$gle_layout_option
		);
		
	}

}  // end function


add_action( 'gle_layouts_drop_down_internal', 'ddw_gle_layouts_drop_down_plugin_alternate', 10, 1 );
/**
 * Adding our own plugin's alternate layout options to the select drop-down menu.
 *
 * @since 2.0.0
 *
 * @uses  genesis_get_option()
 * @uses  ddw_gle_layout_select_option()
 *
 * @param string $gle_layout_option
 */
function ddw_gle_layouts_drop_down_plugin_alternate( $gle_layout_option ) {

	/** Additional layouts: via THIS plugin 'Genesis Layout Extras' */
	if ( genesis_get_option( 'gle_layout_sbc', GLE_SETTINGS_FIELD ) && ! defined( 'GPEX_PLUGIN_BASEDIR' ) ) {

		ddw_gle_layout_select_option(
			'sidebars-below-content',
			__( 'Sidebars below Content', 'genesis-layout-extras' ),
			'#ffe4c4',
			$gle_layout_option
		);
		
	}

	if ( genesis_get_option( 'gle_layout_pbc', GLE_SETTINGS_FIELD ) ) {

		ddw_gle_layout_select_option(
			'primary-below-content',
			__( 'Primary below Content', 'genesis-layout-extras' ),
			'#ffe4c4',
			$gle_layout_option
		);
		
	}

	if ( genesis_get_option( 'gle_layout_pac', GLE_SETTINGS_FIELD ) ) {

		ddw_gle_layout_select_option(
			'primary-above-content',
			__( 'Primary above Content', 'genesis-layout-extras' ),
			'#ffe4c4',
			$gle_layout_option
		);
		
	}

	if ( genesis_get_option( 'gle_layout_hncs', GLE_SETTINGS_FIELD ) ) {

		ddw_gle_layout_select_option(
			'headernav-content-sidebar',
			__( 'Header+Nav/Content/Sidebar', 'genesis-layout-extras' ),
			'#ffe4c4',
			$gle_layout_option
		);
		
	}

	if ( genesis_get_option( 'gle_layout_c_salt', GLE_SETTINGS_FIELD ) && ! defined( 'GPEX_PLUGIN_BASEDIR' ) ) {

		ddw_gle_layout_select_option(
			'content-sidebaralt',
			__( 'Content/Sidebar-Alt', 'genesis-layout-extras' ),
			'#ffe4c4',
			$gle_layout_option
		);
		
	}

	if ( genesis_get_option( 'gle_layout_salt_c', GLE_SETTINGS_FIELD ) && ! defined( 'GPEX_PLUGIN_BASEDIR' ) ) {

		ddw_gle_layout_select_option(
			'sidebaralt-content',
			__( 'Sidebar-Alt/Content', 'genesis-layout-extras' ),
			'#ffe4c4',
			$gle_layout_option
		);
		
	}

	if ( genesis_get_option( 'gle_layout_c_salt_s', GLE_SETTINGS_FIELD ) ) {

		ddw_gle_layout_select_option(
			'content-sidebaralt-sidebar',
			__( 'Content/Sidebar-Alt/Sidebar', 'genesis-layout-extras' ),
			'#ffe4c4',
			$gle_layout_option
		);
		
	}

	if ( genesis_get_option( 'gle_layout_s_salt_c', GLE_SETTINGS_FIELD ) ) {

		ddw_gle_layout_select_option(
			'sidebar-sidebaralt-content',
			__( 'Sidebar/Sidebar-Alt/Content', 'genesis-layout-extras' ),
			'#ffe4c4',
			$gle_layout_option
		);
		
	}

	// genesis_get_layout( 'sidebar-content-sidebaralt' 
	if ( genesis_get_option( 'gle_layout_s_c_salt', GLE_SETTINGS_FIELD ) ) {

		ddw_gle_layout_select_option(
			'sidebar-content-sidebaralt',
			__( 'Sidebar/Content/Sidebar-Alt', 'genesis-layout-extras' ),
			'#ffe4c4',
			$gle_layout_option
		);
		
	}

}  // end function


add_filter( 'genesis_export_options', 'ddw_gle_export_options' );
/**
* Hook "Genesis Layout Extras" plugin into "Genesis Exporter", allowing
*   "Genesis Layout Extras" settings to be exported.
*
* @since  1.7.0
*
* @param  array $options Genesis Exporter options.
* @return array Modified array of Exporter options.
*/
function ddw_gle_export_options( array $options ) {

	/** Add this plugin settings to the Genesis Exporter feature. */
	$options[ 'gle' ] = array(
		'label'          => __( 'Plugin', 'genesis-layout-extras' ) . ': ' . __( 'Genesis Layout Extras', 'genesis-layout-extras' ) . ' (v' . GLE_PLUGIN_VERSION . ')',
		'settings-field' => GLE_SETTINGS_FIELD
	);

	/** Return the options array for the Exporter */
	return $options;

}  // end function


add_action( 'init', 'ddw_gle_additional_post_type_support' );
/**
 * Helper function for adding Layout Options support for Post Type inpost screens.
 *
 * @since 2.0.0
 *
 * @uses  genesis_get_option()
 * @uses  get_post_types()
 * @uses  add_post_type_support()
 */
function ddw_gle_additional_post_type_support() {

	/** Bail early if no Genesis active */
	if ( ! function_exists( 'genesis_get_option' ) ) {
		return;
	}


	/**
	 * 1) Add global post type support for Genesis inpost options for all public
	 *    post types
	 */
	if ( genesis_get_option( 'gle_cpt_inpost_support_global', GLE_SETTINGS_FIELD ) ) {

		foreach ( get_post_types( array( 'public' => TRUE ) ) as $post_type ) {

			add_post_type_support( $post_type, array( 'genesis-seo', 'genesis-layouts', 'genesis-scripts' ) );

		}  // end foreach

		/** Otherwise, add support for user-specific, public post types */
	} else {

		$post_types = explode( ',', genesis_get_option( 'gle_cpt_inpost_support_custom', GLE_SETTINGS_FIELD ) );

		foreach ( $post_types as $post_type ) {

			add_post_type_support( $post_type, array( 'genesis-seo', 'genesis-layouts', 'genesis-scripts' ) );

		}  // end foreach

	}  // end if


	/**
	 * 2) Add global post type support for Genesis Archive Settings for all
	 *    public post types
	 */
	if ( genesis_get_option( 'gle_cpt_archives_support_global', GLE_SETTINGS_FIELD ) ) {

		foreach ( get_post_types( array( 'public' => TRUE, 'has_archive' => TRUE ) ) as $post_type ) {

			add_post_type_support( $post_type, 'genesis-cpt-archives-settings' );

		}  // end foreach

		/** Otherwise, add support for user-specific, public post types */
	} else {

		$post_types = explode( ',', genesis_get_option( 'gle_cpt_archives_support_custom', GLE_SETTINGS_FIELD ) );
		
		foreach ( $post_types as $post_type ) {

			add_post_type_support( $post_type, 'genesis-cpt-archives-settings' );

		}  // end foreach

	}  // end if

}  // end function


/**
 * Helper function for outputting a 'WordPress "Save" Button' for the plugin's
 *   settings page.
 *
 *   Way 1, blue: $button_type = 'button-highlighted'
 *   Way 2, gray: $button_type = 'button-primary'
 *
 * @since  2.0.0
 *
 * @param  string 	$button_type
 * @param  string 	$button_text
 * @param  string 	$output_type
 *
 * @return string HTML output for WordPress "Save" button.
 */
function ddw_gle_save_button( $button_type = 'button-primary', $button_text = 'default', $output_type = 'echo' ) {

	/** Default button text */
	if ( 'default' === $button_text ) {
		$button_text = __( 'Save', 'genesis-layout-extras' );
	}

	/** Create the button markup output */
	$output = sprintf(
		'<div class="bottom-buttons"><input type="submit" class="button %1$s" value="%2$s" title="%3$s" /></div>',
		sanitize_html_class( $button_type ),
		esc_attr( $button_text ),
		esc_html__( 'Save Settings', 'genesis-layout-extras' )
	);

	/** Control function output type */
	if ( 'echo' === sanitize_key( $output_type ) ) {
		echo $output;
	} else {
		return $output;
	}

}  // end function


/**
 * Helper function for detecting 'public' non-'_builtin' post types.
 *
 * @since  2.0.0
 *
 * @uses   get_post_types()
 *
 * @return bool TRUE if there are public, non-builtin post types, otherwise FALSE.
 */
function ddw_gle_check_cpts() {

    $gle_custom_post_types = get_post_types( array( 'public' => TRUE, '_builtin' => FALSE ) );

	if ( empty( $gle_custom_post_types ) ) {

		/** Return FALSE if there are no public, non-builtin post types */
		return FALSE;

	} else {

		/** ...otherwise, return TRUE */
		return TRUE;

	}  // end if

}  // end function


/**
 * Helper function for detecting supported plugins with CPTs.
 *
 * @since  2.0.0
 * @since  2.1.0 Made all checks more strict and plugin-specific.
 *
 * @uses   post_type_exists()
 *
 * @return bool TRUE if at least one supported plugin exists, FALSE otherwise.
 */
function ddw_gle_supported_plugins() {

	/** Layouts - CPTs by Plugins */
	if ( ( post_type_exists( 'listing' )
			&& ( ddw_gle_is_agentpress_listings_active() || ddw_gle_is_simple_listings_genesis_active() )
		)
		|| ( post_type_exists( 'portfolio' ) && ddw_gle_is_genesis_portfolio_pro_active() )
		|| ( post_type_exists( 'book' ) && ddw_gle_is_genesis_author_pro_active() )
		|| ( post_type_exists( 'product' )
			&& ( ddw_gle_is_woocommerce_active() || ddw_gle_is_jigoshop_active() )
			)
		|| ( post_type_exists( 'download' ) && ddw_gle_is_edd_active() )
		|| ddw_gle_is_bbpress_active()
		|| ( post_type_exists( 'sc_event' ) && ddw_gle_is_sugar_calendar_active() )
		|| ( post_type_exists( 'video' ) && ddw_gle_is_genesis_media_project_active() )
	) {

		return TRUE;

	} else {

		return FALSE;

	}  // end if

}  // end function


/**
 * Helper function for detecting supported child themes with CPTs.
 *
 * @since  2.0.0
 *
 * @uses   post_type_exists()
 *
 * @return bool TRUE if at least one supported child theme exists, FALSE otherwise.
 */
function ddw_gle_supported_child_themes() {

	if ( (
			post_type_exists( 'portfolio' )
			&& ( function_exists( 'minimum_portfolio_post_type' ) || function_exists( 'executive_portfolio_post_type' ) )
		)
		|| post_type_exists( 'products' )
		|| post_type_exists( 'photo' )
	) {

		return TRUE;

	} else {

		return FALSE;

	}  // end if

}  // end function


/**
 * Helper function for detecting various child themes of the "ZigZagPress" brand.
 *
 * @since  2.0.0
 *
 * @uses   CHILD_THEME_NAME
 *
 * @return bool TRUE if at least one supported child theme exists, otherwise FALSE.
 */
function ddw_gle_supported_zigzagpress() {

	/** By ZigZagPress brand */
	if ( ( CHILD_THEME_NAME == 'Megalithe'
			|| CHILD_THEME_NAME == 'Engrave Theme'
			|| CHILD_THEME_NAME == 'Vanilla'
			|| CHILD_THEME_NAME == 'Solo'
			|| CHILD_THEME_NAME == 'Bijou'
			|| CHILD_THEME_NAME == 'Eshop'
			|| CHILD_THEME_NAME == 'Single'
			|| CHILD_THEME_NAME == 'Tequila'
			|| CHILD_THEME_NAME == 'Prestige'
			|| CHILD_THEME_NAME == 'Neo'
		) && post_type_exists( 'portfolio' )
	) {

		return TRUE;

	} else {

		return FALSE;

	}  // end if

}  // end function


/**
 * Helper function for detecting Genesis child themes of the "Themedy" brand.
 *
 * @since  2.0.0
 *
 * @return bool TRUE if child theme of brand exists, FALSE otherwise.
 */
function ddw_gle_supported_themedy() {
	
	/** By Themedy brand */
	if ( function_exists( 'themedy_load_scripts' )
		|| function_exists( 'themedy_load_styles' )
		|| function_exists( 'themedy_get_option' )
	) {

		return TRUE;

	} else {

		return FALSE;

	}  // end if

}  // end function


add_filter( 'admin_body_class', 'ddw_gle_admin_body_class', 10, 1 );
/**
 * Helper function to add a admin body class to plugin settings page, for
 *   Genesis prior v2.0.0.
 *
 * @since  2.0.0
 *
 * @uses   ddw_gle_is_genesis_cpt_archive_settings_available()
 *
 * @return string Strings of admin body classes.
 */
function ddw_gle_admin_body_class( $classes ) {

	/** Check for Genesis function, otherwise bail early */
	if ( ! function_exists( 'genesis_is_menu_page' ) ) {
		return;
	}

	/** Add admin body class */
	if ( genesis_is_menu_page( 'gle-layout-extras' )
		&& ! ddw_gle_is_genesis_cpt_archive_settings_available()
	) {
    	return $classes . ' gle-pre-g200';
    }

    /** Return the default */
    return $classes;

}  // end function


/**
 * Check if any of our nine alternate layout options are currently registered in
 *   Genesis Layouts.
 *
 * @since  2.1.0
 * @since  2.1.1 Fixed, simplified and reworked the logic.
 *
 * @see    ddw_genesis_layout_extras_option()
 *
 * @uses   genesis_get_layout()
 *
 * @return bool TRUE if any of our alternate layouts is currently registered in
 *              Genesis Layouts, FALSE otherwise.
 */
function ddw_gle_is_alternate_layout_registered() {

	/** Our possible alternate layouts */
	$gle_alternate_layouts = array(
		'sidebars-below-content',
		'primary-below-content',
		'primary-above-content',
		'headernav-content-sidebar',
		'content-sidebaralt',
		'sidebaralt-content',
		'content-sidebaralt-sidebar',
		'sidebar-sidebaralt-content',
		'sidebar-content-sidebaralt',
	);

	/** Set default */
	$layout_check = FALSE;

	/** Loop through all alternate layouts */
	foreach ( $gle_alternate_layouts as $alternate_layout ) {

		if ( is_array( genesis_get_layout( $alternate_layout ) ) ) {
			$layout_check = TRUE;
			break;
		}

	}  // end foreach

	/**
	 * Return the layout check boolean:
	 *  - TRUE if any alternate layout registered (means array of reg. layouts)
	 *  - FALSE otherwise (means no array of reg. layouts)
	 */
	return $layout_check;

}  // end function


/**
 * Plugin tips/ recommendations.
 *
 * @since 2.1.0
 */
function ddw_gle_plugin_tips() {

	$plugins = array(
		'toolbar-extras'                     => 'tbex',
		'builder-template-categories'        => 'btc',
		'genesis-widgetized-notfound'        => 'gwnf',
		'genesis-whats-new-info'             => 'gnewi',
		'genesis-extra-settings-transporter' => 'gest',
	);

	$install_link = '';
	$details_link = '';
	$image_url    = '';

	$output = '<ul class="gle-plugin-tips">';

	foreach ( $plugins as $plugin => $plugin_data ) {
		
		$install_link = wp_nonce_url( admin_url( 'update.php?action=install-plugin&amp;plugin=' . $plugin ), 'install-plugin_' . $plugin );

		$details_link = sprintf(
			self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=%1$s&amp;TB_iframe=true&amp;width=772&amp;height=1240' ),
			$plugin
		);

		$image_url = sprintf(
			plugins_url( '/assets/images/icon-%s.png', dirname( dirname( __FILE__ ) ) ),
			$plugin_data
		);

		$output .= sprintf(
			'<li class="gle-plugin-tips-item"><a class="thickbox" href="%1$s" title="%3$s"><img src="%2$s" width="96" height="96" /></a>
			<br /><a href="%4$s" target="_blank" rel="noopener noreferrer"><button class="button button-primary"><span class="dashicons dashicons-download"></span></button></a> <a class="thickbox" href="%1$s" title="%3$s"><button class="button"><span class="dashicons dashicons-info"></span></button></a>
			</li>',
			esc_url( $details_link ),
			esc_url( $image_url ),
			esc_attr__( 'A great Plugin for Site Builders:', 'genesis-layout-extras' ),
			esc_url( $install_link )
		);

	}  // end foreach

	$output .= '</ul>';

	return $output;

}  // end function
