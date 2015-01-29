<?php
class GlobalFunction{
	public static function GenerateRandomPassword(){
		return md5(mt_rand(10,99999999999999999));
	}
	public static function DateAdd($Interval,$Range,$Date){
		return strtotime(date('Y-m-d H:i:s',$Date)." ".$Range.$Interval);
	}
	public static function getBooleanQuery($bool){
		if ($bool){
			return "1";
		}
		else
		{
			return "0";
		}
	}
	
	public static function getDateQuery($date){
		return str_replace(' 00:00:00','',date("Y-m-d H:i:s",$date)) ;
	}
	
	public static function getFileExtension($FileName){
		$partName = explode('.',$FileName);
		return strtolower(end($partName));
	}

    public static function IsAllowedPhotoExtension($extension){
        $allowed = array('png','jpg','gif','jpeg','bmp');
        return in_array($extension,$allowed);
    }
    
    public static function getIndonesianMoneyString($number)
    {
        return "Rp. ".number_format ($number,2,",",".");
    }
}
?>