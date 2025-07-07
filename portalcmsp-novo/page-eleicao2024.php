<?php
/*
 Template Name: Eleicao 2024
*/
?>

<?php get_header(); ?>


<style>

iframe { width:50% !important; height:300px; border:3px solid #fff;  margin-bottom:30px; float:left; }			



#content { 
    /*background: url(https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/back_cont.jpg) repeat !important;
    background-size: cover;
    background-position: center top !important;
    display: flex;*/
   
} 
body.theme-v2 .content-box { width:100% !important; }

body.theme-v2 .content-box {
    padding: 16px 16px 30px;
    border-radius: 0 !important;
    border: 1px solid #eeeeee !important;
    background: #fff;
}


body.theme-v2 .content-box-top .content-box-title a {

    color: #000 !important;
    font-size: 2.5rem !important;
}

body.theme-v2 .box-latest-news .box-latest-news-item h3 { display:block !important; }


table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }



        tr:nth-child(even) {
            background-color: #f2f2f2; /* Cor para linhas pares */

        }
        tr:nth-child(odd) {
            background-color: #ffffff; /* Cor para linhas ímpares */
        }
        td {
            padding: 8px;
            border: 1px solid #ddd; /* Borda da tabela */

        }



.content-box-top {
    border: 0;
    /* border-bottom: 3px solid #5b727e; */
    margin-bottom: 0;
    background: #5b727e;
    border-radius: 5px;
    display: block !important;
}
.content-box-top .content-box-title:before {
    border-right: 0;
}
.content-box-top .content-box-title {
    padding: 20px 0 20px 20px;
    margin: 0px;
    font-size: 1.25em;
    line-height: 0;
    color: #fff;
    text-align: left;
}

.box-latest-news .content-box-top { 
	border-bottom: 3px solid #5b727e; 
    margin-bottom: 0;
    background: transparent; 
    border-radius: 0; }
 
/*.box-latest-news-list { display: flex; }*/

.box-latest-news-list .box-latest-news-item {
    border-bottom: 0 solid #ededed !important;
    width: 100%;
       margin-bottom:  30px;
    /*padding-bottom: 20px;*/
}

.box-latest-news-list .box-latest-news-item span.date { 
    background: #5b727e;
    color: white;
    padding: 10px;
    font-size: 20px;
    font-weight: bold;
    width: 100% !important;
    display: block;
    margin-bottom: 10px;
    height: 40px;
    border-radius: 5px;
 }

 .box-latest-news-list .box-latest-news-item span.date:after { display: none; }

.box-latest-news-list .box-latest-news-item h3.article-title { margin: 0; }


.box-latest-news .box-latest-news-item h3 span.headline { display: inline-table; }

.box-latest-news-list .box-latest-news-item span.headline a { 
	color: #333333;
	margin: 5px 0 5px 0;
    line-height: 1;
    font-size: 1em;


 }

