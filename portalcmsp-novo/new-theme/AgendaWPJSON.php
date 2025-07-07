<?php


class AgendaWPJSON
{
    public function __construct()
    {
        // Aplicar o filtro rest_prepare_{$post_type} para modificar o retorno do CPT
        add_filter('rest_api_init', function () {
            register_rest_route('custom/v1', 'agenda', array(
                'methods' => 'GET',
                'callback' => [$this, 'modify_cpt_rest_response'],
                'permission_callback' => function () {
                    return true;
                },
            ));
        });

        add_action('add_meta_boxes', [$this, 'add_custom_metabox']);
        add_action('admin_init', [$this, 'add_custom_metabox_save']);
        add_action('admin_menu', [$this, 'register_agenda_cerimonial_options_menu_page']);

    }

    function register_agenda_cerimonial_options_menu_page() {
        add_submenu_page(
            'edit.php?post_type=agenda_cerimonial',
            'Configurações de Integração',
            'Configurações de Integração',
            'manage_options',
            'agenda_cerimonial_options',
            [$this, 'render_page_admin']
        );
    }

    function render_page_admin() {
        ob_start();
        include get_template_directory()."/new-theme/adm/config-integracao-agenda.php";
        $form = ob_get_contents();
        ob_end_clean();
        echo $form;
    }
    function custom_metabox_content($post)
    {
        // Recupera o valor atual do campo de data
        $date_value = get_field('data', $post->ID);
        $eventos = get_field('eventos-listagem', $post->ID);
        $dateStr = $date_value;
        $originalFormat = "Ymd";
        $newFormat = "Y-m-d";

        $date = date_create_from_format($originalFormat, $dateStr);
        $newDateStr = date_format($date, $newFormat);

        if ($post->post_type === 'agenda_cerimonial' || $_GET['post_type'] == "agenda_cerimonial") { ?>
            <label for="custom_date">Data:</label>
            <input type="date" id="custom_date" name="custom_date" value="">
            <button id="import_button" class="button" type="submit"
                    onclick="return confirm('Tem certeza que deseja realizar essa operação? Lembre-se, você irá perder todos os dados de eventos.')">
                    Importar
            </button>

            <script>
                jQuery(document).ready(function () {
                    jQuery('input[type="submit"]').attr("onclick", "return publicarCheck()");
                    jQuery('[data-name="integracao_log"] textarea').attr("disabled", "disabled");
                });

                function publicarCheck() {
                    if(jQuery("input[name=\"custom_date\"").val() != "")
                    return confirm('Tem certeza que deseja realizar essa operação? Lembre-se, você irá perder todos os dados de eventos.')
                }
            </script>
            <?php
        }
    }

    function convert_to_hour($date) {
        $dateTimeString = $date; // Data e hora no formato "YYYY-MM-DDTHH:MM:SS"

// Converte a string da data e hora para um timestamp
        $timestamp = strtotime($dateTimeString);

        if ($timestamp !== false) {
            // Formata o timestamp para exibir apenas a hora no formato "HH:MM"
            $formattedTime = date('H:i', $timestamp);
            return $formattedTime;
        } else {
            return "";
        }

    }
    function upload_file_by_url($file_url, $description = null) {
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        // Download file to temp location
        $tmp = download_url($file_url);

        // Set up file array to simulate $_FILES
        $file_array = array(
            'name'     => basename($file_url),
            'tmp_name' => $tmp,
        );

        // Check for download errors
        if (is_wp_error($tmp)) {
            @unlink($file_array['tmp_name']);
            return $tmp;
        }

        // Upload file to WordPress media library
        $media_id = media_handle_sideload($file_array, 0, $description);

        // Check for media handle errors
        if (is_wp_error($media_id)) {
            @unlink($file_array['tmp_name']);
            return $media_id;
        }

        return $media_id;
    }

