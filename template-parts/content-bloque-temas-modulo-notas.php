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
 <div class="container mt-7 container-lg">
	<div class="row">
					
<div class="col-md-12 col-lg-8">
	<?php 
	if(have_rows('temas')){
        while(have_rows('temas')){ the_row();
            $tema_id = get_sub_field('tema');
			$tipo_de_carrusel = get_sub_field('tipo_de_carrusel');
			$mostrar_descripcion = get_sub_field('mostrar_descripcion');
			$GLOBALS['tipo_de_carrusel'] = $tipo_de_carrusel;
			if($tema_id){
			
                $tema= get_term_by('id', $tema_id, 'theme');
                $taxonomy_name = $tema->taxonomy;
                $taxonomy_term = $tema->name;
                $nombre_tema = $tema->name;
				$category_description = $tema->description;
				
				//get_color_taxonomy($category->name);
				$tema_link  = get_category_link($tema_id); // Link de la sección
				?>
				<!-- Contenedor de carusel -->
				<div class="container mt-7 container-lg">
					<div class="row">
						<div class="col">
							<!-- *título de sección -->
							<h2 class="titulo-seccion">
								<a class="texto-negro" href="<?php echo esc_url($tema_link); ?>"><?php echo $nombre_tema;?></a>
							</h2>
							<?php 
								if($mostrar_descripcion){ ?>
									<p class="encabezado-descripcion"><?php echo $category_description; ?></p>
							<?php	}	?>
							<div class="borde my-3"></div>
							<div class="row mb-3 links-to-filter-publications-<?php echo $tema_id; ?>">
								
								<!-- *filtros de carusel de sección -->
								<div class="col-sm-auto hidden offset-sm-1 d-none d-md-block text-right">
									<!-- **link filtro más reciente -->
									<a class="rpl-<?php echo $tema_id; ?> recent_added_posts text-white link-filtro-activo p-2"
										href="javascript:void(0)" data-category="<?php echo $tema_id; ?>"
										data-post-type="post" data-filter-type="recent_added"
										data-carousel-type="<?php echo $tipo_de_carrusel; ?>">
										<i class="fa fa-circle d-inline rpl-circle-<?php echo $tema_id; ?>"></i> Más reciente
									</a>
									<!-- **link filtro más visto -->
									<a class="mvl-<?php echo $tema_id; ?> more_viewed_posts link-filtro p-2"
										href="javascript:void(0)" data-category="<?php echo $tema_id; ?>"
										data-post-type="post" data-filter-type="most_viewed"
										data-carousel-type="<?php echo $tipo_de_carrusel; ?>">
										<i class="fas fa-circle d-none mvl-circle-<?php echo $tema_id; ?>"></i> Más visto
									</a>
								</div>
							</div>
							<!-- *carusel de notas -->
							<div id="carousel-<?php echo $tema_id; ?>" class="owl-carousel owl-<?php echo $tipo_de_carrusel; ?> <?php echo $tipo_de_carrusel; ?>">
								<?php
								$output = 'objects';
								$args = array ( 
                                    'suppress_filters' => true,
                                    'post_type' => 'post', 
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
								<!-- **botón ver mas notas -->
								<div class="c-item background-amarillo p-2">
									<a class="texto-blanco text-center text-uppercase" href="<?php echo esc_url($tema_link); ?>" title="Ver más notas">
										<div class="contenedor-media">
											<div class="contenedor-media-item item-ver-mas">
												<h4 class="m-0">Ver más notas</h4>
											</div>
										</div>
									</a>
								</div>
							</div>
							<!-- *icono cargar notas por ajax -->
							<div class="row">
								<div class="col">
									<i class="fas fa-circle-notch fa-spin hidden spinner load-<?php echo $tema_id; ?>"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
			}
			wp_reset_postdata(); 
			unset($GLOBALS['tipo_de_carrusel']);	
		}//endwhile
	}//endif?>
</div>

<div class="col-md-12 col-lg-4">
	<div class="modulo-corchete">
		<?php 
		if(have_rows('modulo_notas_2')){
			while(have_rows('modulo_notas_2')){ the_row();
				$titulo_modulo_2  = get_sub_field('titulo_modulo_2');
				if(!empty($titulo_modulo_2)){
					$titulo = '<h4 class="encabezado-titulo flecha text-break position-relative mt-3 mb-5">'.$titulo_modulo_2.'</h4>';
				}
				$notas_modulo_2 =  get_sub_field('notas_modulo_2');?>
				<?php 
				if($notas_modulo_2){ ?>
					<!-- ENCABEZADO DE MÓDULO -->
					<?php echo $titulo; ?>
					<!-- NOTAS EN MÓDULO -->
					<?php
					foreach ($notas_modulo_2 as $post) {
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
							$featured_img_url = $featured_img_url_medium;		
						}elseif ($tablet_browser > 0) {
							//print 'is tablet';
							$featured_img_url = $featured_img_url_medium_retina;	
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
						</div>
						<div class="borde my-3"></div>    
						<?php 
					}
					wp_reset_postdata();
				}
				wp_reset_postdata();?>
				<?php 
			} //endwhile	
		}//endif?>
		<div class="box-banner">
			<img class="img-fluid" src="https://via.placeholder.com/300x250?text=box%20banner" alt="">
		</div>
	</div>
</div>


	</div>
</div>	