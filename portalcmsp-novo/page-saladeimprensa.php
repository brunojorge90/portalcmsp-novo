<?php
/*
 Template Name: Sala de Imprensa
*/
$post_slug=$post->post_name;
if ($post_slug == "aviso-de-pauta") {$cat = 266;}
elseif ($post_slug == "banco-de-releases") {$cat = 267;}
else {$cat = 268;}
?>
<?php get_header(); ?>

			<div id="content">
			
			<div class="breadcrumbs cf">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p class="wrap cf">','</p>');
				} ?>
			</div>

				<div id="inner-content" class="wrap cf">

						<div id="main" class="two-column-main cf" role="main">

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

								</header> <?php // end article header ?>

								<section class="entry-content cf" itemprop="articleBody">
									<?php $query = new WP_Query( 'cat='.$cat ); ?>
									<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

									<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

										<header class="article-header">

											<p class="byline vcard">
												Atualizado em (<time class="updated" datetime="<?php echo get_the_time('Y-m-j'); ?>" pubdate><?php echo get_the_time('d\/m\/Y'); ?> &ndash; <?php echo get_the_time('H\hi'); ?></time>)
												|
												<?php the_category(', '); ?>
											</p>

											<h1 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

										</header>

										<section class="entry-content cf">
											<?php the_excerpt(); ?>
										</section>

									</article>

									<?php endwhile; ?>
									<?php endif; ?>
									
								</section> <?php // end article section ?>

							</article>

						</div>
						<?php get_sidebar('salaimprensa');	?>

				</div>
			</div>
</main>			
<?php get_footer(); ?>