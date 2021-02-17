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

/**
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_action('restrict_manage_posts', 'postamx_filter_post_type_by_taxonomy_1');
function postamx_filter_post_type_by_taxonomy_1() {
    global $typenow;
    $post_type = 'perspectivas'; // change to your post type
    $taxonomy  = 'columna'; // change to your taxonomy
    if ($typenow == $post_type) {
        $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => sprintf( __( 'Mostrar todas las %s', 'postamx' ), $info_taxonomy->label ),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'orderby'         => 'name',
            'selected'        => $selected,
            'show_count'      => true,
            'hide_empty'      => true,
        ));
    };
}
/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_filter('parse_query', 'postamx_convert_id_to_term_in_query_1');
function postamx_convert_id_to_term_in_query_1($query) {
    global $pagenow;
    $post_type = 'perspectivas'; // change to your post type
    $taxonomy  = 'columna'; // change to your taxonomy
    $q_vars    = &$query->query_vars;
    if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
}

add_action('restrict_manage_posts', 'postamx_filter_post_type_by_taxonomy_2');
function postamx_filter_post_type_by_taxonomy_2() {
    global $typenow;
    $post_type = 'perspectivas'; // change to your post type
    $taxonomy  = 'fuente'; // change to your taxonomy
    if ($typenow == $post_type) {
        $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => sprintf( __( 'Mostrar todas las %s', 'postamx' ), $info_taxonomy->label ),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'orderby'         => 'name',
            'selected'        => $selected,
            'show_count'      => true,
            'hide_empty'      => true,
        ));
    };
}

add_filter('parse_query', 'postamx_convert_id_to_term_in_query_2');
function postamx_convert_id_to_term_in_query_2($query) {
    global $pagenow;
    $post_type = 'perspectivas'; // change to your post type
    $taxonomy  = 'fuente'; // change to your taxonomy
    $q_vars    = &$query->query_vars;
    if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
}

add_action('restrict_manage_posts', 'postamx_filter_post_type_by_taxonomy_3');
function postamx_filter_post_type_by_taxonomy_3() {
    global $typenow;
    $post_type = 'perspectivas'; // change to your post type
    $taxonomy  = 'post_tag'; // change to your taxonomy
    if ($typenow == $post_type) {
        $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => sprintf( __( 'Mostrar todas las %s', 'postamx' ), $info_taxonomy->label ),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'orderby'         => 'name',
            'selected'        => $selected,
            'show_count'      => true,
            'hide_empty'      => true,
        ));
    };
}

add_filter('parse_query', 'postamx_convert_id_to_term_in_query_3');
function postamx_convert_id_to_term_in_query_3($query) {
    global $pagenow;
    $post_type = 'perspectivas'; // change to your post type
    $taxonomy  = 'post_tag'; // change to your taxonomy
    $q_vars    = &$query->query_vars;
    if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
}