<?php get_header(); ?>

    <div id="content">

        <div class="breadcrumbs cf">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p class="wrap cf">', '</p>');
            } ?>
        </div>

        <div id="inner-content" class="wrap cf">

            <div id="main" class="cf" role="main">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope
                             itemtype="http://schema.org/BlogPosting">

                        <header class="article-header">
                            <h2 class="page-title" itemprop="headline"><?php the_title(); ?></h2>
                        </header> <?php // end article header ?>

                        <section class="entry-content cf" itemprop="articleBody">

                            <?php if (get_field("encerrada")) { ?>
                                <iframe class="external-content-iframe" src="<?php echo get_field("encerrada"); ?>"
                                        style="height:1000px;"></iframe>
                            <?php } else { ?>

                                <div class="cmsp-row flex g-32 flex-direction-mobile" style="margin-top:0px;">
                                    <?php $cat_news = get_field("noticias"); ?>
                                    <?php $imagem_pd = get_field("imagem_padrao"); ?>
                                    <?php
                                    $args = array('posts_per_page' => 1, 'category' => $cat_news[0]);
                                    $myposts = get_posts($args);
                                    foreach ($myposts as $post) : setup_postdata($post); ?>
                                        <div class="context">
                                            <h3 style="margin-top:0px;margin-bottom: 32px;font-size: 24px;line-height: normal">
                                                <a href="<?php the_permalink(); ?>"
                                                   style="color:#000;font-weight:bold;"><?php the_title(); ?></a>
                                            </h3>
                                            <?php the_excerpt(); ?>
                                        </div>
                                        <?php
                                        if ($imagem_pd) { ?>
                                            <img src="<?php echo $imagem_pd; ?>" width="464" height="192"
                                                 class=""/>
                                            <?php
                                        } else {
                                            ?>
                                            <img src="/wp-content/uploads/2016/04/padrao.png" width="464" height="192"
                                                 class=""/>
                                            <?php
                                        }
                                        ?>
                                    <?php endforeach;
                                    wp_reset_postdata(); ?>
                                </div>

                                <div class="cmsp-row comissoes-flex flex-direction-mobile">
                                    <div class="flex-1">
                                        <section class="content-box box-latest-news">
                                            <header class="content-box-top">
                                                <h2 class="content-box-title icon-clock-red">Últimas Noticias da
                                                    Comissão</h2>
                                            </header>

                                            <div class="box-latest-news-list">
                                                <?php
                                                $args = array('posts_per_page' => 5, 'offset' => 1, 'category' => $cat_news[0]);
                                                $myposts = get_posts($args);
                                                foreach ($myposts as $post) : setup_postdata($post); ?>
                                                    <article class="box-latest-news-item cf">
                                                        <h3 class="article-title">
                                                        <span class="date"><a
                                                                    href="#"><?php echo get_the_date('d\.m'); ?></a></span>
                                                            <span class="headline">
													<a href="<?php the_permalink(); ?>"><?php if (strlen(get_the_title()) > 63) {
                                                            echo (mb_substr(get_the_title(), 0, 63)) . '...';
                                                        } else {
                                                            echo get_the_title();
                                                        } ?></a>
												</span>
                                                        </h3>
                                                    </article>
                                                <?php endforeach;
                                                $yourcat = get_category($cat_news[0]);
                                                $essa_cat = $yourcat->slug;
                                                wp_reset_postdata(); ?>
                                            </div>

                                            <footer class="box-latest-news-footer" style="padding:10px 0 20px 0;">
                                                <a href="<?php echo get_home_url(); ?>/blog/category/noticias/comissoes/<?php echo $essa_cat; ?>/"
                                                   class="btn">Todas as notícias</a>
                                            </footer>
                                        </section>
                                    </div>
                                    <?php if (get_field("agenda") || get_field("contato")) : ?>
                                        <div class="flex-1">
                                            <section class="box-agenda content-box">
                                                <header class="content-box-top" style="border: none;">
                                                    <h3 class="content-box-title icon-calendar-red"
                                                        style="font-size:2rem;">
                                                        Agenda</h3>
                                                </header>
                                                <div style="padding:20px 20px 10px 10px;font-weight:600;"><?php echo get_field("agenda"); ?></div>
                                            </section>
                                            <section class="box-agenda content-box">
                                                <header class="content-box-top" style="border: none;">
                                                    <h3 class="content-box-title icon-doublearrow-red"
                                                        style="font-size:2rem;">Contato</h3>
                                                </header>
                                                <div style="padding:20px 20px 10px 10px;font-weight:500;font-size:.9em;"><?php echo get_field("contato"); ?></div>
                                            </section>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="cmsp-row comissao-nova">
                                    <a href="<?php echo get_site_url() ?>/atividade-legislativa/comissoes/"
                                       style="float:right;">Voltar para Comissões</a>
                                    <h4 style="font-size: 2em;margin-bottom: 26px;font-weight:600;text-transform: inherit">
                                        A Comissão</h4>
                                    <div style="clear:both;"></div>
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail(array(110, 110), array('class' => 'alignleft'));
                                    }
                                    ?>
                                    <?php the_content(); ?>
                                    <div style="clear:both;"></div>
                                </div>

                                <div class="cmsp-row">
                                    <div class="simpleTabs">
                                        <?php if (get_field("presidente") || get_field("vice_presidente") || get_field("membros")) { ?>
                                            <ul class="simpleTabsNavigation">
                                                <li><a href="#">Composição</a></li>
                                                <?php if (get_field("atribuicoes")) { ?>
                                                    <li><a href="#">Atribuições</a></li>
                                                <?php } ?>
                                                <?php if (get_field("pauta")) { ?>
                                                    <li><a href="#">Pauta</a></li>
                                                <?php } ?>
                                                <?php if (get_field("presenca")) { ?>
                                                    <li><a href="#">Presença</a></li>
                                                <?php } ?>
                                                <?php if (get_field("votacao")) { ?>
                                                    <li><a href="#">Votação</a></li>
                                                <?php } ?>
                                                <?php if (get_field("subcomissoes")) { ?>
                                                    <li><a href="#">Subcomissões</a></li>
                                                <?php } ?>
                                                <?php if (get_field("multimidia")) { ?>
                                                    <li><a href="#">Multimídia</a></li>
                                                <?php } ?>
                                                <?php if (have_rows('aba_extra')) { ?>
                                                    <?php while (have_rows('aba_extra')): the_row();
                                                        $title = get_sub_field('titulo_aba'); ?>
                                                        <li><a href="#"><?php echo $title; ?></a></li>
                                                    <?php endwhile; ?>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                        <div class="simpleTabsContent">
                                            <?php if (get_field("presidente") || get_field("vice_presidente") || get_field("membros")){ ?>
                                            <div>
                                                <?php
                                                $presidente = get_field("presidente");
                                                if ($presidente) {
                                                    //echo $presidente->post_title ."(". $presidente->ID .")<br />";
                                                    $vereador_name = get_post_meta($presidente->ID, '_cmsp_vereador_name', true);
                                                    if ($vereador_name == '') $vereador_name = get_the_title();

                                                    $vereador_image = get_post_meta($presidente->ID, '_cmsp_vereador_image', true);
                                                    $vereador_party = get_post_meta($presidente->ID, '_cmsp_vereador_party', true);
                                                    $page_path = strtolower("partidos/" . $vereador_party);
                                                    $partido = get_page_by_path(basename(untrailingslashit($page_path)), OBJECT, 'partidos');
                                                    $logo = get_field("logo_pequeno", $partido->ID);
                                                    ?>
                                                    <article class="vereador-profile-thumb cf"
                                                             style="margin-right:30px;">
                                                        <h2 class="vereador-picture">
                                                            <a href="<?php echo get_site_url() ?>/vereador/<?php echo $presidente->post_name; ?>">
                                                                <img alt="<?php echo $presidente->post_title; ?>"
                                                                     src="<?php echo $vereador_image; ?>"
                                                                     style="margin-bottom:0;">
                                                            </a>
                                                        </h2>
                                                        <h3 class="vereador-party">
                                                            <?php if (!empty($logo['url'])) : ?>
                                                                <img src="<?= $logo['url'] ?>" width="40"
                                                                     title="<?= $vereador_party ?>" style="margin:0"/>
                                                            <?php endif ?>
                                                        </h3>
                                                        <p class="vereador-name"><a
                                                                    href="<?php echo get_site_url() ?>/vereador/<?php echo $presidente->post_name; ?>"><?php echo $vereador_name; ?></a>
                                                        </p>
                                                        <h4>Presidente</h4>
                                                    </article>
                                                <?php } ?>
                                                <?php
                                                $vice_presidente = get_field("vice_presidente");
                                                if ($vice_presidente) {
                                                    //echo $vice_presidente->post_title ."(". $vice_presidente->ID .")<br />";
                                                    $vereador_name = get_post_meta($vice_presidente->ID, '_cmsp_vereador_name', true);
                                                    if ($vereador_name == '') $vereador_name = get_the_title();

                                                    $vereador_image = get_post_meta($vice_presidente->ID, '_cmsp_vereador_image', true);
                                                    $vereador_party = get_post_meta($vice_presidente->ID, '_cmsp_vereador_party', true);
                                                    $page_path = strtolower("partidos/" . $vereador_party);
                                                    $partido = get_page_by_path(basename(untrailingslashit($page_path)), OBJECT, 'partidos');
                                                    $logo = get_field("logo_pequeno", $partido->ID);
                                                    ?>
                                                    <article class="vereador-profile-thumb cf"
                                                             style="margin-right:30px;">
                                                        <h2 class="vereador-picture">
                                                            <a href="<?php echo get_site_url() ?>/vereador/<?php echo $vice_presidente->post_name; ?>">
                                                                <img alt="<?php echo $vice_presidente->post_title; ?>"
                                                                     src="<?php echo $vereador_image; ?>"
                                                                     style="margin-bottom:0;">
                                                            </a>
                                                        </h2>
                                                        <h3 class="vereador-party">
                                                            <?php if (!empty($logo['url'])) : ?>
                                                                <img src="<?= $logo['url'] ?>" width="40"
                                                                     title="<?= $vereador_party ?>" style="margin:0"/>
                                                            <?php endif ?>
                                                        </h3>
                                                        <p class="vereador-name"><a
                                                                    href="<?php echo get_site_url() ?>/vereador/<?php echo $vice_presidente->post_name; ?>"><?php echo $vereador_name; ?></a>
                                                        </p>
                                                        <h4>Vice-Presidente</h4>
                                                    </article>
                                                <?php } ?>
                                                <?php
                                                $relator = get_field("relator");
                                                if ($relator) {
                                                    $vereador_name = get_post_meta($relator->ID, '_cmsp_vereador_name', true);
                                                    if ($vereador_name == '') $vereador_name = get_the_title();

                                                    $vereador_image = get_post_meta($relator->ID, '_cmsp_vereador_image', true);
                                                    $vereador_party = get_post_meta($relator->ID, '_cmsp_vereador_party', true);
                                                    $page_path = strtolower("partidos/" . $vereador_party);
                                                    $partido = get_page_by_path(basename(untrailingslashit($page_path)), OBJECT, 'partidos');
                                                    $logo = get_field("logo_pequeno", $partido->ID);
                                                    ?>
                                                    <article class="vereador-profile-thumb cf"
                                                             style="margin-right:30px;">
                                                        <h2 class="vereador-picture">
                                                            <a href="<?php echo get_site_url() ?>/vereador/<?php echo $relator->post_name; ?>">
                                                                <img alt="<?php echo $relator->post_title; ?>"
                                                                     src="<?php echo $vereador_image; ?>"
                                                                     style="margin-bottom:0;">
                                                            </a>
                                                        </h2>
                                                        <h3 class="vereador-party">
                                                            <?php if (!empty($logo['url'])) : ?>
                                                                <img src="<?= $logo['url'] ?>" width="40"
                                                                     title="<?= $vereador_party ?>" style="margin:0"/>
                                                            <?php endif ?>
                                                        </h3>
                                                        <p class="vereador-name"><a
                                                                    href="<?php echo get_site_url() ?>/vereador/<?php echo $relator->post_name; ?>"><?php echo $vereador_name; ?></a>
                                                        </p>
                                                        <h4>Relator</h4>
                                                    </article>
                                                <?php } ?>
                                                <?php
                                                $coordenador = get_field("coordenador");
                                                if ($coordenador) {
                                                    $vereador_name = get_post_meta($coordenador->ID, '_cmsp_vereador_name', true);
                                                    if ($vereador_name == '') $vereador_name = get_the_title();

                                                    $vereador_image = get_post_meta($coordenador->ID, '_cmsp_vereador_image', true);
                                                    $vereador_party = get_post_meta($coordenador->ID, '_cmsp_vereador_party', true);
                                                    $page_path = strtolower("partidos/" . $vereador_party);
                                                    $partido = get_page_by_path(basename(untrailingslashit($page_path)), OBJECT, 'partidos');
                                                    $logo = get_field("logo_pequeno", $partido->ID);
                                                    ?>
                                                    <article class="vereador-profile-thumb cf"
                                                             style="margin-right:30px;">
                                                        <h2 class="vereador-picture"><a
                                                                    href="<?php echo get_site_url() ?>/vereador/<?php echo $coordenador->post_name; ?>"><img
                                                                        alt="<?php echo $coordenador->post_title; ?>"
                                                                        src="<?php echo $vereador_image; ?>"
                                                                        style="margin-bottom:0;"></a></h2>
                                                        <h3 class="vereador-party">
                                                            <?php if (!empty($logo['url'])) : ?>
                                                                <img src="<?= $logo['url'] ?>" width="40"
                                                                     title="<?= $vereador_party ?>" style="margin:0"/>
                                                            <?php endif ?>
                                                        </h3>
                                                        <p class="vereador-name"><a
                                                                    href="<?php echo get_site_url() ?>vereador/<?php echo $coordenador->post_name; ?>"><?php echo $vereador_name; ?></a>
                                                        </p>
                                                        <h4>Coordenador</h4>
                                                    </article>
                                                <?php } ?>
                                                <?php $vereadores = get_field("membros"); ?>
                                                <?php if ($vereadores) {
                                                    foreach ($vereadores as $vereador) { ?>
                                                        <?php
                                                        $vereador_name = get_post_meta($vereador->ID, '_cmsp_vereador_name', true);
                                                        if ($vereador_name == '') $vereador_name = get_the_title();

                                                        $vereador_image = get_post_meta($vereador->ID, '_cmsp_vereador_image', true);
                                                        $vereador_party = get_post_meta($vereador->ID, '_cmsp_vereador_party', true);
                                                        $page_path = strtolower("partidos/" . $vereador_party);
                                                        $partido = get_page_by_path(basename(untrailingslashit($page_path)), OBJECT, 'partidos');
                                                        $logo = get_field("logo_pequeno", $partido->ID);
                                                        ?>
                                                        <article class="vereador-profile-thumb cf"
                                                                 style="margin-right:30px;">
                                                            <h2 class="vereador-picture"><a
                                                                        href="<?php echo get_site_url() ?>/vereador/<?php echo $vereador->post_name; ?>"><img
                                                                            alt="<?php echo $vereador->post_title; ?>"
                                                                            src="<?php echo $vereador_image; ?>"
                                                                            style="margin-bottom:0;"></a></h2>
                                                            <h3 class="vereador-party">
                                                                <?php if (!empty($logo['url'])) : ?>
                                                                    <img src="<?= $logo['url'] ?>" width="40"
                                                                         title="<?= $vereador_party ?>"
                                                                         style="margin:0"/>
                                                                <?php endif ?>
                                                            </h3>
                                                            <p class="vereador-name"><a
                                                                        href="<?php echo get_site_url() ?>/vereador/<?php echo $vereador->post_name; ?>"><?php echo $vereador_name; ?></a>
                                                            </p>
                                                            <h4>Membro</h4>
                                                        </article>
                                                        <?php
                                                    }
                                                } ?>
                                                <div style="clear:both;"></div>
                                                <?php if (get_field("ocorrencias")) { ?>
                                                    <p><?php echo get_field("ocorrencias"); ?></p>
                                                    <div style="clear:both;"></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                        <?php if (get_field("atribuicoes")) { ?>
                                            <div class="simpleTabsContent">
                                                <div>
                                                    <?php echo get_field("atribuicoes"); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if (get_field("pauta")) { ?>
                                            <div class="simpleTabsContent">
                                                <div>
                                                    <?php echo get_field("pauta"); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if (get_field("presenca")) { ?>
                                            <div class="simpleTabsContent">
                                                <div>
                                                    <?php echo get_field("presenca"); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if (get_field("votacao")) { ?>
                                            <div class="simpleTabsContent">
                                                <div>
                                                    <?php echo get_field("votacao"); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if (get_field("subcomissoes")) { ?>
                                            <div class="simpleTabsContent">
                                                <div style="padding:30px;">
                                                    <?php echo get_field("subcomissoes"); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if (get_field("multimidia")) { ?>
                                            <div class="simpleTabsContent">
                                                <div>
                                                    <embed type="application/x-shockwave-flash" id="player"
                                                           name="player"
                                                           src="http://player.flashserverbr.com/player.swf"
                                                           width="640" height="480" allowscriptaccess="always"
                                                           allowfullscreen="true"
                                                           flashvars="streamer=rtmp://camarasp.flashserverbr.com/camarasp_vod&file=<?php echo get_field("multimidia"); ?>&provider=rtmp&autostart=true&logo.file=images/logoplayer.png&logo.position=top-left&logo.hide=false"/>
                                                    </embed>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if (have_rows('aba_extra')) { ?>
                                            <?php while (have_rows('aba_extra')): the_row();
                                                $content = get_sub_field('conteudo_aba'); ?>
                                                <div class="simpleTabsContent">
                                                    <div>
                                                        <?php echo $content; ?>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        <?php } ?>
                                    </div>
                                </div>

                            <?php } ?>
                        </section> <?php // end article section ?>

                    </article>

                    <?php if (get_field("banners")) { ?>
                        <h4 style="font-size: 1.5em; border-bottom: 2px #ccc solid; float: left;margin:0px;">DESTAQUES
                            DA
                            COMISSÃO</h4>
                        <div style="clear:both;"></div>
                        <div class="cmsp-row">
                            <?php
                            // Banners Horizontal
                            get_template_part('content-boxes/banners', 'comissao');
                            ?>
                        </div>
                    <?php } ?>

                <?php endwhile; else : ?>

                    <article id="post-not-found" class="hentry cf">
                        <header class="article-header">
                            <h1><?php _e('Oops, Post Not Found!', 'bonestheme'); ?></h1>
                        </header>
                        <section class="entry-content">
                            <p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'bonestheme'); ?></p>
                        </section>
                        <footer class="article-footer">
                            <p><?php _e('This is the error message in the page.php template.', 'bonestheme'); ?></p>
                        </footer>
                    </article>

                <?php endif; ?>

            </div><!-- main -->

        </div><!-- inner content -->

    </div>
    <style>
        @media (max-width: 768px) {
            .flex-direction-mobile {
                flex-direction: column-reverse;
            }

            .article-header .page-title {
                font-size: 28px !important;
                line-height: normal !important;
            }

            .article-header {
                padding: 0px !important;
            }

            .vereador-profile-thumb.cf {
                margin-right: inherit !important;
                margin: 20px auto !important;
            }

            .comissao .vereador-profile-thumb .vereador-name {
                height: 41px;
                padding: 13px 0px !important;
                width: 100% !important;
                align-items: center;
                vertical-align: middle;
                padding-left: 63px !important;
            }
        }
    </style>

<?php get_footer(); ?>