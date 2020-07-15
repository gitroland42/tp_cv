<?php
    session_start();
    require_once("utilitaires/header.php");
    require_once("utilitaires/connexionBDD.php");
    require_once("utilitaires/fonctions.php");
    $errors=[];
    $date = new DateTime();
    
?>
<div class="col-md-6">
    <div class="card text-light border-light p-5" style="height: auto; background-color: #1e1d1d">
    <form id="center" method="post" action="ajoutexperience.php" enctype="multipart/form-data">

        
        <label for="titre">Nom société  ?</label>
        <input type="text" class="form-control" id="titre" name="titre" required >
        <br>
        
        <label for="date_debut">Date début ?</label>
       
        <input type="date" class="form-control" id="date_debut" name="date_debut" required value="<?php echo(date('Y-m-d'));?>">
        <br>
    
        <label for="date_fin">Date fin ?</label>
        <input type="date" class="form-control" id="date_debut" name="date_fin" >
        <br>

        <label for="description">Description  ?</label>
        <input type="text" class="form-control" id="description" name="description" required>
        <br>

        <input type="submit">
        <?php
        
        if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
            $returnValidation = testErreursAjoutexperience($pdo); 
            
            $errors = $returnValidation['errors'];
            if( count($errors) === 0) {
                ajoutexperience($pdo);
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
