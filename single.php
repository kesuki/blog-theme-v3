        <?php get_header(); ?>
        <div class="posts" itemtype="http://schema.org/Article" itemscope="itemscope">
          <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', get_post_format() ); ?>
          <?php endwhile; ?>
        
          <?php comments_template(); ?>
        </div>
        <?php get_footer(); ?>
