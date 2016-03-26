        <?php get_header(); ?>
        <div class="posts" itemtype="http://schema.org/Article" itemscope="itemscope">
          <header class="hentry">
            <h1 itemprop="headline">
              <?php if ( is_tag() ) : ?>
                <?php printf( __( '标签: %s' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
              <?php elseif ( is_category() ) : ?>
                <?php printf( __( '分类: %s' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
              <?php else : ?>
                <?php _e( 'Blog Archives' ); ?>
              <?php endif; ?>
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
