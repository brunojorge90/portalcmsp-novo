<?php
/*
 Template Name: Pagina Posse 2025
*/
?>

<?php get_header(); ?>

<style>

#irconteudo{ 
    background: url(http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/back_posse.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: top !important;
        padding-bottom: 30px;
  
   
}

.content-box-top {
	display: block !important;
}

iframe { width: 100% !important; height: 650px; border-radius: 4px; border: 2px solid #be1f3f !important;}


body.theme-v2 .content-box {
    width: 100% !important;
    margin: 20px 0;
}

body.theme-v2 section h2 { display:block !important;}

/*.cmsp-row:first-of-type {
    margin-top: 30px !important;
}*/

.top-slider { background: #fff; margin: 20px 0 30px;}
.top-slider .slider-container { border: 1px solid #d6d6d6; width: 100%; height: auto; }



.btn { /*background: #be1f3f !important;*/ padding: 8px 24px; border-radius: 5px; }


.container-top-nav-3 { float: left; }

.content-box-top .content-box-title a:hover { color: #be1f3f; text-decoration: none; }


.content-box-top {
    border: 0;
    margin-bottom: 0;
}

.content-box-top .content-box-title:before {
    border-right: 0;
}

.content-box-top .content-box-title {
    padding: 20px 0 20px 10px;
    margin: 0px;
    font-size: 1.50em;
    line-height: 0;
    color: #000;
    text-align: center;
    font-weight:200;

}

.content-box-top .content-box-title a {
    padding: 20px 0 20px 0;
    margin: 0px;
    font-size: 1.25em !important;;
    line-height: 0;
    color: #000 !important;
    text-align: left;
    line-height: 0 !important;
}


.box-latest-news .content-box-top .content-box-title { text-align: left; }

.content-box-top .content-box-title:first-letter  { font-size: 1.75em; font-weight: bold; }

.content-box-top .content-box-title:before {
    content: '';
    display: block;
     width: 0 !important; 
}





.box-latest-news .content-box-top { 
	border-bottom: 3px solid #be1f3f; 
    margin-bottom: 0;
    background: transparent; 
    border-radius: 0;
    height: 50px; }
 

section.noticias-back { 

	 margin-bottom: 20px !important;
	 padding-bottom: 0px !important;

/*	background: rgba(76, 78, 75, 0.1); */
/* box-shadow: inset 0px -30px 40px rgb(0 0 0 / 30%), inset 0px 10px 50px rgb(255 255 255 / 50%); */ }


/*.box-latest-news-list .box-latest-news-item {
    border-bottom: 0 solid #ededed !important;
    width: 100%;
    margin-bottom:  30px;

}*/


body.theme-v2 .box-latest-news .box-latest-news-item h3 {
    display: block !important;
}


.box-latest-news-list .box-latest-news-item {
    border-bottom: 0 solid #ededed !important;
    width: 30%;
    height: 140px;
    margin: 20px 1.5% 10px;
    float: left;
    background:  #fff;
    padding: 15px !important;
/*    border-radius: 5px;*/
    border-bottom: 1px solid #d2d3ce !important;


}


.box-latest-news-list .box-latest-news-item span.date { 
    background:  #d2d3ce;
    color: rgba(76, 78, 75, 1);
    padding: 10px 0;
    font-size: 16px;
    font-weight: bold;
/*    width: 120px !important;*/
    display: block;
/*    margin: 0 0 0 -20px ;*/
    height: 40px;
    border-radius: 5px;
    text-align: center;
 }

.box-latest-news-list .box-latest-news-item span.date:after { display: none; }

.box-latest-news-list .box-latest-news-item h3.article-title { margin: 0; }

.box-latest-news-list .box-latest-news-item span.headline {  padding: 10px 0; display: block;  clear: both;  }


.box-latest-news-list .box-latest-news-item span.headline a { 
	color: #333333;
    margin: 0 0 5px 0;
    /* line-height: 1; */
    font-size: 16px !important;
    text-align: center;
    /* font-weight: 300;*/
 }

 .box-latest-news-list .box-latest-news-item span.headline a:hover { text-decoration: none;  color: #000; }

.box-latest-news-footer { 

    display: table;
    margin:auto ;
    clear: both;
   
     }

.box-latest-news-footer a { margin-top: 20px; padding: 17px 30px 17px 30px !important; background: #be1f3f !important; color: #fff ; font-size: 1.125em;  text-decoration: none !important;   border-radius: 5px; text-transform: uppercase;}

.box-latest-news-footer a:hover { color: #000; background: #d2d3ce !important; border-color: #d2d3ce;} 

.btn:before { background: none; }
.btn:hover:before { background: none; }




.home-banner {
	padding-top: 0;
	display: block;}

.inner-home-banner {font-weight: 200 !important; text-align: center; color: #000; text-transform: uppercase; font-size: 4em;  padding: 30px 0 10px; letter-spacing: 5px; } 

.inner-home-banner span { color: #be1f3f; font-weight: bold; }

.home-banner-img {     
	width: 80%;
    margin: auto;
}


body.theme-v2 .wrap#inner-content {
     display: block; 
  
}


.video-home { width: 100%; margin-top:20px }


h2.label-home { 
	color: #be1f3f;
    font-size: 24px;
    text-align: center;
    display: block;
    line-height: 1.25em;
    margin-top: 0;
    margin-bottom: 20px;
    padding: 30px 0 0;
    font-weight: 700 !important;

	}

/*.video-home h2.label-home span { 
    
    font-weight: normal;

	}*/

.player {
    background: #000000;
    width: 100%;
    height:660px;
    margin: 30px 0 10px;
    border: 2px solid #be1f3f;
    border-radius: 5px;
    }

    body.theme-v2 .box-nav-menu, body.theme-v2 .content-box {

    border-radius: 5px !important;
   
}


.banner_destaque { border-radius: 5px;border: 1px solid #c6d3d9; margin-bottom: -6px; }



.participacao { 
	width: 70%;
    display: table;
    /*background: #131413;*/
    margin: 0 auto 50px;
    border-radius: 5px;
}



.participacao .item { 
	width: 48.5%;  display: block; float: left; 
	margin: 0 2% 0 0.5%;
    background: #d2d3ce;
    text-align: center;
    border-radius: 5px;
    padding: 5px 0; 
    border: 2px solid rgba(76, 78, 75, 1);
    box-shadow: 4px 4px 20px #888888;
     
}

.participacao .item:last-child { margin: 0; }

.destaques { 
	width: 70%;
    display: table;
    /*background: #131413;*/
    margin: 30px auto 0;
    border-radius: 5px;
}

.destaques .item { width: 24%;  display: block; float: left; margin: 0 .5%;
    background: #bbb;
    text-align: center;
    border-radius: 5px;
    padding: 5px 0; 
     
}

.destaques .item:hover { background: #ddd; }


.participacao .item:hover { box-shadow: inset 0px -30px 40px rgb(0 0 0 / 30%), inset 0px 10px 50px rgb(255 255 255 / 50%); }

.destaques .item a  {
    width: auto;
    color: #000;
    text-decoration: none;
}


.participacao .item a  {
    width: auto;
    color: rgba(76, 78, 75, 1);
    text-decoration: none;
}


.participacao .item a span { 
    display: block; font-size: 20px; font-weight: bold; padding: 20px 0;}

.destaques .item a span { margin: -5px 0 5px;
    display: block; font-size: 16px; font-weight: bold;}


.destaques .item a img {
    width: 50px; 
    margin: 0;
    
}

.destaques h2.label-home { 
	color: #be1f3f;
	font-size: 1.5em;
    line-height: 1.25em;
    margin: 10px 0 5px;
    font-weight: bold;

	}


.box-redes { margin: 10px 0 0 ; clear: both; padding: 16px 16px;
    border-radius: 5px;
    border: 1px solid #c6d3d9;
    background: #fff;  }


.caixaflex{
    display: inline-block;
    /* justify-content: space-between; */
    width: 70%;
    list-style: none;
    /* margin-bottom: 40px; */
 
    /*background: rgba(76, 78, 75, 0.2);*/
    margin: 00px 15% 0px; 

    /*box-shadow: 1px 1px 10px #000;*/
}

.caixaflex .item-redes { 
	display: block;
    text-align: center;
    width: 25%;
    float: left;
/*    margin: 20px .5% 0;*/
    /*border: 1px solid rgba(76, 78, 75, 0.1);*/
/*    box-shadow: inset 0px -30px 40px rgb(0 0 0 / 30%), inset 0px 10px 50px rgb(255 255 255 / 50%);*/
    border-radius: 5px;
    padding: 20px 0 0;
	
}

.caixaflex .item-redes span { 
/*	background: #be1f3f;*/
	border-radius: 5px;
    margin: auto;
    padding: 5px 15px;
    color: #000;
    font-size: 14px;
    font-weight: bold;
    display: block;
   

	}

.caixaflex .item-fotos { 
	display: block;
    text-align: center;
    width: 33%;
    float: left;
/*    margin: 20px .5% 0;*/
    /*border: 1px solid rgba(76, 78, 75, 0.1);*/
/*    box-shadow: inset 0px -30px 40px rgb(0 0 0 / 30%), inset 0px 10px 50px rgb(255 255 255 / 50%);*/
    border-radius: 5px;
    padding: 20px 0 0;
	
}



.caixaflex .item-fotos span { 
/*	background: #be1f3f;*/
	border-radius: 5px;
    margin: auto;
    padding: 0px 15px;
    color: #000;
    font-size: 12px;
    font-weight: bold;
    display: block;
   

	}


.caixaflex img { width: 100px; }


.caixaflex .item-redes-img { 
	width: 30%;
    border-radius: 5px;
    border:1px solid #000;
  background: #fff;
    margin-top: 10px;
/* box-shadow: inset 0px -30px 40px rgb(0 0 0 / 30%), inset 0px 10px 50px rgb(255 255 255 / 30%);*/


}


.caixaflex .item-fotos-img { 
	width: 80%;
    border-radius: 5px;
    border:1px solid #000;
  background: #fff;
    margin: 10px auto;
    transition: filter 0.3s ease; /* Suaviza a transição da cor */



}





.caixaflex .item-redes-img:hover {box-shadow: inset 0px -30px 40px rgb(0 0 0 / 50%), inset 0px 10px 50px rgb(255 255 255 / 50%);  }

.caixaflex .item-fotos-img:hover {filter: grayscale(100%) brightness(0.8); /* Deixa a imagem em preto e branco e escurece */ }

@media only screen and (max-width: 480px) {
.box-latest-news-list .box-latest-news-item {
    border-bottom: 0 solid #ededed !important;
    width: 96%;
    height: 150px;
    margin: 20px 1.5% 00px;
    float: left;
    background:  #fff;
    padding: 15px !important;
    border-radius: 5px;
    border-bottom: 3px solid #d2d3ce !important;


}

.inner-home-banner { font-size: 2em; }
.content-box-top .content-box-title { font-size: 1em; }

.header-search-form { display: none; }
.secondary-header { display: none; }

.margem { padding: 0 10px 0; }
.margem .titulo { font-size: 20px; }
.margem .subtitulo { font-size: 12px; }

.top-slider .slider-container img { width: 100%; }

.top-slider .slider-container .cmsp-rslides_tabs a { display: none !important; }

.caixaflex .item-redes { border: 0; }

.box-latest-news-footer a { font-size: .75em; } 

}


@media only screen and (max-width: 768px) {

.destaques .item { width: 47%; margin: 0 1.5% 10px; }

.destaques { width: 100%;}

.participacao { width: 98%;}


	.top-slider { display: block !important; }
}

@media only screen and (max-width: 580px) {

.destaques .item { width: 47%; margin: 0 1.5% 10px; }	

.participacao .item { 
	width: 100%;  
	margin: 0 0 10px; 
    background: #d2d3ce;

     
}

.participacao .item:last-chil  { margin: 0 0 10px;   }

.caixaflex { width: 100%; margin: 00px;  }

.caixaflex .item-redes { 

	width: 50%;
    float: left;
    margin: 0 0%; }



.caixaflex .item-redes-img { 
	width: 50%;
	}

.caixaflex .item-redes span { font-size: 12px; }


}
</style>

	

		<!-- BANNER -->
		<section class="home-banners-container cf">
			<div class="home-banner">

			<div class="inner-home-banner wrap">
			<img class="home-banner-img" src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/posse-2025-horizontal.png"> 
			
				<!-- Posse <span>2025</span> -->

				</div>

			</div>

		</section>


			         

				<!-- TVAOVIVO -->	

							<!-- <div class="cmsp-row wrap">
							
							<div class="video-home">
							<h2 class="label-home"><span>Cerimônia de Posse da 19ª Legislatura da CMSP e eleição da Mesa Diretora de 2025</span></h2>
							<div class="player">
							

							<iframe width="100%" height="100%" src="https://www.youtube.com/embed/" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


							</div>
						    </div>

						   
							</div> -->
			
			


	<!-- CONTEUDO -->

			<section class="noticias-back">

			<div id="inner-content" class="wrap cf">

			<div id="main" class="cf" role="main">



				<!-- conteudo interno -->

				<?php the_content();?>

					



					<!-- REDES SOCIAS -->
							<div class="cmsp-row box-redes">
								<header class="content-box-top">
								    <h2 class="content-box-title">Álbuns de fotos da Cobertura</h2>
								  </header>


								    <div class="caixaflex">
								 

								  <div class="item-fotos"> <a href="https://www.flickr.com/photos/131078419@N07/albums/72177720322655419" target="_blank" title="Álbum de fotos no Flickr"><img class="item-fotos-img" src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/posse.jpg"></a> <span>Posse prefeito Ricardo Nunes e vice-prefeito Coronel Mello Araújo</span></div>

								   <div class="item-fotos"> <a href="https://www.flickr.com/photos/131078419@N07/albums/72177720322652848/" target="_blank" title="Álbum de fotos no Flickr"><img class="item-fotos-img" src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/mesa.jpg"></a> <span>Eleição Mesa Diretora 2025</span></div>

								    <div class="item-fotos"> <a href="https://www.flickr.com/photos/131078419@N07/albums/72177720322655514/" target="_blank" title="Álbum de fotos no Flickr"><img class="item-fotos-img" src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/vereadores.jpg"></a> <span>Posse Vereadores 2025</span></div>
								</div>

								
							</div>




						<!-- ULTIMAS NOTICIAS -->
							<div class="cmsp-row box-redes">

								  <header class="content-box-top">
								    <h2 class="content-box-title">Últimas Notícias</h2>
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
											'category_name' => 'posse-2025',
										));
										
										wp_cache_set($key,$latestQuery,'',600);
								    }
								    while($latestQuery->have_posts()): $latestQuery->the_post();
								    ?>
								      <article class="box-latest-news-item cf">
								        <h3 class="article-title">
								          <span class="date"><?php echo get_the_date('d\.m\.y'); ?></span>
								          <span class="headline"><a href="<?php the_permalink(); ?>"><?php 
							            // Limitar o conteúdo a 30 palavras (ajuste conforme necessário)
							            $content = wp_trim_words(get_the_title(), 10, '...'); 
							            echo $content; 
							            ?></a></span>
								        </h3>

								        <!-- <p>
							            <?php 
							            // Limitar o conteúdo a 30 palavras (ajuste conforme necessário)
							            $content = wp_trim_words(get_the_content(), 30, '...'); 
							            echo $content; 
							            ?>
							        </p> -->


								      </article>
								    <?php endwhile; ?>




								     
								  </div>

								 <footer class="box-latest-news-footer">
								    <a href="<?php echo get_home_url(); ?>/comunicacao/noticias/" class="btn">Todas as notícias</a>
								  </footer> 
							<!-- end box-latest-news -->

							</div><!-- end row -->
						

							<!-- REDES SOCIAS -->
							<div class="cmsp-row box-redes">
								<header class="content-box-top">
									   <h2 class="content-box-title">Acompanhe a Câmara</h2>
								 </header>


								  <div class="caixaflex">

								  

								  <div class="item-redes"><a target="_blank" href="https://www.saopaulo.sp.leg.br/transparencia/auditorios-online/" title="Auditórios Online"><img class="item-redes-img" src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/auditorio.png"></a> <span>Auditórios Online </span> </div>


								  <div class="item-redes"> <a href="https://www.saopaulo.sp.leg.br/redecamara/" target="_blank" title="TV Câmara AO VIVO"><img class="item-redes-img" src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/camarasp.png"></a> <span>TV Canal 8.3 Digital </span></div>

								
								<div class="item-redes"> <a href="https://youtube.com/c/CâmaraMunicipaldeSãoPaulo" target="_blank" title="Youtube"><img class="item-redes-img" src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/youtube.png"></a> <span>YouTube</span></div>

								<div class="item-redes"> <a href="https://api.whatsapp.com/send?phone=551133964000&text=%20Ol%C3%A1,%20tudo%20bem?" target="_blank" title="Zap Câmara"><img class="item-redes-img" src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/zap.png"></a> <span>Zap Câmara</span></div>

								</div>

								
							</div>




							<!-- REDES SOCIAS -->
							<div class="cmsp-row box-redes">
								<header class="content-box-top">
								    
								     <h2 class="content-box-title">Curta, comente e compartilhe</h2>
								  </header>

								  <div class="caixaflex">
								  

								  <div class="item-redes"> <a href="https://facebook.com/camarasaopaulo" target="_blank" title="Facebook" ><img class="item-redes-img" src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/face.png"></a> <span>Facebook </span></div>

								  <div class="item-redes"><a href="https://instagram.com/camarasaopaulo" target="_blank" title="Instagram"><img class="item-redes-img" src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/insta.png"></a> <span>Instagram </span></div>

								  <div class="item-redes"><a href="https://x.com/camarasaopaulo" title="Twitter" target="_blank"><img class="item-redes-img" src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/twitter.png" ></a> <span>X</span></div>

								   <div class="item-redes"><a href="https://twitter.com/camarasaopaulo" title="Linkedin" target="_blank"><img class="item-redes-img" src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/linkedin.png" ></a> <span>Linkedin </span></div>

								</div>
							</div>



						<!-- 	<div class="participacao">
						    		<div class="item">
									<a class="btAgenda" title="Política de Participação" target="_blank" href="https://www.saopaulo.sp.leg.br/politica-de-participacao/"> <span>Política de Participação</span></a></div>

									<div class="item">
									<a class="btAgenda" title="Lei Geral de Proteção de Dados" target="_blank" href="https://www.saopaulo.sp.leg.br/politica-de-privacidade/"> <span>Lei Geral de Proteção de Dados</span></a></div>
							</div>	 -->	



							  <div class="destaques">
						    		<div class="item">
									<a class="btAgenda" title="Vereadores" target="_blank" href="https://www.saopaulo.sp.leg.br/vereadores/"><img src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/vereadores.png"> <span>Vereadores</span></a></div>



									<div class="item"><a title="Agenda da Câmara" class="btAudonline" target="_blank" href="https://www.saopaulo.sp.leg.br/atividade-legislativa/agenda-da-camara/"><img src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/agenda-novo.png"><span>Agenda</span></a></div>

									<div class="item">
									<a class="btAgenda" title="SoundCloud" target="_blank" href="https://soundcloud.com/webradiocamarasaopaulo"><img src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/sound-novo.png"> <span>SoundCloud</span></a></div>

									<div class="item">
									<a class="btAgenda" title="Flickr" target="_blank" href="https://www.flickr.com/photos/131078419@N07/albums/"><img src="http://www.saopaulo.sp.leg.br/retrospectiva2024/wp-content/uploads/sites/65/2024/12/flick-novo.png"> <span>Flickr</span></a></div>
								
							</div>

						
							

						</div>
						</div>
					</section>
</main>
<?php get_footer(); ?>