 <?php
  $conn = mysqli_connect('localhost','root','','shop_db') or die('connection failed');
         ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tout parcourir</title>
</head>
<body>


<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="bx bx-x" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
?>


  <header>
      <h2 class="logo">
        Agora Francia
      </h2>
      <nav class="navigation">
            <a class="page" href="indexConnecte.html">Accueil</a>
            <a class="page" href="tout_parcourir_connecte.php" id="tout-parcourir-link" class="link">Tout parcourir</a>
            <a class="page" href="presentation_connecte.html">A propos de nous</a>
            <a class="page" href="indexConnecte#pageContact">Contact</a>
            <div class="dropdown">
                  <button class="btn-user"><i class="bx bx-user"></i></button>
               <ul class="menu-deroulant">
                     <li><a class="page" href="moncompte.php">Mon compte</a></li>
                     <li><a class="page" href="mesArticles.php">Mes articles</a></li>
                     <li><a class="page" href="index.html">Déconnexion</a></li>
               </ul>
            </div>
            <a href="cart.php"><i class='bx bx-shopping-bag'></i></a>
            <button class="vendre"><a href="vendre.php">Vend tes articles</a></button>
            <div class="icon">
               <i class='bx bx-menu'></i>
            </div>
         </nav>
      <div id="product-list-container"></div>  
      <div id="retour-accueil-container"></div>
    </header>


<section class="display-product-table">
   <table>
      <thead>
         <th>Nom</th>
         <th>Numéro de téléphone</th>
         <th>Votre Email</th>
      </thead>
      <tbody>
         <?php
         
         // Vérification de la connexion
        
         
         // Requête pour récupérer les données de l'utilisateur
         $query = mysqli_query($conn, "SELECT * FROM `user`");
         
         // Vérification s'il y a des résultats
         if (mysqli_num_rows($query) > 0) {
            // Affichage des données dans le tableau
            while ($row = mysqli_fetch_assoc($query)) {
               echo '<tr>';
               echo '<td>' . $row['nom'] . '</td>';
               echo '<td>' . $row['tel'] . '</td>';
               echo '<td>' . $row['email'] . '</td>';
               echo '</tr>';
            }
         } else {
            echo '<tr><td colspan="3">Aucun utilisateur trouvé.</td></tr>';
         }
         
        
         ?>
      </tbody>
   </table>
</section>


<footer>
         <p>@Copyright </p>
      </footer>
      <script src="vendre.js"></script>
   </body>
   </html>