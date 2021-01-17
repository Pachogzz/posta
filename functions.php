<?php
/**
 * postamx functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package postamx
 */

/****************************************************************
*																*
*                         INITIAL SETUP                         *
*																*
****************************************************************/

if ( ! function_exists( 'posta_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function posta_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Enable support for responsive embeds
		 *
		 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#responsive-embedded-content
		 */
		add_theme_support( 'responsive-embeds' );

		// This theme uses wp_nav_menu() in 3 locations.
		register_nav_menus( array(
      'menu-principal' => esc_html__( 'Menú principal', 'postamx' ),
      'menu-2' => esc_html__( 'Menú 2', 'postamx' ),
      'menu-pie-de-pagina' => esc_html__( 'Menú pie de página', 'postamx' )
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		/*add_theme_support(
			'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);*/

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'posta_setup' );


/****************************************************************
*																*
*                         WP IMAGE SIZES                        *
*																*
****************************************************************/

/**
 * Disable default generated image sizes
 */
add_image_size( '360x202', 360, 202, true, array( 'center', 'center' ) ); //small
add_image_size( '720x405', 720, 405, true, array( 'center', 'center' ) ); //small_retina

add_image_size( '550x309', 550, 309, true, array( 'center', 'center' ) ); //medium
add_image_size( '1100x618', 1100, 618, true, array( 'center', 'center' ) ); //medium_retina

add_image_size( '1920x1080', 1920, 1080, true, array( 'center', 'center' ) ); //large
add_image_size( '3840x2160', 3840, 2160, true, array( 'center', 'center' ) ); //large_retina

// add_image_size( 'full', 1920, 0 );

/**
 * big_image_size_threshold
 */
add_filter( 'big_image_size_threshold', '__return_false' );

// function posta_big_image_size_threshold( $threshold ) {
//   return 1920; // new threshold
// }
// add_filter('big_image_size_threshold', 'posta_big_image_size_threshold', 999, 1);

/**
 * Remove max srcset image width
 */
add_filter( 'max_srcset_image_width', 'remove_max_srcset_image_width' );

function remove_max_srcset_image_width( $max_width ) {
  return false;
}

/**
 * Disable some default generated image sizes
 */
function remove_default_image_sizes( $sizes ) {
  
  /* Default WordPress */
  unset( $sizes[ 'medium_large' ]);
  unset( $sizes[ 'medium' ]);
  unset( $sizes[ 'large' ]);
  unset( $sizes[ '1536x1536' ]);
  unset( $sizes[ '2048x2048' ]);
  
  return $sizes;
}

add_filter( 'intermediate_image_sizes_advanced', 'remove_default_image_sizes' );


/****************************************************************
*																*
*                           NAVWALKER                           *
*																*
****************************************************************/

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/template-parts/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

/****************************************************************
*                               *
*                           NEW MENUS                           *
*                               *
****************************************************************/

/**
 * Register Custom Navigation Areas
 */
function register_new_menus() {
  register_nav_menus(
    array(
      'menu-vertical-oculto' => esc_html__( 'Menu Vertical Oculto', 'postamx' ),
     )
   );
  }
add_action( 'init', 'register_new_menus' );

/**
 * Wrap for extended menu
 */
function my_nav_wrap() {
	$wrap  = '<ul id="%1$s" class="%2$s">';
	$wrap .= '%3$s';
	$wrap .= '<li class="nav-item dropdown d-none">';
	$wrap .= '<a href="#" class="nav-link link-more-menu d-flex align-items-center h-100" id="navbarDropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
	$wrap .= '<i class="fas fa-plus"></i>';
	$wrap .= '</a>';
	$wrap .= '<ul class="dropdown-menu dropdown-menu-right bg-dark<<" aria-labelledby="navbarDropdownMenu"></ul>';
	$wrap .= '</li>';
	$wrap .= '</ul>';
return $wrap;
}

/****************************************************************
*																*
*                         CONTENT WIDTH                         *
*																*
****************************************************************/

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function posta_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'posta_content_width', 640 );
}
add_action( 'after_setup_theme', 'posta_content_width', 0 );


/****************************************************************
*																*
*                            WIDGETS                            *
*																*
****************************************************************/

function posta_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar 1', 'postamx' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Agrega tus widgets para Sidebar 1', 'postamx' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="hidden">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'posta_widgets_init' );

