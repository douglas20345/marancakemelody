<?php
/**
 * Upload Component, responsible for uploading images .
 * @package
 */
class UploadComponent extends Object
{

		function uploadNewFile(){
			
				//print $_SERVER["DOCUMENT_ROOT"]; die();
				$data		= $GLOBALS["mupload_file_cakephp"]; 
				$dest		= $GLOBALS["mupload_dest_cakephp"]; 
				$destPath	= $GLOBALS["mupload_dpth_cakephp"]; 
				$output		= $GLOBALS["mupload_filx_cakephp"];

				$MAX_WIDTH = 150;
				$MAX_HEIGHT = 200;

				$pic_width = 150;
				$pic_height =180;

				#$output=date('Ymdhis').".jpg";
				#$dest = '../../app/webroot/img/upload/'.date("Ym")."/".$output;
				#$destPath = '../../app/webroot/img/upload/'.date("Ym")."/";
				#$dest = $_SERVER["DOCUMENT_ROOT"].'work/publion/app/webroot/img/upload/'.date("Ym")."/".$output;
				#$destPath = $_SERVER["DOCUMENT_ROOT"].'work/publion/app/webroot/img/upload/'.date("Ym")."/";

				if(!is_dir($destPath)){
					mkdir($destPath,0777);
				}

				$imagePath = substr($output,0,6)."/";
				$filename = $data;
			
				/*
				list($width, $height) = getimagesize($filename);
				// ............. defaul values.........................
					   $dsizew = 200;
				//................resize process.......................
					   $divider = $width / $dsizew;
					   $newwidth =  $dsizew;
					   $newheight = $height / $divider;
				//.....................................................
				*/

				// NEW  Dimension
				list($width, $height) = getimagesize($filename);
				$scale = min($MAX_WIDTH/$width, $MAX_HEIGHT/$height);

				$new_width = round($scale*$width);
				$new_height = round($scale*$height);

				if($pic_width){$newwidth = $new_width;}else{$newwidth = 100;}
				if($pic_height){$newheight = $new_height;}else{$newheight = 70;}
				//.....................................................
				$thumb = imagecreatetruecolor($newwidth, $newheight);
				$source = imagecreatefromjpeg($filename);
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				imagejpeg($thumb,$dest,100);
				//..........................................................................................
				return true;
		}

	}
?>