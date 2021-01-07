<?php 

add_action( 'rest_api_init', 'add_custom_fields' );
function add_custom_fields() {

    date_default_timezone_set('America/Monterrey');

    

	register_rest_field(
		'post', 
		'datos', //New Field Name in JSON RESPONSEs
		array(
    		'get_callback'    => 'get_custom_fields', // custom function name 
    		'update_callback' => null,
    		'schema'          => null,
     	)
	);

	function get_custom_fields($object){

		$imagen = wp_get_attachment_image_src( get_post_thumbnail_id( $object['id'] ), 'full' )[0];

        if($imagen){
            $imagen = $imagen;
        }else{
            $imagen = get_site_url() . '/wp-content/themes/posta/assets/img/sin-imagen.png'; 
        }

		$datos = array(
			'imagen' => $imagen, 
			'fecha' => fecha($object['date']),
			'title' => $object['title']['raw']
		);

		return $datos;
	}

}