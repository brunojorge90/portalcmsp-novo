<?php
/*
 Template Name: Mapa do Site
 *
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
					<h2 class="wrap icon-lightbulb-large-red">Mapa do Site</h2>
				</div>

				<div id="inner-content" class="wrap cf">

						<div id="main" class="cf" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<!--header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>

								</header-->

								<section class="entry-content cf" itemprop="articleBody">

									<section class="content-box box-nav-menu box-mapa">
										<header class="content-box-top">
											<h2 class="content-box-title icon-doublearrow-red"><a href="/vereadores/">Vereadores</a></h2>
										</header>
									</section>

									<section class="content-box box-nav-menu box-mapa">
										<header class="content-box-top">
											<h2 class="content-box-title icon-doublearrow-red"><a href="/camara/">Câmara</a></h2>
										</header>
									</section>

									<section class="content-box box-nav-menu box-mapa">
										<header class="content-box-top">
											<h2 class="content-box-title icon-doublearrow-red"><a href="/participe/">Participe</a></h2>
										</header>
									</section>

									<section class="content-box box-nav-menu box-mapa">
										<header class="content-box-top">
											<h2 class="content-box-title icon-doublearrow-red"><a href="/institucional/">Institucional</a></h2>
										</header>

										<ul class="box-nav-menu-list">
											<li><a href="/institucional/visita-virtual/" >Visita Virtual</a></li>
											<li><a href="/institucional/historia-da-camara/" >História da Câmara Municipal de São Paulo</a></li>
											<li><a href="/institucional/organograma-unidades/" >Organograma - Unidades</a></li>
											<li><a href="/institucional/campanhas-institucionais/" >Campanhas Institucionais</a></li>
											<li><a href="/institucional/manual-de-identidade-visual/" >Manual de Identidade Visual</a></li>
											<li><a href="/institucional/procuradoria/" >Procuradoria</a></li>
											<li><a href="/institucional/premios-institucionais/" >Prêmios Institucionais</a></li>
											<li><a href="/institucional/publicacoes/" >Públicações</a></li>
											<li><a href="/institucional/recursos-humanos/" >Recursos Humanos</a></li>
											<li><a href="/institucional/escola-parlamento/" >Escola do Parlamento</a></li>
											<li><a href="/institucional/cteo/" >CTEO</a></li>
										</ul>
									</section>

									<section class="content-box box-nav-menu box-mapa">
										<header class="content-box-top">
											<h2 class="content-box-title icon-doublearrow-red"><a href="/atividade-legislativa/">Atividade Legislativa</a></h2>
										</header>

										<ul class="box-nav-menu-list">
											<li><a href="/atividade-legislativa/splegis-consulta/" >SPLegis - Consulta</a></li>
											<li><a href="https://app-spvcidadao-prd.azurewebsites.net/" >Plenário Virtual</a></li>

											<li><a href="/atividade-legislativa/agenda-da-camara/" >Agenda da Câmara</a></li>
											<li><a href="/atividade-legislativa/sessao-plenaria/" >Sessão Plenária</a></li>

											<li><a href="/atividade-legislativa/registro-parlamentar/" >Registro Parlmentar</a></li>

											<li><a href="/atividade-legislativa/comissoes/" >Comissões</a></li>
											<li><a href="/atividade-legislativa/audiencias-publicas/" >Audiências Públicas</a></li>
											<li><a href="/atividade-legislativa/cpis/" >CPIS</a></li>
											<li><a href="/atividade-legislativa/frentes-parlamentares/" >Frentes Parlamentares</a></li>
											<li><a href="/atividade-legislativa/foruns/" >Fóruns </a></li>
											<li><a href="/vereadores/liderancas/" >Lideranças</a></li>
											<li><a href="/atividade-legislativa/projetos-apresentados-desde-1948/" >Projetos Apresentados (Desde 1948)</a></li>
											<li><a href="/vereadores/?filtro=mesa-diretora" >Mesa Diretora</a></li>
											<li><a href="/vereadores/?filtro=corregedoria" >Corregedoria</a></li>
											<li><a href="/atividade-legislativa/gabinetes/" >Gabinetes</a></li>
											<li><a href="/atividade-legislativa/regimento-interno/" >Regimento Interno</a></li>
											<li><a href="https://app-plpconsulta-prd.azurewebsites.net/" >Portal de Legislação Paulistana</a></li>

											<li><a href="/atividade-legislativa/legislacao-municipal-biblioteca/" >Legislação Municipal - Biblioteca</a></li>
										</ul>
									</section>

									<section class="content-box box-nav-menu box-mapa">
										<header class="content-box-top">
											<h2 class="content-box-title icon-doublearrow-red"><a href="/sala-de-imprensa/">Sala de Imprensa</a></h2>
										</header>

										<ul class="box-nav-menu-list">
											<li><a href="/sala-de-imprensa/assessoria-de-imprensa/" >Assessoria de Imprensa</a></li>
											<li><a href="/sala-de-imprensa/aviso-de-pauta/" >Aviso de Pauta</a></li>
											<li><a href="/sala-de-imprensa/credenciamento/" >Credenciamento</a></li>
											<li><a href="/sala-de-imprensa/notas-oficiais/" >Notas Oficiais</a></li>
											<li><a href="/institucional/recursos-humanos/concursos/" >Banco de Releases + Sugestão de Pautas</a></li>
											<li><a href="/sala-de-imprensa/multimidia/" >Multimídia</a></li>
											<li><a href="/sala-de-imprensa/tv-camara/" >TV Câmara</a></li>
											<li><a href="/sala-de-imprensa/web-radio/" >WEB Rádio</a></li>
											<li><a href="/sala-de-imprensa/camara-expressa/" >Câmara Expressa</a></li>
											<li><a href="/institucional/campanhas-institucionais/revista-apartes/" >Revista Apartes</a></li>
										</ul>
									</section>

									<section class="content-box box-nav-menu box-mapa">
										<header class="content-box-top">
											<h2 class="content-box-title icon-doublearrow-red"><a href="/sala-de-imprensa/noticias/">Notícias</a></h2>
										</header>
									</section>

									<div class="clearfix"></div>

									<section class="content-box box-nav-menu box-mapa">
										<header class="content-box-top">
											<h2 class="content-box-title icon-doublearrow-red"><a href="/biblioteca/">Biblioteca</a></h2>
										</header>

										<ul class="box-nav-menu-list">
											<li><a href="/biblioteca/legislacao/" >Legislação</a></li>
											<li><a href="/biblioteca/projetos/" >Projetos</a></li>
											<li><a href="/biblioteca/livros/" >Livros</a></li>
											<li><a href="/biblioteca/arquivo-vereadores/" >Pesquisa em Base de Dados - Vereadores</a></li>
											<li><a href="/biblioteca/comissoes/" >Comissões</a></li>
										</ul>
									</section>

									<section class="content-box box-nav-menu box-mapa">
										<header class="content-box-top">
											<h2 class="content-box-title icon-doublearrow-red"><a href="/fale-conosco/">Fale Conosco</a></h2>
										</header>

										<ul class="box-nav-menu-list">
											<li><a href="/fale-conosco/formulario-de-contato/" >Formulário de Contato</a></li>
											<li><a href="/fale-conosco/visite-camara/" >Visite a Câmara</a></li>
											<li><a href="/fale-conosco/telefones/" >Telefones</a></li>
											<li><a href="/fale-conosco/ouvidoria/" >Ouvidoria</a></li>
										</ul>
									</section>

									<section class="content-box box-nav-menu box-mapa">
										<header class="content-box-top">
											<h2 class="content-box-title icon-doublearrow-red"><a href="#">Transparência</a></h2>
										</header>

										<ul class="box-nav-menu-list">
											<li><a href="/transparencia/lei-de-acesso-informacao/" >Lei de Acesso à Informação</a></li>
											<li><a href="/transparencia/prestando-contas/" >Prestando Contas</a></li>
											<li><a href="/transparencia/custos-de-mandato/" >Custos de Mandato</a></li>
											<li><a href="/transparencia/salarios-abertos/" >Salários Abertos</a></li>
											<li><a href="/transparencia/dados-abertos/" >Dados Abertos</a></li>
											<li><a href="/transparencia/contratos-abertos/" >Contratos Abertos</a></li>
											<li><a href="/transparencia/auditorios-online/" >Auditórios Online</a></li>
											<li><a href="/sala-de-imprensa/multimidia/galeria-de-videos/" >Galeria de Vídeos</a></li>
											<li><a href="/transparencia/orcamentos-da-camara/" >Orçamento da Câmara</a></li>
											<li><a href="/transparencia/licitacoes-e-contratos/" >Licitações e Contratos</a></li>
										</ul>
									</section>

								</section>

								<footer class="article-footer">

                  <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

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
												<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>
					
					<!--?php get_sidebar('banco-de-ideias'); ?-->

				</div>

			</div>

</main>
<?php get_footer(); ?>
