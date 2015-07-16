<?php

/**
 * Baisc Page Class
 *
 * A Generic class with public propterties and and Asset Queue for use in pages
 * and page templates.
 *
 * Client: Midokura SARL
 *
 * @author Amit Talwar <amit@midokura.com>
 * @copyright 2015 midonet.org
 */

class Page
{
    public $title = "";
    public $description = "";
    public $keywords = "";
    public $queue;

    public function Page()
    {
        $this->queue = new AssetQueue;
        $ac = func_num_args();

        if ($ac > 0) {
            $this->title = func_get_arg(0);

            if ($ac > 1) {
                $this->description = func_get_arg(1);
            }

            if ($ac > 2) {
                $this->keywords = func_get_arg(2);
            }
        }
    }

    public function Queue()
    {
        return $this->queue;
    }
}
