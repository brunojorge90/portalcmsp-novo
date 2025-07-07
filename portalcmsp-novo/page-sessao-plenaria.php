<?php
/*
 * Template Name: Sessão Plenária
 */
?>

<?php get_header(); ?>
<?php $youtube = get_field('youtube')?>
    <div id="content">
        <div class="breadcrumbs cf">
            <?php if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb('<p class="wrap cf">','</p>');
            } ?>
        </div>

        <div id="inner-content" class="wrap cf">
            <div id="main" class="two-column-main cf" role="main">
                <h1 class="desktop-headeline-2 mt-32">
                    <?php echo get_the_title()?>
                </h1>
                <div class="content mt-32">
                    <?php the_content()?>
                </div>
                <div class="ultimo-video mt-32">
                    <h2 class="desktop-headeline-4">
                        <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.6711 20L18.6711 14L10.6711 7.99996V20ZM13.3377 0.666626C5.97773 0.666626 0.00439453 6.63996 0.00439453 14C0.00439453 21.36 5.97773 27.3333 13.3377 27.3333C20.6977 27.3333 26.6711 21.36 26.6711 14C26.6711 6.63996 20.6977 0.666626 13.3377 0.666626ZM13.3377 24.6666C7.45773 24.6666 2.67106 19.88 2.67106 14C2.67106 8.11996 7.45773 3.33329 13.3377 3.33329C19.2177 3.33329 24.0044 8.11996 24.0044 14C24.0044 19.88 19.2177 24.6666 13.3377 24.6666Z" fill="#7F1A22"/>
                        </svg>
                        Última Sessão
                    </h2>
                    <div class="iframe-video">
                        <iframe src="" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="ultimo-video mt-50">
                    <div class="flex align-center justify-between w-100">
                        <h2 class="desktop-headeline-4">
                            <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.6711 20L18.6711 14L10.6711 7.99996V20ZM13.3377 0.666626C5.97773 0.666626 0.00439453 6.63996 0.00439453 14C0.00439453 21.36 5.97773 27.3333 13.3377 27.3333C20.6977 27.3333 26.6711 21.36 26.6711 14C26.6711 6.63996 20.6977 0.666626 13.3377 0.666626ZM13.3377 24.6666C7.45773 24.6666 2.67106 19.88 2.67106 14C2.67106 8.11996 7.45773 3.33329 13.3377 3.33329C19.2177 3.33329 24.0044 8.11996 24.0044 14C24.0044 19.88 19.2177 24.6666 13.3377 24.6666Z" fill="#7F1A22"/>
                            </svg>
                            Confira todas as sessões
                        </h2>
                        <div class="flex g-16 playlist-click">
                            <a href="#" class="button-primary button-size-sm" onclick="changeOrder('recentes');return false" id="recentes">Mais recentes</a>
                            <!--<a href="#" class="button-secondary button-size-sm" onclick="changeOrder('alta');return false" id="alta">Em alta</a> -->
                            <a href="#" class="button-secondary button-size-sm" onclick="changeOrder('antigos');return false" id="antigos">Mais antigos</a>
                        </div>
                    </div>
                    <div class="flex flex-wrap videos-itens g-30">
                    </div>
                    <div class="flex flex-center mt-32 w-100">
                        <a href="https://www.youtube.com/playlist?list=<?php echo $youtube?>" class="button-secondary" target="_blank">
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
                jQuery(".playlist-click > a#"+order).addClass("button-primary").removeClass("button-secondary");

                jQuery.get("<?php echo get_site_url()?>/wp-json/youtube-api/v1/playlist/<?php echo $youtube?>?maxResults=<?php echo 13?>&order=" + order, function(data) {

                    jQuery(".videos-itens > *").detach();
                    // Handle the JSON data here
                    var items = data;
                    items.forEach((z, i) => {

                        if(i === 0)
                            jQuery(".iframe-video iframe").attr("src", "https://www.youtube.com/embed/" + z.snippet.resourceId.videoId);

                        if(i != 0)
                            var html = '<a href="#" class="item" onclick="return openVideoRedeCamara(\''+z.snippet.resourceId.videoId+'\')">' +
                                '<img src="'+z.snippet.thumbnails.medium.url+'" alt="">' +
                                '<div class="context-item">' +
                                '<h3>'+z.snippet.title+'</h3>' +
                                '</div>' +
                                '</a>';
                        jQuery(html).appendTo(".videos-itens");
                    });
                    // Example: Display data on the page
                })
                    .fail(function(error) {
                        console.error('Error fetching data:', error);
                    });
            }


            jQuery.get("<?php echo get_site_url()?>/wp-json/youtube-api/v1/playlist/<?php echo $youtube?>?maxResults=<?php echo 13?>&order=recentes", function(data) {
                // Handle the JSON data here
                var items = data;
                items.forEach((z, i) => {
                    console.log(z);

                    if(i === 0)
                        jQuery(".iframe-video iframe").attr("src", "https://www.youtube.com/embed/" + z.snippet.resourceId.videoId);

                    if(i != 0)
                        var html = '<a href="#" class="item" onclick="return openVideoRedeCamara(\''+z.snippet.resourceId.videoId+'\')">' +
                            '<img src="'+z.snippet.thumbnails.medium.url+'" alt="">' +
                            '<div class="context-item">' +
                            '<h3>'+z.snippet.title+'</h3>' +
                            '</div>' +
                            '</a>';
                    jQuery(html).appendTo(".videos-itens");
                });
                // Example: Display data on the page
            })
                .fail(function(error) {
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
    </div>
</main>
<?php get_footer(); ?>