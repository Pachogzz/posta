<?php
  /*Template Name: PRUEBAS UNICAMENTE*/
  get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">
    <div class="container bg-white mt-6 p-6">
      <div class="row">
        
        <div class="col mb-3">
          <h1 class="titulo-pagina mb-6"><?php the_title(); ?></h1>
          <?php
            /* Start the Loop */
            while( have_posts() ) : the_post();
              the_content();
            endwhile;
          ?>
        </div> <!-- ./The Content -->

        <hr>

        <div class="col-12 border mb-3">
          <script>
            window.googletag = window.googletag || {cmd: []};
            googletag.cmd.push(function() {
              googletag.defineSlot('/90573685/overmenu_desktop', [[970, 90], [970, 250], [728, 90], [640, 200]], 'div-gpt-ad-1610518689409-0').addService(googletag.pubads());
              // googletag.pubads().enableSingleRequest();
              googletag.enableServices();
            });
          </script>
          <!-- /90573685/overmenu_desktop -->
          <div id='div-gpt-ad-1610518689409-0' class="mx-auto">
            <script>
              googletag.cmd.push(function() { googletag.display('div-gpt-ad-1610518689409-0'); });
            </script>
          </div>
        </div>

        <hr>

        <div class="col-12 border mb-3">
          <script>
            window.googletag = window.googletag || {cmd: []};
            googletag.cmd.push(function() {
              googletag.defineSlot('/90573685/M320x50', [320, 50], 'div-gpt-ad-1611166209930-0').addService(googletag.pubads());
              // googletag.pubads().enableSingleRequest();
              googletag.enableServices();
            });
          </script>
          <!-- /90573685/M320x50 -->
          <div id='div-gpt-ad-1611166209930-0' class="mx-auto" style='width: 320px; height: 50px;'>
            <script>
              googletag.cmd.push(function() { googletag.display('div-gpt-ad-1611166209930-0'); });
            </script>
          </div>
        </div>

        <hr>

        <div class="col-12 border mb-3">
          <script>
            window.googletag = window.googletag || {cmd: []};
            googletag.cmd.push(function() {
              googletag.defineSlot('/90573685/Leaderboard_home_728x90_970x90', [[970, 90], [728, 90], [640, 200]], 'div-gpt-ad-1610518252679-0').addService(googletag.pubads());
              // googletag.pubads().enableSingleRequest();
              googletag.enableServices();
            });
          </script>

          <!-- /90573685/Leaderboard_home_728x90_970x90 -->
          <div id='div-gpt-ad-1610518252679-0'>
            <script>
              googletag.cmd.push(function() { googletag.display('div-gpt-ad-1610518252679-0'); });
            </script>
          </div>
        </div>

        <hr>

        <div class="col-12 border mb-3">
          <script>
            window.googletag = window.googletag || {cmd: []};
            googletag.cmd.push(function() {
              googletag.defineSlot('/90573685/leaderboard_home_2_728x90_970x90', [[728, 90], [970, 90], [640, 200]], 'div-gpt-ad-1610518319668-0').addService(googletag.pubads());
              // googletag.pubads().enableSingleRequest();
              googletag.enableServices();
            });
          </script>

          <!-- /90573685/leaderboard_home_2_728x90_970x90 -->
          <div id='div-gpt-ad-1610518319668-0'>
            <script>
              googletag.cmd.push(function() { googletag.display('div-gpt-ad-1610518319668-0'); });
            </script>
          </div>
        </div>

        <hr>
        
        <div class="col-12 border mb-3">
          <script>
            window.googletag = window.googletag || {cmd: []};
            googletag.cmd.push(function() {
              googletag.defineSlot('/90573685/Leaderboard_home_3', [[970, 90], [728, 90], [640, 200]], 'div-gpt-ad-1610518358790-0').addService(googletag.pubads());
              // googletag.pubads().enableSingleRequest();
              googletag.enableServices();
            });
          </script>

          <!-- /90573685/Leaderboard_home_3 -->
          <div id='div-gpt-ad-1610518358790-0'>
            <script>
              googletag.cmd.push(function() { googletag.display('div-gpt-ad-1610518358790-0'); });
            </script>
          </div>
        </div>

        <hr>

        <div class="col-12 border mb-3">
          <script>
            window.googletag = window.googletag || {cmd: []};
            googletag.cmd.push(function() {
              googletag.defineSlot('/90573685/Leaderboard_home_4_970x90_728x90', [[728, 90], [970, 90], [640, 200]], 'div-gpt-ad-1610518469085-0').addService(googletag.pubads());
              // googletag.pubads().enableSingleRequest();
              googletag.enableServices();
            });
          </script>

          <!-- /90573685/Leaderboard_home_4_970x90_728x90 -->
          <div id='div-gpt-ad-1610518469085-0'>
            <script>
              googletag.cmd.push(function() { googletag.display('div-gpt-ad-1610518469085-0'); });
            </script>
          </div>
        </div>

      </div>
    </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
  get_footer();
?>