<?php

/**
* Video Model.
*
* @author:		maran_emil@yahoo.com
* @web:			http://maran-emil.de 
* @web2			http://maran.pamil-visions.com 
* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright	Copyright 2009, Maran Project.
* @version		1.0
*/

class Video extends AppModel
{

	var $name = 'Video';
	var $validate = array(
		'bandname' => VALID_NOT_EMPTY,
		'songtitle' => VALID_NOT_EMPTY,
		'tubecode' => VALID_NOT_EMPTY
	);

/*
 public $useTable = "guestbook_entries";

   public function listAll(){
      return $this->find("all",array("order"=>array("Entry.created desc")));
   }
*/

}//
?>
