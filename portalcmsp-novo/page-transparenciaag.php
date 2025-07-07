<?php
/*
 Template Name: Transparência - página agregador
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

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					<header class="article-header">

						<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

					</header> <?php // end article header ?>

					<section class="entry-content cf" itemprop="articleBody">
						<?php the_content(); ?>
						<div style="clear:both;"></div>
					
					</section> <?php // end article section ?>
                    <div class="cmsp-row">
					    <div >
							<div class="cmsp-left" style="width:70%">
							  <?php
								// Consulta Rápida
								get_template_part( 'content-boxes/box', 'quick-search' );
								?>
							</div>
							<div class="box-half box-half-right">
								<?php
								// Banners Vertical
								get_template_part( 'content-boxes/banners', 'column' );
								?>
							</div>
						</div>
					</div>		
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
	</div>

</div>
</main>
<?php get_footer(); ?>
