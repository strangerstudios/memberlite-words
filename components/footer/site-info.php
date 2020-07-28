<?php
/**
 * Displays the footer site info and back to top links.
 *
 * @package Memberlite Words
 */
?>

<?php do_action( 'memberlite_before_site_info' ); ?>

<div class="site-info">
	<div class="row copyright-textbox">
		<div class="small-12 columns">
		<?php
			global $memberlite_defaults;
			$copyright_textbox = get_theme_mod( 'copyright_textbox', $memberlite_defaults['copyright_textbox'] );
			if ( ! empty( $copyright_textbox ) ) {
				echo wpautop( Memberlite_Customize::sanitize_text_with_links( $copyright_textbox ) );
			}
		?>
		</div>
	</div><!-- .row -->
	<div class="row back-to-top">
		<?php 
			$back_to_top = get_theme_mod( 'memberlite_back_to_top', $memberlite_defaults['memberlite_back_to_top'] );
			if ( ! empty( $back_to_top ) ) { ?>
				<div class="small-12 columns">
				<?php
					$back_to_top = apply_filters( 'memberlite_back_to_top', '<i class="fa fa-chevron-up"></i>' );
					if ( ! empty( $back_to_top ) ) {
						echo '<a class="skip-link" href="#page">' . $back_to_top . '</a>';
					}
				?>
				</div><!-- .columns -->
			<?php }
		?>
	</div><!-- .row -->
</div><!-- .site-info -->

<?php do_action( 'memberlite_after_site_info' ); ?>
