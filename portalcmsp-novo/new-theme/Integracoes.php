<?php

namespace NewTheme;

use SimpleXMLElement;

class Integracoes
{
    public function __construct() {
        add_action( 'rest_api_init', [$this, 'registerRoutes']);
    }

    public function registerRoutes() {
        register_rest_route( 'vereadores/v1', '/ausencias/(?P<id>\d+)', array(
            'methods'  => 'GET',
            'callback' => [$this, 'GetAusencias'],
            'permission_callback' => function () { return true; },
        ));
    }

    public function GetAusencias($request) {
        $anos = $this->retornaAnos();
        $url = "https://splegispdarmazenamento.blob.core.windows.net/containersip/PRESENCAS_2023.xml";
        $xmlstr = $this->get_xml_from_url($url);
        $xmlobj = new SimpleXMLElement($xmlstr);
        $vereadores = [];

        $jsonString = json_encode($xmlobj);
        $array = json_decode($jsonString, true);

        foreach ($array['Vereador'] as $item) {
            if($request['id'] == (string) $item['@attributes']['IDParlamentar']) {
                $result = [];

                foreach ($item['Sessao'] as $item2) {

                    $attributes = $item2["@attributes"];
                    $dia = $attributes["Dia"];
                    $presenca = $attributes["Presenca"];
                    $result[$dia] = $presenca;
                }

                $vereador = [
                    'nome' =>(string) $item['@attributes']['Nome'],
                    'partido' =>(string) $item['@attributes']['Partido'],
                ];
            }

        }
        $sessoes = [];
        foreach ($anos as $ano) {
            $result = $this->Ausencias($request['id'], $ano);
            $sessoes = array_merge($sessoes, $result);
        }
        $vereador['quantidade'] = count($sessoes);

        $vereador['presente'] = count(array_filter($sessoes, function($valor) {
            // Retorna true para manter o valor no array ou false para removê-lo
            return $valor == "Presente"; // Mantém apenas os números pares
        }));

        $vereador['justificadas'] = count(array_filter($sessoes, function($valor) {
            // Retorna true para manter o valor no array ou false para removê-lo
            return $valor != "Presente" && $valor != " " && $valor != "*"; // Mantém apenas os números pares
        }));

        $vereador['faltas'] = count(array_filter($sessoes, function($valor) {
            // Retorna true para manter o valor no array ou false para removê-lo
            return $valor == " "; // Mantém apenas os números pares
        }));
        $vereador['sessoes'] = $sessoes;

        return $vereador;
    }
    public function Ausencias($id, $ano) {
        $url = "https://splegispdarmazenamento.blob.core.windows.net/containersip/PRESENCAS_{$ano}.xml";
        $xmlstr = $this->get_xml_from_url($url);
        $xmlobj = new SimpleXMLElement($xmlstr);
        $vereadores = [];

        $jsonString = json_encode($xmlobj);
        $array = json_decode($jsonString, true);
        if(is_array($array['Vereador']))
        foreach ($array['Vereador'] as $item) {
            if($id == (string) $item['@attributes']['IDParlamentar']) {
                $result = [];

                foreach ($item['Sessao'] as $item2) {

                    $attributes = $item2["@attributes"];
                    $dia = $attributes["Dia"];
                    $presenca = $attributes["Presenca"];

                    $result[$dia] = $presenca;
                }
                return $result;
            }

        }

        return $vereadores;
    }

    public function get_xml_from_url($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $xmlstr = curl_exec($ch);
        curl_close($ch);
        return $xmlstr;
    }

    public function retornaAnos() {
        $anoAtual = date('Y');
        $anoLegislativoInicial = 2021;

        $anosLegislativos = [];

        for ($ano = $anoLegislativoInicial; $ano <= $anoAtual; $ano++) {
            $anosLegislativos[] = $ano;
        }

        return $anosLegislativos;
    }
}