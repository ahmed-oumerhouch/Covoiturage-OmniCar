<?php

require_once('./Lieu.entite.php');
require_once('./Utilisateur.entite.php');

class Route implements JsonSerializable {

	private $IDRoute = 0;
	private $statutRoute;
	private $nombrePassagerRoute =0;

	private $directionRoute ;
	private $chauffeurRoute;

	public function __construct($id, $statut, $nmb, $un_lieu, $un_utilisateur )	//Constructeur
	{
        $this->IDRoute = $id;
        $this->statutRoute = $statut;
        $this->nombrePassagerRoute = $nmb;


        
/////////JAI MIS OBJET lIEU ET UTILISATEUR DANS LE CONSTRUCTEUR POUR RECUPER LEUR ID//////////////////
        $this->directionRoute = $un_lieu.getId();
        $this->chauffeurRoute = $un_utilisateur.getId();
/////////////////////////////////////////////////////////////////////////////////////////////////////

	}

	public function chargerObjectBD($obj)
	{
		this->IDRoute = $obj->IDRoute;
		this->statutRoute = $obj->statutRoute;
		this->nombrePassagerRoute = $obj->nombrePassagerRoute;
		this->directionRoute = $obj->directionRoute;
		this->chauffeurRoute = $obj->chauffeurRoute;

	}
	public function jsonSerializable(){
		return[
			'IDRoute' => $this->getIDRoute(),
			'statutRoute' = > $this->getstatutRoute()
			'nombrePassagerRoute' = > $this->getnombrePassager()
			'directionRoute' = > $this->getdirectionRoute()
			'chauffeurRoute' = > $this->getchauffeurRoute()
		];
	}

	public function getIDRoute(){return $this->IDRoute;}
	public function getstatutRoute(){return $this->statutRoute;}
	public function getnombrePassager(){return $this->nombrePassagerRoute;}
	public function getdirectionRoute(){return $this->directionRoute;}
	public function getchauffeurRoute(){return $this->chauffeurRoute;}



	public function setIDRoute($valeur) {$this->IDRoute=$valeur;}
	public function setstatutRoute($valeur) {$this->statutRoute=$valeur;}
	public function setnombrePassager($valeur) {$this->nombrePassagerRoute=$valeur;}
	public function setdirectionRoute($valeur){$this->directionRoute=$valeur;}
	public function setchauffeurRoute($valeur){$this->chauffeurRoute=$valeur;}

	public function __toString(){
		$message="id = [".$this->IDRoute."]; statut = ".$this->statutRoute."]; nombre de passager = ".$this->nombrePassagerRoute."; id Lieu = ".$this->directionRoute."; id utilisateur =".$this->chauffeurRoute;
		return $message;
	}
	public function affiche()
	{
		echo $this->__toString();
	}
         

?>