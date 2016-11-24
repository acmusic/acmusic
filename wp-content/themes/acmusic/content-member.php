<?php
/**
 * @package acmusic
 */
?>
<?php
	$pcolor = esc_html(get_theme_mod('member_profile_clr'));
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

	<?php if ( (has_post_thumbnail()) && ( get_theme_mod( 'acmusic_post_img' )) ) : ?>
		<div class="single-thumb">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>
	<?php
		$name = get_the_title();
		$names = explode(", ", $name);
		$name = $names[1] . " " . $names[0];
	?>

	<header class="row entry-header col-md-12">
		<div class="member-bar-lg col-md-12" style="border-color: <?php echo esc_html(get_theme_mod('member_profile_clr')); ;?>">
		</div>
		<div>
			<h1 class="col-md-4 entry-title page-entry-title">Composer Members</h1>
		</div>
		<div class="">
			<!-- needs to be 51 for production, 70 for staging -->
			<?php $post_id = 51; ?>
			<?php echo list_child_pages_input($post_id); ?>
		</div>

	</header><!-- .entry-header -->

	<div class="row member-profile-content">
		<div class="col-xs-12 hidden-sm hidden-md hidden-lg">
			<?php $photo = get_post_meta( get_the_ID(), 'wpcf-person-image', true ); ?>
			<?php $country = get_post_meta( get_the_ID(), 'wpcf-country', true ); ?>
			<?php if ($photo != '') : ?>
				<div class="member-photo"><img class="" src="<?php echo esc_url($photo); ?>" alt="<?php echo $name; ?>"></div>
			<?php endif; ?>
			<h1 class="entry-title"><strong><?php echo $name; ?></strong></h1>
			<h4 style="color: <?php echo esc_html(get_theme_mod('member_profile_clr')); ?>"><?php echo $country; ?></h4>
			<div class="col-md-12 member-bar-sm" style="border-color: <?php echo esc_html(get_theme_mod('member_profile_clr')); ?>;"></div>
		</div>
		<div class="col-sm-7">
			<?php $tagLine = get_post_meta( get_the_ID(), 'wpcf-tag-line', true ); ?>
			<?php if ($tagLine != '') : ?>
				<div class="member-tag">
					<h2><?php echo $tagLine; ?></h2>
				</div>
			<?php endif; ?>

			<?php the_content(); ?>

			<?php $vimeo = get_post_meta( get_the_ID(), 'wpcf-vimeo', true ); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'acmusic' ),
					'after'  => '</div>',
				) );
			?>
			<div class="member-vimeo">
				<?php if ($vimeo) :
						$url = esc_url($vimeo);
						preg_match(
									'/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',
									$url,
									$matches
							);
						$id = $matches[2];
						$width = '640';
						$height = '360';
						$color = '#ffffff';
						echo '<iframe src="https://player.vimeo.com/video/'.$id.'?title=1&amp;byline=1&amp;portrait=0&amp;badge=0&amp;color='.$color.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
					endif;
				?>
			</div>
		</div>
		<div class="col-sm-5 hidden-xs">
			<?php $photo = get_post_meta( get_the_ID(), 'wpcf-person-image', true ); ?>
			<?php if ($photo != '') : ?>
				<div class="member-photo"><img class="" src="<?php echo esc_url($photo); ?>" alt="<?php echo $name; ?>"></div>
			<?php endif; ?>
			<h1 class="entry-title" style="color: <?php echo esc_html(get_theme_mod('member_profile_clr')); ?>";><strong><?php echo $name; ?></strong></h1>
			<h4 style="color: <?php echo esc_html(get_theme_mod('member_profile_clr')); ?>"><?php echo $country; ?></h4>
			<div class="col-md-12 member-bar-sm" style="border-color: <?php echo esc_html(get_theme_mod('member_profile_clr')); ?>;"></div>
		</div>
	</div>
	<div class="member-bar-lg col-md-12" style="border-color: <?php echo esc_html(get_theme_mod('member_profile_clr')); ;?>">
	</div>

	<div class="entry-content">
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'acmusic' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'acmusic' ) );

			if ( ! acmusic_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = '<i class="fa fa-tag"></i> %2$s' . '<i class="fa fa-link"></i>' . __( '<a href="%3$s" rel="bookmark"> permalink</a>.', 'acmusic' );
				} else {
					$meta_text = '<span><i class="fa fa-link"></i>' . __( '<a href="%3$s" rel="bookmark"> permalink</a>', 'acmusic' ) . '</span>';
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = '<span><i class="fa fa-folder"></i> %1$s</span>' . '<span><i class="fa fa-tag"></i> %2$s</span>' . '<span><i class="fa fa-link"></i>' . __( '<a href="%3$s" rel="bookmark"> permalink</a>', 'acmusic' ) . '</span>';
				} else {
					$meta_text = '<span><i class="fa fa-folder"></i> %1$s</span>' . '<span><i class="fa fa-link"></i>' . __( '<a href="%3$s" rel="bookmark"> permalink</a>', 'acmusic' ) . '</span>';
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list
				// get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'acmusic' ), '<span class="edit-link"><i class="fa fa-edit"></i>&nbsp;', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
