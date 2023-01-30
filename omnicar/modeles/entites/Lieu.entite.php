<?php
    class Lieu implements JsonSerializable{
        private $id;
        private $numCivique;
        private $appartement;
        private $rue;
        private $ville;
        private $province;
        private $pays;
        private $description;
        private $coordonnees;
        private $image;

        public function getId(){ return $this->id; }
        public function getNumCivique(){ return $this->numCivique; }
        public function getAppartement(){ return $this->appartement; }
        public function getRue(){ return $this->rue; }
        public function getVille(){ return $this->ville; }
        public function getProvince(){ return $this->province; }
        public function getPays(){ return $this->pays; }
        public function getDescription(){ return $this->description; }
        public function getCoordonnees(){ return $this->coordonnees; }
        public function getImage(){ return $this->image; }

        function setId($id){ $this->id = $id; }
        function setNumCivique($nc){ $this->numCivique = $nc; }
        function setAppartement($nc){ $this->appartement = $nc; }
        function setRue($r){ $this->rue = $r; }
        function setVille($v){ $this->ville = $v; }
        function setProvince($p){ $this->province = $p; }
        function setPays($p){ $this->pays = $p; }
        function setDescription($d){ $this->description = $d; }
        function setCoordonnees($c){ $this->coordonnees = $c; }
        function setImage($i){ $this->image = $i; }

        public function chargerObjetBD($objetBD){
            $this->id = $objetBD->IDLieu;
            $this->numCivique = $objetBD->numCiviqueLieu;
            $this->appartement = $objetBD->appartementLieu;
            $this->rue = $objetBD->rueLieu;
            $this->ville = $objetBD->villeLieu;
            $this->province = $objetBD->provinceLieu;
            $this->pays = $objetBD->paysLieu;
            $this->description = $objetBD->descriptionLieu;
            $this->coordonnees = $objetBD->coordonneesLieu;
            $this->image = $objetBD->imageLieu;
            
        }

        public function chargerTableauBD($tableauBD){
            $this->id = $tableauBD['IDLieu'];
            $this->numCivique = $tableauBD['numCiviqueLieu'];
            $this->appartement = $tableauBD['appatementLieu'];
            $this->rue = $tableauBD['rueLieu'];
            $this->ville = $tableauBD['villeLieu'];
            $this->province = $tableauBD['provinceLieu'];
            $this->pays = $tableauBD['paysLieu'];
            $this->description = $tableauBD['descriptionLieu'];
            $this->coordonnees = $tableauBD['coordonneesLieu'];
            $this->image = $tableauBD['imageLieu'];
            
        }

        public function jsonSerialize(){
            return[
                'id' => $this->getId(),
                'numCivique' => $this->getNumCivique(),
                'appartement' => $this->getAppartement(),
                'rue' => $this->getRue(),
                'ville' => $this->getVille(),
                'province' => $this->getProvince(),
                'pays' => $this->getPays(),
                'description' => $this->getDescription(),
                'coordonnees' => $this->getCoordonnes(),
                'image' => $this->getImage()
            ];
        }
    }
?>