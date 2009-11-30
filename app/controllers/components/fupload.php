<?php
// /app/controllers/components/math.php
class FuploadComponent extends Object {
	var $savePath="";
	var $file=NULL;
	var $name="";
	var $type="";
	var $size=0;
	/*function setFile($file_=NULL) {
		if($file_==NULL) return false;
		if(!is_uploaded_file($file_['tmp_name'])) return false;
		$this->file = new File($file_['tmp_name']);
		$this->name=
	}
	function setSavePath($path="") {
		$this->savePath=$path;
	}*/
}

?>
