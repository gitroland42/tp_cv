
<?php
    session_start();
    require_once("utilitaires/header.php");
    require_once("utilitaires/connexionBDD.php");
    require_once("utilitaires/fonctions.php");
    $errors=[];

    $idExperience = $_GET['id'];    
    $experience = recherche_experienceID($pdo, $idExperience);
?>

<div class="col-md-6">
    <div class="card text-light border-light p-5" style="height: auto; background-color: #1e1d1d">
    <form id="center" method="post" action="modifexperience.php?id=<?php echo($idExperience);?>" enctype="multipart/form-data">

        
        <label for="titre">Nom société ?</label>
        <input type="text" disabled class="form-control" id="titre" name="titre" required value="<?php echo($experience['titre']) ?>">
        <br>
        
        <label for="date_debut">Date début ?</label>
        <input type="date" class="form-control" id="date_debut" name="date_debut" required value="<?php echo($experience['date_debut']);?>">
         <br>
   
       <label for="date_fin">Date fin ?</label>
       <input type="date" class="form-control" id="date_debut" name="date_fin" value="<?php echo($experience['date_fin']);?>" >
       <br>

       <label for="description">Description  ?</label>
       <input type="text" class="form-control" id="description" name="description" required value="<?php echo($experience['description']);?>">
       <br>

        <input type="submit">
        <?php
        
        if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
            $returnValidation = testErreursAjoutexperience($pdo,1); 
            
            $errors = $returnValidation['errors'];
            if( count($errors) === 0) {
                modifexperience($pdo,$idExperience );
                header('Location: experiences.php');
            }
            

            if(count( $errors) != 0){
            
            foreach ( $errors as $error){
            echo('<div class="error">'.$error.'</div>');
            }
            }
        }
        ?>

    </form>
    </div>
</div>
