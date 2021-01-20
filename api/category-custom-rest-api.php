<?php 

add_action( 'rest_api_init', 'add_custom_fields_category' );
function add_custom_fields_category() {
    

    register_rest_field(
        'category', 
        'datos',
        array(
            'get_callback'    => 'get_custom_fields_category', // custom function name 
            'update_callback' => null,
            'schema'          => null,
        )
    );

    function get_custom_fields_category($object){

        header("Access-Control-Allow-Origin: *");

        $color = get_term_meta( $object['id'], 'category_color', true );


        $datos = array(
            'color' => $color, 
        );

        return $datos;
    }

}