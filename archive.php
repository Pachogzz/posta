<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package posta
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

// if ( isset($_GET['f']) ) {
// 	// load depending the filter value
// 	if ( $_GET['f']=='recent-added' ) {
// 		$filter_type = 'recent-added';
// 		$rp_class = 'link-filtro-2-activo';
// 		$mv_class = 'link-filtro-2';
// 	} else if ( $_GET['f']=='most-viewed' ) {
// 		$filter_type = 'most-viewed';
// 		$rp_class = 'link-filtro-2';
// 		$mv_class = 'link-filtro-2-activo';
// 	} else {
// 		$filter_type = 'recent-added';
// 		// load by defaul the most recents
// 		$rp_class = 'link-filtro-2-activo';
// 		$mv_class = 'link-filtro-2';
// 	}
// } else {
// 	$filter_type = 'recent-added';
// 	// load by defaul the most recents
// 	$rp_class = 'link-filtro-2-activo';
// 	$mv_class = 'link-filtro-2';
// }
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
		<div class="container-xl grid-notas mt-6">
			<div class="row">
				<div class="col-lg-auto px-0 d-none d-xl-block toto1" style="width: 170px;">
					<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/160x600" alt="publicidad">
					<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
				</div>
				<div class="col toto2">
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
							'posts_per_page' => 9,
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

						<!-- *botón cargar notas por ajax -->
						<!--<div class="row mt-3">
							<div class="col text-center">
								<button id="more_posts" class="btn btn-secondary in-line" data-taxonomy="<?php //echo $taxonomy_name; ?>" 
									data-category="<?php //echo $taxonomy_term; ?>" data-post-type="post" data-filter-type="<?php //echo $filter_type; ?>">
									Cargar mas notas
								</button>
								<div class="ajax-response-failed"></div>
								<i class="fas fa-circle-notch fa-spin hidden spinner load-<?php //echo $category_id; ?>"></i>
							</div>
						</div>-->

						<!-- Mensaje si no hay notas en la categoría -->
						<?php
					else:
						echo '<p class="lead text-center mb-0 py-10 text-muted">No se encontraron notas.</p>';
					endif;
					?>
				</div>
				<div class="col-lg-auto px-0 d-none d-xl-block toto1" style="width: 170px;">
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
