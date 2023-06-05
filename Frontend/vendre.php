<?php
$conn = mysqli_connect('localhost','root','','shop_db') or die('connection failed');

session_start();
$valeur = $_SESSION['ma_variable'];

if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_description = $_POST['p_description'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$p_image;


   $la_description = $p_description;
   $_SESSION['la_description'] = $la_description;

   $insert_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image, email, description) VALUES('$p_name', '$p_price', '$p_image', '$valeur','$p_description')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'Article ajouté avec succès';
   }else{
      $message[] = 'L\'article n\'a pas pu être ajouté';
   }
};




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

    
    <div class="pageVendre">
      <section class="sectionVendre">
        <form action="vendre.php" method="post" class="add-product-form" enctype="multipart/form-data">
          <h3>Ajouter un nouvel article</h3>
          <input type="text" name="p_name" placeholder="Nom de l'article" class="box" required >
          <input type="number" name="p_price" min="0" placeholder="Prix de l'article" class="box" required >
          <textarea name="p_description" placeholder="Ecrivez votre message ici..."></textarea>
          <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required >
          <input type="submit" value="ajouter l'article" name="add_product" class="btn">
        </form>
      </section>
      
    </div>


    <footer>
      <p>@Copyright machinmachin</p>
    </footer>


      <script src="vendre.js"></script>
  </body>
  </html>



