<?php /*
 Template Name: Como chegar
*/
get_header();

if (have_posts()) : while (have_posts()) :
    the_post();
    ?>
    <section class="endereco-camara">
        <div class="container">
            <div class="desktop-body-3">
                <div class="breadcrumbs cf">
                    <?php if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<p class="wrap cf">', '</p>');
                    } ?>
                </div>
                <h1 class="desktop-headeline-2 mt-44">Endereço da Câmara</h1>
                <div class="header-endereco-camara" style="gap:26px">
                    <div class="infos-esq">
                        <h2 class="desktop-headeline-4 mt-12">Como chegar no Palácio Anchieta, no viadulto Jacareí.</h2>
                        <p class="desktop-body-1 mt-32">Câmara Municipal de São Paulo - Palácio Anchieta, Viaduto Jacareí, 100 - Bela Vista, São Paulo - SP, 01319-900</p>
                    </div>
                    <div class="infos-contato">
                        <h3 class="desktop-headeline-4">Contato:</h3>
                        <ul>
                            <li class="mt-16">
                                <img src="<?php echo get_template_directory_uri()?>/dist/images/Phone.svg" alt="telefone">
                                <strong>Telefone:</strong> (11) 3396-4000
                            </li>
                            <li class="mt-8">
                                <div>
                                    <strong>Endereço:</strong> Viaduto Jacareí, 100 - Bela Vista, São Paulo - SP,
                                    01319-900
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-32 maps-camara">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.5036360836298!2d-46.641031987933346!3d-23.55034872802745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce59ad4e919fa1%3A0x8b4970d9095ec081!2sC%C3%A2mara%20Municipal%20de%20S%C3%A3o%20Paulo%20-%20Pal%C3%A1cio%20Anchieta!5e0!3m2!1spt-BR!2sbr!4v1705626510336!5m2!1spt-BR!2sbr"
                            width="100%" height="635" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
    <style>
    	@media (max-width:768px) {
        	.header-endereco-camara {
            	flex-direction:column;
            }
        }
    </style>
<?php
endwhile;
endif;
get_footer(); ?>