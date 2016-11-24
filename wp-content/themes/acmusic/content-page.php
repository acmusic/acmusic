<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package acmusic
 */
?>

<?php
	$pdesc = get_post_meta( get_the_ID(), 'wpcf-page-description', true );
	$pcolor = get_post_meta( get_the_ID(), 'wpcf-page-color', true );
?>

<style>
	<?php if ( $pcolor ) : ?>
		.page-entry-title{
			background-color: <?php echo $pcolor ?>;
		}
		.menu-child-pages li a{
			color: <?php echo $pcolor ?>;
		}
		.entry-content-leftbar{
			border-color: <?php echo $pcolor ?>;
		}
		.menu-child-pages li a:hover{
			background-color: <?php echo $pcolor ?>;
		}
		.entry-description{
			color:  <?php echo $pcolor ?>;
		}
		.post-navigation .nav-previous, .post-navigation .nav-next, .paging-navigation .nav-previous, .paging-navigation .nav-next {
			background-color: <?php echo $pcolor ?>;
		}
	<?php endif; ?>
</style>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( (has_post_thumbnail()) && ( get_theme_mod( 'acmusic_page_img' )) ) : ?>
		<div class="single-thumb">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<div class="page-bar-lg" style="border-color: <?php echo $pcolor ?>;">
	</div>

	<header class="entry-header">
		<div>
		<?php the_title( '<h1 class="col-md-4 entry-title page-entry-title">', '</h1><p class="col-md-8 entry-description">'. esc_html($pdesc) .'</p>' ); ?>
		</div>
		<div class="">
			<?php echo list_child_pages(); ?>
		</div>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="col-md-3 hidden-sm hidden-xs entry-content-leftbar">
			<!-- ASDF -->
			<?php get_sidebar(); ?>
		</div>
		<div class="col-md-9">
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
