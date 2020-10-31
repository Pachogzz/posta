
<?php 
/**
 * Template part for displaying module block notes-banner custom
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package posta
 * 
 * 
 */?>

<div class="container mt-6 toto4 container-lg<<<">
	<div class="row justify-content-center">

		<div class="col-sm-7 col-lg-4 toto2">
		
			<div class="modulo-corchete">
				<?php
				if(have_rows('modulo_notas_2')){
					while(have_rows('modulo_notas_2')){ the_row();
						$titulo_modulo_2  = get_sub_field('titulo_modulo_2');
						$notas_modulo_2 =  get_sub_field('notas_modulo_2');?>
						<?php 
						if($notas_modulo_2){ ?>
							<!-- ENCABEZADO DE MÓDULO -->
							<h4 class="encabezado-titulo flecha text-break position-relative mt-3 mb-5"><?php echo $titulo_modulo_2; ?></h4>
							<!-- NOTAS EN MÓDULO -->
							<?php
							foreach ($notas_modulo_2 as $post) {
								setup_postdata($post); ?>
								<h5 class="titulo-de-nota font-weight-normal my-2">
									<a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a>
								</h5>
								<div class="borde my-4"></div>
								<?php 
							}
							wp_reset_postdata();
						}
						wp_reset_postdata();
						
					} //endwhile	
				}//endif ?>
			</div>

			<!-- PUBLICIDAD -->
			<div class="modulo-publicidad mx-auto mt-6" style="width: 302px;">
				<img class="img-fluid" src="https://via.placeholder.com/300x250?text=box%20banner" alt="">
				<div class="text-center text-uppercase text-muted mt-1"><small>Publicidad</small></div>
			</div>
				
		</div>

		<div class="col-lg-8 mt-6 mt-lg-0 toto5">
			<?php
			if(have_rows('banner_custom')){
				while(have_rows('banner_custom')){ the_row();
					$titulo_banner_custom = get_sub_field('titulo_banner_custom');
					$imagen_banner_custom = get_sub_field('imagen_banner_custom');
					$enlace_banner_custom = get_sub_field('enlace_banner_custom');
					$target = get_sub_field('target');
					$mostrar_descripcion = get_sub_field('mostrar_descripcion');
					if($mostrar_descripcion){
						$descripcion_del_bnn = get_sub_field('descripcion_del_banner');
						$descripcion = '<p class="encabezado-descripcion">'.$descripcion_del_bnn.'</p>';
					}
					?>
					<div class="encabezado">
						<?php if( $titulo_banner_custom = get_sub_field('titulo_banner_custom') ) { ?>
							<!-- ENCABEZADO DE BANNER CUSTOM -->
							<h3 class="encabezado-titulo flecha"><?php echo $titulo_banner_custom; ?></h3>
						<?php
						echo $descripcion;	
						} ?>
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