

<?php
$conn = mysqli_connect('localhost','root','','shop_db') or die('connection failed');



if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){

      $message[] = 'L\'article a été supprimé';
   }else{
      $message[] = 'L\'article n\'a pas pu être supprimé';
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'Article modifié avec succès';
      header('location:mesArticles.php');
   }else{
      $message[] = 'L\'article n\'a pas pu être modifié';
      header('location:mesArticles.php');
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
         <th>product image</th>
         <th>product name</th>
         <th>product price</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
            session_start();
            $valeur = $_SESSION['ma_variable'];
            $select_products = "SELECT * FROM products WHERE email = '$valeur'";
            $resultat = $conn->query($select_products);
            if ($resultat->num_rows > 0) {
               while ($row = $resultat->fetch_assoc()) {
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?> €</td>
            <td>
               <a href="mesArticles.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Confirmez la suppression de l\'article ?');"> <i class="bx bx-trash"></i> delete </a>
               <a href="mesArticles.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="bx bx-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>Aucun article en vente actuellement</div>";
            };
         ?>
      </tbody>
   </table>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
      <input type="file" class="box" required name="update_p_image" accept=" image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the prodcut" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>
      <footer>
         <p>@Copyright </p>
      </footer>
      <script src="vendre.js"></script>
   </body>
   </html>