<?php
/**
 * The template for displaying all single posts.
 *
 * @package acmusic
 */

get_header(); ?>

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
		.entry-header{
			margin: 0;
		}
		.member-letter-container {
			color: #888;
		}
		.members-letters-list li p:hover{
			color: <?php echo $pcolor ?>;
		}
		.members-letters-list .active-list-letter{
			color: <?php echo $pcolor ?>;
		}
		.member-list-container{
			border-left: 5px solid <?php echo $pcolor ?>;
			border-top: 2px solid <?php echo $pcolor ?>;
		}
		.entry-description{
			color:  <?php echo $pcolor ?>;
		}
	<?php endif; ?>
</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<!-- <header class="entry-header">
				<?php the_title( '<h1 class="col-md-4 entry-title page-entry-title">', '</h1><p class="col-md-8 entry-description">'. esc_html($pdesc) .'</p>' ); ?>
				<?php
					// echo '<div class="">';
					// display_letters_anchors( array_keys( $by_letter ) );
					// echo '</div>';
				?>
				<div class="">
					<?php echo list_child_pages(); ?>
				</div>
			</header> -->
			<!-- .entry-header -->

		<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( !is_singular( 'members' ) && !is_singular( 'teacher' ) && !is_singular( 'program' )): ?>
				<?php get_template_part( 'content', 'single' ); ?>
			<?php elseif (is_singular( 'teacher' )) : ?>
				<?php get_template_part( 'content', 'teacher' ); ?>
			<?php elseif (is_singular( 'program' )) : ?>
				<?php get_template_part( 'content', 'program' ); ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'member' ); ?>
			<?php endif; ?>

			<?php if (get_theme_mod('author_bio') != '') : ?>
				<?php get_template_part( 'author-bio' ); ?>
			<?php endif; ?>

			<?php acmusic_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
