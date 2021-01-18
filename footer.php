<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package postamx
 */

?>
			<!-- MODAL DE BUSQUEDA -->
			<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="searchModalLabel">Búsqueda</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hidden="true"><i class="fas fa-times"></i></span>
							</button>
						</div>
						<div class="modal-body">
							<div class="well search-result">
								<?php echo do_shortcode('[wpbsearch]'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- MODAL DE ICONOS DE COMPARTIR -->
			<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="shareModal">Compartir publicación</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hidden="true"><i class="fas fa-times"></i></span>
							</button>
						</div>
						<div class="modal-body">
							<p class="texto-negro">Haz clic en los siguientes iconos para compartir este contenido.</p>
							<a href="javascript:void(0)" class="btnsf" data-title="" data-excerpt="" data-link="" data-img="">
								<i class="fab fa-facebook-f share-modal-icon fb-icon"></i>
							</a>
							<a href="javascript:void(0)" class="btnst" data-title="" data-excerpt="" data-link="" data-img="">
								<i class="fab fa-twitter share-modal-icon tw-icon"></i>
							</a>
							<a href="javascript:void(0)" class="btnsw d-sm-none<<<" data-title="" data-excerpt="" data-link="" data-img="" target="_blank">
								<i class="fab fa-whatsapp share-modal-icon wa-icon"></i>
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- MODAL TIPO DE CONTENIDO PARA VIDEOS JW PLAYER -->
			<div class="modal fade" id="mediaFileTypesModal_jw" tabindex="-1" role="dialog" aria-labelledby="mediaFileTypesModal_jw" aria-hidden="true">
				<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
					<div class="modal-content media-modals">
						<div class="modal-header">
							<h5 class="modal-title titulo_jw" id="mediaFileTypesLabel_jw"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hidden="true"><i class="fas fa-times"></i></span>
							</button>
						</div>
						<div class="modal-body">
							<div id="media_container_jw">
								<div id="my-video"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- MODAL TIPO DE CONTENIDO GENERAL -->
			<div class="modal fade" id="mediaFileTypesModal" tabindex="-1" role="dialog" aria-labelledby="mediaFileTypesLabel" aria-hidden="true">
				<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
					<div class="modal-content media-modals">
						<div class="modal-header">
							<h5 class="modal-title titulo_yt" id="mediaFileTypesLabel"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hidden="true"><i class="fas fa-times"></i></span>
							</button>
						</div>
						<div class="modal-body">
    					<div id="media_container"></div>
						</div>
					</div>
				</div>
			</div>

		</div><!-- Termina #content -->

		<!-- FOOTER -->
		<footer id="colophon" class="footer pt-6 mt-6" style="background-color:  <?php echo get_theme_mod( 'footer_bg_color' ); ?>;">
			<div class="container pb-6">

				<div class="row justify-content-center align-items-center">

					<div class="col-md-auto text-center">
						<?php if( get_theme_mod('footer_logo') != '' ) { ?>
							<img class="img-fluid" style="max-height: <?php if( get_theme_mod('footer_logo_height') != '' ) { echo get_theme_mod('footer_logo_height'); } ?>" src="<?php echo get_theme_mod('footer_logo'); ?>" alt="">
						<?php } ?>
					</div>
					
					<div class="col-md col-xl-auto text-center px-5 mt-5 mt-md-0">
						<?php
						wp_nav_menu( array(
							'theme_location'    => 'menu-pie-de-pagina',
							'container'         => 'div',
							'depth'             => 1,
							'container_id'      => 'menu-pie-de-pagina',
							'container_class'   => '',
							'menu_class'        => 'nav justify-content-center mb-2',
							'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
							'walker'            => new WP_Bootstrap_Navwalker(),
							'items_wrap'        => my_nav_wrap(),
						) );
						?>
						<?php if( get_theme_mod('footer_text') != '' ) { ?>
							<p class="pl-2"><?php echo get_theme_mod('footer_text'); ?></p>
						<?php } ?>
					</div>
					
					<div class="col-md-auto text-center pl-5< mt-5 mt-md-0">
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
						<div class="row mt-3">
							<div class="col">
								<?php if( get_theme_mod('appstore_apple_image') != '' ) { ?>
									<a href="<?php echo get_theme_mod('appstore_apple_link'); ?>" target="_blank">
										<img class="img-fluid d-block" src="<?php echo get_theme_mod('appstore_apple_image'); ?>" style="max-height: 50px;">
									</a>
								<?php } ?>
								</div>
							<div class="col">
								<?php if( get_theme_mod('appstore_android_image') != '' ) { ?>
									<a href="<?php echo get_theme_mod('appstore_android_link'); ?>" target="_blank">
										<img class="img-fluid d-block" src="<?php echo get_theme_mod('appstore_android_image'); ?>" style="max-height: 50px;">
									</a>
								<?php } ?>
								</div>
						</div>
					</div>

				</div>

				<div class="row justify-content-center mt-6">
					<div class="col-auto">
						<?php if( get_theme_mod('imagen_footer') != '' ) { ?>
						<img class="img-fluid" style="max-height: <?php if( get_theme_mod('imagen_footer_height') != '' ) { echo get_theme_mod('imagen_footer_height'); } ?>" src="<?php echo get_theme_mod('imagen_footer'); ?>">
						<?php } ?>
					</div>
				</div>
			</div><!-- .site-info -->

			<section class="bg-dark text-white">
				<div class="container">
					<div class="row justify-content-center pt-3">
						<?php if( get_theme_mod('copy_right_text') != '' ) { ?>
							<p class="mb-0 pl-2"><?php echo get_theme_mod('copy_right_text'); ?></p>
						<?php } ?>
						<?php if( get_theme_mod('copy_right_text_two') != '' ) { ?>
							<p class="pl-2"><?php echo get_theme_mod('copy_right_text_two'); ?></p>
						<?php } ?>					
					</div>
				</div>
			</section> <!-- .site-copyright -->

		</footer><!-- #colophon -->

	</div><!-- #page -->

	<?php wp_footer(); ?>
	
	<!-- Bootstrap -->
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/popper.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/bootstrap.min.js"></script>
	<!-- Owl Carousel -->
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/owl.carousel.min.js"></script>
	<!-- Main -->
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/main.js"></script>
	<!-- Bloques de contenido cuadriculado -->
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/bloques-contenido.js"></script>
	<!-- Coverflow -->
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/jquery.responsiveGallery.js"></script>
	<script type="text/javascript">
    $(function () {
      $('.responsiveGallery-wrapper').responsiveGallery({
        animatDuration: 400,
        $btn_prev: $('.responsiveGallery-btn_prev'),
        $btn_next: $('.responsiveGallery-btn_next')
      });
    });
  </script>

  <!-- Galería -->
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/lightgallery.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/lg-pager.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/lg-autoplay.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/lg-fullscreen.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/lg-zoom.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/lg-hash.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/lg-share.min.js"></script>
  <!-- *Simple Fix for galleries -->
  <!--script type="text/javascript">lightGallery(document.getElementById('lightgallery'));</script-->
  <!-- *Simple Fix for galleries -->
	<script type="text/javascript">
		jQuery('#mediaFileTypesModal').on('hidden.bs.modal', function (e) {
			// do something...
			jQuery('#mediaFileTypesModal iframe').attr("src", "");
		});
	</script>
	<?php
	$gallery = $GLOBALS['gallery'];
    for ($i=1; $i<=count($gallery); $i++){ 
	?>
      <script type="text/javascript">
      	lightGallery(document.getElementById('lightgallery-<?php echo ($i); ?>'));
      </script>
  	<?php } unset($GLOBALS['gallery']); ?>

  	<!-- Anythingslider -->
  	<script type="text/javascript">
      jQuery('#slider').anythingSlider({
       	resizeContents      : false,
       	enableArrows		: true, 
       	forwardText			: "Next",
       	backText			: "Prev",
       	autoPlay            : false,
  		buildNavigation     : false,
  		buildStartStop      : false,
      });
    </script>
</body>
</html>
