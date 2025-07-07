<?php
$automatico = get_field("automatico");
$destaques = get_field("automatico");

if($automatico) {
    $featuredQuery = new WP_Query(array(
        'post_type' => ['slider-home'],
        'posts_per_page' => 1,
    ));
} else {
 	$featuredQuery = new WP_Query(array(
        'post_type' => ['slider-home'],
        'posts_per_page' => 1,
        'post__in' => $destaques,
    ));
}

$postsNotIn = [];
?>
<section id="noticias-destaque">
    <!--Notícias de destaque-->
    <div class="container flex flex-col">
        <div class="grupo-noticias-1">
            <?php
            $postsNotIn = [];
            while ($featuredQuery->have_posts()): $featuredQuery->the_post();
                $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
                $postsNotIn[] = get_the_ID();
                $thumbnail = $NewTheme->getPostThumbnail();

                $title = get_the_title();
                $link = get_permalink();
                $excerpt = $NewTheme->excerpt(get_the_excerpt());
                $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
                ?>
                <div href="" class="notícia-nivel-1 <?php if(!$title) echo 'no-title';?>">
                    <a class="desktop-headeline-3 mobile-headeline-4" href="<?php echo $link?>">
                        <h1 class="desktop-headeline-3 mobile-headeline-4">
                            <?php echo $title ?>
                        </h1>
                        <?php if($thumbnail && !$title) : ?>
                            <img src="<?php echo $NewTheme->getPostThumbnail() ?>" alt="<?php echo $title ?>"
                                 class="w100">
                        <?php endif; ?>
                    </a>
                    <?php if($excerpt) : ?>
                    <a class="mt-16 decoration-none desktop-body-1 mobile-body-2" href="<?php echo $link?>" title="<?php echo $title ?>" aria-label="<?php echo $title ?>">
                        <?php echo $excerpt ?>
                    </a>
                    <?php endif;
                    if($title) :
                    ?>
                    <a href="<?php echo $link?>" class="button-primary mt-16">Acessar conteúdo</a>
                    <?php endif?>
                </div>
            <?php endwhile; ?>
        </div>
        <?php
        if ($automatico) {
            $featuredQuery2 = new WP_Query(array(
                'post_type' => ['slider-home'],
                'posts_per_page' => 1,
                'post__not_in' => $postsNotIn,
            ));
        } else {
        	  $featuredQuery2 = new WP_Query(array(
                'post_type' => ['slider-home'],
                'posts_per_page' => 1,
                'post__in' => $destaques,
                'post__not_in' => $postsNotIn,
            ));
        }
        while ($featuredQuery2->have_posts()): $featuredQuery2->the_post();
        $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
        $thumbnail = $NewTheme->getPostThumbnail();

        $title = get_the_title();
        $link = get_permalink();
        $excerpt = $NewTheme->excerpt(get_the_excerpt());
        $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
        if($thumbnail) :
        ?>
            <div class="grupo-noticias-2 with-image <?php if($show_title) echo 'no-title';?>">
                    <a href="<?php echo $link?>" class="notícia-nivel-2 <?php if(!$thumbnail) echo 'no-post-thumbnail'?>">
                        <?php if($thumbnail) : ?>
                            <img src="<?php echo $NewTheme->getPostThumbnail() ?>" alt="<?php echo $title ?>"
                                 class="w100">
                        <?php endif; ?>
                        <?php if($title || $excerpt) : ?>
                            <div class="sd">
                                <h2 class="desktop-headeline-4" style="align-items: flex-start;">
                                    <?php echo $title ?>
                                    <p class="desktop-body-1 mobile-body-2 lines3">
                                        <?php echo $excerpt ?>
                                    </p>
                                </h2>
                            </div>
                        <?php endif?>
                    </a>
            </div>
        <?php
        endif;
        if(!$thumbnail) :
            $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
            ?>

        <div class="grupo-noticias-1 <?php if($show_title) echo 'no-title';?>">
            <div href="" class="notícia-nivel-1">
                <?php if($title) : ?>
                <a class="desktop-headeline-3 mobile-headeline-4" href="<?php echo $link ?>"><?php echo $title ?></a>
                <?php endif?>
                <?php if($excerpt) :?>
                    <a class="mt-16 decoration-none desktop-body-1 mobile-body-2" href="<?php echo $link?>" title="<?php echo $title ?>" aria-label="<?php echo $title ?>">
                       <?php echo $excerpt ?>
                    </a>
                <?php endif?>
                <a href="<?php echo $link?>" class="button-primary mt-16">Acessar conteúdo</a>
            </div>
        </div>

        <?php
        endif;
        endwhile; ?>
    </div>
    <!--Notícias de destaque-->
</section>
<style>
    body.theme-v2 .grupo-noticias-1, body.theme-v2 .grupo-noticias-2 .notícia-nivel-2 img, body.theme-v2 .destaque-principal img {
        min-height: auto;
    }

    body.theme-v2 .grupo-noticias-1 .notícia-nivel-1.no-title {
        border: none;
        padding: 0px;
    }

    body.theme-v2 .destaque-principal img {
        border-radius: 8px;
    }

    body.theme-v2 .grupo-noticias-2.with-image .notícia-nivel-2:before {
        display: none;
    }
</style>