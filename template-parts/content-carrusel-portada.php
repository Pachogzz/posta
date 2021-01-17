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
$estilo_carusel = get_sub_field('estilo_de_carusel');
$show_time_ago = get_theme_mod('show_time_ago');
switch ($show_time_ago == 1) {
    case '1':
        $haceTiempo = time_ago() . ' <i class="fas fa-clock"></i>';
    break;
    case '0':
        $haceTiempo = "";
    break;
}
switch ($estilo_carusel) {
    case 'estilo_de_carusel':
        $estilo_carusel = 'simple';
    break;

    case 'estilo_de_carusel':
        $estilo_carusel = 'cuadricula';
    break;

    case 'estilo_de_carusel':
        $estilo_carusel = 'verticales';
    break;
}

 if($portada){?>
	<div class="container-fluid p-0 mt-6 indicador-elemento">
		<div class="owl-carousel carrusel-portada<?php echo "-" . $estilo_carusel; ?>">
			<?php
			require get_template_directory() . '/inc/detect_mobile_desktop.php'; 
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
					$featured_img_url = $featured_img_url_small_retina;
				}elseif ($tablet_browser > 0) {
					//print 'is tablet';
					$featured_img_url = $featured_img_url_medium_retina;
				}else {
					//print 'is desktop';
					$featured_img_url = $featured_img_url_large;
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
				<div>
					<!-- IMAGEN DE NOTA -->
					<div class="contenedor-media d-flex justify-content-center align-items-center" style="background-image: url( <?php echo get_the_post_thumbnail_url(get_the_ID(),'1920x1080'); ?> );">
						<a class="link-a-nota" href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"></a>
						<!-- ENCABEZADO NOTA -->
						<div class="container-fluid encabezado-nota position-relative align-self-end py-6">
							<div class="container row mx-auto">
							<!-- <div class="row justify-content-center"> -->
								<div class="col-md-12 col-lg-10 px-3 px-md-4">
									<div class="w-100">
										<!-- <pre class="text-white">
										<//?php 
											print_r($categoria);
											echo "<hr>";
											echo $tax_color;
										 ?>
										</pre> -->
									</div>
									<!-- Icono tipo de contenido -->
									<?php require get_template_directory() . '/template-parts/content-tipo.php'; ?>
									<!-- Título de nota -->
									<div class="row mb-3 meta">
			                            <div class="col-6 col-md-4 categoria" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
			                                <a class="text-white" href="<?php echo $category_link; ?>">
			                                    <small><?php echo $category_name; ?></small>
			                                </a>
			                                <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
			                            </div>
			                            <div class="col-6 col-md-4 hora text-white text-right">
			                                <small><?php echo $haceTiempo; ?></small>
			                            </div>
									</div>
									<div class="clearfix"></div>
									<h1 class="titulo-de-nota h3 pr-8 pr-sm-0">
										<a class="text-white" href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo get_the_title(); ?></a>
									</h1>
									<!-- Extracto de nota -->
									<!-- <p class="lead m-0 d-none d-lg-block"></?php echo get_the_excerpt(); ?></p> -->
									<!-- Iconos compartir -->
									<!-- <div class="mt-3">
										</?php require get_template_directory() . '/inc/iconos-compartir.php'; ?>
									</div> -->
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