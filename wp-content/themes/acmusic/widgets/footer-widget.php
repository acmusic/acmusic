<?php

class acmusic_Footer_Widget extends WP_Widget {

// constructor
    function acmusic_footer_widget() {
		$widget_ops = array('classname' => 'acmusic_footer_widget_widget', 'description' => __( 'Display your footer info', 'acmusic') );
        parent::WP_Widget(false, $name = __('acmusic: Footer Widget', 'acmusic'), $widget_ops);
		$this->alt_option_name = 'acmusic_footer_widget';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

	// widget form creation
	function form($instance) {

	// Check values
		$title    = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
    $name     = isset( $instance['name'] ) ? esc_attr( $instance['name'] ) : '';
		$address  = isset( $instance['address'] ) ? esc_html( $instance['address'] ) : '';
		$phone    = isset( $instance['phone'] ) ? esc_html( $instance['phone'] ) : '';
    $email    = isset( $instance['email'] ) ? esc_html( $instance['email'] ) : '';
    $copyright= isset( $instance['copyright'] ) ? esc_html( $instance['copyright'] ) : '';
    $facebook = isset( $instance['facebook'] ) ? esc_html( $instance['facebook'] ) : '';
    $twitter  = isset( $instance['twitter'] ) ? esc_html( $instance['twitter'] ) : '';
	?>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'acmusic'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

  <p><label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Enter your address', 'acmusic' ); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo $address; ?>" size="3" /></p>

	<p><label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Enter your name', 'acmusic' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo $name; ?>" size="3" /></p>

	<p><label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Enter your phone number', 'acmusic' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo $phone; ?>" size="3" /></p>

  <p><label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Enter your email address', 'acmusic' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo $email; ?>" size="3" /></p>

  <p><label for="<?php echo $this->get_field_id( 'copyright' ); ?>"><?php _e( 'Enter the copyright text', 'acmusic' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'copyright' ); ?>" name="<?php echo $this->get_field_name( 'copyright' ); ?>" type="text" value="<?php echo $copyright; ?>" size="3" /></p>

  <p><label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Enter your Facebook URL', 'acmusic' ); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo $facebook; ?>" size="3" /></p>

  <p><label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Enter your Twitter URL', 'acmusic' ); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo $twitter; ?>" size="3" /></p>

	<?php
	}

	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['address'] = strip_tags($new_instance['address']);
    $instance['phone'] = strip_tags($new_instance['phone']);
    $instance['name'] = strip_tags($new_instance['name']);
		$instance['email'] = sanitize_email($new_instance['email']);
    $instance['copyright'] = strip_tags($new_instance['copyright']);
    $instance['facebook'] = strip_tags($new_instance['facebook']);
    $instance['twitter'] = strip_tags($new_instance['twitter']);
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['acmusic_footer_widget']) )
			delete_option('acmusic_footer_widget');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('acmusic_footer_widget', 'widget');
	}

	// display widget
	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'acmusic_footer_widget', 'widget' );
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Contact info', 'acmusic' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
    $address   = isset( $instance['address'] ) ? esc_html( $instance['address'] ) : '';
    $name   = isset( $instance['name'] ) ? esc_html( $instance['name'] ) : '';
		$phone   = isset( $instance['phone'] ) ? esc_html( $instance['phone'] ) : '';
    $email   = isset( $instance['email'] ) ? esc_html( $instance['email'] ) : '';
    $copyright   = isset( $instance['copyright'] ) ? esc_html( $instance['copyright'] ) : '';
    $facebook   = isset( $instance['facebook'] ) ? esc_html( $instance['facebook'] ) : '';
    $twitter   = isset( $instance['twitter'] ) ? esc_html( $instance['twitter'] ) : '';

		echo $before_widget;
?>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-6 footer-widget-left">
    <?php
      if( ($address) ) {
        echo '<div class="contact-address">';
        echo '<a href="'. $address .'>"<p>'. $address . '</p></a>';
        echo '</div>';
      }
      if( ($name) ) {
        echo '<div class="contact-address">';
        echo '<a href="'. $address .'>"<p>'. $name . '</p></a>';
        echo '</div>';
      }
      if( ($phone) ) {
        echo '<div class="contact-phone">';
        echo '<a href="'. $address .'>"<p>'. $phone . '</p></a>';
        echo '</div>';
      }
      if( ($email) ) {
        echo '<div class="contact-email">';
        echo '<p><a href="mailto:' . $email . '">'. __('Contact Us ', 'acmusic') .'</a></p>';
        echo '</div>';
      }
    ?>
  </div>
  <div class="col-md-1 col-sm-1 col-xs-6 footer-social-wrap content-centered">
    <div class="">
      <?php
        if( ($facebook) ) {
          echo '<div class="footer-social-icon">';
          echo '<a href="'. $facebook . '"><i class="fa fa-facebook-square"></i></a>';
          echo '</div>';
        }
        if( ($twitter) ) {
          echo '<div class="footer-social-icon">';
          echo '<a href="'. $twitter . '"><i class="fa fa-twitter-square"></i></a>';
          echo '</div>';
        }
      ?>
    </div>
  </div>
  <div class="col-md-3 col-sm-3 ">
    <?php if ( get_theme_mod('site_logo_reverse') ) : ?>
      <img class="footer-logo" src="<?php echo esc_url( get_theme_mod('site_logo_reverse') ); ?>">
    <?php endif; ?>
  </div>
</div>
<div class="row footer-copyright">
  <?php if( ($copyright) ) {
    echo '<p>' . $copyright . '</p>';
  }
  ?>
</div>
<?php
		echo $after_widget;


		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'acmusic_footer_widget', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

}
