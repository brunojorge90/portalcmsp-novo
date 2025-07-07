<?php
/*
 Template Name: Galeria de Áudios
*/

?>

<?php get_header(); ?>
			
			<div class="breadcrumbs cf">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p class="wrap cf">','</p>');
				} ?>
			</div>

			<div class="section-title">
				<h2 class="wrap icon-clock-large-red"><?php echo $post->post_title; ?></h2>
			</div>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<?php

						$gallery = 'imagem';
						if($post->post_name == 'galeria-videos') $gallery = 'video';
						if($post->post_name == 'galeria-podcasts') $gallery = 'podcast';

						?>

						<div id="main" class="cf" role="main">

							<div class="gallery-list cf">

								<?php

								$galleryPage = (get_query_var("paged")) ? get_query_var("paged") : 1;

								$galleryQuery = new WP_Query(array(
									'post_type' => 'podcasts',
									'posts-per-page' => 20,
									'paged' => $galleryPage
								));

								if($galleryQuery->have_posts()):
								while($galleryQuery->have_posts()): 
									$galleryQuery->the_post();
								?>

									<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

										<header class="article-header">

											<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
											<p class="byline vcard">Adicionado em <time class="updated" datetime="<?php echo get_the_time( 'Y-m-j' ); ?>" pubdate><?php echo get_the_time('j \d\e F \d\e Y'); ?></time> por <span class="author"><?php echo $author_name; ?></span></p>

										</header>

										<section class="entry-content cf">

											<?php the_excerpt(); ?>
													
										</section>

									</article>

								<?php endwhile; else: ?>

									Nenhum item

								<?php endif; ?>

							</div>

							<?php bones_page_navi($galleryQuery); ?>

						</div>

				</div>

			</div>
</main>
<?php get_footer(); ?>
