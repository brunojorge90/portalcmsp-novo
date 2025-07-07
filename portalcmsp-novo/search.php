<?php get_header();

foreach ($_GET as $key => $value) {
    $_GET[$key] = urlencode($value);
}
?>

    <div id="content">
        <div class="config-image-bg w100">
            <img src="<?php echo get_template_directory_uri() ?>/dist/images/search_bk.png" class="w100"
                 alt="Background da página de busca">
            <div class="abs mt-32">
                <div class="container">
                    <div class="desktop-body-3">
                        <ul>
                            <li><a href="<?php echo get_site_url() ?>">Home</a></li>
                            <li>/</li>
                            <li><strong>Pesquisa</strong></li>
                        </ul>
                    </div>
                    <h1 class="mt-44 desktop-headeline-2">Área de pesquisas</h1>
                    <span class="desktop-headeline-4 mt-12">Acesse facilmente projetos, debates e informações legislativas na plataforma da Câmara dos Vereadores de São Paulo.</span>
                    <form class="pesquisa mt-32">
                        <div class="flex g-30 align-center">
                            <div class="position-relative">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.6667 18.6668H19.6133L19.24 18.3068C20.84 16.4401 21.6667 13.8934 21.2133 11.1868C20.5867 7.4801 17.4933 4.5201 13.76 4.06677C8.12001 3.37344 3.37334 8.1201 4.06668 13.7601C4.52001 17.4934 7.48001 20.5868 11.1867 21.2134C13.8933 21.6668 16.44 20.8401 18.3067 19.2401L18.6667 19.6134V20.6668L24.3333 26.3334C24.88 26.8801 25.7733 26.8801 26.32 26.3334C26.8667 25.7868 26.8667 24.8934 26.32 24.3468L20.6667 18.6668ZM12.6667 18.6668C9.34668 18.6668 6.66668 15.9868 6.66668 12.6668C6.66668 9.34677 9.34668 6.66677 12.6667 6.66677C15.9867 6.66677 18.6667 9.34677 18.6667 12.6668C18.6667 15.9868 15.9867 18.6668 12.6667 18.6668Z"
                                          fill="#7F1A22"/>
                                </svg>
                                <label for="s" class="d-none">Busca</label>
                                <input type="search" id="s" name="s" value="<?php echo $_GET['s'] ?>" required/>
                            </div>
                            <button type="submit" class="button-primary">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="flex tags-type g-16">
                <a href="?s=<?php echo $_GET['s'] ?>" <?php if (!isset($_GET['type'])) echo 'class="act"' ?>>
                    Todos os resultados
                </a>
                <a href="?s=<?php echo $_GET['s'] ?>&type=post" <?php if (isset($_GET['type']) && $_GET['type'] === "post") echo 'class="act"' ?>>
                    Notícias
                </a>
                <?php
                $exists = new WP_Query(["post_types" => ["page"], "s" => $_GET['s'], 'relevanssi'  => true]);
                if($exists->have_posts()) :
                ?>
                <a href="?s=<?php echo $_GET['s'] ?>&type=page" <?php if (isset($_GET['type']) && $_GET['type'] === "page") echo 'class="act"' ?>>
                    Páginas
                </a>
                <?php endif?>
                <?php
                $exists = new WP_Query(["post_types" => ["vereador"], "s" => $_GET['s'], 'relevanssi'  => true]);
                if($exists->have_posts()) : ?>
                <a href="?s=<?php echo $_GET['s'] ?>&type=vereador" <?php if (isset($_GET['type']) && $_GET['type'] === "vereador") echo 'class="act"' ?>>
                    Vereadores
                </a>
                <?php endif;
                 $exists = new WP_Query(["post_types" => ["comissao"], "s" => $_GET['s'], 'relevanssi'  => true]);
                if($exists->have_posts()) : ?>
                    <a href="?s=<?php echo $_GET['s'] ?>&type=comissao" <?php if (isset($_GET['type']) && $_GET['type'] === "comissao") echo 'class="act"' ?>>
                        Comissões
                    </a>
                <?php endif?>

                <!--<a href="?s=<?php echo $_GET['s'] ?>&type=comissao" <?php if (isset($_GET['type']) && $_GET['type'] === "comissao") echo 'class="act"' ?>>
                Comissões
            </a>

            <a href="?s=<?php echo $_GET['s'] ?>&type=galeria" <?php if (isset($_GET['type']) && $_GET['type'] === "galeria") echo 'class="act"' ?>>
                Galeria
            </a> -->
            </div>
            <div class="busca-termo">
                <div class="flex flex-wrap align-center">
                    Resultado da pesquisa:
                    <?php

                    if (!$_GET['s']) {
                        wp_redirect(get_site_url());
                    }
                    if ($_GET['s']) :
                        $terms = explode(' ', $_GET['s']);
                        foreach ($terms as $term) :
                            $current_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

                            $url_parts = parse_url($current_url);
                            parse_str($url_parts['query'], $query_params);

                            if (isset($query_params['s'])) {
                                $search_terms = explode(' ', $query_params['s']);
                                $search_terms = array_diff($search_terms, [$term]);
                                $query_params['s'] = implode(' ', $search_terms);
                            }

                            $new_query_string = http_build_query($query_params);
                            $new_url = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . '?' . $new_query_string;


                            ?>
                            <a class="tag" href="<?php echo $new_url; ?>">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 4L12 12" stroke="#7F1A22" stroke-width="1.1" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M12 4L4 12" stroke="#7F1A22" stroke-width="1.1" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                                <?php echo $term ?>
                            </a>
                        <?php endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <div id="inner-content" class="wrap cf">
            <div id="main" class="two-column-main cf" role="main" style="max-width: 704px">
                <?php
                if (!$_GET['type']) :
                    ?>
                    <?php
                    $relevantes = new WP_Query(
                        [
                            "post_types" => ["page", "vereador"],
                            "s" => $_GET['s'],
                            'relevanssi'  => true,
                            "numberposts" => 5,
                            "showposts" => 5,
                        ]
                    );
                    if ($relevantes->have_posts()) :
                        echo "<h2 style='margin-bottom: 24px;font-size: 16px;font-weight: bold'>Resultados relevantes: </h2>";
                        while ($relevantes->have_posts()) : $relevantes->the_post();
                            $post = get_post(get_the_ID());
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">
                                <header class="article-header">
                                    <!-- <p class="byline vcard">
                                            Atualizado em (<time class="updated" datetime="<?php echo get_the_time('Y-m-j'); ?>" pubdate><?php echo get_the_time('d\/m\/Y'); ?> &ndash; <?php echo get_the_time('H\hi'); ?></time>)
                                        </p> -->
                                    <h2 class="h2 entry-title">
                                        <a href="<?php the_permalink() ?>" rel="bookmark"
                                           title="<?php the_title_attribute(); ?>">
                                            <?php
                                            $post_type_object = get_post_type_object(get_post_type(get_the_ID())); // Obtém o objeto do tipo de postagem
                                            $post_type_name = $post_type_object->labels->singular_name; // Obtém o nome do tipo de postagem
                                            if ($post_type_name == "Post") echo 'Notícia'; else echo $post_type_name
                                            ?>:
                                            <?php the_title(); ?>
                                        </a>
                                        <?php if ($post->post_type === "post") echo "<span class='desktop-body-3' style='display: block'>" . get_the_date('j \d\e F \d\e Y - H:i') . "</span>"; ?>
                                    </h2>
                                </header>
                                <?php
                                $excerpt = get_the_excerpt();

                                if ($excerpt && hasTextOutsideTags(get_the_excerpt())) :
                                    ?>
                                    <section class="entry-content cf">
                                        <?php echo $excerpt ?>
                                    </section>
                                <?php endif; ?>
                            </article>
                        <?php endwhile; ?>
                    <?php endif;
                    wp_reset_query()?>
                <?php endif ?>
                <?php
                if (!$_GET['type']) echo "<h2 style='margin-bottom: 24px;margin-top:30px;font-size: 16px;font-weight: bold'>Notícias: </h2>";

                $args = [
                    "post_types" => !$_GET['type'] ? ["post"] : [$_GET['type']],
                    "s" => $_GET['s'],
                    'relevanssi'  => true,
                ];

                if (!$_GET['type'] || $_GET['type'] === "post") {
                    $args["orderby"] = "post_date";
                    $args["order"] = "DESC";
                }
                $noticias = new WP_Query(
                        $args
                );

                if ($noticias->have_posts()) : while ($noticias->have_posts()) : $noticias->the_post();
                    $post = get_post(get_the_ID());
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">
                        <header class="article-header">
                            <!-- <p class="byline vcard">
					                	Atualizado em (<time class="updated" datetime="<?php echo get_the_time('Y-m-j'); ?>" pubdate><?php echo get_the_time('d\/m\/Y'); ?> &ndash; <?php echo get_the_time('H\hi'); ?></time>)
					                </p> -->
                            <h2 class="h2 entry-title">
                                <a href="<?php the_permalink() ?>" rel="bookmark"
                                   title="<?php the_title_attribute(); ?>">
                                    <?php
                                    $post_type_object = get_post_type_object(get_post_type(get_the_ID())); // Obtém o objeto do tipo de postagem
                                    $post_type_name = $post_type_object->labels->singular_name; // Obtém o nome do tipo de postagem
                                    if ($post_type_name == "Post") echo 'Notícia'; else echo $post_type_name
                                    ?>:
                                    <?php the_title(); ?>
                                </a>
                                <?php if ($post->post_type === "post") echo "<span class='desktop-body-3' style='display: block'>" . get_the_date('j \d\e F \d\e Y - H:i') . "</span>"; ?>
                            </h2>
                        </header>
                        <?php
                        $excerpt = get_the_excerpt();

                        if ($excerpt && hasTextOutsideTags(get_the_excerpt())) :
                            ?>
                            <section class="entry-content cf">
                                <?php echo $excerpt ?>
                            </section>
                        <?php endif; ?>
                    </article>
                <?php endwhile; ?>
                    <?php bones_page_navi(); ?>
                <?php else : ?>
                    <article id="post-not-found" class="hentry cf">
                        <header class="article-header">
                            <h1><?php _e('Oops, nada encontrado...', 'bonestheme'); ?></h1>
                        </header>
                        <section class="entry-content">
                            <p><?php _e('Por favor, pesquise por outro termo...', 'bonestheme'); ?></p>
                        </section>
                    </article>
                <?php endif; ?>


            </div>
            <?php
            wp_reset_query();
            get_sidebar('search'); ?>
        </div>
        <section id="agenda-completa">
            <div class="div">
                <div class="container overlap">
                    <div class="ct-agenda proximos-eventos">
                        <div class="topo-proximos-eventos">
                            <h2 class="desktop-headeline-4">
                                <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-calendario-check.svg"
                                     alt="Próximos eventos">
                                Próximos eventos
                            </h2>
                        </div>
                        <div>
                            <div class="flex flex-eventos flex-wrap flex-list">
                                <?php
                                $dataa = date('Ymd');
                                $args = array(
                                    'posts_per_page' => 10,
                                    'post_type' => 'agenda_cerimonial',
                                    'meta_key' => 'data',
                                );

                                if (!isset($_GET['start-date'])) {
                                    $args['meta_query'] = array(
                                        array(
                                            'key' => 'data',
                                            'value' => $dataa,
                                            'compare' => '>=',
                                            'type' => 'DATE'
                                        ),
                                    );
                                } else {
                                    $args['meta_query'] = array(
                                        array(
                                            'key' => 'data',
                                            'value' => str_replace('-', '', $_GET['start-date']),
                                            'compare' => '>=',
                                            'type' => 'DATE'
                                        ),
                                    );
                                }

                                if (isset($_GET['finish-date'])) {
                                    $args['meta_query']['compare'] = "AND";
                                    $args['meta_query'][] = array(
                                        'key' => 'data',
                                        'value' => str_replace('-', '', $_GET['finish-date']),
                                        'compare' => '<=',
                                        'type' => 'DATE'
                                    );
                                }
                                function customorderby($orderby)
                                {
                                    return 'mt1.meta_value ASC';
                                }

                                add_filter('posts_orderby', 'customorderby');
                                $the_query = new WP_Query($args);
                                remove_filter('posts_orderby', 'customorderby');
                                $tem = 0;
                                if ($the_query->have_posts()):
                                    $data = '';
                                    $i = 0;
                                    while ($the_query->have_posts()) {
                                        $the_query->the_post();
                                        $datah = get_field('data');

                                        // exibir todos os eventos da data atual, mesmo eventos finalizados
                                        #$dataa = date("YmdHi");
                                        #$dataa = date("Ymd");

                                        //Listar eventos
                                        while (have_rows("eventos-listagem")) :
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
                                            ?>
                                            <h2>
                                                <?php
                                                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                                                date_default_timezone_set('America/Sao_Paulo');
                                                $date = date_create(get_field('data'));
                                                ?>
                                                <?php echo '<strong>' . date_format($date, 'd') . "</strong> de " . strftime('%B', strtotime(get_field('data'))); ?>
                                            </h2>
                                            <?php include get_template_directory() . '/content-boxes/eventos/item-evento.php';
                                            $tem = 1;
                                            $data = $datah;
                                            $i++;
                                        endwhile;
                                    }
                                endif;
                                if (!$tem) { ?>
                                    <div class="w100">
                                        <div class="flex justify-center w100" style="display: flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="64"
                                                 height="64s">
                                                <path style="text-indent:0;text-align:start;line-height:normal;text-transform:none;block-progression:tb;-inkscape-font-specification:Bitstream Vera Sans"
                                                      d="M 16 4 C 9.3844277 4 4 9.3844277 4 16 C 4 22.615572 9.3844277 28 16 28 C 22.615572 28 28 22.615572 28 16 C 28 9.3844277 22.615572 4 16 4 z M 16 6 C 21.534692 6 26 10.465308 26 16 C 26 21.534692 21.534692 26 16 26 C 10.465308 26 6 21.534692 6 16 C 6 10.465308 10.465308 6 16 6 z M 11.5 12 C 10.671573 12 10 12.671573 10 13.5 C 10 14.328427 10.671573 15 11.5 15 C 12.328427 15 13 14.328427 13 13.5 C 13 12.671573 12.328427 12 11.5 12 z M 20.5 12 C 19.671573 12 19 12.671573 19 13.5 C 19 14.328427 19.671573 15 20.5 15 C 21.328427 15 22 14.328427 22 13.5 C 22 12.671573 21.328427 12 20.5 12 z M 16 18 C 13.332659 18 10.979561 19.335501 9.53125 21.34375 L 11.15625 22.5 C 12.247939 20.986249 13.991341 20 16 20 C 18.008659 20 19.752061 20.986249 20.84375 22.5 L 22.46875 21.34375 C 21.020439 19.335501 18.667341 18 16 18 z"
                                                      fill="#7f1a22" overflow="visible"
                                                      font-family="Bitstream Vera Sans"/>
                                            </svg>
                                        </div>
                                        <h2 style='display: block;text-align: center;width: 100%;color:black'>Não há
                                            eventos
                                            programados</h2>
                                    </div>
                                    <style>
                                        .cj-exibicao {
                                            display: none !important;
                                        }
                                    </style>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="flex justify-center w-100">
                        <a href="<?php echo get_site_url() ?>/agenda" class="button-link w-100">Clique para acessar a
                            agenda completa</a>
                    </div>
                </div>
                <div class="mt-48"></div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>