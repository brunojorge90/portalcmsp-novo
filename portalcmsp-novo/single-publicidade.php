<?php
/*
 * Template Name: Publicidade Novo
 */
?>

<?php get_header(); ?>
<?php $youtube = get_field('youtube') ?>
<div id="content">
    <div class="breadcrumbs cf">
        <p class="wrap cf"><span><span><a href="https://www.saopaulo.sp.leg.br/">Início</a></span> » <span><a
                            href="https://www.saopaulo.sp.leg.br/comunicacao/publicidade/">Publicidades</a></span> » <span
                        class="breadcrumb_last" aria-current="page"><?= get_the_title()?></span></span></p></div>
    <div id="inner-content" class="wrap cf">
        <div id="main" class="two-column-main cf" role="main">
            <h1 class="desktop-headeline-2 mt-32">
                <?php echo get_the_title() ?>
            </h1>
            <div class="content mt-32">
                <?php echo wpautop(get_the_content()) ?>
            </div>
            <div class="flex gap-16 options flex-wrap">
                <a href="#" class="act" data-id="video-internet">
                    Vídeo para internet
                </a>

                <a href="" data-id="spot-radio">
                    Spot de rádio
                </a>

                <a href="" data-id="banner">
                    Banner internet
                </a>

              <a href="" data-id="dooh">
                    DOOH
                </a>

                <a href="" data-id="ooh">
                    OOH
                </a>

                <a href="" data-id="redes-sociais">
                    Redes Sociais
                </a> 
            </div>

            <div class="mt-32 itens-publicidade" id="video-internet">
                <div class="flex gap-32 flex-wrap">
                    <?php
                    $videos_internet = get_field("tipo");
                    foreach ($videos_internet as $video) :
                        $oembed_url = $video['video'];
                        if (!empty($oembed_url)) {
                            // Regex para extrair o ID do vídeo do YouTube do URL oEmbed
                            if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $oembed_url, $matches)) {
                                $youtube_id = $matches[1];
                            }
                        }
                        ?>
                        <div class="item" onclick="openVideoRedeCamara('<?php echo $youtube_id?>')">
                            <div class="relative">
                                <?php echo get_the_post_thumbnail(get_the_ID(), "large")?>
                                <div class="abs">
                                    <svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="0.243164" width="52" height="52" rx="26" fill="#FFF1F5" fill-opacity="0.85"/>
                                        <path d="M26.2432 36C31.766 36 36.2432 31.5228 36.2432 26C36.2432 20.4772 31.766 16 26.2432 16C20.7203 16 16.2432 20.4772 16.2432 26C16.2432 31.5228 20.7203 36 26.2432 36Z" stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M23.7432 22.9653C23.7432 22.488 23.7432 22.2494 23.8429 22.1162C23.9298 22.0001 24.0629 21.9274 24.2075 21.9171C24.3735 21.9052 24.5743 22.0343 24.9758 22.2924L29.6964 25.3271C30.0448 25.551 30.2189 25.663 30.2791 25.8054C30.3317 25.9298 30.3317 26.0702 30.2791 26.1946C30.2189 26.337 30.0448 26.449 29.6964 26.6729L24.9758 29.7076C24.5743 29.9657 24.3735 30.0948 24.2075 30.0829C24.0629 30.0726 23.9298 29.9999 23.8429 29.8838C23.7432 29.7506 23.7432 29.512 23.7432 29.0347V22.9653Z" stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="context">
                                <h3>
                                    <?= $video['titulo']?>
                                </h3>
                                <p>
                                    Filme de <?= $video['duracao']?>
                                </p>
                            </div>

                        </div>
                    <?php endforeach;?>
                </div>
            </div>

            <div class="mt-32 itens-publicidade" id="spot-radio" style="display: none">
                <div class="flex gap-32 flex-wrap">
                    <?php
                    $spot_radio = get_field("spot_radio");
                    //php-error-log: [18-Mar-2025 17:11:05 UTC] PHP Warning:  Invalid argument supplied for foreach() in /var/www/sistemas/CR0313/wp-content/themes/portalcmsp-novo/single-publicidade.php on line 90
					if (!empty($spot_radio)) {
						foreach ($spot_radio as $item) :
							$file = wp_get_attachment_url($item['arquivo_mp3']);
							?>
							<a class="item" href="<?= $file?>" target="_blank">
								<div class="relative">
									<?php echo get_the_post_thumbnail(get_the_ID(), "large")?>
									<div class="abs">
										<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect width="52" height="52" rx="26" fill="#FFF1F5" fill-opacity="0.85"/>
											<path d="M31.1189 32C33.4623 30.4151 35 27.7779 35 24.785C35 19.9333 30.9704 16 26 16C21.0296 16 17 19.9333 17 24.785C17 27.7779 18.5377 30.4151 20.8811 32M22.3597 28C21.5187 27.15 21 26.0086 21 24.7505C21 22.1271 23.2388 20 26 20C28.7612 20 31 22.1271 31 24.7505C31 26.0095 30.4813 27.15 29.6403 28M26 36C24.8954 36 24 35.1046 24 34V32C24 30.8954 24.8954 30 26 30C27.1046 30 28 30.8954 28 32V34C28 35.1046 27.1046 36 26 36ZM27 25C27 25.5523 26.5523 26 26 26C25.4477 26 25 25.5523 25 25C25 24.4477 25.4477 24 26 24C26.5523 24 27 24.4477 27 25Z" stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</div>
								</div>
								<div class="context">
									<h3>
										<?= $item['titulo']?>
									</h3>
									<p>
										Áudio de <?= $item['duracao']?>
									</p>
								</div>

							</a>
                    <?php
						endforeach;
					}	
					?>
                </div>
            </div>

            <div class="mt-32 itens-publicidade banner-internet" id="banner" style="display: none">
                <div class="flex gap-32 flex-wrap">
                    <?php
                    $banner = get_field("banner_internet");
                    //php-error-log: [18-Mar-2025 17:11:05 UTC] PHP Warning:  Invalid argument supplied for foreach() in /var/www/sistemas/CR0313/wp-content/themes/portalcmsp-novo/single-publicidade.php on line 121
					if (!empty($banner)) {
						foreach ($banner as $item) :
							$file = wp_get_attachment_image_url($item["banner"], "full");
							?>
							<a class="item banner-internet" href="<?= $file?>" target="_blank">
								<div class="relative">
									<?php echo wp_get_attachment_image($item["banner"], "large");?>
									<div class="abs">
										<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="0.0810547" width="52" height="52" rx="26" fill="#FFF1F5" fill-opacity="0.85"/>
											<path d="M18.3531 34.7279L24.9497 28.1314C25.3457 27.7354 25.5437 27.5373 25.772 27.4632C25.9729 27.3979 26.1892 27.3979 26.3901 27.4632C26.6184 27.5373 26.8164 27.7354 27.2124 28.1314L33.765 34.6839M28.0811 29L30.9497 26.1314C31.3457 25.7354 31.5437 25.5373 31.772 25.4632C31.9729 25.3979 32.1892 25.3979 32.3901 25.4632C32.6184 25.5373 32.8164 25.7354 33.2124 26.1314L36.0811 29M24.0811 23C24.0811 24.1046 23.1856 25 22.0811 25C20.9765 25 20.0811 24.1046 20.0811 23C20.0811 21.8954 20.9765 21 22.0811 21C23.1856 21 24.0811 21.8954 24.0811 23ZM20.8811 35H31.2811C32.9612 35 33.8013 35 34.443 34.673C35.0075 34.3854 35.4665 33.9265 35.7541 33.362C36.0811 32.7202 36.0811 31.8802 36.0811 30.2V21.8C36.0811 20.1198 36.0811 19.2798 35.7541 18.638C35.4665 18.0735 35.0075 17.6146 34.443 17.327C33.8013 17 32.9612 17 31.2811 17H20.8811C19.2009 17 18.3608 17 17.7191 17.327C17.1546 17.6146 16.6957 18.0735 16.408 18.638C16.0811 19.2798 16.0811 20.1198 16.0811 21.8V30.2C16.0811 31.8802 16.0811 32.7202 16.408 33.362C16.6957 33.9265 17.1546 34.3854 17.7191 34.673C18.3608 35 19.2009 35 20.8811 35Z" stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</div>
								</div>
								<div class="context">
									<h3><?= $item['titulo']?></h3>

									<p><?= $item['tipo']?></p>
									
								</div>

							</a>
                    <?php
						endforeach;
					}	
					?>
                </div>
            </div>






            <div class="mt-32 itens-publicidade" id="dooh">
                <div class="flex gap-32 flex-wrap">
                    <?php
                    $ooh_dooh = get_field("ooh_dooh");
                    //php-error-log: [18-Mar-2025 17:11:05 UTC] PHP Warning:  Invalid argument supplied for foreach() in /var/www/sistemas/CR0313/wp-content/themes/portalcmsp-novo/single-publicidade.php on line 155
					if (!empty($ooh_dooh)) {
						foreach ($ooh_dooh as $video) :
							$oembed_url = $video['video'];
							if (!empty($oembed_url)) {
								// Regex para extrair o ID do vídeo do YouTube do URL oEmbed
								if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $oembed_url, $matches)) {
									$youtube_id = $matches[1];
								}
							}
							?>
							<div class="item" onclick="openVideoRedeCamara('<?php echo $youtube_id?>')">
								<div class="relative">
									<?php echo get_the_post_thumbnail(get_the_ID(), "large")?>
									<div class="abs">
										<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="0.243164" width="52" height="52" rx="26" fill="#FFF1F5" fill-opacity="0.85"/>
											<path d="M26.2432 36C31.766 36 36.2432 31.5228 36.2432 26C36.2432 20.4772 31.766 16 26.2432 16C20.7203 16 16.2432 20.4772 16.2432 26C16.2432 31.5228 20.7203 36 26.2432 36Z" stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M23.7432 22.9653C23.7432 22.488 23.7432 22.2494 23.8429 22.1162C23.9298 22.0001 24.0629 21.9274 24.2075 21.9171C24.3735 21.9052 24.5743 22.0343 24.9758 22.2924L29.6964 25.3271C30.0448 25.551 30.2189 25.663 30.2791 25.8054C30.3317 25.9298 30.3317 26.0702 30.2791 26.1946C30.2189 26.337 30.0448 26.449 29.6964 26.6729L24.9758 29.7076C24.5743 29.9657 24.3735 30.0948 24.2075 30.0829C24.0629 30.0726 23.9298 29.9999 23.8429 29.8838C23.7432 29.7506 23.7432 29.512 23.7432 29.0347V22.9653Z" stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</div>
								</div>
								<div class="context">
									<h3>
										<?= $video['titulo']?>
									</h3>
									<p>
										Filme de <?= $video['duracao']?>
									</p>
								</div>

							</div>
                    <?php
						endforeach;
					}	
					?>
                </div>
            </div>






            <div class="mt-32 itens-publicidade banner-internet" id="ooh" style="display: none">
                <div class="flex gap-32 flex-wrap">
                    <?php
                    $ooh = get_field("ooh");
                    //php-error-log: [18-Mar-2025 17:11:05 UTC] PHP Warning:  Invalid argument supplied for foreach() in /var/www/sistemas/CR0313/wp-content/themes/portalcmsp-novo/single-publicidade.php on line 198
					if (!empty($ooh)) {
						foreach ($ooh as $item) :
							$file = wp_get_attachment_image_url($item["postagem"], "full");
							?>
							<a class="item banner-internet" href="<?= $file?>" target="_blank">
								<div class="relative">
									<?php echo wp_get_attachment_image($item["postagem"], "large");?>
									<div class="abs">
										<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="0.0810547" width="52" height="52" rx="26" fill="#FFF1F5" fill-opacity="0.85"/>
											<path d="M18.3531 34.7279L24.9497 28.1314C25.3457 27.7354 25.5437 27.5373 25.772 27.4632C25.9729 27.3979 26.1892 27.3979 26.3901 27.4632C26.6184 27.5373 26.8164 27.7354 27.2124 28.1314L33.765 34.6839M28.0811 29L30.9497 26.1314C31.3457 25.7354 31.5437 25.5373 31.772 25.4632C31.9729 25.3979 32.1892 25.3979 32.3901 25.4632C32.6184 25.5373 32.8164 25.7354 33.2124 26.1314L36.0811 29M24.0811 23C24.0811 24.1046 23.1856 25 22.0811 25C20.9765 25 20.0811 24.1046 20.0811 23C20.0811 21.8954 20.9765 21 22.0811 21C23.1856 21 24.0811 21.8954 24.0811 23ZM20.8811 35H31.2811C32.9612 35 33.8013 35 34.443 34.673C35.0075 34.3854 35.4665 33.9265 35.7541 33.362C36.0811 32.7202 36.0811 31.8802 36.0811 30.2V21.8C36.0811 20.1198 36.0811 19.2798 35.7541 18.638C35.4665 18.0735 35.0075 17.6146 34.443 17.327C33.8013 17 32.9612 17 31.2811 17H20.8811C19.2009 17 18.3608 17 17.7191 17.327C17.1546 17.6146 16.6957 18.0735 16.408 18.638C16.0811 19.2798 16.0811 20.1198 16.0811 21.8V30.2C16.0811 31.8802 16.0811 32.7202 16.408 33.362C16.6957 33.9265 17.1546 34.3854 17.7191 34.673C18.3608 35 19.2009 35 20.8811 35Z" stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</div>
								</div>
								<div class="context">
									<h3><?= $item['titulo']?></h3>

									<p><?= $item['tipo']?></p>
									
								</div>

							</a>
                    <?php
						endforeach;
					}	
					?>
                </div>
            </div>




            <div class="mt-32 itens-publicidade banner-internet" id="redes-sociais" style="display: none">
                <div class="flex gap-32 flex-wrap">
                    <?php
                    $redes_sociais = get_field("redes_sociais");
                    //php-error-log: [18-Mar-2025 17:11:05 UTC] PHP Warning:  Invalid argument supplied for foreach() in /var/www/sistemas/CR0313/wp-content/themes/portalcmsp-novo/single-publicidade.php on line 230
					if (!empty($redes_sociais)) {
						foreach ($redes_sociais as $item) :
							$file = wp_get_attachment_image_url($item["postagem"], "full");
							?>
							<a class="item banner-internet" href="<?= $file?>" target="_blank">
								<div class="relative">
									<?php echo wp_get_attachment_image($item["postagem"], "large");?>
									<div class="abs">
										<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="0.0810547" width="52" height="52" rx="26" fill="#FFF1F5" fill-opacity="0.85"/>
											<path d="M18.3531 34.7279L24.9497 28.1314C25.3457 27.7354 25.5437 27.5373 25.772 27.4632C25.9729 27.3979 26.1892 27.3979 26.3901 27.4632C26.6184 27.5373 26.8164 27.7354 27.2124 28.1314L33.765 34.6839M28.0811 29L30.9497 26.1314C31.3457 25.7354 31.5437 25.5373 31.772 25.4632C31.9729 25.3979 32.1892 25.3979 32.3901 25.4632C32.6184 25.5373 32.8164 25.7354 33.2124 26.1314L36.0811 29M24.0811 23C24.0811 24.1046 23.1856 25 22.0811 25C20.9765 25 20.0811 24.1046 20.0811 23C20.0811 21.8954 20.9765 21 22.0811 21C23.1856 21 24.0811 21.8954 24.0811 23ZM20.8811 35H31.2811C32.9612 35 33.8013 35 34.443 34.673C35.0075 34.3854 35.4665 33.9265 35.7541 33.362C36.0811 32.7202 36.0811 31.8802 36.0811 30.2V21.8C36.0811 20.1198 36.0811 19.2798 35.7541 18.638C35.4665 18.0735 35.0075 17.6146 34.443 17.327C33.8013 17 32.9612 17 31.2811 17H20.8811C19.2009 17 18.3608 17 17.7191 17.327C17.1546 17.6146 16.6957 18.0735 16.408 18.638C16.0811 19.2798 16.0811 20.1198 16.0811 21.8V30.2C16.0811 31.8802 16.0811 32.7202 16.408 33.362C16.6957 33.9265 17.1546 34.3854 17.7191 34.673C18.3608 35 19.2009 35 20.8811 35Z" stroke="#A15B42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</div>
								</div>
								<div class="context">
									<h3><?= $item['titulo']?></h3>

									<p><?= $item['tipo']?></p>
									
								</div>

							</a>
                    <?php
						endforeach;
					}	
					?>
                </div>
            </div>




        </div>
    </div>
