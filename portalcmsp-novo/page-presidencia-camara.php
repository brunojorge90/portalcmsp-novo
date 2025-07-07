<?php
/*
 Template Name: Presidência da Câmara
*/

//define('DONOTCACHEPAGE', true);
use Cassandra\Date;

date_default_timezone_set("America/Sao_Paulo");
$vereador_name = get_field("nome");
?>

<?php get_header(); ?>

 <style>
        body.theme-v2 .header .otherwise {
            display: none;
        }
    </style>

   
    <div id="content">
        <section id="cover-presidente-camara" class="w100">
            <div class="config-image-bg w100">
                <?php
                $background = get_field("imagem_de_capa");
                if ($background):
                    echo wp_get_attachment_image($background["ID"], 'full', false, ["class" => 'w100']);
                else :
                    ?>
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/backgroundPresidente.jpg" class="w100">
                <?php endif ?>
                <div class="abs mt-32">
                    <div class="container">
                        <div class="desktop-body-3">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>/</li>
                                <li><a href="<?php echo get_site_url() ?>/vereadores">Vereadores</a></li>
                                <li>/</li>
                                <li><strong><?php echo get_the_title() ?></strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="infos-presidente-camara">
            <div class="abs">
                <div class="container">
                    <div class="sobre-presidente-camara">
                        <div class="foto-perfil-presidente-camara">
                            <?php
                            $foto = get_field("foto");

                            echo wp_get_attachment_image($foto['ID'], 'full', false, ["class" => 'w100']);
                            ?>
                        </div>

                        <h1 class="desktop-headeline-3"><?php echo get_field("nome") ?></h1>
                        <h3 class="desktop-body-1 mt-8">Presidente da Câmara</h3>

                        <div class="textos-presidente-camara mt-40">
                            <div class="coluna-esquerda desktop-body-1">
                                <h2 class="desktop-headeline-4">
                                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-profile.svg"
                                         alt="icone">
                                    Conheça o Presidente da Câmara
                                </h2>

                                <?php echo get_field("texto");

                                $link = get_field("link_do_perfil");

                                if($link) :
                                    ?>
                                    <a class="button-secondary" href="<?php echo $link['url']?>" title="link do perfil do presidente" style="color: #7f1a22">Visite o perfil completo do presidente da
                                        Câmara</a>
                                <?php endif ?>
                            </div>

                            <div class="coluna-direita">
                                <h4 class="desktop-headeline-4">Compartilhe</h4>
                                <div class="compartilhe-redes mt-8">
                                    <a href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode(get_permalink()); ?>"
                                       target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-linkedin.svg" alt="Compartilhar Linkedin">
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                                       target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-facebook.svg" alt="Compartilhar Facebook">
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>"
                                       target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-twitter.svg" alt="Compartilhar Twitter">
                                    </a>
                                    <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&amp;body=<?php echo urlencode(get_permalink()); ?>"
                                       target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-email.svg" alt="Compartilhar E-mail">
                                    </a>
                                </div>

                                <div class="infos-gabinete mt-32">
                                    <h3 class="desktop-headeline-4">Infos do Gabinete:</h3>
                                    <?php
                                    $gabinete = get_field("infos_de_gabinete");
                                    ?>
                                    <ul>
                                        <li class="mt-16">
                                            <strong>Chefe de Gabinete da Presidência:</strong>
                                            <?php echo $gabinete["chefe_de_gabinete"]?>
                                        </li>
                                        <li class="mt-16">
                                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/Phone.svg"
                                                 alt="telefone">
                                            <strong>Telefone:</strong> <?php echo $gabinete["telefone"]?>
                                        </li>
                                        <li class="mt-16">
                                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/Email.svg"
                                                 alt="e-mail">
                                            <strong>Email:</strong> <?php echo $gabinete["e-mail"]?>
                                        </li>
                                        <li class="mt-16">
                                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-pin.svg"
                                                 alt="e-mail">
                                            <div><strong>Endereço:</strong> <?php echo $gabinete["endereco"]?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="midia-presidente-camara">
            <div class="container">
                <h2 class="desktop-headeline-4 mt-24">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-video.svg" alt="icone">
                    Apresentação do Presidente
                </h2>
                <div class="iframe-video">
                    <?php echo get_field("video")?>
                </div>

                <div class="noticias-videos-presidente mt-48">
                    <div class="noticias-presidente">
                        <h2 class="desktop-headeline-4">
                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-noticia.svg" alt="icone">
                            Últimas notícias relacionadas ao presidente
                        </h2>

                        <?php
                        $args = [
                            'post_type' => 'post',
                            'showposts' => 3,
                        ];
                        if(!get_field('noticias_auto')) {
                            $args['post__in'] = get_field("noticias");
                        } else {
                            $args['s'] =$vereador_name;
                        }
                        $posts = get_posts($args);

                        foreach ($posts as $i => $post) :
                            $thumbnail = $NewTheme->getPostThumbnail($post->ID);
                            ?>
                            <a href="<?php echo get_the_permalink($post->ID) ?>"
                               class="noticia-individual <?php if ($i != 0) echo 'mt-16' ?>"
                               aria-label="<?php echo $post->post_title ?>">
                                <div class="infos-noticia">
                                    <h3 class="desktop-body-3 lines3" aria-label="<?php echo $post->post_title ?>">
                                        <strong><?php echo $post->post_title ?></strong></h3>
                                    <span class="flex g-13 align-center desktop-body-3">
                                        Acessar notícia
                                        <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                                  stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                </div>
                                <?php
                                if ($thumbnail) :
                                    ?>
                                    <div class="img-noticia">
                                        <img src="<?php echo $thumbnail ?>"
                                             alt="thumbnail noticia" class="w100">
                                    </div>
                                <?php endif ?>
                            </a>
                        <?php endforeach; ?>
                        <a href="<?php echo get_site_url() ?>/noticias" class="button-primary mt-16">Acessar todas as
                            notícias</a>
                    </div>

                    <div class="videos-presidente">
                        <?php
                        $videos = $NewTheme->getVideosByVereador($vereador_name, $postId);
                        ?>
                        <h2 class="desktop-headeline-4">
                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-video.svg" alt="icone">
                            Vídeos com o presidente
                        </h2>

                        <div class="galeria-videos">
                            <?php
                            foreach ($videos as $post) :
                                ?>
                                <a href="#"
                                   onclick="return openVideoContent('<?php echo $post['items'][0]['id'] ?>', '<?php echo $post['link'] ?>')"
                                   class="video-individual" aria-label="">
                                    <div>
                                        <img src="<?php echo $post['items'][0]['snippet']['thumbnails']['medium']['url'] ?>"
                                             alt="legenda do vídeo" class="w100">
                                    </div>
                                    <span class="desktop-body-3"><?php echo $post['items'][0]['snippet']['title'] ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="pronunciamentos-presidente-camara">
            <div class="container">
                <h2 class="desktop-headeline-4 mt-24">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-video.svg" alt="icone">
                    Pronunciamentos do presidente
                </h2>

                <div class="galeria-pronunciamentos videos-itens">

                </div>
                <div class="flex justify-center mt-56">
                    <a href="#" title="link de todos pronunciamentos" class="link-pronunciamento button-secondary text-decoration-none w100">Clique para acessar todos
                        os pronunciamentos</a>
                </div>
            </div>
        </section>

        <section id="mensagem-presidente-camara">
            <div class="container">
                <div class="contato-vereador">
                    <h2 class="desktop-headeline-4 mt-24">
                        <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-send.svg" alt="icone">
                        Mensagem para o Presidente
                    </h2>
                    <span class="desktop-body-2">
                    <?php echo get_field("descricao")?>
                </span>

                    <div class="mensagem-presidente mt-48">
                        <h3 class="desktop-headeline-4">
                            Enviar uma mensagem para o Presidente
                        </h3>

                        <?php
                        $form = do_shortcode('[contact-form-7 id="3e4642a"]');
                        $form = str_replace("<p role=\"status\" aria-live=\"polite\" aria-atomic=\"true\">", "<p role=\"status\" aria-live=\"polite\" aria-atomic=\"true\">Resposta", $form);
                        $form = str_replace("<div class=\"wpcf7-response-output\" aria-hidden=\"true\">", "<div class=\"wpcf7-response-output\" aria-hidden=\"true\">Resposta:", $form);
                        $form = str_replace("<p><span class=\"form-left\"><input", "<p><span class=\"form-left\"><span style='text-indent: -1000px;display:block'>Resposta:</span><input", $form);
                        echo $form;
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        <?php $id_playlist = get_field('playlist_id_youtube')?>

        jQuery.get("<?php echo get_site_url()?>/wp-json/youtube-api/v1/playlist/<?php echo $id_playlist?>?maxResults=12", function (data) {
            // Handle the JSON data here
            var items = data;
            items.forEach((z) => {
                console.log(z);
                var html = '<a href="#" class="pronunciamento-individual" onclick="return openVideoRedeCamara(\''+z.snippet.resourceId.videoId+'\')">' +
                    '<div><img src="'+z.snippet.thumbnails.medium.url+'" alt=""></div>' +
                    '<span class="desktop-body-3">' +
                    '<h3>'+z.snippet.title+'</h3>' +
                    '</span>' +
                    '</a>';
                jQuery(html).appendTo(".videos-itens");
            });
            // Example: Display data on the page
        }).fail(function (error) {
            console.error('Error fetching data:', error);
        });

        function openVideoRedeCamara(videoId) {
            var html = "<div class='popupflex'>" +
                "<div class='flex'>" +
                "<div class='contentPopup'>" +
                '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"> <mask id="mask0_1029_46344" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="30"> <rect x="0.547363" y="0.613281" width="28.8397" height="28.8397" fill="#D9D9D9"></rect> </mask> <g mask="url(#mask0_1029_46344)"> <path d="M8.23798 23.4447L6.55566 21.7624L13.2849 15.0332L6.55566 8.3039L8.23798 6.62158L14.9672 13.3508L21.6965 6.62158L23.3788 8.3039L16.6496 15.0332L23.3788 21.7624L21.6965 23.4447L14.9672 16.7155L8.23798 23.4447Z" fill="#FFF1F5"></path> </g> </svg>' +
                "<iframe border='0' src='https://www.youtube.com/embed/" +videoId + "' ></iframe>" +
                "</div>" +
                "</div>" +
                "</div>";
            jQuery(html).appendTo("body");
            jQuery(".popupflex").fadeIn();

            var contentPopup = jQuery(".contentPopup");

            setTimeout(() => {
                // Event listener para o clique no documento
                jQuery('.popupflex').click(function(event) {
                    // Verifica se o clique foi fora do popup
                    if (!jQuery(event.target).closest(".contentPopup").length) {
                        jQuery(".popupflex").fadeOut();
                        setTimeout(() => {
                            jQuery('.popupflex').detach();
                        }, 500);
                    }
                });

                jQuery('.popupflex svg').click(function () {
                    jQuery(".popupflex").fadeOut();
                    setTimeout(() => {
                        jQuery('.popupflex').detach();
                    }, 500);
                })

                // Event listener para o clique no popup
                contentPopup.click(function(event) {
                    // Impede que o clique dentro do popup seja propagado para o documento
                    event.stopPropagation();
                });
            },300)

            return false;
        }
    </script>
    <script src="https://apis.google.com/js/client.js?onload=onGoogleLoad" defer async></script>
</main>
<?php get_footer(); ?>