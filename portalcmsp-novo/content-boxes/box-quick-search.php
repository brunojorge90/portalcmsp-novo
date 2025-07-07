<!-- 
2021-07-23: adicionado este comentário

-->
<section class="content-box box-quick-search">
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

    <header class="content-box-top">
      <h2 class="content-box-title icon-search-red"><a href="#">Consulta Rápida / <span class="red">Atividade Legislativa</span></a></h2>
    </header>

    <div class="box-quick-search-container">

      <nav class="box-quick-search-nav">
        <select class="nav-mobile mobile-only">
          <option value="item-vereadores">Vereadores</option>
          <option value="item-projetos">Projetos</option>
          <option value="item-leis">Leis</option>
          <option value="item-sessao-plenaria">Sessão Plenária</option>
          <option value="item-comissoes">Comissões</option>
          <option value="item-audiencia-publica">Audiência Pública</option>
          <option value="item-termo-livre">Geral</option>
        </select>

        <ul class="mobile-hide">
          <li class="item-vereadores active"><a href="#">Vereadores</a></li>
          <li class="item-projetos"><a href="#">Projetos</a></li>
          <li class="item-leis"><a href="#">Leis</a></li>
          <li class="item-sessao-plenaria"><a href="#">Sessão Plenária</a></li>
          <li class="item-comissoes"><a href="#">Comissões</a></li>
          <li class="item-audiencia-publica"><a href="#">Audiência Pública</a></li>
          <li class="item-termo-livre"><a href="#">Geral</a></li>
        </ul>
      </nav>

      <?php
      $vereadoresQuery = new WP_Query(array(
          'post_type' => 'vereador',
          'posts_per_page' => -1,
          'meta_key' => '_cmsp_vereador_ativo',
          'orderby' => 'title',
          'order' => 'ASC'
        ));
      $vereadores_options = '<option value="">Escolha um vereador</option>';
      $mandato_options = $vereadores_options;
      while($vereadoresQuery->have_posts()){ $vereadoresQuery->the_post();
        $vereador_name = get_post_meta($post->ID,'_cmsp_vereador_name', true);
        if($vereador_name == '') $vereador_name = get_the_title();
        $vereadores_options .='<option value="'. get_the_permalink() .'">'. $vereador_name .'</option>';
        $mandato_options .='<option value="'. get_the_permalink() .'#mandato-participativo">'. $vereador_name .'</option>';
      }
      ?>

      <div class="box-quick-search-items">
        <article class="box-quick-search-item item-vereadores active">
          <h3>Perfil</h3>
          <div class="form-row">
            <select class="white" onchange="javascript:document.location.href=this.value;">
              <?php echo $vereadores_options; ?>
            </select>
          </div>

          <h3>Mandato Participativo</h3>
          <p>Cadastre-se e participe do mandato do vereador com propostas, sugestões e receba informativos</p>
          <form>
            <div class="form-row">
              <select class="white" onchange="javascript:document.location.href=this.value;">
                <?php echo $mandato_options; ?>
              </select>
            </div>
          </form>
        </article>

        <article class="box-quick-search-item item-projetos">
          <h3>Consulta de Projetos</h3>
          <form onsubmit="javascript:alert('vale o onclick do botão'); mostraProjetosProjetos(); return false;">
            <div class="form-row">
              <select id="projTipo" name="projTipo">
                <option value="TODOS">Todos os tipos</option>
                <option value="%22PROJETO DE LEI%22">Projeto de Lei</option>
                <option value="%22PROJETO DE EMENDA A LEI ORGANI%22">Projeto de Emenda à Lei Orgânica</option>
                <option value="%22PROJETO DE DECRETO LEGISLATIVO%22">Projeto de Decreto Legislativo</option>
                <option value="%22PROJETO DE RESOLUCAO%22">Projeto de Resolução</option>
              </select>
            </div>
            <div class="form-row">
              <label for="projNumero">Número</label>
              <input type="text" id="projNumero" name="projNumero">
            </div>
            <div class="form-row">
              <label for="projAno">Ano</label>
              <input type="text" id="projAno" name="projAno" placeholder="AAAA">
            </div>
            <div class="form-row">
              <input type="button" class="btn" value="Pesquisar" onclick="mostraProjetosProjetos()">
            </div>
          </form>
        </article>

        <article class="box-quick-search-item item-leis">
          <h3>Consulta de Leis</h3>
          <form onsubmit="javascript:alert('vale o onclick do botão'); mostraProjetosLeis(); return false;">
            <div class="form-row">
              <select id="leiTipo" name="leiTipo">
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
            </div>
            <div class="form-row">
              <label for="leiNumero">Número</label>
              <input type="text" id="leiNumero" name="leiNumero">
            </div>
            <div class="form-row">
              <label for="leiAno">Ano</label>
              <input type="text" id="leiAno" name="leiAno" placeholder="AAAA">
            </div>
            <div class="form-row">
              <input type="button" class="btn" value="Pesquisar" onclick="mostraProjetosLeis()">
            </div>
          </form>
        </article>

        <article class="box-quick-search-item item-sessao-plenaria">
          <h3>Sessão Plenária</h3>
          <ul>
            <li><a href="<?php echo home_url(); ?>/atividade-legislativa/sessao-plenaria/pauta-das-sessoes/">Pauta das Sessões</a></li>
            <li><a href="<?php echo home_url(); ?>/atividade-legislativa/sessao-plenaria/presenca-em-plenario/">Presença em Plenário</a></li>
            <li><a href="<?php echo home_url(); ?>/atividade-legislativa/sessao-plenaria/votacao-em-plenario/">Votação em Plenário</a></li>
            <li><a href="<?php echo home_url(); ?>/atividade-legislativa/sessao-plenaria/registro-das-sessoes/">Registro das Sessões</a></li>
            <li><a href="<?php echo home_url(); ?>/atividade-legislativa/sessao-plenaria/projetos/">Projetos</a></li>
            <!--li><a href="<?php echo home_url(); ?>/atividade-legislativa/sessao-plenaria/materias-em-condicao-de-pauta/">Matérias em condição de Pauta</a></li-->
          </ul>
        </article>

        <article class="box-quick-search-item item-comissoes">
          <h3>Comissões</h3>
          <ul>
            <li><a href="<?php echo home_url(); ?>/atividade-legislativa/comissoes/">Ir para a página das Comissões</a></li>
          </ul>
        </article>

        <article class="box-quick-search-item item-audiencia-publica">
          <h3>Audiências Públicas</h3>
          <ul>
            <li>Confira a agenda para as próximas Audiências Públicas convocadas pelas Comissões:</li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo home_url(); ?>/atividade-legislativa/agenda-da-camara/" target="_blank">Agenda do Cerimonial</a></li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://splegisconsulta.saopaulo.sp.leg.br/ReuniaoComissaoVotacao/PautasAudienciasPublicas" target="_blank">Agenda do SPLegis</a></li>
            <li>&nbsp;</li>
            <li>Consultar o <a href="<?php echo home_url(); ?>/atividade-legislativa/audiencias-publicas/registro-escrito/">registro escrito</a> das Audiências Públicas já realizadas</li>
          </ul>
        </article>

        <article class="box-quick-search-item item-termo-livre">
          <h3>Termo livre</h3>
          <p>&nbsp;</p>
          <p>Pesquisa por qualquer termo contido nos documentos legislativos registrados no <br><strong>SPLegis</strong> - Sistema do Processo Legislativo.</p>
          <p><a href="https://splegisconsulta.saopaulo.sp.leg.br/Pesquisa/Geral" target="_blank">Pesquisa de Termo Livre</a></p>
        </article>

      </div>

    </div>
</section><!-- end .box-quick-search -->