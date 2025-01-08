<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="menu.css" />
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="main.css" />
  </head>
  <body>
     <header id="start">
      <div class="overlay">
        <h1>LOGIN</h1>
      </div>
    </header>
    <div>
      <form class="login" method="post">
        <input type="text" name="name" required placeholder="Login Name" />
        <br />
        <input type="password" name="password" required placeholder="Password" />
        <br />
        <button><a href="account_erstellen.php">Account erstellen</a></button>
        <input type="submit" value="Anmelden" />
      </form>
    </div>

    <div class="menu">
      <nav class="navigation" id="home">
        <ul>
          <li>
            <a class="na1" href="http://localhost/php/TGC/index/index.php">Home</a>
          </li>
          <li>
            <a class="na2" href="http://localhost/php/TGC/index/kontakt.php">Kontakt</a>
          </li>
          <li>
            <a class="na3" href="http://localhost/php/TGC/index/imprssum.php">Impressum</a>
          </li>
        </ul>
      </nav>
    </div>
  </body>
</html>


<?php
$host = 'localhost';
$dbname = 'cg';
$username = 'root';
$password = '';
$con = mysqli_connect($host, $username, $password, $dbname);

if (!$con) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . mysqli_connect_error());
}

session_start(); //Startet die Sitzung

// Wenn Benutzer eingeloggt weiterleitung Hauptseite
// if (isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = mysqli_real_escape_string($con, $_POST["name"]);
    $inputPassword = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$inputUsername'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Fehler bei der Datenbankabfrage: " . mysqli_error($con));
    }

    //Benutzer überprüfen
    if (mysqli_num_rows($result) == 1) {
        //Passwort überprüfen
        $row = mysqli_fetch_assoc($result);
        $storedPasswordHash = $row['password_hash'];

        if (password_verify($inputPassword, $storedPasswordHash)) {
            //Benutzer Sitzung speichern
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];

            //Cookiefür 30 Tage
            setcookie("user_id", $row['user_id'], time() + (30 * 24 * 60 * 60), "/");

            // Bestätigungsmeldung
            echo "Erfolgreich eingeloggt, " . htmlspecialchars($row['username']) . "!";
            header("location: \php\TGC\index\index.php");
            echo "<br><a href='index.php'>Zum Dashboard</a>";
        } else {
            echo "Falsches Passwort!";
        }
    } else {
        echo "Benutzername nicht gefunden!";
    }
}
?>