     function custom_metabox_save($post_id)
    {
        // Verifica se o campo de data foi enviado
        if (isset($_POST['custom_date']) && $_POST['custom_date'] != "") {
            $dateString = $_POST['custom_date']; // Data no formato "YYYY-MM-DD"
            $date = date_create_from_format('Y-m-d', $dateString);
            $formattedDate = $date->format('d/m/Y');
            $url = str_replace("{data}", $formattedDate, get_option("url_integracao"));
            $int = file_get_contents($url);
            $eventos = json_decode($int);
       		if(is_array($eventos->eventos))
                if(count($eventos->eventos) > 0) {
                    try {
                         foreach ($eventos->eventos as $evento) {
                            $vereadores = [];
                            foreach ($evento->vereadores as $vereador) {
                                $vereador = new_get_page_by_title(trim($vereador), OBJECT, 'vereador');

                                if($vereador) {
                                    $vereadores[] = $vereador->ID;
                                }
                            }
                            $image_id = "";
                            if(property_exists($evento, "url_img"))
                            if($evento->url_img) {
                                $image_id = $this->upload_file_by_url($evento->url_img, $evento->titulo);
                            }

                            $events[] = [
                                "horario" => [
                                    [
                                        "horario_inicio" => $this->convert_to_hour($evento->inicio),
                                        "horario_fim" => $this->convert_to_hour($evento->fim),
                                    ]
                                ],
                                "local_campos" => [
                                    [
                                        "imagem" => $image_id,
                                        "titulo" => $evento->titulo,
                                        "descricao_completa" => property_exists($evento, "desc_html") ? $evento->desc_html : "",
                                        "local" => $this->mapping_local($evento->local) ? $this->mapping_local($evento->local) : "",
                                        "local_txt" => !$this->mapping_local($evento->local) ? $evento->local : ""
                                    ]
                                ],
                                "solicitante_campos" => [
                                    [
                                        "sol_vereador" => $vereadores,
                                        "sol_depto" => "",
                                        "sol_txt" => $evento->outros_solicitantes
                                    ]
                                ]
                            ];

                        }

                        update_field("eventos-listagem", $events, $post_id);
                        $log = get_field("integracao_log", $post_id);
                        $current_date_time = date_i18n('d/m/Y H:i:s');
                        $current_user = wp_get_current_user();
                        $log .= "Integração realizada de ".$formattedDate." com sucesso por ".$current_user->display_name . " às ".$current_date_time."\n\n";
                        update_field("integracao_log", $log, $post_id);
                        echo '<div class="notice notice-success"><p>Integração realizada com sucesso</p></div>';

                        return;
                    }
                    catch (Exception $e) {
                        echo '<div class="notice notice-success"><p>Integração não realizada.'.$e.'</p></div>';
                        $log = get_field("integracao_log", $post_id);
                        $current_date_time = date_i18n('d/m/Y H:i:s');
                        $current_user = wp_get_current_user();
                        $log .= "Integração realizada de ".$formattedDate." não realizada (não há eventos ou erro na aplicação) por ".$current_user->display_name . " às ".$current_date_time."\n\n";
                        update_field("integracao_log", $log, $post_id);
                    }

                }

            echo '<div class="notice notice-success"><p>Integração não realizada</p></div>';

            $log = get_field("integracao_log", $post_id);
            $current_date_time = date_i18n('d/m/Y H:i:s');
            $current_user = wp_get_current_user();
            $log .= "Integração realizada de ".$formattedDate." não realizada (não há eventos ou erro na aplicação) por ".$current_user->display_name . " às ".$current_date_time."resposta"."\n\n";
            update_field("integracao_log", $log, $post_id);
        }


    }

    function mapping_local($string) {
        $string = trim($string);
        $array = [
            'Salão Nobre'=> "1016",
            'Sala Tiradentes'=>'1020',
            'Auditório Prestes Maia'=>'1018',
            'Plenário 1º de Maio'=> '1014',
            'Sala Sérgio Vieira de Mello'=> '1022',
            'Sala Oscar Pedroso Horta'=> '1024',
            'Auditório Freitas Nobre'=> '1028',
            'Saguão de Entrada José Mentor'=>'sem_pagina'
        ];

        return $array[$string];
    }

