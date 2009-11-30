<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $html->charset(); ?>
		
		<title>
		<?php 
		if(!$title_for_layout) $title_for_layout=" EOPP CAKE MELODY - pre Alpha Preview Version 0.1";
			echo $title_for_layout; 
		?>
		</title>

		
		<!-- 
			This website is powered by CAKEPHP - 
			CakePHP : the rapid development php framework 
			CakePHP enables PHP users at all levels to rapidly develop robust web applications.

			CAKEPHP is a free open source Framework licensed under GNU/GPL.
			Information and contribution at http://cakephp.org/
		-->

		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<?php echo $html->meta('icon'); ?>
		<?php echo $html->css('default'); ?>
		<?php //echo $javascript->link('prototype'); ?>
		<?php //echo $javascript->link('scriptaculous.js?load=effects'); ?>
		<?php //echo $javascript->link('scriptaculous');?>

		<?php  echo $javascript->link('jquery'); ?>
		<?php // echo $javascript->link('customweb'); ?>


		<?php echo $head->registered() ?>
		<?php if ($session->check('Message.flash')): ?>
		<?php echo $javascript->link('flash_message'); ?>
		<?php echo $html->css('flash_message'); ?>
		<?php endif; ?>
		<?php echo $scripts_for_layout; ?>

		<?
			if(strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 7.')){
				echo '<meta http-equiv="X-UA-Compatible" content="IE=7" />';
			}
		?>
	</head>

	<body>
		<!-- Navigatore -->
		<div id="navxbar">
			<div id="navbar">
		
			<div  style="float: left; margin: 8px 20px 5px 0">
				<?if($session->read("User.username")){?>
				Logged as: &nbsp; <A HREF="<?=$this->webroot?>users/view/<?=$session->read("User.id")?>"><?=$session->read("User.name")?> <?=$session->read("User.pastname")?></A> | <A HREF="<?=$this->webroot?>users/logout">Logout</A>
				<?}else{?>
					<form method="post" action="<?=$this->webroot?>users/login/"> <!-- <?php echo $html->url('/users/login/') ?> -->
					<TABLE>
						<TR>
							<TD>Login: &nbsp; <?php echo $form->text('User/username', array('size' => '15', 'class' => 'input_medium','value' => 'email@','onfocus' => 'this.value=""')); ?> </TD>
							<TD><?php echo $form->password('User/password', array('size' => '15', 'class' => 'input_medium','value' => 'password','onfocus' => 'this.value=""')); ?> </TD>
							<TD><?php echo $form->submit('Login'); ?></TD>
							<!-- <TD><A HREF="<?=$this->webroot?>users/register">Register</TD> -->

						</TR>
					</TABLE>
					</form>	
				<?}?>
			</div>

			<!-- Search Box -->
				<div id="searchform" style="float: right; margin: 10px 20px 5px 0">
					<?php echo $form->create('Search',array('id'=>"searchform",'type'=>"get",'url'=>"/videos/search")); ?>
						<input type="text" name="searchq" id="searchq" size="30" value="<?php __("Search"); ?>"  onfocus ='this.value=""'  />
					</form>
				</div>
			<!-- / Search Box -->


		
			</div>
		</div>
		<!-- / Navigatore -->

<style>
#menutop {color:#FFFFFF; font: bold 14px Arial;  height:15px; margin:0;  padding: 0 0 5px 0; }
#menutop a{ color:#FFFFFF; }
</style>


		<div id="breadcrumb" style="padding: 5px 10px 5px 10px; margin: 0px 0 5px 0; background: #0177FF; color: white; font: bold 11px arial; ">
				<!-- You are here: &nbsp; --><!--  http:// --><?//$_SERVER['HTTP_HOST']?><?//$_SERVER['REQUEST_URI']?>
		
			<div id="menutop" style="float: left">
				<a href="<?=$this->webroot?>videos/topvideos/" id="">Top Videos</a> | 
				<a href="<?=$this->webroot?>videos/newvideos/" id="">New Videos</a> | 
				<a href="<?=$this->webroot?>infos/contactus/" id="">Contact / Impressum</a> | 
				<?if(!$session->read("User.username")){?>
					<a href="<?=$this->webroot?>users/register/" id="">Register</a> | 
					<a href="<?=$this->webroot?>users/login/" id="">Login | </a> 
				<?}?>
				<a href="<?=$this->webroot?>infos/whatisthis/" id="">What is this?</a> | 
			</div>

			<div id="menutoplogo" style="float: right">
				<img src="<?=$this->webroot?>img/cakemelody.gif" width="214" height="33" border="0" alt="">
			</div>
			<div style="clear: both"></div>

		</div>

	<div id="middlepage" style="">

		<!-- Contenitore -->
		<div id="content">

			

			<!-- Contenitore Sinistro -->
			<div id="contentleft">
				<?php if ($session->check('Message.flash')): ?>
				<?php $session->flash(); ?>
				<?php endif; ?>