<?php
/*
 Template Name: Comissões
*/
?>
<?php get_header(); ?>

<style type="text/css">
    .teclaCom {
        margin:0 0 15px;
        min-width:90px;
        height:85px;
    }

    img.iconeCom {
        margin-right: 1.5em;
        display: inline;
        float: left;
    }

    a.botao {
        text-decoration: none;
        text-align: center;
        display: block;
        line-height: 40px;
        background: #e0e0e0;
        color: #444;
        font-weight: bolder;
    }

    .cl {
        clear:both;
    }

    .comContent {
        float: left;
        width: 100%;
    }

    .teclaCom a {
        font-size:.85em;
        color:#000;
        text-decoration:none;
    }

    .comTitle {
        font-size: 1.5em;
        margin: .5em 0px 1em;float: left;
    }

    @media only screen and (min-width: 768px) {
        .teclaCom {
            width: calc(32% - 30px);
            margin:0 15px 15px;
        }

        .hentry .article-footer .box-downloads.pageCom {
            width: 100%;
        }
    }

</style>


<div id="content">

    <div class="breadcrumbs cf">
        <?php if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('<p class="wrap cf">','</p>');
        } ?>
    </div>

    <div id="inner-content" class="wrap cf">
        <div id="main" class="cf" role="main">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>
                         role="article" itemscope itemtype="https://schema.org/BlogPosting">

                    <header class="article-header">
                        <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
                    </header><?php // end article header ?>

                    <section class="entry-content cf" itemprop="articleBody">
                        <?php the_content(); ?>
                        <div style="clear:both;"></div>

                        <?php
                        $args = array(
                            'post_type'      => 'comissao',
                            'posts_per_page' => -1,
                            'post_name__in'  => array('comissoes-do-processo-legislativo', 'comissoes-extraordinarias', 'comissoes-temporarias', 'comissoes-parlamentares-de-inquerito-cpis', 'comissoes-de-estudo', 'comissoes-de-representacao', 'comissoes-encerradas'),
                            'orderby' => 'post_name__in',
                            'sort_order' => 'ASC'
                        );

                        $com_query = new WP_Query( $args );
                        while ( $com_query->have_posts() ) : $com_query->the_post();
                            ?>
                            <h2 id="title_<?php echo $post->post_name; ?>" class="comTitle" <?php if( get_field('sub_titulo') ): ?> style="color: <?php the_field('sub_titulo'); ?>;"<?php endif; ?> >
                                <?php the_title(); ?>
                            </h2>
                            <div class="comContent">
                                <?php the_content(); ?>
                            </div>

                            <div class="cl"></div>

                            <?php

                            $args2 = array(
                                'post_type'      => 'comissao',
                                'posts_per_page' => -1,
                                'post_parent'    => $post->ID,
                                'order'          => 'ASC',
                                'orderby'        => 'menu_order'
                            );

                            $childcom_query = new WP_Query( $args2 );
                            while ( $childcom_query->have_posts() ) : $childcom_query->the_post();
                                ?>
                                <div class="teclaCom alignleft" >
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo get_the_post_thumbnail( $post->ID, array(55, 55), array ('class' => 'iconeCom', 'alt' => get_the_title()) );?>
                                        <p><?php the_title(); ?></p>
                                    </a>
                                </div>
                            <?php
                            endwhile; ?>

                            <div class="cl"></div>

                            <?php
                            // reset post data (important!)
                            wp_reset_postdata();

                        endwhile;
                        // reset post data (important!)
                        wp_reset_postdata();
                        ?>

                        <div class="cl"></div>

                        <!-- Histórico das Comissões Encerradas - início -->
                        <div class="teclaCom alignleft">
                            <a href="?p=845">
                                <img alt="historico" width="55" height="55" src="https://saopaulo.sp.leg.br/wp-content/uploads/2016/04/Encerradas_Black-125x125.png" class="iconeCom wp-post-image">
                                <p>Histórico das Comissões Encerradas</p>
                            </a>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- Histórico das Comissões Encerradas - fim -->

                    </section> <?php // end article section ?>

                    <footer class="article-footer cf">
                        <?php
                        $page_downloads = get_post_meta($post->ID, '_cmsp_page_download-files', true);
                        if(isset($page_downloads[0]['title'])):
                            ?>
                            <section class="content-box box-downloads pageCom">
                                <header class="content-box-top box-downloads-header">
                                    <h2 class="content-box-title icon-archives-red">Downloads</h2>
                                </header>
                                <ul class="box-downloads-list">
                                    <?php
                                    foreach($page_downloads as $file):
                                        $blank = false;
                                        if(isset($file['blank'])){ if($file['blank'] == 'on') $blank = true; }
                                        ?>
                                        <li>
                                            <a href="<?php echo $file['file']; ?>" <?php if($blank) echo 'target="_blank" '; ?>>
                                                <?php echo $file['title']; ?>
                                            </a>
                                        </li>
                                    <?php
                                    endforeach;
                                    ?>
                                </ul>
                            </section>
                        <?php
                        endif;
                        ?>
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
    </div>

</div><?php // end content ?>
<script>
    // Verificar se a URL contém o elemento com ID 'title_cpi'
    if (window.location.hash.includes('title_cpi')) {
        // Rolar até o elemento com ID 'title_comissoes-parlamentares-de-inquerito-cpis'
        const element = document.getElementById('title_comissoes-parlamentares-de-inquerito-cpis');
        if (element) {
            const offsetTop = element.offsetTop;
            window.scrollTo({ top: offsetTop, behavior: 'smooth' });
        }
    }

</script>
</main>
<?php get_footer(); ?>