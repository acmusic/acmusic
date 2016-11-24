<?php

/*

Template Name: Programs

*/
	get_header();
?>


	<div id="primary" class="content-area fullwidth">
		<main id="main" class="site-main" role="main">

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<?php
				$programs = new WP_Query( array(
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'post_type' 		  		=> 'program',
					'posts_per_page'	 		=> -1
				) );

				if ($programs->have_posts()) :
			?>
				<?php while ( $programs->have_posts() ) : $programs->the_post(); ?>
					<?php //Get the custom field values
						$photo = get_post_meta( get_the_ID(), 'wpcf-photo', true );
						$position = get_post_meta( get_the_ID(), 'wpcf-position', true );
					?>
					<div class="program col-md-4 col-sm-6 col-xs-6">
						<?php if ($photo != '') : ?>
							<img class="program-photo wow zoomInDown" src="<?php echo esc_url($photo); ?>" alt="<?php the_title(); ?>">
						<?php endif; ?>
						<h4 class="program-name wow fadeInUp"><?php the_title(); ?></h4>
						<?php if ($position != '') : ?>
							<span class="program-position wow fadeInUp"><?php echo esc_html($position); ?></span>
						<?php endif; ?>
						<div class="program-desc wow fadeInUp"><?php the_content(); ?></div>
					</div>
				<?php endwhile; ?>

			<?php acmusic_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
