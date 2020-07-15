
<?php
    session_start();
    require_once("utilitaires/header.php");
    require_once("utilitaires/connexionBDD.php");
    require_once("utilitaires/fonctions.php");
    $errors=[];

    $idCompetence = $_GET['id'];    
    $competence = recherche_competenceID($pdo, $idCompetence);
?>

<div class="col-md-6">
    <div class="card text-light border-light p-5" style="height: auto; background-color: #1e1d1d">
    <form id="center" method="post" action="modifcompetence.php?id=<?php echo($idCompetence);?>" enctype="multipart/form-data">

        
        <label for="titre">Nom compétence ?</label>
        <input type="text" disabled class="form-control" id="titre" name="titre" required value="<?php echo($competence['titre']) ?>">
        <br>
        
        <label for="note">Note sur 5 ?</label>
        <input type="number" class="form-control" id="note" name="note" required value="<?php echo($competence['note']) ?>" >
        <br>
    

        <input type="submit">
        <?php
        
        if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
            $returnValidation = testErreursAjoutcompetence($pdo,1); 
            
            $errors = $returnValidation['errors'];
            if( count($errors) === 0) {
                modifcompetence($pdo,$idCompetence );
                header('Location: competences.php');
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
