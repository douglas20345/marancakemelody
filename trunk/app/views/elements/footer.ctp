</div>
			<!-- / Contenitore Sinistro -->



			
			<!-- Contenitore Destro -->
			<div id="contentright">

				<?if($session->read("User.username")){?>
				<div class="sidebaruser">
					<ul class="sidebaruser">
						<li><a href="<?=$this->webroot?>videos/step1/<?=$session->read("User.id")?>">Add Video</a></li>
						<li><a href="<?=$this->webroot?>users/view/<?=$session->read("User.id")?>">View My Profile</a></li>
						<li><a href="<?=$this->webroot?>users/myprofile/<?=$session->read("User.id")?>">Edit My Profile</a></li>
						<li><a href="<?=$this->webroot?>videos/uservideos/<?=$session->read("User.id")?>">My videos</a></li>
					</ul>
				</div>
				<?}?>

				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Latest Posts -->
					<ul class="sidebar">
						<li><a href="<?=$this->webroot?>" id="">Homepage</a></li>
						<li><a href="<?=$this->webroot?>videos/" id="">Fresh Videos</a></li>
						<li><a href="<?=$this->webroot?>videos/topvideos/" id="">Top Videos</a></li>
						<!-- 	
						<li><a href="<?=$this->webroot?>users/" id="">Users</a></li>
						<li><a href="<?=$this->webroot?>articles/" id="">Articles</a></li>
						 -->
					</ul>
				</div>

				<div class="sidebarcat">
					<ul class="sidebarcat">
						<li><a href="<?=$this->webroot?>videos/category/10" id="">Progressive House</a></li>
						<li><a href="<?=$this->webroot?>videos/category/11" id="">Trance</a></li>
						<li class="sidebarcat"><a href="<?=$this->webroot?>videos/category/1" class="sidebarcat">Best Rock Songs</a></li>
						<li><a href="<?=$this->webroot?>videos/category/2" id="">Blues</a></li>
						<li><a href="<?=$this->webroot?>videos/category/3" id="">Dance</a></li>
						<li><a href="<?=$this->webroot?>videos/category/4" id="">Hip-Hop</a></li>
						<li><a href="<?=$this->webroot?>videos/category/5" id="">Latin</a></li>
						<li><a href="<?=$this->webroot?>videos/category/6" id="">Pop</a></li>
						<li><a href="<?=$this->webroot?>videos/category/7" id="">R'n'B</a></li>
						<li><a href="<?=$this->webroot?>videos/category/8" id="">Rock & Alternative</a></li>
						<li><a href="<?=$this->webroot?>videos/category/9" id="">World & Reggae</a></li>
					</ul>
				</div>
				
		


<br />

<?
				//print_r($this->requestAction('users/lastusers/'));
				?>
				<div id="contentRtUsers">
						<?php foreach($this->requestAction('users/lastusers/8') AS $user): ?>
						
						<div class="userBox">
								<? if($user['User']['image']){?>
									<A HREF="<?=$this->webroot?>users/view/<?=$user['User']['id']?>">
										<img src="<?=$this->webroot?>img/user/<?=$user['User']['image']?>" border=0 width="71" height="68"><BR>
										<?if($user['User']['nickname']=="anonim" && $user['User']['name']){ $user['User']['nickname'] = strtolower($user['User']['name']);} ?>
										<?=$user['User']['nickname']?>
									</A>
								<?}else{?>
									<A HREF="<?=$this->webroot?>users/view/<?=$user['User']['id']?>">
										<img src="<?=$this->webroot?>img/user/usericon.jpg" border=0 width="71" height="68"><BR>
										<?if($user['User']['nickname']==""){ $user['User']['nickname'] = "me".$user['User']['id'];} ?>
										<?=$user['User']['nickname']?>
									</A>
								<?}?>
						</div>
						<?php endforeach; ?>
						
						
						<div style="clear: both"></div>
				</div>


		<!-- / Sidebar -->
			</div>
			<!-- / Contenitore Destro -->











<div style="clear:both;"></div>
		</div>
		<!-- / Contenitore -->


		<div style="clear:both;"></div>
	</div>
	
		

		<!-- Footer Bar -->
		<div id="footerbg">
			<!-- Footer -->
			<div id="footer">
				<!-- Footer Element Left -->
				<div id="footerleft">
					<H1>New Videos</H1>
				
					<ul>
			

					</ul>
				</div>
				<!-- / Footer Element Left -->
				
				<!-- Blogroll -->
				<div id="footermiddle">
					<H1>Related Webs</H1><br />
					<ul>
						<li><a href="http://www.cakephp.org/" target="_blank">www.cakephp.org</a></li>
						<li><a href="http://cakeforge.org/" target="_blank">cakeforge.org</a></li>
						<li><a href="http://book.cakephp.org" target="_blank">book.cakephp.org</a></li>
						<li><a href="http://www.youtube.com/" target="_blank">www.youtube.com</a></li>
						<li><a href="http://www.myvideo.de/" target="_blank">www.myvideo.de</a></li>
						<li><a href="http://www.clipfish.de/" target="_blank">www.clipfish.de</a></li>
					</ul>
				</div>
				<!-- / Blogroll -->
				
				<!-- Footer Element Right -->
				<div id="footerright">
							
					<!-- Credits -->
					
					<H1>Credits</H1>
					<p>
						Developed with <?php echo $html->link("Maran Emil","http://www.maran-emil.de"); ?>.<br />
						Copyright&copy; <?php echo date("Y",time()); ?> Site Owner.<br />
						This Design is based on <?php echo $html->link("Pereira Pulido Nuno Ricardo Design","http://www.namaless.com"); ?>.<br />
						<?php echo $html->link("xHTML","http://validator.w3.org/check/referer",array('title'=>"This page validates as XHTML 1.0 Transitional")); ?> | <?php echo $html->link("CSS","http://jigsaw.w3.org/css-validator/check/referer",array('title'=>"This page validates as CSS")); ?>
					</p>
					<!-- / Credits -->

					<?php //echo $html->image("card.gif"); ?>

				</div>
				<!-- / Footer Element Right -->
			</div>
			<!-- / Footer -->
		</div>
		<!-- / Footer Bar -->
		
		<?php 
				//echo $cakeDebug;
		?>	
	</body>
</html>
