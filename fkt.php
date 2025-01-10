<?php
// db verbindung info
    function sqlconnect(){               //
        $host = 'localhost';
        $dbname = 'cg';
        $username = 'root';
        $password = '';
        $con = mysqli_connect($host, $username, $password, $dbname);

        if (!$con) {
            die("Verbindung zur Datenbank fehlgeschlagen: " . mysqli_connect_error());
        }
        return $con;
    }


// html
    function generate_header($überschrift) {    //
        // Starte die PHP-Session, um auf die Session-Daten zugreifen zu können
        session_start();
        
        // HTML-Ausgabe für den Header und Navigation
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Index</title>

            <link rel="stylesheet" href="menu.css" />
            <link rel="stylesheet" href="main.css" />

            <link href="https://fonts.cdnfonts.com/css/auto-mode" rel="stylesheet">
            <link href="https://fonts.cdnfonts.com/css/neonize" rel="stylesheet">
        </head>
        <body class="startfx">
            
            <header id="start">
            <div class="overlay">
                <h1>'.$überschrift.'</h1>
            </div>';
    }
    function close_header(){
        echo '</header>';
    }
    function generate_navbar() {                //
        echo '<div class="menu">
                <div class="logo">
                    <!-- <img src="Planung-Startseite.png" alt="" width="40" /> -->
                </div>

                <nav class="navigation" id="home">
                    <ul>
                        <li>
                            <a class="na1" href="index.php">Home</a>
                        </li>
                        <li>
                            <a class="na2" href="kontakt.php">Kontakt</a>
                        </li>
                        <li>
                            <a class="na3" href="impressum.php">Impressum</a>
                        </li>';

        // Überprüfen, ob der Benutzer eingeloggt ist
        if (isset($_SESSION['user_id'])) {
            // Benutzer ist eingeloggt, zeige Logout-Link
            echo "<li>";
            echo "<a class='na3' href='logout.php'>Logout</a>";
            echo "</li>";
        } else {
            // Benutzer ist nicht eingeloggt, zeige Login-Link
            echo "<li>";
            echo "<a class='na3' href='login_tcg.php'>Login</a>";
            echo "</li>";
        }
        echo '    
                    </ul>
                </nav>
            </div>';
    }
    function generate_footer(){                 //
        echo '    
            <footer>
            <div class="flex33">
                Text
            </div>

            <div class="flex33">
                <a href="#start">Home</a>
                <p>|</p>
                <a href="kontakt.php">Kontakt</a>
                <p>|</p>
                <a href="imprssum.php">Impressum</a>
            </div>

            <div class="flex33">
                Text
            </div>
            </footer>
        ';
    }

    function close_html(){                      //
    echo '</body>
        </html>';
    }  


// account
    function login_html() {                     //
        echo ' <div class="login_position">
                <form class="menu" method="post">
                    <input type="text" name="name" required placeholder="Login Name" />
                    <br />
                    <input type="password" name="password" required placeholder="Password" />
                    <br />
                    <button><a href="account_erstellen.php">Account erstellen</a></button>
                    <input type="submit" value="Anmelden" />
                </form>
            </div>';
    }
    function verifylogin(){                     //
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputUsername = mysqli_real_escape_string(sqlconnect(), $_POST["name"]);
        $inputPassword = $_POST["password"];

        $sql = "SELECT * FROM users WHERE username = '$inputUsername'";
        $result = mysqli_query(sqlconnect(), $sql);

        if (!$result) {
            die("Fehler bei der Datenbankabfrage: " . mysqli_error(sqlconnect()));
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
                header("location: index.php");
                echo "<br><a href='index.php'>Zum Dashboard</a>";
            } else {
                echo "Falsches Passwort!";
            }
        } else {
            echo "Benutzername nicht gefunden!";
        }
    }
    }
    function logout(){                          //
        session_start();
        session_destroy();
        header("Location: index.php");
    }
    function createaccount_html() {             //
        echo ' <div class="login_position">
                <form class="menu" method="post" action="account_erstellen.php">
                    <input type="text" name="name" required placeholder="Login Name" />
                    <br />
                    <input type="password" name="password" required placeholder="Password" />
                    <br/>
                    <input type="password" name="pwmatch" required placeholder="Password wiederholen" />
                    <br />
                    <input type="submit" value="Erstellen" />
                </form>
            </div>';
    }
    function createaccount(){                   //
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $inputUsername = mysqli_real_escape_string(sqlconnect(), $_POST["name"]);
            $inputPassword = $_POST["password"];
            $inputPasswordRepeat = $_POST["pwmatch"];

            //Überprüfen ob Benutzername bereits existiert
            $checkUsernameQuery = "SELECT * FROM users WHERE username = '$inputUsername'";
            $checkUsernameResult = mysqli_query(sqlconnect(), $checkUsernameQuery);
            
            if (mysqli_num_rows($checkUsernameResult) > 0) {
                echo "Der Benutzername ist bereits vergeben.";
                echo "Die Passwörter stimmen nicht überein.";
            } else {
                $passwordHash = password_hash($inputPassword, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (username, password_hash) VALUES ('$inputUsername', '$passwordHash')";
                if (mysqli_query(sqlconnect(), $sql)) {
                    echo "Benutzer erfolgreich registriert.";
                    echo '<a href="login_tcg.php">zum Login</a>';
                } else {
                    echo "Fehler bei der Registrierung: " . mysqli_error(sqlconnect());
                }
            }
        }

    }
?>
