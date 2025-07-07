<section class="rede_camara" aria-label="Rede Câmara SP">
    <div class="container">
        <div class="justify-center wf100 flex logo-camara">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/rede_camara.svg" alt="Rede Câmara">
        </div>
        <div class="flex-col rede-camara-flex flex mt-56">
            <div class="col">
                <h2 class="desktop-headeline-4" arial-label="Rede Câmara SP ao vivo">
                    <svg width="16" class="bolinha" height="16" viewBox="0 0 16 16" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <circle cx="8" cy="8" r="8" fill="#7F1A22"/>
                    </svg>
                    Ao Vivo
                </h2>
                <div class="ao-vivo border-r-w">
                    <div style="cursor:pointer;border-top-left-radius:16px;border-top-right-radius:16px;background-color: black;position: relative" class="click-rede" onclick="jQuery('.jmvplayer').attr('src', jQuery('.jmvplayer').attr('data-src')).css('pointer-events', 'all');jQuery('.click-rede img').detach();jQuery('.click-rede img').removeAttr('onclick')">
                        <img width="64" height="64" src="https://homolog.saopaulo.sp.leg.br/wp-content/themes/portalcmsp-novo/assets/images/play.svg" alt="Vídeos e áudios" style="position: absolute;top: calc(50% - 32px);left: calc(50% - 32px);filter: brightness(1000)">
                        <iframe class="jmvplayer" title="Rede Camara SP ao vivo"
                                style="width: 100%; aspect-ratio: 16 / 9;height: 100%; display: block; border-top-right-radius: 16px; border-top-left-radius: 16px;pointer-events: none"
                                data-src="<?php echo get_field("embed") ?>" allowfullscreen=""
                                allow="autoplay; fullscreen" frameborder="0" width="50%" height="351" scrolling="yes"
                                data-gtm-yt-inspected-3="true"></iframe>
                                
                             
                    </div>
                    <div class="context ph-12 pv-18 bk-white b-b-16">
                        <h3 class="desktop-headeline-5">
                            <?php echo get_field("titulo_do_ao_vivo") ?>
                        </h3>
                        <!--<div class="flex g-8 mt-16 tags">
                            <?php
                            $categorias = get_field("categorias_rede_camara");
                            foreach ($categorias as $category) :
                                ?>
                                <a href="<?php echo get_term_link($category->term_id) ?>" class="tag">
                                    <?php echo $category->name ?>
                                </a>
                            <?php endforeach; ?>
                        </div> -->
                        <?php
                        $descricao = get_field("descricao_rede_camara");

                        if ($descricao) : ?>
                            <p class="mt-16" style="min-height:auto">
                                <?php echo $descricao ?>
                            </p>
                        <?php endif ?>
                       
                        <?php if (get_field("label_do_botao") && get_field('link_da__pagina')) :
                            ?>
                            <a class="flex g-13 align-center span" href="  <?php echo get_field("link_da__pagina"); ?>">
                                <?php echo get_field("label_do_botao"); ?>
                                <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                          stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"></path>
                                </svg>
                            </a>
                        <?php endif ?>
                         <!--<iframe class="mt-24" src="https://player.maxcast.com.br/saopaulospleg" width="auto" height="60" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="width:100%" class="iframe-class"></iframe>-->
                    </div>
                </div>
            </div>
            <div class="col">
                <h2 class="desktop-headeline-4" arial-label="Vídeos e áudios da Rede Câmara SP">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/play.svg" alt="Vídeos e áudios">
                    Vídeos e áudios
                </h2>

                <div class="ultimos-videos border-r-w">
                    <nav class="flex-col flex nav">
                        <a href="#" class="active col" data-active="videos" aria-label="Últimos videos">
                            Últimos vídeos
                        </a>
                        

                        <a href=""  class="col" data-active="webradio" aria-label="Web Rádio">
                            Últimos aúdios
                        </a>
                    </nav>
                    <div class="context videos">
                        <div class="flex flex-wrap videos-itens g-28">
                        </div>
                    </div>

                    <div class="context webradio">

                        <a style="text-align: center; text-decoration: none; font-weight: bold;" href="https://soundcloud.com/webradiocamarasaopaulo" target="_blank">Acessar a Web radio da Câmara </a>

                        <!--<iframe src="<?php echo get_field('webradio') ?>" frameborder="0"></iframe>-->

                    </div>
                </div>
            </div>
        </div>
        <a href="<?php echo get_field('link_rede_camara') ?>"
           class="w100 button-primary text-decoration-none mt-56 text-center" target="_blank">
            Clique para acessar a Rede Câmara SP
        </a>
    </div>

    <script>
        <?php $youtube = get_field('youtube')?>

                jQuery.get("<?php echo get_site_url()?>/wp-json/youtube-api/v1/playlist/<?php echo $youtube['id_playlist']?>?maxResults=20", function (data) {
            // Handle the JSON data here
            var items = data;
            i = 0;
            items.forEach((z) => {
                if(z.snippet.thumbnails.hasOwnProperty("medium") && i < 4) {
                    
                    //var html = '<a href="#" class="item" onclick="return openVideoRedeCamara(\'' + z.snippet.resourceId.videoId + '\')">' +
                    var html = '<div class="item" role="button" tabindex="0" onclick="return openVideoRedeCamara(\'' + z.snippet.resourceId.videoId + '\')" onkeypress="if(event.key === \'Enter\'){ openVideoRedeCamara(\'' + z.snippet.resourceId.videoId + '\'); }">' +
                        '<img src="' + z.snippet.thumbnails.medium.url + '" alt="'+ z.snippet.title +'">' +
                        '<div class="context-item">' +
                        '<h3>' + z.snippet.title + '</h3>' +
                        '</div>' +
                        '</div>';
                        //'</a>';
                    jQuery(html).appendTo(".videos-itens");
                    i++;
                }
            });
            // Example: Display data on the page
        })
            .fail(function (error) {
                console.error('Error fetching data:', error);
            });

        function openVideoRedeCamara(videoId) {
            var html = "<div class='popupflex'>" +
                "<div class='flex'>" +
                "<div class='contentPopup'>" +
                '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"> <mask id="mask0_1029_46344" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="30"> <rect x="0.547363" y="0.613281" width="28.8397" height="28.8397" fill="#D9D9D9"></rect> </mask> <g mask="url(#mask0_1029_46344)"> <path d="M8.23798 23.4447L6.55566 21.7624L13.2849 15.0332L6.55566 8.3039L8.23798 6.62158L14.9672 13.3508L21.6965 6.62158L23.3788 8.3039L16.6496 15.0332L23.3788 21.7624L21.6965 23.4447L14.9672 16.7155L8.23798 23.4447Z" fill="#FFF1F5"></path> </g> </svg>' +
                "<iframe border='0' src='https://www.youtube.com/embed/" + videoId + "' ></iframe>" +
                "</div>" +
                "</div>" +
                "</div>";
            jQuery(html).appendTo("body");
            jQuery(".popupflex").fadeIn();

            var contentPopup = jQuery(".contentPopup");

            setTimeout(() => {
                // Event listener para o clique no documento
                jQuery('.popupflex').click(function (event) {
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
                contentPopup.click(function (event) {
                    // Impede que o clique dentro do popup seja propagado para o documento
                    event.stopPropagation();
                });
            }, 300)

            return false;
        }
    </script>
</section>
<style>
body.theme-v2 .rede_camara .ultimos-videos nav a:not(.active):not(:hover) {
	color:black
}
</style>
