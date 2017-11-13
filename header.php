<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Memberlite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php if ( is_singular() && pings_open() ) { ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php } ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action('before_page'); ?>
<div id="page" class="hfeed site">
	<?php do_action('before_mobile_nav'); ?>	
	<?php 
		if(is_active_sidebar('sidebar-5') || has_nav_menu('primary'))
		{
			//show the mobile menu widget area
			?>
			<nav id="mobile-navigation" role="navigation">
			<?php
				if(is_active_sidebar('sidebar-5'))
				{
					dynamic_sidebar('sidebar-5');
				}
				elseif(has_nav_menu('primary'))
				{
					$mobile_defaults = array(
						'theme_location' => 'primary',
					);				
					wp_nav_menu($mobile_defaults ); 				
				}
			?>
			</nav>
			<div class="mobile-navigation-bar">
				<button class="menu-toggle"><i class="fa fa-bars"></i></button>
			</div>
			<?php
		}
	?>
	<?php do_action('after_mobile_nav'); ?>
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'memberlite' ); ?></a>
	<?php do_action('before_site_header'); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="row">
			<?php
				$meta_login = get_theme_mod( 'meta_login', false );
				if( !empty( $meta_login ) ) { ?>
					<div class="large-8 large-offset-2 medium-10 medium-offset-1 small-12 columns header-right">
						<div id="meta-member">
							<aside class="widget">
							<?php 
								global $current_user, $pmpro_pages;
								if($user_ID)
								{ 
									if(!empty($pmpro_pages)) {
										$account_page = get_post($pmpro_pages['account']);
										$user_account_link = '<a href="' . esc_url(pmpro_url("account")) . '">' . preg_replace("/\@.*/", "", $current_user->display_name) . '</a>';
									}
									else {
										$user_account_link = '<a href="' . esc_url(admin_url("profile.php")) . '">' . preg_replace("/\@.*/", "", $current_user->display_name) . '</a>';											
									}
									?>				
									<span class="user"><?php printf(__('Welcome, %s', 'memberlite'), $user_account_link);?></span>
									<?php										
								}
								if($user_ID)
								{
									$member_menu_defaults = array(
										'theme_location' => 'member',
										'container' => 'nav',
										'container_id' => 'member-navigation',
										'container_class' => 'member-navigation',
										'fallback_cb' => 'memberlite_member_menu_cb',
										'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									);	
								}
								else
								{
									$member_menu_defaults = array(
										'theme_location' => 'member-logged-out',
										'container' => 'nav',
										'container_id' => 'member-navigation',
										'container_class' => 'member-navigation',
										'fallback_cb' => 'memberlite_member_menu_cb',
										'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									);
								}
								wp_nav_menu( $member_menu_defaults ); 
							?>
							</aside>
						</div><!-- #meta-member -->
					</div><!-- .large-12 -->
				<?php } ?> 
		</div><!-- .row -->
		<div class="row">
			<div class="large-8 large-offset-2 medium-10 medium-offset-1 small-12 columns site-branding">
				<div class="site-branding_avatar">
					<?php 
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						if(!empty($custom_logo_id)) {
							memberlite_the_custom_logo(); 
						} else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php echo get_avatar( get_option( 'admin_email' ), 200, false, get_bloginfo( 'name' )) ; ?>
							</a>
							<?php
						}
					?>
				</div><!-- end .site-branding_avatar -->
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<span class="site-description"><?php bloginfo( 'description' ); ?></span>
			</div><!-- .site-branding -->
		</div><!-- .row -->
	</header><!-- #masthead -->
	<?php do_action('before_site_navigation'); ?>
	<?php do_action('before_content'); ?>
	<div id="content" class="site-content">
	<?php do_action('before_masthead'); ?>
	<header class="masthead_words">
		<div class="row">
			<div class="large-8 large-offset-2 medium-10 medium-offset-1 small-12 columns">
				<?php do_action('before_masthead_inner'); ?>
				<?php memberlite_words_page_title(); ?>
				<?php do_action('after_masthead_inner'); ?>
			</div><!-- .columns -->
		</div><!-- .row -->
	</header><!-- .masthead_words -->
	<div class="row">
	<?php do_action('after_masthead'); ?>