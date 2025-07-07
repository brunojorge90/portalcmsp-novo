<?php
get_header();
?>
<section class="organograma">
    <div class="container">
        <div class="desktop-body-3">
            <div class="breadcrumbs cf">
                <?php if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('<p class="wrap cf">','</p>');
                } ?>
            </div>

            <h1 class="desktop-headeline-2 mt-44">Organograma da Câmara</h1>
            <p class="desktop-body-1 mt-32">Conheça a estrutura das unidades doa Câmara Municipal, suas atribuições, responsáveis e formas de contato.</p>

            <div class="busca mt-48">
                <img src="<?php echo get_template_directory_uri()?>/dist/images/icon-busca.svg" alt="busca">
                <input type="search" name="busca-organograma" id="busca-organograma" class="field-style" placeholder="Digite o que procura e clique em buscar...">
                <button class="button-primary">Buscar</button>
            </div>

            <!--cards nivel01-->
            <div class="organograma-nivel01 mt-32">
                <?php
                $args = [
                    'post_type' => 'organograma',
                    'post_parent' => 0,
                    'showposts'=> -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                ];

                $posts = get_posts($args);

                foreach ($posts as $post) :
                ?>
                <div class="card-nivel01">
                    <div class="img-servicos w100">
                        <img src="<?php echo get_field('icone',  $post->ID)?>" alt="imagem">
                    </div>

                    <div class="infos-servicos mt-16">
                        <h2 class="desktop-headeline-5"><?php echo $post->post_title?></h2>
                        <p class="desktop-body-3">
                            <?php echo get_field("resumo", $post->ID)?>
                        </p>
                    </div>
                    <?php
                    $args_child = [
                        'post_type' => 'organograma',
                        'post_parent' => $post->ID,
                        'showposts'=> 1
                    ];
                    $post_child = get_posts($args_child); ?>
                    <a href="<?php echo get_permalink($post->ID)?>" class="button-secondary button-size-sm <?php if(!$post->post_content && count($post_child) === 0) echo 'disabled-link'?> w100">
                        Acessar
                        <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </a>
                </div>
                <?php endforeach;?>
            </div>
            <!--cards nivel01-->

        </div>
    </div>
</section>
<?php
get_footer();
?>

