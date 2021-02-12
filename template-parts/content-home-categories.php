<?php
/**
 * Template part for displaying posts categories
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 * Este template part es usado para mostrar las secciones mediante carruseles que se encuentran en home
 * 
 */
require get_template_directory() . '/inc/detect_mobile_desktop.php'; 

// Tamaños de imagen destacada
$featured_img_url_small = get_the_post_thumbnail_url(get_the_ID(), '360x202');
$featured_img_url_small_retina = get_the_post_thumbnail_url(get_the_ID(), '720x405');
$featured_img_url_medium = get_the_post_thumbnail_url(get_the_ID(), '550x309');
$featured_img_url_medium_retina = get_the_post_thumbnail_url(get_the_ID(), '1100x618');
$featured_img_url_large = get_the_post_thumbnail_url(get_the_ID(), '1920x1080');
$featured_img_url_large_retina = get_the_post_thumbnail_url(get_the_ID(), '3840x2160');

// De acuerdo al dispositivo y espacio del contenedor de la Imagen destacada ponemos la medida más adecuada
if ($mobile_browser > 0) {
	//print 'is mobile';
	//condicional para los bloques secciones y temas
	if(!empty($GLOBALS['tipo_de_carrusel'])){
		$tipo_de_carrusel = $GLOBALS['tipo_de_carrusel'];
		if($tipo_de_carrusel == 'carrusel-tipo-uno'){
			$featured_img_url = $featured_img_url_small_retina;
		}elseif($tipo_de_carrusel == 'carrusel-tipo-dos'){
			$featured_img_url = $featured_img_url_small_retina;	
		}
		$tipo_de_carrusel = "";
	}

	//condicional para los carruseles de tema y seccion
	if(!empty($GLOBALS['tipo_de_carrusel_2'])){
		$tipo_de_carrusel = $GLOBALS['tipo_de_carrusel_2'];
		if($tipo_de_carrusel == 'carrusel-tipo-uno'){
			$featured_img_url = $featured_img_url_small_retina;
		}elseif($tipo_de_carrusel == 'carrusel-tipo-dos'){
			$featured_img_url = $featured_img_url_small_retina;
		}elseif($tipo_de_carrusel == 'carrusel-tipo-tres'){
			$featured_img_url = $featured_img_url_small_retina;
		}
		$tipo_de_carrusel = "";
	}

}elseif ($tablet_browser > 0) {
	//print 'is tablet';
	//condicional para los bloques secciones y temas
	if(!empty($GLOBALS['tipo_de_carrusel'])){
		$tipo_de_carrusel = $GLOBALS['tipo_de_carrusel'];
		if($tipo_de_carrusel == 'carrusel-tipo-uno'){
			$featured_img_url = $featured_img_url_medium_retina;
		}elseif($tipo_de_carrusel == 'carrusel-tipo-dos'){
			$featured_img_url = $featured_img_url_small_retina;
		}
		$tipo_de_carrusel = "";
	}

	//condicional para los carruseles de tema y seccion
	if(!empty($GLOBALS['tipo_de_carrusel_2'])){
		$tipo_de_carrusel = $GLOBALS['tipo_de_carrusel_2'];
		if($tipo_de_carrusel == 'carrusel-tipo-uno'){
			$featured_img_url = $featured_img_url_medium_retina;
		}elseif($tipo_de_carrusel == 'carrusel-tipo-dos'){
			$featured_img_url = $featured_img_url_small_retina;
		}elseif($tipo_de_carrusel == 'carrusel-tipo-tres'){
			$featured_img_url = $featured_img_url_small_retina;	
		}
		$tipo_de_carrusel = "";
	}

}else {
	//print 'is desktop';
	//condicional para los bloques secciones y temas
	if(!empty($GLOBALS['tipo_de_carrusel'])){
		$tipo_de_carrusel = $GLOBALS['tipo_de_carrusel'];
		if($tipo_de_carrusel == 'carrusel-tipo-uno'){
			$featured_img_url = $featured_img_url_small_retina;
		}elseif($tipo_de_carrusel == 'carrusel-tipo-dos'){
			$featured_img_url = $featured_img_url_small;
		}
		$tipo_de_carrusel = "";
	}

	//condicional para los carruseles de tema y seccion
	if(!empty($GLOBALS['tipo_de_carrusel_2'])){
		$tipo_de_carrusel = $GLOBALS['tipo_de_carrusel_2'];
		if($tipo_de_carrusel == 'carrusel-tipo-uno'){
			$featured_img_url = $featured_img_url_medium_retina;
		}elseif($tipo_de_carrusel == 'carrusel-tipo-dos'){
			$featured_img_url = $featured_img_url_medium;
		}elseif($tipo_de_carrusel == 'carrusel-tipo-tres'){
			$featured_img_url = $featured_img_url_small;
		}
		$tipo_de_carrusel = "";
	}
}

