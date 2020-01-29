<?php

$users = [
  "Arthur" => [
    "pass" => 'kaamelott', //ici pour faire au mieux, on pourrait directement avoir des chaines chiffrés pour d'eviter le chiffrage a faire dans la verification de mot de passe
    "data" => [
      "role" => 'Roi de Bretagne',
      "age" => 37,
      "gimmick" => 'à la volette'
    ]
  ],
  "Perceval" => [
    "pass" => 'pas faux',
    "data" => [
      "role" => 'Chevalier',
      "age" => 39,
      "gimmick" => 'Provencal le Gaulois'
    ]
  ],
  "Lancelot" => [
    "pass" => 'Guenièvre',
    "data" => [
      "role" => 'Bras droit',
      "age" => 35,
      "gimmick" => 'Je me réserve pour le grand amour'
    ]
  ],
];