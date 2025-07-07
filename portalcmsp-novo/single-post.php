
<?php
get_header();

if (have_posts()) : while (have_posts()) :
    the_post();
    $id = get_the_ID();
    ?>
    <div class="container single">
        <div class="breadcrumbs">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p class="wrap cf">', '</p>');
            } ?>
        </div>
        <div class="conteudo" id="conteudo">
            <h1 class="desktop-headeline-2">
                <?php the_title() ?>
            </h1>
            <?php if(get_field("subtitulo", $id)) : ?>
            <h2 class="subtitulo"><?php echo get_field("subtitulo")?></h2>
            <?php endif?>
            <div class="author-and-sm justify-between flex mt-16">
                <div class="author">
                    <?php
                    if(get_field("por", $id)) {
                        $extractedParagraph = get_field("por", $id);
                    } else {
                        $extractedParagraph = $NewTheme->extrair_paragrafo_da_redacao(get_the_content());
                    }

                    if ($extractedParagraph) : ?>
                        <p class="flex g-13">
                            <strong>
                                Por:
                            </strong>
                            <em style="margin: 0; font-style: normal;">
                                <?php
                                echo $extractedParagraph;
                                ?>
                            </em>
                        </p>
                    <?php endif; ?>
                    <span>
                       <?php echo get_the_date('j \d\e F \d\e Y - H:i'); ?>
                    </span>
                </div>
                <div class="social-media flex-end flex g-8">
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
                    <a href="#">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-favorito.svg" alt="Adicionar ao favorito">
                    </a>
                    <a href="<?php echo get_permalink(); ?>#comments" class="comments" aria-label="Comentários" title="Comentários">
                        <span>
                            <?php echo get_comments_number() ?>
                        </span>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-comments.svg" alt="Comentários">
                    </a>
                </div>
            </div>

            <div class="categories mt-24 ">
                <h2 class="desktop-headeline-4">Categorias</h2>
                <ul class="flex g-8">
                    <?php
                    $categories = get_the_category($id);
                    foreach ($categories as $category) :
                        ?>
                        <a href="<?php echo get_term_link($category->term_id) ?>"
                           class="category"><?php echo $category->name ?></a>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="flex flex-post g-32">
                <div class="w100">
                    <div class="content-post entry-content cf">
                        <button class="button-primary" onclick="lerTexto()" type="button" value="Play" id="play">Ouvir esta notícia</button>
                        <button class="button-secondary" onclick="pausarLeitura()" type="button" value="Pausar" id="pause" style="display: none;margin-top: 0px">Pausar leitura</button>
                        <div class="leitura" id="leitura">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <script>
                        var synthesis = window.speechSynthesis;
                        var utterance;
                        var lendo = false;

                        function lerTexto() {
                            responsiveVoice.speak(document.getElementById('leitura').textContent, 'Brazilian Portuguese Male');
                            responsiveVoice.pause();
                            setTimeout(function() {
                                responsiveVoice.resume();
                            }, 2000);
                            // var textoParaLeitura = document.getElementById('leitura').textContent;
                            $("#play").hide();
                            $("#pause").show();

                            /*if (synthesis.speaking) {
                                synthesis.cancel();
                            }

                            utterance = new SpeechSynthesisUtterance(textoParaLeitura);
                            lendo = true;

                            utterance.onend = function() {
                                lendo = false;
                            };

                            synthesis.speak(utterance);
                             */
                        }

                        function pausarLeitura() {
                            $("#play").show();
                            $("#pause").hide();
                            responsiveVoice.pause();
                        }

                        // Adiciona um evento 'beforeunload' para pausar a leitura ao sair da página
                        window.addEventListener('beforeunload', function () {
                            responsiveVoice.pause();
                        });
                    </script>
                    <button class="button-secondary w100 ver-comentarios mt-64">
                        Deixar um comentário
                    </button>
                </div>
                <div class="sidebar">
                    <div class="barra-lateral-noticias">
                        <h3 class="desktop-headeline-4">Últimas notícias</h3>

                        <?php
                        $args = [
                            'showposts' => 4
                        ];

                        $posts = get_posts($args);

                        foreach ($posts as $post) :
                            ?>
                            <!--noticia individual-->
                            <?php
                            $postThumbnail = $NewTheme->getPostThumbnail($post->ID);
                            $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
                            ?>
                            <div class="chamada-noticia">
                                <?php
                                if ($postThumbnail) :
                                    ?>
                                    <a class="img-noticia" href="<?php echo get_permalink($post->ID) ?>" <?php if($show_title) echo "style='max-width:100%' target='_blank'"?>>
                                        <img src="<?php echo $NewTheme->getPostThumbnail($post->ID) ?>"
                                             alt="thumbnail noticia" class="w100">
                                    </a>
                                <?php endif; ?>
                                <?php
                                if(!$show_title) :
                                    ?>
                                    <div class="infos-noticia">
                                        <p class="desktop-body-3"><?php echo $post->post_title ?></p>
                                        <div class="flex flex-end">
                                            <a href="<?php echo get_permalink($post->ID) ?>" class="mobile-body-3" aria-label="<?php echo $post->post_title ?>">
                                                Acessar notícia
                                                <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                                          stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif?>
                            </div>
                            <!--noticia individual-->

                        <?php endforeach; ?>

                    </div>
                    <div class="barra-lateral-noticias">
                        <h2 class="desktop-headeline-4">Notícias mais lidas</h2>
                        <?php
                        $start_date = strtotime('-6 months');
                        $start_date = date('Y-m-d', $start_date);

                        // Configurar argumentos da consulta
                        $args = [
                            'numberposts' => 4,
                            'date_query' => [
                                [
                                    'after' => $start_date,
                                ],
                            ],
                            'meta_key' => 'post_view',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                        ];

                        $posts = get_posts($args);
                        foreach ($posts as $post) :
                            ?>
                            <!--noticia individual-->
                            <div class="chamada-noticia">
                                <?php
                                $postThumbnail = $NewTheme->getPostThumbnail($post->ID);
                                $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
                                if ($postThumbnail) :
                                    ?>
                                    <a class="img-noticia" href="<?php echo get_permalink($post->ID) ?>" <?php if($show_title) echo "style='max-width:100%' target='_blank'"?>>
                                        <img src="<?php echo $NewTheme->getPostThumbnail($post->ID) ?>"
                                             alt="thumbnail noticia" class="w100" <?php if($show_title) echo "style='max-width:100%'"?>>
                                    </a>
                                <?php endif; ?>

                                <?php
                                if(!$show_title) :
                                    ?>
                                    <div class="infos-noticia">
                                        <p class="desktop-body-3"><?php echo $post->post_title ?></p>
                                        <div class="flex flex-end">
                                            <a href="<?php echo get_permalink($post->ID) ?>" class="mobile-body-3" aria-label="<?php echo $post->post_title ?>">
                                                Acessar notícia
                                                <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                                          stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif?>
                            </div>
                            <!--noticia individual-->

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <section id="noticias-todas" class="mt-64 lista-noticias">
                <h2 class="desktop-headeline-3" style="border-bottom:1px solid ">
                    Outras notícias relacionadas
                </h2>
                <!--Notícias-->
                <div class="mt-48 flex flex-column order">
                    <?php
                    $categories = get_the_category($id);
                    $categories_id = [];
                    foreach ($categories as $category) {
                        if ($category->slug != 'geral' && $category->slug != 'noticias')
                            $categories_id[] = $category->term_id;
                    }

                    $featuredQuery2 = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'post__not_in' => [$id],
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'term_id',
                                'terms' => $categories_id, // Array de IDs dos termos que deseja consultar
                            ),
                        ),
                    ));

                    while ($featuredQuery2->have_posts()): $featuredQuery2->the_post();
                        $img = $NewTheme->getPostThumbnail(get_the_ID());
                        ?>
                        <!--Notícia individual-->
                        <div class="noticia-nivel-3 flex <?php if ($img) echo 'order-first'; else echo 'order-last' ?>">
                            <?php

                            if ($img) :?>
                                <div class="img-noticia">
                                    <a href="<?php echo get_permalink() ?>">
                                        <img src="<?php echo $img ?>" alt="imagem da notícia" class="w100">
                                    </a>
                                </div>
                            <?php endif ?>
                            <div class="textos-noticia p-<?php the_ID() ?>">
                                <a href="<?php echo get_permalink() ?>">
                                    <h3 class="desktop-headeline-3 mobile-headeline-2"><?php echo get_the_title() ?></h3>
                                    <?php
                                    $excerpt = $NewTheme->excerpt(get_the_excerpt());

                                    if($excerpt) : ?>
                                        <p class="desktop-body-1 mobile-body-2">
                                            <?php echo $excerpt ?>
                                        </p>
                                    <?php endif?>
                                </a>
                                <ul class="flex-wrap">
                                    <?php
                                    $categories = get_the_category();

                                    foreach ($categories as $category) :
                                        ?>
                                        <li><a href="<?php echo get_term_link($category->term_id) ?>"
                                               class="mobile-body-3" aria-label="<?php echo $post->post_title ?>"><?php echo $category->name ?></a></li>
                                    <?php endforeach; ?>
                                </ul>

                                <a class="infos-botton" href="<?php echo get_permalink() ?>">
                                                <span class="desktop-body-3">Atualizado em
                                                <?php
                                                $postDate = get_the_date('Y-m-d H:i:s');
                                                $formattedDate = date('d/m/Y - H\hi', strtotime($postDate));
                                                echo $formattedDate
                                                ?>
                                                </span>
                                    <div class="mobile-body-2">
                                        Acessar notícia
                                        <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                                  stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--Notícia individual-->
                    <?php endwhile;
                    ?>
                </div>
                <!--Notícias-->
                <div class="flex justify-center mt-64">
                    <a href="<?php echo get_site_url()?>/comunicacao/noticias" class="button-primary w100">
                        Voltar para notícias
                    </a>
                </div>
            </section>


        </div>

    </div>
    <style>
        body.theme-v2 .content-post p a {
            text-decoration: underline;
            display: initial;
            margin: 0;
            font-weight: 500;
        }
        
        .fluid-width-video-wrapper {
            margin-bottom:50px;
        }
        
        .single .content-post a {
            display:inline;
        }
        
        .single  .content-post img.alignleft {
            float:left;
            margin-right: 1.5em;
            display: inline;
        }
        
        .single  .content-post .alignright {
            float:right
            margin-left: 1.5em;
            display: inline;
        }

        h2.subtitulo {
            margin: 16px 0px !important;
            font-style: italic;
            color: #000;
            font-family: Montserrat, sans-serif;
            font-size: 1.8rem;
            font-weight: 400;
            line-height: 2.8rem;
        }
    </style>
<?php
endwhile;
endif;
get_footer()
?>