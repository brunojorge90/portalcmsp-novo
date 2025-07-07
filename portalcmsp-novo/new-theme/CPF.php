<?php

class CPF
{

    public function __construct()
    {
        add_filter('template_include', [$this, 'custom_template_include'], 99);

        add_action('init', [$this, 'criar_tabela_consent']);

        add_action('admin_menu', [$this, 'criar_pagina_opcoes']);
    }


    function custom_template_include($template)
    {
        // Verifique se é uma página única
        if (is_singular('page')) {
            // Obtenha o ID da página atual
            $page_id = get_queried_object_id();

            // Obtenha o valor do campo de meta exigir_cpf
            $cpfNecessario = get_field('exigir_cpf', $page_id);

            // Determine o nome do template com base na condição
            $templateName = $cpfNecessario ? 'page-exigir-cpf.php' : $template;


            if(isset($_POST['cpf']) && $_POST['cpf'] && $this->validarCPF($_POST['cpf'])) {
                global $wpdb;

                // Nome da tabela personalizada
                $table_name = $wpdb->prefix . 'cpf_url';

                // Obtém o endereço IP do usuário
                $ip_address = $_SERVER['REMOTE_ADDR'];

                // Data e hora atual
                $data_hora = current_time('mysql');

                // Insere os dados na tabela
                $wpdb->insert(
                    $table_name,
                    array(
                        'data_hora' => $data_hora,
                        'cpf' => $_POST['cpf'],
                        'url' => get_permalink($page_id),
                        'ip_address' => $ip_address,
                    )
                );
            }
            if (!isset($_POST['cpf']) || !$_POST['cpf'] || !$this->validarCPF($_POST['cpf'])) {
                // Verifique se o arquivo do template personalizado existe
                $customTemplate = get_template_directory() . '/' . $templateName;
                if (file_exists($customTemplate)) {
                    return $customTemplate;
                }
            }
        }

        return $template;
    }

    function validarCPF($cpf)
    {
        // Limpar caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verificar se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verificar se todos os dígitos são iguais
        if (preg_match('/^(\d)\1*$/', $cpf)) {
            return false;
        }

        // Calcula os dígitos verificadores
        for ($i = 9; $i < 11; $i++) {
            $digito = 0;
            for ($j = 0; $j < $i; $j++) {
                $digito += $cpf[$j] * (($i + 1) - $j);
            }
            $digito = (($digito % 11) < 2) ? 0 : 11 - ($digito % 11);
            if ($digito != $cpf[$i]) {
                return false;
            }
        }

        return true;
    }

    // Função para criar a tabela
    function criar_tabela_consent() {
        global $wpdb;

        // Nome da tabela personalizada
        $table_name = $wpdb->prefix . 'cpf_url';

        // Verifique se a tabela já existe
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            // Crie a tabela se ela não existir
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $table_name (
            id INT NOT NULL AUTO_INCREMENT,
            data_hora DATETIME NOT NULL,
            cpf VARCHAR(255) NOT NULL,
            url VARCHAR(255) NOT NULL,
            ip_address VARCHAR(45) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }


    // Adiciona uma página de opções no menu de administração
    function criar_pagina_opcoes() {
        add_menu_page(
            'Exigência de CPF',
            'Exigência de CPF',
            'manage_options',
            'pagina_cpf',
            [$this, 'pagina_consentimento_callback']
        );
    }

// Página de opções de callback
    public function pagina_consentimento_callback() {
        ?>
        <div class="wrap">
            <h1>Exigência de CPF</h1>
            <div style="margin-top: 26px">
                <?php $this->mostrar_tabela_consentimento(); ?>
            </div>
        </div>
        <?php
    }

// Função para exibir a tabela de consentimento
    function mostrar_tabela_consentimento() {
        global $wpdb;

        // Nome da tabela personalizada
        $table_name = $wpdb->prefix . 'cpf_url';

        // Consulta para obter os dados da tabela
        $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

        // Verifica se há resultados
        if (!empty($results)) {
            ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Data e Hora</th>
                    <th>CPF</th>
                    <th>URL</th>
                    <th>Endereço IP</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['data_hora']; ?></td>
                        <td><?php echo $row['cpf']; ?></td>
                        <td><?php echo $row['url']; ?></td>
                        <td><?php echo $row['ip_address']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php
        } else {
            echo '<p>Nenhum dado de consentimento encontrado.</p>';
        }
    }
}