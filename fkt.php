<?php
// db verbindung info
    function sqlconnect(): bool|mysqli{               //
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
            
            <header id="start" class="header1">
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
    function gamesession_navbar() {                //
        echo '<div class="gamemenu">

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
                <form class="menu formlogin" method="post">
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
                <form class="menu formlogin" method="post" action="account_erstellen.php">
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


    function turn_button() {
    $game_id = check_game_id();

    if (isset($_POST['end_turn']) && $_POST['end_turn'] == 'ZugBeenden') {
        // Ermittle den aktuellen Spieler basierend auf dem Zug
        $sql_current_player = 
            'SELECT 
                CASE 
                    WHEN turn % 2 = 1 THEN player1_id
                    ELSE player2_id
                END AS current_player
            FROM game_sessions
            WHERE game_id = '.$game_id.';';
        $result = mysqli_query(sqlconnect(), $sql_current_player);
        $current_player = mysqli_fetch_array($result)['current_player'];

        // Verschiebe die 5 aktiven Karten in den Ablagestapel
        $sql_move_to_discard = 
            'INSERT INTO discard_pile (game_id, card_id, discarded_at)
            SELECT 
                game_id,
                card_id,
                NOW() AS discarded_at
            FROM 
                game_deck
            WHERE 
                game_id = '.$game_id.'
                AND user_id = '.$current_player.'
                AND is_active = 1
            ORDER BY 
                position ASC
            LIMIT 5;';
        mysqli_query(sqlconnect(), $sql_move_to_discard);

        // Setze die Karten, die in den Ablagestapel verschoben wurden, auf inaktiv
        $sql_deactivate_cards = 
            'UPDATE game_deck
            SET is_active = 0
            WHERE game_id = '.$game_id.'
              AND user_id = '.$current_player.'
              AND is_active = 1
              AND card_id IN (
                  SELECT card_id
                  FROM (
                      SELECT card_id
                      FROM game_deck
                      WHERE game_id = '.$game_id.'
                        AND user_id = '.$current_player.'
                        AND is_active = 1
                      ORDER BY position ASC
                      LIMIT 5
                  ) AS temp_table
              );';
        mysqli_query(sqlconnect(), $sql_deactivate_cards);

        // Erhöhe den Zugzähler
        $sql_next_turn = 
            'UPDATE game_sessions
            SET turn = turn + 1
            WHERE game_id = '.$game_id.';';
        mysqli_query(sqlconnect(), $sql_next_turn);

        // Leite zur aktuellen Seite weiter
        header("Location: gamesession.php");
        exit;
    }

    // Ermittle den aktuellen Zug
    $sql_turn = 
        'SELECT turn 
        FROM game_sessions 
        WHERE game_id = '.$game_id.';';
    $result = mysqli_query(sqlconnect(), $sql_turn);
    $turn = mysqli_fetch_array($result);

    // Zeige die entsprechende Schaltfläche an
    if ($turn['turn'] % 2 == 1) {
        // Spielerzug
        echo '<div class="zugbutton">
            <form class="" action="gamesession.php" method="POST">
                <input type="hidden" name="end_turn" value="ZugBeenden">
                <input type="submit" value="Zug Beenden">
            </form>
        </div>'; 
    } else {
        // Computerzug
        echo '<div class="zugbutton">
            <form class="" action="gamesession.php" method="POST">
                <input type="hidden" name="end_turn" value="ZugBeenden">
                <input type="submit" value="Com Zug Beenden">
            </form>
        </div>';
    }
    }



    function turn_who(){
    $game_id = check_game_id();
    $sql_turn = 
        'SELECT turn 
        FROM game_sessions 
        WHERE game_id = '.$game_id.';'
    ;

    $result = mysqli_query(sqlconnect(),$sql_turn);
    $turn = mysqli_fetch_array($result);

    if($turn['turn'] % 2 == 1){
        return '<div class="">    
            <p> Du bist am zug! </p>
        </div>'; 
    }
    else{
        return '<div class="">          
            <p> Der Gegner ist am zug! </p>
        </div>';
    }
    }
    function turn_nr(){

        $game_id = check_game_id();
        $sql_turn = 
            'SELECT turn 
            FROM game_sessions 
            WHERE game_id = '.$game_id.';'
        ;

        $result = mysqli_query(sqlconnect(),$sql_turn);
        $turn = mysqli_fetch_array($result);

        if($turn['turn'] % 2 == 1){
            return '<div class="zugnr">
                <p>Zug<br>'.$turn['turn'].'</p>
            </div>'; 
        }
        else{
            return '<div class="zugnr">
                <p>Zug<br>'.$turn['turn'].'</p>
            </div>';
        }
    }


     
    function load_game_deck_info_p1($game_deck_info){

        $sql= 
        'SELECT 
            game_sessions.game_id,
            deck_cards.card_id,
            cards.card_name,
            cards.ATK,
            cards.DEF,
            cards.energy_cost,
            cards.URL,
            ROW_NUMBER() OVER (ORDER BY deck_cards.card_id ASC) AS position,
            1 AS is_active,
            users.user_id 
        FROM 
            game_sessions
        JOIN 
            users ON users.user_id = game_sessions.player1_id 
        JOIN 
            decks ON decks.user_id = users.user_id
        JOIN 
            deck_cards ON deck_cards.deck_id = decks.deck_id
        JOIN 
            cards ON cards.card_id = deck_cards.card_id
        WHERE 
            game_sessions.game_id = 1;'
        ;

        $result = mysqli_query(sqlconnect(),$sql);
        $deck = mysqli_fetch_array($result);
        return $deck;
    }
    function load_game_deck_info_p2($game_deck_info){

        $sql= 
        'SELECT 
            game_sessions.game_id,
            deck_cards.card_id,
            cards.card_name,
            cards.ATK,
            cards.DEF,
            cards.energy_cost,
            cards.URL,
            ROW_NUMBER() OVER (ORDER BY deck_cards.card_id ASC) AS position,
            1 AS is_active,
            users.user_id 
        FROM 
            game_sessions
        JOIN 
            users ON users.user_id = game_sessions.player2_id 
        JOIN 
            decks ON decks.user_id = users.user_id
        JOIN 
            deck_cards ON deck_cards.deck_id = decks.deck_id
        JOIN 
            cards ON cards.card_id = deck_cards.card_id
        WHERE 
            game_sessions.game_id = 1;'
        ;

        $result = mysqli_query(sqlconnect(),$sql);
        $deck = mysqli_fetch_array($result);
        return $deck;
    }

    function load_deck_p1_p2($game_deck_load){      //ladet und mischt das deck für die spieler 

        $sql= 
        'INSERT INTO game_deck (game_id, card_id, position, is_active, user_id)
        SELECT 
            game_sessions.game_id,
            deck_cards.card_id,
            ROW_NUMBER() OVER (PARTITION BY users.user_id ORDER BY RAND()) AS position,
            1 AS is_active,
            users.user_id
        FROM 
            game_sessions
        JOIN 
            users ON users.user_id IN (game_sessions.player1_id, game_sessions.player2_id)
        JOIN 
            decks ON decks.user_id = users.user_id
        JOIN 
            deck_cards ON deck_cards.deck_id = decks.deck_id
        WHERE 
            game_sessions.game_id = 1;
        ';

        $result = mysqli_query(sqlconnect(),$sql);
        $deck = mysqli_fetch_array($result);
    }
    
    function delete_game_deck(){       
        $sql= 
        'DELETE FROM game_deck
        WHERE game_id = 1;
        ';

        $result = mysqli_query(sqlconnect(),$sql);
    }



    //     function discard_pile(){

    //     $sql= 
    //     'SELECT 
    //         cards.card_id,
    //         cards.card_name,
    //         cards.card_type,
    //         cards.energy_cost,
    //         cards.ATK,
    //         cards.DEF,
    //         cards.description,
    //         cards.URL,
    //         discard_pile.discarded_at
    //     FROM 
    //         discard_pile
    //     JOIN 
    //         cards ON cards.card_id = discard_pile.card_id
    //     WHERE 
    //         discard_pile.game_id = ?
    //     ORDER BY 
    //         discard_pile.discarded_at ASC;
    //     '
    //     ;

    //     $result = mysqli_query(sqlconnect(),$sql);
    //     $pile = mysqli_fetch_array($result);
    // }

    function card() {
    $sql_draw = 
        'SELECT 
            game_deck.card_id,
            cards.card_name,
            cards.ATK,
            cards.DEF,
            cards.energy_cost,
            cards.URL,
            game_deck.position
        FROM 
            game_deck
        JOIN 
            cards ON cards.card_id = game_deck.card_id
        WHERE 
            game_deck.game_id = 1 
            AND game_deck.user_id = (SELECT player1_id FROM game_sessions WHERE game_id = 1) -- Player1
            AND game_deck.is_active = 1                                                    -- Nur aktive Karten
        ORDER BY 
            game_deck.position ASC
        LIMIT 5;';

    $result = mysqli_query(sqlconnect(), $sql_draw);

    while ($row = mysqli_fetch_assoc($result)) {
        echo  
            '<div>
                <div class="card">
                    <div class="cardheader">
                        <div class="cardname">' .$row['card_name'] . '</div>
                        <div class="cardenergie">' . $row['energy_cost'] . '</div>
                    </div>
                    <div>
                        <div class="img_container">
                            <img src="' . $row['URL'] . '" alt="404">
                        </div>
                    </div>
                    <div>
                        <div class="eff">ATK: ' . $row['ATK'] . '</div>
                        <div class="eff">DEF: ' . $row['DEF'] . '</div>
                    </div>                                    
                </div>        
            </div>';
    }
}

    function draw(){
        $game_id = check_game_id();
        $sql_turn = 
            'SELECT turn 
            FROM game_sessions 
            WHERE game_id = '.$game_id.';'
        ;
        $result = mysqli_query(sqlconnect(),$sql_turn);
        $turn = mysqli_fetch_array($result);
        
        if($turn['turn'] % 2 == 1){
            echo '<div></div>';

            card();
 
            echo '<div></div>';
        }
        else{

        }
    }


    function healthbar($player){
        $sql = "SELECT p1_health, p2_health FROM game_sessions WHERE game_id = 1;";
        $result = mysqli_query(sqlconnect(), $sql);
        $health = mysqli_fetch_array($result);
        return $health[$player];
    }
    function healthbar_max($player){
        $sql = "SELECT p1_max_health, p2_max_health FROM game_sessions WHERE game_id = 1;";
        $result = mysqli_query(sqlconnect(), $sql);
        $health = mysqli_fetch_array($result);
        return $health[$player];
    }
?>
