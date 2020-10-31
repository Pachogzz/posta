<?php

function get_color_taxonomy($taxonomy_object){

  // Estilo de taxonomia para "Temas"
  if ($taxonomy_object->taxonomy == "theme"){

    $category_name = $taxonomy_object->name.'<i class="fas fa-circle punto texto-amarillo"></i>';

  // Estilo de taxonomia para "Hashtags"
  }else if ($taxonomy_object->taxonomy == "post_tag"){

    $category_name = '<span class="texto-amarillo">#</span>'.$taxonomy_object->name;

  // Estilo de taxonomia para "Secciones"
  }else{

    // Campos personalizados de seccion
    $yellow_category_text  = get_field('yellow_category_text', $taxonomy_object);
    $white_category_text   = get_field('white_category_text', $taxonomy_object);
    $text_priority         = get_field('text_priority', $taxonomy_object);
    $show_final_dot        = get_field('show_final_dot', $taxonomy_object);
    $has_custom_colors = get_field('show_or_not_category_name', $taxonomy_object);

    if( $has_custom_colors && $has_custom_colors!='default' ) { // Muestra la categoria con la combinacion de colores

      if($show_final_dot && $show_final_dot!='no'){ // Muestra el punto de color
    
        if ($show_final_dot=='yellowd') {  // Punto de color amarillo
    
          if ($text_priority && $text_priority=='yellow') {
            $category_name = '<span class="texto-amarillo">'.$yellow_category_text.'</span>'.$white_category_text.'<i class="fas fa-circle texto-amarillo punto"></i>';
          } elseif ($text_priority && $text_priority=='white'){
            $category_name = $white_category_text.'<span class="texto-amarillo">'.$yellow_category_text.'</span>'.'<i class="fas fa-circle texto-amarillo punto"></i>';
          }
    
        } elseif($show_final_dot=='whited') { // Punto de color blanco
    
          if ($text_priority && $text_priority=='yellow') {
            $category_name = '<span class="texto-amarillo">'.$yellow_category_text.'</span>'.$white_category_text.'<i class="fas fa-circle texto-blanco"></i>';
          } elseif ($text_priority && $text_priority=='white'){
            $category_name = $white_category_text.'<span class="texto-amarillo">'.$yellow_category_text.'</span>'.'<i class="fas fa-circle texto-blanco punto"></i>';
          }
    
        }
    
      } else { // No muestra el punto de color
        
        if ($text_priority && $text_priority=='yellow') {
          $category_name = '<span class="texto-amarillo">'.$yellow_category_text.'</span>'.$white_category_text;
        } elseif ($text_priority && $text_priority=='white'){
          $category_name = $white_category_text.'<span class="texto-amarillo">'.$yellow_category_text.'</span>';
        }
    
      }
      
    } else { // Muestra la categoria sin la combinacion de colores
    
      if($show_final_dot && $show_final_dot!='no'){
        if ($show_final_dot=='yellowd') {
          $category_name = $taxonomy_object->name.'<i class="fas fa-circle texto-amarillo"></i>';
        } elseif($show_final_dot=='whited') {
          $category_name = $taxonomy_object->name.'<i class="fas fa-circle texto-blanco"></i>';
        }
      }
    
    }

  }

  // echo "<span class='toto2'>";
  return $category_name;
  // echo "</span>";
  
}