<?php get_header(); ?>

	<div id="content">

		<div class="breadcrumbs cf">
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p class="wrap cf">','</p>');
			}?>
		</div>

		<div id="inner-content" class="wrap cf">
			<div id="main" class="cf" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post();?>

				<?php
                    $tipo = get_field("tipo");
                    $numero = ( empty(get_field("numero")) ? "(sem nro.)" : get_field("numero") );
                    $ano = get_field("ano");
                    $descricao = get_field("descricao");
                    $palavrasChave = get_field("palavras-chave");

                    $post_title = get_the_title($post);

                    if($tipo == "parecer")  $post_title = "Parecer n&deg; $numero/$ano";
                    if($tipo == "adin")     $post_title = "ADIN n&deg; $numero";
				?>

				<article id="post-<?php the_ID();?>" <?php post_class('cf');?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					<header class="article-header">
						<h2 class="page-title" itemprop="headline"><?=$post_title?></h2>
					</header>

					<section class="entry-content cf" itemprop="articleBody">
						<p><?=$descricao?></p><br/>
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
