<?php 

// pour activer le tableau global de session et l'enregistrer du fichier de stockage coté apache

session_start();

// maintenant j'ai acces à un tableau superglobal que je peux recuperer de n'importe ou tres utile pour stocker des données globale a l'application et notamment les données de l'utilisateur connecté
// c'est apache qui s'occupe de securiser et stocker ces données
$_SESSION['variableDeTestGlobale'] = 'Titan'; //doit etre créé une premiere fois puis ensuite peux etre recupérer de partout
var_dump($_SESSION['variableDeTestGlobale']);
/*
 Lorsque j'utilise les sessions il faut
 
 - en premier lieu les activer grace a session start
 - donc la premiere ligne de code que mon application doit avoir c'est session_start()
 - session_start() permet de creer automatiquement le cookie PHPSESSID => on a plus a s'en occuper
 - je stocke une seule fois ma mariable dans mon tableau . Note si je commente ensuite mon ajout j'y ai quand meme acces vu que l'on recupere la données stocké dans le fichier par apache
 - si je veux redemarrer avec une session toute propre => je nettoie mes cookies
 car le navigateur perd la clef / le nom du fichier et apache ne peux pas nous le retransmettre

*/