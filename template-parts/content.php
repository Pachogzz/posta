<?php
/**
 * Template part for displaying posts categories
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 * Accedes a el si existe una llamada de un get_template_part y esta funcion no encuentra el template part.
 * 
 */
  
// Imagen destacada
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), '720x405');
if (empty($featured_img_url)){
  $featured_img_url = get_theme_mod('default_news_image');
}
?>

<!-- Item (nota) dentro del grid  -->
<div id="post-<?php the_ID(); ?>" class="col-md-6 col-lg-4 mb-5">

  <div class="position-relative">
    <!-- IMAGEN DE NOTA -->
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
    <!-- ENCABEZADO DE NOTA -->
    <div class="encabezado-nota mt-2">
      <h5 class="titulo-de-nota">
        <a class="stretched-link" href="<?php the_permalink(); ?>" title="<?php echo esc_html(get_the_title()); ?>"><?php echo esc_html(get_the_title()); ?></a>
      </h5>
    </div>
  </div>
  <!-- ICONOS COMPARTIR -->
  <?php require get_template_directory() . '/inc/iconos-compartir.php'; ?>

</div>