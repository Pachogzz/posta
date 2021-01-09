// ---------------------------------------------------------------
/*
 * Target first element of Archive page loop to change the classes
 **/
jQuery(document).ready(function() {
	// 2_bb_4_4
	$( ".bloque_notas--2_bb_4_4 .nota:nth-child(1)" ).first().removeClass('col-lg-3').addClass('large');

	// 2_hp_3_4
	$( ".bloque_notas--2_hp_3_4 .inner-row .nota" ).first().removeClass('col-lg-4').addClass('col-lg-8 large');

	// billb_1_2_4
	$( ".bloque_notas--billb_1_2_4 .nota:nth-child(3)" ).removeClass('col-lg-3').addClass('col-lg-6 large');
	$( ".bloque_notas--billb_1_2_4 .nota:nth-child(4)" ).removeClass('col-lg-3').addClass('col-lg-6 large');

	// 1-3_2_4
	$( ".bloque_notas--1-3_2_4 .nota:nth-child(1)" ).removeClass('col-lg-3').addClass('col-lg-9 large');
	$( ".bloque_notas--1-3_2_4 .nota:nth-child(3)" ).removeClass('col-lg-3').addClass('col-lg-6 large');
	$( ".bloque_notas--1-3_2_4 .nota:nth-child(4)" ).removeClass('col-lg-3').addClass('col-lg-6 large');
	
	// 1_4_4
	$( ".bloque_notas--1_4_4 .nota:nth-child(1)" ).removeClass('col-md-6 col-lg-3').addClass('large');

	// 1_2_4
	$( ".bloque_notas--1_2_4 .nota:nth-child(1)" ).removeClass('col-md-6 col-lg-3').addClass('large');
	$( ".bloque_notas--1_2_4 .nota:nth-child(2)" ).removeClass('col-lg-3').addClass('col-lg-6 large');
	$( ".bloque_notas--1_2_4 .nota:nth-child(3)" ).removeClass('col-lg-3').addClass('col-lg-6 large');

	// 2_bb_3_4_x
	$( ".bloque_notas--2_bb_3_4_r .nota" ).first().addClass('large');
	$( ".bloque_notas--2_bb_3_4_l .inner-row .nota" ).first().addClass('large');

	// 2_2_bb_4
	$( ".bloque_notas--2_2_bb_4 .inner-row .nota:nth-child(1)" ).first().removeClass('col-md-6').addClass('large');

	// Removing extra classes to movile sliders
});
