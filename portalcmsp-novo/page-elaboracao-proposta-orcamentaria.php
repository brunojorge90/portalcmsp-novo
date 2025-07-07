<?php
/*
 Template Name: Home Elaboração da Proposta Orçamentária
*/
?>

<?php get_header(); ?>
<script>
jQuery(document).ready(function($){
	//Initially hide all the item-content
    //$('.item-content').hide();
    
    // Attach a click event to item-title
    $('.item-title').on('click', function (e) {
		e.preventDefault();
        //Find the next element having class item-content
        $(this).next('.item-content').toggle();
    });
	//$('#ano-atual').show();
});
</script>
	<div id="content">
		
		<div class="breadcrumbs cf">
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p class="wrap cf">','</p>');
			} ?>
		</div>

			<div id="inner-content" class="wrap cf">

				<div id="main" class="two-column-main cf" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						<header class="article-header">

							<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

						</header> <?php // end article header ?>

						<section class="entry-content cf" itemprop="articleBody">
						<?php the_content();?>
						<div style="clear:both;"></div>
						<div>
							<p><b>CTEO - Consultoria Técnica de Economia e Orçamento</b></p>
						</div>
						<?php
						setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
						$posts = get_posts(array(
							'post_type'  => 'cteo',
							'orderby'    => array(
												'order_ano' => 'DESC'
												),
							'numberposts' => '-1',
							'meta_query' => array(
												array(
													'key' => 'tipo',
													'value' => 'proposta'
												),
												'order_ano' => array(
													'key' => 'ano',
													'compare' => 'EXISTS'
												)
										)
						));
						$ano = '';
						?>

						<?php 
						foreach ($posts as $post) { 
							$arquivo = get_field("arquivo");
						
							if ($ano != '' && $ano != get_field("ano")){
								$ano = get_field("ano");?>
										</ul>
									</div>
								</div>
								<div class="item-title"><b><a href=""><?='Elaboração da Proposta Orçamentária ' . $ano . ' e Plano Plurianual'?></a></b></div>
									<div class="item-content"> 
										<div class="item-body">	
											<ul>
																		
					  <?php }
							
							if ($ano == ''){
								$ano = get_field("ano");?>
								<div class="item-title"><b><a href=""><?='Elaboração da Proposta Orçamentária ' . $ano . ' e Plano Plurianual'?></a></b></div>
									<div class="item-content" id="ano-atual"> 
										<div class="item-body">
										<ul>
					  <?php }?>

								  <?php $titulo = get_field('titulo');?>
										<li><a href="<?=$arquivo['url'];?>" target="_blank"><?=$titulo?></a></li>			
						<?php
						}								
						//Encerra tudo?>
							</ul>
							</div>
						</div>
							<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
						</section> <?php // end article section ?>

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
											<li><a <?php if($blank) echo 'target="_blank" '; ?> href="<?php echo $file['file']; ?>"><?php echo $file['title']; ?></a></li>
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
				<?php
				// if social media page is parent, show social media sidebar
				$social_page_id = 23867;
				if(in_array($social_page_id, $post->ancestors)):
					get_sidebar('buddypress');
				else:
					get_sidebar('page');
				endif;
				?>

		</div>

	</div>
</main>
<?php get_footer(); ?>
