<?php /*
 Template Name: Participação
*/
get_header();

if (have_posts()) : while (have_posts()) :
    the_post();
    ?>
    <section id="atividade-legislativa">
        <div class="container">
            <div class="desktop-body-3">
                <div class="breadcrumbs cf">
                    <?php if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb('<p class="wrap cf">','</p>');
                    } ?>
                </div>
                <h1 class="desktop-headeline-2 mt-44"><?php echo get_the_title() ?></h1>
                <?php the_content() ?>
                <h2 class="desktop-headeline-4 mt-32 color-accent">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-profile.svg" alt="icone">
                    Participe
                </h2>
                <section aria-label= "Participe">        
                <div class="infos-participe">

                    <div class="form-vereador">
                        <h3 class="desktop-headeline-4">
                            <?php echo get_field('titulo_form') ?>
                        </h3>

                        <?php
                        $form = do_shortcode('[contact-form-7 id="'.get_field('form').'" title="Mandato Participativo"]');
                        $form = str_replace("<p role=\"status\" aria-live=\"polite\" aria-atomic=\"true\">", "<p role=\"status\" aria-live=\"polite\" aria-atomic=\"true\">Resposta", $form);
                        $form = str_replace("<div class=\"wpcf7-response-output\" aria-hidden=\"true\">", "<div class=\"wpcf7-response-output\" aria-hidden=\"true\">Resposta:", $form);
                        $form = str_replace("<p><span class=\"form-left\"><input", "<p><span class=\"form-left\">Resposta:<input", $form);
                        echo $form;
                        ?>
                    </div>

                    <div class="links-participe">
                        <?php
                        $titulo_part = get_field('titulo_lateral');
                        $descricao_lateral = get_field('descricao_lateral');
                        if($titulo_part && $descricao_lateral) :
                        ?>
                        <div class="card-sugira-projeto-lei">
                            <h3 class="desktop-headeline-4"><?php echo get_field('titulo_lateral') ?></h3>
                            <p class="desktop-body-3">
                                <?php echo get_field('descricao_lateral') ?>
                            </p>

                            <?php
                            $links = get_field('links');
                            foreach ($links as $i => $link) : ?>
                                <a href="<?php echo $link['url'] ?>" href="#"
                                   class="mobile-body-3" <?php if ($link['nova_aba']) echo 'target="_blank"' ?>
                                   aria-label="<?php echo $link['titulo'] ?>">
                                    <?php echo $link['titulo'] ?>
                                    <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                              stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <?php endif?>
                        <?php
                        $links = get_field('mais_links');
                        foreach ($links as $i => $link) :
                            ?>
                            <a href="<?php echo $link['url'] ?>" class="card-terciario <?php if(($titulo_part && $descricao_lateral && $i == 0) || $i > 0) : ?> mt-32 <?php endif?>"
                               aria-label="<?php echo $link['titulo'] ?>" <?php if ($link['nova_aba']) echo 'target="_blank"' ?>>
                                <h2 class="desktop-headeline-5"><?php echo $link['titulo'] ?></h2>
                                <p class="desktop-body-1"><?php echo $link['descricao'] ?></p>
                                <span class="flex g-13 align-center desktop-body-3">
                                    Acessar página
                                    <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                              stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>                      
                </div>
                <section aria-label="Acompanhe">                
                <h2 class="desktop-headeline-4 color-accent mt-64">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-profile.svg" alt="icone">
                    Acompanhe
                </h2>

                <div class="infos-acompanhe">
                    <?php
                    $itens_lateral = get_field('cards');
                    foreach ($itens_lateral as $i => $item) : ?>
                        <div class="card-secundario">
                            <div class="img-servicos w100">
                                <img src="<?php echo $item['imagem'] ?>"
                                     alt="<?php echo $item['titulo'] ?>" class="w100" alt="">
                            </div>

                            <div class="infos-servicos">
                                <h3 class="desktop-headeline-5"><?php echo $item['titulo'] ?></h3>

                                <p class="desktop-body-3 lines3"><?php echo $item['descricao'] ?></p>
                            </div>
                            <div class="ps">
                                <a href="<?php echo $item['url'] ?>"
                                   aria-label="<?php echo $item['titulo'] ?>" <?php if ($item['nova_aba']) echo 'target="_blank"' ?>
                                   class="button-secondary w100">Acessar Página</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                </section>       
            </div>
        </div>
    </section>
    <section id="auditorios-online" class="mt-56" aria-label="Assista aos Auditórios Online">
        <div class="container">
            <h2 class="desktop-headeline-4 color-accent">
                <svg width="16" class="bolinha" height="16" viewBox="0 0 16 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <circle cx="8" cy="8" r="8" fill="#7F1A22"/>
                </svg>
                Assista aos Auditórios Online
            </h2>

            <div class="ao-vivo border-r-w">
                <iframe class="jmvplayer"
                        style="width: 100%; aspect-ratio: 16 / 9;height: 100%; display: block; border-top-right-radius: 16px; border-top-left-radius: 16px;"
                        src="<?php echo get_field("embed") ?>" allowfullscreen=""
                        frameborder="0" width="50%" height="351" scrolling="yes"
                        data-gtm-yt-inspected-3="true"></iframe>
                <div class="context bk-white b-b-16">
                    <h3 class="desktop-headeline-5">
                        <?php echo get_field('titulo_aud') ?>
                    </h3>
                    <div class="flex g-8 mt-16 tags flex-wrap">
                        <?php
                        $categorias = get_field("categorias");
                        foreach ($categorias as $category) :
                            ?>
                            <a href="<?php echo get_term_link($category->term_id)?>" class="tag">
                                <?php echo $category->name ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <p class="mt-16 desktop-body-3">
                        <?php echo get_field('descricao_aud') ?>
                    </p>
                </div>
            </div>

            <a href="<?php echo get_field('url')?>" aria-label="<?php echo get_field('titulo_link')?>" class="w100 button-transparent text-decoration-none mt-56 button-secondary text-center"  <?php if ($link['nova_aba']) echo 'target="_blank"' ?>>
                <?php echo get_field('titulo_link')?>
            </a>
        </div>
    </section>
<?php
endwhile;
endif;
?>

<?php get_footer(); ?>