<?php
/*
 Template Name: Revista da Procuradoria
*/
?>

<?php get_header(); ?>

    <div id="content">
        <div class="breadcrumbs cf">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p class="wrap cf">', '</p>');
            } ?>
        </div>
        <div class="title-section">
            <div class="container">
                <header class="article-header">
                    <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
                </header> <?php // end article header ?>
            </div>
        </div>
        <div id="inner-content" class="wrap cf">
            <div id="main" class="two-column-main cf" role="main">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope
                             itemtype="http://schema.org/BlogPosting">
                        <section class="entry-content cf" itemprop="articleBody">
                            <?php
                            // the content (pretty self explanatory huh)
                            the_content();

                            // include an iframe of legacy content if selected in the admin
                            if (get_post_meta($post->ID, '_cmsp_page_legacy-type', true) == 'iframe') {
                                $iframe_src = get_post_meta($post->ID, '_cmsp_page_legacy-url', true);
                                $iframe_height = get_post_meta($post->ID, '_cmsp_page_legacy-height', true);
                                if (preg_match('/saopaulo.sp.leg.br\/index.php/', $iframe_src) == 1) {
                                    $iframe_src .= '&template=none';
                                }
                                //adiciona http ou https, se não tiver
                                /**if (!preg_match("~^(?:f|ht)tps?://~i", $iframe_src)) {
                                 * if (is_ssl()) {
                                 * $iframe_src = "https://" . $iframe_src;
                                 * } else {
                                 * $iframe_src = "http://" . $iframe_src;
                                 * }
                                 * }*/
                                //https://www.w3schools.com/tags/att_iframe_sandbox.asp
                                echo '<iframe class="external-content-iframe" src="' . $iframe_src . '" style="height:' . $iframe_height . 'px;"></iframe>';
                            } else if (get_post_meta($post->ID, '_cmsp_page_legacy-type', true) == 'tab') {
                                $link = get_post_meta($post->ID, '_cmsp_page_legacy-url', true);
                                //abrir popup ou nova aba
                                echo '<script>window.open("' . $link . '","_blank");</script>';
                            }

                            /*
                             * Link Pages is used in case you have posts that are set to break into
                             * multiple pages. You can remove this if you don't plan on doing that.
                             *
                             * Also, breaking content up into multiple pages is a horrible experience,
                             * so don't do it. While there are SOME edge cases where this is useful, it's
                             * mostly used for people to get more ad views. It's up to you but if you want
                             * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
                             *
                             * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
                             *
                            */
                            wp_link_pages(array(
                                'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'bonestheme') . '</span>',
                                'after' => '</div>',
                                'link_before' => '<span>',
                                'link_after' => '</span>',
                            ));
                            ?>
                        </section> <?php // end article section ?>

                        <?php
                        $page_downloads = get_post_meta($post->ID, '_cmsp_page_download-files', true);
                        if (isset($page_downloads[0]['title'])):
                            ?>
                            <footer class="article-footer cf">

                                <section class="content-box box-downloads">
                                    <header class="content-box-top box-downloads-header">
                                        <h2 class="content-box-title icon-archives-red">Downloads</h2>
                                    </header>
                                    <ul class="box-downloads-list">
                                        <?php
                                        foreach ($page_downloads as $file):
                                            $blank = false;
                                            if (isset($file['blank'])) {
                                                if ($file['blank'] == 'on') $blank = true;
                                            }
                                            ?>
                                            <li><a <?php if ($blank) echo 'target="_blank" '; ?>
                                                        href="<?php echo $file['file']; ?>"><?php echo $file['title']; ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </section>
                            </footer>

                        <?php endif; ?>

                    </article>

                <?php endwhile; else : ?>

                    <article id="post-not-found" class="hentry cf">
                        <header class="article-header">
                            <h1><?php _e('Oops, Post Not Found!', 'bonestheme'); ?></h1>
                        </header>
                        <section class="entry-content">
                            <p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'bonestheme'); ?></p>
                        </section>
                        <footer class="article-footer">
                            <p><?php _e('This is the error message in the page.php template.', 'bonestheme'); ?></p>
                        </footer>
                    </article>

                <?php endif; ?>

            </div>

            <?php
            // if social media page is parent, show social media sidebar
            $social_page_id = 23867;
            if (in_array($social_page_id, $post->ancestors)):
                get_sidebar('buddypress');
            else:
                get_sidebar('page');
            endif;
            ?>

            <section class="revista" style="width: 100%;">
                <div class="flex justify-between align-center flex-wrap gap-32" style="gap: 32px">
                    <h2 class="desktop-headeline-4 flex g-16 align-center color-accent mb-0" style="margin-bottom: 0px">
                        <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="1" y="1" width="16" height="20" rx="4" stroke="#7F1A22" stroke-width="1.5"/>
                            <path d="M5 6H13" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M5 11H13" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M5 16H9" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        Confira todas as revistas
                    </h2>
                    <div class="flex g-16 playlist-click">
                        <a href="#" class="button-primary button-size-sm" onclick="changeOrder('recentes');return false"
                           id="recentes">Mais recentes</a>
                        <a href="#" class="button-secondary button-size-sm" onclick="changeOrder('antigos');return false"
                           id="antigos">Mais antigos</a>
                    </div>
                </div>
                <div class="flex revista-procuradoria mt-32" data-id="recentes">
                    <?php
                    $revistas = get_field("revistas");
                    $revistas = array_reverse($revistas);

                    foreach ($revistas as $revista) :
                        ?>
                        <a class="item" href="<?= $revista["url"] ?>">
                            <?php echo wp_get_attachment_image($revista['imagem']['id'], "full") ?>
                            <div class="context">
                                <p>
                                    <?= $revista["volume_copiar"] ?>
                                </p>
                                <span>
                                     <?= $revista["descricao"] ?>
                                </span>
                                <div class="flex-item">
                                    <h3>
                                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_3343_368)">
                                                <path d="M24 17.3324H23.0933L20.4267 19.9991H22.9733L25.3333 22.6657H6.66667L9.04 19.9991H11.7733L9.10667 17.3324H8L4 21.3324V26.6657C4 28.1324 5.18667 29.3324 6.65333 29.3324H25.3333C26.8 29.3324 28 28.1457 28 26.6657V21.3324L24 17.3324ZM22.6667 10.5991L16.0667 17.1991L11.3467 12.4791L17.9467 5.87908L22.6667 10.5991ZM17.0133 3.05241L8.52 11.5457C8 12.0657 8 12.9057 8.52 13.4257L15.12 20.0257C15.64 20.5457 16.48 20.5457 17 20.0257L25.48 11.5457C26 11.0257 26 10.1857 25.48 9.66574L18.88 3.06574C18.3733 2.53241 17.5333 2.53241 17.0133 3.05241Z" fill="#7F1A22"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_3343_368">
                                                    <rect width="32" height="32" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <?= $revista["volume"] ?>
                                    </h3>
                                    <em>
                                        <?= $revista["data"] ?>
                                    </em>
                                </div>
                            </div>
                            <div class="h100">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.0394 12.9602C11.4062 14.327 13.6223 14.327 14.9891 12.9602L18.5247 9.42462C19.8915 8.05779 19.8915 5.84171 18.5247 4.47487C17.1578 3.10804 14.9418 3.10804 13.5749 4.47487L11.8072 6.24264" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M12.8678 10.1316C11.501 8.76481 9.28492 8.76481 7.91808 10.1316L4.38255 13.6672C3.01571 15.034 3.01571 17.2501 4.38255 18.6169C5.74938 19.9838 7.96546 19.9838 9.33229 18.6169L11.1001 16.8492" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <div class="flex revista-procuradoria mt-32" data-id="antigos" style="display: none">
                    <?php
                    $revistas = get_field("revistas");
                    foreach ($revistas as $revista) :
                        ?>
                        <a class="item" href="<?= $revista["url"] ?>">
                            <?php echo wp_get_attachment_image($revista['imagem']['id'], "full") ?>
                            <div class="context">
                                <p>
                                    <?= $revista["volume_copiar"] ?>
                                </p>
                                <span>
                                     <?= $revista["descricao"] ?>
                                </span>
                                <div class="flex-item">
                                    <h3>
                                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_3343_368)">
                                                <path d="M24 17.3324H23.0933L20.4267 19.9991H22.9733L25.3333 22.6657H6.66667L9.04 19.9991H11.7733L9.10667 17.3324H8L4 21.3324V26.6657C4 28.1324 5.18667 29.3324 6.65333 29.3324H25.3333C26.8 29.3324 28 28.1457 28 26.6657V21.3324L24 17.3324ZM22.6667 10.5991L16.0667 17.1991L11.3467 12.4791L17.9467 5.87908L22.6667 10.5991ZM17.0133 3.05241L8.52 11.5457C8 12.0657 8 12.9057 8.52 13.4257L15.12 20.0257C15.64 20.5457 16.48 20.5457 17 20.0257L25.48 11.5457C26 11.0257 26 10.1857 25.48 9.66574L18.88 3.06574C18.3733 2.53241 17.5333 2.53241 17.0133 3.05241Z" fill="#7F1A22"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_3343_368">
                                                    <rect width="32" height="32" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <?= $revista["volume"] ?>
                                    </h3>
                                    <em>
                                        <?= $revista["data"] ?>
                                    </em>
                                </div>
                            </div>
                            <div class="h100">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.0394 12.9602C11.4062 14.327 13.6223 14.327 14.9891 12.9602L18.5247 9.42462C19.8915 8.05779 19.8915 5.84171 18.5247 4.47487C17.1578 3.10804 14.9418 3.10804 13.5749 4.47487L11.8072 6.24264" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M12.8678 10.1316C11.501 8.76481 9.28492 8.76481 7.91808 10.1316L4.38255 13.6672C3.01571 15.034 3.01571 17.2501 4.38255 18.6169C5.74938 19.9838 7.96546 19.9838 9.33229 18.6169L11.1001 16.8492" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
        <script>
            function changeOrder(order) {
                jQuery(".playlist-click > a").removeClass("button-primary").addClass("button-secondary");
                jQuery(".playlist-click > a#" + order).addClass("button-primary").removeClass("button-secondary");

                if (order === "antigos") {
                    jQuery("div[data-id=antigos]").show()
                    jQuery("div[data-id=recentes]").hide()
                } else {
                    jQuery("div[data-id=antigos]").hide()
                    jQuery("div[data-id=recentes]").show()
                }
            }
        </script>
        <style>

            @media (max-width: 768px) {
                #main {
                    order: 0;
                }

                .revista-procuradoria {
                    justify-content: center;
                }

                .revista {
                    order: 1;
                }

                .sidebar {
                    order: 3;
                }
            }

            .h100 {
                height: 100%;
            }
            body.theme-v2 .wrap#inner-content {
                flex-wrap: wrap;
            }

            .revista {
                padding-bottom: 136px;
            }

            .revista-procuradoria.act {
                flex-direction: row;
            }

            .revista-procuradoria {
                display: flex;
                flex-direction: revert;
                flex-wrap: wrap;
                gap: 31px;
            }


            span {
                font-family: Montserrat, sans-serif;
                margin-top: 16px;
                font-size: 16px;
                font-weight: 400;
                line-height: 24px;
                text-align: left;
                color: #2C2C2C;
            }

            .revista-procuradoria .item .context {
                padding: 0px;
            }

            .revista-procuradoria .item .context p {
                font-family: Montserrat, sans-serif;
                font-size: 20px;
                font-weight: 700;
                line-height: 28px;
                text-align: left;
                color: #2C2C2C;
            }

            .revista-procuradoria .item .context em {
                font-family: Montserrat, sans-serif;
                font-size: 14px;
                font-weight: 400;
                line-height: 20px;
                text-align: left;
                color: black;
                font-style: normal;
            }

            .revista-procuradoria .item .context h3 {
                display: flex;
                align-items: center;
                gap: 8px;
                color: #7F1A22;
                font-family: Montserrat, sans-serif;
                font-size: 20px;
                font-weight: 600;
                line-height: 28px;
                text-align: left;

            }


            .revista-procuradoria .item img {
                max-width: 100px;
                height: auto;
                display: block;
                aspect-ratio: 100 / 164;
                border-radius:4px;
                object-fit: cover;
            }

            .revista-procuradoria .item .button-primary {
                margin-top: 16px;
                width: 100%;
            }

            .revista-procuradoria .item {
                max-width: 100%;
                width: 100%;
                border-radius: 8px;
                gap:16px;
                text-decoration: none;
                border: 1px solid #AEB6B8;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 16px;
            }

            .flex-item {
                margin-top: 16px;
                display: flex;
                gap: 16px;
                align-items: center;
            }
        </style>
    </div>
</main>
<?php get_footer(); ?>