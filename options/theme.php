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
 *  Registrar las configuraciones para la section
 */
function settings() {

    // Block 1 - Categories
    add_settings_section("block_one_section", "Block 1", null, "blockone");
    add_settings_field("block-one-category", "Categoria", "form_block_one", "blockone", "block_one_section");  
    register_setting("block_one_section", "block-one-category");

    // Block 2
}

/**
 *  Input for the section's field
 */
function form_block_one() {

    $categories = get_terms( 'category', array(
        'orderby'    => 'count',
        'hide_empty' => 0,
    ));

    ?>

    <select name="block-one-category">
        <?php foreach($categories as $c): ?>
            <option value="<?php echo $c->term_id; ?>" <?php selected(get_option('block-one-category'), $c->term_id); ?>><?php echo $c->name; ?></option>
        <?php endforeach ?>
    </select>
<?php
}

/**
 *  Template del form
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