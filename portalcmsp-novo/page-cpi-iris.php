<?php
/*
 Template Name: CPI da Iris
*/
?>


<style>
	
label { display: inline !important; }


body.theme-v2 .desktop-headeline-5 { font-size: 1.6rem !important;}
body.theme-v2 .institucional-terciario .card-terciario .infos-servicos {padding: 15px !important; text-align: center;}
body.theme-v2 .desktop-body-3 {font-size: 1.6rem !important; line-height: 0 !important;}

.comissao .flex-1 {flex: 1;}

body.theme-v2 .content-box { width: 49% !important; float: left; margin: 30px 1% 40px 0 ;}

.playlist { margin: 30px 0 40px 1% !important; }

.playlist iframe { height:350px !important; }

.institucional-terciario {gap: 18px !important;}

@media screen and (max-width: 600px) {
    body.theme-v2 .content-box { width: 100% !important; float: left; margin: 40px 1% 20px 0 ;}

    .playlist { margin: 0 0 20px 0 !important;  }

    .playlist iframe { height:300px !important; }
}


</style>

<?php get_header(); ?>


		
			
			<!-- CONTEUDO -->
			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="cf" role="main">

						
						<?php the_content(); ?>


							<!-- ULTIMAS NOTICIAS -->
						

							<div class="cmsp-row">
							<div class="flex-1">
                                        <section class="content-box box-latest-news">
                                            <header class="content-box-top">
                                                <h2 class="content-box-title icon-clock-red">Últimas Noticias da
                                                    Comissão</h2>
                                            </header>

                                            <div class="box-latest-news-list">

								   <?php
									//cacheia consulta lenta (expiração a cada 10 min)
									$key = 'wpquery_cacheado_ultimas_noticias';
								    if ( ! $latestQuery = wp_cache_get($key) ) {
								         
										$latestQuery = new WP_Query(array(
											'no_found_rows' => true,
											'post_type' => 'post',
											'posts_per_page' => 10,
											'category_name' => 'cpi-da-iris',
										));
										
										wp_cache_set($key,$latestQuery,'',600);
								    }
								    while($latestQuery->have_posts()): $latestQuery->the_post();
								    ?>
								      <article class="box-latest-news-item cf">
								        <h3 class="article-title">
								          <span class="date"><?php echo get_the_date('d\.m'); ?></span>
								          <span class="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
								        </h3>
								      </article>
								    <?php endwhile; ?> 






								  </div>

								 <footer class="box-latest-news-footer">
								    <a href="<?php echo get_home_url(); ?>/blog/category/noticias/cpis/cpi-da-iris/" class="btn">Todas as notícias</a>
								  </footer> 
                                        </section>
                                    </div>

	
                            <div class="flex-1">
                            <section class="content-box playlist">
							<iframe width="100%" src="https://www.youtube.com/embed/videoseries?si=9p2I_uqMm6deU1mY&amp;list=PLYt3a0f9wjCkHNjd8mLj5JGIFGY5zArJ0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

							</section>
                                    </div>

                                </div>
							

						</div>

				</div>

			</div>
   </main>        


<?php get_footer(); ?>