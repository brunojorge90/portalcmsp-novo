<section class="proximos-eventos">
    <div class="container">
        <h2 class="desktop-headeline-4">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/proximos-eventos.svg"
                 alt="proximos eventos">
            Próximos eventos
        </h2>
        <div class="overflow-mobile">
            <div class="flex flex-eventos">
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
                    while ($the_query->have_posts() && $i < 3) {

                        $the_query->the_post();
                        $datah = get_field('data');

                        // exibir todos os eventos da data atual, mesmo eventos finalizados
                        #$dataa = date("YmdHi");
                        #$dataa = date("Ymd");
                        $i_event = 0;
                        //Listar eventos
                        while (have_rows("eventos-listagem") && $i < 3) :
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
                                    include get_template_directory() . '/content-boxes/eventos/item-evento.php';
                                $tem = 1;
                                $data = $datah;
                                $i++;
                            }
                        endwhile;
                    }
                endif;
                if (!$tem) {
                    echo '<style>.proximos-eventos {display:none}.destaque-principal {padding-bottom: 40px}</style>';
                    echo "<h2>Não há eventos programados</h2>";
                }
                ?>
            </div>
        </div>
        <div class="mt-24 w100 flex">
            <a href="<?php echo get_site_url()?>/agenda" class="w100 button-secondary text-decoration-none">
                Clique para acessar a agenda completa
            </a>
        </div>
    </div>
</section>