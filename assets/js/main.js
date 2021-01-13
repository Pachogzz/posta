/*
 * Inicializar menu lateral oculto
 **/
window.onclick = function(event){
	if(event.target == document.getElementById('outerNav')){
		closeNav();
	}
};

function openNav() {
	document.getElementById("outerNav").style.display = "block";
	document.getElementById("outerNav").style.opacity = "1";
	document.getElementById("mySidenav").style.opacity = "1";
}

function closeNav() {
	document.getElementById("outerNav").style.opacity = "0";
	document.getElementById("mySidenav").style.opacity = "0";
	setTimeout(function(){
			document.getElementById("outerNav").style.display = "none";
	},500);
}

/*
 * Inicializar tooltips
 **/
$(function() {
	$('[data-toggle="tooltip"]').tooltip()
})

// ---------------------------------------------------------------

/*
 * Script used to set full screen heigth
 **/
$(window).on('load', function() {
	if ($(window).width() > 1024) {
		$('.contenedor-carrusel-portada').addClass('embed-responsive');
		$('.contenedor-carrusel-portada').css('height', $(window).height() - 266);
	} else {
		$('.contenedor-carrusel-portada > .fat-img').removeClass('hidden');
	}
});

// ---------------------------------------------------------------

/*
 * Autocollapse del menú principal
 **/
var autocollapse = function(menu, maxHeight) {

	var nav = $(menu);
	var navHeight = nav.innerHeight();
	if (navHeight >= maxHeight) {

		$(menu + ' .dropdown').removeClass('d-none');
		$(".navbar-nav").removeClass('w-auto').addClass("w-100");

		while (navHeight > maxHeight) {
			//  add child to dropdown
			var children = nav.children(menu + ' li:not(:last-child)');
			var count = children.length;
			$(children[count - 1]).prependTo(menu + ' .dropdown-menu');
			navHeight = nav.innerHeight();
		}
		$(".navbar-nav").addClass("w-auto").removeClass('w-100');

	} else {

		var collapsed = $(menu + ' .dropdown-menu').children(menu + ' li');

		if (collapsed.length === 0) {
			$(menu + ' .dropdown').addClass('d-none');
		}

		while (navHeight < maxHeight && (nav.children(menu + ' li').length > 0) && collapsed.length > 0) {
			//  remove child from dropdown
			collapsed = $(menu + ' .dropdown-menu').children('li');
			$(collapsed[0]).insertBefore(nav.children(menu + ' li:last-child'));
			navHeight = nav.innerHeight();
		}

		if (navHeight > maxHeight) {
			autocollapse(menu, maxHeight);
		}

	}
};

$(document).ready(function() {

	// when the page loads
	autocollapse('#menu-menu-principal', 50);

	// when the window is resized
	$(window).on('resize', function() {
		autocollapse('#menu-menu-principal', 50);
	});

});

// ---------------------------------------------------------------
/*
 * Target first element of Archive page loop to change the classes
 **/
jQuery(document).ready(function() {
	$( "#ajax-posts .bloque-nota-archivo" ).first().removeClass('col-md-6 col-lg-4').addClass('col-12');
	$( ".carrusel-portada-verticales" ).parent().addClass('vh-70');
	$( ".carrusel-portada-verticales" ).addClass('h-100');
	$( ".carrusel-portada-verticales .owl-stage-outer" ).addClass('h-100');
	$( ".carrusel-portada-verticales .owl-stage" ).addClass('h-100');
	$( ".carrusel-portada-verticales .owl-stage .owl-item" ).addClass('h-100');
	$( ".carrusel-portada-verticales .owl-stage .owl-item > div" ).addClass('h-100');
	$( ".carrusel-portada-verticales .owl-stage .owl-item > div .contenedor-media" ).addClass('h-100');
	$( ".carrusel-portada-verticales .owl-stage .owl-item > div .contenedor-media .link-a-nota" ).addClass('h-100');
	
	$( ".carrusel-portada-cuadricula .owl-stage .owl-item:not(.active)" ).remove();
	$( ".carrusel-portada-cuadricula" ).parent().addClass('vh-70');
	$( ".carrusel-portada-cuadricula" ).addClass('h-100');
	$( ".carrusel-portada-cuadricula .owl-stage-outer" ).addClass('h-100');
	$( ".carrusel-portada-cuadricula .owl-stage" ).addClass('row mx-0 h-100 w-100');

	$( ".carrusel-portada-cuadricula .owl-stage > .owl-item.active" ).addClass('h-100');
	$( ".carrusel-portada-cuadricula .owl-stage .owl-item.active" ).addClass('col-md-6 mx-0 px-0');
	$( ".carrusel-portada-cuadricula .owl-stage > .owl-item.active ~ .owl-item.active" ).addClass('h-50').removeClass('h-100');
	$( ".carrusel-portada-cuadricula .owl-stage .owl-item.active:nth-child(3)" ).addClass('last');

	$( ".carrusel-portada-cuadricula .owl-stage .owl-item > div" ).addClass('mx-0 px-0 h-100');
	$( ".carrusel-portada-cuadricula .owl-stage .owl-item > div .contenedor-media" ).addClass('h-100');
	$( ".carrusel-portada-cuadricula .owl-stage .owl-item > div .contenedor-media .link-a-nota" ).addClass('h-100');
	
});

