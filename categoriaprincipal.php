<?php
// // ============ Categoria Principal
// function categoriaprincipal() {
//     add_meta_box( 'categoriaprincipal-meta-box-id', esc_html__( 'Categoria Principal', 'text-domain' ), 'categoriaprincipal_campos', 'post', 'side', 'low' );
// }
// add_action( 'add_meta_boxes', 'categoriaprincipal');


// // Campos de la Nota Configuracion
// function categoriaprincipal_campos($meta_id){
// 	// meta box de posts
// 	$posts = get_terms('category');	
//     $categoria = get_post_custom();

//     if (!empty($categoria['categoria_principal'][0])) {
//         $cat = $categoria['categoria_principal'][0];
//     }

?>
	<!-- <select name="categoria_principal" id="categoria_principal">
        <option value="">Sin Categoria</option>
        </?php foreach ($posts as $post): ?>
            </?php $name = $post->name . "-" . $post->term_id; ?>
            <option value="</?php echo $post->name . "-" . $post->term_id; ?>" </?php if($cat == $name) echo 'selected="selected"'; ?>>
                </?php echo $post->name; ?>
            </option>
        </?php endforeach ?>
    </select> -->

<?php 
// }


// function categoriaprincipal_save($post_id) {
//     // Checks save status
//     $is_autosave = wp_is_post_autosave( $post_id );
//     $is_revision = wp_is_post_revision( $post_id );
//     $is_valid_nonce = ( isset( $_POST[ 'categoria_principal_nonce' ] ) && wp_verify_nonce( $_POST[ 'categoria_principal_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
//     // Exits script depending on save status
//     if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
//         return;
//     }
  
//     //Guardar datos de Souncloud
//     if (!empty($_POST['categoria_principal'])) {
//         update_post_meta($post_id, 'categoria_principal', $_POST['categoria_principal']);
//     }
    
// }
// add_action( 'save_post', 'categoriaprincipal_save' );