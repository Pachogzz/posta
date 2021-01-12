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
add_action( 'category_add_form_fields', 'colorpicker_field_add_new_category' );  // Variable Hook Name
add_action( 'post_tag_add_form_fields', 'colorpicker_field_add_new_category' );  // Variable Hook Name
add_action( 'theme_add_form_fields', 'colorpicker_field_add_new_category' );  // Variable Hook Name
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
add_action( 'category_edit_form_fields', 'colorpicker_field_edit_category' );   // Variable Hook Name
add_action( 'post_tag_edit_form_fields', 'colorpicker_field_edit_category' );   // Variable Hook Name
add_action( 'theme_edit_form_fields', 'colorpicker_field_edit_category' );   // Variable Hook Name

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
add_action( 'created_category', 'save_termmeta' );  // Variable Hook Name
add_action( 'created_post_tag', 'save_termmeta' );  // Variable Hook Name
add_action( 'created_theme', 'save_termmeta' );  // Variable Hook Name
add_action( 'edited_category',  'save_termmeta' );  // Variable Hook Name
add_action( 'edited_post_tag',  'save_termmeta' );  // Variable Hook Name
add_action( 'edited_theme',  'save_termmeta' );  // Variable Hook Name

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

    if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id && 'edit-post_tag' !== $screen->id && 'edit-theme' !== $screen->id ) {
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

/****************************************************************
*                                                               *
*                      IMAGE IN TAXONOMY                        *
*                                                               *
****************************************************************/

/**
 * Plugin class
 **/
if ( ! class_exists( 'cpt_tax_meta' ) ) {

class cpt_tax_meta {

  public function __construct() {
    //
  }
 
 /*
  * Initialize the class and start calling our hooks and filters
  * @since 1.0.0
 */
 public function init() {
   add_action( 'columnista_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
   add_action( 'created_columnista', array ( $this, 'save_category_image' ), 10, 2 );
   add_action( 'columnista_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
   add_action( 'edited_columnista', array ( $this, 'updated_category_image' ), 10, 2 );
   add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
   add_action( 'admin_footer', array ( $this, 'add_script' ) );
 }

public function load_media() {
 wp_enqueue_media();
}
 
 /*
  * Add a form field in the new category page
  * @since 1.0.0
 */
 public function add_category_image ( $taxonomy ) { ?>
   <div class="form-field term-group">
     <label for="category-image-id"><?php _e('Image', 'posta'); ?></label>
     <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
     <div id="category-image-wrapper"></div>
     <p>
       <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Agregar imagen', 'posta' ); ?>" />
       <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remover imagen', 'posta' ); ?>" />
    </p>
   </div>
 <?php
 }
 
 /*
  * Save the form field
  * @since 1.0.0
 */
 public function save_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
     $image = $_POST['category-image-id'];
     add_term_meta( $term_id, 'category-image-id', $image, true );
   }
 }
 
 /*
  * Edit the form field
  * @since 1.0.0
 */
 public function update_category_image ( $term, $taxonomy ) { ?>
   <tr class="form-field term-group-wrap">
     <th scope="row">
       <label for="category-image-id"><?php _e( 'Image', 'posta' ); ?></label>
     </th>
     <td>
       <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
       <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
       <div id="category-image-wrapper">
         <?php if ( $image_id ) { ?>
           <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
         <?php } ?>
       </div>
       <p>
         <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Agregar imagen', 'posta' ); ?>" />
         <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remover imagen', 'posta' ); ?>" />
       </p>
     </td>
   </tr>
 <?php
 }

/*
 * Update the form field value
 * @since 1.0.0
 */
 public function updated_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
     $image = $_POST['category-image-id'];
     update_term_meta ( $term_id, 'category-image-id', $image );
   } else {
     update_term_meta ( $term_id, 'category-image-id', '' );
   }
 }

/*
 * Add script
 * @since 1.0.0
 */
 public function add_script() { ?>
   <script>
     jQuery(document).ready( function($) {
       function ct_media_upload(button_class) {
         var _custom_media = true,
         _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if ( _custom_media ) {
               $('#category-image-id').val(attachment.id);
               $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
             } else {
               return _orig_send_attachment.apply( button_id, [props, attachment] );
             }
            }
         wp.media.editor.open(button);
         return false;
       });
     }
     ct_media_upload('.ct_tax_media_button.button'); 
     $('body').on('click','.ct_tax_media_remove',function(){
       $('#category-image-id').val('');
       $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
     });
     // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
     $(document).ajaxComplete(function(event, xhr, settings) {
       var queryStringArr = settings.data.split('&');
       if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
         var xml = xhr.responseXML;
         $response = $(xml).find('term_id').text();
         if($response!=""){
           // Clear the thumb image
           $('#category-image-wrapper').html('');
         }
       }
     });
   });
 </script>
 <?php }

  }
 
$cpt_tax_meta = new cpt_tax_meta();
$cpt_tax_meta -> init();
 
}