  
<input id="refreshed" data-value="no" style="display:none;">
<?php

  $check = get_site_url();

  if ( strpos($check, '/ru/') !== false ) {
    echo '<div id="copyright"><div class="container"><div class="row"><div class="col-md-12 text-right site-info">Центр Digital October • Берсеневская набережная 6, стр. 3 • Москва, 119072 | <a href="mailto:info.russia@anaplan.com">info.russia@anaplan.com</a> | <a href="/ru/privacy-policy">Политика конфиденциальности компании</a></div></div></div></div>';
    return false;
  }

?>

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
      <div class="col-md-12 site-info">
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
        <span class="sep"> | </span>

      <?php

        switch($check)
        {
          case strpos($check, '/ru/') !== false:
            echo '<a href="https://www.anaplan.com/ru/privacy-policy/">Privacy policy</a>';
            break;
          case strpos($check, '/de/') !== false:
            echo '<a href="https://www.anaplan.com/de/privacy-policy/">Privacy policy</a>';
            break;
          case strpos($check, '/jp/') !== false:
            echo '<a href="https://www.anaplan.com/jp/privacy-policy/">Privacy policy</a>';
            break;
          case strpos($check, '/fr/') !== false:
            echo '<a href="https://www.anaplan.com/fr/privacy-policy/">Privacy policy</a>';
            break;
          default:
            echo '<a href="https://www.anaplan.com/privacy-policy/">Privacy policy</a>';
            break;
        }

      ?>
      <span class="sep"> | </span>
        <a href="https://www.anaplan.com/cookie-policy/"><?php _ex( 'Cookie policy', 'Footer', 'anaplan' ); ?></a>
        <span class="sep"> | </span>
        <a href="https://www.anaplan.com/terms-of-use/"><?php _ex( 'Terms of service', 'Footer', 'anaplan' ); ?></a>
      </div>
    </div>
  </div>
</div>
<script>
  jQuery(document).ready(function($){
    var addSubMenuSpan = function ( current ) {
      var currentSelection = current.html();
      $(" <span class='fa fa-chevron-down'></span>").appendTo(current.eq(0));
      console.log(currentSelection);
      //current.eq(0).html(currentSelection + " <span class='fa fa-chevron-down'></span>");
    };
    var getCurrentImgAlt = function ( elem ) {
      var currentImgAlt = elem.find("a").text();
      return currentImgAlt;
    };
    var getCurrentImgSrc = function ( elem ) {
      var currentImgSrc = elem.find("a").attr("href");
      return currentImgSrc;
    };
    var createImgMarkup = function ( elem ) {
      var imgAlt = getCurrentImgAlt(elem);
      var imgSrc = getCurrentImgSrc(elem);
      var newImg = document.createElement("img");
      newImg.alt = imgAlt;
      newImg.src = imgSrc;
      elem.html(newImg);
    };
    var loopFunction = function ( elem, num, func ) {
      if ( num < elem.length ) {
        func( elem.eq(num), num );
        num++;
        loopFunction(elem, num, func);
      }
    };
    loopFunction($('.submenu-img'), 0, createImgMarkup);
    loopFunction($('.sub-menu-dropdown'), 0, addSubMenuSpan);
    $(".sub-menu-remove-click>a").click(function(e){
      e.preventDefault();
      return false;
    });
  });
</script>