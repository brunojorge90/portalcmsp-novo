<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<main class="single-premios container" role="main" aria-label="Conteúdo do prêmio <?php the_title_attribute(); ?>">

  <!-- Trilha de navegação -->
  <nav class="breadcrumb" aria-label="Caminho de navegação">
    <a href="<?php echo esc_url(home_url('/')); ?>">Início</a> &raquo;
    <a href="<?php echo esc_url(get_post_type_archive_link('premios')); ?>">Prêmios</a> &raquo;
    <span aria-current="page"><?php the_title(); ?></span>
  </nav>

  <!-- Cabeçalho com título -->
  <h1 class="entry-title"><?php the_title(); ?></h1>

  <div class="premio-layout">
    <!-- Imagem destacada -->
    <?php if (has_post_thumbnail()) : ?>
      <div class="premio">
        <?php
          $status = get_post_meta(get_the_ID(), 'status_inscricao', true);

          if ($status === 'encerrada') {
            echo '<p class="status-encerrado"><strong>Inscrições Encerradas</strong></p>';
          } elseif ($status === 'ativa') {
            echo '<p class="status-ativa"><strong>Inscrições Abertas</strong></p>';
          }
        ?>
          <div class="premio-imagem">
            <?php 
            the_post_thumbnail('large', [
              'alt' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?: 'Imagem ilustrativa do prêmio ' . get_the_title(),
            ]); 
            ?>
          </div>
      </div>
    <?php endif; ?>

    <!-- Conteúdo lateral -->
    <div class="premio-detalhes">
          <!-- Compartilhamento -->
      <section aria-label="Compartilhar nas redes sociais">
        <?php
          $url = urlencode(get_permalink());
          $titulo = urlencode(get_the_title());
        ?>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $titulo; ?>" target="_blank" aria-label="Compartilhar no LinkedIn">
          <img src="https://www.saopaulo.sp.leg.br/wp-content/themes/portalcmsp-novo/assets/images/post-linkedin.svg" alt="Compartilhar Linkedin">
        </a> 
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" aria-label="Compartilhar no Facebook">
          <img src= "https://www.saopaulo.sp.leg.br/wp-content/themes/portalcmsp-novo/assets/images/post-facebook.svg" alt="Compartilhar Facebook" ></a>
        </a> 
        <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $titulo; ?>" target="_blank" aria-label="Compartilhar no Twitter">
          <img src="https://www.saopaulo.sp.leg.br/wp-content/themes/portalcmsp-novo/assets/images/post-twitter.svg" alt="Compartilhar Twitter">
        </a> 
        <a href="mailto:?subject=<?php echo $titulo; ?>&body=<?php echo $url; ?>" aria-label="Compartilhar por email">
          <img src="https://www.saopaulo.sp.leg.br/wp-content/themes/portalcmsp-novo/assets/images/post-email.svg" alt="Compartilhar Email">
        </a>
      </section>
      <!-- Descrição -->
      <section aria-labelledby="descricao-premio">
        <h2 id="descricao-premio">Descrição do Prêmio</h2>
        <?php
          $descricao = get_post_meta(get_the_ID(), 'descricao_premio', true);
          echo wp_kses_post(wpautop($descricao));
        ?>
      </section>

      <!-- Como participar -->
      <section aria-labelledby="como-participar">
        <h2 id="como-participar">Como Participar</h2>
        <?php
          $como_participar = get_post_meta(get_the_ID(), 'como_participar', true);
          if ($como_participar) :
        ?>
          <a href="<?php echo esc_url($como_participar); ?>" class="botao-download" download target="_blank" rel="noopener noreferrer">Baixar "Como Participar"</a>
        <?php else: ?>
          <p>Informação não disponível.</p>
        <?php endif; ?>
      </section>

      <!-- Formulário -->

      <section aria-labelledby="formulario-inscricao">
        <?php if ($status === 'ativa' && !empty($formulario)) : ?>
          <h2 id="formulario-inscricao">Formulário de Inscrição</h2>
          <?php
            $formulario = get_post_meta(get_the_ID(), 'formulario_inscricao', true);
            if ($formulario) :
          ?>
            <a href="<?php echo esc_url($formulario); ?>" class="botao-download" download target="_blank" rel="noopener noreferrer">Baixar Formulário</a>
          <?php else: ?>
            <p>Informação não disponível.</p>
          <?php endif; ?>
        <?php endif; ?>
      </section>
      
        <section class="bloco-informacao" aria-label="Livreto do prêmio">
          <?php
            $livreto = get_post_meta(get_the_ID(), 'livreto', true);
          if ($livreto):
          ?>
          <h2>Livreto</h2>
          <a href="<?php echo esc_url($livreto); ?>" target="_blank" rel="noopener noreferrer" class="botao-download">
            Baixar livreto
          </a>
        </section>
      <?php endif; ?>

      

    </div><!-- /.premio-detalhes -->
  </div><!-- /.premio-layout -->

</main>

<?php endwhile; else: ?>
  <p>Prêmio não encontrado.</p>
<?php endif; ?>

<?php get_footer(); ?>
