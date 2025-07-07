<?php
/*
 Template Name: Junho Lilas
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
    /* border-bottom: 3px solid #cb6ce6; */
    margin-bottom: 0;
    background: #cb6ce6;
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



.home-banner {
	padding: 30px 0 50px;
	background: #eeeeee;
    background-position: center top;
    background: url(https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/back_posse.jpg) no-repeat !important;
    background-size: 100%;
   
}


.inner-home-banner {
    font-weight: 200 !important;
    text-align: center;
    color: #918f8f;
    text-transform: uppercase;
    font-size: 4em;
    padding: 40px 0 10px;
    letter-spacing: 5px;
}


.inner-home-banner span {
    color: #cb6ce6;
    font-weight: bold;
}


.home-banner-img { width: 100%; }

.banner {width: 100%; border-radius: 5px; margin-top: 20px; box-shadow: 0px 0px 30px 0px  #cccccc;}

.conteudo { margin: 10px 0 30px; padding: 20px 30px; background: #fff; border-radius: 5px; box-shadow: 0px 0px 30px 0px  #cccccc;  }
.conteudo p { color: #918f8f; text-align: justify; font-size: 16px; }

.conteudo p a { color: #cb6ce6; font-weight: bold; text-decoration: none;  }
.conteudo p a:hover {  text-decoration:underline; }

.conteudo h3 {color: #cb6ce6; font-weight: bold;}


.video-home { float: left; width: 100%; }


.video-home h2.label-home { 
	color: #cb6ce6;
    font-size: 1.5em;
    line-height: 1.25em;
    margin-top: 0;
    font-weight: bold;

	}

.video-home h2.label-home span { 
    

	}

.player {
    float: left;
    background: #000000;
    width: 100%;
    height:420px;
    margin-bottom: 10px;
    border: 3px solid #cb6ce6;
    border-radius: 5px;
    }




.box-redes { margin: 30px 0 0 ; clear: both;  }


.caixaflex {
    display: inline-block;
    /* justify-content: space-between; */
    width: 70%;
    list-style: none;
    /* margin-bottom: 40px; */
    /* background: rgba(76, 78, 75, 0.2); */
    margin: 0px 15% 0px;
    /* box-shadow: 1px 1px 10px #000; */
}


.caixaflex .item-redes { 
	display: block;
    text-align: center;
    width: 24%;
    float: left;
    margin: 20px .5% 0;
     /*border: 1px solid rgba(76, 78, 75, 0.1); */
     /*box-shadow: inset 0px -30px 40px rgb(0 0 0 / 30%), inset 0px 10px 50px rgb(255 255 255 / 50%); */
    border-radius: 5px;
    padding: 20px 0;
	
}


.caixaflex .item-redes span { 
/*	background: #cb6ce6;*/
	 border-radius: 5px;
    margin: auto;
    padding: 5px 15px 0;
    color: #918f8f;
    font-size: 14px;
    font-weight: bold;
    display: block;
}
   


.caixaflex .item-redes-img { 
	width: 30%;
    border-radius: 5px;
    /* border: 1px solid #000; */
    background: #cb6ce6;
    margin-top: 10px;
    box-shadow: inset 0px -30px 40px rgb(0 0 0 / 30%), inset 0px 10px 50px rgb(255 255 255 / 30%);
}


.caixaflex .item-redes-img:hover {
    box-shadow: inset 0px -30px 40px rgb(0 0 0 / 50%), inset 0px 10px 50px rgb(255 255 255 / 50%);
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
.caixaflex .item-redes { width: 49%; }

.caixaflex .item-redes-img { 
	width: 100px;
	height: 100px;
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
				Junho <span>lilás</span>
		
			</div>

			</div>

		</section>
		
			
			<!-- CONTEUDO -->
			<div id="content">

				<div id="inner-content" class="wrap cf">

                    <img class="banner" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2022/05/banner_teste.jpg">

						<div id="main" class="cf conteudo" role="main">


							<?php the_content(); ?>

                            </div><!-- end row -->

						<!-- TVAOVIVO -->	

							<div class="cmsp-row">
							
							<div class="video-home">
							<h2 class="label-home"><span>Junho Lilás - A importância do exame</span></h2>
							<div class="player">
							

							<iframe width="100%" height="100%" src="https://www.youtube.com/embed/kz3yga2pGJ8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


							</div>
						    </div>

						  
							</div>


							



							<div class="cmsp-row box-redes">
								<header class="content-box-top">
								    
								     <h2 class="content-box-title">Curta, comente e compartilhe</h2>
								  </header>

								  <div class="caixaflex">
								  

								  <div class="item-redes"> <a href="https://facebook.com/camarasaopaulo" target="_blank" title="Facebook"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/02/face.png"></a> <span>Facebook </span></div>

								  <div class="item-redes"><a href="https://instagram.com/camarasaopaulo" target="_blank" title="Instagram"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/02/insta.png"></a> <span>Instagram </span></div>

								  <div class="item-redes"><a href="https://twitter.com/camarasaopaulo" title="Twitter" target="_blank"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/02/twitter.png"></a> <span>Twitter </span></div>

								   <div class="item-redes"><a href="https://twitter.com/camarasaopaulo" title="Linkedin" target="_blank"><img class="item-redes-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/02/linkedin.png"></a> <span>Linkedin </span></div>

								</div>
							</div>
							
                            
						
							

						</div>

				</div>

			</div>
</main>
<?php get_footer(); ?>
