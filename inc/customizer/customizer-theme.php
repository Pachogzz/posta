<?php
/**
 * posta Theme Customizer
 *
 * @package posta
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function posta_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'posta_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'posta_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'posta_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function posta_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function posta_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function posta_customize_preview_js() {
	wp_enqueue_script( 'posta-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'posta_customize_preview_js' );

// Opciones para las noticias
function posta_news_customize_register($wp_customize){

  $wp_customize->add_section('news_settings', array(
		'title' => 'Opciones para las noticias',
		'priority' => 60
  ));
  
  // Agregar imagen por defecto en noticias
	$wp_customize->add_setting('default_news_image', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Upload_Control(
		$wp_customize,
		'default_news_image',
		array(
			'label'       => 'Imagen por defecto de una noticia',
			'description' => 'Imagen que se cargará en la noticia si no se carga una <b>imagen destacada</b> en la noticia.',
			'section'     => 'news_settings',
			'settings'    => 'default_news_image',
		) )
	);
  	// Agregar opcion para habilitar o deshabilitar "Hace x tiempo en las notas"
    $wp_customize->add_setting('show_time_ago', array(
        'capability' => 'edit_theme_options',
        'type'       => 'theme_mod',
    ));
  
    $wp_customize->add_control('show_time_ago', array(
        'label'    => __('Mostrar tiempo de posteo "Hace # tiempo"'),
        'settings' => 'show_time_ago',
        'section'  => 'news_settings',
        'type'     => 'checkbox',
    ));
}
add_action('customize_register', 'posta_news_customize_register');

// Add customatization for the social media links
function posta_social_media_links_customize_register($wp_customize){
	$wp_customize->add_section('main_settings_social_icons', array(
		'title'       => 'Enlaces a redes sociales',
		'priority'    => 60,
		'description' => 'Esta sección permite ingresar las URL de las redes sociales. Las redes sociales se mostrarán en el encabezado y pie de página del sitio.'
	));
	
	// Adding option for letting the user insert the facebook link
	$wp_customize->add_setting('social_media_link_fb', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('social_media_link_fb', array(
		'section' => 'main_settings_social_icons',
		'label'   => 'URL de Facebook',
		'type'    => 'text'
	));

	// Adding option for letting the user insert the twitter link
	$wp_customize->add_setting('social_media_link_tw', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('social_media_link_tw', array(
		'section' => 'main_settings_social_icons',
		'label'   => 'URL de Twitter',
		'type'    => 'text'
	));

	// Adding option for letting the user insert the instagram link
	$wp_customize->add_setting('social_media_link_in', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('social_media_link_in', array(
		'section' => 'main_settings_social_icons',
		'label'   => 'URL de Instagram',
		'type'    => 'text'
	));

	// Adding option for letting the user insert the youtube link
	$wp_customize->add_setting('social_media_link_yt', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('social_media_link_yt', array(
		'section' => 'main_settings_social_icons',
		'label'   => 'URL de YouTube',
		'type'    => 'text'
	));

	// Adding option for letting the user insert the Tumblr link
	$wp_customize->add_setting('social_media_link_tb', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('social_media_link_tb', array(
		'section' => 'main_settings_social_icons',
		'label'   => 'URL de Tumblr',
		'type'    => 'text'
	));

	// Adding option for letting the user insert the LinkedIn link
	$wp_customize->add_setting('social_media_link_lin', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('social_media_link_lin', array(
		'section' => 'main_settings_social_icons',
		'label'   => 'URL de LinkedIn',
		'type'    => 'text'
	));
}
add_action('customize_register', 'posta_social_media_links_customize_register');

// Adding customatization for the header sections
function posta_header_customizer_register($wp_customize){
	$wp_customize->add_section('header_settings', array(
		'title' => 'Encabezado del portal',
		'priority' => 50
	));
	$wp_customize->add_setting('header_bg_color', array(
		'default'           => '#f20e00',
		'sanitize_callback' => 'sanitize_hex_color',
		'type'           	=> 'theme_mod',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_bg_color', array(
        'label'    => 'Color de fondo de encabezado',
        'section'  => 'header_settings',
        'settings' => 'header_bg_color',
    )));
}
add_action('customize_register', 'posta_header_customizer_register');

// Adding customatization for the footer sections
function posta_footer_customize_register($wp_customize){
	$wp_customize->add_section('footer_settings', array(
		'title' => 'Pie del portal',
		'priority' => 50
	));

	$wp_customize->add_setting('footer_bg_color', array(
		'default'           => '#f20e00',
		'sanitize_callback' => 'sanitize_hex_color',
		'type'           	=> 'theme_mod',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_bg_color', array(
        'label'    => 'Color de fondo de encabezado',
        'section'  => 'footer_settings',
        'settings' => 'footer_bg_color',
    )));

	// Imagen footer
	$wp_customize->add_setting('imagen_footer', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Upload_Control(
		$wp_customize,
		'imagen_footer',
		array(
			'label'       => 'Imagen en pie de página',
			'description' => 'El archivo de imagen que se seleccione se mostrará en el pie de página.',
			'section'     => 'footer_settings',
			'settings'    => 'imagen_footer',
		) )
	);

	// Imagen footer height
	$wp_customize->add_setting('imagen_footer_height', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('imagen_footer_height', array(
		'section'     => 'footer_settings',
		'label'       => 'Alto en pixeles de la imagen',
		'description' => 'Por ejemplo: 100px',
		'type'        => 'text'
	));

	// Footer logo
	$wp_customize->add_setting('footer_logo', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Upload_Control(
		$wp_customize,
		'footer_logo',
		array(
			'label'       => 'Logo en pie de página',
			'description' => 'El archivo de imagen que se seleccione se mostrará en el pie de página.',
			'section'     => 'footer_settings',
			'settings'    => 'footer_logo',
		) )
	);

	// Footer logo height
	$wp_customize->add_setting('footer_logo_height', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('footer_logo_height', array(
		'section'     => 'footer_settings',
		'label'       => 'Alto en pixeles del logotipo',
		'description' => 'Por ejemplo: 100px',
		'type'        => 'text'
	));

	// Text of footer
	$wp_customize->add_setting('footer_text', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('footer_text', array(
		'section'     => 'footer_settings',
		'label'       => 'Texto a mostrar en el pie página',
		'description' => 'Este texto se mostrará en el pie de página.',
		'type'        => 'textarea'
	));

	// Imagen Google Play Store
	$wp_customize->add_setting('appstore_android_image', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Upload_Control(
		$wp_customize,
		'appstore_android_image',
		array(
			'label'       => 'Imágen para "Disponible en Play Store"',
			'description' => 'El archivo de imagen que se seleccione se mostrará en el pie de página.',
			'section'     => 'footer_settings',
			'settings'    => 'appstore_android_image',
		) )
	);
	// Link Google Play Store
	$wp_customize->add_setting('appstore_android_link', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('appstore_android_link', array(
		'section'     => 'footer_settings',
		'label'       => 'URL para Google Play Store',
		// 'description' => '',
		'type'        => 'text'
	));

	// Imagen AppStore
	$wp_customize->add_setting('appstore_apple_image', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Upload_Control(
		$wp_customize,
		'appstore_apple_image',
		array(
			'label'       => 'Imágen para "Disponible en AppStore"',
			'description' => 'El archivo de imagen que se seleccione se mostrará en el pie de página.',
			'section'     => 'footer_settings',
			'settings'    => 'appstore_apple_image',
		) )
	);
	// Link AppStore
	$wp_customize->add_setting('appstore_apple_link', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('appstore_apple_link', array(
		'section'     => 'footer_settings',
		'label'       => 'URL para AppStore',
		// 'description' => '',
		'type'        => 'text'
	));
	
	// Copyright text
	$wp_customize->add_setting('copy_right_text', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('copy_right_text', array(
		'section'     => 'footer_settings',
		'label'       => 'Texto 1 leyenda copyright',
		'description' => 'Este texto se mostrará en el pie de página.',
		'type'        => 'text'
	));

	// Copyright text 2
	$wp_customize->add_setting('copy_right_text_two', array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'theme_mod',
	));
	$wp_customize->add_control('copy_right_text_two', array(
		'section'     => 'footer_settings',
		'label'       => 'Texto 2 leyenda copyright',
		'description' => 'Este texto se mostrará en el pie de página.',
		'type'        => 'text'
	));
}
add_action('customize_register', 'posta_footer_customize_register');