// ---------------------------------------------------------------
/*
 * Function to change classes in default WordPress page to Bootstrap classes
 **/

$(document).ready(function() {

	$(".paginacion .pagination .page-item .page-numbers").addClass("page-link");
	$(".paginacion .pagination .page-item .page-link").removeClass("page-numbers");

	if ($(".pagination .page-item .page-link").hasClass("current")) {
		$(".pagination .page-item .current").addClass("active");
	}
});

/*
 *Function to remove the attribute of the links in the carousel images, custom banner and custom banner
 */
$(document).ready(function() {
	// var att = document.getElementById("url-img");
	//att.removeAttribute('href');
	var ver = $("#url-img").attr("href");
	console.log(ver);

});

// ---------------------------------------------------------------

/*
 * Script used to share post
 **/
$('.btnsf').click(function() {
	var excerpt = '';
	var link = '';
	var img = '';
	excerpt = $(this).data('excerpt');
	link = $(this).data('link');
	img = $(this).data('img');
	var url = "https://www.facebook.com/dialog/share?" + "app_id=1223449614698305" + "&quote=" + encodeURIComponent(excerpt) + "&href=" + encodeURIComponent(link) + "&picture=" + encodeURIComponent(img);
	window.open(url, "_blank", "width=550, height=450");
});
$('.btnst').click(function() {
	var title = '';
	var link = '';
	title = $(this).data('title');
	link = $(this).data('link');
	window.open("https://twitter.com/intent/tweet?" + "text=" + encodeURIComponent(title) + "&url=" + encodeURIComponent(link), "_blank", "width=550, height=320");
});

// ---------------------------------------------------------------

/*
 * Script used to display media file types
 * (1)
 **/
$('.media_file').click(function() {
	$('#media_container').html($(this).data('media'));
	$('.titulo_yt').html($(this).data('titulo'));
	$('#mediaFileTypesModal').modal('show');
});

// Show the modal and add the player
$('.media_file_jw').click(function() {
	$('.titulo_jw').html($(this).data('titulo'));
	$('#mediaFileTypesModal_jw').modal('show');
	const player = jwplayer("my-video").setup({
		autostart: false,
		file: $(this).data('video'),
		image: $(this).data('img'),
		primary: "video",
		controls: true,
		autostart: "viewable",
		mute: false,
	});
	/*const bumpIt = () => {
		const vol = player.getVolume();
		player.setVolume(vol + 10);
		player.setConfig({

		});
	}*/
	player.play();
	//bumpIt();
});



/*
 * This script works like the first but I added to fix the no working when loading more content with ajax calls in HOME PAGE TEMPLATE
 * (2)
 **/
$('.container-lg').on('click', '.media_file', function() {
	$('#media_container').html($(this).data('media'));
	$('#mediaFileTypesModal').modal('show');
});

/*
 * Script used to remove content from media modal
 **/
$('#mediaFileTypesModal').on('hidden.bs.modal', function(e) {
	$('#mediaFileTypesModal > .modal-dialog > .modal-content > .modal-body > .container-fluid > .row').html('');
});

// ---------------------------------------------------------------

/*
 * Scripts used to add data to the share buttons in shareModals
 * (1)
 **/
$('.share-from-modal').click(function() {
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-title', $(this).data('title'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-excerpt', $(this).data('excerpt'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-link', $(this).data('link'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-img', $(this).data('img'));

	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-title', $(this).data('title'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-excerpt', $(this).data('excerpt'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-link', $(this).data('link'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-img', $(this).data('img'));

	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsw').attr('href', 'https://api.whatsapp.com/send?text=' + $(this).data('link'));

	$('#shareModal').modal('show');
});

/*
 * This is script works like the first but I added to fix the no working when loading more content with ajax calls in HOME PAGE TEMPLATE
 * (2)
 **/
$('.container-lg').on('click', '.share-from-modal', function() {
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-title', $(this).data('title'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-excerpt', $(this).data('excerpt'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-link', $(this).data('link'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-img', $(this).data('img'));

	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-title', $(this).data('title'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-excerpt', $(this).data('excerpt'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-link', $(this).data('link'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-img', $(this).data('img'));

	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsw').attr('href', 'https://api.whatsapp.com/send?text=' + $(this).data('link'));

	$('#shareModal').modal('show');
});

/*
 * This is script works like the second but I added to fix the no working when loading more content with ajax calls in CATEGORY FILES
 * (3)
 **/
