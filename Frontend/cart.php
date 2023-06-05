<?php

  $conn = mysqli_connect('localhost','root','','shop_db') or die('connection failed');
?>
<?php



if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}

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




<div class="container">

<section class="shopping-cart">

   <h1 class="heading">shopping cart</h1>

   <table>
      <br>
      <br>

      <thead>
         <th>Image</th>
         <th>Nom</th>
         <th>Prix</th>
         <th>Quantite</th>
         <th>Prix total</th>
         <th>Action</th>
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="200" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td><?php echo number_format($fetch_cart['price']); ?>€</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="Rafraîchir" name="update_update_btn">
               </form>   
            </td>
            <td><?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>€</td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Etes vous sures de votre choix')" class="btn"> </i> Retirer le produit</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="tout_parcourir_connecte.php" class="btn" style="margin-top: 0;">Continuer le shopping</a></td>
            <td colspan="3">Total de la commande :</td>
            <td><?php echo $grand_total; ?>€</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('Voulez-vous vraiment tout supprimer ?');" class="btn">  Vider le panier </a></td>
         </tr>

      </tbody>

   </table>

   <div>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Valider le panier</a>
   </div>

</section>

</div>
   
<script src="java.js"></script>

</body>
</html>