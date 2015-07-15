<?php
/**
 * Video Channel class and video class.
 *
 * Provides base for maintaining youtube videos. Uses a Tab delimited text file
 * in channels directory with a text file for each channel in the format
 * ID (youtube video id), Title (title to video), Description (Any description
 * for video, please remove line breaks), Featured (1 or 0, reeserved for future
 * use).
 *
 * Client: Midokura SARL
 *
 * @author Amit Talwar <amit@midokura.com>
 * @copyright 2015 midonet.org
 */

class VideoChannel
{
    protected $count = 0;
    protected $counter = 0;
    protected $fp;

    public function VideoChannel($channel)
    {
        $filename = __DIR__.'/channels/'.$channel.'.txt';

        if ( ! file_exists ($filename)) {
            die('Channel ' .$channel.' Does not exist!!');
        }

        $this->fp = file($filename);
        $this->count = count($this->fp);
    }

    public function size()
    {
        return $this->count;
    }

    // Returns an array of videos
    public function listing()
    {
        $varr = array();

        for ($i = 0; $i < $this->count; $i++) {
            $row = explode("\t", $this->fp[$i]);
            $ft = ($row[3] == 1) ? true : false;
            $video = new Video($row[0], $row[1], $row[2], $ft);
            $varr[] = $video;
        }

        return $varr;
    }
}

class Video
{
    protected $id = '';
    protected $title = '';
    protected $description = '';
    protected $featured = false;

    public function Video($id, $title, $description, $featured = fals
        )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->featured = $featured;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function isFeatured()
    {
        return $this->featured;
    }

    public function getYouTubeURL()
    {
        return 'https://www.youtube.com/watch?v='.$this->id;
    }

    public function getThumbUrl()
    {
        return 'http://img.youtube.com/vi/'.$this->id.'/mqdefault.jpg';
    }

    public function getEmbedUrl()
    {
        return 'https://www.youtube.com/embed/'.$this->id;
    }
}
