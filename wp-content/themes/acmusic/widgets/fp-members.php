<?php

class acmusic_Members extends WP_Widget {

// constructor
    function acmusic_members() {
		$widget_ops = array('classname' => 'acmusic_members_widget', 'description' => __( 'Display member information.', 'acmusic') );
        parent::WP_Widget(false, $name = __('acmusic FP: Members', 'acmusic'), $widget_ops);
		$this->alt_option_name = 'acmusic_members_widget';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

	// widget form creation
	function form($instance) {

	// Check values
		$title     		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$image_uri 		= isset( $instance['image_uri'] ) ? esc_url_raw( $instance['image_uri'] ) : '';
		$number    		= isset( $instance['number'] ) ? intval( $instance['number'] ) : -1;
		$category   	= isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$see_all   		= isset( $instance['see_all'] ) ? esc_url_raw( $instance['see_all'] ) : '';
		$see_all_text  	= isset( $instance['see_all_text'] ) ? esc_html( $instance['see_all_text'] ) : '';
		$random 		= isset( $instance['random'] ) ? (bool) $instance['random'] : false;
	?>

	<p><?php _e('In order to display this widget, you must first add some members from the dashboard. Add as many as you want and the theme will automatically display them all.', 'acmusic'); ?></p>

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
	<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of members to show (-1 shows all of them):', 'acmusic' ); ?></label>
	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
    <p><label for="<?php echo $this->get_field_id('see_all'); ?>"><?php _e('Enter the URL for your members page. Useful if you want to show here just a few members, then send your visitors to a page that uses the members page template.', 'acmusic'); ?></label>
	<input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'see_all' ); ?>" name="<?php echo $this->get_field_name( 'see_all' ); ?>" type="text" value="<?php echo $see_all; ?>" size="3" /></p>
    <p><label for="<?php echo $this->get_field_id('see_all_text'); ?>"><?php _e('The text for the button [Defaults to <em>See all our members</em> if left empty]', 'acmusic'); ?></label>
	<input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'see_all_text' ); ?>" name="<?php echo $this->get_field_name( 'see_all_text' ); ?>" type="text" value="<?php echo $see_all_text; ?>" size="3" /></p>
	<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Enter the slug for your category or leave empty to show all members.', 'acmusic' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo $category; ?>" size="3" /></p>
	<p><input class="checkbox" type="checkbox" <?php checked( $random ); ?> id="<?php echo $this->get_field_id( 'random' ); ?>" name="<?php echo $this->get_field_name( 'random' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'random' ); ?>"><?php _e( 'Show random members?', 'acmusic' ); ?></label></p>

	<?php
	}

	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['number'] 		= strip_tags($new_instance['number']);
	  $instance['image_uri'] 		= esc_url_raw( $new_instance['image_uri'] );
		$instance['see_all'] 		= esc_url_raw( $new_instance['see_all'] );
		$instance['see_all_text'] 	= strip_tags($new_instance['see_all_text']);
		$instance['category'] 		= strip_tags($new_instance['category']);
		$instance['random'] 		= isset( $new_instance['random'] ) ? (bool) $new_instance['random'] : false;

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['acmusic_members']) )
			delete_option('acmusic_members');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('acmusic_members', 'widget');
	}

	// display widget
	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'acmusic_members', 'widget' );
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'What our members say', 'acmusic' );

		$title 			= apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$image_uri 		= isset( $instance['image_uri'] ) ? esc_url($instance['image_uri']) : '';
		$see_all 		= isset( $instance['see_all'] ) ? esc_url($instance['see_all']) : '';
		$see_all_text 	= isset( $instance['see_all_text'] ) ? esc_html($instance['see_all_text']) : '';
		$number 		= ( ! empty( $instance['number'] ) ) ? intval( $instance['number'] ) : -1;
		if ( ! $number ) {
			$number = -1;
		}
		$category 		= isset( $instance['category'] ) ? esc_attr($instance['category']) : '';
		$random 		= isset( $instance['random'] ) ? (bool) $instance['random'] : false;
		if ( $random ) {
			$random = 'rand';
		} else {
			$random = 'date';
		}

		$r = new WP_Query(array(
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'post_type' 		  => 'members',
			'posts_per_page'	  => $number,
			'category_name'		  => $category,
			'orderby'        	  => 'rand'
		) );

		if ($r->have_posts()) :
?>
		<section id="members" class="members-area hidden-sm hidden-xs">

      <div class="x">
        <?php $person_main = '1'; ?>
        <?php $person_num = '1'; ?>
        <?php $person_des = '1'; ?>
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
          <?php $photo = get_post_meta( get_the_ID(), 'wpcf-person-image', true ); ?>
          <?php
            $name = get_the_title();
            $names = explode(", ", $name);
            $name = $names[1] . " " . $names[0];
          ?>
          <?php $content = get_the_content(); ?>
          <div class="y
            <?php
              echo 'person-' . $person_main;
              $person_main = $person_main + 1;
            ?>
          ">
            <?php if ($photo != '') : ?>
            <img class="z
              <?php
                echo 'person-' . $person_num;
                $person_num = $person_num + 1;
              ?>
            " src="<?php echo esc_url($photo); ?>" alt="<?php the_title(); ?>" />
            <span class="img-description-wrap
              <?php
                echo 'person-' . $person_des;
                $person_des = $person_des + 1;
              ?>
            "><span class="img-description"><?php echo $name; ?></span></span>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>

      <div class="bio-wrap">
        <?php $person_num = '1'; ?>
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
          <?php
            $name = get_the_title();
            $names = explode(", ", $name);
            $name = $names[1] . " " . $names[0];
          ?>
          <?php $vimeo = get_post_meta( get_the_ID(), 'wpcf-vimeo', true ); ?>
          <div class="container member-bio
          <?php
            echo 'person-bio-' . $person_num;
            $person_num = $person_num + 1;
          ?>">
            <div class="col-md-10 col-centered col-sm-12 col-centered bio">
              <h1><a href="<?php the_permalink(); ?>" title="<?php echo $name; ?>"><?php echo $name; ?></a></h1>
              <p><?php the_excerpt(); ?></p>
            </div>
            <div class="col-md-6 col-centered bio-vimeo">
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
        <?php endwhile ?>
      </div>

		<?php if ($image_uri != '') : ?>
			<style type="text/css">
				.members-area {
				  display: block;
					background: url(<?php echo $image_uri; ?>) no-repeat;
					background-position: center top;
					background-attachment: fixed;
					background-size: cover;
					z-index: -1;
				}
			</style>
		<?php endif; ?>
		</section>
	<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'acmusic_members', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

}
