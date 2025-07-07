<?php
/*
 Template Name: Revista da Procuradoria RESUMO
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


                        <section class="revista">

                    

                <div class="flex justify-between align-center flex-wrap gap-32" style="gap: 32px">
                    <h2 class="desktop-headeline-4 flex g-16 align-center color-accent mb-0" style="margin-bottom: 0px; margin-top: 30px; font-size: 2.5rem;">
                        <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="1" y="1" width="16" height="20" rx="4" stroke="#7F1A22" stroke-width="1.5"/>
                            <path d="M5 6H13" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M5 11H13" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M5 16H9" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        Artigos da Revista da Procuradoria
                    </h2>
                    
                </div>
                <div class="revista-procuradoria mt-32">
                    <?php
                    $revistas_resumo = get_field("revistas_resumo");
                    
                    // Ordenar em ordem crescente pelo título
                    usort($revistas_resumo, function ($a, $b) {
                        return strcmp($a["titulo"], $b["titulo"]);
                    });

                    foreach ($revistas_resumo as $revista) :
                        ?>
                        
                            <?php ?>
                            <div class="context">
                               
                                <h3 style="margin-bottom: 10px;">
                                    <strong><?= $revista["titulo"] ?></strong>
                                    <span style="text-align: right;display: block;"><i><?= $revista["autor"] ?></i></span>
                                </h3>

                                <p><strong>Resumo:</strong> <?= $revista["descricao"] ?>
                                </p>

                                
                            </div>
                            
                       
                    <?php endforeach; ?>
                </div>
                
            </section>









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


        </div>
      
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


            span {
                font-family: Montserrat, sans-serif;
                font-size: 12px;
                font-weight: 600;
                line-height: 24px;
                color: #2C2C2C;
                margin-top: 10px;

            }

            .context { width:100%; border-top: 1px solid #c6d3d9; padding-top: 30px; }

            .context h3 {
                font-family: Montserrat, sans-serif;
                font-size: 20px;
                font-weight: bold;
                line-height: 28px;
                text-align: left;
                color: #2C2C2C;
                margin-bottom: 10px;
            }

            .context p {
                font-family: Montserrat, sans-serif;
                font-size: 14px;
                font-weight: normal;
                line-height: 28px;
                text-align: justify;
                color: #2C2C2C;
                padding-bottom: 20px;
                margin-top: 20px;
            }

            
        </style>
    </div>
</main>
<?php get_footer(); ?>