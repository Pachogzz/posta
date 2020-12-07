<div class="wrap">
  
  <?php settings_errors() ?>
  
  <h1>Configuraciónes de la App Posta</h1>

  <form method="post" action="options.php">
    <?php settings_fields( 'example-settings-group' ); ?>
    <?php do_settings_sections( 'example-settings-group' ); ?>
    <?php submit_button(); ?>
  </form>
  
</div>