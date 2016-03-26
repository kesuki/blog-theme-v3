        <?php get_header(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
          <?php while ( have_posts() ) : the_post(); ?>
            <div class="post-top"></div>
            <div class="post-body">
              <div class="post-metadata">
                <div class="metadata-byline">
                  <div class="metadata-byline-title" itemprop="name headline">
                    <?php the_title(); ?>
                  </div>
                </div>
              </div>
              <div class="post-content" itemprop="articleBody">
                <?php the_content(''); ?>
              </div>
            </div>
          <?php endwhile; ?>
          <?php comments_template(); ?>
        </div>
        <?php get_footer(); ?>
