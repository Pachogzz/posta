<?php 
/**
 * Template part for displaying 8 notes three sizes 1 box banner
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
    $tax_color = get_term_meta( $categoria->term_id, 'category_color', true );

?>

<section class="bloque_notas--2_2_bb_4 mb-6">
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
            <div class="col-12 col-lg-6">
                <div class="row h-100">
                    <?php
                        $ids = array();
                        $i = 0;
                        $args = array (
                            'post_type'      => 'post',
                            'category'      => $categoria->term_id,
                            'posts_per_page' => 1,
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
                    ?>
                                <div id="post-<?php the_ID(); ?>" class="col-12 nota large h-100">
                                    <div class="row meta">
                                        <div class="col-12 col-md-6 categoria" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
                                            <a class="text-white" href="<?php echo $link; ?>">
                                                <small><?php echo $categoria->name; ?></small>
                                            </a>
                                            <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
                                        </div>
                                        <!-- <div class="col hora text-right">
                                            <small>Hace 1 hora <i class="fas fa-clock"></i></small>
                                        </div> -->
                                    </div>
                                    <a class="h-100" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
                                        <div class='imagen-nota-container h-100'>
                                            <div class="imagen-nota h-100" style="background-image: url('<?php echo $featured_img_url; ?>');"></div>
                                            <h5 class="titulo-nota"><?php the_title(); ?></h5>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                $ids[$i] = get_the_ID();
                                $i++;
                            endwhile;
                        endif;
                        wp_reset_postdata();
                    ?>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="row inner-row align-self-stretch">
            <?php
                $args = array (
                    'post__not_in'      => $ids,
                    'post_type'      => 'post',
                    'category'      => $categoria->term_id,
                    'posts_per_page' => 2,
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
            ?>
                <div id="post-<?php the_ID(); ?>" class="col-12 col-md-6 nota">
                    <div class="row meta">
                        <div class="col-12 col-md-6 categoria" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
                            <a class="text-white" href="<?php echo $link; ?>">
                                <small><?php echo $categoria->name; ?></small>
                            </a>
                            <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
                        </div>
                        <!-- <div class="col hora text-right">
                            <small>Hace 1 hora <i class="fas fa-clock"></i></small>
                        </div> -->
                    </div>
                    <a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
                        <div class='imagen-nota-container'>
                            <div class="imagen-nota" style="background-image: url('<?php echo $featured_img_url; ?>');"></div>
                            <h5 class="titulo-nota"><?php the_title(); ?></h5>
                        </div>
                    </a>
                </div>
            <?php
                    $ids[$i] = get_the_ID();
                    $i++;
                    endwhile;
                endif;
                wp_reset_postdata();
            ?>
                <div class="col-12 col-md-6 nota modulo-publicidad">
                    <img src="http://fakeimg.pl/300x300/333/ccc/?text=BoxBanner" class="img-fluid d-block mb-0" alt="Publicidad...">
                    <span>Publicidad</span>
                </div>
                </div>
            </div>
            <div class="col-12 mt-6">
                <div class="row align-self-stretch">
                    <?php
                        $args = array (
                            'post__not_in'      => $ids,
                            'post_type'      => 'post',
                            'category'      => $categoria->term_id,
                            'posts_per_page' => 4,
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
                    ?>
                        <div id="post-<?php the_ID(); ?>" class="col-12 col-md-6 col-lg-3 nota">
                            <div class="row meta">
                                <div class="col-12 col-md-6 categoria" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
                                    <a class="text-white" href="<?php echo $link; ?>">
                                        <small><?php echo $categoria->name; ?></small>
                                    </a>
                                    <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
                                </div>
                                <!-- <div class="col hora text-right">
                                    <small>Hace 1 hora <i class="fas fa-clock"></i></small>
                                </div> -->
                            </div>
                            <a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
                                <div class='imagen-nota-container'>
                                    <div class="imagen-nota" style="background-image: url('<?php echo $featured_img_url; ?>');"></div>
                                    <h5 class="titulo-nota"><?php the_title(); ?></h5>
                                </div>
                            </a>
                        </div>
                    <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                    ?>
                </div>
            </div>
           
        </div>
    </div>
</section>