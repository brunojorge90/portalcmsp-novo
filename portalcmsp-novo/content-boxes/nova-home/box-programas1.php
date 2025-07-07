<section class="programas" aria-label="Programas e ações da Câmara">
    <div class="container">
        <h2 class="desktop-headeline-4">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/programas.svg" alt="" aria-hadden="true">
            <!-- Ícone decorativo --> Programas e ações
        </h2>

        <div class="flex-programas g-32 owl-carousel owl-theme">
            <?php
            $itens = get_field('itens_programas');
            foreach ($itens as $item) :
            ?>
            <a class="col colEvent" href="<?php echo $item['link'] ?>" aria-label="Acessar o programa: <?php echo $item['titulo']?>" <?php if ($item['nova_aba']) echo 'target="_blank"' ?>>
                <img src="<?php echo $item['imagem'] ?>" alt="" aria-hidden="true" class="thumbnail">
                <div class="context p-16">
                    <h3><?php echo $item['titulo']?></h3>
                    <p>
                        <?php echo $item['descricao']?>
                    </p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>