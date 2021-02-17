<div class="icon-content-type">
    <?php
    if (!empty(get_field('content_type'))){
        $content_type = get_field('content_type');
        switch($content_type){
            // Tipo de contenido: Video
            case 'video':
                if (!empty(get_field('video_youtube'))){
                    $video_iframe = get_field('video_youtube');
                    /*Autoplay Functionallity*/
                    if ( preg_match('/src="(.+?)"/', $video_iframe, $matches) ) {
                        // Video source URL
                        $src = $matches[1];
                        // Add option to hide controls, enable HD, and do autoplay -- depending on provider
                        $params = array(
                            'autoplay' => 1
                        );
                        $new_src = add_query_arg($params, $src);
                        $video_iframe = str_replace($src, $new_src, $video_iframe);
                        // add extra attributes to iframe html
                        $attributes = 'frameborder="0"';
                        $video_iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video_iframe);
                    }
                    /*Autoplay Functionallity*/
                    $video_html = '<div class="contenedor-media">'.$video_iframe.'</div>'; ?>
                    <i class="fab fa-youtube media_file media-type-icon media-type-icon-negro pl-1" data-titulo='<?php echo get_the_title(); ?>' data-media='<?php echo $video_html; ?>'></i>
                    <?php 
                }
            break;
            // Tipo de contenido: Audio
            case 'audio':
                if (!empty(get_field('audio_news'))){
                    $audio_iframe = get_field('audio_news');
                    $audio_html = '<div class="contenedor-media sound-iframe">'.$audio_iframe.'</div>'; ?>
                    <i class="fas fa-headphones-alt media_file media-type-icon media-type-icon-negro" data-media='<?php echo $audio_html; ?>'></i>
                    <?php
                }
            break;
        } // End of switch
    } // End of if (content_type)
    ?>
</div>