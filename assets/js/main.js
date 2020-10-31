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
        //$('.contenedor-carrusel-portada').addClass('embed-responsive embed-responsive-16by9');
        //$('.contenedor-carrusel-portada > .fat-img').addClass('embed-responsive-item');
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
    // var url = "https://www.facebook.com/dialog/share?"+"app_id=379171302612930"+"&quote="+encodeURIComponent(excerpt)+"&href="+encodeURIComponent(link)+"&picture="+encodeURIComponent(img);
    var url = "https://www.facebook.com/dialog/share?" + "app_id=388347495415603" + "&quote=" + encodeURIComponent(excerpt) + "&href=" + encodeURIComponent(link) + "&picture=" + encodeURIComponent(img);
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

//show the modal and add  the reprodoctur of jwplayer
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
 * Parámetros para carruseles
 **/
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
$('.carrusel-tipo-uno').owlCarousel({ //antes .carousel-style-three
    mouseDrag: false,
    loop: false,
    dots: false,
    nav: true,
    navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
    margin: 0,
    responsiveClass: true,
    items: 1
});
$('.carrusel-tipo-dos').owlCarousel({ //antes .carousel-style-one
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
$('.carrusel-tipo-tres').owlCarousel({ //antes .carousel-style-four
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



// :::
$('.carousel-style-two').owlCarousel({
    mouseDrag: false,

    loop: false,
    dots: false,
    nav: true,
    navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
    margin: 20,
    responsiveClass: true,
    center: true,
    startPosition: 1,
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 2
        }
    }
});