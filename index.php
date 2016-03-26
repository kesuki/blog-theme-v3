        <?php get_header(); ?>
        <div class="col-xs-12 col-sm-10">
          <div class="row">
            <div class="col-xs-12 col-lg-6">
              <?php $a = 0; ?>
              <?php while ( have_posts() ) : the_post(); ?>
                <?php $a++; ?>
                <?php if ($a%2==0) { ?>
                  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
                    <?php get_template_part( 'content', get_post_format() ); ?>
                  </div>
                <?php } ?>
              <?php endwhile; ?>
            </div><!--/.col-xs-12.col-lg-6-->

            <div class="col-xs-12 col-lg-6">
              <?php $a = 0; ?>
              <?php while ( have_posts() ) : the_post(); ?>
                <?php $a++; ?>
                <?php if ($a%2==1) { ?>
                  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
                    <?php get_template_part( 'content', get_post_format() ); ?>
                  </div>
                <?php } ?>
              <?php endwhile; ?>
            </div><!--/.col-xs-12.col-lg-6-->
          </div><!--/row-->

          <?php  if ( $wp_query->max_num_pages > 1 ) : ?>
            <div class="pagination"><?php pagenavi(); ?></div>
          <?php endif; ?>

        </div><!--/.col-xs-12 col-sm-10-->

        <div class="col-xs-6 col-sm-2 sidebar-offcanvas" id="sidebar">
          <div class="post-top"></div>
          <div class="panel panel-default">
            <div class="panel-heading">文章分类</div>
            <div class="panel-body">
              <?php wp_list_categories('show_count=1&title_li='); ?>
            </div>
          </div>
        </div><!--/.sidebar-offcanvas-->

        <?php get_footer(); ?>
