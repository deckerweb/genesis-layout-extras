<?php

// includes/gle-admin-help

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Help tab footer content.
 *
 * @since  2.0.0
 * @since  2.1.0 Split into own functionfor re-usage.
 *
 * @uses   ddw_gle_info_values()
 * @uses   ddw_gle_get_info_link()
 * @uses   ddw_gle_coding_years()
 *
 * @param  string $render Flag string to optionally echo string (not returning).
 * @return string Returning or echoing the translateable strings and markup.
 */
function ddw_gle_help_tab_footer( $render = '' ) {

	$gle_info = ddw_gle_info_values();

	/** Further help content */
	$footer = $gle_info[ 'space_helper' ] . '<p><h4 style="font-size: 1.1em;">' . __( 'Important plugin links:', 'genesis-layout-extras' ) . '</h4>' .

		ddw_gle_get_info_link( 'url_plugin', esc_html__( 'Plugin website', 'genesis-layout-extras' ), 'button' ) .

		//'&nbsp;&nbsp;' . ddw_gle_get_info_link( 'url_plugin_faq', esc_html_x( 'FAQ', 'Help tab info', 'genesis-layout-extras' ), 'button' ) .

		'&nbsp;&nbsp;' . ddw_gle_get_info_link( 'url_wporg_forum', esc_html_x( 'Support', 'Help tab info', 'genesis-layout-extras' ), 'button' ) .

		'&nbsp;&nbsp;' . ddw_gle_get_info_link( 'url_fb_group', esc_html_x( 'Facebook Group', 'Help tab info', 'genesis-layout-extras' ), 'button' ) .

		'&nbsp;&nbsp;' . ddw_gle_get_info_link( 'url_translate', esc_html_x( 'Translations', 'Help tab info', 'genesis-layout-extras' ), 'button' ) .

		'&nbsp;&nbsp;' . ddw_gle_get_info_link( 'url_donate', esc_html_x( 'Donate', 'Help tab info', 'genesis-layout-extras' ), 'button dashicons-before dashicons-thumbs-up gle' ) .

		'&nbsp;&nbsp;' . ddw_gle_get_info_link( 'url_newsletter', esc_html_x( 'Join our Newsletter', 'Help tab info', 'genesis-layout-extras' ), 'button button-primary dashicons-before dashicons-awards gle' );

	$footer .= sprintf(
		'<p><a href="%1$s" target="_blank" rel="nofollow noopener noreferrer" title="%2$s">%2$s</a> &#x000A9; %3$s <a href="%4$s" target="_blank" rel="noopener noreferrer" title="%5$s">%5$s</a></p>',
		esc_url( $gle_info[ 'url_license' ] ),
		esc_attr( $gle_info[ 'license' ] ),
		ddw_gle_coding_years(),
		esc_url( $gle_info[ 'author_uri' ] ),
		esc_html( $gle_info[ 'author' ] )
	);

	/** Optional echo footer */
	if ( 'echo' === sanitize_key( $render ) ) {
		echo $footer;
	}

	/** Return footer */
	return $footer;

}  // end function


/**
 * Help content for additional layout options of this plugin that are deprecated
 *   since v2.1.0+.
 *
 * @since 2.1.0
 *
 * @param  string $render Flag string to optionally echo string (not returning).
 * @return string Returning or echoing the translateable strings and markup.
 */
function ddw_gle_help_content_layouts_deprecated( $render = '' ) {

	$message = sprintf(
		/* translators: %1$s - emphasized phrase "additional layouts" */
		__( 'The up to nine %1$s added with version 2.0.0 of the plugin back in 2013 are now deprecated as of December 2018. That means, they will NOT receive any more updates and also NO SUPPORT. You can still use them if you want but you need to care for the proper styling, displaying etc. yourself. Therefore it would make more sense for you to not use these option from the plugin but rather register custom layouts yourself and make use of our filters to bring them also into the settings drop-down field. Thanks for your understanding! - This note only regards the %1$s, NOT the plugin itself of course, the plugin is alive and kicking, hehe :-).', 'genesis-layout-extras' ),
		'<em>' . __( 'additional layouts', 'genesis-layout-extras' ) . '</em>' 
	);

	$content = sprintf(
		'<div class="gle-deprecated notice notice-warning inline">
			<div class="gle-deprecated-icon dashicons dashicons-warning"></div><div class="gle-deprecated-title">%1$s:</div>
			<div class="gle-deprecated-message">%2$s</div>
		</div>',
		__( 'Please note', 'genesis-layout-extras' ),
		$message
	);

	/** Optional echo content */
	if ( 'echo' === sanitize_key( $render ) ) {
		echo $content;
	}

	/** Return content */
	return $content;

}  // end function


/**
 * Add help tab content for Genesis Layout Extras Plugin.
 *
 * @since 2.0.0
 *
 * @uses  ddw_gle_help_tab_footer()
 */
