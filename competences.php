<?php
    session_start();
    require_once("utilitaires/connexionBDD.php");
    require_once("utilitaires/header.php");
    require_once("utilitaires/fonctions.php");
    
?>


<!DOCTYPE html>
<html lang="fr">

<body>
     
<?php
    
    if(isset($_SESSION['nomconnecte'])){
        
        $reponse = $pdo->query('SELECT *FROM competence');
    }
    else{
        header('Location: index.php');
    }
       
       
    ?>
    <a title="ajout" href="ajoutcompetence.php">Ajouter une compétence</a>
    <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">Nom comptétence</th>
            <th scope="col">Note</th>
            </tr>
        </thead>
         <tbody>

         <?php
            // var_dump($reponse->fetchAll());

            while ($data = $reponse->fetch())
            {
            ?>
            <tr>
            
            <td><?php echo($data['titre']); ?></td>

            <td>
            <?php
                for($i = 0; $i<$data['note']; $i++){
               ?>
                <img height="25" width="30" src="<?php echo('images/etoile.jpg'); ?>"/>
                    <?php
                }
            ?>
            </td>
           
            <td>    
            <a title="Editer" href="modifcompetence.php?id=<?php echo($data['id']); ?>">Modifier</a> 
            </td> 

            <td>    
            <a title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette compétence ?')" href="supprcompetence.php?id=<?php echo($data['id']); ?>">supprimer</a>
            </td> 

            <?php    
             }
             $reponse->closeCursor();
             ?>
        </tbody>
    </table>




</body>
</html>