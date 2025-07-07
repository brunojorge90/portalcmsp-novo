<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons (for more: https://thehistoryoftheweb.com/how-we-got-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->

		<!-- canvas support for old IE -->
		<!--[if lte IE 8]>
			<script src="<?php echo get_template_directory_uri(); ?>/library/js/libs/excanvas.compiled.js"></script>
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // typekit function ?>
		<script src="//use.typekit.net/eqp3auo.js"></script>
		<script>try{Typekit.load();}catch(e){}</script>
		<?php // end typekit ?>

	</head>

	<body <?php body_class(); ?>>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=1448942638693369&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<script src="https://apis.google.com/js/platform.js" async defer>
	  {lang: 'pt-BR'}
	</script>
	<script src="//platform.linkedin.com/in.js" type="text/javascript">
	  lang: pt_BR
	</script>

		<div id="container">
			<header class="header" role="banner">
				<section class="header-headlines">
					<div class="inner-header-headlines wrap cf">
						<h2>Em Pauta</h2>
						<div class="container-headlines">

							<?php
							$featuredQuery = new WP_Query(array(
									'post_type' => 'post',
									//'posts_per_page' => 5,
									'meta_query' => array(
							          array(
							            'key' => '_cmsp_post_is-on-the-agenda-article',
							            'value' => 'on',
							          ),
							        ),
								));
							$count = 0; while($featuredQuery->have_posts()): $featuredQuery->the_post(); $count++;
							?>

								<article class="headline-<?php echo $count; if($count == 1) echo ' active'; ?>">
									<h1><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h1>
								</article>

							<?php endwhile; wp_reset_postdata(); ?>

							<div class="headlines-nav">
								<a href="#" class="headlines-prev">Anterior</a>
								<a href="#" class="headlines-next">Próximo</a>
							</div>
						</div>

						<div class="transparencia-menu-wrapper">
							<a href="#" class="link-transparencia">Transparência</a>

							<nav>
								<?php  wp_nav_menu(array(
								'container' => false,                           // remove nav container
								'container_class' => 'menu cf',                 // class of container (should you choose to use it)
								'menu' => __( 'Transparência Menu', 'bonestheme' ),  // nav name
								'menu_class' => 'nav transparencia-menu cf',               // adding custom nav class
								'theme_location' => 'transparencia-menu',                 // where it's located in the theme
								'before' => '',                                 // before the menu
			    			'after' => '',                                  // after the menu
			    			'link_before' => '',                            // before each link
			    			'link_after' => '',                             // after each link
			    			'depth' => 0,                                   // limit the depth of the nav
								'fallback_cb' => ''                             // fallback function (if there is one)
								)); ?>
							</nav>
						</div>

					</div>
				</section><!-- end header-headlines -->
				
				<section class="main-header">
					<div id="inner-header" class="inner-main-header wrap cf">

						<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
						<h1 id="logo" class="h1"><a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/logo-camara.png" alt="<?php bloginfo('name'); ?>"></a></h1>

						<?php // if you'd like to use the site description you can un-comment it below ?>
						<?php // bloginfo('description'); ?>


						<nav role="navigation">
							<?php wp_nav_menu(array(
	    					'container' => false,                           // remove nav container
	    					'container_class' => 'menu cf',                 // class of container (should you choose to use it)
	    					'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
	    					'menu_class' => 'nav top-nav cf',               // adding custom nav class
	    					'theme_location' => 'main-nav',                 // where it's located in the theme
	    					'before' => '',                                 // before the menu
	        			'after' => '',                                  // after the menu
	        			'link_before' => '',                            // before each link
	        			'link_after' => '',                             // after each link
	        			'depth' => 0,                                   // limit the depth of the nav
	    					'fallback_cb' => ''                             // fallback function (if there is one)
							)); ?>

						</nav>
						
						<div class="header-search-form">
							<?php get_search_form(); ?>
						</div>

					</div>
				</section><!-- end main header -->

				<section class="secondary-header">
					<div class="inner-secondary-header wrap cf">
						<nav role="navigation" class="top-nav-2-wrapper">
							<ul class="nav top-nav-2 cf">
								<?php
									$menuID = 3;
									$menu_items = wp_get_nav_menu_items($menuID);

									// save an array with IDs of first level items that have children
									$second_level = array();
									$parents = array();
									$second_level_parents = array();
									foreach($menu_items as $menu_item) {
										if($menu_item->menu_item_parent != 0) {
											array_push($second_level, $menu_item->ID);

											// only add the item into the array if the item's parent is not a second level item the item isn't already there
											$parent = $menu_item->menu_item_parent;
											if(!in_array($parent, array_merge($parents, $second_level))) {
												array_push($parents, $parent);
											}
											elseif(!in_array($parent,array_merge($parents, $second_level_parents)) && in_array($parent, $second_level)) {
												array_push($second_level_parents, $parent);
											}
										}
									}

									foreach($menu_items as $menu_item):

										$item_title = $menu_item->title;
										$item_url  = $menu_item->url;

										// output first level items
										if($menu_item->menu_item_parent == 0):
											$item_classes = '';
											foreach($menu_item->classes as $class) {
												$item_classes .= ' ' . $class;
											}
								?>
										<li class="<?php echo $item_classes; ?>">
											<a href="<?php echo $item_url; ?>"><?php echo $item_title; ?></a>

											<?php
												if(in_array($menu_item->ID, $parents)):
													$parentID = $menu_item->ID;
											?>
												<ul class="sub-menu">
													<h2><?php echo $item_title; ?></h2>
													<?php
													// output second level items
													foreach($menu_items as $menu_item):
													if($menu_item->menu_item_parent == $parentID):
														
														$subitem_class = '';
														foreach($menu_item->classes as $class) {
															$item_classes .= ' ' . $class;
														}
														if(in_array($menu_item->ID,$second_level_parents)) $subitem_class .= ' featured';
													?>
														<li class="<?php echo $subitem_class; ?>">
															<a href="<?php echo $menu_item->url; ?>" class="lv-2-item <?php if(in_array($menu_item->ID,$second_level_parents)) echo 'featured-menu-title'; ?>"><?php echo $menu_item->title; ?></a>

															<?php
															if(in_array($menu_item->ID,$second_level_parents)):
																$subparentID = $menu_item->ID;
															?>
																<ul class="feature-menu">
																	<?php 
																	// output third level items
																	foreach($menu_items as $menu_item):
																	if($menu_item->menu_item_parent == $subparentID): 
																		$postID = $menu_item->object_id;

																		$feature_title = get_post_meta($postID, '_cmsp_feature-page_title', true);
																		if($feature_title == '') $feature_title = $menu_item->title;
																		$feature_icon = get_post_meta($postID, '_cmsp_feature-page_icon', true);
																		if($feature_icon == '') $feature_icon = 'flag-black';
																		$feature_image = get_post_meta($postID, '_cmsp_feature-page_image', true);
																		$feature_text = get_post_meta($postID, '_cmsp_feature-page_text', true);
																		$feature_link = get_post_meta($postID, '_cmsp_feature-page_link', true);
																		if($feature_link == '') $feature_link = $menu_item->url;
																	?>
																		<li>
																			<a href="<?php echo $feature_link; ?>" class="feature-title icon-<?php echo $feature_icon; ?>"><?php echo $feature_title; ?></a>
																			<a href="<?php echo $feature_link; ?>" class="feature-image">
																				<img src="<?php echo $feature_image; ?>">
																				<span class="feature-link-text"><?php echo $feature_text; ?></span>
																			</a>
																		</li>
																	<?php endif; endforeach; ?>
																</ul>
															<?php endif; ?>

														</li><?php /* end second level item */ ?>
													<?php endif; endforeach; ?>

												</ul>

											<?php endif; ?>
										</li><?php /* end first level item */ ?>


								<?php endif; endforeach; ?>

							</ul>

						</nav>

						<nav class="social-nav-wrapper">
							<?php wp_nav_menu(array(
	    					'container' => false,                           // remove nav container
	    					'container_class' => 'menu cf',                 // class of container (should you choose to use it)
	    					'menu' => __( 'Social Networks', 'bonestheme' ),  // nav name
	    					'menu_class' => 'nav social-nav cf',               // adding custom nav class
	    					'theme_location' => 'social-nav',                 // where it's located in the theme
	    					'before' => '',                                 // before the menu
	        			'after' => '',                                  // after the menu
	        			'link_before' => '',                            // before each link
	        			'link_after' => '',                             // after each link
	        			'depth' => 0,                                   // limit the depth of the nav
	    					'fallback_cb' => ''                             // fallback function (if there is one)
							)); ?>

						</nav>
					</div>
				</section>

			</header>
			
			<?php if(is_page_template('page-home.php')): //display the slider ?>
				
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
						
						<?php if(is_page_template('page-home.php')): /* Schedule box on câmara home */?>
							<div class="slider-side">
								<?php
									// Agenda
									// get_template_part('content-boxes/box','agenda');
								?>

								<a href="/blog/o-portal-da-camara-esta-de-cara-nova-confira-novidades/"><img src="<?php echo get_template_directory_uri(); ?>/library/images/banners/side-banner-portal.jpg"></a>
							</div>
						<?php endif; ?>
						
						<?php if(is_page_template('page-participe.php')): /* Schedule box on câmara home */ ?>
							<div class="slider-side">
								<?php
									// Agenda
									get_template_part('content-boxes/box','transparency');
								?>
							</div>
						<?php endif; ?>
					</div>
				</div>

			<?php endif; // end slider ?>

			<?php if(is_page_template('page-home.php')): //display the slider ?>
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
			<?php endif; ?>