function ddw_gle_plugin_start_help() {

	echo '<h3><span class="dashicons dashicons-welcome-widgets-menus"></span> ' . __( 'Plugin', 'genesis-layout-extras' ) . ': ' . __( 'Genesis Layout Extras', 'genesis-layout-extras' ) . ' <small class="gle-help-version">v' . GLE_PLUGIN_VERSION . '</small></h3>';

	ddw_gle_help_content_usage();

	ddw_gle_help_tab_footer( 'echo' );

}  // end function


/**
 * Helper function for echoing the sub headline for help content as HTML string
 *   with specific sub head paramter (title/ subject).
 *
 * @since 2.0.0
 * @since 2.1.0 Added 2nd param, $dashicon.
 *
 * @param string $gle_subhead Label for the sub title.
 * @param string $dashicon    Dashicon css class for icon.
 */
function ddw_gle_help_content_sub_head( $gle_subhead = '', $dashicon = 'dashicons-welcome-widgets-menus' ) {

	echo sprintf(
		'<h3><span class="dashicons %3$s"></span> %1$s: %2$s</h3>',
		__( 'Genesis Layout Extras', 'genesis-layout-extras' ),
		esc_attr( $gle_subhead ),
		sanitize_html_class( $dashicon, 'dashicons-welcome-widgets-menus' )
	);

}  // end function


/**
 * Create and display plugin help tab content: Plugin Info/ Usage etc..
 *
 * @since  1.0.0
 *
 * @uses   ddw_gle_core_sidebars_exists()
 * @uses   ddw_gle_help_content_layouts_deprecated()
 *
 * @return string/HTML of help tab content.
 */
function ddw_gle_help_content_usage() {

	echo '<h4>' . __( 'Section and Template based layout changing', 'genesis-layout-extras' ) . ':</h4>' .
		'<p><blockquote>' . __( 'This plugin for the Genesis Theme Framework allows modifying of default layouts for homepage, singular, archive, attachment, search and 404 pages via its options page under the Genesis menu.', 'genesis-layout-extras' ) . ' ' . sprintf(
			/* translators: %1$s - "bbPress 2.x" / %2$s - "AgentPress Listings" / %3$s - "WooCommerce, Jigoshop, Easy Digital Downloads" / %4$s - "Sugar Events Calendar" */
			__( 'In addition you can also modify the default layout option for pages generated by various popular plugins - if installend - among these are: %1$s forum plugin, %2$s plugin, %3$s and %4$s.', 'genesis-layout-extras' ),
			'bbPress 2.x',
			'AgentPress Listings',
			'WooCommerce, Jigoshop, Easy Digital Downloads',
			'Sugar Events Calendar'
		) . '</blockquote></p>';

	if ( ddw_gle_core_sidebars_exists( 'sidebar' ) ) {

		echo '<h4>' . __( 'Registering additional layouts', 'genesis-layout-extras' ) . ':</h4>' .
		'<p><blockquote>' . sprintf(
			/* translators: %1$s - name of a sidebar, "Secondary Sidebar (Sidebar-Alt)" / %2$s - name of a sidebar, "Primary Sidebar" */
			__( 'Since version 2.0.0 of this plugin you can also register up to nine (9!) additional alternate layout options. All of these make use of the %1$s and most also of the %2$s. So make sure both are registered with your child theme.', 'genesis-layout-extras' ),
			'<em>' . __( 'Secondary Sidebar (Sidebar-Alt)', 'genesis-layout-extras' ) . '</em>',
			'<em>' . __( 'Primary Sidebar', 'genesis-layout-extras' ) . '</em>'
		) . '</blockquote></p>';

		ddw_gle_help_content_layouts_deprecated( 'echo' );

	}  // end if

}  // end function


/**
 * Create and display plugin help tab content: "Layout Extras".
 *
 * @since 2.0.0
 *
 * @uses  ddw_gle_help_content_sub_head()
 * @uses  ddw_gle_help_content_layouts_deprecated()
 * @uses  genesis_get_layout()
 * @uses  ddw_gle_is_genesis_prose_extras_active()
 * @uses  ddw_gle_help_tab_footer()
 */
