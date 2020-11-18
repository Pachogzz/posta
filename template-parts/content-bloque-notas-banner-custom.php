
<?php 
/**
 * Template part for displaying module block notes-banner custom
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 * 
 */?>
<div class="container mt-6 container-lg<<<">
	<div class="row justify-content-center">
		<div class="col-sm-7 col-lg-4">
			<div class="modulo-corchete">
				<?php
				if(have_rows('modulo_notas_2')){
					while(have_rows('modulo_notas_2')){ the_row();
						$titulo_modulo_2 = get_sub_field('titulo_modulo_2');
						if(!empty($titulo_modulo_2)){
							$titulo_1 = '<h4 class="encabezado-titulo flecha text-break position-relative mt-3 mb-5">'.$titulo_modulo_2.'</h4>';
						}
						$notas_modulo_2 = get_sub_field('notas_modulo_2');?>
						<?php
						if($notas_modulo_2){ ?>
							<!-- ENCABEZADO DE MÓDULO -->
							<?php echo $titulo_1; ?>
							<!-- NOTAS EN MÓDULO -->
							<?php
							foreach ($notas_modulo_2 as $post) {
								setup_postdata($post); ?>
								<h5 class="titulo-de-nota font-weight-normal my-2">
									<a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a>
								</h5>
								<div class="separador my-4"></div>
								<?php
							}
							wp_reset_postdata();
						}
						wp_reset_postdata();
					} //endwhile
				}//endif ?>
			</div>
			<!-- PUBLICIDAD -->
			<div style="border: 1px dotted red;">
				<div class="modulo-publicidad mx-auto mt-6" style="width: 302px;">
					<?php if (function_exists ('adinserter')) echo adinserter (10); ?>
					<!-- <img class="img-fluid" src="https://via.placeholder.com/300x250?text=box%20banner"> -->
					<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
				</div>
			</div>
				
		</div>

		<div class="col-lg-8 mt-6 mt-lg-0">
			<?php
			if(have_rows('banner_custom')){
				while(have_rows('banner_custom')){ the_row();
					$titulo_banner_custom = get_sub_field('titulo_banner_custom');
					$imagen_banner_custom = get_sub_field('imagen_banner_custom');
					$enlace_banner_custom = get_sub_field('enlace_banner_custom');
					$target = get_sub_field('target');
					$mostrar_descripcion = get_sub_field('mostrar_descripcion');
					if(!empty($titulo_banner_custom)){
						$titulo_2 = '<h3 class="encabezado-titulo flecha">'.$titulo_banner_custom.'</h3>';
					}
					if($mostrar_descripcion){
						$descripcion_del_bnn = get_sub_field('descripcion_del_banner');
						$descripcion = '<p class="encabezado-descripcion">'.$descripcion_del_bnn.'</p>';
					}
					?>
					<div class="encabezado">
						<!-- ENCABEZADO DE BANNER CUSTOM -->
						<?php echo $titulo_2; ?>
						<?php echo $descripcion;?>
					</div>
					<!-- IMAGEN BANNER CUSTOM -->
					<?php if(empty($enlace_banner_custom)){ ?>
						<img class="img-fluid" src="<?php echo esc_url($imagen_banner_custom); ?>" alt="<?php echo esc_attr($imagen_banner_custom['alt']); ?>">
					<?php }else{ ?>
						<a href="<?php echo $enlace_banner_custom; ?>" target="<?php echo $target; ?>">
							<img class="img-fluid" src="<?php echo esc_url($imagen_banner_custom); ?>" alt="<?php echo esc_attr($imagen_banner_custom['alt']); ?>">
						</a>
					<?php }
				}
			}
			?>
		</div>

	</div>
</div>