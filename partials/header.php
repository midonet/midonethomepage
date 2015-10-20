<?php
$page->Queue()->addCSS('/css/reset.css');
$page->Queue()->addCSS('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
$page->Queue()->addCSS('/css/style.css');

$page->Queue()->addFooterJS('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
$page->Queue()->addFooterJS('/js/jquery.slides.min.js');
$page->Queue()->addFooterJS('/js/jquery.easing.min.js');
$page->Queue()->addFooterJS('/js/site.js');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MidoNet TV</title>
    <meta name="description" content="View and Learn More about Midonet, Demonstrations, Cold Walkthroughs.">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!--[if IE]>
      <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="https://j.wovn.io/0" data-wovnio="key=EVJIv"></script>
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
      <a href="https://www.midonet.org">Home</a>
      <a href="https://github.com/midonet/midonet/wiki">Wiki</a>
      <a href="https://docs.midonet.org">Documentation</a>
      <a href="https://www.midonet.org/#help" class="scrollto">Help</a>
      <a href="https://www.midonet.org/#quickstart" class="scrollto">Quick Start</a>
      <a href="https://www.midonet.org/#resources" class="scrollto">Resources</a>
      <a href="/midonet-tv" class="scrollto">TV</a>
    </nav>
    <h1>MidoNet</h1>
  </div><!--END WRAPPER-->
</section>
