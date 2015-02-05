<?php 
/*
Title: Global Php Code and Functions for midonet.org accessible to all pages.
Author: Amit Talwar <amit@midokura.com>
Client: Midokura SARL
Copyright © 2015
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('class.assetqueue.php');
require_once('class.page.php');
require_once('class.videochannel.php');
$page= new Page(); //initialize the page

function renderVideoChannel($title,$channel,$cssID){
	$chan = new VideoChannel($channel);
	if(!$chan->size() > 0) return '';
	print '<div id="'.$cssID.'" class="video-channel-container">';
	print '<div class="video-channel-title">'.$title.'</div>';
	print '<div class="video-channel-contents">';
	foreach($chan->listing() as $video)
	{
	print '<div class="video-item-container"><div class="video-item">';	
	print "<img src='".$video->getThumbURL()."'".' class="video-thumb" width="220" title="'.$video->getTitle().'" data-url="'.$video->getEmbedUrl().'"/>';
	print "</div>";
	print "<div class='video-item-title'>".$video->getTitle()."</div>";
	print '</div>';	
	}
	print ('<div class="clearfix"> </div></div></div>');
}

?>