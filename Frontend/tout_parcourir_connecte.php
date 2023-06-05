<?php
  $conn = mysqli_connect('localhost','root','','shop_db') or die('connection failed');

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
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
  <title>Tout parcourir</title>
</head>
<body>
  <header>
      <h2 class="logo">
        Agora Francia
      </h2>
      <nav class="navigation">
          <a class="page" href="index.html">Accueil</a>
          <a class="page" href="#">Tout parcourir</a>
          <a class="page" href="presentation.html">A propos de nous</a>
          <a class="page" href="index#pageContact">Contact</a>
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
  
    <div class="div-affichage">
      <section class="section-jeux-affichage">

        <div class="box-affichage-jeux">

          <?php
      
          $select_products = mysqli_query($conn, "SELECT * FROM `products`");
          if(mysqli_num_rows($select_products) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_products)){
          ?>

          <form action="" method="post">
            <div class="box-affichage-jeux-carac" onclick="redirectToProduct('<?php echo $fetch_product['name']; ?>', '<?php echo $fetch_product['price']; ?>', '<?php echo $fetch_product['image']; ?>', '<?php echo $fetch_product['description']; ?>');">
              <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
              <h3><?php echo $fetch_product['name']; ?></h3>
              <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">             
              <div class="boxBox">
                <div class="price"><?php echo $fetch_product['price']; ?>€</div>
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                <input type="submit" class="btn-products" value="Ajouter au panier" name="add_to_cart">
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
    <script>
  function redirectToProduct(name, price, image) {
    const url = `ficheProduit.php?name=${encodeURIComponent(name)}&price=${encodeURIComponent(price)}&image=${encodeURIComponent(image)}`;
    window.location.href = url;
  }
</script>
</body>
</html>
