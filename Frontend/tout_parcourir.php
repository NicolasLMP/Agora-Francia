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
  <header>
      <h2 class="logo">
        Agora Francia
      </h2>
      <nav class="navigation">
          <a class="page" href="index.html">Accueil</a>
          <a class="page" href="tout_parcourir.php" id="tout-parcourir-link" class="link">Tout parcourir</a>
          <a class="page" href="presentation.html">A propos de nous</a>
          <a class="page" href="#pageContact">Contact</a>
          <a href="login.html"><i  class='bx bx-user'></i></a>
        <a href="panier.html"><i class='bx bx-shopping-bag'></i></a>
          <div class="icon">
            <i class='bx bx-menu'></i>
          </div>
      </nav>
      <div id="product-list-container"></div>  
      <div id="retour-accueil-container"></div>
    </header>
  
    <div class="div-affichage">
      <section class="section-jeux-affichage">

        <div class="box-affichage-jeux">

          <?php
      
          $select_products = mysqli_query($conn, "SELECT * FROM `products`");
          if(mysqli_num_rows($select_products) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_products)){
          ?>

          <form action="" method="post">
            <div class="box-affichage-jeux-carac" onclick="window.location.href='ficheProduit.html';">
              <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
              <h3><?php echo $fetch_product['name']; ?></h3>
              <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">             
              <div class="boxBox">
                <div class="price"><?php echo $fetch_product['price']; ?>€</div>
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                <input type="submit" class="btn-products" value="add to cart" name="add_to_cart">
              </div>
            </div>
          </form>
          <?php
            };
          };
          ?>
      </section>
      
    </div>


  <script src="java.js"></script>
  <footer>
      <p>@Copyright machinmachin</p>
    </footer>
</body>
</html>
