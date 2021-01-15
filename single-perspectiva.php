<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package postamx
 */
get_header();
//Obtiener información de los temas asociado a la nota
$columna = get_category(get_the_ID(), 'columna'); 
$columnista = get_category(get_the_ID(), 'columnista');
//obtiene la categoria principal seleccionado  con el yoast
if($columnista){
	$category_name = $columnista->name;
	$category_id = $columnista->term_id;
}
//obtiene la categoria  seleccionado 
if(empty($category_name)){
	$category_name = $columnista[0]->name;
	$category_id = $columnista[0]->term_id;
}

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
						<div>
							<?php
							if (!empty(get_field('content_type'))){
								$content_type = get_field('content_type');
								switch($content_type){
									// Tipo de contenido: Video
									case 'video':
										if (!empty(get_field('video_jwplayer'))){
											$video_iframe = get_field('video_jwplayer');
											$url_imagen_video = get_field('url_imagen_video');
											$video_html = '<div class="contenedor-media">'.$video_iframe.'</div>'; ?>
											<i class="fas fa-play media_file_jw media-type-icon media-type-icon-lg media-type-icon-posta pl-1" 
												data-titulo='<?php echo get_the_title(); ?>' 
												data-video='<?php echo $video_iframe; ?>' 
												data-img='<?php  echo $url_imagen_video?>' ></i>
											<?php
										}else{
											if (!empty(get_field('video_youtube'))){
												$video_iframe = get_field('video_youtube');
												/*Autoplay Functionallity*/
												if ( preg_match('/src="(.+?)"/', $video_iframe, $matches) ) {
													// Video source URL
													$src = $matches[1];
													// Add option to hide controls, enable HD, and do autoplay -- depending on provider
													$params = array(
														'autoplay' => 1
													);
													$new_src = add_query_arg($params, $src);
													$video_iframe = str_replace($src, $new_src, $video_iframe);
													// add extra attributes to iframe html
													$attributes = 'frameborder="0"';
													$video_iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video_iframe);
												}
												/*Autoplay Functionallity*/
												$video_html = '<div class="contenedor-media">'.$video_iframe.'</div>'; ?>
												<i class="fas fa-play media_file media-type-icon media-type-icon-lg media-type-icon-posta pl-1" data-titulo='<?php echo get_the_title(); ?>' data-media='<?php echo $video_html; ?>'></i>
												<?php
											}
										}
									break;
									// Tipo de contenido: Audio
									case 'audio':
										if (!empty(get_field('audio_news'))){
											$audio_iframe = get_field('audio_news');
											$audio_html = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>'; ?>
											<i class="fas fa-volume-up media_file media-type-icon media-type-icon-lg media-type-icon-posta" data-media='<?php echo $audio_html; ?>'></i>
											<?php
										}
									break;
								} // End of switch
							} // End of if (content_type)
							?>
						</div>
					</div>
					<!-- Título de la nota -->
					<h1 class="titulo-principal-nota mt-3 display-4 d-block bg-dark text-light text-center p-3">
						<?php echo get_the_title(); ?>
					</h1>
				</div>
			</div>
		</div>

		<!-- NOTA -->
		<div class="container mt-6 container-lg<<<">
			<div class="row justify-content-center align-items-start">
				<!-- Contenido principal -->
				<div class="col-lg px-4 pl-lg-3 pr-lg-6">
					<!-- Autor de la nota -->
					<p class="autor-de-nota">
						Por
						<?php global $post; $author_id = $post->post_author;
							$author_name = get_the_author_meta( 'display_name', $author_id );
							echo $author_name;
						?>
					</p>
					<!-- Fecha de publicación -->
					<p class="fecha-publicacion"><small><?php echo get_the_date( 'l j F Y - g:i a' ); ?></small></p>
					<!-- Nombre de la sección o categoría principal seleccionada -->
					<!-- <h4 class="encabezado-titulo flecha">
						</?php
							echo $category_name;
						?>
					</h4> -->
					<!-- Nombre del tema -->
					<?php if($columna){
						echo "Temas: ";
							for ($i=0; $i<count($columna) ; $i++) {
								$theme_link  = get_category_link($columna[$i]->term_id);
								echo $theme_name = '<h6 class="tema-de-nota text-primary mt-3"><a href="'.esc_url($theme_link).'">'.$columna[$i]->name.'</a></h6>';
							}
						}?>
					<!-- Extracto -->
					<p class="lead extracto-de-nota mt-3"><?php echo get_the_excerpt() ?></p>

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
					<!-- <h6 class="text-muted">COMPARTE ESTA HISTORIA</h6> -->
					<div class="lista-iconos">
						<i class="fas fa-share-alt icono icono-borde-posta mr-2"></i>
						<a href="javascript:void(0)" class="btnsf icono icono-posta" data-title="<?php the_title(); ?>" data-excerpt="" data-link="<?php the_permalink(); ?>" data-img="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>"><i class="fab fa-facebook-f"></i></a>
						<a href="javascript:void(0)" class="btnst icono icono-posta" data-title="<?php the_title(); ?>" data-link="<?php the_permalink(); ?>"><i class="fab fa-twitter"></i></a>
						<a href="https://api.whatsapp.com/send?text=<?php the_permalink(); ?>" class="btnsw icono icono-posta" target="_blank"><i class="fab fa-whatsapp"></i></a>
					</div>
				</div>

				<!-- Sidebar -->
				<div class="col-auto col-lg-4 mt-6 mt-lg-0 position-sticky" style="top: 20px;">
					<!-- PUBLICIDAD -->
					<div class="modulo-publicidad mx-auto" style="width: 302px; border:1px dotted red;">
						<img src="http://fakeimg.pl/300x600/333/ccc/?text=HalfPage" class="img-fluid d-block mb-0" alt="Publicidad...">
						<span>Publicidad</span>
					</div>
					<?php get_sidebar('sidebar-1') ?>
					<!-- PUBLICIDAD -->
					<div class="modulo-publicidad mx-auto mt-4" style="width: 302px; border:1px dotted red;">
						<img class="img-fluid" src="https://via.placeholder.com/300x600?text=halfpage">
						<span>Publicidad</span>
					</div>
					<!-- HASHTAGS -->
					<!-- <div class="contenedor-hashtags mt-6">
						</?php
							$hashtags = get_the_tags();
							if ($hashtags){
								foreach($hashtags as $hashtag){
									echo '<a class="hashtag" href="' . get_tag_link($hashtag->term_id) . '">#' . $hashtag->name . '</a>';
								}
							}
						?>
					</div> -->
				</div>
			</div>
		</div>

		<!-- PUBLICIDAD -->
		<div class="container mt-8">
			<div class="row">
				<div class="col">
					<div style="border:1px dotted red;">
						<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/728x90">
						<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
					</div>
				</div>
			</div>
		</div>

		<!-- NOTAS RELACIONADAS -->
		<?php

		if($columna){
			for ($i=0; $i<count($columna) ; $i++) { 
				$slug = $columna[$i]->slug;
				if($slug == 'con-tacones-entre-legos' || $slug == 'yo-que-voy-a-saber' || $slug == 'desenfoque' ){
					$category_name = $columna[$i]->name;
					$category_link  = get_category_link($columna[$i]->term_id);
					$category_description  = category_description($columna[$i]->term_id);
					
					$taxonomy_name = $columna[$i]->taxonomy;
					$taxonomy_term = $columna[$i]->name;

					$tema_principal= true;
				}
			}
				
		}else{
			$category_link = get_category_link($category_id);
			$category_description  = category_description($category_id);
			$tema_principal= false;
		}
		
		?>
		<div class="container mt-7 mb-6 container-lg<<<">
			<div class="row">
				<div class="col">
					<!-- ENCABEZADO DE CARRUSEL -->
					<div class="encabezado">
						<h3 class="encabezado-titulo">
							Contenido relacionado en <a href="<?php echo esc_url($category_link); ?>"><?php echo $category_name;?></a>
						</h3>
						<?php if(!empty($category_description)){ echo '<p class="encabezado-descripcion">'.$category_description.'</p>'; } ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<!-- CARRUSEL NOTAS RELACIONADAS -->
					<div class="owl-carousel carrusel-tipo-tres">
						<?php
						if($tema_principal){
							$args = array ( 
								'suppress_filters' => true,
								'post_type' => 'post', 
								'post__not_in' => array(get_the_ID()),
								'cat' => $category_id,
								'posts_per_page' => 6,
								'tax_query' => array(
									array(
										'taxonomy' => $taxonomy_name,
										'field'    => 'name',
										'terms'    => $taxonomy_term,
									),
								),
								'post_status' => array(
									'publish', 
								),
								'orderby' => 'date', 
								'order' => 'DESC' 
							);

						}else{
							$args = array(
								'suppress_filters' => true,
								'post_type' => 'post',
								'post__not_in' => array(get_the_ID()),
								'posts_per_page' => 6,
								'post_status' => array(
									'publish', 
								),
								'cat' => $category_id,
								'orderby' => 'date',
								'order' => 'DESC'
							);
						}

						$output = 'objects';
						$the_query = new WP_Query( $args, $output );

						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), '360x202');
								if (empty($featured_img_url)){
									$featured_img_url = get_theme_mod('default_news_image');
								}?>
								<!-- Item (nota) dentro del carusel  -->
								<div class="c-item">
									<!-- IMAGEN DE NOTA -->
									<div class="contenedor-media d-flex justify-content-center align-items-center" style="background-image: url('<?php echo $featured_img_url; ?>');">
										<!-- Icono de tipo de contenido -->
										<div>
											<?php
											if (!empty(get_field('content_type'))){
												$content_type = get_field('content_type');
												switch($content_type){
													// Tipo de contenido: Video
													case 'video':
														if (!empty(get_field('video_jwplayer'))){
															$video_iframe = get_field('video_jwplayer');
															$url_imagen_video = get_field('url_imagen_video');
															$video_html = '<div class="contenedor-media">'.$video_iframe.'</div>'; ?>
															<i class="fas fa-play media_file_jw media-type-icon media-type-icon-negro pl-1" 
																data-titulo='<?php echo get_the_title(); ?>' 
																data-video='<?php echo $video_iframe; ?>' 
																data-img='<?php  echo $url_imagen_video?>' ></i>
															<?php
														}else{
															if (!empty(get_field('video_youtube'))){
																$video_iframe = get_field('video_youtube');
																/*Autoplay Functionallity*/
																if ( preg_match('/src="(.+?)"/', $video_iframe, $matches) ) {
																	// Video source URL
																	$src = $matches[1];
																	// Add option to hide controls, enable HD, and do autoplay -- depending on provider
																	$params = array(
																		'autoplay' => 1
																	);
																	$new_src = add_query_arg($params, $src);
																	$video_iframe = str_replace($src, $new_src, $video_iframe);
																	// add extra attributes to iframe html
																	$attributes = 'frameborder="0"';
																	$video_iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video_iframe);
																}
																/*Autoplay Functionallity*/
																$video_html = '<div class="contenedor-media">'.$video_iframe.'</div>'; ?>
																<i class="fas fa-play media_file media-type-icon media-type-icon-negro pl-1" data-titulo='<?php echo get_the_title(); ?>' data-media='<?php echo $video_html; ?>'></i>
																<?php 
															}
														}	
													break;
													// Tipo de contenido: Audio
													case 'audio':
														if (!empty(get_field('audio_news'))){
															$audio_iframe = get_field('audio_news');
															$audio_html = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>'; ?>
															<i class="fas fa-volume-up media_file media-type-icon media-type-icon-negro" data-media='<?php echo $audio_html; ?>'></i>
															<?php
														}
													break;
												} // End of switch
											} // End of if (content_type)
											?>
										</div>
									</div>
									<!-- ENCABEZADO DE NOTA -->
									<div class="encabezado-nota">
										<!-- Título de nota -->
										<h4 class="titulo-de-nota mt-2">
											<a class="stretched-link" href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo esc_html(get_the_title()); ?></a>
										</h4>
									</div>
								</div>
								<?php 
							}
						} ?>
						<!-- Link ver más notas -->
						<!-- <div class="c-item">
							<a class="item-ver-mas" href="</?php echo esc_url($category_link); ?>" title="Ver más noticias de </?php echo $category_name;?>">
								<div class="contenedor-media">
									<div class="contenedor-media-item d-flex flex-column justify-content-center align-items-center">
										<p class="h5 m-0">Ver más noticias de</p>
										<h4 class="encabezado-titulo flecha"></?php echo $category_name;?></h4>
									</div>
								</div>
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