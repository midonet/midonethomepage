<?php
/*
Title: Video Channel class and video class
Description: Provides base for maintaining youtube videos.
			Uses a Tab delimited  text file in channels directory with a text file for each channel in the format
			ID(youtube video id),Title[title to video],Description[Any description for video, please remove line breaks],Featured[1 or 0, reeserved for future use]
Author: Amit Talwar <amit@midokura.com>
Client: Midokura SARL
Copyright © 2015

*/

class VideoChannel {
	protected $count=0;
	protected $counter=0;
	protected $fp;

	function VideoChannel($channel){
		$filename = __DIR__.'/channels/'.$channel.'.txt';

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
			$ft=($row[3]==1)?true:false;
			$video=new Video($row[0],$row[1],$row[2],$ft);
			$varr[]= $video;

		}
		return $varr;

	}

}

class Video {
	protected $id='';
	protected $title='';
	protected $description='';
	protected $featured=false;

	function Video($id,$title,$description,$featured=false)	{
		$this->id = $id;
		$this->title=$title;
		$this->description = $description;
		$this->featured = $featured;

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
	function getYouTubeURL(){
		return "https://www.youtube.com/watch?v=".$this->id;
	}
	function getThumbUrl() {
		return "http://img.youtube.com/vi/".$this->id."/mqdefault.jpg";
	}

	function getEmbedUrl() {
		return "https://www.youtube.com/embed/".$this->id;

	}






}

?>
