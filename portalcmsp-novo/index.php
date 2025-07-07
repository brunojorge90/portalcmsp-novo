<?php get_header(); ?>
    <style>
        header .search {
            display: none !important;
        }
    </style>
    <div id="content">
        <!-- <div class="breadcrumbs cf">
                    <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="wrap cf">', '</p>');
        } ?>
                </div> -->
        <?php
        $featuredQuery = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 1,
            'meta_query' => array(
                "compare" => "AND",
                array(
                    'key' => '_cmsp_post_is-featured-article',
                    'value' => 'on',
                )
            ),
        ));


        ?>
        <div id="inner-content">
            <section id="noticias-destaque" aria-label="Notícias de destaque">
                <!--Notícias de destaque-->
                <div class="container flex flex-col">
                    <div class="grupo-noticias-1">
                        <?php
                        $postsNotIn = [];
                        while ($featuredQuery->have_posts()): $featuredQuery->the_post();
                            $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
                            $postsNotIn[] = get_the_ID();

                            ?>
                            <div href="" class="notícia-nivel-1">
                                <h1>
                                    <a class="desktop-headeline-3 mobile-headeline-4"
                                       href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                </h1>
                                <a class="mt-16 decoration-none" href="<?php the_permalink() ?>"
                                   title="<?php the_title() ?>" aria-label="<?php the_title() ?>" <?php if($show_title) echo "target='_blank' style='background:none'" ?>>
                                    <?php
                                    $excerpt = $NewTheme->excerpt(wpautop(get_the_excerpt()));
                                    if ($excerpt) :
                                        ?>
                                        <p class="desktop-body-1 mobile-body-2">
                                            <?php echo $excerpt ?>
                                        </p>
                                    <?php endif ?>
                                </a>
                                <a href="<?php the_permalink() ?>" class="button-primary mt-16">Acessar conteúdo</a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="grupo-noticias-2">
                        <?php
                        $featuredQuery2 = new WP_Query(array(
                            'post_type' => 'post',
                            'posts_per_page' => 2,
                            'post__not_in' => $postsNotIn,
                            'meta_query' => array(
                                array(
                                    'key' => '_cmsp_post_is-featured-article',
                                    'value' => 'on',
                                )
                            ),
                        ));
                        while ($featuredQuery2->have_posts()): $featuredQuery2->the_post();
                            $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
                            ?>
                            <a href="<?php echo the_permalink() ?>" class="notícia-nivel-2 <?php if($show_title) echo 'none-before'?>">
                                <img src="<?php echo $NewTheme->getPostThumbnail() ?>" alt="<?php echo get_the_title() ?>"
                                     class="w100">
                                <?php
                                if (!get_post_meta(get_the_ID(), "_cmsp_post_is-title-inhibitted", true)) :
                                    ?>
                                    <div class="sd">
                                        <h2 class="desktop-headeline-4"><?php echo get_the_title() ?></h2>
                                    </div>
                                <?php endif ?>
                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>
                <!--Notícias de destaque-->

            </section>


            <section id="noticias-todas" class="mt-64 lista-noticias" aria-label="Todas notícias">
                <!--Fitro de notícias-->
                <div class="container">
                    <ul class="filtros owl-theme owl-carousel owl-filtros"">

                    <!--<li class="colEvent col"><a href="#" class="w100 button-secondary">Mais acessadas</a></li> -->

                    <?php
                    $categories_recents = $NewTheme->getRecentCategories();
                    $currentCategory = get_queried_object();
                    if (is_category() && !in_array($currentCategory, $categories_recents)) :
                        ?>
                        <li class="colEvent col"><a href="<?php echo get_term_link($currentCategory->term_id) ?>"
                                                    class="w100 button-primary"><?php echo $currentCategory->name ?></a>
                        </li>
                    <?php endif;
                    ?>
                    <li class="colEvent col"><a href="<?php echo get_site_url() ?>/comunicacao/noticias"
                                                class="w100 <?php if (!is_category()) echo 'button-primary'; else echo 'button-secondary' ?>">Todas
                            as notícias</a></li>
                    <?php
                    if(isset($categories_recents) && is_array($categories_recents)) {
                        foreach ($categories_recents as $recent) :
                            ?>
                            <li class="colEvent col"><a href="<?php echo get_term_link($recent->term_id) ?>"
                                                        class="w100 button-secondary"><?php echo $recent->name ?></a>
                            </li>
                        <?php endforeach;} ?>
                    </ul>
                </div>

                <!--Fitro de notícias-->

                <!--Notícias-->
                <div class="container mt-64 flex flex-column order">
                    <?php if (have_posts()) : while (have_posts()) : the_post();
                        $img = $NewTheme->getPostThumbnail(get_the_ID());
                        ?>
                        <!--Notícia individual-->
                        <div class="noticia-nivel-3 flex">
                            <?php

                            if ($img) :?>
                                <div class="img-noticia">
                                    <a href="<?php echo get_permalink() ?>">
                                        <img src="<?php echo $img ?>" alt="<?php echo get_the_title() ?>" class="w100">
                                    </a>
                                </div>
                            <?php endif ?>
                            <div class="textos-noticia p-<?php the_ID() ?>">
                                <a href="<?php echo get_permalink() ?>">
                                    <?php
                                    if (!get_post_meta(get_the_ID(), "_cmsp_post_is-title-inhibitted", true)) :
                                        ?>
                                        <h2 class="desktop-headeline-3 mobile-headeline-2"><?php echo get_the_title() ?></h2>
                                    <?php endif ?>
                                    <?php
                                    $excerpt = $NewTheme->excerpt(get_the_excerpt());

                                    if ($excerpt) :
                                        ?>
                                        <p class="desktop-body-1 mobile-body-2">
                                            <?php echo $excerpt ?>
                                        </p>
                                    <?php endif ?>
                                </a>
                                <ul class="flex-wrap">
                                    <?php
                                    $categories = get_the_category();

                                    foreach ($categories as $category) :
                                        ?>
                                        <li><a href="<?php echo get_term_link($category->term_id) ?>"
                                               class="mobile-body-3"><?php echo $category->name ?></a></li>
                                    <?php endforeach; ?>
                                </ul>

                                <a class="infos-botton" href="<?php echo get_permalink() ?>">
                                            <span class="desktop-body-3">Atualizado em
                                            <?php
                                            $postDate = get_the_date('Y-m-d H:i:s');
                                            $formattedDate = date('d/m/Y - H\hi', strtotime($postDate));
                                            echo $formattedDate
                                            ?>
                                            </span>
                                    <div class="mobile-body-2">
                                        Acessar notícia
                                        <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                                  stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--Notícia individual-->
                    <?php endwhile;
                    endif;
                    ?>
                </div>
                <!--Notícias-->

            </section>
            <?php bones_page_navi(); ?>
        </div>
    </div>
<?php if (is_category()) : ?>
    <script>
        var anchor = document.querySelector('#noticias-todas');
        window.scroll({top: anchor.offsetTop - 40, left: 0, behavior: 'smooth'});
    </script>
<?php endif ?>

<?php get_footer(); ?>