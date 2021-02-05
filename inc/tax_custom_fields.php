<?php
/****************************************************************
*                                                               *
*                      COLOR IN SECCION.                        *
*                                                               *
****************************************************************/
/**
 * Add new colorpicker field to "Add new Category" screen
 * - https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/
 *
 * @param String $taxonomy
 *
 * @return void
 */
function colorpicker_field_add_new_category( $taxonomy ) {
  ?>
    <div class="form-field term-colorpicker-wrap">
        <label for="term-colorpicker">Color de Categoria</label>
        <input name="category_color" value="#f20e00" class="colorpicker" id="term-colorpicker" />
        <p>Asigna el color de fondo para la categoria, por defecto es el color principal de la identidad del sitio.</p>
    </div>
  <?php
}
add_action( 'category_add_form_fields', 'colorpicker_field_add_new_category' );
add_action( 'post_tag_add_form_fields', 'colorpicker_field_add_new_category' );
add_action( 'theme_add_form_fields', 'colorpicker_field_add_new_category' );
add_action( 'fuente_add_form_fields', 'colorpicker_field_add_new_category' );
/**
 * Add new colopicker field to "Edit Category" screen
 * - https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/
 *
 * @param WP_Term_Object $term
 *
 * @return void
 */
function colorpicker_field_edit_category( $term ) {
    $color = get_term_meta( $term->term_id, 'category_color', true );
    $color = ( ! empty( $color ) ) ? "#{$color}" : '#f20e00';
  ?>
    <tr class="form-field term-colorpicker-wrap">
        <th scope="row"><label for="term-colorpicker">Color de categoria</label></th>
        <td>
            <input name="category_color" value="<?php echo $color; ?>" class="colorpicker" id="term-colorpicker" />
            <p class="description">Asigna el color de fondo para la categoria, por defecto es el color principal de la identidad del sitio.</p>
        </td>
    </tr>
  <?php
}
add_action( 'category_edit_form_fields', 'colorpicker_field_edit_category' );
add_action( 'post_tag_edit_form_fields', 'colorpicker_field_edit_category' );
add_action( 'theme_edit_form_fields', 'colorpicker_field_edit_category' );
add_action( 'fuente_edit_form_fields', 'colorpicker_field_edit_category' );

/**
 * Term Metadata - Save Created and Edited Term Metadata
 * - https://developer.wordpress.org/reference/hooks/created_taxonomy/
 * - https://developer.wordpress.org/reference/hooks/edited_taxonomy/
 *
 * @param Integer $term_id
 *
 * @return void
 */
function save_termmeta( $term_id ) {
    // Save term color if possible
    if( isset( $_POST['category_color'] ) && ! empty( $_POST['category_color'] ) ) {
        update_term_meta( $term_id, 'category_color', sanitize_hex_color_no_hash( $_POST['category_color'] ) );
    } else {
        delete_term_meta( $term_id, 'category_color' );
    }
}
add_action( 'created_category', 'save_termmeta' );
add_action( 'created_post_tag', 'save_termmeta' );
add_action( 'created_theme', 'save_termmeta' );
add_action( 'created_fuente', 'save_termmeta' );

add_action( 'edited_category',  'save_termmeta' );
add_action( 'edited_post_tag',  'save_termmeta' );
add_action( 'edited_theme',  'save_termmeta' );
add_action( 'edited_fuente',  'save_termmeta' );

/**
 * Enqueue colorpicker styles and scripts.
 * - https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
 *
 * @return void
 */
function category_colorpicker_enqueue( $taxonomy ) {

    if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
        return;
    }

    // Colorpicker Scripts
    wp_enqueue_script( 'wp-color-picker' );

    // Colorpicker Styles
    wp_enqueue_style( 'wp-color-picker' );

}
add_action( 'admin_enqueue_scripts', 'category_colorpicker_enqueue' );


/**
 * Print javascript to initialize the colorpicker
 * - https://developer.wordpress.org/reference/hooks/admin_print_scripts/
 *
 * @return void
 */
function colorpicker_init_inline() {

    if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id && 'edit-post_tag' !== $screen->id && 'edit-theme' !== $screen->id && 'edit-fuente' !== $screen->id ) {
        return;
    }

  ?>

    <script>
        jQuery( document ).ready( function( $ ) {

            $( '.colorpicker' ).wpColorPicker();

        } ); // End Document Ready JQuery
    </script>

  <?php

}
add_action( 'admin_print_scripts', 'colorpicker_init_inline', 20 );