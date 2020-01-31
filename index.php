<?php 

require './inc/functions.php';


session_start();

//var_dump($_SESSION);
//initialise le cookie  ou recupere les données de l'utilisateur connecté
//startSessionSystem();

// MON CODE MES TRAITEMENTS
// mon formulaire est envoyé en POST , je dois verifie dans un premier si le formulaire a au moins été soumis avant de commencer mon traitement
if(isset($_POST['username']) && isset($_POST['password'])){

   //je ne recupere mes utilisateurs que si j'ai envoyé le formulaire
   require_once './inc/users.php';

   $username = $_POST['username'];
   $password = $_POST['password'];
   $isValid = false;

   // permet de verifier si une clef existe dans le tableau => param la clef a chercher , et le tableau dans lequel chercher
   if(array_key_exists($username, $users) ){

      //je recupere le mot de passe du tableau user que je vais devoir comparer avec celui que je viens de saisir
      $currentUser = $users[$username]; // ex $users['Arthur'] => retourne le tableau des information d'arthur

      $currentUserPassword = $currentUser['pass'];

      /*
       J'utilise password verify qui est specifique à la verification de mot de passe
       actuellement mon mot de passe n'est pas chiffré mais dans le futur si j'ai une application plus securisé cela pourrait etre le cas.

       de ce fait password_verify se charge de verifier la correspondance entre un mot de passe saisi en clair et un mot de passe stocké chiffré (encrypté - eng)
       
       il existe actuellement plusieurs methode / algorithmes de chiffrage sur le marché mais le dernier et le plus securitaire est toujours celui a employer. 

       Actuellement BCrypt est utilisé mais la nouvelle tendance à utiliser va etre argon2i  

       site pour encrypter une chaine en argon online : https://argon2-generator.com/

       lien pour chiffré une chaine + la liste des mode supporté par php : https://www.php.net/manual/fr/function.password-hash.php
    */

      //avant de verifier mon mot de passe il faut que je le chiffre pour que password_verify puisse verifier quelque chose qu'il connait : bcrypt , argon2i ou autre. cela n'est pas possible avec nos chaine en "clair" (non chiffrées actuelles)
      // password_hash fonctionne comme ceci : je passe ma chaine en clair a verifier puis je passe la chaine valide qui sera elle hashée / chiffrée
      $encryptedStoredPassword = password_hash($currentUserPassword , PASSWORD_DEFAULT);
      
      if(password_verify($password , $encryptedStoredPassword)){ // param 1 mdp saisi en clair , param 2 param stocké et chiffré
         
         //changement d'etat de la validité de mon authentification
         $isValid = true;
      } 
   }
   
   if($isValid){ //si ok je redirige + cookie

      //culture G : permet de modifier le status code initialement en 200 en 301 / 302 qui force le navigateur a rediriger
      //location est obligatoire pour indiquer le fichier vers lequel on souhaite rediriger
      /*
       je stocke la clef de mon tableau users dans mes cookies 
      cela va me permettre a terme de recuperer mes données du tableau users comme ceci $users[$_COOKIE['user']]
      */
      setcookie('user' , $username); 
      //setDataToSessionSystem('username', $username);
      //setDataToSessionSystem('role', $users[$username]['data']['role']);

      header('Location:home.php');

   } else { //sinon je me suis trompée sur le nom d'utilisateur OU le mot de passe

      $errorMessage = 'Mot de passe et/ou idenfiant invalide';

   }

}

/*
 Il existe 4 types d'inclusions 

 require
    => va chercher la ressources si elle n'existe pas 
    => erreur fatale  
    => indique que mon application requiere obligatoirement ce fichier pour fonctionner

 include
    => va chercher la ressources et si elle n'existe pas 
    => notifie l'utilisateur qu'il ne la pas trouvé 
    => indique que mon application veux inclure cette ressource si trouvée

 require_once
    => idem que requiere mais si je l'inclue 2 fois par erreur  , une inclusion sera faite au final

 include_once
    => idem que include + comportement que require_once 
*/

//GESTION DE L'AFFICHAGE
// DIR nous permet de sous situer directement a la racine de notre projet
// Rappel : contrairement à JS , PHP utilise des . pour concatener :'(
// Rappel : $promo = titan; echo 'Youpi $promo' = Youpi $promo
// Rappel : $promo = titan; echo "Youpi $promo" => Youpi titan  
  
require_once  __DIR__ .'/templates/header.tpl.php';
require_once __DIR__ . '/templates/login-form.tpl.php';
require_once __DIR__ . '/templates/footer.tpl.php';