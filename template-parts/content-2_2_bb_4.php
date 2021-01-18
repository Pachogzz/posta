<?php 
/**
 * Template part for displaying 8 notes three sizes 1 box banner
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 */
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

<section class="bloque_notas--2_2_bb_4 py-6" style="background-image: url( <?php echo $imagenFondo; ?> ); background-color: <?php echo $colorFondo; ?> !important;">
    <div class="container">
        <!-- Desktop block -->
        <div class="d-none d-sm-none d-md-none d-lg-block">
            <div class="row">

                <div class="col-12">
                    <div class="encabezado">
                         <h2 class="encabezado-titulo" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
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

                <?php
                            //para asignar el postthumbnail correcto
                            require get_template_directory() . '/inc/detect_mobile_desktop.php'; 
                            
                            $pos = 0;
                            $args = array (
                                'post_type'      => 'post',
                                'cat'      => $categoria->term_id,
                                'posts_per_page' => -1,
                                'orderby'        => 'date',
                                'order'          => 'DESC'
                            );
                            $the_query = new WP_Query( $args );
                            if ( $the_query->have_posts() ):
                                
                                ?>
                                    <style type="text/css">
                                        #slider_2_2_bb_4{
                                            width:1200px;
                                            margin:0px;
                                            border-top: 0px;
                                            border-bottom: 0px;
                                            border:0px !important;
                                            padding: 0px;
                                            height: 1200px;
                                        }
                                        #slider_2_2_bb_4 li{
                                            display:flex;
                                            height:1200px;
                                        }
                                    </style>
                                    <ul id="slider_2_2_bb_4">
                                <?php
                                
                                while ( $the_query->have_posts() ) :
                                    $the_query->the_post(); 
                                    
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
                                    // Si no hay Imagen destacada hace fallback a la imagen definida en opciones del tema
                                    if (empty($featured_img_url)){
                                        $featured_img_url = get_theme_mod('default_news_image');
                                    }
                                    }

                                    //Si pos llega a 8 le asigna el valor 1, si es menor lo sigue incrementando
                                    if($pos >= 8){
                                        $pos = 1;   
                                    }else{
                                        $pos++;
                                    }

                                    echo "<!-- ".$pos." -->";

                                    if( $pos == 1 ){

                ?>

                <li class="row">

                <div class="col-12 col-lg-6">
                    <div class="row h-100">     

                                    <div id="post-<?php the_ID(); ?>" class="col-12 nota large h-100">
                                        <div class="row meta">
                                            <?php 
                                                $child_category = post_child_category(get_the_ID());
                                                $subTax_color = get_term_meta( $child_category->term_id, 'category_color', true );
                                            ?>
                                            <div class="col-6 categoria" style="background-color: <?php echo "#" . $subTax_color; ?> !important;">
                                                <a class="text-white" href="<?php echo get_category_link($child_category->cat_ID); ?>" title="<?php echo $child_category->cat_name;?>">
                                                    <small><?php echo $child_category->cat_name; ?></small>
                                                </a>
                                                <span class="side-triangle" style="background-color: <?php echo "#" . $subTax_color; ?> !important;"></span>
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
                    </div>
                </div>

                <?php 
                    }elseif($pos == 2){
                        ?>

                    <div class="col-12 col-lg-6">
                    <div class="row inner-row align-self-stretch">

                        <div id="post-<?php the_ID(); ?>" class="col-12 large nota">
                            <div class="row meta">
                                            <?php 
                                                $child_category = post_child_category(get_the_ID());
                                                $subTax_color = get_term_meta( $child_category->term_id, 'category_color', true );
                                            ?>
                                            <div class="col-6 categoria" style="background-color: <?php echo "#" . $subTax_color; ?> !important;">
                                                <a class="text-white" href="<?php echo get_category_link($child_category->cat_ID); ?>" title="<?php echo $child_category->cat_name;?>">
                                                    <small><?php echo $child_category->cat_name; ?></small>
                                                </a>
                                                <span class="side-triangle" style="background-color: <?php echo "#" . $subTax_color; ?> !important;"></span>
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

                    }elseif($pos == 3){

                        ?>
                        <div id="post-<?php the_ID(); ?>" class="col-12 col-md-6 nota">
                            <div class="row meta">
                                            <?php 
                                                $child_category = post_child_category(get_the_ID());
                                                $subTax_color = get_term_meta( $child_category->term_id, 'category_color', true );
                                            ?>
                                            <div class="col-6 categoria" style="background-color: <?php echo "#" . $subTax_color; ?> !important;">
                                                <a class="text-white" href="<?php echo get_category_link($child_category->cat_ID); ?>" title="<?php echo $child_category->cat_name;?>">
                                                    <small><?php echo $child_category->cat_name; ?></small>
                                                </a>
                                                <span class="side-triangle" style="background-color: <?php echo "#" . $subTax_color; ?> !important;"></span>
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

                    }elseif($pos == 4){ 
                        //publicidad link estático
                        ?>
                        <div class="col-12 col-md-6 nota modulo-publicidad">
                            <img src="http://fakeimg.pl/300x300/333/ccc/?text=BoxBanner" class="img-fluid d-block mb-0" alt="Publicidad...">
                            <span>Publicidad</span>
                        </div>
                        
                    </div><!-- /.col-12 -->
                </div><!-- /.row .inner-row -->
                        <?php

                    }elseif($pos == 5){
                        ?>
                            <div class="col-12 mt-6">
                                <div class="row align-self-stretch">
                                    
                                        <div id="post-<?php the_ID(); ?>" class="col-12 col-md-6 col-lg-3 nota">
                                            <div class="row meta">
                                            <?php 
                                                $child_category = post_child_category(get_the_ID());
                                                $subTax_color = get_term_meta( $child_category->term_id, 'category_color', true );
                                            ?>
                                            <div class="col-6 categoria" style="background-color: <?php echo "#" . $subTax_color; ?> !important;">
                                                <a class="text-white" href="<?php echo get_category_link($child_category->cat_ID); ?>" title="<?php echo $child_category->cat_name;?>">
                                                    <small><?php echo $child_category->cat_name; ?></small>
                                                </a>
                                                <span class="side-triangle" style="background-color: <?php echo "#" . $subTax_color; ?> !important;"></span>
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
                    }elseif($pos == 6){
                        ?>
                                        <div id="post-<?php the_ID(); ?>" class="col-12 col-md-6 col-lg-3 nota">
                                            <div class="row meta">
                                            <?php 
                                                $child_category = post_child_category(get_the_ID());
                                                $subTax_color = get_term_meta( $child_category->term_id, 'category_color', true );
                                            ?>
                                            <div class="col-6 categoria" style="background-color: <?php echo "#" . $subTax_color; ?> !important;">
                                                <a class="text-white" href="<?php echo get_category_link($child_category->cat_ID); ?>" title="<?php echo $child_category->cat_name;?>">
                                                    <small><?php echo $child_category->cat_name; ?></small>
                                                </a>
                                                <span class="side-triangle" style="background-color: <?php echo "#" . $subTax_color; ?> !important;"></span>
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
                    }elseif($pos == 7){

                    ?>
                        <div id="post-<?php the_ID(); ?>" class="col-12 col-md-6 col-lg-3 nota">
                            <div class="row meta">
                                            <?php 
                                                $child_category = post_child_category(get_the_ID());
                                                $subTax_color = get_term_meta( $child_category->term_id, 'category_color', true );
                                            ?>
                                            <div class="col-6 categoria" style="background-color: <?php echo "#" . $subTax_color; ?> !important;">
                                                <a class="text-white" href="<?php echo get_category_link($child_category->cat_ID); ?>" title="<?php echo $child_category->cat_name;?>">
                                                    <small><?php echo $child_category->cat_name; ?></small>
                                                </a>
                                                <span class="side-triangle" style="background-color: <?php echo "#" . $subTax_color; ?> !important;"></span>
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

                    }elseif($pos == 8){

                    ?>

                            <div id="post-<?php the_ID(); ?>" class="col-12 col-md-6 col-lg-3 nota">
                                <div class="row meta">
                                            <?php 
                                                $child_category = post_child_category(get_the_ID());
                                                $subTax_color = get_term_meta( $child_category->term_id, 'category_color', true );
                                            ?>
                                            <div class="col-6 categoria" style="background-color: <?php echo "#" . $subTax_color; ?> !important;">
                                                <a class="text-white" href="<?php echo get_category_link($child_category->cat_ID); ?>" title="<?php echo $child_category->cat_name;?>">
                                                    <small><?php echo $child_category->cat_name; ?></small>
                                                </a>
                                                <span class="side-triangle" style="background-color: <?php echo "#" . $subTax_color; ?> !important;"></span>
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
                    </div><!-- /.col-12 -->
                </div><!-- /.row .align-self-stretch -->
                    
            </li>

                    <?php

                    }//termina elseif
                    endwhile;
                    ?>
                        </ul><!-- /#slider -->
                    <?php
                    endif;

                ?>
                
                <div class="col-12 text-right">
                    <a class="btn btn-lg" href="<?php echo $link; ?>" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
                        <span class="nombre-taxonomia font-weight-bold lead <?php echo $colorTexto; ?>">Ver más contenido <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>

            </div><!-- /.row -->
        </div><!-- /.d-none .md-block -->
    
        <!-- Anythingslider  -->
        <script type="text/javascript">
          jQuery('#slider_2_2_bb_4').anythingSlider({
            // resizeContents      : false,
            buildArrows         : true,
            autoPlay            : false,
            buildNavigation     : false,
            buildStartStop      : false,
            expand              : false,
            hashTags            : false
          });
        </script>

        <!-- TERMINA Desktop block -->

        <!-- Movile slide -->
        <div class="d-block d-sm-block d-md-block d-lg-none">
            <div class="row">
                <div class="col-12">
                    <div class="encabezado">
                        <h2 class="encabezado-titulo" style="background-color: <?php echo "#" . $tax_color; ?> !important;">
                            <a href="<?php echo $link; ?>">
                                <?php if($tipoTitulo == 'por_defecto'): ?>
                                    <span class="nombre-taxonomia"><?php echo $categoria->name;?></span>
                                <?php else: ?>
                                    <span class="nombre-taxonomia"><?php echo $tituloPerso;?></span>
                                <?php endif ?>
                            </a>
                        </h2>
                        <?php if ($mostraDescr): ?>
                            <p class="encabezado-descripcion text-white"><?php echo strip_tags($descripcion); ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="owl-carousel movile-slider align-self-stretch">
                    <?php
                        $args = array (
                            'post_type'      => 'post',
                            'cat'      => $categoria->term_id,
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
                                <?php 
                                    $child_category = post_child_category(get_the_ID());
                                    $subTax_color = get_term_meta( $child_category->term_id, 'category_color', true );
                                ?>
                                <div class="col-6 categoria" style="background-color: <?php echo "#" . $subTax_color; ?> !important;">
                                    <a class="text-white" href="<?php echo get_category_link($child_category->cat_ID); ?>" title="<?php echo $child_category->cat_name;?>">
                                        <small><?php echo $child_category->cat_name; ?></small>
                                    </a>
                                    <span class="side-triangle" style="background-color: <?php echo "#" . $subTax_color; ?> !important;"></span>
                                </div>
                                <div class="col hora text-right">
                                    <small><?php echo $haceTiempo; ?></small>
                                </div>
                            </div>
                            <?php require get_template_directory() . '/template-parts/content-tipo.php'; ?>
                            <a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
                                <div class='imagen-nota-container'>
                                    <div class="imagen-nota" style="background-image: url('<?php echo $featured_img_url; ?>');">
                                    </div>
                                    <h5 class="titulo-nota <?php echo $colorTexto; ?>"><?php the_title(); ?></h5>
                                </div>
                            </a>
                            <!-- ICONOS COMPARTIR -->
                            <!-- <div class="d-sm-none">
                                </?php require get_template_directory() . '/inc/iconos-compartir.php'; ?>
                            </div> -->
                        </div>
                    <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                        <div class="col-12 nota modulo-publicidad">
                            <img src="http://fakeimg.pl/300x300/333/ccc/?text=BoxBanner" class="img-fluid d-block mb-0" alt="Publicidad...">
                            <span>Publicidad</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Movile slide -->
    </div>
</section>