function unregister_default_wp_widgets(){
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Recent_Comments');
}
add_action('widgets_init', 'unregister_default_wp_widgets' );


/****************************************************************
*																*
*                            SCRIPTS                            *
*																*
****************************************************************/
      
function posta_scripts() {
	wp_enqueue_style( 'postamx-style', get_stylesheet_uri() );

	wp_enqueue_script( 'postamx-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'postamx-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'posta_scripts' );


/****************************************************************
*																*
*                          CUSTOM FILES                         *
*																*
****************************************************************/

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer-theme.php';

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/cpt.php';

/**
 * Custom Fields for Taxonomies
 */
require get_template_directory() . '/inc/tax_custom_fields.php';


/****************************************************************
*																*
*                           CUSTOMIZER                          *
*																*
****************************************************************/

require_once 'inc/customizer/customizer-theme.php';

// Hidden the options that will be not used in customizer section
function theme_option_remove( $wp_customize ) {
	$wp_customize->remove_section("colors");
	$wp_customize->remove_section("header_image");
	$wp_customize->remove_section("static_front_page");
	$wp_customize->remove_section("custom_css");
}

// Hidden the options that will be not used in customizer section
add_action( 'customize_register', 'theme_option_remove', 15 );


/****************************************************************
*																*
*                             MENUS                             *
*																*
****************************************************************/

// Remove items from admin bar
function remove_from_admin_bar($wp_admin_bar) {
  $wp_admin_bar->remove_node('comments');
}
add_action('admin_bar_menu', 'remove_from_admin_bar', 999);

// Function to remove default admin menu links
function remove_menus() { 
  remove_menu_page('edit-comments.php');
}
// Removing some default admin menu links
add_action( 'admin_menu', 'remove_menus' );


/****************************************************************
*																*
*                       COLUMNS IN ADMIN                        *
*																*
****************************************************************/

// Remove comments column in posts
function remove_comments_column_in_posts($column) {
  unset($column['comments']);
  return $column;
}
add_filter('manage_posts_columns', 'remove_comments_column_in_posts');

// Remove comments column in pages
function remove_comments_column_in_pages($column) {
  unset($column['comments']);
  return $column;
}
add_filter('manage_pages_columns', 'remove_comments_column_in_pages');


/****************************************************************
*																*
*                    SEARCH BY FILTERS IN ADMIN                 *
*																*
****************************************************************/

function remove_post_format_filter($post_type){

  // Apply this only on a specific post type
	if ( 'post' !== $post_type )
  return;

  // A list of taxonomy slugs to filter by
  $taxonomies = array( 'fuente', 'post_tag' );

  foreach ( $taxonomies as $taxonomy_slug ) {

    // Retrieve taxonomy data
    $taxonomy_obj = get_taxonomy( $taxonomy_slug );
    $taxonomy_name = $taxonomy_obj->labels->name;

    // Retrieve taxonomy terms
    $terms = get_terms( $taxonomy_slug );

    // Condition for default taxonomy of tags
    if ($taxonomy_slug == 'post_tag'){
      $taxonomy_slug = 'tag';
    }

    // Display filter HTML
    echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
    echo '<option value="">' . sprintf( esc_html__( 'Todos los %s', 'text_domain' ), $taxonomy_name ) . '</option>';
    foreach ( $terms as $term ) {
      printf(
        '<option value="%1$s" %2$s>%3$s</option>',
        $term->slug,
        ( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
        $term->name,
        $term->count
      );
    }
    echo '</select>';
  }

}
add_action( 'restrict_manage_posts', 'remove_post_format_filter', 10, 2);


/****************************************************************
*																*
*                          TAXONOMIES                           *
*																*
****************************************************************/

function rename_default_taxonomy() {
  global $wp_taxonomies;

  $labels = &$wp_taxonomies['category']->labels;
  $labels->name = 'Secciones';
  $labels->singular_name = 'Sección';
  $labels->add_new_item = 'Agregar sección';
  $labels->edit_item = 'Editar sección';
  $labels->view_item = 'Ver sección';
  $labels->search_items = 'Buscar secciones';
  $labels->not_found = 'No se encontró la sección';
  $labels->all_items = 'Todas las secciones';
  $labels->menu_name = 'Secciones';
  $labels->name_admin_bar = 'Secciones';
  $labels->back_to_items = '← Volver a las secciones';
  $labels->update_item = 'Actualizar sección';
  $labels->parent_item = 'Sección superior';

  $labels_tags = &$wp_taxonomies['post_tag']->labels;
  $labels_tags->name = 'Hashtags';
  $labels_tags->singular_name = 'Hashtag';
  $labels_tags->add_new_item = 'Agregar hashtag';
  $labels_tags->edit_item = 'Editar hashtag';
  $labels_tags->view_item = 'Ver hashtag';
  $labels_tags->search_items = 'Buscar hashtags';
  $labels_tags->not_found = 'No se encontró el hashtag';
  $labels_tags->all_items = 'Todas los hashtags';
  $labels_tags->menu_name = 'Hashtags';
  $labels_tags->name_admin_bar = 'Hashtags';
  $labels_tags->back_to_items = '← Volver a los hashtags';
  $labels_tags->update_item = 'Actualizar hashtag';
  $labels_tags->separate_items_with_commas = 'Separa cada hashtag con una coma';
  $labels_tags->choose_from_most_used = 'Elige entre los hashtags más utilizados';
}
add_action( 'init', 'rename_default_taxonomy' );

// Register taxonomy "Temas"
add_action( 'init', 'create_fuente_taxonomy' );
function create_fuente_taxonomy() {
  $labels = array(
    'name'                       => 'Fuentes',
    'singular_name'              => 'Fuente',
    'add_new_item'               => 'Agregar fuente',
    'edit_item'                  => 'Editar fuente',
    'view_item'                  => 'Ver fuente',
    'search_items'               => 'Buscar fuentes',
    'not_found'                  => 'No se encontro el fuente',
    'all_items'                  => 'Todos los fuentes',
    'menu_name'                  => 'Fuentes',
    'back_to_items'              => '← Volver a los fuentes',
    'update_item'                => 'Actualizar fuente',
    'parent_item'                => 'Fuente superior',
    'new_item_name'              => 'Nuevo fuente'
  );
  
  register_taxonomy(
    'fuente',
    array( 'post', 'perspectiva' ),
    array(
      'labels' => $labels,
      'has_archive' => true,
      'rewrite' => array( 
        'slug' => 'fuente', 
        'with_front' => false 
      ),
      'show_in_ui' => false,
      'show_in_nav_menus' => true,
      'show_in_rest' => true,
      'show_admin_column' => true,
      'hierarchical' => false
    )
  );

  flush_rewrite_rules();
}


/****************************************************************
*																*
*                          POST TYPES                           *
*																*
****************************************************************/

add_action( 'init', 'cp_change_post_object' );
// Change of Post Type Posts for "Noticias"
function cp_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
    $labels->name = 'Noticias';
    $labels->singular_name = 'Noticias';
    $labels->edit_item = 'Editar noticias';
    $labels->view_item = 'Ver noticia';
    $labels->search_items = 'Buscar noticias';
    $labels->not_found = 'No se encontraron noticias';
    $labels->not_found_in_trash = 'No se encontraron noticias en la papelera';
    $labels->all_items = 'Todas las noticias';
    $labels->menu_name = 'Noticias';
    $labels->name_admin_bar = 'Noticias';
    $labels->add_new = 'Agregar noticia';
}

/****************************************************************
*                               *
*                       POSTED TIME AGO                         *
*                               *
****************************************************************/
function time_ago( $type = 'post' ) {
    $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';

    return __('Hace') . " " . human_time_diff($d('U'), current_time('timestamp'));

}

/****************************************************************
*																*
*                           POST VIEWS                          *
*																*
****************************************************************/

//Set the Post Custom Field in the WP dashboard as Name/Value pair
function addPostViews($post_ID) {
	//Set the name of the Posts Custom Field.
	$count_key = 'post_views_count';
	//Returns values of the custom field with the specified key from the specified post.
	$count = get_post_meta($post_ID, $count_key, true);
	//If the User is NOT Logged In:
	if(!is_user_logged_in() ){
		//If the the Post Custom Field value is empty.
		if($count == ''){
			$count = 0; // set the counter to zero.
			//Delete all custom fields with the specified key from the specified post.
			delete_post_meta($post_ID, $count_key);
			//Add a custom (meta) field (Name/value)to the specified post.
			add_post_meta($post_ID, $count_key, '0');
			return $count . ' View';
		//If the the Post Custom Field value is NOT empty.
		}else{
			$count++; //increment the counter by 1.
			//Update the value of an existing meta key (custom field) for the specified post.
			update_post_meta($post_ID, $count_key, $count);
			//If statement, is just to have the singular form 'View' for the value '1'
			if($count == '1'){
				return $count . ' View';
				//In all other cases return (count) Views
			}else {
				return $count . ' Views';
			}
		}
	//If the User is Logged In, just return the View count.
	//At a New Post, the $Count will be undefined until you log Out.
	} else {
		return $count . ' View';
	}
}

//Gets the  number of Post Views to be used later.
function get_PostViews($post_ID){
    $count_key = 'post_views_count';
    //Returns values of the custom field with the specified key from the specified post.
    $count = get_post_meta($post_ID, $count_key, true);
    return $count;
}
 
//Function that Adds a 'Views' Column to your Posts tab in WordPress Dashboard.
function post_column_views($newcolumn){
    //Retrieves the translated string, if translation exists, and assign it to the 'default' array.
    $newcolumn['post_views'] = __('# Veces visto');
    return $newcolumn;
}
add_filter('manage_posts_columns', 'post_column_views');
 
//Function that Populates the 'Views' Column with the number of views count.
function post_custom_column_views($column_name, $id){
    if($column_name === 'post_views'){
        echo get_PostViews(get_the_ID());
    }
}
add_action('manage_posts_custom_column', 'post_custom_column_views',10,2);

/****************************************************************
*																*
*                       IMAGES DESCRIPTIONS                     *
*																*
****************************************************************/
/*     */

/****************************************************************
*																*
*                           PAGINATION                         *
*																*
****************************************************************/

function pagination() {
    global $wp_query;
    $big = 999999999; // necesita un número entero improbable
    $pages = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'prev_next' => false,
		'type' => 'array',
		'prev_next' => TRUE,
		'prev_text' => __('Anterior'),
		'next_text' => __('Siguiente'),
	) );
	if( is_array( $pages ) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		$corrent = max( 1, get_query_var('paged') );
		echo '
			<ul class="pagination justify-content-center">';	
				foreach ( $pages as $page ) {
					echo '<li class="page-item">'.$page.'</li>';
				}
				echo '
			</ul>
		';
	}
}


