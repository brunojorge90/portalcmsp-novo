<section class="explore-conteudos">
    <div class="container">
        <h2 class="desktop-headeline-4">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/conteudos.svg"
                 alt="explore nossos conteúdos">
            Explore nossos conteúdos
        </h2>
        <div class="flex-expore g-32 owl-carousel owl-theme">
            <?php
            $conteudos = get_field("conteudos", $postId);
            foreach ($conteudos as $conteudo) :
                ?>
                <a class="col colEvent"
                   href="<?php echo $conteudo['url'] ?>"" aria-label="<?php echo $conteudo['titulo'] ?>" <?php if ($conteudo['nova_aba']) echo 'target="_blank"' ?>>
                <img src="<?php echo $conteudo['icone'] ?>"
                     alt="<?php echo $conteudo['titulo'] ?>">
                <h3 class="desktop-headeline-5">
                    <?php echo $conteudo['titulo'] ?>
                </h3>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>