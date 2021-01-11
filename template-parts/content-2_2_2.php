<?php 
/**
 * Template part for displaying 5 notes two sizes no banner
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
    $colorFondo = get_sub_field('color_de_fondo_seccion');
    $imagenFondo = get_sub_field('imagen_de_fondo_seccion');
    $colorTexto = get_sub_field('color_de_texto_seccion');
    $show_time_ago = get_theme_mod('show_time_ago');
    switch ($show_time_ago == 1) {
        case '1':
            $haceTiempo = time_ago() . ' <i class="fas fa-clock"></i>';
        break;
        case '0':
            $haceTiempo = "";
        break;
    }

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
<section class="bloque_notas--2_2_2 py-6" style="background-image: url( <?php echo $imagenFondo; ?> ); background-color: <?php echo $colorFondo; ?> !important;">
    <div class="container">
        <!-- Desktop block -->
        <div class="d-none d-sm-none d-md-none d-lg-block">
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
                            <p class="encabezado-descripcion <?php echo $colorTexto; ?>"><?php echo strip_tags($descripcion); ?></p>
                        <?php endif ?>
                    </div>
                </div> 
                <div class="col-12 col-lg-6">
                    <div class="row align-self-center">
                        <?php
                            $ids = array();
                            $i = 0;
                            $args = array (
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
                            // Si no hay Imagen destacada hace fallback a la imagen definida en opciones del tema
                            if (empty($featured_img_url)){
                                $featured_img_url = get_theme_mod('default_news_image');
                            }
                        ?>
                                    <div id="post-<?php the_ID(); ?>" class="col-12 nota large">
                                        <div class="row meta">
                                            <div class="col-6 categoria" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
                                                <a class="text-white" href="<?php echo $link; ?>">
                                                    <small><?php echo $categoria->name; ?></small>
                                                </a>
                                                <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
                                            </div>
                                            <div class="col hora text-right">
                                                <small><?php echo $haceTiempo; ?></small>
                                            </div>
                                        </div>
                                        <?php require get_template_directory() . '/template-parts/content-tipo.php'; ?>
                                        <a class="" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
                                            <div class='imagen-nota-container '>
                                                <div class="imagen-nota " style="background-image: url('<?php echo $featured_img_url; ?>');"></div>
                                                <h5 class="titulo-nota <?php echo $colorTexto; ?>"><?php the_title(); ?></h5>
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
                    <div class="row h-100-20px">
                <?php
                    $args = array (
                        'post__not_in'      => $ids,
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
                            // Si no hay Imagen destacada hace fallback a la imagen definida en opciones del tema
                            if (empty($featured_img_url)){
                                $featured_img_url = get_theme_mod('default_news_image');
                            }
                ?>
                    <div id="post-<?php the_ID(); ?>" class="col-12 nota large">
                        <div class="row meta">
                            <div class="col-6 categoria" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
                                <a class="text-white" href="<?php echo $link; ?>">
                                    <small><?php echo $categoria->name; ?></small>
                                </a>
                                <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
                            </div>
                            <div class="col hora text-right">
                                <small><?php echo $haceTiempo; ?></small>
                            </div>
                        </div>
                        <?php require get_template_directory() . '/template-parts/content-tipo.php'; ?>
                        <a class="h-100" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
                            <div class='imagen-nota-container h-100'>
                                <div class="imagen-nota h-100" style="background-image: url('<?php echo $featured_img_url; ?>');"></div>
                                <h5 class="titulo-nota <?php echo $colorTexto; ?>"><?php the_title(); ?></h5>
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
                <div class="col-12">
                    <div class="row align-self-stretch">
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
                            // Si no hay Imagen destacada hace fallback a la imagen definida en opciones del tema
                            if (empty($featured_img_url)){
                                $featured_img_url = get_theme_mod('default_news_image');
                            }
                        ?>
                            <div id="post-<?php the_ID(); ?>" class="col-12 col-md-6 nota large">
                                <div class="row meta">
                                    <div class="col-6 categoria" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
                                        <a class="text-white" href="<?php echo $link; ?>">
                                            <small><?php echo $categoria->name; ?></small>
                                        </a>
                                        <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
                                    </div>
                                    <div class="col hora text-right">
                                        <small><?php echo $haceTiempo; ?></small>
                                    </div>
                                </div>
                                <?php require get_template_directory() . '/template-parts/content-tipo.php'; ?>
                                <a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
                                    <div class='imagen-nota-container'>
                                        <div class="imagen-nota" style="background-image: url('<?php echo $featured_img_url; ?>');"></div>
                                        <h5 class="titulo-nota <?php echo $colorTexto; ?>"><?php the_title(); ?></h5>
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
        <!-- Desktop block -->

        <!-- Movile slide -->
        <div class="d-sm-block d-md-block d-lg-none">
            <div class="row">
                <div class="col-12">
                    <div class="encabezado">
                        <h2 class="encabezado-titulo" style="background-color:<?php echo $color; ?>;">
                            <a href="<?php echo $link; ?>">
                                <?php if($tipoTitulo == 'por_defecto'): ?>
                                    <span class="nombre-taxonomia"><?php echo $categoria->name;?></span>
                                <?php else: ?>
                                    <span class="nombre-taxonomia"><?php echo $tituloPerso;?></span>
                                <?php endif ?>
                            </a>
                        </h2>
                        <?php if ($mostraDescr): ?>
                            <p class="encabezado-descripcion <?php echo $colorTexto; ?>"><?php echo strip_tags($descripcion); ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="owl-carousel movile-slider align-self-stretch">
                    <?php
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
                        <div id="post-<?php the_ID(); ?>" class="nota large">
                            <div class="row meta">
                                <div class="col-6 categoria" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
                                    <a class="text-white" href="<?php echo $link; ?>">
                                        <small><?php echo $categoria->name; ?></small>
                                    </a>
                                    <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
                                </div>
                                <div class="col hora text-right">
                                    <small><?php echo $haceTiempo; ?></small>
                                </div>
                            </div>
                            <?php require get_template_directory() . '/template-parts/content-tipo.php'; ?>
                            <a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
                                <div class='imagen-nota-container'>
                                    <div class="imagen-nota" style="background-image: url('<?php echo $featured_img_url; ?>');"></div>
                                    <h5 class="titulo-nota <?php echo $colorTexto; ?>"><?php the_title(); ?></h5>
                                </div>
                            </a>
                            <!-- ICONOS COMPARTIR -->
                            <div class="d-sm-none">
                                <?php require get_template_directory() . '/inc/iconos-compartir.php'; ?>
                            </div>
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
        <!-- Movile slide -->
    </div>
</section>