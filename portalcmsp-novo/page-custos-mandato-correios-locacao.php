<?php
/*
 Template Name: Custos de Mandato - Correio e Locação de Veículo
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
	$('#ano-atual').show();
});
</script>
	<div id="content">

		<div class="breadcrumbs cf">
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p class="wrap cf">','</p>');
			} ?>
		</div>

		<div id="inner-content" class="wrap cf">

			<div id="main" class="cf" role="main">

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					<header class="article-header">
						<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
					</header><?php //end article header ?>

					<section class="entry-content cf" itemprop="articleBody">
						<?php the_content();?>
						<div style="clear:both;"></div>

						<?php
						setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
						$posts = get_posts(array(
							'post_type'  => 'custos_mandato',
							'meta_query' => array(
								'ano_clause' => array(
									'key' => 'ano'
								),
								'tipo_clause' => array(
									'key' => 'tipo'
								),
								'mes_clause' => array(
									'key' => 'mes'
								)
										),
							//'meta_key'  => 'ano',
							'numberposts' => '-1',
							'orderby'    => array('ano_clause' => 'DESC', 'tipo_clause' => 'DESC', 'mes_clause' => 'ASC')
							//'orderby'    => array('ano' => 'DESC', 'tipo' => 'DESC', 'mes' => 'ASC')
						));
						$ano = '';
						$nomeDosMeses = [
							"m01" => "Janeiro",
							"m02" => "Fevereiro",
							"m03" => "Março",
							"m04" => "Abril",
							"m05" => "Maio",
							"m06" => "Junho",
							"m07" => "Julho",
							"m08" => "Agosto",
							"m09" => "Setembro",
							"m10" => "Outubro",
							"m11" => "Novembro",
							"m12" => "Dezembro"
						];
						
						foreach ($posts as $post) { 
							$arquivo = get_field("arquivo_pdf");
						
							if ($ano != '' && $ano != get_field("ano")){
								$ano = get_field("ano");?>
										</ul>
									</div>
								</div>
								<div class="item-title"><a href=""><?=$ano?></a></div>
									<div class="item-content"> 
										<div class="item-body">	
											<ul>
																		
					  <?php }
							
							if ($ano == ''){
								$ano = get_field("ano");?>
								<div class="item-title"><a href=""><?=$ano?></a></div>
									<div class="item-content" id="ano-atual"> 
										<div class="item-body">
										<ul>
					  <?php }?>
							<li>							
								<a href="<?=$arquivo['url']?>" target="_blank"><?=get_field("tipo")?> - <?=$nomeDosMeses[get_field("mes")]?> de <?=$ano?> (arquivo PDF)</a>
							</li>
											
						<?php
						}
						
						//Encerra tudo?>
							</ul>
							</div>
						</div>	
						<hr/>
					</section><?php //end article section ?>
				</article>
			</div>
			<?php  wp_reset_postdata(); ?>
						<!-- Sidebar -->
						<?php //get_sidebar('page'); ?>

		</div>
	</div>
</main>
<?php get_footer();

?>
