<?php
/*
 Template Name: Orçamento
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

			<div id="main" class="two-column-main cf" role="main">

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
							'post_type'  => 'orcamento',
							'meta_query' => array(
											array(
												'key' => 'tipo',
												'value' => 'Demonstrativo',
											),
										),
							'meta_key'  => 'ano',
							'numberposts' => '-1',
							'orderby'    => array('ano' => 'DESC', 'title' => 'DESC')
						));
						$ano = '';
						
						//NOVO
						foreach ($posts as $post) { 
							$arquivo = get_field("arquivo");
						
							
							if ($ano != '' && $ano != get_field("ano")){
								$ano = get_field("ano");
								if ($ano == '2004' || $ano == '2003'){
								continue;
							}
								?>
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
					 <?php }
					  
							$titulo = get_field("titulo");
							if (stripos($titulo,'Trimestre') == true){?>
							<li>
							
							<a href="<?=$arquivo['url']?>" target="_blank"><?=$titulo?></a>
							</li>
								
						<?php  }
						
						}
						//Encerra NOVO?>
												
							</ul>
							</div>
						</div>	
					</section><?php //end article section ?>
				</article>
			</div>
			<?php  wp_reset_postdata(); ?>
						<!-- Sidebar -->
						<?php get_sidebar('page'); ?>

		</div>
	</div>
</main>
<?php get_footer();

?>
