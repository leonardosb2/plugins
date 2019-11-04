<?php

/* Custom theme Settings */
add_action( 'customize_register', 'custom_settings_fibermaze' );
function custom_settings_fibermaze($wp_customize){
	// Create custom panel.
	$wp_customize->add_panel( 'socials', array(
		'priority'       => 500,
		'theme_supports' => '',
		'title'          => __( 'Child Theme Settings', 'genesis-child' ),
		'description'    => __( 'Set editable text for certain content.', 'genesis-child' ),
	) );
	// Add Footer Text
	// Add section.
	$wp_customize->add_section( 'footer_background' , array(
		'title'    => __('Footer Background','magazine-pro'),
		'panel'    => 'socials',
		'priority' => 12
	) );
	$wp_customize->add_setting( 'footer_bg_url', array(
		 'default' => '',
		 'type' => 'theme_mod'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_bg2_url', array(
        'label' => 'Footer background Image',
        'settings'  => 'footer_bg_url',
        'section'   => 'footer_background'
    ) ));

	$wp_customize->add_section( 'custom_socials' , array(
		'title'    => __('Socials URLs','magazine-pro'),
		'panel'    => 'socials',
		'priority' => 10
	) );
	// Add setting
	$wp_customize->add_setting( 'facebook_url', array(
		 'default'           => '',
		 'type' => 'theme_mod'
	) );
	$wp_customize->add_setting( 'google_url', array(
		 'default'           => '',
		 'type' => 'theme_mod'
	) );
	$wp_customize->add_setting( 'twitter_url', array(
		 'default'           => '',
		 'type' => 'theme_mod'
	) );
	$wp_customize->add_setting( 'youtube_url', array(
		 'default'           => '',
		 'type' => 'theme_mod'
	) );


	$wp_customize->add_section( 'footer_copy' , array(
		'title'    => __('Footer Site Info','magazine-pro'),
		'panel'    => 'socials',
		'priority' => 10
	) );
	$wp_customize->add_setting( 'footer_copy_i', array(
		 'default'           => '',
		 'type' => 'theme_mod'
	) );
	// Add control
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'facebook_url',
		    array(
		        'label'    => __( 'Facebook URL2', 'magazine-pro' ),
		        'section'  => 'custom_socials',
		        'settings' => 'facebook_url',
		        'type'     => 'text'
		    )
	    )
	);
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'twitter_url',
		    array(
		        'label'    => __( 'Twitter URL', 'magazine-pro' ),
		        'section'  => 'custom_socials',
		        'settings' => 'twitter_url',
		        'type'     => 'text'
		    )
	    )
	);
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'google_url',
		    array(
		        'label'    => __( 'Instagram URL', 'magazine-pro' ),
		        'section'  => 'custom_socials',
		        'settings' => 'google_url',
		        'type'     => 'text'
		    )
	    )
	);
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'instagram_url',
		    array(
		        'label'    => __( 'Instagram URL', 'magazine-pro' ),
		        'section'  => 'custom_socials',
		        'settings' => 'instagram_url',
		        'type'     => 'text'
		    )
	    )
	);

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'footer_copy_i',
		    array(
		        'label'    => __( 'Footer Copyright', 'magazine-pro' ),
		        'section'  => 'footer_copy',
		        'settings' => 'footer_copy_i',
		        'type'     => 'text'
		    )
	    )
	);
	// Sanitize text
	function sanitize_text( $text ) {
	    return sanitize_text_field( $text );
	}
}


add_theme_support( 'custom-header', array(
    'header_image'    => '',
    'header-selector' => '.site-title a',
    'header-text'     => false,
    'height'          => 50,
    'width'           => 197,
) );

/* Header Title */
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

/* footer Copyright  */
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action('genesis_footer','yourtheme_footer_widget');
// Position the Footer Area
function yourtheme_footer_widget() {
		echo '<div class="footer-copyright">';
			echo '<div class="footercontainer-area">';
				echo '<div class="footercontent2">';
					echo '<h3 class="widgettitle widget-title"></h3>';
					echo '<div class="textwidget">';
						$f_copy = get_theme_mod('footer_copy_i') ? get_theme_mod('footer_copy_i') : '';
						if ($f_copy) {
							echo '<p>'.$f_copy.'</p>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}