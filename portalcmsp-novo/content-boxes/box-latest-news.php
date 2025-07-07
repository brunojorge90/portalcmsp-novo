<section class="content-box box-latest-news">
  <header class="content-box-top">
    <h2 class="content-box-title icon-clock-red"><a href="<?php echo get_home_url(); ?>/comunicacao/noticias/">Últimas Notícias</a></h2>
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
			'category_name' => 'noticias',
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
    <?php endwhile; ?>
  </div>

  <footer class="box-latest-news-footer">
    <a href="<?php echo get_home_url(); ?>/comunicacao/noticias/" class="btn">Todas as notícias</a>
  </footer>
</section><!-- end box-latest-news -->