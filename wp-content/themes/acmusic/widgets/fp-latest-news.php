<?php

class acmusic_Latest_News extends WP_Widget {

// constructor
    function acmusic_latest_news() {
		$widget_ops = array('classname' => 'acmusic_latest_news_widget', 'description' => __( 'Show the latest news from your blog.', 'acmusic') );
        parent::WP_Widget(false, $name = __('acmusic FP: Latest News', 'acmusic'), $widget_ops);
		$this->alt_option_name = 'acmusic_latest_news_widget';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

	// widget form creation
	function form($instance) {

	// Check values
		$title     		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$category  		= isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$number    		= isset( $instance['number'] ) ? intval( $instance['number'] ) : 3;
		$see_all_text  	= isset( $instance['see_all_text'] ) ? esc_html( $instance['see_all_text'] ) : '';
		$image_uri 		= isset( $instance['image_uri'] ) ? esc_url_raw( $instance['image_uri'] ) : '';
	?>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'acmusic'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Enter the slug for your category or leave empty to show posts from all categories.', 'acmusic' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo $category; ?>" size="3" /></p>

    <p><label for="<?php echo $this->get_field_id('see_all_text'); ?>"><?php _e('Add the text for the button here if you want to change the default <em>See all our news</em>', 'acmusic'); ?></label>
	<input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'see_all_text' ); ?>" name="<?php echo $this->get_field_name( 'see_all_text' ); ?>" type="text" value="<?php echo $see_all_text; ?>" size="3" /></p>

	<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'acmusic' ); ?></label>
	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

    <?php
        if ( $image_uri != '' ) :
           echo '<p><img class="custom_media_image" src="' . $image_uri . '" style="max-width:100px;" /></p>';
        endif;
    ?>
    <p><label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('[DEPRECATED - Go to Edit Row > Theme > Background image] Upload an image for the background if you want. It will get a parallax effect.', 'acmusic'); ?></label></p>
    <p><input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name('image_uri'); ?>" value="Upload Image" style="margin-top:5px;" /></p>
	<p><input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'image_uri' ); ?>" name="<?php echo $this->get_field_name( 'image_uri' ); ?>" type="text" value="<?php echo $image_uri; ?>" size="3" /></p>

	<?php
	}

	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['category'] 		= strip_tags($new_instance['category']);
		$instance['number'] 		= strip_tags($new_instance['number']);
		$instance['see_all_text'] 	= strip_tags($new_instance['see_all_text']);
	  $instance['image_uri'] 		= esc_url_raw( $new_instance['image_uri'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['acmusic_latest_news']) )
			delete_option('acmusic_latest_news');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('acmusic_latest_news', 'widget');
	}

	// display widget
	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'acmusic_latest_news', 'widget' );
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Latest news', 'acmusic' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$category = isset( $instance['category'] ) ? esc_attr($instance['category']) : '';
		$see_all_text = isset( $instance['see_all_text'] ) ? esc_html($instance['see_all_text']) : __( 'See all our news', 'acmusic' );
		$number = ( ! empty( $instance['number'] ) ) ? intval( $instance['number'] ) : 3;
		if ( ! $number )
			$number = 3;
		$image_uri = isset( $instance['image_uri'] ) ? esc_url($instance['image_uri']) : '';

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
     $r = new WP_Query( apply_filters( 'widget_posts_args', array(
 			'no_found_rows'       => true,
 			'post_status'         => 'publish',
 			'posts_per_page'	  => 3,
 			'category_name'		  => $category
 		) ) );

    $q = new WP_Query( apply_filters( 'widget_posts_args', array(
      'no_found_rows'       => true,
      'post_status'         => 'publish',
      'posts_per_page'	  => 1,
      'category_name'		  => $categsry,
      'post_type' 		  => 'featured-post'
    ) ) );

    $s = new WP_Query( apply_filters( 'widget_posts_args', array(
      'no_found_rows'       => true,
      'post_status'         => 'publish',
      'posts_per_page'	  => 1,
      'category_name'		  => $category,
      'post_type' 		  => 'about-post'
    ) ) );

    function strip_vimeo($video_link){
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
      $content_html .= '<div class="vimeo-article"><iframe src="https://player.vimeo.com/video/'.$id.'?title=1&amp;byline=1&amp;portrait=0&amp;badge=0&amp;color='.$color.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
    }

		if ($r->have_posts()) :
