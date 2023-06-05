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
  <title>Agora Francia</title>
</head>
<body>
  <header>
    <h2 class="logo">
      Agora Francia
    </h2>
    <nav class="navigation">
  				<a class="page" href="indexConnecte.html">Accueil</a>
  				<a class="page" href="tout_parcourir_connecte.php">Tout parcourir</a>
  				<a class="page" href="presentation_connecte.html">A propos de nous</a>
  				<a class="page" href="indexConnecte#pageContact">Contact</a>
  				<div class="dropdown">
   					<button class="btn-user"><i class="bx bx-user"></i></button>
    				<ul class="menu-deroulant">
      					<li><a class="page" href="#">Mon compte</a></li>
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

  	<section id="prodetails" class="section-p1">
    	<div class="single-pro-image">
      		<img src="uploaded_img/<?php echo $_GET['image']; ?>" width="100%" id="mainImg">
    	</div>

      <form action="" method="post">
    	<div class="single-pro-details">
      		<h1><?php echo $_GET['name']; ?></h1>
      		<h2><?php echo $_GET['price']; ?>€</h2>
          <input type="submit" class="btn-products" value="Ajouter au panier" name="add_to_cart">
      		<?php 
      			session_start();
      			if (isset($_SESSION['la_description'])) {
         			$description = $_SESSION['la_description'];
         			echo "<h4>$description</h4>";
      			}
      		?>
    	</div>
    </form>
	</section>


  <footer>
    <p>@Copyright</p>
  </footer>

  
</body>
</html>