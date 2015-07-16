<?php

/**
 * SlideShare Channel class.
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

class SlideShare
{
    protected $count = 0;
    protected $counter = 0;
    protected $fp;

    public function SlideShare($channel)
    {
        $filename = ROOT_PATH.'/channels/'.$channel.'.sxt';

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

    // Returns an array of videos.
    public function listing()
    {
        $varr = array();

        for ($i = 0; $i < $this->count; $i++) {
            $row = explode("\t", $this->fp[$i]);
            $video = new SlideShow($row[0], $row[1], $row[2], $row[3]);
            $varr[] = $video;
        }

        return $varr;
    }
}
