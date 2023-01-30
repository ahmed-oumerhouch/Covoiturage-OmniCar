<?php
require_once('./Config/Config.interface.php');
require_once('./modeles/interfaces/Action.interface.php');
class Afficher implements Action{
	public function executer(){
		if(!ISSET($_SESSION))
			session_start();
		if(ISSET($_REQUEST['page'])){
			return $_REQUEST['page'];
		}else{
			return Config::PAGE_DEFAUT;
		}
	}
}
?>