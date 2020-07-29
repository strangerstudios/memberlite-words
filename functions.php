<?php
/**
 * Memberlite [Words] Child Theme functions and definitions
 *
 * @package Memberlite Words
 */
 
// Define constants
define( 'MEMBERLITE_WORDS_DIR', get_stylesheet_directory() );

// Enqueue scripts and styles.
function memberlite_words_enqueue_styles() {
    wp_enqueue_style( 'memberlite', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'memberlite_words_enqueue_styles' );

/**
 * Remove unused parent theme items.
 */
function memberlite_words_setup() {

	// Add logo upload support via Customizer
	add_theme_support( 'custom-logo', array(
	   'height'      => 200,
	   'width'       => 200,
	   'flex-height' => true,
	   'flex-width'	 => true,
	   'header-text' => array( 'site-title', 'site-description' ),
	) );

	remove_image_size( 'memberlite-banner' );
	remove_image_size( 'memberlite-fullwidth' );
	remove_image_size( 'memberlite-masthead' );

	// Remove theme support for post formats.
	remove_theme_support( 'post-formats' );

	remove_theme_support( 'custom-header' );

	// Remove support for a custom body background.
	remove_theme_support( 'custom-background' );

	// Unregister unused theme menu locations.
	unregister_nav_menu( 'meta' );

}
add_action( 'after_setup_theme', 'memberlite_words_setup', 20 );

/**
 * Remove unused parent theme widget areas.
 */
function memberlite_words_widgets_init() {
	unregister_sidebar( 'sidebar-1' ); // Pages
	unregister_sidebar( 'sidebar-2' ); // Posts and Archives
	unregister_sidebar( 'sidebar-3' ); // Header Right
}
add_action( 'widgets_init', 'memberlite_words_widgets_init', 20 );

/**
 * Filter the theme page templates.
 *
 * @param array    $page_templates Page templates.
 * @param WP_Theme $theme_instance           WP_Theme instance.
 * @param WP_Post  $post           The post being edited, provided for context, or null.
 * @return array (Maybe) modified page templates array.
 */
function memberlite_words_filter_theme_page_templates( $page_templates, $theme_instance, $post ) {

	unset( $page_templates['templates/blank.php'] );
	unset( $page_templates['templates/content-sidebar.php'] );
	unset( $page_templates['templates/fluid-width.php'] );
	unset( $page_templates['templates/full-width.php'] );
	unset( $page_templates['templates/interstitial.php'] );
	unset( $page_templates['templates/landing.php'] );
	unset( $page_templates['templates/narrow-width.php'] );
	unset( $page_templates['templates/sidebar-content.php'] );
    return $page_templates;

}
add_filter( 'theme_page_templates', 'memberlite_words_filter_theme_page_templates', 20, 3 );

/**
 * Remove unused parent theme customizer options.
 */
function memberlite_words_customize_register() {  

	global $wp_customize;

	$customizer_settings = apply_filters( 'memberlite_words_remove_customizer_settings', array(
		'nav_menu_search',
		'sticky_nav',
		'columns_ratio_header',
		'columns_ratio',
		'sidebar_location',
		'sidebar_location_blog',
		'posts_entry_meta_after',
		'page_breadcrumbs',
		'post_breadcrumbs',
		'archive_breadcrumbs',
		'attachment_breadcrumbs',
		'search_breadcrumbs',
		'profile_breadcrumbs',
		'delimiter',
		'memberlite_loop_images',
	) );

	foreach( $customizer_settings as $setting ) {
		$wp_customize->remove_control( $setting );
		$wp_customize->remove_setting( $setting );
	}

} 
add_action( 'customize_register', 'memberlite_words_customize_register', 99 );

function memberlite_words_memberlite_defaults( $memberlite_defaults ) {
	$memberlite_defaults['memberlite_webfonts'] = 'Georgia_Georgia';
	$memberlite_defaults['posts_entry_meta_before'] = '{post_categories} {post_comments} {post_date}';
	$memberlite_defaults['copyright_textbox'] = '<a href="http://wordpress.org/" rel="license">' . __( 'Proudly powered by WordPress', 'memberlite' ) . '</a><span class="sep"> | </span><a href="https://memberlitetheme.com/child-themes/words/" rel="license">' . __( 'Theme: Memberlite Words', 'memberlite' ) . '</a>';

	$memberlite_defaults['color_primary_background_elements'] = '#mobile-navigation, #mobile-navigation-height-col, .btn_primary, .btn_primary:link, .menu-toggle, .bg_primary, .banner_primary, .has-background.has-color-primary-background-color';
	$memberlite_defaults['color_secondary_background_elements'] = '.btn_secondary, .btn_secondary:link, .memberlite_tabbable ul.memberlite_tabs li.memberlite_active a, .memberlite_tabbable ul.memberlite_tabs li.memberlite_active a:hover, .banner_secondary, #banner_bottom, .has-background.has-color-secondary-background-color';

/*	 array(
		'memberlite_webfonts'                       => 'Lato_Lato',
		'columns_ratio'                             => '8-4',
		'columns_ratio_header'                      => '4-8',
		'sidebar_location'                          => 'sidebar-right',
		'sidebar_location_blog'                     => 'sidebar-blog-right',
		'content_archives'                          => 'content',
		'memberlite_loop_images'                    => 'show_none',
		'posts_entry_meta_before'                   => __( 'Posted on {post_date} by {post_author_posts_link}', 'memberlite' ),
		'posts_entry_meta_after'                    => __( 'This entry was posted in {post_categories} and tagged {post_tags}. Bookmark the {post_permalink}.', 'memberlite' ),
		'memberlite_footerwidgets'                  => '4',
		'copyright_textbox'                         => '<a href="http://wordpress.org/" rel="license">' . __( 'Proudly powered by WordPress', 'memberlite' ) . '</a><span class="sep"> | </span><a href="http://memberlitetheme.com" rel="license">' . __( 'Theme: Memberlite by Kim Coleman', 'memberlite' ) . '</a>',
		'memberlite_back_to_top'                    => true,
		'memberlite_color_scheme'                   => 'Default',
		'memberlite_darkcss'                        => false,
		'bgcolor_header'							=> '',
		'bgcolor_site_navigation'                   => '#FAFAFA',
		'color_site_navigation'                     => '#777777',
		'color_link'                                => '#2C3E50',
		'color_meta_link'                           => '#2C3E50',
		'color_primary'                             => '#2C3E50',
		'color_secondary'                           => '#18BC9C',
		'color_action'                              => '#F39C12',
		'bgcolor_header_elements'		  			=> '#masthead',
		'bgcolor_site_navigation_elements'          => '#site-navigation, .main-navigation ul.sub-menu',
		'color_site_navigation_elements'            => '.main-navigation a',
		'color_site_navigation_hover_elements'      => '.main-navigation li:hover, .main-navigation li:hover > a',
		'color_link_color_elements'                 => '.content-area a, .footer-navigation a, .site-info a',
		'color_link_hover_elements'                 => '.content-area a:hover, .footer-navigation a:hover, .site-info a:hover',
		'color_meta_link_color_elements'            => '.header-right .menu a',
		'color_primary_background_elements'         => '#mobile-navigation, #mobile-navigation-height-col, .masthead, .footer-widgets, .btn_primary, .btn_primary:link, .menu-toggle, .bg_primary, .banner_primary, .has-background.has-color-primary-background-color',
		'color_primary_background_hover_elements'   => '.btn_primary:hover',
		'color_primary_color_elements'              => '#meta-navigation ul ul a, #pmpro_levels .post h2, .memberlite_signup h2, .pmpro_signup_form h2, .primary, .has-text-color.has-color-primary-color',
		'color_primary_color_hover_elements'        => '#meta-navigation ul ul a:hover',
		'color_secondary_background_elements'       => '#meta-member .meta-member-inner, #meta-member .member-navigation .sub-menu, .btn_secondary, .btn_secondary:link, .memberlite_tabbable ul.memberlite_tabs li.memberlite_active a, .memberlite_tabbable ul.memberlite_tabs li.memberlite_active a:hover, .banner_secondary, #banner_bottom, .has-background.has-color-secondary-background-color',
		'color_secondary_background_hover_elements' => '.btn_secondary:hover',
		'color_secondary_border_elements'           => '#pmpro_levels .pmpro_level-highlight, #pmpro_levels.pmpro_levels-2col .pmpro_level-highlight, #pmpro_levels.pmpro_levels-3col .pmpro_level-highlight, #pmpro_levels.pmpro_levels-4col .pmpro_level-highlight, #pmpro_levels.pmpro_levels-div .pmpro_level-highlight, #pmpro_levels.pmpro_advanced_levels-compare_table thead tr:first-child th.pmpro_level-highlight, #pmpro_levels.pmpro_advanced_levels-compare_table tfoot tr:last-child td.pmpro_level-highlight, .memberlite_signup, .pmpro_signup_form, .memberlite_tabbable ul.memberlite_tabs li.memberlite_active a, .memberlite_tabbable .memberlite_tab_content',
		'color_secondary_border_left_elements'      => '#pmpro_levels.pmpro_advanced_levels-compare_table thead th.pmpro_level-highlight, #pmpro_levels.pmpro_advanced_levels-compare_table tbody td.pmpro_level-highlight, #pmpro_levels.pmpro_advanced_levels-compare_table tfoot td.pmpro_level-highlight, #pmpro_levels.pmpro_levels-table .pmpro_level-highlight td:first-child, .memberlite_tabbable ul.memberlite_tabs li.memberlite_active a',
		'color_secondary_border_right_elements'     => '#pmpro_levels.pmpro_advanced_levels-compare_table thead th.pmpro_level-highlight, #pmpro_levels.pmpro_advanced_levels-compare_table tbody td.pmpro_level-highlight, #pmpro_levels.pmpro_advanced_levels-compare_table tfoot td.pmpro_level-highlight, #pmpro_levels.pmpro_levels-table .pmpro_level-highlight td:last-child, .memberlite_tabbable ul.memberlite_tabs li.memberlite_active a',
		'color_secondary_color_elements'            => 'blockquote.quote:before, q:before, .testimonials-widget-testimonial .open-quote::before, .testimonials-widget-testimonial .close-quote::after, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price, .secondary, .has-text-color.has-color-secondary-color',
		'color_action_background_elements'          => '.btn_action, .btn_action:link, .pmpro_content_message a, .pmpro_content_message a:link, .pmpro_content_message a:visited, .pmpro_btn, .pmpro_btn:link, .pmpro_btn:visited, a.pmpro_btn, a.pmpro_btn:link, a.pmpro_btn:visited, input[type=button].pmpro_btn, input[type=submit].pmpro_btn, #loginform input[type=submit].button.button-primary, .woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .bg_action, .banner_action, .has-background.has-color-action-background-color',
		'color_action_background_hover_elements'    => '.btn_action:hover, .pmpro_content_message a:hover, .pmpro_btn:hover, a.pmpro_btn:hover, input[type=button].pmpro_btn:hover, input[type=submit].pmpro_btn:hover, .woocommerce #content input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover',
		'color_action_color_elements'               => '.action, .has-text-color.has-color-action-color',
		'delimiter'                                 => '&nbsp;&#47;&nbsp;',
		'memberlite_darkcss'                        => false,
	*/
	return $memberlite_defaults;
}
add_filter( 'memberlite_defaults', 'memberlite_words_memberlite_defaults' );

/**
 * Filter the columns ratio to always be narrow width.
 *
 * @param string  $r The return value for the column CSS selectors.
 * @param string  $location Where in the theme this CSS is used.
 * @return strong The column CSS selectors to output.
 */
function memberlite_words_columns_ratio( $r, $location ) {
	global $memberlite_defaults;

	if ( ! empty( $location ) ) {
		return $r;
	}

	$r = '10 medium-offset-1 large-8 large-offset-2 small-12';

	return $r;
}
add_filter( 'memberlite_columns_ratio', 'memberlite_words_columns_ratio', 10, 2 );

/**
 * Filter to display site adminstration email Gravatar as logo if the_custom_logo is not set.
 *
 */
function memberlite_words_get_custom_logo( $html, $blog_id ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( ! empty( $custom_logo_id ) ) {
		return $html;
	} else {
		$html = sprintf(
			'<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>',
			esc_url( home_url( '/' ) ),
			get_avatar( get_option( 'admin_email' ), 200, false, get_bloginfo( 'name' ) )
		);
	}
	return $html;
}
add_filter( 'get_custom_logo', 'memberlite_words_get_custom_logo', 10, 2 );

function memberlite_words_memberlite_show_header_right( $show_header_right ) {
	return false;
}
add_filter( 'memberlite_show_header_right', 'memberlite_words_memberlite_show_header_right', 20 );

/*
	Filter to hide the masthead banner throughout site.
*/
function memberlite_words_memberlite_banner_show() {
	return false;
}
add_filter( 'memberlite_banner_show', 'memberlite_words_memberlite_banner_show', 20 );

function memberlite_words_memberlite_before_site_header() {
	$meta_login = get_theme_mod( 'meta_login', false );
	if ( ! empty( $meta_login ) ) {
		get_template_part( 'components/header/meta', 'member' );
	}
}
add_action( 'memberlite_before_site_header', 'memberlite_words_memberlite_before_site_header' );

/*
	Filter to hide the sidebars throughout site.
*/
function memberlite_words_memberlite_get_sidebar( $name ) {
	return false;
}
add_filter( 'memberlite_get_sidebar', 'memberlite_words_memberlite_get_sidebar', 20 );

function memberlite_words_masthead() { 
	if ( ! is_home() ) { ?>	
	<header class="masthead_words">
		<?php do_action( 'memberlite_before_masthead_inner' ); ?>
		<?php memberlite_page_title(); ?>
		<?php do_action( 'memberlite_after_masthead_inner' ); ?>
	</header><!-- .masthead_words -->
	<?php }
}
add_action( 'memberlite_before_loop', 'memberlite_words_masthead' );

function memberlite_words_memberlite_page_title( $page_title_html ) {
	if ( ! is_singular( 'post' ) ) {
		return $page_title_html;
	} else {
		global $post;
		// Capture output.
		ob_start();
		the_title( '<h1 class="entry-title">', '</h1>' );
		$memberlite_get_entry_meta_before = memberlite_get_entry_meta( $post, 'before' );
		if ( ! empty( $memberlite_get_entry_meta_before ) ) { ?>
			<p class="entry-meta">
				<?php echo Memberlite_Customize::sanitize_text_with_links( memberlite_get_entry_meta( $post, 'before' ) ); ?>
			</p><!-- .entry-meta -->
		<?php }
	
		//get captured output
		$page_title_html = ob_get_contents();
		ob_end_clean();
	}

	return $page_title_html;
}
add_filter( 'memberlite_page_title', 'memberlite_words_memberlite_page_title', 20 );

/**
 * Remove the post meta shown after the post for the Words theme.
 *
 */
function memberlite_words_entry_meta_remove_after( $meta, $post, $location) {
	if ( $location === 'after' ) {
		$meta = '';
	}
	return $meta;
}
add_filter( 'memberlite_get_entry_meta' , 'memberlite_words_entry_meta_remove_after', 10, 3 );

function memberlite_words_memberlite_before_content_single() {
	// Show the featured image
	if ( has_post_thumbnail() ) { ?>
		<a class="splash-image" href="<?php echo get_permalink(); ?>">
			<?php the_post_thumbnail( 'full' ); ?>
		</a>
		<?php
	}
}
add_action( 'memberlite_before_content_single', 'memberlite_words_memberlite_before_content_single' );

/**
 * Filter the recommended plugins to show on the Memberlite Guide.
 *
 */
function memberlite_words_memberlite_plugins_recommended( $memberlite_plugins_recommended ) {
	$memberlite_plugins_recommended = array( 'memberlite-shortcodes', 'paid-memberships-pro' );
	return $memberlite_plugins_recommended;
}
add_filter( 'memberlite_plugins_recommended', 'memberlite_words_memberlite_plugins_recommended' );

/**
 * Filter the supported Elememnts in the Memberlite Elements plugin.
 *
 */
function memberlite_words_memberlite_elements_supported_elements( $memberlite_elements_supported_elements ) {
	$memberlite_elements_supported_elements = array();
	return $memberlite_elements_supported_elements;
}
add_filter( 'memberlite_elements_supported_elements', 'memberlite_words_memberlite_elements_supported_elements' );
