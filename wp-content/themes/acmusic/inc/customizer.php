<?php
/**
 * acmusic Theme Customizer
 *
 * @package acmusic
 */

function acmusic_customize_register( $wp_customize ) {
	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 */
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->remove_control('header_textcolor');

	//Add a class for titles
    class acmusic_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }


	//___General___//
    $wp_customize->add_section(
        'acmusic_general',
        array(
            'title' => __('General', 'acmusic'),
            'priority' => 9,
        )
    );
		//Logo Upload
		$wp_customize->add_setting(
			'site_logo',
			array(
				'default-image' => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
	    $wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'site_logo',
	            array(
	               'label'          => __( 'Upload your logo', 'acmusic' ),
				   	 		 'type' 			=> 'image',
	               'section'        => 'acmusic_general',
	               'settings'       => 'site_logo',
	               'priority' => 9,
	            )
	        )
	    );
	    //Logo size
	    $wp_customize->add_setting(
	        'logo_size',
	        array(
	            'sanitize_callback' => 'absint',
	            'default'           => '100',
	            'transport'         => 'postMessage'
	        )
	    );
	    $wp_customize->add_control( 'logo_size', array(
	        'type'        => 'number',
	        'priority'    => 10,
	        'section'     => 'acmusic_general',
	        'label'       => __('Logo size', 'acmusic'),
	        'description' => __('Menu-content spacing will return to normal after you save &amp; exit the Customizer', 'acmusic'),
	        'input_attrs' => array(
	            'min'   => 10,
	            'max'   => 300,
	            'step'  => 5,
	            'style' => 'margin-bottom: 15px; padding: 15px;',
	        ),
	    ) );
