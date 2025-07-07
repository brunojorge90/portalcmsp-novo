

              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">

                  <h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>

                  <ul class="share-buttons cf">
                    <li class="facebook"><div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div></li>
                    <li class="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="camarasaopaulo" data-dnt="true">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
                    <li class="gplus"><div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div></li>
                    <li class="linkedin"><script type="IN/Share" data-url="http:://lonkplox"></script></li>
                  </ul>

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