?>
		<section id="latest-news" class="latest-news-area">
			<div class="container">
        <div class="col-md-6 clearfix">
          <div class="news-feed">
            <div class="col-md-12 title-box">
              <h2>NEWS FEED</h2>
            </div>
  					<?php while ( $r->have_posts() ) : $r->the_post(); ?>
						<div class="blog-post row">
							<div class="entry-thumb wow fadeInDown col-md-6">
                <?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
										<?php the_post_thumbnail('acmusic-news-thumb'); ?>
									</a>
                <?php endif; ?>
							</div>
              <div class="col-md-6">
                <div class="entry-date-container">
                  <h5 class="entry-date"><i>
                    <?php
                      echo get_the_date();
                    ?></i></h5>
                </div>
                <div class="">
    							<?php the_title( sprintf( '<h4 class="entry-title"><strong><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></strong></h4>' ); ?>
    							<div class="entry-more wow fadeInUp"><?php echo '<a href="' . esc_url( get_permalink() ) . '">READ MORE></a>'; ?></div>
                </div>
              </div>
						</div>
  					<?php endwhile; ?>
            <div class="row">
      				<?php $cat = get_term_by('slug', $category, 'category') ?>
      				<?php if ($category) : //Link to the category page instead of blog page if a category is selected ?>
      				<a href="<?php echo esc_url(get_category_link(get_cat_ID($cat -> name))); ?>" class="all-news">
      				<?php else : ?>
      				<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="all-news">
      				<?php endif; ?>
      					<?php if (!$see_all_text) : ?>
      						<?php echo __( 'See all our news', 'acmusic' ); ?>
      					<?php else : ?>
      						<?php echo $see_all_text; ?>
      					<?php endif; ?>
      				</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 clearfix">
          <div class="latest-top row col-container">
            <?php if($s->have_posts()) : ?>
              <?php while ( $s->have_posts() ) : $s->the_post(); ?>
                <?php $vimeo = get_post_meta( get_the_ID(), 'wpcf-vimeo', true ); ?>
                <div class="about-acm">
                  <div class="row">
                    <div class="col-md-6">
                      <?php if($vimeo):
                        $url = esc_url($vimeo);
                        preg_match(
                              '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',
                              $url,
                              $matches
                          );
                        $id = $matches[2];
                        $width = 'auto';
                        $height = '260';
                        $color = '#ffffff';
                        echo '<iframe src="https://player.vimeo.com/video/'.$id.'?title=1&amp;byline=1&amp;portrait=0&amp;badge=0&amp;color='.$color.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                      endif ?>
                    </div>
                    <div class="fp-content-col col-md-6">
                      <div class="title-box col-md-12">
                        <h2 class="">ABOUT ACM</h2>
                      </div>
                      <div class="entry-summary wow fadeInUp"><?php the_excerpt(); echo '<a class="entry-more" href="about/">READ MORE></a>'; ?></div>
                    </div>
                  </div>
                </div>
              <?php endwhile ?>
            <?php endif ?>
            <?php if($q->have_posts()) : ?>
              <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                <?php $thumb = get_post_meta( get_the_ID(), 'wpcf-featured-post-thumbnail', true ); ?>
                  <div class="featured-post">
                    <div class="row">
                      <?php if ( has_post_thumbnail() ) : ?>
                        <div class="col-md-6 featured-post-thumbnail">
                          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
                            <div class="program-photo wow zoomInDown"><?php the_post_thumbnail('acmusic-programs-thumb'); ?></div>
                          </a>
                        </div>
                        <div class="fp-content-col col-md-6">
                          <div class="title-box col-md-12">
                            <h2 class="">Featured Project</h2>
                          </div>
                          <?php the_title( sprintf( '<h4 class="entry-title"><strong><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></strong></h4>' ); ?>
                          <div class="entry-summary wow fadeInUp"><?php the_excerpt(); echo '<a class="entry-more" href="' . esc_url( get_permalink() ) . '">READ MORE></a>'; ?></div>
                        </div>
                      <?php endif ?>
                    </div>
                  </div>
                <?php endwhile ?>
              <?php endif ?>
            </div>
          </div>
        </div>
		<?php if ($image_uri != '') : ?>
			<style type="text/css">
				.latest-news-area {
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
			wp_cache_set( 'acmusic_latest_news', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

}
