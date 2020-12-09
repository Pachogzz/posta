<?php 
/**
 * Template part for displaying  carousel collection
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 * 
 */

$category_id = get_field('slider_3_posts_verticales');
$section_name = get_term_by('id', $category_id, 'category'); // Nombre de la sección
$category_link = get_category_link($category_id); // Link de la sección
$category_description = category_description($category_id); // Descripción de la sección*/

?>

<div class="container-fluid mb-6">
	<div class="row">

	<?php
	if( $category_id ): ?>
	    <?php foreach( $category_id as $post ): 

	        // Setup this post for WP functions (variable must be named $post).
	        setup_postdata($post); ?>
	        <div class="col bg-primary py-5 px-3" style="background: url('http://fakeimg.pl/1980x1080/111/222/?text=Slide+1') center center no-repeat;">
	            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	            <span>A custom field from this post: <?php the_field( 'field_name' ); ?></span>
	        </li>
	    <?php endforeach; ?>
	    <?php 
	    // Reset the global post object so that the rest of the page works correctly.
	    wp_reset_postdata(); ?>
	<?php endif; ?>

		<div class="col bg-primary py-5 px-3" style="background: url('http://fakeimg.pl/1980x1080/111/222/?text=Slide+1') center center no-repeat;">
			<span class="d-block text-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis cupiditate tempora voluptates saepe eaque, nisi corporis mollitia illo temporibus odit modi excepturi esse ullam perspiciatis, voluptatem hic iusto soluta provident qui, veniam sint totam omnis animi nemo dolore. Amet ea ex tenetur similique asperiores rem vel consequuntur dolorum autem cupiditate.</span>
		</div>
	</div>
</div>	