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

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592c819ada713d34" async="async"></script>
<script src="https://code.responsivevoice.org/responsivevoice.js?key=Nb5F3cJs"></script>
<style>
      #toggle-toc-btn:hover {
        left: 0;
      }
</style>
<style>
  a:focus{
    outline: 2px solid #000 !important; /* Red outline for focus state */
  }
  .snackbar-close {
  display: none !important;
  }
  body.theme-v2 .acessibilidade-box{
    display:none;
  }
  body.theme-v2 .acessibilidade-box.act{
    display:block;
  }
  </style>
<script>



//ANTIGO: ao focar o botão o modal deve abrir com a funcao click do mouse
/*document.addEventListener("DOMContentLoaded", function () {
  function ativarAoFocar(selector, selectorModal) {
    const botao = document.querySelector(selector);
    let jaAtivado = false;

    //if (!botao) return;
    if (!botao) return;


    // Impede redirecionamento se o botão for um <a>
    botao.addEventListener("click", function (e) {
      console.log("Botão clicado:", selector);
      e.preventDefault(); // impede navegação
    });

    // Ao focar, dispara o clique
    botao.addEventListener("focus", () => {
      if (!jaAtivado) {
        //botao.dispatchEvent(new MouseEvent("click", { bubbles: true }));
        botao.click();
        jaAtivado = true;
        
        setTimeout(() => {
          const modal = document.querySelector(selectorModal);
          console.log("Modal encontrado:", modal);
          if (modal) {
            modal.removeAttribute("hidden");
            modal.setAttribute("aria-hidden", "false");
            //modal.setAttribute("tabindex", "-1");
            //modal.focus();
            // Tenta focar no primeiro elemento interativo do modal
        const focoInicial = modal.querySelector('button, a, input, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (focoInicial) {
          focoInicial.focus();
        } else {
          modal.setAttribute('tabindex', '-1');
          modal.focus();
        }
          }
        //}, 100);
        },150);


      }
    });

    // Ao sair do foco, libera para funcionar novamente depois
    botao.addEventListener("blur", () => {
      jaAtivado = false;
    });
  }

  // Aplique aos botões desejados
  // Aplique aos botões e respectivos modais
  ativarAoFocar('#btn-acessibilidade', '.acessibilidade-box');
  ativarAoFocar('#btn-indice', '#sidebar-toc');
});*/
//NOVO: ao focar o botão o modal deve abrir com a funcao click do mouse
document.addEventListener("DOMContentLoaded", function () {
  function ativarAoFocar(selectorBtn, selectorModal, selectorNextFocus) {
    const btn   = document.querySelector(selectorBtn);
    const modal = document.querySelector(selectorModal);
    let   lock  = false;

    if (!btn || !modal) {
      console.warn("Trigger ou modal não encontrado:", selectorBtn, selectorModal);
      return;
    }

    // 1) Impede que <a> navegue
    btn.addEventListener("click", e => e.preventDefault());

    // 2) Abre o modal ao focar
    btn.addEventListener("focus", () => {
      if (lock) return;
      lock = true;

      btn.click();
      btn.style.display = 'none';

      setTimeout(() => {
        // mostra o modal
        modal.style.display = '';
        modal.removeAttribute("hidden");
        modal.setAttribute("aria-hidden", "false");

        // foca o primeiro item do modal
        const primeiro = modal.querySelector(
          'button, a[href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
        );
        if (primeiro) primeiro.focus();
        else {
          modal.setAttribute("tabindex","-1");
          modal.focus();
        }

        // 3) Fecha ao sair do modal e move o foco
        const onFocusOut = () => {
          setTimeout(() => {
            if (!modal.contains(document.activeElement)) {
              // esconde modal
              modal.style.display = 'none';
              modal.setAttribute("hidden", "true");
              modal.setAttribute("aria-hidden", "true");

              // tenta achar o próximo elemento
              console.log("Procurando próximo foco para selectorNextFocus=", selectorNextFocus);
              const next = document.querySelector(selectorNextFocus);
              console.log("Elemento next encontrado:", next);

              if (next) {
                // garante que seja focável
                if (!next.hasAttribute("tabindex")) {
                  next.setAttribute("tabindex", "-1");
                }
                next.focus();
                next.click(); // opcional, se quiser simular um clique
              } else {
                console.warn("❌ Próximo foco NÃO encontrado:", selectorNextFocus);
                // fallback para o próprio botão
                btn.focus();
              }

              btn.style.display = '';
              lock = false;
              modal.removeEventListener("focusout", onFocusOut);
            }
          }, 0);
        };
        modal.addEventListener("focusout", onFocusOut);

      }, 150);
    });

    // libera para reabrir
    btn.addEventListener("blur", () => lock = false);

    // ESC também fecha e avança foco
    modal.addEventListener("keydown", e => {
      if (e.key === "Escape") {
        e.preventDefault();
        // fecha
        modal.style.display = 'none';
        modal.setAttribute("hidden", "true");
        modal.setAttribute("aria-hidden", "true");
        btn.style.display = '';

        // avança foco
        console.log("ESC pressionado: avançando foco para", selectorNextFocus);
        const next = document.querySelector(selectorNextFocus);
        if (next) {
          if (!next.hasAttribute("tabindex")) next.setAttribute("tabindex","-1");
          next.focus();
          next.click(); // opcional, se quiser simular um clique
        } else {
          btn.focus();
        }
        lock = false;
      }
    });
  }

  ativarAoFocar("#btn-acessibilidade", ".acessibilidade-box", "#toggle-toc-btn");
  ativarAoFocar("#toggle-toc-btn",        "#sidebar-toc",          "#main-menu");
  ativarAoFocar("#main-menu",            ".sandwich",             ".menu-lateral");
  ativarAoFocar(".sandwich",             ".menu-lateral",         "#conteudo");
});



