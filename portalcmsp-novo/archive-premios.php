<?php get_header(); ?>

<main class="site-content container" role="main" aria-label="Lista de prêmios disponíveis">

  <header class="archive-header">
    <h1 class="archive-title">Prêmios</h1>

    <!-- Filtro por ano (GET: ?ano=2024) -->
    <form method="get" class="filtro-ano" role="search" aria-label="Filtrar por ano">
      <label for="ano-select">Filtrar por ano:</label>
      <select name="ano" id="ano-select" onchange="this.form.submit()">
        <option value="">Todos os anos</option>
        <?php
          $anos = range(date('Y'), 2000);
          foreach ($anos as $ano) {
            echo '<option value="' . esc_attr($ano) . '" ' . selected($_GET['ano'] ?? '', $ano, false) . '>' . esc_html($ano) . '</option>';
          }
        ?>
      </select>
    </form>
  </header>

  <?php
    // Filtro de query por ano
    if (!empty($_GET['ano'])) {
      add_filter('pre_get_posts', function ($query) {
        if (!is_admin() && $query->is_main_query() && is_post_type_archive('premios')) {
          $query->set('meta_query', [[
            'key' => 'ano_do_premio',
            'value' => sanitize_text_field($_GET['ano']),
            'compare' => '='
          ]]);
        }
      });
    }
  ?>

  <?php if (have_posts()) : ?>
    <section class="lista-premios" aria-label="Lista de prêmios">
      <div class="grid-premios">
        <?php while (have_posts()) : the_post(); ?>
          <?php $ano = get_post_meta(get_the_ID(), 'ano_do_premio', true); ?>
          <article class="card-premio" role="article" aria-labelledby="premio-<?php the_ID(); ?>">
            <a href="<?php the_permalink(); ?>" aria-label="Acessar prêmio <?php the_title_attribute(); ?>">
              <?php
                the_post_thumbnail('medium', [
                  'alt' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?: 'Imagem do prêmio ' . get_the_title(),
                ]);
              ?>
            </a>

            <div class="card-conteudo">
              <?php if ($ano): ?>
                <span class="ano-premio">Ano: <?php echo esc_html($ano); ?></span>
              <?php endif; ?>

              <h2 id="premio-<?php the_ID(); ?>">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>

              <a class="botao-vermais" href="<?php the_permalink(); ?>">Ver mais</a>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <?php the_posts_pagination([
        'mid_size' => 2,
        'prev_text' => __('« Anterior'),
        'next_text' => __('Próximo »'),
        'screen_reader_text' => 'Navegação de páginas'
      ]); ?>
    </section>

  <?php else : ?>
    <p>Nenhum prêmio encontrado.</p>
  <?php endif; ?>

</main>

<?php get_footer(); ?>