// Si no hay Imagen destacada hace fallback a la imagen definida en opciones del tema
if (empty($featured_img_url)){
	$featured_img_url = get_theme_mod('default_news_image');
}

//
if(!empty($GLOBALS['carrusel_tema'])){
	$categorias = get_the_category();
	$name = $categorias[0]->name;
	$category_id = $categorias[0]->term_id;
	$category_link = get_category_link($category_id); // Link de la sección
}
if(!empty($GLOBALS['carrusel_seccion'])){
	$taxonomy_object = get_the_taxonomies();
	$name_tax = $taxonomy_object["theme"];
	$name = substr($name_tax,6);
	$name_taxonomy = trim($name,".");
	$tema = get_term_by('name', $name_taxonomy, 'theme');
	$name = $tema->name;
	$category_id = $tema->term_id;
	$category_link = get_category_link($category_id); // Link de la sección
}
$cats = get_the_category();
if( count($cats) > 0 ){
	$cat_child = "";
	$cat_termid = 0;
	$cat_id = 0;
	foreach( $cats as $val_cat ){
		if( $val_cat->parent != 0 ){
			$cat_child = $val_cat->name;
			$cat_termid = $val_cat->term_id;
			$cat_id = $val_cat->cat_id;
			break;
		}
	}
	if( $cat_child != "" ){
		$name = $cat_child;
		$category_link = get_category_link($cat_id);
		$term_link = get_term_link( $cat_termid );
		$cat_link = count($category_link) > 0 ? $category_link : $term_link;
	}else{
		$name = "Sin categoría";
	}
}
$tax_color = get_term_meta( $cat_termid, 'category_color', true );
?>
<div id="post-<?php the_ID(); ?>">
	<div class="position-relative">
		<div class="row mb-0 meta">
			<!-- <a href="<?php // echo $category_link; ?>"><?php // echo $name ?></a> -->
			<!-- Sección de nota -->
			<div class="col-6 categoria">
				<a class="text-white" href="<?php echo $category_link; ?>" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
					<?php echo $name ?>
				</a>
                <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
			</div>
            <div class="col-6 hora text-right">
                <small><?php echo $haceTiempo; ?></small>
            </div>
		</div>
	<!-- IMAGEN DE NOTA -->
		<div class="contenedor-media d-flex justify-content-center align-items-center" style="background-image: url( <?php echo $featured_img_url; ?> );">
			<!-- Icono tipo de contenido -->
			<div>
				<?php require get_template_directory() . '/template-parts/content-tipo.php'; ?>
			</div>
		</div>
		<!-- ENCABEZADO DE NOTA -->
		<div class="encabezado-nota mt-2">
			<!-- Título de nota -->
			<h4 class="titulo-de-nota">
				<a class="stretched-link" href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>" style="border-left-color:<?php echo "#" . $tax_color; ?>;"><?php the_title(); ?></a>
			</h4>
		</div>
	</div>
	<!-- ICONOS COMPARTIR -->
	<!-- <div class="d-sm-none">
		<?php // require get_template_directory() . '/inc/iconos-compartir.php'; ?>
	</div> -->
</div>