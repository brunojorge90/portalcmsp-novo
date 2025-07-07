<?php
/*
 Template Name: Home Vereadores Membros - JSON
*/
/*
filtro=ordem-alfabetica
filtro=partido
filtro=mesa-diretora
filtro=corregedoria
filtro=liderancas
filtro=licenciados
suplentes: https://sig.tse.jus.br/ords/dwapr/r/seai/sig-eleicao-resultados/resultado-da-elei%C3%A7%C3%A3o?p0_ano=2024&p0_regiao=SUDESTE&p0_uf=SP&p0_municipio=S%C3%83O%20PAULO&p0_tipo_eleicao=Elei%C3%A7%C3%A3o%20Ordin%C3%A1ria&p0_turno=1&p0_cargo_consolidado=Vereador
/*
Listar todos os vereadores ativos
*/
$tipo = 'json';
if (isset($_GET['tipo'])) {
	$tipo = $_GET['tipo'];
}
$filter = 'ordem-alfabetica';
if (isset($_GET['filtro'])) {
    $filter = $_GET['filtro'];
}
// default arguments for the query
$defaultArgs = array(
    'post_type' => 'vereador',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'meta_key' => '_cmsp_vereador_name',
    'orderby' => 'meta_value _cmsp_vereador_name', //'title',
    'order' => 'ASC'
);
$finalArgs = $defaultArgs;
$finalArgs['meta_query'] = array(
    'relation' => 'OR',
    array(
        'key' => '_cmsp_vereador_ativo',
        'value' => 'on',
    ),
    array(
        'key' => '_cmsp_vereador_licenciado',
        'value' => 'on',
    ),
);
                    // tweak args for each filter
$vereadoresQuery = new WP_Query($finalArgs);
                    // Query lista de partidos
                    // Essa meta query filtra a lista para mostrar partidos com vereadores ativos.
$defaultArgs['meta_query'] = array(
    array(
        'key' => '_cmsp_vereador_ativo',
        'value' => 'on',
    ),
);
// Código json (1)
$vereadores = array();
//
//Exibir primeiro o lider
$partido_anterior = '';
while ($vereadoresQuery->have_posts()):
    $vereadoresQuery->the_post();
    $vereador_name = get_post_meta($post->ID, '_cmsp_vereador_name', true);
    if ($vereador_name == '') $vereador_name = get_the_title();
    $vereador_image = get_post_meta($post->ID, '_cmsp_vereador_image', true);
    $vereador_party = get_post_meta($post->ID, '_cmsp_vereador_party', true);
    $page_path = strtolower("partidos/" . $vereador_party);
    $partido = get_page_by_path(basename(untrailingslashit($page_path)), OBJECT, 'partidos');
    $logo = get_field("logo_grande", $partido->ID);
    $vice_lider = get_post_meta($post->ID, '_cmsp_vereador_vice_lider_partido', true);
    $vereador_image = get_post_meta($post->ID, '_cmsp_vereador_image', true);
    $vereador_partido = get_post_meta($post->ID, '_cmsp_vereador_party', true);


    $vereador_ramal = get_post_meta($post->ID, '_cmsp_vereador_contato_ramal', true);
    $vereador_fax = get_post_meta($post->ID, '_cmsp_vereador_contato_fax', true);
    $vereador_andar = get_post_meta($post->ID, '_cmsp_vereador_contato_andar', true);
    $vereador_sala = get_post_meta($post->ID, '_cmsp_vereador_contato_sala', true);
    $vereador_email = get_post_meta($post->ID, '_cmsp_vereador_contato_email', true);
    $vereador_website = get_post_meta($post->ID, '_cmsp_vereador_contato_site', true);
    $vereador_facebook = get_post_meta($post->ID, '_cmsp_vereador_contato_facebook', true);
    $vereador_instagram = get_post_meta($post->ID, '_cmsp_vereador_contato_instagram', true);
    $vereador_twitter = get_post_meta($post->ID, '_cmsp_vereador_contato_twitter', true);
    $vereador_youtube = get_post_meta($post->ID, '_cmsp_vereador_contato_youtube', true);
    $vereador_whatsapp = get_post_meta($post->ID, '_cmsp_vereador_contato_whatsapp', true);
    $vereador_ativo = get_post_meta($post->ID, '_cmsp_vereador_ativo', true);
    $vereador_gv = get_post_meta($post->ID, '_cmsp_vereador_contato_gv', true);
    $vereador_mesa = get_post_meta($post->ID, '_cmsp_vereador_mesa-diretora-posicao', true);
    $vereador_lider_governo = get_post_meta($post->ID, '_cmsp_vereador_lider_governo', true);
    $vereador_lider_partido = get_post_meta($post->ID, '_cmsp_vereador_lider_partido', true);
    $vereador_vice_lider = get_post_meta($post->ID, '_cmsp_vereador_vice_lider_partido', true);
    $vereador_lider_bloco = get_post_meta($post->ID, '_cmsp_vereador_lider_bloco', true); 
    $vereador_suplente = get_post_meta($post->ID, '_cmsp_vereador_suplente', true);
    $vereador_licenciado = get_post_meta($post->ID, '_cmsp_vereador_licenciado', true);
    $vereador_bloco = get_post_meta($post->ID, '_cmsp_vereador_bloco', true);
    $splegis_ID = get_post_meta($post->ID, '_cmsp_vereador_consulta_splegis_id', true);		
    array_push($vereadores,array(
		'Vereador' => $vereador_name,
		'Partido' => $vereador_partido,
		'Foto' => $vereador_image,
		'Ramal' => $vereador_ramal,
		'Fax' => $vereador_fax,
		'Andar' => $vereador_andar,
		'Sala' => $vereador_sala,
		'email' => $vereador_email,
		'Ativo' => $vereador_ativo, 
		'GV' => $vereador_gv,
		'Mesa' => $vereador_mesa,
		'LiderGoverno' => $vereador_lider_governo,
		'LiderPartido' => $vereador_lider_partido,
		'ViceLiderPartido' => $vereador_vice_lider,
		'Suplente' => $vereador_suplente,
		'Licenciado' => $vereador_licenciado,
		'LiderBloco' => $vereador_lider_bloco,
		'Bloco' => $vereador_bloco,
	),
    );
endwhile;
if ($tipo=='json') echo json_encode($vereadores);