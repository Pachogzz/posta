<?php
/**
 * Archivo para generar todos los menu en el panel de Administrador
*/
function posta_app_add_admin_page () {
  // Primer paso...agregar la opción en el menú de la izquierda
  add_menu_page( 'Posta App', 'Posta App', 'manage_options', 'posta-app-options', 'page', 'dashicons-align-wide', 1 );
  // Activa los settings para el menú
  add_action( 'admin_init', 'settings' );
	
}
add_action('admin_menu', 'posta_app_add_admin_page');


// Style Admin
function admin_style($hook) {
    if($hook != 'toplevel_page_posta-app-options') {
        return;
    }
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/style-admin.css');
    wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css' );
    wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array('jquery') );
 
    // please create also an empty JS file in your theme directory and include it too
    wp_enqueue_script('select', get_stylesheet_directory_uri() . '/js/select.js', array( 'jquery', 'select2' ) ); 
}
add_action('admin_enqueue_scripts', 'admin_style');

/**
 *  Registrar las configuraciones para la section
 */
function settings() {
	register_setting( 'post-app-configuration', 'slider_nota' );
	register_setting( 'post-app-configuration', 'b1_categoria' );
	register_setting( 'post-app-configuration', 'b2_categoria' );
	register_setting( 'post-app-configuration', 'b3_categoria' );
	register_setting( 'post-app-configuration', 'b4_categoria' );
	register_setting( 'post-app-configuration', 'b5_categoria' );
    register_setting( 'post-app-configuration', 'menu' );
}


/**
 *  Template del form
 */
function page() {

    settings_errors();

    $posts = get_posts( array(
        'numberposts'    => 200,
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'order'          => 'DESC',
        'orderby'        => 'post_date'
    ));

    $categories = get_terms( 'category', array(
        'orderby'    => 'count',
        'hide_empty' => 0,
    ));


    ?>

    <div class="container-fluid">

        <form method="post" action="options.php">
            <?php settings_fields( 'post-app-configuration' ); ?>
            <?php do_settings_sections( 'post-app-configuration' ); ?>

            <h1 class="logo-admin">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/posta-admin-app.png' ?>" alt="">
            </h1>

            <div id="dashboard-widgets-wrap">
                <div id="dashboard-widgets" class="metabox-holder">
                    <div class="postbox-container" style="width: 47%;">

       

                        <div class="card">
                            <h1>Slider Principal</h1>
                            <hr>

                            <div class="form-group">
                                <label for="slider_categoria">Noticia 1</label>
                                <select class="slider" name="slider_nota[]">
                                    <option value="">Selecciona noticia 1</option>
                                    <?php foreach($posts as $post): ?>
                                        <option value="<?php echo $post->ID; ?>" <?php selected(get_option('slider_nota')[0], $post->ID); ?>><?php echo $post->post_title; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="slider_categoria">Noticia 2</label>
                                <select class="slider" name="slider_nota[]">
                                    <option value="">Selecciona noticia 2</option>
                                    <?php foreach($posts as $post): ?>
                                        <option value="<?php echo $post->ID; ?>" <?php selected(get_option('slider_nota')[1], $post->ID); ?>><?php echo $post->post_title; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="slider_categoria">Noticia 3</label>
                                <select class="slider" name="slider_nota[]">
                                    <option value="">Selecciona noticia 3</option>
                                    <?php foreach($posts as $post): ?>
                                        <option value="<?php echo $post->ID; ?>" <?php selected(get_option('slider_nota')[2], $post->ID); ?>><?php echo $post->post_title; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="slider_categoria">Noticia 4</label>
                                <select class="slider" name="slider_nota[]">
                                    <option value="">Selecciona noticia 4</option>
                                    <?php foreach($posts as $post): ?>
                                        <option value="<?php echo $post->ID; ?>" <?php selected(get_option('slider_nota')[3], $post->ID); ?>><?php echo $post->post_title; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="slider_categoria">Noticia 5</label>
                                <select class="slider" name="slider_nota[]">
                                    <option value="">Selecciona noticia 5</option>
                                    <?php foreach($posts as $post): ?>
                                        <option value="<?php echo $post->ID; ?>" <?php selected(get_option('slider_nota')[3], $post->ID); ?>><?php echo $post->post_title; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="slider_categoria">Noticia 6</label>
                                <select class="slider" name="slider_nota[]">
                                    <option value="">Selecciona noticia 6</option>
                                    <?php foreach($posts as $post): ?>
                                        <option value="<?php echo $post->ID; ?>" <?php selected(get_option('slider_nota')[3], $post->ID); ?>><?php echo $post->post_title; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            
                        </div>

                        <div class="card">
                            <h1>Block 1</h1>
                            <hr>
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <select name="b1_categoria" id="">
                                    <option value="">Selecciona una categoria</option>
                                    <?php foreach($categories as $c): ?>
                                        <option value="<?php echo $c->term_id; ?>" <?php selected(get_option('b1_categoria'), $c->term_id); ?> ><?php echo $c->name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="card">
                            <h1>Block 2</h1>
                            <hr>
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <select name="b2_categoria" id="">
                                    <option value="">Selecciona una categoria</option>
                                    <?php foreach($categories as $c): ?>
                                        <option value="<?php echo $c->term_id; ?>" <?php selected(get_option('b2_categoria'), $c->term_id); ?> ><?php echo $c->name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="card">
                            <h1>Block 3</h1>
                            <hr>
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <select name="b3_categoria" id="">
                                    <option value="">Selecciona una categoria</option>
                                    <?php foreach($categories as $c): ?>
                                        <option value="<?php echo $c->term_id; ?>" <?php selected(get_option('b3_categoria'), $c->term_id); ?> ><?php echo $c->name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="card">
                            <h1>Block 4</h1>
                            <hr>
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <select name="b4_categoria" id="">
                                    <option value="">Selecciona una categoria</option>
                                    <?php foreach($categories as $c): ?>
                                        <option value="<?php echo $c->term_id; ?>" <?php selected(get_option('b4_categoria'), $c->term_id); ?> ><?php echo $c->name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="card">
                            <h1>Block 5</h1>
                            <hr>
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <select name="b5_categoria" id="">
                                    <option value="">Selecciona una categoria</option>
                                    <?php foreach($categories as $c): ?>
                                        <option value="<?php echo $c->term_id; ?>" <?php selected(get_option('b5_categoria'), $c->term_id); ?> ><?php echo $c->name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="postbox-container" style="width: 47%; margin-left: 1%;">
                        <div class="card">
                            <h1>Menu App</h1>
                            <hr>
                            <div class="form-group">
                                <label for="">Selecciona las categorias que saldran en el menu de la app.</label>
                                <select name="menu[]" id="select" multiple='multiple' style="width: 40%;">
                                    <?php foreach($categories as $c): ?>
                                        <?php $selected = in_array( $c->term_id, get_option('menu') ) ? ' selected="selected" ' : '';   ?>
                                        <option value="<?php echo $c->term_id; ?>" <?php echo $selected; ?> >
                                            <?php echo $c->name; ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        

    
            <?php submit_button(); ?>
        </form>
    </div>
 <?php
	
}