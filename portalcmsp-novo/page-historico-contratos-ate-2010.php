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
                    <h1 class="page-title" itemprop="headline"><?php the_title() ?></h1>
                </header>

                <section class="entry-content cf" itemprop="articleBody">

                <div class="container-fluid">
                    <div id="accordion" class="accordion">
                        <div class="card m-b-0">
                            <?php
                                $caminhoArquivos = 'https://' . $_SERVER['SERVER_NAME'] . "/wp-content/uploads/spot-legado/contratos-historicos/arquivos/";

                                // JSON string
                                //$someJSON = '[{"name":"Jonathan Suh","gender":"male"},{"name":"William Philbin","gender":"male"},{"name":"Allison McKinnery","gender":"female"}]';
                                $someJSON = file_get_contents(__DIR__ . '/../../uploads/spot-legado/contratos-historicos/contratos-historicos.json');

                                // Convert JSON string to Object
                                $itensJson = json_decode($someJSON);
                                //print_r($itensJson);      // Dump all data of the Object

                                usort($itensJson, function($a, $b) { //Sort the array using a user defined function

                                    // remove os acentos para ordenação
                                    $accents_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'Ğ'=>'G', 'İ'=>'I', 'Ş'=>'S', 'ğ'=>'g', 'ı'=>'i', 'ş'=>'s', 'ü'=>'u', 'ă'=>'a', 'Ă'=>'A', 'ș'=>'s', 'Ș'=>'S', 'ț'=>'t', 'Ț'=>'T');
                                    $unaccentedB = strtr($b->fornecedor, $accents_array);
                                    $unaccentedA = strtr($a->fornecedor, $accents_array);

                                    return $unaccentedB > $unaccentedA ? -1 : 1; //Compare the scores
                                });

                                // Loop through Object
                                foreach($itensJson as $i => $item) {
                                    ?>
                                    <div class="item-title">
                                        <h4><a class="card-title" href="#"><?=$item->fornecedor?></a></h4>
                                    </div>
                                    <div class="item-content">
                                        <?php foreach($item->contratos as $j => $itemzinho) { ?>
                                            <div>
                                                <p>
                                                    <?php if(!empty($itemzinho->contratada)){ ?> <b>Contratada:</b> <?=$itemzinho->contratada?>   <br /><?php } ?>
                                                    <?php if(!empty($itemzinho->termo)){ ?>      <b>Termo:</b> <?=$itemzinho->termo?>             <br /><?php } ?>
                                                    <?php if(!empty($itemzinho->objeto)){ ?>     <b>Objeto:</b> <?=$itemzinho->objeto?>           <br /><?php } ?>
                                                    <?php if(!empty($itemzinho->{'valor-detalhe'})){ ?>      <b>Valor:</b> <?=$itemzinho->{'valor-detalhe'}?>             <br /><?php } ?>
                                                    <?php if(!empty($itemzinho->empenho)){ ?>    <b>Empenho:</b> <?=$itemzinho->empenho?>         <br /><?php } ?>
                                                    <?php if(!empty($itemzinho->verba)){ ?>      <b>Verba:</b> <?=$itemzinho->verba?>             <br /><?php } ?>
                                                    <?php if(!empty($itemzinho->vigencia)){ ?>   <b>Vig&ecirc;ncia:</b> <?=$itemzinho->vigencia?> <br /><?php } ?>
                                                    <?php if(!empty($itemzinho->assinatura)){ ?> <b>Assinatura:</b> <?=$itemzinho->assinatura?>   <br /><?php } ?>
                                                    <?php if(!empty($itemzinho->arquivo)) { ?>
                                                        <!--<b>Arquivo:</b>&nbsp;-->
                                                        <a href='<?=$caminhoArquivos . $itemzinho->arquivo; ?>'>Contrato na íntegra.</a><br />
                                                    <?php } ?>
                                                </p>
                                            </div>
                                        <?php } ?>
                                  </div>
                            <?php } ?>
							<p>Contratos de Comunicação assinados até 2015.  Todos os outros contratos assinados até 2010.</p>
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
