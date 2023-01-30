<?php
require_once('./controleurs/Constructeur.action.php');
require_once('./modeles/interfaces/PRG.interface.php');
require_once('./Config/Config.interface.php');
//header("Cache-Control:no-cache");
$action = null;
$vue = null;
if (ISSET($_REQUEST["action"])) {
    $action = Constructeur::getAction($_REQUEST["action"]);
    $vue = $action->executer();
} else {
    $action = Constructeur::getAction("");
    $vue = $action->executer();
}


if ($action instanceof PRG) {
    header("Location: ?action=afficher&page=" . $vue);
} else {
    if(!include_once('vues/' . $vue . '.vue.php')){
        header("Location: ?action=afficher&page=".Config::PAGE_DEFAUT);
    }
}
?>