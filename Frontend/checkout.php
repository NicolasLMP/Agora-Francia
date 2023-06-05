<?php

  $conn = mysqli_connect('localhost','root','','shop_db') or die('connection failed');
  ?>
  <?php

if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
            <p>(*pay when product arrives*)</p>
         </div>
            <a href='products.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
       <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="java.js"></script>
      <script src="fonction.js"></script>
      <script src="user.js"></script>
      <title>Agora Francia</title>
   </head>
   <body>
      <div id="content">
      <header>
         <h2 class="logo">
            Agora Francia
         </h2>
         <nav class="navigation">
            <a class="page" href="indexConnecte.php">Accueil</a>
            <a class="page" href="tout_parcourir_connecte.php">Tout parcourir</a>
            <a class="page" href="presentation_connecte.html">A propos de nous</a>
            <a class="page" href="#pageContact">Contact</a>
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


<div class="container1">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <span class="grand-total">Récapitulatif de votre commande</span>
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }

      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> Total : <?= $grand_total; ?>€ </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>Votre nom</span>
            <input type="text" placeholder="Insérer votre nom" name="name" required>
         </div>
         <div class="inputBox">
            <span>Numéro de téléphone</span>
            <input type="number" placeholder="Insérer votre numéro de téléphone" name="number" required>
         </div>
         <div class="inputBox">
            <span>Votre email</span>
            <input type="email" placeholder="Insérer votre email" name="email" required>
         </div>
         <div class="inputBox">
            <span>Méthode de paiement</span>
            <select name="method">
               <option value="cash on delivery" selected>Paiement par cash</option>
               <option value="credit cart">Carte de crédit</option>
               <option value="paypal">Paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Adresse du batiment</span>
            <input type="text" placeholder="Insérer votre adresse" name="flat" required>
         </div>
         <div class="inputBox">
            <span>Etage</span>
            <input type="text" placeholder="Insérer votre étage" name="street" required>
         </div>
         <div class="inputBox">
            <span>Ville</span>
            <input type="text" placeholder="Insérer votre ville" name="city" required>
         </div>
         <div class="inputBox">
            <span>Région</span>
            <input type="text" placeholder="Insérer votre région" name="state" required>
         </div>
         <div class="inputBox">
            <span>Pays</span>
            <input type="text" placeholder="Insérer votre Pays" name="country" required>
         </div>
         <div class="inputBox">
            <span>code du batiment</span>
            <input type="text" placeholder="Insérer le code du batiment" name="pin_code" required>
         </div>
      </div>
      <input  type="submit" value="Valider la commande" name="order_btn" class="btn">
   </form>

</section>

</div>

<script src="java.js"></script>
   
</body>
</html>