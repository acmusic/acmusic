<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package acmusic
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if ( get_theme_mod('site_favicon') ) : ?>
	<link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('site_favicon')); ?>" />
<?php endif; ?>

<?php if ( get_theme_mod('apple_touch_144') ) : ?>
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url(get_theme_mod('apple_touch_144')); ?>" />
<?php endif; ?>
<?php if ( get_theme_mod('apple_touch_114') ) : ?>
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url(get_theme_mod('apple_touch_114')); ?>" />
<?php endif; ?>
<?php if ( get_theme_mod('apple_touch_72') ) : ?>
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url(get_theme_mod('apple_touch_72')); ?>" />
<?php endif; ?>
<?php if ( get_theme_mod('apple_touch_57') ) : ?>
	<link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_mod('apple_touch_57')); ?>" />
<?php endif; ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<style type="text/css">
	.main-navigation ul.menu > li:nth-child(1):hover {
		background-color: <?php echo esc_html(get_theme_mod('color_1')); ?>;
	}
	.main-navigation ul.menu > li:nth-child(1):hover a {
		color: #fff;
	}
	.main-navigation ul.menu > li:nth-child(1):hover .sub-menu a {
		color: #555;
	}
	.main-navigation ul.menu > li:nth-child(2):hover {
		background-color: <?php echo esc_html(get_theme_mod('color_2')); ?>;
	}
	.main-navigation ul.menu > li:nth-child(2):hover a {
		color: #fff;
	}
	.main-navigation ul.menu > li:nth-child(2):hover .sub-menu a {
		color: #555;
	}
	.main-navigation ul.menu > li:nth-child(3):hover {
		background-color: <?php echo esc_html(get_theme_mod('color_3')); ?>;
	}
	.main-navigation ul.menu > li:nth-child(3):hover a {
		color: #fff;
	}
	.main-navigation ul.menu > li:nth-child(3):hover .sub-menu a {
		color: #555;
	}
	.main-navigation ul.menu > li:nth-child(4):hover {
		background-color: <?php echo esc_html(get_theme_mod('color_4')); ?>;
	}
	.main-navigation ul.menu > li:nth-child(4):hover a {
		color: #fff;
	}
	.main-navigation ul.menu > li:nth-child(4):hover .sub-menu a {
		color: #555;
	}
	.main-navigation ul.menu > li:nth-child(5):hover {
		background-color: <?php echo esc_html(get_theme_mod('color_5')); ?>;
	}
	.main-navigation ul.menu > li:nth-child(5):hover a {
		color: #fff;
	}
	.main-navigation ul.menu > li:nth-child(5):hover .sub-menu a {
		color: #555;
	}
	.main-navigation ul.menu > li:nth-child(6):hover {
		background-color: <?php echo esc_html(get_theme_mod('color_1')); ?>;
	}
	.main-navigation ul.menu > li:nth-child(6):hover a {
		color: #fff;
	}
	.main-navigation ul.menu > li:nth-child(6):hover .sub-menu a {
		color: #555;
	}
	.main-navigation ul.menu > li:nth-child(7):hover {
		background-color: <?php echo esc_html(get_theme_mod('color_2')); ?>;
	}
	.main-navigation ul.menu > li:nth-child(7):hover a {
		color: #fff;
	}
	.main-navigation ul.menu > li:nth-child(7):hover .sub-menu a {
		color: #555;
	}
	.main-navigation ul.menu > li:nth-child(8):hover {
		background-color: <?php echo esc_html(get_theme_mod('color_3')); ?>;
	}
	.main-navigation ul.menu > li:nth-child(8):hover a {
		color: #fff;
	}
	.main-navigation ul.menu > li:nth-child(8):hover .sub-menu a {
		color: #555;
	}