function ddw_gle_help_content_layout_extras() {

	ddw_gle_help_content_sub_head( __( 'Layouts', 'genesis-layout-extras' ), 'dashicons-schedule' );

	ddw_gle_help_content_layouts_deprecated( 'echo' );

	/** Custom CSS advise */
	echo '<h4>' . __( 'Additional, alternate layout options', 'genesis-layout-extras' ) . ':</h4>' .
			'<p>' . __( 'Consider these more like variations of existing layouts. So, in the end you have even more flexibility with no overhead! This could be great for content oriented blogs, marketeers websites and so much more...', 'genesis-layout-extras' ) . ' &mdash; ' . __( 'Currently enabled', 'genesis-layout-extras' ) . ':</p>';

			if ( genesis_get_layout( 'sidebars-below-content' ) && ! ddw_gle_is_genesis_prose_extras_active() ) {

				echo '<div class="gle-layout-div"><img class="gle-layout-img alignleft" src="' . apply_filters( 'gle_filter_layout_image_sidebars_below_content', esc_url( plugins_url( 'assets/images/gle_sbc.gif', dirname( dirname( dirname( __FILE__ ) ) ) ) ) ) . '" title="' . esc_html__( 'Sidebars below Content', 'genesis-layout-extras' ) . '" /><span><em>' . __( 'Sidebars below Content', 'genesis-layout-extras' ) . '</em><br />&rarr; ' . sprintf(
					/* translators: %s - a Genesis layout name, "Full Width Content" */
					__( 'Think of it as %s, but with Primary and Secondary sidebars below the content (as two fifty percent-wide responsive columns).', 'genesis-layout-extras' ),
					'"' . __( 'Full Width Content', 'genesis-layout-extras' ) . '"'
				) . '</span></div>';

			}  // end if SBC layout check

			if ( genesis_get_layout( 'primary-below-content' ) ) {

				echo '<div class="gle-layout-div"><img class="gle-layout-img alignleft" src="' . apply_filters( 'gle_filter_layout_image_primary_below_content', esc_url( plugins_url( 'assets/images/gle_pbc.gif', dirname( dirname( dirname( __FILE__ ) ) ) ) ) ) . '" title="' . esc_html__( 'Primary below Content', 'genesis-layout-extras' ) . '" /><span><em>' . __( 'Primary below Content', 'genesis-layout-extras' ) . '</em><br />&rarr; ' . sprintf(
					/* translators: %s - a Genesis layout name, "Full Width Content" */
					__( 'Think of it as %s, but with Primary sidebar below the content.', 'genesis-layout-extras' ),
					'"' . __( 'Full Width Content', 'genesis-layout-extras' ) . '"'
				) . '</span></div>';

			}  // end if PBC layout check

			if ( genesis_get_layout( 'primary-above-content' ) ) {

				echo '<div class="gle-layout-div"><img class="gle-layout-img alignleft" src="' . apply_filters( 'gle_filter_layout_image_primary_above_content', esc_url( plugins_url( 'assets/images/gle_pac.gif', dirname( dirname( dirname( __FILE__ ) ) ) ) ) ) . '" title="' . esc_html__( 'Primary above Content', 'genesis-layout-extras' ) . '" /><span><em>' . __( 'Primary above Content', 'genesis-layout-extras' ) . '</em><br />&rarr; ' . sprintf(
					/* translators: %s - a Genesis layout name, "Full Width Content" */
					__( 'Think of it as %s, but with Primary sidebar above the content.', 'genesis-layout-extras' ),
					'"' . __( 'Full Width Content', 'genesis-layout-extras' ) . '"'
				) . '</span></div>';

			}  // end if PAC layout check

			if ( genesis_get_layout( 'content-sidebaralt' ) && ! ddw_gle_is_genesis_prose_extras_active() ) {

				echo '<div class="gle-layout-div"><img class="gle-layout-img alignleft" src="' . apply_filters( 'gle_filter_layout_image_content_sidebaralt', esc_url( plugins_url( 'assets/images/gle_c-salt.gif', dirname( dirname( dirname( __FILE__ ) ) ) ) ) ) . '" title="' . esc_html__( 'Content/Sidebar-Alt', 'genesis-layout-extras' ) . '" /><span><em>' . __( 'Content/Sidebar-Alt', 'genesis-layout-extras' ) . '</em><br />&rarr; ' . sprintf(
					/* translators: %s - a Genesis layout name, "Content-Sidebar" */
					__( 'Think of it as a variation of %s.', 'genesis-layout-extras' ),
					'"' . __( 'Content-Sidebar', 'genesis-layout-extras' ) . '"'
				) . '</span></div>';

			}  // end if CSA layout check

			if ( genesis_get_layout( 'sidebaralt-content' ) && ! ddw_gle_is_genesis_prose_extras_active() ) {

				echo '<div class="gle-layout-div"><img class="gle-layout-img alignleft" src="' . apply_filters( 'gle_filter_layout_image_sidebaralt_content', esc_url( plugins_url( 'assets/images/gle_salt-c.gif', dirname( dirname( dirname( __FILE__ ) ) ) ) ) ) . '" title="' . esc_html__( 'Sidebar-Alt/Content', 'genesis-layout-extras' ) . '" /><span><em>' . __( 'Sidebar-Alt/Content', 'genesis-layout-extras' ) . '</em><br />&rarr; ' . sprintf(
					/* translators: %s - a Genesis layout name, "Sidebar-Content" */
					__( 'Think of it as a variation of %s.', 'genesis-layout-extras' ),
					'"' . __( 'Sidebar-Content', 'genesis-layout-extras' ) . '"'
				) . '</span></div>';

			}  // end if SAC layout check

			if ( genesis_get_layout( 'content-sidebaralt-sidebar' ) ) {

				echo '<div class="gle-layout-div"><img class="gle-layout-img alignleft" src="' . apply_filters( 'gle_filter_layout_image_content_sidebaralt_sidebar', esc_url( plugins_url( 'assets/images/gle_c-salt-s.gif', dirname( dirname( dirname( __FILE__ ) ) ) ) ) ) . '" title="' . esc_html__( 'Content/Sidebar-Alt/Sidebar', 'genesis-layout-extras' ) . '" /><span><em>' . __( 'Content/Sidebar-Alt/Sidebar', 'genesis-layout-extras' ) . '</em><br />&rarr; ' . sprintf(
					/* translators: %s - a Genesis layout name, "Content-Sidebar-Sidebar" */
					__( 'Think of it as a variation of %s.', 'genesis-layout-extras' ),
					'"' . __( 'Content-Sidebar-Sidebar', 'genesis-layout-extras' ) . '"'
				) . '</span></div>';

			}  // end if CSAS layout check

			if ( genesis_get_layout( 'sidebar-sidebaralt-content' ) ) {

				echo '<div class="gle-layout-div"><img class="gle-layout-img alignleft" src="' . apply_filters( 'gle_filter_layout_image_sidebar_sidebaralt_content', esc_url( plugins_url( 'assets/images/gle_s-salt-c.gif', dirname( dirname( dirname( __FILE__ ) ) ) ) ) ) . '" title="' . esc_html__( 'Sidebar/Sidebar-Alt/Content', 'genesis-layout-extras' ) . '" /><span><em>' . __( 'Sidebar/Sidebar-Alt/Content', 'genesis-layout-extras' ) . '</em><br />&rarr; ' . sprintf(
					/* translators: %s - a Genesis layout name, "Sidebar-Sidebar-Content" */
					__( 'Think of it as a variation of %s.', 'genesis-layout-extras' ),
					'"' . __( 'Sidebar-Sidebar-Content', 'genesis-layout-extras' ) . '"'
				) . '</span></div>';

			}  // end if SSAC layout check

			if ( genesis_get_layout( 'sidebar-content-sidebaralt' ) ) {

				echo '<div class="gle-layout-div"><img class="gle-layout-img alignleft" src="' . apply_filters( 'gle_filter_layout_image_sidebar_content_sidebaralt', esc_url( plugins_url( 'assets/images/gle_s-c-salt.gif', dirname( dirname( dirname( __FILE__ ) ) ) ) ) ) . '" title="' . esc_html__( 'Sidebar/Content/Sidebar-Alt', 'genesis-layout-extras' ) . '" /><span><em>' . __( 'Sidebar/Content/Sidebar-Alt', 'genesis-layout-extras' ) . '</em><br />&rarr; ' . sprintf(
					/* translators: %s - a Genesis layout name, "Sidebar-Content-Sidebar" */
					__( 'Think of it as a variation of %s.', 'genesis-layout-extras' ),
					'"' . __( 'Sidebar-Content-Sidebar', 'genesis-layout-extras' ) . '"'
				) . '</span></div>';

			}  // end if SCSA layout check

			if ( genesis_get_layout( 'headernav-content-sidebar' ) ) {

				echo '<div class="gle-layout-div"><img class="gle-layout-img alignleft" src="' . apply_filters( 'gle_filter_layout_image_headernav_content_sidebar', esc_url( plugins_url( 'assets/images/gle_hncs.gif', dirname( dirname( dirname( __FILE__ ) ) ) ) ) ) . '" title="' . esc_html__( 'Header+Nav/Content/Sidebar', 'genesis-layout-extras' ) . '" /><span><em>' . __( 'Header+Nav/Content/Sidebar', 'genesis-layout-extras' ) . '</em><br />&rarr; ' . __( 'Think of it as a special variation of the 3-column layouts but with fixed left column which consists of re-positioned header together with widget area and footer mixed in.', 'genesis-layout-extras' ) . '</span></div>';

			}  // end if HNCS layout check

		echo '</ul>' .
			'<p>' . __( 'These alternate layouts are fully responsive. All is working like it should with minimal additions on CSS style rules (only what\'s really needed).', 'genesis-layout-extras' ) . ' ' . __( 'Those CSS additions are optional (see settings below), you can also ever integrate the style rules with your child theme.', 'genesis-layout-extras' ) . '</p>';

	/** Help tab footer */
	ddw_gle_help_tab_footer( 'echo' );

}  // end function


