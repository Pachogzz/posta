<?php 
/**
 * Template part for displaying Carrusel Portada
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 * 
 */
$portada = get_sub_field('notas_portada');
 if($portada){?>
	<div class="container-fluid p-0 mt-6 indicador-elemento">
		<div class="owl-carousel carrusel-portada">
			<?php
			foreach ($portada as $post) {
				setup_postdata($post);
				
				// Revisar por Pedro - agregar las condicionales de tamaños de imagen para este carrusel

				?>
				<div>
					<!-- IMAGEN DE NOTA -->
					<div class="contenedor-media d-flex justify-content-center align-items-center" style="background-image: url( <?php echo get_the_post_thumbnail_url(get_the_ID(),'1920x1080'); ?> );">
						<a class="link-a-nota" href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"></a>
					</div>
					<!-- ENCABEZADO NOTA -->
					<div class="container encabezado-nota position-relative mt-sm-n5 mt-md-n6">
						<div class="row justify-content-center">
							<div class="col-md-10 col-lg bg-white px-3 pt-3 px-md-4 pt-md-4">
								<!-- Icono tipo de contenido -->
								<div>
									<?php
									if (!empty(get_field('content_type'))){
									$content_type = get_field('content_type');
									switch($content_type){
									// Tipo de contenido: Video
									case 'video':
									if (!empty(get_field('video_news'))){
											$video_iframe = get_field('video_news');
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
											<i class="fas fa-play media_file media-type-icon media-type-icon-posta pl-1" data-media='<?php echo $video_html; ?>' data-toggle="tooltip" data-placement="left" title="Ver video"></i>
									<?php }
									break;
									// Tipo de contenido: Video de Facebook
									case 'facebook':
										if (!empty(get_field('video_facebook_news'))){
										$url_video = get_field('video_facebook_news');
										$video_iframe = '<iframe src="https://www.facebook.com/plugins/video.php?href='.$url_video.'&mute=0" allow="encrypted-media" allowFullScreen="true">';
										$video_html = '<div class="contenedor-media">'.$video_iframe.'</div>'; ?>
										<i class="fas fa-play media_file media-type-icon media-type-icon-posta pl-1" data-media='<?php echo $video_html; ?>' data-toggle="tooltip" data-placement="top" title="Video"></i>
									<?php }
									break;
									// Tipo de contenido: Gif
									case 'gif':
										if (!empty(get_field('gif_news'))){
										$gif_url = get_field('gif_news');
										$gif_html = '<div class="contenedor-media"><img class="contenedor-media-item" src="'.$gif_url.'"></div>'; ?>
										<i class="fas fa-spinner media_file media-type-icon media-type-icon-posta" data-media='<?php echo $gif_html; ?>' data-toggle="tooltip" data-placement="top" title="Gif"></i>
									<?php }
									break;
									// Tipo de contenido: Audio
									case 'audio':
										if (!empty(get_field('audio_news'))){
										$audio_iframe = get_field('audio_news');
										$audio_html = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>'; ?>
										<i class="fas fa-volume-up media_file media-type-icon media-type-icon-posta" data-media='<?php echo $audio_html; ?>' data-toggle="tooltip" data-placement="top" title="Audio"></i>
									<?php }
									break;
									} // End of switch
									} // End of if (content_type)
									?>
								</div>
								<!-- Título de nota -->
								<h1 class="titulo-de-nota h3 pr-8 pr-sm-0">
									<a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo get_the_title(); ?></a>
								</h1>
								<!-- Extracto de nota -->
								<p class="lead m-0 d-none d-lg-block"><?php echo get_the_excerpt(); ?></p>
								<!-- Iconos compartir -->
								<div class="mt-3">
									<?php require get_template_directory() . '/inc/iconos-compartir.php'; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
<?php } ?>