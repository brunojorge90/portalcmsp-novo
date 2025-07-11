<?php
/**
 * [2024-02-02]: com o uso do plugin wp-optimize para cachear conteúdo os redirects via PHP ficaram intermitentes,
 * uma vez que quando a página passa a ser retornada da cache não se executa código PHP.
 * Para evitar esse problema, adicionamos redirect via HTML em <head> conforme:
 * https://developer.mozilla.org/en-US/docs/Web/HTTP/Redirections
 */
/**if(get_post_meta(get_the_ID(), '_cmsp_feature-page_link', true)) {
header("Location: " .get_post_meta(get_the_ID(), '_cmsp_feature-page_link', true));
}*/?>
<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?> <?php if(isset($_SESSION["font"]) && $_SESSION["font"]) echo "style=\"font-size:".$_SESSION["font"]."\""; ?> class="no-js"><!--<![endif]-->

<head>

    <?php
    /** [2024-02-02] Se configurado Redirect e a página tiver sido servida pelo plugin de cache,
    não ocorreria o redirecionamento via PHP, sendo preciso fazê-lo via HTML,
    que fica guardado na cache.
     */

    if(get_post_meta(get_the_ID(), '_cmsp_feature-page_link', true)) {

        echo "<meta http-equiv='Refresh' content='0; URL=".get_post_meta(get_the_ID(), '_cmsp_feature-page_link', true)."' />";

    }?>



    <!-- Hotjar Tracking Code for https://www.saopaulo.sp.leg.br/ -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:3709847,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <link rel="icon" href="https://www.saopaulo.sp.leg.br/wp-content/themes/portal-cmsp/favicon.png">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta name="adopt-website-id" content="8e7c58ce-4022-4974-ad46-008d7bb8bb71" />
    <script src="//tag.goadopt.io/injector.js?website_code=8e7c58ce-4022-4974-ad46-008d7bb8bb71"
            class="adopt-injector"></script>
    <!-- Google Tag Manager -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "h2vqbbd119");
    </script>
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TNTR2BS');</script>
    <!-- End Google Tag Manager -->

    <meta charset="utf-8">

    <?php // force Internet Explorer to use the latest rendering engine available ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php wp_title(''); ?></title>

    <?php // mobile meta (hooray!) ?>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <?php // FB Open Graph tags ?>
    <?php
    if (isset($post) and is_object($post)) {
        $rg_post = $post->ID;
        $post_data = get_post($rg_post);
        $excerpt = $post_data->post_excerpt;
        if (!$excerpt) $excerpt = get_bloginfo('description');
        //$excerpt = preg_replace('/\[span class=\"media-credit\"\](.*?)\[\/span\]/is',"",$excerpt);
        //$excerpt = wp_strip_all_tags($excerpt);
    }
    ?>
    <!--
		<?php echo get_permalink(); ?>
	-->
    <meta name="description" content="<?php bloginfo('description'); ?>"/>
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?>"/>
    <meta property="og:url" content="<?php if (isset($post) and is_object($post)) {
        echo get_permalink($post->ID);
    } ?>"/>
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
    <meta property="og:description" content="<?php if (isset($excerpt)) {
        echo $excerpt;
    } ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="fb:app_id" content="1501788923465105"/>
    <meta property="fb:pages" content="113507215403008"/>
    <?php if (is_single() && has_post_thumbnail($post->ID)) { ?>
        <meta property="og:image"
              content="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0]; ?>"/>
    <?php } elseif (catch_that_image()) { ?>
        <meta property="og:image" content="<?php echo catch_that_image(); ?>"/>
    <?php } else { ?>
        <meta property="og:image" content="/wp-content/themes/portal-cmsp/library/images/og-image.jpg"/>
    <?php } ?>

    <?php // icons & favicons (for more: https://www.jonathantneal.com/blog/understand-the-favicon/) ?>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
    <!--[if IE]>
    <![endif]-->
    <!-- canvas support for old IE -->
    <!--[if lte IE 8]>
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/libs/excanvas.compiled.js"></script>
	<![endif]-->
    <?php // or, set /favicon.ico for IE10 win ?>
    <meta name="msapplication-TileColor" content="#f01d4f">
    <meta name="msapplication-TileImage"
          content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

            <style>
        .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
        }
        </style>

    <?php // wordpress head functions ?>
    <?php wp_head(); ?>
    <?php // end of wordpress head ?>

    <?php // typekit function ?>
    <!--
    <script src="//use.typekit.net/eqp3auo.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    -->
    <?php // end typekit ?>

    <?php if (is_page(40456)): ?>
        <style>
            .entry-content td {
                padding: 0px;
            }

            span.wpcf7-not-valid-tip {
                margin: -73px 0px 53px 180px;
            }

            div.wpcf7-mail-sent-ok {
                border: 0px;
                font-size: 1.5em;
                padding-bottom: 40px;
                text-align: center;
            }


        </style>
    <?php endif; ?>
    <style>

        .schema-faq-question  {gap:32px}
        .schema-faq-question strong {
            font-size: 20px !important;
            color: #7f1a22;
            line-height: normal;
            display: block;
            cursor: pointer;
        }

        .grecaptcha-badge {
            display:none
        }
        
        .frequencia-vereador, .agenda-vereador {display:none !important}
    </style>
    <?php if (false): // trocar "false" por "is_page(11)" para reativar o popup "Regularização Imob." ?>
        <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/library/css/popup.css' type='text/css'
              media='all'/>
    <?php endif; ?>

    <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/library/css/simpletabs.css' type='text/css'
          media='all'/>
    <script src="<?php echo get_template_directory_uri(); ?>/library/js/simpletabs_1.3.js"></script>

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '408389713134760'); 
    fbq('track', 'PageView');
    </script>
    <noscript>
    <img height="1" width="1" 
    src="https://www.facebook.com/tr?id=408389713134760&ev=PageView
    &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->


    <!-- Google Webmaster -->
    <meta name="google-site-verification" content="OA27lFNtloM_YplcPLVfwgQ_4m7dWFmVthUpLgggFBY"/>
    <!-- end - Google Webmaster -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-57400553-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-57400553-1');
    </script>
    <!-- Google Analytics - end -->


