<?php
/*
Template Name: organograma
*/
get_header();

if (have_posts()) : while (have_posts()) :
    the_post();
?>
    <section class="organograma">
        <div class="container">
            <div class="desktop-body-3">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>/</li>
                    <li><strong>Organograma</strong></li>
                </ul>

                <h1 class="desktop-headeline-2 mt-44">Organograma da Câmara</h1>
                <h2 class="desktop-headeline-4 mt-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dictum tristique urna a pellentesque.</h2>
                <p class="desktop-body-1 mt-32">Donec porta erat lorem, vel aliquet ligula mattis varius. Pellentesque sollicitudin ac nibh interdum vulputate. Pellentesque lectus dolor, eleifend vitae cursus sit amet, cursus nec tortor. Fusce iaculis, nulla a malesuada tristique, tellus justo lobortis nulla, id ultricies arcu sem dapibus lectus.</p>

                <div class="busca mt-48">
                    <img src="<?php echo get_template_directory_uri()?>/dist/images/icon-busca.svg" alt="busca">
                    <input type="search" name="busca-organograma" id="busca-organograma" class="field-style" placeholder="Digite o que procura e clique em buscar...">
                    <button class="button-primary">Buscar</button>
                </div>

                <!--cards nivel01-->
                <div class="organograma-nivel01 mt-32">
                    <div class="card-nivel01">
                        <div class="img-servicos w100">
                            <img src="<?php echo get_template_directory_uri()?>/dist/images/corregedoria.svg" alt="imagem">
                        </div>

                        <div class="infos-servicos mt-16">
                            <h4 class="desktop-headeline-5">Corregedoria da CMSP</h4>

                            <p class="desktop-body-3">Fusce iaculis, nulla a malesuada tristique, tellus justo lobortis nulla.</p>
                        </div>

                        <a href="#" class="button-secondary button-size-sm disabled-link w100">
                            Acessar
                            <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </a>
                    </div>

                    <div class="card-nivel01">
                        <div class="img-servicos w100">
                            <img src="<?php echo get_template_directory_uri()?>/dist/images/gabinete-vereadores.svg" alt="imagem">
                        </div>

                        <div class="infos-servicos mt-16">
                            <h4 class="desktop-headeline-5">Gabinete de vereadores</h4>

                            <p class="desktop-body-3">Fusce iaculis, nulla a malesuada tristique, tellus justo lobortis nulla.</p>
                        </div>

                        <a href="#" class="button-secondary button-size-sm disabled-link w100">
                            Acessar
                            <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </a>
                    </div>

                    <div class="card-nivel01">
                        <div class="img-servicos w100">
                            <img src="<?php echo get_template_directory_uri()?>/dist/images/mesa-diretora.svg" alt="imagem">
                        </div>

                        <div class="infos-servicos mt-16">
                            <h4 class="desktop-headeline-5">Mesa Diretora</h4>

                            <p class="desktop-body-3">Fusce iaculis, nulla a malesuada tristique, tellus justo lobortis nulla.</p>
                        </div>

                        <a href="#" class="button-secondary button-size-sm w100">
                            Acessar
                            <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </a>
                    </div>

                    <div class="card-nivel01">
                        <div class="img-servicos w100">
                            <img src="<?php echo get_template_directory_uri()?>/dist/images/gabinete-presidencia.svg" alt="imagem">
                        </div>

                        <div class="infos-servicos mt-16">
                            <h4 class="desktop-headeline-5">Gabinete da presidência</h4>

                            <p class="desktop-body-3">Fusce iaculis, nulla a malesuada tristique, tellus justo lobortis nulla.</p>
                        </div>

                        <a href="#" class="button-secondary button-size-sm w100">
                            Acessar
                            <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </a>
                    </div>

                    <div class="card-nivel01">
                        <div class="img-servicos w100">
                            <img src="<?php echo get_template_directory_uri()?>/dist/images/gabinete-lideranca.svg" alt="imagem">
                        </div>

                        <div class="infos-servicos mt-16">
                            <h4 class="desktop-headeline-5">Gabinete das lideranças</h4>

                            <p class="desktop-body-3">Fusce iaculis, nulla a malesuada tristique, tellus justo lobortis nulla.</p>
                        </div>

                        <a href="#" class="button-secondary button-size-sm disabled-link w100">
                            Acessar
                            <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9999 9L15.2928 5.70711C15.6834 5.31658 15.6834 4.68342 15.2928 4.29289L11.9999 1M14.9999 5L0.999939 5" stroke="#7F1A22" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <!--cards nivel01-->

            </div>
        </div>
    </section>
<?php
endwhile;
endif;
get_footer(); ?>