/**
 * Create and display plugin help tab content: "Layout Extras".
 *
 * @since 2.0.0
 *
 * @uses  ddw_gle_help_content_sub_head()
 * @uses  genesis_get_layout()
 * @uses  ddw_gle_supported_plugins()
 * @uses  ddw_gle_supported_child_themes()
 * @uses  ddw_gle_help_tab_footer()
 */
function ddw_gle_help_content_post_type_support() {

	ddw_gle_help_content_sub_head( __( 'Additional Post Type Support', 'genesis-layout-extras' ), 'dashicons-admin-page' );

	echo '<h4>' . __( 'Add Genesis Inpost options for public Custom Post Types', 'genesis-layout-extras' ) . ':</h4>' .
		'<p><blockquote>' . __( 'A lot of plugins with post types already integrate good with Genesis but lack support for inpost screen meta boxes. That is especially needed for layout options support.', 'genesis-layout-extras' ) . ' ' . sprintf(
				/* translators: %s - label "public" */
				__( 'To solve this, you can add global support for all %s custom post types below, or, if you want, only for specific post types you need for the project.', 'genesis-layout-extras' ),
				'<em>' . __( 'public', 'genesis-layout-extras' ) . '</em>'
			) . ' ' . __( 'As a bonus, the inpost SEO and Script meta boxes are included as well. You might need those, too :).', 'genesis-layout-extras' ) . '</blockquote></p>';

	if ( class_exists( 'Genesis_Admin_CPT_Archive_Settings' ) && ddw_gle_check_cpts() ) {

		echo '<h4>' . __( 'Add Genesis Archive Settings for public Custom Post Types', 'genesis-layout-extras' ) . ':</h4>' .
			'<p><blockquote>' . sprintf(
					/* translators: %s - PHP code in HTML code tags */
					__( 'This optional Genesis feature can now be enabled with this plugin in global way for all public custom post types that were registered with archive support (%s).', 'genesis-layout-extras' ),
					'<code>\'has_archive\' => true</code>'
				) . ' ' . __( 'Alternatively, you can also only activate that for specific post types you need for the project.', 'genesis-layout-extras' ) . ' &mdash; ' . __( 'These archive settings allow for setting of: archive/page title, detailed introductory texts, SEO settings and layout options.', 'genesis-layout-extras' ) . '</blockquote></p>';

		if ( ddw_gle_supported_plugins() || ddw_gle_supported_child_themes() ) {

			echo '<p><blockquote>' . __( 'Note: The layout settings for archives done via these Genesis Archive settings and/or the content archive settings of THIS plugin (see below) do just the same. So you decide which one you use. Nothing could break, and it does no harm. So, enjoy your content archives (settings)!', 'genesis-layout-extras' ) . ' :)</blockquote></p>';

		}  // end if supported plugins/child themes check

	}  // end if Genesis 2.0+, plus not-builtin post types check

	/** Help tab footer */
	ddw_gle_help_tab_footer( 'echo' );

}  // end function


