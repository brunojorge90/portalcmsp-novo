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
    <div class="container flex flex-col tema-2">
        <div class="grupo-noticias-1">
            <?php
            $postsNotIn = [];
            while ($featuredQuery->have_posts()): $featuredQuery->the_post();
                $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
                $postsNotIn[] = get_the_ID();

                $title = get_the_title();
                $link = get_permalink();
                $excerpt = $NewTheme->excerpt(get_the_excerpt());
                $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
                ?>
                <div class="notícia-nivel-1 <?php if($show_title) echo 'no-title';?>">
                    <a href="<?php echo $link?>" style="text-decoration: none">
                        <h1 class="desktop-headeline-3 mobile-headeline-4" >
                            <?php echo $title?>
                        </h1>
                    </a>
                    <?php if($excerpt) : ?>
                        <a class="mt-16 decoration-none desktop-body-1 mobile-body-2" href="<?php echo $link?>" title="<?php echo $title ?>" aria-label="<?php echo $title ?>">
                            <?php echo $excerpt?>
                        </a>
                    <?php endif?>
                    <a href="<?php echo $link?>" class="button-primary mt-16">Acessar conteúdo</a>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="grupo-noticias-2">
            <?php
            if($automatico) {
                $featuredQuery2 = new WP_Query(array(
                    'post_type' => ['slider-home'],
                    'posts_per_page' => 2,
                    'post__not_in' => $postsNotIn,

                ));
            } else {
            	$featuredQuery2 = new WP_Query(array(
                    'post_type' => ['slider-home'],
                    'posts_per_page' => 2,
                    'post__not_in' => $postsNotIn,
 					'post__in' => $destaques,
                ));
            }
            while ($featuredQuery2->have_posts()): $featuredQuery2->the_post();
                $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
                $thumbnail = $NewTheme->getPostThumbnail();

                $title = get_the_title();
                $link = get_permalink();
                $excerpt = $NewTheme->excerpt(get_the_excerpt());
                $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
                ?>
                <a href="<?php echo $link?>" class="notícia-nivel-2 <?php if($show_title || !$title) echo 'no-title';?> <?php if(!$thumbnail) echo 'no-post-thumbnail'?>">
                    <?php if($thumbnail) : ?>
                        <img src="<?php echo $thumbnail ?>" alt="<?php echo $title ?>"
                             class="w100">
                    <?php endif; ?>
                    <?php if($title && $excerpt) : ?>
                    <div class="sd">
                        <?php if($title) : ?>
                            <h2 class="desktop-headeline-4">
                                <?php echo $title ?>
                            </h2>
                        <?php endif?>
                        <p class="desktop-body-1 mobile-body-2 lines3">
                            <?php echo $excerpt ?>
                        </p>
                    </div>
                    <?php endif?>
                    <?php if(!$thumbnail) : ?>
                        <div class="p20">
                            <p class="desktop-body-1 mobile-body-2 lines3">
                                <?php echo $excerpt ?>
                            </p>
                            <span class="flex g-13 align-center flex-end">
                                Acessar notícia
                                <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"></path>
                                </svg>
                            </span>
                        </div>
                    <?php endif?>
                </a>
            <?php endwhile; ?>
        </div>
    </div>
    <!--Notícias de destaque-->

</section>
<style>
	body.theme-v2 .grupo-noticias-1 {
    	min-height:auto;
    }
    
    .destaque-principal .tema-2  .grupo-noticias-1 img, .destaque-principal .tema-2 .grupo-noticias-2 img {
        min-height: 304px;
    }
</style>