<?php
/*
 Template Name: Assessoria Juridica COVID19
*/
define('DONOTCACHEPAGE', true);
date_default_timezone_set("America/Sao_Paulo");
?>

<?php get_header(); ?>

	<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="breadcrumbs cf">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p class="wrap cf">','</p>');
				} ?>
			</div>

			<div class="section-title">
				<h2 class="wrap icon-clock-large-red"><?php the_title();?></h2>
			</div>

			<div id="inner-content" class="wrap cf">

				<div id="main" class="cf" role="main">

					<article id="post-<?php the_ID();?>" <?php post_class('cf');?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						<!--header class="article-header">
							<h1 class="page-title" itemprop="headline">Pareceres / Manifestações (COVID-19)</h1>
						</header--> 

						<section class="entry-content cf" itemprop="articleBody">
							<p>Aqui você encontra manifestações da Procuradoria relacionadas ao Coronavírus (COVID-19)</p>
							<div class="agenda-events-list" data-when="today">
								<article>
									<?php
										$args = array(
											'posts_per_page'	=> -1,
											'post_type'			=> 'assessoria_juridica',
											'meta_key'			=> 'tipo',
											'meta_query'		=> array(
												array(
													'key' 		=> 'tipo',
													'value'		=> 'covid19',
													'compare' 	=> '='
												),
											),
											'orderby' => array(
												'ano' => 'DESC',
												'numero' => 'DESC',
											)
										);
										
										$the_query = new WP_Query( $args );
										
										if (!$the_query->have_posts() ) {
											
											echo "<p>Não foram encontradas manifestações da Procuradoria relacionadas ao Coronavírus (COVID-19)</p>";
											
										} else {
											
											//Listar pareceres
											while ( $the_query->have_posts() ) {
												
												$the_query->the_post();

												$numero = ( empty(get_field("numero")) ? "(sem nro.)" : get_field("numero") );
												$ano = get_field("ano");
												$resumo = get_field("resumo");
												$post_title = "Parecer n&deg; $numero/$ano";
												?>
												<hr/>
												<div class="item-title">
													<h4>
														<a class="card-title" href="<?=get_home_url()?>/?p=<?=$post->ID?>" target="_blank"><?=get_the_title()?></a><br/>
														<!--a class="card-title" href="<?=get_home_url()?>/?p=<?=$post->ID?>" target="_blank"><?=$post_title?></a><br/-->
													</h4>
												</div>
												<div class="item-content">
													<p><span style="font-weight:bold;">Resumo: </span><?=$resumo?></p>
												</div>
												<?php
											}
											
										}
											
										?>
										
									</article>
									</div>
								</section>
							</article>

						</div>
				</div>

		<?php endwhile; endif;?>
	</div>
	</main>
<?php get_footer();?>
