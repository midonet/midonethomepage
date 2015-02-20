<?php
require_once('_globals.php');
$page=new Page("Midonet TV","View and Learn More about Midonet, Demonstrations, Cold Walkthroughs.");
$page->Queue()->addCSS('video-channel.css');
$page->Queue()->addCSS('jquery-ui-midokura.css');

?>

<? /* page structure start-------------------------------------------------------- */
include '_header.php';
$page->Queue()->addFooterJS('video-player.js');
$page->Queue()->addFooterJS('jquery-ui.js');
 ?>
<? /* page Body Content ---------------------------------------------------------- */ ?>

<section id="video-section">
<div class="vdesc">
<h1>MidoNet TV</h1><div id="video-nav">View: <ul>
<li><a class="scrolltovideo" href="#demo">Demos</a></li>
<li><a class="scrolltovideo" href="#codew">Code Walkthroughs</a></li>
<li><a class="scrolltovideo" href="#education">Education</a></li>
</ul></div>
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
 The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
</div>

<?php     renderVideoChannel('Demonstration Videos','demos',"demo"); ?>
<?php     renderVideoChannel('Code Walkthroughs','code-walkthroughs',"codew"); ?>
<?php     renderVideoChannel('Educational Videos','education',"education"); ?>

<div id="vplayer" ></div>
</section>

<? /* End page Body Content ---------------------------------------------------------- */ ?>

<?include '_footer.php';?>