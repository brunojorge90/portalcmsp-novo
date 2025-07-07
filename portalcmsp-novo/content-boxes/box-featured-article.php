<section class="content-box box-featured-article">
  <header class="content-box-top">
    <h2 class="content-box-title icon-newspaper-red">Notícia em Destaque</h2>
  </header>

  <?php
  $featuredQuery = new WP_Query(array(
      'post_type' => 'post',
      'posts_per_page' => 1,
      'meta_query' => array(
          array(
            'key' => '_cmsp_post_is-featured-article',
            'value' => 'on',
          ),
        ),
    ));
  while($featuredQuery->have_posts()): $featuredQuery->the_post();
  $show_title = get_post_meta( get_the_ID(), '_cmsp_post_is-title-inhibitted', true );
  ?>
    <article>
      <?php if(!$show_title){ ?><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php } ?>
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('cmsp-featured-post-thumb'); ?></a>
    </article>
  <?php endwhile; ?>
</section><!-- end box-featured-article -->