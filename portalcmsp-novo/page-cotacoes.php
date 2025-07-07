<?php
/*
 Template Name: Cotações
*/
?>

<?php get_header(); ?>

	 <script>
	jQuery(document).ready(function($){
        $('.tree').treegrid({
          initialState: 'collapsed'
        });
      });
    </script>
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
					</header><?php //end article header ?>

					<section class="entry-content cf" itemprop="articleBody">
						<?php the_content();?>
						<div style="clear:both;"></div>
						<h3>COTAÇÕES EM ABERTO</h3>
						<p>As cotações deverão ser enviadas exclusivamente para o email cotacao@saopaulo.sp.leg.br</p>
						<p>As cotações deverão ser enviadas exclusivamente com o nome no campo "assunto" constante da folha de pesquisa.</p>
						<p>Dúvidas quanto a utilização do site ligue para (11) 3396-4436 ou 3396-4868.</p>

						<table class="tree">
						<?php
						setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
						$posts = get_posts(array(
							'post_type'  => 'cotacao',
							'meta_key'  => 'data_inicio',
							'meta_query' => array(
											array(
												'key' => 'Status',
												'value' => 'Aberta',
											),
										),
							'numberposts' => '-1',
							'orderby'    => array('data_inicio' => 'DESC')
						));

						$ano = "";
						$mes = "";
						$dia = "";
						$i=0;
						//ids de cada folha da árvore
						$ano_id=0;
						$mes_id=0;
						$dia_id=0;
						$aud_id=0;
						$legis_id=0;
						$legislatura='';
						foreach ($posts as $post) {
							$data_inicio = new DateTime(get_field('data_inicio'));
							$data_fim = new DateTime(get_field('data_fim'));

							echo "<h4><u>Nº Cotação Pesquisa: ".get_field('n_cotacao_pesquisa')."</u></h4>";
							echo "<div style='font-size: .75em'>";
							echo "<span><b>N° do Processo: </b>".get_field('n_do_processo')."</span><br>";
							echo "<span><b>Tipo de Solicitação: </b>".get_field('tipo_de_solicitacao')."</span><br>";
							echo "<span><b>Data Início: </b>".$data_inicio->format("d/m/Y")." - <b>Data Fim: </b>".$data_fim->format("d/m/Y")."</span><br>";
							if(!empty(get_field('descricao'))){
								echo "<span><b>Descrição: </b>".get_field('descricao')."</span><br>";
							}
							if(!empty(get_field('observacao'))){
								echo "<span><b>Observação: </b>".get_field('observacao')."</span><br>";
							}
							echo "<ul>";

							while (have_rows('anexos')) : the_row();
								$file = get_sub_field('arquivo');
								$data = new DateTime(get_field('data'));
								$descricao = !empty(get_sub_field('descricao')) ? " - ". get_sub_field('descricao') : '';

								echo "<li>".$data->format('d/m/Y');
								echo " - <a href='".$file["url"]. "'target='_blank'>".get_sub_field("titulo")."</a>".$descricao."</li>";

								if(!empty(get_sub_field('observacao'))){
									echo "<br>(<i>".get_sub_field(observacao)."</i>)";
								}

							endwhile;

							echo "</ul>";
							echo "</div>";
							echo "<hr/>";
						}
						?>
						</table>

					</section><?php //end article section ?>

					<footer class="article-footer cf">
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
									if(isset($file['blank'])){
										if($file['blank'] == 'on') $blank = true;
									}
									?>
									<li>
										<a <?php if($blank) echo 'target="_blank"'; ?> href="<?php echo $file['file']; ?>">
											<?php echo $file['title']; ?>
										</a>
									</li>
									<?php endforeach;?>
								</ul>
							</section>
						<?php endif;?>
					</footer>

				</article>
<?php  wp_reset_postdata(); ?>

			</div>
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
