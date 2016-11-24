<?php
/**
 *
 * @package acmusic
 */
?>

	<div id="sidebar-footer" class="footer-widget-area clearfix" role="complementary">
		<div class="container">
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
				<div class="sidebar-column col-md-12 col-sm-12"> <?php
					dynamic_sidebar( 'sidebar-3');
				?></div> <?php
			}

			?>
		</div>
	</div>
