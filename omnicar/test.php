<?php
require_once("./modeles/entites/Message.entite.php");
require_once('./modeles/DAOs/Message.dao.php');
date_default_timezone_set('America/New_York');
$msg = new Message();
$msg->setId(0);
$msg->setTitre("Allo");
$msg->setContenu("MESSAGE IMPORTANT");
$msg->setType("Envoi");
$msg->setDate(date('Y-m-d'));
$msg->setHeure(date('H:i:s'));
$msg->setDestinataire(2);
$msg->setProvenance(1);
MessageDAO::inserer($msg);

$dest = MessageDAO::trouverParProvenance(1,'DESC');
if($dest != null){
    foreach($dest as $m){
        echo $m->getId()."<br>".
             $m->getTitre()."<br>".
             $m->getContenu()."<br>".
             $m->getType()."<br>".
             $m->getDate()."<br>".
             $m->getHeure()."<br>".
             $m->getProvenance()."<br>".
             $m->getDestinataire()."<br><br>";
    }
}


?>