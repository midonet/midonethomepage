<?php
require_once('_globals.php');

$page = new Page('Midonet TV', 'View and Learn More about Midonet, Demonstrations, Cold Walkthroughs.');
$page->Queue()->addCSS('video-channel.css');
$page->Queue()->addCSS('jquery-ui-midokura.css');

/* Start Page Structure ----------------------------------------------------------- */
include '_header.php';
$page->Queue()->addFooterJS('video-player.js');
$page->Queue()->addFooterJS('jquery-ui.js');

/* Start Page Body Content -------------------------------------------------------- */
?>
<section id="video-section">
  <div class="vdesc">
    <h1>MidoNet TV</h1>
    <div id="video-nav">
      View:
      <ul>
        <li><a class="scrolltovideo" href="#demo">Demos</a></li>
        <li><a class="scrolltovideo" href="#codew">Code Walkthroughs</a></li>
        <li><a class="scrolltovideo" href="#education">Education</a></li>
      </ul>
    </div>
    <h2 class="medium lighter">Watch and Learn from MidoNet Committers</h2>
    <br>
    If you have a video you want to share with the rest of the MidoNet community,
    <br>
    <em>join MidoNet on Slack and ping</em> <span class="darker">@adjohn</span> or <span class="darker">@susanwu</span>
  </div>

  <?php renderVideoChannel('Demonstration Videos', 'demos', 'demo'); ?>
  <?php renderVideoChannel('Code Walkthroughs', 'code-walkthroughs', 'codew'); ?>
  <?php renderSlideChannel('Educational Slides', 'education', 'education'); ?>

  <div id="vplayer"></div>
</section>
<?php
/* End Page Body Content ---------------------------------------------------------- */

include '_footer.php';