/**
 * Create and display plugin help tab content: "FAQ".
 *
 * @since  1.0.0
 *
 * @uses   ddw_gle_help_content_sub_head()
 * @uses   ddw_gle_help_tab_footer()
 *
 * @return string/HTML of help tab content.
 */
function ddw_gle_help_content_faq() {

	ddw_gle_help_content_sub_head( __( 'FAQ - Frequently Asked Questions', 'genesis-layout-extras' ), 'dashicons-editor-help' );

	echo '<p><strong>' . __( 'Question', 'genesis-layout-extras' ) . ':</strong> <em>' . __( 'Some settings seem to have no effect at all, what happens here?', 'genesis-layout-extras' ) . '</em>' .
		'<blockquote><strong>' . __( 'Answer', 'genesis-layout-extras' ) . ':</strong> ' . __( 'This has to do with priorities. In general, if there is a template for a specific page (archive) type, for example <code>image.php</code> for image attachment display, then Genesis & WordPress will always use that first for the content output AS LONG AS there is an layout setting function or filter in there. Only if there are no templates with layout settings found, the layout option settings will take full effect. So, if our example <code>image.php</code> has a layout filter set in this then has the higher priority but if there is no layout filter in there then the layout setting of the plugin will take effect! - Well, if you experience such cases just leave these fields on "Genesis Default" and you are good to go :-).', 'genesis-layout-extras' ) . '</blockquote></p>';

	echo ddw_gle_space_helper();

	echo '<p><strong>' . __( 'Question', 'genesis-layout-extras' ) . ':</strong> <em>' . __( 'There are two layout options for the plugin AgentPress Listings post type. What does that mean?', 'genesis-layout-extras' ). '</em>' .
		'<blockquote><strong>' . __( 'Answer', 'genesis-layout-extras' ) . ':</strong> ' . sprintf(
			/* translators: %1$s - opening link markup / %2$s - closing link markup / %3$s - opening link markup */
			__( 'You just can set the layout option for the archive pages of the "listings" post type, plus for all terms of its built-in "features" taxonomy. - &mdash; Of course, %1$sthe plugin%2$s (and so the setting here) could be used with the %3$sAgentPress child theme%2$s and also with any other Genesis child theme, so this setting might come in really handy ;-).', 'genesis-layout-extras' ),
			'<a href="https://deckerweb.de/go/agentpress-listings/" target="_blank" rel="noopener noreferrer" title="Plugin: AgentPress Listings ...">',
			'</a>',
			'<a href="https://deckerweb.de/go/genesis-agentpress-child-theme/" target="_blank" rel="noopener noreferrer" title="AgentPress Genesis Child Theme ...">'
		) . '</blockquote></p>';

	echo ddw_gle_space_helper();

	echo '<p><strong>' . __( 'Question', 'genesis-layout-extras' ) . ':</strong> <em>' . __( 'What means Reset of settings?', 'genesis-layout-extras' ) . '</em>' .
		'<blockquote><strong>' . __( 'Answer', 'genesis-layout-extras' ) . ':</strong> ' . __( 'Actually it just restores the default layout setting which is always defined in regular layout settings on the Genesis Theme Settings page.', 'genesis-layout-extras' ) . '</blockquote></p>';

	echo ddw_gle_space_helper();

	echo '<p><strong>' . __( 'Question', 'genesis-layout-extras' ) . ':</strong> <em>' . __( 'Which settings are effected when doing a reset?', 'genesis-layout-extras' ). '</em>' .
		'<blockquote><strong>' . __( 'Answer', 'genesis-layout-extras' ) . ':</strong> ' . __( 'ALL available options <em>on this page</em> are resetted to their defaults! So if you only want to reset <em>one</em> option and leave all other as they are then only change this one section and then click the SAVE button and you are done.', 'genesis-layout-extras' ) . '</blockquote></p>';

	/** Help tab footer */
	ddw_gle_help_tab_footer( 'echo' );

}  // end function


