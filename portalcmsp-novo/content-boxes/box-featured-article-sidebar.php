<section class="content-box box-featured-article">
  <header class="content-box-top">
    <h2 class="content-box-title icon-newspaper-red">Notícia em Destaque</h2>
  </header>

  <?php
  $featuredQueryq = new WP_Query(array(
      'post_type' => 'post',
      'posts_per_page' => 1,
      'meta_query' => array(
          array(
            'key' => '_cmsp_post_is-featured-article',
            'value' => 'on',
          ),
        ),
    ));
  while($featuredQueryq->have_posts()): $featuredQueryq->the_post();
  $show_title = get_post_meta( get_the_ID(), '_cmsp_post_is-title-inhibitted', true );
  ?>
    <article>
      <a href="<?php the_permalink(); ?>"><?php if(!$show_title){ ?><h3><?php the_title(); ?></h3><?php } ?>
      <?php the_post_thumbnail('cmsp-featured-post-thumb'); ?></a>
    </article>
  <?php endwhile; ?>
</section><!-- end box-featured-article -->