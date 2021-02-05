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
<section class="bloque_notas-- py-6" style="background-image: url( <?php echo $imagenFondo; ?> ); background-color: <?php echo $colorFondo; ?> !important;">
	<div class="container mt-6 container-lg">
		<div class="row">
			<div class="col">

				<div class="modulo-corchete-lg">
					<!-- ENCABEZADO DE CARRUSEL -->
					<div class="encabezado mb-5 mt-n3">
						<h2 class="encabezado-titulo text-white">
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
						<!-- Link ver más notas -->
						<div class="c-item my-5" style="min-height: 275px;">
							<a class="item-ver-mas my-10" href="<?php echo $postTypeLink; ?>" title="Ver más Perspectivas">
								<div class="contenedor-media h-100">
									<div class="contenedor-media-item d-flex flex-column justify-content-center align-items-center h-100">
										<p class="h5 mb-3">Ver más:</p>
										<h4 class="encabezado-titulo">
											<span class="bg-white text-dark p-3">
												Perspectivas
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
	</div>
</section>