<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package acmusic
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( (has_post_thumbnail()) && ( get_theme_mod( 'acmusic_page_img' )) ) : ?>
		<div class="single-thumb">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<div>
		<?php the_title( '<h1 class="col-md-4 entry-title page-entry-title">', '</h1><p class="col-md-8 entry-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>' ); ?>
		</div>
		<div class="">
		<?php echo list_child_pages(); ?>
		</div>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="col-md-12">
			<?php the_content(); ?>
		</div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'acmusic' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'acmusic' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
