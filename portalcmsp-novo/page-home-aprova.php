<?php
/*
 Template Name: Home Câmara - APROVA
*/

//Save the template name so it's obtainable in the header
?>

<?php get_header(); ?>
<!-- HEADER -->			
			<div class="top-slider">
				<div class="inner-top-slider wrap cf">
					<section class="slider-container">
					<div class="cmsp-rslides">
						<?php
						$sliderQuery = new WP_Query(array(
								'post_type' => 'slider-home',
								'posts_per_page' => 5
							));
						while($sliderQuery->have_posts()): $sliderQuery->the_post();
							$slide_img = get_post_meta($post->ID, '_cmsp_slider_image', true);
							$slide_text = get_post_meta($post->ID, '_cmsp_slider_text', true);
							$slide_link = get_post_meta($post->ID, '_cmsp_slider_link', true);
							$slide_target = get_post_meta($post->ID, '_cmsp_slider_target', true);
						?>

							<article class="top-slide">
								<a href="<?php echo $slide_link; ?>" target="<?php echo $slide_target; ?>"><img alt="<?php echo $slide_text; ?>" src="<?php echo $slide_img; ?>"></a>
								<?php if($slide_text != ''): ?>
									<h3 class="text"><a href="<?php echo $slide_link; ?>" target="<?php echo $slide_target; ?>"><?php echo $slide_text; ?></a></h3>
								<?php endif; ?>
							</article>

						<?php endwhile; ?>
					</div>
					</section>
					
						<div class="slider-side">
							<?php
								// Agenda -- Removida temporariamente
								get_template_part('content-boxes/box','agenda-aprova');
							?>
						</div>

				</div>
			</div>

			<div class="container-top-nav-3">
				<nav class="wrap">
					<?php  wp_nav_menu(array(
					'container' => false,                           // remove nav container
					'container_class' => 'menu cf',                 // class of container (should you choose to use it)
					'menu' => __( 'Secondary Menu', 'bonestheme' ),  // nav name
					'menu_class' => 'nav top-nav-3 cf',               // adding custom nav class
					'theme_location' => 'third-nav',                 // where it's located in the theme
					'before' => '',                                 // before the menu
				'after' => '',                                  // after the menu
				'link_before' => '',                            // before each link
				'link_after' => '',                             // after each link
				'depth' => 0,                                   // limit the depth of the nav
					'fallback_cb' => ''                             // fallback function (if there is one)
					)); ?>
				</nav>
			</div>
<!-- FIM HEADER -->
			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="cf" role="main">

							<div class="cmsp-row">
								
								<div class="cmsp-left">
									<?php 
										// Últimas Notícias
										get_template_part( 'content-boxes/box', 'latest-news' );
									?>
								</div>

								<div class="cmsp-right">
									<?php 
										// Notícia em Destaque
										get_template_part( 'content-boxes/box', 'featured-article' );
									?>
								</div>

							</div><!-- end row -->

							<div class="cmsp-row">
								<?php 
									// Banners Horizontal
									get_template_part( 'content-boxes/banners', 'row' );
								?>
							</div>

							<div class="cmsp-row">
								
								<div class="cmsp-left">
									<?php 
										// Consulta Rápida
										get_template_part( 'content-boxes/box', 'quick-search' );
									?>
								</div>

								<div class="cmsp-right">
									<div class="box-half box-half-left">
										<?php 
											// eventos
											get_template_part( 'content-boxes/box', 'events' );
										?>
									</div>

									<div class="box-half box-half-right">
										<?php 
											// Últimas da Rede
											get_template_part( 'content-boxes/box', 'network-posts-only' );
										?>
									</div>

									<?php 
										// Tour Virtual
										get_template_part( 'content-boxes/box', 'tour' );
									?>									
								</div>

							</div><!-- end row -->

							<div class="cmsp-row">
								<div class="cmsp-left">
									<?php 
										// Galeria Multimídia
										get_template_part( 'content-boxes/box', 'gallery' );
									?>	
								</div>

								<div class="cmsp-right">

									<div class="box-half box-half-left">
										<?php 
											// Saiba mais
											get_template_part( 'content-boxes/box', 'learn-more' );
										?>
									</div>
									
									<div class="box-half box-half-right">
										<?php 
											// Banners Vertical
											get_template_part( 'content-boxes/banners', 'column' );
										?>
									</div>
								</div>

							</div><!-- end row -->

						</div>

				</div>

			</div>
</main>
<?php get_footer(); ?>
