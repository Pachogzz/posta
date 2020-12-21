<?php 
/**
 * Template part for displaying 11 notes and 1 box banner
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 */
$bloque_7_bb = get_sub_field('bloque_7_bb');
if ( have_rows ('bloque_7_bb') ){
	while ( have_rows ('bloque_7_bb') ){
		the_row();

		$color_del_titulo = get_sub_field('color_del_titulo');
		$titulo_select = get_sub_field('titulo_de_seccion');
		$titulo_personalizado = get_sub_field('titulo_personalizado_');
		$seccion_tema_o_hashtag = get_sub_field('seccion_tema_o_hashtag');
		$mostrar_descripcion = get_sub_field('mostrar_descripcion');

		$section_id = get_sub_field('seccion_select');
		$section_name = get_term_by('id', $section_id, 'category');
		$section_link = get_category_link($section_id);
		$section_description = category_description($section_id);

		$theme_id = get_sub_field('tema_select');
		$theme_name = get_term_by('id', $theme_id, 'theme');
		$theme_link = get_category_link($theme_id);
		$theme_description = category_description($theme_id);

		$hashtag_id = get_sub_field('hashtag_select');
		$hashtag_name = get_term_by('id', $hashtag_id, 'post_tag');
		$hashtag_link = get_category_link($hashtag_id);
		$hashtag_description = category_description($hashtag_id);
	}
}
?>
<!-- Bloques de notas 7 - BB -->
<span class="mute"><small>11 bloques 1 box banner</small></span>
<small><pre>
	<?php print_r($bloque_7_bb); ?>