/**
 * Create and display plugin help tab content: "Translations".
 *
 * @since  1.0.0
 *
 * @uses   ddw_gle_get_info_url()
 * @uses   ddw_gle_help_tab_footer()
 *
 * @return string/HTML of help tab content.
 */
function ddw_gle_help_content_translations() {

	ddw_gle_help_content_sub_head( __( 'Translations', 'genesis-layout-extras' ), 'dashicons-translation' );

	echo '<p>' . sprintf(
		/* translators: %1$s - opening link markup / %2$s - closing link markup */
		__( 'Please contribute to existing or new translations on %1$sour free translations platform%2$s powered by GlotPress.', 'genesis-layout-extras' ),
		'<a href="' . ddw_gle_get_info_url( 'url_translate' ) . '" target="_blank" rel="noopener noreferrer" title="' . __( 'Translations', 'genesis-layout-extras' ) . '"><strong>',
		'</strong></a>'
	) . '</p>' .
		'<p><blockquote><strong><em>&mdash; ' . __( 'Thank You!', 'genesis-layout-extras' ) . '</em></strong></blockquote></p>';

	if ( get_locale() == 'de_DE' || get_locale() == 'de_AT' || get_locale() == 'de_CH' || get_locale() == 'de_LU' ) {
		$gle_language_in_use = '<em> (' . __( 'Currently in use', 'genesis-layout-extras' ) . ' :)</em>';
	} else {
		$gpex_language_in_use = '';
	}

	echo ddw_gle_space_helper();

	echo '<p><strong>' . __( 'Currently available languages', 'genesis-layout-extras' ) . ':</strong></p>' .
		'<ul>' .
			'<li>' . __( 'English (en_US)', 'genesis-layout-extras' ) . ' &ndash; ' . __( 'default, always included (by David Decker)', 'genesis-layout-extras' ) . '</li>' .
			'<li>' . __( 'German (de_DE): Deutsch', 'genesis-layout-extras' ) . ' &ndash; ' . __( 'always included (by David Decker)', 'genesis-layout-extras' ) . $gle_language_in_use . '</li>' .

			'<li>' . __( 'French (fr_FR): Français', 'genesis-layout-extras' ) . ' &ndash; ' . __( 'user-submitted', 'genesis-layout-extras' ) . ' &rarr; <a href="https://translate.wordpress.org/locale/fr/default/wp-plugins/genesis-layout-extras" target="_blank" rel="noopener noreferrer">' . __( 'Help translate and improve it!', 'genesis-layout-extras' ). '</a></li>' .

			'<li>' . __( 'Spanish (es_ES): Español', 'genesis-layout-extras' ) . ' &ndash; ' . __( 'user-submitted', 'genesis-layout-extras' ) . ' &rarr; <a href="https://translate.wordpress.org/locale/es/default/wp-plugins/genesis-layout-extras" target="_blank" rel="noopener noreferrer">' . __( 'Help translate and improve it!', 'genesis-layout-extras' ). '</a></li>' .

			'<li>' . __( 'Italian (it_IT): Italiano', 'genesis-layout-extras' ) . ' &ndash; ' . __( 'user-submitted', 'genesis-layout-extras' ) . ' &rarr; <a href="https://translate.wordpress.org/locale/it/default/wp-plugins/genesis-layout-extras" target="_blank" rel="noopener noreferrer">' . __( 'Help translate and improve it!', 'genesis-layout-extras' ). '</a></li>' .

			'<li>' . __( 'Swedish (sv_SE): Svenska', 'genesis-layout-extras' ) . ' &ndash; ' . __( 'user-submitted', 'genesis-layout-extras' ) . ' &rarr; <a href="https://translate.wordpress.org/locale/sv/default/wp-plugins/genesis-layout-extras" target="_blank" rel="noopener noreferrer">' . __( 'Help translate and improve it!', 'genesis-layout-extras' ). '</a></li>' .

			'<li>' . __( 'Hindi (hi_IN - for India)', 'genesis-layout-extras' ) . ' &ndash; ' . __( 'user-submitted', 'genesis-layout-extras' ) . ' &rarr; <a href="https://translate.wordpress.org/locale/hi/default/wp-plugins/genesis-layout-extras" target="_blank" rel="noopener noreferrer">' . __( 'Help translate and improve it!', 'genesis-layout-extras' ). '</a></li>' .
		'</ul>';

	/** Help tab footer */
	ddw_gle_help_tab_footer( 'echo' );

}  // end function


