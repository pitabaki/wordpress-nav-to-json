<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12" id="site-footer">
        <div class="row">
          <?php
          if ( !dynamic_sidebar() ) :
            dynamic_sidebar( 'Footer Links' );
          endif;
          ?>
        </div>
      </div>
      <div class="col-sm-12 col-md-12">
        <div class="footer-social">
          <h3>Social</h3>
          <ul class="footer-social-wrap">
            <li>
              <a class="footer-social-icon" href="http://www.linkedin.com/company/658814" target="_blank">
                <span class="footer-social-screen-only">Linkedin</span><i class="fa fa-linkedin"></i>
              </a>
            </li>
            <li>
              <a class="footer-social-icon" href="https://www.facebook.com/anaplan" target="_blank">
                <span class="footer-social-screen-only">Facebook</span> <i class="fa fa-facebook"></i>
              </a>
            </li>
            <li>
            <a class="footer-social-icon" href="http://www.twitter.com/anaplan" target="_blank">
              <span class="footer-social-screen-only">Twitter</span><i class="fa fa-twitter"></i>
            </a>
            </li>
            <li>
            <a class="footer-social-icon" href="https://plus.google.com/+AnaplanInc/" target="_blank">
              <span class="footer-social-screen-only">Google-plus</span><i class="fa fa-google-plus"></i>
            </a>
            </li>
            <li>
            <a class="footer-social-icon" href="https://www.instagram.com/anaplanning/" target="_blank">
              <span class="footer-social-screen-only">Instagram</span><i class="fa fa-instagram"></i>
            </a>
            </li>
          </div>
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
