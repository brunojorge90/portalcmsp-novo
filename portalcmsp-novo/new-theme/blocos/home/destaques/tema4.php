<?php
$postsNotIn = [];

$automatico = get_field("automatico");
$destaques = get_field("automatico");
?>
<section id="noticias-destaque">
    <!--Notícias de destaque-->
    <div class="container flex flex-col">
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
                    'post__in' => $destaques,
                    'post__not_in' => $postsNotIn,
                ));
            }
            $postsNotIn = [];
            $i = 0;
            while ($featuredQuery2->have_posts()): $featuredQuery2->the_post();
                $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
                $thumbnail = $NewTheme->getPostThumbnail();
                $postsNotIn[] = get_the_ID();

                $title = get_the_title();
                $title_alt = get_the_title() ? get_the_title() : "posicao".$i;
                $link = get_permalink();
                $excerpt = $NewTheme->excerpt(get_the_excerpt());
                ?>
                <a href="<?php echo the_permalink()?>" class="notícia-nivel-2 <?php if(!$thumbnail) echo 'no-post-thumbnail'?> <?php if(!$title) echo 'no-title'?>">
                    <?php if($thumbnail) : ?>
                        <img src="<?php echo $thumbnail ?>" alt="<?php echo $title_alt ?>"
                             class="w100">
                    <?php endif;
                    if($title) :
                        ?>
                        <div class="sd">
                            <h<?php if($i == 0) echo '1'; else echo '2';?> class="desktop-headeline-4" style="color:white"><?php echo $title_alt ?></h<?php if($i == 0) echo '1'; else echo '2';?>>
                        </div>
                    <?php
                    endif;
                    if(!$thumbnail) : ?>
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
            <?php
            $i++;
            endwhile; ?>
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
                    'post__in' => $destaques,
                    'post__not_in' => $postsNotIn,
                ));
            }
            $i = 0;
            while ($featuredQuery2->have_posts()): $featuredQuery2->the_post();
                $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
                $thumbnail = $NewTheme->getPostThumbnail();
                $title_alt = get_the_title() ? get_the_title() : "posicao".$i;
                $title = get_the_title();
                $link = get_permalink();
                $excerpt = $NewTheme->excerpt(get_the_excerpt());
                $i++;
                ?>
                <a href="<?php echo $link ?>" class="notícia-nivel-2 <?php if(!$thumbnail) echo 'no-post-thumbnail'?>  <?php if(!$title) echo 'no-title'?>">
                    <?php if($thumbnail) : ?>
                        <img src="<?php echo $thumbnail ?>" alt="<?php echo $title_alt ?>"
                             class="w100">
                    <?php endif; ?>
                    <?php if($title) : ?>
                        <div class="sd">
                            <h2 class="desktop-headeline-4"><?php echo $title ?></h2>
                        </div>
                    <?php endif; ?>
                    <?php if(!$thumbnail) : ?>
                        <div class="p20">
                            <p class="desktop-body-1 mobile-body-2 lines3">
                                <?php echo $excerpt?>
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
    <style>
        body.theme-v2 .grupo-noticias-2 .notícia-nivel-2 img {
            height: auto;
            min-height: auto;
        }
    </style>
</section>