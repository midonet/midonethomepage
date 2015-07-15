<?php
require_once('_globals.php');

$page->Queue()->addCSS('reset.css');
$page->Queue()->addCSS('http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
$page->Queue()->addCSS('style.css');

$page->Queue()->addFooterJS('http://code.jquery.com/jquery-latest.min.js');
$page->Queue()->addFooterJS('jquery.slides.min.js');
$page->Queue()->addFooterJS('jquery.easing.min.js');
$page->Queue()->addFooterJS('site.js');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MidoNet TV</title>
    <meta name="description" content="View and Learn More about Midonet, Demonstrations, Cold Walkthroughs.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!--[if IE]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="http://j.wovn.io/0" data-wovnio="key=EVJIv"></script>
    <?php
    $page->Queue()->renderCSS();
    $page->Queue()->renderJS();
    ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-56283377-4', 'auto');
      ga('send', 'pageview');
    </script>
  </head>
<body>
<section class="alt-header">
  <div class="wrapper">
    <nav>
      <a href="http://midonet.org">Home</a>
      <a href="http://wiki.midonet.org">Wiki</a>
      <a href="http://docs.midonet.org">Documentation</a>
      <a href="http://midonet.org/#help" class="scrollto">Help</a>
      <a href="http://midonet.org/#quickstart" class="scrollto">Quick Start</a>
      <a href="http://midonet.org/#resources" class="scrollto">Resources</a>
      <a href="midonet-tv.php" class="scrollto">TV</a>
    </nav>
    <h1>MidoNet</h1>
  </div><!--END WRAPPER-->
</section>
