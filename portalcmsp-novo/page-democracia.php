<?php
/*
 Template Name: Página Especial Democracia
*/
?>

<?php get_header(); ?>

			<div id="content">

			<div class="breadcrumbs cf">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p class="wrap cf">','</p>');
				} ?>
			</div>

				<div id="inner-content" class="wrap cf">

						<div id="main" class="two-column-main cf" role="main" style="width:760px;">

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
											Créditos da equipe: <strong>Coordenção</strong> Flavio Munhoz <strong>Editor Chefe</strong> Marcelo Ruiz <strong>Reportagem</strong> Roberto Vieira, Kátia Kazedani, Rafael Carneiro da Cunha, Jeldean Silveira <strong>Fotografia</strong> André Bueno, Luiz França <strong>Vídeo</strong> André Bueno, Rafael Merino <strong>Edição de imagens</strong> Erica Mansberger <strong>Grafismos</strong> Rafael Merino <strong>Criação e Produção Web</strong> Allan Scupinari <strong>Apoio Técnico</strong> Marcello Farah <strong>Fotos/vídeos de arquivo</strong> Bike é Legal, Cidade Para Pessoas, Cinemateca Brasileira, São Paulo Antiga.<br /><br />© 2016 CÂMARA MUNICIPAL DE SÃO PAULO
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
										<header class="content-box-top" style="background-color:#fff;height:55px;">
											<a href="#"><img src="/wp-content/uploads/2016/06/democracia.png" alt="especial_minhocao" width="184" height="48" style="margin:1px 5px;border:0px;" border="0"></a>
										</header>

										<ul class="box-nav-menu-list" style="padding-left:20px;">
											<li><a href="#democracia">Democracia</a></li>
											<li><a href="#representatividade">Representatividade</a></li>
											<li><a href="#vereadores">Vereadores</a></li>
											<li><a href="#direitos-e-deveres">Direitos e deveres</a></li>
											<li><a href="#linhadotempo">Linha do Tempo</a></li>
										</ul>

									</section><!-- end box-nav-menu -->

							</div>

						</div>

				</div>

			</div>
</main>
<?php get_footer(); ?>
