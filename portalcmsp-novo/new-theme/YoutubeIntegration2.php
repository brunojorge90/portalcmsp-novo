<?php
class YouTubeAPIPlugin2 {
    private $api_handler;

    public function __construct() {
        add_action('rest_api_init', array($this, 'register_custom_endpoint'));
    }

    public function register_custom_endpoint() {
        register_rest_route('youtube-api/v1', '/playlist/(?P<playlist_id>[^/]+)', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_playlist_data'),
        ));

        register_rest_route('youtube-api/v1', '/video/(?P<video_id>[^/]+)', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_playlist_data'),
        ));
    }

    public function get_playlist_data($data) {
        $playlist_id = $data['playlist_id'];


        if($_GET['order']) {
            $filename = $playlist_id ."-".$_GET['order']. ".json";
            if ($this->isDataFresh($filename)) {
                // Se os dados são recentes, ler do arquivo
                $data = $this->readFromFile($filename);
            } else {
                // Se os dados não são recentes, buscar do YouTube e salvar no arquivo
                $data = $this->fetchPlaylistItems($playlist_id);

                if($_GET['order'] === "antigos")
                usort($data, function ($a, $b)  {
                    return strtotime($a['snippet']['publishedAt']) - strtotime($b['snippet']['publishedAt']);
                });

                if ($_GET['order'] === "recentes") {
                    usort($data, function ($a, $b) {
                        return strtotime($b['snippet']['publishedAt']) - strtotime($a['snippet']['publishedAt']);
                    });
                }

                if($_GET['order'] === "alta")
                    usort($data, function ($a, $b)  {
                        return $b['contentDetails']['videoPublishedAt'] - $a['contentDetails']['videoPublishedAt'];
                    });


                $this->saveToFile($data, $filename);
            }


            return $data;
        } else {
            $filename = $playlist_id . ".json";
            if ($this->isDataFresh($filename)) {
                // Se os dados são recentes, ler do arquivo
                $data = $this->readFromFile($filename);
            } else {
                // Se os dados não são recentes, buscar do YouTube e salvar no arquivo
                $data = $this->fetchPlaylistItems($playlist_id);
                $this->saveToFile($data, $filename);
            }
            return $data;
        }
    }

    public function fetchPlaylistItems($playlistId)
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

    public function get_video_data($playlist_id) {

        if($_GET['order']) {
            $filename = $playlist_id ."-".$_GET['order']. ".json";
            if ($this->isDataFresh($filename)) {
                // Se os dados são recentes, ler do arquivo
                $data = $this->readFromFile($filename);
            } else {
                // Se os dados não são recentes, buscar do YouTube e salvar no arquivo
                $data = $this->fetchPlaylistItems($playlist_id);

                if($_GET['order'] === "antigos")
                    usort($data, function ($a, $b)  {
                        return strtotime($a['snippet']['publishedAt']) - strtotime($b['snippet']['publishedAt']);
                    });

                if ($_GET['order'] === "recentes") {
                    usort($data, function ($a, $b) {
                        return strtotime($b['snippet']['publishedAt']) - strtotime($a['snippet']['publishedAt']);
                    });
                }

                if($_GET['order'] === "alta")
                    usort($data, function ($a, $b)  {
                        return $b['contentDetails']['videoPublishedAt'] - $a['contentDetails']['videoPublishedAt'];
                    });


                $this->saveToFile($data, $filename);
            }


            return $data;
        } else {
            $filename = $playlist_id . ".json";
            if ($this->isDataFresh($filename)) {
                // Se os dados são recentes, ler do arquivo
                $data = $this->readFromFile($filename);
            } else {
                // Se os dados não são recentes, buscar do YouTube e salvar no arquivo
                $data = $this->fetchPlaylistItems($playlist_id);
                $this->saveToFile($data, $filename);
            }
            return $data;
        }
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