<?php

class acmusic_Programs extends WP_Widget {

// constructor
    function acmusic_programs() {
		$widget_ops = array('classname' => 'acmusic_programs_widget', 'description' => __( 'Display your programs in a stylish way.', 'acmusic') );
        parent::WP_Widget(false, $name = __('acmusic FP: Programs', 'acmusic'), $widget_ops);
		$this->alt_option_name = 'acmusic_programs_widget';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

	// widget form creation
	function form($instance) {

	// Check values
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$image_uri = isset( $instance['image_uri'] ) ? esc_url_raw( $instance['image_uri'] ) : '';
		$number    = isset( $instance['number'] ) ? intval( $instance['number'] ) : -1;
		$category   = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$see_all   		= isset( $instance['see_all'] ) ? esc_url_raw( $instance['see_all'] ) : '';
		$see_all_text  	= isset( $instance['see_all_text'] ) ? esc_html( $instance['see_all_text'] ) : '';
	?>

	<p><?php _e('In order to display this widget, you must first add some programs from the dashboard. Add as many as you want and the theme will automatically display them all.', 'acmusic'); ?></p>
	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'acmusic'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

    <?php
        if ( $image_uri != '' ) :
           echo '<p><img class="custom_media_image" src="' . $image_uri . '" style="max-width:100px;" /></p>';
        endif;
    ?>
    <p><label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('[DEPRECATED - Go to Edit Row > Theme > Background image] Upload an image for the background if you want. It will get a parallax effect.', 'acmusic'); ?></label></p>
    <p><input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name('image_uri'); ?>" value="Upload Image" style="margin-top:5px;" /></p>
	<p><input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'image_uri' ); ?>" name="<?php echo $this->get_field_name( 'image_uri' ); ?>" type="text" value="<?php echo $image_uri; ?>" size="3" /></p>
	<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of programs to show (-1 shows all of them):', 'acmusic' ); ?></label>
	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
    <p><label for="<?php echo $this->get_field_id('see_all'); ?>"><?php _e('Enter the URL for your programs page. Useful if you want to show here just a few programs, then send your visitors to a page that uses the programs page template.', 'acmusic'); ?></label>
	<input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'see_all' ); ?>" name="<?php echo $this->get_field_name( 'see_all' ); ?>" type="text" value="<?php echo $see_all; ?>" size="3" /></p>
    <p><label for="<?php echo $this->get_field_id('see_all_text'); ?>"><?php _e('The text for the button [Defaults to <em>See all our programs</em> if left empty]', 'acmusic'); ?></label>
	<input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'see_all_text' ); ?>" name="<?php echo $this->get_field_name( 'see_all_text' ); ?>" type="text" value="<?php echo $see_all_text; ?>" size="3" /></p>

	<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Enter the slug for your category or leave empty to show all programs.', 'acmusic' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo $category; ?>" size="3" /></p>

	<?php
	}

	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
    $instance['image_uri'] = esc_url_raw( $new_instance['image_uri'] );
		$instance['see_all'] 		= esc_url_raw( $new_instance['see_all'] );
		$instance['see_all_text'] 	= strip_tags($new_instance['see_all_text']);
		$instance['category'] = strip_tags($new_instance['category']);

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['acmusic_programs']) )
			delete_option('acmusic_programs');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('acmusic_programs', 'widget');
	}

	// display widget
	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'acmusic_programs', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Current Productions', 'acmusic' );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$image_uri = isset( $instance['image_uri'] ) ? esc_url($instance['image_uri']) : '';
		$see_all = isset( $instance['see_all'] ) ? esc_url($instance['see_all']) : '';
		$see_all_text = isset( $instance['see_all_text'] ) ? esc_html($instance['see_all_text']) : '';
		$number = ( ! empty( $instance['number'] ) ) ? intval( $instance['number'] ) : -1;
		if ( ! $number )
			$number = -1;
		$category = isset( $instance['category'] ) ? esc_attr($instance['category']) : '';

		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'post_type' 		  => 'program',
			'posts_per_page'	  => $number,
			'category_name'		  => $category
		) ) );

		if ($r->have_posts()) :
?>

		<section id="programs" class="programs-area">
      <?php $desc = get_post_meta( get_the_ID(), 'wpcf-description', true ); ?>
			<div class="container">
        <div class="col-md-12 programs-top-border"></div>
        <div class="col-md-12">
          <?php if ( $title ) echo '<div class="title-box col-sm-4"><h2>' . $title . '</h2></div>'; ?>
          <div class="col-sm-8 programs-desc">
            <p><?php echo get_theme_mod('fp_programs_desc'); ?></p>
          </div>
        </div>
				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<?php //Get the custom field values
						$photo = get_post_meta( get_the_ID(), 'wpcf-photo', true );
            $color = get_post_meta( get_the_ID(), 'wpcf-color', true );
					?>
					<div class="program col-md-4 col-sm-6 col-xs-6">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="program-photo wow zoomInDown"><?php the_post_thumbnail('acmusic-programs-thumb'); ?></div>
						<?php endif; ?>
						<h4  style="color: <?php echo $color; ?>"class="program-name wow fadeInUp"><?php the_title(); ?></h4>
						<?php if ($position != '') : ?>
							<span class="program-position wow fadeInUp"><?php echo esc_html($position); ?></span>
						<?php endif; ?>
						<div class="program-desc wow fadeInUp"><?php the_excerpt(); ?></div>
            <a style="background-color: <?php echo $color; ?>" class="program-link-container" href="<?php the_permalink(); ?>">READ ABOUT></a>
            <div style="border-color: <?php echo $color; ?>" class="program-bottom-line"></div>
					</div>
				<?php endwhile; ?>
			</div>
			<?php if ($see_all != '') : ?>
				<a href="<?php echo esc_url($see_all); ?>" class="all-news">
					<?php if ($see_all_text) : ?>
						<?php echo $see_all_text; ?>
					<?php else : ?>
						<?php echo __('See all our programs', 'acmusic'); ?>
					<?php endif; ?>
				</a>
			<?php endif; ?>
		</section>
		<?php if ($image_uri != '') : ?>
			<style type="text/css">
				.programs-area {
			    display: block;
					background: url(<?php echo $image_uri; ?>) no-repeat;
					background-position: center top;
					background-attachment: fixed;
					background-size: cover;
					z-index: -1;
				}
				.program {
					background-color: rgba(0,0,0,0.6);
					border-right: 1px solid #5E5E5E;
				}
				.program:nth-of-type(3),
				.program:nth-of-type(6),
				.program:nth-of-type(7) {
					border-right: 0;
				}
			</style>
		<?php endif; ?>

	<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'acmusic_programs', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

}
