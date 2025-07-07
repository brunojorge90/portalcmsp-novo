<?php get_header(); ?>
<?php if(get_field("url_destino")){ ?>
<script>
<!--
	window.location.href= "<?php echo get_field("url_destino"); ?>";
//-->
</script>
<?php } ?>
			<div id="content">
			<div class="breadcrumbs cf">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p class="wrap cf">','</p>');
				} ?>
			</div>

			<div class="section-title">
				<?php if (get_post_format() != "image") { ?>
					<h2 class="wrap icon-clock-large-red">Notícias</h2>
					<?php $cam_foto = "nao"; ?>
				<?php } else { ?>
					<h2 class="wrap icon-camera-large-red">Câmara Fotográfica</h2>
					<?php $cam_foto = "sim"; ?>
				<?php } ?>
			</div>

				<div id="inner-content" class="wrap cf">

					<div id="main" class="<?php if (get_post_format() != "image") { echo "two-column-main"; } ?> cf" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php
								get_template_part( 'post-formats/format', get_post_format() );
							?>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>
						<!-- Inclusão de Veja também - 07/04/2017 -- Toborino -->
						<section class="content-box box-latest-news" style="margin-bottom:60px;">
						  <header class="content-box-top">
							<h2 class="content-box-title icon-clock-red">Veja também</h2>
						  </header>

						  <div class="box-latest-news-list">

							<?php
							$exclude = $post->ID;
							$latestQuery = new WP_Query(array(
								'post_type' => 'post',
								'posts_per_page' => 5,
								'post__not_in' => array($exclude),
								'category__not_in' => array( 1, 8 )
							  ));
							while($latestQuery->have_posts()): $latestQuery->the_post();
							?>
							  <article class="box-latest-news-item cf">
								<h3 class="article-title">
								  <span class="date"><a href="#"><?php echo get_the_date('d\.m'); ?></a></span>
								  <span class="headline"><a href="<?php the_permalink(); ?>"><?php if(strlen(get_the_title()) > 62){ echo(mb_substr(get_the_title(), 0, 80)) . '...'; } else { echo get_the_title(); } ?></a></span>
								</h3>
							  </article>
							<?php endwhile; ?>
						  </div>
						</section><!-- end Veja também -->		
					</div>

					<?php //if (!$cam_foto) {
						get_sidebar();
						//} 
						?>

				</div>

			</div>

<?php get_footer(); ?>
