<?php
/*
    Template Name: Salários: Remuneração
*/
?>

<?php get_header(); ?>

    <div id="content">

        <script>
            // See https://stackoverflow.com/questions/133925/javascript-post-request-like-a-form-submit, jQuery version with arrays and objects support
            function postThis(path, parameters) {
                alert('oi')
                var form = $('<form></form>');

                form.attr("method", "post");
                form.attr("action", path);

                $.each(parameters, function(key, value) {
                    if ( typeof value == 'object' || typeof value == 'array' ){
                        $.each(value, function(subkey, subvalue) {
                            var field = $('<input />');
                            field.attr("type", "hidden");
                            field.attr("name", key+'[]');
                            field.attr("value", subvalue);
                            form.append(field);
                        });
                    } else {
                        var field = $('<input />');
                        field.attr("type", "hidden");
                        field.attr("name", key);
                        field.attr("value", value);
                        form.append(field);
                    }
                });
                alert('e ai')
                $(document.body).append(form);
                alert('pah')
                form.submit();
                alert('chau')
            }
        </script>

        <!--form name="srvForm" action="https://www.saopaulo.sp.leg.br/salarios-single-teste/" method="post">
          <input type="hidden" name="serv" id="serv"/>
        </form -->

        <div class="breadcrumbs cf">
            <?php if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb('<p class="wrap cf">','</p>');
            } ?>
        </div>

        <?php
        $detalhesUrl = "https://www.saopaulo.sp.leg.br/salarios-detalhes/";
        //$atividade = ($_GET['ativ'] == "apos") ? false : true;
        //echo $pagename;
        // se tiver APOSENTADOS no nome, abre listagem  de aposentados, caso contrário, abre listagem de ativos
        $atividade = (strpos($pagename, "aposentados")) ? false : true;

        $file_name = $atividade? 'ativos' : 'aposentados';

        $JSON_file = file_get_contents(__DIR__ . "/../../uploads/transparencia/salariosabertos/JSON_listagens/remun-$file_name.json");

        // Convert JSON string to Object
        $json = json_decode($JSON_file, true);
        //print_r($json);

        function isVazio($jsonField) {
            $isVazio = ($jsonField == null or $jsonField == '' or $jsonField == "R$ 0,00");
            //echo "<h3>json[<b>$jsonField</b>]: [" . $json[$jsonField] . '] isVazio: [' . $isVazio . ']</h3>';
            return $isVazio;
        }

        $lotacoes = [];
        foreach($json['remun-servidores'] as $serv) {
            if(!in_array($serv['servidor-lotacao'], $lotacoes)) {
                $lotacoes[$serv['servidor-ordem-lotacao']] = $serv['servidor-lotacao'];
            }
        }
        ksort($lotacoes);

        $titfrag = $atividade? "Ativos" : "Aposentados";

        $rotuloTabela = '';
        if($atividade) {
            $rotuloTabela = "Remuneração dos servidores e afastados junto à CMSP referente a " . $json['remun-ano-mes-atual-extenso'];
        } else {
            $rotuloTabela = "Remuneração dos servidores aposentados referente a " . $json['remun-ano-mes-atual-extenso'];
        }
        ?>

        <div id="inner-content" class="wrap cf">

            <div id="main" role="main">

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="https://schema.org/BlogPosting">

                    <header class="article-header">
                        <h1 class="page-title" itemprop="headline">Servidores - <?=$titfrag?></h1>
                    </header>

                    <section class="entry-content cf" itemprop="articleBody">
                        <div class="col-12">
                            <!--p>Remuneração dos servidores e afastados junto à CMSP referente a < ?=$json['remun-ano-mes-atual-extenso'];? ></p-->
                            <p><?=$rotuloTabela;?></p>
                            <div class="overflow-mobile">
                                <table>
                                <?php if(false) { ?>
                                    <tr>
                                        <th>Matrícula</th>
                                        <th>Cargo</th>
                                        <th>Remuneração líquida do mês de <?=$json['remun-ano-mes-atual'];?></th>
                                    </tr>
                                <?php } ?>
                                <?php
                                $cspan = $atividade? 6 : 3;
                                foreach ($lotacoes as $lotOrd => $lotNome) {
                                    $servsLotacao = array_filter($json['remun-servidores'], function($srv) use ($lotNome) {
                                        return $srv["servidor-lotacao"] == $lotNome;
                                    });
                                    if($atividade) {
                                        usort($servsLotacao, function ($a, $b) {
                                            $compare = $b["servidor-ordem-funcao"] <=> $a["servidor-ordem-funcao"];
                                            if($compare == 0) $compare = $a["servidor-matricula"] <=> $b["servidor-matricula"];
                                            //if($compare == 0) $compare = $a["servidor-cargo"] <=> $b["servidor-cargo"];
                                            return $compare;
                                        });
                                    } else {
                                        usort($servsLotacao, function ($a, $b) {
                                            $compare = $a["servidor-matricula"] <=> $b["servidor-matricula"];
                                            return $compare;
                                        });
                                    }
                                    ?>
                                    <?php if($atividade) { ?>
                                        <tr><th colspan="<?=$cspan?>"><?=$lotNome;?></th></tr>
                                    <?php } ?>
                                    <tr>
                                        <th>Matrícula</th>
                                        <th>Cargo</th>
                                        <?php if($atividade) { ?>
                                            <th>Função</th>
                                            <th>Admissão <br />no mês</th>
                                            <th>Exoneração</th>
                                        <?php } ?>
                                        <th>Remuneração líquida do mês de <?=$json['remun-ano-mes-atual'];?></th>
                                    </tr>
                                    <?php
                                    foreach($servsLotacao as $serv) {
                                        //print_r($serv);
                                        //[< ?=$serv['servidor-ordem-lotacao'];? >-< ?=$serv['servidor-ordem-funcao'];? >]
                                        if($serv['servidor-ordem-lotacao'] == $lotOrd) { ?>
                                            <tr>
                                                <?php //if(!isVazio($serv['servidor-obs-matricula'])) { ?>
                                                <?php if(strlen($serv['servidor-matricula']) >= 8) { ?>
                                                    <td><?=$serv['servidor-obs-todos'];?></td>
                                                <?php } else { ?>
                                                    <td><?=$serv['servidor-matricula'];?></td>
                                                <?php } ?>
                                                <td><?=$serv['servidor-cargo'];?> <?php if ($serv["servidor-cargo-antigo"]) echo "*" ?></td>
                                                <?php if($atividade) { ?>
                                                    <td><?=$serv['servidor-funcao'];?></td>
                                                    <?php if($serv['servidor-ingresso-recente']) { ?>
                                                        <td>Servidor admitido em <?=$serv['servidor-data-ingresso'];?></td>
                                                    <?php } else { ?>
                                                        <td>&nbsp;</td>
                                                    <?php } ?>
                                                    <?php if(!isVazio($serv['servidor-data-exoneracao'])) { ?>
                                                        <td>Servidor exonerado em <?=$serv['servidor-data-exoneracao'];?></td>
                                                    <?php } else { ?>
                                                        <td>&nbsp;</td>
                                                    <?php } ?>
                                                <?php } ?>
                                                <td>
                                                    <?php if(!isVazio($serv['servidor-obs-todos'])) { ?>
                                                        <?=$serv['servidor-obs-todos'];?><br />
                                                    <?php } ?>
                                                    <?php if($serv['mensal-liquido'] != $serv['mensal-final']) { ?>
                                                        após desc. Previd./I.R. = <a href="<?=$detalhesUrl?>?serv=<?=$serv['servidor-nomearquivo']?>"><?=$serv['mensal-liquido'];?></a>
                                                        <br />
                                                        após desc. judic. ou autorizados p/ servidor = <a href="<?=$detalhesUrl?>?serv=<?=$serv['servidor-nomearquivo']?>"><?=$serv['mensal-final'];?></a>
                                                    <?php } else { ?>
                                                        <a href="<?=$detalhesUrl?>?serv=<?=$serv['servidor-nomearquivo']?>"><?=$serv['mensal-liquido'];?></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    //
                                } ?>
                            </table>
                            </div>
                            <?php if($atividade) { ?>
                                <p>* Nomenclatura anterior à Constituição Federal de 1988; atual desempenho de funções de apoio administrativo.</p>
                            <?php } ?>
                        </div>
                    </section>

                </article>
            </div>

            <script>
                jQuery(document).ready(function($){
                    //Initially hide all the item-content
                    $('.item-content').hide();

                    // Attach a click event to item-title
                    $('.item-title').on('click', function (e) {
                        e.preventDefault();
                        //Find the next element having class item-content
                        $(this).next('.item-content').toggle();
                    });
                    $('#ano-atual').show();
                });
            </script>

            <!-- Sidebar -->
            <?php wp_reset_query(); ?>
            <?php get_sidebar('page'); ?>

        </div>
    </div>
    <style>
        @media (max-width: 768px) {
            .overflow-mobile {
                overflow-x: auto;
            }
        }
    </style>
</main>
<?php get_footer(); ?>