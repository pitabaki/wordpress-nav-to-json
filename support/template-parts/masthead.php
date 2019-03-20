<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQ89NPK"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

  
<header id="masthead" class="site-header solid" role="banner">
  <nav class="navbar navbar-default">
    <div class="container">

      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#site-navigation" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-brand site-branding">
          <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="site-logo" src="/status/wp-content/uploads/sites/19/2018/08/Anaplan_Logo_RGB_blue.svg" alt="Anaplan Logo" /></a>      
        </div><!-- .site-branding -->
      </div>

      <div id="site-navigation" class="collapse navbar-collapse">
        <?php

          if ( has_nav_menu( 'primary' ) ) {
            wp_nav_menu( array(
              'theme_location' => 'primary',
              'menu_id'        => 'primary-menu',
              'container'      => '',
              'menu_class'     => 'nav navbar-nav'
            ) );
          }

        ?>
        <div class="nav navbar-nav navbar-right">
         <!--<a href="#registration-hub18" id="registration-modal" data-toggle="modal" data-modal-size="narrow" class="btn btn-green btn-register animated bounceIn">Register</a>-->
        </div>
      </div><!-- /.navbar-collapse -->

    </div>
  </nav><!-- #navbar -->
</header><!-- #masthead -->
