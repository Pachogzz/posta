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
    
        $response = new WP_REST_Response($posts);
        $response->set_status(200);
    
        return $response;
    }


});