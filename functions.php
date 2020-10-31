<?php
/**
 * posta functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package posta
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
      'menu-principal' => esc_html__( 'Menú principal', 'posta' ),
      'menu-2' => esc_html__( 'Menú 2', 'posta' ),
      'menu-pie-de-pagina' => esc_html__( 'Menú pie de página', 'posta' )
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
 * Calculate image sizes
 */
// function posta_content_image_sizes_attr($sizes, $size) {
//   $width = $size[0];
//   if ($width > 910) {
//     return '(max-width: 768px) 92vw, (max-width: 992px) 690px, (max-width: 1200px) 910px, 1110px';
//   }
//   if ($width < 910 && $width > 690) {
//     return '(max-width: 768px) 360px, (max-width: 992px) 550px, 1920px';
//   }
//   return '(max-width: ' . $width . 'px) 92vw, ' . $width . 'px';
// }
// add_filter('wp_calculate_image_sizes', 'posta_content_image_sizes_attr', 10 , 2);


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
 * Disable default generated image sizes
 */
function remove_default_image_sizes( $sizes ) {
  
  /* Default WordPress */
  // unset( $sizes[ 'thumbnail' ]);
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
function punto_u_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'punto_u_content_width', 640 );
}
add_action( 'after_setup_theme', 'punto_u_content_width', 0 );

/****************************************************************
*																*
*                            WIDGETS                            *
*																*
****************************************************************/

function punto_u_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Publicidad', 'posta' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Agrega imagenes de publicidad aquí', 'posta' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="hidden">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'punto_u_widgets_init' );

function unregister_default_wp_widgets(){
  unregister_widget('WP_Widget_Archives');
  unregister_widget('WP_Widget_Media_Audio');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_Media_Gallery');
  unregister_widget('WP_Nav_Menu_Widget');
  unregister_widget('WP_Widget_Meta');
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Text');
  unregister_widget('WP_Widget_Media_Video');
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Categories');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_Pages');
}
add_action('widgets_init', 'unregister_default_wp_widgets' );

/****************************************************************
*																*
*                            SCRIPTS                            *
*																*
****************************************************************/
      
function punto_u_scripts() {
	wp_enqueue_style( 'posta-style', get_stylesheet_uri() );

	wp_enqueue_script( 'posta-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'posta-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'punto_u_scripts' );

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
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/****************************************************************
*																*
*                           CUSTOMIZER                          *
*																*
****************************************************************/

require_once 'inc/customizer.php';

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
	// remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
}
// Removing some default admin menu links
add_action( 'admin_menu', 'remove_menus' );

// Menu for "accesos directos" in admin bar
function accesos_directos($wp_admin_bar){

  $args = array(
    'id'     => 'accesos_directos',
    'title' =>  'Accesos directos',
    'meta'   => array( 'class' => 'first-toolbar-group' ),
  );
  $wp_admin_bar->add_node( $args );

  // add child items
  $args = array();

  array_push($args,array(
    'id'        =>  'personalizarinicio',
    'title'     =>  'Personalizar Inicio',
    'href'      =>  get_site_url() . '/wp-admin/post.php?post=2&action=edit',
    'parent'    =>  'accesos_directos',
  ));

  foreach( $args as $each_arg){
    $wp_admin_bar->add_node($each_arg);
  }

}
add_action( 'admin_bar_menu', 'accesos_directos', 900 );

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
  $taxonomies = array( 'theme', 'post_tag' );

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

