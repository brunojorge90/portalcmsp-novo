<?php get_header(); ?>

			<div id="content">
			
			<div class="breadcrumbs cf">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p class="wrap cf">','</p>');
				} ?>
			</div>

			<div class="section-title">
				<h2 class="wrap icon-lightbulb-large-red">Banco de Ideias</h2>
			</div>

				<div id="inner-content" class="wrap cf">

					<div id="main" class="two-column-main cf" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php
								get_template_part( 'post-formats/format', 'idea' );
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

					</div>

					<?php get_sidebar('banco-de-ideias'); ?>

				</div>

			</div>

<?php get_footer(); ?>
