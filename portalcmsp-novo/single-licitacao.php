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
								<h2 class="page-title" itemprop="headline"><?php the_title();?></h2>
								<br/>
								<b>Status:</b> <?=get_field( "status" )?><br/>
								<b>Tipo:</b> <?=get_field( "tipo" )?><br/>
								<b>Número:</b> <?=get_field( "numero" )?><br/>
								<b>Ano:</b> <?=get_field( "ano" )?><br/>
								<b>OC BEC:</b> <?=get_field( "oc_bec" )?><br/>
								<b>Descrição:</b> <?=get_field( "descricao" )?><br/>
								<b>Observação:</b><br/><?=get_field( "observacao" )?><br/>
								<b>Anexos:</b><br/>
								<?php
									// get repeater field data
									$repeater = get_field('anexos');

									// vars
									$order = array();

									// loop through repeater
									if( $repeater ): ?>

										<ul>

										<?php 

											// populate order
											foreach( $repeater as $i => $row ) {
												
												$order[ $i ] = $row['data'];
												
											}

											// multisort
											array_multisort( $order, SORT_DESC, $repeater );
											
											foreach( $repeater as $i => $row ): 

											$a_file = $row['arquivo'];												
											$a_data = new DateTime($row['data']);
											$a_titulo =  $row['titulo'];
											$a_descricao =  $row['descricao'];
											$a_observacao =  $row['observacao'];
											$a_nome = $a_data->format('d/m/Y').' - '.$a_titulo.' - '.$a_descricao;
											?>
											<div style="margin-top: 10px;">
												<li><a href="<?=$a_file['url'];?>" target="_blank"><?=$a_nome?></a></li>
												<b style="font-size: .9em;"><?=$a_observacao?></b>
											</div> 

										<?php endforeach; ?>

										</ul>

									<?php endif; ?>	
								
								<br/>
							</header>

							<section class="entry-content cf" itemprop="articleBody">
							</section>

						</article>
						<?php endwhile; else : ?>

						<article id="post-not-found" class="hentry cf">
							<header class="article-header">
								<h1><?php _e( 'Oops, Post Não Encontrado!', 'bonestheme' ); ?></h1>
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

<?php get_footer(); ?>
