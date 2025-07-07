<?php
/*
 Template Name: Audiências
*/
?>

<?php get_header(); ?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

<script>
	jQuery(document).ready(function($){
		$("div.accordion").accordion({
			heightStyle: "content",
			collapsible: true,
			active: false,
			animate: false
		});
	});
</script>

<style>
	.ui-accordion .ui-accordion-content{
		padding: .5em 1.2em;
	}
	.ui-accordion .ui-accordion-header{
		padding: .2em;
	}

	.ui-state-active,
	.ui-widget-content .ui-state-active,
	.ui-widget-header .ui-state-active,
	a.ui-button:active,
	.ui-button:active,
	.ui-button.ui-state-active:hover{
		border: 1px solid #7F1A22;
		background: #7F1A22;
		color: #fff !Important;
	}

	.accordion ul{
		list-style-type:none !important;
		overflow:hidden;
		padding-left: .5em !important;
	}
	.accordion li{
		padding-top: .5em !important;
	}
	.accordion a{
		text-decoration: none;
	}
	.accordion li a{
		text-decoration: underline;
	}
</style>

<div id="content">

	<div class="breadcrumbs cf">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p class="wrap cf">','</p>');
		} ?>
	</div>

	<div id="inner-content" class="wrap cf">
		<div id="main" class="two-column-main cf" role="main">

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>
				role="article" itemscope itemtype="http://schema.org/BlogPosting">

				<header class="article-header">
					<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
				</header>

				<section class="entry-content cf" itemprop="articleBody">
					<?php the_content();?>

					<div style="clear:both;"></div>

					<div class="accordion">
					<?php
					setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
					$posts = get_posts(array(
						'post_type'   => 'audiencia',
						'meta_key'    => 'data',
						'numberposts' => '-1',
						'orderby'     => array('data' => 'DESC')
					));

					$legislatura = "";      $sessLegislativa = "";      $ano = "";      $mes = "";      $dia = "";
					$legislatura_ant = "";  $sessLegislativa_ant = "";  $mes_ant = "";
					$legislatura_prox = ""; $sessLegislativa_prox = ""; $ano_prox = ""; $mes_prox = "";

					while ($current = current($posts) )
					{
					    $next = next($posts);

						$data = new DateTime(get_post_field('data', $current ));
						$data_prox = new DateTime(get_post_field('data', $next ));

						$ano = $data->format('Y');
						$mes = $data->format('M');
						$dia = $data->format('d');
						$legislatura = getLegislatura($ano);
						$sessLegislativa = getLegislativa($ano);
						$mes_exibicao = ucfirst(utf8_encode(strftime("%B", strtotime(get_field('data', $current)))));

						$ano_prox = $data_prox->format('Y');
						$mes_prox = $data_prox->format('M');
						$legislatura_prox = getLegislatura($ano_prox);
						$sessLegislativa_prox = getLegislativa($ano_prox);
					?>
						<?php if($legislatura != $legislatura_ant) : ?>
							<a href="#"><?=$legislatura?>ª Legislatura</a>
							<div class="accordion">
						<?php endif; //legislatura ?>

							<?php if($sessLegislativa != $sessLegislativa_ant) : ?>
								<a href="#"><?=$sessLegislativa?>ª Sessão Legislativa - <?=$ano?></a>
								<div class="accordion">
							<?php endif; //sessLegislativa ?>

								<?php if($mes != $mes_ant) : ?>
									<a href="#"><?=$mes_exibicao?></a>
									<div class="accordion">
								<?php endif; //mes ?>

									<a href="#">Dia <?=$dia?></a>
									<ul>
										<?php
											while (have_rows('documentos', $current)) : the_row();
												$file = get_sub_field('arquivo', $current);
											?>
												<li><a href="<?=$file['url']?>" target="_blank"><?=get_sub_field("titulo")?></a></li>
											<?php
											endwhile;
										?>
									</ul>

								<?php if($mes != $mes_prox) : ?>
									</div><!--mes-->
								<?php endif; //mes ?>

							<?php if($sessLegislativa != $sessLegislativa_prox) : ?>
								</div>
							<?php endif; //sessLegislativa ?>

						<?php
						//if(!$legislatura_opening && $legislatura != $legislatura_prox) : >>>>>>>>>>> GERA MUUUUITO NOTICE EM DEBUG.LOG REF A legislatura_opening, QUE NÃO DOI DECLARADA
						if($legislatura != $legislatura_prox) : 
						?>
							</div>
						<?php endif; //legislatura ?>

					<?php
						$mes_ant = $mes;
						$legislatura_ant = $legislatura;
						$sessLegislativa_ant = $sessLegislativa;
					}
					?>

				</section><?php //end article section ?>

				<footer class="article-footer cf">
					<em>Pesquisas por data de realização, assunto, número dos projetos ou leis discutidos, oradores, vereadores e entidades participantes podem ser também realizadas na Base de Dados de Audiências Públicas, disponível <a href="/biblioteca/audiencias/" rel="noopener noreferrer" target="_blank">aqui</a>.</em>
					<?php
					$page_downloads = get_post_meta($post->ID, '_cmsp_page_download-files', true);
					if(isset($page_downloads[0]['title'])):
					?>
						<section class="content-box box-downloads">
							<header class="content-box-top box-downloads-header">
								<h2 class="content-box-title icon-archives-red">Downloads</h2>
							</header>
							<ul class="box-downloads-list">
								<?php
								foreach($page_downloads as $file):
									$blank = false;
									if(isset($file['blank'])) {
										if($file['blank'] == 'on') $blank = true;
									}
								?>
									<li><a <?php if($blank) echo 'target="_blank"'; ?>
										href="<?=$file['file']?>"><?=$file['title']?></a></li>
								<?php endforeach;?>
							</ul>
						</section>
					<?php endif;?>
				</footer>

			</article>

		</div>
		<?php wp_reset_postdata(); ?>
		<?php get_sidebar('page'); ?>
	</div>

</div>
</main>
<?php get_footer();
function getLegislatura($ano) {
    $ano_inicial = 2009;
	$legislatura_inicial = 15;
	return $legislatura_inicial + floor(($ano-$ano_inicial)/4);
}

function getLegislativa($ano) {
    $ano_inicial = 2009;
	return 1 + ($ano-$ano_inicial)%4;
}
?>
