<?php 
/*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
// Set UI labels for Custom Post Type
    $labels = array(
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
    // Set other options for Custom Post Type 
    $args = array(
        'label'               => __( 'perspectivas', 'postamx' ),
        'description'         => __( '', 'postamx' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'columna' ),
        // A hierarchical CPT is like Pages and can have parent and child items. A non-hierarchical CPT is like Posts.
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
        'show_in_rest' => true,
    );    
// Registering your Custom Post Type
    register_post_type( 'perspectivas', $args ); 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
add_action( 'init', 'custom_post_type', 0 );
 
function taxonomy_columna() {
    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI
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
    // Now register the taxonomy
    register_taxonomy(
        'columna',
        array('perspectivas'), 
            array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'show_in_rest' => true,
                'show_admin_column' => true,
                'query_var' => true,
                'rewrite' => array( 
                    'slug' => 'columna' 
                ),
    ));
}
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'taxonomy_columna', 0 );

function taxonomy_columnista() {
    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI
    $labels = array(
        'name'              => __( 'Columnistas', 'Taxonomy general name' ),
        'singular_name'     => __( 'Columnista', 'Taxonomy singular name' ),
        'search_items'      => __( 'Buscar Columnistas' ),
        'all_items'         => __( 'Todas las Columnistas' ),
        'parent_item'       => __( 'Columnista padre' ),
        'parent_item_colon' => __( 'Columnista padre:' ),
        'edit_item'         => __( 'Editar Columnista' ), 
        'update_item'       => __( 'Actualizar Columnista' ),
        'add_new_item'      => __( 'Agregar Columnista' ),
        'new_item_name'     => __( 'Nuevo nombre de Columnista' ),
        'menu_name'         => __( 'Columnistas' ),
    );    
    // Now register the taxonomy
    register_taxonomy(
        'columnista',
        array('perspectivas'), 
            array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'show_in_rest' => true,
                'show_admin_column' => true,
                'query_var' => true,
                'rewrite' => array( 
                    'slug' => 'columnista' 
                ),
    ));
}
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'taxonomy_columnista', 1 );