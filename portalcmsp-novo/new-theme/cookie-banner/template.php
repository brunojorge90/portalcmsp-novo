<div id="cookie-banner">
    <div class="container">
        <div class="flex">
            <p>Este site usa cookies para garantir que você obtenha a melhor experiência.<br>Ao continuar, você concorda com nossa
                <a href="<?php echo get_site_url()?>/lgpd">política de cookies.</a></p>
            <button onclick="aceitarCookies()" class="button-primary">Aceitar</button>
        </div>
    </div>
</div>

<style>
    #cookie-banner {
        box-shadow: -8px -8px 25px 0 rgba(0,0,0,.25);
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #2c2c2c;
        color: #fff;
        transition: none !important;
        padding: 10px;
        text-align: left;
        z-index: 9999;
    }

    #cookie-banner .flex {
        width: 100%;
        justify-content: space-between;
        display: flex;
        gap: 26px;
        align-items: center;
    }
    @media (max-width: 768px) {
        #cookie-banner .flex {
            flex-direction: column;
        }
    }

    #cookie-banner .button-primary {
        min-width: 189px;
    }
    #cookie-banner a {
        color: white;
    }

</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (!verificarCookie("cookieConsent")) {
            exibirBanner();
        }
    });

    function verificarCookie(nomeCookie) {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            if (cookie.startsWith(nomeCookie + '=')) {
                return true;
            }
        }
        return false;
    }

    function exibirBanner() {
        const banner = document.getElementById('cookie-banner');
        jQuery(banner).fadeIn();
    }

    function aceitarCookies() {
        const banner = document.getElementById('cookie-banner');
        jQuery(banner).fadeOut();

        // Define o cookie com uma validade de 30 dias
        const dataExpiracao = new Date();
        dataExpiracao.setDate(dataExpiracao.getDate() + 30);

        document.cookie = 'cookieConsent=aceito; expires=' + dataExpiracao.toUTCString() + '; path=/';

        // Faz a requisição AJAX para salvar a aceitação no lado do servidor (PHP)
        $.ajax({
            type: 'POST',
            url: '<?php echo get_site_url()?>/wp-json/custom/v1/salvar-cookie',
            data: { cookieConsent: 'aceito' },
            success: function (response) {
                console.log(response);
            }
        });
    }
</script>