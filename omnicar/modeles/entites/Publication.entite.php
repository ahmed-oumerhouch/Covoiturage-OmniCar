<?php

    class Publication implements JsonSerializable{
        private $id;
        private $college;
        private $telephone;
        private $vehicule;
        private $description;
        private $codePostal;
        private $direction;
        private $utilisateur;
        private $date;
        private $heure;

        public function getId() { return $this->id; }
        public function getCollege() { return $this->college; }
        public function getTelephone() { return $this->telephone; }
        public function getVehicule() { return $this->vehicule; }
        public function getDescription() { return $this->description; }
        public function getCodePostal() { return $this->codePostal; }
        public function getDirection() { return $this->direction; }
        public function getUtilisateur() { return $this->utilisateur; }
        public function getDate() { return $this->date; }
        public function getHeure() { return $this->heure; }

        public function setId($id){ $this->id = $id; }
        public function setCollege($c){ $this->college = $c; }
        public function setTelephone($t){ $this->telephone = $t; }
        public function setVehicule($v){ $this->vehicule = $v; }
        public function setDescription($d){ $this->description = $d; }
        public function setCodePostal($cp){ $this->codePostal = $cp; }
        public function setDirection($d){ $this->direction = $d; }
        public function setUtilisateur($u){ $this->utilisateur = $u; }
        public function setDate($d){ $this->date = $d; }
        public function setHeure($h){ $this->heure = $h; }

        public function chargerObjetBD($objetBD){
            $this->id = $objetBD->IDPublication;
            $this->college = $objetBD->collegePublication;
            $this->telephone = $objetBD->telephonePublication;
            $this->vehicule = $objetBD->vehiculePublication;
            $this->description = $objetBD->descriptionPublication;
            $this->codePostal = $objetBD->codePostalPublication;
            $this->direction = $objetBD->directionPublication;
            $this->utilisateur = $objetBD->utilisateurPublication;
			$this->date = $objetBD->datePublication;
			$this->heure = $objetBD->heurePublication;
        }

        public function chargerTableauBD($tableauBD){
            $this->id = $tableauBD['IDPublication'];
            $this->college = $tableauBD['collegePublication'];
            $this->telephone = $tableauBD['telephonePublication'];
            $this->vehicule = $tableauBD['vehiculePublication'];
            $this->description = $tableauBD['descriptionPublication'];
            $this->codePostal = $tableauBD['codePostalPublication'];
            $this->direction = $tableauBD['directionPublication'];
            $this->utilisateur = $tableauBD['utilisateurPublication'];
			$this->date = $tableauBD['datePublication'];
            $this->heure = $tableauBD['heurePublication'];
        }

        public function jsonSerialize(){
            return[
                'id' => $this->getId(),
                'college' => $this->getCollege(),
                'telephone' => $this->getTelephone(),
                'vehicule' => $this->getVehicule(),
                'description' => $this->getDescription(),
                'codePostal' => $this->getCodePostal(),
                'direction' => $this->getDirection(),
                'utilisateur' => $this->getUtilisateur(),
				'date' => $this->getDate(),
				'heure' => $this->getHeure()
            ];
        }
    }

?>