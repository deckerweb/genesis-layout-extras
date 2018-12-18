<?php

// includes/gle-admin-help-plugins

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Add optional help tab content for supported plugins.
 *
 * @since 1.3.0
 * @since 2.1.0 Tweaks and enhancements.
 *
 * @uses  ddw_gle_help_content_sub_head()
 */
function ddw_gle_admin_help_plugins() {

	ddw_gle_help_content_sub_head( __( 'Custom Post Types by Plugins', 'genesis-layout-extras' ) );

		$string_listing = __( 'Listing Post Type Layout (archive)', 'genesis-layout-extras' );

		/** CPT: Listings ('listing') */
		if ( post_type_exists( 'listing' ) ) {

			/** Plugin: AgentPress Listings */
			if ( ddw_gle_is_agentpress_listings_active() ) {

				echo '<h4>AgentPress Listings</h4>' .
					'<ul>' .
						'<li>' . $string_listing . '</li>' .
						'<li>' . __( 'Listings Features Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
					'</ul>';

			}  // end if

			/** Plugin: Simple Listings for Genesis */
			if ( ddw_gle_is_simple_listings_genesis_active() ) {

				echo '<h4>Simple Listings for Genesis</h4>' .
					'<ul>' .
						'<li>' . $string_listing . '</li>' .
						'<li>' . __( 'Listings Status Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
					'</ul>';

			}  // end if

		}  // end if CPT "listing" check


		/** Plugin: Genesis Portfolio Pro */
		if ( post_type_exists( 'portfolio' ) && ddw_gle_is_genesis_portfolio_pro_active() ) {

			echo '<h4>Genesis Portfolio Pro</h4>' .
				'<ul>' .
					'<li>' . __( 'Portfolio Post Type Layout (archive)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Portfolio Type Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
				'</ul>';

		}  // end if GPP check


		/** Plugin: Genesis Author Pro */
		if ( post_type_exists( 'book' ) && ddw_gle_is_genesis_author_pro_active() ) {

			echo '<h4>Genesis Author Pro</h4>' .
				'<ul>' .
					'<li>' . __( 'Book Post Type Layout (archive)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Book Authors Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Book Series Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Book Tags Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
				'</ul>';

		}  // end if GAP check


		/** Plugins: WooCommerce or Jigoshop */
		if ( post_type_exists( 'product' )
			&& ( ddw_gle_is_woocommerce_active() || ddw_gle_is_jigoshop_active() )
		) {

			echo '<h4>' . __( 'WooCommerce OR Jigoshop', 'genesis-layout-extras' ) . '</h4>' .
				'<ul>' .
					'<li>' . __( 'Product Post Type Layout - Product Categories (all)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Product Post Type Layout - Product Tags (all)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . sprintf(
						/* translators: %s - name of a plugin, "WooCommerce" */
						__( '%s Genesis Integration Plugin', 'genesis-layout-extras' ),
						'<em>WooCommerce</em>'
					) . ': <a href="https://wordpress.org/plugins/genesis-connect-woocommerce/" target="_blank" rel="noopener noreferrer">Genesis Connect for WooCommerce</a> <small><em>(' . __( 'required', 'genesis-layout-extras' ) . ')</em></small></li>' .
					'<li>' . sprintf(
						/* translators: %s - name of a plugin, "Jigoshop" */
						__( '%s Genesis Integration Plugin', 'genesis-layout-extras' ),
						'<em>Jigoshop</em>'
					) . ': <a href="https://jigoshop.com/product/genesis-connect-for-jigoshop/" target="_blank" rel="noopener noreferrer">Genesis Connect for Jigoshop</a> <small><em>(' . __( 'required', 'genesis-layout-extras' ) . ')</em></small></li>' .
				'</ul>';

		}  // end if CPT "product" check


		/** Plugin: Easy Digital Downloads */
		if ( post_type_exists( 'download' ) && ddw_gle_is_edd_active() ) {

			echo '<h4>' . __( 'Easy Digital Downloads', 'genesis-layout-extras' ) . '</h4>' .
				'<ul>' .
					'<li>' . __( 'Download Post Type Layout (archive)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Download Categories Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Download Tags Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . sprintf(
						/* translators: %s - name of a plugin, "Easy Digital Downloads" */
						__( '%s Genesis Integration Plugin', 'genesis-layout-extras' ),
						'<em>Easy Digital Downloads</em>'
					) . ': <a href="https://wordpress.org/plugins/genesis-connect-edd/" target="_blank" rel="noopener noreferrer">Genesis Connect for Easy Digital Downloads</a> <small><em>(' . __( 'recommended', 'genesis-layout-extras' ) . ')</em></small></li>' .
				'</ul>';

		}  // end if EDD check


		/** Plugin: Sugar Events Calendar */
		if ( post_type_exists( 'sc_event' ) && ddw_gle_is_sugar_calendar_active() ) {

			echo '<h4>' . __( 'Sugar Events Calendar', 'genesis-layout-extras' ) . '</h4>' .
				'<ul>' .
					'<li>' . __( 'Event Post Type Layout (archive)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Event Categories Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
				'</ul>';

		}  // end if Sugar Events check


		/** Plugin: bbPress 2.x Forum */
		if ( ddw_gle_is_bbpress_active() ) {

			echo '<h4>' . __( 'bbPress 2.x', 'genesis-layout-extras' ) . '</h4>' .
				'<ul>' .
					'<li>' . __( 'bbPress 2.x Forum Layout (all areas)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Including extra setting for singular topics view', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . sprintf(
						/* translators: %s - name of a plugin, "bbPress" */
						__( '%s Genesis Integration Plugin', 'genesis-layout-extras' ),
						'<em>bbPress</em>'
					) . ': <a href="https://wordpress.org/plugins/bbpress-genesis-extend/" target="_blank" rel="noopener noreferrer">bbPress Genesis Extend</a> <small><em>(' . __( 'required', 'genesis-layout-extras' ) . ')</em></small></li>' .
				'</ul>';

		}  // end if bbPress 2.x check


		/** Plugin: Genesis Media Project */
		if ( post_type_exists( 'video' ) && ddw_gle_is_genesis_media_project_active() ) {

			echo '<h4>' . __( 'Genesis Media Project', 'genesis-layout-extras' ) . '</h4>' .
				'<ul>' .
					'<li>' . __( 'Video Post Type Layout (archive)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Video SlideShows Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Video Categories Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Video Tags Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
				'</ul>';

		}  // end if GMP check

}  // end function
