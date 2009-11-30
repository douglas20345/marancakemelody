<?php
// Creo il navigatore.
$html->addCrumb(__("Home", TRUE), "/");
?>

<?php 
if(is_array($arTmpVid)){
	foreach ($arTmpVid as $sVid){
		echo $this->renderElement("video", $sVid); 
	}
	echo $this->renderElement('pagination', $paging);
}
?> 

 
