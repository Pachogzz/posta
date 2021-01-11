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
// $category_name = get_color_taxonomy($taxonomy_object);

$category = get_category( $taxonomy_object );
$category_name = $category->name;
$category_description = $category->description;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main pt-8 pb-4">

		<!-- TÍTULO DE TAXONOMÍA -->
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="encabezado text-center m-0">
						<h2 class="encabezado-titulo">
							<span class="nombre-sitio">POSTA</span>
							<span class="nombre-taxonomia"><?php echo $category_name; ?></span>
						</h2>
						<!-- <p class="encabezado-descripcion"></?php echo $category_description; ?></p> -->
					</div>
				</div>
			</div>
		</div>

		<!-- GRID -->
		<div class="container-fluid grid-notas px-6 mt-6">
			<div class="row">
				<div class="col-lg-auto px-0 d-none d-xl-block" style="max-width: 185px;">
					<div style="border: 1px dotted red;">
						<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/160x600">
						<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
					</div>
				</div>
				<div class="col">
					<?php
					// Columnas
					if (!empty(get_query_var('cat'))){
						$taxonomy_term = get_query_var('cat');
						$taxonomy_name = $taxonomy_object->taxonomy;
						$args = array(
							'suppress_filters' => true,
							'post_type' => 'post',
							'posts_per_page' => 13,
							'post_status' => array(
								'publish',
							),
							'cat' => $taxonomy_term,
							'orderby' => 'date',
							'order' => 'DESC',
							'paged' => $paged
						);
					// Columnista
					}else if ($taxonomy_object->taxonomy == "theme" || "post_tag"){
						$taxonomy_term = $taxonomy_object->name;
						$taxonomy_name = $taxonomy_object->taxonomy;

						$args = array(
							'suppress_filters' => true,
							'post_type' => 'post',
							'posts_per_page' => 13,
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
						<div id="ajax-posts" class="row category">
							<?php
							while ( $the_query->have_posts() ) : $the_query->the_post();
								get_template_part( 'template-parts/content', 'content' );
							endwhile;
							?>
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
				<div class="col-lg-auto px-0 d-none d-xl-block" style="max-width: 185px;">
					<div style="border: 1px dotted red;">
						<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/160x600">
						<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
					</div>
				</div>
			</div>
		</div>

		<!-- PUBLICIDAD -->
		<div class="container mt-8">
			<div class="row">
				<div class="col">
					<div style="border: 1px dotted red;">
						<?php if (function_exists ('adinserter')) echo adinserter (7); ?>
						<!-- <img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/728x90"> -->
						<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
					</div>
				</div>
			</div>
		</div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();