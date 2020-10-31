<?php $links = get_field('enlaces'); ?>

<?php  if(!empty($links[0])){ ?>
  <h4>Enlaces relacionados</h4>
  <ul>
    <?php
      foreach ($links as $k => $v) {
        $re  = '<li><a href="';
        $re .= $v['url'];
        $re .= '">';
        $re .= $v['title_link'];
        $re .= '</a></li>';
        echo $re;
      }
    ?>
  </ul>
<?php } ?>