</style>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'acmusic' ); ?></a>

	<?php //Single page header image data
		$himage  = get_post_meta( get_the_ID(), 'wpcf-header-image', true );
		$htitle  = get_post_meta( get_the_ID(), 'wpcf-header-title', true );
		$hlogo 	 = get_post_meta( get_the_ID(), 'wpcf-header-logo', true );
		$htext 	 = get_post_meta( get_the_ID(), 'wpcf-header-text', true );
		$hbutton = get_post_meta( get_the_ID(), 'wpcf-header-button-title', true );
		$hlink 	 = get_post_meta( get_the_ID(), 'wpcf-header-button-link', true );
		$hvideolink 	 = get_post_meta( get_the_ID(), 'wpcf-header-button-link', true );
	?>
	<?php tha_header_before(); ?>
	<?php if ( is_page_template('page_front-page.php') ) : ?>
		<?php if ( get_header_image() && $himage == '' ) : ?>
			<?php if ( get_theme_mod('acmusic_banner') == 1 && !is_front_page() ) : ?>
				<header id="masthead" class="site-header" role="banner">
				<?php tha_header_top(); ?>
			<?php else : ?>
				<!-- REMOVED THE 'has-banner' class tag from the following -->
				<header id="masthead" class="site-header
				<?php if ( is_page_template('page_front-page.php') && get_theme_mod('video_link_toggle') && esc_url(get_theme_mod('header_video_link')) != ''): ?>
					<?php echo ""; ?>
				<?php else : ?>
					<?php echo "has-banner"; ?>
				<?php endif ?>
				" role="banner">
				<?php tha_header_top(); ?>
				<?php if ( get_theme_mod('mobile_header') ) : ?>
					<img class="header-image" src="<?php echo esc_url( get_theme_mod('mobile_header') ); ?>">
				<?php else : ?>
					<img class="header-image" src="<?php echo esc_url(get_header_image()); ?>">
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( (get_theme_mod('acmusic_banner') == 1 && is_front_page()) ||  (get_theme_mod('acmusic_banner') != 1)) : ?>
				<div class="welcome-info">
					<?php if ( get_theme_mod('header_logo') ) : ?>
						<img class="welcome-logo wow bounceInDown hidden-xs" src="<?php echo esc_url(get_theme_mod('header_logo')); ?>" />
					<?php elseif ( get_theme_mod('header_title') ) : ?>
						<div class="welcome-title wow bounceInDown"><?php echo esc_attr(get_theme_mod('header_title')); ?></div>
					<?php endif; ?>
					<?php if ( get_theme_mod('header_desc') ) : ?>
						<div class="welcome-desc wow bounceInRight" data-wow-delay="0.2s"><?php echo esc_html(get_theme_mod('header_desc')); ?></div>
					<?php endif; ?>
				</div>
				<div class="see-more">
					<?php if (get_theme_mod('header_btn_text') && get_theme_mod('header_btn_link')) : ?>
						<a href="<?php echo esc_url(get_theme_mod('header_btn_link')); ?>" class="see-more-button explore-button hidden-xs hidden-sm" data-wow-delay="0.3s"><i class="fa fa-caret-down"></i><?php echo esc_html(get_theme_mod('header_btn_text')); ?></a>
					<?php endif; ?>
					<?php if(get_theme_mod('header_btn_text_1') && get_theme_mod('header_btn_link_1')) : ?>
						<a href="<?php echo esc_url(get_theme_mod('header_btn_link_1')); ?>" class="see-more-button extra-button button-1 hidden-xs hidden-sm" data-wow-delay="0.3s"><?php echo esc_html(get_theme_mod('header_btn_text_1')); ?></a>
					<?php endif; ?>
					<?php if(get_theme_mod('header_btn_text_2') && get_theme_mod('header_btn_link_2')) : ?>
						<a href="<?php echo esc_url(get_theme_mod('header_btn_link_1')); ?>" class="see-more-button extra-button button-2 hidden-xs hidden-sm" data-wow-delay="0.3s"><?php echo esc_html(get_theme_mod('header_btn_text_2')); ?></a>
					<?php endif; ?>
					<?php if(get_theme_mod('header_btn_text_3') && get_theme_mod('header_btn_link_3')) : ?>
						<a href="<?php echo esc_url(get_theme_mod('header_btn_link_1')); ?>" class="see-more-button extra-button button-3 hidden-xs hidden-sm" data-wow-delay="0.3s"><?php echo esc_html(get_theme_mod('header_btn_text_3')); ?></a>
					<?php endif; ?>
					<?php if(get_theme_mod('header_btn_text_4') && get_theme_mod('header_btn_link_4')) : ?>
						<a href="<?php echo esc_url(get_theme_mod('header_btn_link_1')); ?>" class="see-more-button extra-button button-4 hidden-xs hidden-sm" data-wow-delay="0.3s"><?php echo esc_html(get_theme_mod('header_btn_text_4')); ?></a>
					<?php endif; ?>
					<?php if(get_theme_mod('header_btn_text_5') && get_theme_mod('header_btn_link_5')) : ?>
						<a href="<?php echo esc_url(get_theme_mod('header_btn_link_1')); ?>" class="see-more-button extra-button button-5 hidden-xs hidden-sm" data-wow-delay="0.3s"><?php echo esc_html(get_theme_mod('header_btn_text_5')); ?></a>
					<?php endif; ?>
				</div>
				<?php if (get_theme_mod('video_link_toggle') && esc_url(get_theme_mod('header_video_link')) != '') : ?>
					<?php if ( is_page_template('page_front-page.php')) : ?>
						<div class="fullscreen-bg hidden-sm hidden-xs">
								<video loop muted autoplay poster="" class="fullscreen-bg__video">
										<source src="<?php echo esc_url(get_theme_mod('header_video_link')) ?>" type="video/mp4">
								</video>
						</div>
					<?php endif;?>
				<?php endif;?>
			<?php endif; ?>
			<?php tha_header_bottom(); ?>
			</header><!-- #masthead -->
		<?php elseif ( $himage != '' ) : ?>
			<!-- REMOVED THE 'has-banner' class tag from the following -->
			<header id="masthead" class="site-header has-banner" role="banner">
				<?php tha_header_top(); ?>
				<img class="header-image" src="<?php echo esc_url($himage); ?>">
				<div class="welcome-info">

					<?php if ( $hlogo ) : ?>
						<img class="welcome-logo wow bounceInDown hidden-xs" src="<?php echo esc_url($hlogo); ?>" />
					<?php elseif ( $htitle ) : ?>
						<div class="welcome-title wow bounceInDown"><?php echo esc_html($htitle); ?></div>
					<?php endif; ?>

					<?php if ( $htext ) : ?>
						<div class="welcome-desc wow bounceInRight" data-wow-delay="0.2s"><?php echo esc_html($htext); ?></div>
					<?php endif; ?>
					<div class="see-more">
						<?php if (get_theme_mod('header_btn_text') && get_theme_mod('header_btn_link')) : ?>
							<a href="<?php echo esc_url(get_theme_mod('header_btn_link')); ?>" class="see-more-button explore-button wow bounceInUp hidden-xs hidden-sm" data-wow-delay="0.3s"><i class="fa fa-caret-down"></i><?php echo esc_html(get_theme_mod('header_btn_text')); ?></a>
						<?php endif; ?>
						<?php if(get_theme_mod('header_btn_text_1') && get_theme_mod('header_btn_link_1')) : ?>
							<a href="<?php echo esc_url(get_theme_mod('header_btn_link_1')); ?>" class="see-more-button extra-button button-1 wow bounceInUp hidden-xs hidden-sm button-visible" data-wow-delay="0.3s"><?php echo esc_html(get_theme_mod('header_btn_text_1')); ?></a>
						<?php endif; ?>
						<?php if(get_theme_mod('header_btn_text_2') && get_theme_mod('header_btn_link_2')) : ?>
							<a href="<?php echo esc_url(get_theme_mod('header_btn_link_1')); ?>" class="see-more-button extra-button button-2 wow bounceInUp hidden-xs hidden-sm" data-wow-delay="0.3s"><?php echo esc_html(get_theme_mod('header_btn_text_2')); ?></a>
						<?php endif; ?>
						<?php if(get_theme_mod('header_btn_text_3') && get_theme_mod('header_btn_link_3')) : ?>
							<a href="<?php echo esc_url(get_theme_mod('header_btn_link_1')); ?>" class="see-more-button extra-button button-3 wow bounceInUp hidden-xs hidden-sm" data-wow-delay="0.3s"><?php echo esc_html(get_theme_mod('header_btn_text_3')); ?></a>
						<?php endif; ?>
						<?php if(get_theme_mod('header_btn_text_4') && get_theme_mod('header_btn_link_4')) : ?>
							<a href="<?php echo esc_url(get_theme_mod('header_btn_link_1')); ?>" class="see-more-button extra-button button-4 wow bounceInUp hidden-xs hidden-sm" data-wow-delay="0.3s"><?php echo esc_html(get_theme_mod('header_btn_text_4')); ?></a>
						<?php endif; ?>
						<?php if(get_theme_mod('header_btn_text_5') && get_theme_mod('header_btn_link_5')) : ?>
							<a href="<?php echo esc_url(get_theme_mod('header_btn_link_1')); ?>" class="see-more-button extra-button button-5 wow bounceInUp hidden-xs hidden-sm" data-wow-delay="0.3s"><?php echo esc_html(get_theme_mod('header_btn_text_5')); ?></a>
						<?php endif; ?>
					</div>
				</div>
				<?php tha_header_bottom(); ?>
			</header><!-- #masthead -->
		<?php endif; ?>
		<?php tha_header_after(); ?>

	<?php endif; ?>


