<?php
/*
 Template Name: Agenda (2017)
*/
date_default_timezone_set("America/Sao_Paulo");
?>

<?php get_header(); ?>
   <main> 
	<div id="content">
        <section id="topo-agenda" class="w100">
            <div class="config-image-bg w100">
                <img src="../images/backgroundAgenda.jpg" class="w100">

                <div class="abs mt-32">
                    <div class="container">
                        <div class="desktop-body-3">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>/</li>
                                <li><strong>Agenda da câmara</strong></li>
                            </ul>
                        </div>

                        <h1 class="mt-44 desktop-headeline-2">Agenda da câmara</h1>
                        <span class="desktop-headeline-4 mt-12">Acompanhe nossa agenda, e fique por dentro das iniciativas na cidade.</span>

                        <div class="barra-acoes">
                            <div class="itens-esquerda">
                                <input type="date" id="start-date" name="start-date" class="field-style field-date">
                                <span class="desktop-body-2">até</span>
                                <input type="date" id="finish-date" name="finish-date" class="field-style field-date">
                            </div>

                            <div class="itens-direita">
                                <a href="#" class="button-primary">Filtrar</a>
                                <a href="#" class="button-secondary">Baixar PDF da agenda completa</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
	

	
        <section id="agenda-completa">
            <div class="abs">
                <div class="container">
                    <div class="ct-agenda">
                        <div class="topo-proximos-eventos">
                            <h2 class="desktop-headeline-4">
                                <img src="../images/icon-calendario-check.svg" alt="Próximos eventos">
                                Próximos eventos
                            </h2>

                            <div class="cj-exibicao">
                                <input type="radio" name="modo-exibicao" checked="checked" class="exibicao-card">
                                <input type="radio" name="modo-exibicao" class="exibicao-lista">
                            </div>
                        </div>

                        <div>
                            <center><p class="desktop-headeline-2">Aqui fica conteúdo da página</p></center>
                        </div>
                    </div>

                </div>
            </div>
        </section>
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="breadcrumbs cf">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p class="wrap cf">','</p>');
				} ?>
			</div>

			<div class="section-title">
				<h2 class="wrap icon-clock-large-red"><?php the_title();?></h2>
			</div>

			<div id="inner-content" class="wrap cf">

				<div id="main" class="cf" role="main">

					<article id="post-<?php the_ID();?>" <?php post_class('cf');?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						<header class="article-header">
							<h1 class="page-title" itemprop="headline">Próximos Eventos</h1>
						</header> <?php // end article header ?>

						<section class="entry-content cf" itemprop="articleBody">
							<a href="javascript:window.print();" class="btn">Imprimir Agenda</a>
							<div class="agenda-events-list" data-when="today">
								<article>

											</tbody>
										</table>
									</article>
									</div>
									<a href="javascript:window.print();" class="btn">Imprimir Agenda</a>
								</section>

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
													<li>
														<a <?php if($blank) echo 'target="_blank" '; ?> href="<?php echo $file['file']; ?>">
															<?php echo $file['title']; ?>
														</a>
													</li>
												<?php endforeach; ?>
											</ul>
										</section>
									<?php endif;?>
								</footer>

							</article>

						</div>
				</div>

		<?php endwhile; endif;?>
	</div>
</main>
<?php get_footer();?>
