
<?php

    function verif_compte($pdo){

    $query = $pdo->prepare('SELECT nom,prenom FROM user WHERE email = :email and mot_de_passe= :mot_de_passe');

    $query->execute([
        'email' => $_POST['email'],
        'mot_de_passe' =>md5($_POST['mot_de_passe'])
    ]);

    $fetchRes = $query->fetch();

    return $fetchRes;

    }


    // COMPETENCE 

    function competenceunique($pdo,$titre){
        $query = $pdo->prepare('SELECT * FROM competence WHERE titre = :titre');
       
        $query->execute([
            'titre' => $titre
            
        ]);

        $fetchRes = $query->fetch();
        return($fetchRes);
    }

   
    // mode=0 on est en creation test unicite titre competence
    // mode=1 on est modif pas de test unicite sur le titre
    function testErreursAjoutcompetence($pdo,$mode=0){
      
        $errors=[];
       
        
        if($mode==0){
            if(competenceunique($pdo,$_POST['titre'])!==false){
                $errors[]="erreur nom compétence existante";
            }
      
    
            if (empty($_POST['titre'])) {
                $errors[]="erreur: nom compétence obligatoire";
            } 
        }


        if (empty($_POST['note'])) {
            $errors[]="erreur: note obligatoire";
          } 
          else{
              if($_POST['note']<1 || $_POST['note']>5){
                $errors[]="erreur: la note doit etre comprise entre 1 et 5"; 
              }
          }
              
        
        return ['errors'=>$errors];
    }


    function ajoutcompetence($pdo){

        $req = $pdo->prepare(
        'INSERT INTO competence(titre, note)
        VALUES(:titre, :note)');
        $req->execute([
        'titre' => $_POST['titre'],
        'note' => $_POST['note'],
               
        ]);
        
    }


    function recherche_competenceID($pdo,$competenceid){

        $query = $pdo->prepare('SELECT * FROM competence WHERE id = :idcompetence');
       
        $query->execute([
            'idcompetence' => $competenceid
            
        ]);

        $fetchRes = $query->fetch();
        return($fetchRes);

    }

// seule la note peut etre modifiee
    function modifcompetence($pdo,$id){
       
        $req = $pdo->prepare('UPDATE competence SET note = :note WHERE id = :id');
        $req->execute([
        'note' => $_POST['note'],
        'id'=> $id
        ]);

    }

   




     // EXPERIENCE

     function experienceunique($pdo,$titre){
        $query = $pdo->prepare('SELECT * FROM experience WHERE titre = :titre');
       
        $query->execute([
            'titre' => $titre
            
        ]);

        $fetchRes = $query->fetch();
        return($fetchRes);
    }

   
    // mode=0 on est en creation test unicite titre competence
    // mode=1 on est modif pas de test unicite sur le titre
    function testErreursAjoutexperience($pdo,$mode=0){
      
        $errors=[];
       
        
        if($mode==0){
            if(experienceunique($pdo,$_POST['titre'])!==false){
                $errors[]="erreur nom compétence existante";
            }
      
    
            if (empty($_POST['titre'])) {
                $errors[]="erreur: nom compétence obligatoire";
            } 
        }


        if (empty($_POST['date_debut'])) {
            $errors[]="erreur: date début obligatoire";
          } 
        
        if (empty($_POST['description'])) {
            $errors[]="erreur: description obligatoire";
          }     
        
        if (!empty($_POST['date_debut']) && !empty($_POST['date_fin'])) {
            if($_POST['date_fin']<$_POST['date_debut']){
                $errors[]="erreur: la date de fin ne peut être anterieure à la date de début";
            }

         

          }
        return ['errors'=>$errors];
    }


    function ajoutexperience($pdo){
        $datefin=NULL;
        if(empty($_POST['date_fin'])) {
           $datefin=NULL;
          } 
        else{
            $datefin=$_POST['date_fin'];
        }

        $req = $pdo->prepare(
        'INSERT INTO experience(titre, date_debut, date_fin, description)
        VALUES(:titre, :date_debut, :date_fin, :description)');
        $req->execute([
        'titre' => $_POST['titre'],
        'date_debut' => $_POST['date_debut'],
        'date_fin' => $datefin,       
        'description' => $_POST['description']
        ]);
        
    }


    function recherche_experienceID($pdo,$experienceid){

        $query = $pdo->prepare('SELECT * FROM experience WHERE id = :idexperience');
       
        $query->execute([
            'idexperience' => $experienceid
            
        ]);

        $fetchRes = $query->fetch();
        return($fetchRes);

    }


    // letitre ne peut être modifie
    function modifexperience($pdo,$id){
        $datefin=NULL;
        if(empty($_POST['date_fin'])) {
           $datefin=NULL;
          } 
        else{
            $datefin=$_POST['date_fin'];
        }
        $req = $pdo->prepare('UPDATE experience SET date_debut = :date_debut, date_fin = :date_fin, description = :description WHERE id = :id');
        $req->execute([
        'date_debut' => $_POST['date_debut'],
        'date_fin' => $datefin,
        'description' => $_POST['description'],
        'id'=> $id
        ]);

    }

?>