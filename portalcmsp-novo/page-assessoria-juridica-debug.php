<?php
    # tem de ser no início do arquivo!
    if ( !session_id()) {
        session_start();
    }
?>
<?php
/*
 T3mpl4te Nam3: Assessoriah Jurídica DEBUG
*/
?>
<?php get_header(); ?>
<?php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

    if ( empty($_SESSION['post-data']) || ( !empty($_POST) && ($_SESSION['post-data'] != $_POST) ) ) {
       $_SESSION['post-data'] = $_POST;
    }

/*
    echo "<br /><br />" . __LINE__ . "_POST:"; print_r($_POST);
    echo "<br />_POST['frmTipo']: " . $_POST['frmTipo'];
    echo "<br />_POST['frmNumero']: " . $_POST['frmNumero'];
    echo "<br />_POST['frmAno']: " . $_POST['frmAno'];
    echo "<br />_POST['frmPesquisa']: " . $_POST['frmPesquisa'];

    echo "<br /><br />" . __LINE__ . "_SESSION[post-data]:"; print_r($_SESSION['post-data']);
    echo "<br />_SESSION['post-data']['frmTipo']: " . $_SESSION['post-data']['frmTipo'];
    echo "<br />_SESSION['post-data']['frmNumero']: " . $_SESSION['post-data']['frmNumero'];
    echo "<br />_SESSION['post-data']['frmAno']: " . $_SESSION['post-data']['frmAno'];
    echo "<br />_SESSION['post-data']['frmPesquisa']: " . $_SESSION['post-data']['frmPesquisa'];
*/

    //$tipo = '';
    if(isset($_SESSION['post-data']['frmTipo'])) {
        $tipo = $_SESSION['post-data']['frmTipo'];
    }
    //$numero = '';
    if(isset($_SESSION['post-data']['frmNumero'])) {
        $numero = $_SESSION['post-data']['frmNumero'];
    }
    //$ano = '';
    if(isset($_SESSION['post-data']['frmAno'])) {
        $ano = $_SESSION['post-data']['frmAno'];
    }
    $pesquisa = '';
    if(isset($_SESSION['post-data']['frmPesquisa'])) {
        #$pesquisa = "possuia 29 anos de contribuicao"; #Parecer n° 394/2005
        $pesquisa = $_SESSION['post-data']['frmPesquisa'];
        $pesquisa = remove_accents($pesquisa);
        $pesquisa = str_replace('\\', "", $pesquisa);
        $pesquisa = str_replace('"', "", $pesquisa);
        $pesquisa = str_replace("'", "", $pesquisa);
        $pesquisa = strtolower(trim($pesquisa));
        #echo "<br> " . __LINE__ . ": #pesquisa : $pesquisa";
        $_SESSION['post-data']['frmPesquisa'] = $pesquisa;
    }

    /******************************************
      Compondo a query
    ******************************************/
    $meta_query = array(
        array( 'key' => 'tipo', 'value' => $tipo )
    );
	if (!empty($ano)) { array_push($meta_query, array( 'key' => 'ano', 'value' => $ano,'compare' => '==' )); }
	if (!empty($numero)) { array_push($meta_query, array( 'key' => 'numero', 'value' => $numero,'compare' => '==' )); }

    #$strPalPesquisa = strtolower(trim(remove_accents($pesquisa)));
    $strPalPesquisa = $pesquisa;

    #=====================================================================================================================
    # CODIGOS PARA CADA POSSIBILIDADE DE PESQUISA
    #
    # cod  0 = palavra simples:                                             exemplo: casa
    # cod  1 = palavras entre aspas duplas:                                 exemplo: "perto de"
    # cod  5 = palavras compostas por E:                                    exemplo: casa E registro
    # cod  8 = palavras compostas por OU:                                   exemplo: casa OU registro
    #
    # buscas mais complexas:
    # cod 13 = palavras compostas com os booleanos E e OU:                  exemplo: registro E casa OU parte
    # cod  6 = palavras entre aspas duplas e com o booleano E:              exemplo: "perto de" E casa
    # cod  9 = palavras entre aspas duplas e com o booleano OU:             exemplo: "perto de" OU casa
    # cod 14 = palavras entre aspas duplas e com os booleanos E e OU:       exemplo: "perto de" E casa OU registro
    #=====================================================================================================================

    $codParPesquisa = 0;

    if (strpos($strPalPesquisa, '"'))    $codParPesquisa  = 1;
    if (strpos($strPalPesquisa, " e "))  $codParPesquisa += 5;
    if (strpos($strPalPesquisa, " ou ")) $codParPesquisa += 8;

    //======> defininindo como o string SQL sera
    switch ($codParPesquisa) {

        # palavra simples
        case 0:
            #echo "<br>" . __LINE__ . ": <b>CASE 0 (SIMPLES)</b>";
            $args = array(
                'relation' => 'OR',
                array(
                    'key' => 'descricao',
                    'value' => $strPalPesquisa,
                    'compare' => 'LIKE',
                ),
                array(
                    'key' => 'palavras-chave',
                    'value' => $strPalPesquisa,
                    'compare' => 'LIKE',
                ),
            );
            array_push($meta_query, $args);
            break;

        # palavras entre aspas duplas

        case 1:
            #echo "<br>" . __LINE__ . ": <b>CASE 1 (ASPAS)</b>";
            $strPalPesquisa = str_replace('"', "", $strPalPesquisa);
            $args = array(
                'relation' => 'OR',
                array(
                    'key' => 'descricao',
                    'value' => $strPalPesquisa,
                    'compare' => 'LIKE',
                ),
                array(
                    'key' => 'palavras-chave',
                    'value' => $strPalPesquisa,
                    'compare' => 'LIKE',
                ),
            );
            array_push($meta_query, $args);
            break;

        # palavras entre Es
        case 5:
            #echo "<br>" . __LINE__ . ": <b>CASE 5 (E)</b>";
            $strPalavras = explode(" e ", $strPalPesquisa);
            $numFim = count($strPalavras);
            #echo '<br>' . __LINE__ . ": <b>#strPalavras</b>: "; print_r($strPalavras); echo " <b>#numFim:</b> $numFim";

            $args = array( 'relation' => 'AND' );
            $argsFor = "";

            for($i = 0; $i < $numFim; $i++){
                #echo "<br>" . __LINE__ . ": <b>i</b>:$i | <b>#strPalavras[$i]</b>: $strPalavras[$i]";
                $argsFor = array(
                    'relation' => 'OR',
                    array(
                        'key' => 'descricao',
                        'value' => $strPalavras[$i],
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key' => 'palavras-chave',
                        'value' => $strPalavras[$i],
                        'compare' => 'LIKE',
                    ),
                );
                array_push($args, $argsFor);
            }
            array_push($meta_query, $args);
            break;

        # palavras entre OUs
        case 8:
            #echo "<br>" . __LINE__ . ": <b>CASE 8 (OU)</b>";
            $strPalavras = explode(" ou ", $strPalPesquisa);
            $numFim = count($strPalavras);
            #echo '<br>' . __LINE__ . ": <b>#strPalavras</b>: "; print_r($strPalavras); echo " <b>#numFim:</b> $numFim";

            $args = array( 'relation' => 'OR' );
            $argsFor = "";

            for ($i = 0; $i < $numFim; $i++) {
                $argsFor = array(
                    'relation' => 'OR',
                    array(
                        'key' => 'descricao',
                        'value' => $strPalavras[$i],
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key' => 'palavras-chave',
                        'value' => $strPalavras[$i],
                        'compare' => 'LIKE',
                    ),
                );
                array_push($args, $argsFor);
            }
            array_push($meta_query, $args);
            break;

        # palavras entre Es e OUs em qq ordem
        case 13:
            #echo "<br>" . __LINE__ . ": <b>CASE 13</b>";
            $strPalavrasOrig = explode(" ", $strPalPesquisa);
            $numFimOrig = count($strPalavrasOrig);

            $args = [];
            $argsFor = "";

            for ($j = 0; $j = $numFimOrig; $j++) {
                $strTempPal = $strPalavrasOrig(j);
                if ($strTempPal = "e") {
                    $args = array( 'relation' => 'AND' );
                    $argsFor = array(
                        'relation' => 'OR',
                        array(
                            'key' => 'descricao',
                            'value' => $strTempPal[$i],
                            'compare' => 'LIKE',
                        ),
                        array(
                            'key' => 'palavras-chave',
                            'value' => $strTempPal[$i],
                            'compare' => 'LIKE',
                        ),
                    );
                    array_push($args, $argsFor);
                } else if ($strTempPal = "ou") {
                    $args = array( 'relation' => 'OR' );
                    $argsFor = array(
                        'relation' => 'OR',
                        array(
                            'key' => 'descricao',
                            'value' => $strTempPal[$i],
                            'compare' => 'LIKE',
                        ),
                        array(
                            'key' => 'palavras-chave',
                            'value' => $strTempPal[$i],
                            'compare' => 'LIKE',
                        ),
                    );
                    array_push($args, $argsFor);
                } else {
                    $args = array( 'relation' => 'OR' );
                    $argsFor = array(
                        'relation' => 'OR',
                        array(
                            'key' => 'descricao',
                            'value' => $strTempPal[$i],
                            'compare' => 'LIKE',
                        ),
                        array(
                            'key' => 'palavras-chave',
                            'value' => $strTempPal[$i],
                            'compare' => 'LIKE',
                        ),
                    );
                    array_push($args, $argsFor);
                }
            }
            array_push($meta_query, $args);
            break;

        # palavras com aspas duplas e E em qq ordem ========> NAO esta previsto
        # palavras com aspas duplas e OU em qq ordem =======> NAO esta previsto
        # palavras com aspas duplas e OU e E em qq ordem ===> NAO esta previsto
        default:
            #echo "<br>" . __LINE__ . ": <b>CASE DEFAULT</b>";
            $strPalPesquisa = str_replace('"', "", $strPalPesquisa);
            $strPalPesquisa = str_replace(" e ", " ", $strPalPesquisa);
            $strPalPesquisa = str_replace(" ou ", " ", $strPalPesquisa);
            $args = array(
                'relation' => 'OR',
                array(
                    'key' => 'descricao',
                    'value' => $strPalPesquisa,
                    'compare' => 'LIKE',
                ),
                array(
                    'key' => 'palavras-chave',
                    'value' => $strPalPesquisa,
                    'compare' => 'LIKE',
                ),
            );
            array_push($meta_query, $args);
            array_push($meta_query, $args);
    } // switch

    echo "<br><br>" . __LINE__ . ": <b>#codParPesquisa:</b> $codParPesquisa   <b>#strPalPesquisa:</b> $strPalPesquisa";
    echo "<br><br>" . __LINE__ . ": <b>#args:</b> "; print_r($args);
    echo "<br><br>" . __LINE__ . ": <b>#meta_query_after:</b> "; print_r($meta_query);


    /******************************************
      Paginação
    ******************************************/

    //what pagination page are we on?
    if( !empty($_GET['pag']) && is_numeric($_GET['pag']) ){
        $paged = $_GET['pag'];
    } else {
        $paged = 1;
    }

    //you could use this if you want, just make sure to use "/page/2" instead of "?pag=2" in the pagination links.
    //$paged = (get_query_var('paged')) ? get_query_var('paged') : 0;

    //how many posts should we display?
    #$posts_per_page = (get_option('posts_per_page')) ? get_option('posts_per_page') : 10;
    $posts_per_page = 50;

    $cpt_name = 'assessoria_juridica'; //add your own post type

    //let's first get ALL of the possible posts
    $all_posts_args = array(
            'post_type'        => $cpt_name,
            'meta_query'       => $meta_query,
            'fields'           => 'ids',
            'posts_per_page'   => -1,
            #'orderby'          => 'ano',
            #'order'            => 'DESC',
            'orderby' => array(
                'ano' => 'DESC',
                'numero' => 'DESC',
            ),
        );
    $all_posts = get_posts($all_posts_args);

    //how many total posts are there?
    $post_count = count($all_posts);

    //how many pages do we need to display all those posts?
    $num_pages = ceil($post_count / $posts_per_page);

    //let's make sure we don't have a page number that is higher than we have posts for
    if($paged > $num_pages || $paged < 1){
        $paged = $num_pages;
    }

    //now we get the posts we want to display
    $page_posts_args = array(
        'post_type'       => $cpt_name,
        'meta_query'      => $meta_query,
        'posts_per_page'  => $posts_per_page,
        'paged'           => $paged,
        #'orderby'         => 'ano',
        #'order'           => 'DESC',
        'orderby' => array(
            'ano' => 'DESC',
            'numero' => 'DESC',
        ),
    );

    $page_posts = get_posts($page_posts_args);
