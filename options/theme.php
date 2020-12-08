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
    register_setting( 'post-app-configuration', 'new_option_name' );
	register_setting( 'post-app-configuration', 'some_other_option' );
	register_setting( 'post-app-configuration', 'option_etc' );
	register_setting( 'post-app-configuration', 'slider_nota' );
}


/**
 *  Template del form
 */
function page() {

    settings_errors();

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
                        <option value="">Selecciona una categoria</option>
                        <?php foreach($categories as $c): ?>
                            <option value="<?php echo $c->term_id; ?>" <?php selected(get_option('slider_nota')[0], $c->term_id); ?>><?php echo $c->name; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="slider_categoria">Noticia 2</label>
                    <select name="slider_nota[]">
                        <option value="">Selecciona una categoria</option>
                        <?php foreach($categories as $c): ?>
                            <option value="<?php echo $c->term_id; ?>" <?php selected(get_option('slider_nota')[1], $c->term_id); ?>><?php echo $c->name; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="slider_categoria">Noticia 3</label>
                    <select name="slider_nota[]">
                        <option value="">Selecciona una categoria</option>
                        <?php foreach($categories as $c): ?>
                            <option value="<?php echo $c->term_id; ?>" <?php selected(get_option('slider_nota')[2], $c->term_id); ?>><?php echo $c->name; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="slider_categoria">Noticia 4</label>
                    <select name="slider_nota[]">
                        <option value="">Selecciona una categoria</option>
                        <?php foreach($categories as $c): ?>
                            <option value="<?php echo $c->term_id; ?>" <?php selected(get_option('slider_nota')[3], $c->term_id); ?>><?php echo $c->name; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                
            </div>
                        
    
            <?php submit_button(); ?>
       </form>
    </div>
 <?php
	
}