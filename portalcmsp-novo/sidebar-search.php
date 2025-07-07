<div id="sidebar1" class="sidebar m-all t-1of3 d-2of7 last-col cf" role="complementary" style="margin-top: 0px">

    <div class="barra-lateral-noticias">
        <h2 class="desktop-headeline-4">Notícias mais lidas</h2>
        <?php
        $start_date = strtotime('-6 months');
        $start_date = date('Y-m-d', $start_date);

        // Configurar argumentos da consulta
        $args = [
            'post_type' => ['post'],
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
                global $NewTheme;
                $postThumbnail = $NewTheme->getPostThumbnail($post->ID);
                if ($postThumbnail) :
                    ?>
                    <a class="img-noticia" href="<?php echo get_permalink($post->ID) ?>">
                        <img src="<?php echo $NewTheme->getPostThumbnail($post->ID) ?>"
                             alt="thumbnail noticia" class="w100">
                    </a>
                <?php endif; ?>
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
            </div>
            <!--noticia individual-->

        <?php endforeach; ?>
    </div>

    <div class="barra-lateral-noticias mt-32">
        <h3 class="desktop-headeline-4">Últimas notícias</h3>

        <?php
        wp_reset_query();
        $args = [
            'post_type' => ['post'],
            'showposts' => 4,
        ];
        $posts_ = get_posts($args);
        foreach ($posts_ as $post) :
            ?>
            <!--noticia individual-->
            <?php

            $postThumbnail = $NewTheme->getPostThumbnail($post->ID);
            ?>
            <div class="chamada-noticia">
                <?php
                if ($postThumbnail) :
                    ?>
                    <a class="img-noticia" href="<?php echo get_permalink($post->ID) ?>">
                        <img src="<?php echo $NewTheme->getPostThumbnail($post->ID) ?>"
                             alt="thumbnail noticia" class="w100">
                    </a>
                <?php endif; ?>
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
            </div>
            <!--noticia individual-->

        <?php endforeach; ?>

    </div>

    <?php if (comments_open()) : ?>
        <div class="participe-button ver-comentarios" aria-label="Opine sobre este conteúdo?">
            <h3>Opine sobre este conteúdo</h3>
            <p>
                Queremos te ouvir, nos envie uma mensagem.
            </p>
        </div>
    <?php endif ?>
</div>
