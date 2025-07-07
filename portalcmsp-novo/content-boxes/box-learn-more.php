
<section class="content-box box-nav-menu">
  <header class="content-box-top">
    <h2 class="content-box-title icon-plus-red"><a href="#">Saiba Mais</a></h2>
  </header>

  <ul class="box-nav-menu-list box-height-adjust">
	<?php  wp_nav_menu(array(
						'container' => false,
						'menu' => 'Saiba Mais',  // nav name
						'before' => '',                                 // before the menu
			    		'items_wrap' => '%3$s',                                  // after the menu
			    		'after' => '',                                  // after the menu
			    		'link_before' => '',                            // before each link
			    		'link_after' => '',                             // after each link
			    		'depth' => 0
	)); ?>
  </ul>

</section><!-- end box-nav-menu -->