//Reverse Logo Upload
$wp_customize->add_setting(
	'site_logo_reverse',
	array(
		'default-image' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
	$wp_customize->add_control(
			new WP_Customize_Image_Control(
					$wp_customize,
					'site_logo_reverse',
					array(
						 'label'          => __( 'Upload your reserve color logo', 'acmusic' ),
						 'type' 			=> 'image',
						 'section'        => 'acmusic_general',
						 'settings'       => 'site_logo_reverse',
						 'priority' => 9,
					)
			)
	);
	//Favicon Upload
	$wp_customize->add_setting(
		'site_favicon',
		array(
			'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
               'label'          => __( 'Upload your favicon', 'acmusic' ),
			   'type' 			=> 'image',
               'section'        => 'acmusic_general',
               'settings'       => 'site_favicon',
               'priority' => 11,
            )
        )
    );
    //Apple touch icon 144
    $wp_customize->add_setting(
        'apple_touch_144',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_144',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (144x144 pixels)', 'acmusic' ),
               'type'           => 'image',
               'section'        => 'acmusic_general',
               'settings'       => 'apple_touch_144',
               'priority'       => 12,
            )
        )
    );
    //Apple touch icon 114
    $wp_customize->add_setting(
        'apple_touch_114',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_114',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (114x114 pixels)', 'acmusic' ),
               'type'           => 'image',
               'section'        => 'acmusic_general',
               'settings'       => 'apple_touch_114',
               'priority'       => 13,
            )
        )
    );
    //Apple touch icon 72
    $wp_customize->add_setting(
        'apple_touch_72',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_72',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (72x72 pixels)', 'acmusic' ),
               'type'           => 'image',
               'section'        => 'acmusic_general',
               'settings'       => 'apple_touch_72',
               'priority'       => 14,
            )
        )
    );
    //Apple touch icon 57
    $wp_customize->add_setting(
        'apple_touch_57',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_57',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (57x57 pixels)', 'acmusic' ),
               'type'           => 'image',
               'section'        => 'acmusic_general',
               'settings'       => 'apple_touch_57',
               'priority'       => 15,
            )
        )
    );
    //SCroller
	$wp_customize->add_setting(
		'acmusic_scroller',
		array(
			'sanitize_callback' => 'acmusic_sanitize_checkbox',
			'default' => 0,
		)
	);
	$wp_customize->add_control(
		'acmusic_scroller',
		array(
			'type' => 'checkbox',
			'label' => __('Check this box if you want to disable the custom scroller.', 'acmusic'),
			'section' => 'acmusic_general',
            'priority' => 16,
		)
	);
    //Animations
    $wp_customize->add_setting(
        'acmusic_animate',
        array(
            'sanitize_callback' => 'acmusic_sanitize_checkbox',
            'default' => 0,
        )
    );
    $wp_customize->add_control(
        'acmusic_animate',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box if you want to disable the animations.', 'acmusic'),
            'section' => 'acmusic_general',
            'priority' => 17,
        )
    );
    //Sidebar widgets
    $wp_customize->add_setting(
        'sidebar_widgets',
        array(
            'sanitize_callback' => 'acmusic_sanitize_checkbox',
            'default' => 0,
        )
    );
    $wp_customize->add_control(
        'sidebar_widgets',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to hide the sidebar widgets on screen widths below 1024px', 'acmusic'),
            'section' => 'acmusic_general',
            'priority' => 18,
        )
    );
    //Footer widgets
    $wp_customize->add_setting(
        'footer_widgets',
        array(
            'sanitize_callback' => 'acmusic_sanitize_checkbox',
            'default' => 0,
        )
    );
    $wp_customize->add_control(
        'footer_widgets',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to hide the footer widgets on screen widths below 1024px', 'acmusic'),
            'section' => 'acmusic_general',
            'priority' => 19,
        )
    );
    //Search
    $wp_customize->add_setting(
        'toggle_search',
        array(
            'sanitize_callback' => 'acmusic_sanitize_checkbox',
            'default' => 0,
        )
    );
    $wp_customize->add_control(
        'toggle_search',
        array(
            'type' => 'checkbox',
            'label' => __('Activate header search icon?', 'acmusic'),
            'section' => 'acmusic_general',
            'priority' => 20,
        )
    );
    //___Single posts___//
    $wp_customize->add_section(
        'acmusic_singles',
        array(
            'title' => __('Single posts/pages', 'acmusic'),
            'priority' => 13,
        )
    );
    //Single posts
    $wp_customize->add_setting(
        'acmusic_post_img',
        array(
            'sanitize_callback' => 'acmusic_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'acmusic_post_img',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to show featured images on single posts', 'acmusic'),
            'section' => 'acmusic_singles',
        )
    );
    //Pages
    $wp_customize->add_setting(
        'acmusic_page_img',
        array(
            'sanitize_callback' => 'acmusic_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'acmusic_page_img',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to show featured images on pages', 'acmusic'),
            'section' => 'acmusic_singles',
        )
    );
    //Author bio
    $wp_customize->add_setting(
        'author_bio',
        array(
            'sanitize_callback' => 'acmusic_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'author_bio',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to display the author bio on single posts. You can add your author bio and social links on the Users screen in the Your Profile section.', 'acmusic'),
            'section' => 'acmusic_singles',
        )
    );
    //___Blog layout___//
    $wp_customize->add_section(
        'blog_options',
        array(
            'title' => __('Blog options', 'acmusic'),
            'priority' => 12,
            'description' => __('The blog layout can use either small featured images or large featured images. Select your desired option below.', 'acmusic'),

        )
    );
    //Layout
    $wp_customize->add_setting(
        'blog_layout',
        array(
            'default' => 'small-images',
            'sanitize_callback' => 'acmusic_sanitize_layout',
        )
    );

    $wp_customize->add_control(
        'blog_layout',
        array(
            'type' => 'radio',
            'label' => __('Layout', 'solon'),
            'section' => 'blog_options',
            'choices' => array(
                'small-images' => 'Small images',
                'large-images' => 'Large images',
                'masonry'      => 'Masonry (no sidebar)',
                'fullwidth'    => 'Full width (no sidebar)',
            ),
        )
    );
    //Full content posts
    $wp_customize->add_setting(
      'full_content',
      array(
        'sanitize_callback' => 'acmusic_sanitize_checkbox',
        'default' => 0,
      )
    );
    $wp_customize->add_control(
        'full_content',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to display the full content of your posts on the home page.', 'acmusic'),
            'section' => 'blog_options',
            'priority' => 11,
        )
    );
    //Excerpt
    $wp_customize->add_setting(
        'exc_lenght',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
        )
    );
    $wp_customize->add_control( 'exc_lenght', array(
        'type'        => 'number',
        'priority'    => 12,
        'section'     => 'blog_options',
        'label'       => __('Excerpt lenght', 'acmusic'),
        'description' => __('Choose your excerpt length here. Default: 30 words', 'acmusic'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'padding: 15px;',
        ),
    ) );
	//___Welcome area___//
	$wp_customize->add_section(
			'acmusic_header',
			array(
					'title' => __('Welcome Area', 'acmusic'),
					'priority' => 12,
			)
	);
	$wp_customize->add_section(
			'acmusic_fp_programs',
			array(
					'title' => __('FP Programs', 'acmusic'),
					'priority' => 12,
			)
	);
    //Header title
	$wp_customize->add_setting(
	    'header_title',
	    array(
	        'default' => '',
	        'sanitize_callback' => 'acmusic_sanitize_text',
	    )
	);
	$wp_customize->add_control(
	    'header_title',
	    array(
	        'label' => __( 'Welcome title (not the site title)', 'acmusic' ),
	        'section' => 'acmusic_header',
	        'type' => 'text',
	        'priority' => 13
	    )
	);
    //Welcome logo
    $wp_customize->add_setting(
        'header_logo',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'header_logo',
            array(
               'label'          => __( 'Welcome logo. Displayed instead of the welcome title from the previous option.', 'acmusic' ),
               'type'           => 'image',
               'section'        => 'acmusic_header',
               'settings'       => 'header_logo',
               'priority'       => 14,
            )
        )
    );
    //Logo size
    $wp_customize->add_setting(
        'wlogo_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '200',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'wlogo_size', array(
        'type'        => 'number',
        'priority'    => 15,
        'section'     => 'acmusic_header',
        'label'       => __('Welcome logo size', 'acmusic'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 500,
            'step'  => 5,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
   //Header description
	$wp_customize->add_setting(
	    'header_desc',
	    array(
	        'default' => '',
	        'sanitize_callback' => 'acmusic_sanitize_text',
	    )
	);
	$wp_customize->add_control(
	    'header_desc',
	    array(
	        'label' => __( 'Welcome message (not the site description)', 'acmusic' ),
	        'section' => 'acmusic_header',
	        'type' => 'text',
	        'priority' => 16
	    )
	);
	//HEADER 0
   //Header button text
	$wp_customize->add_setting(
	    'header_btn_text',
	    array(
	        'default' => 'explore',
	        'sanitize_callback' => 'acmusic_sanitize_text',
	    )
	);
	$wp_customize->add_control(
	    'header_btn_text',
	    array(
	        'label' => __( 'The text for the explore button', 'acmusic' ),
	        'section' => 'acmusic_header',
	        'type' => 'text',
	        'priority' => 17
	    )
	);
   //Header button link
	$wp_customize->add_setting(
	    'header_btn_link',
	    array(
	        'default' => '#content',
	        'sanitize_callback' => 'esc_url_raw',
	    )
	);
	$wp_customize->add_control(
	    'header_btn_link',
	    array(
	        'label' => __( 'The link for the explore button', 'acmusic' ),
	        'section' => 'acmusic_header',
	        'type' => 'text',
	        'priority' => 18
	    )
	);
	$wp_customize->add_setting(
		'header_btn_clr',
		array(
			'default'			=> '#00b7d2',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'			=> 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_btn_clr',
			array(
				'label' => __('The background color for explore button', 'acmusic'),
				'section' => 'acmusic_header',
				'settings' => 'header_btn_clr',
				'priority' => 19
			)
		)
	);
	//HEADER 1
	//Header button text
 $wp_customize->add_setting(
		 'header_btn_text_1',
		 array(
				 'default' => 'take a class',
				 'sanitize_callback' => 'acmusic_sanitize_text',
		 )
 );
 $wp_customize->add_control(
		 'header_btn_text_1',
		 array(
				 'label' => __( 'The text for button 1', 'acmusic' ),
				 'section' => 'acmusic_header',
				 'type' => 'text',
				 'priority' => 20
		 )
 );
	//Header button link
 $wp_customize->add_setting(
		 'header_btn_link_1',
		 array(
				 'default' => '#',
				 'sanitize_callback' => 'esc_url_raw',
		 )
 );
 $wp_customize->add_control(
		 'header_btn_link_1',
		 array(
				 'label' => __( 'The link for button 1', 'acmusic' ),
				 'section' => 'acmusic_header',
				 'type' => 'text',
				 'priority' => 21
		 )
 );
 $wp_customize->add_setting(
	 'header_btn_clr_1',
	 array(
		 'default'			=> '#ea3d96',
		 'sanitize_callback' => 'sanitize_hex_color',
		 'transport'			=> 'postMessage'
	 )
 );
 $wp_customize->add_control(
	 new WP_Customize_Color_Control(
		 $wp_customize,
		 'header_btn_clr_1',
		 array(
			 'label' => __('The background color for button 1', 'acmusic'),
			 'section' => 'acmusic_header',
			 'settings' => 'header_btn_clr_1',
			 'priority' => 22
		 )
	 )
 );
 //HEADER 2
	 //Header button text
	$wp_customize->add_setting(
			'header_btn_text_2',
			array(
					'default' => 'attend a concert',
					'sanitize_callback' => 'acmusic_sanitize_text',
			)
	);
	$wp_customize->add_control(
			'header_btn_text_2',
			array(
					'label' => __( 'The text for button 2', 'acmusic' ),
					'section' => 'acmusic_header',
					'type' => 'text',
					'priority' => 23
			)
	);
	 //Header button link
	$wp_customize->add_setting(
			'header_btn_link_2',
			array(
					'default' => '#',
					'sanitize_callback' => 'esc_url_raw',
			)
	);
	$wp_customize->add_control(
			'header_btn_link_2',
			array(
					'label' => __( 'The link for button 2', 'acmusic' ),
					'section' => 'acmusic_header',
					'type' => 'text',
					'priority' => 24
			)
	);
	$wp_customize->add_setting(
		'header_btn_clr_2',
		array(
			'default'			=> '#f4962d',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'			=> 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_btn_clr_2',
			array(
				'label' => __('The background color for button 2', 'acmusic'),
				'section' => 'acmusic_header',
				'settings' => 'header_btn_clr_2',
				'priority' => 25
			)
		)
	);
	//HEADER 3
		//Header button text
	 $wp_customize->add_setting(
			 'header_btn_text_3',
			 array(
					 'default' => 'score a film',
					 'sanitize_callback' => 'acmusic_sanitize_text',
			 )
	 );
	 $wp_customize->add_control(
			 'header_btn_text_3',
			 array(
					 'label' => __( 'The text for button 3', 'acmusic' ),
					 'section' => 'acmusic_header',
					 'type' => 'text',
					 'priority' => 26
			 )
	 );
		//Header button link
	 $wp_customize->add_setting(
			 'header_btn_link_3',
			 array(
					 'default' => '#',
					 'sanitize_callback' => 'esc_url_raw',
			 )
	 );
	 $wp_customize->add_control(
			 'header_btn_link_3',
			 array(
					 'label' => __( 'The link for button 3', 'acmusic' ),
					 'section' => 'acmusic_header',
					 'type' => 'text',
					 'priority' => 27
			 )
	 );
	 $wp_customize->add_setting(
		 'header_btn_clr_3',
		 array(
			 'default'			=> '#0054a6',
			 'sanitize_callback' => 'sanitize_hex_color',
			 'transport'			=> 'postMessage'
		 )
	 );
	 $wp_customize->add_control(
		 new WP_Customize_Color_Control(
			 $wp_customize,
			 'header_btn_clr_3',
			 array(
				 'label' => __('The background color for button 3', 'acmusic'),
				 'section' => 'acmusic_header',
				 'settings' => 'header_btn_clr_3',
				 'priority' => 28
			 )
		 )
	 );

 //HEADER 4
	 //Header button text
	 $wp_customize->add_setting(
			'header_btn_text_4',
			array(
					'default' => 'submit your music',
					'sanitize_callback' => 'acmusic_sanitize_text',
			)
	 );
	 $wp_customize->add_control(
			'header_btn_text_4',
			array(
					'label' => __( 'The text for button 4', 'acmusic' ),
					'section' => 'acmusic_header',
					'type' => 'text',
					'priority' => 29
			)
	 );
	 //Header button link
	 $wp_customize->add_setting(
			'header_btn_link_4',
			array(
					'default' => '#',
					'sanitize_callback' => 'esc_url_raw',
			)
	 );
	 $wp_customize->add_control(
			'header_btn_link_4',
			array(
					'label' => __( 'The link for button 4', 'acmusic' ),
					'section' => 'acmusic_header',
					'type' => 'text',
					'priority' => 30
			)
	 );
	 $wp_customize->add_setting(
		'header_btn_clr_4',
		array(
			'default'			=> '#eb3740',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'			=> 'postMessage'
		)
	 );
	 $wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_btn_clr_4',
			array(
				'label' => __('The background color for button 4', 'acmusic'),
				'section' => 'acmusic_header',
				'settings' => 'header_btn_clr_4',
				'priority' => 31
			)
		)
	 );

 //HEADER 5
	 //Header button text
	 $wp_customize->add_setting(
			'header_btn_text_5',
			array(
					'default' => 'watch a video',
					'sanitize_callback' => 'acmusic_sanitize_text',
			)
	 );
	 $wp_customize->add_control(
			'header_btn_text_5',
			array(
					'label' => __( 'The text for button 5', 'acmusic' ),
					'section' => 'acmusic_header',
					'type' => 'text',
					'priority' => 32
			)
	 );
	 //Header button link
	 $wp_customize->add_setting(
			'header_btn_link_5',
			array(
					'default' => '#',
					'sanitize_callback' => 'esc_url_raw',
			)
	 );
	 $wp_customize->add_control(
			'header_btn_link_5',
			array(
					'label' => __( 'The link for button 5', 'acmusic' ),
					'section' => 'acmusic_header',
					'type' => 'text',
					'priority' => 33
			)
	 );
	 $wp_customize->add_setting(
		'header_btn_clr_5',
		array(
			'default'			=> '#ea3d96',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'			=> 'postMessage'
		)
	 );
	 $wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_btn_clr_5',
			array(
				'label' => __('The background color for button 5', 'acmusic'),
				'section' => 'acmusic_header',
				'settings' => 'header_btn_clr_5',
				'priority' => 34
			)
		)
	 );

	//Activate video header
	$wp_customize->add_setting(
			'video_link_toggle',
			array(
					'sanitize_callback' => 'acmusic_sanitize_checkbox',
					'default' => 0,
			)
	);
	$wp_customize->add_control(
			'video_link_toggle',
			array(
					'type' => 'checkbox',
					'label' => __('Check this box if you want to enable the video background.', 'acmusic'),
					'section' => 'acmusic_header',
					'priority' => 35,
			)
	);
	//Header video
 $wp_customize->add_setting(
		 'header_video_link',
		 array(
				 'default' => '',
				 'sanitize_callback' => 'esc_url_raw',
		 )
 );
 $wp_customize->add_control(
		 'header_video_link',
		 array(
				 'label' => __( 'The link for the background video in the header', 'acmusic' ),
				 'section' => 'acmusic_header',
				 'type' => 'text',
				 'priority' => 36
		 )
 );
 //program desc video
 $wp_customize->add_setting(
		'fp_programs_desc',
		array(
				'default' => '',
				'sanitize_callback' => 'acmusic_sanitize_text',
		)
 );
 $wp_customize->add_control(
		'fp_programs_desc',
		array(
				'label' => __( 'The text description for the front page programs section.', 'acmusic' ),
				'section' => 'acmusic_fp_programs',
				'type' => 'text',
				'priority' => 36
		)
 );
    //Activate
    $wp_customize->add_setting(
        'acmusic_banner',
        array(
            'sanitize_callback' => 'acmusic_sanitize_checkbox',
            'default' => 0,
        )
    );
    $wp_customize->add_control(
        'acmusic_banner',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box if you want to disable the header image and text on all pages except the front page.', 'acmusic'),
            'section' => 'acmusic_header',
            'priority' => 37,
        )
    );
    //Title color
    $wp_customize->add_setting(
        'header_title_color',
        array(
            'default'           => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_title_color',
            array(
                'label' => __('Welcome title color', 'acmusic'),
                'section' => 'acmusic_header',
                'settings' => 'header_title_color',
                'priority' => 38
            )
        )
    );
    //Description color
    $wp_customize->add_setting(
        'header_desc_color',
        array(
            'default'           => '#d8d8d8',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_desc_color',
            array(
                'label' => __('Welcome message color', 'acmusic'),
                'section' => 'acmusic_header',
                'settings' => 'header_desc_color',
                'priority' => 39
            )
        )
    );
    //Button
    $wp_customize->add_setting(
        'header_btn_bg',
        array(
            'default'           => '#008082',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_btn_bg',
            array(
                'label' => __('Button background', 'acmusic'),
                'section' => 'acmusic_header',
                'settings' => 'header_btn_bg',
                'priority' => 40
            )
        )
    );
    //Button box shadow
    $wp_customize->add_setting(
        'header_btn_bs',
        array(
            'default'           => '#C2503D',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_btn_bs',
            array(
                'label' => __('Button box shadow', 'acmusic'),
                'section' => 'acmusic_header',
                'settings' => 'header_btn_bs',
                'priority' => 41
            )
        )
    );
    //___Menu___//
    $wp_customize->add_section(
        'acmusic_menu',
        array(
            'title' => __('Menu', 'acmusic'),
            'priority' => 13,
        )
    );
    //Top menu
    $wp_customize->add_setting(
        'acmusic_menu_top',
        array(
            'sanitize_callback' => 'acmusic_sanitize_checkbox',
            'default' => 0,
        )
    );
    $wp_customize->add_control(
        'acmusic_menu_top',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to show the nav bar at top (changes will be visible after you save and exit the Customizer).', 'acmusic'),
            'section' => 'acmusic_menu',
            'priority' => 10,
        )
    );
    //Menu height
    $wp_customize->add_setting(
        'acmusic_menu_height',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '40',
        )
    );
    $wp_customize->add_control( 'acmusic_menu_height', array(
        'type'        => 'number',
        'priority'    => 11,
        'section'     => 'acmusic_menu',
        'label'       => __('Menu bar height', 'acmusic'),
        'description' => __('The 40px default value refers to the top/bottom padding', 'acmusic'),
        'input_attrs' => array(
            'min'   => 5,
            'max'   => 100,
            'step'  => 5,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //Sticky menu height
    $wp_customize->add_setting(
        'acmusic_sticky_height',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '20',
        )
    );
    $wp_customize->add_control( 'acmusic_sticky_height', array(
        'type'        => 'number',
        'priority'    => 12,
        'section'     => 'acmusic_menu',
        'label'       => __('Menu bar height [sticky]', 'acmusic'),
        'description' => __('This option refers to the menu in sticky mode', 'acmusic'),
        'input_attrs' => array(
            'min'   => 5,
            'max'   => 100,
            'step'  => 5,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //Unsticky menu
    $wp_customize->add_setting(
        'acmusic_menu_sticky',
        array(
            'sanitize_callback' => 'acmusic_sanitize_checkbox',
            'default' => 0,
        )
    );
    $wp_customize->add_control(
        'acmusic_menu_sticky',
        array(
            'type' => 'checkbox',
            'label' => __('Stop the nav bar from being sticky?', 'acmusic'),
            'section' => 'acmusic_menu',
            'priority' => 12,
        )
    );

    //___Colors___//

    $wp_customize->get_section( 'colors' )->description = __('Not all of the color settings found in this section apply to the front page.', 'acmusic');

    //color palette
		$wp_customize->add_setting(
        'color_1',
        array(
            'default'           => '#0054a6',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'color_1',
            array(
                'label' => __('Color 1', 'acmusic'),
                'section' => 'colors',
                'settings' => 'color_1',
                'priority' => 11
            )
        )
    );
		$wp_customize->add_setting(
				'color_2',
				array(
						'default'           => '#00b7d2',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'         => 'postMessage'
				)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'color_2',
						array(
								'label' => __('Color 2', 'acmusic'),
								'section' => 'colors',
								'settings' => 'color_2',
								'priority' => 12
						)
				)
		);
		$wp_customize->add_setting(
				'color_3',
				array(
						'default'           => '#eb3740',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'         => 'postMessage'
				)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'color_3',
						array(
								'label' => __('Color 3', 'acmusic'),
								'section' => 'colors',
								'settings' => 'color_3',
								'priority' => 13
						)
				)
		);
		$wp_customize->add_setting(
				'color_4',
				array(
						'default'           => '#f4962d',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'         => 'postMessage'
				)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'color_4',
						array(
								'label' => __('Color 4', 'acmusic'),
								'section' => 'colors',
								'settings' => 'color_4',
								'priority' => 14
						)
				)
		);
		$wp_customize->add_setting(
				'color_5',
				array(
						'default'           => '#ea3d96',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'         => 'postMessage'
				)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'color_5',
						array(
								'label' => __('Color 5', 'acmusic'),
								'section' => 'colors',
								'settings' => 'color_5',
								'priority' => 15
						)
				)
		);
		$wp_customize->add_setting(
				'member_profile_clr',
				array(
						'default'           => '#0054a6',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'         => 'postMessage'
				)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'member_profile_clr',
						array(
								'label' => __('Composer Member Profile Color', 'acmusic'),
								'section' => 'colors',
								'settings' => 'member_profile_clr',
								'priority' => 16
						)
				)
		);
		$wp_customize->add_setting(
				'teacher_profile_clr',
				array(
						'default'           => '#00b7d2',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'         => 'postMessage'
				)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'teacher_profile_clr',
						array(
								'label' => __('Teacher Profile Color', 'acmusic'),
								'section' => 'colors',
								'settings' => 'teacher_profile_clr',
								'priority' => 16
						)
				)
		);
		$wp_customize->add_setting(
				'program_clr',
				array(
						'default'           => '#ea3d96',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'         => 'postMessage'
				)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'program_clr',
						array(
								'label' => __('Program Individual Post Color', 'acmusic'),
								'section' => 'colors',
								'settings' => 'program_clr',
								'priority' => 17
						)
				)
		);
		$wp_customize->add_setting(
				'general_post_clr',
				array(
						'default'           => '#00b7d2',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'         => 'postMessage'
				)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'general_post_clr',
						array(
								'label' => __('General Individual Post Color', 'acmusic'),
								'section' => 'colors',
								'settings' => 'general_post_clr',
								'priority' => 18
						)
				)
		);
    //Menu links

    //___Fonts___//
    $wp_customize->add_section(
        'acmusic_typography',
        array(
            'title' => __('Fonts', 'acmusic' ),
            'priority' => 15,
        )
    );
    $font_choices =
        array(
            'Source+Sans+Pro:400,700,400italic,700italic' => 'Source Sans Pro',
            'Droid+Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
            'PT+Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT+Sans+Narrow:400,700' => 'PT Sans Narrow',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid+Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Open+Sans:400italic,700italic,400,700' => 'Open Sans',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Oswald:400,700' => 'Oswald',
            'Open+Sans+Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto+Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Raleway:400,700' => 'Raleway',
            'Roboto+Slab:400,700' => 'Roboto Slab',
            'Yanone+Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
        );

    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'acmusic_sanitize_fonts',
        )
    );

    $wp_customize->add_control(
        'headings_fonts',
        array(
            'type' => 'select',
            'label' => __('Select your desired font for the headings.', 'acmusic'),
            'section' => 'acmusic_typography',
            'choices' => $font_choices
        )
    );

    $wp_customize->add_setting(
        'body_fonts',
        array(
            'sanitize_callback' => 'acmusic_sanitize_fonts',
        )
    );

    $wp_customize->add_control(
        'body_fonts',
        array(
            'type' => 'select',
            'label' => __('Select your desired font for the body.', 'acmusic'),
            'section' => 'acmusic_typography',
            'choices' => $font_choices
        )
    );
    //H1 size
    $wp_customize->add_setting(
        'h1_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '36',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h1_size', array(
        'type'        => 'number',
        'priority'    => 11,
        'section'     => 'acmusic_typography',
        'label'       => __('H1 font size', 'acmusic'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //H2 size
    $wp_customize->add_setting(
        'h2_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h2_size', array(
        'type'        => 'number',
        'priority'    => 12,
        'section'     => 'acmusic_typography',
        'label'       => __('H2 font size', 'acmusic'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //H3 size
    $wp_customize->add_setting(
        'h3_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '24',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h3_size', array(
        'type'        => 'number',
        'priority'    => 13,
        'section'     => 'acmusic_typography',
        'label'       => __('H3 font size', 'acmusic'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //h4 size
    $wp_customize->add_setting(
        'h4_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h4_size', array(
        'type'        => 'number',
        'priority'    => 14,
        'section'     => 'acmusic_typography',
        'label'       => __('H4 font size', 'acmusic'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //h5 size
    $wp_customize->add_setting(
        'h5_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h5_size', array(
        'type'        => 'number',
        'priority'    => 15,
        'section'     => 'acmusic_typography',
        'label'       => __('H5 font size', 'acmusic'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //h6 size
    $wp_customize->add_setting(
        'h6_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '12',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h6_size', array(
        'type'        => 'number',
        'priority'    => 16,
        'section'     => 'acmusic_typography',
        'label'       => __('H6 font size', 'acmusic'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //body
    $wp_customize->add_setting(
        'body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'body_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'acmusic_typography',
        'label'       => __('Body font size', 'acmusic'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 24,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //Home page widget titles size
    $wp_customize->add_setting(
        'widget_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '56',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'widget_title_size', array(
        'type'        => 'number',
        'priority'    => 18,
        'section'     => 'acmusic_typography',
        'label'       => __('Home page widget titles size', 'acmusic'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //Menu links font size
    $wp_customize->add_setting(
        'menu_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'menu_size', array(
        'type'        => 'number',
        'priority'    => 19,
        'section'     => 'acmusic_typography',
        'label'       => __('Menu links font size', 'acmusic'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 30,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //___Extensions___//
    // $wp_customize->add_section(
    //     'acmusic_extensions',
    //     array(
    //         'title' => __('Extensions', 'acmusic'),
    //         'priority' => 99,
    //         'description' => __('A growing collection of free extensions for acmusic is available ', 'acmusic') . '<a href="http://athemes.com/acmusic-extensions">here</a>',
    //     )
    // );
    //Extensions
    $wp_customize->add_setting('acmusic_options[info]', array(
            'sanitize_callback' => 'acmusic_no_sanitize',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new acmusic_Info( $wp_customize, 'extensions', array(
        'section' => 'acmusic_extensions',
        'settings' => 'acmusic_options[info]',
        'priority' => 10
        ) )
    );
		//___Secondary-page header image___//
    $wp_customize->add_setting(
        'secondary_header',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'secondary_header',
            array(
               'label'          => __( 'Secondary pages header image', 'acmusic' ),
               'type'           => 'image',
               'section'        => 'header_image',
               'settings'       => 'secondary_header',
               'description'    => __( 'This is the image that will appear above the content all of the child pages. Select and image that is very wide and not very tall. The space is limited at 250px high and 1140px wide. Anything within that ratio will do, preferable of those pixel dimensions or slightly higher.' ),
               'priority'       => 10,
            )
        )
    );
		//___Mobile header image___//
    $wp_customize->add_setting(
        'mobile_header',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'mobile_header',
            array(
               'label'          => __( 'Small screens header image', 'acmusic' ),
               'type'           => 'image',
               'section'        => 'header_image',
               'settings'       => 'mobile_header',
               'description'    => __( 'You can add below a smaller version of your header image and it will be displayed at screen widths below 1024px. This is important in case iPhones don\'t display your header image because of it being too big. You can also add a completely different image if you want, in case you have one that will look better on small screens. Recommended width: 1024px', 'acmusic' ),
               'priority'       => 10,
            )
        )
    );
    //Background-size
    $wp_customize->add_setting(
        'header_bg_size',
        array(
            'default' => 'cover',
            'sanitize_callback' => 'acmusic_sanitize_bg_size',
        )
    );
    $wp_customize->add_control(
        'header_bg_size',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Header background size', 'acmusic'),
            'section' => 'header_image',
            'choices' => array(
                'cover'     => __('Cover', 'acmusic'),
                'contain'   => __('Contain', 'acmusic'),
            ),
        )
    );
    //Header max height 1199
    $wp_customize->add_setting(
        'header_max_height_1199',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '1440',
        )
    );
    $wp_customize->add_control( 'header_max_height_1199', array(
        'type'        => 'number',
        'priority'    => 11,
        'section'     => 'header_image',
        'label'       => __('Header max height > 1199px', 'acmusic'),
        'description' => __('Max height for the header at screen widths above 1199px', 'acmusic'),
        'input_attrs' => array(
            'min'   => 200,
            'max'   => 1440,
            'step'  => 5,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //Header max height 1025
    $wp_customize->add_setting(
        'header_max_height_1025',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '1440',
        )
    );
    $wp_customize->add_control( 'header_max_height_1025', array(
        'type'        => 'number',
        'priority'    => 12,
        'section'     => 'header_image',
        'label'       => __('Header max height > 1024px', 'acmusic'),
        'description' => __('Max height for the header at screen widths above 1024px', 'acmusic'),
        'input_attrs' => array(
            'min'   => 200,
            'max'   => 1440,
            'step'  => 5,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //Welcome info top offset 1199
    $wp_customize->add_setting(
        'welcome_info_offset_1199',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '100',
        )
    );
    $wp_customize->add_control( 'welcome_info_offset_1199', array(
        'type'        => 'number',
        'priority'    => 13,
        'section'     => 'header_image',
        'label'       => __('Welcome info offset top > 1199px', 'acmusic'),
        'description' => __('Offset at screen widths above 1199px', 'acmusic'),
        'input_attrs' => array(
            'min'   => 0,
            'max'   => 300,
            'step'  => 5,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
    //Welcome info top offset 991
    $wp_customize->add_setting(
        'welcome_info_offset_991',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '100',
        )
    );
    $wp_customize->add_control( 'welcome_info_offset_991', array(
        'type'        => 'number',
        'priority'    => 13,
        'section'     => 'header_image',
        'label'       => __('Welcome info offset top > 991px', 'acmusic'),
        'description' => __('Offset at screen widths above 991px', 'acmusic'),
        'input_attrs' => array(
            'min'   => 0,
            'max'   => 300,
            'step'  => 5,
            'style' => 'margin-bottom: 15px; padding: 15px;',
        ),
    ) );
}
add_action( 'customize_register', 'acmusic_customize_register' );

/**
 * Sanitization
 */
//Checkboxes
function acmusic_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}
//Integers
function acmusic_sanitize_int( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}
//Text
function acmusic_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//Fonts
function acmusic_sanitize_fonts( $input ) {
    $valid = array(
            'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT+Sans+Narrow:400,700' => 'PT Sans Narrow',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Open+Sans:400italic,700italic,400,700' => 'Open Sans',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Oswald:400,700' => 'Oswald',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Raleway:400,700' => 'Raleway',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Blog layout
function acmusic_sanitize_layout( $input ) {
    $valid = array(
        'small-images' => 'Small images',
        'large-images' => 'Large images',
        'masonry'      => 'Masonry (no sidebar)',
        'fullwidth'    => 'Full width (no sidebar)',
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Background size
function acmusic_sanitize_bg_size( $input ) {
    $valid = array(
        'cover'     => __('Cover', 'acmusic'),
        'contain'   => __('Contain', 'acmusic'),
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//No sanitize - empty function for options that do not require sanitization -> to bypass the Theme Check plugin
function acmusic_no_sanitize( $input ) {
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function acmusic_customize_preview_js() {
	wp_enqueue_script( 'acmusic_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), true );
}
add_action( 'customize_preview_init', 'acmusic_customize_preview_js' );
