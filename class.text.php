<?php
class TEXT{
    public function __construct(){
       // $this->CheckLogin();
 	} 

    public function Slug($string){
        $strResult = str_ireplace("à", "a", $string);
        $strResult = str_ireplace("á", "a", $strResult);
        $strResult = str_ireplace("è", "e", $strResult);
        $strResult = str_ireplace("é", "e", $strResult);
        $strResult = str_ireplace("ì", "i", $strResult);
        $strResult = str_ireplace("í", "i", $strResult);
        $strResult = str_ireplace("ò", "o", $strResult);
        $strResult = str_ireplace("ó", "o", $strResult);
        $strResult = str_ireplace("ù", "u", $strResult);
        $strResult = str_ireplace("ú", "u", $strResult);
        $strResult = str_ireplace("ç", "c", $strResult);
        $strResult = str_ireplace("ö", "o", $strResult);
        $strResult = str_ireplace("û", "u", $strResult);
        $strResult = str_ireplace("ê", "e", $strResult);
        $strResult = str_ireplace("ü", "u", $strResult);
        $strResult = str_ireplace("ë", "e", $strResult);
        $strResult = str_ireplace("ä", "a", $strResult);
        $strResult = str_ireplace("'", " ", $strResult);
        $strResult = preg_replace('/[^A-Za-z0-9 ]/', "", $strResult);
        $strResult = trim($strResult);
        $strResult =  preg_replace('/[ ]{2,}/', " ", $strResult);
        $strResult = str_replace(" ", "-", $strResult);
        $strResult = strtolower($strResult); 
        return $strResult;
    }
  
    public function replace( $str, $find, $repl ){
        // str_ireplace case insensitive
        // str_replace case sensitive
        return str_replace( $find, $repl, $str );
    }
	
 

    public function random_string($type = 'basic', $len = 10){
		switch ($type){
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case 'numeric':
            case 'nozero':
              switch ($type){
					case '1':
						$pool = 'abcdefghijklmnopqrstuvwxyz';
						break;
					case '2':
						$pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case '3':
						$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
                    case '4':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyz';
                        break;
                    case '5':
                        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case '6':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
				   case 'numeric':
						$pool = '0123456789';
						break;
					case 'nozero':
						$pool = '123456789';
						break;
				}

				return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);

			case 'md5':
				return md5(uniqid(mt_rand()));
			case 'sha1':
				return sha1(uniqid(mt_rand(), TRUE));
		}
	}


    public function ucase($str){
        return strtoupper($str);
	}
    public function lcase($str){
        return strtolower($str);
	}

    public function fcase($str){
        return ucfirst($str);
	}


}






?>