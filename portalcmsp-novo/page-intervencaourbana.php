<?php
/*
 Template Name: Intervenção Urbana
*/
?>

<?php get_header(); ?>

<style>


.footer { padding-bottom:50px !important; }

.introducao { 
	display: block;
	margin: 20px 0 40px;


}

.introducao span { 
	display: block;
	color: #be1f3f;
    font-size: 2em;
    font-weight: 600;
    line-height: 1.25em;
    

}


.introducao p { 
	color: #333333;
    font-size: 1em;
    font-weight: 500;
    text-align: justify;
    

}


.introducao p a { text-decoration: none; font-weight: bold; color: #be1f3f;}
.introducao p a:hover { color: #000;}


#content { 
    background: url(https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/12/back_cont.jpg) repeat !important;
    background-size: cover !important;
    background-position: center top !important;
    display: flex;
   
} 

.content-box {
    
    border: 0px !important;
    background: transparent !important;
    width: 100% !important ;
    float: left;
}

.content-box-top .content-box-title a:hover { color: #ff1616; text-decoration: none; }


.content-box-top {
    border: 0;
    margin-bottom: 0;
    overflow: initial;
    height: auto;
    
}

.content-box-top .content-box-title:before {
    border-right: 0;
}

.content-box-top .content-box-title {
/*    padding: 20px 0 30px 0;*/
    margin: auto;
    font-size: 1.18em;
    line-height: 40px;
    color: #000;
    font-weight:bold;
  
    gap: 0 !important;

}

.box-latest-news .content-box-top { 
	border-bottom: 3px solid #be1f3f !important; 
    margin-bottom: 0;
    background: transparent; 
    border-radius: 0; }


    .content-box-top .content-box-title:before {

        display: none;
    }
 
/*.box-latest-news-list { display: flex; }*/

.box-latest-news-list .box-latest-news-item {
    border-bottom: 0 solid #ededed !important;
    width: 100%;
    margin-top:  30px;
    /*padding-bottom: 20px;*/
}

.box-latest-news-list .box-latest-news-item span.date { 
    background: #be1f3f;
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

.box-latest-news-list .box-latest-news-item h3.article-title { margin: 0; display: block !important; }

.box-latest-news-list .box-latest-news-item span.headline { 

   padding: 10px;
   display: block;

 }

.box-latest-news-list a { 
	color: #be1f3f;
/*	margin: 20px 0 5px 0;*/
    line-height: 1;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;


 }


 .box-latest-news-list a:hover { 
	color: #000;

 }

.box-latest-news-footer { 
	color: white;
    text-transform: uppercase;
    padding: 8px 65px;
    text-decoration: none;
    background: #be1f3f url(../images/plus.png) no-repeat;
    display: table;
    margin: auto;
    border-radius: 5px;
    clear: both;
   
     }

   .box-latest-news-footer a { color: #fff !important; font-size: 1em;  text-decoration: none !important; background: transparent;  }  




.home-banner {
	padding: 0 0 30px;
	display: block;
	background: #be1f3f;
}


.inner-home-banner {font-weight: 500 !important; text-align: center; color: #fff; text-transform: uppercase; font-size: 3em;  padding: 40px 0 10px; } 

.inner-home-banner span { font-weight: bold; }

.home-banner-img { width: 100%; }

.video-home { float: left; width: 100%; }


.video-home h2.label-home { 
	color: #be1f3f;
    font-size: 2em;
    line-height: 1.25em;
    margin: 20px 0;
   

	}

.video-home h2.label-home span { 
    
    font-weight: bold !important;

	}

.player {
    float: left;
    background: #000000;
    width: 100%;
    height:420px;
    margin-bottom: 10px;
    border: 3px solid #be1f3f;
    border-radius: 5px;
    }




.box-redes {  background: #be1f3f; padding: 20px 0 0; color: #fff !important; }

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
    width: 46%;
    min-height: 120px;
    margin: 30px 2% 0;
    float: left;
    font-size: 15px;
        text-align: justify;
}

.box-latest-news-list .box-latest-news-item:last-child {
    margin: 30px 2% 30px;


}}


@media only screen and (max-width: 768px) {
.video-home h2.label-home { text-align: center; font-size: 1.5em; }
.video-home h2.label-home span { display: block; }


.inner-home-banner {font-size: 2.5em; line-height: 1.2;  } 

.box-redes h2 {line-height: 1.2 !important; }


.caixaflex {
    width: 60%;
    margin:0 20% 0; 

    /*box-shadow: 1px 1px 10px #000;*/
   
}

.caixaflex .item-redes { width: 25%;}

.caixaflex .item-redes-img { width: 50%;}

.content-box-top .content-box-title  { line-height: 20px; padding: 0 0 20px;
    font-size: 1em;}


}

@media only screen and (max-width: 580px) {
.caixaflex .item-redes { width: 100%; margin: 0; }

.caixaflex .item-redes { width: 25%;}

.caixaflex .item-redes-img { width: 50%;}

.caixaflex .item-redes span {
 
     padding: 0; 
    font-size: 12px;
}



}
</style>

		<!-- BANNER -->
		<section class="home-banners-container cf">
			<div class="home-banner">
			<div class="inner-home-banner wrap">
				Intervenção <span>Urbana</span>
			<!-- <img class="home-banner-img" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/02/logo-camara-agora-novo.png"> --> 
			</div>

			</div>

		</section>
		
		
			
			<!-- CONTEUDO -->
			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="cf" role="main">

							
						

							<!-- <div class="cmsp-row">
							
							<div class="video-home">
							<h2 class="label-home"><span>Projetos de Intervenção Urbana</span></h2>

							<div class="player">
							

							<iframe width="100%" height="100%" src="https://www.youtube.com/embed/HBtLxoivH4o" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; height: 100%;"></iframe>


							</div>
						    </div>

						    
							</div> -->


							<?php the_content();?>

							
						

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