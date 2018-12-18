<?php

// includes/gle-frontend

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Get all taxonomies covered by this plugin's settings, filterable.
 *
 * @since  2.1.0
 *
 * @return array Array of IDs of all covered taxonomies.
 */
function ddw_gle_get_covered_taxonomies() {

	return apply_filters(
		'gle_filter_covered_taxonomies',
		array(
			'features', 'status',							// CPT: Listing
			'portfolio-type',								// Plugin: GPP
			'book-authors', 'book-series', 'book-tags',		// Plugin: GAP
			'product_cat', 'product_tag',					// Plugins: Woo/Jigo
			'download_category', 'download_tag',			// Plugin: EDD
			'portfolio_category',							// CTs: ZigZag
			'product-category',	'galleries',				// CTs: Themedy
			'sc_event_category',							// Plugin: Sugar Calendar
			'slideshow', 'video-category', 'video-tag',		// Plugin: GMP
		)
	);

}  // end function


add_filter( 'genesis_pre_get_option_site_layout', 'ddw_genesis_layout_extras_filter', 101 );
/**
 * Manage Genesis layouts for extra sections
 *
 * @since  1.0.0
 * @since  2.1.0 Reorganizing and enhancing of if-statement.
 *
 * @uses   filter: genesis_pre_get_option_site_layout
 * @uses   genesis_get_option()
 * @uses   ddw_gle_get_covered_taxonomies()
 *
 * @global object $wp_query
 *
 * @param  string $gle_layout_option Holds the current Genesis layout option.
 * @return string $gle_layout_option Modified Genesis layout option.
 */
