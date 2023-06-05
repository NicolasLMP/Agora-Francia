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
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Vérifier les informations d'identification
        $sql = "SELECT * FROM user WHERE email = '$email' AND mdp = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // L'utilisateur est connecté avec succès
            echo "Connexion réussie!";
            echo "bienvenue a vous monsieur $email";
            header('location:indexConnecte.html');
        } else {
            // Identifiants invalides
            echo "Adresse e-mail ou mot de passe incorrect.";
        }
    } else {
        echo "Veuillez saisir votre adresse e-mail et votre mot de passe.";
    }
    session_start();
        $ma_variable = $email;
        $_SESSION['ma_variable'] = $ma_variable;
    }



// Fermer la connexion
$conn->close();
?>

