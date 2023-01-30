<?php
class ConvertDateTime{
	public static function formatHeure($heure){
		$ma_chaine = $heure;
		$iparr = explode (":", $ma_chaine); 
		$nouvelle = $iparr[0]."h ".$iparr[1]."min";
		return $nouvelle;
	}
}
?>