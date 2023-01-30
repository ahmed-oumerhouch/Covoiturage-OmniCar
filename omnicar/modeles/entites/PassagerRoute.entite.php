
<?php

require_once('./Pointservice.entite.php');
require_once('./Utilisateur.entite.php');

class PassagerRoute implements JsonSerializable{

	private $pointServicePassagerRoute = 0;
	private $utilisateurPassagerRoute =0;

	public function __construct($point, $utilisateur )	//Constructeur
	{

///JAI MIS OBJET lIEU ET Route DANS LE CONSTRUCTEUR POUR RECUPER LEUR ID//////////////////
        $this->pointServicePassagerRoute = $point.getIDPointService();
        $this->utilisateurPassagerRoute = $utilisateur.getId();
/////////////////////////////////////////////////////////////////////////////////////////////////////
	}

	public function chargerObjectBD($obj)
	{
		this->pointServicePassagerRoute = $obj->pointServicePassagerRoute;
		this->utilisateurPassagerRoute = $obj->utilisateurPassagerRoute;
	}
	public function jsonSerializable(){
		return[
			'pointServicePassagerRoute' => $this->getpointServicePassagerRoute(),
			'utilisateurPassagerRoute' = > $this->getutilisateurPassagerRoute()
		];
	}

	public function getpointServicePassagerRoute(){return $this->pointServicePassagerRoute;}
	public function getutilisateurPassagerRoute(){return $this->utilisateurPassagerRoute;}

	public function setpointServicePassagerRoute($valeur) {$this->pointServicePassagerRoute=$valeur;}
	public function setutilisateurPassagerRoute($valeur) {$this->utilisateurPassagerRoute=$valeur;}

	

	public function __toString(){
		$message="id point service = [".$this->IDPointService."]; id utilisateur= [".$this->datePointService."]";
		return $message;
	}

	public function affiche(){echo $this->__toString();}
         

?>