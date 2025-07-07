<?php
/*
 Template Name: Agenda Cerimonial
*/

//define('DONOTCACHEPAGE', true);
use Cassandra\Date;
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
?>

<?php get_header(); ?>
<main>
<div id="content">
    <section id="topo-agenda" class="w100">
        <div class="config-image-bg w100">
            <img src="<?php echo get_template_directory_uri() ?>/dist/images/backgroundAgenda.jpg" class="w100" alt="Imagem de fundo da agenda da câmara" />
            <div class="abs mt-32">
                <div class="container">
                  <div class="desktop-body-3">
                        <ul>
                            <li><a href="#" aria-label="Ir para home">Home</a></li>
                            <li>/</li>
                            <li><strong>Agenda da Câmara</strong></li>
                        </ul>
                    </div>

                    <h1 class="mt-44 desktop-headeline-2">Agenda da Câmara</h1>
                    <span class="desktop-headeline-4 mt-12">Acompanhe nossa agenda e fique por dentro das iniciativas na cidade</span>
                </div>
            </div>
        </div>
    </section>
</main>
<main>
    <section id="agenda-completa" aria-label="Agenda">
        <div class="abs">
            <form class="container overlap barra-acoes">
                <div class="itens-esquerda">
                    <!--<label for="start-date" class="d-none">Data de inicio</label>-->
                    <input type="date" id="start-date" required name="start-date" class="field-style field-date"
                           value="<?php if (isset($_GET['start-date'])) echo $_GET['start-date']; else echo date('Y-m-d');?>">
                    <span class="desktop-body-2">até</span>
                    <!--<label for="finish-date" class="d-none">Data de fim</label>-->
                    <input type="date" id="finish-date" name="finish-date" class="field-style field-date"
                           value="<?php if (isset($_GET['start-date'])) echo $_GET['finish-date']; else echo date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d')))) ?>">
                </div>
                <div class="itens-direita">
                    <button type="submit" class="button-primary">Filtrar</button>
                    <a href="#" class="button-secondary btn-pdf" aria-label="Baixar PDF da agenda completa">Baixar PDF da agenda completa</a>
                </div>
            </form>
            <div class="container overlap">
                <div class="ct-agenda proximos-eventos">
                    <div class="topo-proximos-eventos">
                        <h2 class="desktop-headeline-4">
                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-calendario-check.svg"
                                 alt="Próximos eventos">
                            Próximos eventos
                        </h2>

                        <div class="cj-exibicao">
                            <input type="radio" name="modo-exibicao" checked="checked" class="exibicao-card"
                                   value="normal">
                            <input type="radio" name="modo-exibicao" class="exibicao-lista" value="flex-list">
                        </div>
                    </div>

                    <div>
                        <div class="flex flex-eventos flex-wrap">
                            <?php
                            $dataa = date('Ymd');
                            $args = array(
                                'posts_per_page' => -1,
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

                            if (isset($_GET['finish-date']) && $_GET['finish-date']!= "") {
                                $args['meta_query']['compare'] = "AND";
                                $args['meta_query'][] =  array(
                                    'key' => 'data',
                                    'value' => str_replace('-', '', $_GET['finish-date']),
                                    'compare' => '<=',
                                    'type' => 'DATE'
                                );
                            } else {
                                $args['meta_query']['compare'] = "AND";
                                $args['meta_query'][] =  array(
                                    'key' => 'data',
                                    'value' => str_replace('-', '',  date('Y-m-d', strtotime('+1 month', strtotime(date("Y-m-d"))))),
                                    'compare' => '<=',
                                    'type' => 'DATE'
                                );
                            }
                            if(!function_exists("customorderby")) {
								function customorderby($orderby) {
									return 'mt1.meta_value ASC';
								}
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
                                    $i_event = 1;

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
                                        if ($data != $datah) {
                                        ?>
                                        <h2>
                                            <?php

                                            $date = date_create(get_field('data'));

                                            ?>
                                            <?php echo '<strong>' . date_format($date, 'd') . "</strong> de " . strftime('%B', strtotime(get_field('data')));?>
                                        </h2>
                                        <?php } ?>
                                        <?php include get_template_directory() . '/content-boxes/eventos/item-evento.php';
                                        $tem = 1;
                                        $data = $datah;
                                        $i++;
                                        $i_event++;
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
                                                  fill="#7f1a22" overflow="visible" font-family="Bitstream Vera Sans"/>
                                        </svg>
                                    </div>
                                    <h2 style='display: block;text-align: center;width: 100%;color:black'>Não há eventos
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
        </div>
    </section>
</main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <!--
        <div class="breadcrumbs cf">
            <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="wrap cf">', '</p>');
        } ?>
        </div>

        <div class="section-title">
            <h2 class="wrap icon-clock-large-red"><?php the_title(); ?></h2>
        </div>

        <div id="inner-content" class="wrap cf">

            <div id="main" class="cf" role="main">

                <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope
                         itemtype="http://schema.org/BlogPosting">

                    <header class="article-header">
                        <h1 class="page-title" itemprop="headline">Próximos Eventos</h1>
                    </header> <?php // end article header ?>

                    <section class="entry-content cf" itemprop="articleBody">
                        <a href="javascript:window.print();" class="btn">Imprimir Agenda</a>
                        <div class="agenda-events-list" data-when="today">
                            <article>
                                <?php
        $i = 0;
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


        add_filter('posts_orderby', 'customorderby');
        $the_query = new WP_Query($args);
        remove_filter('posts_orderby', 'customorderby');

        if ($the_query->have_posts()):
            $data = '';
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
                                    </tbody>
                                    </table>
                                <?php } ?>
                                <h2>
                                    <?php echo substr(get_field('data'), 6, 2) . "/" . substr(get_field('data'), 4, 2) . "/" . substr(get_field('data'), 0, 4); ?>
                                </h2>
                                <table class="events-table">
                                    <thead>
                                    <tr>
                                        <th class="time">Horário</th>
                                        <th class="event" style="width:300px">Evento</th>
                                        <th class="location" style="width:200px">Local</th>
                                        <th class="vereador" style="width:200px">Vereador</th>
                                        <th class="party" style="width:150px">Partido</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php } ?>
                                    <tr class="agenda-event">
                                        <td class="time">
                                            <?php echo $horario['horario_inicio']; ?><?php if ($horario['horario_fim']) {
                            echo " - " . $horario['horario_fim'];
                        } ?>
                                        </td>
                                        <td class="event">
                                            <?php echo $descricao['titulo']; ?>
                                        </td>
                                        <td class="location">
                                            <?php echo $local; ?>
                                            <?php if ($descricao['local_txt']) {
                            echo "<p style='margin:0;'>" . $descricao['local_txt'] . "</p>";
                        } ?>
                                        </td>
                                        <td class="vereador">
                                            <?php

                        $vereador_id = "";
                        $vereadores_id = array();

                        while (have_rows("solicitante_campos")) : the_row();
                            $vereadores = get_sub_field('sol_vereador');
                            if ($vereadores): ?>
                                                    <?php foreach ($vereadores as $v): ?>
                                                        <?php array_push($vereadores_id, $vereador_id = $v->ID); ?>
                                                        <a href="<?php echo get_permalink($v->ID); ?>"
                                                           style="display:block;">
                                                            <?php echo get_the_title($v->ID); ?>
                                                        </a>
                                                    <?php endforeach;
                            endif;

                            if (get_sub_field('sol_txt')) {
                                ?>
                                                    <div class="flex">
                                                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/user.svg">
                                                        <?php echo get_sub_field('sol_txt') ?>
                                                    </div>
                                                    <?php
                            }

                            if (get_sub_field_object('sol_depto')) {
                                $field = get_sub_field_object('sol_depto');
                                $sol_depto = get_sub_field('sol_depto');
                                $choices_soldepto = array();
                                if (!(empty($sol_depto) or empty($field))) {
                                    $choices_soldepto = $field['choices'][get_sub_field('sol_depto')];
                                }
                                $label = !empty($choices_soldepto) ? $choices_soldepto : null;
                                ?>
                                                        <div class="flex g-16">
                                                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/user.svg">
                                                            <?php echo $label ?>
                                                        </div>
                                                    <?php
                            }
                            ?>
                                            <?php
                        endwhile;
                        ?>
                                        </td>
                                        <td class="party">
                                            <?php
                        if ($vereadores_id) {

                            $v_args = array(
                                'post_type' => 'vereador',
                                'post__in' => $vereadores_id
                            );
                            //echo "<!-- v_args = " . json_encode($v_args) . "-->"; //t3ste

                            $v_posts = get_posts($v_args);
                            //echo "<!-- v_posts = " . json_encode($v_posts) . "-->"; //t3ste

                            $array_partidos = array();
                            foreach ($v_posts as $p) {
                                //array_push($array_partidos, get_field("_cmsp_vereador_party", $p->ID));
                                array_push($array_partidos, get_post_meta($p->ID, '_cmsp_vereador_party', true));
                                //echo "<!-- vereador_party_id = " . get_post_meta($p->ID,'_cmsp_vereador_party', true) . "-->"; //t3ste
                            }
                            asort($array_partidos);
                            //echo "<!-- array_partidos = " . json_encode($array_partidos) . "-->"; //t3ste

                            $unique_partidos = array_unique($array_partidos);
                            //echo "<!-- unique_partidos = " . json_encode($unique_partidos) . "-->"; //t3ste

                            $posts = array();
                            foreach ($unique_partidos as $partido) {
                                if ($partido):

                                    $p_args = array(
                                        'title' => $partido,
                                        'post_type' => 'partidos',
                                        'post_status' => 'publish',
                                        'posts_per_page' => -1
                                    );
                                    //echo "<!-- p_args = " . json_encode($p_args) . "-->"; //t3ste

                                    $posts_partial = get_posts($p_args);

                                    foreach ($posts_partial as $pst) {
                                        //echo "<!-- pst = " . json_encode($pst) . "-->"; //t3ste
                                        array_push($posts, $pst);
                                    }

                                endif;
                            }
                            //echo "<!-- posts = " . json_encode($posts) . "-->"; //t3ste

                            if ($posts):
                                foreach ($posts as $p):
                                    $logo = get_field("logo_grande", $p->ID);

                                    //echo "<!-- logo = " . $logo . "-->"; //t3ste
                                    if (!empty($logo)) {
                                        ?>
                                                            <img src="<?php echo $logo['url']; ?>" width="40"
                                                                 title="<?php echo get_the_title($p->ID); ?>"
                                                                 style="margin:0"/>
                                                            <?php
                                    } else {
                                        ?>
                                                            <p><?php echo get_the_title($p->ID); ?></p>
                                                            <?php
                                    }
                                endforeach;
                            endif;
                        }
                        ?>
                                        </td>
                                    </tr>
                                    <?php $tem = 1;
                        $data = $datah;
                        $i++;
                    }
                endwhile;
            }
        endif;
        if (!$tem) {
            echo "<table><tbody><h2>Não há eventos programados</h2>";
        }
        ?>
                                    </tbody>
                                </table>
                            </article>
                        </div>
                        <a href="javascript:window.print();" class="btn">Imprimir Agenda</a>
                    </section>

                    <footer class="article-footer cf">
                        <?php
        $page_downloads = get_post_meta($post->ID, '_cmsp_page_download-files', true);
        if (isset($page_downloads[0]['title'])):
            ?>
                            <section class="content-box box-downloads">
                                <header class="content-box-top box-downloads-header">
                                    <h2 class="content-box-title icon-archives-red">Downloads</h2>
                                </header>
                                <ul class="box-downloads-list">
                                    <?php
            foreach ($page_downloads as $file):
                $blank = false;
                if (isset($file['blank'])) {
                    if ($file['blank'] == 'on') $blank = true;
                }
                ?>
                                        <li>
                                            <a <?php if ($blank) echo 'target="_blank" '; ?>
                                                    href="<?php echo $file['file']; ?>">
                                                <?php echo $file['title']; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </section>
                        <?php endif; ?>
                    </footer>

                </article>

            </div>
        </div> -->

    <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>