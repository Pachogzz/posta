<?php 
/*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => __( 'Autores', 'Post Type General Name', 'postamx' ),
        'singular_name'       => __( 'Autor', 'Post Type Singular Name', 'postamx' ),
        'menu_name'           => __( 'Autores', 'postamx' ),
        'parent_item_colon'   => __( 'Autor padre', 'postamx' ),
        'all_items'           => __( 'Todos los Autores', 'postamx' ),
        'view_item'           => __( 'Ver Autor', 'postamx' ),
        'add_new_item'        => __( 'Agregar nuevo Autor', 'postamx' ),
        'add_new'             => __( 'Agregar nuevo', 'postamx' ),
        'edit_item'           => __( 'Editar Autor', 'postamx' ),
        'update_item'         => __( 'Actualizar Autor', 'postamx' ),
        'search_items'        => __( 'Buscar Autor', 'postamx' ),
        'not_found'           => __( 'No encontrado', 'postamx' ),
        'not_found_in_trash'  => __( 'No encontrado en la papelera', 'postamx' ),
    );
// Set other options for Custom Post Type 
    $args = array(
        'label'               => __( 'autores', 'postamx' ),
        'description'         => __( 'Autores para las notas y contenidos existentes', 'postamx' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'autores' ),
        // A hierarchical CPT is like Pages and can have parent and child items. A non-hierarchical CPT is like Posts.
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );    
// Registering your Custom Post Type
    register_post_type( 'autores', $args ); 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
add_action( 'init', 'custom_post_type', 0 );