</head>

<body <?php body_class(); ?>>


<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TNTR2BS"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="fb-root"></div>
<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8&appId=1063515973681507";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script src="https://apis.google.com/js/platform.js" async defer>
    {
        lang: 'pt-BR'
    }
</script>
<script src="//platform.linkedin.com/in.js">
    lang: pt_BR
</script>

<style>
    @media (max-width:768px) {
        body.theme-v2.home header .search {
            display: flex;
            gap: 12px;
            align-items: initial;
        }

        body.theme-v2 .search .button-primary  {
            display:block;
        }
    }
</style>

<div id="container">
    <header class="header" role="banner" id="topo">
        <!-- <a class="mensagem" href="/antigo">
            Gostaria de navegar na versão antiga do site? Clique Aqui
        </a> -->
        <style>
        	.versao_antiga {flex:1;text-align:center}
            .versao_antiga a {text-align:center !important}
            .mensagem {
                width:100%;
                display: flex;
                padding: 4px 8px;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 8px;
                display:block;
                text-align:center;
                margin:0px;
                background: var(--Primary-Extra-Color-3, #E0B5A4);
                position: relative;
                top: -30px;
                color: var(--Neutral-Black, #212121);
                font-family: Verdana;
                font-size: 8px;
                font-style: normal;
                font-weight: 100;
                line-height: normal;
                text-decoration:none;
            }

        </style>
        <div class="container">
            <div class="flex align-center justify-between g-24">
                <a href="<?php echo get_site_url()?>" aria-label="Ir para a página inicial">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/logo.svg"
                         alt="Logo Câmara de SP">
                </a>
                <nav class="menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-top-novo',
                        'container_class' => 'container',
                        'menu_class' => 'flex'
                    ));
                    ?>
                </nav>
                <nav class="sandwich">
                    <a href="#" aria-label="Abrir o menu">
                        Menu
                        <span>
                                <img src="<?php echo get_template_directory_uri() ?>/assets/images/sand.svg" alt="Abrir menu">
                            </span>
                    </a>
                </nav>
            </div>
            <nav class="menu-lateral">
                <div class="menu-context">
                    <a href="#" class="close-menu flex-end flex g-28 align-center">
                        Fechar
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_1029_46344" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                  width="30" height="30">
                                <rect x="0.547363" y="0.613281" width="28.8397" height="28.8397" fill="#D9D9D9"/>
                            </mask>
                            <g mask="url(#mask0_1029_46344)">
                                <path d="M8.23798 23.4447L6.55566 21.7624L13.2849 15.0332L6.55566 8.3039L8.23798 6.62158L14.9672 13.3508L21.6965 6.62158L23.3788 8.3039L16.6496 15.0332L23.3788 21.7624L21.6965 23.4447L14.9672 16.7155L8.23798 23.4447Z"
                                      fill="#FFF1F5"/>
                            </g>
                        </svg>
                    </a>
                    <div class="menu-wp">
                        <?php wp_nav_menu(array(
                            'menu' => __('Menu Lateral', 'bonestheme'),        // nav name
                            'theme_location' => 'main-nav-right',                            // where it's located in the theme
                            'link_before' => '',                                        // before each link
                            'link_after' => '',                                        // after each link
                            'depth' => 0,                                        // limit the depth of the nav
                            'fallback_cb' => 'bones_footer_links_fallback'            // fallback function
                        )); ?>
                    </div>
                    <!--<div class="brasao mt-96 flex w-100 justify-center">
                        <img src="<?php echo get_template_directory_uri()?>/assets/images/brasao-menu.svg" alt="Brasão Câmara SP">
                    </div> -->
                </div>
                <div class="overlay"></div>
            </nav>
            <nav class="otherwise">
                <ul class="flex">
                    <?php
                    $icones = get_field('icones', get_id_of_option('theme-general-settings'));
                    if(isset($icones) && is_array($icones)) {
                        foreach ($icones as $icone) :
                            ?>
                            <li>
                                <a href="<?php echo $icone['url'] ?>">
                                    <img src="<?php echo $icone['icone'] ?>" alt="<?php echo $icone['titulo'] ?>">
                                    <?php echo $icone['titulo'] ?>
                                </a>
                            </li>
                        <?php endforeach;}?>
                </ul>
            </nav>
            <form class="search flex align-center" method="GET">
                <div class="input-search">
                    <div class="">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="9" cy="9" r="8" stroke="#4D4D4D" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            <path d="M14.5 14.958L19.5 19.958" stroke="#4D4D4D" stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <!--<label class="d-none" for="s">Buscar</label>-->
                        <input  type="search" name="s" id="s" placeholder="Digite o que procura e clique em buscar...">
                    </div>
                </div>
                <button type="submit" class="button-primary">Buscar</button>
            </form>
        </div>
    </header>
    <?php get_template_part('banners/banners'); ?>
    <div class="commentOverlay">
        <div class="overlay"></div>
    </div>
    <style>
        .external-content-iframe {
            min-height:800px
        }
    </style>
    <?php
    if(!is_page("vereadores") && !is_singular('vereadores')) :?>
        <!-- header:comentarios -->
        <div class="comentarios">
            <?php comments_template('/comments-new-theme.php'); ?>
        </div>
    <?php endif;
    ?>
    <!-- header:conteudo -->
        <?php
        // Exibe <h1> apropriado para cada tipo de página, apenas para leitores de tela
        if ( is_front_page() && !is_paged() ) : ?>
            <h1 class="sr-only">Página Inicial - Câmara Municipal de São Paulo</h1>

        <?php elseif ( is_home() ) : ?>
            <h1 class="sr-only">Notícias</h1>

        <?php elseif ( is_post_type_archive('vereador') ) : ?>
            <h1 class="sr-only">Vereadores</h1>

        <?php elseif ( is_post_type_archive('atividade_legislativa') ) : ?>
            <h1 class="sr-only">Atividade Legislativa</h1>

        <?php elseif ( is_singular('vereador') ) : ?>
            <h1 class="sr-only"><?php the_title(); ?></h1>

        <?php elseif ( is_page() ) : ?>
            <h1 class="sr-only"><?php echo get_the_title(); ?></h1>

        <?php elseif ( is_single() ) : ?>
            <h1 class="sr-only"><?php the_title(); ?></h1>

        <?php elseif ( is_archive() ) : ?>
            <h1 class="sr-only"><?php the_archive_title(); ?></h1>

        <?php elseif ( is_search() ) : ?>
            <h1 class="sr-only">Resultados da busca por "<?php the_search_query(); ?>"</h1>

        <?php elseif ( is_404() ) : ?>
            <h1 class="sr-only">Página não encontrada</h1>

        <?php endif; ?>
        <main id="site-main" role="main">