$('#ajax-posts').on('click', '.share-from-modal', function() {
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-title', $(this).data('title'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-excerpt', $(this).data('excerpt'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-link', $(this).data('link'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-img', $(this).data('img'));

	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-title', $(this).data('title'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-excerpt', $(this).data('excerpt'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-link', $(this).data('link'));
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-img', $(this).data('img'));

	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsw').attr('href', 'https://api.whatsapp.com/send?text=' + $(this).data('link'));

	$('#shareModal').modal('show');
});

/*
 * This script is used to remove attr data values from share icons in share modal
 **/
$('#shareModal').on('hidden.bs.modal', function(e) {
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-title', '');
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-excerpt', '');
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-link', '');
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsf').attr('data-img', '');

	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-title', '');
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-excerpt', '');
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-link', '');
	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnst').attr('data-img', '');

	$('#shareModal > .modal-dialog > .modal-content > .modal-body > .btnsw').attr('href', 'javascript:void(0)');
});

// ---------------------------------------------------------------

/*
 * Add classes to taxonomy lists on archive templates
 **/
$('#term-list-filter .nav-item > a').addClass('badge badge-primary rounded-pill py-2 px-3');

/*
 * Parámetros para carruseles
 **/
$('.movile-slider').owlCarousel({
	mouseDrag: true,
	loop: true,
	dots: true,
	nav: true,
	navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
	margin: 30,
	responsiveClass: true,
	// autoplay: false,
	// autoplayTimeout: 12000,
	// items: 1,
	responsive: {
		0: {
			items: 1
		},
		768: {
			items: 2
		},
		992: {
			items: 3
		}
	}
});
$('.carrusel-portada').owlCarousel({
	mouseDrag: false,
	loop: true,
	dots: false,
	nav: true,
	navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
	margin: 0,
	responsiveClass: true,
	autoplay: false,
	autoplayTimeout: 12000,
	items: 1,
});
$('.carrusel-portada-simple').owlCarousel({
	mouseDrag: false,
	loop: true,
	dots: false,
	nav: true,
	navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
	margin: 0,
	responsiveClass: true,
	autoplayTimeout: 12000,
	items: 1,
});
$('.carrusel-portada-verticales').owlCarousel({
	mouseDrag: false,
	loop: true,
	dots: false,
	nav: true,
	navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
	margin: 0,
	responsiveClass: true,
	autoplayTimeout: 8000,
	responsive: {
		0: {
			items: 1
		},
		768: {
			items: 2
		},
		992: {
			items: 3,
		}
	}
});
$('.carrusel-portada-cuadricula').owlCarousel({
	mouseDrag: false,
	loop: false,
	dots: false,
	nav: false,
	// navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
	margin: 0,
	responsiveClass: true,
	// autoplayTimeout: 8000,
	items: 3
});
$('.carrusel-opinion').owlCarousel({
	mouseDrag: false,
	loop: true,
	dots: true,
	nav: true,
	navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
	margin: 50,
	responsiveClass: true,
	autoplay: true,
	autoplayTimeout: 10000,
	responsive: {
		0: {
			items: 1
		},
		768: {
			items: 2
		},
		992: {
			items: 4,
			loop: false,
			autoplay: false
		}
	}
});
$('.carrusel-imagenes').owlCarousel({
	mouseDrag: false,
	autoHeight: true,
	loop: true,
	dots: true,
	nav: true,
	navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
	margin: 0,
	responsiveClass: true,
	autoplay: false,
	items: 1
});
$('.carrusel-tipo-uno').owlCarousel({ //antes .carousel-style-one
	mouseDrag: false,
	loop: false,
	dots: false,
	nav: true,
	navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
	margin: 0,
	responsiveClass: true,
	items: 1
});
$('.carrusel-tipo-dos').owlCarousel({ //antes .carousel-style-two
	mouseDrag: false,
	loop: false,
	dots: false,
	nav: true,
	navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
	margin: 20,
	responsiveClass: true,
	responsive: {
		0: {
			items: 1
		},
		768: {
			items: 2
		}
	}
});
$('.carrusel-tipo-tres').owlCarousel({ //antes .carousel-style-three
	mouseDrag: false,
	loop: false,
	dots: false,
	nav: true,
	navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
	margin: 20,
	responsiveClass: true,
	responsive: {
		0: {
			items: 1
		},
		768: {
			items: 2
		},
		992: {
			items: 3
		}
	}
});
$('.carrusel-tipo-cuatro').owlCarousel({ //antes .carousel-style-four
	mouseDrag: false,
	loop: false,
	dots: false,
	nav: true,
	navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
	margin: 20,
	responsiveClass: true,
	responsive: {
		0: {
			items: 1
		},
		468: {
			items: 2
		},
		768: {
			items: 3
		},
		992: {
			items: 4
		}
	}
});