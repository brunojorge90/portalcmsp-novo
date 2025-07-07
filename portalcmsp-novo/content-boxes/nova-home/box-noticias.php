<section class="noticias" aria-label="Notícias">
    <div class="container">
        <div class="flex flex-col">
            <?php
            $featuredQuery = new WP_Query(array(
                'post_type' => ['post', 'slider-home'],
                'posts_per_page' => 1,
                'meta_query' => [
                    [
                        'key' => '_cmsp_post_is-featured-article',
                        'value' => 'on',
                    ],
                ],
            ));
            while ($featuredQuery->have_posts()): $featuredQuery->the_post();
                global $NewTheme;
                $postID = get_the_ID();
                $thumbnail = $NewTheme->getPostThumbnail(get_the_ID());
                $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                
                ?>
                <div class="col">
                    <h2 class="desktop-headeline-4" arial-label="Notícia em destaque">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/noticias.svg"
                             alt=" Notícia em destaque">
                        Notícia em destaque
                    </h2>
                    <div class="noticia-destaque no-post-thumbnail">
                        <a href="<?php echo get_the_permalink() ?>" aria-label="<?php echo get_the_title() ?>">
                            <?php if ($thumbnail) : ?>
                                <div class="thumbnail">
                                    <img src="<?php echo $thumbnail ?>"
                                         alt="<?php echo $alt_text ?>">
                                </div>
                            <?php endif ?>
                            <div class="context">
                                <h3 class="desktop-headeline-4">
                                    <?php the_title() ?>
                                </h3>
                                <?php if($NewTheme->excerpt(get_the_excerpt())) : ?>
                                <p class="lines4">
                                    <?php echo $NewTheme->excerpt(get_the_excerpt()) ?>
                                </p>
                                <?php endif?>
                                <span class="flex g-13 align-center">
                                Acessar notícia
                                <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                          stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </span>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
            <div class="col">
                <h2 class="desktop-headeline-4" arial-label="Últimas notícias">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/ultimas-noticias.svg"
                         alt="Últimas notícias">
                    Últimas notícias
                </h2>
                <div class="itens-noticias">
                    <?php
                    $featuredQuery = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 3
                    ));

                    while ($featuredQuery->have_posts()): $featuredQuery->the_post();
                        ?>
                        <div class="col">
                            <a title="<?php echo get_the_title() ?>" class="flex g-16 align-center mt-12 no-image" href="<?php echo get_the_permalink() ?>">
                                <div class="context">
                                    <h3>
                                        <?php echo get_the_title() ?>
                                    </h3>
                                    <span class="flex g-13 align-center">
                                        Acessar notícia
                                        <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                                  stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                </div>
                                <?php
                                $thumbnail = $NewTheme->getPostThumbnail(get_the_ID());
                                $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                                $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

                                if ($thumbnail) :
                                    ?>
                                    <div class="thumbnail">
                                        <img src="<?php echo $thumbnail ?>" alt="<?php echo $alt_text ?>">
                                    </div>
                                <?php endif ?>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        <a href="<?php echo get_site_url()?>/comunicacao/noticias" class="w100 button-secondary mt-24 text-decoration-none">
            Clique para acessar todas as notícias
        </a>
    </div>
    <?php wp_reset_query()?>
</section>
