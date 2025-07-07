<?php
/*
 Template Name: Pauta das Sessões - NOVA
*/
?>

<?php get_header(); ?>

    <style type="text/css">
        .wrap .wrap {
            width: 100%;
        }

        .cmsp-row:first-of-type {
            margin-top: 0;
        }

        .content-box {
            margin-bottom: 2em;
        }

        .content-box:last-child {
            margin-bottom: 0;
        }

        .box-downloads-list {
            padding: 1em;
        }

        .box-latest-news .box-latest-news-footer {
            padding: 1em 1em 1em 0;
        }

        .hentry {
            margin-bottom: 1em;
        }

        .hentry footer {
            padding: 1.5em 0;
        }

        .contact-widget {
            margin-bottom: 2.5em;
            padding-left: 40px;
        }

        .content-box-top .content-box-title {
            display: flex;
            gap: 16px;
        }

        .content-box-top .content-box-title:before {
            position: relative;
        }

        @media only screen and (min-width: 768px) {
            .wrap .wrap {
                width: 980px;
            }

            .cmsp-row:first-of-type {
                margin-top: 1.5em;
            }

            .box-downloads-list {
                padding: 12px 0 12px 40px;
            }

            .hentry .article-footer .box-downloads {
                width: 482px;
            }

            .hentry {
                margin-bottom: 1.5em;
            }

            .hentry footer {
                padding: 1.5em;
            }

            .contact-widget {
                float: right;
                text-align: left;
                width: 300px;
            }
        }

        .box-nav-menu-list,
        .box-downloads-list {
            border: none;
        }

        .content-box-top {
            border-top: none;
            border-left: none;
            border-right: none;
        }
    </style>

    <div id="content">

        <div class="breadcrumbs cf">
            <?php if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb('<p class="wrap cf">','</p>');
            } ?>
        </div>

        <div id="inner-content" class="wrap cf">

            <div id="main" class="two-column-main cf" role="main">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                        <header class="article-header">

                            <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

                        </header> <?php // end article header ?>

                        <section class="entry-content cf" itemprop="articleBody">
                            <header class="content-box-top">
                                <h2 class="content-box-title icon-calendar-red">AGENDA</h2>
                            </header>
                            <br/>
                            <?php
                            // the content (pretty self explanatory huh)
                            the_content();

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
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                            ) );
                            ?>
                        </section> <?php // end article section ?>

                        <!--footer class="article-footer cf" display="inline-block"-->
                        <footer class="article-footer cmsp-row wrap cf">
                            <?php
                            $page_downloads = get_post_meta($post->ID, '_cmsp_page_download-files', true);
                            //if(isset($page_downloads[0]['title'])):
                            ?>
                            <section class="content-box box-downloads cmsp-left">
                                <header class="content-box-top box-downloads-header">
                                    <h2 class="content-box-title icon-archives-red">Downloads</h2>
                                </header>
                                <ul class="box-downloads-list">
                                    <?php
                                    if(isset($page_downloads[0]['title'])):
                                        foreach($page_downloads as $file):
                                            $blank = false;
                                            if(isset($file['blank'])){
                                                if($file['blank'] == 'on') $blank = true;
                                            }
                                            if($file['file']) :
                                                ?>
                                                <li><a <?php if($blank) echo 'target="_blank" '; ?> href="<?php echo $file['file']; ?>"><?php echo $file['title']; ?></a></li>
                                            <?php endif; endforeach; endif;?>
                                    <li><a href="https://splegisconsulta.saopaulo.sp.leg.br/SessaoPlnrPautasV2/Index?avoidDataTable=true">Clique aqui para ver o histórico de Pautas no SPLegis</a></li>
                                    <li><a href="https://www.saopaulo.sp.leg.br/atividade-legislativa/lei-organica-do-municipio/">Clique aqui para ver a Lei Orgânica do Município</a></li>
                                    <li><a href="https://www.saopaulo.sp.leg.br/atividade-legislativa/regimento-interno/">Clique aqui para ver o Regimento Interno</a></li>
                                </ul>
                            </section>
                            <?php //endif; ?>

                            <section class="content-box box-latest-news cmsp-right">
                                <header class="content-box-top">
                                    <h2 class="content-box-title icon-clock-red"><a href="<?php echo get_home_url(); ?>/blog/category/sessao-plenaria/">Últimas Notícias das Sessões</a></h2>
                                </header>
                                <div class="box-latest-news-list">

                                    <?php
                                    //cacheia consulta lenta (expiração a cada 10 min)
                                    $key = 'wpquery_cacheado_ultimas_noticias';
                                    if ( ! $latestQuery = wp_cache_get($key) ) {

                                        $latestQuery = new WP_Query(array(
                                            'no_found_rows' => true,
                                            'post_type' => 'post',
                                            'posts_per_page' => 5,
                                            'category_name' => 'sessao-plenaria',
                                            //'category_name' => 'projetos,plenario,projetos-aprovados,em-tramitacao,sessao-solene,sessao-plenaria,projetos-sancionados,aviso-de-pauta',
                                        ));

                                        wp_cache_set($key,$latestQuery,'',600);
                                    }
                                    while($latestQuery->have_posts()): $latestQuery->the_post();
                                        ?>
                                        <article class="box-latest-news-item cf">
                                            <h3 class="article-title">
                                                <span class="date"><a href="#"><?php echo get_the_date('d\.m'); ?></a></span>
                                                <span class="headline"><a href="<?php the_permalink(); ?>"><?php if(strlen(get_the_title()) > 60){ echo(mb_substr(get_the_title(), 0, 60)) . '&#8230;'; } else { echo get_the_title(); } ?></a></span>
                                            </h3>
                                        </article>
                                    <?php endwhile; wp_reset_query(); ?>
                                </div>

                                <footer class="box-latest-news-footer">
                                    <a href="<?php echo get_home_url(); ?>/comunicacao/noticias/" class="btn">Todas as notícias</a>
                                </footer>
                            </section><!-- end box-latest-news -->
                        </footer>

                    </article>

                <?php endwhile; else : ?>

                    <article id="post-not-found" class="hentry cf">
                        <header class="article-header">
                            <h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
                        </header>
                        <section class="entry-content">
                            <p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
                        </section>
                        <footer class="article-footer">
                            <p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
                        </footer>
                    </article>

                <?php endif; ?>

            </div>

            <!-- Sidebar -->
            <?php get_sidebar('pauta-sessoes'); ?>

        </div>

    </div>
</main>
<?php get_footer(); ?>