// Register own taxonomy for "Temas"
add_action( 'init', 'create_theme_taxonomy' );
function create_theme_taxonomy() {
  $labels = array(
    'name'                       => 'Temas',
    'singular_name'              => 'Tema',
    'add_new_item'               => 'Agregar tema',
    'edit_item'                  => 'Editar tema',
    'view_item'                  => 'Ver tema',
    'search_items'               => 'Buscar temas',
    'not_found'                  => 'No se encontro el tema',
    'all_items'                  => 'Todos los temas',
    'menu_name'                  => 'Temas',
    'back_to_items'              => '← Volver a los temas',
    'update_item'                => 'Actualizar tema',
    'parent_item'                => 'Tema superior',
    'new_item_name'              => 'Nuevo tema'
  );
  
  register_taxonomy(
    'theme',
    array( 'post' ),
    array(
      'labels' => $labels,
      'has_archive' => true,
      'rewrite' => array( 'slug' => 'tema', 'with_front' => false ),
      'show_in_nav_menus' => true,
      'show_in_rest' => true,
      'show_admin_column' => true,
      'hierarchical' => true
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
*																*
*                         AJAX FUNCTIONS                        *
*																*
****************************************************************/


// Method used to add the load more script and generate a global var
function my_theme_enqueue_scripts() {
  // Calling new js for the load more button in posts category
  wp_enqueue_script  ( 'custom_js', get_template_directory_uri().'/assets/js/custom-ajax.js', array('jquery'), '', true );
  wp_localize_script ( 'custom_js', 'ajax_posts', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'noposts' => __('No older posts found', 'divi'),
    'baseUrl' => get_bloginfo('url'),
  ));
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_scripts' );

// Method used for loading more post in category section
function more_post_ajax(){
    $taxonomy = ( isset($_POST['taxonomy']) ) ? $_POST['taxonomy'] : '';
  	$cat   = ( isset($_POST['cat']) ) ? $_POST['cat'] : '';
  	$ppp   = ( isset($_POST["ppp"]) ) ? $_POST["ppp"] : 9;
  	//$ppp = 9;
  	$pst   = ( isset($_POST['pst']) ) ? $_POST['pst'] : 'post';
  	$fpt   = ( isset($_POST['fpt']) ) ? $_POST['fpt'] : 'recent_added';
  	$page  = ( isset($_POST['pageNumber']) ) ? $_POST['pageNumber'] : 0;

  	header("Content-Type: text/html");

  	if ($taxonomy == "theme" || $taxonomy == "post_tag"){
    	$args = array (
		'suppress_filters' => true,
		'post_type'        => $pst,
		'posts_per_page'   => $ppp,
		'tax_query' => array(
			array(
			'taxonomy' => $taxonomy,
			'field'    => 'name',
			'terms'    => $cat,
			),
		),
		'paged'            => $page,
		'orderby'          => 'date',
		'order'            => 'DESC'
    	);
	}else if ($taxonomy == "category"){
		$args = array (
		'suppress_filters' => true,
		'post_type'        => $pst,
		'posts_per_page'   => $ppp,
		'cat'              => $cat,
		'paged'            => $page,
		'orderby'          => 'date',
		'order'            => 'DESC'
		);
	}else{
		$args = array ();
	}
	

	$loop = new WP_Query($args);

	if ( $loop->have_posts() ) :
		$totalp = count($loop->posts);
		while ( $loop->have_posts() ) : $loop->the_post();
		get_template_part( 'template-parts/content', 'content' );
		endwhile;
		wp_reset_postdata();
	else:
		echo 'no hay posts';
	endif;
	wp_reset_postdata();
}
add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

// Method used for loading more viewed posts
function filter_post_ajax(){
  $cat   = ( isset($_POST['cat']) ) ? $_POST['cat'] : '';
  $ppp   = ( isset($_POST["ppp"]) ) ? $_POST["ppp"] : 6;
  $pst   = ( isset($_POST['pst']) ) ? $_POST['pst'] : 'post';
  $fpt   = ( isset($_POST['fpt']) ) ? $_POST['fpt'] : 'recent_added';
  $cpt   = ( isset($_POST['cpt']) ) ? $_POST['cpt'] : '';
  $page  = ( isset($_POST['pageNumber']) ) ? $_POST['pageNumber'] : 0;
  $category_link  = get_category_link($cat);

  $outarr = array();
  $outhtm = '';

  if ( $pst != 'post' ) {
    // arg for post types(noticias or eventos)
    if ( $fpt=='recent_added' ) {
      // arg for recent added posts by post type
      $args = array(
        'suppress_filters' => true,
        'post_type'      => $pst,
        'posts_per_page' => $ppp,
        'paged'          => $page,
        'orderby'        => 'date',
        'order'          => 'DESC'
      );
    } else {
      // arg for more viewed posts by post type
      $args = array(
        'suppress_filters' => true,
        'post_type'        => $pst,
        'meta_key'         => 'post_views_count',
        'posts_per_page'   => $ppp,
        'paged'            => $page,
        'orderby'          => 'meta_value_num',
        'order'            => 'DESC'
      );
    }
  } else {
    // arg for post by category(default)
    if ( $fpt=='recent_added' ) {
      // arg for recent added posts by category
      $args = array (
        'suppress_filters' => true,
        'post_type'        => $pst,
        'posts_per_page'   => $ppp,
        'cat'              => $cat,
        'paged'            => $page,
        'orderby'          => 'date',
        'order'            => 'DESC'
      );
    } else {
      // arg for more viewed posts by category
      $args = array (
        'suppress_filters' => true,
        'post_type'        => $pst,
        'meta_key'         => 'post_views_count',
        'posts_per_page'   => $ppp,
        'cat'              => $cat,
        'paged'            => $page,
        'orderby'          => 'meta_value_num',
        'order'            => 'DESC'
    );
    }
  }

  $loop = new WP_Query($args);




















// ------------------------------------
// ------------------------------------
// ------------------------------------
// ------------------------------------
// ------------------------------------
// ------------------------------------
  if ( $loop->have_posts() ) {
    $totalp = count($loop->posts);
    while ( $loop->have_posts() ) {
      $loop->the_post();
      $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
      if (empty($featured_img_url)){
        $featured_img_url = get_theme_mod('default_news_image');
      }

      if ( $cpt=='carousel-style-one' ) {
        $outhtm = '
        <div class="c-item toto2">
          <div class="contenedor-media d-flex justify-content-start align-items-start p-2 slider-style-1-b" style="background-image: url('.$featured_img_url.');">
              <a class="link-a-nota" href="'.get_the_permalink().'"></a>
              <img class="slider-style-media-1 hidden" src="'.$featured_img_url.'" alt="">
          </div>';
        if ( get_field( 'content_type', get_the_ID() ) == 'video' ) {
          if ( get_field( 'video_news', get_the_ID() ) ) {
            $video_iframe = get_field( 'video_news', get_the_ID() );
                /*Autoplay Functionallity*/
                if ( preg_match('/src="(.+?)"/', $video_iframe, $matches) ) {
                  // Video source URL
                  $src = $matches[1];
                  // Add option to hide controls, enable HD, and do autoplay -- depending on provider
                  $params = array(
                    'autoplay' => 1
                  );
                  $new_src = add_query_arg($params, $src);
                  $video_iframe = str_replace($src, $new_src, $video_iframe);
                  // add extra attributes to iframe html
                  $attributes = 'frameborder="0"';
                  $video_iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video_iframe);
                }
                /*Autoplay Functionallity*/
            $video = '<div class="contenedor-media">'.$video_iframe.'</div>';
          } else {
            $video = 'No se puede mostrar el contenido.';
          }
          $clear = "'".$video."'";
          $outhtm .= '<i class="fas fa-play media_file media-type-icon media-type-icon-top-left pl-1" data-media='.$clear.' data-toggle="tooltip" data-placement="right" title="Video"></i>';
        } else if ( get_field( 'content_type', get_the_ID() ) == 'gif' ) {
          if ( get_field( 'gif_news', get_the_ID() ) ) {
            $gif_url = get_field('gif_news',get_the_ID());
            $gifim = '<div class="contenedor-media"><img class="contenedor-media-item" src="'.$gif_url.'"></div>';
          } else {
            $gifim = 'No se puede mostrar el contenido.';
          }
          $clear = "'".$gifim."'";
          $outhtm .= '<i class="fas fa-spinner media_file media-type-icon media-type-icon-top-left" data-media='.$clear.' data-toggle="tooltip" data-placement="right" title="Gif"></i>';
        } else if ( get_field( 'content_type', get_the_ID() ) == 'audio' ) {
          if ( get_field( 'audio_news', get_the_ID() ) ) {
            $audio_iframe = get_field( 'audio_news', get_the_ID() );
            $sound = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>';
          } else {
            $sound = 'No se puede mostrar el contenido.';
          }
          $clear = "'".$sound."'";
          $outhtm .= '<i class="fas fa-volume-up media_file media-type-icon media-type-icon-top-left" data-media='.$clear.' data-toggle="tooltip" data-placement="right" title="Audio"></i>';
        }
        $outhtm .= '
          <i class="fas fa-share-alt share-from-modal share-icon" data-title="'.esc_html(get_the_title()).'" data-excerpt="" data-link="'.get_the_permalink().'" data-img="'.$featured_img_url.'" data-toggle="tooltip" data-placement="left" title="Compartir"></i>
          <div class="encabezado-nota">
            <h4 class="titulo-de-nota">
              <a class="texto-blanco" href="'.get_the_permalink().'">'.esc_html(get_the_title()).'</a>
            </h4>
            <div>[tags de la nota]</div>
          </div>
        </div>';
        array_push($outarr, $outhtm);

      } else if ( $cpt=='carousel-style-two' ) {
        $outhtm = '
        <div class="c-item toto2">
          <div class="contenedor-media d-flex justify-content-start align-items-start p-2 slider-style-2-b" style="background-image: url('.$featured_img_url.');">
            <a class="link-a-nota" href="'.get_the_permalink().'"></a>
            <img class="slider-style-media-1 hidden" src="'.$featured_img_url.'" alt="">
          </div>';
        if ( get_field( 'content_type', get_the_ID() ) == 'video' ) {
          if ( get_field( 'video_news', get_the_ID() ) ) {
            $video_iframe = get_field( 'video_news', get_the_ID() );
                /*Autoplay Functionallity*/
                if ( preg_match('/src="(.+?)"/', $video_iframe, $matches) ) {
                  // Video source URL
                  $src = $matches[1];
                  // Add option to hide controls, enable HD, and do autoplay -- depending on provider
                  $params = array(
                    'autoplay' => 1
                  );
                  $new_src = add_query_arg($params, $src);
                  $video_iframe = str_replace($src, $new_src, $video_iframe);
                  // add extra attributes to iframe html
                  $attributes = 'frameborder="0"';
                  $video_iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video_iframe);
                }
                /*Autoplay Functionallity*/
            $video = '<div class="contenedor-media">'.$video_iframe.'</div>';
          } else {
            $video = 'No se puede mostrar el contenido.';
          }
          $clear = "'".$video."'";
          $outhtm .= '<i class="fas fa-play media_file media-type-icon media-type-icon-top-left pl-1" data-media='.$clear.' data-toggle="tooltip" data-placement="right" title="Video"></i>';
        } else if ( get_field( 'content_type', get_the_ID() ) == 'gif' ) {
          if ( get_field( 'gif_news', get_the_ID() ) ) {
            $gif_url = get_field('gif_news',get_the_ID());
            $gifim = '<div class="contenedor-media"><img class="contenedor-media-item" src="'.$gif_url.'"></div>';
          } else {
            $gifim = 'No se puede mostrar el contenido.';
          }
          $clear = "'".$gifim."'";
          $outhtm .= '<i class="fas fa-spinner media_file media-type-icon media-type-icon-top-left" data-media='.$clear.' data-toggle="tooltip" data-placement="right" title="Gif"></i>';
        } else if ( get_field( 'content_type', get_the_ID() ) == 'audio' ) {
          if ( get_field( 'audio_news', get_the_ID() ) ) {
            $audio_iframe = get_field( 'audio_news', get_the_ID() );
            $sound = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>';
          } else {
            $sound = 'No se puede mostrar el contenido.';
          }
          $clear = "'".$sound."'";
          $outhtm .= '<i class="fas fa-volume-up media_file media-type-icon media-type-icon-top-left" data-media='.$clear.' data-toggle="tooltip" data-placement="right" title="Audio"></i>';
        }
        $outhtm .= '
          <i class="fas fa-share-alt share-from-modal share-icon" data-title="'.esc_html(get_the_title()).'" data-excerpt="" data-link="'.get_the_permalink().'" data-img="'.$featured_img_url.'" data-toggle="tooltip" data-placement="left" title="Compartir"></i>
          <div class="encabezado-nota">
            <h4 class="titulo-de-nota">
              <a class="texto-blanco" href="'.get_the_permalink().'">'.esc_html(get_the_title()).'</a>
            </h4>
            <div>[tags de la nota]</div>
          </div>
        </div>';
        array_push($outarr, $outhtm);

      } else if ( $cpt=='carousel-style-three' ) {
        $outhtm = '
        <div class="c-item toto2">
          <div class="contenedor-media d-flex justify-content-start align-items-start p-2 slider-style-3-b" style="background-image: url('.$featured_img_url.');">
            <a class="link-a-nota" href="'.get_the_permalink().'"></a>
            <img class="slider-style-media-1 hidden" src="'.$featured_img_url.'" alt="">
          </div>';
          if ( get_field( 'content_type', get_the_ID() ) == 'video' ) {
            if ( get_field( 'video_news', get_the_ID() ) ) {
              $video_iframe = get_field( 'video_news', get_the_ID() );
                /*Autoplay Functionallity*/
                if ( preg_match('/src="(.+?)"/', $video_iframe, $matches) ) {
                  // Video source URL
                  $src = $matches[1];
                  // Add option to hide controls, enable HD, and do autoplay -- depending on provider
                  $params = array(
                    'autoplay' => 1
                  );
                  $new_src = add_query_arg($params, $src);
                  $video_iframe = str_replace($src, $new_src, $video_iframe);
                  // add extra attributes to iframe html
                  $attributes = 'frameborder="0"';
                  $video_iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video_iframe);
                }
                /*Autoplay Functionallity*/
              $video = '<div class="contenedor-media">'.$video_iframe.'</div>';
            } else {
              $video = 'No se puede mostrar el contenido.';
            }
            $clear = "'".$video."'";
            $outhtm .= '<i class="fas fa-play media_file media-type-icon media-type-icon-top-left pl-1" data-media='.$clear.' data-toggle="tooltip" data-placement="right" title="Video"></i>';
          } else if ( get_field( 'content_type', get_the_ID() ) == 'gif' ) {
            if ( get_field( 'gif_news', get_the_ID() ) ) {
              $gif_url = get_field('gif_news',get_the_ID());
              $gifim = '<div class="contenedor-media"><img class="contenedor-media-item" src="'.$gif_url.'"></div>';
            } else {
              $gifim = 'No se puede mostrar el contenido.';
            }
            $clear = "'".$gifim."'";
            $outhtm .= '<i class="fas fa-spinner media_file media-type-icon media-type-icon-top-left" data-media='.$clear.' data-toggle="tooltip" data-placement="right" title="Gif"></i>';
          } else if ( get_field( 'content_type', get_the_ID() ) == 'audio' ) {
            if ( get_field( 'audio_news', get_the_ID() ) ) {
              $audio_iframe = get_field( 'audio_news', get_the_ID() );
              $sound = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>';
            } else {
              $sound = 'No se puede mostrar el contenido.';
            }
            $clear = "'".$sound."'";
            $outhtm .= '<i class="fas fa-volume-up media_file media-type-icon media-type-icon-top-left" data-media='.$clear.' data-toggle="tooltip" data-placement="right" title="Audio"></i>';
          }
          $outhtm .= '
            <i class="fas fa-share-alt share-from-modal share-icon" data-title="'.esc_html(get_the_title()).'" data-excerpt="" data-link="'.get_the_permalink().'" data-img="'.$featured_img_url.'" data-toggle="tooltip" data-placement="left" title="Compartir"></i>
            <div class="encabezado-nota">
              <h4 class="titulo-de-nota">
                <a class="texto-blanco" href="'.get_the_permalink().'">'.esc_html(get_the_title()).'</a>
              </h4>
              <div>[tags de la nota]</div>
            </div>
            <div class="encabezado-nota-bg"></div>
          </div>';
          array_push($outarr, $outhtm);

      } else if ( $cpt=='carousel-style-four' ) {
        $outhtm = '
        <div class="c-item toto2">
          <div class="contenedor-media d-flex justify-content-start align-items-start p-2 slider-style-4-b" style="background-image: url('.$featured_img_url.');">
            <a class="link-a-nota" href="'.get_the_permalink().'"></a>
            <img class="slider-style-media-1 hidden" src="'.$featured_img_url.'" alt="">
          </div>';
          if ( get_field( 'content_type', get_the_ID() ) == 'video' ) {
            if ( get_field( 'video_news', get_the_ID() ) ) {
              $video_iframe = get_field( 'video_news', get_the_ID() );
                /*Autoplay Functionallity*/
                if ( preg_match('/src="(.+?)"/', $video_iframe, $matches) ) {
                  // Video source URL
                  $src = $matches[1];
                  // Add option to hide controls, enable HD, and do autoplay -- depending on provider
                  $params = array(
                    'autoplay' => 1
                  );
                  $new_src = add_query_arg($params, $src);
                  $video_iframe = str_replace($src, $new_src, $video_iframe);
                  // add extra attributes to iframe html
                  $attributes = 'frameborder="0"';
                  $video_iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video_iframe);
                }
                /*Autoplay Functionallity*/
              $video = '<div class="contenedor-media">'.$video_iframe.'</div>';
            } else {
              $video = 'No se puede mostrar el contenido.';
            }
            $clear = "'".$video."'";
            $outhtm .= '<i class="fas fa-play media_file media-type-icon media-type-icon-top-left pl-1" data-media='.$clear.' data-toggle="tooltip" data-placement="right" title="Video"></i>';
          } else if ( get_field( 'content_type', get_the_ID() ) == 'gif' ) {
            if ( get_field( 'gif_news', get_the_ID() ) ) {
              $gif_url = get_field('gif_news',get_the_ID());
              $gifim = '<div class="contenedor-media"><img class="contenedor-media-item" src="'.$gif_url.'"></div>';
            } else {
              $gifim = 'No se puede mostrar el contenido.';
            }
            $clear = "'".$gifim."'";
            $outhtm .= '<i class="fas fa-spinner media_file media-type-icon media-type-icon-top-left" data-media='.$clear.' data-toggle="tooltip" data-placement="right" title="Gif"></i>';
          } elseif ( get_field( 'content_type', get_the_ID() ) == 'audio' ) {
            if ( get_field( 'audio_news', get_the_ID() ) ) {
              $audio_iframe = get_field( 'audio_news', get_the_ID() );
              $sound = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>';
            } else {
              $sound = 'No se puede mostrar el contenido.';
            }
            $clear = "'".$sound."'";
            $outhtm .= '<i class="fas fa-volume-up media_file media-type-icon media-type-icon-top-left" data-media='.$clear.' data-toggle="tooltip" data-placement="right" title="Audio"></i>';
          }
          $outhtm .= '
            <i class="fas fa-share-alt share-from-modal share-icon" data-title="'.esc_html(get_the_title()).'" data-excerpt="" data-link="'.get_the_permalink().'" data-img="'.$featured_img_url.'" data-toggle="tooltip" data-placement="left" title="Compartir"></i>
            <div class="encabezado-nota">
              <h4 class="titulo-de-nota">
                <a class="texto-blanco" href="'.get_the_permalink().'">'.esc_html(get_the_title()).'</a>
              </h4>
              <div>[tags de la nota]</div>
            </div>
          </div>';
          array_push($outarr, $outhtm);
      }
    } //Endwhile
    $outhtml .= '
    <div class="c-item background-amarillo p-2">
      <a class="texto-blanco text-center text-uppercase" href="'.esc_url($category_link).'" title="Ver más notas">
        <div class="contenedor-media">
          <div class="contenedor-media-item item-ver-mas">
            <h4 class="m-0">Ver más notas</h4>
          </div>
        </div>
      </a>
    </div>';
    array_push($outarr, $outhtml);
  } //Endif
