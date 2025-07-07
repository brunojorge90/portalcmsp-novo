<section class="content-box box-gallery">
  <header class="content-box-top">
    <h2 class="content-box-title icon-photo-camera-red"><a href="<?php bloginfo('url'); ?>/blog/category/camara-fotografica/">Câmara Fotográfica</a></h2>
  </header>
  <style>
  .box-gallery-item img {width:100%;height:318px;}
  </style>
  <div class="box-gallery-list">
<?php
global $post;
$args = array( 'posts_per_page' => 5, 'category_name' => 'camara-fotografica' );
$myposts = get_posts( $args );
foreach ( $myposts as $post ) : 
  setup_postdata( $post ); ?>
    <article class="box-gallery-item <?php if(isset($t) and !$t){ echo "active"; $t="tem"; } ?>">
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
      <p><?php the_title(); ?></p>
    </article>
<?php endforeach;
wp_reset_postdata(); ?>
  </div>

  <ul class="box-gallery-nav">
    <li><a href="#" class="prev">Anterior</a></li>
    <li><a href="#" class="next">Próximo</a></li>
  </ul>

</section><!-- end box-gallery -->