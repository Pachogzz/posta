<?php $batch = get_field('descargas_relacionadas_batch'); ?>

<?php if(!empty($batch[0])){ ?>
  <h4>Documentos relacionados</h4>
  <ul class="listado-documentos-relacionados">
    <?php
    foreach ($batch as $k => $v) {
      $re  = '<li><a target="_blank" href="';
      $re .= $v['archivo_batch'];
      $re .= '"></i>';
      $re .= $v['title_batch'];
      $re .= '</a></li>';
      echo $re;
    }
    ?>
  </ul>
<?php } ?>