/****************************************************************
*																*
*                             OTROS                             *
*																*
****************************************************************/

require_once 'categoriaprincipal.php';
require_once 'options/theme.php';

// API
require_once 'api/slider.php';
require_once 'api/blockone.php';
require_once 'api/blocktwo.php';
require_once 'api/blockthree.php';
require_once 'api/blockfour.php';
require_once 'api/blockfive.php';
require_once 'api/post-custom-rest-api.php';
require_once 'api/category-custom-rest-api.php';
require_once 'api/functions-api.php';

/****************************************************************
*																*
*                      GET PRIMARY CATEGORY  TO YOAST           *
*																*
****************************************************************/

function get_primary_category($post_id, $custom_tax){

	$categories = get_the_terms( $post_id, $custom_tax );
	if ( ! $categories ){
		return false;
	}

	if ( class_exists( 'WPSEO_Primary_Term' ) ){
		$wpseo_primary_term = new WPSEO_Primary_Term( $custom_tax, $post_id );
		$term = get_term( $wpseo_primary_term->get_primary_term() );
		if ( ! is_wp_error( $term ) && isset( $term ) ) {
			return $term;
		}
	}
	
	return $categories;
}

/****************************************************************
*                               *
*                      DOUBLE TERM TAX TREE                     *
*                               *
****************************************************************/

