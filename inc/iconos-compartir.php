<!-- Iconos para compartir contenido -->
<div class="lista-iconos">
  <a href="javascript:void(0)" class="btnsf icono icono-posta" data-title="<?php the_title(); ?>" data-excerpt="" data-link="<?php the_permalink(); ?>" data-img="<?php echo get_the_post_thumbnail_url(get_the_ID(),'1100x618'); ?>"><i class="fab fa-facebook-f"></i></a>
  <a href="javascript:void(0)" class="btnst icono icono-posta" data-title="<?php the_title(); ?>" data-link="<?php the_permalink(); ?>"><i class="fab fa-twitter"></i></a>
  <a href="https://api.whatsapp.com/send?text=<?php the_permalink(); ?>" class="btnsw icono icono-posta" target="_blank"><i class="fab fa-whatsapp"></i></a>
</div>