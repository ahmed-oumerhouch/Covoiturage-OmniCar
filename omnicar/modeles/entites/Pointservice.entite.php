

<?php

require_once('./Lieu.entite.php');
require_once('./Route.entite.php');

class Pointservice implements JsonSerializable{

	private $IDPointService = 0;
	private $datePointService;
	private $heurePointService;
	private $lieuPointService;
	private $routePointService;


	public function __construct($id, $date, $heure, $nmb, $un_lieu, $route )	//Constructeur
	{
        $this->IDPointService = $id;
        $this->datePointService = $date;
        $this->heurePointService = $heure;


///JAI MIS OBJET lIEU ET Route DANS LE CONSTRUCTEUR POUR RECUPER LEUR ID//////////////////
        $this->lieuPointService = $un_lieu.getId();
        $this->routePointService = $route.getIDRoute();
/////////////////////////////////////////////////////////////////////////////////////////////////////

	}

	public function chargerObjectBD($obj)
	{
		this->IDPointService = $obj->IDPointService;
		this->datePointService = $obj->datePointService;
		this->heurePointService = $obj->heurePointService;
		this->lieuPointService = $obj->lieuPointService;
		this->routePointService = $obj->routePointService;

	}
	public function jsonSerializable(){
		return[
			'IDPointService' => $this->getIDPointService(),
			'datePointService' = > $this->getdatePointService()
			'lieuPointService' = > $this->getlieuPointService()
			'routePointService' = > $this->getroutePointService()
			'heurePointService' = > $this->getheurePointService()
		];
	}

	public function getIDPointService(){return $this->IDPointService;}
	public function getdatePointService(){return $this->datePointService;}
	public function getlieuPointService(){return $this->lieuPointService;}
	public function getroutePointService(){return $this->routePointService;}
	public function getheurePointService(){return $this->heurePointService;}
	



	public function setIDPointService($valeur) {$this->IDPointService=$valeur;}
	public function setdatePointService($valeur) {$this->datePointService=$valeur;}
	public function setlieuPointService($valeur) {$this->lieuPointService=$valeur;}
	public function setroutePointService($valeur){$this->routePointService=$valeur;}
	public function setheurePointService($valeur){$this->heurePointService=$valeur;}
	

	public function __toString(){
		$message="id = [".$this->IDPointService."]; date et heure= ".$this->datePointService."-".$this->heurePointService."]; id Lieu = ".$this->lieuPointService."; id route =".$this->routePointService;
		return $message;
	}

	public function affiche(){echo $this->__toString();}
         

?>