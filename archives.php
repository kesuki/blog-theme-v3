        <?php get_header(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
          <div class="post-content" itemprop="articleBody">
            <div id="archives">
              <?php
              $previous_year = $year = 0;
              #$previous_month = $month = 0;
              $ul_open = false;

              $myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');

              foreach($myposts as $post) :
                setup_postdata($post);

                $year = mysql2date('Y', $post->post_date);
                #$month = mysql2date('n', $post->post_date);
                #$day = mysql2date('j', $post->post_date);

                #if($year != $previous_year || $month != $previous_month) :
                if($year != $previous_year) :
                  if($ul_open == true) : 
                    echo '</ul>';
                    echo '</div>';
                    echo '<div class="clear"></div>';
                  endif;

                  echo '<div class="col-sm-2">';
                  echo '<h3 class="al_year">'; echo the_time('Y 年'); echo '</h3>';
                  echo '</div>';
                  echo '<div class="col-sm-10">';
                  echo '<ul class="al_mon_list">';
                  $ul_open = true;

                endif;

                $previous_year = $year;
                #$previous_month = $month;
              ?>
              <?php
                if (get_post_format()==false) :
              ?>
              <li>
                <div class="col-sm-2">
                <span class="archive-time"><?php the_time('m月d日'); ?></span>
                </div>
                <div class="col-sm-10">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <span class="archive-data"><?php if(function_exists('the_views')) the_views(); ?></span>
                </div>
              </li>
              <?php
                endif;
              ?>
              <?php endforeach; ?>
              </ul>					
            </div>
          </div>
        </div>
        <?php get_footer(); ?>
