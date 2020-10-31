<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package posta
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <meta name="description" content="">
  <meta name="author" content="Posta">

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" media="print" onload="this.media='all'" />

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/bootstrap-custom.min.css">
  <!-- Owl Carousel -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/owl.theme.default.min.css">
  <!-- Fontawesome -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/all.min.css">
  <!-- Coverflow -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/jquery-responsiveGallery.css">
  <!-- Galería -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/lightgallery.min.css">
  <!-- Estilos tema -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/posta.css">

  <?php wp_head(); ?>

  <!-- Ad Manager -->
  <script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
  <script>
    window.googletag = window.googletag || {cmd: []};
    googletag.cmd.push(function() {
      googletag.defineSlot('/130272121/home_resp_boxbanner_01', [300, 250], 'div-gpt-ad-1603322982156-0').addService(googletag.pubads());
      googletag.pubads().enableSingleRequest();
      googletag.pubads().collapseEmptyDivs();
      googletag.enableServices();
    });
  </script>
  <!--Integración del reproductor JW Player Magenta 2.0-->
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/jwplayer/jwplayer.js"></script>
  <script src='https://cdn.jwplayer.com/libraries/2LuFt05J.js'></script>
  <script>jwplayer.key='gUSA7bc0RGA/BmzlZln6KngeAc8tLUB0ZPYTUQ==';</script>

</head>

<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Ir directamente al contenido ', 'posta' ); ?></a>

	<div id="page" class="site d-flex flex-column justify-content-between" style="height: 100vh;">

    <!-- Publicidad -->
    <div class="container-fluid bg-white pt-2">
      <img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/970x90?text=Superleaderboard">
    </div>
    
    <!-- Encabezado -->
    <header class="bg-white">

      <div class="container-xl py-3">
				<div class="row justify-content-between align-items-center">
          
          <div class="d-none d-xl-block col-xl-2">
            <!-- ... -->
          </div>
					<div class="col-md-8 col-xl-8">
            <div class="logotipo-sitio">
              <?php if( has_custom_logo() ):  ?>
                <?php 
                  $custom_logo_id = get_theme_mod( 'custom_logo' );
                  $custom_logo_data = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                  $custom_logo_url = $custom_logo_data[0];
                ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                  title="Ir al inicio"
                  rel="home">
                  <img class="img-fluid no-lazy-load" width="638" height="90" src="<?php echo esc_url( $custom_logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
                </a>
              <?php else: ?>
                <?php bloginfo( 'name' ); ?>
              <?php endif; ?>
            </div>
          </div>
					<div class="col-md-4 col-xl-2 mt-2 mt-md-0">

            <div class="row justify-content-between justify-content-md-center align-items-center">
              <div class="col-auto col-md-12 order-md-last mt-md-2">
                <div class="lista-iconos justify-content-center">
                  <?php if( get_theme_mod('social_media_link_fb') != '' ){ ?>
                    <a class="icono icono-negro" href="<?php echo get_theme_mod('social_media_link_fb'); ?>" target="_blank" id="fb">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                  <?php } ?>
                  <?php if( get_theme_mod('social_media_link_tw') != '' ){ ?>
                    <a class="icono icono-negro" href="<?php echo get_theme_mod('social_media_link_tw'); ?>" target="_blank" id="tw">
                      <i class="fab fa-twitter"></i>
                    </a>
                  <?php } ?>
                  <?php if( get_theme_mod('social_media_link_in') != '' ){ ?>
                    <a class="icono icono-negro" href="<?php echo get_theme_mod('social_media_link_in'); ?>" target="_blank" id="in">
                      <i class="fab fa-instagram"></i>
                    </a>
                  <?php } ?>
                  <?php if( get_theme_mod('social_media_link_yt') != '' ){ ?>
                    <a class="icono icono-negro" href="<?php echo get_theme_mod('social_media_link_yt'); ?>" target="_blank" id="yt">
                      <i class="fab fa-youtube"></i>
                    </a>
                  <?php } ?>
                </div>
              </div>
              <div class="col-auto col-md-12">
                <div class="fecha-sitio">
                  <?php echo date_i18n( get_option('date_format') ); ?>
                </div>
              </div>
            </div>

					</div>
				</div>
      </div>

      <nav class="navbar navbar-expand navbar-dark bg-dark" role="navigation">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="<?php esc_attr_e( 'Menú', 'posta' ); ?>">
              <span class="navbar-toggler-icon"></span>
          </button>
          <?php
          function my_nav_wrap() {
            $wrap  = '<ul id="%1$s" class="%2$s">';
            $wrap .= '%3$s';
            $wrap .= '<li class="nav-item dropdown d-none">';
            $wrap .= '<a href="#" class="nav-link link-more-menu d-flex align-items-center h-100" id="navbarDropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $wrap .= '<i class="fas fa-plus"></i>';
            $wrap .= '</a>';
            $wrap .= '<ul class="dropdown-menu dropdown-menu-right bg-dark<<" aria-labelledby="navbarDropdownMenu"></ul>';
            $wrap .= '</li>';
            $wrap .= '</ul>';
          return $wrap;
          }
          wp_nav_menu( array(
            'theme_location'    => 'menu-principal',
            'container'         => 'div',
            'depth'             => 2,
            'container_id'      => 'menu-principal',
            'container_class'   => 'collapse navbar-collapse',
            'menu_class'        => 'nav navbar-nav mx-lg-auto',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
            'items_wrap'        => my_nav_wrap(),
          ) );
          ?>
        </div>
      </nav>
			
    </header>

		<div id="content" class="site-content">