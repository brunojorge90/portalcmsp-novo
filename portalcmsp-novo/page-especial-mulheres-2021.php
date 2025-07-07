<?php
/*
 Template Name: Especial Mulheres 2021
*/
?>


<?php get_header(); ?>


<style>

.two-column-main { width: 100%; max-width: 760px; }	

a, a:visited { color: #741789; font-weight: bold; text-decoration: none; }
a:hover { color: #741789; font-weight: 500; text-decoration: none; }

#back-logo { 
	background: url(https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/02/textura-horizontal.png); 
	background-size: cover; background-position: top center; background-repeat: no-repeat;
}


img.logo-mulher { display: block; margin: auto; padding: 15px;  }

.breadcrumbs { background: #731688;  margin-bottom: -3px;}

.video { border-radius: 10px; background: #731688; display: block; }
.video iframe { border-radius: 10px; border: 5px solid transparent; width: 100%}

table.topo { background: #741789; border-radius: 10px; border:0; margin-top: 10px; }

h2  { margin: 0;  }
h2 span.titulo { color: #f7e7cd; padding-left: 15px;  }

p { text-align: justify; }





.galleria-theme-classic {background: #f7e7cd; border-radius: 10px;}

.galleria-theme-classic .galleria-thumbnails .galleria-image { width: 45px !important; }

.galeria { background: #f7e7cd;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    padding: 15px;
    text-align: center;
    margin-top: -5px; }

span.legenda { color: #741789; }   
span.legenda a { color: #741789; text-decoration: none; }   
span.legenda a:hover { color: #741789; font-weight: bold;} 


table.perfil { background: #f7e7cd; border-radius: 10px; border: 0; }
.entry-content td { border-right: 1px solid #741789; padding: 10px; width: 33%; }
.color2 { background: #fefaef; }

.entry-content td .wp-caption {background: transparent !important; margin-bottom: 0 !important;}

.entry-content tr {border-bottom: 0 !important;}


table.perfil p a, table.perfil p a:hover  { text-decoration: none;  }

table.perfil span.titulo-perfil { 
	text-align: center !important;
	color: #f7e7cd;
    background: #741789;
    text-decoration: none;
    font-size: 14px;
    display: block;
    font-weight: bold;
    padding: 5px 0;
    border-radius: 5px; }


table.perfil span.texto-perfil {color: #000; text-align: center !important; font-weight: 500;  text-decoration: none; display: block; font-size: 16px; }

table.perfil p.nota { font-weight: bold; font-weight: bold; text-align: center; font-size: 12px; }


.credits { margin-top: 0; border-radius: 10px;
    background: #741789; color: #f7e7cd; padding:20px; font-size: 12px;}


.content-box-top {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom: 3px solid #f4ebcc;
}

.content-box {
    border-bottom: 20px solid #741789;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

.box-nav-menu-list { border:0; }
.box-nav-menu-list li { border-bottom: 2px solid #f4ebcc;}

.box-nav-menu-list a:hover { color: #741789; }


.wp-caption { background: #f7e7cd !important; padding: 10px; border-radius: 10px;}
.wp-caption p.wp-caption-text {color: #741789;}
.wp-caption img[class*="wp-image-"] {border-radius: 5px;}


.elisa01{ display: block; }
.elisa02{ display: none; }

.ana01{display: block;}
.ana02{display: none;}
.ana03{display: none;}

/*
.tl-slide .tl-slide-content-container { display: block; margin-top: 30px; }*/

.entry-content .external-content-iframe {height: 700px;}




@media only screen and (max-width: 480px) {

.breadcrumbs { background: #731688;  margin-bottom: -3px; margin-top: 20px;}	

.secondary-header { display: none; }
.header-search-form { display: none; }	

.wrap {width: 100%;}

img.logo-mulher { width: 100%; }

#sidebar1 {width: 90% !important; margin: 0 5%;  display: none;}	

.entry-content td { width: 100% !important; display: block; text-align: center; border: 0; }	

.entry-content td .wp-caption {display: contents;}

.video iframe {height: 250px;}

.elisa01{ display: none; }
.elisa02{ display: block; }

.ana01{display: none;}
.ana02{display: block;}

.theo { width: 100%;   }

}	

	</style>




			<div id="content">

			<div class="breadcrumbs cf">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p class="wrap cf">','</p>');
				} ?>
			</div>

			<div id="back-logo">
			<img class="logo-mulher" src="https://www.saopaulo.sp.leg.br/wp-content/uploads/2021/02/logo-especial-mulher.png">
		    </div>


				<div id="inner-content" class="wrap cf">

						<div id="main" class="two-column-main cf" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<section class="entry-content cf" itemprop="articleBody">
									<?php
										// the content (pretty self explanatory huh)
										the_content();

										// include an iframe of legacy content if selected in the admin
										if(get_post_meta($post->ID,'_cmsp_page_legacy-type',true) == 'iframe') {
											$iframe_src = get_post_meta($post->ID,'_cmsp_page_legacy-url',true);
											$iframe_height = get_post_meta($post->ID,'_cmsp_page_legacy-height',true);
											if(preg_match('/saopaulo.sp.leg.br\/index.php/',$iframe_src) == 1) {
												$iframe_src .= '&template=none';
											}
											echo '<iframe class="external-content-iframe" src="'. $iframe_src .'" style="height:'.$iframe_height.'px;"></iframe>';
										}

										/*
										 * Link Pages is used in case you have posts that are set to break into
										 * multiple pages. You can remove this if you don't plan on doing that.
										 *
										 * Also, breaking content up into multiple pages is a horrible experience,
										 * so don't do it. While there are SOME edge cases where this is useful, it's
										 * mostly used for people to get more ad views. It's up to you but if you want
										 * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
										 *
										 * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
										 *
										*/
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );

									?>
									<div class="one-column">
										<div class="credits">
											<?php echo get_field("creditos"); ?><br>© <?php echo date("Y");?> Câmara Municipal de São Paulo
										</div>
									</div>
								</section> <?php // end article section ?>

							</article>

							<?php endwhile; endif; ?>

						</div>
						<style>
						        #sidebar1 { width:200px; float:right; margin-top:22px;}

						</style>
						<script>
							jQuery(document).ready(function($){
								var offset = $("#sidebar1").offset();
								var topPadding = 22;
								$(window).scroll(function() {
									if ($(window).scrollTop() > offset.top) {
										$("#sidebar1").stop().animate({
											marginTop: $(window).scrollTop() - offset.top + topPadding
										});
									} else {
										$("#sidebar1").stop().animate({
											marginTop: 22
										});
									};
								});
							});
						</script>
						<div id="sidebar1" class="sidebar sidebar-page" role="complementary">

							<div class="subpage-navigation clearfix">

									<section class="content-box box-nav-menu">
										<header class="content-box-top" style="background-color:<?php echo get_field("cor_fundo_submenu"); ?>;height:55px;">
											<a href="#"><img src="<?php echo get_field("imagem_do_submenu"); ?>" alt="especial_minhocao" width="184" height="44" style="margin:5px;border:0px;" border="0"></a>
										</header>

										<ul class="box-nav-menu-list" style="padding-left:20px;">
										<?php if( have_rows('links_ancoras') ): ?>
											<?php while( have_rows('links_ancoras') ): the_row();
												// vars
												$key = get_sub_field('link_key');
												$value = get_sub_field('link_value');
												?>
												<li><a href="<?php echo $key; ?>"><?php echo $value; ?></a></li>
											<?php endwhile; ?>
										<?php endif; ?><!-- / ancoras -->
										</ul>

									</section><!-- end box-nav-menu -->

							</div>

						</div>

				</div>

			</div>
</main>
<?php get_footer(); ?>
