        <?php get_header(); ?>
        <div class="posts" itemtype="http://schema.org/Article" itemscope="itemscope">
          <header>
            <h1 itemprop="headline">
              <?php _e("Search"); ?>: <?php the_search_query(); ?>
	    </h1>
          </header>
          <?php while ( have_posts() ) : the_post(); ?>
            <div <?php post_class(); ?>>
              <?php get_template_part( 'content', get_post_format() ); ?>
            </div>
          <?php endwhile; ?>
        </div>
        <?php  if ( $wp_query->max_num_pages > 1 ) : ?>
          <div class="pagination"><?php pagenavi(); ?></div>
        <?php endif; ?>
        <?php get_footer(); ?>
