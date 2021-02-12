
<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package postamx
 */
get_header();
// Script que muestra 
if( function_exists('addPostViews') ) { 
	addPostViews(get_the_ID()); 
}

$columna = wp_get_post_terms( $post->ID, 'columna', array( 'fields' => 'all' ) );
$columna_ID = $columna[0]->term_id;
$columna_name = $columna[0]->name;
$columna_link = get_term_link( $columna[0]->slug, 'columna');
$fuente = get_field('fuente');
@$fuenteLink = get_term_link($fuente->slug, 'fuente');

$fuenteImage = get_field('imagen_de_perfil', $fuente);
if (!empty($fuenteImage)){
	$fuenteImage = get_field('imagen_de_perfil', $fuente);
}else{
	$fuenteImage = get_theme_mod('default_news_image');
}

// Create shortcodes
require get_template_directory() . '/inc/shortcodes.php';
$gallery = get_field('galeria_imagenes');
$GLOBALS['gallery']=  $gallery;
?>
<div id="primary" class="content-area content-perspectiva">
	<main id="main" class="site-main">
		<!-- IMAGEN DE NOTA / ICONO DE TIPO DE CONTENIDO -->
		<div class="container">
			<div class="row">
				<div class="col text-center p-0">
					<div class="contenedor-media contenedor-media-imagen-nota d-flex justify-content-center align-items-center rounded-circle mb-n6" style="background-image: url(<?php echo $fuenteImage; ?>);">
                        <?php require get_template_directory() . '/template-parts/content-tipo.php'; ?>
					</div>
					<!-- Nombre de la sección o categoría principal seleccionada -->
					<h4 class="encabezado-titulo text-white mb-n4">
						<?php echo $columna_name; ?>
					</h4>
					<!-- Título de la nota -->
					<h1 class="titulo-principal-nota display-4 d-block bg-dark text-light text-center p-3 pt-5 py-lg-4 pt-lg-6 mb-md-n6">
						<!-- Autor de la nota -->
						<p class="autor-de-nota mb-4">
							<?php 
							if (!empty($fuente)) {
								echo "Por: " . $fuente->name;
							}else{
								echo "Por: POSTA REDACCIÓN";
							}
							?>
						</p>
						<?php echo get_the_title(); ?>
					</h1>
				</div>
			</div>
		</div>

		<!-- NOTA -->
		<div class="container px-3 py-6 p-lg-6 pt-lg-9 bg-white">
			<div class="row justify-content-center align-items-start">
				<!-- Contenido principal -->
				<div class="col-12 col-lg-8 px-4 pl-lg-3 pr-lg-6">
					<!-- Share this -->
					<div class="sharethis-inline-share-buttons mb-3"></div>
					<!-- Fecha de publicación -->
					<p class="fecha-publicacion">
						<small><?php echo get_the_date( 'l j F Y - g:i a' ); ?></small>
					</p>
					<!-- Extracto -->
					<?php 
					if ( ! has_excerpt() ) {
					    echo '<!-- . -->';
					} else { ?>
						<!-- Extracto -->
						<p class="lead extracto-de-nota mt-3">
							<?php echo get_the_excerpt(); ?>
						</p>
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
					<!-- Share this -->
					<div class="sharethis-inline-share-buttons mb-3"></div>
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
					<!-- <div class="modulo-publicidad border mx-auto mt-4" style="width: 302px;">
						<img class="img-fluid" src="https://via.placeholder.com/300x600?text=halfpage">
						<span>Publicidad</span>
					</div> -->
				</div>
			</div>
		</div>

		<!-- PUBLICIDAD -->
		<!-- <div class="container mt-8">
			<div class="row">
				<div class="col">
					<div class="">
						<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/728x90">
						<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
					</div>
				</div>
			</div>
		</div> -->

		<!-- NOTAS RELACIONADAS -->
		<div id="relatedContentPerspective" class="container mt-7 mb-6 contenido-relacionado perspectivas">
			<div class="row">
				<div class="col">
					<!-- ENCABEZADO DE CARRUSEL -->
					<div class="encabezado text-md-center text-lg-left">
						<h3 class="encabezado-titulo text-sm-center">
							<span class="d-block d-lg-inline-block bg-dark text-light p-2 mb-2 mb-lg-0">Contenido relacionado en</span> 
							<a class="text-white" href="<?php echo esc_url($columna_link); ?>"><?php echo $columna_name;?></a>
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
							// 'suppress_filters' => true,
							'post_type' => 'perspectivas',
							'columna' => $columna_name,
							'post__not_in' => array(get_the_ID()),
							'posts_per_page' => 6,
							'post_status' => array(
								'publish', 
							),
							'orderby' => 'date',
							'order' => 'DESC'
						);
						$the_query = new WP_Query( $args );

						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$tax_color = get_term_meta( $columna_ID, 'category_color', true );
							    $show_time_ago = get_theme_mod('show_time_ago');
							    switch ($show_time_ago == 1) {
							        case '1':
							            $haceTiempo = "<div class='col-12'><p><small>" . time_ago() . ' <i class="fas fa-clock"></i></small></p></div>';
							        break;
							        case '0':
							            $haceTiempo = "";
							        break;
							    }
									$fuenteImage = get_field('imagen_de_perfil', $fuente);
									if (!empty($fuenteImage)){
										$fuenteImage = get_field('imagen_de_perfil', $fuente);
									}else{
										$fuenteImage = get_theme_mod('default_news_image');
									}
						?>
								<!-- Item (nota) dentro del carusel  -->
								<div class="c-item nota">
									<!-- IMAGEN DE NOTA -->
                        			<?php require get_template_directory() . '/template-parts/content-tipo.php'; ?>
									<div class="contenedor-media d-flex justify-content-center align-items-center rounded-circle mt-0 mb-n6" style="background-image: url('<?php echo $fuenteImage; ?>');">
									</div>
									<div class="row mb-0 meta text-center pt-4">
										<div class="col-12 columna">
											<!-- Nombre del tema -->
												<span class="text-white p-0 mr-1">
													<?php echo $columna_name; ?>
												</span>
										</div>
							            <div class="col-12 columnista">
							            	<h6 class="py-3">
											<?php 
											if (!empty($fuente)) {
												// echo "Por: <a href=".$fuenteLink.">".$fuente->name."</a>";
												echo "Por: " . $fuente->name;
											}else{
												echo "Por: POSTA REDACCIÓN";
											}
											?>
											</h6>
							            </div>
							            <!-- PUBLICADO HACE... -->
							            <?php echo $haceTiempo; ?>
									</div>
									<!-- ENCABEZADO DE NOTA -->
									<div class="encabezado-nota text-center">
										<!-- Título de nota -->
										<h5 class="titulo-nota font-weight-bolder">
											<a class="stretched-link" href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo esc_html(get_the_title()); ?></a>
										</h5>
									</div>
								</div>
								<?php 
							}
						} ?>
						<!-- Link ver más notas -->
						<!-- <div class="c-item my-5">
							<a class="item-ver-mas d-block h-100" href="<?php echo esc_url($columna_link); ?>" title="Ver más noticias de <?php echo $columna_name;?>">
								<p class="h5 d-block w-100 text-center mb-3">Ver más de: </p>
								<h4 class="encabezado-titulo d-inline-block mx-auto w-100 text-white"><?php echo $columna_name;?></h4>
							</a>
						</div> -->
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