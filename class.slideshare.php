<?php
/*
Title: SlideShare  Channel class
Description: Provides base for maintaining Slideshare Slides
			Uses a Tab delimited  text file in channels directory with a text file with extension .sxt for each channel in the format
			ID(slide id),Title[title to slide],thumbnail Url,Link (direct link to slide)
Author: Amit Talwar <amit@midokura.com>
Client: Midokura SARL
Copyright © 2015

*/

class SlideShare {
	protected $count=0;
	protected $counter=0;
	protected $fp;

	function SlideShare($channel){
		$filename = __DIR__.'/channels/'.$channel.'.sxt';

		if (!file_exists ($filename))
		{
			die("Channel " .$channel." Does not exist!!");
		}
		$this->fp=file($filename);
		$this->count = count($this->fp);
	}

	public function size()
	{
		return $this->count;
	}

	public function listing() { //returns an array of videos
		$varr=array();
		for($i=0; $i<$this->count; $i++) {
			$row=explode('	',$this->fp[$i]);
		//	$ft=($row[3]==1)?true:false;
			$video=new SlideShow($row[0],$row[1],$row[2],$row[3]);
			$varr[]= $video;

		}
		return $varr;

	}

}

class SlideShow {
	protected $id='';
	protected $title='';
	protected $thumb='';
	protected $link='';

	protected $featured=false;

	function SlideShow($id,$title,$thumb,$link)	{
		$this->id = $id;
		$this->title=$title;
		$this->thumb = $thumb;
		$this->link = $link;

	}

	function getID()		{
		return $this->id;
	}

	function getTitle()		{
		return $this->title;
	}

	function getDescription() {
		return $this->description;
	}
	function isFeatured() {
		return $this->featured;
	}
	function getPageURL(){
		return $this->link;
	}
	function getThumbUrl() {
		return $this->thumb;
	}

	function getEmbedUrl() {
		return "//www.slideshare.net/slideshow/embed_code/".$this->id;

	}


}

?>
