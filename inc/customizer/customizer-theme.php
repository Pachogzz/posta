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
		'priority' => 1
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

}
add_action('customize_register', 'posta_news_customize_register');

// Add customatization for the social media links
function posta_social_media_links_customize_register($wp_customize){
	$wp_customize->add_section('main_settings_social_icons', array(
		'title'       => 'Enlaces a redes sociales',
		'priority'    => 2,
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
}
// Add customatization for social media links
add_action('customize_register', 'posta_social_media_links_customize_register');

// Adding customatization for the footer sections
function posta_footer_customize_register($wp_customize){
	$wp_customize->add_section('footer_settings', array(
		'title' => 'Opciones para el pie de página',
		'priority' => 3
	));

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
// Add customatization for site title
add_action('customize_register', 'posta_footer_customize_register');