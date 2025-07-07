<?php
/*
 Template Name: Home Câmara Nova
*/

//Save the template name so it's obtainable in the header
?>
<!-- home-v2:conteudo -->
<?php get_header();
$postId = get_the_ID();

if (have_posts()) : while (have_posts()) :
the_post();
$id = get_the_ID();
?>

<section class="">
	<!-- home-v2:destaque-principal -->
    <?php
        $tema = get_field('tema');
        include get_template_directory() . '/new-theme/blocos/home/destaques/destaques.php';
    ?>
</section>


<?php
    set_query_var( 'postId', $postId );

    //Próximos eventos
    get_template_part('content-boxes/nova-home/proximos', 'eventos');

    //Próximos eventos
    get_template_part('content-boxes/nova-home/explore', 'conteudos');

    //Noticias
    get_template_part('content-boxes/nova-home/box', 'noticias');

    //Consulta Rápida
    get_template_part('content-boxes/nova-home/consulta', 'paginas');

    //Programas
    get_template_part('content-boxes/nova-home/box', 'programas');

    get_template_part('content-boxes/nova-home/rede', 'camara');

endwhile;
endif;
?>
<?php get_footer(); ?>