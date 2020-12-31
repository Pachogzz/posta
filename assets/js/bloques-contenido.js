// ---------------------------------------------------------------
/*
 * Target first element of Archive page loop to change the classes
 **/
jQuery(document).ready(function() {
	$( ".bloque_notas--2_bb_4_4 .nota" ).first().removeClass('col-lg-3').addClass('large');	
	$( ".bloque_notas--2_bb_4_4 .nota.large" ).append("<div class='imagen-nota-container'></div>");
	$( ".bloque_notas--2_bb_4_4 .nota.large .imagen-nota" ).prependTo( ".bloque_notas--2_bb_4_4 .imagen-nota-container" );
	$( ".bloque_notas--2_bb_4_4 .nota.large .titulo-nota" ).addClass('text-white').appendTo( ".bloque_notas--2_bb_4_4 .imagen-nota-container" );
});
