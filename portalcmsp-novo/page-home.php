<?php
/*
 Template Name: Home Câmara
*/

//Save the template name so it's obtainable in the header
?>

<?php get_header(); ?>

		<h1 class="visually-hidden">Portal da Câmara Municipal de São Paulo</h1>
			<div id="content">
				<div id="inner-content" class="wrap cf">
						<div id="main" class="cf" role="main">

							<div class="cmsp-row">

								<div class="cmsp-left">
									<?php
										// Últimas Notícias
										get_template_part( 'content-boxes/box', 'latest-news' );
									?>
								</div>

								<div class="cmsp-right">
									<?php
										// Notícia em Destaque
										get_template_part( 'content-boxes/box', 'featured-article' );
									?>
								</div>

							</div><!-- end row -->

							<div class="cmsp-row">
								<?php
									// Banners Horizontal
									get_template_part( 'content-boxes/banners', 'row' );
								?>
							</div>

							<div class="cmsp-row">

								<div class="cmsp-left">
									<?php
										// Consulta Rápida
										get_template_part( 'content-boxes/box', 'quick-search' );
									?>
								</div>

								<div class="cmsp-right">
									<div class="box-half box-half-left">
										<?php
											// eventos
											get_template_part( 'content-boxes/box', 'events' );
										?>
									</div>

									<div class="box-half box-half-right">
										<?php
											// Últimas da Rede
											get_template_part( 'content-boxes/box', 'network-posts-only' );
										?>
									</div>

									<?php
										// Tour Virtual
										get_template_part( 'content-boxes/box', 'tour' );
									?>
								</div>

							</div><!-- end row -->

							<div class="cmsp-row">
								<div class="cmsp-left">
									<?php
										// Galeria Multimídia
										get_template_part( 'content-boxes/box', 'foto-do-dia' );
									?>
								</div>

								<div class="cmsp-right">

									<div class="box-half box-half-left">
										<?php
											// Saiba mais
											get_template_part( 'content-boxes/box', 'learn-more' );
										?>
									</div>

									<div class="box-half box-half-right">
										<?php
											// Banners Vertical
											get_template_part( 'content-boxes/banners', 'column' );
										?>
									</div>
								</div>

							</div><!-- end row -->

						</div>

				</div>

			</div>
</main>
<?php get_footer(); ?>
