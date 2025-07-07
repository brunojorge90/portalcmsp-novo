<?php
/*
 Template Name: Audiência Pública Virtual
*/
?>
<?php get_header(); ?>

	<style type="text/css">
		div#content {
		    background: url(https://www.saopaulo.sp.leg.br/wp-content/uploads/2020/05/Tela-Horizontal.jpg) no-repeat fixed;
		    background-size: cover;
		    background-position: center bottom;
		}

		.hentry {
		    background-color: transparent;
		}

		/*section.entry-content.cf {
		    padding: 2.2em;
		    background: #1d1d1d63;
		    color: #fff;
		}*/

		section.entry-content.cf a {
		    font-weight: bolder;
		}

		.page-title {
		    border-bottom: 5px solid #480000;
		    color: #fff;
		    background: #9a01019e;
		    padding: 5px 15px;
		    position: relative;
		    text-transform: uppercase;
		    text-align: center;
		    margin: 0 auto;
		    text-shadow: 2px 2px 5px rgba(0,0,0,0.75);
		}

		a.linkDestaque {
		    display: block;
		    text-align: center;
		    text-decoration: none;
		    font-weight: bolder;
		    font-size: 1.25em;
		    background: rgba(0, 0, 0, 0.35);
		    line-height: 60px;
		    color: #fff;
		    box-shadow: inset 3px 3px 10px rgba(0,0,0,0.35);
		    text-shadow: 2px 2px 3px rgba(0,0,0,0.5);
		}

		a.linkDestaque:hover {
		    color: #fff;
		    background: rgba(0, 0, 0, 0.5);
		    box-shadow: inset 1px 1px 6px rgba(0,0,0,0.25);
		    text-shadow: 0px 0px 3px rgba(255,255,255,0.75);
		}

		a.linkDestaque.fechada, a.linkDestaque.fechada:hover {
		    background: rgba(0, 0, 0, 0.25);
		    line-height: 60px;
		    color: #9c9c9c;
		    box-shadow: inset 0px 0px 5px rgba(0,0,0,0.35);
		    text-shadow: 0px 0px 1px rgba(0,0,0,0.5);
		    pointer-events: none;
		}

		.entry-content h2:after {
		    content: '';
		    height: 5px;
		    width: 100%;
		    background: #a3454559;
		    display: block;
		    margin-bottom: 20px;
		}

		h1.page-title a {
		    color: #fff;
		    line-height: 1.5em;
		}

		label {
		    height: 65px;
		}

		span.wpcf7-form-control.wpcf7-radio span {
		    line-height: 30px;
		    min-width: 100%;
		}

		input.wpcf7-form-control.wpcf7-text {
		    height: 40px;
		}

		input.wpcf7-form-control.wpcf7-submit {
		    width: 100%;
		    height: 40px;
		    border: none;
		    background: #8e0707;
		    color: #fff;
		    font-weight: bolder;
		}

		@media only screen and (min-width: 768px) {
			.sidebar {
			    width: 300px;
			    float: right;
			    margin-top: 2.2em;
			    padding-bottom: 2.2em;
			}

			.two-column-main {
			    width: 380px;
			    float: left;
			    margin-top: 2.2em;
			    margin-bottom: 2.2em;
			}
		}

		@media only screen and (min-width: 1030px) {
			.two-column-main {
			    width: 590px;
			}
		}
	</style>

			<div id="content">
			
			<div class="breadcrumbs cf">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p class="wrap cf">','</p>');
				} ?>
			</div>

				<div id="inner-content" class="wrap cf">

						<div id="main" class="<?php if( get_field('iframe_participe') ): ?>two<?php else : ?>three<?php endif; ?>-column-main cf" role="main">

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

								</header> <?php // end article header ?>

								<?php if( get_field('iframe_player') ): ?>
								<section class="player">
								    <iframe src="<?php echo get_field('iframe_player'); ?>" width="630" height="360" style="overflow:hidden;border:0;margin:2.2em;margin-left:-1.1em;"></iframe>					
								</section>
								<?php endif; ?>

								<section class="entry-content cf" itemprop="articleBody">
									<?php the_content(); ?>
									
								</section> <?php // end article section ?>

							</article>

						</div>
						<?php if( get_field('iframe_participe') ): ?>
							<div id="sidebar1" class="sidebar sidebar-page" role="complementary">
							    <iframe src="<?php echo get_field('iframe_participe'); ?>" width="340" height="1000" style="overflow:hidden;border:0;"></iframe>
							</div>
						<?php endif; ?>
				</div>
			</div>
	</main>
<?php get_footer(); ?>