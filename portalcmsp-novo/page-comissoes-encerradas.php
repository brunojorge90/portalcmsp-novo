<?php get_header(); ?>

<div id="content">

    <div class="breadcrumbs cf">
        <?php if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('<p class="wrap cf">','</p>');
        } ?>
    </div>

    <div id="inner-content" class="wrap cf">

        <div id="main" class="two-column-main cf" role="main">

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="https://schema.org/BlogPosting">

                <header class="article-header">
                    <h1 class="page-title" itemprop="headline">Comissões encerradas</h1>
                </header>

                <section class="entry-content cf" itemprop="articleBody">

                <div class="container-fluid">
                    <div id="accordion" class="accordion">
                        <div class="card m-b-0">

                            <?php
                                $caminhoArquivos = 'https://' . $_SERVER['SERVER_NAME'] . "/wp-content/uploads/spot-legado/comissoes-encerradas/arquivos/";

                              // JSON string
                              //$someJSON = '[{"name":"Jonathan Suh","gender":"male"},{"name":"William Philbin","gender":"male"},{"name":"Allison McKinnery","gender":"female"}]';
                              $someJSON = file_get_contents(__DIR__ . '/../../uploads/spot-legado/comissoes-encerradas/comissoes-encerradas.json');

                              // Convert JSON string to Object
                              $comissoesJson = json_decode($someJSON);
                              //print_r($comissoesJson);      // Dump all data of the Object

                              // Loop through Object
                              foreach($comissoesJson as $com => $comis) {
                                $comisHref = "comissao-$comis->ComissaoTipo-$comis->ComissaoID";
                                ?>
                                <div class="item-title">
                                    <h4><a class="card-title" href="#"><?=$comis->ComissaoDescr?></a></h4>
                                </div>
                                <div class="item-content">
                                    <p>
                                    <?php
                                    # Listagem de vereadores da Comissão
                                    $primeiroDemais = true;
                                    foreach($comis->ComissaoVereadores as $verea) {
                                        $vereadorCargo = '';
                                        switch ($verea->VereaCargo) {
                                            case 0:
                                                $vereadorCargo = 'Presidente';
                                                echo "<b>$vereadorCargo:</b>&nbsp;";
                                                break;
                                            case 1:
                                                $vereadorCargo = 'Vice-Presidente';
                                                echo "<b>$vereadorCargo:</b>&nbsp;";
                                                break;
                                            case 3:
                                                $vereadorCargo = 'Relator';
                                                echo "<b>$vereadorCargo:</b>&nbsp;";
                                                break;
                                            case 2:
                                                $vereadorCargo = 'Demais Integrantes';
                                                if($primeiroDemais) {
                                                    echo "<b>$vereadorCargo:</b><br />";
                                                }
                                                $primeiroDemais = false;
                                                break;
                                        }
                                        echo "$verea->VereaNome ($verea->VereaPartido)<br />";
                                    }
                                    ?>
                                    </p>
                                    <p><b>Atribuições:</b><br /><?=$comis->ComissaoAtribuicoes?></p>
                                    <p>
                                        <?php if(!empty($comis->ComissaoDataInicio)){ ?>
                                            <b>Data de início:</b> <?=$comis->ComissaoDataInicio?><br />
                                        <?php } if(!empty($comis->ComissaoDataTermino)){ ?>
                                            <b>Data de término:</b> <?=$comis->ComissaoDataTermino?>
                                        <?php } ?>
                                    </p>
                                    <p>
                                        <?php if(!empty($comis->ComissaoArquivo1Nome) && !empty($comis->ComissaoArquivo1Descr)) { ?>
                                            <b>Arquivo:</b>&nbsp;
                                            <a href='<?=$caminhoArquivos . $comis->ComissaoArquivo1Nome; ?>'>
                                                <?=$comis->ComissaoArquivo1Descr?>
                                            </a><br />
                                        <?php } if(!empty($comis->ComissaoArquivo2Nome) && !empty($comis->ComissaoArquivo2Descr)) { ?>
                                            <b>Arquivo (2):</b>&nbsp;
                                            <a href='<?=$caminhoArquivos . $comis->ComissaoArquivo2Nome; ?>'>
                                                <?=$comis->ComissaoArquivo2Descr?>
                                            </a><br />
                                        <?php } if(!empty($comis->ComissaoRelNome) && !empty($comis->ComissaoRelDescr)) { ?>
                                            <b>Relatório final:</b>&nbsp;
                                            <a href='<?=$caminhoArquivos . $comis->ComissaoRelNome; ?>'>
                                                <?=$comis->ComissaoRelDescr?>
                                            </a>
                                        <?php } ?>
                                    </p>
                                </div>

                                <?php
                              }
                            ?>
                        </div>
                    </div>
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
</main>
<?php get_footer(); ?>