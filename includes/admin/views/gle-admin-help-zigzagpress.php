<?php

// includes/gle-admin-help-zigzagpress

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Add optional help tab content for supported child themes by ZigZagPress.
 *
 * @since 1.6.0
 *
 * @uses  post_type_exists()
 * @uses  CHILD_THEME_NAME
 */
function ddw_gle_admin_help_zigzagpress() {

	echo '<h3>' . __( 'Plugin: Genesis Layout Extras', 'genesis-layout-extras' ) . ' <small>v' . GLE_PLUGIN_VERSION . '</small></h3>';

		echo '<h4>' . __( 'Custom Post Types by Child Themes', 'genesis-layout-extras' ) . ' &mdash; ' . __( 'by StudioPress', 'genesis-layout-extras' ) . '</h4>';

		/** Child Themes by ZigZagPress: Bijou, Engrave, Eshop, Megalithe, Single, Solo, Tequila, Vanilla */
		if ( post_type_exists( 'portfolio' ) ) {

			if ( CHILD_THEME_NAME == 'Megalithe' ) {
				$gle_zzp_theme_check = 'Megalithe';
			} elseif ( CHILD_THEME_NAME == 'Engrave Theme' ) {
				$gle_zzp_theme_check = 'Engrave';
			} elseif ( CHILD_THEME_NAME == 'Vanilla' ) {
				$gle_zzp_theme_check = 'Vanilla';
			} elseif ( CHILD_THEME_NAME == 'Solo' ) {
				$gle_zzp_theme_check = 'Solo';
			} elseif ( CHILD_THEME_NAME == 'Bijou' ) {
				$gle_zzp_theme_check = 'Bijou';
			} elseif ( CHILD_THEME_NAME == 'Eshop' ) {
				$gle_zzp_theme_check = 'Eshop';
			} elseif ( CHILD_THEME_NAME == 'Single' ) {
				$gle_zzp_theme_check = 'Single';
			} elseif ( CHILD_THEME_NAME == 'Tequila' ) {
				$gle_zzp_theme_check = 'Tequila';
			} elseif ( CHILD_THEME_NAME == 'Prestige' ) {
				$gle_zzp_theme_check = 'Prestige';
			} elseif ( CHILD_THEME_NAME == 'Neo' ) {
				$gle_zzp_theme_check = 'Neo';
			}

			echo '<p>' . sprintf(
					/* translators: %s - name of a child theme from ZigZagPress brand */
					__( 'Child Theme: %s by ZigZagPress', 'genesis-layout-extras' ),
					$gle_zzp_theme_check
				) . '</p>' .
				'<ul>' .
					'<li>' . __( 'Portfolio Post Type Layout (archive)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Portfolio Categories Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
				'</ul>';

		}  // end-if ZigZagPress check

}  // end function
