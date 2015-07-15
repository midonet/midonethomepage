<?php

/**
 * Global PHP Code and Functions for midonet.org accessible to all pages.
 *
 * client: Midokura SARL
 *
 * @author Amit Talwar <amit@midokura.com>
 * @copyright 2015 midonet.org
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'class.assetqueue.php';
require_once 'class.page.php';
require_once 'class.videochannel.php';
require_once 'class.slideshare.php';
$page = new Page; // initialize the page

function renderVideoChannel($title, $channel, $cssID)
{
    $chan = new VideoChannel($channel);

    if ( ! $chan->size() > 0) {
        return '';
    }

    print '<div id="'.$cssID.'" class="video-channel-container">';
    print '<div class="video-channel-title">'.$title.'</div>';
    print '<div class="video-channel-contents">';

    foreach ($chan->listing() as $video) {
        print '<div class="video-item-container">';
        print '<div class="video-item">';
        print '<img src="'.$video->getThumbURL().'" class="video-thumb" width="220" title="'.$video->getTitle().'" data-url="'.$video->getEmbedUrl().'">';
        print '</div>';
        print '<div class="video-item-title">'.$video->getTitle().'</div>';
        print '</div>';
    }

    print ('<div class="clearfix"></div>');
    print '</div>';
    print '</div>';
}

function renderSlideChannel($title, $channel, $cssID)
{
    $chan = new SlideShare($channel);

    if ( ! $chan->size() > 0) {
        return '';
    }

    print '<div id="'.$cssID.'" class="video-channel-container">';
    print '<div class="video-channel-title">'.$title.'</div>';
    print '<div class="video-channel-contents">';

    foreach($chan->listing() as $video) {
        print '<div class="video-item-container"><div class="video-item">';
        print '<img src="'.$video->getThumbURL().'" class="video-thumb" width="220" title="'.$video->getTitle().'" data-url="'.$video->getEmbedUrl().'">';
        print "</div>";
        print "<div class='video-item-title'>".$video->getTitle()."</div>";
        print '</div>';
    }

    print ('<div class="clearfix"></div>');
    print '</div>';
    print '</div>';
}
