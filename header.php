<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package postamx
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<meta name="description" content="SABER / ACTUAR">
	<meta name="author" content="MINDS MX">

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/bootstrap-custom.min.css">
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
 	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"> 
	<!-- Owl Carousel -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/owl.theme.default.min.css">
	<!-- Fontawesome -->
	<script src="https://kit.fontawesome.com/0f2dd2d9af.js" crossorigin="anonymous"></script>
	<!-- Coverflow -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/jquery-responsiveGallery.css">
	<!-- Galería -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/lightgallery.min.css">
	<!-- Estilos tema -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/postamx.css">

	<?php wp_head(); ?>

	<!-- Share This -->
	<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5ff8b5b8aca127001328f8c7&product=inline-share-buttons" async="async"></script>

	<!-- Ad Manager -->
	<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
	<!-- <script async src="<?php //bloginfo('template_url') ?>/assets/js/adds_units.js"></script> -->

	<style type="text/css">
		.anythingSlider-default{
			padding: 0px !important;
		}
	    .anythingWindow{
	        border-top: 0px !important;
	        border-bottom: 0px !important;
	        border:0px !important;
	        padding:0px !important;
	        margin:0px !important;
	    }
	    .anythingSlider-default .arrow a{
	    	margin-left:-30px;
	    }
	    .anythingSlider-default .forward{
	    	right:-29px;
	    }
	</style>

<!-- Begin comScore Tag -->
<script>
  var _comscore = _comscore || [];
  _comscore.push({ c1: "2", c2: "19962896" });
  (function() {
    var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
    s.src = "https://sb.scorecardresearch.com/cs/19962896/beacon.js";
    el.parentNode.insertBefore(s, el);
  })();
</script>
<noscript>
  <img src="https://sb.scorecardresearch.com/p?c1=2&amp;c2=19962896&amp;cv=3.6.0&amp;cj=1">
</noscript>
<!-- End comScore Tag -->
<!-- Begin FBIA Tag -->
<!-- <script>
  var _comscore = _comscore || [];
  _comscore.push({ c1: "2", c2: "619962896",
    options: {
    url_append: "comscorekw=fbia"
    }
  });
  (function() {
    var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
    s.src = "https://sb.scorecardresearch.com/cs/619962896/beacon.js";
    el.parentNode.insertBefore(s, el);
  })();
</script>
<noscript>
  <img src="https://sb.scorecardresearch.com/p?c1=2&amp;c2=619962896&amp;cv=3.6.0&amp;cj=1&amp;comscorekw=fbia">
 </noscript> -->
<!-- End FBIA Tag -->
<!-- Begin Google AMP Tag -->
<!-- <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
<amp-analytics type="comscore" id="comscore">
    <script type="application/json">
        {
            "vars": {
                "c2": "19962896"
            },
            "extraUrlParams": {
                "comscorekw": "amp"
            }
        }
    </script>
</amp-analytics> -->
<!-- End Google AMP Tag -->
</head>

