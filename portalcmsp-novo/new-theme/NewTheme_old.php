<?php

namespace NewTheme;
require 'CookieBanner.php';
require 'YoutubeIntegration.php';

use DOMDocument;
use stdClass;
use NewTheme\CookieBanner;
use YouTubeAPIPlugin;

class NewTheme
{
    public function __construct()
    {

        new \NewTheme\CookieBanner();
        new YouTubeAPIPlugin();
        add_action( 'after_setup_theme', [$this, 'register_custom_menu']);
        add_action('wp_enqueue_scripts', [$this, 'register_my_styles']);
        add_filter('body_class', [$this, 'add_body_class']);
        add_action('the_post', [$this, 'incrementPostView']);
        add_filter('the_content', [$this, 'remove_first_insertion_from_single_post']);
        add_filter('the_excerpt', [$this, 'remove_first_insertion_from_single_post']);
        add_filter('manage_post_posts_columns', [$this, 'addPostViewColumn']);
        add_action('manage_post_posts_custom_column', [$this, 'displayPostViewColumn'], 10, 2);
        add_filter('the_content', [$this, 'remover_paragrafo_da_redacao']);
        add_filter('query_vars', [$this, 'custom_query_vars']);
        add_action('init', [$this, 'custom_rewrite_rule']);
        add_filter('nav_menu_link_attributes', [$this, 'custom_menu_link_attributes'], 10, 4 );
        add_filter('the_title', [$this, 'custom_get_the_title'], 10, 2);
        add_filter('post_type_link', [$this, 'custom_post_type_permalink'], 10, 3);
        add_filter('post_link', [$this, 'custom_post_permalink'], 10, 2);


        // Aplicar os filtros para adicionar e salvar o campo personalizado
        add_filter('attachment_fields_to_edit', [$this, 'custom_attachment_fields_to_edit'], 10, 2);
        add_filter('attachment_fields_to_save', [$this, 'custom_attachment_fields_to_save'], 10, 2);

        //Select do Vereador
        add_filter( 'wpcf7_form_tag',[$this, 'cf7_select_dropdown']);

        // Aplicar session acessibilidade
        add_filter('rest_api_init', function () {
            register_rest_route('custom/v1', 'acessibilidade', array(
                'methods' => 'POST',
                'callback' => [$this, 'acessibilidade'],
                'permission_callback' => function () {
                    return true;
                },
            ));
        });

        add_filter('body_class', function ($classes) {
            if (isset($_SESSION["contrast"])) {
                if($_SESSION["contrast"] === true)
                    $classes[] = "highcontrast";
            }
            return $classes;
        });
    }

    public function acessibilidade($request) {
        if($request['font']) {
            $_SESSION["font"] = $request['font'];
            $_SESSION["percent"] = $request['percent'];
        }

        $_SESSION["contrast"] = $request['contrast'];
    }

    public function register_custom_menu() {
        register_nav_menus( array(
            'menu-top-novo' => 'Novo Menu TOPO', // Replace 'primary-menu' with your desired menu location slug
            'menu-footer-novo' => 'Novo Menu FOOTER' // Replace 'secondary-menu' with another menu location if needed
        ) );
    }

    public function incrementPostView($post)
    {
        if (is_single() && !isset($GLOBALS['post_view_count'])) {
            $post_view = get_post_meta($post->ID, 'post_view', true) ? get_post_meta($post->ID, 'post_view', true) : 0;
            $post_view++;
            update_post_meta($post->ID, 'post_view', $post_view);
            $GLOBALS['post_view_count'] = $post_view;
        }

        if (is_singular('page') && !isset($GLOBALS['post_view_count'])) {
            $post_view = get_post_meta($post->ID, 'post_view', true) ? get_post_meta($post->ID, 'post_view', true) : 0;
            $post_view++;
            update_post_meta($post->ID, 'post_view', $post_view);
            $GLOBALS['post_view_count'] = $post_view;
        }
    }

