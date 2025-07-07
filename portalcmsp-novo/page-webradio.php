<?php
/*
 * Template Name: Web Rádio
 */
?>

<style type="text/css">
	
.webradio-sobre {
    width: 100% !important;
    text-align: justify;
}


.webradio-menu {
    width: 32% !important;
    float: right;
    padding: 30px 20px 10px;
    background: #f5f5f5;
    box-shadow: inset 0px 1px 3px rgb(0 0 0 / 30%);
    border-bottom: 3px solid #333;
    border-radius: 3px;

}

.titulo-div { 
	font-size: 1.5em;
    margin-bottom: 20px;
    display: block;
    font-weight: bold;
    text-align: center; }

.leftalign { text-align: left; margin-top: 20px; }    

.showhide .showhide-title a, .showhide .podcast-title a, .podcast .showhide-title a, .podcast .podcast-title a { 
	border-bottom: 3px solid #7F1A22;
    margin: 0;
    font-size: 1.4rem;
    text-transform: uppercase;
    background: #fff; }   

.external-content-iframe {
    width: 65% !important;
    border: none;
    height: 800px;
} 

small { font-size: 65% !important; }

.showhide .showhide-content, .podcast .showhide-content { 
	font-size: 12px; }


@media only screen and (max-width: 768px) {

.external-content-iframe {
    width: 100% !important;
    border: none;
    height: 800px;
} 


.webradio-menu {
     width: 100% !important;
     margin-bottom: 30px;
    }

    .titulo-div { 
    text-align: left; }

	}


</style>

<?php get_header(); ?>

			<div id="content">

			<div class="breadcrumbs cf">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p class="wrap cf">','</p>');
				} ?>
			</div>

				<div id="inner-content" class="wrap cf">

						<div id="main" class="cf" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

								</header> <?php // end article header ?>

								<section class="entry-content cf" itemprop="articleBody">
									
									<!-- <iframe class="webradio-frame" src="http://streaming14.hstbr.net/player/webradiocamarasp/" name="playerradio" marginwidth="0" marginheight="0" scrolling="No" id="playerradio" align="top" frameborder="0" height="40"></iframe> -->
									
									<div class="webradio-sobre">

									A Web Rádio Câmara São Paulo é uma <strong>AGÊNCIA ELETRÔNICA DE NOTÍCIAS </strong>que permite a qualquer cidadão baixar e utilizar seus conteúdos em áudio. Toda programação ao vivo é transformada em <strong>PODCASTs </strong>e esses arquivos ficam a disposição no Portal da Câmara. Além disso, tem a função inigualável do rádio.
									<br><br>

									Meio de comunicação inseparável do público, integra as estratégias de comunicação da Câmara e leva a você as informações do cotidiano do Poder Legislativo. A linguagem radiofônica converge para a web e narra os acontecimentos desta Casa explicando de forma simples o resultado de audiências públicas, reuniões, debates e decisões dos vereadores em Plenário.
									<br><br>

									É um registro histórico dos acontecimentos legislativos. Diariamente são produzidos boletins sobre as atividades parlamentares, sessões plenárias, audiências públicas, reuniões das comissões técnicas, seminários, comemorações cívicas, homenagens, reuniões de ONGs e demais eventos.

									</div>


									
									<div class="webradio-sobre" style="margin-bottom: 30px; margin-top: 10px;">
										<span class="titulo-div leftalign">Ouça a Web Rádio agora. Clique aqui:</span>
										

										<iframe src="https://player.maxcast.com.br/webradiocamarasaopaulo" width="100%" height="60" frameborder="0" marginwidth="0" marginheight="" scrolling="no"></iframe>
									</div>

									<div class="webradio-menu">
									<span class="titulo-div">Programação Web Rádio</span>

									<p></p><div class="showhide"><h3 class="showhide-title"><a href="#">Segunda Feira</a></h3><div class="showhide-content"><br>
									09:00 – PREFIXO / AGENDA LEGISLATIVA / PREVISÃO DO TEMPO<br>
									09:10 – NOTICIÁRIO AGÊNCIA NACIONAL<br>
									10:10 – BOLETIM PORTAL ON LINE<br>
									10:15 – EVENTO AO VIVO OU GRAVADO<br>
									13:00 – JORNAL DA CÂMARA 1ª EDIÇÃO<br>
									13:45 – WEB JORNAL RADIO CÂMARA<br>
									14:05 – ENTREVISTA<br>
									14:35 – BOLETIM PORTAL ON LINE<br>
									14:40 – EVENTO AO VIVO OU GRAVADO<br>
									16:00 – BOLETIM PORTAL ON LINE<br>
									16:05 – RÁDIO SENADO<br>
									16:35 – BOLETIM PORTAL ON LINE<br>
									16:40 – BRASIL ELEITOR<br>
									17:10 – BOLETIM PORTAL ON LINE<br>
									17:15 – CÂMARA NOTÍCIAS<br>
									18:00 – CÂMARA TRÂNSITO<br>
									18:10 – CÂMARA NOTÍCIAS<br>
									18:30 – JORNAL TV CÂMARA<br>
									19:10 – CÂMARA CULTURA (*)<br>
									19:30 – FLASH SESSÃO SOLENE<br>
									20:00 – ENCERRAMENTO<br>
									</div></div><br>
									<div class="showhide"><h3 class="showhide-title"><a href="#">Terça Feira</a></h3><div class="showhide-content"><br>
									09:00 – PREFIXO / AGENDA LEGISLATIVA / PREVISÃO DO TEMPO<br>
									09:10 – NOTICIÁRIO AGÊNCIA NACIONAL<br>
									10:10 – BOLETIM PORTAL ON LINE<br>
									10:15 – COLÉGIO DE LÍDERES<br>
									11:30 – CÂMARA NOTÍCIAS<br>
									13:00 – JORNAL DA CÂMARA 1ª EDIÇÃO<br>
									13:45 – WEB JORNAL RÁDIO CÂMARA<br>
									14:05 – CÂMARA NOTÍCIAS<br>
									14:55 – BOLETIM PORTAL ON LINE<br>
									15:00 – SESSÃO PLENÁRIA<br>
									18:00 – CÂMARA TRÂNSITO<br>
									18:10 – CÂMARA NOTÍCIAS<br>
									18:30 – JORNAL DA CÂMARA 2ª EDIÇÃO<br>
									19:10 – CÂMARA NOTÍCIAS (*)<br>
									19:40 – FLASH SESSÃO SOLENE<br>
									19:55 – BOLETIM PORTAL ON LINE<br>
									20:00 – ENCERRAMENTO<br>
									</div></div><br>
									<div class="showhide"><h3 class="showhide-title"><a href="#">Quarta Feira</a></h3><div class="showhide-content"><br>
									09:00 – PREFIXO / AGENDA LEGISLATIVA / PREVISÃO DO TEMPO<br>
									09:10 – NOTICIÁRIO AGÊNCIA NACIONAL<br>
									10:10 – BOLETIM PORTAL ON LINE<br>
									10:15 – COLÉGIO DE LÍDERES<br>
									11:30 – CÂMARA NOTÍCIAS<br>
									13:00 – JORNAL DA CÂMARA 1ª EDIÇÃO<br>
									13:45 – WEB JORNAL RÁDIO CÂMARA<br>
									14:05 – CÂMARA NOTÍCIAS<br>
									14:55 – BOLETIM PORTAL ON LINE<br>
									15:00 – SESSÃO PLENÁRIA<br>
									18:00 – CÂMARA TRÂNSITO<br>
									18:10 – CÂMARA NOTÍCIAS<br>
									18:30 – JORNAL DA CÂMARA 2ª EDIÇÃO<br>
									19:10 – CÂMARA NOTÍCIAS (*)<br>
									19:40 – FLASH SESSÃO SOLENE<br>
									19:55 – BOLETIM PORTAL ON LINE<br>
									20:00 – ENCERRAMENTO<br>
									</div></div><br>
									<div class="showhide"><h3 class="showhide-title"><a href="#">Quinta Feira</a></h3><div class="showhide-content"><br>
									09:00 – PREFIXO / AGENDA LEGISLATIVA / PREVISÃO DO TEMPO<br>
									09:10 – NOTICIÁRIO AGÊNCIA NACIONAL<br>
									10:10 – BOLETIM PORTAL ON LINE<br>
									10:15 – COLÉGIO DE LÍDERES<br>
									11:30 – CÂMARA NOTÍCIAS<br>
									13:00 – JORNAL DA CÂMARA 1ª EDIÇÃO<br>
									13:45 – WEB JORNAL RÁDIO CÂMARA<br>
									14:05 – CÂMARA NOTÍCIAS<br>
									14:55 – BOLETIM PORTAL ON LINE<br>
									15:00 – SESSÃO PLENÁRIA<br>
									18:00 – CÂMARA TRÂNSITO<br>
									18:10 – CÂMARA NOTÍCIAS<br>
									18:30 – JORNAL DA CÂMARA 2ª EDIÇÃO<br>
									19:10 – CÂMARA NOTÍCIAS (*)<br>
									19:40 – FLASH SESSÃO SOLENE<br>
									19:55 – BOLETIM PORTAL ON LINE<br>
									20:00 – ENCERRAMENTO<br>
									</div></div><br>
									<div class="showhide"><h3 class="showhide-title"><a href="#">Sexta Feira</a></h3><div class="showhide-content"><br>
									09:00 – PREFIXO / AGENDA LEGISLATIVA / PREVISÃO DO TEMPO<br>
									09:10 – NOTICIÁRIO AGÊNCIA NACIONAL<br>
									10:10 – BOLETIM PORTAL ON LINE<br>
									10:15 – POVO FALA<br>
									11:15 – CÂMARA NOTÍCIAS<br>
									13:00 – JORNAL DA CÂMARA 1ª EDIÇÃO<br>
									13:45 – WEB JORNAL RÁDIO CÂMARA<br>
									14:05 – PELA ORDEM<br>
									14:10 – BRASIL ELEITOR<br>
									14:40 – BOLETIM PORTAL ON LINE<br>
									14:45 – CÂMARA NOTÍCIAS<br>
									15:15 – AGENDA DA DEMOCRACIA<br>
									15:30 – BOLETIM PORTAL ON LINE<br>
									15:35 – CÂMARA NOTÍCIAS<br>
									16:00 – CÂMARA CULTURA<br>
									16:20 – CÂMARA EXPRESSA<br>
									16:50 – BOLETIM PORTAL ON LINE<br>
									16:55 – CÂMARA NOTÍCIAS<br>
									18:00 – CÂMARA TRÂNSITO<br>
									18:10 – CÂMARA NOTÍCIAS<br>
									18:30 – JORNAL DA CÂMARA 2ª EDIÇÃO<br>
									19:10 – FLASH SESSÃO SOLENE<br>
									19:55 – BOLETIM PORTAL ON LINE<br>
									20:00 – PROGRAMA MEGA BRASIL<br>
									</div></div><br>
									<div class="showhide"><h3 class="showhide-title"><a href="#">Sábado</a></h3><div class="showhide-content"><br>
									09:00 às 20:00 – REPRISE DA PROGRAMAÇÃO<br>
									</div></div><br>
									
									<div class="podcast">
									<h3 class="podcast-title"><a href="https://www.saopaulo.sp.leg.br/comunicacao/web-radio/podcasts/">+Podcast</a></h3>
									</div>


									<small><b>Obs:</b><br>
									- EVENTOS AO VIVO OU GRAVADOS SÃO: SEMINÁRIOS, REUNIÃO DE COMISSÕES, PALESTRAS, CPI'S, CONGRESSO DE COMISSÕES, SESSÕES SOLENES, AUDIÊNCIAS PÚBLICAS <br>

									- EVENTUALMENTE O NOTICIÁRIO DA AGÊNCIA NACIONAL SERÁ TRANSMITIDO "AO VIVO " ÀS 19:00 HS. ( * ) <br>

									- A GRADE PODERÁ SOFRER EVENTUAIS ALTERAÇÕES PARA TRANSMISSÃO DE EVENTOS AO "VIVO"
									</small>
									</div>
									

									<span class="titulo-div leftalign">Ouça nosso banco de áudios</span>
									<iframe class="external-content-iframe" src="https://w.soundcloud.com/player/?url=https://api.soundcloud.com/users/52810594"></iframe>



										<!-- <?php the_content();
										// include an iframe of legacy content if selected in the admin
										// if(get_post_meta($post->ID,'_cmsp_page_legacy-type',true) == 'iframe') {
										// 	$iframe_src = get_post_meta($post->ID,'_cmsp_page_legacy-url',true);
										// 	if(preg_match('/saopaulo.sp.leg.br\/index.php/',$iframe_src) == 1) {
										// 		$iframe_src .= '&template=none';
										// 	}
										// 	echo '<iframe class="external-content-iframe" src="'. $iframe_src .'"></iframe>';
										// }


										?> -->
										


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


							

							<!-- <iframe src="https://w.soundcloud.com/player/?url=https://api.soundcloud.com/users/52810594" width="100%" scrolling="yes"></iframe>	 -->

					</div>

				</div>
			
			</div>

<?php get_footer(); ?>
