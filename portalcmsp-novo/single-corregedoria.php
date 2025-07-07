<?php get_header(); ?>

			<div id="content">

				<div class="breadcrumbs cf">
					<?php if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p class="wrap cf">','</p>');
					} ?>
				</div>

				<div id="inner-content" class="wrap cf">
					<div id="main" class="cf" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post();?>

						<article id="post-<?php the_ID();?>" <?php post_class('cf');?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

							<header class="article-header">
								<h2 class="page-title" itemprop="headline"><?php the_title();?></h2>
								<br/><b>Corregedor Geral:</b><br/>
								<?php
									$inicio = new DateTime(get_field('data_de_inicio'));
									$termino = new DateTime(get_field('data_de_termino'));
									foreach( get_field('corregedor') as $p ){
										 ?>
										 <a href="<?=get_home_url()?>/?p=<?=$p->ID?>" target="_blank"><?=get_the_title($p->ID)?></a><br/>
										 <?php
									}?>
									<br/><b>Demais Membros:</b><br/>
									<?php
									foreach( get_field('membros_da_corregedoria') as $p ){
										?>
										<a href="<?=get_home_url()?>/?p=<?=$p->ID?>" target="_blank"><?=get_the_title($p->ID)?></a><br/>
										<?php
									}
									?>
									<br/>
									<b>Atribuições:</b> <?=get_field( "atribuições" )?><br/><br/>
									<b>Data de início:</b> <?=$inicio->format('d/m/Y')?><br/>
									<b>Data de término:</b> <?=$termino->format('d/m/Y')?><br/><br/>
									<?php
									while ( have_rows('arquivos') ) : the_row();
										$file = get_sub_field('arquivo');
										?>
										<a href="<?=$file['url']?>" target="_blank"><?= get_sub_field("descrição_do_arquivo")?></a><br/>
										<?php
									endwhile;
								?>
								<br/>
							</header>

							<section class="entry-content cf" itemprop="articleBody">
							</section>

						</article>
						<?php endwhile; else : ?>

						<article id="post-not-found" class="hentry cf">
							<header class="article-header">
								<h1><?php _e( 'Oops, Post Não Encontrado!', 'bonestheme' ); ?></h1>
							</header>
							<section class="entry-content">
								<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
							</section>
							<footer class="article-footer">
								<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
							</footer>
						</article>

						<?php endif; ?>

					</div>
				</div>

			</div>

<?php get_footer(); ?>