// ------------------------------------
// ------------------------------------
// ------------------------------------
// ------------------------------------
// ------------------------------------
// ------------------------------------




















  
  wp_reset_postdata();
  die(json_encode($outarr));
}
add_action('wp_ajax_nopriv_filter_post_ajax', 'filter_post_ajax');
add_action('wp_ajax_filter_post_ajax', 'filter_post_ajax');

/****************************************************************
*																*
*                       CUSTOM SEARCH FORM                      *
*																*
****************************************************************/

// Custom search form
function wpbsearchform( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="'.home_url('').'" >
			     <div class="input-group">
				     <input type="text" name="s" id="s" class="form-control" value="'.get_search_query().'">
					 <span class="input-group-btn">
					     <button id="searchsubmit" type="submit" class="btn btn-info btn-lg bg-dark custom-btn-src"><i class="fa fa-search"></i></button>
					 </span>
				 </div>
			 </form>';
    return $form;
}
add_shortcode('wpbsearch', 'wpbsearchform');

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
*                            EXCERPT                            *
*																*
****************************************************************/

/**
 * Removes the regular excerpt box. We're not getting rid
 * of it, we're just moving it above the wysiwyg editor
 *
 * @return null
 */
function oz_remove_normal_excerpt() {
    remove_meta_box( 'postexcerpt' , 'post' , 'normal' );
}
add_action( 'admin_menu' , 'oz_remove_normal_excerpt' );

