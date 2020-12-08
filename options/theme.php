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
	register_setting( 'post-app-configuration', 'slider_categoria' );
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

    <div class="wrap">

        <h1>Configuraciones Home para la app posta</h1>

        <form method="post" action="options.php">
            <?php settings_fields( 'post-app-configuration' ); ?>
            <?php do_settings_sections( 'post-app-configuration' ); ?>

            <div class="card">
                <div class="card-header">
                    <h2>Slider Principal</h2>
                </div>
                <div class="card-body">
                    <label for="">Categorias</label>
                    <select name="slider_categoria">
                        <option value="">Selecciona una categoria</option>
                        <?php foreach($categories as $c): ?>
                            <option value="<?php echo $c->term_id; ?>" <?php selected(get_option('slider_categoria'), $c->term_id); ?>><?php echo $c->name; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row">New Option Name</th>
                    <td><input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Some Other Option</th>
                    <td><input type="text" name="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Options, Etc.</th>
                    <td><input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
                </tr>
            </table>

            
    
            <?php submit_button(); ?>
       </form>
    </div>
 <?php
	
}