<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
	<?php $headerDisplay = true; ?>

	<?php if ( !is_page_template('page_front-page.php') && $headerDisplay == false) : ?>
		<?php tha_header_after(); ?>
	<?php endif; ?>

	<?php if ( !is_page_template('page_front-page.php')  && $headerDisplay == true) : ?>
		<?php if ( get_header_image() && $himage == '' && !esc_url( get_theme_mod('secondary_header') ) ) : ?>
				<!-- REMOVED THE 'has-banner' class tag from the following -->
				<header id="masthead" class="site-header has-banner" role="banner">
				<?php tha_header_top(); ?>
				<?php if ( get_theme_mod('mobile_header') ) : ?>
					<img class="header-image" src="<?php echo esc_url( get_theme_mod('mobile_header') ); ?>">
				<?php else : ?>
					<img class="header-image" src="<?php echo esc_url(get_header_image()); ?>">
				<?php endif; ?>
			<?php tha_header_bottom(); ?>
			</header><!-- #masthead -->

		<?php elseif ( get_header_image() && $himage == '' && esc_url( get_theme_mod('secondary_header') ) ) : ?>
				<!-- REMOVED THE 'has-banner' class tag from the following -->
			<header id="masthead" class="page-header" role="banner" style="background-image: url(' <?php echo esc_url( get_theme_mod('secondary_header') );?>');>
				<?php tha_header_top(); ?>
				<?php if ( get_theme_mod('mobile_header') ) : ?>
					<img class="header-image" src="<?php echo esc_url( get_theme_mod('mobile_header') ); ?>"/>
				<?php else : ?>
					<img class="header-image" src="<?php echo esc_url(get_header_image()); ?>"/>
				<?php endif; ?>
			<?php tha_header_bottom(); ?>
			</header><!-- #masthead -->

		<?php elseif ( $himage != '' ) : ?>
			<!-- REMOVED THE 'has-banner' class tag from the following -->
 			<header id="masthead" class="page-header secondary-header" role="banner" style="background-image: url(' <?php echo esc_url($himage);?>');">
				<?php tha_header_top(); ?>
				<div class="welcome-info">
					<?php if ( $hlogo ) : ?>
						<img class="welcome-logo wow bounceInDown hidden-xs" src="<?php echo esc_url($hlogo); ?>" />
					<?php elseif ( $htitle ) : ?>
						<div class="welcome-title wow bounceInDown"><?php echo esc_html($htitle); ?></div>
					<?php endif; ?>
					<?php if ( $htext ) : ?>
						<div class="welcome-desc wow bounceInRight" data-wow-delay="0.2s"><?php echo esc_html($htext); ?></div>
					<?php endif; ?>
					<?php if ($hbutton && $hlink) : ?>
						<a href="<?php echo esc_url($hlink); ?>" class="welcome-button wow bounceInUp" data-wow-delay="0.3s"><?php echo esc_html($hbutton); ?></a>
					<?php endif; ?>
				</div>
				<?php tha_header_bottom(); ?>
			</header><!-- #masthead -->
		<?php endif; ?>
		<?php tha_header_after(); ?>

	<?php endif; ?>


	<?php if ( !is_page_template('page_front-page.php') || ( 'posts' == get_option( 'show_on_front' ) ) ) : ?>
		<?php $container = "container"; ?>
	<?php else : ?>
		<?php $container = ""; ?>
	<?php endif; ?>
	<?php tha_content_before(); ?>
	<div id="content" class="site-content clearfix <?php echo $container; ?>"
		<?php if ( is_page_template('page_front-page.php')) : ?>
			<?php echo "style=\"padding-bottom:0px; margin-bottom:0px;\""; ?>
		<?php endif ?>
	>
