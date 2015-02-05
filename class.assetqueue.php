<?php
/*
Title: Asset Queue  class
Description: Provides Methods for Queuing and rendering assts in page templates. Javscript files and css files are considered as queable assets.
Author: Amit Talwar <amit@midokura.com>
Client: Midokura SARL
Copyright © 2015

*/

class AssetQueue {
	protected $CSS = array();
	protected $JS = array();
	protected $FJS = array(); //footer js

	function addCSS($css) {
		
		$this->CSS[]= $css;
	}

	function addJS($js) {
		
		$this->JS[]= $js;
	}
	function addFooterJS($js) {
		
		$this->FJS[]= $js;
	}

	function renderCSS(){
		
		foreach ($this->CSS as $item) {
			print "<link rel='stylesheet' type='text/css' href='".$item."'>\n";
		}
	}


	function renderJS(){
		foreach ($this->JS as $item) {
			print "<script language='javascript' src='".$item."'></script>\n";
		}
	}

	function renderFooterJS(){
		
		foreach ($this->FJS as $item) {
			print "<script language='javascript' src='".$item."'></script>\n";
		}
	}



}
?>