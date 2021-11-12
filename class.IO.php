<?php
class IO{
    public function __construct(){
       // $this->CheckLogin();
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

    public function GetFileInfo($src){
        //input "file.jpg"
        // [dirname] => file
        // [basename] => file.mp3
        // [extension] => mp3
        // [filename] => file
        // [size] => 4788069
        // [sizeformat] => 4.6 MB
        $array = pathinfo($src);
        $array["size"] = filesize($src);
        $array["sizeformat"] = $this->formatBytes($array["size"]);
        return $array;

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
