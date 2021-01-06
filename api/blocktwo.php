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

        $dataPosts = array();
        $i = 0;


        $term = get_term( get_option('b2_categoria'), 'category' );
        $color = get_term_meta( $term->id, 'category_color', true );

        $category = array(
            'nombre' => $term->name,
            'color' => $color,
        );


        foreach ($posts as $post) {

            $categoria = get_the_terms($post->ID, 'category')[0];
            $imagen = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0];

            if($imagen){
                $imagen = $imagen;
            }else{
                $imagen = get_site_url() . '/wp-content/themes/posta/assets/img/sin-imagen.png'; 
            }

            $dataPosts[$i]['id'] = $post->ID;
            $dataPosts[$i]['titulo'] = $post->post_title;
            $dataPosts[$i]['categoria'] = $categoria->name;
            $dataPosts[$i]['categoria_id'] = $categoria->term_id;
            $dataPosts[$i]['imagen'] = $imagen;
            $dataPosts[$i]['fecha'] = date("d-m-Y", strtotime($post->post_date));
            $dataPosts[$i]['color'] = NULL;

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