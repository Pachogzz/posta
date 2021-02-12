<?php 
/**
 * Template part for displaying Carruosel Editorials
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package posta
 * 
 * 
 */
$postTypeLink = get_post_type_archive_link( 'perspectivas' );
$tituloBloque = get_sub_field('titulo_bloque_perspectivas');
$colorFondo = get_sub_field('color_fondo_bloque_perspectivas');
$imagenFondo = get_sub_field('imagen_fondo_bloque_perspectivas');
$colorTexto = get_sub_field('color_texto_bloque_perspectivas');
$descripcionBloque = get_sub_field('descripcion_del_bloque_de_perspectivas');
	if (!empty($descripcionBloque)) {
		$descripcionBloque = "<p class='encabezado-descripcion ". $colorTexto ."'>" . get_sub_field('descripcion_del_bloque_de_perspectivas') . "</p>";
	}else{
		$descripcionBloque = "<!-- No hay descripción para mostrar -->";
	}
$numItems = get_sub_field('elementos_a_mostrar');
$mostrarExcerpt = get_sub_field('mostrar_excerpt_perspectivas'); 

// echo "<span class='text-white'><pre>";
// echo "<br>";
// echo $postTypeLink;
// echo "<br>";
// echo $descripcionBloque;
// echo "<br>";
// echo $colorFondo;
// echo "<br>";
// echo $imagenFondo;
// echo "<br>";
// echo $colorTexto;
// echo "<br>";
// echo $numItems;
// echo "<br>";
// echo $mostrarExcerpt;
// echo "</pre></span>";

?>
<section class="bloque_notas-- " style="background-image: url( <?php echo $imagenFondo; ?> ); background-color: <?php echo $colorFondo; ?> !important;">
	<div class="container p-4 p-sm-6" style="background-color: <?php echo $colorFondo; ?> !important;">
		<div class="row">
			<div class="col">

				<!-- ENCABEZADO DE CARRUSEL -->
				<div class="encabezado mb-5 mt-n3">
					<h2 class="encabezado-titulo">
						<span class="nombre-sitio">POSTA</span>
						<span class="nombre-taxonomia">PERSPECTIVAS</span>
					</h2>
					<?php echo $descripcionBloque; ?>
				</div>
				<!-- CARRUSEL OPINIÓN -->
				<div class="owl-carousel owl-theme carrusel-perspectiva">
	                <?php
	                    $args = array (
	                        'post_type'      => 'perspectivas',
	                        'posts_per_page' => $numItems,
	                        'orderby'        => 'date',
	                        'order'          => 'DESC'
	                    );
	                    $the_query = new WP_Query( $args );
						if ( $the_query->have_posts() ) :
							while ( $the_query->have_posts() ) :
								$the_query->the_post(); ?>
								<div class="c-item">
									<?php get_template_part( 'template-parts/content', 'perspectiva' ); ?>
								</div>
								<?php
							endwhile;
						endif;
						wp_reset_postdata();
						//unset($GLOBALS['carrusel_seccion']);
					?>

				</div>
				<!-- Cierre de owl carrusel de perspectivas -->

			</div>
		</div>
	</div>
</section>