<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>oLogin</title>
  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <div id="app">
    <header id="header">
      <h1 id="app-title"><a href="#">oLogin</a></h1>
      <nav id="nav">
        <a href="./">Accueil</a>
        <a href="#">Profil</a>
        <a href="#">À propos</a>
        <a href="#">FAQ</a>
        <a href="#">Contact</a>

        <?php if (isset($_COOKIE['user'])) :  ?>
          <a href="logout.php">Déconnexion</a>
        <?php else:  ?>
          <a href="index.php">Connexion</a>
        <?php endif;  ?>
      </nav>
    </header>