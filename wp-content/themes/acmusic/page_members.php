<?php

/*

Template Name: Members

*/
	get_header();
?>

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

<!-- <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['geochart']}]}"></script> -->


	<div id="primary" class="content-area fullwidth">
		<main id="main" class="site-main" role="main">

			<?php
				$query = new WP_Query( array(
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'post_type' 		 			=> 'members',
					'posts_per_page'	  	=> -1,
					'orderby'							=> 'title',
					'order' 							=> 'ASC'
				) );

				// echo"
				// <script>
				// 	var by_country = [];
				// </script>
				// ";

				$by_letter = array();
				// $by_country = array();
				while( $query->have_posts() ) { $query->the_post();
				  global $post;
					$country = get_post_meta( get_the_ID(), 'wpcf-country', true );
					// echo "
					// <script>
					// 	by_country.push('".$country."');
					// </script>
					// ";

					if ( ! isset($by_country[$country]) ) $by_country[$country] = array();
					// var_dump($by_country);


				  $letter = substr(strtolower($post->post_title), 0, 1);
				  if ( ! isset($by_letter[$letter]) ) $by_letter[$letter] = array();
				  $by_letter[$letter][] = $post;
				}

				// echo "
				// <script>
				// 	var result = sortCount(by_country);
				// 	// console.log(result);
				//
				// 	google.setOnLoadCallback(drawRegionsMap);
				//
				// 	function drawRegionsMap() {
				//
				// 		var data = google.visualization.arrayToDataTable(result);
				//
				// 		var options = {
				// 			legend: 'none',
				// 			colorAxis: {colors:['#0054a6','#00b7d2','#eb3740','f4962d','#ea3d96']}};
				//
				// 		var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
				//
				// 		chart.draw(data, options);
				//
				//     function myClickHandler(){
				// 			var selection = chart.getSelection()[0];
				// 			var selection1 = chart.getSelection();
				// 				console.log(data.getValue(selection.row, 0));
				// 				console.log(selection1);
				//     }
				//
				//     google.visualization.events.addListener(chart, 'select', myClickHandler);
				//
				//     chart.draw(data, options);
				// 	}
				//
				// </script>
				// ";

				wp_reset_postdata();


				if ( ! empty( $by_letter ) ) {

				  // ksort($by_letter); // order the array

				  // fill the array with letters have no posts
				  $by_letter = fill_by_letter_array( $by_letter );

					?>
					<div class="page-bar-lg" style="border-color: <?php echo $pcolor ?>;">
					</div>
					<header class="entry-header">
						<?php the_title( '<h1 class="col-md-4 entry-title page-entry-title">', '</h1><p class="col-md-8 entry-description">'. esc_html($pdesc) .'</p>' ); ?>
						<?php
							// echo '<div class="">';
							// display_letters_anchors( array_keys( $by_letter ) );
							// echo '</div>';
						?>
						<div class="">
							<?php echo list_child_pages(); ?>
						</div>
					</header><!-- .entry-header -->
					<!-- <div class="col-sm-12 hidden-xs">
						<div id="regions_div" style="width: 100%; height: 450px;"></div>
					</div> -->

					<!-- overlay color -->
					<script>
						var r = hexToRgb( '<?php echo $pcolor; ?>' ).r;
								g = hexToRgb( '<?php echo $pcolor; ?>' ).g,
								b = hexToRgb( '<?php echo $pcolor; ?>' ).b;
						var backgroundColor = "background-color: rgba(" + r.toString() + ", " + g.toString() + ", " + b.toString() + ", 0.7);";
						// console.log(backgroundColor);
					</script>

					<!-- left -->
					<?php
					echo '<div class="col-sm-6 member-profile-container">';
					$foo = 0;
					foreach( $by_letter as $letter => $posts ) {
					?>
						<?php
						if ( ! empty($posts) ) {
							foreach ( $posts as $post ) {
								$photo = get_post_meta( get_the_ID(), 'wpcf-person-image', true );
								$nation = get_post_meta( get_the_ID(), 'wpcf-country', true );
								$tag = get_post_meta( get_the_ID(), 'wpcf-tag-line', true );
								if ($foo == 0 || $foo % 2 == 0){
									echo '<div class="row">';
								}
								?>
								<div id="member-<?php echo $letter; ?>" class="col-xs-6 member-profile member-letter-group member-<?php echo $letter; ?>-object">
								<?php
								setup_postdata($post);
								// just an example of post output
								$name = get_the_title();
								$names = explode(", ", $name);
								$name = $names[1] . " " . $names[0];

								if ($photo != ''): ?>
									<div class="member-profile-photo-container">
										<img class="member-profile-photo" src="<?php echo esc_url($photo); ?>" alt="<?php echo $name; ?>">
										<script>
											document.write("<a class=\"member-overlay\" href=\"<?php echo get_permalink(); ?>\" style=\""+ backgroundColor +
											"\">");
										</script>
										<a class="member-overlay" href="<?php echo get_permalink(); ?>">
											<p><?php echo $tag; ?></p>
											<p>READ MORE></p>
										</a>
									</div>
									<?php echo '<p><a href="' . get_permalink() . '">' . $name . ', ' . $nation . '</a></p>'; ?>
								<?php endif; ?>
								</div>
								<?php
								if (($foo != 0 && $foo % 2 != 0) && !empty($posts) ){
									echo '</div>';
								}
								if ( empty($posts) ) {
									echo '</div>';
								}
								$foo = $foo + 1;
							}

						} else {

						}
						?>
					<?php
					}
					echo '</div>';
					echo '</div>';
					wp_reset_postdata();
					?>




					<!-- right -->
					<?php
					echo '<div class="col-sm-6 member-list-container">';
					echo '<div class="">';
					display_letters_anchors( array_keys( $by_letter ) );
					echo '</div>';
				  foreach( $by_letter as $letter => $posts ) {
				  ?>
				    <div id="member-<?php echo $letter; ?>" class="member-letter-group member-<?php echo $letter; ?>-object">
				    <?php
						// echo '<h4>'.strtoupper($letter).'</h4>';
				    if ( ! empty($posts) ) {
							echo '<h4>'.strtoupper($letter).'</h4>';
				      foreach ( $posts as $post ) {
				        setup_postdata($post);
				        // just an example of post output
								$name = get_the_title();
								$names = explode(", ", $name);
								$name = $names[1] . " " . $names[0];

				        echo '<p><a href="' . get_permalink() . '">' . $name . '</a></p>';
				      }
				    } else {
				      //  echo '<p>' . __('Sorry, no members here yet!') . '</p>';
				    }
				    ?>
				    </div>
				  <?php
				  }
					echo '</div>';
				  wp_reset_postdata();
				}

			 else {
				get_template_part( 'content', 'none' );
			}
			?>


			<?php wp_reset_query();?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
