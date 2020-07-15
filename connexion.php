<?php
    session_start(); // pour le login
    require_once("utilitaires/header.php");
    require_once("utilitaires/connexionBDD.php");
    require_once("utilitaires/fonctions.php");
    //$errors=0;

    if(isset($_SESSION['nomconnecte'])){
        session_destroy();
        header('Location: index.php');
        
    }
?>

<div class="col-md-6">
    <div class="card text-light border-light p-5" style="height: auto; background-color: #1e1d1d">
        <form id="center"  method="POST" action="connexion.php" enctype="multipart/form-data">

            <div class="form-group">
                <label for="pseudo">Mail</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe">
            </div>
           
            <button type="submit" class="btn btn-outline-success">Connexion</button>
            <?php
            
            if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
                $compteok = verif_compte($pdo); 
                         
                // $errors = 0 connexion ok , = 1 connexion echoué
                if($compteok === false) {
                    echo("Combinaison email/mot de passe invalide");
                 }
                 else{
                   
                    $_SESSION['nomconnecte']=$compteok["nom"];
                    $_SESSION['prenomconnecte']=$compteok["prenom"];
                    
                    header('Location: index.php');
                };
                

            }
            ?>
        </div>
        </form>
    </div>
</div>
        