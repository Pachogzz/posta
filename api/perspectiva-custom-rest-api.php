<?php 

add_action( 'rest_api_init', 'add_custom_fields_perspectiva' );
function add_custom_fields_perspectiva() {

    date_default_timezone_set('America/Monterrey');

    

    register_rest_field(
        'perspectivas', 
        'datos', //New Field Name in JSON RESPONSEs
        array(
            'get_callback'    => 'get_custom_fields_perspectiva', // custom function name 
            'update_callback' => null,
            'schema'          => null,
        )
    );

    function get_custom_fields_perspectiva($object){

        $imagen = wp_get_attachment_image_src( get_post_thumbnail_id( $object['id'] ), 'full' )[0];
        
        $term = get_term( $object['columna'][0], 'columna' );
        $color = get_term_meta( $term->term_id, 'category_color', true );

        if($imagen){
            $imagen = $imagen;
        }else{
            $imagen = get_site_url() . '/wp-content/themes/posta/assets/img/sin-imagen.png'; 
        }

        $video = get_post_meta($object['id'], 'video_youtube', true);
        $imagenVideo = wp_get_attachment_image_src(get_post_meta($object['id'], 'url_imagen_video', true), 'full')[0];
        $audio = get_post_meta($object['id'], 'audio_news', true);

        $fuente = get_field('fuente', $object['id']);
        $foto = wp_get_attachment_image_src(get_term_meta($fuente->term_id, 'imagen_de_perfil', true), 'full' )[0];

        if ($foto) {
            $foto = $foto;
        } else {
            $foto = get_site_url() . '/wp-content/themes/posta/assets/img/foto-sin-usuario.jpg';
        }


        $datos = array(
            'imagen' => $imagen, 
            'fecha' => fechaCorta($object['date']),
            'fechaLarga' => fecha($object['date']),
            'title' => $object['title']['raw'],
            'categoria' => $term->name,
            'color' => $color,
            'video' => $video,
            'imagenVideo' => $imagenVideo,
            'audio' => $audio,
            'autor' => array(
                'nombre' => $fuente->name,
                'foto' => $foto,
            ),
        );

        return $datos;
    }

}