</div>
<script>
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

    jQuery(".options a").click(function () {
        jQuery(".options a").removeClass("act");
        jQuery(this).addClass("act");

        jQuery(".itens-publicidade").hide();
        jQuery("#"+jQuery(this).attr("data-id")).show();

        return false;
    })
</script>
<style>
    .gap-16 {
        gap: 16px;
    }

    .gap-32 {
        gap:32px
    }

    #inner-content {
        padding-bottom: 60px;
    }

    .itens-publicidade .item {
        text-decoration: none;
        cursor: pointer;
        max-width: 255px !important;
    }
    .itens-publicidade .item .relative {
        position: relative;
    }
    .itens-publicidade .item .abs {
        position: absolute;
        top: calc(50% - 26px);
        left: calc(50% - 26px);
    }
    .itens-publicidade .item.banner-internet img {
        object-fit: contain !important;
        background: #ffebeb;
    }
    .itens-publicidade .item img {
        width: 255px !important;
        height: 143px !important;
        object-fit: cover;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }
    .itens-publicidade .item .context {
        padding: 16px;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
        background: var(--Primary-Extra-Color-5, #fff1f5);
        text-align: center;
    }
    .itens-publicidade .item .context h3 {
        overflow: hidden;
        color: var(--Neutral-Black, #212121);
        text-overflow: ellipsis;
        line-clamp: 2;
        font-family: Montserrat, sans-serif;
        font-size: 16px;
        font-style: normal;
        font-weight: 600;
        line-height: 24px;
        /* 133.333% */
    }
    .itens-publicidade .item .context p {
        color: var(--Neutral-Black, #212121);
        font-family: Inter, sans-serif;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 5px;
    }

    .options a {
        color: var(--Primary-Accent-Color, #7F1A22);
        font-family: Inter, sans-serif;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 24px; /* 150% */
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 50px;
        transition: all ease-in-out 300ms;
        border: 1px solid var(--Primary-Accent-Color, #7F1A22);
    }

    .options a:hover {
        background-color: #b8b8b8;
    }

    .options a.act {
        background-color: #7F1A22;
        color: white;
    }
</style>

<?php get_footer(); ?>