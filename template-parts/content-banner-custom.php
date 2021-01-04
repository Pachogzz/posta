<?php 
/**
 * Template part for displaying Banner Custom
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 * 
 */

$titulo_banner_custom = get_sub_field('titulo_banner_custom');
$enlace_banner_custom = get_sub_field('enlace_banner_custom');
$imagen_banner_custom = get_sub_field('imagen_banner_custom');
$target = get_sub_field('target');
$mostrar_descripcion = get_sub_field('mostrar_descripcion');
if(!empty($titulo_banner_custom)){
	$titulo_banner = '<h2 class="encabezado-titulo text-white"><span class="nombre-sitio">POSTA</span><span class="nombre-taxonomia">'.strip_tags($titulo_banner_custom).'</span></h2>';
}
if($mostrar_descripcion){
	$descripcion_del_banner = get_sub_field('descripcion_del_banner');
	$descripcion_bc = '<p class="encabezado-descripcion">'.$descripcion_del_banner.'</p>';
}

if($imagen_banner_custom){ ?>
	<div class="container mt-6 container-lg<<<">
		<div class="row">
			<div class="col">
				<!-- ENCABEZADO DE BANNER CUSTOM -->
				<div class="encabezado mb-3">
					<?php echo $titulo_banner; ?>
					<?php echo $descripcion_bc; ?>
				</div>
				<!-- IMAGEN BANNER CUSTOM -->
				<div>
				<?php if(empty($enlace_banner_custom)){ ?>
						<img class="img-fluid d-block mx-auto" src="<?php echo esc_url($imagen_banner_custom); ?>" alt="<?php echo esc_attr($titulo_banner_custom); ?>">
				<?php }else{ ?>
					<a href="<?php echo $enlace_banner_custom; ?>" target="<?php echo $target; ?>">
						<img class="img-fluid d-block mx-auto" src="<?php echo esc_url($imagen_banner_custom); ?>" alt="<?php echo esc_attr($titulo_banner_custom); ?>"></a>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}