//focar no botão dos cookies se ele existir
document.addEventListener("DOMContentLoaded", function () {
  const lgpd = document.getElementById('lgpd-banner');
  const cookieButton = lgpd ? lgpd.querySelector('button') : null;

  if (cookieButton) {
    cookieButton.focus();
  }

  const acessibilidade = document.querySelector('.acessibilidade button, .acessibilidade a');
    if (acessibilidade) {
      acessibilidade.focus();
  }
});

  document.addEventListener('keydown', (e) => {
  if (e.key === 'Tab') {
    console.log('Foco atual:', document.activeElement);
  }
  });

  document.addEventListener("DOMContentLoaded", function () {
    const content = document.querySelector('.container') || document.body;
    // Localiza os links de acessibilidade no header
    const btnAcc = document.querySelectorAll('a.acessibilidade');
    console.log("achou o botão de acessibilidade?", btnAcc.length > 0);
    

    const btn = document.createElement("button");
    btn.id = "toggle-toc-btn";
    btn.textContent = "☰";
    btn.setAttribute("aria-expanded", "false");
    btn.setAttribute("aria-label", "Mostrar/Esconder Índice da Página");
    btn.setAttribute("title", "Mostrar/Esconder Índice da Página");
    btn.setAttribute("tabindex", "0");
    btn.style.cssText = `
      position: fixed;
      top: 60%;
      left: -20px;
      transition: left 0.3s ease;
      z-index: 10000;
      background: #80979f;
      color: white;
      padding: 12px 20px 12px 30px;
      border: none;
      border-radius: 30px;
      font-size: 22px;
      cursor: pointer;
    `;
     // Insere o botão logo após o último skip link
    if (btnAcc) {
        document.body.appendChild(btn);
    } else {
        document.body.appendChild(btn); // fallback
    }
    btn.focus();
    
    const aside = document.createElement("aside");
    aside.id = "sidebar-toc";
    aside.setAttribute("aria-label", "Índice da Página");
    aside.hidden = true;
    aside.style.cssText = `
      position: fixed;
      top: 0;
      left: 0;
      width: 280px;
      height: 100%;
      background: #f8f9fa;
      box-shadow: 2px 0 10px rgba(0,0,0,0.15);
      overflow-y: auto;
      z-index: 9999;
      padding: 1rem;
      box-sizing: border-box;
    `;

    const closeBtn = document.createElement("button");
    closeBtn.innerHTML = "&times;";
    closeBtn.style.cssText = `
      background: none;
      border: none;
      font-size: 1.2rem;
      float: right;
      cursor: pointer;
      color: #333;
    `;
    aside.appendChild(closeBtn);

    const h2 = document.createElement("h2");
    h2.textContent = "Índice";
    h2.style.marginTop = "0";
    aside.appendChild(h2);

    const ul = document.createElement("ul");
    ul.id = "toc-list";
    ul.style.cssText = "list-style: none; padding: 0; margin: 0; font-size: 0.95rem;";
    aside.appendChild(ul);

    document.body.appendChild(aside);

    // Função auxiliar para mover o foco nos itens do menu
function setupKeyboardNavigation(menu) {
  const links = Array.from(menu.querySelectorAll("a"));

  links.forEach((link, index) => {
    link.addEventListener("keydown", (e) => {
      if (e.key === "ArrowDown") {
        e.preventDefault();
        const next = links[index + 1] || links[0];
        next.focus();
      }
      if (e.key === "ArrowUp") {
        e.preventDefault();
        const prev = links[index - 1] || links[links.length - 1];
        prev.focus();
      }
    });
  });
}

// Chamada após criar os links do índice
setupKeyboardNavigation(ul);
// Suporte à tecla ESC para fechar o índice e devolver o foco ao botão
document.addEventListener("keydown", function (e) {
  const tocVisible = !aside.hidden;
  if (tocVisible && e.key === "Escape") {
    aside.hidden = true;
    btn.setAttribute("aria-expanded", "false");
    btn.focus(); // Retorna o foco ao botão
  }
});


    const accessibilityAnchor = document.querySelector("a.acessibilidade");
    if (accessibilityAnchor && accessibilityAnchor.parentNode) {
      accessibilityAnchor.parentNode.insertBefore(btn, accessibilityAnchor.nextSibling);
    } else {
      // fallback: adiciona no body
      document.body.appendChild(btn);
    }

    /*document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll("section[aria-label]");
    if (sections.length === 0) return;
    */



     // 1. Adiciona links do menu principal
  /*const navMenu = document.querySelector("nav, .menu, .sandwich");
  if (navMenu) {
    const links = navMenu.querySelectorAll("a");
    links.forEach(link => {
      const li = document.createElement("li");
      const a = link.cloneNode(true);
      a.style.color = "#004085";
      a.style.textDecoration = "none";
      a.addEventListener("click", function (e) {
        e.preventDefault();
        const el = document.querySelector(this.getAttribute("href"));
        if (el) {
          el.scrollIntoView({ behavior: "smooth", block: "start" });
          aside.hidden = true;
          btn.setAttribute("aria-expanded", "false");
        }
      });
      li.appendChild(a);
      ul.appendChild(li);
    });
  }*/
 // Seleciona o menu principal (exemplo: nav#main-menu, ajuste conforme seu tema)
  const mainMenu = document.querySelector("nav#main-menu") || document.querySelector("nav");

  // Seleciona o menu sandwich
  
  

    // Verifica se o menu principal existe
    if (!mainMenu) return;
    
    
    
    if (window.getComputedStyle(mainMenu).display === "none") return; // pula invisíveis
    
    if (!mainMenu.id) mainMenu.id = "main-menu";
    const li = document.createElement("li");
    const a = document.createElement("a");
    a.href = `#${mainMenu.id}`;
    a.textContent = "Menu Principal";
    a.style.textDecoration = "none";
    a.style.color = "#004085";
    a.addEventListener("click", function (e) {
        e.preventDefault();
        const targetElement = document.getElementById(mainMenu.id);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: "smooth", block: "start" });
            targetElement.setAttribute("tabindex", "-1"); // Permite foco
            targetElement.focus({ preventScroll: true }); // Dá foco sem pular a rolagem
        }

        aside.hidden = true;
        btn.setAttribute("aria-expanded", "false");
    });
    li.appendChild(a);
    ul.appendChild(li);
    

    
    

    
    // 2. Captura seções com atributo aria-label e adiciona ao índice



  const sections = document.querySelectorAll("section[aria-label]");
    sections.forEach((section, index) => {
    if (window.getComputedStyle(section).display === "none") return; // pula invisíveis
    const label = section.getAttribute("aria-label");
    const id = section.id || `section-${index}`;
    section.id = id;
    
    const li = document.createElement("li");
    const a = document.createElement("a");
    a.href = `#${id}`;
    a.textContent = label;
    a.style.textDecoration = "none";
    a.style.color = "#004085";

    li.appendChild(a);
    ul.appendChild(li);
    });
  // 2. Captura blocos da página e adiciona ao índice
 /* const sections = content.querySelectorAll("section");
  let count = 1;
  sections.forEach(sec => {
    if (!sec.id) sec.id = `secao-${count++}`;

    const heading = sec.querySelector("h1, h2, h3, h4, h5, h6");
    if (heading) {
      const li = document.createElement("li");
      const a = document.createElement("a");
      a.href = `#${sec.id}`;
      a.textContent = heading.innerText;
      a.style.color = "#004085";
      a.style.textDecoration = "none";

      a.addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById(sec.id).scrollIntoView({ behavior: "smooth", block: "start" });
        aside.hidden = true;
        btn.setAttribute("aria-expanded", "false");
      });

      li.appendChild(a);
      ul.appendChild(li);
    }
  });

    headings.forEach((heading, index) => {
      if (!heading.id) heading.id = `heading-${index + 1}`;

      const li = document.createElement("li");
      li.style.marginBottom = "0.5rem";

      const a = document.createElement("a");
      a.href = `#${heading.id}`;
      a.textContent = heading.innerText;
      a.style.textDecoration = "none";
      a.style.color = "#004085";

      a.addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById(heading.id).scrollIntoView({ behavior: "smooth", block: "start" });
        aside.hidden = true;
        btn.setAttribute("aria-expanded", "false");
      });

      li.appendChild(a);
      ul.appendChild(li);
    });*/

    btn.addEventListener("click", () => {
        aside.hidden = !aside.hidden;
        const expanded = !aside.hidden;
        btn.setAttribute("aria-expanded", expanded.toString());
        if (expanded) {
    // Espera pequeno tempo para garantir que o aside foi exibido
    setTimeout(() => {
      const firstLink = ul.querySelector("a");
      if (firstLink) {
        firstLink.setAttribute("tabindex", "-1"); // Garante que possa receber foco
        firstLink.focus();
      }
    }, 100); // Pequeno atraso para o aside renderizar
  }
      
    });

    closeBtn.addEventListener("click", () => {
      aside.hidden = true;
      btn.setAttribute("aria-expanded", "false");
    });

    document.addEventListener("click", function (e) {
      if (!aside.contains(e.target) && e.target !== btn && !aside.hidden) {
        aside.hidden = true;
        btn.setAttribute("aria-expanded", "false");
      }
    });
  });
</script>


</body>

</html><!-- end of site. what a ride! -->