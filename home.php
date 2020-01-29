<?php
// traitement + initialisation des variables necessaires aux templates

require_once './inc/users.php';

//je recupere la données de mon cookie créée dans index.php
// cela me permet via le tableau users de recuperer l'utilisateur en cours
$username = $_COOKIE['user']; //je recupere d'abord le nom
$connectedUser = $users[$username]; // et ses info associées (si je ne fais que cette etape je perd l'information du nom)

require_once  __DIR__ .'/templates/header.tpl.php';
require_once __DIR__ . '/templates/home.tpl.php';
require_once __DIR__ . '/templates/footer.tpl.php';