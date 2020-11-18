<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package postamx
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main py-7 py-md-9">

			<div class="container container-lg">

				<!-- Título de página -->
        <div class="row">
          <div class="col text-center">
            <h2>
              <?php
								// translators: %s: search query.
								printf( esc_html__( 'Lista de resultados para: %s', 'postamx' ), '<br><span class="texto-amarillo">' . get_search_query() . '</span>' );
							?>
            </h2>
          </div>
        </div>
				
				<div id="ajax-posts" class="row category-<?php echo esc_html($category_slug); ?>  mt-7">
					<?php
						if ( have_posts() ) :
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 **/
								get_template_part( 'template-parts/content', 'search' );
							endwhile;
							the_posts_navigation();
						endif;
					?>
				</div>

				<!-- *botón cargar notas por ajax -->
        <!-- <div class="row mt-3">
          <div class="col text-center">
            <button id="more_posts" class="btn btn-secondary in-line" data-category="<?php echo $cat_id; ?>">
              Cargar mas notas
            </button>
            <div class="ajax-response-failed"></div>
            <i class="fas fa-circle-notch fa-spin hidden spinner load-<?php echo $category_id; ?>"></i>
          </div>
        </div> -->

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();