function perspectivas_terms(
      $post_types = array( 'post' ),
      $first      = 'category',
      $second     = 'post_tag'
    )
  {
    $query = new WP_Query(
        array (
            'numberposts'      => -1,
            'suppress_filters' => TRUE,
            'posts_per_page'   => -1,
            'post_type'        => $post_types,
            'tax_query'        => array (
                'relation' => 'AND',
                array(
                    'taxonomy' => $first,
                    'field'    => 'id',
                    'terms'    => get_terms( $first, array( 'fields' => 'ids' ) )
                ),
                array(
                    'taxonomy' => $second,
                    'field'    => 'id',
                    'terms'    => get_terms( $second, array( 'fields' => 'ids' ) )
                ),
            ),
        )
    );

    if ( empty ( $query->posts ) )
        return;

    $result_list = array();
    $output      = '<ul>';

    foreach ( $query->posts as $post )
    {
        $first_terms  = get_the_term_list( $post->ID, $first, '', '|' );
        $second_terms = get_the_term_list( $post->ID, $second, '', '|' );

        $f_term_array = explode( '|', $first_terms );
        $s_term_array = explode( '|', $second_terms );

        foreach ( $f_term_array as $f_term )
        {
            if ( ! isset ( $result_list[ $f_term ] ) )
                $result_list[ $f_term ] = array();

            $result_list[ $f_term ] = array_merge( $result_list[ $f_term ], $s_term_array );
        }
    }

    foreach ( $result_list as $k => $v )
    {
        $result_list[ $k ] = array_unique( $v );
        $output           .= "\n<li class='li-1st-lvl'>$k\n\t<ul>\n\t\t<li>"
            . join( "</li>\n\t\t<li>", array_unique( $v ) )
            . "</li>\n\t</ul>\n</li>";
    }

    $output .= '</ul>';

    return $result_list;
  }
