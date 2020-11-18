<?php 
/**
 * Template part for displaying Top Stories
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 * 
 */
require get_template_directory() . '/inc/detect_mobile_desktop.php';
$portada = get_sub_field('portada');
 if($portada){?>
	<div class="container-fluid top-stories p-0 mt-6 indicador-elemento">
		<div class="owl-carousel carrusel-portada">
			<?php
			foreach ($portada as $post) {
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
					$featured_img_url = $featured_img_url_medium_retina;
				}elseif ($tablet_browser > 0) {
					//print 'is tablet';
					$featured_img_url = $featured_img_url_large;
				}else {
					//print 'is desktop';
					$featured_img_url = $featured_img_url_large;
				} ?>
				<div>
					<!-- IMAGEN DE NOTA -->
					<div class="contenedor-media contenedor-carrusel-portada<<<" style="background-image: url(<?php echo $featured_img_url ?>); background-size: cover; background-position: center center;">
						<a class="link-a-nota " href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"></a>
					</div>
					<!-- ENCABEZADO NOTA -->
					<div class="container encabezado-nota position-relative mt-n5 mt-md-n6">
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
												if (!empty(get_field('video_jwplayer'))){
													$video_iframe = get_field('video_jwplayer');
													$url_imagen_video = get_field('url_imagen_video');
													$video_html = '<div class="contenedor-media">'.$video_iframe.'</div>'; ?>
													<i class="fas fa-play media_file_jw media-type-icon media-type-icon-posta pl-1" 
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
														<i class="fas fa-play media_file media-type-icon media-type-icon-posta pl-1" data-titulo='<?php echo get_the_title(); ?>' data-media='<?php echo $video_html; ?>'></i>
														<?php 
													}
												}	
											break;
											// Tipo de contenido: Audio
											case 'audio':
												if (!empty(get_field('audio_news'))){
													$audio_iframe = get_field('audio_news');
													$audio_html = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>'; ?>
													<i class="fas fa-volume-up media_file media-type-icon media-type-icon-posta" data-media='<?php echo $audio_html; ?>'></i>
													<?php
												}
											break;
										} // End of switch
									} // End of if (content_type)
									?>
								</div>
								<!-- Título de nota -->
								<h1 class="display-4 titulo-de-nota pr-8 pr-sm-0">
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