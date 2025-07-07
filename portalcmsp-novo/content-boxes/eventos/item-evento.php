<div class="col flex" style="flex-direction: column">
    <div class="thumbnail">
        <?php
        $imagem = $descricao['imagem'];
        if($imagem) :
            ?>
            <img src="<?php echo $imagem?>" alt="<?php echo $descricao['titulo'];?>">
        <?php
        else :
            $imagens = get_field('eventos_', get_id_of_option('theme-general-settings'));
            $v = false;
            foreach ($imagens as $imagen) {
                if($imagen['id_do_evento'] === $descricao['local'])  {?>
                    <img src="<?php echo $imagen['imagem_do_campo']?>"
                         alt="imagem do local <?php echo $descricao['local']?>">
                    <?php
                    $v = true;
                }
            }
            if(!$v) :
                ?>
                <img src="<?php echo get_template_directory_uri() ?>/random-img/default.jpg"
                     alt="imagem randomica <?php echo $descricao['local']?>">
            <?php endif?>
        <?php
        endif
        ?>
        <div class="abs-event">
            <span>
                <strong class="desktop-headeline-4">
                    <?php
                    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                    date_default_timezone_set('America/Sao_Paulo');
                    $date = date_create(get_field('data'));
                    echo date_format($date, 'd');
                    ?>
                </strong>
    			<?php 
					//DEPRECATED: echo utf8_encode(strftime('%B', strtotime(get_field('data'))));
					
					$formatter = new IntlDateFormatter('pt_BR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);//https://www.php.net/manual/en/class.intldateformatter
					$formatter->setPattern('MMMM');//https://unicode-org.github.io/icu/userguide/format_parse/datetime/
					echo $formatter->format(strtotime(get_field('data')));
					
					//$date = DateTimeImmutable::createFromFormat('U', strtotime(get_field('data')));
					//echo $date->format('M');
			?>
            </span>
        </div>
    </div>
    <div class="context flex-auto">
        <h3 class="desktop-headeline-5">
            <?php echo $descricao['titulo']; ?>
        </h3>
        <div class="flex-mobile">
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
        </div>

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
                                                 alt="<?php echo get_the_title($p->ID); ?>"
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
                    <div class="flex g-16" style="width: 100%;">
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

                    if ($label) :
                        ?>
                        <div class="flex g-16" style="width: 100%;">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/user.svg"
                                 alt="usuário">
                            <?php echo $label ?>
                        </div>
                    <?php
                    endif;
                }
            endwhile;
            ?>
            <!--<div class="vereador">
                <a class="flex">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/user.svg">
                    Edir Sales
                </a>
            </div>
            <div class="partido">
                <img src="<?php echo get_template_directory_uri() ?>/assets/images/partido1.png"
                     alt="">
            </div> -->
        </div>
    </div>
    <div class="context">
        <?php
        $descricao_completa = $descricao["descricao_completa"];

        if ($descricao_completa) : ?>
            <a href="<?php echo get_permalink() ?><?php echo $i_event ?>" class="button-primary w100"
               aria-label="Acessar o evento <?php echo $descricao['titulo']; ?>">
                Acessar evento
            </a>
        <?php endif ?>

        <?php
        ?>
        <a href="<?php echo $NewTheme->getLinkEvent(get_field('data'), $horario['horario_inicio'], $horario['horario_fim'], $descricao['titulo'], $label) ?>"
           class="button-secondary w100">
            Cadastrar na agenda
        </a>
    </div>
</div>