<?php /*
		<!-- Vlibras inicio -->
		<div id="slideout">
		  <img src="<?php echo get_template_directory_uri(); ?>/library/images/libras.png" alt="Libras">
		  <div id="slideout_inner">
			<strong>Acessibilidade com Libras</strong>
			<p><img src="<?php echo get_template_directory_uri(); ?>/library/images/vlibras_logo.png" alt="VLibras"></p>
			<p>O conteúdo do Portal da Câmara Municipal de São Paulo pode ser traduzido para a LIBRAS (Língua Brasileira de Sinais) através da plataforma VLibras.</p>
			<p><a href="https://www.vlibras.gov.br/" target="_blank">Clique aqui</a> (ou acesse diretamente no endereço - <a href="https://www.vlibras.gov.br/" target="_blank">https://www.vlibras.gov.br/</a>) e utilize a plataforma.</p>
		  </div>
		</div>
		<!-- Vlibras fim -->
		*/
?>

</div><!-- /id="irconteudo" -->
<a class="acessibilidade" href="<?php echo get_site_url()?>/acessibilidade-no-portal" aria-label="Informações sobre acessibilidade do Portal" title="Informações sobre acessibilidade do Portal">
    <img src="<?php echo get_template_directory_uri()?>/dist/images/acessibilidade.svg" alt="Ícone de acessibilidade">
</a>
<?php include get_template_directory().'/new-theme/acessibilidade/box.php'?>
<footer class="footer" role="contentinfo" id="footer">
    <div class="container">

        <nav role="navigation">
            <?php wp_nav_menu(array(
                'container' => '',                                        // remove nav container
                'container_class' => 'footer-links cf',                        // class of container (should you choose to use it)
                'menu_class' => 'nav footer-links cf',                    // adding custom nav class
                'theme_location' => 'menu-footer-novo',                            // where it's located in the theme
                'fallback_cb' => 'bones_footer_links_fallback'            // fallback function
            )); ?>
        </nav>
    </div>
    <div class="container">
        <div class="flex justify-center mt-80">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/brasao.svg" alt="Logo Câmara">
        </div>
        <div class="copyright color-white mt-8 w100">
            © <?php echo date('Y') ?> Câmara Municipal de São Paulo
        </div>

    </div>
    <div class="container">
        <div class="endereco">
            <p>
                <strong>
                    ENDEREÇO:
                </strong>
                PALÁCIO ANCHIETA  /  VIADUTO JACAREÍ, 100  -  BELA VISTA -  SÃO PAULO-SP
            </p>
            <p>
                <strong>
                    CEP:
                </strong>
                01319-900
            </p>
            <p>
                <strong>
                    TELEFONE:
                </strong>
                11 3396-4000
            </p>
        </div>
    </div>
    <div class="container links-extra">
        <div class="flex justify-center w-100">
            <a href="<?php echo get_site_url()?>/expediente">Expediente</a>
            <span>|</span>
            <a target="_blank" href="<?php echo get_site_url()?>/wp-content/uploads/2024/01/Termos-de-uso-e-aviso-de-privacidade.pdf">Política de privacidade</a>
            <span>|</span>
            <a target="_blank" href="https://www.google.com/maps/place/C%C3%A2mara+Municipal+de+S%C3%A3o+Paulo/@-23.550657,-46.641236,17z/data=!3m1!4b1!4m2!3m1!1s0x94ce59ad4e919fa1:0x8b4970d9095ec081?hl=pt-BR">Como chegar</a>
        </div>
    </div>

</footer>
<style>
    .endereco {
        max-width: 640px;
        color: white;
        padding-right: 12px !important;
        margin: 30px auto !important;
        margin-top: 50px !important;
    }

    .endereco p {
        text-align: center;
    }
</style>
<script>
    /* jQuery('body.theme-v2 .footer nav > ul > li > a').click(function () {
         var liItem = jQuery(this).parent('li');
         var isExpanded = liItem.height() > 74;

         if (isExpanded) {
             liItem.animate({
                 height: '74px'
             }, 300, function() {
                 jQuery(this).css('overflow', 'hidden').addClass('collapsed');
             });
         } else {
             liItem.animate({
                 height: liItem[0].scrollHeight + 'px'
             }, 300, function() {
                 jQuery(this).css('overflow', 'visible').removeClass('collapsed');
             });
         }

         return false;
     }); */



</script>

</div>

<!-- Hand Talk - início -->
<script src="https://plugin.handtalk.me/web/latest/handtalk.min.js"></script>
<script>
    var ht = new HT({
        token: "f2026460ac33713ed232a90e0e703516"
    });
</script>
<!-- Hand Talk - fim -->

