<?php
/*
 Template Name: Faq
*/
get_header();

if (have_posts()) : while (have_posts()) :
    the_post();
    $id = get_the_ID();
    $post_type = "page";
    include 'parts/estrutura-hierarquica.php';
endwhile;
endif;
?>
    <script>
        jQuery(".expandir-todos").addClass("act");
        jQuery(".header-accordion").addClass("act");
        jQuery(".header-accordion").next().slideDown();
        jQuery(".expandir-todos").html("Recolher todos os itens").removeClass("button-primary").addClass("button-secondary");
    </script>
    </main>
<?php get_footer(); ?>