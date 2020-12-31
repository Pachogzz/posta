<?php 
/**
 * Template part for displaying 10 notes - one at tho sizes - and 1 box banner
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 */
    $color = get_sub_field('color_del_titulo');
    $tipo = get_sub_field('tipo');
    $tipoTitulo = get_sub_field('titulo_de_seccion');
    $tituloPerso = get_sub_field('titulo_personalizado');
    $mostraDescr = get_sub_field('mostrar_descripcion');

    switch ($tipo) {
        case 'seccion':
            $id = get_sub_field('elegir_seccion');
            $tipo = 'category';
        break;

        case 'tema':
            $id = get_sub_field('elegir_tema');
            $tipo = 'theme';
        break;

        case 'hashtag':
            $id = get_sub_field('elegir_hashtag');
            $tipo = 'post_tag';
        break;
    }

    $categoria = get_term_by('id', $id, $tipo);
    $descripcion = category_description($categoria->term_id);
    $link = get_category_link($categoria->term_id);

?>
<section class="bloque_notas--2_bb_4_4 mb-6">
	<div class="container">
		<div class="row">
			<div class="col-12">
                <div class="encabezado">
                     <h2 class="encabezado-titulo" style="background-color:<?php echo $color; ?>;">
                        <a href="<?php echo $link; ?>">
                            <span class="nombre-sitio">POSTA</span>
                            <?php if($tipoTitulo == 'por_defecto'): ?>
                                <span class="nombre-taxonomia"><?php echo $categoria->name;?></span>
                            <?php else: ?>
                                <span class="nombre-taxonomia"><?php echo $tituloPerso;?></span>
                            <?php endif ?>
                        </a>
                    </h2>
                    <?php if ($mostraDescr): ?>
                        <p class="encabezado-descripcion"><?php echo strip_tags($descripcion); ?></p>
                    <?php endif ?>
                </div>
			</div>
            <?php
                $ids = array();
                $i = 0;
                $args = array (
                    'post_type'      => 'post',
                    'category'      => $categoria->term_id,
                    'posts_per_page' => 6,
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                );

                $the_query = new WP_Query( $args, 'objects');
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post(); 
                        require get_template_directory() . '/inc/detect_mobile_desktop.php'; 
                        if ($mobile_browser > 0) {
                            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), '720x405');
                        }elseif ($tablet_browser > 0) {
                            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), '1100x618');
                        }else {
                            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), '3840x2160');
                        }
            ?>
			            <div id="post-<?php the_ID(); ?>" class="col-12 col-md-6 col-lg-3 nota">
			                <div class="row meta">
			                    <div class="col-12 col-md-6 categoria">
			                        <small><?php echo $categoria->name; ?></small>
			                    </div>
			                    <!-- <div class="col hora text-right">
			                        <small>Hace 1 hora <i class="fas fa-clock"></i></small>
			                    </div> -->
			                </div>
			                <div class="imagen-nota" style="background-image: url('<?php echo $featured_img_url; ?>');"></div>
			                <!-- <img src="<?php echo $featured_img_url; ?>" class="img-fluid d-block" alt="Lorem ipsum dolor sit amet consectetur adipisicing elit."> -->
			                <h5 class="titulo-nota"><?php the_title(); ?></h5>
			            </div>
			            <?php
			            $ids[$i] = get_the_ID();
			            $i++;
			        endwhile;
			    endif;
			    wp_reset_postdata();
			?>
			<div class="col-12 col-md-6 col-lg-3 nota">
				<img src="http://fakeimg.pl/300x300/333/ccc/?text=BoxBanner" class="img-fluid d-block imagen-nota" alt="Publicidad...">
			</div>
		</div>
	</div>
</section>