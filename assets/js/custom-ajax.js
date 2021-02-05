(function($) {
    $(document).ready(function() {

        // TODO: Cargar posts de Más reciente y Más visto por medio de AJAX en archives

        /* Variables de AJAX */

        var ppp = 9; // Post per page
        var cat = $('#more_posts').data('category'); // Category ID
        var pst = $('#more_posts').data('post-type'); // Post type
        var fpt = $('#more_posts').data('filter-type'); // Filter type (Mas reciente o mas visto)
        var taxonomy = $('#more_posts').data('taxonomy'); // Taxonomy name
        var pageNumber = 1; // Page number

        /* Funcion para cargar mas posts */
        function load_posts() {
            pageNumber++;
            var str = '&cat=' + cat + '&taxonomy=' + taxonomy + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&pst=' + pst + '&fpt=' + fpt + '&action=more_post_ajax';
            $.ajax({
                type: "POST",
                dataType: "html",
                url: ajax_posts.ajaxurl,
                data: str,
                success: function(data) {
                    var $data = $(data);
                    if ($data.length) {
                        $("#ajax-posts").append($data);
                        $(".ajax-response-failed").html('');
                        $(".spinner").addClass('hidden');
                        $("#more_posts").removeClass('hidden');
                    } else {
                        $(".ajax-response-failed").html('<p class="lead texto-gris-medio m-0">No se encontraron más notas.</p>');
                        $(".spinner").addClass('hidden');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                }
            });
            return false;
        }

        /* Cargar mas posts */
        $("#more_posts").on("click", function() {
            $(".ajax-response-failed").html('');
            $(".spinner").removeClass('hidden');
            $("#more_posts").addClass('hidden');
            load_posts();
        });

        /* Funcion para filtrar por: mas reciente o mas visto */
        function posts_filter(cat_id, post_type, filter_type, carousel_type) {

            /* Variables de AJAX */
            var cat = cat_id; // Category ID
            //var ppp = 3; // Post per page
            var pst = post_type; // Post type
            var fpt = filter_type; // Filter type
            var cpt = carousel_type; // Carousel type
            var pageNumber = 1; // Page Number
            var str = '&cat=' + cat + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&pst=' + pst + '&fpt=' + fpt + '&cpt=' + cpt + '&action=filter_post_ajax';
            $.ajax({
                type: "POST",
                dataType: "json",
                url: ajax_posts.ajaxurl,
                data: str,
                success: function(data) {
                    var $data = $(data);
                    if ($data.length) {
                        // create again the carousel and add all items for
                        var html = '';
                        html += '<div id="carousel-' + cat_id + '" class="owl-carousel owl-' + carousel_type + ' ' + carousel_type + '">';
                        $.each($data, function(index, val) {
                            html += val;
                        });
                        html += '</div>';

                        // add the carousel after the specific id wich contain the filter links
                        $('.links-to-filter-publications-' + cat_id + '').after(html);

                        // after got and add the content load again the carousel
                        setTimeout(function() {
                            // hidde the load more
                            $('.load-' + cat_id + '').addClass('hidden');

                            // load again the carousel
                            loadOwl(cat_id, carousel_type);
                        }, 600);
                    } else {
                        // hidde the load more
                        $('.load-' + cat_id + '').addClass('hidden');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                }
            });
            return false;
        }

        $(".more_viewed_posts").on("click", function() {
            var cat_id = $(this).data('category');
            var post_type = $(this).data('post-type');
            var filter_type = $(this).data('filter-type');
            var carousel_type = $(this).data('carousel-type');

            // change style for recent publication link filter to inactive style
            $('.rpl-' + cat_id + '').removeClass('link-filtro-activo');
            $('.rpl-' + cat_id + '').addClass('link-filtro');
            $('.rpl-circle-' + cat_id + '').removeClass('d-inline');
            $('.rpl-circle-' + cat_id + '').addClass('d-none');

            // change style for most viewed publication link filter to active style
            $(this).removeClass('link-filtro');
            $(this).addClass('link-filtro-activo');
            $(this).find('.mvl-circle-' + cat_id + '').removeClass('d-none');
            $(this).find('.mvl-circle-' + cat_id + '').addClass('d-inline');

            // remove the carousel with the specific id
            var carousel = '#carousel-' + cat_id + '';
            $(carousel).remove();

            // display the load more
            $('.load-' + cat_id + '').removeClass('hidden');

            // call the function to load the content to the slider
            posts_filter(cat_id, post_type, filter_type, carousel_type);
        });

        $(".recent_added_posts").on("click", function() {
            var cat_id = $(this).data('category');
            var post_type = $(this).data('post-type');
            var filter_type = $(this).data('filter-type');
            var carousel_type = $(this).data('carousel-type');

            // change style for recent publication link filter to inactive style
            $('.mvl-' + cat_id + '').removeClass('link-filtro-activo');
            $('.mvl-' + cat_id + '').addClass('link-filtro');
            $('.mvl-circle-' + cat_id + '').removeClass('d-inline');
            $('.mvl-circle-' + cat_id + '').addClass('d-none');

            // change style for most viewed publication link filter to active style
            $(this).removeClass('link-filtro');
            $(this).addClass('link-filtro-activo');
            $(this).find('.rpl-circle-' + cat_id + '').removeClass('d-none');
            $(this).find('.rpl-circle-' + cat_id + '').addClass('d-inline');

            // remove the carousel with the specific id
            var carousel = '#carousel-' + cat_id + '';
            $(carousel).remove();

            // display the load more
            $('.load-' + cat_id + '').removeClass('hidden');

            // call the function to load the content to the slider
            posts_filter(cat_id, post_type, filter_type, carousel_type);
        });
    });
})(jQuery);

// ---------------------------------------------------------------

/*
 * Parámetros para caruseles
 **/
function loadOwl(cat_id, carousel_type) {
    if (carousel_type == 'carousel-style-one') {
        $('#carousel-' + cat_id + '').owlCarousel({
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
    } else if (carousel_type == 'carousel-style-two') {
        $('#carousel-' + cat_id + '').owlCarousel({
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
    } else if (carousel_type == 'carousel-style-three') {
        $('#carousel-' + cat_id + '').owlCarousel({
            loop: false,
            dots: false,
            nav: true,
            navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
            margin: 10,
            responsiveClass: true,
            items: 1
        });
    } else if (carousel_type == 'carousel-style-four') {
        $('#carousel-' + cat_id + '').owlCarousel({
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
    }
}