    function add_custom_metabox()
    {
        $post_types = array('agenda_cerimonial'); // Substitua 'seu_post_type' pelo nome do seu tipo de postagem

        foreach ($post_types as $post_type) {
            add_meta_box(
                'custom_metabox',
                'Importar JSON',
                [$this, 'custom_metabox_content'],
                $post_type,
                'side',
                'default'
            );
        }
    }

    // Função para adicionar o hook de salvamento
    function add_custom_metabox_save()
    {
        $post_types = array('agenda_cerimonial'); // Substitua 'seu_post_type' pelo nome do seu tipo de postagem

        foreach ($post_types as $post_type) {
            add_action('acf/save_post', [$this, 'custom_metabox_save']);
        }
    }


    // Modificar o retorno do CPT na API REST
    function modify_cpt_rest_response($request)
    {
        $data_rest = [];
        // Obter os dados existentes
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

                    $item = new StdClass();
                    $item->titulo = $descricao['titulo'];
                    $item->local = $local;

                    if ($descricao['local_txt']) {
                        $item->local .= $descricao['local_txt'];
                    }


                    $dom = new DOMDocument();
                    $dom->loadHTML($item->local);

                    $text = $dom->getElementsByTagName('a')->item(0)->nodeValue;
                    $text = utf8_decode(html_entity_decode($text, ENT_COMPAT, 'UTF-8'));
                    $item->local = $text;

                    $item->inicio = $datah . $horario['horario_inicio'];

                    $dateString = $item->inicio;

                    $year = substr($dateString, 0, 4);
                    $month = substr($dateString, 4, 2);
                    $day = substr($dateString, 6, 2);
                    $hour = substr($dateString, 8, 2);
                    $minute = substr($dateString, 11, 2);

                    $isoDate = sprintf('%s-%s-%sT%s:%s:00', $year, $month, $day, $hour, $minute);
                    $item->inicio = $isoDate;
                    $item->fim = $datah . $horario['horario_fim'];

                    $dateString = $item->fim;

                    $year = substr($dateString, 0, 4);
                    $month = substr($dateString, 4, 2);
                    $day = substr($dateString, 6, 2);
                    $hour = substr($dateString, 8, 2);
                    $minute = substr($dateString, 11, 2);

                    $isoDate = sprintf('%s-%s-%sT%s:%s:00', $year, $month, $day, $hour, $minute);
                    $item->fim = $isoDate;

                    $solicitantes = [];

                    while (have_rows("solicitante_campos")) : the_row();
                        $vereadores = get_sub_field('sol_vereador');
                        if ($vereadores): ?>
                            <?php foreach ($vereadores as $v): ?>
                                <?php array_push($vereadores_id, $vereador_id = $v->ID);
                                $solicitantes[] = get_the_title($v->ID);
                            endforeach;
                        endif;
                        $outros_solicitantes = "";
                        if (get_sub_field('sol_txt')) {
                            $outros_solicitantes = get_sub_field('sol_txt');
                        }


                        if (get_sub_field_object('sol_depto') && count($vereadores_id) == 0) {
                            $field = get_sub_field_object('sol_depto');
                            $sol_depto = get_sub_field('sol_depto');
                            $choices_soldepto = array();
                            if (!(empty($sol_depto) or empty($field))) {
                                $choices_soldepto = $field['choices'][get_sub_field('sol_depto')];
                            }
                            $label = !empty($choices_soldepto) ? $choices_soldepto : null;
                            $item->departamento = $label;
                        }

                        $item->departamento = $label;
                        $item->outros_solicitantes = $outros_solicitantes;
                        ?>
                    <?php
                    endwhile;
                    $item->vereadores = $solicitantes;
                    $item->descricao_completa = $descricao["descricao_completa"];
                    $tem = 1;
                    $data = $datah;
                    $i++;
                    $data_rest[] = $item;

                endwhile;
            }
        endif;
        return $data_rest;
    }
}