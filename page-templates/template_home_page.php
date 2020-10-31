<?php
  /* Template Name: Template Home Page */
  get_header();
  
  // SLIDER PRINCIPAL
  $acf_featured_notes = get_field('acf_featured_notes');
  $acf_journals_publications = get_field('journals_publications');
  // Definition to see if has any pos
  if ( $acf_featured_notes ) { ?>

    <div class="owl-carousel carousel-style-zero">
      <?php
        foreach ($acf_featured_notes as $post) {
          setup_postdata($post); ?>
          <div class="custom-main-slider py-5 py-md-7 d-flex align-items-end" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>); background-size: cover; background-position: center center;"><a class="link-a-nota toto-2" href="<?php the_permalink(); ?>"></a><!-- *imagen de nota (como background-image) -->

            <!-- Iconos de compartir -->
            <!-- <ul class="links-compartir list-inline mb-0">
              <li class="list-inline-item">
                <a href="javascript:void(0)" class="btnsf" data-title="<?php the_title(); ?>" data-excerpt="" data-link="<?php the_permalink(); ?>" data-img="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>"><i class="fab fa-facebook-square"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="javascript:void(0)" class="btnst" data-title="<?php the_title(); ?>" data-link="<?php the_permalink(); ?>"><i class="fab fa-twitter"></i></a>
              </li>
            </ul> -->
            <!-- <a href="javascript:void(0)" class="btnsf" data-title="<?php the_title(); ?>" data-excerpt="" data-link="<?php the_permalink(); ?>" data-img="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>"><i class="fab fa-facebook-square texto-blanco topright1"></i></a>
            <a href="javascript:void(0)" class="btnst" data-title="<?php the_title(); ?>" data-link="<?php the_permalink(); ?>"><i class="fab fa-twitter texto-blanco topright2"></i></a> -->
            
            <!-- Título de nota / Hashtags -->
            <div class="container">
              <div class="row">
                <div class="col col-sm-10 col-lg-9">

                    <div class="mb-3">
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
                              <i class="fas fa-play media_file media-type-icon pl-1" data-media='<?php echo $video_html; ?>' data-toggle="tooltip" data-placement="top" title="Video"></i>
                      <?php }
                        break;
                        // Tipo de contenido: Video de Facebook
                        case 'facebook':
                          if (!empty(get_field('video_facebook_news'))){
                            $url_video = get_field('video_facebook_news');
                            $video_iframe = '<iframe src="https://www.facebook.com/plugins/video.php?href='.$url_video.'&mute=0" allow="encrypted-media" allowFullScreen="true">';
                            $video_html = '<div class="contenedor-media">'.$video_iframe.'</div>'; ?>
                            <i class="fas fa-play media_file media-type-icon pl-1" data-media='<?php echo $video_html; ?>' data-toggle="tooltip" data-placement="top" title="Video"></i>
                      <?php }
                        break;
                        // Tipo de contenido: Gif
                        case 'gif':
                          if (!empty(get_field('gif_news'))){
                            $gif_url = get_field('gif_news');
                            $gif_html = '<div class="contenedor-media"><img class="contenedor-media-item" src="'.$gif_url.'"></div>'; ?>
                            <i class="fas fa-spinner media_file media-type-icon" data-media='<?php echo $gif_html; ?>' data-toggle="tooltip" data-placement="top" title="Gif"></i>
                      <?php }
                        break;
                        // Tipo de contenido: Audio
                        case 'audio':
                          if (!empty(get_field('audio_news'))){
                            $audio_iframe = get_field('audio_news');
                            $audio_html = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>'; ?>
                            <i class="fas fa-volume-up media_file media-type-icon" data-media='<?php echo $audio_html; ?>' data-toggle="tooltip" data-placement="top" title="Audio"></i>
                      <?php }
                        break;
                        } // End of switch
                      } // End of if (content_type)
                      ?>
                    </div>

                    <!-- *hashtags -->
                    <div class="d-none d-sm-block mb-2">
                      <?php
                      $hashtags = get_the_tags();
                        if ($hashtags){
                          foreach($hashtags as $hashtag){
                            echo '<a class="hashtag" href="' . get_tag_link($hashtag->term_id) . '"><span class="bg-light py-1 px-2">#' . $hashtag->name . '</span></a>';
                          }
                        }
                      ?>
                    </div>

                    <!-- *título de la nota -->
                    <h1 class="titulo-destacado-nota m-0">
                      <a href="<?php the_permalink(); ?>">
                        <span><?php echo get_the_title(); ?> <i class="fas fa-circle punto texto-amarillo"></i></span>
                      </a>
                    </h1>

                </div>
              </div>
            </div>

          </div>
      <?php
        }
        wp_reset_postdata();
      ?>
    </div>