?>
    <script>
        /*
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
        */
    </script>
    <style>
        label:before {
            content: '';
            display: inline;
            background: none;
            position: static;
        }
    </style>
    <div id="content">

        <div class="breadcrumbs cf">
            <?php if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb('<p class="wrap cf">','</p>');
            } ?>
        </div>

        <div id="inner-content" class="wrap cf">
            <div id="main" class="cf" role="main">

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                    <header class="article-header">
                        <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
                    </header>
                    <section class="entry-content cf" itemprop="articleBody">
                        <div><?php the_content(); ?></div>
                        <div style="clear:both;"></div>

                            <form action="<?php the_permalink(); ?>" method="post" name="leis" id="buscaForm" accept-charset="utf-8">

                                    <div class="form-group">
                                        <div class="form-row">
                                            <label>Tipo:</label>
                                            <label style="text-transform:none; font-weight:normal;">
                                                <input type="radio" name="frmTipo" value="parecer" <?=((!isset($tipo) or $tipo == 'parecer' or $tipo  == '') ? 'checked="checked"' : '') ?> />&nbsp;Parecer
                                            </label>
                                            <label style="text-transform:none; font-weight:normal;">
                                                <input type="radio" name="frmTipo" value="nota" <?=($tipo == 'nota' ? 'checked="checked"' : '') ?> />&nbsp;Nota técnica
                                            </label>
                                            <label style="text-transform:none; font-weight:normal;">
                                                <input type="radio" name="frmTipo" value="adin" <?=($tipo == 'adin' ? 'checked="checked"' : '') ?> />&nbsp;ADIN
                                            </label>
                                        </div>
                                        <div class="form-row">
                                            <label>Número (campo textual):</label>
											<div style="font-size:small;"><b>OBS</b>: 1 é diferente de 01 - exemplos de números válidos: 003-Chefia | 2064901-79.2019.8.26.0000</div>
                                            <input type="text" name="frmNumero" size="200" maxlength="200"
                                                class="form-control" value="<?=$numero?>" />
                                            <label>Ano (com 4 dígitos):</label>
                                            <input type="text" name="frmAno" size="4" maxlength="4"
                                                class="form-control" placeholder="AAAA" value="<?=$ano?>" />
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="form-row">
                                            <label for="frmPesquisa">Pesquisa:&nbsp;</label>
                                            <input type="text" name="frmPesquisa" id="frmPesquisa" size="100" maxlength="100"
                                                class="form-control" value="<?=$pesquisa?>" />
                                        </div>
                                        <div class="form-row">
                                            <button class="btn btn-danger">
                                                <span class="glyphicon glyphicon-search"></span>&nbsp;Pesquisar
                                            </button>
                                        </div>
                                    </div>

                            </form>
                            <div style="clear:both;"></div>
                        <?php

                            //did we find any?
                            if( empty($page_posts) ) {
								echo '<div id="my-posts-wrapper"><br /><label>Não há resultados a exibir</label></div>';
							} else {
                                ?>
                                <div id="my-posts-wrapper">
                                    <br /><label>Foram encontrados <?=$post_count?> registros:</label>
                                    <?php
                                        //THE FAKE LOOP
                                        foreach($page_posts as $key => $post){
                                            //do stuff with your posts
                                            #echo '<div class="post">'.$post->post_title.'</div>';

                                            //$tipo = get_post_meta($post->ID, 'tipo', true);
                                            //$numero = ( empty(get_post_meta($post->ID, 'numero', true)) ? "(sem nro.)" : get_post_meta($post->ID, 'numero', true) );
                                            //$ano = get_post_meta($post->ID, 'ano', true);
                                            //$descricao = get_post_meta($post->ID, 'descricao', true);
                                            //$palavrasChave = get_post_meta($post->ID, 'palavras-chave', true);

                                            $post_title = get_the_title($post);

                                            //if($tipo == "parecer")  $post_title = "Parecer n&deg; $numero/$ano";
                                            //if($tipo == "nota")  	$post_title = "Nota técnica n&deg; $numero/$ano";
                                            //if($tipo == "adin")     $post_title = "ADIN n&deg; $numero";
											?>
                                            <div class="item-title">
                                                <h4>
                                                    <!--<a class="card-title" href="#"><?=$post_title?></a>-->
                                                    <a class="card-title" href="<?=get_home_url()?>/?p=<?=$post->ID?>" target="_blank"><?=$post_title?></a><br/>
                                                </h4>
                                            </div>
                                            <?php
												echo "<br><br>" . __LINE__ . ": <b>#TIPO:</b> " . get_post_meta($post->ID, 'tipo', true);
												echo "<br><br>" . __LINE__ . ": <b>#ANO:</b> " . get_post_meta($post->ID, 'ano', true);
												echo "<br><br>" . __LINE__ . ": <b>#NÚMERO:</b> " . get_post_meta($post->ID, 'numero', true);
												echo "<br><br>" . __LINE__ . ": <b>#POST:</b> "; print_r($post);
											/*
                                            <div class="item-content">
                                                <p><?=$descricao?></p>
                                                <!--<p><b>palavrasChave:</b>&nbsp;<?=$palavrasChave?></p>-->
                                            </div>
                                            */
                                            ?>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <?php

                                //we need to display some pagination if there are more total posts than the posts displayed per page
                                if($post_count > $posts_per_page ){
                                    ?>
                                    <div class="pagination">
                                        <ul>
                                            <?php
                                            if ($paged > 1) {
                                            ?>
                                                <li><a class="first" href="?pag=1">&laquo;</a></li>
                                            <?php
                                            } else {
                                                ?>
                                                <li><span class="first">&laquo;</span></li>
                                            <?php
                                            }
                                            for ($p = 1; $p <= $num_pages; $p++) {
                                                if ($paged == $p) {
                                                ?>
                                                    <li><span class="current"><?=$p?></span></li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li><a href="?pag=<?=$p?>&<?=htmlspecialchars(SID)?>"><?=$p?></a></li>
                                                <?php
                                                }
                                            }
                                            if($paged < $num_pages){
                                            ?>
                                                <li><a class="last" href="?pag=<?=$num_pages?>&<?=htmlspecialchars(SID)?>">&raquo;</a></li>
                                            <?php
                                            }else{
                                            ?>
                                                <li><span class="last">&raquo;</span></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <?php
                                }
                            } // if( !empty($page_posts) )
                        ?>
                    </section>
                </article>

            </div><!-- main -->
        </div><!-- inner-content -->

    </div><!-- content -->

<?php get_footer();?>