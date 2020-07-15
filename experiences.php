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
      
        $reponse = $pdo->query('SELECT * FROM experience order by date_debut');
    }
    else{
        header('Location: index.php');
    }
       
       
    ?>
    <a title="ajout" href="ajoutexperience.php">Ajouter une expérience</a>
    <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">Société</th>
            <th scope="col">Date début</th>
            <th scope="col">Date fin</th>
            <th scope="col">Description</th>
            </tr>
        </thead>
         <tbody>

         <?php
            
            while ($data = $reponse->fetch())
            {
            ?>
            <tr>
            <td><?php echo($data['titre']); ?></td>
            <td><?php echo(date("d-m-Y",strtotime($data['date_debut']))); ?></td>

            <?php
                $datefinformat = $data['date_fin'];	
                $datefinformat = $datefinformat ? date("d/m/Y", strtotime($datefinformat)) : 'jj/mm/aaaa';
            ?>
            <td><?php echo($datefinformat); ?></td>
            <td><?php echo($data['description']); ?></td>
              
            <td>
            <a title="Editer" href="modifexperience.php?id=<?php echo($data['id']); ?>">Modifier</a> 
            </td> 

            <td>    
            <a title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette expérience ?') "href="supprexperience.php?id=<?php echo($data['id']); ?>">supprimer</a>
            </td> 

            <?php    
             }
             $reponse->closeCursor();
             ?>
        </tbody>
    </table>




</body>
</html>