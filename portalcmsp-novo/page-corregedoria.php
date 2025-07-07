<?php
/*
 Template Name: Corregedoria
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
					<div id="main" class="cf" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post();?>

						<article id="post-<?php the_ID();?>" <?php post_class('cf');?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

							<header class="article-header">
								<h1 class="page-title" itemprop="headline"><?php the_title();?></h1>
							</header>

							<section class="entry-content cf" itemprop="articleBody">
								<?php the_content();?>
								<div style="clear:both;"></div>

								<?php
								// $args = array(
								// 	'meta_query' => array(
								// 			array(
								// 				'key' => '_cmsp_vereador_name',
								// 				'value' => array('Adilson Amadeu', 'Alfredinho'),
								// 				'compare' => 'IN'
								// 			),
								// 		)
								// );
								// $query = new WP_Q%uery($args);
								// echo $query;

								//echo '<h4 style="font-size: 1em;border-bottom: 2px #ccc solid;margin: .5em 0px .5em;float: left;">aaa'.$query.'</h4>';

								$posts = get_posts(array(
									'post_type' => 'corregedoria',
									'meta_key' => 'data_de_inicio',
									'orderby' => array('data_de_inicio' => 'DESC')));

								$first = true;
								foreach ($posts as $post) {
									if($first){
									?>
										<h4 style="font-size: 1em;border-bottom: 2px #ccc solid;margin: .5em 0px .5em;float: left;"><?=$post->post_title?></h4>
										<div style="clear:both;"></div>
										<br/><b>Corregedor Geral:</b><br/>
										<?php
										$inicio = new DateTime(get_field('data_de_inicio'));
										$termino = new DateTime(get_field('data_de_termino'));
										foreach(get_field('corregedor') as $p){
											 ?>
											 <a href="<?=get_home_url()?>/?p=<?=$p->ID?>" target="_blank"><?=get_the_title($p->ID)?></a><br/>
											 <?php
										}
										?>
										<br/><b>Demais Membros:</b><br/>
										<?php
											foreach(get_field('membros_da_corregedoria') as $p){
												?>
												<a href="<?=get_home_url()?>/?p=<?=$p->ID?>" target="_blank"><?=get_the_title($p->ID)?></a><br/>
												<?php
											}
										?>
										<br/>
										<b>Atribuições:</b> <?=get_field("atribuições")?><br/><br/>
										<b>Data de início:</b> <?=$inicio->format('d/m/Y')?><br/>
										<b>Data de término:</b> <?=$termino->format('d/m/Y')?><br/><br/>
										<?php
										while (have_rows('arquivos')) : the_row();
											$file = get_sub_field('arquivo');
											?>
											<a href="<?=$file['url']?>" target="_blank"><?=get_sub_field("descrição_do_arquivo")?></a><br/>
											<?php
										endwhile;
										?>
										<br/>
										<h4 style="font-size: 1em;border-bottom: 2px #ccc solid;margin: .5em 0px .5em;float: left;">Corregedorias anteriores:</h4>
										<br/><br/>
										<?php
										$first=false;
									}else{
									?>
										<a href="<?=get_home_url()?>/?p=<?=$post->ID?>" target="_blank"><?=$post->post_title?></a><br/>
										<div style="clear:both;"></div>
										<?php
									}
								}
								?>
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
												<li><a <?php if($blank) echo 'target="_blank" '; ?>
													href="<?php echo $file['file']; ?>"><?php echo $file['title']; ?></a></li>
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

					</div>
				</div>

			</div>
</main>
<?php get_footer(); ?>
