<?php
  $links = get_field('btn_links');
  $module = get_field('modulo_destacado');
?>

<!-- Módulo destacado -->
<?php if (!empty($module['titulo']) && !empty($module['descripcion']) && !empty($module['url']) && !empty($module['titulo_de_enlace'])): ?>
  <div class="card border-0 bg-primary text-white">
    <div class="card-body">
      <h6 class="card-subtitle mb-2"><?php echo $module['titulo']; ?></h6>
      <h3 class="card-title"><?php echo $module['descripcion']; ?></h3>
      <a href="<?php echo $module['url']; ?>" class="btn btn-secondary btn-block" <?php if ($module['nueva_ventana']) { echo 'target="_blank"'; } ?>><?php echo $module['titulo_de_enlace']; ?></a>
    </div>
  </div>
<?php endif; ?>

<div class="separador"></div>

<!-- Navegación interna -->
<?php  if(!empty($links[0])){ ?>
  <div>
    <?php
      foreach ($links as $k => $v) {
        $re  = '<a href="';
        $re .= $v['btn_url'];
        $re .= '"class="btn btn-outline-light btn-block"';
        if ($v['nueva_ventana']) {
          $re.= 'target="_blank"';
        }
        $re .= ">";
        $re .= $v['btn_title_link'];
        $re .= '</a>';
        echo $re;
      }
    ?>
  </div>
<?php } ?>