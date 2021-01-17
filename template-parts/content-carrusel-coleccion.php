<?php 
/**
 * Template part for displaying  carousel collection
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 * 
 */
require get_template_directory() . '/inc/detect_mobile_desktop.php'; 
$titulo_del_carrusel = get_sub_field('titulo_del_carrusel');
$notas_coleccion = get_sub_field('notas_coleccion');
$tipo_de_carrusel_coleccion = get_sub_field('tipo_de_carrusel_coleccion');
$estilo_de_carrusel_coleccion = get_sub_field('estilo_de_carrusel_coleccion');
$imagen_de_fondo_coleccion = get_sub_field('imagen_de_fondo_coleccion');
$color_de_fondo_coleccion = get_sub_field('color_de_fondo_coleccion');
$color_de_texto_coleccion = get_sub_field('color_de_texto_coleccion');
$mostrar_descripcion = get_sub_field('mostrar_descripcion');
$show_time_ago = get_theme_mod('show_time_ago');
switch ($show_time_ago == 1) {
    case '1':
        $haceTiempo = time_ago() . ' <i class="fas fa-clock"></i>';
    break;
    case '0':
        $haceTiempo = "";
    break;
}

if($titulo_del_carrusel){
	$titulo ='<h2 class="encabezado-titulo"><span class="nombre-sitio">POSTA</span><span class="nombre-taxonomia">'.$titulo_del_carrusel.'</span></h2>';
}
if($mostrar_descripcion){
	$descripcion_del_carrusel_coleccion = get_sub_field('descripcion_del_carrusel');
	$descripcion_del_carrusel = '<p class="encabezado-descripcion">'.$descripcion_del_carrusel_coleccion.'</p>';
}
if ( $notas_coleccion ) { ?>
	<div class="<?php echo $estilo_de_carrusel_coleccion; ?> <?php echo $color_de_texto_coleccion; ?> mt-6" style="background-image: url( <?php echo $imagen_de_fondo_coleccion; ?> ); background-color: <?php echo $color_de_fondo_coleccion; ?>;">
		<div class="container container-lg<<<">
			<div class="row">
				<div class="col">
					<!-- ENCABEZADO DE CARRUSEL -->
					<div class="encabezado">
						<?php echo $titulo; ?>
						<?php echo $descripcion_del_carrusel; ?>
					</div>
					<!-- CARRUSEL COLECCIÓN -->
					<div class="owl-carousel owl-<?php echo $tipo_de_carrusel_coleccion; ?> <?php echo $tipo_de_carrusel_coleccion; ?>">
						<?php
						foreach ($notas_coleccion as $post) {
							setup_postdata($post);
							$featured_img_url_small = get_the_post_thumbnail_url(get_the_ID(), '360x202');
							$featured_img_url_small_retina = get_the_post_thumbnail_url(get_the_ID(), '720x405');
							$featured_img_url_medium = get_the_post_thumbnail_url(get_the_ID(), '550x309');
							$featured_img_url_medium_retina = get_the_post_thumbnail_url(get_the_ID(), '1100x618');
							$featured_img_url_large = get_the_post_thumbnail_url(get_the_ID(), '1920x1080');
							$featured_img_url_large_retina = get_the_post_thumbnail_url(get_the_ID(), '3840x2160');
							
							// De acuerdo al dispositivo y espacio del contenedor de la Imagen destacada ponemos la medida más adecuada
							if ($mobile_browser > 0) {
								//print 'is mobile';
								if($tipo_de_carrusel_coleccion){
									if($tipo_de_carrusel_coleccion == 'carrusel-tipo-uno'){
										$featured_img_url = $featured_img_url_small_retina;
									}elseif($tipo_de_carrusel_coleccion == 'carrusel-tipo-dos'){
										$featured_img_url = $featured_img_url_small_retina;
									}elseif($tipo_de_carrusel_coleccion == 'carrusel-tipo-tres'){
										$featured_img_url = $featured_img_url_small_retina;
									}
									$tipo_de_carrusel = "";
								}
							}elseif ($tablet_browser > 0) {
								//print 'is tablet';
								if($tipo_de_carrusel_coleccion){
									if($tipo_de_carrusel_coleccion == 'carrusel-tipo-uno'){
										$featured_img_url = $featured_img_url_large;
									}elseif($tipo_de_carrusel_coleccion == 'carrusel-tipo-dos'){
										$featured_img_url = $featured_img_url_small_retina;
									}elseif($tipo_de_carrusel_coleccion == 'carrusel-tipo-tres'){
										$featured_img_url = $featured_img_url_small_retina;
									}
									$tipo_de_carrusel = "";
								}

							}else {
								//print 'is desktop';
								if($tipo_de_carrusel_coleccion){
									if($tipo_de_carrusel_coleccion == 'carrusel-tipo-uno'){
										$featured_img_url = $featured_img_url_medium_retina;
									}elseif($tipo_de_carrusel_coleccion == 'carrusel-tipo-dos'){
										$featured_img_url = $featured_img_url_medium;
									}elseif($tipo_de_carrusel_coleccion == 'carrusel-tipo-tres'){
										$featured_img_url = $featured_img_url_small;
									}
									$tipo_de_carrusel = "";
								}
							}

							//obtiene obtiene la categoria principal
							$categoria = get_primary_category(get_the_ID(), 'category');
							// categoria principal con el yoast
							if($categoria){
								$category_name = $categoria->name;
								$category_id = $categoria->term_id;
							}
							//la categoria  seleccionado  sin el yoast
							if(empty($category_name)){
								$category_name = $categoria[0]->name;
								$category_id = $categoria[0]->term_id;
							}
							$category_link = get_category_link($category_id);
							$category_description  = category_description($category_id);
			    			$tax_color = get_term_meta( $category_id, 'category_color', true );
							?>

							<div class="c-item">
								<div class="row mb-0 meta">
									<!-- Sección de nota -->
									<div class="col-6 categoria" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
										<a class="text-white" href="<?php echo $category_link; ?>">
											<?php echo $category_name ?>
										</a>
			                            <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
									</div>
		                            <div class="col-6 hora text-right">
		                                <small><?php echo $haceTiempo; ?></small>
		                            </div>
								</div>
								<div class="position-relative">
									<!-- IMAGEN DE NOTA -->
									<div class="contenedor-media d-flex justify-content-center align-items-center" style="background-image: url(<?php echo $featured_img_url ?>);">
										<!-- Icono tipo de contenido -->
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
									<div class="encabezado-nota mt-2">
										<!-- Título de nota -->
										<h4 class="titulo-de-nota mt-1">
											<a class="stretched-link" href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo esc_html(get_the_title()); ?></a>
										</h4>
									</div>
								</div>
								<!-- ICONOS COMPARTIR -->
								<div class="d-sm-none">
									<?php require get_template_directory() . '/inc/iconos-compartir.php'; ?>
								</div>
							</div>
						<?php }
						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } 
wp_reset_postdata();