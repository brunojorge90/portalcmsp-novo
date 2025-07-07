<?php
/*
 * CUSTOM POST TYPE TEMPLATE
 *
 * This is the custom post type post template. If you edit the post type name, you've got
 * to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is "register_post_type( 'bookmarks')",
 * then your single template should be single-bookmarks.php
 *
 * Be aware that you should rename 'custom_cat' and 'custom_tag' to the appropiate custom
 * category and taxonomy slugs, or this template will not finish to load properly.
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header();
$postId = get_the_ID();
$title = get_the_title();
?>

<?php
//PERÍODO ELEITORAL DEMANDA OCULTAÇÃO DE DADOS COM REFERÊNCIA A CAMPANHA
$periodo_eleitoral = false;
$genero = get_field("genero") === "feminino" ? "f" : "m";
// see whatever is the current filter and set a default
$filter = 'default';
if (isset($_GET['filtro'])) {
    $filter = $_GET['filtro'];
}
//DEBUG: echo '<p>filtro=' . $filter . '</p>';

//2021-03-09: filtros existentes: default e simples
?>

<?php
// por padrão, mostrar breadcrumbs
if (strcmp($filter, 'default') == 0) {

    ?>
    <!--<div class="breadcrumbs cf">
		<?php if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p class="wrap cf">', '</p>');
    } ?>
	</div> -->
    <?php
}

$vereador_name = get_post_meta($post->ID, '_cmsp_vereador_name', true);
if ($vereador_name == '') $vereador_name = get_the_title();

$vereador_image = get_post_meta($post->ID, '_cmsp_vereador_image', true);
$vereador_party = get_post_meta($post->ID, '_cmsp_vereador_party', true);
$page_path = strtolower("partidos/" . $vereador_party);
$partido = get_page_by_path(basename(untrailingslashit($page_path)), OBJECT, 'partidos');
$logo = get_field("logo_pequeno", $partido->ID);

$vereador_bio = get_post_meta($post->ID, '_cmsp_vereador_biografia', true);

$vereador_tel = get_post_meta($post->ID, '_cmsp_vereador_contato_telefone', true);
$vereador_ramal = get_post_meta($post->ID, '_cmsp_vereador_contato_ramal', true);
$vereador_fax = get_post_meta($post->ID, '_cmsp_vereador_contato_fax', true);
$vereador_andar = get_post_meta($post->ID, '_cmsp_vereador_contato_andar', true);
$vereador_sala = get_post_meta($post->ID, '_cmsp_vereador_contato_sala', true);
$vereador_email = get_post_meta($post->ID, '_cmsp_vereador_contato_email', true);
$vereador_website = get_post_meta($post->ID, '_cmsp_vereador_contato_site', true);
$vereador_facebook = get_post_meta($post->ID, '_cmsp_vereador_contato_facebook', true);
$vereador_instagram = get_post_meta($post->ID, '_cmsp_vereador_contato_instagram', true);
$vereador_twitter = get_post_meta($post->ID, '_cmsp_vereador_contato_twitter', true);
$vereador_youtube = get_post_meta($post->ID, '_cmsp_vereador_contato_youtube', true);
$vereador_whatsapp = get_post_meta($post->ID, '_cmsp_vereador_contato_whatsapp', true);
$vereador_ativo = get_post_meta($post->ID, '_cmsp_vereador_ativo', true);

$legacy_ID = get_post_meta($post->ID, '_cmsp_vereador_legacy_id', true);
$splegis_ID = get_post_meta($post->ID, '_cmsp_vereador_consulta_splegis_id', true);
?>

    <div id="content" class="<?php if (strcmp($filter, 'simples') == 0) { ?>filtro-simples<?php } ?>">
        <input id="splegisID" type="hidden" value="<?= $splegis_ID ?>"/>
        <article id="post-<?php the_ID(); ?>" <?php post_class('vereador-entry cf'); ?> data-id="<?= $legacy_ID ?>"
                 role="article" >
            <section id="cover-vereador" class="w100">
                <div class="config-image-bg w100">
                    <?php
                    $image = get_field('imagem_de_fundo');

                    if($image) {?>
                        <img src="<?php echo $image?>" alt="Imagem do vereador <?php echo get_the_title()?>"
                             class="w100">
                    <?php } else {?>
                        <img alt="Imagem do vereador <?php echo get_the_title()?>" src="<?php echo get_template_directory_uri() ?>/dist/images/img-cover-vereador-exemplo.jpg"
                             class="w100">
                    <?php }
                    ?>


                    <div class="abs mt-32">
                        <div class="container">
                            <div class="desktop-body-3">
                                <ul>
                                    <li><a href="#">Home</a></li>
                                    <li>/</li>
                                    <li>
                                        <a href="<?php echo get_site_url()?>/vereadores">Vereadores</a>
                                    </li>
                                    <li>/</li>
                                    <li>
                                        <strong>
                                            <?php the_title(); ?>
                                        </strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <section id="infos-vereador">
                <div class="abs">
                    <div class="container">
                        <div class="sobre-vereador">
                            <div class="foto-perfil-vereador">
                                <img src="<?php echo $vereador_image ?>" alt="foto do vereador" class="w100">
                            </div>
                            <div class="textos-vereador mt-24">
                                <h1 class="desktop-headeline-3"><?php the_title() ?></h1>
                                <p class="desktop-body-1 mt-16 flex align-center g-24 justify-center">
                                    <?= $genero === "f" ? "Vereadora" : "Vereador"?> pelo
                                    <?php if (!empty($logo['url'])) : ?>
                                        <img src="<?=$logo['url']?>" width="40" title="<?=$vereador_party?>" style="margin:0" />
                                    <?php
                                    else :?>
                                        partido <span><?php echo $partido->post_name ?></span>
                                    <?php endif;?>
                                </p>
                                <div class="desktop-body-2 mt-32 bio lines4">
                                    <?php if (trim($vereador_ativo) != 'on') { ?>
                                        <h3>ATENÇÃO: <?= $genero === "f" ? "Esta vereadora está licenciada" : "Este vereador esta licenciado"?> ou pertence a uma legislatura anterior à
                                            atual. Acesse a relação de Parlamentares em exercício <a
                                                    href="https://www.saopaulo.sp.leg.br/vereadores/">aqui.</a></h3>
                                    <?php } ?>
                                    <?php if ($periodo_eleitoral) { //ELEIÇÕES - NÃO PODE TER LINK PARA MTERIAL DE CAMPANHA  ?>
                                        <p><strong>Conteúdo temporariamente removido para atendimento da Legislação Eleitoral</strong></p>
                                        <?php if (trim($vereador_ativo) == 'on') { ?>
                                            <!-- <p>Você pode contactar diretamente o gabinete <?= $genero === "f" ? "da vereadora" : "do vereador"?>.<br/>
                                                Contatos ao lado</p> -->
                                        <?php } ?>
                                    <?php } else { //ELEIÇÕES ?>
                                        <?php if (trim($vereador_bio) != '') { ?>
                                            <span class="br-not"><?= wpautop($vereador_bio) ?></span>
                                            <span class="notalegal">Nota: Este texto foi produzido por e é de responsabilidade do gabinete de <?= $vereador_name ?>.</span>
                                        <?php } ?>
                                    <?php } //ELEIÇÕES ?>
                                </div>
                                <a href="#" class="button-tertiary mt-32 continue-lendo"
                                   onclick="jQuery('.lines4').removeClass('lines4');jQuery(this).hide();return false">Continue
                                    lendo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="midia-vereador">
                <div class="container">
                    <div class="noticias-vereador">
                        <h2 class="desktop-headeline-4">
                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-noticia.svg" alt="icone">
                            Últimas notícias relacionadas com <?= $genero === "f" ? "a vereadora" : "o vereador"?>
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

                    <div class="videos-vereador w100">
                        <?php
                        $videos = $NewTheme->getVideosByVereador($vereador_name, $postId);
                        ?>
                        <h2 class="desktop-headeline-4">
                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-video.svg" alt="icone">
                            Vídeos <?= $genero === "f" ? "com a vereadora" : "com o vereador"?>
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
            </section>

            <?php
            $id_playlist = get_field('id_playlist', $postId);

            if($id_playlist) :
                ?>
                <section id="midia-vereador">
                    <div class="container">
                        <div class="videos-vereador w100">
                            <h2 class="desktop-headeline-4">
                                <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-video.svg" alt="icone">
                                Pronunciamentos <?= $genero === "f" ? "da vereadora" : "do vereador"?>
                            </h2>

                            <div class="galeria-videos videos-itens">
                            </div>

                            <a href="https://www.youtube.com/playlist?list=<?php echo $id_playlist?>" class="button-secondary w100 text-decoration-none mt-24" target="_blank">
                                Clique para acessar todos os pronunciamentos
                            </a>
                        </div>
                    </div>

                    <script>
                        <?php $youtube = get_field('youtube')?>
                        jQuery.get("<?php echo get_site_url()?>/wp-json/youtube-api/v1/playlist/<?php echo $id_playlist?>?maxResults=<?php echo 12?>", function (data) {
                            // Handle the JSON data here
                            var items = data;
                            items.forEach((z) => {
                                console.log(z);
                                var html = '<a href="#" class="video-individual" onclick="return openVideoRedeCamara(\''+z.snippet.resourceId.videoId+'\')">' +
                                    '<div><img src="'+z.snippet.thumbnails.medium.url+'" alt=""></div>' +
                                    '<span class="desktop-body-3">' +
                                    '<h3>'+z.snippet.title+'</h3>' +
                                    '</span>' +
                                    '</a>';
                                jQuery(html).appendTo(".videos-itens");
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
                </section> 
            <?php endif?>
            <section id="infos-vereador">
                <div class="abs not-abs">
                    <div class="container">
                        <div class="projetos-leis mt-32 vereador-projects">
                            <div class="card-projetos">
                                <h2 class="desktop-headeline-4">
                                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-grafico.svg"
                                         alt="icone">
                                    Projetos em tramitação
                                </h2>
                                <article class="box-vereador-projects-chart">
                                    <canvas class="vereador-projects-chart" width="200" height="200"
                                            data-label="Em Tramitação"></canvas>
                                </article>
                                <footer class="box-vereador-projects-list infos-projetos mt-16"
                                        id="box-vereador-projects-processing">
                                    <?php if (trim($splegis_ID) != '') { ?>
                                        <div class='loading'>Carregando...</div><?php } ?>
                                </footer>
                                <div class="infos-projetos mt-24">
                                    <a href="/wp-content/uploads/php/vereador_projetos.php?vereador=<?= $splegis_ID ?>&tipo=T"
                                       class="button-secondary w100 cmsp-lightbox-iframe cmsp-lightbox"
                                       data-title="<?php the_title(); ?> - Projetos em tramitação">Veja Mais
                                    </a>
                                </div>
                            </div>

                            <div class="card-projetos">
                                <h2 class="desktop-headeline-4">
                                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-tribunal.svg"
                                         alt="icone">
                                    Leis aprovadas
                                </h2>
                                <article class="box-vereador-projects-chart">
                                    <canvas class="vereador-projects-chart" width="200" height="200"
                                            data-label="Aprovados"></canvas>
                                </article>
                                <footer class="box-vereador-projects-list infos-projetos mt-16"
                                        id="box-vereador-projects-approved">
                                    <?php if (trim($splegis_ID) != '') { ?>
                                        <div class='loading'>Carregando...</div><?php } ?>
                                </footer>
                                <div class="infos-projetos mt-24">
                                    <a href="/wp-content/uploads/php/vereador_projetos.php?vereador=<?= $splegis_ID ?>&tipo=A"
                                       class="button-secondary w100 cmsp-lightbox-iframe cmsp-lightbox"
                                       data-title="<?php the_title(); ?> - Leis aprovadas">Veja Mais
                                    </a>
                                </div>
                            </div>

                            <div class="card-projetos">
                                <h2 class="desktop-headeline-4">
                                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-vetado.svg"
                                         alt="icone">
                                    Projetos vetados
                                </h2>
                                <article class="box-vereador-projects-chart">
                                    <canvas class="vereador-projects-chart" width="200" height="200"
                                            data-label="Vetados"></canvas>
                                </article>
                                <footer class="box-vereador-projects-list infos-projetos mt-16"
                                        id="box-vereador-projects-denied">
                                    <?php if (trim($splegis_ID) != '') { ?>
                                        <div class='loading'>Carregando...</div><?php } ?>
                                </footer>
                                <div class="infos-projetos mt-24">
                                    <a href="/wp-content/uploads/php/vereador_projetos.php?vereador=<?= $splegis_ID ?>&tipo=V"
                                       class="button-secondary w100 cmsp-lightbox-iframe cmsp-lightbox"
                                       data-title="<?php the_title(); ?> - Projetos vetados">Veja Mais
                                    </a>
                                </div>
                            </div>

                        </div>
                        <?php
                        global $Integracoes;
                        $dadosAusencia = $Integracoes->GetAusencias(['id' => $splegis_ID]);
                        ?>
                        <div class="frequencia-vereador mt-32">
                            <?php if(!get_field('presenca_na_camara', $postId)) : ?>
                                <div class="card-frequencia">
                                    <h2 class="desktop-headeline-4">
                                        <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-calendario.svg"
                                             alt="icone">
                                        Presença na Câmara
                                    </h2>
                                    <strong class="desktop-headeline-1"><?php echo $dadosAusencia['presente'] ?></strong>
                                    <span class="desktop-headeline-4">dias</span>
                                </div>
                            <?php endif ?>
                            <?php if(!get_field('faltas_justificadas', $postId)) : ?>
                                <div class="card-frequencia">
                                    <h2 class="desktop-headeline-4">
                                        <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-calendario-check.svg"
                                             alt="Ausências Justificadas">
                                        Ausências justificadas
                                    </h2>
                                    <strong class="desktop-headeline-1"><?php echo $dadosAusencia['justificadas'] ?></strong>
                                    <span class="desktop-headeline-4">dias</span>
                                </div>
                            <?php endif?>
                            <?php if(!get_field('faltas_nao_justificadas', $postId)) : ?>
                                <div class="card-frequencia">
                                    <h2 class="desktop-headeline-4">
                                        <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-calendario-deny.svg"
                                             alt="icone">
                                        Ausências não justificadas
                                    </h2>
                                    <strong class="desktop-headeline-1"><?php echo $dadosAusencia['faltas'] ?></strong>
                                    <span class="desktop-headeline-4">dias</span>
                                </div>
                            <?php endif?>
                        </div>
                        <!--<div class="verba-gabinete mt-32">
                            <h2 class="desktop-headeline-4">
                                <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-busca-dinheiro.svg" alt="icone">
                                Verba de gabinete
                             </h2>

                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/grafico-1-exemplo.svg" alt="gráfico" class="w100" style="max-width: 1013px;">

                            <div class="detalhes-grafico">
                                <h4 class="desktop-headeline-4">
                                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-legenda.svg" alt="icone">
                                    Legenda
                                </h4>

                                <div class="infos-legenda">
                                    <div class="itens-legenda">
                                        <span class="desktop-body-3 verba-consumida">Verba consumida até o momento</span>
                                        <span class="desktop-body-3 verba-total">Verba total de 2023</span>
                                    </div>

                                    <a href="#" class="mobile-body-3 button-tertiary">
                                        Mais detalhes
                                        <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>

            </section>

            <section id="contato-agenda-vereador">
                <div class="container">
                    <div class="contato-vereador" id="contato">
                        <h2 class="desktop-headeline-4">
                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-profile.svg" alt="icone">
                            <span class="lines1">
                                Fale com <?= $genero === "f" ? "a vereadora" : "o vereador"?> <?php echo get_the_title($postId) ?>
                            </span>
                        </h2>
                        <div class="mensagem-contato">
                            <nav class="flex-col flex nav desktop-body-3">
                                <a href="#" class="col active" toggle-class="todos">
                                    Todos os contatos
                                </a>
                                <a href="#" class="desktop-body-3 col" toggle-class="enviar">
                                    Enviar mensagem
                                </a>

                            </nav>

                            <div class="context enviar d-none">
                                <h3 class="desktop-headeline-4">
                                    Participe do mandato <?= $genero === "f" ? "da vereadora" : "do vereador"?> com propostas, sugestões e receba informativos.
                                </h3>
                                <?php
                                //id anterior = 121010
                                wp_reset_query();
                                $form = do_shortcode('[contact-form-7 id="13f818a" title="Mandato Participativo"]');
                                $form = str_replace("<p role=\"status\" aria-live=\"polite\" aria-atomic=\"true\">", "<p role=\"status\" aria-live=\"polite\" aria-atomic=\"true\">Resposta", $form);
                                $form = str_replace("<div class=\"wpcf7-response-output\" aria-hidden=\"true\">", "<div class=\"wpcf7-response-output\" aria-hidden=\"true\">Resposta:", $form);
                                $form = str_replace("<p><span class=\"form-left\"><input", "<p><span class=\"form-left\"><span style='text-indent: -1000px;display:block'>Resposta:</span><input", $form);
                                echo $form;
                                ?>
                            </div>
                            <div class="context todos" >
                                <?php if (trim($vereador_ativo) == 'on'): ?>
                                    <div class="vereador-data">
                                        <h3 class="desktop-headeline-4">Fale <?= $genero === "f" ? "com sua vereadora" : "com seu vereador"?> </h3>
                                        <ul>
                                            <?php if (trim($vereador_tel) != '') { ?>
                                                <li><strong>Telefone:</strong> <?= $vereador_tel ?></li>
                                            <?php } ?>

                                            <?php if (trim($vereador_ramal) != '') { ?>
                                                <li><strong>Ramal:</strong> <?= $vereador_ramal ?></li>
                                            <?php } ?>

                                            <?php if (trim($vereador_fax) != '') { ?>
                                                <li><strong>FAX:</strong> <?= $vereador_fax ?></li>
                                            <?php } ?>
                                            <?php if (trim($vereador_whatsapp) != '') {
                                                if (strpos($vereador_whatsapp, 'http') > -1) {//https://www.saopaulo.sp.leg.br/vereador/toninho-vespoli/  -> http://bit.ly/ZapdoToninho ?>
                                                    <li><strong>WhatsApp:</strong> <a target="_blank"
                                                                                      href="<?= $vereador_whatsapp ?>"><?= $vereador_whatsapp ?></a>
                                                    </li>
                                                <?php } else { //https://www.saopaulo.sp.leg.br/vereador/fernando-holiday/   ->   WhatsApp: (0xx11) 97664-0324?>
                                                    <li><strong>WhatsApp:</strong> <?= $vereador_whatsapp ?></li>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php if (trim($vereador_email) != '') { ?>
                                                <li><strong>E-mail:</strong> <a
                                                            href='mailto:"<?= $vereador_email ?>"'><?= $vereador_email ?></a>
                                                </li>
                                            <?php } ?>

                                            <?php if (!$periodo_eleitoral && FALSE) { //ELEIÇÕES - NÃO PODE TER LINK PARA MTERIAL DE CAMPANHA | 2022-11-09: add:"&& FALSE" equipe portal pediu ocultação provisória por pedido da procuradoria?>

                                                <?php if (trim($vereador_website) != '') { ?>
                                                    <li><strong>Site Oficial:</strong> <a target="_blank"
                                                                                          href="<?= $vereador_website ?>"><?= $vereador_website ?></a>
                                                    </li>
                                                <?php } ?>
                                                <?php if (trim($vereador_facebook) != '') { ?>
                                                    <li><strong>Facebook:</strong> <a target="_blank"
                                                                                      href="<?= $vereador_facebook ?>"><?= $vereador_facebook ?></a>
                                                    </li>
                                                <?php } ?>
                                                <?php if (trim($vereador_instagram) != '') { ?>
                                                    <li><strong>Instagram:</strong> <a target="_blank"
                                                                                       href="<?= $vereador_instagram ?>"><?= $vereador_instagram ?></a>
                                                    </li>
                                                <?php } ?>
                                                <?php if (trim($vereador_twitter) != '') { ?>
                                                    <li><strong>Twitter:</strong> <a target="_blank"
                                                                                     href="<?= $vereador_twitter ?>"><?= $vereador_twitter ?></a>
                                                    </li>
                                                <?php } ?>
                                                <?php if (trim($vereador_youtube) != '') { ?>
                                                    <li><strong>Youtube:</strong> <a target="_blank"
                                                                                     href="<?= $vereador_youtube ?>"><?= $vereador_youtube ?></a>
                                                    </li>
                                                <?php } ?>
                                            <?php } //ELEIÇÕES ?>

                                            <li>
                                                <strong>Endereço para correspondência:</strong>
                                                Câmara Municipal de São Paulo - Palácio Anchieta - Viaduto Jacareí, 100 -
                                                CEP 01319-900
                                            </li>
                                            <?php if (trim($vereador_andar) != '') { ?>
                                                <li><strong>Andar:</strong> <?= $vereador_andar ?></li>
                                            <?php } ?>
                                            <?php if (trim($vereador_sala) != '') { ?>
                                                <li><strong>Sala:</strong> <?= $vereador_sala ?></li>
                                            <?php } ?>
                                        </ul>
                                        <?php if (trim($vereador_email) != '') { ?>
                                            <input type="hidden" name="vereador_email" value="<?= $vereador_email ?>"/>
                                        <?php } ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="agenda-vereador">
                        <h2 class="desktop-headeline-4">
                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-calendario-mini.svg"
                                 alt="icone">
                            <span class="lines1">
                            Acompanhe a agenda <?= $genero === "f" ? "da vereadora" : "do vereador"?> <?php echo get_the_title($postId) ?>
                            </span>
                        </h2>

                        <div class="agenda-completa">
                            <?php
                            global $NewTheme;
                            $dataa = date('Ymd');
                            $args = array(
                                'posts_per_page' => -1,
                                'post_type' => 'agenda_cerimonial',
                                'meta_key' => 'data',
                                'meta_query' => array(
                                    array(
                                        'key' => 'data',
                                        'value' => $dataa,
                                        'compare' => '>=',
                                        'type' => 'DATE'
                                    ),
                                )
                            );
                            $eventos_ = [];
                            function customorderby($orderby)
                            {
                                return 'mt1.meta_value ASC';
                            }
                            $tem = 0;
                            add_filter('posts_orderby', 'customorderby');
                            $the_query = new WP_Query($args);
                            remove_filter('posts_orderby', 'customorderby');

                            if ($the_query->have_posts()):
                                $data = '';
                                $i = 0;

                                while ($the_query->have_posts() && $i < 3) {

                                    $the_query->the_post();
                                    $datah = get_field('data');

                                    // exibir todos os eventos da data atual, mesmo eventos finalizados
                                    #$dataa = date("YmdHi");
                                    #$dataa = date("Ymd");
                                    $i_event = 0;
                                    //Listar eventos
                                    while (have_rows("eventos-listagem")) :
                                        $i_event++;
                                        the_row();
                                        $descricao = array_values(get_sub_field("local_campos"))[0];
                                        $horario = array_values(get_sub_field("horario"))[0];

                                        $hora = $horario['horario_inicio'];

                                        if ($horario['horario_fim']) {
                                            $hora = $horario['horario_fim'];
                                        }

                                        // exibir todos os eventos da data atual, mesmo eventos finalizados
                                        #$datac = $datah . $hora;
                                        $datac = $datah;

                                        // exibir todos os eventos da data atual, mesmo eventos finalizados
                                        #if ($datac = $dataa) {
                                        if ($datac >= $dataa) {
                                            $value = $descricao['local'];
                                            $label = '';
                                            while (have_rows("local_campos")) : the_row();
                                                $field = get_sub_field_object('local');
                                                $label = $field['choices'][$value];
                                            endwhile;

                                            //https://developer.wordpress.org/reference/functions/get_permalink/
                                            //Return (string|false) The permalink URL or false if post does not exist.
                                            //String diferente de uma string vazia e a string "0" é TRUE
                                            //https://www.php.net/manual/pt_BR/language.types.boolean.php
                                            if (get_permalink($value)) {
                                                $local = '<a href="' . get_permalink($value) . '">' . $label . '</a>';
                                            } else {
                                                $local = $label;
                                            }
                                            if ($data != $datah) {
                                                if ($i > 0) {
                                                    ?>
                                                <?php } ?>
                                            <?php }
                                            $vereador_id = "";
                                            $vereadores_id = array();
                                            $vereador_true = false;
                                            while (have_rows("solicitante_campos")) : the_row();
                                                $vereadores = get_sub_field('sol_vereador');
                                                if ($vereadores): ?>
                                                    <?php foreach ($vereadores as $v): ?>
                                                        <?php array_push($vereadores_id, $vereador_id = $v->ID);
                                                        ?>
                                                    <?php endforeach; ?>
                                                <?php endif ?>
                                            <?php endwhile;
                                            if (in_array($postId, $vereadores_id)) :
                                                $eventos_[] = 'event';
                                                ?>
                                                <h3 class="desktop-headeline-4">
                                                    <?php
                                                    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                                                    date_default_timezone_set('America/Sao_Paulo');
                                                    $date = date_create(get_field('data'));
                                                    echo date_format($date, 'd');
                                                    ?>
                                                    <?php echo strftime('%B', strtotime(get_field('data'))); ?>
                                                </h3>
                                                <div class="item-agenda">
                                                    <h4 class="desktop-headeline-5 lines2"><?php echo $descricao['titulo']; ?></h4>

                                                    <div class="hora-local">
                                                    <span class="desktop-body-2"><strong>Horário:</strong> <?php echo $horario['horario_inicio']; ?><?php if ($horario['horario_fim']) {
                                                            echo " - " . $horario['horario_fim'];
                                                        } ?></span>
                                                        <span class="desktop-body-2"><strong>Local:</strong>
                                                          <?php echo $local; ?>
                                                            <?php if ($descricao['local_txt']) {
                                                                echo $descricao['local_txt'];
                                                            } ?>
                                                    </span>
                                                    </div>

                                                    <div class="acoes">
                                                        <a href="<?php echo get_permalink() ?><?php echo $i_event ?> "
                                                           class="button-secondary">Acessar evento</a>
                                                        <a href="<?php echo $NewTheme->getLinkEvent(get_field('data'), $horario['horario_inicio'], $horario['horario_fim'], $descricao['titulo'], $label) ?>"
                                                           class="button-tertiary">+ Cadastrar na agenda</a>
                                                    </div>
                                                </div>
                                            <?php
                                            endif;
                                            $tem = 1;
                                            $data = $datah;
                                            $i++;
                                        }
                                    endwhile;
                                }
                            endif;
                            if (!$tem || count($eventos_) == 0) {?>
                                <div class="w100">
                                    <div class="flex justify-center w100 n-eventos">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="64" height="64s">
                                            <path style="text-indent:0;text-align:start;line-height:normal;text-transform:none;block-progression:tb;-inkscape-font-specification:Bitstream Vera Sans" d="M 16 4 C 9.3844277 4 4 9.3844277 4 16 C 4 22.615572 9.3844277 28 16 28 C 22.615572 28 28 22.615572 28 16 C 28 9.3844277 22.615572 4 16 4 z M 16 6 C 21.534692 6 26 10.465308 26 16 C 26 21.534692 21.534692 26 16 26 C 10.465308 26 6 21.534692 6 16 C 6 10.465308 10.465308 6 16 6 z M 11.5 12 C 10.671573 12 10 12.671573 10 13.5 C 10 14.328427 10.671573 15 11.5 15 C 12.328427 15 13 14.328427 13 13.5 C 13 12.671573 12.328427 12 11.5 12 z M 20.5 12 C 19.671573 12 19 12.671573 19 13.5 C 19 14.328427 19.671573 15 20.5 15 C 21.328427 15 22 14.328427 22 13.5 C 22 12.671573 21.328427 12 20.5 12 z M 16 18 C 13.332659 18 10.979561 19.335501 9.53125 21.34375 L 11.15625 22.5 C 12.247939 20.986249 13.991341 20 16 20 C 18.008659 20 19.752061 20.986249 20.84375 22.5 L 22.46875 21.34375 C 21.020439 19.335501 18.667341 18 16 18 z" fill="#7f1a22" overflow="visible" font-family="Bitstream Vera Sans"/>
                                        </svg>
                                    </div>
                                    <h2 style='margin-bottom:0px;display: block;text-align: center;width: 100%;color:black'>Não há eventos programados</h2>
                                </div>
                            <?php }
                            wp_reset_query();
                            ?>
                        </div>

                    </div>
                </div>
            </section>
            <script>
                function openVideoContent(videoId, link) {
                    var html = "<div class='popupflex'>" +
                        "<div class='flex'>" +
                        "<div class='contentPopup'>" +
                        '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><mask id="mask0_1029_46344" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="30"> <rect x="0.547363" y="0.613281" width="28.8397" height="28.8397" fill="#D9D9D9"></rect> </mask> <g mask="url(#mask0_1029_46344)"> <path d="M8.23798 23.4447L6.55566 21.7624L13.2849 15.0332L6.55566 8.3039L8.23798 6.62158L14.9672 13.3508L21.6965 6.62158L23.3788 8.3039L16.6496 15.0332L23.3788 21.7624L21.6965 23.4447L14.9672 16.7155L8.23798 23.4447Z" fill="#FFF1F5"></path> </g> </svg>' +
                        "<iframe border='0' src='https://www.youtube.com/embed/" + videoId + "' ></iframe>" +
                        "<a href='" + link + "' target='blank' style='display: block;width: 100%;margin-top: 20px;text-align: center'> Mais detalhes </a>" +
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
        </article>
    </div>

    <style>

        body.theme-v2 #infos-vereador .abs .container .sobre-vereador .textos-vereador p { text-align: justify !important;  }


        /******* estilos específicos para o filtro de visualização simples em single-vereador.php ******/
        @media only screen and (max-width: 768px) {
            .filtro-simples .section-title h2 {
                font-size: 2em;
                line-height: 2em;
                font-weight: bolder;
                text-transform: uppercase;
                padding: 15px 0;
                position: relative;
                text-align: center;
            }

            .filtro-simples .vereador-profile-thumb .vereador-picture img {
                display: block;
                width: 100%;
                border: none;
                border-bottom: 3px solid #7F1A22;
            }

            .filtro-simples .vereador-profile-thumb .vereador-name, .filtro-simples .vereador-profile-thumb .vereador-position, .vereador-profile-thumb .vereador-party {
                border: none;
            }

            .filtro-simples .vereador-profile-thumb .vereador-party:after {
                width: 0;
            }

            .filtro-simples .vereador-profile-thumb .vereador-name {
                width: 181px;
                padding-left: 5px;
                padding-top: 15px;
                font-size: 1em;
                float: right;
                border-left: none;
            }

            .filtro-simples .content-box-top {
                border: none;
            }

            .filtro-simples .content-box-top .content-box-title:before {
                border-right: none;
            }

            .filtro-simples aside#mandato-participativo {
                background: #e4e4e4;
                padding: 20px;
                width: calc(100% + 20px);
                margin: 0 0 0 -10px;
            }

            .filtro-simples .type-vereador .vereador-data li {
                margin: 0 0 10px 0;
                padding: 5px 10px;
                border-radius: 5px;
                background: #8f8f8f;
                color: #fff;
                font-size: 1.6rem;
            }

            .filtro-simples .type-vereador .vereador-data li a {
                color: #e4e4e4;
            }

            .filtro-simples .type-vereador .vereador-data li a:hover {
                color: #f1f1f1;
            }

            .filtro-simples .social-nav {
                width: auto;
                height: 42px;
                margin: 1.5em auto 10px;
                display: flex;
            }

            .filtro-simples .social-nav li {
                float: none;
                margin: 0;
                background: #8f8f8f;
                padding: 5px;
                margin-right: 5px;
                border-radius: 5px;
                text-align: center;
                flex-basis: calc(100% - 5px);
            }

            .filtro-simples button, html .filtro-simples input[type="button"], .filtro-simples input[type="reset"], .filtro-simples input[type="submit"] {
                -webkit-appearance: button;
                cursor: pointer;
                width: 100%;
                background: #b50101;
                border-radius: 7px;
                border: none;
                font-weight: bolder;
                text-transform: uppercase;
                padding: 5px 10px;
                color: #fff;
            }

            .notalegal {
                font-size: 0.75em;
                margin-top: 20px;
                display: block;
            }

            .filtro-simples .social-nav li.facebook a, .filtro-simples .social-nav li.facebook a:hover {
                background: url(https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/04/redessociais.png) 0 0 no-repeat;
            }

            .filtro-simples .social-nav li.twitter a, .filtro-simples .social-nav li.twitter a:hover {
                background: url(https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/04/redessociais.png) 0 -32px no-repeat;
            }

            .filtro-simples .social-nav li.instagram a, .filtro-simples .social-nav li.instagram a:hover {
                background: url(https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/04/redessociais.png) 0 -64px no-repeat;
            }

            .filtro-simples .social-nav li.youtube a, .filtro-simples .social-nav li.youtube a:hover {
                background: url(https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/04/redessociais.png) 0 -96px no-repeat;
            }
        }

        @media only screen and (min-width: 768px) {
            .filtro-simples .type-vereador .vereador-contact {
                clear: none;
                padding-left: 217px;
            }

            .filtro-simples .inner-secondary-header.wrap.cf {
                padding-left: 217px;
                text-align: center;
            }

            .filtro-simples .social-nav {
                height: 60px;
                text-align: center;
                clear: both;
            }

            .filtro-simples .type-vereador .vereador-data li a,
            .filtro-simples .type-vereador .vereador-data li a:hover {
                color: #7F1A22;
            }
        }

        @media only screen and (min-width: 1030px) {
            .filtro-simples .type-vereador .vereador-contact {
                padding-left: 0;
            }
        }

        .type-vereador .vereador-projects {
            padding-left: 0px;
        }

        .br-not br {
            display: none;
        }
    </style>
    
<?php get_footer(); ?>