/**
 * Add the excerpt meta box back in with a custom screen location
 *
 * @param  string $post_type
 * @return null
 */
function oz_add_excerpt_meta_box( $post_type ) {
    $post = get_post();
    $post_name = $post->post_name;
    if ( in_array( $post_type, array( 'post', 'page' ) ) && $post_name != 'home' ) {
        add_meta_box(
            'oz_postexcerpt',
            __( 'Extracto', 'thetab-theme' ),
            'post_excerpt_meta_box',
            $post_type,
            'after_title',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'oz_add_excerpt_meta_box' );

/****************************************************************
*																*
*                            META BOX                           *
*																*
****************************************************************/
 
/**
 * You can't actually add meta boxes after the title by default in WP so
 * we're being cheeky. We've registered our own meta box position
 * `after_title` onto which we've regiestered our new meta boxes and
 * are now calling them in the `edit_form_after_title` hook which is run
 * after the post tile box is displayed.
 *
 * @return null
 */
function oz_run_after_title_meta_boxes() {
    global $post, $wp_meta_boxes;
    # Output the `below_title` meta boxes:
    do_meta_boxes( get_current_screen(), 'after_title', $post );
}
add_action( 'edit_form_after_title', 'oz_run_after_title_meta_boxes' );


/****************************************************************
*																*
*                           TESTING DE SHORTCODES                          *
*																*
****************************************************************/

// Shortcode [puntou_cita]
function shortcode_puntou_cita( $atts ){

	$puntou_cita_parametros="";
	extract(shortcode_atts(array(
		'cita' => 'No especificado',
		'autor' => 'No especificado',
	), $atts));

	// Display info
	$puntou_cita_parametros = '<div class="cita"><blockquote>';
	$puntou_cita_parametros .= '<p>Cita: ' .$cita. '</p>';
	$puntou_cita_parametros .= '<p>Autor: ' .$autor. '</p>';
	$puntou_cita_parametros .= '</blockquote></div>';
	return $puntou_cita_parametros;
}
add_shortcode('puntou_cita', 'shortcode_puntou_cita');
// add_action( 'init', 'register_shortcodes');


// Shortcode [puntou_cita2]
function puntou_cita2_parametros( $atts, $content = null ) {
	// Genero los valores por defecto de los parámetros
	$params = shortcode_atts( array(
		'text-color'        => '#000000',
		'background-color'  => '#ffffff',
		'font-size'  		    => '20',
	), $atts );
	// Genero el string con estilos en línea
	$style = "style= 'color:{$params['text-color']}; background-color:{$params['background-color']}; font-size:{$params['font-size']}px;'";
	// Aplico el texto y el stilo a la etiqeta <p>
	return "<div {$style}>{$content}</div>";
}
add_shortcode( 'puntou_cita2', 'puntou_cita2_parametros' );


// Shortcode [puntou_boton]
function puntou_boton_parametros( $atts, $content ) {
	$atts = shortcode_atts( array(
		'icono' => 'pencil'
	), $atts );
	return '<h1><span class="fab fa-' . $atts['icono'] . '"></span> ' . $content . '</h1>';
}
add_shortcode('puntou_boton', 'puntou_boton_parametros');


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
		'type'  => 'array',
		'prev_next'   => TRUE,
		'prev_text'    => __('Anterior'),
		'next_text'    => __('Siguiente'),
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

require_once 'categoriaprincipal.php';