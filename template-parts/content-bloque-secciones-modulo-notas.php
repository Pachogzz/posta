<?php 
/**
 * Template part for displaying sections and module notes 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 * 
 */?>
<?php 
?>
<div class="container mt-6 container-lg<<<">
	<div class="row justify-content-center">
	
		<div class="col-lg-8 contenedor-carruseles">
			<?php 
			if(have_rows('secciones')){
				while(have_rows('secciones')){ the_row();
					$seccion_id = get_sub_field('seccion');
					$tipo_de_carrusel = get_sub_field('tipo_de_carrusel');
					$mostrar_descripcion = get_sub_field('mostrar_descripcion');
					
					if($seccion_id){
						$GLOBALS['tipo_de_carrusel'] = $tipo_de_carrusel;
						$category = get_category( $seccion_id );	
						$category_name = $category->name;
						$category_link = get_category_link($seccion_id); // Link de la sección
						$category_description = $category->description;
						?>

						<div class="carrusel-seccion mb-5">						

							<!-- ENCABEZADO DE CARRUSEL -->
							<div class="encabezado">
								<h2 class="encabezado-titulo flecha">
									<a href="<?php echo esc_url($category_link); ?>"><?php echo $category_name;?></a>
								</h2>
								<?php if($mostrar_descripcion){?>
									<p class="encabezado-descripcion"><?php echo $category_description; ?></p>
								<?php } ?>
							</div>
							
							<!-- CARRULES DE SECCIONES -->
							<div id="carousel-<?php echo $seccion_id; ?>" class="owl-carousel <?php echo $tipo_de_carrusel; ?>">
								<?php
								$output = 'objects';
								$args = array (
									'post_type'      => 'post',
									'cat'            => $seccion_id,
									'posts_per_page' => 6,
									'orderby'        => 'date',
									'order'          => 'DESC'
								);
								$the_query = new WP_Query( $args, $output );
								if ( $the_query->have_posts() ) :
									while ( $the_query->have_posts() ) :
										$the_query->the_post(); ?>
											<div class="c-item">
												<?php get_template_part( 'template-parts/content', 'home-categories' ); ?>
											</div>
											<?php
									endwhile;
								endif;
								wp_reset_postdata();
								?>
								<!-- Link ver más notas -->
								<div class="c-item">
									<a class="item-ver-mas" href="<?php echo esc_url($category_link); ?>" title="Ver más noticias de <?php echo $category_name;?>">
										<div class="contenedor-media">
											<div class="contenedor-media-item d-flex flex-column justify-content-center align-items-center">
												<p class="h5 m-0">Ver más noticias de</p>
												<h4 class="encabezado-titulo flecha"><?php echo $category_name;?></h4>
											</div>
										</div>
									</a>
								</div>

							</div>

						</div>
									
						<?php 
						unset($GLOBALS['tipo_de_carrusel']);
					}
					wp_reset_postdata();
						
				}//endwhile
			}//endif?>
		</div>

		<div class="col-md-8 mt-6 col-lg-4 mt-lg-0">

			<!-- MÓDULO DE NOTAS -->
			<div class="modulo-corchete">
				<?php
				if(have_rows('modulo_notas_1')){
					while(have_rows('modulo_notas_1')){ the_row();
						$titulo_modulo_1 = get_sub_field('titulo_modulo_1');
						if(!empty($titulo_modulo_1)){
							$titulo = '<h4 class="encabezado-titulo flecha text-break position-relative mt-3 mb-5">'.$titulo_modulo_1.'</h4>';
						}
						$notas_modulo_1 = get_sub_field('notas_modulo_1');?>
						<?php 
						if($notas_modulo_1){ ?>

							<!-- ENCABEZADO DE MÓDULO -->
								<?php echo $titulo;?>
							<!-- NOTAS EN MÓDULO -->
							<?php
							foreach ($notas_modulo_1 as $post) {
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
									$featured_img_url = $featured_img_url_small_retina;
								}elseif ($tablet_browser > 0) {
									//print 'is tablet';
									$featured_img_url = $featured_img_url_small_retina;
								}else {
									//print 'is desktop';
									$featured_img_url = $featured_img_url_small;
								} ?>

								<div class="position-relative">
									<h5 class="titulo-de-nota font-weight-normal my-2">
										<a class="stretched-link" href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo esc_html(get_the_title()); ?></a>
									</h5>
									<div class="contenedor-media d-flex justify-content-center align-items-center" style="background-image: url( <?php echo $featured_img_url; ?> );">
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
								</div>
								<div class="separador my-4"></div>

								<?php
							}
							wp_reset_postdata();
						}
						wp_reset_postdata();?>
						<?php
					} //endwhile
				}//endif?>
			</div>

			<!-- PUBLICIDAD -->
			<div style="border: 1px dotted red;">
				<div class="modulo-publicidad mx-auto mt-6" style="width: 302px;">
					<?php if (function_exists ('adinserter')) echo adinserter (9); ?>
					<!-- <img class="img-fluid" src="https://via.placeholder.com/300x250?text=box%20banner"> -->
					<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
				</div>
			</div>
		</div>

	</div>
</div>