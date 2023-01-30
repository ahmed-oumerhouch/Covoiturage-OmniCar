<?php
require_once('./config/Config.interface.php');
date_default_timezone_set('America/New_York');

class ConnexionBD{
	private static $connexion = null;
	private function __construct(){}
	
	public static function getConnexion(){
		if(self::$connexion == null)
			try{
				self::$connexion = new PDO(
					"mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME.";charset=".Config::BD_ENCODAGE,Config::DB_USER,Config::DB_PWD);
			}
			catch(PDOException $e){
				
				$message = date('Y-m-d')." ".date('H:i:s')."#connexionBD.classe.php *La connexion à la BD a échouée*"."\n";
				
				self::$connexion = null;
			}
		return self::$connexion;
	}
	
	public static function fermerConnexion(){
		self::$connexion = null;
	}
}
?>