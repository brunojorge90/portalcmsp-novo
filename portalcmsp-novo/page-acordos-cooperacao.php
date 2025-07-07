<?php
/*
 Template Name: Acordos de Cooperação Técnica
*/
?>

<?php get_header(); ?>
<script>
jQuery(document).ready(function($){
	//Initially hide all the item-content
    $('.item-content').hide();
    
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
						
						<?php
						setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
						$posts = get_posts(array(
							'post_type'  => 'acordo_cooperacao',
							'orderby'    => array(
												'order_ano' => 'DESC',
												'order_numero' => 'DESC',
												),
							'numberposts' => '-1',
							'meta_query'	=> array(
								'relation'		=> 'AND',
								array(
									'key'	 	=> 'status',
									'value'	  	=> 'Ativo',
									'compare' 	=> '=',
								),
								'order_ano' => array(
									'key' => 'ano',
									'compare' => 'EXISTS'
								),
								'order_numero' => array(
									'key' => 'numero',
									'compare' => 'EXISTS',
									'type' => 'NUMERIC'
								)
							)							
						
						));						
						?>
						
						<?php
						foreach ($posts as $post) { ?>
						
							<div style="border: 1px #ccc solid; padding: 15px; margin: 10px 0px 10px 0px;">
								<div><h2><b>Acordo de Cooperação Técnica nº <?=get_field('numero');?>/<?=get_field('ano');?></b><br/><?php /*the_title()*/; ?></h2></div>
								<div><?php the_field('extrato') ?></div>
								<div style="margin-top: 10px;">
									
									<?php
									// get repeater field data
									$repeater = get_field('anexos');

									// vars
									$order = array();

									// populate order
									foreach( $repeater as $i => $row ) {
										
										$order[ $i ] = $row['arquivo'];
										
									}

									// multisort
									array_multisort( $order, SORT_DESC, $repeater );

									// loop through repeater
									if( $repeater ): ?>

										<ul>

										<?php foreach( $repeater as $i => $row ): 
											$a_file = $row['arquivo'];												
											//$a_data = new DateTime($row['data']);
											//$a_titulo =  $row['titulo'];
											//$a_descricao =  $row['descricao'];
											//$a_observacao =  $row['observacao'];
											//$a_nome = $a_data->format('d/m/Y').' - '.$a_titulo.' - '.$a_descricao;
											?>
											<div style="margin-top: 10px;">
												<li><a href="<?=$a_file['url'];?>" target="_blank"><?=$a_file['title'];?></a></li>
											</div> 

										<?php endforeach; ?>

										</ul>

									<?php endif; ?>		
								
								</div>
							</div>	
							
						<?php } ?>
						
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