/**
 * Add help tab content for Recommended Plugins.
 *
 * @since 2.0.0
 *
 * @uses  ddw_gle_help_tab_footer()
 */
function ddw_gle_help_content_recommended_plugins() {

	echo '<h3><span class="dashicons dashicons-admin-plugins"></span> ' . __( 'Recommended Plugins', 'genesis-layout-extras' ) . '</h3>';

	echo __( 'Optional extensions to get the best out of your Genesis powered child theme.', 'genesis-layout-extras' );

	echo '<ul>';

		if ( ! ddw_gle_is_toolbar_extras_active() ) {
			echo '<li><a href="https://wordpress.org/plugins/toolbar-extras/" target="_blank" rel="noopener noreferrer" title="Toolbar Extras for Genesis ...">Toolbar Extras for Genesis</a><br /><small>' . __( 'Manage Genesis Framework, active child theme and extensions from your WordPress toolbar. Massive resources links included!', 'genesis-layout-extras' ) . '</small></li>';
			$gle_help_plugins = 'not_installed';
		}

		if ( ! ddw_gle_is_genesis_widgetized_notfound_active() ) {
			echo '<li><a href="https://wordpress.org/plugins/genesis-widgetized-notfound/" target="_blank" rel="noopener noreferrer" title="Genesis Widgetized Not Found & 404 ...">Genesis Widgetized Not Found & 404</a><br /><small>' . __( 'Easily add widgets for these two not found edge cases. Then you\'re prepared! Again, changing content then is really easy!', 'genesis-layout-extras' ) . '</small></li>';
			$gle_help_plugins = 'not_installed';
		}

		if ( ! ddw_gle_is_genesis_extra_settings_transporter_active() ) {
			echo '<li><a href="https://wordpress.org/plugins/genesis-extra-settings-transporter/" target="_blank" rel="noopener noreferrer" title="Genesis Extra Settings Transporter ...">Genesis Extra Settings Transporter</a><br /><small>' . __( 'Adds support for exporting settings of various Genesis specific plugins & Child Themes via the Genesis Exporter feature.', 'genesis-layout-extras' ) . '</small></li>';
			$gle_help_plugins = 'not_installed';
		}

		if ( ! ddw_gle_is_genesis_whats_new_info_active() ) {
			echo '<li><a href="https://wordpress.org/plugins/genesis-whats-new-info/" target="_blank" rel="noopener noreferrer" title="Genesis What\'s New Info ...">Genesis What\'s New Info</a><br /><small>' . __( 'Easy access of the Genesis What\'s New Admin overview page - not only on updates but everytime.', 'genesis-layout-extras' ) . '</small></li>';
			$gle_help_plugins = 'not_installed';
		}

		if ( ! ddw_gle_is_genesis_widgetized_archive_active() ) {
			echo '<li><a href="https://wordpress.org/plugins/genesis-widgetized-archive/" target="_blank" rel="noopener noreferrer" title="Genesis Widgetized Archive ...">Genesis Widgetized Archive</a><br /><small>' . __( 'Finally, use widgets to maintain &amp; customize your Archive Page Template in Genesis Framework and Child Themes to create archive or sitemap-like listings.', 'genesis-layout-extras' ) . '</small></li>';
			$gle_help_plugins = 'not_installed';
		}

		if ( ! ddw_gle_is_genesis_printstyle_plus_active() ) {
			echo '<li><a href="https://wordpress.org/plugins/genesis-printstyle-plus/" target="_blank" rel="noopener noreferrer" title="Genesis Printstyle Plus ...">Genesis Printstyle Plus</a><br /><small>' . __( 'Print out your content easily - unneeded sections are removed.', 'genesis-layout-extras' ) . '</small></li>';
			$gle_help_plugins = 'not_installed';
		}

		if ( 'not_installed' !== $gle_help_plugins  ) {
			echo '<li><em>' . __( 'Perfect, you already have all our recommended plugins installed.', 'genesis-layout-extras' ) . '</em></li>';
		}

	echo '</ul>';

	/** Help tab footer */
	ddw_gle_help_tab_footer( 'echo' );

}  // end function


