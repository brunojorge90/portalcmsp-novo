				<div id="sidebar1" class="sidebar m-all t-1of3 d-2of7 last-col cf" role="complementary">
                    <div class="social-media flex-end flex g-8">
                        <a href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode(get_permalink()); ?>"
                           target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-linkedin.svg" alt="Compartilhar Linkedin">
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                           target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-facebook.svg" alt="Compartilhar Facebook">
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>"
                           target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-twitter.svg" alt="Compartilhar Twitter">
                        </a>
                        <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&amp;body=<?php echo urlencode(get_permalink()); ?>"
                           target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-email.svg" alt="Compartilhar E-mail">
                        </a>
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-favorito.svg" alt="Adicionar ao favorito">
                        </a>
                        <a href="<?php echo get_permalink(); ?>#comments" class="comments" aria-label="Comentários" title="Comentários">
                        <span>
                            <?php echo get_comments_number() ?>
                        </span>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-comments.svg" alt="Comentários">
                        </a>
                    </div>

					<?php if (is_day() || is_month() || is_category('camara-fotografica')) { ?>
						<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
						<section class="content-box box-latest-news">
							<header class="content-box-top">
								<h2 class="content-box-title icon-monitor-red"><a href="<?php echo get_home_url(); ?>/blog/camara-fotografica/">Câmara Fotográfica</a></h2>
							</header>
							<div class="box-latest-news-list">
								<?php dynamic_sidebar( 'sidebar-1' ); ?>
							</div><!-- .sidebar .widget-area -->
						</section>
						<?php endif; ?>
					<?php } ?>
					
					<?php get_template_part('content-boxes/box','featured-article-sidebar'); ?>

					<section class="content-box box-latest-news">
						<header class="content-box-top">
							<h2 class="content-box-title icon-clock-red"><a href="<?php echo get_home_url(); ?>/comunicacao/noticias/">Outras Notícias</a></h2>
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
										<span class="headline"><a href="<?php the_permalink(); ?>"><?php if(strlen(get_the_title()) > 55){ echo(mb_substr(get_the_title(), 0, 55)) . '...'; } else { echo get_the_title(); } ?></a></span>
									</h3>
								</article>
							<?php endwhile; ?>
						</div>

						<footer class="box-latest-news-footer">
							<a href="<?php echo get_home_url(); ?>/comunicacao/noticias/" class="" style="width: 100%;text-align: center">Todas as notícias</a>
						</footer>
					</section><!-- end box-latest-news -->

					<div class="container-top-nav-3">
						<nav>
							<?php  wp_nav_menu(array(
							'container' => false,                           // remove nav container
							'container_class' => 'menu cf',                 // class of container (should you choose to use it)
							'menu' => __( 'Secondary Menu', 'bonestheme' ),  // nav name
							'menu_class' => 'nav top-nav-3 cf',               // adding custom nav class
							'theme_location' => 'third-nav',                 // where it's located in the theme
							'before' => '',                                 // before the menu
		    			'after' => '',                                  // after the menu
		    			'link_before' => '',                            // before each link
		    			'link_after' => '',                             // after each link
		    			'depth' => 0,                                   // limit the depth of the nav
							'fallback_cb' => ''                             // fallback function (if there is one)
							)); ?>
						</nav>
					</div>

                    <?php if(comments_open()) : ?>
                    <div class="participe-button ver-comentarios" aria-label="Opine sobre este conteúdo?">
                        <h3>Opine sobre este conteúdo</h3>
                        <p>
                            Queremos te ouvir, nos envie uma mensagem.
                        </p>
                    </div>
                    <?php endif?>
				</div>
