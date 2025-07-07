<?php
/*
 Template Name: Pesquisa Leis
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

									<?php the_content(); ?>

									<h1 class="page-title" itemprop="headline">Pesquisa de Leis</h1>

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

								<p>
									Utilize o formulário abaixo para pesquisar a Legislação Municipal: Leis, Decretos, Decretos Legislativos, Emendas à Lei Orgânica, Resoluções e Atos a partir de 1892 com acesso ao texto integral das normas.
								</p>
								<form action="#" method="post" name="leis" id="buscarForm">
									<input type="hidden" id="baseDados" value="legis" />
									<fieldset>
										<!--legend>Utilize ao menos um campo para realizar a pesquisa:</legend-->
										<br />
										<p id="textoAjuda" class="hidden has-error">
											Utilize ao menos um campo para realizar a pesquisa:
										</p>
										<fieldset>
											<div class="form-group">
												<div class="form-row">
													<label>Tipo de Norma:</label>
														<select id="projetoTipo" class="form-control">
															<option value="TODOS" selected="selected">Todos os tipos</option>
															<option value="&quot;LEI&quot;">Lei</option>
															<option value="&quot;DECRETO&quot;">Decreto</option>
															<option value="&quot;DECRETO LEGISLATIVO&quot;">Decreto Legislativo</option>
															<option value="&quot;DECRETO-LEI&quot;">Decreto-Lei</option>
															<option value="&quot;EMENDA&quot;">Emenda à Lei Orgânica</option>
															<option value="&quot;ATO DA CMSP&quot;">Ato da CMSP</option>
															<option value="&quot;ATO AMC&quot;">Ato AMC</option>
															<option value="&quot;ACTO&quot;">Acto</option>
															<option value="&quot;ACTO EXECUTIVO&quot;">Acto Executivo</option>
															<option value="&quot;ATO GOVERNO PROVISORIO&quot;">Ato do Governo Provisório</option>
															<option value="&quot;RESOLUCAO DA CMSP&quot;">Resolução da CMSP</option>
															<option value="&quot;RESOLUCAO AMC&quot;">Resolução AMC</option>
															<option value="&quot;RESOLUCAO&quot;">Resolução</option>
															<option value="&quot;MEMORANDO&quot;">Memorando</option>
															<option value="&quot;REQUERIMENTO&quot;">Requerimento</option>
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
									<a href="https://www.saopaulo.sp.leg.br/cgi-bin/wxis.bin/iah/scripts/?IsisScript=iah.xis&form=A&navBar=Off&hits=200&lang=pt&nextAction=search&base=legis"
										title="Página com formulário avançado de pesquisa na base de legislação" target="_blank">
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

							</article>

						</div>
					<!-- Sidebar -->
						<?php  wp_reset_query(); ?>
						<?php get_sidebar('page'); ?>
				</div>

			</div>
			
			
			
			<script>
				//*******************************************************************************************
				//
				// 2021-09-03 - SGP31 pediu reativação desta página via <laraobs@saopaulo.sp.leg.br>: feito por hvalois
				// 2021-09-08 - Porém, este antigo não estava funcionando. As funcões javascripts não estavam sendo carregadas.
				// SOLUÇÃO RÁPIDA: copiar o javascript para este template
				// PENDENTE: identificar onde o javascript era originalmente carregado
				//
				//*******************************************************************************************
				
				
				////src="https://www.saopaulo.sp.leg.br/library/js/iah-pesquisa.js"
				// limpar preposicoes da busca
				function limparPreposicoes(str) {
					str = str.replace(/ dos /gi, " ");
					str = str.replace(/ das /gi, " ");
					str = str.replace(/ do /gi, " ");
					str = str.replace(/ da /gi, " ");
					str = str.replace(/ de /gi, " ");
					str = str.replace(/ nos /gi, " ");
					str = str.replace(/ nas /gi, " ");
					str = str.replace(/ no /gi, " ");
					str = str.replace(/ na /gi, " ");
					str = str.replace(/ em /gi, " ");
					str = str.replace(/ aos /gi, " ");
					str = str.replace(/ às /gi, " ");
					str = str.replace(/ ao /gi, " ");
					str = str.replace(/ à /gi, " ");
					str = str.replace(/ a /gi, " ");
					str = str.replace(/ e /gi, " ");
					str = str.replace(/ o /gi, " ");
					str = str.replace(/ os /gi, " ");
					str = str.replace(/ as /gi, " ");
					return str;
				}

				function limparAcentos(str)
				{
					/*
					str = str.replace(/[ÀÁÂÃÄÅ]/,"A");
					str = str.replace(/[àáâãäå]/,"a");
					str = str.replace(/[ÈÉÊË]/,"E");
					str = str.replace(/[èéêë]/,"e");
					str = str.replace(/[ÌÍÎÏ]/,"I");
					str = str.replace(/[ìíîï]/,"i");
					str = str.replace(/[ÒÓÔÕÖ]/,"O");
					str = str.replace(/[òóôõö]/,"o");
					str = str.replace(/[ÙÚÛÜ]/,"U");
					str = str.replace(/[ùúûü]/,"u");
					str = str.replace(/[Ç]/,"C");
					str = str.replace(/[ç]/,"c");

					// o resto
					return str.replace(/[^a-z0-9 ]/gi,'');
					*/
					var r=str.toLowerCase();
					//r = r.replace(new RegExp("\\s", 'g'),"");
					r = r.replace(new RegExp("[àáâãäå]", 'g'),"a");
					r = r.replace(new RegExp("æ", 'g'),"ae");
					r = r.replace(new RegExp("ç", 'g'),"c");
					r = r.replace(new RegExp("[èéêë]", 'g'),"e");
					r = r.replace(new RegExp("[ìíîï]", 'g'),"i");
					r = r.replace(new RegExp("ñ", 'g'),"n");
					r = r.replace(new RegExp("[òóôõö]", 'g'),"o");
					r = r.replace(new RegExp("œ", 'g'),"oe");
					r = r.replace(new RegExp("[ùúûü]", 'g'),"u");
					r = r.replace(new RegExp("[ýÿ]", 'g'),"y");
					//r = r.replace(new RegExp("\\W", 'g'),"");
					return r;
				}

				var parExprSearch  = "&exprSearch=";
				var parIndexSearch = "&indexSearch=";
				var parEydatabase  = "%5EyDATABASE";

				var iahProjetoTipo = function(baseIah, inputProjetoTipo){
					var iahProjetoTipo = '';
					if (inputProjetoTipo === '') { iahProjetoTipo = "";
					} else {
						var parProjetoTipo = '';
						if (baseIah == "proje") { parProjetoTipo = "%5EnCm%5ELTipo+de+projeto%5Etshort%5Ex%2F20"; }
						if (baseIah == "legis") { parProjetoTipo = "%5EnTn%5ELTipo+de+norma%5Ex%2F5"; }
						if (inputProjetoTipo == "TODOS") { inputProjetoTipo = "$"; }
						iahProjetoTipo = parExprSearch + inputProjetoTipo + parIndexSearch + parProjetoTipo + parEydatabase;
					}
					return iahProjetoTipo;
				}

				var iahProjetoNumero = function(baseIah, inputProjetoNumero){
					var iahProjetoNumero = '';
					if (inputProjetoNumero === '') { iahProjetoNumero = "";
					} else {
						var parProjetoNumero = '';
						if (baseIah == "proje") { parProjetoNumero = "%5EnPj%5ELN%FAmero+do+projeto%5Ex%2F30"; }
						if (baseIah == "legis") { parProjetoNumero = "%5EnNn%5ELN%FAmero+da+norma%5Ex%2F6"; }
						iahProjetoNumero = parExprSearch + parseInt(inputProjetoNumero, 10) + parIndexSearch + parProjetoNumero + parEydatabase;
					}
					return iahProjetoNumero;
				}

				var iahProjetoAno = function(baseIah, inputProjetoAno){
					var iahProjetoAno = '';
					if (inputProjetoAno==='') { iahProjetoAno = "";
					} else {
						var parProjetoAno = '';
						if (baseIah == "proje") { parProjetoAno = "%5EnDp%5ELAno+do+projeto%5Ex%2F40%5Etshort"; }
						if (baseIah == "legis") { parProjetoAno = "%5EnDn%5ELAno+da+norma%5Ex%2F10"; }
						iahProjetoAno = parExprSearch + inputProjetoAno + parIndexSearch + parProjetoAno + parEydatabase;
					}
					return iahProjetoAno
				}

				var iahProjetoAutor = function(baseIah, inputProjetoAutor){
					var iahProjetoAutor = '';
					if (inputProjetoAutor==='') { iahProjetoAutor = "";
					} else {
						var parAutorNome = '';
						if (baseIah == "proje") { parAutorNome = "%5EnAu%5ELAutor+do+projeto%5Ex%2F50"; }
						if (baseIah == "legis") { parAutorNome = "%5EnAu%5ELAutor+do+projeto%5Ex%2F32"; }
						iahProjetoAutor = parExprSearch + inputProjetoAutor + parIndexSearch + parAutorNome + parEydatabase;
						//var parProjetoAutor = '';
						//if (baseIah == "proje") { parProjetoAutor = "%5EnAu%5ELAutor+do+projeto%5Ex%2F50"; }
						//if (baseIah == "legis") { parProjetoAutor = "%5EnAu%5ELAutor+da+norma%5Ex%2F32"; }
						//iahProjetoAutor = parExprSearch + inputProjetoAutor + parIndexSearch + parProjetoAutor + parEydatabase;
					}
					return iahProjetoAutor;
				}

				var iahProjetoAssunto = function(baseIah, inputProjetoAssunto){
					var iahProjetoAssunto;
					iahProjetoAssunto = limparAcentos(inputProjetoAssunto);
					iahProjetoAssunto = limparPreposicoes(iahProjetoAssunto);

					if (inputProjetoAssunto==='') { iahProjetoAssunto = "";
					} else {
						var assuntoPalavras = iahProjetoAssunto.split(" ");
						var contador=0;
						while (contador < assuntoPalavras.length) {
							// adaptacao para otimizacao do sistema (sugestao da marcia em 06/08/2010)
							var temp = assuntoPalavras[contador].substring(0, assuntoPalavras[contador].length);
							assuntoPalavras[contador] = "" + (temp) + "/(70)"; // assunto

							//somente base proje
							if (baseIah == "proje") {
								assuntoPalavras[contador] = assuntoPalavras[contador] + "%20OR%20" + (temp) + "/(71)"; // nome de logradouro
								assuntoPalavras[contador] = assuntoPalavras[contador] + "%20OR%20" + (temp) + "/(72)"; // homenageado
							}

							//substituido para ir ate ultimo caracter
							//assuntoPalavras[contador] = (assuntoPalavras[contador].substring(0,assuntoPalavras[contador].length));
							contador += 1;
						}
						//assuntoFrase = assuntoPalavras.join("$%20AND%20"); substituido para nao haver truncamento
						assuntoFrase = assuntoPalavras.join(")%20AND%20(");
						//iahProjetoAssunto = parExprSearch +       assuntoFrase +"$"  + parIndexSearch + "^nTw^LTodos+os+campos^2Todos+los+campos^3All+fields^yDATABASE^xALL+";  substituido para nao haver truncamento
						//iahProjetoAssunto = parExprSearch + "(" + assuntoFrase + ")" + parIndexSearch + "^nTw^LTodos+os+campos^2Todos+los+campos^3All+fields^yDATABASE^xALL+";
						iahProjetoAssunto =   parExprSearch + "(" + assuntoFrase + ")";// + parIndexSearch;
						//Procurar pelo termo completo Ex. Lei 14.485/2007 [08/04/2016]
						iahProjetoAssunto = iahProjetoAssunto + " OR (" + inputProjetoAssunto + ")" + parIndexSearch;
						iahProjetoAssunto = iahProjetoAssunto + "%5EnTw%5ELTodos+os+campos%5E2Todos+los+campos%5E3All+fields" + parEydatabase + "%5ExALL+";
					}
					return iahProjetoAssunto;
				}

				var montarLinkIah = function(baseIah, parProjetoTipo, parProjetoNumero, parProjetoAno, parProjetoAutor, parProjetoAssunto) {
					var domain = "https://www.saopaulo.sp.leg.br/cgi-bin/wxis.bin/iah/scripts/?IsisScript=iah.xis";
					var params = "&form=A&format=standard.pft&navBar=OFF&hits=200&lang=pt&nextAction=search&base=" + baseIah + "&conectSearch=init";
					var parAnd  = "&conectSearch=and";
					var URL = domain + params + iahProjetoTipo(baseIah, parProjetoTipo);
					if(parProjetoNumero !== "") URL += parAnd + iahProjetoNumero(baseIah, parProjetoNumero);
					if(parProjetoAno    !== "") URL += parAnd + iahProjetoAno(baseIah, parProjetoAno);
					if(typeof parProjetoAutor !== 'undefined'){
						if(parProjetoAutor !== "") URL += parAnd + iahProjetoAutor(baseIah, parProjetoAutor);
					}
					if(typeof parProjetoAssunto !== 'undefined'){
						if(parProjetoAssunto !== "") URL += parAnd + iahProjetoAssunto(baseIah, parProjetoAssunto.trim());
					}
					return URL;
				}

				function mostrarPopupIah(baseIah, parProjetoTipo, parProjetoNumero, parProjetoAno, parAutorNome, parAssunto) {
					var URL = montarLinkIah(baseIah, parProjetoTipo, parProjetoNumero, parProjetoAno, parAutorNome, parAssunto);
				//function mostrarPopupIah(baseIah, parProjetoTipo, parProjetoNumero, parProjetoAno, parProjetoAutor, parAssunto) {
					//var URL = montarLinkIah(baseIah, parProjetoTipo, parProjetoNumero, parProjetoAno, parProjetoAutor, parAssunto);
					var parPopup = "toolbar=0,scrollbars=1,location=no,statusbar=0,menubar=0,resizable=0,width=790,height=500,left=465,top=275";
					window.open(URL, "resultado", parPopup);
					//return false;
				}
			
			
			//src="https://www.saopaulo.sp.leg.br/library/js/iah-validacao.js"
			jQuery(document).ready(function($) {
				  resetVereadorAtual = function(){
					$("select#autorVereadorAtual option").filter(function() {
					  return $(this).val() == "default";
					}).attr("selected", true);
					$("#autorVereadorAtual").closest("div").addClass("hidden");
				  };
				  resetVereadorAnterior = function(){
					$("#autorVereadorAnterior").val("");
					$("#autorVereadorAnterior").closest("div").addClass("hidden");
				  };

				changeAuthorType = function(authorType){
				  switch(authorType){
					case "autorVereaAtual":
					  $("#autorVereadorAtual").closest("div").removeClass("hidden");
					  resetVereadorAnterior();
					break;
					case "autorVereaAnterior":
					  resetVereadorAtual();
					  $("#autorVereadorAnterior").closest("div").removeClass("hidden");
					break;
					default:
					  resetVereadorAtual();
					  resetVereadorAnterior();
				  }
				};

				validateForm = function(){
				  var isValid = true;
				  var projetoTipo = $("#projetoTipo").val();
				  var autorTipo = $("#autorTipo").val();
				  var autorVereadorAtual = $("#autorVereadorAtual").val();
				  if(
					  projetoTipo == "TODOS"      &&
					  !$("#projetoNumero").val()  &&
					  !$("#projetoAno").val()     &&
					  (
						(autorTipo == "default")  ||
						(autorTipo == "autorVereaAtual" && autorVereadorAtual == "default") ||
						//(autorTipo == "autorVereaAnterior" && !autorVereadorAtual)
						(autorTipo == "autorVereaAnterior" && !autorVereadorAnterior)
					  ) &&
					  !$("#assunto").val()
					)
				  {
					isValid = false;
					$("#textoAjuda").removeClass("hidden");
				  }
				  else
				  {
					isValid = true;
					$("#textoAjuda").addClass("hidden");
				  }

				  return isValid;
				};

				getAuthorName = function(){
				  var autorTipo = $("#autorTipo").find("option:selected").val();
				  var autorNome = "";
				  switch(autorTipo) {
					case "autorVereaAtual":
					  if(!($("#autorVereadorAtual").find("option:selected").val())){
						autorNome = $("#autorVereadorAtual").find("option:selected").text();
					  } else {
						autorNome = $("#autorVereadorAtual").find("option:selected").val();
					  }
					break;
					case "autorVereaAnterior":
					  autorNome = $("#autorVereadorAnteriorInput").val() + "$";
					break;
					case "autorExecutivo":
					  autorNome = "EXECUTIVO";
					break;
					case "autorMesa":
					  autorNome = "MESA";
					break;
				  }
				  return autorNome;
				};

				  setFieldMasks = function(){
					$("#projetoNumero"  ).mask("?99999",   {placeholder:""});
					$("#projetoAno"  ).mask("9999",   {placeholder:""});
				  }();

				  $("#autorTipo").change(function(){
					var authorType = $(this).find("option:selected").val();
					changeAuthorType(authorType);
				  });

				  $("#limparBtn").click(function(){
					resetVereadorAtual();
					resetVereadorAnterior();
					$("#buscarForm")[0].reset();
				  });

				  $("#buscarBtn").click(function(){
						if(validateForm()){
							var baseDados = $("#baseDados").val();
							var projetoTipo = $("#projetoTipo").find("option:selected").val();
							var projetoNumero = $.trim($("#projetoNumero").val());
							var projetoAno = $.trim($("#projetoAno").val());
							var autorNome = getAuthorName();
							var assunto = $("#assunto").val();
							if (assunto instanceof String) {
							  assunto.trim();
							}
							mostrarPopupIah(baseDados, projetoTipo, projetoNumero, projetoAno, autorNome, assunto);
						}
					});
				});
			</script>
</main>
<?php get_footer(); ?>