<?php if (false): // trocar "false" por "is_page(11)" para reativar o popup "Regularização Imob." ?>
    <!-- popup regularização imobiliário da equipe portal/dce - 2019-12-13 -->
    <div id="boxes">
        <div style="display: none;" id="dialog" class="window">
            <div id="pop">
                <a href="#" class="close agree"><img
                            src="<?php echo get_template_directory_uri(); ?>/library/images/popup/close-icon.png"
                            width="25" style="float:right; "></a>
                <a href="./regularizacaoimobiliaria/">
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/popup/regulimobV.png"
                         class="banner">
                </a>
            </div>
        </div>
        <div style="width: 100vw; height: 100vh; display: block;" id="mask"></div>
    </div>
    <script src="<?php echo get_template_directory_uri(); ?>/library/js/popup.js"></script>
    <!-- FIM: popup regularização imobiliário da equipe portal/dce - 2019-12-13 -->
<?php endif; ?>

<?php // all js scripts are loaded in library/bones.php ?>
<?php wp_footer(); ?>

<?php
// custom page-specific scripts
$pageScripts = get_post_meta($post->ID, '_cmsp_page_javascript-scripts', true);
if ($pageScripts != '') {
    $pageScripts = str_replace(array('&amp;'), array('&'), $pageScripts);
    echo '<script>';
    echo $pageScripts;
    echo '</script>';
}
?>
<script>
    $('.flex-expore').owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        margin:30,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        },
        navText: ['<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M24.6 15.6L19.1783 20.6344C18.3262 21.4257 18.3262 22.7743 19.1783 23.5656L24.6 28.6M22 2C10.9543 2 2 10.9543 2 22C2 33.0457 10.9543 42 22 42C33.0457 42 42 33.0457 42 22C42 10.9543 33.0457 2 22 2Z" stroke="#717171" stroke-width="3" stroke-linecap="round"/> </svg>','<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M19.4 28.4001L24.8217 23.3656C25.6738 22.5744 25.6738 21.2257 24.8217 20.4345L19.4 15.4001M22 42.0001C33.0457 42.0001 42 33.0457 42 22.0001C42 10.9544 33.0457 2.00006 22 2.00006C10.9543 2.00006 2 10.9544 2 22.0001C2 33.0458 10.9543 42.0001 22 42.0001Z" stroke="#717171" stroke-width="3" stroke-linecap="round"/> </svg>'],
        lazyLoad:true,
    });


    $('.owl-filtros').owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        margin:30,
        responsive:{
            0:{
                items:2
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        },
        navText: ['<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M24.6 15.6L19.1783 20.6344C18.3262 21.4257 18.3262 22.7743 19.1783 23.5656L24.6 28.6M22 2C10.9543 2 2 10.9543 2 22C2 33.0457 10.9543 42 22 42C33.0457 42 42 33.0457 42 22C42 10.9543 33.0457 2 22 2Z" stroke="#717171" stroke-width="3" stroke-linecap="round"/> </svg>','<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M19.4 28.4001L24.8217 23.3656C25.6738 22.5744 25.6738 21.2257 24.8217 20.4345L19.4 15.4001M22 42.0001C33.0457 42.0001 42 33.0457 42 22.0001C42 10.9544 33.0457 2.00006 22 2.00006C10.9543 2.00006 2 10.9544 2 22.0001C2 33.0458 10.9543 42.0001 22 42.0001Z" stroke="#717171" stroke-width="3" stroke-linecap="round"/> </svg>'],
        lazyLoad:true,
    });


    $('.flex-programas').owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        margin:32,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        },
        navText: ['<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M24.6 15.6L19.1783 20.6344C18.3262 21.4257 18.3262 22.7743 19.1783 23.5656L24.6 28.6M22 2C10.9543 2 2 10.9543 2 22C2 33.0457 10.9543 42 22 42C33.0457 42 42 33.0457 42 22C42 10.9543 33.0457 2 22 2Z" stroke="#717171" stroke-width="3" stroke-linecap="round"/> </svg>','<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M19.4 28.4001L24.8217 23.3656C25.6738 22.5744 25.6738 21.2257 24.8217 20.4345L19.4 15.4001M22 42.0001C33.0457 42.0001 42 33.0457 42 22.0001C42 10.9544 33.0457 2.00006 22 2.00006C10.9543 2.00006 2 10.9544 2 22.0001C2 33.0458 10.9543 42.0001 22 42.0001Z" stroke="#717171" stroke-width="3" stroke-linecap="round"/> </svg>'],
        lazyLoad:true,
    });

</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const prevButtons = document.querySelectorAll(".owl-prev");
    const nextButtons = document.querySelectorAll(".owl-next");

    prevButtons.forEach(btn => {
      btn.setAttribute("aria-label", "Slide anterior");
    });

    nextButtons.forEach(btn => {
      btn.setAttribute("aria-label", "Próximo slide");
    });
  });
</script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592c819ada713d34" async="async"></script>
<script src="https://code.responsivevoice.org/responsivevoice.js?key=Nb5F3cJs"></script>
</body>

</html><!-- end of site. what a ride! -->