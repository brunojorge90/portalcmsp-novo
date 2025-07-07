<?php
/*
 Template Name: Cadastro de Ideias
 *
*/
?>

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

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>

								</header>

								<section class="entry-content cf" itemprop="articleBody">

									<form class="idea-subscribe-form">
										<div class="form-row">
											<label for="idea-subscribe-name">Nome</label>
											<input type="text" placeholder="Digite seu nome" name="name" id="idea-subscribe-name">
										</div>

										<div class="form-row">
											<label for="idea-subscribe-email">E-mail</label>
											<input type="text" placeholder="Digite seu e-mail" name="email" id="idea-subscribe-name">
										</div>

										<div class="form-row">
											<label for="idea-subscribe-title">Título da ideia</label>
											<input type="text" name="title" id="idea-subscribe-title">
										</div>

										<div class="form-row">
											<label for="idea-subscribe-content">Descrição da ideia</label>
											<textarea name="content" id="idea-subscribe-content"></textarea>
										</div>

										<div class="form-row">
											<input class="btn" type="submit" value="enviar">
										</div>
									</form>

								</section>

								<footer class="article-footer">

                  <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

								</footer>

							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>
					
					<?php get_sidebar('banco-de-ideias'); ?>

				</div>

			</div>

</main>
<?php get_footer(); ?>
