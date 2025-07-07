<?php
    $args_child = [
        'post_type' => $post_type,
        'post_parent' => get_the_ID(),
        'showposts' => -1,
        'order' => 'ASC',
        'orderby' => "title"
    ];
    $i_ = 0;
    $post_child = get_posts($args_child);
    
    $new_tab = get_field("_cmsp_page_legacy-type") === "tab" ? "_blank" : "_self";
    ?>
    <section class="organograma">
        <div class="container">
            <div class="desktop-body-3 organograma-column">
                <div class="order-1">
                    <div class="breadcrumbs cf">
                        <?php if (function_exists('yoast_breadcrumb')) {
                            yoast_breadcrumb('<p class="wrap cf">', '</p>');
                        } ?>
                    </div>

                    <h1 class="desktop-headeline-2 mt-44"><?php echo get_the_title() ?></h1>
                    <?php echo get_the_content() ?>
                </div>


                <div class="mt-32 order-3">
                    <?php

                    foreach ($post_child as $post) :
                    $args_child_2 = [
                        'post_type' => $post_type,
                        'post_parent' => $post->ID,
                        'showposts' => -1,
                        'order' => 'ASC',
                        'orderby' => "title"
                    ];

                    $post_child_2 = get_posts($args_child_2);
                    $post_excerpt = "";
                    if ($post->post_content) {
                        global $NewTheme;
                        $post_excerpt = $NewTheme->excerpt($post->post_content);
                    } ?>
                    <div class="accordion-organograma w100"  <?php if (count($post_child_2) === 0 && !$post_excerpt && $post_type != "page") : ?> style="pointer-events: none" <?php endif ?>>
                        <div class="header-accordion" <>
                        <div class="infos-titulo-accordion">
                            <h3 class="desktop-headeline-4"><?php echo $post->post_title ?></h3>
                            <span class="desktop-body-1"><?php echo get_field('resumo', $post->ID) ?></span>
                        </div>
                        <div class="acoes-accordion" <?php if (count($post_child_2) === 0 && !$post_excerpt && $post_type != "page") : ?> style="display: none" <?php endif ?>>
                            <a href="<?php echo get_permalink($post->ID) ?>" class="button-secondary" target="<?= $new_tab?>">Acessar
                                página</a>
                            <?php if ($post->post_content || count($post_child_2) > 0) : ?>

                            <?php endif ?>
                            <?php if (count($post_child_2) > 0 || $post_excerpt) : ?>
                                <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-chevron-accordion.svg"
                                     alt="chevron">

                            <?php endif ?>

                            <?php if($post_type === "page" && count($post_child_2) === 0 && !$post_excerpt) : ?>
                                <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-chevron-accordion.svg"
                                     alt="chevron" style="opacity: 0">
                            <?php endif?>
                        </div>
                    </div>
                    <?php
                    if (count($post_child_2) > 0 || $post_excerpt) :
                        $i_++;
                        ?>
                        <div class="content-accordion" style="display: none">


                            <?php
                            if ($post->post_content && $post_type != "page") : ?>
                                <p class="desktop-body-1"><?php echo $post_excerpt ?></p>
                            <?php
                            endif;

                            if ($post->post_content && $post_type === "page") :
                                echo $post->post_content;
                            endif;
                            ?>

                            <div class="links-accordion">
                                <?php
                                foreach ($post_child_2 as $post_2) :

                                    $args_child_3 = [
                                        'post_type' => $post_type,
                                        'post_parent' => $post_2->ID,
                                        'showposts' => -1,
                                        'order' => 'ASC',
                                        'orderby' => "title"
                                    ];

                                    $posts_3 = get_posts($args_child_3);

                                    ?>
                                    <a href="<?php echo get_permalink($post_2->ID)?>" class="link-accordion w100">
                                        <?php echo $post_2->post_title ?><?php if(get_field('resumo', $post_2->ID)) echo ' - '.get_field('resumo', $post_2->ID)?>
                                        <?php if($post_2->post_content || count($posts_3) > 0) :?>
                                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-chevron-right.svg"
                                                 alt="chevron">
                                        <?php endif?>
                                    </a>


                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
                <?php endforeach; ?>
            </div>

            <?php
            if ($i_ > 0) :
                ?>
                <div class="filtragem mt-48 order-2">
                    <a href="#" class="button-primary expandir-todos">Expandir todos os itens</a>
                    <!--<div>
                        <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-busca.svg"
                             alt="busca">
                        <input type="search" name="filtro-organograma" id="filtro-organograma" class="field-style"
                               placeholder="Digite o que quer filtrar...">
                    </div> -->
                </div>
            <?php endif ?>
        </div>
        </div>
    </section>
<?php
?>