    public function addPostViewColumn($columns) {
        $columns['post_view'] = 'Visualizações';
        return $columns;
    }

    public function displayPostViewColumn($column, $post_id) {
        if ($column === 'post_view') {
            $post_view = get_post_meta($post_id, 'post_view', true) ? get_post_meta($post_id, 'post_view', true) : 0;
            echo $post_view;
        }
    }

    public function register_my_styles()
    {
        wp_register_style('new-theme-v2', get_stylesheet_directory_uri() . '/dist/css/main.min.css?v20', array(), '2.7');
        wp_register_script('new-theme-v2-script', get_stylesheet_directory_uri() . '/dist/js/app.js', array(), '');
        wp_enqueue_style('new-theme-v2');
        wp_enqueue_script('new-theme-v2-script');
    }

    function add_body_class($classes)
    {
        $classes[] = 'theme-v2';
        return $classes;
    }

    public function getPostThumbnail($postID = null)
    {
        if (!$postID) $postID = get_the_ID();

        $post = get_post($postID);

        if($post->post_type === "slider-home") {
            return get_post_meta($postID, "_cmsp_slider_image", true);
        }

        $thumbnail = get_the_post_thumbnail_url($postID, 'full'); // Obtém a URL da imagem destacada

        if (!$thumbnail) {
            $content = $post->post_content;

            preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches); // Procura pela primeira imagem no conteúdo

            if (isset($matches[1])) {
                $thumbnail = $matches[1];
            }
        }
        return $thumbnail;
    }

    public function excerpt($excerpt)
    {

        $post = get_post(get_the_ID());

        $excerpt = $this->remover_paragrafo_da_redacao($excerpt);

        if($post->post_type === "slider-home") {
            return get_post_meta($post->ID, "_cmsp_slider_sub_text", true);
        }
        //$excerpt = $this->extrair_paragrafo_da_redacao($excerpt);

        $stripped_excerpt = strip_tags($excerpt); // Remove todas as tags HTML do excerpt


        // Remove os links do excerpt
        $stripped_excerpt = preg_replace('/<a[^>]*>(.*?)<\/a>/i', '', $stripped_excerpt);
        $stripped_excerpt = str_replace('Ler mais', '', $stripped_excerpt);
        $stripped_excerpt = preg_replace('/\[[^\]]*\]/', '', $stripped_excerpt);




        return $stripped_excerpt;
    }

    public function getRecentCategories($limit = 12)
    {
        $categories = get_field('assuntos_do_momento', get_id_of_option('theme-general-settings'));
        return $categories;
    }


    public function remove_first_insertion_from_single_post($content) {
        // Verificar se estamos em um post individual (single post)
        if (is_singular('post') ) {
            global $post;

            // Verificar se não há uma imagem em destaque (thumbnail)
            if (!has_post_thumbnail($post->ID)) {
                // Identificar a primeira inserção de conteúdo usando o shortcode [caption]
                $pattern = '/\[caption(.*?)\[\/caption\]/s';
                preg_match($pattern, $content, $matches);

                $first_insertion = '';

                if($matches)
                    $first_insertion = $matches[0];



                // Remover a primeira inserção de conteúdo do $content
                $content = str_replace($first_insertion, '', $content);
            }
        }

        return $content;
    }


    public function get_first_image_caption_as_thumbnail($post_id = null) {
        if(!$post_id) $post_id = get_the_ID();
        // Verificar se há uma imagem em destaque (post thumbnail)
        if (has_post_thumbnail($post_id)) {
            $thumbnail_id = get_post_thumbnail_id($post_id);
            $thumbnail = wp_get_attachment_image($thumbnail_id, 'full');
            return $thumbnail;
        }

        $content = get_the_content(null, false, $post_id);

        // Identificar a primeira inserção de conteúdo usando o shortcode [caption]
        $pattern = '/\[caption(.*?)\[\/caption\]/s';
        preg_match($pattern, $content, $matches);
        $first_insertion = '';

        if($matches)
            $first_insertion = $matches[0];

        // Verificar se encontrou uma primeira inserção de conteúdo com caption
        if (!empty($first_insertion)) {
            // Executar o shortcode [caption] usando do_shortcode
            $caption = do_shortcode($first_insertion);
            return $caption;
        }

        return '';
    }


    public function remover_paragrafo_da_redacao($content) {
        // Verificar se o conteúdo contém o termo "DA REDAÇÃO"

        if (is_singular('post') ) {
            if (strpos($content, 'DA REDAÇÃO') !== false || strpos($content, 'HOME OFFICE') !== false) {
                // Converter o conteúdo em um objeto DOM
                $dom = new DOMDocument();
                libxml_use_internal_errors(true); // Desativar erros relacionados à análise HTML
                $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
                libxml_clear_errors();

                // Obter todos os elementos <p> no conteúdo
                $paragraphs = $dom->getElementsByTagName('p');

                // Iterar pelos parágrafos em ordem reversa para evitar problemas de índice
                for ($i = $paragraphs->length - 1; $i >= 0; $i--) {
                    $paragraph = $paragraphs->item($i);
                    $paragraphContent = $paragraph->textContent;

                    // Verificar se o parágrafo contém o termo "DA REDAÇÃO"
                    if (strpos($paragraphContent, 'DA REDAÇÃO') !== false || strpos($paragraphContent, 'HOME OFFICE') !== false) {
                        // Remover o parágrafo do DOM
                        $paragraph->parentNode->removeChild($paragraph);
                        break;
                    }
                }

                // Obter o conteúdo atualizado do DOM
                $updatedContent = $dom->saveHTML();

                // Remover as tags <html>, <body> e doctype adicionadas pelo DOMDocument
                $updatedContent = preg_replace('/^.*?<body[^>]*>|<\/body>.*?$/si', '', $updatedContent);

                return $updatedContent;
            }
        }

        return $content;
    }



    public function extrair_paragrafo_da_redacao($content) {
        $content = wpautop($content);
        if (is_singular('post') && (strpos($content, 'DA REDAÇÃO') !== false || strpos($content, 'HOME OFFICE') !== false)) {
            // Converter o conteúdo em um objeto DOM
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
            libxml_clear_errors();

            // Obter todos os elementos <p> no conteúdo
            $paragraphs = $dom->getElementsByTagName('p');

            // Iterar pelos parágrafos para encontrar o parágrafo que contém o termo "DA REDAÇÃO"
            foreach ($paragraphs as $paragraph) {
                $paragraphContent = $paragraph->textContent;

                // Verificar se o parágrafo contém o termo "DA REDAÇÃO"
                if (strpos($paragraphContent, 'DA REDAÇÃO') !== false || strpos($paragraphContent, 'HOME OFFICE') !== false) {
                    // Extrair o parágrafo completo sem as tags HTML
                    $extractedParagraph = trim(strip_tags($dom->saveHTML($paragraph)));
                    $extractedParagraph = str_replace("DA REDAÇÃO", " - DA REDAÇÃO", $extractedParagraph);
                    $extractedParagraph = str_replace("HOME OFFICE", " - HOME OFFICE", $extractedParagraph);
                    return $extractedParagraph;
                }
            }
        }
        return '';
    }


    public function getEvents() {

    }

    public function getDateGMT($date) {
        date_default_timezone_set('GMT');
        $data_evento_gmt = date_i18n('Ymd\THis\Z', strtotime($date));

        // Agora você tem a data formatada em GMT na variável $data_evento_gmt
        return $data_evento_gmt;
    }

    public function getLinkEvent($date, $start, $end, $titulo, $location) {
        $start = $this->getDateGMT($start);
        $end = $end ? $this->getDateGMT($date ." ". $end.":00") : null;
        $titulo = strip_tags($titulo);
        $titulo = str_replace(array("\r", "\n"), ' ', $titulo);
        $location = strip_tags($location);
        $location = str_replace(array("\r", "\n"), ' ', $location);

        $location = preg_replace('/[\'"]/', '', $location);
        $titulo = preg_replace('/[\'"]/', '', $titulo);
        //  return str_replace('https://', 'webcal://', get_template_directory_uri().'/request-webcall?start='.$start.'&end='.$end.'&summary='.$titulo.'&location='.$location);
        return str_replace("https:", "webcal:", get_template_directory_uri()).'/request-webcall?start='.$start.'&end='.$end.'&summary='.$titulo.'&location='.$location;
    }


    public function custom_query_vars($query_vars) {
        $query_vars[] = 'evento_id';
        return $query_vars;
    }

    public function custom_rewrite_rule() {
        add_rewrite_rule(
            '^agenda_cerimonial/([^/]+)/(\d+)/?$',
            'index.php?post_type=agenda_cerimonial&name=$matches[1]&evento_id=$matches[2]',
            'top'
        );
    }

    public function getVideosByVereador($vereador, $postId = null) {
        $posts_ = get_field('videos', $postId) ? get_field('videos', $postId) : [];
        if(!get_field("obter_videos_automaticamente", $postId) && count($posts_) == 0) {
            $subquery_args = array(
                'post_type' => 'post',
                'showposts' => 100,// Tipo de post a ser consultado
                's' => $vereador, // Texto a ser procurado no conteúdo do post
            );

            // Criar a subconsulta WP_Query
            $subquery = get_posts($subquery_args);

            // Obter os IDs dos posts que atendem aos critérios da subconsulta
            $matching_posts_ids = wp_list_pluck($subquery, 'ID');

            // Parâmetros da consulta principal
            $args = array(
                'post_type' => 'post', // Tipo de post a ser consultado (pode ser alterado para outros tipos de post, se necessário)
                'post__in' => $matching_posts_ids, // IDs dos posts que atendem à subconsulta
                's' => 'youtube.com',
                'showposts' => 4
            );

            $posts = get_posts($args);
            $videos = [];
        } else {
            $videos = [];
            $posts_ = get_field('videos', $postId) ? get_field('videos', $postId) : [];
            foreach ($posts_ as $post) {
                $posts[] = (object) ['post_content' => $post['url_do_youtube'], 'ID' => null];
            }
        }
        $apiKey = get_field('api_key_youtube', get_id_of_option('theme-general-settings'));
        foreach ($posts as $post) {
            $videoId = $this->extract_video_id_from_embedded_link($post->post_content);
            if($videoId) {
                $video = $this->get_video_data($videoId);
                if(!is_null($video) && count($video['items']) > 0) {//is_null evita warning em PHP8+ por tentar iterar em variável nula
                    if($post->ID) {
                        $video['postId'] = $post->ID;
                        $video['link'] = get_permalink($post->ID);
                    } else {
                        $video['postId'] = null;
                        $video['link'] = null;
                    }

                    $videos[] = $video;
                }
            }
        }

        return $videos;
    }

    public function  custom_menu_link_attributes($atts, $item, $args, $depth)
    {
        // Verificar se o menu possui o atributo 'aria-label' vazio (ou não possui)
        if (empty($atts['aria-label'])) {
            // Obter o título do item do menu
            $menu_title = $item->title;
            // Adicionar o atributo 'aria-label' com o título do item do menu
            $atts['aria-label'] = 'Acessar a página '.$menu_title. ' '.rand(0, 200);

            // Adicionar o atributo 'title' com o título do item do menu (opcional, pode ser removido se não for necessário)
            $atts['title'] =  'Acesse a página '.$menu_title. ' '.rand(0, 200);;

            if (in_array('menu-item-has-children', $item->classes)) {
                $atts['aria-label'] = 'Abrir as páginas filho de '.$menu_title. ' '.rand(0, 200);

                // Adicionar o atributo 'title' com o título do item do menu (opcional, pode ser removido se não for necessário)
                $atts['title'] =  'Abrir as páginas filho de '.$menu_title. ' '.rand(0, 200);;

            }
        }

        return $atts;
    }

    public function extract_video_id_from_embedded_link($content) {
        // Regular expression to match the embedded video URL pattern
        $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/i';
        // You can modify the pattern according to the video service you are using (e.g., Vimeo, Dailymotion, etc.)

        // Perform the regex match
        preg_match($pattern, $content, $matches);

        // If a match is found, return the video ID, otherwise return null
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            return null;
        }
    }

    public function get_youtube_video_data($video_id, $api_key)
    {
        $url = "https://www.googleapis.com/youtube/v3/videos";
        $params = array(
            'part' => 'snippet', // Change this to include other parts you want to retrieve (e.g., 'statistics')
            'id' => $video_id,
            'key' => $api_key,
        );

        $url .= '?' . http_build_query($params);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }


    function custom_get_the_title($title, $post_id) {
        // Modify the title as needed

        $post = get_post($post_id);

        if(!is_admin()) {
            if($post->post_type != "slider-home") return $title;
            else return get_post_meta($post_id, "_cmsp_slider_text", true);
        }

        return $title;
    }

    function custom_post_type_permalink($permalink, $post, $leavename) {
        // Check if it is the desired post type
        if ($post->post_type === 'slider-home') {
            // Modify the permalink structure as needed

            return get_post_meta($post->ID, "_cmsp_slider_link", true);
        }

        return $permalink;
    }


    // Adicione o campo personalizado ao formulário de edição de mídia
    function custom_attachment_fields_to_edit($form_fields, $post) {
        // Verifique se o ACF está ativo e se o campo personalizado existe
        if (function_exists('acf_add_local_field_group')) {
            // Adicione o campo personalizado ao formulário de edição de mídia

            $fotografos = get_field('fotografos', get_id_of_option('theme-general-settings'));
            $options = '';

            if(get_field('_media_credit', $post->ID)) {
                $options .= "<option value=\"".get_field('_media_credit', $post->ID)."\">".get_field('_media_credit', $post->ID)."</option>";
            }

            $options .= "<option value=\"\">Nenhum</option>";
            foreach ($fotografos as $fotografo) {
                if($fotografo['nome'] != get_field('_media_credit', $post->ID))
                    $options .= "<option value=\"{$fotografo['nome']}\">{$fotografo['nome']}</option>";
            }
            $form_fields['mediaCredit'] = array(
                'label' => 'Lista de fotógrafos',
                'input' => 'html',
                'html'  =>  '<select name="attachments['.$post->ID.'][custom_dropdown]" value="'.get_field('_media_credit', $post->ID).'">
                                '.$options.
                    '</select>',
                'value' => get_field('_media_credit', $post->ID),
                'helps' => 'Esse campo é novo para inserir crédito ao fotográfo<br><a href="'.get_site_url().'/wp-admin/admin.php?page=theme-general-settings" target="_blank">Altere a lista de fotógrafos aqui </a>',
            );
        }
        return $form_fields;
    }

