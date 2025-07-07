<?php
/*
    Template Name: Salários: Detalhes
*/
?>

<?php get_header(); ?>

<div id="content">
    <div class="breadcrumbs cf">
        <?php if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('<p class="wrap cf">','</p>');
        } ?>
    </div>

    <?php
        $servNomeArquivo = $_GET['serv'];

        $jsonURL = __DIR__ . '/../../uploads/transparencia/salariosabertos/JSON_detalhes/' . $servNomeArquivo . '.json';
        $JSON_file = file_get_contents($jsonURL);

        // Convert JSON string to Object
        $json = json_decode($JSON_file, true);
        //print_r($json);

        //echo "json['servidor-atividade']: [" . $json['servidor-atividade'] . "]";
        $atividade = ($json['servidor-atividade'] == 0);

        $linkBase = "https://www.saopaulo.sp.leg.br/transparencia/salarios-abertos/salarios-abertos/";
        $linkListAtivos = $linkBase . "remuneracao-dos-servidores-e-afastados/";
        $linkListAposent = $linkBase . "remuneracao-dos-servidores-aposentados/";
        $linkVoltar = $atividade ? $linkListAtivos : $linkListAposent;
        //$linkVoltar = $atividade ? "../salarios-remuneracao-teste/" : "../salarios-remuneracao-teste/?ativ=apos";
        //$linkVoltar = ($json['servidor-atividade'] == 0) ? "../salarios-remuneracao-teste/" : "../salarios-remuneracao-teste/?ativ=apos";

        function isVazio($jsonField) {
            $isVazio = ($jsonField == null or $jsonField == '' or $jsonField == "R$ 0,00");
            //echo "<h3>json[<b>$jsonField</b>]: [" . $json[$jsonField] . '] isVazio: [' . $isVazio . ']</h3>';
            return $isVazio;
        }

        $exibe_DecimoTerceiro = !isVazio($json['decimoterceiro-base']);
        $exibe_Ferias = (!isVazio($json['ferias-bruto']) or !isVazio($json['ferias-liquido']));
        $exibe_OutrosNaoRec = (!isVazio($json['outrosnr-creditos']) or !isVazio($json['outrosnr-bruto'])
            or !isVazio($json['outrosnr-prev']) or !isVazio($json['outrosnr-irrf']) or !isVazio($json['outrosnr-liquido'])
            or !isVazio($json['outrosnr-descontos']) or !isVazio($json['outrosnr-final']));
        $exibe_AtrasadosNr = (!isVazio($json['atrasadosnr-creditos']) or !isVazio($json['atrasadosnr-bruto'])
            or !isVazio($json['atrasadosnr-prev']) or !isVazio($json['atrasadosnr-irrf']) or !isVazio($json['atrasadosnr-liquido'])
            or !isVazio($json['atrasadosnr-descontos']) or !isVazio($json['atrasadosnr-final']));
        $exibe_Anteriores = (!isVazio($json['anteriores-creditos']) or !isVazio($json['anteriores-abono'])
            or !isVazio($json['anteriores-bruto'])
            or !isVazio($json['anteriores-prev']) or !isVazio($json['anteriores-irrf']) or !isVazio($json['anteriores-liquido'])
            or !isVazio($json['anteriores-descontos']) or !isVazio($json['anteriores-final'])
            or !isVazio($json['anteriores-teto']));

        $colunas_ParcelasNr = 0;
        if($exibe_DecimoTerceiro) ++$colunas_ParcelasNr;
        if($exibe_Ferias)         ++$colunas_ParcelasNr;
        if($exibe_OutrosNaoRec)   ++$colunas_ParcelasNr;
        if($exibe_AtrasadosNr)    ++$colunas_ParcelasNr;
        if($exibe_Anteriores)     ++$colunas_ParcelasNr;
    ?>

    <div id="inner-content" class="wrap cf">

        <div id="main" role="main">

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="https://schema.org/BlogPosting">

                <header class="article-header">
                    <h2 class="page-title" itemprop="headline">Detalhes da remunera&ccedil;&atilde;o do Servidor
                        <?php if(strlen($json['servidor-matricula']) < 8) { ?>
                            <?=$json['servidor-matricula'];?>
                        <?php } ?>
                     referente a <?=$json['servidor-mesanoatual'];?></h2>
                </header>

                <section class="entry-content cf" itemprop="articleBody">
                    <div class="col-12">
                        <table>
                            <?php if($colunas_ParcelasNr) { ?>
                                <tr>
                                    <th colspan="2">&nbsp;</th>
                                    <th colspan="<?=$colunas_ParcelasNr?>">Parcelas n&#227;o recorrentes</th>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Remunera&ccedil;&atilde;o<?php if($colunas_ParcelasNr > 2) echo '<br />'?> do m&ecirc;s</th>
                                <?php if($colunas_ParcelasNr) { ?>
                                    <?php if($exibe_DecimoTerceiro) { ?>
                                        <th>Parcela<br />de 13&#186;</th>
                                    <?php } ?>
                                    <?php if($exibe_Ferias) { ?>
                                        <th>Ter&ccedil;o de<br />F&eacute;rias</th>
                                    <?php } ?>
                                    <?php if($exibe_OutrosNaoRec) { ?>
                                        <th>Outros<br />Cr&eacute;ditos</th>
                                    <?php } ?>
                                    <?php if($exibe_AtrasadosNr) { ?>
                                        <th>Cr&eacute;ditos<br />atrasados</th>
                                    <?php } ?>
                                    <?php if($exibe_Anteriores) { ?>
                                        <th>Cr&eacute;ditos atrasados<br />(per&iacute;odos anteriores)</th>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Remunera&ccedil;&atilde;o bruta do m&ecirc;s*</td>
                                <td><?=$json['mensal-bruto-teto'];?></td>
                                <?php if($colunas_ParcelasNr) { ?>
                                    <?php if($exibe_DecimoTerceiro) { ?>
                                        <td><?=$json['decimoterceiro-base'];?></td>
                                    <?php } ?>
                                    <?php if($exibe_Ferias) { ?>
                                        <td><?=$json['ferias-bruto'];?></td>
                                    <?php } ?>
                                    <?php if($exibe_OutrosNaoRec) { ?>
                                        <td>&nbsp;</td>
                                    <?php } ?>
                                    <?php if($exibe_AtrasadosNr) { ?>
                                        <td>&nbsp;</td>
                                    <?php } ?>
                                    <?php if($exibe_Anteriores) { ?>
                                        <td><?=$json['anteriores-creditos'];?></td>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                            <?php if(!isVazio($json['mensal-abono'])) { ?>
                                <tr>
                                    <td>Abono de perman&ecirc;ncia</td>
                                    <td><?=$json['mensal-abono'];?></td>
                                    <?php if($colunas_ParcelasNr) { ?>
                                        <?php if($exibe_DecimoTerceiro) { ?>
                                            <td><?=$json['decimoterceiro-abono'];?></td>
                                        <?php } ?>
                                        <?php if($exibe_Ferias) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                        <?php if($exibe_OutrosNaoRec) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                        <?php if($exibe_AtrasadosNr) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                        <?php if($exibe_Anteriores) { ?>
                                            <td><?=$json['anteriores-abono'];?></td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <?php if(!isVazio($json['atrasadosnr-creditos'])) { ?>
                                <tr>
                                    <td>Créditos atrasados</td>
                                    <td>&nbsp;</td>
                                    <?php if($colunas_ParcelasNr) { ?>
                                        <?php if($exibe_DecimoTerceiro) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                        <?php if($exibe_Ferias) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                        <?php if($exibe_OutrosNaoRec) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                        <?php if($exibe_AtrasadosNr) { ?>
                                            <td><?=$json['atrasadosnr-creditos'];?></td>
                                        <?php } ?>
                                        <?php if($exibe_Anteriores) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <?php if(!isVazio($json['mensal-outros']) or !isVazio($json['outrosnr-creditos'])) { ?>
                                <tr>
                                    <td>Outros créditos</td>
                                    <td><?=$json['mensal-outros'];?></td>
                                    <?php if($colunas_ParcelasNr) { ?>
                                        <?php if($exibe_DecimoTerceiro) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                        <?php if($exibe_Ferias) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                        <?php if($exibe_OutrosNaoRec) { ?>
                                            <td><?=$json['outrosnr-creditos'];?></td>
                                        <?php } ?>
                                        <?php if($exibe_AtrasadosNr) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                        <?php if($exibe_Anteriores) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td><strong>Remunera&ccedil;&atilde;o bruta</strong></td>
                                <td><strong><?=$json['mensal-bruto-efetivo'];?></strong></td>
                                <?php if($colunas_ParcelasNr) { ?>
                                    <?php if($exibe_DecimoTerceiro) { ?>
                                        <td><strong><?=$json['decimoterceiro-bruto'];?></strong></td>
                                    <?php } ?>
                                    <?php if($exibe_Ferias) { ?>
                                        <td><strong><?=$json['ferias-bruto'];?></strong></td>
                                    <?php } ?>
                                    <?php if($exibe_OutrosNaoRec) { ?>
                                        <td><strong><?=$json['outrosnr-bruto'];?></strong></td>
                                    <?php } ?>
                                    <?php if($exibe_AtrasadosNr) { ?>
                                        <td><strong><?=$json['atrasadosnr-bruto'];?></strong></td>
                                    <?php } ?>
                                    <?php if($exibe_Anteriores) { ?>
                                        <td><strong><?=$json['anteriores-bruto'];?></strong></td>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Contrib. Previd. (<?=$json['servidor-prev-orgao'];?>)</td>
                                <?php //(<?=$json['servidor-prev-porcent'];? >&nbsp;<?=$json['servidor-prev-orgao'];? >) ?>
                                <?php if(!isVazio($json['mensal-prev'])) { ?>
                                    <td><?=$json['mensal-prev'];?></td>
                                <?php } else { ?>
                                    <td>R$ 0,00</td>
                                <?php } ?>
                                <?php if($colunas_ParcelasNr) { ?>
                                    <?php if($exibe_DecimoTerceiro) { ?>
                                        <td><!--decimoterceiro-prev--><?=$json['decimoterceiro-prev'];?></td>
                                    <?php } ?>
                                    <?php if($exibe_Ferias) { ?>
                                        <td><!--ferias-prev-->&nbsp;</td>
                                    <?php } ?>
                                    <?php if($exibe_OutrosNaoRec) { ?>
                                        <?php if(!isVazio($json['outrosnr-prev'])) { ?>
                                            <td><!--outrosnr-prev--><?=$json['outrosnr-prev'];?></td>
                                        <?php } else { ?>
                                            <td><!--outrosnr-prev-->***</td>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if($exibe_AtrasadosNr) { ?>
                                        <?php if(!isVazio($json['atrasadosnr-prev'])) { ?>
                                            <td><!--atrasadosnr-prev--><?=$json['atrasadosnr-prev'];?></td>
                                        <?php } else { ?>
                                            <td><!--atrasadosnr-prev-->***</td>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if($exibe_Anteriores) { ?>
                                        <td><!--anteriores-prev--><?=$json['anteriores-prev'];?></td>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Imposto de renda</td>
                                <?php if(!isVazio($json['mensal-irrf'])) { ?>
                                    <td><?=$json['mensal-irrf'];?></td>
                                <?php } else { ?>
                                    <td>R$ 0,00</td>
                                <?php } ?>
                                <?php if($colunas_ParcelasNr) { ?>
                                    <?php if($exibe_DecimoTerceiro) { ?>
                                        <td><!--decimoterceiro-irrf--><?=$json['decimoterceiro-irrf'];?></td>
                                    <?php } ?>
                                    <?php if($exibe_Ferias) { ?>
                                        <td><!--ferias-irrf--><?=$json['ferias-irrf'];?></td>
                                    <?php } ?>

                                    <?php if($exibe_OutrosNaoRec) { ?>
                                        <?php if(!isVazio($json['outrosnr-irrf'])) { ?>
                                            <td><!--outrosnr-irrf--><?=$json['outrosnr-irrf'];?></td>
                                        <?php } else { ?>
                                            <td><!--outrosnr-irrf-->****</td>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if($exibe_AtrasadosNr) { ?>
                                        <?php if(!isVazio($json['atrasadosnr-irrf'])) { ?>
                                            <td><!--atrasadosnr-irrf--><?=$json['atrasadosnr-irrf'];?></td>
                                        <?php } else { ?>
                                            <td><!--atrasadosnr-irrf-->****</td>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if($exibe_Anteriores) { ?>
                                        <td><!--anteriores-irrf--><?=$json['anteriores-irrf'];?></td>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td><strong>Remunera&ccedil;&atilde;o l&#237;quida</strong></td>
                                <td><strong><?=$json['mensal-liquido'];?></strong></td>
                                <?php if($colunas_ParcelasNr) { ?>
                                    <?php if($exibe_DecimoTerceiro) { ?>
                                        <td><strong><?=$json['decimoterceiro-liquido'];?></strong></td>
                                    <?php } ?>
                                    <?php if($exibe_Ferias) { ?>
                                        <td><strong><?=$json['ferias-liquido'];?></strong></td>
                                    <?php } ?>
                                    <?php if($exibe_OutrosNaoRec) { ?>
                                        <td><strong><?=$json['outrosnr-liquido'];?></strong></td>
                                    <?php } ?>
                                    <?php if($exibe_AtrasadosNr) { ?>
                                        <td><strong><?=$json['atrasadosnr-liquido'];?></strong></td>
                                    <?php } ?>
                                    <?php if($exibe_Anteriores) { ?>
                                        <td><strong><?=$json['anteriores-liquido'];?></strong></td>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                            <?php if(!isVazio($json['mensal-descontos'])
                                or !isVazio($json['decimoterceiro-descontos'])
                                or !isVazio($json['ferias-descontos'])
                                or !isVazio($json['outrosnr-descontos'])
                                or !isVazio($json['atrasadosnr-descontos'])
                                or !isVazio($json['anteriores-descontos']))
                            { ?>
                                <tr>
                                    <td>Descontos judiciais ou autorizados pelo servidor</td>
                                    <td><?=$json['mensal-descontos'];?></td>
                                    <?php if($colunas_ParcelasNr) { ?>
                                        <?php if($exibe_DecimoTerceiro) { ?>
                                            <td><?=$json['decimoterceiro-descontos'];?></td>
                                        <?php } ?>
                                        <?php if($exibe_Ferias) { ?>
                                            <td><?=$json['ferias-descontos'];?></td>
                                        <?php } ?>
                                        <?php if($exibe_OutrosNaoRec) { ?>
                                            <td><?=$json['outrosnr-descontos'];?></td>
                                        <?php } ?>
                                        <?php if($exibe_AtrasadosNr) { ?>
                                            <td><?=$json['atrasadosnr-descontos'];?></td>
                                        <?php } ?>
                                        <?php if($exibe_Anteriores) { ?>
                                            <td><?=$json['anteriores-descontos'];?></td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td><strong>Cr&eacute;dito ao servidor</strong></td>
                                <td><strong><?=$json['mensal-final'];?></strong></td>
                                <?php if($colunas_ParcelasNr) { ?>
                                    <?php if($exibe_DecimoTerceiro) { ?>
                                        <td><strong><?=$json['decimoterceiro-final'];?></strong></td>
                                    <?php } ?>
                                    <?php if($exibe_Ferias) { ?>
                                        <td><strong><?=$json['ferias-final'];?></strong></td>
                                    <?php } ?>
                                    <?php if($exibe_OutrosNaoRec) { ?>
                                        <td><strong><?=$json['outrosnr-final'];?></strong></td>
                                    <?php } ?>
                                    <?php if($exibe_AtrasadosNr) { ?>
                                        <td><strong><?=$json['atrasadosnr-final'];?></strong></td>
                                    <?php } ?>
                                    <?php if($exibe_Anteriores) { ?>
                                        <td><strong><?=$json['anteriores-final'];?></strong></td>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                            <?php if(!isVazio($json['mensal-teto']) ||
                                    !isVazio($json['decimoterceiro-teto']) ||
                                    !isVazio($json['anteriores-teto'])) { ?>
                                <tr>
                                    <td>Retenção no teto constitucional</td>
                                    <td><?=$json['mensal-teto'];?></td>
                                    <?php if($colunas_ParcelasNr) { ?>
                                        <?php if($exibe_DecimoTerceiro) { ?>
                                            <td><?=$json['decimoterceiro-teto'];?></td>
                                        <?php } ?>
                                        <?php if($exibe_Ferias) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                        <?php if($exibe_OutrosNaoRec) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                        <?php if($exibe_AtrasadosNr) { ?>
                                            <td>&nbsp;</td>
                                        <?php } ?>
                                        <?php if($exibe_Anteriores) { ?>
                                            <td><?=$json['anteriores-teto'];?></td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <?php if(!isVazio($json['servidor-tempo-contribuicao'])) { ?>
                                <tr>
                                    <td><strong>Tempo de contribui&ccedil;&atilde;o na CMSP</strong><?php if(!isVazio($json['servidor-obs-exoneracao'])) { ?>&nbsp;**<?php } ?></td>
                                    <td colspan="<?=($colunas_ParcelasNr + 1)?>">
                                        <?=$json['servidor-tempo-contribuicao'];?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                        <p>
                            * Remuneração bruta
                            <?php if($atividade) { ?>
                                com desconto de afastamentos e faltas,
                            <?php } ?>
                            limitada ao Teto Salarial conforme artigo 37 inciso XI da Constituição Federal,
                            se não houver decisão judicial em contrário.
                        </p>
                        <?php if(!isVazio($json['servidor-obs-exoneracao'])) { ?>
                            <p><?=$json['servidor-obs-exoneracao']?></p>
                        <?php } ?>
                        <?php
                            if( ($exibe_OutrosNaoRec && isVazio($json['outrosnr-prev'])) ||
                                ($exibe_AtrasadosNr && isVazio($json['atrasadosnr-prev'])) ) {
                            ?>
                                <p>
                                    *** O valor da Previdência referente a esta parcela não recorrente, se houver,
                                    está englobado no respectivo campo da coluna "Remuneração do Mês".
                                </p>
                            <?php
                            }
                            if( ($exibe_OutrosNaoRec && isVazio($json['outrosnr-irrf'])) ||
                                ($exibe_AtrasadosNr && isVazio($json['atrasadosnr-irrf'])) ) {
                            ?>
                                <p>
                                    **** O valor de Imposto de Renda referente a esta parcela não recorrente, se houver,
                                    está englobado no respectivo campo da coluna "Remuneração do Mês".
                                </p>
                            <?php
                            }
                        ?>
                        <?php if(!empty($json) && array_key_exists('retroativos-existem', $json) && $json['retroativos-existem']) { ?>
                            <p><strong>&#42;</strong> Servidor(a) percebeu reembolso referente a <?=$json['mes-anterior'];?> e anterior(es).</p>
                        <?php } ?>
                        <?php if(!empty($json) && array_key_exists('servidor-obs-detalhes', $json) && !isVazio($json['servidor-obs-detalhes'])) { ?>
                            <p>NOTA: <?=json['servidor-obs-detalhes']?></p>
                        <?php } ?>
                    </div>
                </section>

                <p><span class="feature-link-text"><a href="<?=$linkVoltar?>">Voltar</a></span></p>

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