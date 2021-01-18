<?php
add_action( 'rest_api_init', function () {
    
    register_rest_route( 'api', '/slider', array(
        'methods' => 'GET',
        'callback' => 'notas_slider',
    ));


    function notas_slider() {

        $args = array(
            'include'   => get_option('slider_nota'),
            'post_type'      => 'post',
            'post_status'    => 'publish',
        );
    
        $posts = get_posts($args);
    
        if (empty($posts)) {
            return new WP_Error( 'empty_notas_slider', 'no hay publicaciones', array('status' => 404) );
        }

        $data = array();
        $i = 0;

        foreach ($posts as $post) {

            $categoria = get_the_terms($post->ID, 'category')[0];
            $color = get_term_meta( $categoria->term_id, 'category_color', true );
            $imagen = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0];

            $video = get_post_meta($post->ID, 'video_youtube', true);
            $imagenVideo = wp_get_attachment_image_src(get_post_meta($post->ID, 'url_imagen_video', true), 'full')[0];

            if($imagen){
                $imagen = $imagen;
            }else{
                $imagen = get_site_url() . '/wp-content/themes/posta/assets/img/sin-imagen.png'; 
            }

            $data[$i]['id'] = $post->ID;
            $data[$i]['titulo'] = $post->post_title;
            $data[$i]['categoria'] = $categoria->name;
            $data[$i]['categoria_id'] = $categoria->term_id;
            $data[$i]['color'] = $color;
            $data[$i]['imagen'] = $imagen;
            $data[$i]['fecha'] = timeDate($post->post_date);
            $data[$i]['url'] = get_permalink($post->ID);
            $data[$i]['video'] = $video;
            $data[$i]['imagenVideo'] = $imagenVideo;

            $i++;
        }

    
        $response = new WP_REST_Response($data);
        $response->set_status(200);
    
        return $response;
    }


});