<?php
/**
 * @package Memberlite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php //NOTE: The title is generated in header.php via the memberlite_page_title() function found in functions.php ?>
		<?php do_action('before_content_single'); ?>
		
		<?php
			if(get_post_format() == 'image')
				the_post_thumbnail( 'fullwidth', array( 'class' => 'aligncenter' ) );
		?>	
		<?php the_content(); ?>
		
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'memberlite' ),
				'after'  => '</div>',
			) );
		?>
		<?php do_action('after_content_single'); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : 
			echo memberlite_words_get_entry_meta(); 
		endif; ?>
		<?php if( current_user_can( 'edit_post', $post->ID ) ) { edit_post_link( __( 'Edit', 'memberlite' ), '<span class="edit-link">', '</span>' ); } ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
