<?php

add_action( 'rest_api_init', function () {
    
    register_rest_route( 'api', '/menu', array(
        'methods' => 'GET',
        'callback' => 'addMenu',
    ));


    function addMenu() {

        $terms = get_terms( array(
            'include' => get_option('menu'),
            'taxonomy' => 'category',
            'hide_empty' => false,
        ));
    
        if (empty($terms)) {
            return new WP_Error( 'empty_notas_categoria_blockone', 'no hay publicaciones', array('status' => 404) );
        }
    
        $response = new WP_REST_Response($terms);
        $response->set_status(200);
    
        return $response;
    }


});