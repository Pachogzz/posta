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
}


/**
 *  Template del form
 */
function page() {

    settings_errors();

    $posts = get_posts( array(
        'numberposts'    => 20,
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

    <div class="container">

        <!-- <div id="dashboard-widgets-wrap">
            <div id="dashboard-widgets" class="metabox-holder">
                <div class="postbox-container" style="width: 49%;">...</div>
                <div class="postbox-container" style="width: 49%;">...</div>
            </div>
        </div> -->

        <h1 class="logo-admin">
            <img src="<?php echo get_template_directory_uri() . '/assets/img/posta-admin-app.png' ?>" alt="">
        </h1>

        <form method="post" action="options.php">
            <?php settings_fields( 'post-app-configuration' ); ?>
            <?php do_settings_sections( 'post-app-configuration' ); ?>

            <div class="card">
                <h1>Slider Principal</h1>
                <hr>

                <div class="form-group">
                    <label for="slider_categoria">Noticia 1</label>
                    <select name="slider_nota[]">
                        <option value="">Selecciona noticia 1</option>
                        <?php foreach($posts as $post): ?>
                            <option value="<?php echo $post->ID; ?>" <?php selected(get_option('slider_nota')[0], $post->ID); ?>><?php echo $post->post_title; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="slider_categoria">Noticia 2</label>
                    <select name="slider_nota[]">
                        <option value="">Selecciona noticia 2</option>
                        <?php foreach($posts as $post): ?>
                            <option value="<?php echo $post->ID; ?>" <?php selected(get_option('slider_nota')[1], $post->ID); ?>><?php echo $post->post_title; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="slider_categoria">Noticia 3</label>
                    <select name="slider_nota[]">
                        <option value="">Selecciona noticia 3</option>
                        <?php foreach($posts as $post): ?>
                            <option value="<?php echo $post->ID; ?>" <?php selected(get_option('slider_nota')[2], $post->ID); ?>><?php echo $post->post_title; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="slider_categoria">Noticia 4</label>
                    <select name="slider_nota[]">
                        <option value="">Selecciona noticia 4</option>
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

    
            <?php submit_button(); ?>
       </form>
    </div>
 <?php
	
}