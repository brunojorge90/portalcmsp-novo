<?php
$automatico = get_field("automatico");
$destaques = get_field("automatico");
if ($automatico) {
    $args = [
        'post_type' => ['slider-home'],
        'showposts' => 1,
    ];
    $featuredQuery2 = new WP_Query($args);
} else {
    $args = [
        'post_type' => ['slider-home'],
        'post__in' => $destaques,
    ];
    $featuredQuery2 = new WP_Query($args);
}
while ($featuredQuery2->have_posts()): $featuredQuery2->the_post();
    $thumbnail = $NewTheme->getPostThumbnail(get_the_ID());
    $show_title = get_post_meta(get_the_ID(), '_cmsp_post_is-title-inhibitted', true);
    ?>
    <div class="container">
        <div class="destaque-principal-1 <?php if (!$thumbnail) echo 'no-post-thumbnail'; if($show_title) echo 'no-title'; ?>">
            <?php

            $title = get_the_title();
            $link = get_permalink();
            $excerpt = $NewTheme->excerpt(get_the_excerpt());

            if ($thumbnail) :
                if($link) {
                    echo "<a href='{$link}'>";
                }
                ?>
                <img src="<?php echo $thumbnail ?>" alt="<?php echo get_the_title() ?>">
                <?php if($link) {
                    echo "</a>";
                }?>
            <?php endif ?>
            <div class="abs">
                <div class="context">
                    <h2 aria-label="<?php echo $title ?>">
                        <a href="<?php echo $link ?>">
                            <?php echo $title ?>
                        </a>
                    </h2>
                    <p class="lines4">
                        <?php echo $excerpt ?>
                    </p>
                    <?php if($title) : ?>
                        <a href="<?php echo $link ?>"
                           class="<?php if ($thumbnail) echo 'button-secondary'; else echo "button-primary"; ?>">
                            Acessar conteúdo
                            <?php
                            if ($thumbnail) :
                                ?>
                                <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 9L15.2929 5.70711C15.6834 5.31658 15.6834 4.68342 15.2929 4.29289L12 1M15 5L1 5"
                                          stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            <?php endif ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>