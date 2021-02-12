<?php
/**
 * Template part for displaying posts categories
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 * Accedes a el si existe una llamada de un get_template_part y esta funcion no encuentra el template part.
 * 
 */
  
// Imagen destacada
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), '720x405');
if (empty($featured_img_url)){
  $featured_img_url = get_theme_mod('default_news_image');
}
$sections = get_the_category(get_the_ID(), 'category');
foreach ($sections as $key => $value) {
	if ($value->parent > 0) {
		$sectionsChild = $value->term_id;
		$sectionsName = $value->name;
		break;
	}
}
$themes = get_the_terms(get_the_ID(), 'post_tag');

$tax_color = get_term_meta( $sectionsChild, 'category_color', true );

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

<!-- Item (nota) dentro del grid  -->
<div id="post-<?php the_ID(); ?>" class="bloque-nota-archivo nota col-md-6 col-lg-4 mb-5">
	<div class="row mb-0 meta">
			<!-- Nombre del tema -->
			<?php 
			// echo "<pre>";
			// print_r($sectionsChild);
			// echo "</pre>";
			// $sections = $sections[0];
			if(!empty($themes)){
				echo "<div class='col-6 categoria' style='background-color:#" . $tax_color . "!important;'>";
				$section_link  = get_category_link($sectionsChild);
				echo $theme_name = '
					<a class="text-white p-0 mr-1" href="'.esc_url($section_link).'">
						<small>'.$sectionsName.'</small>
					</a>
					<span class="side-triangle" style="background-color:#' . $tax_color . '!important;"></span>';
				echo "</div>";
			} else {
				echo "<div class='col-6 categoria' style='background-color:#" . $tax_color . "!important;'>";
				$section_link  = get_category_link($sectionsChild);
				echo $theme_name = '
					<a class="text-white p-0 mr-1" href="'.esc_url($section_link).'">
						<small>'.$sectionsName.'</small>
					</a>
					<span class="side-triangle" style="background-color:#' . $tax_color . '!important;"></span>';
				echo "</div>";
			}?>
            <div class="col hora text-right">
                <small><?php echo $haceTiempo; ?></small>
            </div>
	</div>
<?php require get_template_directory() . '/template-parts/content-tipo.php'; ?>
  <div class="position-relative bloque_notas--">
    <!-- IMAGEN DE NOTA -->
    <div class="contenedor-media d-flex justify-content-center align-items-center" style="background-image: url( <?php echo $featured_img_url; ?> );">
    </div>
    <!-- ENCABEZADO DE NOTA -->
    <div class="encabezado-nota mt-4">
      <h5 class="titulo-de-nota font-weight-bolder">
        <a class="stretched-link" href="<?php the_permalink(); ?>" title="<?php echo esc_html(get_the_title()); ?>"><?php echo esc_html(get_the_title()); ?></a>
      </h5>
    </div>
  </div>
  <!-- ICONOS COMPARTIR -->
  <!-- </?php require get_template_directory() . '/inc/iconos-compartir.php'; ?> -->

</div>