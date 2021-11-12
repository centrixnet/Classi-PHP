
<?php
class XDATA {
    const CONST_VALUE = 'A constant value';

    public function GetMese($xval,$xformat){
        $mesi = array
            (
            array("Gennaio ", "Gen "),
            array("Febbraio ", "Feb "),
            array("Marzo ", "Mar "),
            array("Aprile ", "Apr "),
            array("Maggio ", "Mag "),
            array("Giugno ", "Giu "),
            array("Luglio ", "Lug "),
            array("Agosto ", "Ago "),
            array("Settembre ", "Set "),
            array("Ottobre ", "Ott "),
            array("Novembre ", "Nov "),
            array("Dicembre ", "Dic ")
            );
        switch($xformat){ 
            case "0": 
                $i = 0;
                break;
            case "1": 
                $i = 1;
                break;
            case "2": 
                $i = 2;
                break;
        }
        $StringReturn = $mesi[$xval - 1][$i];
        return $StringReturn;
    } 
   
    public function AddDayWeekToDate($xval, $xformat, $concstring = true){
        $giorni = array
            (
            array("Lunedì ", "Lun ", "L "),
            array("Martedì ", "Mar ", "M "),
            array("Mercoledì ", "Merc ", "M "),
            array("Giovedì ", "Gio ", "G "),
            array("Venerdì ", "Ven ", "V "),
            array("Sabato ", "Sab ", "S "),
            array("Domenica ", "Dom ", "D "),
            );
        switch($xformat){ 
            case "0": 
                $f  = 0;
                break;
            case "1": 
                $f  = 1;
                break;
            case "2": 
                $f  = 2;
                break;
        }
            $ngiorno 	= date("w", strtotime($xval));
            $nomegiorno	= $giorni[$ngiorno - 1][$f];
            
            if($concstring){
                return $nomegiorno . $xval;
            }else{
                return $nomegiorno;
            }
          
    } 
    
    public function UnixTimeConvert($xval, $format="datetime") {
        switch($format){ 
            case "datetime": 
                return date("d/m/Y H:i:s",$xval) ;
                break;
            case "time": 
                return  date("H:i:s",$xval) ;
                break;
            case "date": 
                return  date("d/m/Y",$xval) ;
                break;
            case "full": 
                return $this->AddDayWeekToDate($xval, 0, false) . date("d/m/Y H:i:s",$xval) ;
                break;
        }
    }	 

    public function GetDayWeekFromDate($xval,$xformat){
        $giorni = array
            (
            array("Lunedì ", "Lun ", "L "),
            array("Martedì ", "Mar ", "M "),
            array("Mercoledì ", "Merc ", "M "),
            array("Giovedì ", "Gio ", "G "),
            array("Venerdì ", "Ven ", "V "),
            array("Sabato ", "Sab ", "S "),
            array("Domenica ", "Dom ", "D "),
            );
        switch($xformat){ 
            case "0": 
                $f  = 0;
                break;
            case "1": 
                $f  = 1;
                break;
            case "2": 
                $f  = 2;
                break;
        }
            $ngiorno 	= date("w", strtotime($xval));
            $nomegiorno	= $giorni[$ngiorno - 1][$f];
            return $nomegiorno;
    } 

    public function TempoLavorato($d1, $d2, $format = "ghms"){

		// $output = "N/A";
		// $d1 = 0;
		// $d2 = 0;
		
        // $dateTimeObject1 	= date_create($d1); 
        // $dateTimeObject2 	= date_create($d2); 
		// $difference		    = date_diff($dateTimeObject1, $dateTimeObject2); 

		// 		$d1 = $difference1->h * 60;
		// 		$d1 += $difference1->i ;
		// 		$d2 = 0;
		// 		$somma = ($d1 + $d2);
		
		// 	$hours = floor($somma / 60);
		// 	$minutes = ($somma % 60);
		// 	$output = $hours . "." . $minutes;
		// 	return  $output;
		
	}	


    
}






?>