function ddw_genesis_layout_extras_filter( $gle_layout_option ) {

	global $wp_query;


	/**
	 * 1) WordPress Core default features:
	 * -------------------------------------------------------------------------
	 */

	/** Homepage / Front Page */
	if ( ( is_home() || is_front_page() )
		&& genesis_get_option( 'ddw_genesis_layout_home', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_home', GLE_SETTINGS_FIELD );

	}

	/** Search (has results!) */
	elseif ( ( is_search() && ! empty( $wp_query->posts ) )
		&& genesis_get_option( 'ddw_genesis_layout_search', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_search', GLE_SETTINGS_FIELD );

	}

	/** Search not found (no results!) */
	elseif ( ( is_search() && empty( $wp_query->posts ) )
		&& genesis_get_option( 'ddw_genesis_layout_search_not_found', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_search_not_found', GLE_SETTINGS_FIELD );

	}

	/** 404 Error */
	elseif ( is_404()
		&& genesis_get_option( 'ddw_genesis_layout_404', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_404', GLE_SETTINGS_FIELD );

	}

	/** Date (general) */
	elseif ( is_date()
		&& genesis_get_option( 'ddw_genesis_layout_date', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_date', GLE_SETTINGS_FIELD );

	}

	/** Date: year */
	elseif ( is_year()
		&& genesis_get_option( 'ddw_genesis_layout_date_year', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_date_year', GLE_SETTINGS_FIELD );

	}

	/** Date: month */
	elseif ( is_month()
		&& genesis_get_option( 'ddw_genesis_layout_date_month', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_date_month', GLE_SETTINGS_FIELD );

		/** Date: day */
	} elseif ( is_day()
		&& genesis_get_option( 'ddw_genesis_layout_date_day', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_date_day', GLE_SETTINGS_FIELD );

		/** Author */
	} elseif ( is_author()
		&& genesis_get_option( 'ddw_genesis_layout_author', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_author', GLE_SETTINGS_FIELD );

		/** Category (all!) */
	} elseif ( is_category()
		&& genesis_get_option( 'ddw_genesis_layout_category', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_category', GLE_SETTINGS_FIELD );

		/** Tag (all!) */
	} elseif ( is_tag()
		&& genesis_get_option( 'ddw_genesis_layout_tag', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_tag', GLE_SETTINGS_FIELD );

	}

	/** Posts (all!) */
	elseif ( is_singular( 'post' )
		&& genesis_get_option( 'ddw_genesis_layout_post', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_post', GLE_SETTINGS_FIELD );

	}

	/** Pages (all!) */
	elseif ( is_singular( 'page' )
		&& genesis_get_option( 'ddw_genesis_layout_page', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_page', GLE_SETTINGS_FIELD );

	}

	/** Attachment (all!) */
	elseif ( is_attachment()
		&& genesis_get_option( 'ddw_genesis_layout_attachment', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_attachment', GLE_SETTINGS_FIELD );

	}



	/**
	 * 2) ALL CUSTOM taxonomies at once, except the ones we have settings for!!
	 * -------------------------------------------------------------------------
	 */

		/**
		 * Taxonomy (all, general)
		 * Exceptions, because extra setup via extra settings:
		 *    features, slideshow, video-category, video-tag, product_cat,
		 *    product_tag, product-category, download_category, download_tag,
		 *    galleries
		 */
	elseif ( is_tax()
		&& ! ( is_tax( ddw_gle_get_covered_taxonomies() ) )
		&& genesis_get_option( 'ddw_genesis_layout_taxonomy', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_taxonomy', GLE_SETTINGS_FIELD );

	}



	/**
	 * 3) Plugin: AgentPress Listings
	 * -------------------------------------------------------------------------
	 */

	/** CPT: "Listing" (by APL plugin) */
	elseif ( is_post_type_archive( 'listing' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_apl_listing', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_apl_listing', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Listing" - Tax: "Features" (by APL plugin) */
	elseif ( is_tax( 'features' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_apl_features', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_apl_features', GLE_SETTINGS_FIELD );

	}



	/**
	 * 4) Plugin: Simple Listings for Genesis
	 * -------------------------------------------------------------------------
	 */

	/** CPT: "Listing" (by SLfG plugin) */
	elseif ( is_post_type_archive( 'listing' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_slfg_listing', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_slfg_listing', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Listing" - Tax: "Status" (by SLfG plugin) */
	elseif ( is_tax( 'status' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_slfg_listing_status', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_slfg_listing_status', GLE_SETTINGS_FIELD );

	}



	/**
	 * 5) Plugin: Genesis Media Project
	 * -------------------------------------------------------------------------
	 */

	/** CPT: "Video" (by GMP plugin) */
	elseif ( is_post_type_archive( 'video' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_gmp_video', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_gmp_video', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Video" - Tax: "SlideShow" (by GMP plugin) */
	elseif ( is_tax( 'slideshow' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_gmp_slideshow', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_gmp_slideshow', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Video" - Tax: "Video Category" (by GMP plugin) */
	elseif ( is_tax( 'video-category' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_gmp_video_category', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_gmp_video_category', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Video" - Tax: "Video Tag" (by GMP plugin) */
	elseif ( is_tax( 'video-tag' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_gmp_video_tag', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_gmp_video_tag', GLE_SETTINGS_FIELD );

	}



	/**
	 * 6) Shop Plugins: WooCommerce AND Jigoshop
	 * -------------------------------------------------------------------------
	 */

	/** CPT: "Product" (by WooCommerce & Jigoshop plugins) */
	elseif ( is_tax( 'product_cat' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_wcjs_product_cat', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_wcjs_product_cat', GLE_SETTINGS_FIELD );

	}

	/** */
	elseif ( is_tax( 'product_tag' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_wcjs_product_tag', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_wcjs_product_tag', GLE_SETTINGS_FIELD );

	}



	/**
	 * 7) Plugin: Easy Digital Downloads
	 * -------------------------------------------------------------------------
	 */

	/** CPT: "Download" (by Easy Digital Downloads plugin) */
	elseif ( is_post_type_archive( 'download' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_edd_download', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_edd_download', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Download" - Tax: "Download Category" (by Easy Digital Downloads plugin) */
	elseif ( is_tax( 'download_category' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_edd_download_category', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_edd_download_category', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Download" - Tax: "Download Tag" (by Easy Digital Downloads plugin) */
	elseif ( is_tax( 'download_tag' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_edd_download_tag', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_edd_download_tag', GLE_SETTINGS_FIELD );

	}



	/**
	 * 8) Plugin: Genesis Author Pro
	 * -------------------------------------------------------------------------
	 */

	/** CPT: "Book" (by Genesis Author Pro plugin) */
	elseif ( is_post_type_archive( 'book' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_gap_book', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_gap_book', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Book" - Tax: "Book-Authors" (by Genesis Author Pro plugin) */
	elseif ( is_tax( 'book-authors' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_gap_book_authors', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_gap_book_authors', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Book" - Tax: "Book-Series" (by Genesis Author Pro plugin) */
	elseif ( is_tax( 'book-series' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_gap_book_series', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_gap_book_series', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Book" - Tax: "Book-Tags" (by Genesis Author Pro plugin) */
	elseif ( is_tax( 'book-tags' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_gap_book_tags', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_gap_book_tags', GLE_SETTINGS_FIELD );

	}



	/**
	 * 9) Plugin: Sugar Events Calendar
	 * -------------------------------------------------------------------------
	 */

	/** CPT: "SC_Event" (by Sugar Events Calendar plugin) */
	elseif ( is_post_type_archive( 'sc_event' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_sc_event', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_sc_event', GLE_SETTINGS_FIELD );

	}

	/** CPT: "SC_Event" - Tax: "Event Category" (by Sugar Events Calendar plugin) */
	elseif ( is_tax( 'sc_event_category' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_sc_event_category', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_sc_event_category', GLE_SETTINGS_FIELD );

	}



	/**
	 * 10) CPT: Portfolio ('portfolio') - by various Child Themes
	 * -------------------------------------------------------------------------
	 */

	/** CPT: "Portfolio" (by various child themes) */
	elseif ( is_post_type_archive( 'portfolio' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_child_portfolio', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_child_portfolio', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Portfolio" - Tax: "Portfolio Category" (by various child themes) */
	elseif ( is_tax( 'portfolio_category' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_child_portfolio_category', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_child_portfolio_category', GLE_SETTINGS_FIELD );

	}



	/**
	 * 11) Plugin: Genesis Portfolio Pro
	 * -------------------------------------------------------------------------
	 */

	/** CPT: "Portfolio" (by GPP plugin) */
	elseif ( is_post_type_archive( 'portfolio' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_gpp_portfolio', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_gpp_portfolio', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Portfolio" - Tax: "Portfolio Type" (by Genesis Portfolio Pro plugin) */
	elseif ( is_tax( 'portfolio-type' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_gpp_portfolio_type', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_gpp_portfolio_type', GLE_SETTINGS_FIELD );

	}



	/**
	 * 12) CPT/ Tax: various Themedy Child Themes
	 * -------------------------------------------------------------------------
	 */

	/** CPT: "Products" (by Themedy Child Themes) */
	elseif ( is_post_type_archive( 'products' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_themedy_products', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_themedy_products', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Products" - Tax: "Product Category" (by Themedy Child Themes) */
	elseif ( is_tax( 'product-category' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_themedy_product_category', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_themedy_product_category', GLE_SETTINGS_FIELD );

	}

	/** CPT: "Photo" - Tax: "Photo Gallery" (by Themedy Child Themes) */
	elseif ( is_tax( 'galleries' )
		&& genesis_get_option( 'ddw_genesis_layout_cpt_themedy_photo_gallery', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_cpt_themedy_photo_gallery', GLE_SETTINGS_FIELD );

	}  // end if/elseif


	/** Finally, output the layout(s) */
	return $gle_layout_option;

}  // end function


add_filter( 'bbp_genesis_force_full_content_width', 'ddw_genesis_layout_extras_bbpress_filter', 101 );
add_filter( 'bbp_genesis_layout', 'ddw_genesis_layout_extras_bbpress_filter' );
/**
 * Manage Genesis layouts for bbPress 2.x Forum section.
 *
 * @since  1.0.0
 *
 * @uses   filter: bbp_genesis_force_full_content_width
 * @uses   filter: bbp_genesis_layout
 * @uses   is_bbpress()
 * @uses   genesis_get_option()
 *
 * @param  string 	$gle_layout_option
 *
 * @return string Genesis layout option.
 */
function ddw_genesis_layout_extras_bbpress_filter( $gle_layout_option ) {

	/** CPT: all bbPress 2.x post types */
	if ( is_bbpress()
		&& genesis_get_option( 'ddw_genesis_layout_bbpress', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_bbpress', GLE_SETTINGS_FIELD );

	}  // end if bbPress & option check

	/** Output bbPress Forums layout */
	return $gle_layout_option;

}  // end function


add_filter( 'bbp_genesis_force_full_content_width', 'ddw_genesis_layout_extras_bbpress_topics_filter', 101 );
add_filter( 'bbp_genesis_layout', 'ddw_genesis_layout_extras_bbpress_topics_filter' );
/**
 * Manage Genesis layouts for bbPress 2.x forum Topics.
 *
 * @since  1.7.0
 *
 * @uses   filter: bbp_genesis_force_full_content_width
 * @uses   filter: bbp_genesis_layout
 * @uses   get_post_type()
 * @uses   is_bbpress()
 * @uses   genesis_get_option()
 *
 * @param  string 	$gle_layout_option
 *
 * @return string Genesis layout option.
 */
function ddw_genesis_layout_extras_bbpress_topics_filter() {

	$gle_layout_option = 'default';

	/** CPT: all bbPress 2.x post types */
	if ( ( 'topic' == get_post_type() && is_bbpress() )
		&& genesis_get_option( 'ddw_genesis_layout_bbpress_topics', GLE_SETTINGS_FIELD )
	) {

		$gle_layout_option = genesis_get_option( 'ddw_genesis_layout_bbpress_topics', GLE_SETTINGS_FIELD );

	}  // end-if bbPress & topics plus option check

	/** Output bbPress topics layout */
	return $gle_layout_option;

}  // end function


add_action( 'wp_enqueue_scripts', 'ddw_gle_register_frontend_styles', 11 );
/**
 * Register our additional frontend helper styles.
 *
 * @since 2.0.0
 *
 * @uses  genesis_html5()
 * @uses  wp_register_style()
 *
 * @param string 	$gle_genesis_html
 * @param array  	$gle_layout_options
 * @param array 	$gle_layouts
 * @param string 	$gle_layout_arg
 */
function ddw_gle_register_frontend_styles() {

	/** Check for Genesis HTML5 */
	$gle_genesis_html = ( function_exists( 'genesis_html5' ) && genesis_html5() ) ? 'html5-' : '';

	$gle_layout_options = '';

	/** Setup defaults parameters */
	$gle_layouts = array(
		'sidebars-below-content'    => 'sbc',
		'primary-sidebar'           => 'prims',
		'headernav-content-sidebar' => 'hncs',
		'2-columns'                 => '2col',
		'3-column'                  => '3col',
	);

	$gle_layout_options = wp_parse_args( (array) $gle_layout_options, $gle_layouts );

	foreach ( $gle_layout_options as $gle_layout_arg ) {

		wp_register_style(
			'gle-layout-' . $gle_layout_arg,
			plugins_url(
				'assets/css/gle-layout-' . $gle_layout_arg . '-' . $gle_genesis_html . 'styles' . GLE_SCRIPT_SUFFIX . '.css',
				dirname( dirname( __FILE__ ) )
			),
			FALSE,
			( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) || ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ) ? time() : filemtime( plugin_dir_path( __FILE__ ) ),
			'all'
		);

	}  // end foreach

}  // end function


add_action( 'genesis_meta', 'ddw_gle_do_additional_layouts' );
/**
 * @since 2.0.0
 *
 * @uses  genesis_site_layout()
 *
 * @param string 	$gle_site_layout
 */
function ddw_gle_do_additional_layouts() {

	/** Get registered layouts */
	$gle_site_layout = genesis_site_layout();


	/** 1) Drop Primary Sidebar if our Sidebar-Alt layouts are active */
	if ( 'content-sidebaralt' == $gle_site_layout || 'sidebaralt-content' == $gle_site_layout ) {

		remove_action( 'genesis_after_content', 'genesis_get_sidebar' );

	}  // end-if layout check


	/** 2) For Sidebars below Content tweak sidebar positions */
	if ( 'sidebars-below-content' == $gle_site_layout ) {

		remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
		remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );

		add_action( 'genesis_after_content_sidebar_wrap', 'ddw_gle_do_layout_sidebars_below_content' );

	}  // end-if layout check


	/** 3) Alternate 3-column layout versions */
	if ( in_array( $gle_site_layout, array( 'content-sidebaralt-sidebar', 'sidebar-sidebaralt-content', 'sidebar-content-sidebaralt' ) ) ) {

		/** First, remove Genesis core hooks */
		remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
		remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );

		/** Second, add reversed sidebars back */
		add_action( 'genesis_after_content', 'ddw_gle_do_reversed_sidebar_alt' );
		add_action( 'genesis_after_content_sidebar_wrap', 'ddw_gle_do_reversed_sidebar' );

	}  // end-if layout check


	/** 4) For Primary below Content tweak sidebar positions */
	if ( 'primary-below-content' == $gle_site_layout ) {

		remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );

	}  // end-if layout check


	/** 5) For Primary above Content tweak sidebar positions */
	if ( 'primary-above-content' == $gle_site_layout ) {

		/** First, remove Genesis core hooks */
		remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
		remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );

		/** Second, add primary one back */
		add_action( 'genesis_before_content', 'genesis_get_sidebar' );

	}  // end-if layout check


	/** 6) For 'Header+Nav/Content/Sidebar' tweak stuff */
	if ( 'headernav-content-sidebar' == $gle_site_layout ) {

		/** First, remove Genesis core hooks */
		remove_action( 'genesis_after_header', 'genesis_do_nav' );
		remove_action( 'genesis_after_header', 'genesis_do_subnav' );
		remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
		remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
		remove_action( 'genesis_footer', 'genesis_do_footer' );
		remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

		/** Second, add our tweaks */
		//add_action( 'genesis_header', 'genesis_do_nav', 11 );
		//add_action( 'genesis_header', 'genesis_do_subnav', 11 );
		add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_nav', 11 );
		add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_subnav', 11 );
		add_action( 'genesis_header', 'genesis_footer_markup_open', 12 );
		add_action( 'genesis_header', 'genesis_do_footer', 13 );
		add_action( 'genesis_header', 'genesis_footer_markup_close', 14 );

	}  // end-if layout check

}  // end function


/**
 * Setup structure for layout "Sidebars below Content".
 *    Primary gets loaded before Secondary but Secondary is displayed on the
 *    left, and Primary on the right.
 *
 * @since 2.0.0
 *
 * @uses  get_sidebar()
 */
function ddw_gle_do_layout_sidebars_below_content() {
	
	echo '<div class="gle-sidebars-below-content">';

		echo '<div class="one-half second gle-columns">';
			
			get_sidebar();

		echo '</div>';

		echo '<div class="one-half first gle-columns">';

			get_sidebar( 'alt' );

		echo '</div>';

	echo '</div><div class="clear"></div>';

}  // end function


/**
 * Output the "Primary Sidebar" on our changed location.
 *
 * @since 2.0.0
 *
 * @uses  get_sidebar()
 */
function ddw_gle_do_reversed_sidebar_alt() {

	get_sidebar( 'alt' );

}  // end function


/**
 * Output the "Secondary Sidebar" (Sidebar-Alt) on our changed location.
 *
 * @since 2.0.0
 *
 * @uses  get_sidebar()
 */
function ddw_gle_do_reversed_sidebar() {

	get_sidebar();

}  // end function


add_action( 'wp_enqueue_scripts', 'ddw_gle_layouts_frontend_styles', 15 );
/**
 * Load our additional frontend helper styles if alternate layouts are used.
 *
 * @since 2.0.0
 *
 * @uses  genesis_site_layout()
 * @uses  genesis_get_option()
 * @uses  wp_enqueue_style()
 *
 * @param string 	$gle_site_layout
 */
function ddw_gle_layouts_frontend_styles() {

	/** Bail early if Genesis is not present, i.e. if Jetpack Mobile Theme is active */
	if ( ! function_exists( 'genesis_site_layout' ) ) {
		return;
	}

	/** Get registered layouts */
	$gle_site_layout = genesis_site_layout();

	/** Enqueue style based on current layout */
	if ( 'sidebars-below-content' == $gle_site_layout
		&& genesis_get_option( 'gle_layout_styles_sbc', GLE_SETTINGS_FIELD )
	) {

		wp_enqueue_style( 'gle-layout-sbc' );

	}

	elseif ( ( 'content-sidebaralt' == $gle_site_layout || 'sidebaralt-content' == $gle_site_layout )
				&& genesis_get_option( 'gle_layout_styles_2col', GLE_SETTINGS_FIELD )
	) {

		wp_enqueue_style( 'gle-layout-2col' );

	}

	elseif ( ( 'content-sidebaralt-sidebar' == $gle_site_layout
					|| 'sidebar-sidebaralt-content' == $gle_site_layout
					|| 'sidebar-content-sidebaralt' == $gle_site_layout
				) && genesis_get_option( 'gle_layout_styles_3col', GLE_SETTINGS_FIELD )
	) {

		wp_enqueue_style( 'gle-layout-3col' );

	}

	elseif ( ( 'primary-below-content' == $gle_site_layout || 'primary-above-content' == $gle_site_layout )
				&& genesis_get_option( 'gle_layout_styles_prims', GLE_SETTINGS_FIELD )
	) {

		wp_enqueue_style( 'gle-layout-prims' );

	}

	elseif ( ( 'headernav-content-sidebar' == $gle_site_layout )
				&& genesis_get_option( 'gle_layout_styles_hncs', GLE_SETTINGS_FIELD )
	) {

		wp_enqueue_style( 'gle-layout-hncs' );

	}  // end if layout check

}  // end function