<body <?php body_class(); ?>>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Ir directamente al contenido ', 'postamx' ); ?></a>

	<?php if ( has_nav_menu( 'menu-vertical-oculto' ) ): ?>
	<div id="outerNav" class="outerNav">
		<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn mt-2" onclick="closeNav()">
				<i class="far fa-times-circle"></i>
			</a>
			<div class="d-block d-sm-block d-md-block d-lg-none mt-4 px-4">
				<?php get_search_form(); ?>
				<hr>
			</div>
			<?php 
				wp_nav_menu( array(
					'theme_location'    => 'menu-vertical-oculto',
					'container'         => 'div',
					'depth'             => 2,
					'container_id'      => 'menu-vertical-oculto',
					// 'container_class'   => 'collapse navbar-collapse',
					'menu_class'        => 'nav flex-column',
					'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
					'walker'            => new WP_Bootstrap_Navwalker(),
				) );
			?>
			<div class="d-block d-sm-block d-md-block d-lg-none mt-4 px-4">
				<hr>
				<div class="row justify-content-between justify-content-md-center align-items-center">
					<div class="col-auto col-md-12">
						<div class="lista-iconos justify-content-center">
							<?php if( get_theme_mod('social_media_link_fb') != '' ){ ?>
								<a class="icono icono-blanco" href="<?php echo get_theme_mod('social_media_link_fb'); ?>" target="_blank" id="fb">
									<i class="fab fa-facebook-f"></i>
								</a>
							<?php } ?>
							<?php if( get_theme_mod('social_media_link_tw') != '' ){ ?>
								<a class="icono icono-blanco" href="<?php echo get_theme_mod('social_media_link_tw'); ?>" target="_blank" id="tw">
									<i class="fab fa-twitter"></i>
								</a>
							<?php } ?>
							<?php if( get_theme_mod('social_media_link_in') != '' ){ ?>
								<a class="icono icono-blanco" href="<?php echo get_theme_mod('social_media_link_in'); ?>" target="_blank" id="in">
									<i class="fab fa-instagram"></i>
								</a>
							<?php } ?>
							<?php if( get_theme_mod('social_media_link_yt') != '' ){ ?>
								<a class="icono icono-blanco" href="<?php echo get_theme_mod('social_media_link_yt'); ?>" target="_blank" id="yt">
									<i class="fab fa-youtube"></i>
								</a>
							<?php } ?>
							<?php if( get_theme_mod('social_media_link_lin') != '' ){ ?>
								<a class="icono icono-blanco" href="<?php echo get_theme_mod('social_media_link_lin'); ?>" target="_blank" id="yt">
									<i class="fab fa-linkedin"></i>
								</a>
							<?php } ?>
							<?php if( get_theme_mod('social_media_link_tb') != '' ){ ?>
								<a class="icono icono-blanco" href="<?php echo get_theme_mod('social_media_link_tb'); ?>" target="_blank" id="yt">
									<i class="fab fa-tumblr"></i>
								</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div id="page" class="site d-flex flex-column justify-content-between">

		<!-- Publicidad -->
		<div class="container text-center py-2">
			<div id="overMenuDesktop" class="d-none d-sm-none d-md-none d-lg-block">
				<script>
				  window.googletag = window.googletag || {cmd: []};
				  googletag.cmd.push(function() {
				    googletag.defineSlot('/90573685/overmenu_desktop', [[970, 90], [970, 250], [728, 90], [640, 200]], 'div-gpt-ad-1610518689409-0').addService(googletag.pubads());
				    googletag.pubads().enableSingleRequest();
				    googletag.enableServices();
				  });
				</script>
				<!-- /90573685/overmenu_desktop -->
				<div id='div-gpt-ad-1610518689409-0' class="mx-auto">
				  <script>
				    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1610518689409-0'); });
				  </script>
				</div>
				<!-- <img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/970x90?text=SuperleaderboardDesktop"> -->
			</div>
			<div id="overMenuMobile" class="d-block d-sm-block d-md-block d-lg-none">
				<script>
				  window.googletag = window.googletag || {cmd: []};
				  googletag.cmd.push(function() {
				    googletag.defineSlot('/90573685/M320x50', [320, 50], 'div-gpt-ad-1611166209930-0').addService(googletag.pubads());
				    googletag.pubads().enableSingleRequest();
				    googletag.enableServices();
				  });
				</script>
				<!-- /90573685/M320x50 -->
				<div id='div-gpt-ad-1611166209930-0' class="mx-auto" style='width: 320px; height: 50px;'>
				  <script>
				    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1611166209930-0'); });
				  </script>
				</div>
				<!-- <img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/320x50?text=SuperleaderboardMobile"> -->
			</div>
		</div>
		
		<!-- Encabezado -->
		<header id="siteHEader" style="background-color: <?php echo get_theme_mod( 'header_bg_color' ); ?>;">
			<div id="headerMobile" class="container d-block d-sm-block d-md-block d-lg-none w-100">
				<div class="row">
					<div class="col-3">
						<?php if ( has_nav_menu( 'menu-vertical-oculto' ) ): ?>
						<span class="mt-2 my-md-4" id="openSideNav" onclick="openNav()">
							<i class="fas fa-bars fa-2x text-white"></i>
						</span>
						<?php endif; ?>	
					</div>
					<div class="col-6">
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
					<div class="col-3 px-0">
						<div class="fecha-sitio text-white mt-2 mt-md-5 text-capitalize text-left">
							<small>
							<?php 
								$date_format = date_i18n(get_option( 'date_format' ));
								echo $date_format;
							?>
							</small>
						</div>
					</div>
				</div>
			</div>

			<div id="headerArrow" class="container-xl py-3 d-none d-sm-none d-md-none d-lg-block">
				<div class="row justify-content-between align-items-center">				
					<div class="col-md-1">
						<?php if ( has_nav_menu( 'menu-vertical-oculto' ) ): ?>
						<span class="mt-3" id="openSideNav" onclick="openNav()">
							<i class="fas fa-bars fa-2x text-white"></i>
						</span>
						<?php endif; ?>
					</div>
					<div class="col-md-3">
						<div class="row justify-content-between justify-content-md-center align-items-center">
							<div class="col-auto col-md-12">
								<div class="lista-iconos justify-content-center">
									<?php if( get_theme_mod('social_media_link_fb') != '' ){ ?>
										<a class="icono icono-blanco" href="<?php echo get_theme_mod('social_media_link_fb'); ?>" target="_blank" id="fb">
											<i class="fab fa-facebook-f"></i>
										</a>
									<?php } ?>
									<?php if( get_theme_mod('social_media_link_tw') != '' ){ ?>
										<a class="icono icono-blanco" href="<?php echo get_theme_mod('social_media_link_tw'); ?>" target="_blank" id="tw">
											<i class="fab fa-twitter"></i>
										</a>
									<?php } ?>
									<?php if( get_theme_mod('social_media_link_in') != '' ){ ?>
										<a class="icono icono-blanco" href="<?php echo get_theme_mod('social_media_link_in'); ?>" target="_blank" id="in">
											<i class="fab fa-instagram"></i>
										</a>
									<?php } ?>
									<?php if( get_theme_mod('social_media_link_yt') != '' ){ ?>
										<a class="icono icono-blanco" href="<?php echo get_theme_mod('social_media_link_yt'); ?>" target="_blank" id="yt">
											<i class="fab fa-youtube"></i>
										</a>
									<?php } ?>
									<?php if( get_theme_mod('social_media_link_lin') != '' ){ ?>
										<a class="icono icono-blanco" href="<?php echo get_theme_mod('social_media_link_lin'); ?>" target="_blank" id="yt">
											<i class="fab fa-linkedin"></i>
										</a>
									<?php } ?>
									<?php if( get_theme_mod('social_media_link_tb') != '' ){ ?>
										<a class="icono icono-blanco" href="<?php echo get_theme_mod('social_media_link_tb'); ?>" target="_blank" id="yt">
											<i class="fab fa-tumblr"></i>
										</a>
									<?php } ?>
								</div>
							</div>
							<div class="col-auto col-md-12 order-md-last">
								<div class="fecha-sitio text-white mt-3">
									<?php 
										$date_format = date_i18n(get_option( 'date_format' ));
										echo $date_format;
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
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
						<?php if ( get_bloginfo( 'description' )  !== '' ) { ?>
								<span class="h4 d-block text-light text-center"><?php bloginfo( 'description' ); ?></span>
						<?php } ?>
					</div>
					<div class="col-md-3 offset-md-1">
						<!-- <div class="d-none d-sm-none d-md-block"> -->
							<?php get_search_form(); ?>
							<!-- <a class="icono icono-blanco" href="#" data-toggle="modal" data-target="#searchModal"><i class="fas fa-search"></i></a> -->
						<!-- </div> -->
					</div>
				</div>
			</div>

			<?php if ( has_nav_menu( 'menu-principal' ) ): ?>
			<!-- <nav class="navbar navbar-expand navbar-dark bg-dark" role="navigation">
				<div class="container-xl">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="<?php esc_attr_e( 'Menú', 'postamx' ); ?>">
							<span class="navbar-toggler-icon"></span>
					</button>
					<?php
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
			</nav> -->
			<?php endif; ?>
			
		</header>

		<div id="content" class="site-content">