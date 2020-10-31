<?php
  
  // -------------------------------
  // Texto destacado
  // Shortcode ['texto_destacado-'.$i]
  // -------------------------------
  $important_text_module = get_field('important_text_module', get_the_ID());
  if (!empty($important_text_module)){
    $counter = 0;

    function shortcode_important_text($atts){
      extract(shortcode_atts(array(
        'important_text_module' => get_field('important_text_module', get_the_ID())
      ), $atts));

      global $counter;
      
      // $position = (float:left) o (float:right)
      $position = $important_text_module[$counter]['important_text_style'];
      $text = $important_text_module[$counter]['important_text'];

      $shortcode_html = '';
      if ($position == 'left') {
        $shortcode_html .= '
        <div class="texto-destacado mt-2 mb-5 mr-sm-5 float-left">
          <p class="mb-0">'.$text.'</p>
        </div>';
      } elseif ($position == 'right') {
        $shortcode_html .= '
        <div class="texto-destacado mt-2 mb-5 ml-sm-5 float-right">
          <p class="mb-0">'.$text.'</p>
        </div>';
      } else {
        $shortcode_html .= '
        <div class="texto-destacado ancho-completo my-5">
          <p class="mb-0">'.$text.'</p>
        </div>';
      }

      $counter++;
    
      return $shortcode_html;
    }

    for ($i=0; $i<count($important_text_module); $i++){
      add_shortcode('texto_destacado-'.($i+1), 'shortcode_important_text');
    }

  }

  // -------------------------------
  // Galeria
  // Shortcode ['galeria-'.$i]
  // -------------------------------
  $image_gallery = get_field('galeria_imagenes', get_the_ID());
  if (!empty($image_gallery)){
    $gallery_title_counter = 0;

    function shortcode_gallery_images($atts){
      extract(shortcode_atts(array(
        'galeria' => get_field('galeria_imagenes', get_the_ID())
      ), $atts));

      global $gallery_title_counter;

      $gallery_title = $galeria[$gallery_title_counter]['titulo_galeria'];
      $gallery_description = $galeria[$gallery_title_counter]['descripcion_galeria'];

      $shortcode_html = '';
      $shortcode_html .= '
      <div class="galeria p-3 my-5 single-post-gallery">';
      if(!empty($gallery_title)){
         $shortcode_html .= '<h4 class="encabezado-titulo mb-2">'.$gallery_title.'</h4>'; 
      }
      if(!empty($gallery_description)){
        $shortcode_html .= '<p class="mb-0">'.$gallery_description.'</p>';
      }

      $shortcode_html .= '<div id="lightgallery-'.($gallery_title_counter+1).'" class="row galeria-contenido no-gutters mt-2">';
          foreach($galeria[$gallery_title_counter]['contenido_galeria'] as $gallery_image){
            $shortcode_html .= '
            <div class="col-6 col-md-4" data-src="'.$gallery_image['imagen_galeria'].'">
              <div class="galeria-item">
                <a href="'.$gallery_image['imagen_galeria'].'" class="contenedor-media d-flex justify-content-start align-items-end p-2" style="background-image: url('.$gallery_image['imagen_galeria'].'); background-size:cover;" title="Ver imagen">
                  <i class="fas fa-plus"></i>
                  <img class="d-none" src="'.$gallery_image['imagen_galeria'].'">
                </a>
              </div>
            </div>';
          }
        $shortcode_html .='
        </div>
      </div>';

      $gallery_title_counter++;
    
      return $shortcode_html;
    }

    for ($i=0; $i<count($image_gallery); $i++){
      add_shortcode('galeria-'.($i+1), 'shortcode_gallery_images');
    }
  }

  // -------------------------------
  // Ficha de perfil
  // Shortcode ['ficha_de_perfil-'.$i]
  // -------------------------------
  $card_profile_module = get_field('card_profile_module', get_the_ID());
  if (!empty($card_profile_module)){
    $card_profile_counter = 0;

    function shortcode_card_profile($atts){
      extract(shortcode_atts(array(
        'card_profile' => get_field('card_profile_module', get_the_ID())
      ), $atts));

      global $card_profile_counter;

      $shortcode_html = '';
      $shortcode_html .= '
      <div class="ficha-perfil my-5 p-4">
        <div class="row">
          <div class="col-auto">
            <div class="ficha-perfil-imagen" style="background-image: url('.$card_profile[$card_profile_counter]['card_image'].');"></div>
          </div>
          <div class="col-sm mt-3 mt-sm-0">
            <div class="ficha-perfil-contenido">
              <h4 class="mb-2">'.$card_profile[$card_profile_counter]['card_title'].'</h4>
              '.$card_profile[$card_profile_counter]['card_description'];
              if(!empty($card_profile[$card_profile_counter]['card_link'])){
                $shortcode_html .= '<a href="'.$card_profile[$card_profile_counter]['card_link'].'" target="'.$card_profile[$card_profile_counter]['target'].'">Ver más</a>';
              }
              
          $shortcode_html .= '</div>
          </div>
        </div>
      </div>';

      $card_profile_counter++;

      return $shortcode_html;
    }

    for ($i=0; $i<count($card_profile_module); $i++){
      add_shortcode('ficha_de_perfil-'.($i+1), 'shortcode_card_profile');
    }

  }

  // -------------------------------
  // Lista numerada
  // Shortcode ['lista_numerada-'.$i]
  // -------------------------------
  $enumerated_list = get_field('lista_numerada', get_the_ID());
  if (!empty($enumerated_list)){

    $enumerated_list_counter = 0;
    
    function shortcode_lista($atts){
      extract(shortcode_atts(array(
        'list_number' => get_field('lista_numerada', get_the_ID())
      ), $atts));

      global $enumerated_list_counter;

      if ($list_number[$enumerated_list_counter]['estilo_lista']=='estilo-uno') {
        $class = 'lista-numerada estilo-1';
      } else {
        $class = 'lista-numerada estilo-2';
      }

      $shortcode_html = '';
      $shortcode_html .= '<div class="my-5"><ol class="'. $class .'">';
        $text_list = $list_number[$enumerated_list_counter]['contenido_lista'];
        foreach ($text_list as $text){
          $shortcode_html .= '<li>' . $text['texto_lista'] . '</li>';
        }
      $shortcode_html .= '</ol></div>';

      $enumerated_list_counter++;

      return $shortcode_html;

    }

    for ($i=0; $i<count($enumerated_list); $i++){
      add_shortcode('lista_numerada-'.($i+1), 'shortcode_lista');
    }

  }

  // -------------------------------
  // Bloque de metricas destacadas
  // Shortcode ['bloque_metricas_destacadas-'.$i]
  // -------------------------------
  $important_metrics = get_field('important_metrics_module', get_the_ID());
  if (!empty($important_metrics)){

    $metrics_counter = 0;

    function shortcode_important_metrics($atts){
      extract(shortcode_atts(array(
        'metrics' => get_field('important_metrics_module', get_the_ID())
      ), $atts));

      global $metrics_counter;

      $shortcode_html = '';
      $shortcode_html .= '
        <div class="mt-5 metrica-destacada">';
          if(!empty($metrics[$metrics_counter]['important_metrics_title'])){
              $shortcode_html .= '<h4 class="encabezado-titulo flecha mb-4">'.$metrics[$metrics_counter]['important_metrics_title'].'</h4>';
          }
  
          $shortcode_html .= '<div class="row align-items-stretch">';
          $metrics_content = $metrics[$metrics_counter]['important_metrics_content_module'];
          switch ($metrics[$metrics_counter]['important_metrics_style']){
            case 'estilo-uno':
              foreach ($metrics_content as $content) {
                $shortcode_html .= '
                <div class="col-md-6 d-flex">
                  <div class="estilo-1 align-items-stretch">
                    <h4 class="numero">'.$content['important_metrics_content_number'].'</h4>';
                    if(!empty($content['important_metrics_content_subtitle'])){
                        $shortcode_html .= '<h5 class="subtitulo">'.$content['important_metrics_content_subtitle'].'</h5>';
                    }
                   $shortcode_html .= ' <p class="descripcion">'.$content['important_metrics_content_description'].'</p>
                  </div>
                </div>';
              }
            break;
            case 'estilo-dos':
              foreach ($metrics_content as $content){
                $shortcode_html .='
                <div class="col-md-6">
                  <div class="estilo-2">
                    <h4 class="numero">'.$content['important_metrics_content_number'].'</h4>
                    <h5 class="subtitulo">'.$content['important_metrics_content_subtitle'].'</h5>
                    <p class="descripcion">'.$content['important_metrics_content_description'].'</p>
                  </div>
                </div>';
              }
            break;
          }
      $shortcode_html .= '</div></div>';

      $metrics_counter++;

      return $shortcode_html;

    }

    for ($i=0; $i<count($important_metrics); $i++){
      add_shortcode('bloque_metricas_destacadas-'.($i+1), 'shortcode_important_metrics');
    }

  }

  // -------------------------------
  // Métrica destacada
  // Shortcode ['metrica_destacada-'.$i]
  // -------------------------------
  $metrica_destacada = get_field('metrica_destacada', get_the_ID());
  if (!empty($metrica_destacada)){
    $counter = 0;

    function shortcode_metrica_destacada($atts){
      extract(shortcode_atts(array(
        'metrica_destacada' => get_field('metrica_destacada', get_the_ID())
      ), $atts));

      global $counter;
      
      // $position = (float:left) o (float:right)
      $position = $metrica_destacada[$counter]['metrica_destacada_style'];
      $text = $metrica_destacada[$counter]['metrica_destacada'];

      $shortcode_html = '';
      if ($position == 'left') {
        $shortcode_html .= '
        <p>izquierda</p>';
      } elseif ($position == 'right') {
        $shortcode_html .= '
        <p>derecha</p>';
      } else {
        $shortcode_html .= '
        <p>centro</p>';
      }

      $counter++;
    
      return $shortcode_html;
    }

    for ($i=0; $i<count($metrica_destacada); $i++){
      add_shortcode('metrica_destacada-'.($i+1), 'shortcode_important_text');
    }

  }

  // -------------------------------
  // Cita textual
  // Shortcode ['cita-'.$i]
  // -------------------------------
  $testimonials = get_field('testimonials', get_the_ID());
  if (!empty($testimonials)){

    $testimonials_counter = 0;

    function shortcode_testimonials($atts){
      extract(shortcode_atts(array(
        'testimonials' => get_field('testimonials', get_the_ID())
      ), $atts));

      global $testimonials_counter;

      $shortcode_html = '';
      $shortcode_html .= '
        <div class="cita my-5">
          <div class="row no-gutters">
            <div class="col-12 col-sm-auto">
              <div class="comillas"></div>
            </div>
            <div class="col col-sm pl-sm-3">
              <p class="texto-cita mb-2">'.$testimonials[$testimonials_counter]['testimonial_text'].'”</p>
              <footer>
                <p class="autor-cita mb-0">'.$testimonials[$testimonials_counter]['testimonial_person_name'].'</p>
                <cite>'.$testimonials[$testimonials_counter]['testimonial_person_title'].'</cite>
              </footer>
            </div>
          </div>
        </div>';

      $testimonials_counter++;

      return $shortcode_html;

    }

    for ($i=0; $i<count($testimonials); $i++){
      add_shortcode('cita-'.($i+1), 'shortcode_testimonials');
    }

  }