<?php

  /* Template Name: Template Inicio */
  get_header();
?>
<?php // Template del Home page con contenido flexible ?>

<?php 
$cont_layout = 0; //Varible para ver el numero de layouts

if( have_rows('contenido_de_inicio')){
  	while ( have_rows('contenido_de_inicio')) {
		the_row();
		if(get_row_layout() == 'top_stories'){ 
			 get_template_part('template-parts/content', 'top-stories'); 
			if(have_rows('historias_del_dia')){
				while(have_rows('historias_del_dia')){ the_row();
				 get_template_part('template-parts/content', 'historias-dia');
					wp_reset_postdata();
				}
			}
		} elseif (get_row_layout() == 'carrusel_portada'){ 
			 get_template_part('template-parts/content', 'carrusel-portada');
		} elseif (get_row_layout() == 'carrusel_opinion'){
			 get_template_part('template-parts/content', 'bloque-opinion');
		} elseif (get_row_layout() == 'bloque_secciones_modulo_notas'){
			 get_template_part('template-parts/content', 'bloque-secciones-modulo-notas'); 
		} elseif (get_row_layout() == 'bloque_temas_modulo_notas'){
			 get_template_part('template-parts/content', 'bloque-temas-modulo-notas'); 
		} elseif (get_row_layout() == 'carrusel_coleccion'){
			get_template_part('template-parts/content', 'carrusel-coleccion');
		} elseif (get_row_layout() == 'carrusel_imagenes'){ 
			 get_template_part('template-parts/content', 'carrusel-imagenes'); 
		} elseif (get_row_layout() == 'bloque_modulo_notas_banner_custom'){ 
			 get_template_part('template-parts/content', 'bloque-notas-banner-custom'); 
		} elseif (get_row_layout()== 'banner_custom'){ 
			 get_template_part('template-parts/content', 'banner-custom'); 
		} elseif (get_row_layout() == 'carrusel_tema'){
			 get_template_part('template-parts/content', 'carrusel-tema'); 
		} elseif (get_row_layout() == 'carrusel_seccion'){
			 get_template_part('template-parts/content', 'carrusel-seccion'); 
		} elseif (get_sub_field('tipo_block')) {
			echo get_sub_field('tipo_block');
			get_template_part( 'template-parts/content', get_sub_field('tipo_block'));
		} elseif (get_sub_field('carrusel_perspectivas')){
			get_template_part( 'template-parts/content', 'bloque-perspectiva');
		}

		// Bloque para colocar el script de la publicidad
		$cont_layout = $cont_layout +1;
		if($cont_layout == 2){ ?>
			<!-- PUBLICIDAD -->
			<div class="modulo-publicidad my-6">
				<div class="container-fluid">
					<div class="row"> 
						<div class="col">
							<img class="img-fluid d-block mx-auto" src="https://via.placeholder.com/728x90" alt="publicidad">
							<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
						</div>
					</div>
				</div>
			</div>
			<?php 
			$cont_layout = 0; 
		}
  	}
}	

// Totales de publicidad
// echo 'totales: '. $cont_layout;
?>
<?php get_footer(); ?>