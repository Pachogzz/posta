<?php  
/*
* Creating Custom Post Types needed and their taxonomies or terms
* 
*/

add_action( 'init', 'custom_post_type', 0 ); 
function custom_post_type() {
    $labelsp = array(
        'name'                => __( 'Perspectivas', 'Post Type General Name', 'postamx' ),
        'singular_name'       => __( 'Perspectiva', 'Post Type Singular Name', 'postamx' ),
        'menu_name'           => __( 'Perspectivas', 'postamx' ),
        'parent_item_colon'   => __( 'Perspectiva padre', 'postamx' ),
        'all_items'           => __( 'Todos los Perspectivas', 'postamx' ),
        'view_item'           => __( 'Ver Perspectiva', 'postamx' ),
        'add_new_item'        => __( 'Agregar nuevo Perspectiva', 'postamx' ),
        'add_new'             => __( 'Agregar nuevo', 'postamx' ),
        'edit_item'           => __( 'Editar Perspectiva', 'postamx' ),
        'update_item'         => __( 'Actualizar Perspectiva', 'postamx' ),
        'search_items'        => __( 'Buscar Perspectiva', 'postamx' ),
        'not_found'           => __( 'No encontrado', 'postamx' ),
        'not_found_in_trash'  => __( 'No encontrado en la papelera', 'postamx' ),
    );
    $argsp = array(
        'label'               => __( 'perspectivas', 'postamx' ),
        'description'         => __( '', 'postamx' ),
        'labels'              => $labelsp,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'columna', 'post_tag', 'fuente' ),
        'rewrite'             => array( 'slug' => 'perspectivas', 'with_front' => true ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-visibility',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'query_var'           => true,
    );    
    register_post_type( 'perspectivas', $argsp );
    flush_rewrite_rules();
}
 
add_action( 'init', 'taxonomy_columna', 0 );
function taxonomy_columna() {
    $labels = array(
        'name'              => __( 'Columnas', 'Taxonomy general name' ),
        'singular_name'     => __( 'Columna', 'Taxonomy singular name' ),
        'search_items'      => __( 'Buscar Columnas' ),
        'all_items'         => __( 'Todas las Columnas' ),
        'parent_item'       => __( 'Columna padre' ),
        'parent_item_colon' => __( 'Columna padre:' ),
        'edit_item'         => __( 'Editar Columna' ), 
        'update_item'       => __( 'Actualizar Columna' ),
        'add_new_item'      => __( 'Agregar Columna' ),
        'new_item_name'     => __( 'Nuevo nombre de Columna' ),
        'menu_name'         => __( 'Columnas' ),
    );    
    register_taxonomy(
        'columna',
        array('perspectivas'), 
            array(
                'hierarchical'        => true,
                'labels'              => $labels,
                'show_ui'             => true,
                'show_in_rest'        => true,
                'show_admin_column'   => true,
                'query_var'           => true,
                'rewrite'             => array( 'slug' => 'columna', 'with_front' => true ),
    ));
    flush_rewrite_rules();
}
