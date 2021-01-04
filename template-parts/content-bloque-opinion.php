<?php 
/**
 * Template part for displaying Carruosel Editorials
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package posta
 * 
 * 
 */?>
<?php 
 $mostrar_descripcion = get_sub_field('mostrar_descripcion'); 
 if($mostrar_descripcion){
	$descripcion_del_carrusel_opinion = get_sub_field('descripcion_del_carrusel');
	$descripcion_del_carrusel = '<p class="encabezado-descripcion text-center lead">'.$descripcion_del_carrusel_opinion.'</p>';
 }
?>
<div class="container mt-6 container-lg<<<">
	<div class="row">
		<div class="col">

			<div class="modulo-corchete-lg">
				<!-- ENCABEZADO DE CARRUSEL -->
				<div class="encabezado mb-5 mt-n3">
					<h2 class="encabezado-titulo text-white">
						<span class="nombre-sitio">POSTA</span>
						<span class="nombre-taxonomia">PERSPECTIVAS</span>
					</h2>
					<?php echo $descripcion_del_carrusel; ?>
				</div>
				<!-- CARRUSEL OPINIÓN -->
				<div class="owl-carousel owl-theme carrusel-opinion">
					<?php 
					if(have_rows('editoriales_posta')){
						while(have_rows('editoriales_posta')){ the_row();
							$nombre_editor = get_sub_field('nombre_editor');
							$enlace_a_editorial = get_sub_field('enlace_a_editorial');
							$imagen_editorial = get_sub_field('imagen_editorial');
							$nombre_editorial = get_sub_field('nombre_editorial');?>
							<div class="c-item">
								<!-- Imagen editorialista -->
								<div class="img-thumbnail rounded-pill" style="background-image: url('<?php echo $imagen_editorial['url'] ?>')"></div>
								<!-- <img src="<?php echo $imagen_editorial['url'] ?>" class="img-fluid mb-3" alt="<?php echo $nombre_editor; ?>"> -->
								<!-- <div class="separador-chico"></div> -->
								<!-- Nombre editorialista -->
								<h5 class="text-center text-uppercase name">
									<?php echo esc_html($nombre_editor); ?>
								</h5>
								<!-- Nombre editorial -->
								<h4 class="font-weight-normal text-center mb-3">
									<a class="stretched-link" href="<?php echo $enlace_a_editorial; ?>" title="<?php echo strip_tags($nombre_editorial); ?>"><?php echo $nombre_editorial; ?></a>
								</h4>
							</div>
							<?php 
						}
					}?>
				</div>
			</div>
		</div>
	</div>
</div>