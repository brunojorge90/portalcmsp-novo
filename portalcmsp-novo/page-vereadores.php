<?php
/*
 Template Name: Home Vereadores Membros
*/
?>

<?php get_header();
/**$filter = 'ordem-alfabetica';
if (isset($_GET['filtro'])) {
    $filter = $_GET['filtro'];
}*/
$filter = 'ordem-alfabetica';
if (array_key_exists('filtro', $_GET) && isset($_GET['filtro'])) {
    $filter = $_GET['filtro'];
} else {
    $_GET['filtro'] = $filter;
}


if (have_posts()) : while (have_posts()) :
    the_post();
    ?>
    <style>
        header .search {
            display: none !important;
        }
    </style>
    <section id="topo-vereadores" class="w100">
        <div class="config-image-bg w100">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/backgroundVereadores.jpg" class="w100"
                 alt="Background Vereadores">
            <div class="abs mt-32">
                <div class="container">
                    <div class="desktop-body-3">
                        <ul>
                            <li><a href="<?php echo get_site_url() ?>/">Home</a></li>
                            <li>/</li>
                            <li><a href="<?php echo get_site_url() ?>/vereadores">Vereadores</a></li>
                            <li>/</li>
                            <li><strong>Membros</strong></li>
                        </ul>
                    </div>

                    <h1 class="mt-44 desktop-headeline-2"><?php echo get_the_title() ?></h1>
                    <?php the_content() ?>
                </div>
            </div>
        </div>

    </section>
    <section id="vereadores" aria-label="Lista de Vereadores">
        <div class="abs">
            <div class="container overlap">
                <div class="ct-vereadores">
                    <h2 class="desktop-headeline-4">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icon_organize.svg"
                             alt="Organize e ordene por">
                        Organize e ordene por:
                    </h2>
                    <div class="overflow-mobile">
                        <ul class="mt-16">
                            <li><a href="?filtro=ordem-alfabetica"
                                   class="w100 <?php if ($_GET['filtro'] == '' || $_GET['filtro'] == 'ordem-alfabetica') echo 'button-primary border-radius-left'; else echo 'button-secondary  border-radius-left' ?>">Ordem
                                    alfabética</a></li>
                            <li><a href="?filtro=partido"
                                   class="w100 <?php if ($_GET['filtro'] == 'partido') echo 'button-primary '; else echo 'button-secondary' ?>">Partido</a>
                            </li>
                            <li><a href="?filtro=mesa-diretora"
                                   class="w100 <?php if ($_GET['filtro'] == 'mesa-diretora') echo 'button-primary '; else echo 'button-secondary' ?>">Mesa
                                    Diretora</a></li>
                            <li><a href="?filtro=corregedoria"
                                   class="w100 <?php if ($_GET['filtro'] == 'corregedoria') echo 'button-primary '; else echo 'button-secondary' ?>">Corregedoria</a>
                            </li>
                            <li><a href="?filtro=liderancas"
                                   class="w100 <?php if ($_GET['filtro'] == 'liderancas') echo 'button-primary '; else echo 'button-secondary' ?>">Lideranças</a>
                            </li>
                            <li><a href="?filtro=licenciados"
                                   class="w100 <?php if ($_GET['filtro'] == 'licenciados') echo 'button-primary '; else echo 'button-secondary' ?>">Licenciados</a>
                            </li>

                            <li>
                                <a href="https://sig.tse.jus.br/ords/dwapr/r/seai/sig-eleicao-resultados/resultado-da-elei%C3%A7%C3%A3o?p0_ano=2024&p0_regiao=SUDESTE&p0_uf=SP&p0_municipio=S%C3%83O%20PAULO&p0_tipo_eleicao=Elei%C3%A7%C3%A3o%20Ordin%C3%A1ria&p0_turno=1&p0_cargo_consolidado=Vereador"
                                    <?php
                                    // Correção em 2024-02-16 - Alexandre Uratsuka Manoel
                                    // <li><a href="https://dadosabertos.tse.jus.br/dataset/?tags=Ano+2020"
                                    // <li><a href="https://dadosabertos.tse.jus.br/dataset/resultados-2020/resource/db0b6c75-dc82-48d8-b207-ba2b420ec58a"
                                    // <li><a href="https://www.tre-sp.jus.br/eleicoes/eleicoes-anteriores/eleicoes-2020/eleicoes-2020#ancora-2"
                                    // <li><a href="https://resultados.tse.jus.br/oficial/app/index.html#/eleicao/resultados"
                                    ?>
                                   target="_blank" class="w100 button-secondary border-radius-right">Suplentes</a></li>
                        </ul>
                    </div>


                    <div class="conjunto-cards mt-56">
                        <?php
                        // see whatever is the current filter and set a default
                        $filter = 'ordem-alfabetica';
                        if (isset($_GET['filtro'])) {
                            $filter = $_GET['filtro'];
                        }
                        ?>

                        <?php
                        // default arguments for the query
                        $defaultArgs = array(
                            'post_type' => 'vereador',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                            //'meta_key' => '_cmsp_vereador_ativo',
                            'meta_key' => '_cmsp_vereador_name',
                            'orderby' => 'meta_value _cmsp_vereador_name', //'title',
                            'order' => 'ASC'
                        );
                        $finalArgs = $defaultArgs;
                        $finalArgs['meta_query'] = array(
                            array(
                                'key' => '_cmsp_vereador_ativo',
                                'value' => 'on',
                            ),
                        );

                        // tweak args for each filter

                        if ($filter == 'partido') {
                            $finalArgs['orderby'] = 'meta_value';
                            $finalArgs['meta_key'] = '_cmsp_vereador_party';
                            if (isset($_GET['partido'])) {
                                $finalArgs['meta_query'] = array(
                                    'relation' => 'AND',
                                    array(
                                        'key' => '_cmsp_vereador_party',
                                        'value' => $_GET['partido'],
                                    ),
                                    array(
                                        'key' => '_cmsp_vereador_ativo',
                                        'value' => 'on',
                                    ),
                                );
                            } else {
                                $finalArgs['meta_query'] = array(
                                    array(
                                        'key' => '_cmsp_vereador_ativo',
                                        'value' => 'on',
                                    ),
                                );
                            }
                        }

                        if ($filter == 'mesa-diretora') {
                            $finalArgs['orderby'] = 'meta_value title';
                            $finalArgs['meta_key'] = '_cmsp_vereador_hierarquia';
                            $finalArgs['meta_query'] = array(
                                'relation' => 'AND',
                                array(
                                    'key' => '_cmsp_vereador_mesa-diretora',
                                    'value' => 'on',
                                ),
                                array(
                                    'key' => '_cmsp_vereador_ativo',
                                    'value' => 'on',
                                ),
                            );
                        }

                        if ($filter == 'corregedoria') {
                            $finalArgs['orderby'] = 'meta_value title';
                            $finalArgs['meta_key'] = '_cmsp_vereador_hierarquia';
                            $finalArgs['meta_query'] = array(
                                'relation' => 'AND',
                                array(
                                    'key' => '_cmsp_vereador_corregedoria',
                                    'value' => 'on',
                                ),
                                array(
                                    'key' => '_cmsp_vereador_ativo',
                                    'value' => 'on',
                                ),
                            );
                        }

                        if ($filter == 'liderancas') {
                            $finalArgs['orderby'] = 'meta_value';
                            $finalArgs['meta_key'] = '_cmsp_vereador_party';
                            $finalArgs['meta_query'] = array(
                                'relation' => 'OR',
                                array(
                                    'key' => '_cmsp_vereador_lider_partido',
                                    'value' => 'on',
                                ),
                                array(
                                    'key' => '_cmsp_vereador_vice_lider_partido',
                                    'value' => 'on',
                                ),
                            );


                            
                        }



                        if ($filter == 'licenciados') {
                            $finalArgs['orderby'] = 'meta_value';
                            $finalArgs['meta_key'] = '_cmsp_vereador_party';
                            $finalArgs['meta_query'] = array(
                                array(
                                    'key' => '_cmsp_vereador_licenciado',
                                    'value' => 'on',
                                ),
                            );
                        }

                        if ($filter == 'suplentes') {
                            $finalArgs['orderby'] = 'meta_value';
                            $finalArgs['meta_key'] = '_cmsp_vereador_party';
                            $finalArgs['meta_query'] = array(
                                array(
                                    'key' => '_cmsp_vereador_suplente',
                                    'value' => 'on',
                                ),
                            );
                        }

                        $vereadoresQuery = new WP_Query($finalArgs);
                        // Query lista de partidos
                        // Essa meta query filtra a lista para mostrar partidos com vereadores ativos.
                        $defaultArgs['meta_query'] = array(
                            array(
                                'key' => '_cmsp_vereador_ativo',
                                'value' => 'on',
                            ),
                        );
                        $partidosQuery = new WP_Query($defaultArgs);
                        $partidos = array();

                        while ($partidosQuery->have_posts()): $partidosQuery->the_post();
                            $vereador_partido = get_post_meta($post->ID, '_cmsp_vereador_party', true);
                            array_push($partidos, $vereador_partido);
                        endwhile;

                        asort($partidos);
                        $unique_partidos = array_unique($partidos);


                        if ($_GET['filtro'] === "partido") :
                            foreach ($unique_partidos as $i => $partido) {
						//default
						$class = "button-secondary";
						//partido selecionado?
						if (array_key_exists('partido', $_GET) && $partido === $_GET['partido']){
							$class = "button-primary";
						}
                                //$class = $partido === $_GET['partido'] ? "button-primary" : "button-secondary";
                                echo '<a style="text-transform:uppercase" class=" btn-small button-size-sm text-decoration-none ' . $class . '" href="?filtro=partido&partido=' . $partido . '">' . $partido . '</a>';
                            }
                        endif;

                        //Exibir primeiro o lider
                        $partido_anterior = '';
                        while ($vereadoresQuery->have_posts()): $vereadoresQuery->the_post();

                            $vereador_name = get_post_meta($post->ID, '_cmsp_vereador_name', true);
                            if ($vereador_name == '') $vereador_name = get_the_title();
                            $vereador_image = get_post_meta($post->ID, '_cmsp_vereador_image', true);
                            $vereador_party = get_post_meta($post->ID, '_cmsp_vereador_party', true);
                            $page_path = strtolower("partidos/" . $vereador_party);
                            $partido = get_page_by_path(basename(untrailingslashit($page_path)), OBJECT, 'partidos');
                            $logo = get_field("logo_grande", $partido->ID);
                            $lider = get_post_meta($post->ID, '_cmsp_vereador_lider_partido', true);
							$vice_lider = get_post_meta($post->ID, '_cmsp_vereador_vice_lider_partido', true);

                            if ($filter == 'partido' || $filter == 'liderancas') {
                                if ($partido_anterior == '' or $partido_anterior != $vereador_party) {
                                    echo '<h2 class="w100 mt-16" style="margin-bottom: 0px;text-transform: uppercase">' . $vereador_party . '</h2>';
                                    $partido_anterior = $vereador_party;
                                }
                            }
                            ?>
                            <!--card vereador-->
                            <div class="card-vereador">
                                <div class="img-vereador">
                                    <img class="thumbnail" src="<?php echo $vereador_image ?>" alt="foto do vereador"
                                         class="w100">
                                    <div class="img-partido">
                                        <?php if ($logo['url']) : ?>
                                            <img src="<?php echo $logo['url'] ?>" alt="partido do vereador"
                                                 class="w100">
                                        <?php
                                        else: ?>
                                            <span style="text-align: center; font-size: 12px; height: 100%; width: 100%; align-items: center; justify-content: center; padding: 8px; display: flex; line-height: normal;">
                                                Sem partido
                                            </span>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="context mt-16">
                                    <h3 class="desktop-headeline-5"><?php echo $vereador_name ?></h3>
									<?php if ($filter == 'liderancas' && $lider): ?>
										<p>líder</p>
									<?php endif; ?> 
                                    <?php if ($filter == 'liderancas' && $vice_lider): ?>
										<p>vice-líder</p>
									<?php endif; ?> 
                                    <?php if ($filter == 'mesa-diretora' || $filter == 'corregedoria'): ?>
                                        <?php
                                        $position = get_post_meta($post->ID, '_cmsp_vereador_mesa-diretora-posicao', true);
                                        if ($position != 'Corregedor Geral' && $filter == "corregedoria") $position = 'Demais Membros';
                                        ?>
                                        <p class="vereador-position"><?php echo $position; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="infos-vereador mt-32">
                                    <a href="<?php echo get_permalink(get_the_ID()) ?>" class="button-primary w100">Acessar</a>
                                    <a href="<?php echo get_permalink(get_the_ID()) ?>#contato"
                                       class="button-secondary w100 mt-16">Enviar mensagem</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <!--card vereador-->
                        <?php
                        // Tratamento de líderes de bloco e governo
                        if ($filter == 'liderancas') {
                        $finalArgs['orderby'] = 'meta_value';
                        $finalArgs['meta_key'] = '_cmsp_vereador_party';
                        $finalArgs['meta_query'] = array(
                            'relation' => 'OR',
                            array(
                                'key' => '_cmsp_vereador_lider_governo',
                                'value' => 'on',
                            ),
                            array(
                                'key' => '_cmsp_vereador_vice_lider_governo',
                                'value' => 'on',
                            ),
                            array(
                                'key' => '_cmsp_vereador_lider_bloco',
                                'value' => 'on',
                            ),
                        );

                        $liderBlocoGovernoQuery = new WP_Query($finalArgs);

                        //Exibir os blocos partidários
                        while ($liderBlocoGovernoQuery->have_posts()):
                        $liderBlocoGovernoQuery->the_post();

                        $vereador_name = get_post_meta($post->ID, '_cmsp_vereador_name', true);
                        if ($vereador_name == '') $vereador_name = get_the_title();
                        $vereador_image = get_post_meta($post->ID, '_cmsp_vereador_image', true);
                        $vereador_party = get_post_meta($post->ID, '_cmsp_vereador_party', true);
                        $page_path = strtolower("partidos/" . $vereador_party);
                        $partido = get_page_by_path(basename(untrailingslashit($page_path)), OBJECT, 'partidos');
                        $logo = get_field("logo_pequeno", $partido->ID);
                        ?>
                    </div>
                    <div class="conjunto-cards mt-56">
                        <?php
                        $lider_governo = get_post_meta($post->ID, '_cmsp_vereador_lider_governo', true);
						$vice_lider_governo = get_post_meta($post->ID, '_cmsp_vereador_vice_lider_governo', true);
                        $lider_bloco = get_post_meta($post->ID, '_cmsp_vereador_lider_bloco', true);
						
                        if ($lider_governo == 'on') {
                            ?>
                            <h2 class="w100 mt-16" style="margin-bottom: 0px;text-transform: uppercase">LÍDER DE
                                GOVERNO</h2>
                            <?php
                        } else if ($vice_lider_governo == 'on') {
                            ?>
                            <h2 class="w100 mt-16" style="margin-bottom: 0px;text-transform: uppercase">VICE-LÍDER DE
                                GOVERNO</h2>
                            <?php
                        } else if ($lider_bloco == 'on') {
                            $bloco = get_post_meta($post->ID, '_cmsp_vereador_bloco', true);
                            ?>
                            <h2 class="w100 mt-16"
                                style="margin-bottom: 0px;text-transform: uppercase"><?= $bloco ?></h2>
                            <?php
                        }
                        ?>
                        <!--card vereador-->
                        <div class="card-vereador">
                            <div class="img-vereador">
                                <img class="thumbnail" src="<?php echo $vereador_image ?>" alt="foto do vereador"
                                     class="w100">
                                <div class="img-partido">
                                    <?php if ($logo['url']) : ?>
                                        <img src="<?php echo $logo['url'] ?>" alt="partido do vereador" class="w100">
                                    <?php
                                    else: ?>
                                        <span style="text-align: center; font-size: 12px; height: 100%; width: 100%; align-items: center; justify-content: center; padding: 8px; display: flex; line-height: normal;">
                                                Sem partido
                                            </span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="context mt-16">
                                <h3 class="desktop-headeline-5"><?php echo $vereador_name ?></h3>
                                <?php if ($filter == 'liderancas' && $lider_bloco): ?>
									<p>líder</p>
								<?php endif; ?> 
								<?php if ($filter == 'liderancas' && $lider_governo): ?>
									<p>líder</p>
								<?php endif; ?> 
								<?php if ($filter == 'liderancas' && $vice_lider_governo): ?>
									<p>vice-líder</p>
								<?php endif; ?> 
                                <?php if ($filter == 'mesa-diretora' || $filter == 'corregedoria'): ?>
                                    <?php
                                    $position = get_post_meta($post->ID, '_cmsp_vereador_mesa-diretora-posicao', true);
                                    if ($position != 'Corregedor Geral' && $filter == "corregedoria") $position = 'Demais Membros';
                                    ?>
                                    <p class="vereador-position"><?php echo $position; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="infos-vereador mt-32">
                                <a href="<?php echo get_permalink(get_the_ID()) ?>"
                                   class="button-primary w100">Acessar</a>
                                <a href="<?php echo get_permalink(get_the_ID()) ?>#contato"
                                   class="button-secondary w100 mt-16">Enviar mensagem</a>
                            </div>
                        </div>
                        <?php
                        endwhile;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        <?php if($_GET['filtro']) : ?>
        var anchor = document.querySelector('#vereadores');
        window.scroll({top: anchor.offsetTop, left: 0, behavior: 'smooth'});
        <?php endif ?>
    </script>
    <div class="container" style="padding-bottom: 60px">
        <!-- Arquivo para download -->
        <footer class="article-footer cf">
            <?php
            $page_downloads = get_post_meta('13', '_cmsp_page_download-files', true);
            if (isset($page_downloads[0]['title'])):
                ?>
                <section class="content-box box-downloads">
                    <header class="content-box-top box-downloads-header">
                        <h2 class="content-box-title icon-archives-red">Downloads</h2>
                    </header>
                    <ul class="box-downloads-list">
                        <?php
                        foreach ($page_downloads as $file):
                            $blank = false;
                            if (isset($file['blank'])) {
                                if ($file['blank'] == 'on') $blank = true;
                            }
                            ?>
                            <li>
                                <a <?php if ($blank) echo 'target="_blank" '; ?>
                                        href="<?php echo $file['file']; ?>"><?php echo $file['title']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endif; ?>
        </footer>
    </div>
<?php
endwhile;
endif;
?> 

<?php get_footer(); ?>