<?php

// includes/admin/views/gle-admin-help-studiopress

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Add optional help tab content for supported child themes by StudioPress.
 *
 * @since 1.6.0
 *
 * @uses  ddw_gle_help_content_sub_head()
 * @uses  post_type_exists()
 */
function ddw_gle_admin_help_studiopress() {

	ddw_gle_help_content_sub_head( __( 'Custom Post Types by Child Themes', 'genesis-layout-extras' ) . ' &mdash; ' . __( 'by StudioPress', 'genesis-layout-extras' ), 'dashicons-schedule' );
	
		/** Child Themes by StudioPress: Minimum 2.0 / Executive 2.0 */
		if ( post_type_exists( 'portfolio' )
			&& ( function_exists( 'minimum_portfolio_post_type' ) || function_exists( 'executive_portfolio_post_type' ) )
		) {

			if ( function_exists( 'minimum_portfolio_post_type' ) ) {
				$gle_sp_theme_check = 'Minimum 2.0';
			} elseif ( function_exists( 'executive_portfolio_post_type' ) ) {
				$gle_sp_theme_check = 'Executive 2.0';
			}

			echo '<p>' . sprintf(
					/* translators: %s - name of a child theme, "Minimum 2.0" OR "Executive 2.0" */
					__( 'Child Theme: %s by StudioPress', 'genesis-layout-extras' ),
					$gle_sp_theme_check
				) . '</p>' .
				'<ul>' .
					'<li>' . __( 'Portfolio Post Type Layout (archive)', 'genesis-layout-extras' ) . '</li>' .
				'</ul>';

		}  // end-if StudioPress check

}  // end function
