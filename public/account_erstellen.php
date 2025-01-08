<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="menu.css" />
    <link rel="stylesheet" href="login.css" />
  </head>
  <body>

    <header id="start">
      <div class="overlay">
        <h1>ANMELDUNG</h1>
      </div>
    </header>

    <div >
      <form class="login" method="post" action="account_erstellen.php">
        <input type="text" name="name" required placeholder="Login Name" />
        <br />
        <input type="password" name="password" required placeholder="Password" />
        <br/>
        <input type="password" name="pwmatch" required placeholder="Password wiederholen" />
        <br />
        <input type="submit" value="Erstellen" />
      </form>
    </div>

    <div class="menu">
      <nav class="navigation" id="home">
        <ul>
          <li>
            <a class="na1" href="http://localhost/php/TGC/index/index.php">Home</a>
          </li>
          <li>
            <a class="na2" href="kontakt.php">Kontakt</a>
          </li>
          <li>
            <a class="na3" href="imprssum.php">Impressum</a>
          </li>
          <li>
            <a class="na3" href="login\login_tcg.php">Login</a>
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = mysqli_real_escape_string($con, $_POST["name"]);
    $inputPassword = $_POST["password"];
    $inputPasswordRepeat = $_POST["pwmatch"];

    //Überprüfen ob Benutzername bereits existiert
    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$inputUsername'";
    $checkUsernameResult = mysqli_query($con, $checkUsernameQuery);
    
    if (mysqli_num_rows($checkUsernameResult) > 0) {
        echo "Der Benutzername ist bereits vergeben.";
        echo "Die Passwörter stimmen nicht überein.";
    } else {
        $passwordHash = password_hash($inputPassword, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password_hash) VALUES ('$inputUsername', '$passwordHash')";
        if (mysqli_query($con, $sql)) {
            echo "Benutzer erfolgreich registriert.";
            echo '<a href="login_tcg.php">zum Login</a>';
        } else {
            echo "Fehler bei der Registrierung: " . mysqli_error($con);
        }
    }
}
?>