<?php } ?>

<?php
  // CARUSELES DE SECCIONES
  $sliders = get_field('sliders');
  require get_template_directory() . '/inc/color_categories.php';

  if ( $sliders ) {
    foreach ($sliders as $slider) {

      /* Obtener el nombre y color de las secciones */
      $category_id = $slider['category'];
      $category_object = get_terms( 
        array(
          'taxonomy' => 'category',
          'term_taxonomy_id' => $category_id
        )
      );
      $category_name = get_color_taxonomy($category_object[0]);

      $slider_type = $slider['slider_type']; // Tipo de slider
      $posts_per_page = $slider['posts_per_page']; // Número de notas a cargar
      $category_link  = get_category_link($category_id); // Link de la sección
      $category_description  = category_description($category_id); // Descripción de la sección

      ?>

      <!-- Contenedor de carusel -->
      <div class="container mt-7 container-lg">

        <div class="row">
          <div class="col">
            <!-- *título de sección -->
            <h2 class="titulo-seccion">
              <a href="<?php echo esc_url($category_link); ?>"><?php echo $category_name; ?></a>
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
                  'posts_per_page' => $posts_per_page, 
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
    } // End for ($sliders as $slider)
  } // End if ($sliders)
?>
  
<?php
// PUBLICACIONES UANL
  if ( $acf_journals_publications ) { ?>

    <div class="my-7 my-md-9">
      <div class="container container-lg">
        <div class="row">
          <div class="col text-center">
            <h2 class="titulo-seccion">
              PUBLICACIONES<span class="texto-amarillo">UANL</span><i class="fa fa-circle punto"></i>
            </h2>
          </div>
        </div>
      </div>

      <div class="w-gallery mt-5">
        <section id="responsiveGallery-container" class="responsiveGallery-container">
          <a class="responsiveGallery-btn responsiveGallery-btn_prev" href="javascript:void(0);"><i class="fas fa-chevron-left texto-azul"></i></a>
          <a class="responsiveGallery-btn responsiveGallery-btn_next" href="javascript:void(0);"><i class="fas fa-chevron-right texto-azul"></i></a>
          <ul class="responsiveGallery-wrapper">
            <?php
              foreach ($acf_journals_publications as $post) {
                setup_postdata($post);
                $journal = '<div class="journal-iframe-conatiner"><iframe class="journal-iframe" src="'.$post['journal_url'].'/1?ff" width="100%"></iframe></div>'; ?>
                <li class="responsiveGallery-item">
                  <a class="media_file responsivGallery-link" href="javascript:void(0);" data-media='<?php echo $journal; ?>'>
                    <img src="<?php echo $post['image']; ?>" height="320" width="320" alt="" class="responsivGallery-pic">
                  </a>
                  <div class="w-responsivGallery-info">
                    <h2 class="responsivGallery-name"><span class="yellow-color"><?php echo $post['journal_title'].':'; ?></span> <?php echo $post['journal_edition']; ?></h2>
                    <h3 class="responsivGallery-position"><?php echo $post['journal_publication_date']; ?></h3>
                  </div>
                </li>
            <?php
              }
              wp_reset_postdata();
            ?>
          </ul>
        </section>
      </div>
    </div>
<?php } ?>

<?php get_footer(); ?>