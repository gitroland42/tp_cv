<?php
    session_start();
    require_once("utilitaires/header.php");
    require_once("utilitaires/connexionBDD.php");
    require_once("utilitaires/fonctions.php");
    
?>


<!DOCTYPE html>
<html lang="fr">

<body>
  
    <?php
        
        if(isset($_SESSION['nomconnecte'])){
            ?>  
            <p><?php echo("Bonjour ".$_SESSION['nomconnecte'].' vous êtes sur mon CV');?></p>            
            <?php
        }

    ?>
   
   <!-- Begin Wrapper -->
<div id="wrapper">
  <!-- <div class="wrapper-top"></div> -->
  <div class="wrapper-mid">
    <!-- Begin Paper -->
    <div id="paper">
      <div class="paper-top"></div>
      <div id="paper-mid">
        <div class="entry">
         
          <div class="self">
            <h1 class="name">Roland CORNET <br />
              <span>Développeur Web/Web mobile</span></h1>
            <ul>
              <li class="ad">1030 Route de Batizols</li>
              <li class="ad">42380 St Nizier de Fornas</li>
              <li class="mail">cornet.roland@wanadoo.fr</li>
           
            </ul>
          </div>
         
         
        <div class="entry">
          <h2>EXPERIENCES</h2>
          <div class="content">
           
            <?php
            
                $reponse = $pdo->query('SELECT * FROM experience order by date_debut');
                while ($data = $reponse->fetch())
                {
                ?>
                <h3><?php
                    if(!empty($data['date_fin'])){
                         echo(date("d-m-Y",strtotime($data['date_debut'])) .' - '.date("d-m-Y",strtotime($data['date_fin'])));
                    }
                    else
                    {
                        echo(date("d-m-Y",strtotime($data['date_debut'])));
                    }

                  
                
                ?>
                </h3>
                    <p><?php
                        echo($data['titre']);
                    ?>
                    <br />
                    <p><?php
                        echo($data['description']);
                    ?>

                    <br /><br />
                <?php
                }
                ?>
            
          </div>
    
        </div>


        <div class="entry">
          <h2>COMPETENCES</h2>
          <div class="content">
           
            <?php
            
                $reponse = $pdo->query('SELECT * FROM competence order by note desc');
                while ($data = $reponse->fetch())
                {
                ?>
               
                <p><?php
                        echo($data['titre']);
                
                        for($i = 0; $i<$data['note']; $i++){
                    ?>
                        <img height="25" width="30" src="<?php echo('images/etoile.jpg'); ?>"/>
                            <?php
                        }
                    ?>
                    </p>
                    <br /><br />
                <?php
                }
                ?>
            
          </div>

          <div class="entry">
             <h2>LOISIRS</h2>
                <div class="content">
                   <p>Course à pied - Trail</p>
                   <p>Badminton</p>
                </div>
            </div>    
    
        </div>

  

</body>
</html>