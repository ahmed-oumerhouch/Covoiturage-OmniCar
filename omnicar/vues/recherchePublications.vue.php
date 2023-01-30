<?php
    require_once('./modeles/classes/ConvertDateTime.php');

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
            <img src="./image/avatar.png" width="30" height="30">
            <p style= "margin-bottom:  35px;" ><?=$utilisateur->getNom().",".$utilisateur->getPrenom();?></p>
            <img src="./image/car.png" width="30" height="30">
            <p style= "margin-bottom:  35px;"><?=$p->getVehicule();?></p>
            <img src="./image/home.png" width="30" height="30">
            <p style= "margin-bottom:  35px;"><?=$p->getDescription();?></p>
            <img src="./image/telephone.png" width="30" height="30">
            <p style= "margin-bottom:  35px;"><?=$p->getTelephone();?></p>   
            <img src="./image/direction.png" width="35" height="35">  
            <p style= "margin-bottom:  35px;"><?=$p->getDirection();?></p>  

           
            <form name="testForm" id="testForm"  method="POST"  >
                <input name="woo" id="woo" type="hidden" value="<?= $utilisateur->getId(); ?>">
                <input name="wooo" id="wooo" type="hidden" value="<?= $p->getDirection(); ?>">
                <input name="woooo" id="woooo" type="hidden" value="<?= $p->getCollege(); ?>">
            <button  type="submit" name="btn" value="submit" autofocus  onclick=" return true;" style="width:auto;">Envoyer un message</button>
            </form> 

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

<?PHP
if(isset($_POST['btn'])){
          $k =  $_POST['woo'];
          $ko =  $_POST['wooo'];
          $koo =  $_POST['woooo'];
          echo '<div id="id03" class="modal3">
          <form class="modal3-content animate"  method="post">
          <h1 style="padding-left:2%;">Message</h1>
          <input name="idutilisateur" id="idutilisateur" type="hidden" value="'.$k.'">
          <input name="directiontitre" id="directiontitre" type="hidden" value="'.$ko.'">
          <input name="collegetitre" id="collegetitre" type="hidden" value="'.$koo.'">
          </br>
          <div style="padding-left:2%;padding-right:2%;"> 
          <table>
          <tr>
            <td style="width:100%; height: 90px;">
               <textarea placeholder="" name="msg" required style="width:100%; height: 90px;"></textarea>
            </td>
            <td>
               <button type="submit" name="action" value="acceuilEnvoyerMessage" >Envoyer <i class="fa fa-paper-plane-o"></i></button>
            </td>
          </tr>
           </table>
           </div>
          </br>
           </br></br></br>
           </form>

          </div>';
          

}
      if(ISSET($_SESSION['MessageRedirection'])){
        echo "<script>alert(".$_SESSION['MessageRedirection'].")</script>";
        UNSET($_SESSION['MessageRedirection']);
      }


    ?>
 