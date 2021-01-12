<?php
  /* Template Name: Template Prueba */
  get_header();
?>
<?php
// CODIGO DE CARUSELES DE SECCIONES ORIGINAL DEL TEMA DE PUNTO U:
  //$sliders = get_field('sliders');

  //if ( $sliders ) {
   // foreach ($sliders as $slider) {

      /* Obtener el nombre y color de las secciones */
    //  $category_id = $slider['category'];
     /* $category_object = get_terms( 
        array(
          'taxonomy' => 'category',
          'term_taxonomy_id' => $category_id
        )
      );
      $category_name = get_color_taxonomy($category_object[0]);

      $slider_type = $slider['slider_type']; // Tipo de slider
      $posts_per_page = $slider['posts_per_page']; // Número de notas a cargar
      $category_link  = get_category_link($category_id); // Link de la sección
      $category_description  = category_description($category_id); // Descripción de la sección*/
      ?>

      <!-- Contenedor de carusel -->
          <!--div class="container mt-7 container-lg">

            <div class="row">
              <div class="col">
                <!-- *título de sección -->
                <!--h2 class="titulo-seccion">
                  <a href="<?php //echo esc_url($category_link); ?>"><?php //echo $category_name; ?></a>
                </h2>
                <div class="borde my-3"></div>
                <div class="row mb-3 links-to-filter-publications-<?php //echo $category_id; ?>">
                  <!-- *descripcion de seccion -->
                  <!--div class="col-sm d-none d-md-block text-left">
                    <div class="text-white p-0 descripcion-categoria"><?php //echo $category_description; ?></div>
                  </div>
                  <!-- *filtros de carusel de sección -->
                  <!--div class="col-sm-auto hidden offset-sm-1 d-none d-md-block text-right">
                    <!-- **link filtro más reciente -->
                    <!--a class="rpl-<?php //echo $category_id; ?> recent_added_posts link-filtro-activo p-2"
                      href="javascript:void(0)"
                      data-category="<?php //echo $category_id; ?>"
                      data-post-type="post"
                      data-filter-type="recent_added"
                      data-carousel-type="<?php //echo $slider_type; ?>">
                      <i class="fas fa-circle d-inline rpl-circle-<?php //echo $category_id; ?>"></i> Más reciente
                    </a>
                    <!-- **link filtro más visto -->
                    <!--a class="mvl-<?php //echo $category_id; ?> more_viewed_posts link-filtro p-2"
                      href="javascript:void(0)"
                      data-category="<?php //echo $category_id; ?>"
                      data-post-type="post"
                      data-filter-type="most_viewed"
                      data-carousel-type="<?php //echo $slider_type; ?>">
                      <i class="fas fa-circle d-none mvl-circle-<?php //echo $category_id; ?>"></i> Más visto
                    </a>
                  </div>
                </div>
                <!-- *carusel de notas -->
                <!--div id="carousel-<?php //echo $category_id; ?>" class="owl-carousel owl-<?php ///echo $slider_type; ?> <?php //echo $slider_type; ?>">
                  <?php
                    /*$output = 'objects';
                    $args = array ( 
                      'post_type' => 'post', 
                      'posts_per_page' => $posts_per_page, 
                      'cat' => $category_id, 
                      'orderby' => 'date', 
                      'order' => 'DESC' 
                    );*/
                    //$the_query = new WP_Query( $args, $output );

                    //if ( $the_query->have_posts() ) :
                     // while ( $the_query->have_posts() ) :
                       // $the_query->the_post(); ?>
                        <div class="c-item">
                          <?php //get_template_part( 'template-parts/content', 'home-categories' ); ?>
                        </div>
                  <?php
                    //  endwhile;
                   // endif;
                  ?>
                  <!-- **botón ver mas notas -->
                  <!--div class="c-item background-amarillo p-2">
                    <a class="texto-blanco text-center text-uppercase" href="<?php //echo esc_url($category_link); ?>" title="Ver más notas">
                      <div class="contenedor-media">
                        <div class="contenedor-media-item item-ver-mas">
                          <h4 class="m-0">Ver más notas</h4>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <!-- *icono cargar notas por ajax -->
                <!--div class="row">
                  <div class="col">
                    <i class="fas fa-circle-notch fa-spin hidden spinner load-<?php //echo $category_id; ?>"></i>
                  </div>
                </div>

              </div>
            </div>

          </div-->
        <?php
        //} // End for ($sliders as $slider)
     // } // End if ($sliders)
    ?>

