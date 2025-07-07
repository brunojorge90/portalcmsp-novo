<?php
/*
 Template Name: Home Historico dos Contratos de Comunicacao
*/
?>

<?php get_header(); ?>
<style>
.indent {
    padding: 0px 0px 0px 35px;
}
th, td {
    text-align: right;
	line-height: 10px;
	width: 50%;
}
.seccol {
	text-align: center;
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

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

								</header> <?php // end article header ?>

								<section class="entry-content cf" itemprop="articleBody">
								<?php the_content();?>
								<div style="clear:both;"></div>
								
								<?php
										$args = array(
											'post_type'  => 'contrato_comunicacao',
											'orderby'    => array(
																'order_ano' => 'DESC',
																'order_numero' => 'DESC',
																),
											'numberposts' => '-1',
											'meta_query' => array(
																array(
																	'key' => 'ativo',
																	'value' => 0
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
											//'posts_per_page'	=> -1,
											//'post_type'			=> 'contrato_comunicacao',
											//'meta_key'		    => 'ano',
											//'orderby'           => 'meta_value',
											//'order'             => 'DESC'
										);	
	
										$the_query = new WP_Query( $args ); ?>
										
										<?php if( $the_query->have_posts() ): ?>
											
											<?php while( $the_query->have_posts() ) : $the_query->the_post(); 
													$raw_sign = new DateTime(get_field('data_da_assinatura'));
													$raw_start = new DateTime(get_field('inicio_vigencia'));
													$raw_end = new DateTime(get_field('fim_vigencia'));
													?>													
													<div style="padding: 0px 0px 10px 0px; font-size: .9em;">
														<h3 style="font-size: large;"><b><?php the_title(); ?></b></h3>
														Contratada<br/>
														<div class="indent"><?php the_field('contratada'); ?></div>
														Objeto<br/>
														<div class="indent"><?php the_field('objeto'); ?></div>
														Valor<br/>
														<div class="indent">R$ <?php the_field('valor'); ?></div>
														Empenho<br/>
														<div class="indent"><?php the_field('empenho'); ?></div>
														Verba<br/>
														<div class="indent"><?php the_field('verba'); ?></div>
														Data da assinatura<br/>
														<div class="indent"><?=$raw_sign->format('d/m/Y')?></div>
														Período de vigência<br/>
														<div class="indent"><?=$raw_start->format('d/m/Y')?> a <?=$raw_end->format('d/m/Y')?></div>
														<?php
														$termo = get_field('termo_de_contrato'); ?>
														Íntegra do termo de contrato<br/>
														<div class="indent"><a href="<?=$termo['url']?>" target="_blank">Termo de Contrato</a></div>
													</div>
													<div>
													<?php
													while (have_rows('aditamentos')) : the_row();												
														$numero = get_sub_field('numero');
														$valor = get_sub_field('valor');
														$verba = get_sub_field('verba');
														$empenho = get_sub_field('empenho');
														$data_da_assinatura = get_sub_field('data_da_assinatura');
														if ($data_da_assinatura != ''){
															$assinatura = new DateTime(get_sub_field('data_da_assinatura'));
															$data_da_assinatura = $assinatura->format('d/m/Y');;
														}	
														$inicio_vigencia = get_sub_field('inicio_vigencia');
														if ($inicio_vigencia != ''){
															$inicio = new Datetime(get_sub_field('inicio_vigencia'));
															$inicio_vigencia = $inicio->format('d/m/Y');
														}
														$fim_vigencia = get_sub_field('fim_vigencia');
														if ($fim_vigencia != ''){
															$fim = new DateTime(get_sub_field('fim_vigencia'));	
															$fim_vigencia = $fim->format('d/m/Y');		
														}											
														$adita_arquivo = get_sub_field('arquivo');
														if (strpos($adita_arquivo['url'], 'pdf') == false){
															continue;
														}
														
														?>
														<table id="<?=$numero?>" style="font-size: .9em;">
															<caption align="left" style="text-align: left; color:#333">Aditamento nº <?=$numero?></caption>
															<tr>
																<td><b>Valor:</b></td>
																<td class="seccol">R$ <?=$valor?></td>
															</tr>
															<tr>
																<td><b>Empenho:</b></td>
																<td class="seccol"><?=$empenho?></td>
															</tr>
															<tr>
																<td><b>Verba:</b></td>
																<td class="seccol"><?=$verba?></td>
															</tr>
															<tr>
																<td><b>Data da assinatura:</b></td>
																<td class="seccol"><?=$data_da_assinatura?></td>
															</tr>
															<tr>
																<td><b>Período de vigência:</b></td>					
																<td class="seccol"><?php echo ($inicio_vigencia == ''?'': $inicio_vigencia.' a '.$fim_vigencia);?></td>
															</tr>
															<tr>
																<td><b>Íntegra do termo de aditamento:</b></td>
																<td class="seccol"><a href="<?=$adita_arquivo['url']?>" target="_blank">Termo de Aditamento</a></td>
															</tr>
														</table>
														<?php
													endwhile;
													?>
													</div>												
													<?php
													if (have_rows('planilhas')) { ?>
														<p><b>Planilhas de composição de custos apresentadas pela contratada e/ou para atender a Lei Federal 12.232/2010:</b></p>
													<?php } ?>
													<div style="padding: 0px 0px 0px 30px;">
														<?php
														// get repeater field data
														$repeater = get_field('planilhas');
														
														//prosseguir se houver planilhas
														if( $repeater ):

														// vars
														$order = array();

														// populate order
														foreach( $repeater as $i => $row ) {
															
															$order[ $i ] = $row['data'];
															
														}

														// multisort
														array_multisort( $order, SORT_DESC, $repeater );
														setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
														
														// loop through repeater
														?>													
															<ul style="font-size: .9em;">

															<?php foreach( $repeater as $i => $row ): 												
																	$raw_data = new DateTime($row['data']);
																	$observacao = $row['observacao'];
																	$planilha_arquivo = $row['arquivo'];
																	//$verba = $row['verba'];
																	$mes_ref = utf8_encode(strftime("%B/%Y",$raw_data->getTimestamp()));
																	//$mes_ref = strftime("%B/%Y",$raw_data);
																?>
																	<li><a href="<?=$planilha_arquivo['url'];?>" target="_blank"><?=$mes_ref?></a></li> 

															<?php endforeach; ?>
															</ul>	
															<p style="font-style: italic;">Informações de controle em conformidade com Lei Federal nº 12.232/2010</p>
														<?php endif; ?>
													</div>
													<hr/>
											<?php endwhile; ?>
											
										<?php endif; ?>
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