// Salve o valor do campo personalizado ao salvar a mídia
    function custom_attachment_fields_to_save($post, $attachment) {
        // Verifique se o ACF está ativo e se o campo personalizado existe
        update_post_meta($post['ID'], '_media_credit', $attachment['custom_dropdown']);
        return $post;
    }


// Aplicar o filtro wp_prepare_attachment_for_js para adicionar o valor do campo de seleção personalizado aos dados da mídia



    function cf7_select_dropdown_($tag, $unused ) {
        if ( $tag['name'] != 'vereador-post' )
            return $tag;

        $tag['raw_values'][] = "One";
        $tag['labels'][] = "One";

        $tag['raw_values'][] = "Two";
        $tag['labels'][] = "Two";

        $tag['raw_values'][] = "Three";
        $tag['labels'][] = "Three";

        $pipes = new WPCF7_Pipes($tag['raw_values']);
        $tag['values'] = $pipes->collect_befores();
        $tag['pipes'] = $pipes;

        return $tag;
    }

    function cf7_select_dropdown( $tag ) {
        if ( $tag['name'] == 'vereador-post' ) { // Substitua 'your-select-field-name' pelo nome do campo de seleção
            $options = [];
            $options_ = [];
            $args = [
                "post_type" => "vereador",
                "showposts" => -1,
                "meta_query" =>array(
                    array(
                        'key' => '_cmsp_vereador_ativo',
                        'value' => 'on',
                    )
                ),
                'orderby'       => 'name',
                'order'         => 'ASC',
            ];

            $vereadores = get_posts($args);

            foreach ($vereadores as $vereador) :
                $options[] = $vereador->post_title;
                $options_[] =  get_post_meta($vereador->ID, '_cmsp_vereador_contato_email', true);
            endforeach;

            $tag['raw_values'] = $options_;
            $tag['values'] = $options_;
            $tag['labels'] = $options;

            return $tag;
        }

        return $tag;
    }


    function custom_post_permalink($permalink, $post) {
        // Verifica se o campo personalizado 'url_destino' existe
        $url_destino = get_post_meta($post->ID, 'url_destino', true);

        if ($url_destino) {
            // Substitui o permalink pelo valor do campo 'url_destino'
            $permalink = $url_destino;
        }

        return $permalink;
    }

    public function get_video_data($playlist_id) {
        $filename = $playlist_id . ".json";
        if ($this->isDataFresh($filename)) {
            // Se os dados são recentes, ler do arquivo
            $data = $this->readFromFile($filename);
        } else {
            // Se os dados não são recentes, buscar do YouTube e salvar no arquivo
            $data = $this->get_youtube_video_data($playlist_id, get_field('api_key_youtube', get_id_of_option('theme-general-settings')));
            $this->saveToFile($data, $filename);
        }
        return $data;
    }

    public function fetchVideo($playlistId)
    {
        $apiEndpoint = 'https://content-youtube.googleapis.com/youtube/v3/playlistItems';
        $maxResults = $_GET['maxResults'] ? $_GET['maxResults'] : 4;

        if($_GET['order'] === "antigos") {
            $maxResults  = 50;
        }
        $params = [
            'part' => 'snippet',
            'playlistId' => $playlistId,
            'key' => get_field('api_key_youtube', get_id_of_option('theme-general-settings')),
            'maxResults' => $maxResults

        ];

        $url = $apiEndpoint . '?' . http_build_query($params);

        $response = wp_remote_get($url);
        $response = $response['body'];
        $data = json_decode($response, true);
        if (isset($data['items'])) {
            return $data['items'];
        } else {
            return [];
        }
    }

    private function isDataFresh($filename) {
        // Lógica para verificar se os dados no arquivo são recentes (menos de 2 horas)
        $file_path = ABSPATH.'/wp-content/uploads/json/youtube/' . $filename;

        if (file_exists($file_path)) {
            $last_modified = filemtime($file_path);
            $current_time = time();

            // Verificar se a última modificação foi há mais de 2 horas
            return ($current_time - $last_modified) < (2 * 60 * 60); // 2 horas em segundos
        }

        return false;
    }


    private function saveToFile($data, $filename) {
        // Lógica para salvar dados em um arquivo JSON
        $file_path = ABSPATH.'/wp-content/uploads/json/youtube/' . $filename;
        file_put_contents($file_path, json_encode($data));
    }

    private function readFromFile($filename) {
        // Lógica para ler dados de um arquivo JSON
        $file_path = ABSPATH.'/wp-content/uploads/json/youtube/' . $filename;
        $json_data = file_get_contents($file_path);

        return json_decode($json_data, true);
    }

}