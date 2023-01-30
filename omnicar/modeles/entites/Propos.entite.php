<?php

    class Propos implements JsonSerializable{
        private $id;
        private $contenu;
        private $date;
        private $heure;
        private $utilisateur;
        private $conversation;

        public function getId() { return $this->id; }
        public function getContenu() { return $this->contenu; }
        public function getDate() { return $this->date; }
        public function getHeure() { return $this->heure; }
        public function getUtilisateur() { return $this->utilisateur; }
        public function getConversation() { return $this->conversation; }

        public function setId($id){ $this->id = $id; }
        public function setContenu($c){ $this->contenu = $c; }
        public function setDate($d){ $this->date = $d; }
        public function setHeure($h){ $this->heure = $h; }
        public function setUtilisateur($u){ $this->utilisateur = $u; }
        public function setConversation($c){ $this->conversation = $c; }

        public function chargerObjetBD($objetBD){
            $this->id = $objetBD->IDPropos;
            $this->contenu = $objetBD->contenuPropos;
            $this->date = $objetBD->datePropos;
            $this->heure = $objetBD->heurePropos;
            $this->utilisateur = $objetBD->utilisateurPropos;
            $this->conversation = $objetBD->conversationPropos;
        }

        public function jsonSerialize(){
            return[
                'id' => $this->getId(),
                'contenu' => $this->getContenu(),
                'date' => $this->getDate(),
                'heure' => $this->getHeure(),
                'utilisateur' => $this->getUtilisateur(),
                'conversation' => $this->getConversation()
            ];
        }
    }

?>