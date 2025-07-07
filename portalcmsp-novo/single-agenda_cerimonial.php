<?php
get_header();


$event_id = get_query_var('evento_id') ? get_query_var('evento_id') - 1 : null;
?>
    <section id="detalhes-agenda">
        <div class="container">
            <div class="desktop-body-3">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>/</li>
                    <li><a href="<?php echo get_site_url() ?>/agenda">Agenda da câmara</a></li>
                    <li>/</li>
                    <li><strong>Evento</strong></li>
                </ul>
            </div>
            <?php
            global $NewTheme;
            $dataa = get_field('data');
            $args = array(
                'posts_per_page' => -1,
                'post_type' => 'agenda_cerimonial',
                'meta_key' => 'data',
                'meta_query' => array(
                    array(
                        'key' => 'data',
                        'value' => $dataa,
                        'compare' => '=',
                        'type' => 'DATE'
                    ),
                ),
                'post__in' => [get_the_ID()]
            );

            function customorderby($orderby)
            {
                return 'mt1.meta_value ASC';
            }

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
                                <?php } ?>
                            <?php } ?>

                            <?php
                            if ($event_id == $i) :
                                ?>
                                <h1 class="desktop-headeline-2 mt-32">
                                    <?php
                                    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                                    date_default_timezone_set('America/Sao_Paulo');
                                    $date = date_create(get_field('data'));
                                    echo date_format($date, 'd');
                                    ?>
                                    <?php echo strftime('%B', strtotime(get_field('data'))); ?>
                                </h1>
                                <h2 class="desktop-headeline-5 mt-16"><?php echo $descricao['titulo']; ?></h2>
                                <div class="img-evento">
                                    <?php
                                    $imagem = $descricao['imagem'];
                                    if (!$imagem) :
                                        $imagens = get_field('eventos_', get_id_of_option('theme-general-settings'));
                                        $v = false;
                                        foreach ($imagens as $imagen) {
                                            if ($imagen['id_do_evento'] === $descricao['local']) { ?>
                                                <img src="<?php echo $imagen['imagem_do_campo'] ?>"
                                                     alt="imagem do local <?php echo $descricao['local'] ?>">
                                                <?php
                                                $v = true;
                                            }
                                        }
                                        if (!$v) :
                                            ?>
                                            <img src="<?php echo get_template_directory_uri() ?>/random-img/default.jpg"
                                                 alt="imagem randomica <?php echo $descricao['local'] ?>">
                                        <?php endif ?>
                                    <?php
                                    else :?>
                                        <img src="<?php echo $imagem ?>" alt="<?php echo $descricao['titulo']; ?>"
                                             class="w100">
                                    <?php endif ?>
                                </div>
                                <div class="infos-evento-agenda">
                                    <div class="coluna-esquerda">
                                        <h3 class="desktop-headeline-5"><?php echo $descricao['titulo']; ?></h3>
                                        <?php
                                        $editor_content = $descricao['descricao_completa'];
                                        if ($editor_content) {
                                            // Verifica se o valor do campo não está vazio
                                            if ($editor_content) {
                                                // Adicione sua classe desejada aos parágrafos
                                                $modified_content = preg_replace('/<p>/', '<p class="desktop-body-1">', $editor_content);

                                                // Exiba o conteúdo modificado
                                                echo $modified_content;
                                            }
                                        } else { ?>
                                            <p class="desktop-body-1">Não há descrição registrada...</p>
                                        <?php } ?>
                                    </div>
                                    <div class="coluna-direita">
                                        <ul>
                                            <li>
                                                <strong>Data:</strong>
                                                <?php
                                                $date = date_create(get_field('data'));
                                                echo $date->format('d/m/Y')
                                                ?>
                                            </li>
                                            <li>
                                                <strong>Horário:</strong>
                                                <?php echo $horario['horario_inicio']; ?><?php if ($horario['horario_fim']) {
                                                    echo " - " . $horario['horario_fim'];
                                                } ?>
                                            </li>
                                            <li><strong>Local:</strong>
                                                <?php echo $local; ?>
                                                <?php if ($descricao['local_txt']) {
                                                    echo $descricao['local_txt'];
                                                } ?>
                                            </li>
                                        </ul>

                                        <div class="partido justify-between align-center mt-16">
                                            <?php

                                            $vereador_id = "";
                                            $vereadores_id = array();

                                            while (have_rows("solicitante_campos")) : the_row();
                                                $vereadores = get_sub_field('sol_vereador');
                                                if ($vereadores): ?>
                                                    <?php foreach ($vereadores as $v): ?>
                                                        <?php array_push($vereadores_id, $vereador_id = $v->ID); ?>
                                                        <a href="<?php echo get_permalink($v->ID); ?>"
                                                           class="flex g-16 align-center justify-between"
                                                           style="width: 100%">
                                                            <div class="flex g-16 align-center">
                                                                <img src="<?php echo get_template_directory_uri() ?>/assets/images/user.svg"
                                                                     alt="usuário">
                                                                <?php echo get_the_title($v->ID); ?>
                                                            </div>
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
                                                                            <img src="<?php echo $logo['url']; ?>"
                                                                                 width="40"
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
                                                        </a>
                                                    <?php endforeach;
                                                endif;

                                                if (get_sub_field('sol_txt')) {
                                                    ?>
                                                    <div class="flex g-16">
                                                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/user.svg"
                                                             alt="usuário">
                                                        <?php echo get_sub_field('sol_txt') ?>
                                                    </div>
                                                    <?php
                                                }

                                                if (get_sub_field_object('sol_depto') && count($vereadores_id) == 0) {
                                                    $field = get_sub_field_object('sol_depto');
                                                    $sol_depto = get_sub_field('sol_depto');
                                                    $choices_soldepto = array();
                                                    if (!(empty($sol_depto) or empty($field))) {
                                                        $choices_soldepto = $field['choices'][get_sub_field('sol_depto')];
                                                    }
                                                    $label = !empty($choices_soldepto) ? $choices_soldepto : null;
                                                    ?>
                                                    <div class="flex g-16">
                                                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/user.svg"
                                                             alt="usuário">
                                                        <?php echo $label ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            <?php
                                            endwhile; ?>
                                        </div>
                                        <a href="<?php echo $NewTheme->getLinkEvent(get_field("data"), $horario['horario_inicio'], $horario['horario_fim'], $descricao['titulo'], $label) ?>"
                                           class="button-primary w100 mt-32">
                                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-calendario-branco.svg"
                                                 alt="cadastrar na agenda">
                                            Cadastrar na agenda
                                        </a>

                                        <h4 class="desktop-headeline-4 mt-32">Compartilhe esta agenda</h4>

                                        <div class="compartilhe-redes mt-16">
                                            <a href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode(get_permalink() . $event_id); ?>"
                                               id="linkedin" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/post-linkedin.svg"
                                                     alt="linkedin">
                                            </a>
                                            <a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink() . $event_id); ?>"
                                               id="facebook" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/post-facebook.svg"
                                                     alt="facebook">
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink() . $event_id); ?>"
                                               id="twitter" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/post-twitter.svg"
                                                     alt="twitter">
                                            </a>
                                            <a href="mailto:?body=<?php echo urlencode(get_permalink() . $event_id); ?>"
                                               id="e-mail" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/post-email.svg"
                                                     alt="e-mail">
                                            </a>
                                            <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink() . $event_id); ?>"
                                               id="telegram" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/post-telegram.svg"
                                                     alt="telegram">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col flex" style="flex-direction: column">
                                <div class="thumbnail">
                                    <img src="<?php echo get_template_directory_uri() ?>/random-img/<?php echo $i + 1 ?>.jpg"
                                         alt="imagem randomica">
                                    <div class="abs-event">
                                        <h4>
                                            <strong class="desktop-headeline-4">

                                            </strong>
                                            <?php echo strftime('%B', strtotime(get_field('data'))); ?>
                                        </h4>
                                    </div>
                                </div>
                                <div class="context flex-auto">
                                    <h3 class="desktop-headeline-5">
                                        <?php echo $descricao['titulo']; ?>
                                    </h3>
                                    <p>
                                        <strong>
                                            Horário:
                                        </strong>
                                        <?php echo $horario['horario_inicio']; ?><?php if ($horario['horario_fim']) {
                                    echo " - " . $horario['horario_fim'];
                                } ?>
                                    </p>
                                    <p>
                                        <strong>
                                            Local:
                                        </strong>
                                        <?php echo $local; ?>
                                        <?php if ($descricao['local_txt']) {
                                    echo $descricao['local_txt'];
                                } ?>
                                    </p>
                                    <div class="partido flex justify-between align-center">
                                        <?php

                                $vereador_id = "";
                                $vereadores_id = array();

                                while (have_rows("solicitante_campos")) : the_row();
                                    $vereadores = get_sub_field('sol_vereador');
                                    if ($vereadores): ?>
                                                <?php foreach ($vereadores as $v): ?>
                                                    <?php array_push($vereadores_id, $vereador_id = $v->ID); ?>
                                                    <a href="<?php echo get_permalink($v->ID); ?>"
                                                       class="flex g-16 align-center justify-between"
                                                       style="width: 100%">
                                                        <div class="flex g-16 align-center">
                                                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/user.svg"
                                                                 alt="usuário">
                                                            <?php echo get_the_title($v->ID); ?>
                                                        </div>
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
                                                                        <img src="<?php echo $logo['url']; ?>"
                                                                             width="40"
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
                                                    </a>
                                                <?php endforeach;
                                    endif;

                                    if (get_sub_field('sol_txt')) {
                                        ?>
                                                <div class="flex g-16">
                                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/user.svg"
                                                         alt="usuário">
                                                    <?php echo get_sub_field('sol_txt') ?>
                                                </div>
                                                <?php
                                    }

                                    if (get_sub_field_object('sol_depto') && count($vereadores_id) == 0) {
                                        $field = get_sub_field_object('sol_depto');
                                        $sol_depto = get_sub_field('sol_depto');
                                        $choices_soldepto = array();
                                        if (!(empty($sol_depto) or empty($field))) {
                                            $choices_soldepto = $field['choices'][get_sub_field('sol_depto')];
                                        }
                                        $label = !empty($choices_soldepto) ? $choices_soldepto : null;
                                        ?>
                                                <div class="flex g-16">
                                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/user.svg"
                                                         alt="usuário">
                                                    <?php echo $label ?>
                                                </div>
                                                <?php
                                    }
                                    ?>
                                        <?php
                                endwhile;
                                ?>
                                    </div>
                                </div>
                                <div class="context">
                                    <a href="<?php echo get_permalink() ?>" class="button-primary w100">
                                        Acessar evento
                                    </a>
                                    <a href="" class="button-secondary w100">
                                        Cadastrar na agenda
                                    </a>
                                </div>
                            </div> -->
                            <?php
                            endif;
                            $tem = 1;
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

        </div>
    </section>


<?php
get_footer()
?>