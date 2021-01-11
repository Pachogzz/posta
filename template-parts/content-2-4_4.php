<?php 
/**
 * Template part for displaying 6 notes two sizes no banner
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
<section class="bloque_notas--2-4_4 mb-6">
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
                            <p class="encabezado-descripcion"><?php echo strip_tags($descripcion); ?></p>
                        <?php endif ?>
                    </div>
                </div> 
                <!-- <div class="col-12 col-lg-6"> -->
                    <!-- <div class="row align-self-center"> -->
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
                        ?>
                                    <div id="post-<?php the_ID(); ?>" class="col-12 col-md-6 nota large doble">
                                        <div class="row meta">
                                            <div class="col-6 categoria" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
                                                <a class="text-white" href="<?php echo $link; ?>">
                                                    <small><?php echo $categoria->name; ?></small>
                                                </a>
                                                <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
                                            </div>
                                            <div class="col hora text-right">
                                                <small><?php echo time_ago(); ?> <i class="fas fa-clock"></i></small>
                                            </div>
                                        </div>
                                        <a class="" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
                                            <div class='imagen-nota-container '>
                                                <div class="imagen-nota " style="background-image: url('<?php echo $featured_img_url; ?>');"></div>
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
                    <!-- </div> -->
                <!-- </div> -->
                <div class="col-12">
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
                                    <div class="col-6 categoria" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
                                        <a class="text-white" href="<?php echo $link; ?>">
                                            <small><?php echo $categoria->name; ?></small>
                                        </a>
                                        <span class="side-triangle" style="background-color: <?php echo "#" . $tax_color; ?> !important;"></span>
                                    </div>
                                    <div class="col hora text-right">
                                        <small><?php echo time_ago(); ?> <i class="fas fa-clock"></i></small>
                                    </div>
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
                            <p class="encabezado-descripcion"><?php echo strip_tags($descripcion); ?></p>
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
                                    <small><?php echo time_ago(); ?> <i class="fas fa-clock"></i></small>
                                </div>
                            </div>
                            <a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
                                <div class='imagen-nota-container'>
                                    <div class="imagen-nota" style="background-image: url('<?php echo $featured_img_url; ?>');">
                                        <div>
                                            <?php
                                            if (!empty(get_field('content_type'))){
                                                $content_type = get_field('content_type');
                                                switch($content_type){
                                                    // Tipo de contenido: Video
                                                    case 'video':
                                                        if (!empty(get_field('video_jwplayer'))){
                                                            $video_iframe = get_field('video_jwplayer');
                                                            $url_imagen_video = get_field('url_imagen_video');
                                                            $video_html = '<div class="contenedor-media">'.$video_iframe.'</div>'; ?>
                                                            <i class="fas fa-play media_file_jw media-type-icon media-type-icon-negro pl-1" 
                                                                data-titulo='<?php echo get_the_title(); ?>' 
                                                                data-video='<?php echo $video_iframe; ?>' 
                                                                data-img='<?php  echo $url_imagen_video?>' ></i>
                                                            <?php
                                                        }else{
                                                            if (!empty(get_field('video_youtube'))){
                                                                $video_iframe = get_field('video_youtube');
                                                                /*Autoplay Functionallity*/
                                                                if ( preg_match('/src="(.+?)"/', $video_iframe, $matches) ) {
                                                                    // Video source URL
                                                                    $src = $matches[1];
                                                                    // Add option to hide controls, enable HD, and do autoplay -- depending on provider
                                                                    $params = array(
                                                                        'autoplay' => 1
                                                                    );
                                                                    $new_src = add_query_arg($params, $src);
                                                                    $video_iframe = str_replace($src, $new_src, $video_iframe);
                                                                    // add extra attributes to iframe html
                                                                    $attributes = 'frameborder="0"';
                                                                    $video_iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video_iframe);
                                                                }
                                                                /*Autoplay Functionallity*/
                                                                $video_html = '<div class="contenedor-media">'.$video_iframe.'</div>'; ?>
                                                                <i class="fas fa-play media_file media-type-icon media-type-icon-negro pl-1" data-titulo='<?php echo get_the_title(); ?>' data-media='<?php echo $video_html; ?>'></i>
                                                                <?php 
                                                            }
                                                        }   
                                                    break;
                                                    // Tipo de contenido: Audio
                                                    case 'audio':
                                                        if (!empty(get_field('audio_news'))){
                                                            $audio_iframe = get_field('audio_news');
                                                            $audio_html = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>'; ?>
                                                            <i class="fas fa-volume-up media_file media-type-icon media-type-icon-negro" data-media='<?php echo $audio_html; ?>'></i>
                                                            <?php
                                                        }
                                                    break;
                                                } // End of switch
                                            } // End of if (content_type)
                                            ?>
                                        </div>
                                    </div>
                                    <!-- <img src="<?php echo $featured_img_url; ?>" class="img-fluid d-block imagen-nota" alt="<?php the_title(); ?>"> -->
                                    <h5 class="titulo-nota"><?php the_title(); ?></h5>
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