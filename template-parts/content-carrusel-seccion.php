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
$category_id = get_sub_field('notas_seccion');
$mostrar_descripcion = get_sub_field('mostrar_descripcion');

$section_name = get_term_by('id', $category_id, 'category');//
//$GLOBALS['carrusel_seccion'] = $section_name;
$slider_type = get_sub_field('tipo_de_carrusel_seccion'); // Tipo de slider
$GLOBALS['tipo_de_carrusel_2'] = $slider_type;
$category_link = get_category_link($category_id); // Link de la sección
$category_description = category_description($category_id); // Descripción de la sección*/
$show_time_ago = get_theme_mod('show_time_ago');
switch ($show_time_ago == 1) {
    case '1':
        $haceTiempo = time_ago() . ' <i class="fas fa-clock"></i>';
    break;
    case '0':
        $haceTiempo = "";
    break;
}

?>
<!-- Contenedor de carusel -->
<div class="container mt-6 container-lg<<<">
	<div class="row">
		<div class="col">

			<!-- ENCABEZADO DE CARRUSEL -->
			<div class="encabezado">
				<h2 class="encabezado-titulo">
					<a class="text-white" href="<?php echo esc_url($category_link); ?>">
						<span class="nombre-sitio">POSTA</span>
						<span class="nombre-taxonomia"><?php echo esc_html($section_name->name);?></span>
						</a>
				</h2>
				<?php if($mostrar_descripcion){ ?>
					<p class="encabezado-descripcion"><?php echo strip_tags($category_description); ?></p>
				<?php } ?>
			</div>

			<!-- CARRUSEL COLECCIÓN -->
			<div id="carousel-<?php echo $category_id; ?>" class="owl-carousel owl-<?php echo $slider_type; ?> <?php echo $slider_type; ?>">
				<?php
					$output = 'objects';
					$args = array (
						'post_type'      => 'post',
						'cat'            => $category_id,
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
					//unset($GLOBALS['carrusel_seccion']);
				?>
				<!-- Link ver más notas -->
				<div class="c-item">
					<a class="item-ver-mas" href="<?php echo esc_url($category_link); ?>" title="Ver más noticias de <?php echo $section_name->name;?>">
						<div class="contenedor-media">
							<div class="contenedor-media-item d-flex flex-column justify-content-center align-items-center">
								<p class="h5 mb-3">Ver más noticias de:</p>
								<h4 class="encabezado-titulo">
									<span class="bg-white text-dark p-3">
										<?php echo esc_html($section_name->name);?>
									</span>
								</h4>
							</div>
						</div>
					</a>
				</div>
			</div>
			
		</div>
	</div>
</div>
<?php unset($GLOBALS['tipo_de_carrusel_2']); ?>