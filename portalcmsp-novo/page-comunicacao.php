<?php /*
 Template Name: Comunicação
*/
get_header();

if (have_posts()) : while (have_posts()) :
    the_post();
    ?>
    <section id="comunicacao">
        <div class="container">
            <div class="desktop-body-3">
                <div class="breadcrumbs cf">
                    <?php if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<p class="wrap cf">', '</p>');
                    } ?>
                </div>

                <h1 class="desktop-headeline-2 mt-44"><?php the_title() ?></h1>
                <?php the_content() ?>

                <div class="comunicacao-destaque mt-48">
                    <div class="coluna-esquerda">
                        <?php
                        $itens_lateral = get_field('cards_1');
                        if (!empty($itens_lateral)) foreach ($itens_lateral as $i => $item) :
                            ?>
                            <a href="<?php echo $item['url'] ?>" aria-label="<?php echo $item['titulo'] ?>"
                               class="card-primario <?php if ($i != 0) echo 'mt-16' ?>" <?php if ($item['nova_aba']) echo 'target="_blank"' ?>>
                                <div class="infos-card">
                                    <h2 class="desktop-headeline-5"><?php echo $item['titulo'] ?></h2>
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
                                <?php
                                $img = $item['imagem'];
                                if ($img) :
                                    ?>
                                    <div class="img-card">
                                        <img src="<?php echo $img ?>"
                                             alt="<?php echo $item['titulo'] ?>" class="w100">
                                    </div>
                                <?php endif ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <div class="coluna-direita">
                        <?php
                        $itens_lateral = get_field('cards_2');
                        if (!empty($itens_lateral)) foreach ($itens_lateral as $i => $item) :
                            ?>
                            <a href="<?php echo $item['url'] ?>" aria-label="<?php echo $item['titulo'] ?>"
                               class="card-primario <?php if ($i != 0) echo 'mt-16' ?>" <?php if ($link['nova_aba']) echo 'target="_blank"' ?>>
                                <div class="infos-card">
                                    <h2 class="desktop-headeline-5"><?php echo $item['titulo'] ?></h2>
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
                                <?php
                                $img = $item['imagem'];
                                if ($img) :
                                    ?>
                                    <div class="img-card">
                                        <img src="<?php echo $img ?>"
                                             alt="<?php echo $item['titulo'] ?>" class="w100">
                                    </div>
                                <?php endif ?>
                            </a>
                        <?php endforeach; ?>

                        <div class="card-multimidia mt-24">
                            <h3 class="desktop-headeline-4"><?php echo get_field('titulo_lateral') ?></h3>
                            <p class="desktop-body-3">
                                <?php echo get_field('descricao_lateral') ?>
                            </p>

                            <?php
                            $links = get_field("links");
                            if (!empty($links)) foreach ($links as $i => $link) :?>
                                <a href="<?php echo $link['url']['url'] ?>"
                                   class="mobile-body-3" <?php if ($link['nova_aba']) echo 'target="_blank"' ?>>
                                    <?php echo $link['titulo'] ?>
                                    <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                              stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="servicos-secundarios mt-44">
                    <?php
                    $itens_lateral = get_field('cards');
                    if (!empty($itens_lateral)) foreach ($itens_lateral as $i => $item) : ?>
                        <div class="card-secundario">
                            <div class="img-servicos w100">
                                <img src="<?php echo $item['imagem'] ?>"
                                     alt="<?php echo $item['titulo'] ?>" class="w100" alt="">
                            </div>

                            <div class="infos-servicos">
                                <h2 class="desktop-headeline-5"><?php echo $item['titulo'] ?></h2>

                                <p class="desktop-body-3 lines3"><?php echo $item['descricao'] ?></p>
                            </div>
                            <div class="btnt">
                                <a href="<?php echo $item['url']?>" <?php if($item['nova_aba']) echo "target='_blank'"?> class="button-secondary w100">Acessar</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    
<?php
endwhile;
endif;
?>

<?php get_footer(); ?>

