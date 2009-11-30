<?php

 /* videos_controller.php, Provides Functions for Video Managment
    Copyright (C) 2009  Maran Emil

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


/**
* Controller Videos
*
* @author:		maran_emil@yahoo.com
* @web:			http://maran-emil.de 
* @web2			http://maran.pamil-visions.com 
* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright	Copyright 2009, Maran Project.
* @version		1.0
 */

class VideosController extends AppController
{

	var $name = "Videos";
	var $uses = array('Video','User','Category','Rating');
	var $helpers = array('Html', 'Javascript', 'Session','Head','Javascript', 'Ajax','Form','Pagination');
	var $components = array('Pagination','Upload');
	
	/**
	* Index Videos
	*
	* @param		id = none
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function index(){
		$criteria = null;

		$paging['sortBy']="id";
		$paging['direction']='DESC';
		$paging['show']='5';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpVid = $this->Video->findAll($criteria,"", $order, $limit, $page);
		$arTmpCats = $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC'); 
	
		if($arTmpVid){
			$this->set("arTmpVid", $arTmpVid);
			$this->set("arTmpCats", $arTmpCats);
			$this->pageTitle = 'Cakemelody - Videos';
		}else{
			$this->pageTitle = ' - No videos found';
			$this->set('message',"No Article were found,...");
			$this->render(null,null,'views/errors/cc_die');
		} 

		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);
	}

	/**
	* Category
	*
	* @param		id (interger)
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function category($id=NULL)
	{

		$id = $this->params["pass"][0];
		if(!$id) $id=1;
		$criteria = " Video.category_id=".$id." ";

		$paging['sortBy']="views";
		$paging['direction']='DESC';
		$paging['show']='5';
			
		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpVid = $this->Video->findAll($criteria,"", $order, $limit, $page);
		$arTmpCats = $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC'); 
	
		if(isset($arTmpVid)){
			$this->set("arTmpVid", $arTmpVid);
			$this->set("arTmpCats", $arTmpCats);
			$this->pageTitle = 'Cakemelody - Videos';
		}else{
			$this->pageTitle = ' - No videos found';
			$this->set('message',"No Article were found,...");
			$this->render(null,null,'views/errors/cc_die');
		} 

		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);
	}

	/**
	* User Videos
	*
	* @param		id (interger)
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function uservideos($id=NULL){

		if($id==NULL) $id=1;
		$criteria = " Video.user_id=".$id;

		$paging['sortBy']="views";
		$paging['direction']='DESC';
		$paging['show']='5';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpVid = $this->Video->findAll($criteria,"", $order, $limit, $page);
		$arTmpCats = $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC'); 
	
		if(isset($arTmpVid)){
			$this->set("arTmpVid", $arTmpVid);
			$this->set("arTmpCats", $arTmpCats);
			$this->pageTitle = 'Cakemelody - Videos';
		}else{
			$this->pageTitle = ' - No videos found';
			$this->set('message',"No Article were found,...");
			$this->render(null,null,'views/errors/cc_die');
		} 

		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);
	}

	/**
	* Display Videos
	*
	* @param		none
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function display()
	{
		$criteria = null;

		$paging['sortBy']="views";
		$paging['direction']='DESC';
		$paging['show']='5';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpVid = $this->Video->findAll($criteria,"", $order, $limit, $page);
		$arTmpCats = $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC'); 
	
		if($arTmpVid){
			$this->set("arTmpVid", $arTmpVid);
			$this->set("arTmpCats", $arTmpCats);
			$this->pageTitle = 'Cakemelody - Videos';
		}else{
			$this->pageTitle = ' - No videos found';
			$this->set('message',"No Article were found,...");
			$this->render(null,null,'views/errors/cc_die');
		} 

		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);
	}

	/**
	* Top Videos
	*
	* @param		none
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function topvideos(){
		$criteria = null;

		$paging['sortBy']="views";
		$paging['direction']='DESC';
		$paging['show']='5';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpVid = $this->Video->findAll($criteria,"", $order, $limit, $page);
		$arTmpCats = $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC'); 
	
		if($arTmpVid){
			$this->set("arTmpVid", $arTmpVid);
			$this->set("arTmpCats", $arTmpCats);
			$this->pageTitle = 'Cakemelody - Videos';
		}else{
			$this->pageTitle = ' - No videos found';
			$this->set('message',"No Article were found,...");
			$this->render(null,null,'views/errors/cc_die');
		} 

		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);
	}

	/**
	* New Videos
	*
	* @param		none
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function newvideos(){
		$criteria = null;

		$paging['sortBy']="date";
		$paging['direction']='DESC';
		$paging['show']='5';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpVid = $this->Video->findAll($criteria,"", $order, $limit, $page);
		$arTmpCats = $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC'); 
	
		if($arTmpVid){
			$this->set("arTmpVid", $arTmpVid);
			$this->set("arTmpCats", $arTmpCats);
			$this->pageTitle = 'Cakemelody - Videos';
		}else{
			$this->pageTitle = ' - No videos found';
			$this->set('message',"No Article were found,...");
			$this->render(null,null,'views/errors/cc_die');
		} 

		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);
	}

	/**
	* View Video
	*
	* @param		none
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function view($id = NULL) {
		$this->Video->id = $id;

		$ratingTMP = $this->Rating->query("SELECT SUM(rateval) as Gesamt, COUNT(rateval) as Votes FROM ratings WHERE video_id=".$id." "); 
		
		$arTmp  = $this->Video->query('SELECT * FROM videos WHERE id='.$id);
		$viewsplus = $arTmp[0]['videos']['views']+1;
		
		$update = $this->Video->query("UPDATE videos SET views = '".$viewsplus."' WHERE id=".$id);
		$ratingVal = round($ratingTMP[0][0]['Gesamt']/$ratingTMP[0][0]['Votes']);

		$arTmpV  = $this->Video->query('SELECT * FROM videos WHERE id='.$id);
		$viewsplus = $arTmpV[0]['videos']['views']+1;
		$update = $this->Video->query("UPDATE videos SET views = '".$viewsplus."' WHERE id=".$id);

		$this->set("Video", $arTmpV);
		$this->set("rating", $ratingVal);
		$this->set("votes", $ratingTMP[0][0]['Votes']);

	}

	/**
	* Rating Save Videos 
	*
	* @param		none
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function ratingsave(){
			$this->layout = "ajax";

			$ratingval = $this->params["pass"][0];
			$articleid = $this->params["pass"][1];
			$userid = $this->Session->read("User.id");

			$tmpdata = array(
						"Rating"=>array(
						"video_id"=>$articleid,
						"rateval"=>$ratingval,
						"user_id"=>$userid,
						"user_ip"=>$_SERVER['REMOTE_ADDR']
						)
					);
			
			
			$chekcRate = $this->Rating->query("SELECT * FROM ratings WHERE user_ip='".$_SERVER['REMOTE_ADDR']."' AND video_id='".$articleid."'");
			if(!$chekcRate){
				$this->Rating->save($tmpdata);
			}
	}

	/**
	* checkIfLogged
	*
	* @param		none
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function checkIfLogged(){
		if(!$this->Session->read("User")){
			$this->flash('Please login or register first...', '/');
			$this->redirect("/users/login"); 
			exit;
		}
	}

	/**
	* step1 add new video
	*
	* @param		id (integer) = user id
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function step1($id = NULL) {
		$this->checkIfLogged();
		$this->pageTitle = 'Add Video...';

		$arTmpCat = $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
		$this->set("arTmpCat", $arTmpCat);
	}

	/**
	* step2 save new video
	*
	* @param		none
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function step2() {
		$this->checkIfLogged();
		$this->pageTitle = 'saving data...';

		// get youtube code from url or simple code
		if(strstr($this->data['Video']['tubecode'],"http")){
			$arCodeTmp = explode("?v=",trim($this->data['Video']['tubecode']));
			$newVideoCode = trim($arCodeTmp[1]);
			$arCodeTmpSec = explode("&",trim($newVideoCode));
			$newVideoCodeF = trim($arCodeTmpSec[0]);
			if($newVideoCodeF && strlen($newVideoCodeF)==11) {
				$Videotubecode = $newVideoCodeF;
			}
			else {
				$this->flash('Wrong Video Tube code!','/videos/step1/');
			}
		
		}
		else if(strlen(trim($this->data['Video']['tubecode']))==11){
			$Videotubecode = trim($this->data['Video']['tubecode']);
		}
		else{
			$this->flash('Wrong Video Tube code!','/videos/step1/');
		}
		
		if($this->data['Video']["category_id"]){
		$form_data = array(
						'Video' => array(
						'category_id'		=>	$this->data['Video']["category_id"],
						'bandname'			=>	$this->data['Video']['bandname'], 
						'songtitle'			=>	$this->data['Video']['songtitle'], 
						'tubecode'			=>	$Videotubecode, 
						'tags'				=>	$this->data['Video']['tags'], 
						'date'				=>	date("Y-m-d"), 
						'ip1'				=>	$REMOTE_ADDR,
						'ip2'				=>	$_SERVER['REMOTE_ADDR'],
						'user_id'			=>	$this->Session->read("User.id")
					)
				); 

		if($this->Video->save($form_data)) {
				//Displays a Message on success
				$this->flash(''.$lbls["registred_ok"].'Your video has been saved succesfully', '/videos');
			} 
		}
		else{
			//$this->flash('Wrong data!','/videos/step1/');
		}
		#####################################################################################	
	}

	/**
	* showcategory
	*
	* @param		id integer
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function showcategory($id){
		$currCat = "Default";
		
			$arTmpCatSubCats = $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC'); 

		foreach($arTmpCatSubCats as $sCat) {
			if($sCat['categories']["id"]==$id){
				$currCat = $sCat['categories']["name"];
			}
		}
		return $currCat;
	}

	/**
	* list_latest - get last videos
	*
	* @param		limit integer
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function list_latest($limit = 9)	
	{
		if ( isset($this->params['requested']) AND $this->params['requested'] )
		{
			return 	$this->Video->find('all', array('order' => 'Video.id DESC', 'limit' => $limit));
			}
		else
		{
			return FALSE;
		}
	}

	/**
	* search videos
	*
	* @param		searchq string
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function search($searchq = NULL){

		$searchq = $this->params['url']['searchq'];

		if($searchq!=NULL){
			$criteria = " `Video`.`songtitle` LIKE '%".$searchq."%' OR `Video`.`bandname` LIKE '%".$searchq."%' ";
		}
		else{
			$criteria = " `Video`.`descr` LIKE '%nuit%'";
		}

		$paging['sortBy']="date";
		$paging['direction']='DESC';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpVid = $this->Video->findAll($criteria,"", $order, $limit, $page);
		$arTmpCats = $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC'); 
	
		if($arTmpVid){
			//$this->set(compact('comments','currentDateTime'));
			$this->set("arTmpVid", $arTmpVid);
			$this->set("arTmpCats", $arTmpCats);
			$this->pageTitle = 'Publion - Anunturi - Search';
		}else{
			$this->pageTitle = ' - No Articles';
			$this->set('message',"No Article were found,...");
			$this->render(null,null,'views/errors/cc_die');
		} 

		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);
	}

} // end class

?>
