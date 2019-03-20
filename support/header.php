<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Anaplan
 */
//include_once('support/additional_metadata.php');
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NQ89NPK');</script>
<!-- End Google Tag Manager -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="icon" type="image/png" href="/favicon.png" />
<meta property="article:published_time" content="<?php echo get_the_date('c'); ?>" />
<meta property="article:modified_time" content="<?php the_modified_date('c'); ?>" />
<?php
//additional_lob_meta();
?>
<script type="text/javascript">
	if (location.hash) {
      setTimeout(function() {
        window.scrollTo(0, 0);
      }, 1);
    }
</script>


<!--
/****************************************/

Welcome to Anaplan

/****************************************/
-->

<?php 
wp_head();
?>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body <?php global $post; body_class( 'anaplan slug-' . get_post( $post )->post_name ); ?>>
