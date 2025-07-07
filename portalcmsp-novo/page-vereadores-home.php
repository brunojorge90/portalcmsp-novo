<?php /*
 Template Name: Vereadores SubHome
*/
get_header();

if (have_posts()) : while (have_posts()) :
the_post();

if(isset($_GET['filtro'])) {
    header("Location: ".get_site_url().'/membros/?filtro='.$_GET['filtro']);
}
?>
    <section id="sub_vereadores" aria-label="Informações de Vereadores">
        <div class="container">
            <div class="desktop-body-3">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>/</li>
                    <li><strong><?php the_title()?></strong></li>
                </ul>

                <h1 class="desktop-headeline-2 mt-44"><?php the_title()?></h1>
                <?php the_content()?>

                <!--cards primarios-->
                <div class="sub_vereadores-primario mt-44 g-16">
                    <?php
                    $itens_lateral = get_field('cards_1');
                    foreach ($itens_lateral as $i => $item) : ?>
                        <a href="<?php echo $item['url'] ?>" aria-label="<?php echo $item['titulo'] ?>"
                           class="card-primario" <?php if ($item['nova_aba']) echo 'target="_blank"' ?>>
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
                <!--cards primarios-->

                <!--cards secundarios-->
                <div class="servicos-secundarios mt-44">
                    <?php
                    $itens_lateral = get_field('cards');
                    foreach ($itens_lateral as $i => $item) : ?>
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
                <!--cards secundarios-->

            </div>
        </div>
    </section>
<?php
endwhile;
endif;
?>

<?php get_footer(); ?>

