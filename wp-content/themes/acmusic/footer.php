<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package acmusic
 */
?>

	<?php tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>

	<?php tha_footer_before(); ?>

	<footer class="site-footer" role="contentinfo">
		<div class="">
			<div class="container">
				<div class="col-md-12 mc-form-container">
					<?php
						if( function_exists( 'mc4wp_form' ) ) {
								mc4wp_form();
						}
					?>
				</div>
				<!-- The actual html that needs to be placed in the mailchimp plugin -->
				<!-- <p>
					<label>Stay Updated With Our Newsletter: </label>
					<input type="email" id="mc4wp_email" name="EMAIL" class="mc-email" placeholder="email@address.com" required />
					<input type="submit" value="SIGN UP" class="mc-submit"/>
				</p> -->
			</div>
		</div>
		<?php if ( is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) || is_active_sidebar( 'sidebar-5' ) ) : ?>
			<?php get_sidebar('footer'); ?>
		<?php endif; ?>
		<?php tha_footer_top(); ?>
		<div class="site-info container">
		</div><!-- .site-info -->
		<?php tha_footer_bottom(); ?>
	</footer><!-- #colophon -->
	<?php tha_footer_after(); ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
