<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package posta
 */
	// Imagen destacada
  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
  if (empty($featured_img_url)){
    $featured_img_url = get_theme_mod('default_news_image');
  }
?>

<!-- Item (nota) dentro del grid  -->
<div id="post-<?php the_ID(); ?>" class="col-md-6 col-lg-4 mb-6">
  
	<div class="nota-item">

    <!-- *imagen de nota -->
    <div class="contenedor-media embed-responsive-z100-tc d-flex justify-content-start align-items-start p-2" style="background-image: url( <?php echo $featured_img_url; ?> );"><a class="link-a-nota" href="<?php the_permalink(); ?>"></a>

      <!-- *tipo de contenido -->
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
              <i class="fas fa-play media_file media-type-icon pl-1" data-media='<?php echo $video_html; ?>' data-toggle="tooltip" data-placement="right" title="Video"></i>
      <?php           
            }
          break;
          // Tipo de contenido: Video de Facebook
          case 'facebook':
            if (!empty(get_field('video_facebook_news'))){
              $url_video = get_field('video_facebook_news');
              $video_iframe = '<iframe src="https://www.facebook.com/plugins/video.php?href='.$url_video.'&mute=0" allow="encrypted-media" allowFullScreen="true" data-autoplay="true">';
              $video_html = '<div class="contenedor-media">'.$video_iframe.'</div>'; ?>
              <i class="fas fa-play media_file media-type-icon pl-1" data-media='<?php echo $video_html; ?>' data-toggle="tooltip" data-placement="right" title="Video"></i>
      <?php
            }
          break;
          // Tipo de contenido: Gif
          case 'gif':
            if (!empty(get_field('gif_news'))){
              $gif_url = get_field('gif_news');
              $gif_html = '<div class="contenedor-media"><img class="contenedor-media-item" src="'.$gif_url.'"></div>'; ?>
              <i class="fas fa-spinner media_file media-type-icon" data-media='<?php echo $gif_html; ?>' data-toggle="tooltip" data-placement="right" title="Gif"></i>
      <?php 
            }
          break;
          // Tipo de contenido: Audio
          case 'audio':
            if (!empty(get_field('audio_news'))){
              $audio_iframe = get_field('audio_news');
              $audio_html = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>'; ?>
              <i class="fas fa-volume-up media_file media-type-icon" data-media='<?php echo $audio_html; ?>' data-toggle="tooltip" data-placement="right" title="Audio"></i>
      <?php
            }
          break;
        }
      } ?>

      <!-- *icono de compartir -->
      <i class="fas fa-share-alt share-from-modal share-icon" data-title="<?php echo esc_html(get_the_title()); ?>" data-excerpt="" data-link="<?php the_permalink(); ?>" data-img="<?php echo $featured_img_url; ?>" data-toggle="tooltip" data-placement="left" title="Compartir"></i>

    </div>

    <!-- Encabezado de nota -->
    <div class="encabezado-nota">
      <!-- *titulo de nota -->
      <h4 class="titulo-de-nota">
        <a class="texto-blanco" href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a>
      </h4>

      <!-- *hashtags de nota -->
      <?php
        $hashtags = get_the_tags();
        if ($hashtags){
          foreach($hashtags as $hashtag){
            echo '<a class="d-inline-block mr-2" href="' . get_tag_link($hashtag->term_id) . '">#'.$hashtag->name.'</a>';
          }
        }
      ?>
    </div>

  </div>
</div>