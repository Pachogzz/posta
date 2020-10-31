<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package posta
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main py-7 py-md-10">

			<div class="container container-lg<<<">
				<div class="row">
					<div class="col text-center">
						<h2><?php esc_html_e( 'Esta página no puede ser encontrada.', 'posta' ); ?></h2>
						<p><?php esc_html_e( 'Parece que no se encontró nada en esta ubicación.', 'posta' ); ?></p>
					</div>
				</div>
			</div><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
