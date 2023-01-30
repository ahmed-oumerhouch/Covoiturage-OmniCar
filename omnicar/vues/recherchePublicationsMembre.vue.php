<?php
    require_once('./modeles/classes/ConvertDateTime.php');
    require_once('./modeles/classes/ConvertCodePostale.php');
    
    if(!ISSET($_SESSION))
	    session_start();
    if(!ISSET($_SESSION['membre']) || !ISSET($_SESSION['listePublications'])){
        /* Rien à faire */
    }else if(sizeof($_SESSION['listePublications']) == 0){
        echo  "<script>document.getElementById('boiteMessagePublication').innerHTML = 'Aucun résultat trouvé'</script>";
    }else{
      echo  "<script>document.getElementById('boiteMessagePublication').innerHTML = ''</script>";
      foreach($_SESSION['listePublications'] as $p){
        $utilisateur = UtilisateurDAO::trouverParIdAvecOBJ($p->getUtilisateur());
?>
        <div class="card">
            <div>
            <?php
              for($i=0;$i < 5;$i++){
                if($i < $utilisateur->getNote()){
                  echo '<img src="./image/star.png" width="10" height="10"> ';
                }else{
                  echo '<img src="./image/star_vide.png" width="10" height="10"> ';
                }
              }
               
?>
            </div>
            </br>
            
            <p id="A1" style= "margin-bottom:  35px;"><?=$p->getDate();?> | <?=ConvertDateTime::formatHeure($p->getHeure()) ;?></p>
            <img src="./image/car.png" width="30" height="30">
               <p id="A1" style= "margin-bottom:  35px;"><?=$p->getVehicule();?></p>
            <img src="./image/home.png" width="30" height="30">
                <p id="A2"style= "margin-bottom:  35px;"><?=$p->getDescription();?></p>
            <img src="./image/letter.png" width="30" height="30">
                <p id="A2"style= "margin-bottom:  35px;"><?=ConvertCodePostale::formatCode($p->getCodePostal()) ;?></p>
            <img src="./image/telephone.png" width="30" height="30">
               <p id="A4"style= "margin-bottom:  35px;"><?=$p->getTelephone();?></p>   
            <img src="./image/direction.png" width="35" height="35">  
               <p style= "margin-bottom:  35px;"><?=$p->getDirection();?></p>   
            <button onclick="AfficherMAJ(<?=$p->getId();?>); afficherInfos();" style="width:auto;">Mise à jour</button>
          </div>
<?PHP
      }
      UNSET($_SESSION['listePublications']);
      if(ISSET($_SESSION['msg'])){
        echo "<script>alert(".$_SESSION['msg'].")</script>";
        UNSET($_SESSION['msg']);
      }
    }
?>