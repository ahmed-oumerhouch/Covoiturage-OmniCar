<?php
    class Utilisateur implements JsonSerializable{
        private $id;
        private $nom;
        private $prenom;
        private $courriel;
        private $telephone;
        private $type;
        private $note;
        private $description;
        private $vehicule;
        private $motDePasse;
        private $image;
        private $adresse;
        private $codePostal;

        public function getId(){ return $this->id; }
        public function getNom(){ return $this->nom; }
        public function getPrenom(){ return $this->prenom; }
        public function getCourriel(){ return $this->courriel; }
        public function getTelephone(){ return $this->telephone; }
        public function getType(){ return $this->type; }
        public function getNote(){ return $this->note; }
        public function getDescription(){ return $this->description; }
        public function getVehicule(){ return $this->vehicule; }
        public function getMotDePasse(){ return $this->motDePasse; }
        public function getImage(){ return $this->image; }
        public function getAdresse(){ return $this->adresse; }
        public function getCodePostal(){ return $this->codePostal; }

        public function setId($id){ $this->id = $id; }
        public function setNom($n){ $this->nom = $n; }
        public function setPrenom($p){ $this->prenom = $p; }
        public function setCourriel($c){ $this->courriel = $c; }
        public function setTelephone($t){ $this->telephone = $t; }
        public function setType($t){ $this->type = $t; }
        public function setNote($n){ $this->note = $n; }
        public function setDescription($d){ $this->description = $d; }
        public function setVehicule($v){ $this->vehicule = $v; }
        public function setMotDePasse($mdp){ $this->motDePasse = $mdp; }
        public function setImage($i){ $this->image = $i; }
        public function setAdresse($d){ $this->adresse = $d; }
        public function setCodePostal($cp){ $this->codePostal = $cp; }

        public function chargerObjetBD($objetBD){
            $this->id = $objetBD->IDUtilisateur;
            $this->nom = $objetBD->nomUtilisateur;
            $this->prenom = $objetBD->prenomUtilisateur;
            $this->courriel = $objetBD->courrielUtilisateur;
            $this->telephone = $objetBD->telephoneUtilisateur;
            $this->type = $objetBD->typeUtilisateur;
            $this->note = $objetBD->noteUtilisateur;
            $this->description = $objetBD->descriptionUtilisateur;
            $this->vehicule = $objetBD->vehiculeUtilisateur;
            $this->motDePasse = $objetBD->motDePasseUtilisateur;
            $this->image = $objetBD->imageUtilisateur;
            $this->adresse = $objetBD->adresseUtilisateur;
            $this->codePostal = $objetBD->codePostalUtilisateur;
        }

        public function chargerTableauBD($tableauBD){
            $this->id = $tableauBD['IDUtilisateur'];
            $this->nom = $tableauBD['nomUtilisateur'];
            $this->prenom = $tableauBD['prenomUtilisateur'];
            $this->courriel = $tableauBD['courrielUtilisateur'];
            $this->telephone = $tableauBD['telephoneUtilisateur'];
            $this->type = $tableauBD['typeUtilisateur'];
            $this->note = $tableauBD['noteUtilisateur'];
            $this->description = $tableauBD['descriptionUtilisateur'];
            $this->vehicule = $tableauBD['vehiculeUtilisateur'];
            $this->motDePasse = $tableauBD['motDePasseUtilisateur'];
            $this->image = $tableauBD['imageUtilisateur'];
            $this->adresse = $tableauBD['adresseUtilisateur'];
            $this->codePostal = $tableauBD['codePostalUtilisateur'];
        }

        public function jsonSerialize(){
            return[
                'id' => $this->getId(),
                'nom' => $this->getNom(),
                'prenom' => $this->getPrenom(),
                'courriel' => $this->getCourriel(),
                'telephone' => $this->getTelephone(),
                'type' => $this->getType(),
                'note' => $this->getNote(),
                'description' => $this->getDescription(),
                'vehicule' => $this->getVehicule(),
                /*'motDePasse' => $this->getMotDePasse(),*/
                'image' => $this->getImage(),
                'adresse' => $this->getAdresse(),
                'codePostal' => $this->getCodePostal()
            ];
        }
    }

?>