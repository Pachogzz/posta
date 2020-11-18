<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 */

get_header();

// Obtener el color de la taxonomia
global $wp_query;
$taxonomy_object = $wp_query->get_queried_object();
require get_template_directory() . '/inc/color_categories.php';
$category_name = get_color_taxonomy($taxonomy_object);

$category = get_category( $taxonomy_object );
$category_name = $category->name;
$category_description = $category->description;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main py-8">

		<!-- TÍTULO DE TAXONOMÍA -->
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="encabezado text-center m-0">
						<h2 class="encabezado-titulo flecha"><?php echo $category_name; ?></h2>
						<p class="encabezado-descripcion"><?php echo $category_description; ?></p>
					</div>
				</div>
			</div>
		</div>

		<!-- GRID -->
		<div class="container-fluid grid-notas px-6 mt-6">
			<div class="row">
				<div class="col-lg-auto px-0 d-none d-xl-block" style="width: 170px;">
					<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/160x600" alt="publicidad">
					<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
				</div>
				<div class="col">
					<?php
					// Secciones
					if (!empty(get_query_var('cat'))){
						$taxonomy_term = get_query_var('cat');
						$taxonomy_name = $taxonomy_object->taxonomy;
						$args = array(
							'suppress_filters' => true,
							'post_type' => 'post',
							'posts_per_page' => 12,
							'post_status' => array(
								'publish',
							),
							'cat' => $taxonomy_term,
							'orderby' => 'date',
							'order' => 'DESC',
							'paged' => $paged
						);
					// Temas o hashtags
					}else if ($taxonomy_object->taxonomy == "theme" || "post_tag"){
						$taxonomy_term = $taxonomy_object->name;
						$taxonomy_name = $taxonomy_object->taxonomy;

						$args = array(
							'suppress_filters' => true,
							'post_type' => 'post',
							'posts_per_page' => 12,
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
							'order' => 'DESC',
							'paged' => $paged
						);
					}else{
						$args = array();
					}

					$output = 'objects';

					$the_query = new WP_Query( $args, $output );
					if ( $the_query->have_posts() ) :
						?>
						<div id="ajax-posts" class="row">
						<?php
							while ( $the_query->have_posts() ) : $the_query->the_post();

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
                    <div class="categoria">
                      <?php $category_object = get_the_category();
                      $category_id = $category_object[0]->term_id;
                      $category_name = $category_object[0]->name; //nombre de la sección
                      $category_link = get_category_link($category_id); // Link de la sección ?>
                      <a href="<?php echo $category_link; ?>"><?php echo $category_name ?></a>
                    </div>
                    <h5 class="titulo-de-nota">
                      <a class="stretched-link" href="<?php the_permalink(); ?>" title="<?php echo esc_html(get_the_title()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                    </h5>
                  </div>
                </div>
                <!-- ICONOS COMPARTIR -->
                <?php require get_template_directory() . '/inc/iconos-compartir.php'; ?>

							</div>

						<?php endwhile; ?>
						</div>
						<div class="paginacion mt-5">
							<?php
								echo pagination();
							?>
						</div>

						<!-- Mensaje si no hay notas en la categoría -->
						<?php
					else:
						echo '<p class="lead text-center mb-0 py-10 text-muted">No se encontraron notas.</p>';
					endif;
					?>
				</div>
				<div class="col-lg-auto px-0 d-none d-xl-block" style="width: 170px;">
					<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/160x600" alt="publicidad">
					<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
				</div>
			</div>
		</div>

		<!-- PUBLICIDAD -->
		<div class="container mt-8">
			<div class="row">
				<div class="col">
					<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/728x90" alt="publicidad">
					<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
				</div>
			</div>
		</div>

	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();