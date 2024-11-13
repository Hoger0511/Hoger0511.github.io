<?php
// Start sesjon
session_start();

// Database tilkobling
$host = 'localhost';
$dbname = 'support_db';
$user = 'root';
$pass = '';
// $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

// Sjekk om skjemaet er sendt
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hent bruker fra database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Sjekk om passordet er riktig
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        echo "Innlogging vellykket!";
    } else {
        echo "Feil brukernavn eller passord!";
    }
}

?>

<!-- Innloggingsskjema -->
<form method="POST" action="login.php">
    <link rel="stylesheet" href="">
    <input type="text" name="username" placeholder="Brukernavn" required>
    <input type="password" name="password" placeholder="Passord" required>
    <button type="submit">Logg inn</button>
</form>