<?php
/*
    Template Name: Salários: Auxílio Saúde
*/
?>

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
                    <h1 class="page-title" itemprop="headline">Auxílio Saúde</h1>
                </header>

                <?php
                    $JSON_file = file_get_contents(__DIR__ . '/../../uploads/transparencia/salariosabertos/JSON_listagens/auxilio-saude.json');

                    // Convert JSON string to Object
                    $json = json_decode($JSON_file, true);
                    //print_r($json);
                ?>
                <section class="entry-content cf" itemprop="articleBody">
                    <div class="container-fluid">
                        <p>Reembolso efetuado em <?=$json['auxilio-ano-mes-atual'];?>, referente a <?=$json['auxilio-ano-mes-anterior'];?></p>
                        <table>
                            <tr>
                                <th>Matrícula</th>
                                <th>Auxílio Saúde</th>
                            </tr>
                            <?php
                                foreach($json['auxilio-servidores'] as $serv) {
                                    ?>
                                        <tr>
                                            <td><?=$serv['servidor-matricula'];?> <?php if ($serv["auxilio-retroativo"] == "SIM") echo "*" ?></td>
                                            <td><?=$serv['auxilio-valor'];?> <?php if ($serv["auxilio-retroativo"] == "SIM") echo "*" ?></td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </table>
                        <?php //if($json['retroativos-existem']) { ?>
                            <p><strong>&#42;</strong> Servidor(a) percebeu reembolso referente a <?=$json['auxilio-ano-mes-anterior'];?> e anterior(es).</p>
                        <?php //} ?>
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