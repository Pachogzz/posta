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
echo "Bloque de perspectiva";
$colorFondo = get_sub_field('color_de_fondo_perspectiva');
$imagenFondo = get_sub_field('imagen_de_fondo_perspectiva');
$colorTexto = get_sub_field('color_de_texto_perspectiva');
 $mostrar_descripcion = get_sub_field('mostrar_descripcion'); 
 if($mostrar_descripcion){
	$descripcion_del_carrusel = '<p class="encabezado-descripcion text-center lead"' . $colorTexto . '">' . get_sub_field('descripcion_del_carrusel') . '</p>';
 }
$columna = get_term_by('id', 'category_columna');
$columnista = get_term_by('id', 'term_columnista');
$descripcion = category_description($categoria->term_id);
$link = get_category_link($categoria->term_id);
$tax_color = get_term_meta( $categoria->term_id, 'category_color', true );

?>
<div class="container mt-6 container-lg" style="background-image: url( <?php echo $imagenFondo; ?> ); background-color: <?php echo $colorFondo; ?> !important;">
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
                    $args = array (
                        'post_type'      => 'perspectivas',
                        'category'      => $categoria->term_id,
                        // 'posts_per_page' => 3,
                        'orderby'        => 'date',
                        'order'          => 'DESC'
                    );

                    $the_query = new WP_Query( $args, 'objects');
                    if ( $the_query->have_posts() ) :
                        while ( $the_query->have_posts() ) :
                            $the_query->the_post(); 
                            require get_template_directory() . '/inc/detect_mobile_desktop.php'; 
                            // De acuerdo al dispositivo y espacio del contenedor de la Imagen destacada ponemos la medida más adecuada
                            if ($mobile_browser > 0) {
                                //print 'is mobile';
                                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), '720x405');
                            }elseif ($tablet_browser > 0) {
                                //print 'is tablet';
                                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), '1100x618');
                            }else {
                                //print 'is desktop';
                                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), '3840x2160');
                            }
                            // Si no hay Imagen destacada hace fallback a la imagen definida en opciones del tema
                            if (empty($featured_img_url)){
                                $featured_img_url = get_theme_mod('default_news_image');
                            }
                ?>
							<div class="c-item">
								<!-- Imagen editorialista -->
								<div class="img-thumbnail rounded-pill" style="background-image: url('<?php echo $imagen_editorial['url'] ?>')"></div>
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
				</div>
			</div>
		</div>
	</div>
</div>