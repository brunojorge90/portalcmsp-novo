
<section class="banners-row cf">
  <ul>
    <?php
        if(is_active_sidebar('banner-row')):
            dynamic_sidebar('banner-row');
        else:
    ?>
	<!--
        <li><a href="<?php echo get_home_url(); ?>/institucional/campanhas-institucionais/aplicativo-camara/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/content-placeholders/home-banners-5.jpg" alt="Aplicativo Plano Diretor"></a></li>
        <li><a href="/transparencia/orcamentos-da-camara/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/content-placeholders/home-banners-6.jpg" alt="Orçamento 2015"></a></li>
        <li><a href="<?php echo get_home_url(); ?>/fale-conosco/ouvidoria/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/content-placeholders/home-banners-ouvidoria.jpg" alt="Ouvidoria"></a></li>
        <li><a href="<?php echo get_home_url(); ?>/institucional/escola-parlamento/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/content-placeholders/home-banners-escola-parlamento.jpg" alt="Escola do Parlamento"></a></li>
	-->
	<li><a href="/memoria" id="" target="_blank" class="widget_sp_image-image-link" title="" rel=""><img width="233" height="91" alt="" class="attachment-full" style="max-width: 100%;" src="/wp-content/uploads/2016/06/botão_CM_CMSP_novo.fw_.png" /></a></li>
	<li><a href="/tamanduatei/" id="" target="_blank" class="widget_sp_image-image-link" title="" rel=""><img width="311" height="123" alt="" class="attachment-full" style="max-width: 100%;" src="/wp-content/uploads/2016/04/BANNER_TAMANDUATEI_HOME_PORTAL_alt.jpg" /></a></li>
	<li><a href="/orcamento2016" id="" target="_blank" class="widget_sp_image-image-link" title="" rel=""><img width="233" height="90" alt="" class="attachment-full" style="max-width: 100%;" src="/wp-content/uploads/2015/11/banner_orcamento2016.jpg" /></a></li>
	<li><a href="/zoneamento/" id="" target="_blank" class="widget_sp_image-image-link" title="" rel=""><img width="233" height="90" alt="" class="attachment-full" style="max-width: 100%;" src="/wp-content/uploads/2015/06/banner_zoneamento2.jpg" /></a></li>
	<!--
	<li><a href="http://saopaulo.votenaweb.com.br/" id="" target="_blank" class="widget_sp_image-image-link" title="" rel=""><img width="233" height="90" alt="" class="attachment-full" style="max-width: 100%;" src="/wp-content/uploads/2015/10/Banner_votenaweb.jpg" /></a></li>
	-->
	<li><a href="/camaranoseubairro/" id="" target="_blank" class="widget_sp_image-image-link" title="" rel=""><img width="233" height="90" alt="" class="attachment-full" style="max-width: 100%;" src="/wp-content/uploads/2015/03/home-banners-cmsp-seu-bairro.jpg" /></a></li>
	<li><a href="/escoladoparlamento/" id="" target="_blank" class="widget_sp_image-image-link" title="" rel=""><img width="233" height="91" alt="" class="attachment-full" style="max-width: 100%;" src="/wp-content/uploads/2015/04/escola_parlamento_newlogo.jpg" /></a></li>
    <?php endif; ?>
  </ul>
</section>