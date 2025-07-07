<?php
/*
 Template Name: Auditórios Online
*/
date_default_timezone_set("America/Sao_Paulo");
?>

<?php get_header(); ?>

<div id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="breadcrumbs cf">
            <?php if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb('<p class="wrap cf">','</p>');
            } ?>
        </div>

        <div class="section-title">
            <h1 class="wrap icon-clock-large-red"><?php the_title();?></h1>
        </div>

        <div id="inner-content" class="wrap cf">

            <div id="main" class="cf" role="main">

                <article id="post-<?php the_ID();?>" <?php post_class('cf');?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                    <section class="entry-content cf" aria-label="Teste">
                        <?php the_content(); ?>
                    </section>
                    <header class="article-header">
                        <h2 class="page-title" itemprop="headline">Próximos Eventos</h2>
                    </header> <?php // end article header ?>

                    <section class="entry-content cf" itemprop="articleBody">
                        <div class="agenda-events-list" data-when="today">
                            <article>
                                <?php
                                $args = array(
                                    'posts_per_page'	=> -1,
                                    'post_type'			=> 'agenda_cerimonial',
                                    'meta_key'			=> 'data',
                                    'meta_query'		=> array(
                                        array(
                                            'key' 		=> 'data'
                                        ),
                                    )
                                );

								if(!function_exists("customorderby")) {
									function customorderby($orderby) {
										return 'mt1.meta_value ASC';
									}
								}

                                add_filter('posts_orderby','customorderby');
                                $the_query = new WP_Query( $args );
                                remove_filter('posts_orderby','customorderby');

								$tem=0;

                                if ( $the_query->have_posts()  ):
                                $data='';
                                $i=0;
                                while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                $datah = get_field('data');
                                $dataa = date("YmdHi");

                                //Listar eventos
                                while (have_rows("eventos-listagem")) : the_row();
                                $descricao = array_values(get_sub_field("local_campos"))[0];
                                $horario = array_values(get_sub_field("horario"))[0];

                                $hora = $horario['horario_inicio'];

                                if ($horario['horario_fim']){
                                    $hora = $horario['horario_fim'];
                                }

                                $datac = $datah . $hora;

                                if ($datac > $dataa){
                                $value = $descricao['local'];
                                $label = '';
                                while (have_rows("local_campos")) : the_row();
                                    $field = get_sub_field_object('local');
                                    $label = $field['choices'][ $value ];
                                endwhile;

                                //https://developer.wordpress.org/reference/functions/get_permalink/
                                //Return (string|false) The permalink URL or false if post does not exist.
                                //String diferente de uma string vazia e a string "0" é TRUE
                                //https://www.php.net/manual/pt_BR/language.types.boolean.php
                                if (get_permalink($value)) {
                                    $local = '<a href="'.get_permalink($value).'">'.$label.'</a>';
                                } else {
                                    $local = $label;
                                }
                                if ($data != $datah) {
                                if ($i > 0) {
                                    ?>
                                    </tbody>
                                    </table>
                                <?php } ?>
                                <h2>
                                    <?php echo substr(get_field('data'), 6,2)."/".substr(get_field('data'), 4,2)."/".substr(get_field('data'), 0,4); ?>
                                </h2>
                                <table class="events-table">
                                    <thead>
                                    <tr>
                                        <th class="time">Horário</th>
                                        <th class="event" style="width:300px">Evento</th>
                                        <th class="location" style="width:200px">Local</th>
                                        <th class="vereador" style="width:200px">Vereador</th>
                                        <th class="party" style="width:150px">Partido</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php } ?>
                                    <tr class="agenda-event">
                                        <td class="time">
                                            <?php echo $horario['horario_inicio']; ?><?php if ($horario['horario_fim']) {
                                                echo " - ". $horario['horario_fim'];
                                            }?>
                                        </td>
                                        <td class="event">
                                            <?php echo $descricao['titulo']; ?>
                                        </td>
                                        <td class="location"><!-- local -->
                                            <?php echo $local; ?>
                                            <?php if($descricao['local_txt']) { echo "<p style='margin:0;'>".$descricao['local_txt']."</p>"; } ?>
                                        </td>
                                        <td class="vereador">
                                            <?php

                                            $vereador_id = "";
                                            $vereadores_id = array();

                                            while (have_rows("solicitante_campos")) : the_row();
                                                $vereadores= get_sub_field('sol_vereador');
                                                if( $vereadores ): ?>
                                                    <?php foreach( $vereadores as $v ): ?>
                                                        <?php array_push($vereadores_id, $vereador_id = $v->ID);?>
                                                        <a href="<?php echo get_permalink($v->ID); ?>" style="display:block;">
                                                            <?php echo get_the_title($v->ID); ?>
                                                        </a>
                                                    <?php endforeach;
                                                endif;

                                                if(get_sub_field('sol_txt')) {
                                                    echo "<p style='margin:0;'>".get_sub_field('sol_txt')."</p>";
                                                }

                                                if(get_sub_field_object('sol_depto')){
                                                    $field = get_sub_field_object('sol_depto');
                                                    $sol_depto = get_sub_field('sol_depto');
                                                    $choices_soldepto = array();
                                                    if(!(empty($sol_depto) OR empty($field))){
                                                        $choices_soldepto = $field['choices'][get_sub_field('sol_depto')];
                                                    }
                                                    $label = !empty($choices_soldepto) ? $choices_soldepto : null;

                                                    if($label)
                                                    echo "<p style='margin:0;'>".$label."</p>";
                                                }
                                                ?>
                                            <?php
                                            endwhile;
                                            ?>

                                        </td>
                                        <td class="party">
                                            <?php
                                            if($vereadores_id){

                                                $v_args = array(
                                                    'post_type' => 'vereador',
                                                    'post__in' => $vereadores_id
                                                );
                                                $v_posts = get_posts($v_args);
                                                $array_partidos = array();
                                                foreach( $v_posts as $p ){
                                                    array_push($array_partidos,  get_field("_cmsp_vereador_party",$p->ID));
                                                }
                                                asort($array_partidos);
                                                $unique_partidos = array_unique($array_partidos);

                                                $posts = array();
                                                foreach( $unique_partidos as $partido ){

                                                    $p_args = array(
                                                        'title' => $partido,
                                                        'post_type' => 'partidos',
                                                        'post_status' => 'publish',
                                                        'posts_per_page' => -1
                                                    );

                                                    //echo "<!-- p_args = " . json_encode($p_args) . "-->";// t3ste

                                                    $posts_partial = get_posts($p_args);
                                                    foreach( $posts_partial as $pst ){
                                                        array_push($posts, $pst);
                                                    }
                                                    //echo "<!-- get_posts = " . json_encode($posts) . "-->";// t3ste

                                                }
                                                //echo "<!-- $posts = " . json_encode($posts) . "-->";// t3ste

                                                if( $posts ):
                                                    foreach( $posts as $p ):
                                                        $logo = get_field("logo_grande",$p->ID);

                                                        //echo "<!-- logo = " . $logo . "-->";// t3ste

                                                        if(!empty($logo)){
                                                            ?>
                                                            <img src="<?php echo $logo['url']; ?>" width="40"
                                                                 title="<?php echo get_the_title($p->ID); ?>" style="margin:0" />
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p><?php echo get_the_title($p->ID); ?></p>
                                                            <?php
                                                        }
                                                    endforeach;
                                                endif;

                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php $tem=1;
                                    $data = $datah;
                                    $i++;
                                    }
                                    endwhile;
                                    }
                                    endif;
                                    if(!$tem) {
                                        echo "<table><tbody><h2>Não há eventos programados</h2>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </article>
                        </div>
                    </section>

                    <footer class="article-footer cf">
                        <?php
                        $page_downloads = get_post_meta($post->ID, '_cmsp_page_download-files', true);
                        if(isset($page_downloads[0]['title'])):
                            ?>
                            <section class="content-box box-downloads">
                                <header class="content-box-top box-downloads-header">
                                    <h2 class="content-box-title icon-archives-red">Downloads</h2>
                                </header>
                                <ul class="box-downloads-list">
                                    <?php
                                    foreach($page_downloads as $file):
                                        $blank = false;
                                        if(isset($file['blank'])){
                                            if($file['blank'] == 'on') $blank = true;
                                        }
                                        ?>
                                        <li>
                                            <a <?php if($blank) echo 'target="_blank" '; ?> href="<?php echo $file['file']; ?>">
                                                <?php echo $file['title']; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </section>
                        <?php endif;?>
                    </footer>

                </article>

            </div>
        </div>

    <?php endwhile; endif;?>
</div>

<?php get_footer();?>