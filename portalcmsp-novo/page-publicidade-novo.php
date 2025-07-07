<?php
/*
 * Template Name: Publicidade Novo
 */
?>

<?php get_header(); ?>
<?php $youtube = get_field('youtube') ?>
<div id="content">
    <div class="breadcrumbs cf">
        <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="wrap cf">', '</p>');
        } ?>
    </div>

    <div id="inner-content" class="wrap cf">
        <div id="main" class="two-column-main cf" role="main">
            <h1 class="desktop-headeline-2 mt-32">
                <?php echo get_the_title() ?>
            </h1>
            <div class="content mt-32">
                <?php echo wpautop(get_the_content()) ?>
            </div>
            <div class="ultimo-video mt-32">
                <h2 class="desktop-headeline-4">
                    <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.6711 20L18.6711 14L10.6711 7.99996V20ZM13.3377 0.666626C5.97773 0.666626 0.00439453 6.63996 0.00439453 14C0.00439453 21.36 5.97773 27.3333 13.3377 27.3333C20.6977 27.3333 26.6711 21.36 26.6711 14C26.6711 6.63996 20.6977 0.666626 13.3377 0.666626ZM13.3377 24.6666C7.45773 24.6666 2.67106 19.88 2.67106 14C2.67106 8.11996 7.45773 3.33329 13.3377 3.33329C19.2177 3.33329 24.0044 8.11996 24.0044 14C24.0044 19.88 19.2177 24.6666 13.3377 24.6666Z"
                              fill="#7F1A22"/>
                    </svg>
                    Último vídeo
                </h2>
                <div class="iframe-video">
                    <iframe src="" frameborder="0"></iframe>
                </div>
            </div>
            <div class="ultimo-video mt-50">
                <div class="flex align-center justify-between w-100">
                    <h2 class="desktop-headeline-4">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.33789 2V6M7.33789 16V20M17.3379 4V8M17.3379 18V22M2.33789 6H12.3379M2.33789 16H12.3379M12.3379 8H22.3379M12.3379 18H22.3379M12.3379 20V3.6C12.3379 3.03995 12.3379 2.75992 12.2289 2.54601C12.133 2.35785 11.98 2.20487 11.7919 2.10899C11.578 2 11.2979 2 10.7379 2H7.13789C5.45773 2 4.61765 2 3.97592 2.32698C3.41143 2.6146 2.95249 3.07354 2.66487 3.63803C2.33789 4.27976 2.33789 5.11984 2.33789 6.8V15.2C2.33789 16.8802 2.33789 17.7202 2.66487 18.362C2.95249 18.9265 3.41143 19.3854 3.97592 19.673C4.61765 20 5.45773 20 7.13789 20H12.3379ZM12.3379 4H17.5379C19.218 4 20.0581 4 20.6999 4.32698C21.2643 4.6146 21.7233 5.07354 22.0109 5.63803C22.3379 6.27976 22.3379 7.11984 22.3379 8.8V17.2C22.3379 18.8802 22.3379 19.7202 22.0109 20.362C21.7233 20.9265 21.2643 21.3854 20.6999 21.673C20.0581 22 19.218 22 17.5379 22H13.9379C13.3778 22 13.0978 22 12.8839 21.891C12.6957 21.7951 12.5428 21.6422 12.4469 21.454C12.3379 21.2401 12.3379 20.9601 12.3379 20.4V4Z" stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Vídeos recentes
                    </h2>
                    <div class="flex g-16 playlist-click">
                        <a href="#" class="button-primary button-size-sm" onclick="changeOrder('recentes');return false"
                           id="recentes">Mais recentes</a>
                        <a href="#" class="button-secondary button-size-sm" onclick="changeOrder('alta');return false" id="alta">Em alta</a>
                        <a href="#" class="button-secondary button-size-sm"
                           onclick="changeOrder('antigos');return false" id="antigos">Mais antigos</a>
                    </div> 
                </div>
                <div class="flex flex-wrap videos-itens videos g-30">
                </div>
                 <div class="flex flex-center mt-32 w-100">
                    <a href="https://www.youtube.com/playlist?list=<?php echo $youtube ?>" class="button-secondary"
                       target="_blank">
                        Clique para acessar todos os episódios no nosso canal do Youtube
                    </a>
                </div>
            </div>

            <div class="ultimo-video mt-50">
                <div class="flex align-center justify-between w-100">
                    <h2 class="desktop-headeline-4">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.3379 6C12.8902 6 13.3379 5.55228 13.3379 5C13.3379 4.44772 12.8902 4 12.3379 4C11.7856 4 11.3379 4.44772 11.3379 5C11.3379 5.55228 11.7856 6 12.3379 6Z"
                                  stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.3379 13C12.8902 13 13.3379 12.5523 13.3379 12C13.3379 11.4477 12.8902 11 12.3379 11C11.7856 11 11.3379 11.4477 11.3379 12C11.3379 12.5523 11.7856 13 12.3379 13Z"
                                  stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.3379 20C12.8902 20 13.3379 19.5523 13.3379 19C13.3379 18.4477 12.8902 18 12.3379 18C11.7856 18 11.3379 18.4477 11.3379 19C11.3379 19.5523 11.7856 20 12.3379 20Z"
                                  stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19.3379 6C19.8902 6 20.3379 5.55228 20.3379 5C20.3379 4.44772 19.8902 4 19.3379 4C18.7856 4 18.3379 4.44772 18.3379 5C18.3379 5.55228 18.7856 6 19.3379 6Z"
                                  stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19.3379 13C19.8902 13 20.3379 12.5523 20.3379 12C20.3379 11.4477 19.8902 11 19.3379 11C18.7856 11 18.3379 11.4477 18.3379 12C18.3379 12.5523 18.7856 13 19.3379 13Z"
                                  stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19.3379 20C19.8902 20 20.3379 19.5523 20.3379 19C20.3379 18.4477 19.8902 18 19.3379 18C18.7856 18 18.3379 18.4477 18.3379 19C18.3379 19.5523 18.7856 20 19.3379 20Z"
                                  stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5.33789 6C5.89018 6 6.33789 5.55228 6.33789 5C6.33789 4.44772 5.89018 4 5.33789 4C4.78561 4 4.33789 4.44772 4.33789 5C4.33789 5.55228 4.78561 6 5.33789 6Z"
                                  stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5.33789 13C5.89018 13 6.33789 12.5523 6.33789 12C6.33789 11.4477 5.89018 11 5.33789 11C4.78561 11 4.33789 11.4477 4.33789 12C4.33789 12.5523 4.78561 13 5.33789 13Z"
                                  stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5.33789 20C5.89018 20 6.33789 19.5523 6.33789 19C6.33789 18.4477 5.89018 18 5.33789 18C4.78561 18 4.33789 18.4477 4.33789 19C4.33789 19.5523 4.78561 20 5.33789 20Z"
                                  stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Campanhas da Câmara
                    </h2>
                    <div class="flex g-16 playlist-click">
                       <a href="#" class="button-primary button-size-sm" onclick="changeOrder('recentes');return false"
                           id="recentes">Mais recentes</a>
                        <a href="#" class="button-secondary button-size-sm" onclick="changeOrder('alta');return false" id="alta">Em alta</a>
                        <a href="#" class="button-secondary button-size-sm"
                           onclick="changeOrder('antigos');return false" id="antigos">Mais antigos</a>
                    </div> 
                </div>
                <div class="flex flex-wrap videos-itens g-30">
                    <?php
                    $posts = get_posts([
                        "post_type" => "publicidade",
                        "showposts" => -1,
                    ]);

                    foreach ($posts as $post) :
                    ?>
                    <a href="<?php echo get_permalink($post->ID); ?>" class="item" >
                        <?php echo get_the_post_thumbnail($post->ID, "large")?>
                        <div class="context-item">
                            <h3><?= $post->post_title ?></h3>
                        </div>
                    </a>
                    <?php endforeach;?>
                </div>
                <div class="flex flex-center mt-32 w-100">
                    <a href="https://www.youtube.com/playlist?list=<?php echo $youtube ?>" class="button-secondary"
                       target="_blank">
                        Clique para acessar todos os episódios no nosso canal do Youtube
                    </a>
                </div> 
                <div class="mt-80"></div>
            </div>
        </div>
    </div>
    <script>
        var order = "";

        function changeOrder(order) {
            jQuery(".playlist-click > a").removeClass("button-primary").addClass("button-secondary");
            jQuery(".playlist-click > a#" + order).addClass("button-primary").removeClass("button-secondary");

            jQuery.get("<?php echo get_site_url()?>/wp-json/youtube-api/v1/playlist/<?php echo $youtube?>?maxResults=<?php echo 13?>&order=" + order, function (data) {

                jQuery(".videos-itens > *").detach();
                // Handle the JSON data here
                var items = data;
                items.forEach((z, i) => {
                    var html = '<a href="#" class="item" onclick="return openVideoRedeCamara(\'' + z.snippet.resourceId.videoId + '\')">' +
                        '<img src="' + z.snippet.thumbnails.medium.url + '" alt="">' +
                        '<div class="context-item">' +
                        '<h3>' + z.snippet.title + '</h3>' +
                        '</div>' +
                        '</a>';
                    jQuery(html).appendTo(".videos-itens");
                });
                // Example: Display data on the page
            })
                .fail(function (error) {
                    console.error('Error fetching data:', error);
                });
        }


        jQuery.get("<?php echo get_site_url()?>/wp-json/youtube-api/v1/playlist/<?php echo $youtube?>?maxResults=<?php echo 5?>&order=recentes", function (data) {
            // Handle the JSON data here
            var items = data;
            items.forEach((z, i) => {
                console.log(z);

                if (i === 0)
                    jQuery(".iframe-video iframe").attr("src", "https://www.youtube.com/embed/" + z.snippet.resourceId.videoId);

                if (i != 0)
                    var html = '<a href="#" class="item" onclick="return openVideoRedeCamara(\'' + z.snippet.resourceId.videoId + '\')">' +
                        '<img src="' + z.snippet.thumbnails.medium.url + '" alt="">' +
                        '<div class="context-item">' +
                        '<h3>' + z.snippet.title + '</h3>' +
                        '</div>' +
                        '</a>';
                jQuery(html).appendTo(".videos-itens.videos");
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
</div>

<style>
    .ultimo-video .videos-itens {
        min-height: auto;
    }

    .ultimo-video .videos-itens .item img {
        object-fit: cover;
    }
</style>
</main>
<?php get_footer(); ?>