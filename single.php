<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package postamx
 */
get_header();

// Obtiener información de los temas asociado a la nota
$categoria = get_the_category(get_the_ID(), 'category');

// Only for related notes
$category_id = $categoria[0]->term_id;
$category_name = $categoria[0]->name;
$fuente = get_field('fuente');
@$fuenteLink = get_term_link($fuente->slug, 'fuente');

// echo "<span class='text-white py-6'><pre>";
// print_r($categoria);
// echo "</pre><span>";

// Script que muestra 
if( function_exists('addPostViews') ) { 
	addPostViews(get_the_ID()); 
}

// Imagen destacada
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), '1920x1080');
if (empty($featured_img_url)){
	$featured_img_url = get_theme_mod('default_news_image');
}

// Create shortcodes
require get_template_directory() . '/inc/shortcodes.php';
$gallery = get_field('galeria_imagenes');
$GLOBALS['gallery']=  $gallery;
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<!-- IMAGEN DE NOTA / ICONO DE TIPO DE CONTENIDO -->
		<div class="container">
			<div class="row">
				<div class="col p-0">
					<div class="contenedor-media contenedor-media-imagen-nota d-flex justify-content-center align-items-center" style="background-image: url(<?php echo $featured_img_url; ?>);">
                        <?php require get_template_directory() . '/template-parts/content-tipo.php'; ?>
					</div>
					<!-- Título de la nota -->
					<h1 class="titulo-principal-nota mt-n2 mt-md-n8 mb-md-n6 display-4 d-block bg-dark text-light text-center p-3">
						<?php echo get_the_title(); ?>
					</h1>
				</div>
			</div>
		</div>

		<!-- NOTA -->
		<div class="container px-3 py-6 p-lg-6 pt-lg-9 bg-white container-lg">
			<div class="row justify-content-center align-items-start">
				<!-- Contenido principal -->
				<div class="col-12 col-lg-8 px-4 pl-lg-3 pr-lg-6">
					<!-- Share this -->
					<div class="sharethis-inline-share-buttons mb-3"></div>

					<!-- Autor de la nota -->
					<p class="autor-de-nota">
						<?php 
						if (!empty($fuente)) {
							echo "Por: " . $fuente->name;
						}else{
							echo "Por: POSTA REDACCIÓN";
						}
						?>
					</p>
					<!-- Fecha de publicación -->
					<p class="fecha-publicacion">
						<small><?php echo get_the_date( 'l j F Y - g:i a' ); ?></small>
					</p>
					<!-- Nombre de la sección o categoría principal seleccionada -->
					<!-- <h4 class="encabezado-titulo flecha">
						<//?php echo $category_name; ?>
					</h4> -->
					<!-- Nombre del tema -->
					<?php
						if (!empty($categoria[1])) {
							$theme_link  = get_category_link($categoria[1]->term_id);
							$theme_name = $categoria[1]->name;
							$theme_id = $categoria[1]->term_id;
							echo '<h2 class="tema-de-nota pl-0">Temas: <a class="font-weight-bolder" href="'.esc_url($theme_link).'">'.$categoria[1]->name.'</a></h2>';
						} else {
							$theme_link  = get_category_link($categoria[0]->term_id);
							$theme_name = $categoria[0]->name;
							$theme_id = $categoria[0]->term_id;
							echo '<h2 class="tema-de-nota pl-0">Temas: <a class="font-weight-bolder" href="'.esc_url($theme_link).'">'.$categoria[0]->name.'</a></h2>';
						}
						
						if ( ! has_excerpt() ) {
						    echo '<!-- . -->';
						} else { ?>
							<!-- Extracto -->
							<p class="lead extracto-de-nota mt-3"><?php echo get_the_excerpt(); ?></p>
						<?php } ?>

					<div class="separador"></div>

					<!-- Contenido de la nota -->
					<div class="row contenido-nota mt-5">
						<div class="col">
							<?php
							if ( have_posts() ) :
								while ( have_posts() ) : the_post();
									the_content();
								endwhile; 
							endif;
							?>
						</div>
					</div>

					<div class="separador"></div>

					<!-- Iconos de compartir -->
					<!-- Share this -->
					<div class="sharethis-inline-share-buttons mb-3"></div>
					<!-- <h6 class="text-muted">COMPARTE ESTA HISTORIA</h6> -->
					<!-- <div class="lista-iconos">
						<i class="fas fa-share-alt icono icono-borde-posta mr-2"></i>
						<a href="javascript:void(0)" class="btnsf icono icono-posta" data-title="<?php the_title(); ?>" data-excerpt="" data-link="<?php the_permalink(); ?>" data-img="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>"><i class="fab fa-facebook-f"></i></a>
						<a href="javascript:void(0)" class="btnst icono icono-posta" data-title="<?php the_title(); ?>" data-link="<?php the_permalink(); ?>"><i class="fab fa-twitter"></i></a>
						<a href="https://api.whatsapp.com/send?text=<?php the_permalink(); ?>" class="btnsw icono icono-posta" target="_blank"><i class="fab fa-whatsapp"></i></a>
					</div> -->
				</div>

				<!-- Sidebar -->
				<div class="col-auto col-lg-4 mt-6 mt-lg-0 position-sticky" style="top: 20px;">
					<!-- HASHTAGS -->
					<div class="contenedor-hashtags mt-6">
						<?php
							$hashtags = get_the_tags();
							if ($hashtags){
								foreach($hashtags as $hashtag){
									echo '<a class="hashtag" href="' . get_tag_link($hashtag->term_id) . '">#' . $hashtag->name . '</a>';
								}
							}
						?>
					</div>
					<!-- PUBLICIDAD -->
					<!-- <div class="modulo-publicidad border mx-auto" style="width: 302px;">
						<img src="http://fakeimg.pl/300x600/333/ccc/?text=HalfPage" class="img-fluid d-block mb-0" alt="Publicidad...">
						<span>Publicidad</span>
					</div> -->
					<?php get_sidebar('sidebar-1') ?>
					<!-- PUBLICIDAD -->
					<div class="modulo-publicidad mx-auto mt-4" style="width: 302px;">
						<!-- /90573685/D-ArticleTop -->
						<script>
						  window.googletag = window.googletag || {cmd: []};
						  googletag.cmd.push(function() {
						    googletag.defineSlot('/90573685/D-ArticleTop', [[300, 250], [300, 600]], 'div-gpt-ad-1611098605381-0').addService(googletag.pubads());
						    googletag.pubads().enableSingleRequest();
						    googletag.enableServices();
						  });
						</script>
						<div id='div-gpt-ad-1611098605381-0' class="mx-auto">
						  <script>
						    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1611098605381-0'); });
						  </script>
						</div>
						<span>Publicidad</span>
					</div>
				</div>
			</div>
		</div>

		<!-- PUBLICIDAD -->
		<!-- <div class="container mt-8">
			<div class="row">
				<div class="col">
					<div class="border">
						<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/728x90">
						<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
					</div>
				</div>
			</div>
		</div> -->

		<!-- NOTAS RELACIONADAS -->
		<div class="container mt-7 mb-6 contenido-relacionado">
			<div class="row">
				<div class="col">
					<!-- ENCABEZADO DE CARRUSEL -->
					<div class="encabezado text-md-center text-lg-left">
						<h3 class="encabezado-titulo text-sm-center">
							<span class="d-block d-lg-inline-block bg-dark text-light p-2 mb-2 mb-lg-0">Contenido relacionado en</span> 
							<a class="text-white" href="<?php echo esc_url($theme_link); ?>"><?php echo $theme_name;?></a>
						</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<!-- CARRUSEL NOTAS RELACIONADAS -->
					<div class="owl-carousel carrusel-tipo-tres">
						<?php
						$args = array(
							'suppress_filters' => true,
							'post_type' => 'post',
							'post__not_in' => array(get_the_ID()),
							'posts_per_page' => 6,
							'post_status' => array(
								'publish', 
							),
							'cat' => $theme_id,
							'orderby' => 'date',
							'order' => 'DESC'
						);

						$the_query = new WP_Query( $args );

						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$categoria = get_the_category(get_the_ID(), 'category');
								$tax_color = get_term_meta( $categoria[0]->term_id, 'category_color', true );
							    $show_time_ago = get_theme_mod('show_time_ago');
							    switch ($show_time_ago == 1) {
							        case '1':
							            $haceTiempo = time_ago() . ' <i class="fas fa-clock"></i>';
							        break;
							        case '0':
							            $haceTiempo = "";
							        break;
							    }
								$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), '360x202');
								if (empty($featured_img_url)){
									$featured_img_url = get_theme_mod('default_news_image');
								}
								?>
								<!-- Item (nota) dentro del carusel  -->
								<div class="c-item nota">
			                        <div class="row meta">
			                            <div class="col-12 col-md-6 categoria" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
			                                <a class="text-white" href="<?php echo $theme_link; ?>">
			                                    <small><?php echo $theme_name; ?></small>
			                                </a>
			                                <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
			                            </div>
			                            <div class="col hora text-right">
			                                <small><?php echo $haceTiempo; ?></small>
			                            </div>
			                        </div>
									<!-- IMAGEN DE NOTA -->
                        			<?php require get_template_directory() . '/template-parts/content-tipo.php'; ?>
									<div class="contenedor-media d-flex justify-content-center align-items-center" style="background-image: url('<?php echo $featured_img_url; ?>');">
									</div>
									<!-- ENCABEZADO DE NOTA -->
									<div class="encabezado-nota">
										<!-- Título de nota -->
										<h5 class="titulo-nota mt-2">
											<a class="stretched-link font-weight-bolder" href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo esc_html(get_the_title()); ?></a>
										</h5>
									</div>
								</div>
								<?php 
							}
						} ?>
						<!-- Link ver más notas -->
						<div class="c-item my-5">
							<a class="item-ver-mas" href="<?php echo esc_url($theme_link); ?>" title="Ver más noticias de <?php echo $theme_name;?>">
								<div class="contenedor-media">
									<div class="contenedor-media-item d-flex flex-column justify-content-center align-items-center">
										<p class="h5 m-3">Ver más noticias de</p>
										<h4 class="encabezado-titulo text-white"><?php echo $category_name;?></h4>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- COMENTARIOS FACEBOOK -->
		<!-- <div class="container mt-8 mb-4">
			<div class="row">
				<div class="col-12">
					<div class="fb-comments" data-href="<?php $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; echo $url;?>" data-numposts="5" data-width="100%" data-lazy="true"></div>
				</div>
			</div>
		</div> -->

	</main>
</div>

<?php 
get_footer();