<?php
/*
 Template Name: Fale com o vereador
*/

?>

<?php get_header(); ?>

<div id="content">
    <section id="fale-com-vereador" aria-label="fale com Vereador">
        <div class="container">
            <div class="desktop-body-3">
                <ul class="breadcrumb">
                    <li><a href="<?php echo get_site_url()?>">Home</a></li>
                    <li>/</li>
                    <li><strong><?php the_title()?></strong></li>
                </ul>

                <h1 class="desktop-headeline-2 mt-44"><?php the_title()?></h1>
                <?php echo get_the_content()?>
                <!--<h2 class="desktop-headeline-4 mt-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dictum tristique urna a pellentesque.</h2>-->
                <!--<p class="desktop-body-1 mt-32">Donec porta erat lorem, vel aliquet ligula mattis varius. Pellentesque sollicitudin ac nibh interdum vulputate. Pellentesque lectus dolor, eleifend vitae cursus sit amet, cursus nec tortor. Fusce iaculis, nulla a malesuada tristique, tellus justo lobortis nulla, id ultricies arcu sem dapibus lectus.</p>-->
            </div>
        </div>
    </section>

    <section id="enviar-mensagem-para-vereador" style="padding-bottom: 60px" aria-label="Enviar mensagem">
        <div class="container">
            <div class="mensagem-vereador mt-48">
                <h2 class="desktop-headeline-4">
                    Enviar uma mensagem para um(a) vereador(a)
                </h2>
                <?php $form = do_shortcode('[contact-form-7 id="'.get_field("contato").'" title="Mandato Participativo Seleção de Vereador"]');

                $form = str_replace("<p role=\"status\" aria-live=\"polite\" aria-atomic=\"true\">", "<p role=\"status\" aria-live=\"polite\" aria-atomic=\"true\">Resposta", $form);
                $form = str_replace("<div class=\"wpcf7-response-output\" aria-hidden=\"true\">", "<div class=\"wpcf7-response-output\" aria-hidden=\"true\">Resposta:", $form);
                $form = str_replace("<p><span class=\"form-left\"><input", "<p><span class=\"form-left\"><span style='text-indent: -1000px;display:block'>Resposta:</span><input", $form);
                echo $form;
                ?>
            </div>
        </div>
    </section>

    <!--<section id="sugestao-projeto-lei">
        <div class="container mt-48">
            <div class="img-container">
                <img src="<?php echo get_template_directory_uri()?>/dist/images/exemplo-projeto-lei.jpg" alt="Sugira seu projeto de lei" class="w100">
            </div>

            <div class="texto-projeto-lei">
                <h3 class="desktop-headeline-5">Agora você pode sugerir um projeto de lei, faça o melhor pela sua comunidade e participe!</h3>
                <p class="desktop-body-1">Ao receber 20.000 apoios, a ideia se tornará uma Sugestão Legislativa, e será debatida pelos Senadores.</p>
                <a href="#" class="button-secondary">Sugerir um projeto de lei</a>
            </div>
        </div>
    </section> -->
</div>

<?php get_footer(); ?>
