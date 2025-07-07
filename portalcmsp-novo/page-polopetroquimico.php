<?php
/*
 Template Name: CPI Pólo Petroquimico
*/
?>

<?php get_header(); ?>


		
			
			<!-- CONTEUDO -->
			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="cf" role="main">

						
						<?php the_content(); ?>


							<!-- ULTIMAS NOTICIAS -->
							<div class="cmsp-row" style="clear: both; margin-top: 30px;">

								<section class="content-box box-latest-news">
								  <header class="content-box-top">
								    <h2 class="content-box-title"><a href="<?php echo get_home_url(); ?>/blog/category/noticias/cpis/cpi-da-poluicao-petroquimica/">Últimas Notícias</a></h2>
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
											'category_name' => 'cpi-da-poluicao-petroquimica',
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


								    	<!-- <article class="box-latest-news-item cf">
								        <h3 class="article-title">
								          <span class="date">27.11</span>
								          <span class="headline"><a href="https://www.saopaulo.sp.leg.br/blog/cidade-de-sao-paulo-fecha-a-semana-com-143-mil-obitos-e-4017-mil-casos-de-covid-19/">Cidade de São Paulo fecha a semana com 14,3 mil óbitos e 401,7 mil casos de Covid-19</a></span>
								        </h3>
								    
								      </article> -->
								    	




								  </div>

								 <footer class="box-latest-news-footer">
								    <a href="<?php echo get_home_url(); ?>/blog/category/noticias/cpis/cpi-da-poluicao-petroquimica/" class="btn">Todas as notícias</a>
								  </footer> 
								</section><!-- end box-latest-news -->

							</div><!-- end row -->

	
							

						</div>

				</div>

			</div>
</main>
<?php get_footer(); ?>
