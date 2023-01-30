<?php

    class Message implements JsonSerializable{
        private $id;
        private $titre;
        private $contenu;
        private $type;
        private $date;
        private $heure;
        private $destinataire;
        private $provenance;

        public function getId() { return $this->id; }
        public function getTitre() { return $this->titre; }
        public function getContenu() { return $this->contenu; }
        public function getType() { return $this->type; }
        public function getDate() { return $this->date; }
        public function getHeure() { return $this->heure; }
        public function getDestinataire() { return $this->destinataire; }
        public function getProvenance() { return $this->provenance; }

        public function setId($id){ $this->id = $id; }
        public function setTitre($t){ $this->titre = $t; }
        public function setContenu($c){ $this->contenu = $c; }
        public function setType($t){ $this->type = $t; }
        public function setDate($d){ $this->date = $d; }
        public function setHeure($h){ $this->heure = $h; }
        public function setDestinataire($d){ $this->destinataire = $d; }
        public function setProvenance($p){ $this->provenance = $p; }

        public function chargerObjetBD($objetBD){
            $this->id = $objetBD->IDMessage;
            $this->titre = $objetBD->titreMessage;
            $this->contenu = $objetBD->contenuMessage;
            $this->type = $objetBD->typeMessage;
            $this->date = $objetBD->dateMessage;
			$this->heure = $objetBD->heureMessage;
            $this->provenance = $objetBD->destinataireMessage;
            $this->destinataire = $objetBD->provenanceMessage;
			
        }

        public function jsonSerialize(){
            return[
                'id' => $this->getId(),
                'titre' => $this->getTitre(),
                'contenu' => $this->getContenu(),
                'type' => $this->getType(),
                'date' => $this->getDate(),
				'heure' => $this->getHeure(),
                'destinataire' => $this->getDestinataire(),
                'provenance' => $this->getProvenance()
            ];
        }
    }

?>