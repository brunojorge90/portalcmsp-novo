<?php

namespace NewTheme;

class CookieBanner
{
    public function __construct() {
        add_filter("wp_footer", [$this, 'template']);
// Execute a função durante a ativação do tema
        add_action('after_setup_theme', [$this, 'criar_tabela_consent']);
        add_filter('rest_api_init', function () {
            register_rest_route('custom/v1', 'salvar-cookie', array(
                'methods' => 'POST',
                'callback' => [$this, 'salvar_aceitacao_cookie'],
                'permission_callback' => function () {
                    return true;
                },
            ));
        });

        add_action('admin_menu', [$this, 'criar_pagina_opcoes']);

    }

    public function template() {
        include 'cookie-banner/template.php';
    }

    function salvar_aceitacao_cookie($cookie_consent) {
        global $wpdb;

        // Nome da tabela personalizada
        $table_name = $wpdb->prefix . 'consent_lgpd';

        // Obtém o endereço IP do usuário
        $ip_address = $_SERVER['REMOTE_ADDR'];

        // Data e hora atual
        $data_hora = current_time('mysql');

        // Insere os dados na tabela
        $wpdb->insert(
            $table_name,
            array(
                'data_hora' => $data_hora,
                'cookie_consent' => true,
                'ip_address' => $ip_address,
            )
        );
    }

    // Função para criar a tabela
    function criar_tabela_consent() {
        global $wpdb;

        // Nome da tabela personalizada
        $table_name = $wpdb->prefix . 'consent_lgpd';

        // Verifique se a tabela já existe
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            // Crie a tabela se ela não existir
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $table_name (
            id INT NOT NULL AUTO_INCREMENT,
            data_hora DATETIME NOT NULL,
            cookie_consent VARCHAR(255) NOT NULL,
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
            'Configurações de Consentimento',
            'Consentimento',
            'manage_options',
            'pagina_consentimento',
            [$this, 'pagina_consentimento_callback']
        );
    }

// Página de opções de callback
    public function pagina_consentimento_callback() {
        ?>
        <div class="wrap">
            <h1>Configurações de Consentimento</h1>
            <table class="form-table" role="presentation">
                <tbody>
                <tr class="user-description-wrap">
                    <th><label for="description">Texto</label></th>
                    <td><textarea name="texto" id="texto" rows="5" cols="30"></textarea>
                </tr>
                </tbody></table>
            <input type="submit" class="acf-button button button-primary button-large" value="Atualizar">
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
        $table_name = $wpdb->prefix . 'consent_lgpd';

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
                    <th>Cookie Consent</th>
                    <th>Endereço IP</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['data_hora']; ?></td>
                        <td><?php echo $row['cookie_consent']; ?></td>
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