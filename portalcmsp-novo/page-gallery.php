<?php
/*
 Template Name: Galeria
*/

?>

<?php get_header(); ?>
			
			<div class="breadcrumbs cf">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p class="wrap cf">','</p>');
				} ?>
			</div>

			<div class="section-title">
				<h2 class="wrap icon-clock-large-red"><?php echo $post->post_title; ?></h2>
			</div>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<?php

						$gallery = 'imagem';
						if($post->post_name == 'galeria-videos') $gallery = 'video';
						if($post->post_name == 'galeria-podcasts') $gallery = 'podcast';

						?>

						<div id="main" class="cf" role="main">

							<div class="gallery-list cf">

								<?php

								$galleryQuery = new WP_Query(array(
									'post_type' => 'gallery-item',
									'posts-per-page' => 20,
									'paged' => true,
									'gallery-type' => $gallery
								));

								if($galleryQuery->have_posts()):
								while($galleryQuery->have_posts()): 
									$galleryQuery->the_post();

									$item_file = get_post_meta($post->ID, '_cmsp_gallery-item_file', true);
									$item_embed = get_post_meta($post->ID, '_cmsp_gallery-item_embed', true);
									$item_description = get_post_meta($post->ID, '_cmsp_gallery-item_description', true);

									$file_ext = substr($item_file, strlen($item_file) - 4);
									$item_thumb = substr($item_file, 0, strlen($item_file) - 4) . '-233x175' . $file_ext;

									$a_atts = array();

									if($gallery == 'imagem') {
										array_push($a_atts, 'href="'. $item_file .'"');
										array_push($a_atts, 'class="cmsp-lightbox"');
										array_push($a_atts, 'data-title="Galeria - Imagem"');
										array_push($a_atts, 'data-description="'. $item_description .'"');
									}

									if($gallery == 'video') {
										array_push($a_atts, 'href="'. $item_embed .'"');
										array_push($a_atts, 'class="cmsp-lightbox cmsp-lightbox-youtube"');
										array_push($a_atts, 'data-title="Galeria - Vídeo"');
										array_push($a_atts, 'data-description="'. $item_description .'"');

										parse_str(parse_url($item_embed, PHP_URL_QUERY), $embed_vars);
										$item_thumb = 'http://img.youtube.com/vi/'. $embed_vars['v'] . '/0.jpg';
									}
								?>

									<article class="gallery-item-<?php echo $gallery; ?> gallery-item">
										<a <?php echo implode(' ', $a_atts); ?>>
											<img class="gallery-item-thumb" src="<?php echo $item_thumb; ?>">
										</a>
										<div class="gallery-item-description">
											<?php echo $item_description; ?>
										</div>
									</article>

								<?php endwhile; else: ?>

									Nenhum item

								<?php endif; ?>

							</div>

						</div>

				</div>

			</div>
</main>
<?php get_footer(); ?>
