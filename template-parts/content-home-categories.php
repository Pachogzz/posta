<?php
/**
 * Template part for displaying posts categories
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package posta
 * 
 * Este template part es usado para mostrar las secciones mediante carruseles que se encuentran en home
 * 
 */
require get_template_directory() . '/inc/detect_mobile_desktop.php'; 

// Tamaños de imagen destacada
$featured_img_url_small = get_the_post_thumbnail_url(get_the_ID(), '360x202');
$featured_img_url_small_retina = get_the_post_thumbnail_url(get_the_ID(), '720x405');
$featured_img_url_medium = get_the_post_thumbnail_url(get_the_ID(), '550x309');
$featured_img_url_medium_retina = get_the_post_thumbnail_url(get_the_ID(), '1100x618');
$featured_img_url_large = get_the_post_thumbnail_url(get_the_ID(), '1920x1080');
$featured_img_url_large_retina = get_the_post_thumbnail_url(get_the_ID(), '3840x2160');

// De acuerdo al dispositivo y espacio del contenedor de la Imagen destacada ponemos la medida más adecuada
if ($mobile_browser > 0) {
	//print 'is mobile';
	//condicional para los bloques secciones y temas
	if(!empty($GLOBALS['tipo_de_carrusel'])){
		$tipo_de_carrusel = $GLOBALS['tipo_de_carrusel'];
		if($tipo_de_carrusel == 'carrusel-tipo-uno'){
			$featured_img_url = $featured_img_url_small_retina;	
		}elseif($tipo_de_carrusel == 'carrusel-tipo-dos'){
			$featured_img_url = $featured_img_url_small_retina;	
		}
		$tipo_de_carrusel = "";
	}

	//condicional para los carruseles de tema y seccion
	if(!empty($GLOBALS['tipo_de_carrusel_2'])){
		$tipo_de_carrusel = $GLOBALS['tipo_de_carrusel_2'];
		if($tipo_de_carrusel == 'carrusel-tipo-uno'){
			$featured_img_url = $featured_img_url_medium_retina;	
		}elseif($tipo_de_carrusel == 'carrusel-tipo-dos'){
			$featured_img_url = $featured_img_url_medium;	
		}elseif($tipo_de_carrusel == 'carrusel-tipo-tres'){
			$featured_img_url = $featured_img_url_small_retina;	
		}
		$tipo_de_carrusel = "";
	}

}elseif ($tablet_browser > 0) {
	//print 'is tablet';
	//condicional para los bloques secciones y temas
	if(!empty($GLOBALS['tipo_de_carrusel'])){
		$tipo_de_carrusel = $GLOBALS['tipo_de_carrusel'];
		if($tipo_de_carrusel == 'carrusel-tipo-uno'){
			$featured_img_url = $featured_img_url_medium_retina;	
		}elseif($tipo_de_carrusel == 'carrusel-tipo-dos'){
			$featured_img_url = $featured_img_url_small_retina;	
		}
		$tipo_de_carrusel = "";
	}

	//condicional para los carruseles de tema y seccion
	if(!empty($GLOBALS['tipo_de_carrusel_2'])){
		$tipo_de_carrusel = $GLOBALS['tipo_de_carrusel_2'];
		if($tipo_de_carrusel == 'carrusel-tipo-uno'){
			$featured_img_url = $featured_img_url_medium_retina;		
		}elseif($tipo_de_carrusel == 'carrusel-tipo-dos'){
			$featured_img_url = $featured_img_url_medium;		
		}elseif($tipo_de_carrusel == 'carrusel-tipo-tres'){
			$featured_img_url = $featured_img_url_small_retina;	
		}
		$tipo_de_carrusel = "";
	}

}else {
	//print 'is desktop';
	//condicional para los bloques secciones y temas
	if(!empty($GLOBALS['tipo_de_carrusel'])){	
		$tipo_de_carrusel = $GLOBALS['tipo_de_carrusel'];
		if($tipo_de_carrusel == 'carrusel-tipo-uno'){
			$featured_img_url = $featured_img_url_small_retina;		
		}elseif($tipo_de_carrusel == 'carrusel-tipo-dos'){
			$featured_img_url = $featured_img_url_small;		
		}
		$tipo_de_carrusel = "";
	}

	//condicional para los carruseles de tema y seccion
	if(!empty($GLOBALS['tipo_de_carrusel_2'])){
		$tipo_de_carrusel = $GLOBALS['tipo_de_carrusel_2'];
		if($tipo_de_carrusel == 'carrusel-tipo-uno'){
			$featured_img_url = $featured_img_url_medium_retina;		
		}elseif($tipo_de_carrusel == 'carrusel-tipo-dos'){
			$featured_img_url = $featured_img_url_medium;		
		}elseif($tipo_de_carrusel == 'carrusel-tipo-tres'){
			$featured_img_url = $featured_img_url_small_retina;	
		}
		$tipo_de_carrusel = "";
	}
} 

// Si no hay Imagen destacada hace fallback a la imagen definida en opciones del tema
if (empty($featured_img_url)){
	$featured_img_url = get_theme_mod('default_news_image');
}

//
if(!empty($GLOBALS['carrusel_tema'])){
	$categorias = get_the_category(); 
	$name = $categorias[0]->name;
	$category_id = $categorias[0]->term_id;
	$category_link = get_category_link($category_id); // Link de la sección
}
if(!empty($GLOBALS['carrusel_seccion'])){
	$taxonomy_object = get_the_taxonomies();
	$name_tax =  $taxonomy_object["theme"];
	$name = substr($name_tax,6);
	$name_taxonomy=  trim($name,".");
	$tema= get_term_by('name', $name_taxonomy, 'theme');
	$name = $tema->name;
	$category_id = $tema->term_id;
	$category_link = get_category_link($category_id); // Link de la sección
}
?>

<div id="post-<?php the_ID(); ?>">
	<div class="position-relative toto5">
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
			<!-- <a href="<?php// echo $category_link; ?>"><?php// echo $name ?></a> -->
			<!-- Título de nota -->
			<h4 class="titulo-de-nota">
				<a class="stretched-link" href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php the_title(); ?></a>
			</h4>
		</div>
	</div>
	<!-- MODAL ICONOS COMPARTIR -->
	<?php require get_template_directory() . '/inc/modal-compartir.php'; ?>
</div>