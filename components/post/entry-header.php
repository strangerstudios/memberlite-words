<?php
/**
 * Displays the post entry header
 *
 * @package Memberlite Words
 */
?>
<header class="entry-header">
	<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	<?php if ( 'post' == get_post_type() ) : ?>
	<div class="entry-meta">
		<?php echo memberlite_get_entry_meta( $post, 'before' ); ?>
	</div><!-- .entry-meta -->
	<?php endif; ?>
	<?php // Show the featured image
		if ( has_post_thumbnail() ) { ?>
			<a class="splash-image" href="<?php echo get_permalink(); ?>">
				<?php the_post_thumbnail( 'full' ); ?>
			</a>
			<?php
		}
	?>
</header><!-- .entry-header -->