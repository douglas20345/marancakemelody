<?php
/* users_controller.php, Provides Functions for User Authentification and Managment
    Copyright (C) 2007  Christoph Hochstrasser

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

class UsersController extends AppController {
	
	/**
	* Class for User Authentification and Managment
	* @author:		Christoph Hochstrasser
	* @email:		christoph.hochstrasser@googlemail.com
	* @project:		http://cakeforge.org/projects/eventportal/
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2007, Christoph Hochstrasser
	*/

	var $name = 'Users';
	var $uses = array('Video','User','Category','Rating');
	var $helpers = array('Html', 'Javascript', 'Session','Head','Javascript', 'Ajax','Form','Pagination');
	var $components = array('Pagination','Upload'); 

	/**
	* Display users  in list 
	*
	* @param none
	* @author:		Christoph Hochstrasser
	* @email:		christoph.hochstrasser@googlemail.com
	* @project:		http://cakeforge.org/projects/eventportal/
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2007, Christoph Hochstrasser
	*/

	function index() {

			$criteria = null;	
			$paging['sortBy']='name';
			$paging['direction']='ASC';
			$paging['show']='5';
			
			list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
			$arUser = $this->User->findAll($criteria,"", $order, $limit, $page);
		
			if($arUser){
				//$this->set(compact('comments','currentDateTime'));
				$this->set("arUser", $arUser);
				$this->pageTitle = ' Users ';
			}else{
				$this->pageTitle = ' - No results';
				$this->set('message',"No info were found, add some...");
				$this->render(null,null,'views/errors/cc_die.ctp');
			}
	}

	/**
	* Login user
	*
	* @param none
	* @author:		Christoph Hochstrasser
	* @email:		christoph.hochstrasser@googlemail.com
	* @project:		http://cakeforge.org/projects/eventportal/
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2007, Christoph Hochstrasser
	*/

	function login() {
		$this->pageTitle = 'Login';
		//Sets the error variable to false
		$this->set('error', 'false');
		//If the form is submitted and form data is available,
		//the form data is compared with the data in the database table.
		if (!empty($this->data)){
			//$someone = $this->User->findByUsername($this->data['User']['username']);
			//$someone = $this->User->findByUsername($this->data['User']['username']);
			$someone = $this->User->query("SELECT * FROM users WHERE users.username LIKE '".$this->data['User']['username']."%'");

			if(
				!empty($someone[0]['users']['password']) && 
				$someone[0]['users']['password'] == md5($this->data['User']['password']) &&
				$someone[0]['users']['active'] == "true") 
				{
				//Sets the session variable with the user information
				$this->Session->write('User', $someone[0]['users']);
				//Sets the authentication variable
				$this->Session->write('authenticated', 'true');				
				//Sets the rights variable, which contains the rights of the current user
				$this->Session->write('rights', $someone[0]['users']['rights']);
				//Sets the status of the user to "online"
				$user = $this->Session->read('User');
				$this->User->id = $user['id'];
				$this->User->saveField("online","true");
				$this->flash('Succesfully Loged...', '/videos/');
			}
			else {
				//If the user cannot be authenticated, the error variable is set to "true"
				$this->set('error', 'true');
			}
		}
	}

	/**
	* Register user
	*
	* @param none
	* @author:		Christoph Hochstrasser
	* @email:		christoph.hochstrasser@googlemail.com
	* @project:		http://cakeforge.org/projects/eventportal/
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2007, Christoph Hochstrasser
	*/

	function register() {
		$this->set('error', 'false');
		$this->pageTitle = 'Registrierung';
		
		//If the form is submitted and the two passwords match, the data will be processed
		if(!empty($this->data) AND $this->data['User']['password'] == $this->data['User']['password_confirm']) {
			
			//Processing of the data
			$form_data = array(
					'User' => array(
						'username' => $this->data['User']['username'], 
						'password' => md5($this->data['User']['password']), 
						'e-mail' => $this->data['User']['e-mail'], 
						'name' => $this->data['User']['name'], 
						'pastname' => $this->data['User']['pastname'], 
						'active' => 'true'
					)
				);
			
			//Writes the data into the Table "users"
			if($this->User->save($form_data)) {
				//Displays a Message on success
				$this->flash(''.$lbls["registred_ok"].''.$this->data['User']['username'].''.$lbls["registred_ok_sec"].'', '/users/login');
			}
		}
		elseif($this->data['User']['password'] == $this->data['User']['password_confirm']) {
			//Otherwise the error variable is set to "true"
			$this->set('error', 'true');
		}
	}

	/**
	* Show all users
	*
	* @param none
	* @author:		Christoph Hochstrasser
	* @email:		christoph.hochstrasser@googlemail.com
	* @project:		http://cakeforge.org/projects/eventportal/
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2007, Christoph Hochstrasser
	*/

	function all() {
		//Displays the Usernames of all Members including a link to their blog and user informations
		$this->pageTitle = 'Alle Mitglieder';
		$this->checkSession();
		$this->set('users', $this->User->findAll(null, array('id','username','online'),"username ASC"));
		 
	}

	/**
	* Show last users
	*
	* @param none
	* @author:		Christoph Hochstrasser
	* @email:		christoph.hochstrasser@googlemail.com
	* @project:		http://cakeforge.org/projects/eventportal/
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2007, Christoph Hochstrasser
	*/

	function newest() {
		//Displays the newest Members
		$this->pageTitle = 'Neueste Mitglieder';
		$this->checkSession();
		$this->set('users', $this->User->findAll(null, array('id','username','online','created'),'created DESC',10));
	}

	/**
	* View user data
	*
	* @param id - user_id
	* @author:		Christoph Hochstrasser
	* @email:		christoph.hochstrasser@googlemail.com
	* @project:		http://cakeforge.org/projects/eventportal/
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2007, Christoph Hochstrasser
	*/

	function view($id=null) {
		$this->checkIfLogged();

		//Displays the user information of the user with the supplied user id
		$this->pageTitle = 'User ansehen';
		$this->User->id = $id;
		$this->set('user', $this->User->read("id,username,e-mail,online,name,pastname,created,interests,userpage,nickname,image"));
	}

	/**
	* Myprofile user
	*
	* @param id = user id
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function myprofile($id=null) {
		$this->checkIfLogged();
		$this->checkIfBelongsToArea($id);
		
			//Displays the user information of the user with the supplied user id
			$this->pageTitle = 'User ansehen';
			$this->User->id = $id;
			$this->set('user', $this->User->read("id,username,e-mail,online,name,pastname,created,interests,userpage,nickname"));
	}

	/**
	* Register user
	*
	* @param id = user_id
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function savemyprofile($id=null) {

		//Displays the user information of the user with the supplied user id
		$this->pageTitle = 'saving data...';
		$this->User->id = $id;

			#####################################################################################
			// .......................start of GD 1.6...........................................
			#####################################################################################
			if ($this->data["images"]["File"]["tmp_name"]){

				$output=date('Ymdhis').".jpg";

				$GLOBALS["mupload_file_cakephp"] = $this->data["images"]["File"]["tmp_name"];
				$GLOBALS["mupload_dest_cakephp"] = "../../app/webroot/img/user/".$output;
				$GLOBALS["mupload_dpth_cakephp"] = "../../app/webroot/img/user/";
				$GLOBALS["mupload_filx_cakephp"] = $output;
			
				if(!$this->Upload->uploadNewFile()){
					$this->flash('Wrong data!','users/');
				}

				$this->data["User"]["image"] = $output;
			}
		
		if($this->Session->read("User.id")==$this->User->id) {
				//Displays a Message on success
				$this->User->save($this->data);
				$this->flash('Sie haben sich als '.$this->data['User']['name'].' saved', '/users/myprofile/'.$this->User->id);
			}
	}

	/**
	* Logout
	* @author:		Christoph Hochstrasser
	* @email:		christoph.hochstrasser@googlemail.com
	* @project:		http://cakeforge.org/projects/eventportal/
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2007, Christoph Hochstrasser
	*/

	function logout() {
		//Destroys all session variables and sets the status of the user to "offline"
		$this->pageTitle = 'Abmeldung';
		//Reads the user id out of the session variable
		$user = $this->Session->read('User');
		$this->User->id = $user['id'];
		//Sets the status to "offline"
		$this->User->saveField("online","false");
		//Destroys all session variables
		$this->Session->delete('User');
		$this->Session->delete('authenticated');
		$this->Session->delete('rights');
		//Displays a success message and redirects to the Homepage for not registered users
		$this->flash('You are logged out...', '/videos');
	}

	/**
	* checkIfLogged
	* @author:		Christoph Hochstrasser
	* @email:		christoph.hochstrasser@googlemail.com
	* @project:		http://cakeforge.org/projects/eventportal/
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2007, Christoph Hochstrasser
	*/

	function checkIfLogged(){
		if(!$this->Session->read("User")){
			$this->flash('Please login or register first...', '/users/login');
		}
	}

	/**
	* checkIfBelongsToArea
	* @author:		Christoph Hochstrasser
	* @email:		christoph.hochstrasser@googlemail.com
	* @project:		http://cakeforge.org/projects/eventportal/
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2007, Christoph Hochstrasser
	*/

	function checkIfBelongsToArea($id){
		if($this->Session->read("User.id")!=$id){
			$this->flash('This Page not exist...', '/');
		}
	}

	/**
	* getuserbyid
	* @author:		Christoph Hochstrasser
	* @email:		christoph.hochstrasser@googlemail.com
	* @project:		http://cakeforge.org/projects/eventportal/
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2007, Christoph Hochstrasser
	*/

	function getuserbyid($id = NULL)	
	{
		if ( isset($this->params['requested']) AND $this->params['requested'] )
		{
			$arUsr = $this->User->query("SELECT nickname,name FROM users where id=".$id." LIMIT 1");
			if($arUsr[0]["users"]['nickname']){
				$nickname = $arUsr[0]["users"]['nickname'];
			}
			else{
				$nickname = "music lover";
			}
			return $nickname;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	* Get last users
	*
	* @param limit = integer number
	* @author:		maran_emil@yahoo.com
	* @web:			http://maran-emil.de 
	* @web2			http://maran.pamil-visions.com 
	* @license		http://www.opensource.org/licenses/mit-license.php The MIT License
	* @copyright	Copyright 2009, Maran Project.
	* @version		1.0
	*/

	function lastusers($limit = 8) {

		$criteria = null;
		$criteria = " User.image !='' ";
		//$order = 'order by User.id DESC';
		$order = 'ORDER BY Rand()';
		if( isset($this->params['requested']) AND $this->params['requested'] )
		{
			return $this->User->findAll($criteria,"", $order, $limit, $page);
		}
		else
		{
			return FALSE;
		}
	}

} // end class
?>