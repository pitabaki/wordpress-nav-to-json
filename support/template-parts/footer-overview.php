<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-3 request-button" style="display: none;">
        <div class="row">
          <?php
          if ( !dynamic_sidebar() ) :
            dynamic_sidebar( 'Footer Demo Button' );
          endif;
          ?>
        </div>
      </div>
      <div class="col-sm-12 col-md-12">
        <div class="row">
          <?php
          if ( !dynamic_sidebar() ) :
            dynamic_sidebar( 'Footer Links' );
          endif;
          ?>
        </div>
      </div>
    </div>
  </div>
</footer>

<div id="copyright" class="site-copyright" role="contentinfo">
  <div class="container">
    <div class="row">
      <div class="col-md-6 site-info site-info--left">
        <?php 
          date_default_timezone_set('UTC');
          $thisYear = date('Y', time());
          if (strlen($thisYear) > 0) {
            $concatString = '© ' . $thisYear . ' Anaplan, Inc. All rights reserved.';
            _ex( $concatString , 'Footer', 'anaplan' );
          } else {
            _ex( '© 2017 Anaplan, Inc. All rights reserved.', 'Footer', 'anaplan' );
          };
        ?>
      </div>
      <div class="col-md-6 site-info site-info--right">
        <a href="https://www.anaplan.com/privacy-policy/">Privacy policy</a>
        <span class="sep"> | </span>
        <a href="https://www.anaplan.com/cookie-policy/"><?php _ex( 'Cookie policy', 'Footer', 'anaplan' ); ?></a>
        <span class="sep"> | </span>
        <a href="https://www.anaplan.com/terms-of-use/"><?php _ex( 'Terms of service', 'Footer', 'anaplan' ); ?></a>
      </div>
    </div>
  </div>
</div>