</pre></small>
<section class="bloque_notas--7_bb mt-6 mb-6">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="encabezado">
					<h2 class="encabezado-titulo" style="background-color:<?php echo $color_del_titulo; ?>;">
						<?php if( $seccion_tema_o_hashtag == 'seccion' ) { ?>
						<a href="<?php echo $section_link; ?>">
							<span class="nombre-sitio">POSTA</span>
							<span class="nombre-taxonomia"><?php echo $section_id->name;?></span>
						</a>
						<?php } ?>
						<?php if( $seccion_tema_o_hashtag == 'tema' ) { ?>
						<a href="<?php echo $theme_link; ?>">
							<span class="nombre-sitio">POSTA</span>
							<span class="nombre-taxonomia"><?php echo $theme_id->name;?></span>
						</a>
						<?php } ?>
						<?php if( $seccion_tema_o_hashtag == 'hashtag' ) { ?>
						<a href="<?php echo $hashtag_link; ?>">
							<span class="nombre-sitio">POSTA</span>
							<span class="nombre-taxonomia"><?php echo $hashtag_id->name;?></span>
						</a>
						<?php } ?>
					</h2>
					<?php if( $seccion_tema_o_hashtag == 'seccion' ) { ?>
						<?php if( $mostrar_descripcion == '1' ){ ?>
						<p class="encabezado-descripcion"><?php echo strip_tags($section_description); ?></p>
						<?php } ?>
					<?php } ?>
					<?php if( $seccion_tema_o_hashtag == 'tema' ) { ?>
						<?php if( $mostrar_descripcion == '1' ){ ?>
						<p class="encabezado-descripcion"><?php echo strip_tags($theme_description); ?></p>
						<?php } ?>
					<?php } ?>
					<?php if( $seccion_tema_o_hashtag == 'hashtag' ) { ?>
						<?php if( $mostrar_descripcion == '1' ){ ?>
						<p class="encabezado-descripcion"><?php echo strip_tags($hashtag_description); ?></p>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
			
			<div class="row">
			<?php
				$output = 'objects';
				if ($seccion_tema_o_hashtag == 'seccion') {
					$args = array (
						'post_type'      => 'post',
						'cat'		=> $section_id->term_id,
						// 'posts_per_page' => 6,
						'orderby'        => 'date',
						'order'          => 'DESC'
					);
				}
				if ($seccion_tema_o_hashtag == 'tema') {
					$args = array (
						'post_type'      => 'post',
						'cat'		=> $theme_id->term_id,
						// 'posts_per_page' => 6,
						'orderby'        => 'date',
						'order'          => 'DESC'
					);
				}
				if ($seccion_tema_o_hashtag == 'hashtag') {
					$args = array (
						'post_type'      => 'post',
						'cat'		=> $hashtag_id->term_id,
						// 'posts_per_page' => 6,
						'orderby'        => 'date',
						'order'          => 'DESC'
					);
				}
				$the_query = new WP_Query( $args, $output );
				if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) :
						$the_query->the_post(); 
						
						require get_template_directory() . '/inc/detect_mobile_desktop.php'; 

						// Tamaños de imagen destacada
						$featured_img_url_small = get_the_post_thumbnail_url(get_the_ID(), '360x202');
						$featured_img_url_small_retina = get_the_post_thumbnail_url(get_the_ID(), '720x405');
						$featured_img_url_medium = get_the_post_thumbnail_url(get_the_ID(), '550x309');
						$featured_img_url_medium_retina = get_the_post_thumbnail_url(get_the_ID(), '1100x618');
						$featured_img_url_large = get_the_post_thumbnail_url(get_the_ID(), '1920x1080');
						$featured_img_url_large_retina = get_the_post_thumbnail_url(get_the_ID(), '3840x2160');

						// De acuerdo al dispositivo y espacio del contenedor de la Imagen destacada ponemos la medida más adecuada
						if ($mobile_browser > 0) {
							//print 'is mobile';
							$featured_img_url = $featured_img_url_small_retina;	
						}elseif ($tablet_browser > 0) {
							//print 'is tablet';
							$featured_img_url = $featured_img_url_medium_retina;
						}else {
							//print 'is desktop';
							$featured_img_url = $featured_img_url_large_retina;
						}
						?>
						<div id="post-<?php the_ID(); ?>" class="col-12 col-md-6 col-lg-3 nota">
							<div class="row meta">
								<div class="col categoria">
									<?php if( $seccion_tema_o_hashtag == 'tema' ) { ?>
										<small><?php echo $theme_id->name;?></small>
									<?php } ?>
									<?php if( $seccion_tema_o_hashtag == 'hashtag' ) { ?>
										<small><?php echo $hashtag_id->name;?></small>
									<?php } ?>
									<?php if( $seccion_tema_o_hashtag == 'seccion' ) { ?>
										<small><?php echo $section_id->name;?></small>
									<?php } ?>
								</div>
								<div class="col hora text-right">
									<small>Hace 1 hora <i class="fas fa-clock"></i></small>
								</div>
							</div>
							<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
								<img src="<?php echo $featured_img_url; ?>" class="img-fluid d-block imagen-nota" alt="<?php the_title(); ?>">
								<h5 class="titulo-nota"><?php the_title(); ?></h5>
							</a>
						</div>
						<?php
					endwhile;
				endif;
				wp_reset_postdata();
				//unset($GLOBALS['carrusel_seccion']);
			?>
			</div>

			<div class="col-12 col-md-6 col-lg-3 nota">
				<div class="row meta">
					<div class="col categoria">
						<small>Categoría</small>
					</div>
					<div class="col hora text-right">
						<small>Hace 1 hora <i class="fas fa-clock"></i></small>
					</div>
				</div>
				<img src="http://fakeimg.pl/350x200/ccc/333/?text=placeholder" class="img-fluid d-block imagen-nota" alt="Lorem ipsum dolor sit amet consectetur adipisicing elit.">
				<h5 class="titulo-nota">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5>
			</div>
			<div class="col-12 col-md-6 col-lg-3 nota">
				<img src="http://fakeimg.pl/300x300/333/ccc/?text=BoxBanner" class="img-fluid d-block imagen-nota" alt="Publicidad...">
			</div>
		</div>
	</div>
</section>