<?php
  /*Template Name: Template Default*/
  get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">
    <div class="container bg-white mt-6 p-6">
      <div class="row">
        <div class="col">
          <h1 class="titulo-pagina mb-6"><?php the_title(); ?></h1>
          <?php
            /* Start the Loop */
            while( have_posts() ) : the_post();
              the_content();
            endwhile;
          ?>
        </div>
      </div>
    </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
  get_footer();
?>