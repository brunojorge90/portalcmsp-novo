<?php
/*
 Template Name: Posse 2021
*/
?>

<?php get_header(); ?>

<style>

#content { 
    background: url(https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/back_cont.jpg) repeat !important;
    background-size: cover;
    background-position: center top !important;
    display: flex;
   
} 

.content-box-top {
    border: 0;
    /* border-bottom: 3px solid #ff1616; */
    margin-bottom: 0;
    background: #ff1616;
    border-radius: 5px;
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
	border-bottom: 3px solid #ff1616; 
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
    background: #ff1616;
    color: white;
    padding: 10px;
    font-size: 20px;
    font-weight: bold;
    width: 100%;
    display: block;
    margin-bottom: 10px;
    height: 40px;
    border-radius: 5px;
 }

 .box-latest-news-list .box-latest-news-item span.date:after { display: none; }

.box-latest-news-list .box-latest-news-item h3.article-title { margin: 0; }

.box-latest-news-list .box-latest-news-item span.headline a { 
	color: #333333;
	margin: 20px 0 5px 0;
    line-height: 1;
    font-size: 1.375em;
    font-weight: bold;

 }

.box-latest-news-footer { 
	color: white;
    text-transform: uppercase;
    padding: 8px 65px;
    text-decoration: none;
    background: #ff1616 url(../images/plus.png) no-repeat;
    display: table;
    margin: auto;
    border-radius: 5px;
    clear: both;
   
     }

   .box-latest-news-footer a { color: #fff !important; font-size: 1em;  text-decoration: none !important; background: transparent;  }  





.home-banner {
	padding-top: 0;
	background: #eeeeee;
    background-position: center top;
    background: url(https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/back_posse.jpg) no-repeat !important;
    background-size: 100%;
   
}

.home-banner-img { width: 100%; }

.video-home { float: left; width: 100%; }


.video-home h2.label-home { 
	color: #ff1616;
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
    height:420px;
    margin-bottom: 10px;
    border: 3px solid #ff1616;
    border-radius: 5px;
    }


.destaques { 
	/*width: 100%;*/
    display: table;
    /*background: #131413;*/
    margin: 30px auto 30px;
    border-radius: 5px;
}

.destaques .item { /*width: 50%; */ display: inline-flex; float: left; margin: 0 5px;
    background: #000;
    border-radius: 5px;
    padding: 10px 20px;  }

.destaques .item a {
    width: auto;
    text-align: left;
    color: #fff;
    text-decoration: none;
}

.destaques .item a span { padding-top: 10px; padding-left: 5px;
    display: flex; font-size: 16px;}


.destaques .item a img {
    width: 60px; 
    text-align: left;
    float: left;
    
}

.destaques h2.label-home { 
	color: #ff1616;
	font-size: 1.5em;
    line-height: 1.25em;
    margin: 10px 0 5px;
    font-weight: bold;

	}


.box-redes { margin: 30px 0 ; clear: both;  }


.caixaflex {
    display: inline-block;
    /* justify-content: space-between; */
    width: 100%;
    list-style: none;
    /* margin-bottom: 40px; */
    padding: 20px 20px 0;
    background: rgba(76, 78, 75, 0.2);
    border-radius: 5px;
    margin-top: 10px;
}

.caixaflex .item-redes { 
	display: grid;
    text-align: center;
    width: 33%;
    float: left;
    margin-bottom: 20px;
	
}


.caixaflex .item-redes span { 
/*	background: #ff1616;*/
	border-radius: 5px;
    margin: auto;
    padding: 5px 15px;
    color: #000;
    font-size: 16px;
    font-weight: bold;
   

	}

.caixaflex .item-redes-img { 
	width: 170px;
	height: 170px;
	background: #fff;
    border-radius: 100%;
  /*  border:1px solid #000;*/
    margin-top: 10px;
    box-shadow: 1px 1px 10px #000

    

}

@media only screen and (min-width: 768px) {
.box-latest-news-list .box-latest-news-item {
    border-bottom: 0 solid #ededed !important;
    width: 30%;
    min-height: 120px;
    margin: 20px 1.5% 40px;
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
.caixaflex .item-redes { width: 100%; }

.caixaflex .item-redes-img { 
	width: 250px;
	height: 250px;
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
			<img class="home-banner-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/logo-posse.png">
			</div>

			</div>

		</section>
		
			
			<!-- CONTEUDO -->
			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="cf" role="main">

						<!-- TVAOVIVO -->	

							<div class="cmsp-row">
							
							<div class="video-home">
							<h2 class="label-home"><span>Cerimônia de Posse da 18ª Legislatura da CMSP</span></h2>
							<div class="player">
							

							<iframe width="100%" height="100%" src="https://www.youtube.com/embed/wQo85OLh9kw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


							</div>
						    </div>

						    <!-- <div class="destaques">
						    	<h2 class="label-home">Vereadores</h2>
						    		<div class="item">
									<a class="btAgenda" target="_blank" href="https://www.saopaulo.sp.leg.br/vereadores/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/11/agenda-1.png"></a></div>


									<h2 class="label-home">Auditórios Online</h2>

									<div class="item"><a class="btAudonline" target="_blank" href="https://www.saopaulo.sp.leg.br/transparencia/auditorios-online/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/11/auditorio-virtual-1.png"></a></div>
								
							</div> -->
							</div>


							<!-- REDES SOCIAS -->
							<div class="cmsp-row box-redes">
								<header class="content-box-top">
								    <h2 class="content-box-title">Confira pelas Redes Sociais</h2>
								  </header>

								  <div class="caixaflex">
								  <div class="item-redes"><a href="https://twitter.com/camarasaopaulo" title="Cobertura Twitter" target="_blank"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/twitter.jpg" ></a> <span>TWITTER <br/>Comente e compartilhe!</span></div>

								  <div class="item-redes"> <a href="https://facebook.com/camarasaopaulo" target="_blank" title="Live do Facebook" ><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/facebook.jpg"></a> <span>FACEBOOK <br/> Acompanhe e compartilhe</span></div>

								  <div class="item-redes"><a href="https://instagram.com/camarasaopaulo" target="_blank" title="Cobertura Instagram"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/instagram.jpg"></a> <span>INSTAGRAM <br/> Confira os bastidores </span></div>

								</div>
							</div>



							<!-- REDES SOCIAS -->
							<div class="cmsp-row box-redes">
								<header class="content-box-top">
								    <h2 class="content-box-title">Álbuns de fotos da Cobertura</h2>
								  </header>

								    <div class="caixaflex">
								 

								  <div class="item-redes"> <a href="https://www.flickr.com/photos/131078419@N07/albums/72157717065885558" target="_blank" title="Álbum de fotos no Flickr"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/cerimonia.jpg"></a> <span>Cerimônia de Posse 2021 </span></div>

								   <div class="item-redes"> <a href="https://www.flickr.com/photos/131078419@N07/albums/72157717065993331" target="_blank" title="Álbum de fotos no Flickr"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/mesa-diretora.jpg"></a> <span>Eleição da Mesa Diretora 2021</span></div>

								    <div class="item-redes"> <a href="https://www.flickr.com/photos/131078419@N07/albums/72157717070206237" target="_blank" title="Álbum de fotos no Flickr"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/vereadores.jpg"></a> <span>Fotos Vereadores 2021</span></div>
								</div>

								
							</div>





							<!-- REDES SOCIAS -->
							<div class="cmsp-row box-redes">
								<header class="content-box-top">
								    <h2 class="content-box-title">Confira também em:</h2>
								  </header>


								  <div class="caixaflex">

								  

								  <div class="item-redes"><a target="_blank" href="https://www.saopaulo.sp.leg.br/transparencia/auditorios-online/"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/auditorios.jpg"></a> <span>Auditórios Online </span> </div>


								  <div class="item-redes"> <a href="https://www.youtube.com/c/TVCÂMARASÃOPAULO" target="_blank" title="TV Câmara AO VIVO"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/tvcamara.jpg"></a> <span>TV Câmara SP <br> 8.3 canal aberto digital </span></div>

								
								<div class="item-redes"> <a href="https://youtube.com/c/CâmaraMunicipaldeSãoPaulo" target="_blank" title="Live Youtube"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/live-youtube.jpg"></a> <span>Live YouTube</span></div>

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
											'posts_per_page' => 6,
											'category_name' => 'posse-2021',
										));
										
										wp_cache_set($key,$latestQuery,'',600);
								    }
								    while($latestQuery->have_posts()): $latestQuery->the_post();
								    ?>
								      <article class="box-latest-news-item cf">
								        <h3 class="article-title">
								          <span class="date"><?php echo get_the_date('d\.m'); ?></span>
								          <span class="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
								        </h3>
								      </article>
								    <?php endwhile; ?> 


								    	<!-- <article class="box-latest-news-item cf">
								        <h3 class="article-title">
								          <span class="date">27.11</span>
								          <span class="headline"><a href="https://www.saopaulo.sp.leg.br/blog/cidade-de-sao-paulo-fecha-a-semana-com-143-mil-obitos-e-4017-mil-casos-de-covid-19/">Cidade de São Paulo fecha a semana com 14,3 mil óbitos e 401,7 mil casos de Covid-19</a></span>
								        </h3>
								    
								      </article> -->
								    	




								  </div>

								 <footer class="box-latest-news-footer">
								    <a href="<?php echo get_home_url(); ?>/comunicacao/noticias/" class="btn">Todas as notícias</a>
								  </footer> 
								</section><!-- end box-latest-news -->

							</div><!-- end row -->



							  <div class="destaques">
						    		<div class="item">
									<a class="btAgenda" title="Vereadores" target="_blank" href="https://www.saopaulo.sp.leg.br/vereadores/"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/11/agenda-1.png"> <span>Vereadores</span></a></div>



									<div class="item"><a title="Discursos Online" class="btAudonline" target="_blank" href="https://youtube.com/playlist?list=PLYt3a0f9wjCnM34JbqihMFuFejcgsIHAw"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/tube.png"><span>Discursos Online</span></a></div>

									<div class="item">
									<a class="btAgenda" title="Podcast da Posse na íntegra" target="_blank" href="https://soundcloud.com/user-303787330/01012021-sessao-solene-de-posse-do-prefeito-de-sp-vice-e-vereadores-eleitos"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/01/sound-novo.png"> <span>Sessão da Posse</span></a></div>

									<div class="item">
									<a class="btAgenda" title="Podcast da Eleição da Mesa Diretora" target="_blank" href="https://soundcloud.com/user-303787330/01012021-mesa-diretora-da-cmsp-e-eleita"><img src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/01/sound-novo.png"> <span>Eleição Mesa Diretora</span></a></div>
								
							</div>

						
							

						</div>

				</div>

			</div>
</main>
<?php get_footer(); ?>
