<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mdp = $_POST['password'];
    $tel = $_POST['phone'];

    // Prepare and bind the statement
    $stmt = $conn->prepare("INSERT INTO user (nom, email, mdp, tel) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $email, $mdp, $tel);

    if ($stmt->execute()) {
        echo "Enregistrement effectué avec succès!";
    } else {
        echo "Erreur lors de l'enregistrement: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}


if(isset($_POST['submit'])) {
    // Code à exécuter lorsque le bouton est cliqué
    // Vous pouvez effectuer une redirection vers une autre page avec la fonction header()
    header("Location: page3.php");
    exit();
}



// Close the connection$conn->close();
?>