function noticias_terms(
      $post_types = array( 'post' ),
      $first      = 'category',
      $second     = 'post_tag'
    )
  {
    $query = new WP_Query(
        array (
            'numberposts'      => -1,
            'suppress_filters' => TRUE,
            'posts_per_page'   => -1,
            'post_type'        => $post_types,
            'tax_query'        => array (
                'relation' => 'AND',
                array(
                    'taxonomy' => $first,
                    'field'    => 'id',
                    'terms'    => get_terms( $first, array( 'fields' => 'ids' ) )
                ),
                array(
                    'taxonomy' => $second,
                    'field'    => 'id',
                    'terms'    => get_terms( $second, array( 'fields' => 'ids' ) )
                ),
            ),
        )
    );

    if ( empty ( $query->posts ) )
        return;

    $result_list = array();
    $output      = '<ul>';

    foreach ( $query->posts as $post )
    {
        $first_terms  = get_the_term_list( $post->ID, $first, '', '|' );
        $second_terms = get_the_term_list( $post->ID, $second, '', '|' );

        $f_term_array = explode( '|', $first_terms );
        $s_term_array = explode( '|', $second_terms );

        foreach ( $f_term_array as $f_term )
        {
            if ( ! isset ( $result_list[ $f_term ] ) )
                $result_list[ $f_term ] = array();

            $result_list[ $f_term ] = array_merge( $result_list[ $f_term ], $s_term_array );
        }
    }

    foreach ( $result_list as $k => $v )
    {
        $result_list[ $k ] = array_unique( $v );
        $output           .= "\n<li class='li-1st-lvl'>$k\n\t<ul>\n\t\t<li>"
            . join( "</li>\n\t\t<li>", array_unique( $v ) )
            . "</li>\n\t</ul>\n</li>";
    }

    $output .= '</ul>';

    return $result_list;
  }



  //Estilos y JS para AnythingSlider
function agregar_anythingslider_scripts(){
  wp_enqueue_style( 'anythingslider', get_template_directory_uri() . '/assets/css/anythingslider.css',false, null, 'all');
  wp_enqueue_script( 'anythingslider', get_template_directory_uri() . '/assets/js/jquery.anythingslider.min.js', array ( 'jquery' ), null, false); //footer
}
add_action( 'wp_enqueue_scripts', 'agregar_anythingslider_scripts' );