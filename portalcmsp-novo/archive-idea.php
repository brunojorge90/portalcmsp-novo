<?php
/*
 * CUSTOM POST TYPE ARCHIVE TEMPLATE
 *
 * This is the custom post type archive template. If you edit the custom post type name,
 * you've got to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is called "register_post_type( 'bookmarks')",
 * then your template name should be archive-bookmarks.php
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

			<div id="content">
			
				<div class="breadcrumbs cf">
					<?php if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p class="wrap cf">','</p>');
					} ?>
				</div>

				<div class="section-title">
					<h2 class="wrap icon-lightbulb-large-red">Banco de Ideias</h2>
				</div>

				<div id="inner-content" class="wrap cf">

						<div id="main" class="two-column-main cf" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php
								$author_name = get_post_meta($post->ID, '_cmsp_idea_author_name', true);
								$author_email = get_post_meta($post->ID, '_cmsp_idea_author_email', true);
							?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="article-header">

									<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<p class="byline vcard">Ideia adicionada em <time class="updated" datetime="<?php echo get_the_time( 'Y-m-j' ); ?>" pubdate><?php echo get_the_time('j \d\e F \d\e Y'); ?></time> por <span class="author"><?php echo $author_name; ?></span></p>

								</header>

								<section class="entry-content cf">

									<?php the_excerpt(); ?>

								</section>

								<footer class="article-footer">

								</footer>

							</article>

							<?php endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the custom posty type archive template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

					<?php get_sidebar('banco-de-ideias'); ?>

				</div>

			</div>

<?php get_footer(); ?>
