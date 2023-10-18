<?php 
 require '../config/database.php'; 
 require '../vendor/autoload.php'; 
  $faker = Faker\Factory::create(); 
  for ($i=1; $i <= 30 ; $i++) { 
  	 $q = $db->prepare('INSERT INTO utilisateurs(nom, prenom,sexe,pseudo, mot_de_passe,email, cin,pays,ville,acces) 
  	   VALUES(:nom, :prenom,:sexe,:pseudo, :mot_de_passe,:email, :cin,:pays,:ville,:acces)'); 
  	 $q->execute([ 
      'nom'=> $faker->unique()->firstName,
      'prenom'=>$faker->unique()->lastname,
      'sexe'=> $faker->randomElement(['masculin', 'feminin']),
      'pseudo'=> $faker->unique()->userName,
      'mot_de_passe'=> password_hash('123456', PASSWORD_BCRYPT),
      'email' => $faker->unique()->email,
      'cin'=>$faker->creditCardNumber,
      'pays' => $faker->country,
      'ville' =>$faker->city,
      'acces'=> 1
  	            ]); 
  	 $id = $db->lastInsertId(); 
  	  $q = $db->prepare("INSERT INTO entreprises(utilisateurs_id, nom_e, activite) 
  	   VALUES(:utilisateurs_id, :nom_e, :activite)"); 

  	    $q->execute([
          'utilisateurs_id'=>$id, 
          'nom_e'=>$faker->unique()->company, 
          'activite'=> $faker->paragraph() 
        ]); 

    $q = $db->prepare("INSERT INTO comptes(code, type, solde,numero_tel,utilisateurs_id) 
       VALUES(:code, :type, :solde,:numero_tel,:utilisateurs_id)"); 

        $q->execute([
          'code'=>$faker->unique()->creditCardNumber, 
          'type'=>$faker->randomElement(['om', 'mv','am','pp']), 
          'solde'=>1000000,
          'numero_tel'=>$faker->unique()->phoneNumber,
          'utilisateurs_id'=>$id 
        ]); 

  	     } 
  	     echo 'utilisateurs add added!!!';
