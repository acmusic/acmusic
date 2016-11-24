<?php
/**
 * @package acmusic
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumb col-md-4 col-sm-4 col-xs-4">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
				<?php the_post_thumbnail('acmusic-thumb'); ?>
			</a>
		</div>
	<?php endif; ?>


	<?php if (has_post_thumbnail()) : ?>
		<?php $has_thumb = "col-md-8 col-sm-8 col-xs-8"; ?>
	<?php else : ?>
		<?php $has_thumb = ""; ?>
	<?php endif; ?>

	<div class="post-content <?php echo $has_thumb; ?>">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="page-entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php acmusic_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php if ( (get_theme_mod('full_content') == 1) && is_home() ) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'acmusic' ) );
					if ( $categories_list && acmusic_categorized_blog() ) :
				?>
				<span class="cat-links">
					<?php echo '<i class="fa fa-folder"></i>&nbsp;' . $categories_list; ?>
				</span>
				<?php endif; // End if categories ?>

				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ', 'acmusic' ) );
					if ( $tags_list ) :
				?>
				<span class="tags-links">
					<?php echo '<i class="fa fa-tag"></i>&nbsp;' . $tags_list; ?>
				</span>
				<?php endif; // End if $tags_list ?>
			<?php endif; // End if 'post' == get_post_type() ?>

			<?php edit_post_link( __( 'Edit', 'acmusic' ), '<span class="edit-link"><i class="fa fa-edit"></i>&nbsp;', '</span>' ); ?>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-## -->
