<?php
/*
 Template Name: Conteúdo em Iframe
*/
?>

<head>
		<meta charset="utf-8">
		<title><?php wp_title(''); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/library/css/style.css">
</head>

<body>

	<div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

			<section class="entry-content">

				<?php the_content(); ?>

			</section>
		</article>

		<?php endwhile; else: ?>
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
		// custom page-specific scripts
		$pageScripts = get_post_meta($post->ID,'_cmsp_page_javascript-scripts',true);
		if($pageScripts != '') {
			$pageScripts = str_replace(array('&amp;'),array('&'),$pageScripts);
			echo '<script>';
			echo $pageScripts;
			echo '</script>';
		}
	?>

</body>
