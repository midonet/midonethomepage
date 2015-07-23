<?php
/**
 * Video class.
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

class Video
{
    protected $id = '';
    protected $title = '';
    protected $description = '';
    protected $featured = false;

    public function Video($id, $title, $description, $featured = false)
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
        return 'https://img.youtube.com/vi/'.$this->id.'/mqdefault.jpg';
    }

    public function getEmbedUrl()
    {
        return 'https://www.youtube.com/embed/'.$this->id;
    }
}
