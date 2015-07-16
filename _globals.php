<?php

/**
 * Global PHP Code and Functions for midonet.org accessible to all pages.
 *
 * client: Midokura SARL
 *
 * @author Amit Talwar <amit@midokura.com>
 * @copyright 2015 midonet.org
 */

/*
|--------------------------------------------------------------------------
| Configure PHP Settings
|--------------------------------------------------------------------------
|
| First we'll configure PHP settings just a little bit to handle errors
| more clearly.
|
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
|--------------------------------------------------------------------------
| Define Global Constants
|--------------------------------------------------------------------------
|
| Next we'll define some global constants so we don't have to worry so much
| about path handling.
|
*/

define('ROOT_PATH', __DIR__);

/*
|--------------------------------------------------------------------------
| Load Classes
|--------------------------------------------------------------------------
|
| We just need to utilize class loading. Since this is very simple website
| we'll just going to load everything here.
|
*/

require_once 'class.assetqueue.php';
require_once 'class.page.php';
require_once 'class.videochannel.php';
require_once 'class.slideshare.php';
$page = new Page;

/*
|--------------------------------------------------------------------------
| Load Helpers
|--------------------------------------------------------------------------
|
| Load global helper functions here so it can be used anywhere in the
| application.
|
*/

require_once ROOT_PATH.'/_helpers.php';
