<!DOCTYPE html>
<html itemscope="itemscope" itemtype="http://schema.org/WebPage">
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title itemprop="name"><?php global $page, $paged;wp_title( '|', true, 'right' );bloginfo( 'name' );$site_description = get_bloginfo( 'description', 'display' );if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( '第 %s 页'), max( $paged, $page ) );?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.min.js"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
    <![endif]-->

    <?php wp_head(); ?>
  </head>

  <body>
    <nav class="navbar navbar-fixed-top navbar-default" itemscope itemtype="http://schema.org/SiteNavigationElement">
      <div class="container">
        <div class="navbar-header">
          <?php if( is_home() ){ ?>
          <button type="button" class="toggle-nav visible-xs" data-toggle="offcanvas" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
          </button>
          <?php } ?>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php bloginfo('url'); ?>">Home</a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
          <?php
            wp_nav_menu(array(
              'container'=>'ul',
              'menu_class'=>'nav navbar-nav',
            ));
          ?>
          <form method="get" class="navbar-form navbar-left" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
              <input name="s" id="s" type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">
      <div class="row row-offcanvas row-offcanvas-right">