/**
 * Helper function for returning the Help Sidebar content.
 *
 * @since  1.7.0
 *
 * @uses   ddw_gle_get_info_url()
 *
 * @return string/HTML of help sidebar content.
 */
function ddw_gle_help_sidebar_content() {

	$gle_help_sidebar = '<p><strong>' . __( 'Feedback and more about the Author', 'genesis-layout-extras' ) . '</strong></p>' .
		'<p><a href="' . ddw_gle_get_info_url( 'url_plugin' ) . '" target="_blank" rel="noopener noreferrer" title="' . __( 'Website', 'genesis-layout-extras' ) . '">' . __( 'Website', 'genesis-layout-extras' ) . '</a> | <a href="' . ddw_gle_get_info_url( 'url_wporg_forum' ) . '" target="_blank" rel="noopener noreferrer" title="' . __( 'Forum', 'genesis-layout-extras' ) . '">' . __( 'Forum', 'genesis-layout-extras' ) . '</a></p>';

	$gle_help_sidebar .= '<p>' . __( 'Social:', 'genesis-layout-extras' ) . '<br /><a href="' . ddw_gle_get_info_url( 'url_twitter' ) . '" target="_blank" rel="noopener noreferrer" title="@ Twitter">' . __( 'Twitter', 'genesis-layout-extras' ) . '</a> | <a href="' . ddw_gle_get_info_url( 'url_fb_group' ) . '" target="_blank" rel="noopener noreferrer" title="@ Facebook">' . __( 'Facebook', 'genesis-layout-extras' ) . '</a> | <a href="' . ddw_gle_get_info_url( 'url_github_follow' ) . '" target="_blank" rel="noopener noreferrer" title="@ GitHub">' . __( 'Google+', 'genesis-layout-extras' ) . '</a> | <a href="' . ddw_gle_get_info_url( 'author_uri' ) . '" target="_blank" rel="noopener noreferrer" title="@ deckerweb.de">deckerweb</a></p>' .
		'<p><a href="' . ddw_gle_get_info_url( 'url_wporg_profile' ) . '" target="_blank" rel="noopener noreferrer" title="@ WordPress.org">@ WordPress.org</a></p>';

	return apply_filters(
		'gle_filter_help_sidebar_content',
		$gle_help_sidebar
	);

}  // end function


/**
 * Helper function for returning the Help Sidebar content - extra for plugin
 *   setting page.
 *
 * @since  2.0.0
 *
 * @uses   ddw_gle_get_info_url()
 *
 * @return string Extra HTML content for help sidebar.
 */
function ddw_gle_help_sidebar_content_extra() {

	$gle_help_sidebar_content_extra = '<p><strong>' . __( 'Actions', 'genesis-layout-extras' ) . '</strong></p>' .
		'<p>&rarr; <a href="' . ddw_gle_get_info_url( 'url_wporg_forum' ) . '" target="_blank" rel="noopener noreferrer">' . __( 'Support Forum', 'genesis-layout-extras' ) . '</a></p>' .
		'<p style="margin-top: -5px;">&rarr; <a href="' . ddw_gle_get_info_url( 'url_donate' ) . '" target="_blank" rel="noopener noreferrer">' . __( 'Donate', 'genesis-layout-extras' ) . '</a></p>';

	return apply_filters(
		'gle_filter_help_sidebar_content_extra',
		$gle_help_sidebar_content_extra
	);

}  // end function


/**
 * Helper function for echoing extra space as HTML string.
 *
 * @since 2.0.0
 *
 * @param $gle_space_helper
 */
function ddw_gle_space_helper() {

	$gle_space_helper = '<div style="height: 5px;"></div>';

	return $gle_space_helper;

}  // end function
