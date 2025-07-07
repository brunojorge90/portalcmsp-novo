
<section class="content-box box-events">
  <header class="content-box-top">
    <h2 class="content-box-title icon-photo-camera-red">Eventos</h2>
  </header>


  <?php
  $featuredQuery = new WP_Query(array(
      'post_type' => 'post',
      'posts_per_page' => 1,
      'category_name' => 'eventos'
    ));
  while($featuredQuery->have_posts()): $featuredQuery->the_post();
  ?>
	  <article>
	    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	    <?php the_post_thumbnail('cmsp-featured-post-thumb'); ?>
	  </article>
  <?php endwhile; ?>
</section><!-- end .box-events -->