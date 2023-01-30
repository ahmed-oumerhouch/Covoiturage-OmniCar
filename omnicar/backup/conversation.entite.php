<?php

    class Conversation implements JsonSerializable{
        private $id;
        private $dateDebut;
        private $dateFin;
        private $heureDebut;
        private $heureFin;

        public function getId() { return $this->id; }
        public function getDateDebut() { return $this->dateDebut; }
        public function getHeureDebut() { return $this->heureDebut; }
        public function getDateFin() { return $this->dateFin; }
        public function getHeureFin() { return $this->heureFin; }

        public function setId($id){ $this->id = $id; }
        public function setDateDebut($dd){ $this->dateDebut = $dd; }
        public function setDateFin($df){ $this->dateFin = $df; }
        public function setHeureDebut($hd){ $this->heureDebut = $hd; }
        public function setHeureFin($hf){ $this->heureFin = $hf; }

        public function chargerObjetBD($objetBD){
            $this->id = $objetBD->IDConversation;
            $this->dateDebut = $objetBD->dateDebutConversation;
            $this->dateFin = $objetBD->dateFinConversation;
            $this->heureDebut = $objetBD->heureDebutConversation;
            $this->heureFin = $objetBD->heureFinConversation;
        }

        public function jsonSerialize(){
            return[
                'id' => $this->getId(),
                'dateDebut' => $this->getDateDebut(),
                'dateFin' => $this->getDateFin(),
                'heureDebut' => $this->getHeureDebut(),
                'heureFin' => $this->getHeureFin()
            ];
        }
    }

?>