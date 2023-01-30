<?php
class ConvertCodePostale{
	public static function formatCode($code){
		$ma_chaine = $code;
		$iparr = explode (";", $ma_chaine); 
		$nouvelle = $iparr[0];
		return $nouvelle;
	}
}
?>