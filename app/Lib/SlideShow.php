<?php

/**
 * SlideShow class.
 *
 * Provides base for maintaining Slideshare Slides Uses a Tab delimited text
 * file in channels directory with a text file with extension .sxt for each
 * channel in the format ID (slide id), Title (title to slide), thumbnail Url,
 * Link (direct link to slide).
 *
 * Client: Midokura SARL
 *
 * @author Amit Talwar <amit@midokura.com>
 * @copyright 2015 midonet.org
 */

class SlideShow
{
    protected $id = '';
    protected $title = '';
    protected $thumb = '';
    protected $link = '';
    protected $featured = false;

    public function SlideShow($id, $title, $thumb, $link)
    {
        $this->id = $id;
        $this->title = $title;
        $this->thumb = $thumb;
        $this->link = $link;
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

    public function getPageURL()
    {
        return $this->link;
    }

    public function getThumbUrl()
    {
        return $this->thumb;
    }

    public function getEmbedUrl()
    {
        return '//www.slideshare.net/slideshow/embed_code/'.$this->id;
    }
}
