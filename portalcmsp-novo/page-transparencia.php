<?php /*
 Template Name: Transparência
*/
get_header();

if (have_posts()) : while (have_posts()) :
the_post();
?>
<section id="topo-transparencia" class="w100">
    <div class="config-image-bg w100">
        <img src="<?php echo get_template_directory_uri()?>/dist/images/backgroundAgenda.jpg" class="w100" alt="Topo background">
        <div class="abs mt-32">
            <div class="container">
                <div class="desktop-body-3">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>/</li>
                        <li><strong><?php echo get_the_title()?></strong></li>
                    </ul>
                </div>

                <h1 class="mt-44 desktop-headeline-2"><?php echo get_the_title()?></h1>
                <span class="desktop-headeline-4 mt-12"><?php echo get_field('subtitulo')?></span>
            </div>
        </div>
    </div>
</section>
<section id="conteudo-transparencia" aria-label="Portais de Transparência">
    <div class="abs">
        <div class="container overlap">
            <div class="ct-transparência desktop-body-1">
                <?php echo get_field('descricao')?>
                <div class="acessos-transparencia mt-32 flex-wrap">

                    <?php
                    $cards = get_field("cards");

                    foreach ($cards as $card) :
                    ?>
                    <div class="card-individual">
                        <div class="img-transparencia w100">
                            <img src="<?php echo $card['imagem']?>" alt="<?php echo $card['titulo']?>" class="w100">
                        </div>

                        <div class="infos-transparencia">
                            <h2 class="desktop-headeline-5">
                                <?php echo $card['titulo']?>
                            </h2>
                            <p class="desktop-body-3">
                                <?php echo $card['descricao']?>
                            </p>

                        </div>
                        <div class="btnt">
                            <a href="<?php echo $card['url']?>" <?php if($card['nova_aba']) echo "target='_blank'"?> class="button-secondary w100">Acessar</a>
                        </div>
                    </div>

                    <?php endforeach;?>

                </div>
            </div>

        </div>
    </div>
</section>
<section id="consulta-acesse" aria-label="Consulta rápida/Acesse também">
    <div class="container">
        <div class="flex flex-col g-32">
            <div class="col">
                <div class="consulta1">
                    <?php include get_template_directory().'/content-boxes/geral/consulta-rapida.php'?>
                </div>
            </div>
            <div class="col">
                <h2 class="desktop-headeline-4">
                    <img src="<?php echo get_template_directory_uri()?>/dist/images/paginas.svg" alt="Páginas">
                    Acesse também
                </h2>
                <div class="box-acesse-tambem">
                      <?php
                    $itens = get_field("itens");

                    foreach ($itens as $card) :
                    ?>
                        <a href="<?php echo $card['url']?>" <?php if($card['nova_aba']) echo "target='_blank'"?> class="item-acesse">
                            <div class="img-item-acesse w100">
                                <img src="<?php echo $card['imagem']?>" class="w100" alt="<?php echo $card['descricao']?>">
                            </div>
                            <p class="lines3"><?php echo $card['descricao']?></p>
                            <div class="flex flex-end">
                                <span class="mobile-body-3">
                                    Acessar
                                    <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
endwhile;
endif;
?>

<?php get_footer(); ?>

