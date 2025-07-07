<?php get_header(); ?>

<div id="content">

    <div class="breadcrumbs cf">
        <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="wrap cf">', '</p>');
        } ?>
    </div>

    <div id="inner-content" class="wrap cf">

        <div id="main" class="two-column-main cf" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope
                     itemtype="https://schema.org/BlogPosting">

                <header class="article-header">
                    <h1 class="page-title" itemprop="headline"><?php the_title() ?></h1>
                </header>

                <section class="entry-content cf" itemprop="articleBody">

                    <div class="container-fluid">
                        <div class="card m-b-0">

                            <?php the_content() ?>

                            <?php
                            // JSON string
                            //$someJSON = '[{"name":"Jonathan Suh","gender":"male"},{"name":"William Philbin","gender":"male"},{"name":"Allison McKinnery","gender":"female"}]';
                            #$jsonFilePath = __DIR__ . '/../../uploads/salariosabertos/';
                            #$jsonFilePath = 'http://129.191.26.47/wp-content/uploads/transparencia/funcionarios/';
                            #$jsonFilePath = 'http://static.saopaulo.sp.leg.br/transparencia/funcionarios/';
                            $jsonFilePath = ABSPATH . '/static/transparencia/funcionarios/';
                            $jsonFileName = 'funcionarios-qtde.json';
                            $request = file_get_contents($jsonFilePath . $jsonFileName);


                            $jsonFile = $request;

                            // Convert JSON string to Object
                            #print_r($jsonFile);   // Dump all data of the Object
                            $json = json_decode($jsonFile, true);
                            $totalFuncionarios = 0;
                            ?>

                            <p>Este é o quadro de pessoal da Câmara Municipal de São Paulo em
                                <b><?= $json["data"] ?></b>:</p>

                            <ul>
                                <?php
                                foreach ($json["vinculos"] as $item) {
                                    if (!empty($item['descr']) && !empty($item['qtde'])) {
                                        $totalFuncionarios += $item['qtde'];
                                        ?>
                                        <li><?= $item['descr'] ?>: <?= $item['qtde'] ?></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                            <p>Total: <?= $totalFuncionarios ?></p>
                        </div>
                    </div>
                    <p><a href="/static/transparencia/funcionarios/CMSP-Funcionarios.pdf"
                          target="_blank">Nomes dos funcionários que trabalham na Câmara.</a></p>
                    <p><a href="/static/transparencia/funcionarios/CMSP-XML-Funcionarios.xml"
                          target="_blank">Relação de funcionários em formato aberto (xml).</a></p>

                </section>

            </article>
        </div>

        <!-- Sidebar -->
        <?php wp_reset_query(); ?>
        <?php get_sidebar('page'); ?>

    </div>
</div>
</main>
<?php get_footer(); ?>