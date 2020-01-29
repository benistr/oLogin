<?php

// va permettre de generer un nom de fichier aleatoire et complexe (tentative d'etre unique)

function generateRandomId(){
    return md5(time().'monfichierdesession'.mt_rand(0,1000)); //chifre + rendre random le nom de fichier
}

// creer le fichier de session si il n'existe pas encore (utilisateur connecté)
// ou recupere les données du fichier de session
function startSessionSystem(){

    global $sessionData;

    $sessionData = [];

    //si ma session est pas vide alors je recupere les données du fichier
    if(!empty($_COOKIE['oSessionId'])){
        
        $serializedContent = file_get_contents('sessions/'.$_COOKIE['oSessionId'] );

        //serialisé à l'allée et deserialisée au retour
        $sessionData = unserialize($serializedContent);

    // sinon je vais devoir creer mon cookie avec mon nom de fichier pour reference
    } else {
        
        //ma session id va prendre un nom de fichier aleatoire
        $sessionId = generateRandomId();

        //je vais ensuite stocker uniquement ce nom de fichier dans mes cookie et non directement mes données
        setcookie('oSessionId', $sessionId);
    }

}


// 
function setDataToSessionSystem($key, $value){

    global $sessionData;

    $sessionData[$key] = $value;

    /*lorsque je veux enregistrer une données dans un fichier et notamment plusieurs données je n'utilise pas directement un tableau PHP.

    Ce que tout les autres logociel tier savent lire c'est les chaine de caractere.

    je vais donc convertir mon tableau PHP en chaine.

    il existe une fonction pour ceci : serialize.
    */

    $dataArrAyToString = serialize($sessionData);

    /*
     Fonction tres pratique lorsque l'on souhaite creer des fichiers avec PHP
     file_put_content permet de stocker des données et de creer le fichier en meme temps
    */
    file_put_contents('sessions/'.$_COOKIE['oSessionId'] , $dataArrAyToString );
}

//recupere les données de session
function getDataFromTheSessionSystem($key){

    global $sessionData;

    if( array_key_exists($key, $sessionData)){

        return $sessionData[$key];
    }

}

// DECONNEXION
function logout() {
    //lorsque je souhaite supprimer une clef d'un tableau + sa valeur = unset
    //je verifie avant de supprimer que cet element existe

    
    if(isset($_COOKIE['user'])) {

        //unset($_COOKIE['user']); //arraive a supprimer la valeur du tableau coté php mais pas du coté navigateur

        // on doit alors setter une valeur a vide pour notre cookie et lui indiquer une date d'expiration
        // ensuite le navigateur fera lui meme le travail de suppression du fichier
        // merci pierre <3
        setcookie('user', '', time() - 3600);
        //var_dump(isset($_COOKIE['user']));die;
        header('Location:index.php'); 
    }
}
