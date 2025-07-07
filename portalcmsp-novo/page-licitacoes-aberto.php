<?php
/*
 Template Name: Home Editais em Aberto
*/
?>

<?php get_header(); ?>
<script>
jQuery(document).ready(function($){
	//Initially hide all the item-content
    $('.item-content').hide();
    
    // Attach a click event to item-title
    $('.item-title').on('click', function (e) {
		e.preventDefault();
        //Find the next element having class item-content
        $(this).next('.item-content').toggle();
    });
	//$('#ano-atual').show();
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

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						<header class="article-header">

							<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

						</header> <?php // end article header ?>

						<section class="entry-content cf" itemprop="articleBody">
						<?php the_content();?>
						<div style="clear:both;"></div>
						<div>
							<!--<p>O "Edital" é o documento por meio do qual a Câmara Municipal de São Paulo estabelece as condições da licitação e as características do produto a ser adquirido ou do serviço a ser prestado.</p>
 
							<p>As informações disponíveis ao público apontam os requisitos para participação e respectivos prazos. Aqui, o internauta encontrará também as licitações que estão suspensas, mas que serão republicadas pela Câmara.</p>
 
							<p><b>O que é "Licitação"?</b></p>
 
							<p>A licitação é o instrumento do qual os poderes Executivos ou Legislativos lançam mão para adquirir produtos ou contratar serviços de quaisquer natureza. O processo licitatório tem como meta seguir os princípios da legalidade, da isonomia, da impessoalidade, da moralidade, da publicidade e da eficiência, com o objetivo de proporcionar a compra ou a prestação de serviços de forma vantajosa, ou seja, menos onerosa e com melhor qualidade possível.
								O artigo 37, inciso XXI, da Constituição Federal determina a obrigatoriedade da licitação nos poderes públicos no exercício de suas funções. A regulamentação é determinada pela Lei Municipal nº 13.278 de 7 de janeiro de 2002, no que for compatível com o disposto na Lei Federal nº 8.666/93, com alterações introduzidas pelas Leis Federais nº 8.883/94 e nº 9.648/98, bem como nos termos das Resoluções da Câmara Municipal de São Paulo nº 05/95 e nº 09/95.</p>
 
							<p><b>Modalidades de licitação:</b></p>
							
							<table>
								<tr>
									<th>LIMITES PECUNIÁRIOS ADOTADOS PARA FINS DE ESTABELECIMENTO DE MODALIDADES LICITATÓRIAS</th>
								</tr>
								<tr>
									<td colspan="3">I - PARA OBRAS E SERVIÇOS DE ENGENHARIA:</td>
								</tr>
								<tr>
									<td>Dispensa</td>
									<td>até</td>
									<td>R$ 15.000,00</td>								
								</tr>
								<tr>
									<td>Convite</td>
									<td>até</td>
									<td>R$ 150.000,00</td>								
								</tr>
								<tr>
									<td>Tomada de Preços</td>
									<td>até</td>
									<td>R$ 1.500.000,00</td>								
								</tr>
								<tr>
									<td>Concorrência</td>
									<td>acima de</td>
									<td>R$ 1.500.000,00</td>								
								</tr>
								<tr>
									<td colspan="3">II - PARA COMPRAS E SERVIÇOS:</td>
								</tr>
								<tr>
									<td>PREGÃO</td>
									<td colspan="2">QUALQUER VALOR</td>								
								</tr>
								<tr>
									<td>Dispensa</td>
									<td>até</td>
									<td>R$ 8.000,00</td>								
								</tr>
								<tr>
									<td>Convite</td>
									<td>até</td>
									<td>R$ 80.000,00</td>								
								</tr>
								<tr>
									<td>Tomada de Preços</td>
									<td>até</td>
									<td>R$ 650.000,00</td>								
								</tr>
								<tr>
									<td>Concorrência</td>
									<td>acima de</td>
									<td>R$ 650.000,00</td>								
								</tr>							
							</table>
							-->
							<p>"Nas próximas páginas, o fornecedor poderá baixar os editais que estão em aberto, para participar das licitações da Câmara".</p>
						</div>
						<?php
						setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
						$posts = get_posts(array(
							'post_type'  => 'licitacao',
							'orderby'    => array(
												'order_ano' => 'DESC',
												'order_numero' => 'DESC',
												),
							'numberposts' => '-1',
							'meta_query'	=> array(
								'relation'		=> 'AND',
								array(
									'key'	 	=> 'status',
									'value'	  	=> 'Aberto',
									'compare' 	=> '=',
								),
								array(
									'key'	  	=> 'tipo',
									'value'	  	=> 'DISPENSA ELETRÔNICA',
									'compare' 	=> '!=',
								),
								array(
									'key'	  	=> 'tipo',
									'value'	  	=> 'DISPENSA LEI 17355-20',
									'compare' 	=> '!=',
								),
								'order_ano' => array(
									'key' => 'ano',
									'compare' => 'EXISTS'
								),
								'order_numero' => array(
									'key' => 'numero',
									'compare' => 'EXISTS',
									'type' => 'NUMERIC'
								)
							)
							
							
							/**'meta_query' => array(
												array(
													'key' => 'status',
													'value' => 'Aberto'
												),
												'order_ano' => array(
													'key' => 'ano',
													'compare' => 'EXISTS'
												),
												'order_numero' => array(
													'key' => 'numero',
													'compare' => 'EXISTS',
													'type' => 'NUMERIC'
												)
										)*/
						));						
						?>
						
						<?php
						foreach ($posts as $post) { 					  ?>
							<div style="border: 1px #ccc solid; padding: 15px; margin: 10px 0px 10px 0px;">
								<b><?php the_title(); ?></b><br/>
								<div style="margin: 10px 0px 10px 0px;"><?php the_field('descricao') ?></div>
								<?php
								$observacao = get_field('observacao');
								if ($observacao) { ?>
									<span style="font-size: .9em;line-height:200%;"><?=$observacao?></span><br/>
								<?php } ?>
								<div style="padding-left: 10px;">
								<!--<ul>-->
								<?php
								// get repeater field data
								$repeater = get_field('anexos');

								// vars
								$order = array();

								// populate order
								foreach( $repeater as $i => $row ) {
									
									$order[ $i ] = $row['data'];
									
								}

								// multisort
								array_multisort( $order, SORT_DESC, $repeater );

								// loop through repeater
								if( $repeater ): ?>

									<ul>

									<?php foreach( $repeater as $i => $row ): 
										$a_file = $row['arquivo'];												
										$a_data = new DateTime($row['data']);
										$a_titulo =  $row['titulo'];
										$a_descricao =  $row['descricao'];
										$a_observacao =  $row['observacao'];
										$a_nome = $a_data->format('d/m/Y').' - '.$a_titulo.' - '.$a_descricao;
										?>
										<div style="margin-top: 10px;">
											<li><a href="<?=$a_file['url'];?>" target="_blank"><?=$a_nome?></a></li>
											<b style="font-size: .9em;"><?=$a_observacao?></b>
										</div> 

									<?php endforeach; ?>

									</ul>

								<?php endif; ?>		
								<?php
								//while (have_rows('anexos')) : the_row();
								//	$a_file = get_sub_field('arquivo');												
								//	$a_data = new DateTime(get_sub_field('data'));
								//	$a_titulo = get_sub_field('titulo');
								//	$a_descricao = get_sub_field('descricao');
								//	$a_observacao = get_sub_field('observacao');
								//	$a_nome = $a_data->format('d/m/Y').' - '.$a_titulo.' - '.$a_descricao;
									?>
								<!--	<div style="margin-top: 10px;">
									<li><a href="<?php //$a_file['url']?>" target="_blank"><?php //$a_nome?></a></li>
									<b style="font-size: .9em;"><?php //$a_observacao?></b>
									</div>--> 
									<?php
								//endwhile;
								?>
								<!--</ul>-->
								</div>
							</div>
						<?php } ?>					
						
							<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
						</section> <?php // end article section ?>

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
											<li><a <?php if($blank) echo 'target="_blank" '; ?> href="<?php echo $file['file']; ?>"><?php echo $file['title']; ?></a></li>
										<?php endforeach; ?>
									</ul>
								</section>
							<?php endif; ?>
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
										<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
								</footer>
							</article>

					<?php endif; ?>

				</div>
				<?php
				// if social media page is parent, show social media sidebar
				$social_page_id = 23867;
				if(in_array($social_page_id, $post->ancestors)):
					get_sidebar('buddypress');
				else:
					get_sidebar('page');
				endif;
				?>

		</div>

	</div>
</main>
<?php get_footer(); ?>