<?php // CODIGO DE CARUSELES DE COLECCION, TEMAS Y SECCION ?>
<?php 
$cont_car =0; //Varible para ver el numero de carriseles- se usó para priebas
$test = false;
if($test  == true){
if( have_rows('contenedor_carruseles_2')){
  while ( have_rows('contenedor_carruseles_2')) {
    the_row();
    
    if($cont_car % 3==0){
    ?>
      <div class="container mt-7 container-lg " style="border-style: solid; border-width: 1px;" width="auto" height="600px">
        <div class="row">
          <div class="col">

          </div>
        </div>
      </div>
      
    <?php
    echo $cont_car;
    }

    if(get_row_layout() == 'carrusel-coleccion'){   //Evalua si el layout es para el carrusel de coleccion

      echo 'carrusel_coleccionn <br>';
      $selecciona_las_notas = get_sub_field('selecciona_las_notas');
      $slider_type_coleccion = get_sub_field('tipo_de_carrusel_coleccion');
      $titulo_del_carrusel = get_sub_field('titulo_del_carrusel');
      if ( $selecciona_las_notas ) { ?>
        <div class="container mt-7 container-lg">
          <div class="row">
            <div class="col">
              <!-- *título de sección -->
              <h2 class="titulo-seccion">
                <a href="<?php echo esc_url($category_link); ?>"><?php echo $titulo_del_carrusel;  ?></a>
              </h2>
              <div class="borde my-3"></div>        
              <div class="owl-carousel owl-<?php echo $slider_type_coleccion; ?> <?php echo $slider_type_coleccion; ?>">
            
                <?php
                foreach ($selecciona_las_notas as $post) {
                  setup_postdata($post); ?>
                  <div class="c-item">
                    <div class="contenedor-media embed-responsive-z100-tc d-flex justify-content-start align-items-start p-2" 
                      style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>);">
                      <a class="link-a-nota toto-2" href="<?php the_permalink(); ?>"></a><!-- *imagen de nota (como background-image) -->
                  
                      <!-- Iconos de compartir -->
                      <!-- <ul class="links-compartir list-inline mb-0">
                      <li class="list-inline-item">
                        <a href="javascript:void(0)" class="btnsf" data-title="<?php the_title(); ?>" 
                        data-excerpt="" data-link="<?php the_permalink(); ?>" 
                        data-img="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>">
                        <i class="fab fa-facebook-square"></i></a>
                      </li>
                      <li class="list-inline-item">
                        <a href="javascript:void(0)" class="btnst" data-title="<?php the_title(); ?>" 
                        data-link="<?php the_permalink(); ?>"><i class="fab fa-twitter"></i></a>
                      </li>
                      </ul> -->
                      <!-- <a href="javascript:void(0)" class="btnsf" data-title="<?php the_title(); ?>" 
                      data-excerpt="" data-link="<?php the_permalink(); ?>" 
                      data-img="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>">
                      <i class="fab fa-facebook-square texto-blanco topright1"></i></a>
                      <a href="javascript:void(0)" class="btnst" data-title="<?php the_title(); ?>" 
                      data-link="<?php the_permalink(); ?>"><i class="fab fa-twitter texto-blanco topright2">
                      </i></a> -->
    
                      <!-- *icono tipo de contenido -->
                      <?php
                      if (!empty(get_field('content_type'))){
                        $content_type = get_field('content_type');
                        switch($content_type){
                          // Tipo de contenido: Video
                          case 'video':
                            if (!empty(get_field('video_news'))){
                              $video_iframe = get_field('video_news');
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
                              <i class="fas fa-play media_file media-type-icon pl-1" data-media='<?php echo $video_html; ?>' 
                              data-toggle="tooltip" data-placement="top" title="Video"></i>
                          <?php }
                          break;
                          // Tipo de contenido: Video de Facebook
                          case 'facebook':
                            if (!empty(get_field('video_facebook_news'))){
                              $url_video = get_field('video_facebook_news');
                              $video_iframe = '<iframe src="https://www.facebook.com/plugins/video.php?href='.$url_video.'&mute=0" allow="encrypted-media" allowFullScreen="true">';
                              $video_html = '<div class="contenedor-media">'.$video_iframe.'</div>'; ?>
                              <i class="fas fa-play media_file media-type-icon pl-1" data-media='<?php echo $video_html; ?>' 
                              data-toggle="tooltip" data-placement="top" title="Video"></i>
                          <?php }
                          break;
                          // Tipo de contenido: Gif
                          case 'gif':
                            if (!empty(get_field('gif_news'))){
                              $gif_url = get_field('gif_news');
                              $gif_html = '<div class="contenedor-media"><img class="contenedor-media-item" src="'.$gif_url.'"></div>'; ?>
                              <i class="fas fa-spinner media_file media-type-icon" data-media='<?php echo $gif_html; ?>' 
                              data-toggle="tooltip" data-placement="top" title="Gif"></i>
                          <?php }
                          break;
                          // Tipo de contenido: Audio
                          case 'audio':
                            if (!empty(get_field('audio_news'))){
                              $audio_iframe = get_field('audio_news');
                              $audio_html = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>'; ?>
                              <i class="fas fa-volume-up media_file media-type-icon" data-media='<?php echo $audio_html; ?>' 
                              data-toggle="tooltip" data-placement="top" title="Audio"></i>
                          <?php }
                          break;
                        } // End of switch
                      } // End of if (content_type)
                      ?> 
                      <!-- *icono de compartir -->
                      <i class="fas fa-share-alt share-from-modal share-icon" data-title="<?php echo esc_html(get_the_title()); ?>" 
                      data-excerpt="" data-link="<?php the_permalink(); ?>" data-img="<?php echo $featured_img_url; ?>" data-toggle="tooltip" data-placement="left" title="Compartir"></i>           
                    </div><!--Cierra el div contenedo media-->
                      <div class="encabezado-nota">
                        <!-- *titulo de nota -->
                        <h4 class="titulo-de-nota">
                          <a class="texto-blanco" href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a>
                        </h4>
                        <!-- *hashtags de nota -->
                        <?php
                        $hashtags = get_the_tags();
                        if ($hashtags){
                          foreach($hashtags as $hashtag){
                            echo '<a class="d-inline-block mr-2" href="' . get_tag_link($hashtag->term_id) . '">#'.$hashtag->name.'</a>';
                          }
                        }
                        ?>
                      </div>
                  </div><!-- Cierra en div item --> 
                  <?php }
                  wp_reset_postdata();
                ?>
              </div>
            </div>
          </div>
        </div>
      <?php } 
      wp_reset_postdata(); 

    }elseif(get_row_layout() == 'carrusel-tema'){  //Evalua si el  layout es para el carrusel de tema
    
      echo 'carrusel_tema <br>';
      /* Obtener el nombre y color de las secciones */
      $category_id = get_sub_field('selecciona_el_tema');
      $category_object = get_terms( 
        array(
          'taxonomy' => 'category',
          'term_taxonomy_id' => $category_id
        )
      );
      $category_name = get_color_taxonomy($category_object[0]);
      $slider_type = get_sub_field('tipo_de_carrusel_tema'); // Tipo de slider
      //$posts_per_page = 3;
      //$posts_per_page = $slider['posts_per_page']; // Número de notas a cargar
      $category_link  = get_category_link($category_id); // Link de la sección
      $category_description  = category_description($category_id); // Descripción de la sección*/
      ?>
      <!-- Contenedor de carusel -->
      <div class="container mt-7 container-lg">
        <div class="row">
          <div class="col">
            <!-- *título de sección -->
            <h2 class="titulo-seccion">
              <a href="<?php echo esc_url($category_link); ?>"><?php echo $category_name;  ?></a>
            </h2>
            <div class="borde my-3"></div>
            <div class="row mb-3 links-to-filter-publications-<?php echo $category_id; ?>">
              <!-- *descripcion de seccion -->
              <div class="col-sm d-none d-md-block text-left">
                <div class="text-white p-0 descripcion-categoria"><?php echo $category_description; ?></div>
              </div>
              <!-- *filtros de carusel de sección -->
              <div class="col-sm-auto hidden offset-sm-1 d-none d-md-block text-right">
                <!-- **link filtro más reciente -->
                <a class="rpl-<?php echo $category_id; ?> recent_added_posts link-filtro-activo p-2"
                  href="javascript:void(0)"
                  data-category="<?php echo $category_id; ?>"
                  data-post-type="post"
                  data-filter-type="recent_added"
                  data-carousel-type="<?php echo $slider_type; ?>">
                  <i class="fas fa-circle d-inline rpl-circle-<?php echo $category_id; ?>"></i> Más reciente
                </a>
                <!-- **link filtro más visto -->
                <a class="mvl-<?php echo $category_id; ?> more_viewed_posts link-filtro p-2"
                  href="javascript:void(0)"
                  data-category="<?php echo $category_id; ?>"
                  data-post-type="post"
                  data-filter-type="most_viewed"
                  data-carousel-type="<?php echo $slider_type; ?>">
                  <i class="fas fa-circle d-none mvl-circle-<?php echo $category_id; ?>"></i> Más visto
                </a>
              </div>
            </div>
            <!-- *carusel de notas -->
            <div id="carousel-<?php echo $category_id; ?>" class="owl-carousel owl-<?php echo $slider_type; ?> <?php echo $slider_type; ?>">
              <?php
                $output = 'objects';
                $args = array ( 
                'post_type' => 'post', 
                'tag_id' => $category_id, 
                'orderby' => 'date', 
                'order' => 'DESC' 
                );
                $the_query = new WP_Query( $args, $output );
                if ( $the_query->have_posts() ) :
                  while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>
                    <div class="c-item">
                      <?php get_template_part( 'template-parts/content', 'home-categories' ); ?>
                    </div>
              <?php
                  endwhile;
                endif;
                wp_reset_postdata();
              ?>
              <!-- **botón ver mas notas -->
              <div class="c-item background-amarillo p-2">
                <a class="texto-blanco text-center text-uppercase" href="<?php echo esc_url($category_link); ?>" title="Ver más notas">
                  <div class="contenedor-media">
                    <div class="contenedor-media-item item-ver-mas">
                      <h4 class="m-0">Ver más notas</h4>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            <!-- *icono cargar notas por ajax -->
            <div class="row">
              <div class="col">
                <i class="fas fa-circle-notch fa-spin hidden spinner load-<?php echo $category_id; ?>"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php  

    }elseif(get_row_layout() == 'carrusel-seccion'){ //Evalua si el  layout es para el carrusel de seccion

      echo 'carrusel_seccion <br>'; 
      $category_id = get_sub_field('selecciona_la_seccion');
      $category_object = get_terms( 
        array(
          'taxonomy' => 'category',
          'term_taxonomy_id' => $category_id
        )
      );
      $category_name = get_color_taxonomy($category_object[0]);
      $slider_type = get_sub_field('tipo_de_carrusel_seccion'); // Tipo de slider
      //$posts_per_page = 3;
      //$posts_per_page = $slider['posts_per_page']; // Número de notas a cargar
      $category_link  = get_category_link($category_id); // Link de la sección
      $category_description  = category_description($category_id); // Descripción de la sección*/
      ?>
      <!-- Contenedor de carusel -->
      <div class="container mt-7 container-lg">
        <div class="row">
          <div class="col">
            <!-- *título de sección -->
            <h2 class="titulo-seccion">
              <a href="<?php echo esc_url($category_link); ?>"><?php echo $category_name;?></a>
            </h2>
            <div class="borde my-3"></div>
            <div class="row mb-3 links-to-filter-publications-<?php echo $category_id; ?>">
              <!-- *descripcion de seccion -->
              <div class="col-sm d-none d-md-block text-left">
                <div class="text-white p-0 descripcion-categoria"><?php echo $category_description; ?></div>
              </div>
              <!-- *filtros de carusel de sección -->
              <div class="col-sm-auto hidden offset-sm-1 d-none d-md-block text-right">
                <!-- **link filtro más reciente -->
                <a class="rpl-<?php //echo $category_id; ?> recent_added_posts text-white link-filtro-activo p-2"
                  href="javascript:void(0)"
                  data-category="<?php //echo $category_id; ?>"
                  data-post-type="post"
                  data-filter-type="recent_added"
                  data-carousel-type="<?php //echo $slider_type; ?>">
                  <i class="fa fa-circle d-inline rpl-circle-<?php //echo $category_id; ?>"></i> Más reciente
                </a>
                <!-- **link filtro más visto -->
                <a class="mvl-<?php //echo $category_id; ?> more_viewed_posts link-filtro p-2"
                  href="javascript:void(0)"
                  data-category="<?php //echo $category_id; ?>"
                  data-post-type="post"
                  data-filter-type="most_viewed"
                  data-carousel-type="<?php //echo $slider_type; ?>">
                  <i class="fas fa-circle d-none mvl-circle-<?php //echo $category_id; ?>"></i> Más visto
                </a>
              </div>
            </div>
            <!-- *carusel de notas -->
            <div id="carousel-<?php echo $category_id; ?>" class="owl-carousel owl-<?php echo $slider_type; ?> <?php echo $slider_type; ?>">
              <?php
                $output = 'objects';
                $args = array ( 
                  'post_type' => 'post', 
                  'cat' => $category_id, 
                  'orderby' => 'date', 
                  'order' => 'DESC' 
                );
                $the_query = new WP_Query( $args, $output );
                if ( $the_query->have_posts() ) :
                  while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>
                    <div class="c-item">
                      <?php get_template_part( 'template-parts/content', 'home-categories' ); ?>
                    </div>
                <?php
                  endwhile;
                endif;
                wp_reset_postdata();
                ?>
              <!-- **botón ver mas notas -->
              <div class="c-item background-amarillo p-2">
                <a class="texto-blanco text-center text-uppercase" href="<?php //echo esc_url($category_link); ?>" title="Ver más notas">
                  <div class="contenedor-media">
                    <div class="contenedor-media-item item-ver-mas">
                      <h4 class="m-0">Ver más notas</h4>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            <!-- *icono cargar notas por ajax -->
            <div class="row">
              <div class="col">
                <i class="fas fa-circle-notch fa-spin hidden spinner load-<?php echo $category_id; ?>"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php  
    }
    $cont_car += $cont_car;
  }
}
echo 'totales: '.$cont_car;
}
?>

