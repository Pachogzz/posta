<?php
/* Template Name: Template Inicio */
/* Template del Home page con contenido flexible */

get_header();
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
			// echo "<span class='text-white'><small>".get_sub_field('tipo_block')."</small></span>";
			get_template_part( 'template-parts/content', get_sub_field('tipo_block'));
		} elseif (get_row_layout() == 'bloque_de_perspectivas'){
			get_template_part( 'template-parts/content', 'bloque-perspectivas');
		}

		// Bloque para colocar el script de la publicidad
		$cont_layout = $cont_layout +1;
		if($cont_layout == 2){ ?>
			<!-- PUBLICIDAD -->
			<div class="modulo-publicidad leaderBoard my-6">
				<div class="container-fluid">
					<div class="row"> 
						<div class="col text-center">
							<script>
							  window.googletag = window.googletag || {cmd: []};
							  googletag.cmd.push(function() {
							    googletag.defineSlot('/90573685/Leaderboard_home_728x90_970x90', [[970, 90], [728, 90], [640, 200]], 'div-gpt-ad-1610518252679-0').addService(googletag.pubads());
							    googletag.pubads().enableSingleRequest();
							    googletag.enableServices();
							  });
							</script>

							<!-- /90573685/Leaderboard_home_728x90_970x90 -->
							<div id='div-gpt-ad-1610518252679-0 text-center'>
							  <script>
							    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1610518252679-0'); });
							  </script>
							</div>
							<!-- <img class="img-fluid d-block mx-auto" src="http://fakeimg.pl/720x90/c00/FFF/?text=Leaderboard+Home+2" alt="Publicidad"> -->
							<!-- <div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div> -->
						</div>
					</div>
				</div>
			</div>
			<?php 
			// $cont_layout = 0; 
		}
		if($cont_layout == 4){ ?>
			<!-- PUBLICIDAD -->
			<div class="modulo-publicidad leaderBoard my-6">
				<div class="container-fluid">
					<div class="row"> 
						<div class="col text-center">
							<script>
							  window.googletag = window.googletag || {cmd: []};
							  googletag.cmd.push(function() {
							    googletag.defineSlot('/90573685/leaderboard_home_2_728x90_970x90', [[728, 90], [970, 90], [640, 200]], 'div-gpt-ad-1610518319668-0').addService(googletag.pubads());
							    googletag.pubads().enableSingleRequest();
							    googletag.enableServices();
							  });
							</script>

							<!-- /90573685/leaderboard_home_2_728x90_970x90 -->
							<div id='div-gpt-ad-1610518319668-0 text-center'>
							  <script>
							    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1610518319668-0'); });
							  </script>
							</div>
							<!-- <div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div> -->
						</div>
					</div>
				</div>
			</div>
			<?php 
			// $cont_layout = 0; 
		}
		if($cont_layout == 6){ ?>
			<!-- PUBLICIDAD -->
			<div class="modulo-publicidad leaderBoard my-6">
				<div class="container-fluid">
					<div class="row"> 
						<div class="col text-center">
							<script>
							  window.googletag = window.googletag || {cmd: []};
							  googletag.cmd.push(function() {
							    googletag.defineSlot('/90573685/Leaderboard_home_3', [[970, 90], [728, 90], [640, 200]], 'div-gpt-ad-1610518358790-0').addService(googletag.pubads());
							    googletag.pubads().enableSingleRequest();
							    googletag.enableServices();
							  });
							</script>

							<!-- /90573685/Leaderboard_home_3 -->
							<div id='div-gpt-ad-1610518358790-0 text-center'>
							  <script>
							    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1610518358790-0'); });
							  </script>
							</div>
							<!-- <div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div> -->
						</div>
					</div>
				</div>
			</div>
			<?php 
			// $cont_layout = 0; 
		}
		if($cont_layout == 8){ ?>
			<!-- PUBLICIDAD -->
			<div class="modulo-publicidad leaderBoard my-6">
				<div class="container-fluid">
					<div class="row"> 
						<div class="col text-center">
							<script>
							  window.googletag = window.googletag || {cmd: []};
							  googletag.cmd.push(function() {
							    googletag.defineSlot('/90573685/Leaderboard_home_4_970x90_728x90', [[728, 90], [970, 90], [640, 200]], 'div-gpt-ad-1610518469085-0').addService(googletag.pubads());
							    googletag.pubads().enableSingleRequest();
							    googletag.enableServices();
							  });
							</script>

							<!-- /90573685/Leaderboard_home_4_970x90_728x90 -->
							<div id='div-gpt-ad-1610518469085-0 text-center'>
							  <script>
							    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1610518469085-0'); });
							  </script>
							</div>
							<!-- <div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div> -->
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