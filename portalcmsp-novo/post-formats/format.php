
              <?php
                /*
                 * This is the default post format.
                 *
                 * So basically this is a regular post. if you don't want to use post formats,
                 * you can just copy ths stuff in here and replace the post format thing in
                 * single.php.
                 *
                 * The other formats are SUPER basic so you can style them as you like.
                 *
                 * Again, If you want to remove post formats, just delete the post-formats
                 * folder and replace the function below with the contents of the "format.php" file.
                */
              ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">

                  <p class="byline vcard">
                    Atualizado em (<time class="updated" datetime="<?php echo get_the_time('Y-m-j'); ?>" pubdate><?php echo get_the_time('d\/m\/Y'); ?> &ndash; <?php echo get_the_time('H\hi'); ?></time>)
                    |
                    <?php the_category(', '); ?>
                  </p>

                  <h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
<!--
                  <ul class="share-buttons cf">
                    <li class="facebook"><div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div></li>
                    <li class="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="camarasaopaulo" data-dnt="true">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
                    <li class="gplus"><div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div></li>
                    <li class="linkedin"><script type="IN/Share" data-url="http:://lonkplox"></script></li>
                  </ul>
-->
                </header> <?php // end article header ?>

                <section class="entry-content cf" itemprop="articleBody">
                  <?php
                    // the content (pretty self explanatory huh)
                    the_content();
                  ?>
                </section> <?php // end article section ?>

                <footer class="article-footer">

                  <a href="#" class="btn btn-left">Voltar</a>

                </footer> <?php // end article footer ?>

                <?php comments_template(); ?>

              </article> <?php // end article ?>