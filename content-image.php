              <div class="post-top"></div>
              <div class="post-body">
                <div class="post-metadata">
                  <a class="metadata-img" rel="link" href="<?php the_permalink() ?>"><?php echo get_avatar($post->post_author, 36); ?></a>
                  <div class="metadata-byline">
                    <div class="metadata-byline-title" itemprop="name headline">
                      <?php if( is_single() ):?>
                        <?php the_title(); ?>
                      <?php else: ?>
                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a>
                      <?php endif ;?>
                    </div>
                    <div class="update-time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" pubdate>
                      <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                      <?php the_time(' j  F,  Y'); ?>
                    </div>
                  </div>
                </div>
                <div class="post-content" itemprop="articleBody"><?php the_content(''); ?></div>
              </div>
