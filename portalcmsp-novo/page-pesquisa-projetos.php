<?php
/*
 Template Name: Pesquisa Projetos
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
				<h2 class="wrap icon-clock-large-red"><?php the_title(); ?></h2>
			</div>

				<div id="inner-content" class="wrap cf">

						<div id="main" class="two-column-main cf" role="main">

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline">Pesquisa de Projetos</h1>

								</header>
								<?php
									$defaultArgs = array(
										'post_type' => 'vereador',
										'posts_per_page' => -1,
										'meta_key' => '_cmsp_vereador_ativo',
										'orderby' => 'title',
										'order' => 'ASC'
									);
									$vereadores = new WP_Query($defaultArgs);
								?>

								<section class="entry-content cf" itemprop="articleBody">
								<h3>Pesquisa de Projetos no Novo Sistema do Processo Legislativo, a partir de 1991:</h3>
								<a href="https://splegisconsulta.saopaulo.sp.leg.br/" target="_blank">Link para pesquisas no Sistema do Processo Legislativo - SPLEGIS</a>
								<br/>
								<br/>
								<h3>Pesquisa de Projetos na Base de Dados da Biblioteca, a partir de 1948:</h3>
								<p>
									Utilize o formulário abaixo para pesquisar Projetos de Lei, de Resolução, de Decreto Legislativo e de Emenda à Lei Orgânica, desde 1948, <i>após leitura em Plenário e publicação em Diário Oficial</i>.
								</p>
								<form action="#" method="post" name="leis" id="buscarForm">
									<input type="hidden" id="baseDados" value="proje" />
									<fieldset>
										<!--legend>Utilize ao menos um campo para realizar a pesquisa:</legend-->
										<br />
										<p id="textoAjuda" class="hidden has-error">
											Utilize ao menos um campo para realizar a pesquisa:
										</p>
										<fieldset>
											<div class="form-group">
												<div class="form-row">
													<label>Tipo de Projeto:</label>
													<select id="projetoTipo" class="form-control">
														<option value="TODOS" selected="selected">Todos os tipos</option>
														<option value="&quot;PROJETO DE LEI&quot;">Projeto de Lei</option>
														<option value="&quot;PROJETO DE EMENDA A LEI ORGANI&quot;">Projeto de Emenda à Lei Orgânica</option>
														<option value="&quot;PROJETO DE DECRETO LEGISLATIVO&quot;">Projeto de Decreto Legislativo</option>
														<option value="&quot;PROJETO DE RESOLUCAO&quot;">Projeto de Resolução</option>
														<!--<option value='%22OFICIO%22'>Ofício</option-->
														<!--option value='%22MEMORANDO%22'>Memorando</option>-->
													</select>
												</div>
												<div class="form-row">
													<label>Número:</label>
													<input type="text" id="projetoNumero" size="5" maxlength="5" class="form-control" />
												</div>
												<div class="form-row">
													<label>Ano:</label>
													<input type="text" id="projetoAno" size="4" maxlength="4" class="form-control" />
												</div>
											</div>
											<div class="form-group">
												<div class="form-row">
													<label>Autor da norma:</label>
														<select id="autorTipo" class="form-control">
															<option value="default" selected="selected"><em>(selecione)</em></option>
															<option value="autorVereaAtual">Vereador - legislatura atual</option>
															<option value="autorVereaAnterior">Vereador - legislatura anterior</option>
															<option value="autorExecutivo">Executivo</option>
															<option value="autorMesa">Mesa da Câmara</option>
														</select>
													<div id="autorVereadorAtual"  class="hidden">
														<label>Selecione o vereador (legislatura atual):</label>
														<select class="form-control">
															<option value="default" selected="selected"><em>(selecione)</em></option>
														<?php
															while($vereadores->have_posts()): $vereadores->the_post();
																$nome_biblioteca = get_post_meta($post->ID,'_cmsp_vereador_nome_biblioteca', true);
																$nome_parlamentar = get_post_meta($post->ID,'_cmsp_vereador_name', true);
																echo '<option value="'.$nome_biblioteca.'">'.$nome_parlamentar.'</option>';
															endwhile;
														?>
														</select>

													</div>
													<div id="autorVereadorAnterior" class="hidden">
														<label>Nome do vereador (legislaturas anteriores):</label>
														<input id="autorVereadorAnteriorInput" type="text" size="48" maxlength="48" class="form-control" />
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="form-row">
													<label>
														Palavras relacionadas ao assunto procurado:</label>
														<input type="text" id="assunto" size="48" maxlength="48" class="form-control" />
												</div>
											</div>
										</fieldset>
									</fieldset>
								</form>

								<button class="btn btn-danger" id="buscarBtn">
									<span class="glyphicon glyphicon-search"></span>&nbsp;Pesquisar
								</button>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<button class="btn btn-info" id="limparBtn">
									<span class="glyphicon glyphicon-erase"></span>&nbsp;Limpar formulário
								</button>
								<br />
								<br />

								<h4>Dicas para preenchimento</h4>
								<p>
									<ul>
										<li><strong>Se a pesquisa não estiver aparecendo, verifique seu bloqueador de pop-ups.</strong></li>
										<li>Utilize apenas espaços entre as palavras. Não utilize barras ( / ).</li>
										<li>Use o símbolo de truncagem "<strong>$</strong>" (cifrão) para pesquisar palavras com mesma raiz.
											<br /> Exemplo: "lanch<strong>$</strong>" recupera "lanche", "lancheteria", "lanchonete", etc.</li>
										<li>Não digite operadores booleanos (<em>AND</em>, <em>OR</em> ou <em>AND NOT</em>) entre as palavras.</li>
										<li>Para visualizar os documentos correlatos, clique no número da lei ou norma desejada na lista de resultados.</li>
									</ul>
								</p>
								<br />

								<h4>Outros formulários para pesquisa</h4>
								<p>
									<a href="https://www.saopaulo.sp.leg.br/ipdbv/por/menu.html" target="_blank"
										title="Página com facilidades para acesso por deficientes visuais">
										Página com facilidades para acesso por deficientes visuais</a>.
									<br />
									<a href="https://www.saopaulo.sp.leg.br/cgi-bin/wxis.bin/iah/scripts/?IsisScript=iah.xis&form=A&navBar=Off&hits=200&lang=pt&nextAction=search&base=proje"
										title="Página com formulário avançado de pesquisa na base de projetos" target="_blank">
										Formulário avançado de pesquisa</a>.
								</p>
								<br />

								<h4>Dúvidas</h4>
								<p>
									Em caso de dúvidas na pesquisa, entrar em contato com:
									<br />
									<address>
										Secretaria de Documentação da Câmara Municipal de São Paulo (SGP.3)
										<br /> Equipe de Documentação do Legislativo (SGP.31)
										<br /> Telefones: (11)3396-5357, (11)3396-5360, (11)3396-4984, (11)3396-4549
										<br /> E-mail: <a href="mailto:atendimentodoc@saopaulo.sp.leg.br">atendimentodoc@saopaulo.sp.leg.br</a>
									</address>
								</p>

								</section>

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

						</div>
					<!-- Sidebar -->
						<?php get_sidebar('page'); ?>
				</div>

			</div>
</main>
<?php get_footer(); ?>
