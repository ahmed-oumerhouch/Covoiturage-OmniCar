<?php
require_once('./Config/Config.interface.php');
require_once('./modeles/interfaces/Action.interface.php');
class Deconnexion implements Action{
	public function executer(){
		if(isset($_SESSION["membre"])){
			Unset($_SESSION["membre"]);
		}
		return "accueil";
	}
}
?>