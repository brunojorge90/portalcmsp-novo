<section class="banners-column">
  <ul>
    <?php
        if(is_active_sidebar('banner-col')): 
            dynamic_sidebar('banner-col');
        else:
    ?>
	    <li class="first"><a href="<?php echo get_home_url(); ?>/fale-conosco/ouvidoria/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/content-placeholders/home-banners-ouvidoria.jpg" alt="Ouvidoria"></a></li>
	    <li><a href="<?php echo get_home_url(); ?>/transparencia/lei-de-acesso-informacao/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/content-placeholders/home-banners-acesso.jpg" alt="Acesso à Informação"></a></li>
	    <li class="last"><a href="http://diariooficial.imprensaoficial.com.br/nav_v4/index.asp?c=1" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/content-placeholders/home-banners-diario.jpg" alt="Diário Oficial"></a></li>
	<?php endif; ?>
  </ul>
</section>