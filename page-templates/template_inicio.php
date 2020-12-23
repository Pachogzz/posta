<?php

  /* Template Name: Template Inicio */
  get_header();
?>
<?php // Template del Home page con contenido flexible ?>

<?php 
require get_template_directory() . '/inc/color_categories.php'; 
$cont_layout = 0; //Varible para ver el numero de layouts


if(have_rows('bloque_de_contenidos')):
	while(have_rows('bloque_de_contenidos')):
		the_row();

		if( get_sub_field('cuadricula_de_notas_a_utilizar') == '7_bb' ) {
			get_template_part( 'template-parts/content', 'bloque-7-bb' );
		}
		elseif ( get_sub_field('cuadricula_de_notas_a_utilizar') == '6_hb'){
			get_template_part( 'template-parts/content', 'bloque-6-hp' );
		}
		elseif ( get_sub_field('cuadricula_de_notas_a_utilizar') == '2-1_5_bb'){
			get_template_part( 'template-parts/content', 'bloque-2-1-5-bb' );
		}
		elseif ( get_sub_field('cuadricula_de_notas_a_utilizar') == '2-1_4_hp'){
			get_template_part( 'template-parts/content', 'bloque-2-1-4-hp' );
		}
	endwhile;
endif;

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
		}

		// Bloque para colocar el script de la publicidad
		$cont_layout = $cont_layout +1;
		if($cont_layout == 2){ ?>
			<!-- PUBLICIDAD -->
			<div class="modulo-publicidad-2 mt-6">
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

// Bloques de notas
require get_template_directory() . '/layouts/bcn_7_bb.html'; 
require get_template_directory() . '/layouts/bcn_6_hp.html'; 
require get_template_directory() . '/layouts/bcn_2-1_5_bb.html'; 
require get_template_directory() . '/layouts/bcn_2-1_4_hp.html'; 
require get_template_directory() . '/layouts/bcn_5_billb.html'; 
require get_template_directory() . '/layouts/bcn_1-3_5.html'; 
require get_template_directory() . '/layouts/bcn_1-4_4.html'; 
require get_template_directory() . '/layouts/bcn_1-4_2.html'; 
require get_template_directory() . '/layouts/bcn_1-4_3-bb-r.html'; 
require get_template_directory() . '/layouts/bcn_1-4_3-bb-l.html'; 
require get_template_directory() . '/layouts/bcn_1-4_2-bb.html'; 
require get_template_directory() . '/layouts/bcn_1-4_2-v-r.html'; 
require get_template_directory() . '/layouts/bcn_1-4_2-v-l.html'; 
require get_template_directory() . '/layouts/bcn_2-4.html'; 
require get_template_directory() . '/layouts/bcn_1-6_2.html'; 
require get_template_directory() . '/layouts/bcn_1-6_hp.html'; 
require get_template_directory() . '/layouts/bcn_1-6_hp_2-2.html'; 
require get_template_directory() . '/layouts/bcn_1-8.html'; 

// Totales de publicidad
// echo 'totales: '. $cont_layout;
?>
<?php get_footer(); ?>