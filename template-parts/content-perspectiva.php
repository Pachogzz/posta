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
  
$columna = wp_get_post_terms( $post->ID, 'columna', array( 'fields' => 'all' ) );
$columna_link = get_term_link( $columna[0]->slug, 'columna');
$columna_name = $columna[0]->name;
$fuente = get_field('fuente');
@$fuenteLink = get_term_link($fuente->slug, 'fuente');

$fuenteImage = get_field('imagen_de_perfil', $fuente);
if (!empty($fuenteImage)){
	$fuenteImage = get_field('imagen_de_perfil', $fuente);
}else{
	$fuenteImage = get_theme_mod('default_news_image');
}

$show_time_ago = get_theme_mod('show_time_ago');
switch ($show_time_ago == 1) {
    case '1':
        $haceTiempo = "<div class='col-12'><p><small>" . time_ago() . ' <i class="fas fa-clock"></i></small></p></div>';
    break;
    case '0':
        $haceTiempo = "";
    break;
}

?>
<!-- <?php echo basename(__FILE__); ?> -->
<!-- Item (nota) dentro del grid  -->
<div id="post-<?php the_ID(); ?>" class="bloque-nota-archivo bloque-nota-perspectiva nota col-md-6 col-lg-4 mb-5">
	<div class="bloque-nota-inner-container h-100">
	    <!-- IMAGEN DE NOTA -->
	    <div class="contenedor-media d-flex justify-content-center align-items-center rounded-circle" style="background-image: url( <?php echo $fuenteImage; ?> );">
	    </div>
		<div class="row mb-0 meta">
			<div class="col-12 columna">
				<!-- Nombre del tema -->
				<?php 
				// echo "<span class='text-white'><pre>";
				// print_r($fuenteImage);
				// echo "</pre></span>";
				?>
				<span class="text-white p-0 mr-1">
					<?php echo $columna_name; ?>
				</span>
			</div>
            <div class="col-12 columnista">
            	<h6 class="py-3">
				<?php 
				if (!empty($fuente)) {
					// echo "Por: <a href=".$fuenteLink.">".$fuente->name."</a>";
					echo "Por: " . $fuente->name;
				}else{
					echo "Por: POSTA REDACCIÓN";
				}
				?>
				</h6>
            </div>
            <!-- PUBLICADO HACE... -->
            <?php echo $haceTiempo; ?>
		</div>
		<!-- </?php require get_template_directory() . '/template-parts/content-tipo.php'; ?> -->
		<div class="position-relative bloque_notas--">
			<!-- ENCABEZADO DE NOTA -->
			<div class="encabezado-nota mt-2">
			  <h4 class="titulo-de-nota font-weight-bolder">
			    <a class="stretched-link d-block" href="<?php the_permalink(); ?>" title="<?php echo esc_html(get_the_title()); ?>">
			    	<?php echo esc_html(get_the_title()); ?>
			    </a>
			  </h4>
			</div>
			<!-- <div class="extracto-nota">
				<?php 
				if ( ! has_excerpt() ) {
				   // echo '<!-- . -->';
				} else { ?>
					Extracto
					<p class="lead extracto-de-nota mt-3"><?php // echo get_the_excerpt(); ?></p>
				<?php } ?>
			</div> -->
		</div>
		<!-- ICONOS COMPARTIR -->
		<!-- <?php // require get_template_directory() . '/inc/iconos-compartir.php'; ?> -->
	</div>
</div>