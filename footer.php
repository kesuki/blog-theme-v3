      </div><!--/row-->
      <div class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
        &copy; 2008–2016 Mak | 
        <a href="https://github.com/kesuki/wordpress-theme">kesuki Theme</a>
        <br>
        <br>
        Powered by 
        <a href="http://wordpress.org/" target="_blank">Wordpress</a>
      </div>

    </div><!--/.container-->

    <?php wp_footer(); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/offcanvas.js"></script>

    <?php if( is_singular() ){ ?>
      <script type="text/javascript">
        jQuery(document).ready(function($){
          $('textarea').keypress(function(e) {if (e.ctrlKey && e.which == 13 || e.which == 10) {$(this).parent().submit()}});
          $('#comments .comment-body').dblclick(function(){var crl=$('#cancel-comment-reply-link');if($(this).next('#respond').length > 0) {crl.click()}else{$(this).find('.comment-reply-link').click();}return false});
        });
      </script>
    <?php } ?>
    <script type="text/javascript">
      jQuery(document).ready(function($){
        if($('.post-content a[rel!=link]:has(img)').length > 0){
          $.getScript("<?php bloginfo('template_url'); ?>/js/slimbox2.min.js");
        };
      });
    </script>
  </body>
</html>
