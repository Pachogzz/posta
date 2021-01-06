<?php
add_action( 'rest_api_init', function () {
    
    register_rest_route( 'api', '/blocktwo', array(
        'methods' => 'GET',
        'callback' => 'blockTwo',
    ));


    function blockTwo() {

        $args = array(
            'category'   => get_option('b2_categoria'),
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'numberposts'    => 4,
            'order'          => 'DESC',
            'orderby'        => 'post_date'
        );
    
        $posts = get_posts($args);
    
        if (empty($posts)) {
            return new WP_Error( 'empty_notas_categoria_blocktwo', 'no hay publicaciones', array('status' => 404) );
        }

        $data = array();
        $i = 0;

        foreach ($posts as $post) {

            $categoria = get_the_terms($post->ID, 'category')[0];
            $color = get_term_meta( $categoria->term_id, 'category_color', true );
            $imagen = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0];

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
            $data[$i]['fecha'] = date("d-m-Y", strtotime($post->post_date));

            $i++;
        }

    
        $response = new WP_REST_Response($data);
        $response->set_status(200);
    
        return $response;
    }


});