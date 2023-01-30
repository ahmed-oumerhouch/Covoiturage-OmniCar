<?php
require_once('./Config/Config.interface.php');
require_once('./modeles/interfaces/Action.interface.php');
class Defaut implements Action{
	public function executer(){
		return Config::PAGE_DEFAUT;
	}
}
?>