<?php 
$cont_layout=0;
 if (have_rows('contenedor_carruseles_2')) {
   while (have_rows('contenedor_carruseles_2')) {
     the_row();
    if(get_row_layout() == 'story_dia'){ //Layout  para el grupo de historias del dia
        //Primer grupo para ver la Nota del dia principal
       if(have_rows('primer_carrusel')){
          while(have_rows('primer_carrusel')){ the_row();
            $historia_del_dia  = get_sub_field('historia_del_dia');
            $tipo_de_carrusel  = get_sub_field('tipo_de_carrusel');
            if($historia_del_dia){
                
            }

          }

        }
        //Segundo grupo para ver la Notas del dia secondarios
        if(have_rows('segundo_carrusel')){
          while(have_rows('segundo_carrusel')){ the_row();
            $historias_del_dia  = get_sub_field('historias_del_dia');
            $tipo_de_carrusel  = get_sub_field('tipo_de_carrusel');
            if($historias_del_dia){
                
            }

          }

        }

    }elseif(get_row_layout() == 'opinon'){ //Layout para ver los editoriales


    }elseif(get_row_layout() == 'carrusel-coleccion'){//Layout para los carruseles de coleccion
      $selecciona_las_notas = get_sub_field('selecciona_las_notas');
      $slider_type_coleccion = get_sub_field('tipo_de_carrusel_coleccion');
      $titulo_del_carrusel = get_sub_field('titulo_del_carrusel');

    }elseif(get_row_layout() == 'grupo_oferta_&_recomendacion'){

        //Codigo para poder hacer los carruseles en notas ofertadas
        if(have_rows('notas_ofertadas')){
          while(have_rows('notas_ofertadas')){ the_row();
              $carruseles_ofertas = get_sub_field('notas');
              
              if($carruseles_ofertas){
                foreach ($carruseles_ofertas as $slider) {
                  $category_id = $slider['selecciona_la_seccion'];
                  $slider_type_ofertadas = $slider['tipo_de_carrusel_seccion'];

                } 
              }
          }
        }//Termina en grupo de las notas ofertadas

        //Codigo para poder mostrar  las notas mas vistas
        if(have_rows('notas_mas_vistas')){
          while(have_rows('notas_mas_vistas')){ the_row();
            $notas_mas_vistas  = get_sub_field('selecciona_notas');
            $tipo_de_carrusel  = get_sub_field('tipo_de_carrusel');
           
            if($notas_mas_vistas){
              foreach($notas_mas_vistas as $nota_mas_vista ){
                  
              }
               
              //Conculta para ver listado de notas mas  vitas
               $args_vistas =  array(
                'port_per_page' => 4,
                'meta_key' => 'post_views',
                'oderby' => 'meta_value_num',
                'order' => 'DESC'
               );  
            }

          }
        }//
        
    }elseif(get_row_layout() == 'galeria'){
         
    }elseif(get_row_layout() == 'grupo_oferta_&_editorial'){
      if (have_rows('notas_recomendadas')) {
        while (haver_rows('notas_recomendadas')) {
         
        }
      }

      if(have_rows('editoriales')){
          
      }
         
    }elseif(get_row_layout() == 'carrusel-tema'){
         
    }
    if($cont_layout ==2 ){
      
    }
   }
 }
?>
<?php get_footer(); ?>