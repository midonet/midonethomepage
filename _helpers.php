<?php

/**
 * Global helper functions.
 *
 * client: Midokura SARL
 *
 * @author Amit Talwar <amit@midokura.com>
 * @copyright 2015 midonet.org
 */

if ( ! function_exists('renderVideoChannel')) {

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

}

if ( ! function_exists('renderSlideChannel')) {

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

}
