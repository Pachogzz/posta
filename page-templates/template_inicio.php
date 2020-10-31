<?php
  /* Template Name: Template Inicio */
  get_header();
?>
<?php // Template del Home page con contenido flexible ?>

<?php 
require get_template_directory() . '/inc/color_categories.php'; 
$cont_layout =0; //Varible para ver el numero de layouts

if( have_rows('contenido_de_inicio')){
  	while ( have_rows('contenido_de_inicio')) {
		the_row();
		if(get_row_layout() == 'top_stories'){ ?>
			<?php get_template_part('template-parts/content', 'top-stories'); ?>
			<?php
			if(have_rows('historias_del_dia')){
				while(have_rows('historias_del_dia')){ the_row();?>
				<?php get_template_part('template-parts/content', 'historias-dia');?>
				<?php	wp_reset_postdata();
				}
			}
		}elseif(get_row_layout() == 'carrusel_portada'){ ?>
			<?php get_template_part('template-parts/content', 'carrusel-portada');?>
		<?php
		}elseif(get_row_layout() == 'carrusel_opinion'){?>
			<?php get_template_part('template-parts/content', 'bloque-opinion');?>
		<?php
		}elseif(get_row_layout() == 'bloque_secciones_modulo_notas'){?>
			<?php get_template_part('template-parts/content', 'bloque-secciones-modulo-notas'); ?>
			<?php
		}elseif(get_row_layout() == 'bloque_temas_modulo_notas'){?>
			<?php get_template_part('template-parts/content', 'bloque-temas-modulo-notas'); ?>
			<?php
		}elseif(get_row_layout() == 'carrusel_coleccion'){   //Evalua si el layout es para el carrusel de coleccion
			get_template_part('template-parts/content', 'carrusel-coleccion');
		}elseif(get_row_layout() == 'carrusel_imagenes'){ ?>
			<?php get_template_part('template-parts/content', 'carrusel-imagenes'); ?>
		<?php
		}elseif(get_row_layout() == 'bloque_modulo_notas_banner_custom'){ ?>
			<?php get_template_part('template-parts/content', 'bloque-notas-banner-custom'); ?>
		<?php
		}elseif(get_row_layout()== 'banner_custom'){ ?>
			<?php get_template_part('template-parts/content', 'banner-custom'); ?>
		<?php
		}elseif(get_row_layout() == 'carrusel_tema'){  //Evalua si el  layout es para el carrusel de tema?>
			<?php get_template_part('template-parts/content', 'carrusel-tema'); ?>
		<?php
		}elseif(get_row_layout() == 'carrusel_seccion'){ //Evalua si el  layout es para el carrusel de seccion?>
			<?php get_template_part('template-parts/content', 'carrusel-seccion'); ?>
		<?php
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
			$cont_layout=0; 
		}
  	}
}	
// echo 'totales: '.$cont_layout;
?>
<?php get_footer(); ?>