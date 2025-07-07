<?php
/*
 * Template Name: TV Câmara
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

						<div id="main" class="two-column-main cf" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

								</header> <?php // end article header ?>

								<section class="entry-content cf" itemprop="articleBody">
									<object style="margin: 1em auto;" id="MediaPlayer" classid="CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components..." type="application/x-oleobject" width="450" height="300">
										<param name="FileName" value="mms://media.ebsit.net.br/tvcamarasp.wmv">
										<param name="ShowControls" value="true">
										<param name="ShowStatusBar" value="false">
										<param name="ShowDisplay" value="false">
										<param name="autostart" value="true">
										<param name="windowlessVideo" value="true">
									    <embed type="application/x-mplayer2" src="mms://media.ebsit.net.br/tvcamarasp.wmv" name="MediaPlayer" showcontrols="1" showstatusbar="0" showdisplay="0" autostart="1" width="450" height="300">
								    </object>

								    <ul>
									    <li>Canal 61.4 (aberto digital – 24h)</li>
									    <li>Canais a cabo 7 (digital) e 13 (analógico) NET, das 13h às 20h.</li>
									</ul>
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

						<div id="sidebar1" class="sidebar sidebar-page" role="complementary">
							
							<div class="tvcamara-menu">
								<h2>Programação TV Câmara</h2>
								<?php the_content(); ?>
							</div>

						</div>

				</div>

			</div>
</main>
<?php get_footer(); ?>
