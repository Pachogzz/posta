<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 */

get_header();

$taxonomy_object = $wp_query->get_queried_object();

$perspectiva = get_category( $taxonomy_object );
$perspectiva_name = $perspectiva->name;
// $perspectiva_description = $perspectiva->description;
$tax_color = get_term_meta( $perspectiva->term_id, 'category_color', true );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main pt-8 pb-4">

		<!-- TÍTULO DE TAXONOMÍA -->
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="encabezado text-center m-0">
						<h2 class="encabezado-titulo" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
							<span class="nombre-sitio">POSTA</span>
							<span class="nombre-taxonomia"><?php echo $perspectiva_name; ?></span>
						</h2>
						<!-- <?php //if (!empty($perspectiva_description)): ?> -->
						<!-- <p class="encabezado-descripcion"><?php //echo $perspectiva_description; ?></p> -->
						<!-- <?php //endif ?> -->
					</div>
				</div>
			</div>
		</div>

		<!-- GRID -->
		<div class="container-fluid grid-notas px-6 mt-6">
			<div class="row">
				<div class="col-lg-auto px-0 d-none d-xl-block" style="max-width: 185px;">
					<div class=" modulo-publicidad">
						<!-- <img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/160x600"> -->
						<small><span class="text-dark">Publicidad</span></small>
					</div>
				</div>
				
				<div class="col">
					<?php

					// Todas las perspectivas
					$args = array(
						'post_type' => 'perspectivas',
						'posts_per_page' => 9,
						'post_status' => array(
							'publish',
						),
						'orderby' => 'date',
						'order' => 'DESC',
						'paged' => $paged
					);
					$output = 'objects';
					$the_query = new WP_Query( $args );
					if ( $the_query->have_posts() ) :
						?>
						<div id="ajax-posts" class="row category">
							<?php
							while ( $the_query->have_posts() ) : $the_query->the_post();
								get_template_part( 'template-parts/content', 'perspectiva' );
							endwhile;
							?>
						</div>
						<div class="row">
							<div class="col-12 paginacion mt-5">
								<?php echo pagination(); ?>
							</div>
						</div>

						<!-- Mensaje si no hay notas en la categoría -->
						<?php
					else:
						echo '<p class="lead text-center mb-0 py-10 text-muted">No se encontraron notas.</p>';
					endif;
					?>
				</div>
				<div class="col-lg-auto px-0 d-none d-xl-block" style="max-width: 185px;">
					<div class=" modulo-publicidad">
						<!-- <img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/160x600"> -->
						<small><span class="text-dark">Publicidad</span></small>
					</div>
				</div>
			</div>
		</div>

		<!-- PUBLICIDAD -->
		<div class="container mt-8">
			<div class="row">
				<div class="col">
					<!-- <div class="border modulo-publicidad">
						<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/728x90">
						<small>Publicidad</small>
					</div> -->
				</div>
			</div>
		</div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();