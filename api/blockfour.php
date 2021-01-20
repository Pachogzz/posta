<?php

header("Access-Control-Allow-Origin: *");

add_action( 'rest_api_init', function () {
    
    register_rest_route( 'api', '/blockfour', array(
        'methods' => 'GET',
        'callback' => 'blockFour',
    ));


    function blockFour() {

        $args = array(
            'category'   => get_option('b4_categoria'),
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'numberposts'    => 4,
            'order'          => 'DESC',
            'orderby'        => 'post_date'
        );
    
        $posts = get_posts($args);
    
        if (empty($posts)) {
            return new WP_Error( 'empty_notas_categoria_blockfour', 'no hay publicaciones', array('status' => 404) );
        }

        $dataPosts = array();
        $i = 0;


        $term = get_term( get_option('b4_categoria'), 'category' );
        $color = get_term_meta( $term->term_id, 'category_color', true );

        $category = array(
            'id' => $term->term_id,
            'nombre' => $term->name,
            'color' => $color,
        );


        foreach ($posts as $post) {

            $imagen = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0];

            $video = get_post_meta($post->ID, 'video_youtube', true);
            $imagenVideo = wp_get_attachment_image_src(get_post_meta($post->ID, 'url_imagen_video', true), 'full')[0];
            $audio = get_post_meta($post->ID, 'audio_news', true);

            if($imagen){
                $imagen = $imagen;
            }else{
                $imagen = get_site_url() . '/wp-content/themes/posta/assets/img/sin-imagen.png'; 
            }

            $dataPosts[$i]['id'] = $post->ID;
            $dataPosts[$i]['titulo'] = $post->post_title;
            $dataPosts[$i]['imagen'] = $imagen;
            $dataPosts[$i]['fecha'] = timeDate($post->post_date);
            $dataPosts[$i]['url'] = get_permalink($post->ID);
            $dataPosts[$i]['video'] = $video;
            $dataPosts[$i]['imagenVideo'] = $imagenVideo;
            $dataPosts[$i]['audio'] = $audio;


            $i++;
        }

        $data = array(
            'category' => $category,
            'posts' => $dataPosts,
        );

    
        $response = new WP_REST_Response($data);
        $response->set_status(200);
    
        return $response;
    }


});