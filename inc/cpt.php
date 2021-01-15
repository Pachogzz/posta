<?php  
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
// add_action( 'init', 'taxonomy_columna', 0 );
// function taxonomy_columna() {
//     $labels = array(
//         'name'              => __( 'Columnas', 'Taxonomy general name' ),
//         'singular_name'     => __( 'Columna', 'Taxonomy singular name' ),
//         'search_items'      => __( 'Buscar Columnas' ),
//         'all_items'         => __( 'Todas las Columnas' ),
//         'parent_item'       => __( 'Columna padre' ),
//         'parent_item_colon' => __( 'Columna padre:' ),
//         'edit_item'         => __( 'Editar Columna' ), 
//         'update_item'       => __( 'Actualizar Columna' ),
//         'add_new_item'      => __( 'Agregar Columna' ),
//         'new_item_name'     => __( 'Nuevo nombre de Columna' ),
//         'menu_name'         => __( 'Columnas' ),
//     );    
//     register_taxonomy(
//         'columna',
//         array('perspectiva'), 
//             array(
//                 'hierarchical'        => false,
//                 'labels'              => $labels,
//                 'show_ui'             => true,
//                 'show_in_rest'        => true,
//                 'show_admin_column'   => true,
//                 'query_var'           => true,
//                 'rewrite'             => array( 'slug' => 'columna', 'with_front' => true ),
//     ));
//     flush_rewrite_rules();
// }

add_action( 'init', 'taxonomy_columnista', 1 );
function taxonomy_columnista() {
    $labels = array(
        'name'              => __( 'Autores', 'Taxonomy general name' ),
        'singular_name'     => __( 'Autor', 'Taxonomy singular name' ),
        'search_items'      => __( 'Buscar Autores' ),
        'all_items'         => __( 'Todas las Autores' ),
        'parent_item'       => __( 'Autor padre' ),
        'parent_item_colon' => __( 'Autor padre:' ),
        'edit_item'         => __( 'Editar Autor' ), 
        'update_item'       => __( 'Actualizar Autor' ),
        'add_new_item'      => __( 'Agregar Autor' ),
        'new_item_name'     => __( 'Nuevo nombre de Autor' ),
        'menu_name'         => __( 'Autores' ),
    );    
    register_taxonomy( 'columnista', array('perspectiva'), 
            array(
                'hierarchical'        => true,
                'labels'              => $labels,
                'show_ui'             => true,
                'show_in_rest'        => true,
                'show_admin_column'   => true,
                'query_var'           => true,
                'rewrite'             => array( 'slug' => 'columnista', 'with_front' => true ),
    ));
    flush_rewrite_rules();
}

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
        'label'               => __( 'perspectiva', 'postamx' ),
        'description'         => __( '', 'postamx' ),
        'labels'              => $labelsp,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'columna', 'columnistas' ),
        'rewrite'             => array( 'slug' => 'perspectiva', 'with_front' => true ),
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
    register_post_type( 'perspectiva', $argsp );
    flush_rewrite_rules();

    // $labelsf = array(
    //     'name'                => __( 'Fuentes', 'Post Type General Name', 'postamx' ),
    //     'singular_name'       => __( 'Fuente', 'Post Type Singular Name', 'postamx' ),
    //     'menu_name'           => __( 'Fuentes', 'postamx' ),
    //     'parent_item_colon'   => __( 'Fuente padre', 'postamx' ),
    //     'all_items'           => __( 'Todos los Fuentes', 'postamx' ),
    //     'view_item'           => __( 'Ver Fuente', 'postamx' ),
    //     'add_new_item'        => __( 'Agregar nuevo Fuente', 'postamx' ),
    //     'add_new'             => __( 'Agregar nuevo', 'postamx' ),
    //     'edit_item'           => __( 'Editar Fuente', 'postamx' ),
    //     'update_item'         => __( 'Actualizar Fuente', 'postamx' ),
    //     'search_items'        => __( 'Buscar Fuente', 'postamx' ),
    //     'not_found'           => __( 'No encontrado', 'postamx' ),
    //     'not_found_in_trash'  => __( 'No encontrado en la papelera', 'postamx' ),
    // );
    // $argsf = array(
    //     'label'               => __( 'fuente', 'postamx' ),
    //     'description'         => __( '', 'postamx' ),
    //     'labels'              => $labelsf,
    //     'supports'            => array( 'title', 'custom-fields', ),
    //     'hierarchical'        => false,
    //     'public'              => true,
    //     'show_ui'             => true,
    //     'show_in_menu'        => true,
    //     'show_in_nav_menus'   => true,
    //     'show_in_admin_bar'   => true,
    //     'menu_position'       => 5,
    //     'menu_icon'           => 'dashicons-format-chat',
    //     'can_export'          => true,
    //     'has_archive'         => true,
    //     'exclude_from_search' => false,
    //     'publicly_queryable'  => true,
    //     'capability_type'     => 'post',
    //     'show_in_rest'        => true,
    //     'query_var'           => true,
    // );    
    // register_post_type( 'fuente', $argsf );
    // flush_rewrite_rules();
}

// add_filter('post_type_link', 'projectcategory_permalink_structure', 10, 4);
// function projectcategory_permalink_structure($post_link, $post, $leavename, $sample) {
//     if (false !== strpos($post_link, '%columnista%')) {
//         $columnista_type_term = get_the_terms($post->ID, 'columnista');
//         if (!empty($columnista_type_term))
//             $post_link = str_replace('%columnista%', array_pop($columnista_type_term)->slug, $post_link);
//         else
//             $post_link = str_replace('%columnista%', 'uncategorized', $post_link);
//     }
//     return $post_link;
// }