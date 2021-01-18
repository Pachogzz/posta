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

$category = get_category( $taxonomy_object );
$category_name = $category->name;
$category_description = $category->description;
$tax_color = get_term_meta( $category->term_id, 'category_color', true );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$queriedObjetc = get_queried_object();
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
							<span class="nombre-taxonomia"><?php echo $category_name; ?></span>
						</h2>
						<p class="encabezado-descripcion text-white mt-3"><?php echo $category_description; ?></p>
					</div>
				</div>
			</div>
		</div>

		<!-- GRID -->
		<div class="container-fluid grid-notas px-6 mt-6">
			<div class="row">
				<div class="col-lg-1 px-0 d-none d-xl-block" style="max-width: 185px;">
					<!-- <div class="border modulo-publicidad">
						<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/160x600">
						<small>Publicidad</small>
					</div> -->
				</div>
				<div class="col">

					<?php 
					// Section related themes on archive ( childs )
					$termchildren = get_term_children( $taxonomy_object->term_id, $taxonomy_object->taxonomy );

					// Themes related parent/childs on archive ( parent/childs )
					$ancestorOfChildID = get_ancestors( $taxonomy_object->term_id, $taxonomy_object->taxonomy );

					if (count($ancestorOfChildID) == 0) {
						echo "<ul id='term-list-filter' class='nav nav-pills justify-content-center mb-6'>";
						foreach ($termchildren as $child) {
							$tax_color = get_term_meta( $child, 'category_color', true );
							echo "<li class='nav-item mr-2 lead'>
									<a href=". get_term_link($child) ." title='" . get_cat_name($child) . "' style='background-color:#" . $tax_color . "!important;'>" 
										. get_cat_name($child) . 
									"</a>
								</li>";
						}
						echo "</ul>";
					} elseif (count($ancestorOfChildID) > 0) {
						$ancestorArray = get_term($ancestorOfChildID[0], $taxonomy_object->taxonomy);
						$ancestorChilds = get_term_children( $ancestorArray->term_id, $ancestorArray->taxonomy );
						$taxQueriedObject = get_queried_object();
						echo "<ul id='term-list-filter' class='nav nav-pills justify-content-center mb-6'>";
						foreach ($ancestorChilds as $child) {
							if ( $taxQueriedObject->term_id != $child ) {
								$tax_color = get_term_meta( $child, 'category_color', true );
								echo "<li class='nav-item mr-2 lead'>
										<a href=". get_term_link($child) ." title='" . get_cat_name($child) . "' style='background-color:#" . $tax_color . "!important;'>" 
											. get_cat_name($child) . 
										"</a>
									</li>";
							}
						}
						echo "</ul>";
					}
					
					// echo "<pre><span class='text-white'>";
					// var_dump($ancestorOfChildID);
					// echo "<hr class='border-light'>";
					// var_dump($ancestorArray);
					// echo "<hr class='border-warning'>";
					// var_dump($ancestorChilds);
					// echo "<hr class='border-info'>";
					// var_dump($taxQueriedObject);
					// echo "</span></pre>";

					// if (!empty(get_query_var('cat'))){
					if (is_tax()){
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
					// Hashtags
					}else if ($taxonomy_object->taxonomy == "fuente" || "post_tag"){
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
				<div class="col-lg-1 px-0 d-none d-xl-block" style="max-width: 185px;">
					<!-- <div class="border modulo-publicidad">
						<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/160x600">
						<small>Publicidad</small>
					</div> -->
				</div>
			</div>
		</div>

		<!-- PUBLICIDAD -->
		<!-- <div class="container mt-8">
			<div class="row">
				<div class="col">
					<div class="">
						<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/728x90">
						<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
					</div>
				</div>
			</div>
		</div> -->

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();