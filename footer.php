<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Memberlite
 */
?>
		<?php 
			$template = get_page_template();
			if( 
				!is_page_template('templates/fluid-width.php') && 
				!is_page_template( 'templates/interstitial.php' ) &&
				!is_404() && 
				(!is_front_page() || (is_front_page() && !empty($template) && (basename($template) != 'page.php') || 'posts' == get_option( 'show_on_front' )))
			) 
			{ 
				?>
				</div><!-- .row -->
				<?php 
			} 
		?>
		<?php do_action('after_content'); ?>
	</div><!-- #content -->
	
	<?php do_action('before_footer'); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<nav id="footer-navigation">
			<?php 
				$footer_defaults = array(
					'theme_location' => 'footer',
					'container' => 'div',
					'container_class' => 'footer-navigation row',
					'menu_class' => 'menu large-8 large-offset-2 medium-10 medium-offset-1 small-12 columns',
					'fallback_cb' => false,					
				);				
				wp_nav_menu($footer_defaults); 				
			?>
		</nav><!-- #footer-navigation -->
		<?php do_action('before_site_info'); ?>
		<div class="row site-info">
			<div class="large-8 large-offset-2 medium-10 medium-offset-1 small-12 columns">
				<div class="row">
					<?php
						global $memberlite_defaults;
						$back_to_top = get_theme_mod( 'memberlite_back_to_top',$memberlite_defaults['memberlite_back_to_top'] ) ;

						if( !empty($back_to_top) ) { ?>
							<div class="small-11 columns">
						<?php } else { ?>
							<div class="large-12 columns">
						<?php } ?>		
						<?php 
							$copyright_textbox = get_theme_mod( 'copyright_textbox',$memberlite_defaults['copyright_textbox'] ); 
							if ( ! empty( $copyright_textbox ) ) 
							{
								echo wpautop(memberlite_Customize::sanitize_text_with_links($copyright_textbox));
							}				
						?>
					</div>
					<?php 
						if( !empty($back_to_top) ) { 
							$back_to_top = apply_filters('memberlite_back_to_top', __('<i class="fa fa-chevron-up"></i>', 'memberlite') );
							?>
							<div class="small-1 columns text-right">
								<?php echo '<a class="skip-link" href="#page">' . $back_to_top . '</a>'; ?>
							</div><!-- .columns -->
					<?php } ?>
				</div><!-- .row -->
			</div><!-- .columns -->
		</div><!-- .row, .site-info -->
		<?php do_action('after_site_info'); ?>
	</footer><!-- #colophon -->
	<?php do_action('after_footer'); ?>
</div><!-- #page -->
<?php do_action('after_page'); ?>
<?php wp_footer(); ?>
</body>
</html>
