<?php //echo $this->renderElement('post',$post); ?>
<? // echo "<pre>"; print_r($Video); echo "</pre>"; ?>

<script>
function saveRating(ratingval,videoid){

 $.ajax({
   type: "GET",
   url: "http://<?=$_SERVER['HTTP_HOST']?><?=$this->webroot?>videos/ratingsave/"+ratingval+"/"+videoid+"",
   data: "",
   success: function(msg){
    //alert( "Saved!");
   }
 });
//http://docs.jquery.com/Ajax/jQuery.ajax
//http://docs.jquery.com/Ajax
}
</script>



<? 
// clean blank space around string - EM 14.11.2009
$Video[0]['videos']['tubecode'] = trim($Video[0]['videos']['tubecode']); 
?>

<div style="width: 640px; border: 1px solid white; float: left; padding: 0 5px 5px 5px">

		<h1 style="margin: 0px"><?=$Video[0]['videos']['bandname']?> - <?=$Video[0]['videos']['songtitle']?></h1>
		<div style="width: 630px; border: 1px solid white;">
			
			<object width="630" height="376">
			<param name="movie" value="http://www.youtube.com/v/<?=$Video[0]['videos']['tubecode']?>&hl=en"></param>
			<param name="wmode" value="transparent"></param>
			<embed src="http://www.youtube.com/v/<?=$Video[0]['videos']['tubecode']?>&hl=en" type="application/x-shockwave-flash" wmode="transparent" width="630" height="376"></embed>
			</object>
		
			<HR>
			<h3>
			Views: <?=$Video[0]['videos']['views']?>  <br />
			<? echo $this->renderElement('rating',array( 'rating'=>$rating,'votes'=>$votes )); ?><br />


			See all videos from <A HREF="<? echo $this->webroot."videos/uservideos/".$Video[0]['videos']['user_id']; ?>">  <?	echo $this->requestAction('users/getuserbyid/'.$Video[0]['videos']['user_id']);	?> </a> <BR>

			Youtube FULL VIDEO URL: 
			<A HREF="http://www.youtube.com/v/<?=$Video[0]['videos']['tubecode']?>&hl=en" target="_blank">http://www.youtube.com/v/<?=$Video[0]['videos']['tubecode']?>&hl=en</A>
			<BR>

			Youtube normal URL: 
			<A HREF="http://www.youtube.com/watch?v=<?=$Video[0]['videos']['tubecode']?>" target="_blank">http://www.youtube.com/watch?v=<?=$Video[0]['videos']['tubecode']?></A>
			<BR>
			</h3>
			
			<div style="clear: both"></div>
		</div>


<!-- Comments Area -->
	<div style="width: 220px; padding: 5px">
		<h1> Comments </h1>
		<ul>
		<?if(is_array($comm)){?>
			<? foreach($comm as $sncomm){?>
				<li>
				<B><?=$sncomm['comments']['nickname']?></B> <?=$sncomm['comments']['date']?><BR> 
				<?=$sncomm['comments']['comment']?> <hr>
				</li>
			<?}?>
		<?}?>
		</ul>
	</div>
	<div style="clear: both"></div>
</div>

</div>
<!-- / Comments Area -->
