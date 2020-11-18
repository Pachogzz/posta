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
/* Obtener el nombre y color de las secciones */

$theme_id = get_sub_field('notas_tema');
$mostrar_descripcion = get_sub_field('mostrar_descripcion');

$tema = get_term_by('id', $theme_id, 'theme');
$taxonomy_name = $tema->taxonomy;
$taxonomy_term = $tema->name;
$tema_description = $tema->description;
$GLOBALS['carrusel_tema'] = $tema;
$tipo_de_carrusel_tema = get_sub_field('tipo_de_carrusel_tema'); // Tipo de slider
$GLOBALS['tipo_de_carrusel_2'] = $tipo_de_carrusel_tema;
$category_link = get_category_link($theme_id); // Link de la sección
$category_description = category_description($theme_id); // Descripción de la sección*/
?>

<!-- Contenedor de carusel -->
<div class="container mt-6 container-lg<<<">
	<div class="row">
		<div class="col">

			<!-- ENCABEZADO DE CARRUSEL -->
			<div class="encabezado">
				<h2 class="encabezado-titulo flecha">
					<a href="<?php echo esc_url($category_link); ?>"><?php echo $taxonomy_term;?></a>
				</h2>
				<?php if($mostrar_descripcion){?>
					<p class="encabezado-descripcion"><?php echo $tema_description; ?></p>
				<?php } ?>
			</div>
			
			<!-- CARRUSEL TEMA -->
			<div id="carousel-<?php echo $theme_id; ?>" class="owl-carousel <?php echo $tipo_de_carrusel_tema; ?>">
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
					'posts_per_page' => 6,
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
				unset($GLOBALS['carrusel_tema']);
				unset($GLOBALS['tipo_de_carrusel_2']);
				?>
				<!-- Link ver más notas -->
				<div class="c-item">
					<a class="item-ver-mas" href="<?php echo esc_url($category_link); ?>" title="Ver más noticias de <?php echo $taxonomy_term;?>">
						<div class="contenedor-media">
							<div class="contenedor-media-item d-flex flex-column justify-content-center align-items-center p-5">
								<p class="h5 m-0">Ver más noticias de</p>
								<h4 class="encabezado-titulo flecha"><?php echo $taxonomy_term;?></h4>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>