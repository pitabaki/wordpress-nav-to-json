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

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="icon" type="image/png" href="/favicon.png" />
<link rel="stylesheet" type="text/css" href="https://cloud.typography.com/7167176/6983772/css/fonts.css" />
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
<script type="text/javascript" src="/wp-content/themes/anaplan-hub17/js/update_reg_links.js"></script>
</head>

<body <?php global $post; body_class( 'anaplan slug-' . get_post( $post )->post_name ); ?>>
