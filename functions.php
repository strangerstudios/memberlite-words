<?php
/**
 * Memberlite [Words] Child Theme functions and definitions
 *
 * @package Memberlite 2.0
 * @subpackage Memberlite Words 1.0
 */
 
//Define constants
define( 'MEMBERLITE_WORDS_DIR', get_stylesheet_directory() );


//Enqueue scripts and styles.
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

	// Unregister unused parent theme menu locations.
	unregister_nav_menu('primary');

}
add_action('after_setup_theme', 'memberlite_words_setup', 20);

/**
 * Remove unused parent theme widget areas.
 */
function memberlite_words_widgets_init() {

	// Unregister unused parent theme sidebars.
	unregister_sidebar( 'sidebar-1' );
	unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
	unregister_sidebar( 'sidebar-4' );
	
}
add_action('widgets_init', 'memberlite_words_widgets_init', 20);

/**
 * Filter the theme page templates.
 *
 * @param array    $page_templates Page templates.
 * @param WP_Theme $this           WP_Theme instance.
 * @param WP_Post  $post           The post being edited, provided for context, or null.
 * @return array (Maybe) modified page templates array.
 */
function memberlite_words_filter_theme_page_templates( $page_templates, $this, $post ) {

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
	$wp_customize->remove_setting( 'nav_menu_search' );
	$wp_customize->remove_setting( 'columns_ratio_header' );
	$wp_customize->remove_setting( 'columns_ratio' );
	$wp_customize->remove_setting( 'sidebar_location' );
	$wp_customize->remove_setting( 'sidebar_location_blog' );
	
	// Memberlite parent theme settings.
	$wp_customize->remove_setting( 'posts_entry_meta_before' );
	$wp_customize->remove_control( 'posts_entry_meta_before' );
	$wp_customize->remove_setting( 'posts_entry_meta_after' );
	$wp_customize->remove_control( 'posts_entry_meta_after' );

} 
add_action( 'customize_register', 'memberlite_words_customize_register', 20 );

function memberlite_words_page_title() {

	global $post; 
	
	//capture output
	ob_start();
	
	//figure out page title
	if(is_post_type_archive())
	{
		$post_type = get_post_type_object(get_query_var('post_type'));
		?>
		<h1 class="page-title"><?php echo $post_type->labels->name; ?></h1>
		<?php
	}
	elseif(is_author() || is_tag() || is_archive())
	{
		?>
			<h1 class="page-title">
			<?php
				if ( is_category() ) :
					single_cat_title();
	
				elseif ( is_tag() ) :
					$current_tag = single_tag_title("", false);
					printf( __( 'Posts Tagged: %s', 'memberlite' ), '<span>' . $current_tag . '</span>' );
	
				elseif ( is_author() ) :
					printf( __( 'Author: %s', 'memberlite' ), '<span class="vcard">' . get_the_author() . '</span>' );
	
				elseif ( is_day() ) :
					printf( __( 'Day: %s', 'memberlite' ), '<span>' . get_the_date() . '</span>' );
	
				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'memberlite' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'memberlite' ) ) . '</span>' );
	
				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'memberlite' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'memberlite' ) ) . '</span>' );
	
				elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
					_e( 'Asides', 'memberlite' );
	
				elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
					_e( 'Galleries', 'memberlite' );
	
				elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
					_e( 'Images', 'memberlite' );
	
				elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
					_e( 'Videos', 'memberlite' );
	
				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
					_e( 'Quotes', 'memberlite' );
	
				elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
					_e( 'Links', 'memberlite' );
	
				elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
					_e( 'Statuses', 'memberlite' );
	
				elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
					_e( 'Audios', 'memberlite' );
	
				elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
					_e( 'Chats', 'memberlite' );
				
				elseif ( is_tax ( ) ) :
                    single_term_title();
					
				else :
					_e( 'Archives', 'memberlite' );
	
				endif;
			?>
		</h1>
		<?php
			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
				printf( '<div class="taxonomy-description">%s</div>', $term_description );
			endif;			
	}	
	elseif(is_search())
	{
		?>
		<h1 class="page-title">
			<?php printf( __( 'Search Results for: %s', 'memberlite' ), '<span>' . get_search_query() . '</span>' ); ?>
		</h1>
		<?php
	}
	elseif(is_singular('post'))
	{
		?>
		<div class="masthead-post-byline">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php
				$memberlite_get_entry_meta_before = memberlite_get_entry_meta($post, 'before');
				if(!empty($memberlite_get_entry_meta_before))
				{
					?>
					<p class="entry-meta">
						<?php echo memberlite_get_entry_meta($post, 'before'); ?>
					</p><!-- .entry-meta -->
					<?php
				}
			?>
		</div>
		<?php
	}
	elseif(is_home())
	{
		?>
		<h1 class="page-title">
		<?php 
			if(get_option('page_for_posts'))
				echo get_the_title(get_option('page_for_posts')); 
		?></h1>
		<?php
	}	
	else
	{
		the_title( '<h1 class="entry-title">', '</h1>' );
	}
	
	//get captured output
	$page_title_html = ob_get_contents();
	ob_end_clean();
	
	//filter
	$page_title_html = apply_filters('memberlite_words_page_title', $page_title_html);
	
	echo $page_title_html;

}

/**
 * This retrives post meta and displays it in a cool format.
 * @param $post Object.
 */
function memberlite_words_get_entry_meta(){
	?>
	<div id="memberlite-words-post-meta">
		<i class="fa fa-user"></i> <?php echo get_the_author_posts_link(); ?>
		<i class="fa fa-tags"></i> <?php echo get_the_category_list( ', ' ); ?>
		<i class="fa fa-comments"></i><a href="<?php echo get_comments_link(); ?>"> <?php echo comments_number( __( 'Leave a Comment', 'memberlite-words' ) ); ?></a>
		<i class="fa fa-calendar"></i> <?php echo get_the_date(); ?>
	</div>
	<?php
}
