<?php
class IMAGE{
    public function __construct(){
       // $this->CheckLogin();
 	} 
    
    function imagecreatefrom( $format ){
		$ext = strtolower(pathinfo($format, PATHINFO_EXTENSION));
		switch($ext){ 
			case "jpg": 
			 $source_image = imagecreatefromjpeg($format);
			 break;
			case "png": 
			 $source_image = imagecreatefrompng($format);
			 break;
			 case "bmp": 
			 $source_image = imagecreatefromwbmp($format);
			 break;
		   }
		return $source_image;
	}
    function imagesavefrom( $vi , $d , $q=100){
		$ext = strtolower(pathinfo($d, PATHINFO_EXTENSION));

		switch($ext){ 
			case "jpg": 
                imagejpeg( $vi ,$d, $q );
			 break;
			case "png": 
                imagepng( $vi, $d, $q );
			 break;
			 case "bmp": 
                imagebmp( $vi, $d );
			 break;
		   }
		
	}

    public function imageToBase64($src){
        return  base64_encode(file_get_contents($src)); 
    }
    
    public function BaseToImage64( $src, $dest, $quality= 100){
        $data = base64_decode($src);
        $im = imageCreateFromString($data);
        $this->imagesavefrom($im, $dest, $quality);
       
    }
    

    public function formatBytes($bytes) {
        if ($bytes > 0) {
            $i = floor(log($bytes) / log(1024));
            $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            return sprintf('%.02F', round($bytes / pow(1024, $i),1)) * 1 . ' ' . @$sizes[$i];
        } else {
            return 0;
        }
    }

    public function GetImageSizeInfo($src){
        //input "file.jpg"
        // [dirname] => file
        // [basename] => file.mp3
        // [extension] => mp3
        // [filename] => file
        // [size] => 4788069
        // [sizeformat] => 4.6 MB
      
        //Indice 2 mostra il tipo di immagine, restituisce il numero, dove:
        //1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, TIFF 7 = (ordine dei byte Intel), 8 = TIFF (ordine dei byte Motorola), 9 = CPM, 10 = JP2,11 = JPX, 12 = JB2,13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM 
        $image_info = getimagesize($src); 
        $array = pathinfo($src);
        $array["size"]          = filesize($src);
        $array["sizeformat"]    = $this->formatBytes($array["size"]);
        $array["w"]             = $image_info["0"];
        $array["h"]             = $image_info["1"];
        $array["tipo"]          = $image_info["2"];
        $array["string"]        = $image_info["3"];
        $array["bit"]           = $image_info["bits"];
        $array["channels"]      = $image_info["channels"];
        $array["mime"]          = $image_info["mime"];
        return $array;

    }
       
    public function AddWatermarkText($src, $dest, $text){
        list($width, $height) = getimagesize($src);
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($src);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
        // $red = imagecolorallocate($image_p, 255, 0, 0);    
        imagettftext($image_p, WatermarkFontSize, WatermarkA, WatermarkX, WatermarkY, WatermarkFontColor, WatermarkFontName, $text);
        if ($dest) {
           imagejpeg ($image_p, $dest, 100);
        } else {
           header('Content-Type: image/jpeg');
           imagejpeg($image_p, null, 100);
        };
        imagedestroy($image);
        imagedestroy($image_p);
    }

    public function AddWatermarkImage($src, $dest, $wmark){

        $watermark = imagecreatefrompng($wmark);
        $SourceFile = imagecreatefromjpeg($src);
       
        $marginSide = 15;
        $marginBottom = 15;
      
        $photoWidth = imagesx($SourceFile);
        $photoHeight = imagesy($SourceFile);
      
        $watermarkWidth = imagesx($watermark);
        $watermarkHeight = imagesy($watermark);
      
        $dstX = ($photoWidth - $watermarkWidth - $marginSide);
        $dstY = ($photoHeight - $watermarkHeight - $marginBottom);
      
        imagecopy($SourceFile, $watermark, $dstX, $dstY, 0, 0, $watermarkWidth, $watermarkHeight);
    
        imagejpeg($SourceFile, $dest, 100);
        imagedestroy($SourceFile);
        imagedestroy($watermark);
      
    }

    function splitletternumber($string){
        $chars = '';
        $nums = '';
        
        for ($index=0;$index<strlen($string);$index++) {
            if(preg_match('/[0-9]/', $string[$index]))
                $nums .= $string[$index];
            else    
                $chars .= $string[$index];
        }
        $valore["numero"] = $nums;
        $valore["tipo"] = $chars;

        return $valore;
    }
  
    function make_thumb($src, $dest, $desired_width) {
		$source_image = $this->imagecreatefrom($src);
		$width = imagesx($source_image);
		$height = imagesy($source_image);

        $x=$this->splitletternumber($desired_width);
       
        if ($x["tipo"] == "%" ) {
            //creo miniatura percentuale
            // es: 2048x1536 e voglio w = 25% quindi Arrotondo(2048 * ( 384 / 100 ) ) dove 0,1953125 = 400/2048
            $desired_width = floor($width *($x["numero"] / 100));
            $desired_height = floor($height * ($desired_width / $width)); 
        }else{
             //creo miniatura con w massimo ....
             //es: 2048x1536 e voglio w = 400 quindi Arrotondo( 1536 * (0,1953125 / 2048) ) dove 0,1953125 = 400/2048
            $desired_width = $x["numero"];
            $desired_height = floor($height * ($x["numero"] / $width)); 
        }
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	    $this->imagesavefrom($virtual_image, $dest);
	}

 

	public function AddFolder($dest){
		if (!file_exists($dest)){
			mkdir($dest);
		}   
	}	
    public function RemoveFolder($dest){
		if (!file_exists($dest)){
			rmdir($dest);
		}   
	}	
}


?>