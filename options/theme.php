<?php
/**
 * Archivo para generar todos los menu en el panel de Administrador
*/
function posta_app_add_admin_page () {
  // Primer paso...agregar la opción en el menú de la izquierda
  add_menu_page( 'Posta App', 'Posta App', 'manage_options', 'posta-app-options', 'page', 'dashicons-align-wide', 60 );
  // Activa los settings para el menú
  add_action( 'admin_init', 'settings' );
	
}
add_action( 'admin_menu', 'posta_app_add_admin_page' );

/**
 *  Register all the settings field and sections
 */
function settings() {
    add_settings_section("block_one_section", "Block 1", null, "blockone");
    add_settings_field("block-one", "Categoria", "form_message", "blockone", "block_one_section");  
    register_setting("block_one_section", "block-one");
}

/**
 *  Input for the section's field
 */
function form_message() {
    ?>
    <select name="block-one">
      <option value="qscutter" <?php selected(get_option('block-one'), "qscutter"); ?>>QScutter</option>
      <option value="qnimate" <?php selected(get_option('block-one'), "qnimate"); ?>>QNimate</option>
      <option value="qidea" <?php selected(get_option('block-one'), "qidea"); ?>>QIdea</option>
      <option value="qtrack" <?php selected(get_option('block-one'), "qtrack"); ?>>QTrack</option>
    </select>
<?php
}

function example_message() {
  // Mensaje para separar
  echo "<hr/>";

}

/**
 *  Template where itll be show the form
 */
function page() {
        
    settings_errors();

    ?>
    <div class="wrap">
       <h1>Configuraciones Home para la app posta</h1>

       <form method="post" action="options.php">
          <?php
             settings_fields("block_one_section");
             do_settings_sections("blockone");
             submit_button();
          ?>
       </form>
    </div>
 <?php
	
}