.box-latest-news-footer { 
	color: white;
    text-transform: uppercase;
    padding: 8px 65px;
    text-decoration: none;
    background: #5b727e url(../images/plus.png) no-repeat;
    display: table;
    margin: auto;
    border-radius: 5px;
    clear: both;
   
     }

   .box-latest-news-footer a { color: #fff !important; font-size: 1em;  text-decoration: none !important; background: transparent;  }  





.home-banner {
	padding-top: 0;
    margin-bottom: 10px;
	background: #fff;
    /*background-position: center top;
    background: url(https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/back_posse.jpg) no-repeat !important;
    background-size: 100%;*/
   
}

.home-banner-img { width: 40%; margin: 15px auto; display:block; }


 body.theme-v2 .btn { background:transparent !important; border:0 !important; }   

.video-home { float: left; width: 100%; }


.video-home h2.label-home { 
	color: #5b727e;
    font-size: 1.5em;
    line-height: 1.25em;
    margin-top: 0;
    font-weight: bold;

	}

.video-home h2.label-home span { 
    
    font-weight: normal;

	}

.player {
    float: left;
    background: #000000;
    width: 100%;
    margin-bottom: 50px;
    border: 3px solid #5b727e;
    border-radius: 5px;
    }


.destaques { 
	width: 100%;
    display: inline-block;
    /*background: #131413;*/
    margin: 10px auto 30px;
    border-radius: 5px;
}

.destaques .item { width: 32.3%;  display: inline-table; float: left; margin: 0 3px;
    background: #5b727e;
    border-radius: 5px;
    padding: 20px 20px; margin-bottom:7px; }

.destaques .item a {
    width: 100%;
    text-align: center;
    color: #fff;
    text-decoration: none;
  
}


.destaques .item a:hover { font-weight:bold; }


.destaques .item a span { padding-top: 5px;
    display: block; font-size: 15px; text-align: center;}

    .destaques .item a span strong { font-size: 18px;  }


.destaques .item a img {
    width: 100px; 
    margin: auto;
    display: block;
    
}

.destaques h2.label-home { 
	color: #5b727e;
	font-size: 1.5em;
    line-height: 1.25em;
    margin: 10px 0 5px;
    font-weight: bold;

	}


.box-redes {  background: #5b727e; padding: 20px 0 0; color: #fff !important; }

.box-redes h2 {color: #fff !important; font-weight: 600 !important; text-align: center !important;}

.caixaflex {
    display: inline-block;
    /* justify-content: space-between; */
    width: 40%;
    list-style: none;
    /* margin-bottom: 40px; */
 
    /*background: rgba(76, 78, 75, 0.2);*/
    margin:0 30% 0; 

    /*box-shadow: 1px 1px 10px #000;*/
   
}

.caixaflex .item-redes { 
	display: block;
    text-align: center;
    width: 25%;
    float: left;
   /* margin: 20px .5%;*/
    /*border: 1px solid rgba(76, 78, 75, 0.1);*/
/*    box-shadow: inset 0px -30px 40px rgb(0 0 0 / 30%), inset 0px 10px 50px rgb(255 255 255 / 50%);*/
    border-radius: 5px;
    padding: 20px 0;
	
}



.caixaflex .item-redes span { 
/*	background: #ff1616;*/
	border-radius: 5px;
    margin: auto;
    padding: 5px 15px;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    display: block;
   

	}


.caixaflex img { 
	width: 100px; }


.caixaflex .item-redes-img { 
	width: 35%;
    border-radius: 100%;
    border:1px solid #fff;
 
    margin-top: 10px;
 /*box-shadow: inset 0px -30px 40px rgb(0 0 0 / 30%), inset 0px 10px 50px rgb(255 255 255 / 30%);*/


}




.caixaflex .item-redes-img:hover {background:#000;  }

@media only screen and (min-width: 768px) {
.box-latest-news-list .box-latest-news-item {
    border-bottom: 0 solid #ededed !important;
    width: 30%;
/*    min-height: 120px;*/
    margin: 20px 1.5% 20px;
    float: left;
}
}


@media only screen and (max-width: 768px) {
.video-home h2.label-home { text-align: center; font-size: 1.5em; }
.video-home h2.label-home span { display: block; }

.caixaflex .item-redes-img { 
	width: 130px;
	height: 130px;
	}
}

@media only screen and (max-width: 580px) {
.caixaflex .item-redes { width: 50%; }

.caixaflex .item-redes-img { 
	width: 50px;
	height: 50px;
	}

.destaques .item {
    width: 100%;
    display: block;
    margin: 0 0 10px;
}


}
</style>


		<!-- BANNER -->
		<section class="home-banners-container cf">
			<div class="home-banner">
			<div class="inner-home-banner wrap">
			<img class="home-banner-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/eleicao.png">
			</div>

			</div>

		</section>
		
			
			<!-- CONTEUDO -->
			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="cf" role="main">

						<!-- TVAOVIVO -->	

							<!-- <div class="cmsp-row">
							
							<div class="video-home" style="">
							<h1 class="label-home"><span>Tudo sobre as Eleições 2024</span></h1> <br>
							<div class="player">
							

							<iframe width="100%" height="500" src="https://www.youtube.com/embed/kZrgaTcVBjs?si=rXfynQp_shzCQx-y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>


							</div>
						    </div>
							</div> -->





							<!-- CONTEUDO -->
							<div class="cmsp-row">
						
							<?php the_content();?>
							<br>


							<!-- <table>
							    <tr><td><strong>8h</strong> - Abertura da cobertura especial das eleições municipais 2024</td></tr>

							    <tr><td><strong>8h20</strong> - AO VIVO – Boletim Câmara Expressa diretamente do TRE - SP</td></tr>

							    <tr><td><strong>8h30</strong> - Entrevista coletiva com o presidente do TRE - Desembargador Silmar Fernandes</td></tr>

							    <tr><td><strong>9h</strong> - Programa Legislativo do Futuro: História das Eleições</td></tr>

							    <tr><td><strong>10h10</strong> - Programa Cidadania: Direito de Saber, o que fazem as prefeituras (Parceria com a TV Senado)</td></tr>

							    <tr><td><strong>10h45</strong> - Documentário Jovens Eleitores (Parceria com o TSE)</td></tr>

							    <tr><td><strong>11h</strong> - AO VIVO – Boletim ao Vivo em Rede Nacional através da Rede Legislativa</td></tr>

							    <tr><td><strong>11h10</strong> - Programa Cidadania: Impacto das notícias falsas nas eleições (Parceria com a TV Senado)</td></tr>

							    <tr><td><strong>11h35</strong> - Programa Cidadania: Assunto de Estado - Representatividade nas Eleições (Parceria com a TV Senado)</td></tr>

							    <tr><td><strong>12h</strong> - Programa Legislativo do Futuro: Inteligência Artificial e Eleições</td></tr>

							    <tr><td><strong>12h30</strong> - Programa DiverCidade: Acessibilidade nas Eleições</td></tr>

							    <tr><td><strong>13h</strong> - AO VIVO – Boletim ao Vivo em Rede Nacional através da Rede Legislativa</td></tr>

							    <tr><td><strong>13h30</strong> - Programa Cidadania: Assunto de Estado - Manipulação do processo eleitoral (Parceria com a TV Senado)</td></tr>

							    <tr><td><strong>14h</strong> - Programa Legislativo do Futuro: Conduta dos candidatos</td></tr>

							    <tr><td><strong>14h30</strong> - Câmara Explica – especial eleições</td></tr>

							    <tr><td><strong>15h</strong> - Câmara Reportagem: Eleições 2024</td></tr>

							    <tr><td><strong>15h30</strong> - Programa Sampa Cast: Processo Eleitoral, com o cientista político Paulo Roberto de Souza</td></tr>

							    <tr><td><strong>16h30</strong> - Programa DiverCidade: Acessibilidade nas eleições</td></tr>

							    <tr><td><strong>17h</strong> - AO VIVO – Estúdio: Programa Rede Câmara SP – APURAÇÃO, com análise e comentários do jornalista Carlos Maglio e do gestor do Centro de Memória Eleitoral do TRE-SP, José D’Amico Bauab. </td></tr>


							</table> -->

							</div>

				


						



					        <div class="destaques">

					        		<div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/camara-explica-boletim-de-urna-e-instrumento-de-integridade-e-transparencia-nas-eleicoes/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-recibo.png"> <span><strong>Câmara Explica</strong> <br>O que é Boletim de Urna?</span><br></a>
								    </div>

								     <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/eleicoes-2024-saiba-como-encontrar-a-zona-eleitoral-e-como-justificar-o-voto/"> <img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-urna.png"><span><strong>Câmara Explica</strong> <br>Saiba como encontrar a zona eleitoral e como justificar o voto</span></a>
								    </div>

								     <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/eleicoes-2024-saiba-quais-documentos-sao-aceitos-ou-nao-para-votar/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-doc.png"> <span><strong>Câmara Explica</strong> <br>Saiba quais documentos são aceitos ou não para votar</span></a>
								    </div>





						    		<div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/camara-explica-qual-a-diferenca-entre-voto-branco-nulo-ou-por-legenda/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-urna.png">  <span><strong>Câmara Explica</strong> <br>Qual a diferença entre voto branco, nulo ou por legenda?</span></a>
								    </div>

								    


								    <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/camara-explica-o-que-significa-votar-em-transito-como-faco-para-justificar-meu-voto/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-mapa.png"> <span><strong>Câmara Explica</strong> <br>O que significa votar em trânsito? Como faço para justificar meu voto?</span></a>
								    </div>

								    <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/camara-explica-detalha-o-servico-de-mesario-nas-eleicoes/"> <img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-mesario.png"><span><strong>Câmara Explica</strong> <br>O que o mesário faz?</span><br></a>
								    </div>


								   

								    <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/eleicoes-2024-perdeu-o-titulo-de-eleitor-confira-o-que-voce-pode-fazer/"> <img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-titulo.png"><span><strong>Câmara Explica</strong> <br>Perdeu o título de eleitor? Confira o que você pode fazer</span></a>
								    </div>


								      <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/eleicoes-2024-plataforma-oficial-apresenta-informacoes-sobre-candidatos/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-politico.png"> <span><strong>Câmara Explica</strong> <br>Plataforma oficial apresenta informações sobre candidatos</span></a>
								    </div>


								    <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/eleicoes-2024-populacao-tira-duvidas-no-quero-saber/"> <img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-saber.png"><span><strong>Câmara Explica</strong> <br>População tira dúvidas no “Quero Saber”</span><br></a>
								    </div>

								     <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/eleicoes-2024-eleitor-pode-denunciar-fake-news-e-propaganda-irregular/"> <img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-fake.png"><span><strong>Câmara Explica</strong> <br>Eleitor pode denunciar fake news e propaganda irregular</span></a>
								    </div>

								    <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/evolucao-das-urnas-exposicao-do-tre-sp-mostra-mudancas-do-sistema-eleitoral-no-brasil/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-urna2.png"> <span><strong>Evolução das urnas </strong> <br> Exposição do TRE-SP mostra mudanças do sistema eleitoral no Brasil</span></a>
								    </div>



									<div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/presidente-do-tre-sp-aborda-preparativos-para-as-eleicoes-municipais-do-proximo-domingo/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-presidente.png"> <span><strong>Presidente do TRE-SP</strong> <br> aborda preparativos para as eleições municipais do próximo domingo</span></a>
								    </div>


								    <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/cerimonia-publica-marca-inicio-da-preparacao-das-urnas-eletronicas/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-cerimonia.png"> <span><strong>Cerimônia pública </strong> <br> marca início da preparação das urnas eletrônicas</span></a>
								    </div>


								     <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/acessibilidade-nas-eleicoes-tre-sp-disponibiliza-servico-voltado-a-deficientes-auditivos/"> <img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-acesso.png"><span><strong>Acessibilidade nas eleições</strong> <br>TRE-SP disponibiliza serviço voltado a deficientes auditivos</span></a>
								    </div>


								     <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/campanha-do-mpt-conscientiza-sobre-o-assedio-eleitoral-no-ambiente-de-trabalho/"> <img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-assedio.png"><span><strong>Campanha do MPT </strong> <br>conscientiza sobre o Assédio Eleitoral no ambiente de trabalho </span></a>
								    </div>


								     <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/eleicoes-2024-programa-legislativo-do-futuro-resgata-a-historia-das-eleicoes/"> <img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-urna.png"><span><strong>Eleições 2024</strong> <br>Programa Legislativo do Futuro resgata a história das eleições</span><br></a>
								    </div>


								     <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/inteligencia-artificial-e-eleicoes-assista-ao-programa-legislativo-do-futuro-desta-semana/"> <img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-ia.png"><span><strong>Eleições 2024</strong> <br>Legislativo do Futuro fala sobre o uso da Inteligência Artificial e outras tecnologias nas eleições </span></a>
								    </div>


								    <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/camara-reportagem-desafios-do-processo-eleitoral-em-sp-e-tema-do-ultimo-episodio-da-serie-especial-sobre-eleicoes/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-reportagem.png"> <span><strong>Câmara Reportagem</strong> <br>Desafios do processo eleitoral em SP é o último episódio da série sobre eleições</span><br></a>
								    </div>


								    
									<div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/primeiro-episodio-do-camara-reportagem-sobre-eleicoes-municipais-retoma-historia-do-processo-eleitoral-democratico/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-reportagem.png"> <span><strong>Câmara Reportagem</strong> <br> Primeiro episódio sobre eleições municipais retoma história do processo eleitoral democrático </span></a>
								    </div>


								    


								    <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/o-papel-da-justica-eleitoral-e-assunto-do-segundo-episodio-do-camara-reportagem-sobre-eleicoes-municipais/"> <img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-reportagem.png"><span><strong>Câmara Reportagem</strong> <br>O papel da Justiça Eleitoral é assunto do segundo episódio do Câmara Reportagem sobre eleições municipais </span></a>
								    </div>


								    

								    <div class="item">
									<a class="btAgenda" title="Noticias" target="_blank" href="https://www.saopaulo.sp.leg.br/blog/camara-reportagem-terceiro-episodio-da-serie-sobre-eleicoes-mostra-as-diferencas-entre-sistemas-majoritario-e-proporcional/"> <img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2024/10/icone-reportagem.png"><span><strong>Câmara Reportagem</strong> <br>Terceiro episódio da série sobre eleições mostra diferenças entre os sistemas majoritário e proporcional </span></a>
								    </div>

							</div>


							<!-- ULTIMAS NOTICIAS -->
							<div class="cmsp-row">

								<section class="content-box box-latest-news">
								  <header class="content-box-top">
								    <h2 class="content-box-title"><a href="<?php echo get_home_url(); ?>/comunicacao/noticias/">Últimas Notícias</a></h2>
								  </header>

								  <div class="box-latest-news-list">

								   <?php
									//cacheia consulta lenta (expiração a cada 10 min)
									$key = 'wpquery_cacheado_ultimas_noticias';
								    if ( ! $latestQuery = wp_cache_get($key) ) {
								         
										$latestQuery = new WP_Query(array(
											'no_found_rows' => true,
											'post_type' => 'post',
											'posts_per_page' => 9,
											'category_name' => 'eleicoes-2024',
										));
										
										wp_cache_set($key,$latestQuery,'',600);
								    }
								    while($latestQuery->have_posts()): $latestQuery->the_post();
								    ?>
								      <article class="box-latest-news-item cf">
								        <h3 class="article-title">
								          <span class="date"><?php echo get_the_date('d/m/y'); ?></span>
								          <span class="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
								        </h3>
								      </article>
								    <?php endwhile; ?> 



								  </div>

								 <footer class="box-latest-news-footer">
								    <a href="<?php echo get_home_url(); ?>/blog/category/noticias/especiais/eleicoes-2024/" target="_blank class="btn">Todas as notícias</a>
								  </footer> 
								</section><!-- end box-latest-news -->

							</div><!-- end row -->




							</div>

							</div>

							</div>


			



							<!-- REDES SOCIAS -->
							<div class="cmsp-row box-redes">
								<header class="content-box-top">
								    
								     <h2 class="content-box-title">Curta, comente e compartilhe</h2>
								  </header>

								  <div class="caixaflex">
								  

								  <div class="item-redes"> <a href="https://facebook.com/camarasaopaulo" target="_blank" title="Facebook" ><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/02/face.png"></a> <span>Facebook </span></div>

								  <div class="item-redes"><a href="https://instagram.com/camarasaopaulo" target="_blank" title="Instagram"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/02/insta.png"></a> <span>Instagram </span></div>

								  <div class="item-redes"><a href="https://twitter.com/camarasaopaulo" title="Twitter" target="_blank"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/02/twitter.png" ></a> <span>Twitter </span></div>

								   <div class="item-redes"><a href="https://twitter.com/camarasaopaulo" title="Linkedin" target="_blank"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/02/linkedin.png" ></a> <span>Linkedin </span></div>

								</div>
							</div>
</main>

<?php get_footer(); ?>