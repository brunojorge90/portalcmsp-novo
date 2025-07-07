<?php
get_header();
?>
<div class="pop-up-autenticacao">
    <div class="fechar">
        <a href="<?php echo get_site_url()?>" id="fecharcpf">
            <img src="<?php echo get_template_directory_uri()?>/dist/images/icon-close.svg" alt="Fechar">
        </a>
    </div>

    <div class="conteudo-pop-up">
        <h2 class="desktop-headeline-2">Autenticação</h2>
        <h3 class="desktop-headeline-4">Para acessar esta área do portal, é necessário que você forneça o número do seu CPF.</h3>

        <form class="dados-CPF" method="POST" onsubmit="return valid()">
            <h4 class="desktop-headeline-4">Digite os seus dados abaixo:</h4>

            <label for="CPF" class="desktop-body-2 mt-32">
                CPF
            </label>
            <input type="text" name="cpf" placeholder="Digite o número do seu CPF (obrigatório)" class="field-style mt-16" id="CPF">
            <span style="color: red;display: none;font-size:12px;margin-top:12px" id="spancpf">Por favor, digite um CPF válido</span>
            <div class="botao">
                <button class="button-primary mt-24" type="submit">
                    Acessar
                </button>
            </div>
        </form>
        <span class="desktop-body-3">Os seus dados serão registrados em ambiente seguro seguindo todos os protocolos de <a href="#">LGPD</a> exigidos na legislação brasileira.</span>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    jQuery("#CPF").mask('000.000.000-00', {reverse: true});

    function valid() {
        if(validarCPF(jQuery("#CPF").val())) {
            return true
        }
        else {
            jQuery("#spancpf").show();
            return false;
        }
    }

    function validarCPF(cpf) {
        // Limpar caracteres não numéricos
        cpf = cpf.replace(/[^\d]/g, '');

        // Verificar se o CPF tem 11 dígitos
        if (cpf.length !== 11) {
            return false;
        }

        // Verificar se todos os dígitos são iguais
        if (/^(\d)\1*$/.test(cpf)) {
            return false;
        }

        // Calcular os dígitos verificadores
        let soma = 0;
        let resto;

        for (let i = 1; i <= 9; i++) {
            soma += parseInt(cpf[i - 1]) * (11 - i);
        }

        resto = (soma * 10) % 11;

        if (resto === 10 || resto === 11) {
            resto = 0;
        }

        if (resto !== parseInt(cpf[9])) {
            return false;
        }

        soma = 0;

        for (let i = 1; i <= 10; i++) {
            soma += parseInt(cpf[i - 1]) * (12 - i);
        }

        resto = (soma * 10) % 11;

        if (resto === 10 || resto === 11) {
            resto = 0;
        }

        if (resto !== parseInt(cpf[10])) {
            return false;
        }

        return true;
    }
</script>
<style>
    #irconteudo {
        display: flex;
        justify-content: center;
    }
</style>
</main>
<?php get_footer()?>