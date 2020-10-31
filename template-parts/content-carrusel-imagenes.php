<?php 
/**
 * Template part for displaying Carruosel galery
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package posta
 * 
 * 
 */
$titulo_del_carrusel = get_sub_field('titulo_del_carrusel');
$mostrar_descripcion = get_sub_field('mostrar_descripcion');
if($mostrar_descripcion){
	$descripcion_del_carrusel_img = get_sub_field('descripcion_del_carrusel');
	$descripcion_del_carrusel = '<p class="encabezado-descripcion text-center">'.$descripcion_del_carrusel_img.'</p>';
}
$imagenes_carrusel = get_sub_field('imagenes_carrusel');
?>

<div class="container mt-6 toto2 container-lg<<<">
	<div class="row">
		<div class="col">

			<div class="modulo-corchete-lg">
				<!-- ENCABEZADO DE CARRUSEL DE IMÁGENES -->
				<div class="encabezado mb-5 mt-n3">
					<h2 class="encabezado-titulo flecha position-relative text-center"><?php echo $titulo_del_carrusel;?></h2>
					<?php echo $descripcion_del_carrusel; ?>
				</div>
				<!-- CARRUSEL DE IMÁGENES -->
				<div class="owl-carousel owl-theme carrusel-imagenes">
					<?php 
						if($imagenes_carrusel){
							foreach($imagenes_carrusel as $imagen_carrusel){
									$img_carrusel = $imagen_carrusel['imagen_carrusel'];
									$enlace_imagen_carrusel = $imagen_carrusel['enlace_imagen_carrusel'];
									$target = $imagen_carrusel['target'];?>
									
									<div class="c-item">
										<?php if(empty($enlace_imagen_carrusel)){?>
											<img class="img-fluid no-lazy-load" src="<?php echo $img_carrusel?>" alt="<?php echo esc_attr($imagen_carrusel['alt']); ?>">
										<?php }elseif(!empty($enlace_imagen_carrusel)){ ?>
												<a id="url-img"  href="<?php echo $enlace_imagen_carrusel ?>" target="<?php echo $target; ?>">
													<img class="img-fluid no-lazy-load" src="<?php echo $img_carrusel?>" alt="<?php echo esc_attr($imagen_carrusel['alt']); ?>">
												</a>
										<?php } ?>
									</div>	
						<?php	}	 
						}
					?>		
				</div>
									
			</div>

		</div>
	</div>
</div>