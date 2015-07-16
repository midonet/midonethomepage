<?php

/**
 * Asset Queue class.
 *
 * Provides Methods for Queuing and rendering assts in page templates.
 * JavaScript files and css files are considered as queable assets.
 *
 * Client: Midokura SARL
 *
 * @author Amit Talwar <amit@midokura.com>
 * @copyright 2015 midonet.org
 */

class AssetQueue
{
    protected $CSS = array();
    protected $JS = array();
    protected $FJS = array(); //footer js

    public function addCSS($css)
    {
        $this->CSS[] = $css;
    }

    public function addJS($js)
    {
        $this->JS[] = $js;
    }

    public function addFooterJS($js)
    {
        $this->FJS[] = $js;
    }

    public function renderCSS()
    {
        foreach ($this->CSS as $item) {
            print '<link rel="stylesheet" href="'.$item.'">'."\n";
        }
    }

    public function renderJS()
    {
        foreach ($this->JS as $item) {
            print '<script src="'.$item.'"></script>'."\n";
        }
    }

    public function renderFooterJS()
    {
        foreach ($this->FJS as $item) {
            print '<script src="'.$item.'"></script>'."\n";
        }
    }
}
