<section class="box-newsletter content-box">
  <header class="content-box-top">
    <h3 class="content-box-title icon-calendar-red">Boletim Informativo</h3>
  </header>

  <section class="box-newsletter-content box-height-adjust">
    <p><strong class="red">Cadastre-se</strong> e receba as notícias da Câmara Municipal de São Paulo</p>
    <form id="participe-boletim-informativo" method="post" action=""> 
    <div style="font-weight: bold;padding-bottom: 20px;text-align: center;">
    <?php
    require_once(get_template_directory(). '/helpers/form.php');

     if(is_post() )
     {  
      $boletim_name = filter_var($_POST['boletim_name'], FILTER_SANITIZE_STRING);
      $boletim_email = filter_var($_POST['boletim_email'], FILTER_VALIDATE_EMAIL);
      $boletim_regiao = filter_var($_POST['boletim_regiao'], FILTER_SANITIZE_STRING);
      
      
      $boletim_post = array(
        'post_type' => 'boletim_inf',
        'post_title' => $boletim_email,
        'post_status'   => 'publish',
      );

      $post_id = wp_insert_post( $boletim_post, $wp_error );

      if(false !== $post_id) 
      {
        add_post_meta($post_id, '_cmsp_boletim_nome', $boletim_name);
        add_post_meta($post_id, '_cmsp_boletim_regiao', $boletim_regiao);
        flash_message("success", "Cadastro efetuado com sucesso!");  
      
      } else {
        flash_message("error", "Ocorreu um erro ao efetuar cadastro. Por favor, tente novamente.");
      }

    }

    ?>
	</div>

      <div class="form-row">
        <input type="text" name="boletim_name" id="box-newsletter-name" placeholder="Digite seu nome" data-rule-required="true">
      </div>
      <div class="form-row">
        <input type="email" name="boletim_email" id="box-newsletter-email" placeholder="Digite seu email" data-rule-required="true" data-rule-email="true">
      </div>
      <div class="form-row">
        <div class="form-select-wrapper">
          <select name="boletim_regiao" data-rule-required="true">
            <option value="">Escolha sua Região</option>
            <option value="Centro">Centro</option>
            <option value="Norte">Norte</option>
            <option value="Oeste">Oeste</option>
            <option value="Sul">Sul</option>
            <option value="Leste">Leste</option>          
          </select>
        </div>
      </div>
      <div class="form-row">
        <div style="float: left; width: 95px;display:none;">
          <input type="radio" value="subscribe" class="input-checkbox" name="sub" id="box-newsletter-subscribe">
          <label for="box-newsletter-subscribe" class="label-checkbox">Cadastrar</label>
        </div>
        <div style="float: left; width: 100px; display:none;">
          <input type="radio" value="unsubscribe" class="input-checkbox" name="sub" id="box-newsletter-unsubscribe">
          <label for="box-newsletter-unsubscribe" class="label-checkbox">Descadastrar</label>
        </div>
      </div>
      <div class="form-row">
        <input type="submit" class="btn" value="Enviar">
      </div>
    </form>
  </section>
</section><!-- end .box-agenda -->