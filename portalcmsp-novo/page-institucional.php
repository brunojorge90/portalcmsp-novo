<?php /*
 Template Name: Institucional
*/
get_header();

if (have_posts()) : while (have_posts()) :
    the_post();
    ?>

    <section id="institucional">
        <div class="container">
            <div class="desktop-body-3">
                <div class="breadcrumbs cf">
                    <?php if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<p class="wrap cf">', '</p>');
                    } ?>
                </div>

                <h1 class="desktop-headeline-2 mt-44"><?php echo get_the_title() ?></h1>
                <?php the_content() ?>

                <!--cards primarios-->
                <div class="institucional-primario mt-48">
                    <?php
                    $itens_principal = get_field('itens_principal');

                    foreach ($itens_principal as $item) :
                        ?>
                        <a href="<?php echo $item['url'] ?>" <?php if ($item['nova_aba']) echo "target='_blank'" ?>
                           class="card-primario" style="text-decoration: none">
                            <div class="img-servicos w100">
                                <img src="<?php echo $item['imagem'] ?>" alt="<?php echo $item['titulo'] ?>"
                                     class="w100">
                            </div>

                            <div class="infos-servicos">
                                <h2 class="desktop-headeline-4"><?php echo $item['titulo'] ?></h2>
                                <p class="desktop-body-3 lines4"><?php echo $item['descricao'] ?></p>
                                <span class="flex g-13 align-center desktop-button-link-medium">
                                    Acessar página
                                    <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                              stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <!--cards primarios-->

                <!--cards secundarios-->
                <div class="institucional-secundario mt-24">
                    <?php
                    $itens_sec = get_field('itens_sec');

                    foreach ($itens_sec as $item) :
                        ?>
                        <a href="<?php echo $item['url'] ?>" <?php if ($item['nova_aba']) echo "target='_blank'" ?>
                           class="card-secundario">
                            <div class="infos-card">
                                <h3 class="desktop-headeline-5"><?php echo $item['titulo'] ?></h3>
                                <p class="desktop-body-3"><?php echo $item['descricao'] ?></p>

                                <span class="flex g-13 align-center desktop-button-link-medium">
                                Acessar página
                                <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                          stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </span>
                            </div>
							<?php if($item['imagem']) : ?>
                            <div class="img-card">
                                <img src="<?php echo $item['imagem'] ?>"
                                     alt="<?php echo $item['titulo'] ?>" class="w100">
                            </div>
                            <?php endif?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <!--cards secundarios-->

                <!--cards terciarios-->
                <div class="institucional-terciario mt-24">
                    <?php
                    $itens_sec = get_field('itens_cards');

                    foreach ($itens_sec as $item) :
                        ?>
                        <div class="card-terciario">
                            <div class="img-servicos w100">
                                <img src="<?php echo $item['imagem'] ?>"
                                     alt="<?php echo $item['titulo'] ?>" class="w100">
                            </div>
                            <div class="infos-servicos">
                                <h2 class="desktop-headeline-5"><?php echo $item['titulo'] ?></h2>

                                <p class="desktop-body-3"><?php echo $item['descricao'] ?></p>
                            </div>
                            <div class="ps">
                                <a href="<?php echo $item['url'] ?>" <?php if ($item['nova_aba']) echo "target='_blank'" ?>
                                   class="button-secondary w100">Acessar Página</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!--cards terciarios-->

                <?php
                $itens_abaixo = get_field('itens_abaixo_1');

                foreach ($itens_abaixo as $item) :?>
                    <!--card recursos humanos-->
                    <div class=" card-recursos-humanos mt-24">
                        <div class="img-card">
                            <img src="<?php echo $item['imagem']?>"
                                 alt="thumbnail noticia" class="w100">
                        </div>

                        <div class="infos-card">
                            <h3 class="desktop-headeline-4"><?php echo $item['titulo']?></h3>
                            <p class="desktop-body-3"><?php echo $item['descricao']?></p>
                            <?php
                            $links = $item['itens_abaixo_2'];
                            foreach ($links as $link) :
                            ?>
                                <a href="<?php echo $link['url'] ?>" <?php if ($link['nova_aba']) echo "target='_blank'" ?> class="mobile-body-3">
                                <?php echo $link['titulo']?>
                                <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                          stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </a>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <!--card recursos humanos-->
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php
endwhile;
endif;
get_footer(); ?>