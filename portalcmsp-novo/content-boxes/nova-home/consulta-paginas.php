<section class="consulta-paginas" aria-label="Consulta páginas">
    <div class="container">
        <div class="flex flex-col g-32">
            <div class="col">
                <?php include get_template_directory().'/content-boxes/geral/consulta-rapida.php'?>
            </div>
            <div class="col">
                <h2 class="desktop-headeline-4">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/paginas.svg"
                         alt="Páginas mais visitadas">
                    Páginas mais visitadas
                </h2>
                <div class="paginas border-r-w p-t24-h16">
                    <?php

                    $pages = get_posts([
                            'post_type' => 'page',
                            'numberposts' => 5,
                            'meta_key' => 'post_view',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'post__not_in' => [$postId]
                        ]
                    );

                    foreach ($pages as $page) :
                        ?>
                        <a class="col" href="<?php echo get_permalink($page->ID)?>">
                            <h3 class="desktop-headeline-5">
                                <?php echo $page->post_title?>
                            </h3>
                            <span class="flex g-13 align-center">
                            Acessar página
                            <svg width="17" height="10" viewBox="0 0 17 10" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5"
                                      stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>


</section>