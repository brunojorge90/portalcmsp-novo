<?php
/*
 * Template Name: Câmara Em Ação
 */
?>

<?php get_header(); ?>

<script src="https://13d0fa3468e94493baa481d44ef61e4c.js.ubembed.com" async></script>

<div id="content">

    <div class="breadcrumbs cf">
        <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="wrap cf">', '</p>');
        } ?>
    </div>
    
   

    <section id="camara-em-acao">
        <div class="container">
            <h1 class="desktop-headeline-2 mt-44"><?php echo get_the_title() ?></h1>
 <div class="edicoes-noticias mt-32">
<div class="confira-todas-edicoes">

 <div id="inscreva-se-na-news-7c30a4b374354ff76845" role="main"></div>
<script src="https://d335luupugsy2.cloudfront.net/js/rdstation-forms/stable/rdstation-forms.min.js"></script><script> new RDStationForms('inscreva-se-na-news-7c30a4b374354ff76845', 'null').createForm();</script><a href="https://suaopiniao.redecamara.com.br/camara-em-acao" target="_blank" rel="noopener">
</a>


<h3 class="desktop-headeline-3">Confira todas as edições</h3>
                    <div class="mt-32">
                        <?php the_content(); ?>
                        <?php
                        $edicoes = get_field("edicoes");
						if (is_array($edicoes) && !empty($edicoes)) {//muitos erros: Invalid argument supplied for foreach() in /var/www/sistemas/CR0313/wp-content/themes/portalcmsp-novo/page-camaraemacao.php on line 29
                        foreach ($edicoes as $edicao) : ?>
                            <!--acordion-->
                            <div class="accordion-camara-acao w100">
                                <div class="header-accordion">
                                    <div class="infos-titulo-accordion">
                                        <h4 class="desktop-headeline-4">Edição <?php echo $edicao['ano'] ?></h4>
                                        <!--<span class="desktop-body-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </span>-->
                                    </div>
                                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-chevron-accordion.svg"
                                         alt="chevron">
                                </div>
                                <div class="content-accordion">
                                    <?php
                                    echo $edicao['edicoes'];
                                    ?>
                                </div>
                            </div>
                            <!--acordion-->
                        <?php endforeach;
						}
						?>						
                    </div>
                </div>

                <?php get_sidebar(); ?>
            </div>

            <footer class="article-footer cf">
                <footer>
                    <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                    <style type="text/css">
                        #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
                        /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */

                        /*label:before {
                           content: '';
                           display: inline-block;
                           background: url(https://www.saopaulo.sp.leg.br/wp-content/themes/portal-cmsp/library/images/sprite-icons-s7105b97072.png) 0 -350px no-repeat;
                           height: 21px;
                           max-height: 21px;
                           width: 15px;
                       }*/
                    </style>

                    <div role="main" id="inscreva-se-camara-em-acao-2-431102a286413796aa17"></div><script type="text/javascript" src="https://d335luupugsy2.cloudfront.net/js/rdstation-forms/stable/rdstation-forms.min.js"></script><script type="text/javascript"> new RDStationForms('inscreva-se-camara-em-acao-2-431102a286413796aa17', 'UA-26023297-1').createForm();</script>


                    <!-- <div id="mc_embed_signup">
                    <form action="https://gmail.us6.list-manage.com/subscribe/post?u=1a4161f5f68ed4814863e7a51&amp;id=c263753b1e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">
                        <h2>Deseja receber semanalmente o Câmara em Ação? Preencha o formulário:</h2>
                    <div class="indicates-required"><span class="asterisk">*</span> Campos obrigatórios</div>
                    <div class="mc-field-group">
                        <label for="mce-FNAME">Nome Completo  <span class="asterisk">*</span>
                    </label>
                        <input type="text" value="" name="FNAME" class="required" id="mce-FNAME">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-EMAIL">Email  <span class="asterisk">*</span>
                    </label>
                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                    </div>
                    <div class="mc-field-group size1of2">
                        <label for="mce-PHONE">WhatsApp  <span class="asterisk">*</span>
                    </label>
                        <input type="text" name="PHONE" class="required" value="" id="mce-PHONE">
                    </div>
                    <div class="mc-field-group input-group">
                        <strong>Termos de Uso </strong>
                        <ul><li><input type="checkbox" value="1" name="group[23777][1]" id="mce-group[23777]-23777-0"><label for="mce-group[23777]-23777-0">Aceito receber informativos sobre as atividades da Câmara Municipal de São Paulo</label></li>
                    <li><input type="checkbox" value="2" name="group[23777][2]" id="mce-group[23777]-23777-1"><label for="mce-group[23777]-23777-1">Sou maior de 18 anos</label></li>
                    </ul>
                    </div>
                        <div id="mce-responses" class="clear">
                            <div class="response" id="mce-error-response" style="display:none"></div>
                            <div class="response" id="mce-success-response" style="display:none"></div>
                        </div>
                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_1a4161f5f68ed4814863e7a51_c263753b1e" tabindex="-1" value=""></div>
                        <div class="clear"><input type="submit" value="Inscreva-se aqui" name="subscribe" id="mc-embedded-subscribe" class="button" style="background-color: rgb(175 12 12);width: 100%;line-height: 40px;height: 40px; font-weight: bolder;"></div>
                        </div>
                    </form>
                    </div> -->
                    <!-- <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[1]='FNAME';ftypes[1]='text';fnames[0]='EMAIL';ftypes[0]='email';fnames[4]='PHONE';ftypes[4]='phone';}(jQuery));var $mcj = jQuery.noConflict(true);</script> -->
                    <!--End mc_embed_signup-->
                </footer>
            </footer>
        </div>
    </section>
</div>
</main>
<?php get_footer(); ?>