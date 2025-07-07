<div class="consulta-rapida">
    <h2 class="desktop-headeline-4">
    <img src="<?php echo get_template_directory_uri() ?>/assets/images/consulta.svg"
         alt="Consulta rápida">
    Consulta rápida
    </h2>
    <div class="consulta">
    <nav class="flex-col flex nav">
        <a href="" class="active col" data-active="projetos">
            Escolher projeto
        </a>
        <a href="" class="col" data-active="leis">
            Escolher lei
        </a>
    </nav>
        <?php
        $imagem = get_field("imagem_consulta");
        if(!$imagem) : ?>
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/consulta_2.svg" alt="Consulta Rápida"
                 class="thumbnail">
        <?php
        else :
            echo wp_get_attachment_image($imagem["ID"], "full", "", ["class" => "thumbnail"]);
            ?>
        <?php endif;?>
    <form class="context projetos" onsubmit="mostraProjetosProjetos(); return false;" >
        <h3 class="desktop-headeline-5">
            Escolha o projeto
        </h3>
        <label for="projTipo" class="label mt-24">
            Tipo de projeto
        </label>
        <select name="" id="projTipo" class="select">
            <option value="TODOS">Todos os tipos</option>
            <option value="%22PROJETO DE LEI%22">Projeto de Lei</option>
            <option value="%22PROJETO DE EMENDA A LEI ORGANI%22">Projeto de Emenda à Lei Orgânica</option>
            <option value="%22PROJETO DE DECRETO LEGISLATIVO%22">Projeto de Decreto Legislativo</option>
            <option value="%22PROJETO DE RESOLUCAO%22">Projeto de Resolução</option>
        </select>

        <label for="projNumero" class="label">
            Número do projeto
        </label>
        <input type="text" placeholder="Digite o número do projeto" class="field-style" id="projNumero">

        <label for="projAno" class="label">
            Ano
        </label>
        <input type="text" placeholder="Digite o ano de protocolo" class="field-style" id="projAno">
        <button class="button-secondary mt-24 w100" type="submit">
            Pesquisar
        </button>
    </form>

    <form class="context leis" onsubmit="mostraProjetosLeis(); return false;" style="display: none">
        <h3 class="desktop-headeline-5">
            Escolha a lei
        </h3>
        <label for="leiTipo" class="label mt-24">
            Tipo de lei
        </label>
        <select name="" id="leiTipo" class="select">
            <option value="TODOS">Todos os tipos</option>
            <option value="%22LEI%22">Lei Ordinária</option>
            <option value="%22DECRETO%22">Decreto</option>
            <option value="%22DECRETO LEGISLATIVO%22">Decreto Legislativo</option>
            <option value="%22DECRETO-LEI%22">Decreto-Lei</option>
            <option value="%22EMENDA%22">Emenda à Lei Orgânica</option>
            <option value="%22ATO DA CMSP%22">Ato da CMSP</option>
            <option value="%22ATO AMC%22">Ato da AMC</option>
            <option value="%22ACTO%22">Acto</option>
            <option value="%22ACTO EXECUTIVO%22">Acto Executivo</option>
            <option value="%22ATO GOVERNO PROVISORIO%22">Ato do Governo Provisório</option>
            <option value="%22RESOLUCAO DA CMSP%22">Resolução da CMSP</option>
            <option value="%22RESOLUCAO AMC%22">Resolução da AMC</option>
            <option value="%22RESOLUCAO%22">Resolução</option>
            <option value="%22MEMORANDO%22">Memorando</option>
            <option value="%22REQUERIMENTO%22">Requerimento</option>
        </select>

        <label for="leiNumero" class="label">
            Número da lei
        </label>
        <input type="text" placeholder="Digite o número da lei" class="field-style" id="leiNumero">

        <label for="leiAno" class="label">
            Ano de aprovação
        </label>
        <input type="text" placeholder="Digite o ano da aprovação" class="field-style" id="leiAno">
        <button class="button-secondary mt-24 w100" type="submit">
            Pesquisar
        </button>
    </form>
    </div>
    <script>
        function mostraProjetosLeis() {
            var varDomain      = "https://www.saopaulo.sp.leg.br/cgi-bin/wxis.bin/iah/scripts/?IsisScript=iah.xis";
            var varForm        = "&form=A";
            var varNavbar      = "&navBar=OFF";
            var varHits        = "&hits=200";
            var varLang        = "&lang=pt";
            var varNextAction  = "&nextAction=search";
            var varBase        = "&base=legis";
            var varInit        = "&conectSearch=init";
            var URL = varDomain + varForm +  varNavbar + varHits +  varLang + varNextAction + varBase + varInit;
            var varExprSearch  = "&exprSearch=";
            var varIndexSearch = "&indexSearch=";

            var varTP = document.getElementById("leiTipo").value;
            if (document.getElementById("leiTipo").value=="TODOS") {
                varTP = varExprSearch + "$" + varIndexSearch + "%5EnTn%5ELTipo+de+norma%5Ex%2F5%5EyDATABASE";
            } else if (document.getElementById("leiTipo").value==="") {
                varTP = "";
            } else {
                varTP = varExprSearch + document.getElementById("leiTipo").value + varIndexSearch + "%5EnTn%5ELTipo+de+norma%5Ex%2F5%5EyDATABASE";
            }

            var varNumberPj = document.getElementById("leiNumero").value;
            if (document.getElementById("leiNumero").value==="") {
                varNumberPj = "";
            } else {
                varNumberPj = varExprSearch + parseInt(document.getElementById("leiNumero").value,10) + varIndexSearch + "%5EnNn%5ELN%FAmero+da+norma%5Ex%2F6%5EyDATABASE";
            }

            var varYearPj = document.getElementById("leiAno").value;
            if (document.getElementById("leiAno").value==="") {
                varYearPj = "";
            } else {
                varYearPj = varExprSearch + document.getElementById("leiAno").value + varIndexSearch + "%5EnDn%5ELAno+da+norma%5Ex%2F10%5EyDATABASE";
            }

            var varAnd  = "&conectSearch=and";
            URL += varTP + varAnd + varNumberPj + varAnd + varYearPj;

            window.open(URL, "Resultado", "toolbar=0,scrollbars=1,location=no,statusbar=0,menubar=0,resizable=0,width=790,height=500");
        }

        function mostraProjetosProjetos() {
            var varDomain      = "https://www.saopaulo.sp.leg.br/cgi-bin/wxis.bin/iah/scripts/?IsisScript=iah.xis";
            var varForm        = "&form=A";
            var varNavbar      = "&navBar=OFF";
            var varHits        = "&hits=200";
            var varLang        = "&lang=pt";
            var varNextAction  = "&nextAction=search";
            var varBase        = "&base=proje";
            var varInit        = "&conectSearch=init";
            var URL = varDomain + varForm +  varNavbar + varHits +  varLang + varNextAction + varBase + varInit;
            var varExprSearch  = "&exprSearch=";
            var varIndexSearch = "&indexSearch=";

            var varTP = document.getElementById("projTipo").value;
            if (document.getElementById("projTipo").value=="TODOS") {
                varTP = varExprSearch + "$" + varIndexSearch + "%5EnCm%5ELTipo+de+projeto%5Etshort%5Ex%2F20%5EyDATABASE";
            } else if (document.getElementById("projTipo").value==="") {
                varTP = "";
            } else {
                varTP = varExprSearch + document.getElementById("projTipo").value + varIndexSearch + "%5EnCm%5ELTipo+de+projeto%5Etshort%5Ex%2F20%5EyDATABASE";
            }

            var varNumberPj = document.getElementById("projNumero").value;
            if (document.getElementById("projNumero").value==="") {
                varNumberPj = "";
            } else {
                varNumberPj = varExprSearch + parseInt(document.getElementById("projNumero").value,10) + varIndexSearch + "%5EnPj%5ELN%FAmero+do+projeto%5Ex%2F30%5EyDATABASE";
            }

            var varYearPj = document.getElementById("projAno").value;
            if (document.getElementById("projAno").value==="") {
                varYearPj = "";
            } else {
                varYearPj = varExprSearch + document.getElementById("projAno").value + varIndexSearch + "%5EnDp%5ELAno+do+projeto%5Ex%2F40%5Etshort%5EyDATABASE";
            }

            var varAnd  = "&conectSearch=and";
            URL += varTP + varAnd + varNumberPj + varAnd + varYearPj;

            window.open(URL, "_blank", "toolbar=0,scrollbars=1,location=yes,statusbar=0,menubar=0,resizable=0,width=790,height=500");
        }

    </script>
</div>